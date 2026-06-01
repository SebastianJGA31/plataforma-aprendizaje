<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Inscripcion;

class DashboardController extends Controller
{
    public function index()
    {
        $usuarioId = auth()->id();

        $misCursos = Curso::where(
            'instructor_id',
            $usuarioId
        )->count();

        $pendientes = Inscripcion::whereHas(
            'curso',
            function ($query)
            use ($usuarioId)
            {
                $query->where(
                    'instructor_id',
                    $usuarioId
                );
            }
        )
        ->where(
            'estado',
            'Pendiente'
        )
        ->count();

        $aprobados = Inscripcion::whereHas(
            'curso',
            function ($query)
            use ($usuarioId)
            {
                $query->where(
                    'instructor_id',
                    $usuarioId
                );
            }
        )
        ->where(
            'estado',
            'Aprobado'
        )
        ->count();

        $listaEspera = Inscripcion::whereHas(
            'curso',
            function ($query)
            use ($usuarioId)
            {
                $query->where(
                    'instructor_id',
                    $usuarioId
                );
            }
        )
        ->where(
            'estado',
            'Lista Espera'
        )
        ->count();

        $ultimasInscripciones = Inscripcion::with([
                'alumno',
                'curso'
            ])
            ->whereHas(
                'curso',
                function ($query)
                use ($usuarioId)
                {
                    $query->where(
                        'instructor_id',
                        $usuarioId
                    );
                }
            )
            ->latest()
            ->take(10)
            ->get();

        return view(
            'maestro.dashboard',
            compact(
                'misCursos',
                'pendientes',
                'aprobados',
                'listaEspera',
                'ultimasInscripciones'
            )
        );
    }
}