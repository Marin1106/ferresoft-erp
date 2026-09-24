@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                <!-- HEADER -->
                <div class="card-header bg-primary text-white py-4">

                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">

                        <div>

                            <h3 class="fw-bold mb-1">

                                👤 Crear Nuevo Usuario

                            </h3>

                            <small class="opacity-75">

                                Complete la información del nuevo empleado

                            </small>

                        </div>

                        <div class="fs-1">

                            <i class="bi bi-person-plus-fill"></i>

                        </div>

                    </div>

                </div>

                <div class="card-body p-4">

                    <!-- ERRORES -->
                    @if ($errors->any())

                        <div class="alert alert-danger border-0 shadow-sm rounded-3">

                            <div class="fw-bold mb-2">

                                ⚠ Se encontraron errores:

                            </div>

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

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-person-fill"></i>

                                    </span>

                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           placeholder="Ingrese el nombre completo"
                                           value="{{ old('name') }}"
                                           required>

                                </div>

                            </div>

                            <!-- EMAIL -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Correo electrónico

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-envelope-fill"></i>

                                    </span>

                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           placeholder="correo@ejemplo.com"
                                           value="{{ old('email') }}"
                                           required>

                                </div>

                            </div>

                            <!-- PASSWORD -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Contraseña

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-lock-fill"></i>

                                    </span>

                                    <input type="password"
                                           name="password"
                                           class="form-control"
                                           placeholder="Ingrese la contraseña"
                                           required>

                                </div>

                            </div>

                            <!-- ROL -->
                            <div class="col-md-3">

                                <label class="form-label fw-semibold">

                                    Rol

                                </label>

                                <select name="role"
                                        class="form-select"
                                        required>

                                    <option value="">

                                        Seleccione

                                    </option>

                                    <option value="admin">

                                        👑 Administrador

                                    </option>

                                    <option value="vendedor">

                                        🛒 Vendedor

                                    </option>

                                    <option value="contador">

                                        📊 Contador

                                    </option>

                                    <option value="operario">

                                        🏭 Operario

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
                        <div class="mt-5 d-flex flex-wrap gap-3">

                            <button class="btn btn-primary px-4 py-2 rounded-3 shadow-sm">

                                <i class="bi bi-save-fill me-2"></i>

                                Guardar Usuario

                            </button>

                            <a href="{{ route('users.index') }}"
                               class="btn btn-secondary px-4 py-2 rounded-3 shadow-sm">

                                <i class="bi bi-arrow-left-circle me-2"></i>

                                Volver

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection