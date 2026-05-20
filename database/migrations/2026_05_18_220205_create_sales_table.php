<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {

    $table->id();

    /*
    |--------------------------------------------------------------------------
    | CLIENTE
    |--------------------------------------------------------------------------
    */

    $table->foreignId('client_id')
          ->constrained()
          ->onDelete('cascade');

    /*
    |--------------------------------------------------------------------------
    | PRODUCTO
    |--------------------------------------------------------------------------
    */

    $table->foreignId('product_id')
          ->constrained()
          ->onDelete('cascade');

    /*
    |--------------------------------------------------------------------------
    | CANTIDAD
    |--------------------------------------------------------------------------
    */

    $table->integer('quantity');

    /*
    |--------------------------------------------------------------------------
    | PRECIO UNITARIO
    |--------------------------------------------------------------------------
    */

    $table->decimal('price', 10, 2);

    /*
    |--------------------------------------------------------------------------
    | TOTAL
    |--------------------------------------------------------------------------
    */

    $table->decimal('total', 10, 2);

    /*
    |--------------------------------------------------------------------------
    | METODO DE PAGO
    |--------------------------------------------------------------------------
    */

    $table->string('payment_method')
          ->default('Efectivo');

    /*
    |--------------------------------------------------------------------------
    | ESTADO
    |--------------------------------------------------------------------------
    */

    $table->string('status')
          ->default('Pagado');

    $table->timestamps();

});
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};