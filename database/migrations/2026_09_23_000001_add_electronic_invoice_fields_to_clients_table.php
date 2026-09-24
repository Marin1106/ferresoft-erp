<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | DATOS FISCALES (FACTURACIÓN ELECTRÓNICA)
            |--------------------------------------------------------------------------
            */

            $table->unsignedSmallInteger('identity_document_id')
                  ->default(1)
                  ->after('name');

            $table->string('dni', 20)
                  ->nullable()
                  ->after('identity_document_id');

            $table->unsignedTinyInteger('type_organization_id')
                  ->default(2)
                  ->after('dni');

            $table->unsignedTinyInteger('tax_regime_id')
                  ->default(2)
                  ->after('type_organization_id');

            $table->unsignedTinyInteger('tax_level_id')
                  ->default(5)
                  ->after('tax_regime_id');

            $table->unsignedSmallInteger('city_id')
                  ->nullable()
                  ->after('address');

            $table->string('postal_code', 10)
                  ->nullable()
                  ->after('city_id');

        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {

            $table->dropColumn([
                'identity_document_id',
                'dni',
                'type_organization_id',
                'tax_regime_id',
                'tax_level_id',
                'city_id',
                'postal_code',
            ]);

        });
    }
};
