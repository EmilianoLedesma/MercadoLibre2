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
                'name' => 'Administrador SEALS',
                'email' => 'admin@seals.mx',
                'password' => Hash::make('admin123'),
                'phone' => '+52 55 1234-5678',
                'role' => 'admin',
            ],
            [
                'name' => 'Vendedor SEALS',
                'email' => 'seller@seals.mx',
                'password' => Hash::make('seller123'),
                'phone' => '+52 55 1234-5679',
                'role' => 'seller',
            ],
            [
                'name' => 'Cliente SEALS',
                'email' => 'customer@seals.mx',
                'password' => Hash::make('customer123'),
                'phone' => '+52 55 1234-5680',
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
                'name' => 'Admin Diego Ramírez',
                'email' => 'diego.ramirez@admin.mx',
                'password' => Hash::make('password123'),
                'phone' => '+52 55 2234-5678',
                'role' => 'admin',
            ],

            // Vendedores
            [
                'name' => 'TechStore México',
                'email' => 'ventas@techstore.mx',
                'password' => Hash::make('password123'),
                'phone' => '+52 55 3234-5678',
                'role' => 'seller',
            ],
            [
                'name' => 'ElectroHogar MX',
                'email' => 'contacto@electrohogar.mx',
                'password' => Hash::make('password123'),
                'phone' => '+52 33 4234-5678',
                'role' => 'seller',
            ],
            [
                'name' => 'Moda & Estilo CDMX',
                'email' => 'ventas@modayestilo.mx',
                'password' => Hash::make('password123'),
                'phone' => '+52 55 5234-5678',
                'role' => 'seller',
            ],
            [
                'name' => 'Deportes Total MTY',
                'email' => 'info@deportestotal.mx',
                'password' => Hash::make('password123'),
                'phone' => '+52 81 6234-5678',
                'role' => 'seller',
            ],
            [
                'name' => 'Librería Porrúa',
                'email' => 'ventas@porrua.mx',
                'password' => Hash::make('password123'),
                'phone' => '+52 55 7234-5678',
                'role' => 'seller',
            ],

            // Compradores/Clientes
            [
                'name' => 'Juan Pérez Sánchez',
                'email' => 'juan.perez@gmail.com',
                'password' => Hash::make('password123'),
                'phone' => '+52 55 8234-5678',
                'role' => 'customer',
            ],
            [
                'name' => 'María González López',
                'email' => 'maria.gonzalez@hotmail.com',
                'password' => Hash::make('password123'),
                'phone' => '+52 33 9234-5678',
                'role' => 'customer',
            ],
            [
                'name' => 'Carlos Rodríguez Mendoza',
                'email' => 'carlos.rodriguez@yahoo.com',
                'password' => Hash::make('password123'),
                'phone' => '+52 81 1134-5678',
                'role' => 'customer',
            ],
            [
                'name' => 'Ana Martínez Flores',
                'email' => 'ana.martinez@outlook.com',
                'password' => Hash::make('password123'),
                'phone' => '+52 55 1224-5678',
                'role' => 'customer',
            ],
            [
                'name' => 'Luis Fernández Torres',
                'email' => 'luis.fernandez@gmail.com',
                'password' => Hash::make('password123'),
                'phone' => '+52 33 1334-5678',
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
