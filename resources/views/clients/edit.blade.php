@extends('layouts.app')

@section('content')

<h1 class="mb-4">Editar Cliente</h1>

<form action="{{ route('clients.update', $client->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Nombre</label>

        <input type="text"
               name="name"
               class="form-control"
               value="{{ $client->name }}">

    </div>

    <div class="mb-3">

        <label>Email</label>

        <input type="email"
               name="email"
               class="form-control"
               value="{{ $client->email }}">

    </div>

    <div class="mb-3">

        <label>Teléfono</label>

        <input type="text"
               name="phone"
               class="form-control"
               value="{{ $client->phone }}">

    </div>

    <div class="mb-3">

        <label>Dirección</label>

        <input type="text"
               name="address"
               class="form-control"
               value="{{ $client->address }}">

    </div>

    <button class="btn btn-warning">

        Actualizar Cliente

    </button>

</form>

@endsection