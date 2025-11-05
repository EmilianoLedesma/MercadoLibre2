<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tecnología',
                'description' => 'Celulares, computadoras, tablets y accesorios tecnológicos',
            ],
            [
                'name' => 'Electrodomésticos',
                'description' => 'Heladeras, lavarropas, microondas y más para el hogar',
            ],
            [
                'name' => 'Hogar y Muebles',
                'description' => 'Muebles, decoración y artículos para el hogar',
            ],
            [
                'name' => 'Moda',
                'description' => 'Ropa, calzado y accesorios para hombre, mujer y niños',
            ],
            [
                'name' => 'Deportes y Fitness',
                'description' => 'Equipamiento deportivo, ropa deportiva y fitness',
            ],
            [
                'name' => 'Juguetes y Bebés',
                'description' => 'Juguetes, artículos para bebés y niños',
            ],
            [
                'name' => 'Belleza y Cuidado Personal',
                'description' => 'Perfumes, maquillaje, cuidado de la piel y cabello',
            ],
            [
                'name' => 'Herramientas',
                'description' => 'Herramientas manuales, eléctricas y equipamiento',
            ],
            [
                'name' => 'Libros y Entretenimiento',
                'description' => 'Libros, música, películas y videojuegos',
            ],
            [
                'name' => 'Automotriz',
                'description' => 'Repuestos, accesorios y productos para vehículos',
            ],
            [
                'name' => 'Jardín y Exterior',
                'description' => 'Plantas, herramientas de jardinería y decoración exterior',
            ],
            [
                'name' => 'Alimentos y Bebidas',
                'description' => 'Alimentos, bebidas y productos gourmet',
            ],
        ];

        // Crear solo las categorías básicas de Mercado Libre
        foreach ($categories as $categoryData) {
            // Verificar si ya existe esta categoría
            $slug = Str::slug($categoryData['name']);
            if (!Category::where('slug', $slug)->exists()) {
                Category::create([
                    'name' => $categoryData['name'],
                    'slug' => $slug,
                    'description' => $categoryData['description'],
                    'is_active' => true,
                ]);
            }
        }
    }
}