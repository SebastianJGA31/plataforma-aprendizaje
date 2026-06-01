<?php

namespace Database\Seeders;
use App\Models\Carrera;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    public function run(): void
{
    $carreras = [
        'Ingeniería en Sistemas Computacionales',
        'Ingeniería Industrial',
        'Ingeniería Mecánica',
        'Ingeniería Civil',
        'Ingeniería Informática',
        'Ingeniería Gestión Empresarial',
        'Licenciatura en Biologia',
        'Ingeniería en Electronica',
        'Ingeniería en Energías Renovables'
    ];

    foreach ($carreras as $carrera) {
        Carrera::create([
            'nombre' => $carrera
        ]);
    }
}
    
}
