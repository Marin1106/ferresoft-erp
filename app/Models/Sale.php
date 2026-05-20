<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /*
    |--------------------------------------------------------------------------
    | CAMPOS PERMITIDOS
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'client_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
        'iva',
        'total',
        'payment_method',
        'status'

    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN CLIENTE
    |--------------------------------------------------------------------------
    */

    public function client()
    {
        return $this->belongsTo(Client::class);
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

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN DETALLES DE VENTA
    |--------------------------------------------------------------------------
    */

    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }
}