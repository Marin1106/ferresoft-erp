<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Log;

use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REPORTES PRINCIPALES
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | GUARDAR LOG
        |--------------------------------------------------------------------------
        */

        Log::create([

            'action' => 'VER REPORTES',

            'description' =>
                'El usuario ingresó al módulo de reportes',

            'user' => Auth::user()->name

        ]);

        /*
        |--------------------------------------------------------------------------
        | FILTROS FECHA
        |--------------------------------------------------------------------------
        */

        $from = $request->from;

        $to = $request->to;

        /*
        |--------------------------------------------------------------------------
        | CONSULTA VENTAS
        |--------------------------------------------------------------------------
        */

        $sales = Sale::with([
                'client',
                'product'
            ])
            ->when($from, function ($query) use ($from) {

                $query->whereDate(
                    'created_at',
                    '>=',
                    $from
                );

            })
            ->when($to, function ($query) use ($to) {

                $query->whereDate(
                    'created_at',
                    '<=',
                    $to
                );

            })
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | VENTAS TOTALES
        |--------------------------------------------------------------------------
        */

        $ventasTotales = $sales->sum('total');

        /*
        |--------------------------------------------------------------------------
        | CANTIDAD VENTAS
        |--------------------------------------------------------------------------
        */

        $cantidadVentas = $sales->count();

        /*
        |--------------------------------------------------------------------------
        | VENTAS HOY
        |--------------------------------------------------------------------------
        */

        $ventasHoy = Sale::whereDate(
            'created_at',
            today()
        )->sum('total');

        /*
        |--------------------------------------------------------------------------
        | VENTAS MES
        |--------------------------------------------------------------------------
        */

        $ventasMes = Sale::whereMonth(
                'created_at',
                now()->month
            )
            ->sum('total');

        /*
        |--------------------------------------------------------------------------
        | TOTAL PRODUCTOS
        |--------------------------------------------------------------------------
        */

        $totalProductos = Product::count();

        /*
        |--------------------------------------------------------------------------
        | STOCK TOTAL
        |--------------------------------------------------------------------------
        */

        $stockTotal = Product::sum('stock');

        /*
        |--------------------------------------------------------------------------
        | VALOR INVENTARIO
        |--------------------------------------------------------------------------
        */

        $valorInventario = Product::selectRaw(
            'SUM(stock * price) as total'
        )->value('total');

        /*
        |--------------------------------------------------------------------------
        | PRODUCTOS MÁS VENDIDOS
        |--------------------------------------------------------------------------
        */

        $productosVendidos = Sale::with('product')
            ->selectRaw(
                'product_id, SUM(quantity) as total_vendido'
            )
            ->groupBy('product_id')
            ->orderByDesc('total_vendido')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | PRODUCTOS STOCK BAJO
        |--------------------------------------------------------------------------
        */

        $productosBajos = Product::whereColumn(
                'stock',
                '<=',
                'stock_minimo'
            )
            ->orderBy('stock')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | ÚLTIMAS VENTAS
        |--------------------------------------------------------------------------
        */

        $ultimasVentas = $sales->take(10);

        /*
        |--------------------------------------------------------------------------
        | RETORNAR VISTA
        |--------------------------------------------------------------------------
        */

        return view(
            'reports.index',
            compact(

                'sales',
                'from',
                'to',

                'ventasTotales',
                'cantidadVentas',
                'ventasHoy',
                'ventasMes',

                'totalProductos',
                'stockTotal',
                'valorInventario',

                'productosVendidos',
                'productosBajos',
                'ultimasVentas'

            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORTAR PDF
    |--------------------------------------------------------------------------
    */

    public function exportPdf()
    {
        /*
        |--------------------------------------------------------------------------
        | GUARDAR LOG
        |--------------------------------------------------------------------------
        */

        Log::create([

            'action' => 'EXPORTAR PDF',

            'description' =>
                'El usuario exportó el reporte PDF',

            'user' => Auth::user()->name

        ]);

        /*
        |--------------------------------------------------------------------------
        | DATOS REPORTE
        |--------------------------------------------------------------------------
        */

        $ventasTotales = Sale::sum('total');

        $cantidadVentas = Sale::count();

        $ventasHoy = Sale::whereDate(
            'created_at',
            today()
        )->sum('total');

        $ventasMes = Sale::whereMonth(
                'created_at',
                now()->month
            )
            ->sum('total');

        $totalProductos = Product::count();

        $stockTotal = Product::sum('stock');

        $valorInventario = Product::selectRaw(
            'SUM(stock * price) as total'
        )->value('total');

        $productosVendidos = Sale::with('product')
            ->selectRaw(
                'product_id, SUM(quantity) as total_vendido'
            )
            ->groupBy('product_id')
            ->orderByDesc('total_vendido')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | GENERAR PDF
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView(

            'reports.pdf',

            compact(

                'ventasTotales',
                'cantidadVentas',
                'ventasHoy',
                'ventasMes',

                'totalProductos',
                'stockTotal',
                'valorInventario',

                'productosVendidos'

            )

        );

        /*
        |--------------------------------------------------------------------------
        | DESCARGAR PDF
        |--------------------------------------------------------------------------
        */

        return $pdf->download(

            'reporte-ferresoft.pdf'

        );
    }
}