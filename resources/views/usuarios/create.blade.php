<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>Nuevo Usuario</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('usuarios.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre Completo</label>
                            <input
                                type="text"
                                name="name"
                                oninput="this.value=this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ ]/g,'')" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Número de Control</label>
                            <input
                                type="text"
                                name="numero_control"
                                maxlength="8"
                                pattern="[0-9]{8}"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,8)" value="{{ old('numero_control') }}" class="form-control @error('numero_control') is-invalid @enderror">
                            @error('numero_control')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Correo</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Contraseña</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Rol</label>
                            <select id="rol_id" name="rol_id" class="form-select @error('rol_id') is-invalid @enderror">
                                <option value="">Seleccione un Rol</option>
                                @foreach($roles as $rol)
                                <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
                                    {{ $rol->nombre }}
                                </option>
                                @endforeach
                            </select>
                            @error('rol_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Carrera</label>
                            <select name="carrera_id" class="form-select">
                                <option value="">Seleccione (Opcional)</option>
                                @foreach($carreras as $carrera)
                                <option value="{{ $carrera->id }}" {{ old('carrera_id') == $carrera->id ? 'selected' : '' }}>
                                    {{ $carrera->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3"  id="divSemestre">
                            <label>Semestre</label>
                            <input type="number" name="semestre" value="{{ old('semestre') }}" class="form-control @error('semestre') is-invalid @enderror">
                            @error('semestre')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control @error('telefono') is-invalid @enderror">
                        @error('telefono')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-success">Guardar Usuario</button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <script>

function controlarSemestre()
{
    let rol =
        document.getElementById('rol_id');

    let divSemestre =
        document.getElementById('divSemestre');

    if(
        rol.options[rol.selectedIndex]
            .text === 'Alumno'
    )
    {
        divSemestre.style.display =
            'block';
    }
    else
    {
        divSemestre.style.display =
            'none';
    }
}

document.addEventListener(
    'DOMContentLoaded',
    function()
    {
        controlarSemestre();

        document
            .getElementById('rol_id')
            .addEventListener(
                'change',
                controlarSemestre
            );
    }
);

</script>
</x-app-layout>