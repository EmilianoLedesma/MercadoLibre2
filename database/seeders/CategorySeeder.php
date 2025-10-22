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

        foreach ($categories as $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'description' => $categoryData['description'],
                'is_active' => true,
            ]);
        }
    }
}