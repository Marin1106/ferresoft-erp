@extends('layouts.app')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h1 class="fw-bold">

                🧾 Nueva Venta

            </h1>

            <p class="text-muted mb-0">

                Registrar nueva venta del sistema

            </p>

        </div>

        <!-- BOTÓN VOLVER -->
        <a href="{{ route('sales.index') }}"
           class="btn btn-dark shadow-sm">

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <!-- ALERTA ERRORES -->
    @if ($errors->any())

        <div class="alert alert-danger shadow-sm border-0">

            <strong>

                ⚠️ Se encontraron errores:

            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- CARD -->
    <div class="card border-0 shadow-lg rounded-4">

        <!-- HEADER CARD -->
        <div class="card-header bg-primary text-white rounded-top-4 py-3">

            <h5 class="mb-0 fw-bold">

                📋 Datos de la Venta

            </h5>

        </div>

        <!-- BODY -->
        <div class="card-body p-4">

            <form action="{{ route('sales.store') }}"
                  method="POST">

                @csrf

                <div class="row g-4">

                    <!-- CLIENTE -->
                    <div class="col-md-6">

                        <label class="form-label fw-bold">

                            👤 Cliente

                        </label>

                        <select name="client_id"
                                class="form-select shadow-sm"
                                required>

                            <option value="">

                                Seleccionar cliente

                            </option>

                            @foreach($clients as $client)

                                <option value="{{ $client->id }}">

                                    {{ $client->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- PRODUCTO -->
                    <div class="col-md-6">

                        <label class="form-label fw-bold">

                            📦 Producto

                        </label>

                        <select name="product_id"
                                id="product"
                                class="form-select shadow-sm"
                                required>

                            <option value="">

                                Seleccionar producto

                            </option>

                            @foreach($products as $product)

                                <option value="{{ $product->id }}"
                                        data-price="{{ $product->price }}"
                                        data-stock="{{ $product->stock }}"
                                        data-minimo="{{ $product->stock_minimo }}"
                                        data-type="{{ $product->type }}">

                                    {{ $product->name }}
                                    | Stock: {{ $product->stock }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- TIPO PRODUCTO -->
                    <div class="col-md-4">

                        <label class="form-label fw-bold">

                            🏷️ Tipo

                        </label>

                        <input type="text"
                               id="type"
                               class="form-control shadow-sm"
                               readonly>

                    </div>

                    <!-- STOCK -->
                    <div class="col-md-4">

                        <label class="form-label fw-bold">

                            📊 Stock Disponible

                        </label>

                        <input type="text"
                               id="stock"
                               class="form-control shadow-sm"
                               readonly>

                    </div>

                    <!-- PRECIO -->
                    <div class="col-md-4">

                        <label class="form-label fw-bold">

                            💰 Precio Unitario

                        </label>

                        <input type="text"
                               id="price"
                               class="form-control shadow-sm"
                               readonly>

                    </div>

                    <!-- CANTIDAD -->
                    <div class="col-md-4">

                        <label class="form-label fw-bold">

                            🔢 Cantidad

                        </label>

                        <input type="number"
                               name="quantity"
                               id="quantity"
                               class="form-control shadow-sm"
                               min="1"
                               required>

                    </div>

                    <!-- MÉTODO PAGO -->
                    <div class="col-md-4">

                        <label class="form-label fw-bold">

                            💳 Método de Pago

                        </label>

                        <select name="payment_method"
                                class="form-select shadow-sm"
                                required>

                            <option value="">

                                Seleccionar método

                            </option>

                            <option value="Efectivo">

                                Efectivo

                            </option>

                            <option value="Tarjeta">

                                Tarjeta

                            </option>

                            <option value="Transferencia">

                                Transferencia

                            </option>

                        </select>

                    </div>

                    <!-- ESTADO -->
                    <div class="col-md-4">

                        <label class="form-label fw-bold">

                            📌 Estado

                        </label>

                        <select name="status"
                                class="form-select shadow-sm"
                                required>

                            <option value="Completada">

                                Completada

                            </option>

                            <option value="Pendiente">

                                Pendiente

                            </option>

                            <option value="Cancelada">

                                Cancelada

                            </option>

                        </select>

                    </div>

                    <!-- SUBTOTAL -->
                    <div class="col-md-4">

                        <label class="form-label fw-bold">

                            🧮 Subtotal

                        </label>

                        <input type="text"
                               id="subtotal"
                               class="form-control shadow-sm"
                               readonly>

                    </div>

                    <!-- IVA -->
                    <div class="col-md-4">

                        <label class="form-label fw-bold">

                            🧾 IVA (19%)

                        </label>

                        <input type="text"
                               id="iva"
                               class="form-control shadow-sm"
                               readonly>

                    </div>

                    <!-- TOTAL -->
                    <div class="col-md-4">

                        <label class="form-label fw-bold">

                            💵 Total Venta

                        </label>

                        <input type="text"
                               id="total"
                               class="form-control form-control-lg fw-bold text-success shadow-sm"
                               readonly>

                    </div>

                </div>

                <!-- ALERTA STOCK -->
                <div id="stockAlert"
                     class="alert alert-warning mt-4 d-none">

                    ⚠️ Este producto tiene stock bajo

                </div>

                <!-- ALERTA MATERIA PRIMA -->
                <div id="typeAlert"
                     class="alert alert-info mt-3 d-none">

                    🏭 Este producto es materia prima

                </div>

                <!-- BOTÓN -->
                <div class="mt-4">

                    <button class="btn btn-primary btn-lg shadow-sm px-5">

                        <i class="bi bi-check-circle"></i>

                        Registrar Venta

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- SCRIPT -->
<script>

    const product = document.getElementById('product');

    const stock = document.getElementById('stock');

    const price = document.getElementById('price');

    const quantity = document.getElementById('quantity');

    const subtotal = document.getElementById('subtotal');

    const iva = document.getElementById('iva');

    const total = document.getElementById('total');

    const stockAlert = document.getElementById('stockAlert');

    const typeAlert = document.getElementById('typeAlert');

    const type = document.getElementById('type');

    /*
    |--------------------------------------------------------------------------
    | CAMBIO PRODUCTO
    |--------------------------------------------------------------------------
    */

    product.addEventListener('change', function () {

        const option = this.options[this.selectedIndex];

        const currentStock = option.dataset.stock || 0;

        const currentPrice = option.dataset.price || 0;

        const minimo = option.dataset.minimo || 5;

        const currentType = option.dataset.type || '';

        /*
        |--------------------------------------------------------------------------
        | MOSTRAR DATOS
        |--------------------------------------------------------------------------
        */

        stock.value = currentStock;

        price.value = '$ ' + parseFloat(currentPrice).toFixed(2);

        /*
        |--------------------------------------------------------------------------
        | MOSTRAR TIPO
        |--------------------------------------------------------------------------
        */

        if(currentType === 'materia_prima'){

            type.value = 'Materia Prima';

            typeAlert.classList.remove('d-none');

        }else{

            type.value = 'Producto Terminado';

            typeAlert.classList.add('d-none');

        }

        /*
        |--------------------------------------------------------------------------
        | ALERTA STOCK BAJO
        |--------------------------------------------------------------------------
        */

        if (parseInt(currentStock) <= parseInt(minimo)) {

            stockAlert.classList.remove('d-none');

        } else {

            stockAlert.classList.add('d-none');

        }

        calculateTotal();

    });

    /*
    |--------------------------------------------------------------------------
    | CALCULAR TOTAL
    |--------------------------------------------------------------------------
    */

    quantity.addEventListener('input', calculateTotal);

    function calculateTotal() {

        let selected = product.options[product.selectedIndex];

        let p = parseFloat(selected.dataset.price) || 0;

        let q = parseInt(quantity.value) || 0;

        let sub = p * q;

        let tax = sub * 0.19;

        let finalTotal = sub + tax;

        subtotal.value = '$ ' + sub.toFixed(2);

        iva.value = '$ ' + tax.toFixed(2);

        total.value = '$ ' + finalTotal.toFixed(2);

    }

</script>

@endsection