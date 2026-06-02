<x-app-layout>
    <div class="container mt-4">
        <h2 class="mb-4">Inscripciones del Sistema</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control" placeholder="Buscar alumno">
                </div>
                <div class="col-md-3">
                    <select name="curso" class="form-select">
                        <option value="">Todos los cursos</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->id }}" {{ request('curso') == $curso->id ? 'selected' : '' }}>
                                {{ $curso->titulo }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="estado" class="form-select">
                        <option value="">Todos los estados</option>
                        @foreach(['Pendiente', 'Aprobado', 'Rechazado', 'Lista Espera', 'Baja'] as $estado)
                            <option value="{{ $estado }}" {{ request('estado') == $estado ? 'selected' : '' }}>
                                {{ $estado }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-primary w-100">Filtrar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.inscripciones.index') }}" class="btn btn-secondary w-100">Limpiar</a>
                </div>
            </div>
        </form>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Alumno</th>
                            <th>Curso</th>
                            <th>Instructor</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inscripciones as $inscripcion)
                            <tr>
                                <td>{{ $inscripcion->alumno->name }}</td>
                                <td>{{ $inscripcion->curso->titulo }}</td>
                                <td>{{ $inscripcion->curso->instructor->name ?? '—' }}</td>
                                <td>
                                    @if($inscripcion->estado == 'Pendiente')
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    @elseif($inscripcion->estado == 'Aprobado')
                                        <span class="badge bg-success">Aprobado</span>
                                    @elseif($inscripcion->estado == 'Lista Espera')
                                        <span class="badge bg-secondary">Lista Espera</span>
                                    @elseif($inscripcion->estado == 'Baja')
                                        <span class="badge bg-dark">Baja</span>
                                    @else
                                        <span class="badge bg-danger">Rechazado</span>
                                    @endif
                                </td>
                                <td>{{ $inscripcion->fecha_inscripcion?->format('d/m/Y') ?? $inscripcion->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted">No hay inscripciones registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $inscripciones->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
