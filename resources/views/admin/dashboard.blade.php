
<x-app-layout>

<div class="container-fluid">

    <h2 class="mb-4">

        Dashboard Administrador

    </h2>

    <div class="row">

        <div class="col-md-3 mb-3">

            <div class="card text-white bg-primary shadow">

                <div class="card-body">

                    <h5>

                        Usuarios

                    </h5>

                    <h2>

                        {{ $totalUsuarios }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card text-white bg-success shadow">

                <div class="card-body">

                    <h5>

                        Alumnos

                    </h5>

                    <h2>

                        {{ $totalAlumnos }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card text-white bg-warning shadow">

                <div class="card-body">

                    <h5>

                        Maestros

                    </h5>

                    <h2>

                        {{ $totalMaestros }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card text-white bg-danger shadow">

                <div class="card-body">

                    <h5>

                        Cursos

                    </h5>

                    <h2>

                        {{ $totalCursos }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header">

                    Últimos Usuarios

                </div>

                <div class="card-body">

                    <table class="table">

                        <thead>

                            <tr>

                                <th>Nombre</th>
                                <th>Correo</th>

                            </tr>

                        </thead>

                        <tbody>

                        @foreach($ultimosUsuarios as $usuario)

                            <tr>

                                <td>

                                    {{ $usuario->name }}

                                </td>

                                <td>

                                    {{ $usuario->email }}

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header">

                    Últimos Cursos

                </div>

                <div class="card-body">

                    <table class="table">

                        <thead>

                            <tr>

                                <th>Título</th>
                                <th>Estado</th>

                            </tr>

                        </thead>

                        <tbody>

                        @foreach($ultimosCursos as $curso)

                            <tr>

                                <td>

                                    {{ $curso->titulo }}

                                </td>

                                <td>

                                    {{ $curso->estado }}

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>