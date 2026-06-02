<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">{{ config('app.name') }}</a>
        <div class="ms-auto">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-outline-light btn-sm">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Registrarse</a>
            @endauth
        </div>
    </div>
</nav>

<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="display-5 fw-bold mb-3">Plataforma de Aprendizaje y Gestión de Cursos</h1>
                <p class="lead mb-4">
                    Sistema universitario para administrar cursos, inscripciones y usuarios
                    por rol: Administrador, Maestro y Alumno.
                </p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg me-2">Soy alumno — Registrarme</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Iniciar sesión</a>
                @endguest
            </div>
            <div class="col-lg-5 text-center mt-4 mt-lg-0">
                <img src="{{ asset('assets/img/itcv.jpg') }}" alt="Institución" class="img-fluid rounded shadow" style="max-height:280px;">
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">¿Qué puedes hacer?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center p-4">
                        <div class="display-6 mb-3">👨‍💼</div>
                        <h5 class="card-title">Administrador</h5>
                        <p class="card-text text-muted">
                            Gestiona usuarios, carreras, cursos e inscripciones del sistema completo.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center p-4">
                        <div class="display-6 mb-3">👨‍🏫</div>
                        <h5 class="card-title">Maestro</h5>
                        <p class="card-text text-muted">
                            Administra tus cursos, aprueba inscripciones y da seguimiento a tus alumnos.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center p-4">
                        <div class="display-6 mb-3">🎓</div>
                        <h5 class="card-title">Alumno</h5>
                        <p class="card-text text-muted">
                            Consulta cursos de tu carrera, inscríbete y revisa el estado de tus solicitudes.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        <small>{{ config('app.name') }} &copy; {{ date('Y') }}</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
