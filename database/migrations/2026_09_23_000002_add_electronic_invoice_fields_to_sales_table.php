<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | FACTURA ELECTRÓNICA
            |--------------------------------------------------------------------------
            | fe_status: pendiente | aceptada | rechazada | error
            */

            $table->string('fe_status', 20)
                  ->nullable();

            $table->string('fe_prefix', 10)
                  ->nullable();

            $table->unsignedBigInteger('fe_number')
                  ->nullable();

            $table->string('fe_cufe', 120)
                  ->nullable();

            $table->text('fe_message')
                  ->nullable();

            $table->longText('fe_response')
                  ->nullable();

            $table->timestamp('fe_sent_at')
                  ->nullable();

            $table->unique(['fe_prefix', 'fe_number']);

        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {

            $table->dropUnique(['fe_prefix', 'fe_number']);

            $table->dropColumn([
                'fe_status',
                'fe_prefix',
                'fe_number',
                'fe_cufe',
                'fe_message',
                'fe_response',
                'fe_sent_at',
            ]);

        });
    }
};
