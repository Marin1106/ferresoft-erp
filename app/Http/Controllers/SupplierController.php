<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR PROVEEDORES
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $suppliers = Supplier::latest()
            ->paginate(10);

        return view(
            'suppliers.index',
            compact('suppliers')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULARIO CREAR
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('suppliers.create');
    }

    /*
    |--------------------------------------------------------------------------
    | GUARDAR PROVEEDOR
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

            'name' => 'required|string|max:255',

            'phone' => 'nullable|string|max:255',

            'email' => 'nullable|email|max:255',

            'address' => 'nullable|string',

        ]);

        /*
        |--------------------------------------------------------------------------
        | CREAR PROVEEDOR
        |--------------------------------------------------------------------------
        */

        Supplier::create([

            'name' => $request->name,

            'phone' => $request->phone,

            'email' => $request->email,

            'address' => $request->address,

        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECCIONAR
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                'Proveedor creado correctamente'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULARIO EDITAR
    |--------------------------------------------------------------------------
    */

    public function edit(Supplier $supplier)
    {
        return view(
            'suppliers.edit',
            compact('supplier')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR PROVEEDOR
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Supplier $supplier
    ) {

        /*
        |--------------------------------------------------------------------------
        | VALIDACIONES
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'name' => 'required|string|max:255',

            'phone' => 'nullable|string|max:255',

            'email' => 'nullable|email|max:255',

            'address' => 'nullable|string',

        ]);

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR
        |--------------------------------------------------------------------------
        */

        $supplier->update([

            'name' => $request->name,

            'phone' => $request->phone,

            'email' => $request->email,

            'address' => $request->address,

        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECCIONAR
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                'Proveedor actualizado correctamente'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR PROVEEDOR
    |--------------------------------------------------------------------------
    */

    public function destroy(Supplier $supplier)
    {
        /*
        |--------------------------------------------------------------------------
        | ELIMINAR
        |--------------------------------------------------------------------------
        */

        $supplier->delete();

        /*
        |--------------------------------------------------------------------------
        | REDIRECCIONAR
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                'Proveedor eliminado correctamente'
            );
    }
}