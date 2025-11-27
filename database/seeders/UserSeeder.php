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
        // Crear usuarios principales para testing (Sprint 3)
        $mainUsers = [
            [
                'name' => 'Administrador MercadoLibre',
                'email' => 'admin@mercadolibre.com',
                'password' => Hash::make('admin123'),
                'phone' => '+54 11 1234-5678',
                'role' => 'admin',
            ],
            [
                'name' => 'Vendedor MercadoLibre',
                'email' => 'seller@mercadolibre.com',
                'password' => Hash::make('seller123'),
                'phone' => '+54 11 1234-5679',
                'role' => 'seller',
            ],
            [
                'name' => 'Cliente MercadoLibre',
                'email' => 'customer@mercadolibre.com',
                'password' => Hash::make('customer123'),
                'phone' => '+54 11 1234-5680',
                'role' => 'customer',
            ],
        ];

        foreach ($mainUsers as $userData) {
            if (! User::where('email', $userData['email'])->exists()) {
                User::create(array_merge($userData, [
                    'email_verified_at' => now(),
                    'is_active' => true,
                ]));
            }
        }

        // Crear usuarios de prueba adicionales con roles específicos
        $testUsers = [
            // Administradores adicionales
            [
                'name' => 'Admin Joaquín Moreno',
                'email' => 'joaquin.moreno@admin.com',
                'password' => Hash::make('password123'),
                'phone' => '+54 11 2234-5678',
                'role' => 'admin',
            ],

            // Vendedores
            [
                'name' => 'TechStore Argentina',
                'email' => 'ventas@techstore.com.ar',
                'password' => Hash::make('password123'),
                'phone' => '+54 11 3234-5678',
                'role' => 'seller',
            ],
            [
                'name' => 'ElectroHogar SA',
                'email' => 'contacto@electrohogar.com',
                'password' => Hash::make('password123'),
                'phone' => '+54 11 4234-5678',
                'role' => 'seller',
            ],
            [
                'name' => 'Moda & Estilo',
                'email' => 'ventas@modayestilo.com',
                'password' => Hash::make('password123'),
                'phone' => '+54 11 5234-5678',
                'role' => 'seller',
            ],
            [
                'name' => 'Deportes Total',
                'email' => 'info@deportestotal.com',
                'password' => Hash::make('password123'),
                'phone' => '+54 11 6234-5678',
                'role' => 'seller',
            ],
            [
                'name' => 'Librería El Ateneo',
                'email' => 'ventas@elateneo.com',
                'password' => Hash::make('password123'),
                'phone' => '+54 11 7234-5678',
                'role' => 'seller',
            ],

            // Compradores/Clientes
            [
                'name' => 'Juan Pérez',
                'email' => 'juan.perez@gmail.com',
                'password' => Hash::make('password123'),
                'phone' => '+54 11 8234-5678',
                'role' => 'customer',
            ],
            [
                'name' => 'María González',
                'email' => 'maria.gonzalez@hotmail.com',
                'password' => Hash::make('password123'),
                'phone' => '+54 11 9234-5678',
                'role' => 'customer',
            ],
            [
                'name' => 'Carlos Rodríguez',
                'email' => 'carlos.rodriguez@yahoo.com',
                'password' => Hash::make('password123'),
                'phone' => '+54 11 1134-5678',
                'role' => 'customer',
            ],
            [
                'name' => 'Ana Martínez',
                'email' => 'ana.martinez@outlook.com',
                'password' => Hash::make('password123'),
                'phone' => '+54 11 1224-5678',
                'role' => 'customer',
            ],
            [
                'name' => 'Luis Fernández',
                'email' => 'luis.fernandez@gmail.com',
                'password' => Hash::make('password123'),
                'phone' => '+54 11 1334-5678',
                'role' => 'customer',
            ],
        ];

        foreach ($testUsers as $userData) {
            if (! User::where('email', $userData['email'])->exists()) {
                User::create(array_merge($userData, [
                    'email_verified_at' => now(),
                    'is_active' => true,
                ]));
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
