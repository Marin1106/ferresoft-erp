<?php

namespace App\Exports;

use App\Models\Sale;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    /*
    |----------------------------------------------------------------------
    | DATOS
    |----------------------------------------------------------------------
    */

    public function collection()
    {
        return Sale::with([
            'client',
            'product'
        ])->get()->map(function ($sale) {

            return [

                'ID' => $sale->id,

                'Cliente' => $sale->client->name ?? 'N/A',

                'Producto' => $sale->product->name ?? 'N/A',

                'Cantidad' => $sale->quantity,

                'Precio' => $sale->price,

                'Subtotal' => $sale->subtotal,

                'IVA' => $sale->iva,

                'Total' => $sale->total,

                'Método Pago' => $sale->payment_method,

                'Estado' => $sale->status,

                'Fecha' => $sale->created_at,

            ];

        });
    }

    /*
    |----------------------------------------------------------------------
    | HEADERS
    |----------------------------------------------------------------------
    */

    public function headings(): array
    {
        return [

            'ID',
            'Cliente',
            'Producto',
            'Cantidad',
            'Precio',
            'Subtotal',
            'IVA',
            'Total',
            'Método Pago',
            'Estado',
            'Fecha',

        ];
    }
}