@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold">

                🧾 Detalle de Venta

            </h1>

            <p class="text-muted">

                Información completa de la factura

            </p>

        </div>

        <a href="{{ route('sales.index') }}"
           class="btn btn-secondary">

            ← Volver

        </a>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-lg">

        <div class="card-body p-5">

            <div class="row g-4">

                <!-- CLIENTE -->
                <div class="col-md-6">

                    <h5 class="fw-bold text-primary">

                        👤 Cliente

                    </h5>

                    <hr>

                    <p>

                        <strong>Nombre:</strong>
                        {{ $sale->client->name }}

                    </p>

                    <p>

                        <strong>Email:</strong>
                        {{ $sale->client->email }}

                    </p>

                    <p>

                        <strong>Teléfono:</strong>
                        {{ $sale->client->phone }}

                    </p>

                </div>

                <!-- PRODUCTO -->
                <div class="col-md-6">

                    <h5 class="fw-bold text-success">

                        📦 Producto

                    </h5>

                    <hr>

                    <p>

                        <strong>Producto:</strong>
                        {{ $sale->product->name }}

                    </p>

                    <p>

                        <strong>Precio:</strong>
                        ${{ number_format($sale->price, 2) }}

                    </p>

                    <p>

                        <strong>Cantidad:</strong>
                        {{ $sale->quantity }}

                    </p>

                </div>

            </div>

            <!-- TOTALES -->
            <div class="mt-5">

                <h5 class="fw-bold text-dark">

                    💰 Totales

                </h5>

                <hr>

                <div class="row">

                    <div class="col-md-4">

                        <div class="card bg-light border-0 shadow-sm">

                            <div class="card-body text-center">

                                <h6>Subtotal</h6>

                                <h4>

                                    ${{ number_format($sale->subtotal, 2) }}

                                </h4>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="card bg-warning border-0 shadow-sm">

                            <div class="card-body text-center">

                                <h6>IVA</h6>

                                <h4>

                                    ${{ number_format($sale->iva, 2) }}

                                </h4>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="card bg-success text-white border-0 shadow-sm">

                            <div class="card-body text-center">

                                <h6>Total</h6>

                                <h3>

                                    ${{ number_format($sale->total, 2) }}

                                </h3>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- FECHA -->
            <div class="mt-4">

                <strong>Fecha de venta:</strong>

                {{ $sale->created_at->format('d/m/Y H:i') }}

            </div>

            <!-- BOTONES -->
            <div class="mt-5 d-flex gap-3">

                <a href="{{ route('sales.invoice', $sale->id) }}"
                   class="btn btn-danger">

                    📄 Descargar PDF

                </a>

            </div>

        </div>

    </div>

</div>

@endsection