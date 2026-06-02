<?php

namespace App\Http\Controllers\Admin;

use App\Models\Curso;
use App\Models\Inscripcion;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $rolAlumno = Role::where('nombre', 'Alumno')->value('id');
        $rolMaestro = Role::where('nombre', 'Maestro')->value('id');

        $totalUsuarios = User::count();
        $totalAlumnos = User::where('rol_id', $rolAlumno)->count();
        $totalMaestros = User::where('rol_id', $rolMaestro)->count();
        $totalCursos = Curso::count();

        $totalInscripciones = Inscripcion::count();
        $inscripcionesPendientes = Inscripcion::where('estado', 'Pendiente')->count();
        $inscripcionesAprobadas = Inscripcion::where('estado', 'Aprobado')->count();
        $listaEspera = Inscripcion::where('estado', 'Lista Espera')->count();

        $ultimosUsuarios = User::latest()->take(5)->get();
        $ultimosCursos = Curso::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsuarios',
            'totalAlumnos',
            'totalMaestros',
            'totalCursos',
            'totalInscripciones',
            'inscripcionesPendientes',
            'inscripcionesAprobadas',
            'listaEspera',
            'ultimosUsuarios',
            'ultimosCursos'
        ));
    }
}
