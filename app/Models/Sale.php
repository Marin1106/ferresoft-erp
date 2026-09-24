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
        'status',
        'fe_status',
        'fe_prefix',
        'fe_number',
        'fe_cufe',
        'fe_message',
        'fe_response',
        'fe_sent_at'

    ];

    protected $casts = [

        'fe_sent_at' => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | NÚMERO FACTURA ELECTRÓNICA (PREFIJO + CONSECUTIVO)
    |--------------------------------------------------------------------------
    */

    public function getFeFullNumberAttribute()
    {
        return $this->fe_number
            ? $this->fe_prefix . $this->fe_number
            : null;
    }

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