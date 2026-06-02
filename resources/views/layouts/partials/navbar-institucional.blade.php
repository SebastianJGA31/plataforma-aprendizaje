{{-- ═══════════════════════════════════════════════════════════════════
     Navbar Institucional — Instituto Tecnológico de Ciudad Victoria
     Incluir con: @include('layouts.partials.navbar-institucional')
     Aparece en: app.blade.php (páginas internas) y guest.blade.php (auth)
════════════════════════════════════════════════════════════════════ --}}
<nav style="
    background-color: #8B1A1A;
    border-bottom: 3px solid #FFD700;
    padding: 0.4rem 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
">
    {{-- Lado izquierdo: logos institucionales --}}
    <div class="d-flex align-items-center gap-2">
        <img src="{{ asset('assets/img/itcv.png') }}"
             alt="Escudo ITCV"
             style="height:44px; width:auto; object-fit:contain;">
        <img src="{{ asset('assets/img/Aguila_ITCV.jpg') }}"
             alt="Águila TecNM"
             style="height:44px; width:auto; object-fit:contain; border-radius:4px;">
    </div>

    {{-- Lado derecho: nombre institucional como enlace --}}
    <div>
        <a href="https://www.itvictoria.edu.mx/"
           target="_blank"
           rel="noopener noreferrer"
           style="
               color: #FFD700;
               text-decoration: none;
               font-size: 1rem;
               font-weight: 600;
               letter-spacing: 0.02em;
               transition: color 0.2s;
           "
           onmouseover="this.style.color='#fff'"
           onmouseout="this.style.color='#FFD700'">
            Instituto Tecnológico de Ciudad Victoria
        </a>
    </div>
</nav>
