<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',

        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Cliente creado correctamente');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([

            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',

        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Cliente actualizado');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Cliente eliminado');
    }
}