<x-app-layout>

    <div class="container mt-4">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                <h4>Editar Curso</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('cursos.update', $curso) }}" method="POST"  enctype="multipart/form-data">>
                    @csrf
                    @method('PUT')

                    {{-- Título --}}
                    <div class="mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" name="titulo" value="{{ old('titulo', $curso->titulo) }}" class="form-control @error('titulo') is-invalid @enderror">
                        @error('titulo')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">

    <label class="form-label">

        Imagen Actual

    </label>

    <br>

    @if($curso->imagen)

        <img
            src="{{ asset('storage/'.$curso->imagen) }}"
            width="250"
            class="mb-3 rounded border">

    @else

        <p class="text-muted">

            Este curso no tiene imagen.

        </p>

    @endif

</div>

<div class="mb-3">

    <label class="form-label">

        Cambiar Imagen

    </label>

    <input
        type="file"
        name="imagen"
        class="form-control"
        accept="image/*">

</div>

                    {{-- Descripción --}}
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="4">{{ old('descripcion', $curso->descripcion) }}</textarea>
                        @error('descripcion')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tipo y Modalidad --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tipo</label>
                            <select name="tipo" class="form-select @error('tipo') is-invalid @enderror">
                                <option value="">Seleccione un tipo</option>
                                <option value="Curso" {{ old('tipo', $curso->tipo) == 'Curso' ? 'selected' : '' }}>Curso</option>
                                <option value="Taller" {{ old('tipo', $curso->tipo) == 'Taller' ? 'selected' : '' }}>Taller</option>
                                <option value="Conferencia" {{ old('tipo', $curso->tipo) == 'Conferencia' ? 'selected' : '' }}>Conferencia</option>
                                <option value="Webinar" {{ old('tipo', $curso->tipo) == 'Webinar' ? 'selected' : '' }}>Webinar</option>
                            </select>
                            @error('tipo')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Modalidad</label>
                            <select name="modalidad" class="form-select @error('modalidad') is-invalid @enderror">
                                <option value="">Seleccione una modalidad</option>
                                <option value="Presencial" {{ old('modalidad', $curso->modalidad) == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                <option value="Virtual" {{ old('modalidad', $curso->modalidad) == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                                <option value="Hibrida" {{ old('modalidad', $curso->modalidad) == 'Hibrida' ? 'selected' : '' }}>Hibrida</option>
                            </select>
                            @error('modalidad')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tipo de Origen y Lugar --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tipo de Origen</label>
                            <select name="tipo_origen" class="form-select">
                                <option value="Interno" {{ old('tipo_origen', $curso->tipo_origen) == 'Interno' ? 'selected' : '' }}>Interno</option>
                                <option value="Externo" {{ old('tipo_origen', $curso->tipo_origen) == 'Externo' ? 'selected' : '' }}>Externo</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Lugar</label>
                            <input type="text" name="lugar" value="{{ old('lugar', $curso->lugar) }}" class="form-control @error('lugar') is-invalid @enderror" placeholder="Ejemplo: Aula B3">
                            @error('lugar')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Enlace Externo --}}
                    <div class="mb-3">
                        <label class="form-label">Enlace Externo</label>
                        <input type="url" name="enlace_externo" value="{{ old('enlace_externo', $curso->enlace_externo) }}" class="form-control" placeholder="https://...">
                    </div>

                    {{-- Checkboxes de Ajustes --}}
                    <div class="mb-4">
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" name="requiere_aprobacion" value="1" {{ old('requiere_aprobacion', $curso->requiere_aprobacion) ? 'checked' : '' }}>
                            <label class="form-check-label">Requiere aprobación del maestro</label>
                        </div>

                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" name="permite_resenas" value="1" {{ old('permite_resenas', $curso->permite_resenas) ? 'checked' : '' }}>
                            <label class="form-check-label">Permitir reseñas</label>
                        </div>

                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" name="todas_las_carreras" value="1" {{ old('todas_las_carreras', $curso->todas_las_carreras) ? 'checked' : '' }}>
                            <label class="form-check-label">Disponible para todas las carreras</label>
                        </div>
                    </div>

                    <hr>

                    {{-- Lista de Carreras M2M --}}
                    <div class="mb-4">
                        <h5 class="mb-3">Carreras Permitidas</h5>
                        @foreach($carreras as $carrera)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="carreras[]" value="{{ $carrera->id }}" 
                                    {{ in_array($carrera->id, old('carreras', $curso->carreras->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    {{ $carrera->nombre }}
                                </label>
                            </div>
                        @endforeach
                        
                        @error('todas_las_carreras')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    {{-- Instructor y Cupo Máximo --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Instructor</label>
                            <select name="instructor_id" class="form-select @error('instructor_id') is-invalid @enderror">
                                <option value="">Seleccione un maestro</option>
                                @foreach($maestros as $maestro)
                                    <option value="{{ $maestro->id }}" {{ old('instructor_id', $curso->instructor_id) == $maestro->id ? 'selected' : '' }}>{{ $maestro->name }}</option>
                                @endforeach
                            </select>
                            @error('instructor_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Cupo Máximo</label>
                            <input type="number" name="cupo_maximo" value="{{ old('cupo_maximo', $curso->cupo_maximo) }}" class="form-control @error('cupo_maximo') is-invalid @enderror">
                            @error('cupo_maximo')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Estado y Fechas --}}
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select @error('estado') is-invalid @enderror">
                                <option value="Activo" {{ old('estado', $curso->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Cerrado" {{ old('estado', $curso->estado) == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                                <option value="Finalizado" {{ old('estado', $curso->estado) == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                                <option value="Cancelado" {{ old('estado', $curso->estado) == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                            @error('estado')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $curso->fecha_inicio ? \Carbon\Carbon::parse($curso->fecha_inicio)->format('Y-m-d') : '') }}" class="form-control @error('fecha_inicio') is-invalid @enderror">
                            @error('fecha_inicio')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Fecha Fin</label>
                            <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $curso->fecha_fin ? \Carbon\Carbon::parse($curso->fecha_fin)->format('Y-m-d') : '') }}" class="form-control @error('fecha_fin') is-invalid @enderror">
                            @error('fecha_fin')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Botones de acción --}}
                    <div class="mt-4">
                        <button class="btn btn-success me-2">Actualizar Curso</button>
                        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

</x-app-layout>