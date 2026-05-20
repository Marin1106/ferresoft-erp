@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- =========================================
         HEADER
    ========================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

        <div>

            <h1 class="fw-bold text-dark">

                📊 Dashboard ERP

            </h1>

            <p class="text-muted mb-0">

                Bienvenido al panel administrativo de FerreSoft

            </p>

        </div>

        <div>

            <span class="badge bg-primary p-3 fs-6 shadow-sm">

                Sistema Activo

            </span>

        </div>

    </div>

    <!-- =========================================
         CARDS PRINCIPALES
    ========================================== -->

    <div class="row g-4">

        <!-- PRODUCTOS -->
        <div class="col-lg-3 col-md-6">

            <div class="card dashboard-card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">

                                Total Productos

                            </p>

                            <h2 class="fw-bold">

                                {{ $totalProductos }}

                            </h2>

                        </div>

                        <div class="icon-box bg-primary text-white">

                            📦

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- STOCK -->
        <div class="col-lg-3 col-md-6">

            <div class="card dashboard-card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">

                                Stock Total

                            </p>

                            <h2 class="fw-bold">

                                {{ $totalStock }}

                            </h2>

                        </div>

                        <div class="icon-box bg-success text-white">

                            📊

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- INVENTARIO -->
        <div class="col-lg-3 col-md-6">

            <div class="card dashboard-card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">

                                Valor Inventario

                            </p>

                            <h2 class="fw-bold">

                                ${{ number_format($valorInventario, 2) }}

                            </h2>

                        </div>

                        <div class="icon-box bg-warning text-dark">

                            💰

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- STOCK BAJO -->
        <div class="col-lg-3 col-md-6">

            <div class="card border-0 shadow-sm h-100 bg-danger text-white dashboard-card">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="mb-1">

                                Stock Bajo

                            </p>

                            <h2 class="fw-bold">

                                {{ $productosBajos }}

                            </h2>

                        </div>

                        <div class="icon-box bg-light text-danger">

                            ⚠️

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- =========================================
         ALERTA STOCK BAJO
    ========================================== -->

    @if($productosBajos > 0)

        <div class="alert alert-danger shadow-sm mt-4 border-0">

            ⚠️ Hay productos con inventario bajo.
            Revisa el módulo de productos para evitar quedarte sin stock.

        </div>

    @endif

    <!-- =========================================
         ÚLTIMOS PRODUCTOS
    ========================================== -->

    <div class="card border-0 shadow-sm mt-4">

        <div class="card-header bg-dark text-white">

            📦 Últimos Productos Registrados

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Precio</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($ultimosProductos as $product)

                            <tr>

                                <!-- ID -->
                                <td>

                                    {{ $product->id }}

                                </td>

                                <!-- NOMBRE -->
                                <td>

                                    <strong>

                                        {{ $product->name }}

                                    </strong>

                                </td>

                                <!-- TIPO -->
                                <td>

                                    @if($product->type == 'materia_prima')

                                        <span class="badge bg-secondary">

                                            Materia Prima

                                        </span>

                                    @else

                                        <span class="badge bg-primary">

                                            Producto Terminado

                                        </span>

                                    @endif

                                </td>

                                <!-- STOCK -->
                                <td>

                                    {{ $product->stock }}

                                </td>

                                <!-- ESTADO -->
                                <td>

                                    @if($product->stock <= $product->stock_minimo)

                                        <span class="badge bg-danger">

                                            Stock Bajo

                                        </span>

                                    @elseif($product->stock <= 10)

                                        <span class="badge bg-warning text-dark">

                                            Stock Medio

                                        </span>

                                    @else

                                        <span class="badge bg-success">

                                            Disponible

                                        </span>

                                    @endif

                                </td>

                                <!-- PRECIO -->
                                <td>

                                    <strong>

                                        ${{ number_format($product->price, 2) }}

                                    </strong>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center text-muted py-4">

                                    No hay productos registrados

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- =========================================
         PRODUCTOS MÁS VENDIDOS
    ========================================== -->

    <div class="card border-0 shadow-sm mt-4">

        <div class="card-header bg-warning text-dark">

            🏆 Productos Más Vendidos

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>Producto</th>
                            <th>Total Vendido</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($ventasPorProducto as $venta)

                            <tr>

                                <td>

                                    {{ $venta->product->name ?? 'Producto eliminado' }}

                                </td>

                                <td>

                                    <span class="badge bg-success">

                                        {{ $venta->total_vendido }}

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="2"
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

    <!-- =========================================
         VENTAS TOTALES
    ========================================== -->

    <div class="card border-0 shadow-sm mt-4">

        <div class="card-header bg-success text-white">

            💵 Ventas Totales

        </div>

        <div class="card-body">

            <h2 class="fw-bold text-success">

                ${{ number_format($ventasTotales, 2) }}

            </h2>

            <p class="text-muted mb-0">

                Total generado por ventas registradas.

            </p>

        </div>

    </div>

    <!-- =========================================
         GRÁFICA INVENTARIO
    ========================================== -->

    <div class="card border-0 shadow-sm mt-4">

        <div class="card-header bg-primary text-white">

            📈 Estadísticas Inventario

        </div>

        <div class="card-body">

            <canvas id="inventoryChart" height="100"></canvas>

        </div>

    </div>

    <!-- =========================================
         GRÁFICA PRODUCTOS MÁS VENDIDOS
    ========================================== -->

    <div class="card border-0 shadow-sm mt-4 mb-5">

        <div class="card-header bg-success text-white">

            📊 Productos Más Vendidos

        </div>

        <div class="card-body">

            <canvas id="ventasChart"></canvas>

        </div>

    </div>

</div>

<!-- =========================================
     CHART JS
========================================== -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

/*
|--------------------------------------------------------------------------
| GRÁFICA INVENTARIO
|--------------------------------------------------------------------------
*/

const inventoryCtx = document.getElementById('inventoryChart');

new Chart(inventoryCtx, {

    type: 'bar',

    data: {

        labels: [

            'Productos',
            'Stock',
            'Stock Bajo'

        ],

        datasets: [{

            label: 'Estadísticas ERP',

            data: [

                {{ $totalProductos }},
                {{ $totalStock }},
                {{ $productosBajos }}

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

/*
|--------------------------------------------------------------------------
| GRÁFICA PRODUCTOS MÁS VENDIDOS
|--------------------------------------------------------------------------
*/

const ventasCtx = document.getElementById('ventasChart');

new Chart(ventasCtx, {

    type: 'pie',

    data: {

        labels: [

            @foreach($ventasPorProducto as $venta)

                '{{ $venta->product->name ?? "Producto" }}',

            @endforeach

        ],

        datasets: [{

            label: 'Ventas',

            data: [

                @foreach($ventasPorProducto as $venta)

                    {{ $venta->total_vendido }},

                @endforeach

            ],

            borderWidth: 1

        }]

    },

    options: {

        responsive: true

    }

});

</script>

@endsection