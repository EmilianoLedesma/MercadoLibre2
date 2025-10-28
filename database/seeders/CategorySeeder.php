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
                'name' => 'Hombre',
                'description' => 'Ropa y accesorios para hombre',
            ],
            [
                'name' => 'Mujer',
                'description' => 'Moda femenina y accesorios',
            ],
            [
                'name' => 'Niños',
                'description' => 'Ropa y juguetes para niños',
            ],
            [
                'name' => 'Accesorios',
                'description' => 'Complementos y accesorios',
            ],
            [
                'name' => 'Calzado',
                'description' => 'Zapatos y zapatillas para todos',
            ],
            [
                'name' => 'Deportes',
                'description' => 'Ropa y equipamiento deportivo',
            ],
        ];

        // Si ya hay suficientes categorías creadas, generar categorías adicionales
        $existingCount = Category::count();
        
        if ($existingCount >= count($categories)) {
            // Si ya existen las categorías básicas, crear algunas categorías adicionales
            Category::factory(15)->create();
            return;
        }
        
        // Si no hay suficientes categorías, crear las básicas
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
        
        // Agregar algunas categorías adicionales
        Category::factory(15)->create();
    }
}