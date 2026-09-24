<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | INFORMACIÓN DEL PRODUCTO
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            $table->text('description');

            /*
            |--------------------------------------------------------------------------
            | INVENTARIO
            |--------------------------------------------------------------------------
            */

            $table->integer('stock')
                  ->default(0);

            $table->integer('stock_minimo')
                  ->default(5);

            /*
            |--------------------------------------------------------------------------
            | PRECIO
            |--------------------------------------------------------------------------
            */

            $table->decimal('price', 10, 2);

            /*
            |--------------------------------------------------------------------------
            | TIPO PRODUCTO
            |--------------------------------------------------------------------------
            */

            $table->enum('type', [

                'herramienta',
                'construccion',
                'electricidad',
                'plomeria'

            ])->default('herramienta');

            /*
            |--------------------------------------------------------------------------
            | ESTADO
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [

                'Activo',
                'Inactivo'

            ])->default('Activo');

            /*
            |--------------------------------------------------------------------------
            | IMAGEN
            |--------------------------------------------------------------------------
            */

            $table->string('image')
                  ->nullable();

            /*
            |--------------------------------------------------------------------------
            | CATEGORÍA
            |--------------------------------------------------------------------------
            */

            $table->string('category')
                  ->nullable();

            /*
            |--------------------------------------------------------------------------
            | TIMESTAMPS
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};