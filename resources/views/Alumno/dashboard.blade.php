<x-app-layout>

<div class="container mt-4">

    <h2 class="mb-4">Dashboard Alumno</h2>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Cursos Disponibles</h5>
                    <h2>{{ $cursosDisponibles }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Mis Inscripciones</h5>
                    <h2>{{ $totalInscripciones }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-warning">
                <div class="card-body">
                    <h5>Pendientes</h5>
                    <h2>{{ $pendientes }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Aprobados</h5>
                    <h2>{{ $aprobados }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5>Lista de Espera</h5>
                    <h2>{{ $listaEspera }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Últimas Inscripciones</span>
            <a href="{{ route('alumno.cursos') }}" class="btn btn-sm btn-primary">Ver cursos</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ultimasInscripciones as $inscripcion)
                        <tr>
                            <td>{{ $inscripcion->curso->titulo }}</td>
                            <td>{{ $inscripcion->estado }}</td>
                            <td>{{ $inscripcion->fecha_inscripcion?->format('d/m/Y') ?? $inscripcion->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted">Aún no tienes inscripciones.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</x-app-layout>
