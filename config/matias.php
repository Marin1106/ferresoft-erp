<?php

/*
|--------------------------------------------------------------------------
| FACTURACIÓN ELECTRÓNICA - MATIAS API (DIAN UBL 2.1)
|--------------------------------------------------------------------------
|
| Los IDs de los catálogos son los IDs internos de MATIAS API, no los
| códigos DIAN. Fueron tomados de los endpoints públicos:
| /identity-documents, /organization-type, /accounting-regime,
| /fiscal-regime, /payment-means, /document-type, /quantity-units.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | ACTIVAR / DESACTIVAR ENVÍO
    |--------------------------------------------------------------------------
    */

    'enabled' => (bool) env('MATIAS_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | CONEXIÓN
    |--------------------------------------------------------------------------
    |
    | Sandbox:    https://sandbox-api.matias-api.com/api/ubl2.1
    | Producción: la URL entregada por MATIAS al contratar.
    |
    | Autenticación: se recomienda MATIAS_TOKEN (Personal Access Token).
    | Si no existe, se hace login con MATIAS_EMAIL / MATIAS_PASSWORD
    | y el token queda en caché.
    |
    */

    'url' => rtrim(env('MATIAS_URL', 'https://sandbox-api.matias-api.com/api/ubl2.1'), '/'),

    'token' => env('MATIAS_TOKEN'),

    'email' => env('MATIAS_EMAIL'),

    'password' => env('MATIAS_PASSWORD'),

    'timeout' => (int) env('MATIAS_TIMEOUT', 60),

    /*
    |--------------------------------------------------------------------------
    | RESOLUCIÓN DE FACTURACIÓN DIAN
    |--------------------------------------------------------------------------
    */

    'resolution_number' => env('MATIAS_RESOLUTION_NUMBER'),

    'prefix' => env('MATIAS_PREFIX', ''),

    'number_from' => (int) env('MATIAS_NUMBER_FROM', 1),

    'number_to' => (int) env('MATIAS_NUMBER_TO', 0),

    /*
    |--------------------------------------------------------------------------
    | DOCUMENTO
    |--------------------------------------------------------------------------
    */

    'type_document_id' => 7,   // Factura electrónica de venta (código DIAN 01)

    'operation_type_id' => 1,  // Estándar

    'send_email' => (int) env('MATIAS_SEND_EMAIL', 1),

    'graphic_representation' => (int) env('MATIAS_GRAPHIC_REPRESENTATION', 1),

    'iva_percent' => (float) env('MATIAS_IVA_PERCENT', 19),

    'credit_days' => (int) env('MATIAS_CREDIT_DAYS', 30),

    'quantity_units_id' => 70,            // Unidad (código DIAN 94)

    'type_item_identifications_id' => 4,  // Estándar de adopción del contribuyente

    'reference_price_id' => 1,

    'country_id' => 45,                   // Colombia

    /*
    |--------------------------------------------------------------------------
    | CATÁLOGOS (formularios de clientes)
    |--------------------------------------------------------------------------
    */

    'identity_documents' => [
        1  => 'Cédula de ciudadanía (CC)',
        3  => 'NIT',
        2  => 'Cédula de extranjería (CE)',
        8  => 'Tarjeta de extranjería (TE)',
        7  => 'Tarjeta de identidad (TI)',
        9  => 'Pasaporte (PA)',
        10 => 'Documento de identificación extranjero (DE)',
        11 => 'NIT de otro país',
        13 => 'PPT (Permiso Protección Temporal)',
        14 => 'PEP (Permiso Especial de Permanencia)',
    ],

    'organization_types' => [
        2 => 'Persona natural',
        1 => 'Persona jurídica',
    ],

    'tax_regimes' => [
        2 => 'No responsable de IVA',
        1 => 'Responsable de IVA',
    ],

    'tax_levels' => [
        5 => 'R-99-PN - No aplica (Otros)',
        1 => 'O-13 - Gran contribuyente',
        2 => 'O-15 - Autorretenedor',
        3 => 'O-23 - Agente de retención IVA',
        4 => 'O-47 - Régimen simple de tributación',
    ],

    /*
    |--------------------------------------------------------------------------
    | MÉTODO DE PAGO DE LA VENTA => MEDIO DE PAGO MATIAS
    |--------------------------------------------------------------------------
    */

    'means_payment' => [
        'Efectivo'      => 10,  // Efectivo
        'Tarjeta'       => 48,  // Tarjeta crédito
        'Transferencia' => 31,  // Transferencia débito
    ],

    'default_means_payment' => 10,

    /*
    |--------------------------------------------------------------------------
    | MUNICIPIOS (id MATIAS + código DANE)
    |--------------------------------------------------------------------------
    */

    'cities_file' => database_path('data/matias_cities.json'),

];
