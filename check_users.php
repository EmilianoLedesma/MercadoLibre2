<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

echo "==============================================\n";
echo "VERIFICACIÓN DE USUARIOS DE PRUEBA\n";
echo "==============================================\n\n";

$users = User::whereIn('email', [
    'admin@mercadolibre.com',
    'seller@mercadolibre.com',
    'customer@mercadolibre.com'
])->get(['id', 'name', 'email', 'role', 'is_active']);

if ($users->count() === 0) {
    echo "❌ No se encontraron usuarios de prueba\n";
    echo "Ejecuta: php artisan db:seed --class=UserSeeder\n\n";
    exit(1);
}

echo "Total de usuarios: " . User::count() . "\n\n";
echo "Usuarios de prueba:\n";
echo str_repeat("-", 80) . "\n";

foreach ($users as $user) {
    $active = $user->is_active ? '✓ Activo' : '✗ Inactivo';
    echo sprintf(
        "ID: %d | %-30s | %-25s | %-10s | %s\n",
        $user->id,
        $user->name,
        $user->email,
        strtoupper($user->role),
        $active
    );
}

echo str_repeat("-", 80) . "\n\n";

echo "✅ Usuarios listos para testing\n";
echo "\nCredenciales:\n";
echo "  - admin@mercadolibre.com / admin123\n";
echo "  - seller@mercadolibre.com / seller123\n";
echo "  - customer@mercadolibre.com / customer123\n";
echo "\n";
