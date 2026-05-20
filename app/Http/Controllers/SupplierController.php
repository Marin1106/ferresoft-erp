<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $suppliers = Supplier::latest()->paginate(10);

        return view(
            'suppliers.index',
            compact('suppliers')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('suppliers.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'address' => 'nullable',

        ]);

        Supplier::create($request->all());

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                'Proveedor creado correctamente'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
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
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Supplier $supplier
    ) {

        $request->validate([

            'name' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'address' => 'nullable',

        ]);

        $supplier->update($request->all());

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                'Proveedor actualizado'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return back()->with(
            'success',
            'Proveedor eliminado'
        );
    }
}