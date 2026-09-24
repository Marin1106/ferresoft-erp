@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================
        HEADER
    ========================================== --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h1 class="fw-bold text-dark">
                📈 Reportes 
            </h1>

            <p class="text-muted mb-0">
                Estadísticas generales del sistema FerreSoft
            </p>
        </div>

        <a href="{{ route('reports.pdf') }}"
           class="btn btn-danger shadow-sm">
            📄 Exportar PDF
        </a>

    </div>

    {{-- =========================================
        CARDS
    ========================================== --}}
    <div class="row g-4">

        {{-- VENTAS --}}
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                💰 Ventas Totales
                            </p>

                            <h2 class="fw-bold text-success">
                                ${{ number_format($ventasTotales, 2) }}
                            </h2>
                        </div>

                        <div class="fs-1">
                            💵
                        </div>

                    </div>

                </div>
            </div>
        </div>

        {{-- TOTAL VENTAS --}}
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                🧾 Total Ventas
                            </p>

                            <h2 class="fw-bold">
                                {{ $cantidadVentas }}
                            </h2>
                        </div>

                        <div class="fs-1">
                            📊
                        </div>

                    </div>

                </div>
            </div>
        </div>

        {{-- PRODUCTOS --}}
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                📦 Productos
                            </p>

                            <h2 class="fw-bold text-primary">
                                {{ $totalProductos }}
                            </h2>
                        </div>

                        <div class="fs-1">
                            
                        </div>

                    </div>

                </div>
            </div>
        </div>

        {{-- INVENTARIO --}}
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                💎 Inventario
                            </p>

                            <h2 class="fw-bold text-warning">
                                ${{ number_format($valorInventario, 2) }}
                            </h2>
                        </div>

                        <div class="fs-1">
                            📦
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- =========================================
        GRAFICA GENERAL
    ========================================== --}}
    <div class="card border-0 shadow-sm mt-4">

        <div class="card-header bg-primary text-white fw-bold">
            📊 Resumen General
        </div>

        <div class="card-body">
            <canvas id="reportChart" height="100"></canvas>
        </div>

    </div>

    {{-- =========================================
        PRODUCTOS MÁS VENDIDOS
    ========================================== --}}
    <div class="card border-0 shadow-sm mt-4">

        <div class="card-header bg-dark text-white fw-bold">
            🏆 Productos Más Vendidos
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Total Vendido</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($productosVendidos as $index => $venta)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $venta->product->name ?? 'Producto eliminado' }}
                                    </strong>
                                </td>

                                <td>
                                    <span class="badge bg-success">
                                        {{ $venta->total_vendido }}
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="3"
                                    class="text-center text-muted py-4">

                                    No hay ventas registradas

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- =========================================
        STOCK BAJO
    ========================================== --}}
    <div class="card border-0 shadow-sm mt-4">

        <div class="card-header bg-danger text-white fw-bold">
            ⚠️ Productos con Stock Bajo
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>
                            <th>Producto</th>
                            <th>Stock</th>
                            <th>Estado</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($productosBajos as $product)

                            <tr>

                                <td>
                                    <strong>
                                        {{ $product->name }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $product->stock }}
                                </td>

                                <td>
                                    <span class="badge bg-danger">
                                        Stock Bajo
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="3"
                                    class="text-center text-muted py-4">

                                    No hay productos con stock bajo

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- =========================================
        ÚLTIMAS VENTAS
    ========================================== --}}
    <div class="card border-0 shadow-sm mt-4">

        <div class="card-header bg-success text-white fw-bold">
            🧾 Últimas Ventas
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Producto</th>
                            <th>Total</th>
                            <th>Fecha</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($ultimasVentas as $sale)

                            <tr>

                                <td>
                                    #{{ $sale->id }}
                                </td>

                                <td>
                                    {{ $sale->client->name ?? 'Cliente eliminado' }}
                                </td>

                                <td>
                                    {{ $sale->product->name ?? 'Producto eliminado' }}
                                </td>

                                <td>
                                    <strong class="text-success">
                                        ${{ number_format($sale->total, 2) }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $sale->created_at->format('d/m/Y') }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center text-muted py-4">

                                    No hay ventas registradas

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

{{-- =========================================
    CHART JS
========================================== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('reportChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [
            'Ventas Totales',
            'Cantidad Ventas',
            'Productos',
            'Inventario'
        ],

        datasets: [{

            label: 'Estadísticas',

            data: [
                {{ $ventasTotales }},
                {{ $cantidadVentas }},
                {{ $totalProductos }},
                {{ $valorInventario }}
            ],

            borderWidth: 1,
            borderRadius: 10

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {
                display: true
            }

        },

        scales: {

            y: {
                beginAtZero: true
            }

        }

    }

});

</script>

@endsection