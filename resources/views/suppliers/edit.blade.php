@extends('layouts.app')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h2 class="fw-bold mb-4">

            ✏️ Editar Proveedor

        </h2>

        <form action="{{ route('suppliers.update',$supplier) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">

                        Nombre

                    </label>

                    <input type="text"
                           name="name"
                           value="{{ $supplier->name }}"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-6">

                    <label class="form-label">

                        Teléfono

                    </label>

                    <input type="text"
                           name="phone"
                           value="{{ $supplier->phone }}"
                           class="form-control">

                </div>

                <div class="col-md-6">

                    <label class="form-label">

                        Email

                    </label>

                    <input type="email"
                           name="email"
                           value="{{ $supplier->email }}"
                           class="form-control">

                </div>

                <div class="col-md-6">

                    <label class="form-label">

                        Dirección

                    </label>

                    <input type="text"
                           name="address"
                           value="{{ $supplier->address }}"
                           class="form-control">

                </div>

            </div>

            <button class="btn btn-success mt-4">

                💾 Actualizar proveedor

            </button>

        </form>

    </div>

</div>

@endsection