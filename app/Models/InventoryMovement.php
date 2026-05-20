<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    protected $fillable = [

        'product_id',
        'type',
        'quantity',
        'stock_before',
        'stock_after',
        'user',

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