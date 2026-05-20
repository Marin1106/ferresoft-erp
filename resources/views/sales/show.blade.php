@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold">

                🧾 Detalle de Venta

            </h1>

            <p class="text-muted">

                Información completa de la venta

            </p>

        </div>

        <a href="{{ route('sales.index') }}"
           class="btn btn-secondary">

            Volver

        </a>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="row g-4">

                <div class="col-md-6">

                    <h5 class="fw-bold">

                        Cliente

                    </h5>

                    <p>

                        {{ $sale->client->name }}

                    </p>

                </div>

                <div class="col-md-6">

                    <h5 class="fw-bold">

                        Producto

                    </h5>

                    <p>

                        {{ $sale->product->name }}

                    </p>

                </div>

                <div class="col-md-4">

                    <h5 class="fw-bold">

                        Cantidad

                    </h5>

                    <p>

                        {{ $sale->quantity }}

                    </p>

                </div>

                <div class="col-md-4">

                    <h5 class="fw-bold">

                        Precio

                    </h5>

                    <p>

                        ${{ number_format($sale->price, 2) }}

                    </p>

                </div>

                <div class="col-md-4">

                    <h5 class="fw-bold">

                        Subtotal

                    </h5>

                    <p>

                        ${{ number_format($sale->subtotal, 2) }}

                    </p>

                </div>

                <div class="col-md-4">

                    <h5 class="fw-bold">

                        IVA

                    </h5>

                    <p>

                        ${{ number_format($sale->iva, 2) }}

                    </p>

                </div>

                <div class="col-md-4">

                    <h5 class="fw-bold">

                        Total

                    </h5>

                    <p class="text-success fw-bold">

                        ${{ number_format($sale->total, 2) }}

                    </p>

                </div>

                <div class="col-md-4">

                    <h5 class="fw-bold">

                        Fecha

                    </h5>

                    <p>

                        {{ $sale->created_at->format('d/m/Y H:i') }}

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection