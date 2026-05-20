@extends('layouts.app')

@section('content')

<h1 class="mb-4">Editar Producto</h1>

<form action="{{ route('products.update', $product->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nombre</label>
        <input 
            type="text" 
            name="name" 
            class="form-control"
            value="{{ $product->name }}">
    </div>

    <div class="mb-3">
        <label>Descripción</label>
        <textarea 
            name="description" 
            class="form-control">{{ $product->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Stock</label>
        <input 
            type="number" 
            name="stock" 
            class="form-control"
            value="{{ $product->stock }}">
    </div>

    <div class="mb-3">
        <label>Precio</label>
        <input 
            type="number" 
            step="0.01"
            name="price" 
            class="form-control"
            value="{{ $product->price }}">
    </div>

    <button class="btn btn-warning">
        Actualizar Producto
    </button>

</form>

@endsection