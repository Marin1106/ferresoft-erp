@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="fw-bold">📦 Crear Producto</h1>
        <p class="text-muted mb-0">Registra un nuevo producto en el inventario</p>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-dark">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

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
            <div class="row">

                <!-- NOMBRE -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Ej: Martillo">
                </div>

                <!-- STOCK -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Stock</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" placeholder="0">
                </div>

                <!-- PRECIO -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Precio</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" placeholder="0.00">
                </div>

                <!-- TIPO PRODUCTO -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tipo de producto</label>
                    <select name="type" class="form-select">
                        <option value="materia_prima">Materia Prima</option>
                        <option value="producto_terminado">Producto Terminado</option>
                    </select>
                </div>

                <!-- STOCK MÍNIMO -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Stock mínimo</label>
                    <input type="number" name="stock_minimo" class="form-control" value="{{ old('stock_minimo',5) }}">
                </div>

                <!-- DESCRIPCIÓN -->
                <div class="col-12 mb-4">
                    <label class="form-label fw-semibold">Descripción</label>
                    <textarea name="description" rows="4" class="form-control" placeholder="Descripción del producto...">{{ old('description') }}</textarea>
                </div>

            </div>

            <!-- BOTONES -->
            <div class="d-flex gap-2">
                <button class="btn btn-success px-4">
                    <i class="bi bi-check-circle"></i> Guardar Producto
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection