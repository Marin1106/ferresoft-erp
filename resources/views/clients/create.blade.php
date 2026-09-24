@extends('layouts.app')

@section('content')

<h1 class="mb-4">Crear Cliente</h1>

<form action="{{ route('clients.store') }}"
      method="POST">

    @csrf

    @include('clients._form')

    <button class="btn btn-success">

        Guardar Cliente

    </button>

</form>

@endsection
