<x-app-layout>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h4>

                Inscripción al Curso

            </h4>

        </div>

        <div class="card-body">

            <h5>

                {{ $curso->titulo }}

            </h5>

            <p>

                {{ $curso->descripcion }}

            </p>
            @if(session('error'))

<div class="alert alert-danger">

    {{ session('error') }}

</div>

@endif

            <hr>
            

            <form
                action="{{ route(
                    'alumno.inscripciones.store',
                    $curso
                ) }}"
                method="POST">

                @csrf

                <div class="mb-3">

                    <label>

                        Motivo

                    </label>

                    <textarea
                        name="motivo"
                        rows="4"
                        class="form-control"
                        required></textarea>

                </div>

                <div class="mb-3">

                    <label>

                        Experiencia Previa

                    </label>

                    <textarea
                        name="experiencia"
                        rows="4"
                        class="form-control"></textarea>

                </div>

                <button
                    class="btn btn-success">

                    Enviar Solicitud

                </button>

            </form>

        </div>

    </div>

</div>

</x-app-layout>