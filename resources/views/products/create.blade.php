@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold">📦 Crear Producto</h1>
            <p class="text-muted mb-0">Registra un nuevo producto en el inventario</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-dark">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    {{-- ERRORES --}}
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm border-0">
            <strong>❌ Se encontraron errores:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="row g-4">

                    {{-- NOMBRE --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Ej: Martillo" required>
                    </div>

                    {{-- TIPO --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tipo de producto</label>
                        <select name="type" class="form-select" required>
                            <option value="herramienta" {{ old('type') == 'herramienta' ? 'selected' : '' }}>Herramienta</option>
                            <option value="construccion" {{ old('type') == 'construccion' ? 'selected' : '' }}>Construcción</option>
                            <option value="electricidad" {{ old('type') == 'electricidad' ? 'selected' : '' }}>Electricidad</option>
                            <option value="plomeria" {{ old('type') == 'plomeria' ? 'selected' : '' }}>Plomería</option>
                        </select>
                    </div>

                    {{-- STOCK --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Stock</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock',0) }}" required>
                    </div>

                    {{-- STOCK MÍNIMO --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Stock mínimo</label>
                        <input type="number" name="stock_minimo" class="form-control" value="{{ old('stock_minimo',5) }}" required>
                    </div>

                    {{-- PRECIO --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Precio</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price',0.00) }}" required>
                    </div>

                    {{-- DESCRIPCIÓN --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Descripción</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Descripción del producto..." required>{{ old('description') }}</textarea>
                    </div>

                </div>

                {{-- BOTONES --}}
                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-success">
                        💾 Guardar Producto
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        ↩ Volver
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection