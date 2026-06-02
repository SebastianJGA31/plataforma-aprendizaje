<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAlumnoRequest;
use App\Models\Carrera;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $carreras = Carrera::orderBy('nombre')->get();

        return view('auth.register', compact('carreras'));
    }

    public function store(RegisterAlumnoRequest $request): RedirectResponse
    {
        $rolAlumno = Role::where('nombre', 'Alumno')->firstOrFail();

        $user = User::create([
            'name' => $request->name,
            'numero_control' => $request->numero_control,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => $rolAlumno->id,
            'carrera_id' => $request->carrera_id,
            'semestre' => $request->semestre,
            'telefono' => $request->telefono,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
