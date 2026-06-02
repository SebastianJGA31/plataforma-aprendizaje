<x-app-layout>
    <div class="container mt-4">
        <h2 class="mb-4">Mi Perfil</h2>

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success">Perfil actualizado correctamente.</div>
        @endif

        @if (session('status') === 'password-updated')
            <div class="alert alert-success">Contraseña actualizada correctamente.</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-6">
                @include('profile.partials.academic-information')
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Información personal</h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0">Cambiar contraseña</h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow border-danger mb-4">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">Eliminar cuenta</h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
