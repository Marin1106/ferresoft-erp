<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kardex;

class KardexController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR MOVIMIENTOS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | BUSCADOR
        |--------------------------------------------------------------------------
        */

        $search = $request->search;

        /*
        |--------------------------------------------------------------------------
        | CONSULTA KARDEX
        |--------------------------------------------------------------------------
        */

        $movements = Kardex::with('product')

            ->when($search, function ($query) use ($search) {

                $query->whereHas('product', function ($q) use ($search) {

                    $q->where(
                        'name',
                        'LIKE',
                        "%{$search}%"
                    );

                });

            })

            ->latest()

            ->paginate(15);

        /*
        |--------------------------------------------------------------------------
        | RETORNAR VISTA
        |--------------------------------------------------------------------------
        */

        return view(
            'kardex.index',
            compact(
                'movements',
                'search'
            )
        );
    }
}