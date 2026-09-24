<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [

        'name',
        'identity_document_id',
        'dni',
        'type_organization_id',
        'tax_regime_id',
        'tax_level_id',
        'email',
        'phone',
        'address',
        'city_id',
        'postal_code'

    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /*
    |--------------------------------------------------------------------------
    | MUNICIPIOS (CATÁLOGO MATIAS)
    |--------------------------------------------------------------------------
    */

    public static function cities(): array
    {
        static $cities = null;

        if ($cities === null) {

            $cities = json_decode(
                file_get_contents(config('matias.cities_file')),
                true
            ) ?: [];

        }

        return $cities;
    }

    public function getCityNameAttribute()
    {
        foreach (self::cities() as $city) {

            if ($city['id'] == $this->city_id) {

                return $city['name'] . ' (' . $city['department'] . ')';

            }

        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | DÍGITO DE VERIFICACIÓN NIT (DIAN)
    |--------------------------------------------------------------------------
    */

    public function getDvAttribute()
    {
        if ($this->identity_document_id != 3 || ! $this->dni) {

            return null;

        }

        $weights = [3, 7, 13, 17, 19, 23, 29, 37, 41, 43, 47, 53, 59, 67, 71];

        $digits = array_reverse(str_split(preg_replace('/\D/', '', $this->dni)));

        $sum = 0;

        foreach ($digits as $i => $digit) {

            $sum += $digit * ($weights[$i] ?? 0);

        }

        $mod = $sum % 11;

        return $mod > 1 ? 11 - $mod : $mod;
    }

    /*
    |--------------------------------------------------------------------------
    | DATOS FALTANTES PARA FACTURA ELECTRÓNICA
    |--------------------------------------------------------------------------
    */

    public function missingElectronicInvoiceFields(): array
    {
        $required = [
            'dni'                  => 'número de documento',
            'identity_document_id' => 'tipo de documento',
            'type_organization_id' => 'tipo de persona',
            'tax_regime_id'        => 'régimen de IVA',
            'tax_level_id'         => 'responsabilidad fiscal',
            'email'                => 'correo electrónico',
            'address'              => 'dirección',
            'city_id'              => 'municipio',
        ];

        return array_values(array_filter(
            $required,
            fn ($label, $field) => blank($this->{$field}),
            ARRAY_FILTER_USE_BOTH
        ));
    }
}
