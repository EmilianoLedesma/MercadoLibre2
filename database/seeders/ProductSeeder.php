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
        Product::factory(30)->create();
    }
}