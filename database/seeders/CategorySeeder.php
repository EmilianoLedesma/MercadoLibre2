<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tecnología',
                'description' => 'Celulares, computadoras, tablets y accesorios tecnológicos',
                'image' => 'images/tecnologia.jpg',
                'subcategories' => [
                    'Celulares y Smartphones',
                    'Computadoras y Laptops',
                    'Tablets',
                    'Accesorios Tecnológicos',
                    'Cámaras y Fotografía',
                    'Audio y Video',
                ]
            ],
            [
                'name' => 'Electrodomésticos',
                'description' => 'Heladeras, lavarropas, microondas y más para el hogar',
                'image' => 'images/electrodomesticos.jpg',
                'subcategories' => [
                    'Refrigeración',
                    'Lavado y Secado',
                    'Cocina',
                    'Climatización',
                    'Pequeños Electrodomésticos',
                ]
            ],
            [
                'name' => 'Hogar y Muebles',
                'description' => 'Muebles, decoración y artículos para el hogar',
                'image' => 'images/muebles.jpg',
                'subcategories' => [
                    'Muebles de Sala',
                    'Muebles de Dormitorio',
                    'Muebles de Comedor',
                    'Decoración',
                    'Textiles para el Hogar',
                    'Organización',
                ]
            ],
            [
                'name' => 'Moda',
                'description' => 'Ropa, calzado y accesorios para hombre, mujer y niños',
                'image' => 'images/moda.jpg',
                'subcategories' => [
                    'Ropa de Hombre',
                    'Ropa de Mujer',
                    'Ropa de Niños',
                    'Calzado',
                    'Accesorios y Joyería',
                    'Relojes',
                ]
            ],
            [
                'name' => 'Deportes y Fitness',
                'description' => 'Equipamiento deportivo, ropa deportiva y fitness',
                'image' => 'images/Deportes_y_fitness.jpg',
                'subcategories' => [
                    'Fitness y Gimnasio',
                    'Deportes al Aire Libre',
                    'Bicicletas y Ciclismo',
                    'Deportes Acuáticos',
                    'Ropa Deportiva',
                ]
            ],
            [
                'name' => 'Juguetes y Bebés',
                'description' => 'Juguetes, artículos para bebés y niños',
                'image' => 'images/Juguetes.jpg',
                'subcategories' => [
                    'Juguetes para Bebés',
                    'Juguetes Educativos',
                    'Muñecas y Accesorios',
                    'Vehículos y Pistas',
                    'Artículos para Bebés',
                ]
            ],
            [
                'name' => 'Belleza y Cuidado Personal',
                'description' => 'Perfumes, maquillaje, cuidado de la piel y cabello',
                'image' => 'images/belleza_cuidado_personal.jpg',
                'subcategories' => [
                    'Fragancias',
                    'Maquillaje',
                    'Cuidado de la Piel',
                    'Cuidado del Cabello',
                    'Cuidado Personal',
                ]
            ],
            [
                'name' => 'Herramientas',
                'description' => 'Herramientas manuales, eléctricas y equipamiento',
                'image' => 'images/herramientas.jpg',
                'subcategories' => [
                    'Herramientas Manuales',
                    'Herramientas Eléctricas',
                    'Herramientas de Jardín',
                    'Equipamiento Industrial',
                ]
            ],
            [
                'name' => 'Libros y Entretenimiento',
                'description' => 'Libros, música, películas y videojuegos',
                'image' => 'images/entretenimiento.jpg',
                'subcategories' => [
                    'Libros',
                    'Música',
                    'Películas y Series',
                    'Videojuegos',
                    'Instrumentos Musicales',
                ]
            ],
            [
                'name' => 'Automotriz',
                'description' => 'Repuestos, accesorios y productos para vehículos',
                'image' => 'images/Automotriz.jpg',
                'subcategories' => [
                    'Accesorios para Auto',
                    'Repuestos',
                    'Herramientas Automotrices',
                    'Audio y Video para Auto',
                ]
            ],
            [
                'name' => 'Jardín y Exterior',
                'description' => 'Plantas, herramientas de jardinería y decoración exterior',
                'image' => 'images/jardineria.jpg',
                'subcategories' => [
                    'Plantas y Semillas',
                    'Herramientas de Jardín',
                    'Muebles de Exterior',
                    'Decoración de Jardín',
                ]
            ],
            [
                'name' => 'Alimentos y Bebidas',
                'description' => 'Alimentos, bebidas y productos gourmet',
                'image' => 'images/alimentos.jpg',
                'subcategories' => [
                    'Alimentos Frescos',
                    'Bebidas',
                    'Snacks y Dulces',
                    'Productos Gourmet',
                ]
            ],
        ];

        foreach ($categories as $categoryData) {
            $slug = Str::slug($categoryData['name']);
            
            // Verificar si ya existe esta categoría
            $category = Category::where('slug', $slug)->first();
            
            if (!$category) {
                $category = Category::create([
                    'name' => $categoryData['name'],
                    'slug' => $slug,
                    'description' => $categoryData['description'],
                    'image' => $categoryData['image'] ?? null,
                    'is_active' => true,
                ]);
            }

            // Crear subcategorías si existen
            if (isset($categoryData['subcategories'])) {
                foreach ($categoryData['subcategories'] as $subCatName) {
                    $subSlug = Str::slug($subCatName);
                    
                    if (!Category::where('slug', $subSlug)->exists()) {
                        Category::create([
                            'name' => $subCatName,
                            'slug' => $subSlug,
                            'description' => $subCatName . ' - ' . $categoryData['name'],
                            'parent_id' => $category->id,
                            'is_active' => true,
                        ]);
                    }
                }
            }
        }
    }
}