<?php

// Script para verificar y mostrar usuarios admin

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "\n";
echo "=================================================\n";
echo "    VERIFICACIÓN DE USUARIOS ADMIN\n";
echo "=================================================\n\n";

try {
    $totalUsers = User::count();
    echo "Total de usuarios en la base de datos: {$totalUsers}\n\n";
    
    if ($totalUsers === 0) {
        echo "⚠️  NO HAY USUARIOS EN LA BASE DE DATOS\n\n";
        echo "Ejecuta el seeder con:\n";
        echo "   php artisan db:seed --class=UserSeeder\n\n";
        exit(1);
    }
    
    $admins = User::where('role', 'admin')->get();
    
    if ($admins->count() === 0) {
        echo "⚠️  NO HAY USUARIOS CON ROL ADMIN\n\n";
        echo "Ejecuta el seeder con:\n";
        echo "   php artisan db:seed --class=UserSeeder\n\n";
        exit(1);
    }
    
    echo "✅ Usuarios ADMIN encontrados: {$admins->count()}\n\n";
    echo "-------------------------------------------------\n";
    
    foreach ($admins as $admin) {
        echo "👨‍💼 Nombre: {$admin->name}\n";
        echo "   Email:  {$admin->email}\n";
        echo "   Activo: " . ($admin->is_active ? '✅ Sí' : '❌ No') . "\n";
        echo "-------------------------------------------------\n";
    }
    
    echo "\n🔐 CREDENCIALES PRINCIPALES:\n\n";
    echo "Email:    admin@seals.mx\n";
    echo "Password: admin123\n\n";
    
    echo "🌐 URL de acceso:\n";
    echo "   Login:  http://localhost:8000/login\n";
    echo "   Admin:  http://localhost:8000/admin/products\n\n";
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n\n";
    echo "Asegúrate de que la base de datos esté configurada correctamente.\n\n";
    exit(1);
}

echo "=================================================\n\n";
