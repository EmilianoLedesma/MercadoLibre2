<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "\n=== PRODUCTOS DE MERCADO LIBRE ===\n\n";

$products = App\Models\Product::with('category', 'user')->take(15)->get();

foreach ($products as $p) {
    echo sprintf(
        "%-50s | %-25s | $%-10s | Stock: %-5d | Vendedor: %s\n",
        substr($p->name, 0, 49),
        substr($p->category->name, 0, 24),
        number_format($p->price, 0, ',', '.'),
        $p->stock_quantity,
        substr($p->user->name, 0, 20)
    );
}

echo "\n=== CATEGORÍAS ===\n\n";
$categories = App\Models\Category::withCount('products')->get();
foreach ($categories as $cat) {
    echo sprintf("%-30s | Productos: %d\n", $cat->name, $cat->products_count);
}

echo "\n=== PEDIDOS RECIENTES ===\n\n";
$orders = App\Models\Order::with('user')->latest()->take(5)->get();
foreach ($orders as $order) {
    echo sprintf(
        "%s | Usuario: %-25s | Total: $%-10s | Estado: %s\n",
        $order->order_number,
        substr($order->user->name, 0, 24),
        number_format($order->total, 2, ',', '.'),
        $order->status
    );
}

echo "\n";
