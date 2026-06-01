<x-app-layout>

    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2>Gestión de Cursos</h2>

            <a href="{{ route('cursos.create') }}"
                class="btn btn-primary">
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

                                <span class="badge bg-success">

                                    Todas las carreras

                                </span>

                                @else

                                @foreach($curso->carreras as $carrera)

                                <span class="badge bg-primary">

                                    {{ $carrera->nombre }}

                                </span>

                                @endforeach

                                @endif

                            </td>
                            <td>{{ $curso->instructor->name }}</td>
                        

                            <td>

                                <span class="badge bg-success">
                                    {{ $curso->estado }}
                                </span>

                            </td>

                            <td>

                                <a href="{{ route('cursos.show',$curso) }}"
                                    class="btn btn-info btn-sm">
                                    Ver
                                </a>

                                <a href="{{ route('cursos.edit',$curso) }}"
                                    class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <form
                                    action="{{ route('cursos.destroy',$curso) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar curso?')">

                                        Eliminar

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6"
                                class="text-center">

                                No hay cursos registrados

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>