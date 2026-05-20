<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    /*
    |--------------------------------------------------------------------------
    | TABLA
    |--------------------------------------------------------------------------
    */

    protected $table = 'kardexes';

    /*
    |--------------------------------------------------------------------------
    | CAMPOS PERMITIDOS
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'product_id',
        'type',
        'quantity',
        'stock_before',
        'stock_after',
        'description',
        'user',

    ];

    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'quantity' => 'integer',
        'stock_before' => 'integer',
        'stock_after' => 'integer',

    ];

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