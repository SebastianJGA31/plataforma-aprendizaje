<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCursoRequest;
use App\Models\User;
use App\Models\Curso;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Carrera;
use App\Http\Requests\UpdateCursoRequest;

class CursoController extends Controller
{
    private function getMaestros()
    {
        $rolMaestro = Role::where('nombre', 'Maestro')->value('id');

        return User::where('rol_id', $rolMaestro)->orderBy('name')->get();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $cursos = Curso::with([
            'instructor',
            'carreras'
        ])

        ->when(
            request('buscar'),
            function ($query) {

                $query->where(
                    'titulo',
                    'like',
                    '%' . request('buscar') . '%'
                );

            }
        )

        ->when(
            request('estado'),
            function ($query) {

                $query->where(
                    'estado',
                    request('estado')
                );

            }
        )

        ->when(
            request('modalidad'),
            function ($query) {

                $query->where(
                    'modalidad',
                    request('modalidad')
                );

            }
        )

        ->when(
            request('tipo'),
            function ($query) {

                $query->where(
                    'tipo',
                    request('tipo')
                );

            }
        )

        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view(
        'cursos.index',
        compact('cursos')
    );
}



   public function create()
{
    $maestros = $this->getMaestros();

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
    $imagen = null;

if ($request->hasFile('imagen'))
{
    $imagen = $request
        ->file('imagen')
        ->store(
            'cursos',
            'public'
        );
}
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

        'imagen' => $imagen,

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
    $maestros = $this->getMaestros();

    $carreras = Carrera::all();

    $curso->load('carreras');

    return view(
        'cursos.show',
        compact(
            'curso',
            'maestros',
            'carreras'
        )
    );
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
{
    $maestros = $this->getMaestros();

    $carreras = Carrera::all();

    $curso->load('carreras');

    return view(
        'cursos.edit',
        compact(
            'curso',
            'maestros',
            'carreras'
        )
    );
}

    /**
     * Update the specified resource in storage.
     */
    /**
 * Update the specified resource in storage.
 */
public function update(UpdateCursoRequest $request, Curso $curso)
{
    if(
    $request->hasFile(
        'imagen'
    )
)
{
    $curso->imagen =
        $request->file('imagen')
            ->store(
                'cursos',
                'public'
            );
}

    $curso->update([
        'titulo'              => $request->titulo,
        'descripcion'         => $request->descripcion,
        'tipo'                => $request->tipo,
        'modalidad'           => $request->modalidad,
        'tipo_origen'         => $request->tipo_origen,
        'instructor_id'       => $request->instructor_id,
        'cupo_maximo'         => $request->cupo_maximo,
        'fecha_inicio'        => $request->fecha_inicio,
        'fecha_fin'           => $request->fecha_fin,
        'lugar'               => $request->lugar,
        'enlace_externo'      => $request->enlace_externo,
        'requiere_aprobacion' => $request->has('requiere_aprobacion'),
        'permite_resenas'     => $request->has('permite_resenas'),
        'todas_las_carreras'  => $request->has('todas_las_carreras'),
        'imagen' => $curso->imagen,
        'estado' => $request->estado
    ]);

    // Lógica para sincronizar carreras respetando el checkbox "todas_las_carreras"
    if ($request->has('todas_las_carreras')) {
        // Si está disponible para todas, limpiamos la tabla pivote
        $curso->carreras()->detach();
    } else {
        // Si no, sincronizamos las carreras que seleccionó (o un arreglo vacío si desmarcó todas)
        $curso->carreras()->sync($request->carreras ?? []);
    }

    return redirect()
        ->route('cursos.index')
        ->with('success', 'Curso actualizado correctamente');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
{
    $curso->delete();

    return redirect()
        ->route('cursos.index')
        ->with(
            'success',
            'Curso eliminado correctamente.'
        );
}
}
