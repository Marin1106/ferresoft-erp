@extends('layouts.app')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h3 class="fw-bold mb-4">

            ✏️ Editar Usuario

        </h3>

        <form method="POST"
              action="{{ route('users.update',$user) }}">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">

                    Nombre

                </label>

                <input type="text"
                       name="name"
                       value="{{ $user->name }}"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Email

                </label>

                <input type="email"
                       name="email"
                       value="{{ $user->email }}"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Rol

                </label>

                <select name="role"
                        class="form-select">

                    <option value="admin"
                        {{ $user->role == 'admin' ? 'selected' : '' }}>

                        Admin

                    </option>

                    <option value="empleado"
                        {{ $user->role == 'empleado' ? 'selected' : '' }}>

                        Empleado

                    </option>

                </select>

            </div>

            <div class="mb-4">

                <label class="form-label">

                    Estado

                </label>

                <select name="status"
                        class="form-select">

                    <option value="activo"
                        {{ $user->status == 'activo' ? 'selected' : '' }}>

                        Activo

                    </option>

                    <option value="inactivo"
                        {{ $user->status == 'inactivo' ? 'selected' : '' }}>

                        Inactivo

                    </option>

                </select>

            </div>

            <button class="btn btn-primary">

                Guardar cambios

            </button>

        </form>

    </div>

</div>

@endsection