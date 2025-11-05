<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "\n=== PRODUCTOS POR CATEGORÍA ===\n\n";
echo "Total de productos: " . App\Models\Product::count() . "\n\n";

$categories = App\Models\Category::withCount('products')->orderBy('name')->get();

foreach ($categories as $cat) {
    echo sprintf("%-35s | %3d productos\n", $cat->name, $cat->products_count);
}

echo "\n";
