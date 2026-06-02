<x-app-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestión de Cursos</h2>
            <a href="{{ route('cursos.create') }}" class="btn btn-primary">
                Nuevo Curso
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <form method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control" placeholder="Buscar curso">
                        </div>

                        <div class="col-md-2">
                            <select name="tipo" class="form-select">
                                <option value="">Todos los tipos</option>
                                <option value="Curso" {{ request('tipo') == 'Curso' ? 'selected' : '' }}>Curso</option>
                                <option value="Taller" {{ request('tipo') == 'Taller' ? 'selected' : '' }}>Taller</option>
                                <option value="Conferencia" {{ request('tipo') == 'Conferencia' ? 'selected' : '' }}>Conferencia</option>
                                <option value="Webinar" {{ request('tipo') == 'Webinar' ? 'selected' : '' }}>Webinar</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select name="modalidad" class="form-select">
                                <option value="">Todas modalidades</option>
                                <option value="Presencial" {{ request('modalidad') == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                <option value="Virtual" {{ request('modalidad') == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                                <option value="Hibrida" {{ request('modalidad') == 'Hibrida' ? 'selected' : '' }}>Híbrida</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select name="estado" class="form-select">
                                <option value="">Todos estados</option>
                                <option value="Activo" {{ request('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Cerrado" {{ request('estado') == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                                <option value="Finalizado" {{ request('estado') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                                <option value="Cancelado" {{ request('estado') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </div>

                        <div class="col-md-1">
                            <button class="btn btn-primary w-100">Buscar</button>
                        </div>

                        <div class="col-md-2">
                            <a href="{{ route('cursos.index') }}" class="btn btn-secondary w-100">Limpiar</a>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Modalidad</th>
                            <th>Carreras</th>
                            <th>Instructor</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cursos as $curso)
                            <tr>
                                <td>{{ $curso->id }}</td>
                                <td>{{ $curso->titulo }}</td>
                                <td>{{ $curso->tipo }}</td>
                                <td>{{ $curso->modalidad }}</td>
                                <td>
                                    @if($curso->todas_las_carreras)
                                        <span class="badge bg-success">Todas las carreras</span>
                                    @else
                                        @foreach($curso->carreras as $carrera)
                                            <span class="badge bg-primary">{{ $carrera->nombre }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $curso->instructor->name }}</td>
                                <td>
                                    @if($curso->estado == 'Activo')
                                        <span class="badge bg-success">Activo</span>
                                    @elseif($curso->estado == 'Cerrado')
                                        <span class="badge bg-warning text-dark">Cerrado</span>
                                    @elseif($curso->estado == 'Finalizado')
                                        <span class="badge bg-secondary">Finalizado</span>
                                    @else
                                        <span class="badge bg-danger">Cancelado</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('cursos.show', $curso) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-warning btn-sm">Editar</a>
                                    
                                    <form action="{{ route('cursos.destroy', $curso) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar curso?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No hay cursos registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $cursos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>