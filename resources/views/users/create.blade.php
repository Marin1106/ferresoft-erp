@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white">

            <h4 class="mb-0 fw-bold">

                👤 Crear Nuevo Usuario

            </h4>

        </div>

        <div class="card-body">

            <!-- ERRORES -->
            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <!-- FORM -->
            <form action="{{ route('users.store') }}"
                  method="POST">

                @csrf

                <div class="row g-4">

                    <!-- NOMBRE -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            Nombre completo

                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               required>

                    </div>

                    <!-- EMAIL -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            Correo electrónico

                        </label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email') }}"
                               required>

                    </div>

                    <!-- PASSWORD -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            Contraseña

                        </label>

                        <input type="password"
                               name="password"
                               class="form-control"
                               required>

                    </div>

                    <!-- ROL -->
                    <div class="col-md-3">

                        <label class="form-label fw-semibold">

                            Rol

                        </label>

                        <select name="role"
                                class="form-select"
                                required>

                            <option value="vendedor">

                                Vendedor

                            </option>

                            <option value="cliente">

                                Cliente

                            </option>

                            <option value="admin">

                                Administrador

                            </option>

                        </select>

                    </div>

                    <!-- STATUS -->
                    <div class="col-md-3">

                        <label class="form-label fw-semibold">

                            Estado

                        </label>

                        <select name="status"
                                class="form-select"
                                required>

                            <option value="activo">

                                🟢 Activo

                            </option>

                            <option value="inactivo">

                                🔴 Inactivo

                            </option>

                        </select>

                    </div>

                </div>

                <!-- BOTONES -->
                <div class="mt-4 d-flex gap-2">

                    <button class="btn btn-primary">

                        💾 Guardar Usuario

                    </button>

                    <a href="{{ route('users.index') }}"
                       class="btn btn-secondary">

                        ↩ Volver

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection