<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CarreraSeeder::class,
        ]);

        $rolAdmin = Role::where('nombre', 'Administrador')->value('id');
        $rolMaestro = Role::where('nombre', 'Maestro')->value('id');
        $rolAlumno = Role::where('nombre', 'Alumno')->value('id');

        User::firstOrCreate(
            ['email' => 'admin@itcv.edu.mx'],
            [
                'name' => 'Administrador ITCV',
                'numero_control' => 'ADMIN001',
                'password' => Hash::make('password123'),
                'rol_id' => $rolAdmin,
                'telefono' => '8340000000',
            ]
        );

        User::firstOrCreate(
            ['email' => 'maestro@itcv.edu.mx'],
            [
                'name' => 'Maestro de Prueba',
                'numero_control' => 'DOCENTE001',
                'password' => Hash::make('password123'),
                'rol_id' => $rolMaestro,
                'telefono' => '8340000001',
            ]
        );

        User::firstOrCreate(
            ['email' => 'alumno@itcv.edu.mx'],
            [
                'name' => 'Alumno de Prueba',
                'numero_control' => 'ALUMNO001',
                'password' => Hash::make('password123'),
                'rol_id' => $rolAlumno,
                'telefono' => '8340000002',
            ]
        );
    }
}
