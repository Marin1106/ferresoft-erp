<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Client;
use App\Models\Log;
use App\Models\Kardex;

use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\SalesExport;

use App\Services\Matias\ElectronicInvoiceService;

class SaleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR VENTAS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = $request->search;

        $sales = Sale::with([
                'client',
                'product'
            ])
            ->when($search, function ($query) use ($search) {

                $query->whereHas('client', function ($q) use ($search) {

                    $q->where(
                        'name',
                        'LIKE',
                        "%{$search}%"
                    );

                })->orWhereHas('product', function ($q) use ($search) {

                    $q->where(
                        'name',
                        'LIKE',
                        "%{$search}%"
                    );

                });

            })
            ->latest()
            ->paginate(10);

        return view(
            'sales.index',
            compact(
                'sales',
                'search'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULARIO CREAR VENTA
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | PRODUCTOS CON STOCK
        |--------------------------------------------------------------------------
        */

        $products = Product::where(
                'stock',
                '>',
                0
            )
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | CLIENTES
        |--------------------------------------------------------------------------
        */

        $clients = Client::orderBy('name')->get();

        return view(
            'sales.create',
            compact(
                'products',
                'clients'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | GUARDAR VENTA
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, ElectronicInvoiceService $electronicInvoice)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDACIONES
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'client_id'      => 'required|exists:clients,id',

            'product_id'     => 'required|exists:products,id',

            'quantity'       => 'required|integer|min:1',

            'payment_method' => 'required',

            'status'         => 'required',

        ]);

        /*
        |--------------------------------------------------------------------------
        | BUSCAR PRODUCTO
        |--------------------------------------------------------------------------
        */

        $product = Product::findOrFail(
            $request->product_id
        );

        /*
        |--------------------------------------------------------------------------
        | VALIDAR STOCK
        |--------------------------------------------------------------------------
        */

        if ($product->stock <= 0) {

            return back()->with(

                'error',
                'El producto no tiene stock disponible'

            );
        }

        if ($request->quantity > $product->stock) {

            return back()->with(

                'error',
                'Stock insuficiente'

            );
        }

        /*
        |--------------------------------------------------------------------------
        | CALCULAR VALORES
        |--------------------------------------------------------------------------
        */

        $price = $product->price;

        $subtotal = $price * $request->quantity;

        $iva = $subtotal * 0.19;

        $total = $subtotal + $iva;

        /*
        |--------------------------------------------------------------------------
        | CREAR VENTA
        |--------------------------------------------------------------------------
        */

        $sale = Sale::create([

            'client_id'      => $request->client_id,

            'product_id'     => $request->product_id,

            'quantity'       => $request->quantity,

            'price'          => $price,

            'subtotal'       => $subtotal,

            'iva'            => $iva,

            'total'          => $total,

            'payment_method' => $request->payment_method,

            'status'         => $request->status,

        ]);

        /*
        |--------------------------------------------------------------------------
        | STOCK ANTERIOR
        |--------------------------------------------------------------------------
        */

        $stockAnterior = $product->stock;

        /*
        |--------------------------------------------------------------------------
        | DESCONTAR STOCK
        |--------------------------------------------------------------------------
        */

        $product->stock -= $request->quantity;

        $product->save();

        /*
        |--------------------------------------------------------------------------
        | REGISTRAR KARDEX
        |--------------------------------------------------------------------------
        */

        Kardex::create([

            'product_id' => $product->id,

            'type' => 'salida',

            // IMPORTANTE:
            // usa los nombres EXACTOS de tus columnas

            'quantity' => $request->quantity,

            'stock_before' => $stockAnterior,

            'stock_after' => $product->stock,

            'description' =>
                'Venta registrada ID #' . $sale->id,

            'user' => Auth::user()->name,

        ]);

        /*
        |--------------------------------------------------------------------------
        | GUARDAR LOG
        |--------------------------------------------------------------------------
        */

        Log::create([

            'action' => 'CREAR VENTA',

            'description' =>
                'Venta registrada | Producto: ' .
                $product->name .
                ' | Cantidad: ' .
                $request->quantity .
                ' | Total: $' .
                number_format($total, 2),

            'user' => Auth::user()->name

        ]);

        /*
        |--------------------------------------------------------------------------
        | FACTURA ELECTRÓNICA (MATIAS API / DIAN)
        |--------------------------------------------------------------------------
        | Si la DIAN rechaza o falla la conexión, la venta queda registrada
        | y la factura se puede reenviar desde el detalle de la venta.
        */

        $fe = $electronicInvoice->send($sale);

        /*
        |--------------------------------------------------------------------------
        | REDIRECCIONAR
        |--------------------------------------------------------------------------
        */

        $redirect = redirect()
            ->route('sales.index')
            ->with(

                'success',
                'Venta registrada correctamente' .
                    ($fe && $fe['ok'] ? '. ' . $fe['message'] : '')

            );

        if ($fe && ! $fe['ok']) {

            $redirect->with('error', $fe['message']);

        }

        return $redirect;
    }

    /*
    |--------------------------------------------------------------------------
    | REENVIAR FACTURA ELECTRÓNICA
    |--------------------------------------------------------------------------
    */

    public function sendElectronicInvoice(Sale $sale, ElectronicInvoiceService $electronicInvoice)
    {
        if (! config('matias.enabled')) {

            return back()->with('error', 'La facturación electrónica está desactivada (MATIAS_ENABLED=false).');

        }

        if ($sale->status === 'Cancelada') {

            return back()->with('error', 'Una venta cancelada no se factura electrónicamente.');

        }

        $fe = $electronicInvoice->send($sale);

        return back()->with($fe['ok'] ? 'success' : 'error', $fe['message']);
    }

    /*
    |--------------------------------------------------------------------------
    | MOSTRAR VENTA
    |--------------------------------------------------------------------------
    */

    public function show(Sale $sale)
    {
        $sale->load([
            'client',
            'product'
        ]);

        return view(
            'sales.show',
            compact('sale')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR VENTA
    |--------------------------------------------------------------------------
    */

    public function destroy(Sale $sale)
    {
        /*
        |--------------------------------------------------------------------------
        | DEVOLVER STOCK
        |--------------------------------------------------------------------------
        */

        $product = Product::find(
            $sale->product_id
        );

        if ($product) {

            /*
            |--------------------------------------------------------------------------
            | STOCK ANTERIOR
            |--------------------------------------------------------------------------
            */

            $stockAnterior = $product->stock;

            /*
            |--------------------------------------------------------------------------
            | DEVOLVER STOCK
            |--------------------------------------------------------------------------
            */

            $product->stock += $sale->quantity;

            $product->save();

            /*
            |--------------------------------------------------------------------------
            | REGISTRAR KARDEX
            |--------------------------------------------------------------------------
            */

            Kardex::create([

                'product_id' => $product->id,

                'type' => 'entrada',

                'quantity' => $sale->quantity,

                'stock_before' => $stockAnterior,

                'stock_after' => $product->stock,

                'description' =>
                    'Eliminación venta ID #' . $sale->id,

                'user' => Auth::user()->name,

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | LOG
        |--------------------------------------------------------------------------
        */

        Log::create([

            'action' => 'ELIMINAR VENTA',

            'description' =>
                'Se eliminó la venta ID: ' .
                $sale->id,

            'user' => Auth::user()->name

        ]);

        /*
        |--------------------------------------------------------------------------
        | ELIMINAR
        |--------------------------------------------------------------------------
        */

        $sale->delete();

        return redirect()
            ->route('sales.index')
            ->with(

                'success',
                'Venta eliminada correctamente'

            );
    }

    /*
    |--------------------------------------------------------------------------
    | FACTURA PDF
    |--------------------------------------------------------------------------
    */

    public function invoice(Sale $sale)
    {
        $sale->load([
            'client',
            'product'
        ]);

        $pdf = Pdf::loadView(

            'sales.invoice',

            compact('sale')

        );

        return $pdf->download(

            'factura-' . $sale->id . '.pdf'

        );
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORTAR EXCEL
    |--------------------------------------------------------------------------
    */

    public function export()
    {
        /*
        |--------------------------------------------------------------------------
        | LOG
        |--------------------------------------------------------------------------
        */

        Log::create([

            'action' => 'EXPORTAR EXCEL',

            'description' =>
                'El usuario exportó las ventas en Excel',

            'user' => Auth::user()->name

        ]);

        /*
        |--------------------------------------------------------------------------
        | EXPORTAR
        |--------------------------------------------------------------------------
        */

        return Excel::download(

            new SalesExport,

            'ventas-ferresoft.xlsx'

        );
    }
}