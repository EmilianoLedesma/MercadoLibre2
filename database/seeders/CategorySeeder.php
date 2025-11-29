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
                'image' => 'images/tecnologia.jpg',
            ],
            [
                'name' => 'Electrodomésticos',
                'description' => 'Heladeras, lavarropas, microondas y más para el hogar',
                'image' => 'images/electrodomesticos.jpg',
            ],
            [
                'name' => 'Hogar y Muebles',
                'description' => 'Muebles, decoración y artículos para el hogar',
                'image' => 'images/muebles.jpg',
            ],
            [
                'name' => 'Moda',
                'description' => 'Ropa, calzado y accesorios para hombre, mujer y niños',
                'image' => 'images/moda.jpg',
            ],
            [
                'name' => 'Deportes y Fitness',
                'description' => 'Equipamiento deportivo, ropa deportiva y fitness',
                'image' => 'images/Deportes_y_fitness.jpg',
            ],
            [
                'name' => 'Juguetes y Bebés',
                'description' => 'Juguetes, artículos para bebés y niños',
                'image' => 'images/Juguetes.jpg',
            ],
            [
                'name' => 'Belleza y Cuidado Personal',
                'description' => 'Perfumes, maquillaje, cuidado de la piel y cabello',
                'image' => 'images/belleza_cuidado_personal.jpg',
            ],
            [
                'name' => 'Herramientas',
                'description' => 'Herramientas manuales, eléctricas y equipamiento',
                'image' => 'images/herramientas.jpg',
            ],
            [
                'name' => 'Libros y Entretenimiento',
                'description' => 'Libros, música, películas y videojuegos',
                'image' => 'images/entretenimiento.jpg',
            ],
            [
                'name' => 'Automotriz',
                'description' => 'Repuestos, accesorios y productos para vehículos',
                'image' => 'images/Automotriz.jpg',
            ],
            [
                'name' => 'Jardín y Exterior',
                'description' => 'Plantas, herramientas de jardinería y decoración exterior',
                'image' => 'images/jardineria.jpg',
            ],
            [
                'name' => 'Alimentos y Bebidas',
                'description' => 'Alimentos, bebidas y productos gourmet',
                'image' => 'images/alimentos.jpg',
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
                    'image' => $categoryData['image'] ?? null,
                    'is_active' => true,
                ]);
            }
        }
    }
}