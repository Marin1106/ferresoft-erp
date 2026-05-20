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
        Schema::create('inventory_movements', function (Blueprint $table) {

            $table->id();

            /*
            |------------------------------------------------------------------
            | RELACIÓN PRODUCTO
            |------------------------------------------------------------------
            */

            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade');

            /*
            |------------------------------------------------------------------
            | MOVIMIENTO
            |------------------------------------------------------------------
            */

            $table->enum('type', [
                'entrada',
                'salida'
            ]);

            $table->integer('quantity');

            $table->integer('stock_before');

            $table->integer('stock_after');

            /*
            |------------------------------------------------------------------
            | USUARIO
            |------------------------------------------------------------------
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
        Schema::dropIfExists('inventory_movements');
    }
};