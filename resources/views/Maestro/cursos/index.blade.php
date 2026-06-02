<x-app-layout>
    <div class="container mt-4">
        <h2 class="mb-4">Mis Cursos</h2>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Curso</th>
                            <th>Estado</th>
                            <th>Cupo</th>
                            <th>Pendientes</th>
                            <th>Aprobados</th>
                            <th>Lista Espera</th>
                            <th>Inicio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cursos as $curso)
                            <tr>
                                <td>{{ $curso->titulo }}</td>
                                <td>
                                    @if($curso->estado == 'Activo')
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $curso->estado }}</span>
                                    @endif
                                </td>
                                <td>{{ $curso->cupo_maximo }}</td>
                                <td>{{ $curso->pendientes_count }}</td>
                                <td>{{ $curso->aprobados_count }}</td>
                                <td>{{ $curso->lista_espera_count }}</td>
                                <td>{{ $curso->fecha_inicio }}</td>
                                <td>
                                    <a href="{{ route('maestro.inscripciones.index') }}" class="btn btn-primary btn-sm">
                                        Ver inscripciones
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-muted">No tienes cursos asignados como instructor.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
