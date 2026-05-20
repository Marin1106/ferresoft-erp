@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                🧾 Detalle de Venta #{{ $sale->id }}

            </h2>

            <p class="text-muted">

                Información completa de la venta

            </p>

        </div>

        <a href="{{ route('sales.index') }}"
           class="btn btn-secondary">

            ⬅ Volver

        </a>

    </div>

    <!-- CARD INFO -->
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="row">

                <!-- CLIENTE -->
                <div class="col-md-6 mb-3">

                    <h6 class="text-muted">Cliente</h6>

                    <h5 class="fw-bold">

                        👤 {{ $sale->client->name ?? 'No disponible' }}

                    </h5>

                </div>

                <!-- PRODUCTO -->
                <div class="col-md-6 mb-3">

                    <h6 class="text-muted">Producto</h6>

                    <h5 class="fw-bold">

                        📦 {{ $sale->product->name ?? 'No disponible' }}

                    </h5>

                </div>

                <!-- CANTIDAD -->
                <div class="col-md-4 mb-3">

                    <h6 class="text-muted">Cantidad</h6>

                    <h5>

                        {{ $sale->quantity }}

                    </h5>

                </div>

                <!-- PRECIO -->
                <div class="col-md-4 mb-3">

                    <h6 class="text-muted">Precio Unitario</h6>

                    <h5>

                        ${{ number_format($sale->price ?? 0, 2) }}

                    </h5>

                </div>

                <!-- FECHA -->
                <div class="col-md-4 mb-3">

                    <h6 class="text-muted">Fecha</h6>

                    <h5>

                        {{ $sale->created_at->format('d/m/Y H:i') }}

                    </h5>

                </div>

            </div>

            <hr>

            <!-- TOTALES -->
            <div class="row text-center">

                <div class="col-md-4">

                    <h6 class="text-muted">Subtotal</h6>

                    <h4 class="text-primary">

                        ${{ number_format($sale->subtotal ?? 0, 2) }}

                    </h4>

                </div>

                <div class="col-md-4">

                    <h6 class="text-muted">IVA (19%)</h6>

                    <h4 class="text-warning">

                        ${{ number_format($sale->iva ?? 0, 2) }}

                    </h4>

                </div>

                <div class="col-md-4">

                    <h6 class="text-muted">Total</h6>

                    <h3 class="text-success fw-bold">

                        ${{ number_format($sale->total, 2) }}

                    </h3>

                </div>

            </div>

        </div>

    </div>

    <!-- BOTONES -->
    <div class="mt-4 d-flex gap-2">

        <a href="{{ route('sales.invoice', $sale->id) }}"
           class="btn btn-success">

            📄 Descargar Factura

        </a>

        <form action="{{ route('sales.destroy', $sale->id) }}"
              method="POST">

            @csrf
            @method('DELETE')

            <button class="btn btn-danger">

                🗑️ Eliminar Venta

            </button>

        </form>

    </div>

</div>

@endsection