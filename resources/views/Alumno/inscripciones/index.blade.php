<x-app-layout>

<div class="container">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h4>

                Mis Inscripciones

            </h4>

        </div>

        <div class="card-body">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            <table
                class="table table-hover">

                <thead>

                    <tr>

                        <th>Curso</th>

                        <th>Estado</th>

                        <th>Fecha</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($inscripciones as $inscripcion)

                    <tr>

                        <td>

                            {{ $inscripcion->curso->titulo }}

                        </td>

                        <td>

                            @if($inscripcion->estado == 'Aprobado')

                                <span
                                    class="badge bg-success">

                                    Aprobado

                                </span>

                            @elseif($inscripcion->estado == 'Pendiente')

                                <span
                                    class="badge bg-warning text-dark">

                                    Pendiente

                                </span>

                            @elseif($inscripcion->estado == 'Lista Espera')

                                <span class="badge bg-info">Lista Espera</span>

                            @elseif($inscripcion->estado == 'Baja')

                                <span class="badge bg-dark">Baja</span>

                            @elseif($inscripcion->estado == 'Rechazado')

                                <span class="badge bg-danger">Rechazado</span>

                            @else

                                <span class="badge bg-secondary">{{ $inscripcion->estado }}</span>

                            @endif

                        </td>

                        <td>

                            {{ $inscripcion->fecha_inscripcion }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3">

                            No tienes inscripciones.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            {{ $inscripciones->links() }}

        </div>

    </div>

</div>

</x-app-layout>