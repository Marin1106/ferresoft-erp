@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                🚚 Proveedores

            </h2>

            <p class="text-muted mb-0">

                Gestión completa de proveedores

            </p>

        </div>

        <a href="{{ route('suppliers.create') }}"
           class="btn btn-primary shadow-sm">

            ➕ Nuevo proveedor

        </a>

    </div>

    {{-- ALERTA --}}
    @if(session('success'))

        <div class="alert alert-success shadow-sm border-0">

            {{ session('success') }}

        </div>

    @endif

    {{-- CARD --}}
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Nombre</th>

                            <th>Teléfono</th>

                            <th>Email</th>

                            <th>Dirección</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($suppliers as $supplier)

                            <tr>

                                <td>

                                    {{ $supplier->id }}

                                </td>

                                <td class="fw-semibold">

                                    {{ $supplier->name }}

                                </td>

                                <td>

                                    {{ $supplier->phone ?? '—' }}

                                </td>

                                <td>

                                    {{ $supplier->email ?? '—' }}

                                </td>

                                <td>

                                    {{ $supplier->address ?? '—' }}

                                </td>

                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        {{-- EDITAR --}}
                                        <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                           class="btn btn-warning btn-sm">

                                            ✏️ Editar

                                        </a>

                                        {{-- ELIMINAR --}}
                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Eliminar proveedor?')">

                                                🗑️ Eliminar

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center py-4 text-muted">

                                    No hay proveedores registrados

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINACIÓN --}}
            <div class="mt-3">

                {{ $suppliers->links() }}

            </div>

        </div>

    </div>

</div>

@endsection