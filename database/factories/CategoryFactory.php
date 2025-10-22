<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(rand(1, 2), true);
        
        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(rand(10, 20)),
            'image' => $this->faker->boolean(70) ? 'categories/category_' . $this->faker->numberBetween(1, 10) . '.jpg' : null,
            'parent_id' => $this->faker->boolean(30) ? Category::inRandomOrder()->first()->id : null, // 30% de probabilidad de tener un padre
            'is_active' => $this->faker->boolean(90), // 90% de probabilidad de estar activo
        ];
    }
}