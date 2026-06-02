<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión — Instituto Tecnológico de Ciudad Victoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Navbar institucional ── */
        .navbar-institucional {
            background-color: #8B1A1A;
            border-bottom: 3px solid #FFD700;
            padding: 0.4rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-institucional .brand-link {
            color: #FFD700;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            transition: color 0.2s;
        }
        .navbar-institucional .brand-link:hover {
            color: #fff;
        }
        .navbar-institucional img.logo-img {
            height: 48px;
            width: auto;
            object-fit: contain;
        }

        /* ── Panel izquierdo institucional ── */
        .panel-institucional {
            background: linear-gradient(160deg, #6B0F0F 0%, #8B1A1A 50%, #A52929 100%);
            min-height: calc(100vh - 67px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .panel-institucional::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("{{ asset('assets/img/tec.jpg') }}") center / cover no-repeat;
            opacity: 0.08;
        }
        .panel-institucional .contenido {
            position: relative;
            text-align: center;
        }
        .panel-institucional .logo-escudo {
            width: 110px;
            height: 110px;
            object-fit: contain;
            background: #fff;
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.35);
        }
        .panel-institucional .logo-aguila {
            width: 90px;
            height: 90px;
            object-fit: contain;
            background: #fff;
            border-radius: 50%;
            padding: 6px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.35);
            margin-left: 0.75rem;
        }
        .panel-institucional h1 {
            font-size: 1.6rem;
            font-weight: 700;
            line-height: 1.3;
            color: #FFD700;
            text-shadow: 0 2px 8px rgba(0,0,0,0.4);
            margin-bottom: 0.5rem;
        }
        .panel-institucional .subtitulo {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.85);
            margin-bottom: 1.5rem;
        }
        .divider-gold {
            width: 60px;
            height: 3px;
            background: #FFD700;
            margin: 1rem auto;
            border-radius: 2px;
        }
        .panel-institucional .sistema-label {
            display: inline-block;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,215,0,0.4);
            border-radius: 50px;
            padding: 0.35rem 1.2rem;
            font-size: 0.82rem;
            color: rgba(255,255,255,0.9);
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        /* ── Panel derecho (login) ── */
        .panel-login {
            min-height: calc(100vh - 67px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1.5rem;
            background-color: #f0f2f5;
        }
        .card-login {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 14px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.13);
            overflow: hidden;
        }
        .card-login .card-header-login {
            background: linear-gradient(135deg, #8B1A1A, #A52929);
            padding: 1.5rem 2rem 1.2rem;
            text-align: center;
            color: #fff;
        }
        .card-login .card-header-login h4 {
            font-weight: 700;
            font-size: 1.2rem;
            margin: 0;
        }
        .card-login .card-header-login p {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.8);
            margin: 0.25rem 0 0;
        }
        .card-login .card-body {
            padding: 2rem;
            background: #fff;
        }
        .card-login .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #444;
        }
        .card-login .form-control {
            border-radius: 8px;
            border: 1.5px solid #dde0e5;
            padding: 0.6rem 0.9rem;
            font-size: 0.92rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .card-login .form-control:focus {
            border-color: #8B1A1A;
            box-shadow: 0 0 0 3px rgba(139,26,26,0.12);
            outline: none;
        }
        .btn-ingresar {
            background: linear-gradient(135deg, #8B1A1A, #A52929);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.65rem;
            font-size: 0.95rem;
            width: 100%;
            letter-spacing: 0.03em;
            transition: opacity 0.2s, transform 0.15s;
        }
        .btn-ingresar:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            color: #fff;
        }
        .link-olvide {
            font-size: 0.82rem;
            color: #8B1A1A;
            text-decoration: none;
        }
        .link-olvide:hover {
            text-decoration: underline;
            color: #6B0F0F;
        }
        .form-check-input:checked {
            background-color: #8B1A1A;
            border-color: #8B1A1A;
        }

        /* Responsive: en móvil el panel institucional es solo banner */
        @media (max-width: 991.98px) {
            .panel-institucional {
                min-height: auto;
                padding: 2rem 1.5rem;
            }
            .panel-login {
                min-height: auto;
                padding: 1.5rem 1rem 3rem;
            }
        }
    </style>
</head>
<body>

{{-- ═══════════════════════════════════════════════ --}}
{{-- NAVBAR INSTITUCIONAL                            --}}
{{-- ═══════════════════════════════════════════════ --}}
<nav class="navbar-institucional">
    <div class="d-flex align-items-center gap-2">
        <img src="{{ asset('assets/img/itcv.png') }}"
             alt="Escudo ITCV"
             class="logo-img">
        <img src="{{ asset('assets/img/Aguila_ITCV.jpg') }}"
             alt="Águila TecNM"
             class="logo-img"
             style="border-radius: 4px;">
    </div>
    <div>
        <a href="https://www.itvictoria.edu.mx/"
           target="_blank"
           rel="noopener noreferrer"
           class="brand-link">
            Instituto Tecnológico de Ciudad Victoria
        </a>
    </div>
</nav>

{{-- ═══════════════════════════════════════════════ --}}
{{-- SPLIT SCREEN: INSTITUCIONAL + LOGIN             --}}
{{-- ═══════════════════════════════════════════════ --}}
<div class="flex-grow-1 row g-0">

    {{-- ── PANEL IZQUIERDO: Identidad institucional ── --}}
    <div class="col-lg-5 panel-institucional">
        <div class="contenido">

            {{-- Logos --}}
            <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
                <img src="{{ asset('assets/img/itcv.png') }}"
                     alt="Escudo ITCV"
                     class="logo-escudo">
                <img src="{{ asset('assets/img/Aguila_ITCV.jpg') }}"
                     alt="Águila TecNM"
                     class="logo-aguila">
            </div>

            <h1>Instituto Tecnológico<br>de Ciudad Victoria</h1>
            <div class="divider-gold"></div>
            <p class="subtitulo">Tecnológico Nacional de México</p>
            <span class="sistema-label">Plataforma de Aprendizaje</span>

            <div class="mt-4 d-none d-lg-block">
                <p style="font-size:0.85rem; color:rgba(255,255,255,0.6); margin:0;">
                    Gestión de cursos · Inscripciones · Seguimiento académico
                </p>
            </div>

        </div>
    </div>

    {{-- ── PANEL DERECHO: Formulario de login ── --}}
    <div class="col-lg-7 panel-login">
        <div class="card-login">

            <div class="card-header-login">
                <h4>🔐 Iniciar Sesión</h4>
                <p>Accede con tu correo institucional</p>
            </div>

            <div class="card-body">

                {{-- Mensaje de estado (ej. después de restablecer contraseña) --}}
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Errores de validación --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Correo electrónico --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input id="email"
                               type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               autocomplete="username"
                               placeholder="correo@itvictoria.edu.mx">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Contraseña --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password"
                               type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required
                               autocomplete="current-password"
                               placeholder="••••••••">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Recordarme + Olvidé contraseña --}}
                    <div class="mb-4 d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input id="remember_me"
                                   type="checkbox"
                                   class="form-check-input"
                                   name="remember">
                            <label for="remember_me"
                                   class="form-check-label"
                                   style="font-size:0.85rem;">
                                Recordarme
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="link-olvide">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    {{-- Botón de ingreso --}}
                    <button type="submit" class="btn btn-ingresar">
                        Ingresar al sistema
                    </button>

                </form>

            </div>{{-- /card-body --}}
        </div>{{-- /card-login --}}
    </div>{{-- /col panel-login --}}

</div>{{-- /flex-grow-1 row --}}

<footer class="text-center py-2"
        style="background:#8B1A1A; color:rgba(255,255,255,0.6); font-size:0.78rem;">
    Instituto Tecnológico de Ciudad Victoria &copy; {{ date('Y') }}
    &mdash; Plataforma de Aprendizaje
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
