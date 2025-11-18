<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            [
                'user_id' => 3, // TechStore Argentina
                'name' => 'TechStore Argentina',
                'slug' => 'techstore-argentina',
                'description' => 'Tu tienda de tecnología de confianza. Ofrecemos los mejores productos electrónicos y gadgets del mercado.',
                'phone' => '+54 11 1234-5678',
                'email' => 'ventas@techstore.com.ar',
                'address' => 'Av. Corrientes 1234, Buenos Aires, Argentina',
            ],
            [
                'user_id' => 4, // ElectroHogar SA
                'name' => 'ElectroHogar',
                'slug' => 'electrohogar',
                'description' => 'Especialistas en electrodomésticos para el hogar. Calidad y garantía asegurada.',
                'phone' => '+54 11 2345-6789',
                'email' => 'contacto@electrohogar.com',
                'address' => 'Av. Santa Fe 2345, Buenos Aires, Argentina',
            ],
            [
                'user_id' => 5, // Moda & Estilo
                'name' => 'Moda & Estilo',
                'slug' => 'moda-estilo',
                'description' => 'Las últimas tendencias en moda y accesorios. Renueva tu estilo con nosotros.',
                'phone' => '+54 11 3456-7890',
                'email' => 'ventas@modayestilo.com',
                'address' => 'Av. Cabildo 3456, Buenos Aires, Argentina',
            ],
            [
                'user_id' => 6, // Deportes Total
                'name' => 'Deportes Total',
                'slug' => 'deportes-total',
                'description' => 'Todo lo que necesitas para tu deporte favorito. Equipamiento de primera calidad.',
                'phone' => '+54 11 4567-8901',
                'email' => 'info@deportestotal.com',
                'address' => 'Av. del Libertador 4567, Buenos Aires, Argentina',
            ],
            [
                'user_id' => 7, // Librería El Ateneo
                'name' => 'Librería El Ateneo',
                'slug' => 'libreria-el-ateneo',
                'description' => 'Los mejores libros y material educativo. Cultura y conocimiento a tu alcance.',
                'phone' => '+54 11 5678-9012',
                'email' => 'ventas@elateneo.com',
                'address' => 'Av. Florida 5678, Buenos Aires, Argentina',
            ],
        ];

        foreach ($stores as $storeData) {
            if (!Store::where('user_id', $storeData['user_id'])->exists()) {
                Store::create($storeData);
            }
        }
    }
}
