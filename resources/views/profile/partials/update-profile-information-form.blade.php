<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $user->name) }}" required autofocus>
        @error('name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $user->email) }}" required>
        @error('email')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <p class="text-muted small mt-2">
                Tu correo no está verificado.
                <button form="send-verification" class="btn btn-link btn-sm p-0">Reenviar verificación</button>
            </p>
            @if (session('status') === 'verification-link-sent')
                <p class="text-success small">Se envió un nuevo enlace de verificación.</p>
            @endif
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
</form>
