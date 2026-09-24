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

    <!-- FACTURA ELECTRÓNICA -->
    <div class="card border-0 shadow-sm mt-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">

                <h5 class="fw-bold mb-0">

                    🧾 Factura Electrónica DIAN

                </h5>

                @php
                    $feBadge = [
                        'aceptada'  => 'success',
                        'pendiente' => 'warning text-dark',
                        'rechazada' => 'danger',
                        'error'     => 'danger',
                    ][$sale->fe_status] ?? 'secondary';
                @endphp

                <span class="badge bg-{{ $feBadge }} fs-6">

                    {{ $sale->fe_status ? ucfirst($sale->fe_status) : 'No enviada' }}

                </span>

            </div>

            <div class="row g-3">

                <div class="col-md-4">

                    <strong>Número:</strong>

                    {{ $sale->fe_full_number ?? '—' }}

                </div>

                <div class="col-md-4">

                    <strong>Último envío:</strong>

                    {{ $sale->fe_sent_at?->format('d/m/Y H:i') ?? '—' }}

                </div>

                <div class="col-md-4">

                    <strong>Correo cliente:</strong>

                    {{ $sale->client->email }}

                </div>

                @if ($sale->fe_cufe)

                    <div class="col-12">

                        <strong>CUFE:</strong>

                        <code class="text-break">{{ $sale->fe_cufe }}</code>

                    </div>

                @endif

                @if ($sale->fe_message)

                    <div class="col-12">

                        <div class="alert alert-{{ $sale->fe_status === 'aceptada' ? 'success' : 'warning' }} mb-0">

                            {{ $sale->fe_message }}

                        </div>

                    </div>

                @endif

            </div>

            @if ($sale->fe_status === 'aceptada')

                <form action="{{ route('sales.electronic-invoice.email', $sale) }}"
                      method="POST"
                      class="mt-3">

                    @csrf

                    <label class="form-label fw-bold">

                        Enviar factura por correo

                    </label>

                    <div class="input-group">

                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $sale->client->email) }}"
                               required>

                        <button class="btn btn-outline-primary">

                            Enviar

                        </button>

                    </div>

                    <small class="text-muted">

                        Por defecto va al correo del cliente; puede escribir otro.

                    </small>

                </form>

            @endif

            @if ($sale->fe_status !== 'aceptada' && $sale->status !== 'Cancelada')

                <form action="{{ route('sales.electronic-invoice', $sale) }}"
                      method="POST"
                      class="mt-3">

                    @csrf

                    <button class="btn btn-primary">

                        {{ $sale->fe_status ? 'Reenviar a la DIAN' : 'Enviar a la DIAN' }}

                    </button>

                    @if ($sale->client->missingElectronicInvoiceFields())

                        <a href="{{ route('clients.edit', $sale->client) }}"
                           class="btn btn-outline-secondary ms-2">

                            Completar datos del cliente

                        </a>

                    @endif

                </form>

            @endif

        </div>

    </div>

</div>

@endsection