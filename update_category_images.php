<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Category;

// Mapeo de categorías a imágenes
$categoryImages = [
    'tecnologia' => 'images/tecnologia.jpg',
    'electrodomesticos' => 'images/electrodomesticos.jpg',
    'hogar-y-muebles' => 'images/muebles.jpg',
    'moda' => 'images/moda.jpg',
    'deportes-y-fitness' => 'images/Deportes_y_fitness.jpg',
    'juguetes-y-bebes' => 'images/Juguetes.jpg',
    'belleza-y-cuidado-personal' => 'images/belleza_cuidado_personal.jpg',
    'herramientas' => 'images/herramientas.jpg',
    'libros-y-entretenimiento' => 'images/entretenimiento.jpg',
    'automotriz' => 'images/Automotriz.jpg',
    'jardin-y-exterior' => 'images/jardineria.jpg',
    'alimentos-y-bebidas' => 'images/alimentos.jpg',
];

echo "Actualizando imágenes de categorías...\n\n";

foreach ($categoryImages as $slug => $imagePath) {
    $category = Category::where('slug', $slug)->first();
    
    if ($category) {
        // Verificar si el archivo existe
        $fullPath = public_path($imagePath);
        if (file_exists($fullPath)) {
            $category->image = $imagePath;
            $category->save();
            echo "✓ Actualizada: {$category->name} -> {$imagePath}\n";
        } else {
            echo "✗ Archivo no encontrado: {$imagePath} para {$category->name}\n";
        }
    } else {
        echo "✗ Categoría no encontrada: {$slug}\n";
    }
}

echo "\n¡Actualización completada!\n";
