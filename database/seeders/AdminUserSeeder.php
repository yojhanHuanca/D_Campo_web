<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario admin predeterminado si no existe
        User::firstOrCreate(
            ['email' => 'admin@dcampo.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
                'rol' => 'admin',
            ]
        );
    }
}
