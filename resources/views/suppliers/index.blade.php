@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold">

            🚚 Proveedores

        </h2>

        <p class="text-muted">

            Gestión de proveedores

        </p>

    </div>

    <a href="{{ route('suppliers.create') }}"
       class="btn btn-primary">

        ➕ Nuevo proveedor

    </a>

</div>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($suppliers as $supplier)

                        <tr>

                            <td>{{ $supplier->name }}</td>

                            <td>{{ $supplier->phone }}</td>

                            <td>{{ $supplier->email }}</td>

                            <td>{{ $supplier->address }}</td>

                            <td class="d-flex gap-2">

                                <a href="{{ route('suppliers.edit',$supplier) }}"
                                   class="btn btn-warning btn-sm">

                                    ✏️

                                </a>

                                <form action="{{ route('suppliers.destroy',$supplier) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">

                                        🗑️

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="text-center">

                                No hay proveedores

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection