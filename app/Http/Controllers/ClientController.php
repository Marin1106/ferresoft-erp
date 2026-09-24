<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create', $this->catalogs());
    }

    public function store(Request $request)
    {
        Client::create($this->validateClient($request));

        return redirect()->route('clients.index')
            ->with('success', 'Cliente creado correctamente');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', ['client' => $client] + $this->catalogs());
    }

    public function update(Request $request, Client $client)
    {
        $client->update($this->validateClient($request));

        return redirect()->route('clients.index')
            ->with('success', 'Cliente actualizado');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Cliente eliminado');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDACIÓN (DATOS OBLIGATORIOS FACTURA ELECTRÓNICA DIAN)
    |--------------------------------------------------------------------------
    */

    private function validateClient(Request $request): array
    {
        return $request->validate([

            'name'                 => 'required|string|max:255',
            'identity_document_id' => ['required', Rule::in(array_keys(config('matias.identity_documents')))],
            'dni'                  => 'required|alpha_num|max:20',
            'type_organization_id' => ['required', Rule::in(array_keys(config('matias.organization_types')))],
            'tax_regime_id'        => ['required', Rule::in(array_keys(config('matias.tax_regimes')))],
            'tax_level_id'         => ['required', Rule::in(array_keys(config('matias.tax_levels')))],
            'email'                => 'required|email|max:255',
            'phone'                => 'required|string|max:20',
            'address'              => 'required|string|max:255',
            'city_id'              => ['required', Rule::in(array_column(Client::cities(), 'id'))],
            'postal_code'          => 'nullable|digits:6',

        ], [

            'dni.required'     => 'El número de documento (NIT / cédula) es obligatorio.',
            'dni.alpha_num'    => 'El documento solo debe tener números (NIT sin dígito de verificación).',
            'city_id.required' => 'El municipio es obligatorio para la factura electrónica.',

        ]);
    }

    private function catalogs(): array
    {
        return [
            'identityDocuments' => config('matias.identity_documents'),
            'organizationTypes' => config('matias.organization_types'),
            'taxRegimes'        => config('matias.tax_regimes'),
            'taxLevels'         => config('matias.tax_levels'),
            'cities'            => Client::cities(),
        ];
    }
}
