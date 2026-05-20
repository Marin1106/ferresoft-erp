@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-4">

    <h1>Clientes</h1>

    <a href="{{ route('clients.create') }}"
       class="btn btn-primary">

        Nuevo Cliente

    </a>

</div>

@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif

<table class="table table-bordered table-hover bg-white shadow">

    <thead class="table-dark">

        <tr>

            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Acciones</th>

        </tr>

    </thead>

    <tbody>

        @foreach($clients as $client)

        <tr>

            <td>{{ $client->id }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->address }}</td>

            <td>

                <a href="{{ route('clients.edit', $client->id) }}"
                   class="btn btn-warning btn-sm">

                    Editar

                </a>

                <form action="{{ route('clients.destroy', $client->id) }}"
                      method="POST"
                      style="display:inline-block;">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm">

                        Eliminar

                    </button>

                </form>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection