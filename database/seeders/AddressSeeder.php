<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que existan usuarios
        $userCount = User::count();
        if ($userCount === 0) {
            User::factory(5)->create();
        }
        
        // Obtén todos los usuarios
        $users = User::all();
        
        // Crea al menos una dirección para cada usuario
        foreach ($users as $user) {
            // Crear entre 1 y 3 direcciones por usuario
            $addressCount = rand(1, 3);
            
            // La primera dirección será la predeterminada
            Address::factory()->create([
                'user_id' => $user->id,
                'is_default' => true
            ]);
            
            // Crear direcciones adicionales si es necesario
            if ($addressCount > 1) {
                Address::factory($addressCount - 1)->create([
                    'user_id' => $user->id,
                    'is_default' => false
                ]);
            }
        }
    }
}