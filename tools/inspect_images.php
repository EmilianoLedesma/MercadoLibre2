<?php
// Quick script to inspect Product images field for debugging
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$products = Product::take(10)->get();
foreach ($products as $p) {
    $imgs = $p->images;
    if (is_array($imgs)) {
        $imgsJson = json_encode($imgs);
    } else {
        $imgsJson = $imgs;
    }
    echo "Product ID: {$p->id}\n";
    echo " images field raw: {$imgsJson}\n";
    if ($imgsJson) {
        $arr = json_decode($imgsJson, true);
        if (is_array($arr)) {
            foreach ($arr as $i) {
                $publicPath = __DIR__ . '/public/storage/' . $i;
                $exists = file_exists($publicPath) ? 'YES' : 'NO';
                echo "  -> path: {$i} (public/storage/{$i}) exists? {$exists}\n";
            }
        }
    }
    echo PHP_EOL;
}
