@extends('layouts.app')

@section('content')

<h1 class="mb-4">Crear Cliente</h1>

<form action="{{ route('clients.store') }}"
      method="POST">

    @csrf

    <div class="mb-3">

        <label>Nombre</label>

        <input type="text"
               name="name"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Email</label>

        <input type="email"
               name="email"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Teléfono</label>

        <input type="text"
               name="phone"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Dirección</label>

        <input type="text"
               name="address"
               class="form-control">

    </div>

    <button class="btn btn-success">

        Guardar Cliente

    </button>

</form>

@endsection