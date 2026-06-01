<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCursoRequest;
use App\Models\User;
use App\Models\Curso;
use Illuminate\Http\Request;
use App\Models\Carrera;
use App\Http\Requests\UpdateCursoRequest;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $cursos = Curso::with([
    'instructor',
    'carreras'
])->get();

    return view('cursos.index', compact('cursos'));
}

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    $maestros = User::whereIn('rol_id', [1, 2])->get();

    $carreras = Carrera::all();

    return view(
        'cursos.create',
        compact(
            'maestros',
            'carreras'
        )
    );
}

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreCursoRequest $request)
{
    $curso = Curso::create([

    'titulo' => $request->titulo,

    'descripcion' => $request->descripcion,

    'tipo' => $request->tipo,

    'modalidad' => $request->modalidad,

    'tipo_origen' => $request->tipo_origen,

    'instructor_id' => $request->instructor_id,

    'cupo_maximo' => $request->cupo_maximo,

    'fecha_inicio' => $request->fecha_inicio,

    'fecha_fin' => $request->fecha_fin,

    'lugar' => $request->lugar,

    'enlace_externo' => $request->enlace_externo,

    'requiere_aprobacion'
        => $request->has('requiere_aprobacion'),

    'permite_resenas'
        => $request->has('permite_resenas'),

    'todas_las_carreras'
        => $request->has('todas_las_carreras'),

    'estado' => $request->estado

]);
if (!$request->has('todas_las_carreras')) {

    $curso->carreras()
          ->sync(
              $request->carreras ?? []
          );

}

    return redirect()
        ->route('cursos.index')
        ->with(
            'success',
            'Curso creado correctamente'
        );
}

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        //
    }
}
