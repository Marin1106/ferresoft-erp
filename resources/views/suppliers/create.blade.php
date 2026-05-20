@extends('layouts.app')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h2 class="fw-bold mb-4">

            ➕ Nuevo Proveedor

        </h2>

        <form action="{{ route('suppliers.store') }}"
              method="POST">

            @csrf

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">

                        Nombre

                    </label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-6">

                    <label class="form-label">

                        Teléfono

                    </label>

                    <input type="text"
                           name="phone"
                           class="form-control">

                </div>

                <div class="col-md-6">

                    <label class="form-label">

                        Email

                    </label>

                    <input type="email"
                           name="email"
                           class="form-control">

                </div>

                <div class="col-md-6">

                    <label class="form-label">

                        Dirección

                    </label>

                    <input type="text"
                           name="address"
                           class="form-control">

                </div>

            </div>

            <button class="btn btn-primary mt-4">

                💾 Guardar proveedor

            </button>

        </form>

    </div>

</div>

@endsection