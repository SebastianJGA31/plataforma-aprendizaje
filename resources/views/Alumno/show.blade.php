<x-app-layout>

<div class="container">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h3>

                {{ $curso->titulo }}

            </h3>

        </div>

        <div class="card-body">

            <div class="row">
@if($curso->imagen)

<img
    src="{{ asset(
        'storage/'.$curso->imagen
    ) }}"
    class="img-fluid rounded mb-3">

@endif
                <div class="col-md-8">

                    <h5>

                        Descripción

                    </h5>

                    <p>

                        {{ $curso->descripcion }}

                    </p>

                </div>

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <p>

                                <strong>
                                    Instructor:
                                </strong>

                                {{ $curso->instructor->name }}

                            </p>

                            <p>

                                <strong>
                                    Tipo:
                                </strong>

                                {{ $curso->tipo }}

                            </p>

                            <p>

                                <strong>
                                    Modalidad:
                                </strong>

                                {{ $curso->modalidad }}

                            </p>

                            <p>

                                <strong>
                                    Cupo:
                                </strong>

                                {{ $curso->cupo_maximo }}

                            </p>

                            <p>

                                <strong>
                                    Inicio:
                                </strong>

                                {{ $curso->fecha_inicio }}

                            </p>

                            <p>

                                <strong>
                                    Fin:
                                </strong>

                                {{ $curso->fecha_fin }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <hr>

            <h5>

                Carreras Permitidas

            </h5>

            @if($curso->todas_las_carreras)

                <span
                    class="badge bg-success">

                    Todas las carreras

                </span>

            @else

                @foreach(
                    $curso->carreras
                    as $carrera
                )

                    <span
                        class="badge bg-primary">

                        {{ $carrera->nombre }}

                    </span>

                @endforeach

            @endif

            <hr>

            @php

                $inscrito = $curso
                    ->inscripciones()
                    ->where(
                        'alumno_id',
                        auth()->id()
                    )
                    ->exists();

            @endphp

            @if($inscrito)

                <button
                    class="btn btn-secondary"
                    disabled>

                    Ya inscrito

                </button>

            @else

                <a
                    href="{{ route(
                        'alumno.inscripciones.create',
                        $curso
                    ) }}"
                    class="btn btn-success">

                    Inscribirme

                </a>

            @endif

            <a
                href="{{ url()->previous() }}"
                class="btn btn-outline-secondary">

                Regresar

            </a>

        </div>

    </div>

</div>

</x-app-layout>