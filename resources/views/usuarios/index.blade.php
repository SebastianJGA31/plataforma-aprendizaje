<x-app-layout>

    <div class="container mt-4">

        <div
            class="d-flex
               justify-content-between
               align-items-center
               mb-3">

            <h2>

                Usuarios

            </h2>

            <p class="text-muted">

    Total de usuarios:
    {{ $usuarios->count() }}

</p>

            <a
                href="{{ route('usuarios.create') }}"
                class="btn btn-primary">

                Nuevo Usuario

            </a>

        </div>

        @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

        @endif

        <form method="GET" class="mb-3">

            <div class="row">

                <div class="col-md-5">

                    <input
                        type="text"
                        name="buscar"
                        value="{{ request('buscar') }}"
                        class="form-control"
                        placeholder="Buscar usuario por nombre">

                </div>

                <div class="col-md-3">

                    <select
                        name="rol"
                        class="form-select">

                        <option value="">

                            Todos los roles

                        </option>

                        @foreach($roles as $rol)

                        <option
                            value="{{ $rol->id }}"
                            {{ request('rol') == $rol->id ? 'selected' : '' }}>

                            {{ $rol->nombre }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2">

                    <button
                        class="btn btn-primary w-100">

                        Buscar

                    </button>

                </div>

                <div class="col-md-2">

                    <a
                        href="{{ route('usuarios.index') }}"
                        class="btn btn-secondary w-100">

                        Limpiar

                    </a>

                </div>

            </div>

        </form>

        <div class="card shadow">

           <div class="card-body">

    <div class="table-responsive">

                <table
                    class="table table-hover">

                    <thead
                        class="table-dark">

                        <tr>

                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Número Control</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Carrera</th>
                            <th>Semestre</th>
                            <th>Teléfono</th>
                            <th>Creado</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($usuarios as $usuario)

                        <tr>

                            <td>

                                {{ $usuario->id }}

                            </td>

                            <td>

                                {{ $usuario->name }}

                            </td>

                            <td>

                                {{ $usuario->numero_control }}

                            </td>
                            <td>{{ $usuario->email }}</td>

                            <td>

                                @if($usuario->role->nombre == 'Administrador')

                                <span class="badge bg-danger">
                                    Administrador
                                </span>

                                @elseif($usuario->role->nombre == 'Maestro')

                                <span class="badge bg-warning text-dark">
                                    Maestro
                                </span>

                                @else

                                <span class="badge bg-primary">
                                    Alumno
                                </span>

                                @endif

                            </td>

                            <td>

                                {{ $usuario->carrera?->nombre }}

                            </td>

                            <td>{{ $usuario->semestre }}</td>

<td>{{ $usuario->telefono }}</td>

<td>

    {{ $usuario->created_at->format('d/m/Y') }}

</td>

                            <td>
                                <a href="{{ route('usuarios.show',$usuario) }}"
                                    class="btn btn-info btn-sm">
                                    Ver
                                </a>

                                <a
                                    href="{{ route('usuarios.edit',$usuario) }}"
                                    class="btn btn-warning btn-sm">

                                    Editar

                                </a>

                                <form
                                    action="{{ route('usuarios.destroy',$usuario) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar usuario?')">

                                        Eliminar

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>    
</div>

</x-app-layout>