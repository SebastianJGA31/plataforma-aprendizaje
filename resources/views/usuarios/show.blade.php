<x-app-layout>
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h4>Detalles del Usuario: {{ $usuario->name }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-muted">Nombre Completo</label>
                    <input type="text" class="form-control-plaintext border-bottom fs-5 ps-2" value="{{ $usuario->name }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-muted">Número de Control</label>
                    <input type="text" class="form-control-plaintext border-bottom fs-5 ps-2" value="{{ $usuario->numero_control ?? 'N/A' }}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold text-muted">Correo Electrónico</label>
                    <input type="email" class="form-control-plaintext border-bottom fs-5 ps-2" value="{{ $usuario->email }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold text-muted">Contraseña</label>
                    <input type="text" class="form-control-plaintext border-bottom text-muted ps-2" value="******** (Protegida por encriptación)" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="fw-bold text-muted">Rol Asignado</label>
                    <input type="text" class="form-control-plaintext border-bottom fs-5 ps-2" value="{{ $usuario->role->nombre ?? 'Sin Rol' }}" readonly>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="fw-bold text-muted">Carrera</label>
                    <input type="text" class="form-control-plaintext border-bottom fs-5 ps-2" value="{{ $usuario->carrera->nombre ?? 'Ninguna (Es Admin/Maestro)' }}" readonly>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="fw-bold text-muted">Semestre</label>
                    <input type="text" class="form-control-plaintext border-bottom fs-5 ps-2" value="{{ $usuario->semestre ? $usuario->semestre . '° Semestre' : 'N/A' }}" readonly>
                </div>
            </div>

            <div class="mb-4">
                <label class="fw-bold text-muted">Teléfono</label>
                <input type="text" class="form-control-plaintext border-bottom fs-5 ps-2" value="{{ $usuario->telefono ?? 'No registrado' }}" readonly>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning text-white">
                    Editar este usuario
                </a>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                    Volver a la lista
                </a>
            </div>
        </div>
    </div>
</div>
</x-app-layout>