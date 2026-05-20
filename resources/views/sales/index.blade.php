@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

        <div>

            <h1 class="fw-bold">

                💰 Gestión de Ventas

            </h1>

            <p class="text-muted mb-0">

                Administración general de ventas

            </p>

        </div>

        <div class="d-flex gap-2 flex-wrap">

            <!-- EXPORTAR -->
            <a href="{{ route('sales.export') }}"
               class="btn btn-success shadow-sm">

                <i class="bi bi-file-earmark-excel"></i>

                Excel

            </a>

            <!-- NUEVA VENTA -->
            <a href="{{ route('sales.create') }}"
               class="btn btn-primary shadow-sm">

                <i class="bi bi-plus-circle"></i>

                Nueva Venta

            </a>

        </div>

    </div>

    <!-- BUSCADOR -->
    <form method="GET"
          action="{{ route('sales.index') }}"
          class="mb-4">

        <div class="input-group shadow-sm">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Buscar cliente o producto..."
                   value="{{ $search }}">

            <button class="btn btn-primary">

                <i class="bi bi-search"></i>

                Buscar

            </button>

        </div>

    </form>

    <!-- ALERTAS -->
    @if(session('success'))

        <div class="alert alert-success shadow-sm border-0">

            ✅ {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger shadow-sm border-0">

            ❌ {{ session('error') }}

        </div>

    @endif

    <!-- CARDS -->
    <div class="row g-4 mb-4">

        <!-- TOTAL -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">

                        💰 Total Ventas

                    </small>

                    <h2 class="fw-bold text-success">

                        ${{ number_format($sales->sum('total'), 2) }}

                    </h2>

                </div>

            </div>

        </div>

        <!-- CANTIDAD -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">

                        📊 Cantidad Ventas

                    </small>

                    <h2 class="fw-bold">

                        {{ $sales->count() }}

                    </h2>

                </div>

            </div>

        </div>

        <!-- HOY -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">

                        📅 Ventas Hoy

                    </small>

                    <h2 class="fw-bold text-primary">

                        {{ $sales->where('created_at', '>=', now()->startOfDay())->count() }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLA -->
    <div class="card border-0 shadow-lg">

        <div class="card-header bg-dark text-white">

            📋 Lista de Ventas

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Pago</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($sales as $sale)

                            <tr>

                                <!-- ID -->
                                <td>

                                    <strong>

                                        #{{ $sale->id }}

                                    </strong>

                                </td>

                                <!-- CLIENTE -->
                                <td>

                                    👤 {{ $sale->client->name ?? 'N/A' }}

                                </td>

                                <!-- PRODUCTO -->
                                <td>

                                    📦 {{ $sale->product->name ?? 'N/A' }}

                                </td>

                                <!-- CANTIDAD -->
                                <td>

                                    <span class="badge bg-info">

                                        {{ $sale->quantity }}

                                    </span>

                                </td>

                                <!-- TOTAL -->
                                <td>

                                    <strong class="text-success">

                                        ${{ number_format($sale->total, 2) }}

                                    </strong>

                                </td>

                                <!-- MÉTODO -->
                                <td>

                                    @if($sale->payment_method == 'Efectivo')

                                        <span class="badge bg-success">

                                            💵 Efectivo

                                        </span>

                                    @elseif($sale->payment_method == 'Tarjeta')

                                        <span class="badge bg-primary">

                                            💳 Tarjeta

                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">

                                            🏦 Transferencia

                                        </span>

                                    @endif

                                </td>

                                <!-- ESTADO -->
                                <td>

                                    @if($sale->status == 'Completada')

                                        <span class="badge bg-success">

                                            ✅ Completada

                                        </span>

                                    @elseif($sale->status == 'Pendiente')

                                        <span class="badge bg-warning text-dark">

                                            ⏳ Pendiente

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            ❌ Cancelada

                                        </span>

                                    @endif

                                </td>

                                <!-- FECHA -->
                                <td>

                                    {{ $sale->created_at->format('d/m/Y') }}

                                </td>

                                <!-- ACCIONES -->
                                <td>

                                    <div class="d-flex gap-2">

                                        <!-- VER -->
                                        <a href="{{ route('sales.show', $sale) }}"
                                           class="btn btn-info btn-sm shadow-sm">

                                            <i class="bi bi-eye"></i>

                                        </a>

                                        <!-- PDF -->
                                        <a href="{{ route('sales.invoice', $sale) }}"
                                           class="btn btn-dark btn-sm shadow-sm">

                                            <i class="bi bi-file-earmark-pdf"></i>

                                        </a>

                                        <!-- ELIMINAR -->
                                        <form action="{{ route('sales.destroy', $sale) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm shadow-sm"
                                                    onclick="return confirm('¿Eliminar venta?')">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9"
                                    class="text-center text-muted py-4">

                                    🚫 No hay ventas registradas

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- PAGINACIÓN -->
    <div class="mt-4">

        {{ $sales->links() }}

    </div>

</div>

@endsection