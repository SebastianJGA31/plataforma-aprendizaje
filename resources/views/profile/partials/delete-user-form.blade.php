<p class="text-muted">
    Al eliminar tu cuenta se borrarán permanentemente tus datos. Esta acción no se puede deshacer.
</p>

<form method="post" action="{{ route('profile.destroy') }}" class="mt-3"
    onsubmit="return confirm('¿Estás seguro de eliminar tu cuenta?')">
    @csrf
    @method('delete')

    <div class="mb-3">
        <label for="password" class="form-label">Confirma tu contraseña</label>
        <input id="password" name="password" type="password"
            class="form-control @error('password', 'userDeletion') is-invalid @enderror" required>
        @error('password', 'userDeletion')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-danger">Eliminar cuenta</button>
</form>
