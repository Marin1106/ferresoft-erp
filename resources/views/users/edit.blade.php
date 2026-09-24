@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0 rounded-4">

        <!-- HEADER -->
        <div class="card-header bg-warning text-dark py-3 rounded-top-4">

            <h3 class="fw-bold mb-0">

                ✏️ Editar Usuario

            </h3>

        </div>

        <div class="card-body p-4">

            <!-- ERRORES -->
            @if ($errors->any())

                <div class="alert alert-danger rounded-3">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <!-- FORM -->
            <form method="POST"
                  action="{{ route('users.update', $user) }}">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- NOMBRE -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            👤 Nombre Completo

                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               class="form-control rounded-3"
                               required>

                    </div>

                    <!-- EMAIL -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            📧 Correo Electrónico

                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               class="form-control rounded-3"
                               required>

                    </div>

                    <!-- PASSWORD -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            🔑 Nueva Contraseña

                        </label>

                        <input type="password"
                               name="password"
                               class="form-control rounded-3">

                        <small class="text-muted">

                            Déjalo vacío si no deseas cambiarla

                        </small>

                    </div>

                    <!-- ROL -->
                    <div class="col-md-3">

                        <label class="form-label fw-semibold">

                            🛡️ Rol

                        </label>

                        <select name="role"
                                class="form-select rounded-3"
                                required>

                            <option value="admin"
                                {{ $user->role == 'admin' ? 'selected' : '' }}>

                                Administrador

                            </option>

                            <option value="vendedor"
                                {{ $user->role == 'vendedor' ? 'selected' : '' }}>

                                Vendedor

                            </option>

                            <option value="contador"
                                {{ $user->role == 'contador' ? 'selected' : '' }}>

                                Contador

                            </option>

                            <option value="operario"
                                {{ $user->role == 'operario' ? 'selected' : '' }}>

                                Operario

                            </option>

                        </select>

                    </div>

                    <!-- ESTADO -->
                    <div class="col-md-3">

                        <label class="form-label fw-semibold">

                            📌 Estado

                        </label>

                        <select name="status"
                                class="form-select rounded-3"
                                required>

                            <option value="activo"
                                {{ $user->status == 'activo' ? 'selected' : '' }}>

                                🟢 Activo

                            </option>

                            <option value="inactivo"
                                {{ $user->status == 'inactivo' ? 'selected' : '' }}>

                                🔴 Inactivo

                            </option>

                        </select>

                    </div>

                </div>

                <!-- BOTONES -->
                <div class="mt-5 d-flex gap-3">

                    <button class="btn btn-warning px-4 rounded-3 fw-semibold">

                        💾 Guardar Cambios

                    </button>

                    <a href="{{ route('users.index') }}"
                       class="btn btn-secondary px-4 rounded-3">

                        ↩ Volver

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection