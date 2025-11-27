<?php

// Script para corregir vendedores de productos

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\User;

echo "\n";
echo "=======================================================\n";
echo "    CORRECCIÓN DE VENDEDORES EN PRODUCTOS\n";
echo "=======================================================\n\n";

try {
    // Obtener vendedores
    $sellers = User::where('role', 'seller')->get();
    
    if ($sellers->count() === 0) {
        echo "❌ ERROR: No hay vendedores en la base de datos\n\n";
        echo "Ejecuta el seeder primero:\n";
        echo "   php artisan db:seed --class=UserSeeder\n\n";
        exit(1);
    }
    
    echo "✅ Vendedores disponibles: {$sellers->count()}\n";
    foreach ($sellers as $seller) {
        echo "   - {$seller->name} ({$seller->email})\n";
    }
    echo "\n";
    
    // Obtener productos con vendedores incorrectos (no son sellers)
    $incorrectProducts = Product::whereHas('user', function($query) {
        $query->where('role', '!=', 'seller');
    })->get();
    
    echo "Productos con vendedor incorrecto: {$incorrectProducts->count()}\n\n";
    
    if ($incorrectProducts->count() === 0) {
        echo "✅ Todos los productos tienen vendedores correctos\n\n";
        exit(0);
    }
    
    echo "Corrigiendo productos...\n\n";
    
    $corrected = 0;
    foreach ($incorrectProducts as $product) {
        $oldUser = $product->user;
        $newSeller = $sellers->random();
        
        $product->user_id = $newSeller->id;
        $product->save();
        
        $corrected++;
        
        echo "✓ Producto '{$product->name}'\n";
        echo "  Antiguo: {$oldUser->name} (rol: {$oldUser->role})\n";
        echo "  Nuevo:   {$newSeller->name} (rol: {$newSeller->role})\n\n";
    }
    
    echo "=======================================================\n";
    echo "✅ CORRECCIÓN COMPLETADA\n";
    echo "=======================================================\n\n";
    echo "Total de productos corregidos: {$corrected}\n\n";
    
    // Verificar que ya no haya productos incorrectos
    $remaining = Product::whereHas('user', function($query) {
        $query->where('role', '!=', 'seller');
    })->count();
    
    if ($remaining > 0) {
        echo "⚠️  Advertencia: Aún quedan {$remaining} productos con vendedor incorrecto\n";
    } else {
        echo "✅ Todos los productos ahora tienen vendedores correctos\n";
    }
    
    echo "\n";
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n\n";
    exit(1);
}

echo "=======================================================\n\n";
