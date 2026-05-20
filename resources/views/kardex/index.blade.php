@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- =========================================
         HEADER
    ========================================== -->

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h1 class="fw-bold text-dark">

                📦 Kardex de Inventario

            </h1>

            <p class="text-muted mb-0">

                Historial completo de movimientos del inventario

            </p>

        </div>

        <div>

            <span class="badge bg-primary p-3 shadow-sm">

                {{ $movements->total() }} Movimientos

            </span>

        </div>

    </div>

    <!-- =========================================
         ALERTAS
    ========================================== -->

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">

            ✅ {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0">

            ❌ {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    <!-- =========================================
         BUSCADOR
    ========================================== -->

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('kardex.index') }}">

                <div class="row g-2">

                    <div class="col-md-10">

                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="🔍 Buscar producto..."
                               value="{{ request('search') }}">

                    </div>

                    <div class="col-md-2">

                        <button type="submit"
                                class="btn btn-primary w-100">

                            <i class="bi bi-search"></i>

                            Buscar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- =========================================
         TABLA KARDEX
    ========================================== -->

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-dark text-white fw-bold">

            📋 Movimientos de Inventario

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>ID</th>
                            <th>Producto</th>
                            <th>Tipo</th>
                            <th>Cantidad</th>
                            <th>Stock Anterior</th>
                            <th>Stock Nuevo</th>
                            <th>Descripción</th>
                            <th>Usuario</th>
                            <th>Fecha</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($movements as $movement)

                        <tr>

                            <!-- ID -->
                            <td>

                                <strong>

                                    #{{ $movement->id }}

                                </strong>

                            </td>

                            <!-- PRODUCTO -->
                            <td>

                                <strong>

                                    {{ $movement->product->name ?? 'Producto eliminado' }}

                                </strong>

                            </td>

                            <!-- TIPO -->
                            <td>

                                @if($movement->type == 'entrada')

                                    <span class="badge bg-success px-3 py-2">

                                        ⬆️ Entrada

                                    </span>

                                @else

                                    <span class="badge bg-danger px-3 py-2">

                                        ⬇️ Salida

                                    </span>

                                @endif

                            </td>

                            <!-- CANTIDAD -->
                            <td>

                                <span class="badge bg-primary px-3 py-2">

                                    {{ $movement->cantidad }}

                                </span>

                            </td>

                            <!-- STOCK ANTERIOR -->
                            <td>

                                {{ $movement->stock_anterior }}

                            </td>

                            <!-- STOCK NUEVO -->
                            <td>

                                <strong class="text-success">

                                    {{ $movement->stock_nuevo }}

                                </strong>

                            </td>

                            <!-- DESCRIPCIÓN -->
                            <td>

                                {{ $movement->description }}

                            </td>

                            <!-- USUARIO -->
                            <td>

                                👤 {{ $movement->user }}

                            </td>

                            <!-- FECHA -->
                            <td>

                                {{ $movement->created_at->format('d/m/Y H:i') }}

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="9"
                                class="text-center py-5 text-muted">

                                🚫 No hay movimientos registrados

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- =========================================
         PAGINACIÓN
    ========================================== -->

    <div class="mt-4 d-flex justify-content-center">

        {{ $movements->links() }}

    </div>

</div>

@endsection