<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un usuario administrador si no existe
        if (!User::where('email', 'admin@mercadolibre.com')->exists()) {
            User::create([
                'name' => 'Administrador',
                'email' => 'admin@mercadolibre.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
            ]);
        }
        
        // Crear un usuario de prueba específico si no existe
        if (!User::where('email', 'test@mercadolibre.com')->exists()) {
            User::create([
                'name' => 'Usuario Prueba',
                'email' => 'test@mercadolibre.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
            ]);
        }
        
        // Verificar cuántos usuarios ya existen y crear hasta tener al menos 20
        $userCount = User::count();
        if ($userCount < 22) { // 2 usuarios predefinidos + 20 aleatorios
            $usersToCreate = 22 - $userCount;
            User::factory($usersToCreate)->create();
        }
    }
}