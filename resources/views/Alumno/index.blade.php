<x-app-layout>
    <div class="container mt-4">
        <h2>Cursos Disponibles</h2>

        <div class="row mt-3">
            @forelse($cursos as $curso)
                @php
                    $cuposDisponibles = max(0, $curso->cupo_maximo - $curso->aprobados_count);
                @endphp
                <div class="col-md-4 mb-4">
                    <div class="card shadow h-100">
                        @if($curso->imagen)
                            <img src="{{ asset('storage/'.$curso->imagen) }}" class="card-img-top"
                                style="height:220px; object-fit:cover;" alt="{{ $curso->titulo }}">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                style="height:220px;">
                                <span>Sin imagen</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $curso->titulo }}</h5>
                            <p class="text-muted">{{ Str::limit($curso->descripcion, 100) }}</p>

                            <div class="mb-2">
                                <span class="badge bg-primary">{{ $curso->tipo }}</span>
                                <span class="badge bg-info">{{ $curso->modalidad }}</span>
                            </div>

                            <p><strong>Instructor:</strong> {{ $curso->instructor->name }}</p>
                            <p><strong>Cupo total:</strong> {{ $curso->cupo_maximo }}</p>
                            <p>
                                <strong>Cupos disponibles:</strong>
                                @if($cuposDisponibles > 0)
                                    <span class="badge bg-success">{{ $cuposDisponibles }}</span>
                                @else
                                    <span class="badge bg-danger">Lleno — Lista de espera</span>
                                @endif
                            </p>
                            <p><strong>Inicio:</strong> {{ $curso->fecha_inicio }}</p>
                        </div>

                        <div class="card-footer bg-white">
                            <a href="{{ route('alumno.cursos.show', $curso) }}" class="btn btn-primary">Detalles</a>

                            @php
                                $inscrito = $curso->inscripciones()
                                    ->where('alumno_id', auth()->id())
                                    ->whereIn('estado', \App\Models\Inscripcion::ESTADOS_ACTIVOS)
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
                    <div class="alert alert-info">No hay cursos disponibles para tu carrera.</div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
