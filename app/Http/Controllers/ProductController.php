<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Log;
use App\Models\Kardex;

use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR PRODUCTOS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | CAPTURAR BÚSQUEDA
        |--------------------------------------------------------------------------
        */

        $search = $request->search;

        /*
        |--------------------------------------------------------------------------
        | CONSULTA PRODUCTOS
        |--------------------------------------------------------------------------
        */

        $products = Product::query();

        /*
        |--------------------------------------------------------------------------
        | FILTRAR BÚSQUEDA
        |--------------------------------------------------------------------------
        */

        if ($search) {

            $products->where(function ($query) use ($search) {

                $query->where(
                    'name',
                    'LIKE',
                    "%{$search}%"
                )
                ->orWhere(
                    'description',
                    'LIKE',
                    "%{$search}%"
                );

            });

        }

        /*
        |--------------------------------------------------------------------------
        | PAGINACIÓN
        |--------------------------------------------------------------------------
        */

        $products = $products
            ->latest()
            ->paginate(5);

        /*
        |--------------------------------------------------------------------------
        | RETORNAR VISTA
        |--------------------------------------------------------------------------
        */

        return view('products.index', compact(
            'products',
            'search'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULARIO CREAR
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('products.create');
    }

    /*
    |--------------------------------------------------------------------------
    | GUARDAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDACIONES
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'name' => 'required',

            'description' => 'required',

            'stock' => 'required|integer|min:0',

            'price' => 'required|numeric|min:1',

            'type' => 'required',

            'stock_minimo' => 'required|integer|min:1',

        ]);

        /*
        |--------------------------------------------------------------------------
        | CREAR PRODUCTO
        |--------------------------------------------------------------------------
        */

        $product = Product::create([

            'name' => $request->name,

            'description' => $request->description,

            'stock' => $request->stock,

            'price' => $request->price,

            'type' => $request->type,

            'stock_minimo' => $request->stock_minimo,

        ]);

        /*
        |--------------------------------------------------------------------------
        | REGISTRAR ENTRADA INICIAL KARDEX
        |--------------------------------------------------------------------------
        */

        if ($product->stock > 0) {

            Kardex::create([

                'product_id' => $product->id,

                'type' => 'entrada',

                'quantity' => $product->stock,

                'stock_before' => 0,

                'stock_after' => $product->stock,

                'description' =>
                    'Stock inicial del producto',

                'user' => Auth::user()->name,

            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | LOG CREAR PRODUCTO
        |--------------------------------------------------------------------------
        */

        Log::create([

            'action' => 'CREAR PRODUCTO',

            'description' =>
                'Se creó el producto: ' . $product->name,

            'user' => Auth::user()->name

        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECCIONAR
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Producto creado correctamente'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULARIO EDITAR
    |--------------------------------------------------------------------------
    */

    public function edit(Product $product)
    {
        return view(
            'products.edit',
            compact('product')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Product $product
    ) {

        /*
        |--------------------------------------------------------------------------
        | VALIDACIONES
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'name' => 'required',

            'description' => 'required',

            'stock' => 'required|integer|min:0',

            'price' => 'required|numeric|min:1',

            'type' => 'required',

            'stock_minimo' => 'required|integer|min:1',

        ]);

        /*
        |--------------------------------------------------------------------------
        | STOCK ANTERIOR
        |--------------------------------------------------------------------------
        */

        $stockAnterior = $product->stock;

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR PRODUCTO
        |--------------------------------------------------------------------------
        */

        $product->update([

            'name' => $request->name,

            'description' => $request->description,

            'stock' => $request->stock,

            'price' => $request->price,

            'type' => $request->type,

            'stock_minimo' => $request->stock_minimo,

        ]);

        /*
        |--------------------------------------------------------------------------
        | REGISTRAR ENTRADA
        |--------------------------------------------------------------------------
        */

        if ($product->stock > $stockAnterior) {

            $cantidadIngresada =
                $product->stock - $stockAnterior;

            Kardex::create([

                'product_id' => $product->id,

                'type' => 'entrada',

                'quantity' => $cantidadIngresada,

                'stock_before' => $stockAnterior,

                'stock_after' => $product->stock,

                'description' =>
                    'Ingreso manual de inventario',

                'user' => Auth::user()->name,

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | REGISTRAR SALIDA
        |--------------------------------------------------------------------------
        */

        if ($product->stock < $stockAnterior) {

            $cantidadSalida =
                $stockAnterior - $product->stock;

            Kardex::create([

                'product_id' => $product->id,

                'type' => 'salida',

                'quantity' => $cantidadSalida,

                'stock_before' => $stockAnterior,

                'stock_after' => $product->stock,

                'description' =>
                    'Descuento manual de inventario',

                'user' => Auth::user()->name,

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | LOG EDITAR PRODUCTO
        |--------------------------------------------------------------------------
        */

        Log::create([

            'action' => 'EDITAR PRODUCTO',

            'description' =>
                'Se editó el producto: ' . $product->name,

            'user' => Auth::user()->name

        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECCIONAR
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Producto actualizado correctamente'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function destroy(Product $product)
    {
        /*
        |--------------------------------------------------------------------------
        | LOG ELIMINAR PRODUCTO
        |--------------------------------------------------------------------------
        */

        Log::create([

            'action' => 'ELIMINAR PRODUCTO',

            'description' =>
                'Se eliminó el producto: ' . $product->name,

            'user' => Auth::user()->name

        ]);

        /*
        |--------------------------------------------------------------------------
        | ELIMINAR PRODUCTO
        |--------------------------------------------------------------------------
        */

        $product->delete();

        /*
        |--------------------------------------------------------------------------
        | REDIRECCIONAR
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Producto eliminado correctamente'
            );
    }
}