@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

    <div>

        <h1 class="fw-bold mb-1">

            📦 Gestión de Productos

        </h1>

        <p class="text-muted mb-0">

            Administra el inventario del sistema

        </p>

    </div>

    <a href="{{ route('products.create') }}"
       class="btn btn-primary shadow-sm rounded-3">

        <i class="bi bi-plus-circle"></i>

        Nuevo Producto

    </a>

</div>

<!-- ALERTAS -->
@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show shadow-sm">

        ✅ {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>

    </div>

@endif

@if(session('error'))

    <div class="alert alert-danger alert-dismissible fade show shadow-sm">

        ❌ {{ session('error') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>

    </div>

@endif

<!-- BUSCADOR -->
<div class="card shadow-sm border-0 mb-4">

    <div class="card-body">

        <form method="GET"
              action="{{ route('products.index') }}">

            <div class="row g-2">

                <div class="col-md-10">

                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Buscar producto..."
                           value="{{ $search }}">

                </div>

                <div class="col-md-2 d-grid">

                    <button class="btn btn-dark">

                        <i class="bi bi-search"></i>

                        Buscar

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<!-- TABLA -->
<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>#</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th>Stock</th>
                        <th>Stock Mínimo</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)

                        <tr>

                            <!-- ID -->
                            <td>

                                {{ $product->id }}

                            </td>

                            <!-- NOMBRE -->
                            <td>

                                <div class="fw-bold">

                                    {{ $product->name }}

                                </div>

                            </td>

                            <!-- DESCRIPCIÓN -->
                            <td>

                                {{ $product->description }}

                            </td>

                            <!-- TIPO -->
                            <td>

                                @if($product->type === 'materia_prima')

                                    <span class="badge bg-dark">

                                        🏭 Materia Prima

                                    </span>

                                @else

                                    <span class="badge bg-primary">

                                        📦 Producto Terminado

                                    </span>

                                @endif

                            </td>

                            <!-- STOCK -->
                            <td>

                                <strong>

                                    {{ $product->stock }}

                                </strong>

                            </td>

                            <!-- STOCK MINIMO -->
                            <td>

                                <span class="badge bg-secondary">

                                    {{ $product->stock_minimo }}

                                </span>

                            </td>

                            <!-- PRECIO -->
                            <td>

                                <strong>

                                    ${{ number_format($product->price, 2) }}

                                </strong>

                            </td>

                            <!-- ESTADO -->
                            <td>

                                @if($product->stock <= $product->stock_minimo)

                                    <span class="badge bg-danger">

                                        🔴 Stock Bajo

                                    </span>

                                @elseif($product->stock <= 10)

                                    <span class="badge bg-warning text-dark">

                                        🟡 Stock Medio

                                    </span>

                                @else

                                    <span class="badge bg-success">

                                        🟢 Disponible

                                    </span>

                                @endif

                            </td>

                            <!-- ACCIONES -->
                            <td>

                                <div class="d-flex justify-content-center gap-2">

                                    <!-- EDITAR -->
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="btn btn-warning btn-sm shadow-sm">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                    <!-- ELIMINAR -->
                                    <form action="{{ route('products.destroy', $product) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm shadow-sm"
                                                onclick="return confirm('¿Deseas eliminar este producto?')">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9"
                                class="text-center py-4 text-muted">

                                No hay productos registrados

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- PAGINACIÓN -->
<div class="mt-4 d-flex justify-content-center">

    {{ $products->links() }}

</div>

@endsection