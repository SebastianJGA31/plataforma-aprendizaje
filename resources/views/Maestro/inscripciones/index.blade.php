<x-app-layout>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container mt-4">
        <h2>Inscripciones de Mis Cursos</h2>

        <form method="GET" class="mb-3 mt-3">
            <div class="row">
                <div class="col-md-4">
                    <select name="curso" class="form-select">
                        <option value="">Todos mis cursos</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->id }}" {{ request('curso') == $curso->id ? 'selected' : '' }}>
                                {{ $curso->titulo }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="estado" class="form-select">
                        <option value="">Todos los estados</option>
                        @foreach(['Pendiente', 'Aprobado', 'Rechazado', 'Lista Espera', 'Baja'] as $estado)
                            <option value="{{ $estado }}" {{ request('estado') == $estado ? 'selected' : '' }}>
                                {{ $estado }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Filtrar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('maestro.inscripciones.index') }}" class="btn btn-secondary w-100">Limpiar</a>
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
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inscripciones as $inscripcion)
                            <tr>
                                <td>{{ $inscripcion->alumno->name }}</td>
                                <td>{{ $inscripcion->curso->titulo }}</td>
                                <td>
                                    @if($inscripcion->estado == 'Pendiente')
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    @elseif($inscripcion->estado == 'Lista Espera')
                                        <span class="badge bg-secondary">Lista de Espera</span>
                                    @elseif($inscripcion->estado == 'Aprobado')
                                        <span class="badge bg-success">Aprobado</span>
                                    @elseif($inscripcion->estado == 'Baja')
                                        <span class="badge bg-dark">Baja</span>
                                    @else
                                        <span class="badge bg-danger">Rechazado</span>
                                    @endif
                                </td>
                                <td>{{ $inscripcion->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @if($inscripcion->estado == 'Pendiente')
                                        <form action="{{ route('maestro.inscripciones.aprobar', $inscripcion) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-success btn-sm">Aprobar</button>
                                        </form>
                                        <form action="{{ route('maestro.inscripciones.rechazar', $inscripcion) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-danger btn-sm">Rechazar</button>
                                        </form>
                                    @elseif($inscripcion->estado == 'Lista Espera')
                                        <form action="{{ route('maestro.inscripciones.rechazar', $inscripcion) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-danger btn-sm">Rechazar</button>
                                        </form>
                                    @elseif($inscripcion->estado == 'Aprobado')
                                        <form action="{{ route('maestro.inscripciones.baja', $inscripcion) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-warning btn-sm">Dar Baja</button>
                                        </form>
                                    @else
                                        <span class="text-muted">Sin acciones</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay inscripciones registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $inscripciones->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
