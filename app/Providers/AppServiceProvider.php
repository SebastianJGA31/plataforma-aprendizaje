<?php

namespace App\Providers;

use App\Models\Curso;
use App\Models\Inscripcion;
use App\Policies\CursoPolicy;
use App\Policies\InscripcionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Registro de Policies
        Gate::policy(Curso::class, CursoPolicy::class);
        Gate::policy(Inscripcion::class, InscripcionPolicy::class);
    }
}
