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
        // Crear vendedores específicos con diferentes perfiles
        $vendedores = [
            [
                'name' => 'TechStore Argentina',
                'email' => 'ventas@techstore.com.ar',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'ElectroHogar SA',
                'email' => 'contacto@electrohogar.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Moda & Estilo',
                'email' => 'ventas@modayestilo.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Deportes Total',
                'email' => 'info@deportestotal.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Librería El Ateneo',
                'email' => 'ventas@elateneo.com',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($vendedores as $vendedor) {
            if (!User::where('email', $vendedor['email'])->exists()) {
                User::create(array_merge($vendedor, ['email_verified_at' => now()]));
            }
        }

        // Crear un usuario administrador si no existe
        if (!User::where('email', 'admin@mercadolibre.com')->exists()) {
            User::create([
                'name' => 'Administrador MercadoLibre',
                'email' => 'admin@mercadolibre.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
            ]);
        }
        
        // Crear compradores de prueba
        $compradores = [
            [
                'name' => 'Juan Pérez',
                'email' => 'juan.perez@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'María González',
                'email' => 'maria.gonzalez@hotmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Carlos Rodríguez',
                'email' => 'carlos.rodriguez@yahoo.com',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($compradores as $comprador) {
            if (!User::where('email', $comprador['email'])->exists()) {
                User::create(array_merge($comprador, ['email_verified_at' => now()]));
            }
        }
        
        // Verificar cuántos usuarios ya existen y crear hasta tener al menos 25
        $userCount = User::count();
        if ($userCount < 25) {
            $usersToCreate = 25 - $userCount;
            User::factory($usersToCreate)->create();
        }
    }
}