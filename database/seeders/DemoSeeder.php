<?php

namespace Database\Seeders;

use App\Models\Carrera;
use App\Models\Curso;
use App\Models\Inscripcion;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $rolAdmin = Role::where('nombre', 'Administrador')->value('id');
        $rolMaestro = Role::where('nombre', 'Maestro')->value('id');
        $rolAlumno = Role::where('nombre', 'Alumno')->value('id');

        $carreraSistemas = Carrera::where('nombre', 'like', '%Sistemas%')->first()
            ?? Carrera::first();
        $carreraIndustrial = Carrera::where('nombre', 'Ingeniería Industrial')->first()
            ?? Carrera::skip(1)->first();
        $carreraCivil = Carrera::where('nombre', 'Ingeniería Civil')->first()
            ?? Carrera::skip(2)->first();

        $maestro1 = User::firstOrCreate(
            ['email' => 'maestro1@plataforma.com'],
            [
                'name' => 'Prof. Juan García',
                'numero_control' => '20000001',
                'password' => Hash::make('maestro123'),
                'rol_id' => $rolMaestro,
                'telefono' => '5511111111',
            ]
        );

        $maestro2 = User::firstOrCreate(
            ['email' => 'maestro2@plataforma.com'],
            [
                'name' => 'Prof. Ana López',
                'numero_control' => '20000002',
                'password' => Hash::make('maestro123'),
                'rol_id' => $rolMaestro,
                'telefono' => '5522222222',
            ]
        );

        $alumno1 = User::firstOrCreate(
            ['email' => 'alumno1@plataforma.com'],
            [
                'name' => 'Carlos Ramírez',
                'numero_control' => '21180384',
                'password' => Hash::make('alumno123'),
                'rol_id' => $rolAlumno,
                'carrera_id' => $carreraSistemas?->id,
                'semestre' => 6,
                'telefono' => '5533333333',
            ]
        );

        $alumno2 = User::firstOrCreate(
            ['email' => 'alumno2@plataforma.com'],
            [
                'name' => 'María Hernández',
                'numero_control' => '21180385',
                'password' => Hash::make('alumno123'),
                'rol_id' => $rolAlumno,
                'carrera_id' => $carreraIndustrial?->id,
                'semestre' => 4,
                'telefono' => '5544444444',
            ]
        );

        $alumno3 = User::firstOrCreate(
            ['email' => 'alumno3@plataforma.com'],
            [
                'name' => 'Luis Torres',
                'numero_control' => '21180386',
                'password' => Hash::make('alumno123'),
                'rol_id' => $rolAlumno,
                'carrera_id' => $carreraCivil?->id,
                'semestre' => 8,
                'telefono' => '5555555555',
            ]
        );

        $curso1 = Curso::firstOrCreate(
            ['titulo' => 'Programación Web con Laravel'],
            [
                'descripcion' => 'Curso práctico de desarrollo web con Laravel, Bootstrap y MySQL.',
                'tipo' => 'Curso',
                'modalidad' => 'Virtual',
                'tipo_origen' => 'Interno',
                'instructor_id' => $maestro1->id,
                'cupo_maximo' => 3,
                'fecha_inicio' => now()->addDays(7)->toDateString(),
                'fecha_fin' => now()->addDays(60)->toDateString(),
                'lugar' => 'Aula virtual',
                'requiere_aprobacion' => true,
                'permite_resenas' => false,
                'todas_las_carreras' => false,
                'estado' => 'Activo',
            ]
        );
        if ($carreraSistemas) {
            $curso1->carreras()->syncWithoutDetaching([$carreraSistemas->id]);
        }

        $curso2 = Curso::firstOrCreate(
            ['titulo' => 'Taller de Robótica Industrial'],
            [
                'descripcion' => 'Introducción a brazos robóticos y automatización industrial.',
                'tipo' => 'Taller',
                'modalidad' => 'Presencial',
                'tipo_origen' => 'Interno',
                'instructor_id' => $maestro2->id,
                'cupo_maximo' => 2,
                'fecha_inicio' => now()->addDays(14)->toDateString(),
                'fecha_fin' => now()->addDays(30)->toDateString(),
                'lugar' => 'Laboratorio de Mecatrónica',
                'requiere_aprobacion' => true,
                'permite_resenas' => false,
                'todas_las_carreras' => false,
                'estado' => 'Activo',
            ]
        );
        if ($carreraIndustrial) {
            $curso2->carreras()->syncWithoutDetaching([$carreraIndustrial->id]);
        }

        $curso3 = Curso::firstOrCreate(
            ['titulo' => 'Conferencia: Ingeniería Sostenible'],
            [
                'descripcion' => 'Charla sobre construcción sostenible y normativa ambiental.',
                'tipo' => 'Conferencia',
                'modalidad' => 'Hibrida',
                'tipo_origen' => 'Interno',
                'instructor_id' => $maestro1->id,
                'cupo_maximo' => 50,
                'fecha_inicio' => now()->addDays(3)->toDateString(),
                'fecha_fin' => now()->addDays(3)->toDateString(),
                'lugar' => 'Auditorio principal',
                'requiere_aprobacion' => false,
                'permite_resenas' => false,
                'todas_las_carreras' => true,
                'estado' => 'Activo',
            ]
        );

        $curso4 = Curso::firstOrCreate(
            ['titulo' => 'Webinar: Gestión de Proyectos'],
            [
                'descripcion' => 'Metodologías ágiles aplicadas a proyectos empresariales.',
                'tipo' => 'Webinar',
                'modalidad' => 'Virtual',
                'tipo_origen' => 'Externo',
                'instructor_id' => $maestro2->id,
                'cupo_maximo' => 1,
                'fecha_inicio' => now()->addDays(10)->toDateString(),
                'fecha_fin' => now()->addDays(10)->toDateString(),
                'lugar' => 'Zoom',
                'enlace_externo' => 'https://zoom.us/ejemplo',
                'requiere_aprobacion' => true,
                'permite_resenas' => false,
                'todas_las_carreras' => true,
                'estado' => 'Activo',
            ]
        );

        $this->crearInscripcion($alumno1, $curso1, 'Aprobado');
        $this->crearInscripcion($alumno2, $curso2, 'Pendiente');
        $this->crearInscripcion($alumno3, $curso3, 'Aprobado');
        $this->crearInscripcion($alumno1, $curso4, 'Lista Espera');
        $this->crearInscripcion($alumno2, $curso4, 'Aprobado');
    }

    private function crearInscripcion(User $alumno, Curso $curso, string $estado): void
    {
        Inscripcion::firstOrCreate(
            [
                'alumno_id' => $alumno->id,
                'curso_id' => $curso->id,
            ],
            [
                'estado' => $estado,
                'motivo' => 'Interés en el tema del curso.',
                'experiencia' => 'Conocimientos básicos previos.',
                'fecha_inscripcion' => now()->subDays(2),
            ]
        );
    }
}
