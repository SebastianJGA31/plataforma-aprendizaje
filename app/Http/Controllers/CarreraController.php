<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarreraRequest;
use App\Http\Requests\UpdateCarreraRequest;
use App\Models\Carrera;

class CarreraController extends Controller
{
    public function index()
    {
        $carreras = Carrera::withCount(['users', 'cursos'])
            ->when(request('buscar'), function ($query) {
                $query->where('nombre', 'like', '%' . request('buscar') . '%');
            })
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('carreras.index', compact('carreras'));
    }

    public function create()
    {
        return view('carreras.create');
    }

    public function store(StoreCarreraRequest $request)
    {
        Carrera::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()
            ->route('carreras.index')
            ->with('success', 'Carrera creada correctamente.');
    }

    public function edit(Carrera $carrera)
    {
        return view('carreras.edit', compact('carrera'));
    }

    public function update(UpdateCarreraRequest $request, Carrera $carrera)
    {
        $carrera->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()
            ->route('carreras.index')
            ->with('success', 'Carrera actualizada correctamente.');
    }

    public function destroy(Carrera $carrera)
    {
        if ($carrera->users()->exists()) {
            return back()->with('error', 'No se puede eliminar: hay alumnos asignados a esta carrera.');
        }

        if ($carrera->cursos()->exists()) {
            return back()->with('error', 'No se puede eliminar: hay cursos vinculados a esta carrera.');
        }

        $carrera->delete();

        return redirect()
            ->route('carreras.index')
            ->with('success', 'Carrera eliminada correctamente.');
    }
}
