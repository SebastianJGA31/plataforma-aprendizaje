<x-app-layout>
    <div class="container mt-4">
        <h2>Cursos Disponibles</h2>

        <div class="row">
            @forelse($cursos as $curso)
                <div class="col-md-4 mb-4"> <div class="card shadow h-100">
                        <div class="card-body">

                        @if($curso->imagen)

<img
    src="{{ asset(
        'storage/'.$curso->imagen
    ) }}"
    class="card-img-top"
    style="
        height:220px;
        object-fit:cover;
    ">

@endif
                            <h5 class="card-title">{{ $curso->titulo }}</h5>
                            
                            <p class="text-muted">
                                {{ Str::limit($curso->descripcion, 100) }}
                            </p>

                            <div class="mb-2">
                                <span class="badge bg-primary">{{ $curso->tipo }}</span>
                                <span class="badge bg-info">{{ $curso->modalidad }}</span>
                            </div>

                            <div class="mb-2">
                                @if($curso->estado == 'Activo')
                                    <span class="badge bg-success">Activo</span>
                                @elseif($curso->estado == 'Cerrado')
                                    <span class="badge bg-warning text-dark">Cerrado</span>
                                @elseif($curso->estado == 'Finalizado')
                                    <span class="badge bg-secondary">Finalizado</span>
                                @else
                                    <span class="badge bg-danger">Cancelado</span>
                                @endif
                            </div>

                            <p><strong>Instructor:</strong> {{ $curso->instructor->name }}</p>
                            <p><strong>Cupo:</strong> {{ $curso->cupo_maximo }}</p>
                            <p><strong>Inicio:</strong> {{ $curso->fecha_inicio }}</p>
                        </div>

                        <div class="card-footer bg-white">
                            <a href="{{ route(
    'alumno.cursos.show',
    $curso
) }}" class="btn btn-primary">Detalles</a>

                            @php
                                $inscrito = $curso->inscripciones()
                                    ->where('alumno_id', auth()->id())
                                    ->exists();
                            @endphp

                            @if($inscrito)
                                <button class="btn btn-secondary" disabled>Ya inscrito</button>
                            @else
                                <a href="{{ route('alumno.inscripciones.create', $curso) }}" class="btn btn-success">
                                    Inscribirme
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No hay cursos disponibles.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>