<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Carrera;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $usuarios = User::with([
            'role',
            'carrera'
        ])
        ->when(
            request('buscar'),
            function ($query) {

                $query->where(
                    'name',
                    'like',
                    '%' . request('buscar') . '%'
                );

            }
        )
        ->when(
            request('rol'),
            function ($query) {

                $query->where(
                    'rol_id',
                    request('rol')
                );

            }
        )
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $roles = Role::all();

    return view(
        'usuarios.index',
        compact(
            'usuarios',
            'roles'
        )
    );
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $roles = Role::all();

    $carreras = Carrera::all();

    return view(
        'usuarios.create',
        compact(
            'roles',
            'carreras'
        )
    );
}

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreUserRequest $request)
{
    User::create([

        'name' =>
            $request->name,

        'numero_control' =>
            $request->numero_control,

        'email' =>
            $request->email,

        'password' =>
            Hash::make(
                $request->password
            ),

        'rol_id' =>
            $request->rol_id,

        'carrera_id' =>
            $request->carrera_id,

        'semestre' =>
            $request->semestre,

        'telefono' =>
            $request->telefono

    ]);

    return redirect()
        ->route('usuarios.index')
        ->with(
            'success',
            'Usuario creado correctamente'
        );
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ⚡ LLENADO: Buscamos al usuario con sus relaciones cargadas
        $usuario = User::with(['role', 'carrera'])->findOrFail($id);

        // 🚨 Ajusta aquí si tu vista está dentro de admin (ej: 'admin.usuarios.show')
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(User $usuario)
{
    $roles = Role::all();

    $carreras = Carrera::all();

    return view(
        'usuarios.edit',
        compact(
            'usuario',
            'roles',
            'carreras'
        )
    );
}

    
/**
 * Update the specified resource in storage.
 */
public function update(UpdateUserRequest $request, User $usuario)
{

    $usuario->update([
        'name'           => $request->name,
        'numero_control' => $request->numero_control,
        'email'          => $request->email,
        'rol_id'         => $request->rol_id,
        'carrera_id'     => $request->carrera_id,
        'semestre'       => $request->semestre,
        'telefono'       => $request->telefono
    ]);

    // Si el usuario escribió algo en el campo de contraseña, la actualizamos
    if ($request->filled('password')) {
        $usuario->update([
            'password' => Hash::make($request->password) // Usamos Hash::make para mantener consistencia con el store
        ]);
    }

    return redirect()
        ->route('usuarios.index')
        ->with('success', 'Usuario actualizado correctamente');
}

    public function destroy(User $usuario)
{
    $usuario->delete();

    return redirect()
        ->route('usuarios.index')
        ->with(
            'success',
            'Usuario eliminado correctamente'
        );
}
}
