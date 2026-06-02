<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InscripcionController as AdminInscripcionController;
use App\Http\Controllers\Maestro\DashboardController as MaestroDashboardController;
use App\Http\Controllers\Maestro\CursoController as MaestroCursoController;
use App\Http\Controllers\Alumno\DashboardController as AlumnoDashboardController;
use App\Http\Controllers\Alumno\CursoController as AlumnoCursoController;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\Alumno\InscripcionController;
use App\Http\Controllers\Maestro\InscripcionController as MaestroInscripcionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
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

        Route::resource('usuarios', UserController::class);

        Route::resource('carreras', CarreraController::class);

        Route::get('/inscripciones', [AdminInscripcionController::class, 'index'])
            ->name('admin.inscripciones.index');
    });

Route::middleware(['auth', 'role:Maestro'])
    ->prefix('maestro')
    ->group(function () {

        Route::get('/dashboard', [MaestroDashboardController::class, 'index'])
            ->name('maestro.dashboard');

        Route::get('/cursos', [MaestroCursoController::class, 'index'])
            ->name('maestro.cursos.index');

        Route::get('/inscripciones', [MaestroInscripcionController::class, 'index'])
            ->name('maestro.inscripciones.index');

        Route::patch('/inscripciones/{inscripcion}/aprobar', [MaestroInscripcionController::class, 'aprobar'])
            ->name('maestro.inscripciones.aprobar');

        Route::patch('/inscripciones/{inscripcion}/rechazar', [MaestroInscripcionController::class, 'rechazar'])
            ->name('maestro.inscripciones.rechazar');

        Route::patch('/inscripciones/{inscripcion}/baja', [MaestroInscripcionController::class, 'darBaja'])
            ->name('maestro.inscripciones.baja');
    });

Route::middleware(['auth', 'role:Alumno'])
    ->prefix('alumno')
    ->group(function () {

        Route::get('/dashboard', [AlumnoDashboardController::class, 'index'])->name('alumno.dashboard');

        Route::get('/cursos', [AlumnoCursoController::class, 'index'])->name('alumno.cursos');

        Route::get('/cursos/{curso}/inscribirse', [InscripcionController::class, 'create'])
            ->name('alumno.inscripciones.create');

        Route::post('/cursos/{curso}/inscribirse', [InscripcionController::class, 'store'])
            ->name('alumno.inscripciones.store');

        Route::get('/mis-inscripciones', [InscripcionController::class, 'index'])
            ->name('alumno.inscripciones.index');

        Route::get('/cursos/{curso}', [AlumnoCursoController::class, 'show'])
            ->name('alumno.cursos.show');
    });

require __DIR__ . '/auth.php';
