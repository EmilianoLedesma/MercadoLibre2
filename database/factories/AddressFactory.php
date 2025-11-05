<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ciudades principales de Argentina
        $ciudades = [
            ['city' => 'Buenos Aires', 'state' => 'Capital Federal', 'postal_code' => '1000'],
            ['city' => 'Córdoba', 'state' => 'Córdoba', 'postal_code' => '5000'],
            ['city' => 'Rosario', 'state' => 'Santa Fe', 'postal_code' => '2000'],
            ['city' => 'Mendoza', 'state' => 'Mendoza', 'postal_code' => '5500'],
            ['city' => 'La Plata', 'state' => 'Buenos Aires', 'postal_code' => '1900'],
            ['city' => 'Mar del Plata', 'state' => 'Buenos Aires', 'postal_code' => '7600'],
            ['city' => 'San Miguel de Tucumán', 'state' => 'Tucumán', 'postal_code' => '4000'],
            ['city' => 'Salta', 'state' => 'Salta', 'postal_code' => '4400'],
        ];
        
        $location = $this->faker->randomElement($ciudades);
        
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'full_name' => $this->faker->name(),
            'phone' => $this->faker->numerify('+54 9 11 ####-####'),
            'address_line_1' => $this->faker->streetName() . ' ' . $this->faker->buildingNumber(),
            'address_line_2' => $this->faker->boolean(30) ? ('Piso ' . $this->faker->numberBetween(1, 10) . ', Depto ' . $this->faker->randomLetter()) : null,
            'city' => $location['city'],
            'state' => $location['state'],
            'postal_code' => $location['postal_code'],
            'country' => 'Argentina',
            'is_default' => $this->faker->boolean(20),
        ];
    }
}