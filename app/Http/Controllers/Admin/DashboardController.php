<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Curso;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $totalUsuarios = User::count();

    $totalAlumnos = User::where(
        'rol_id',
        3
    )->count();

    $totalMaestros = User::where(
        'rol_id',
        2
    )->count();

    $totalCursos = Curso::count();

    $ultimosUsuarios = User::latest()
        ->take(5)
        ->get();

    $ultimosCursos = Curso::latest()
        ->take(5)
        ->get();

    return view(
        'admin.dashboard',
        compact(
            'totalUsuarios',
            'totalAlumnos',
            'totalMaestros',
            'totalCursos',
            'ultimosUsuarios',
            'ultimosCursos'
        )
    );
}
}
