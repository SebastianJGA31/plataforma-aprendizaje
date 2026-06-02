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

        User::firstOrCreate(
            ['email' => 'admin@plataforma.com'],
            [
                'name' => 'Administrador',
                'numero_control' => '10000001',
                'password' => Hash::make('admin123'),
                'rol_id' => $rolAdmin,
                'telefono' => '5500000000',
            ]
        );

        $this->call(DemoSeeder::class);
    }
}
