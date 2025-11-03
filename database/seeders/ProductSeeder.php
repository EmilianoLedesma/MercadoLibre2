<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que existan usuarios y categorías
        $userCount = User::count();
        if ($userCount === 0) {
            User::factory(5)->create();
        }
        
        $categoryCount = Category::count();
        if ($categoryCount === 0) {
            $this->call(CategorySeeder::class);
        }
        
        // Crear 30 productos
        $products = Product::factory(30)->create();

        // Asegurarse de que cada producto tenga al menos un path de imagen válido.
        // Si no existe el fichero en storage o en public, asignamos un placeholder público.
        foreach ($products as $product) {
            $images = is_string($product->images) ? json_decode($product->images, true) : ($product->images ?? []);
            $images = $images ?? [];

            $validImages = [];
            foreach ($images as $img) {
                $storagePath = storage_path('app/public/' . $img);
                $publicPath = public_path($img);
                if ($img && (file_exists($storagePath) || file_exists($publicPath))) {
                    $validImages[] = $img;
                }
            }

            if (empty($validImages)) {
                // usar placeholder público almacenado en public/images
                $product->images = json_encode(['images/placeholder-product.svg']);
                $product->save();
            }
        }
    }
}