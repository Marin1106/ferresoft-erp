<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = [

        'sale_id',
        'product_id',
        'quantity',
        'price',
        'subtotal'

    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN VENTA
    |--------------------------------------------------------------------------
    */

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}