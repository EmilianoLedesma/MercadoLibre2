<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(rand(2, 4), true);
        $price = $this->faker->randomFloat(2, 50, 5000);
        $salePrice = $this->faker->boolean(30) ? $price * 0.8 : null; // 30% de probabilidad de tener un precio de oferta
        
        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraphs(rand(3, 5), true),
            'short_description' => $this->faker->sentence(rand(10, 15)),
            'sku' => $this->faker->unique()->bothify('PRD-####???'),
            'price' => $price,
            'sale_price' => $salePrice,
            'stock_quantity' => $this->faker->numberBetween(0, 100),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'images' => json_encode($this->getRandomImages()),
            'is_active' => $this->faker->boolean(90), // 90% de probabilidad de estar activo
            'is_featured' => $this->faker->boolean(20), // 20% de probabilidad de ser destacado
        ];
    }
    
    /**
     * Generar URLs de imágenes aleatorias para los productos
     */
    private function getRandomImages(): array
    {
        $images = [];
        $numImages = rand(1, 3);
        
        // En un entorno real se generarían imágenes reales, pero aquí usamos rutas de ejemplo
        for ($i = 0; $i < $numImages; $i++) {
            $images[] = 'products/product_' . $this->faker->numberBetween(1, 20) . '.jpg';
        }
        
        return $images;
    }
}