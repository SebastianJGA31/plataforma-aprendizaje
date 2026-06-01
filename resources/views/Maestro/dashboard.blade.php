<x-app-layout>

<div class="container mt-4">

    <h2 class="mb-4">

        Dashboard Maestro

    </h2>

    <div class="row">

        <div class="col-md-3">

            <div class="card bg-primary text-white">

                <div class="card-body">

                    <h5>

                        Mis Cursos

                    </h5>

                    <h2>

                        {{ $misCursos }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card bg-warning">

                <div class="card-body">

                    <h5>

                        Pendientes

                    </h5>

                    <h2>

                        {{ $pendientes }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card bg-success text-white">

                <div class="card-body">

                    <h5>

                        Aprobados

                    </h5>

                    <h2>

                        {{ $aprobados }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card bg-secondary text-white">

                <div class="card-body">

                    <h5>

                        Lista Espera

                    </h5>

                    <h2>

                        {{ $listaEspera }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow mt-4">

        <div class="card-header">

            Últimas Inscripciones

        </div>

        <div class="card-body">

            <table class="table">

                <thead>

                    <tr>

                        <th>Alumno</th>

                        <th>Curso</th>

                        <th>Estado</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach(
                        $ultimasInscripciones
                        as $inscripcion
                    )

                    <tr>

                        <td>

                            {{ $inscripcion->alumno->name }}

                        </td>

                        <td>

                            {{ $inscripcion->curso->titulo }}

                        </td>

                        <td>

                            {{ $inscripcion->estado }}

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>