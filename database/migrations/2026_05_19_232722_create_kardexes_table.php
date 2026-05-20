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
        Schema::create('kardexes', function (Blueprint $table) {

            $table->id();

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
            | TIPO MOVIMIENTO
            |--------------------------------------------------------------------------
            */

            $table->enum('type', [

                'entrada',
                'salida'

            ]);

            /*
            |--------------------------------------------------------------------------
            | CANTIDAD
            |--------------------------------------------------------------------------
            */

            $table->integer('quantity');

            /*
            |--------------------------------------------------------------------------
            | STOCK ANTERIOR
            |--------------------------------------------------------------------------
            */

            $table->integer('stock_before');

            /*
            |--------------------------------------------------------------------------
            | STOCK NUEVO
            |--------------------------------------------------------------------------
            */

            $table->integer('stock_after');

            /*
            |--------------------------------------------------------------------------
            | DESCRIPCIÓN
            |--------------------------------------------------------------------------
            */

            $table->text('description')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | USUARIO
            |--------------------------------------------------------------------------
            */

            $table->string('user');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('kardexes');
    }
};