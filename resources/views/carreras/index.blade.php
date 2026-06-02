<x-app-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestión de Carreras</h2>
            <a href="{{ route('carreras.create') }}" class="btn btn-primary">Nueva Carrera</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control" placeholder="Buscar carrera">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Buscar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('carreras.index') }}" class="btn btn-secondary w-100">Limpiar</a>
                </div>
            </div>
        </form>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Alumnos</th>
                            <th>Cursos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($carreras as $carrera)
                            <tr>
                                <td>{{ $carrera->id }}</td>
                                <td>{{ $carrera->nombre }}</td>
                                <td>{{ $carrera->users_count }}</td>
                                <td>{{ $carrera->cursos_count }}</td>
                                <td>
                                    <a href="{{ route('carreras.edit', $carrera) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('carreras.destroy', $carrera) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar carrera?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted">No hay carreras registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $carreras->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
