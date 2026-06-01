<x-app-layout>

<div class="container mt-4">

    <h2>

        Cursos Disponibles

    </h2>

    <div class="row">

        @forelse($cursos as $curso)

        <div class="col-md-4 mb-4">

            <div class="card shadow">

                <div class="card-body">

                    <h5>

                        {{ $curso->titulo }}

                    </h5>

                    <p>

                        {{ $curso->descripcion }}

                    </p>

                    <p>

                        <strong>
                            Instructor:
                        </strong>

                        {{ $curso->instructor->name }}

                    </p>

                    <a href="#"
                       class="btn btn-primary">

                        Ver Detalles

                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="alert alert-info">

            No hay cursos
            disponibles.

        </div>

        @endforelse

    </div>

</div>

</x-app-layout>