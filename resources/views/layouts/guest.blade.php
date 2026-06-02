<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Plataforma ITCV') }}</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        {{-- Vite: mantiene los estilos y scripts de Breeze compilados --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background-color: #f0f2f5;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
            .guest-content {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2.5rem 1rem;
            }
            .guest-card {
                width: 100%;
                max-width: 460px;
                background: #fff;
                border: none;
                border-radius: 12px;
                box-shadow: 0 6px 32px rgba(0,0,0,0.11);
                padding: 2rem 2.2rem;
            }
        </style>
    </head>
    <body>

        @include('layouts.partials.navbar-institucional')

        <div class="guest-content">
            <div class="guest-card">
                {{ $slot }}
            </div>
        </div>

        <footer class="text-center py-2"
                style="background:#8B1A1A; color:rgba(255,255,255,0.6); font-size:0.78rem;">
            Instituto Tecnológico de Ciudad Victoria &copy; {{ date('Y') }}
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
