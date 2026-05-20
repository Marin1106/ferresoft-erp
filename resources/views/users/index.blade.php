@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold">
            👥 Gestión de Usuarios
        </h2>
        <p class="text-muted">
            Administra empleados y administradores
        </p>
    </div>

    <!-- Cambiado de 'register' a 'users.create' -->
    <a href="{{ route('users.create') }}"
       class="btn btn-primary">
        <i class="bi bi-person-plus"></i>
        Nuevo Usuario
    </a>

</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role === 'admin')
                                    <span class="badge bg-danger">ADMIN</span>
                                @else
                                    <span class="badge bg-primary">EMPLEADO</span>
                                @endif
                            </td>
                            <td>
                                @if($user->status === 'activo')
                                    <span class="badge bg-success">ACTIVO</span>
                                @else
                                    <span class="badge bg-secondary">INACTIVO</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('users.edit', $user) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('users.toggle', $user) }}"
                                      method="POST">
                                    @csrf
                                    @method('POST') <!-- Asegúrate que tu ruta usa POST -->
                                    <button class="btn btn-dark btn-sm">
                                        <i class="bi bi-power"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No hay usuarios
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection