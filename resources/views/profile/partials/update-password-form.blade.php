<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="mb-3">
        <label for="update_password_current_password" class="form-label">Contraseña actual</label>
        <input id="update_password_current_password" name="current_password" type="password"
            class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
        @error('current_password', 'updatePassword')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="update_password_password" class="form-label">Nueva contraseña</label>
        <input id="update_password_password" name="password" type="password"
            class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
        @error('password', 'updatePassword')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="update_password_password_confirmation" class="form-label">Confirmar contraseña</label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
            class="form-control" autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-warning">Actualizar contraseña</button>
</form>
