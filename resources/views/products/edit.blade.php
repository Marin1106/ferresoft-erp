@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <!-- HEADER -->
        <div class="card-header bg-warning text-dark">

            <h4 class="mb-0 fw-bold">

                ✏️ Editar Producto

            </h4>

        </div>

        <div class="card-body">

            <!-- ERRORES -->
            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <!-- FORM -->
            <form action="{{ route('products.update', $product->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- NOMBRE -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            Nombre

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $product->name) }}"
                            required>

                    </div>

                    <!-- TIPO -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            Tipo

                        </label>

                        <select name="type"
                                class="form-select"
                                required>

                            <option value="herramienta"
                                {{ $product->type == 'herramienta' ? 'selected' : '' }}>

                                Herramienta

                            </option>

                            <option value="construccion"
                                {{ $product->type == 'construccion' ? 'selected' : '' }}>

                                Construcción

                            </option>

                            <option value="electricidad"
                                {{ $product->type == 'electricidad' ? 'selected' : '' }}>

                                Electricidad

                            </option>

                            <option value="plomeria"
                                {{ $product->type == 'plomeria' ? 'selected' : '' }}>

                                Plomería

                            </option>

                        </select>

                    </div>

                    <!-- DESCRIPCIÓN -->
                    <div class="col-12">

                        <label class="form-label fw-semibold">

                            Descripción

                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="4"
                            required>{{ old('description', $product->description) }}</textarea>

                    </div>

                    <!-- STOCK -->
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">

                            Stock

                        </label>

                        <input
                            type="number"
                            name="stock"
                            class="form-control"
                            value="{{ old('stock', $product->stock) }}"
                            required>

                    </div>

                    <!-- STOCK MÍNIMO -->
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">

                            Stock mínimo

                        </label>

                        <input
                            type="number"
                            name="stock_minimo"
                            class="form-control"
                            value="{{ old('stock_minimo', $product->stock_minimo) }}"
                            required>

                    </div>

                    <!-- PRECIO -->
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">

                            Precio

                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="price"
                            class="form-control"
                            value="{{ old('price', $product->price) }}"
                            required>

                    </div>

                </div>

                <!-- BOTONES -->
                <div class="mt-4 d-flex gap-2">

                    <button class="btn btn-warning">

                        💾 Actualizar Producto

                    </button>

                    <a href="{{ route('products.index') }}"
                       class="btn btn-secondary">

                        ↩ Volver

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection