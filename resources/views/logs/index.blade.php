@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold">

                📜 Logs del Sistema

            </h1>

            <p class="text-muted">

                Registro de actividades del sistema

            </p>

        </div>

    </div>

    <div class="card shadow border-0">

        <div class="card-header bg-dark text-white">

            Historial

        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Acción</th>
                        <th>Fecha</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($logs as $log)

                    <tr>

                        <td>

                            {{ $log->id }}

                        </td>

                        <td>

                            {{ $log->action }}

                        </td>

                        <td>

                            {{ $log->created_at }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="3"
                            class="text-center text-muted">

                            No hay logs registrados

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection