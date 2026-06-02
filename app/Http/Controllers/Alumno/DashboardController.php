<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $alumnoId = Auth::id();
        $carreraId = Auth::user()->carrera_id;

        $cursosDisponibles = Curso::disponibleParaCarrera($carreraId)->count();

        $inscripcionesQuery = Inscripcion::where('alumno_id', $alumnoId);

        $totalInscripciones = (clone $inscripcionesQuery)->count();
        $pendientes = (clone $inscripcionesQuery)->where('estado', 'Pendiente')->count();
        $aprobados = (clone $inscripcionesQuery)->where('estado', 'Aprobado')->count();
        $listaEspera = (clone $inscripcionesQuery)->where('estado', 'Lista Espera')->count();

        $ultimasInscripciones = Inscripcion::with('curso')
            ->where('alumno_id', $alumnoId)
            ->latest()
            ->take(5)
            ->get();

        return view('alumno.dashboard', compact(
            'cursosDisponibles',
            'totalInscripciones',
            'pendientes',
            'aprobados',
            'listaEspera',
            'ultimasInscripciones'
        ));
    }
}
