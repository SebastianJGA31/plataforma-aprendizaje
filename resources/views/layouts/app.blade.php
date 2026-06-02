<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>

@include('layouts.partials.navbar-institucional')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 bg-dark text-white min-vh-100">
            <div class="p-3">
                <h4>Plataforma</h4>
                <hr>
                <p>{{ Auth::user()->name }}</p>
                <small>{{ Auth::user()->role->nombre }}</small>
                <hr>

                <ul class="nav flex-column">

                @if(Auth::user()->role->nombre == 'Administrador')
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                            📊 Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('usuarios.index') }}" class="nav-link text-white">
                            👥 Usuarios
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('cursos.index') }}" class="nav-link text-white">
                            📚 Cursos
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('carreras.index') }}" class="nav-link text-white">
                            🎓 Carreras
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.inscripciones.index') }}" class="nav-link text-white">
                            📝 Inscripciones
                        </a>
                    </li>
                @endif

                @if(Auth::user()->role->nombre == 'Maestro')
                    <li class="nav-item mb-2">
                        <a href="{{ route('maestro.dashboard') }}" class="nav-link text-white">
                            📊 Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('maestro.cursos.index') }}" class="nav-link text-white">
                            📚 Mis Cursos
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('maestro.inscripciones.index') }}" class="nav-link text-white">
                            📝 Inscripciones
                        </a>
                    </li>
                @endif

                @if(Auth::user()->role->nombre == 'Alumno')
                    <li class="nav-item mb-2">
                        <a href="{{ route('alumno.dashboard') }}" class="nav-link text-white">
                            📊 Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('alumno.cursos') }}" class="nav-link text-white">
                            📚 Cursos Disponibles
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route(
'alumno.inscripciones.index'
) }}" class="nav-link text-white">
                            🎓 Mis Inscripciones
                        </a>
                    </li>
                @endif

                    <li class="nav-item mb-2">
                        <a href="{{ route('profile.edit') }}" class="nav-link text-white">
                            👤 Perfil
                        </a>
                    </li>

                    <li class="nav-item mt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-danger w-100">
                                Cerrar Sesión
                            </button>
                        </form>
                    </li>

                </ul>
                </div>
        </div>

        <div class="col-md-10">
            <div class="p-4">
                {{ $slot }}
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>