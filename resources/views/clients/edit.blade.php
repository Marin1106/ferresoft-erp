@extends('layouts.app')

@section('content')

<h1 class="mb-4">Editar Cliente</h1>

<form action="{{ route('clients.update', $client->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    @include('clients._form')

    <button class="btn btn-warning">

        Actualizar Cliente

    </button>

</form>

@endsection
