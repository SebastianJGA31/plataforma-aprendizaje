<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Maestro\DashboardController as MaestroDashboardController;
use App\Http\Controllers\Alumno\DashboardController as AlumnoDashboardController;
use App\Http\Controllers\Alumno\CursoController as AlumnoCursoController;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    // Cambiado a Auth::user() para eliminar la alerta visual
    $rol = Auth::user()->role->nombre;

    if ($rol === 'Administrador') {
        return redirect()->route('admin.dashboard');
    }

    if ($rol === 'Maestro') {
        return redirect()->route('maestro.dashboard');
    }

    return redirect()->route('alumno.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:Administrador'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('cursos', CursoController::class);

        Route::resource(
            'usuarios',
            UserController::class
        );
    });

Route::middleware(['auth', 'role:Maestro'])
    ->prefix('maestro')
    ->group(function () {

        Route::get('/dashboard', [MaestroDashboardController::class, 'index'])
            ->name('maestro.dashboard');
    });

Route::middleware(['auth', 'role:Alumno'])
    ->prefix('alumno')
    ->group(function () {

        Route::get('/dashboard', [AlumnoDashboardController::class, 'index'])
            ->name('alumno.dashboard');

        Route::get('/cursos', [AlumnoCursoController::class, 'index'])
            ->name('alumno.cursos'); 
    });

require __DIR__ . '/auth.php';
