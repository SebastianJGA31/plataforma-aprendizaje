<div class="card shadow h-100">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Datos académicos</h5>
    </div>
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr>
                <th class="text-muted" style="width:40%">Rol</th>
                <td>{{ $user->role->nombre ?? '—' }}</td>
            </tr>
            <tr>
                <th class="text-muted">Número de control</th>
                <td>{{ $user->numero_control ?? '—' }}</td>
            </tr>
            <tr>
                <th class="text-muted">Carrera</th>
                <td>{{ $user->carrera->nombre ?? 'No asignada' }}</td>
            </tr>
            <tr>
                <th class="text-muted">Semestre</th>
                <td>{{ $user->semestre ?? '—' }}</td>
            </tr>
            <tr>
                <th class="text-muted">Teléfono</th>
                <td>{{ $user->telefono ?? '—' }}</td>
            </tr>
            <tr>
                <th class="text-muted">Correo</th>
                <td>{{ $user->email }}</td>
            </tr>
        </table>
        <p class="text-muted small mt-3 mb-0">
            Para modificar carrera, rol u otros datos académicos, contacta al administrador.
        </p>
    </div>
</div>
