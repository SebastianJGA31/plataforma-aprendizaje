<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Curso;
use App\Models\Inscripcion;

class InscripcionController extends Controller

{
    use AuthorizesRequests;
    public function index()
    {
        $inscripciones = Inscripcion::with(['alumno', 'curso.instructor'])
            ->when(request('curso'), fn ($query) => $query->where('curso_id', request('curso')))
            ->when(request('estado'), fn ($query) => $query->where('estado', request('estado')))
            ->when(request('buscar'), function ($query) {
                $query->whereHas('alumno', function ($q) {
                    $q->where('name', 'like', '%' . request('buscar') . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $cursos = Curso::orderBy('titulo')->get();

        return view('admin.inscripciones.index', compact('inscripciones', 'cursos'));
    }
}
