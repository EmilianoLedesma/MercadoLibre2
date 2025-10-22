<?php

// Verificar la configuración de almacenamiento
echo "Configuración de almacenamiento:\n";
$config = config('filesystems');
echo "Disco por defecto: " . $config['default'] . "\n";
echo "URL de disco público: " . $config['disks']['public']['url'] . "\n";
echo "Raíz de disco público: " . $config['disks']['public']['root'] . "\n\n";

// Verificar el enlace simbólico
$linkTarget = public_path('storage');
$linkExists = file_exists($linkTarget);
echo "Enlace simbólico:\n";
echo "Ruta: " . $linkTarget . "\n";
echo "Existe: " . ($linkExists ? 'Sí' : 'No') . "\n";
if ($linkExists && is_link($linkTarget)) {
    echo "Apunta a: " . readlink($linkTarget) . "\n\n";
}

// Verificar el directorio de productos
$productsDir = storage_path('app/public/products');
echo "Directorio de productos:\n";
echo "Ruta: " . $productsDir . "\n";
echo "Existe: " . (file_exists($productsDir) ? 'Sí' : 'No') . "\n";
if (file_exists($productsDir)) {
    $files = scandir($productsDir);
    echo "Archivos: " . implode(', ', array_diff($files, ['.', '..'])) . "\n\n";
}

// Verificar un producto específico con imágenes
use App\Models\Product;
$product = Product::first();
if ($product) {
    echo "Producto de ejemplo:\n";
    echo "ID: " . $product->id . "\n";
    echo "Nombre: " . $product->name . "\n";
    echo "JSON de imágenes: " . $product->images . "\n";
    
    $images = json_decode($product->images, true) ?? [];
    echo "Imágenes decodificadas: " . implode(', ', $images) . "\n";
    
    foreach ($images as $image) {
        $imagePath = storage_path('app/public/' . $image);
        echo "Ruta de imagen: " . $imagePath . "\n";
        echo "Existe: " . (file_exists($imagePath) ? 'Sí' : 'No') . "\n";
        echo "URL pública: " . asset('storage/' . $image) . "\n";
    }
}