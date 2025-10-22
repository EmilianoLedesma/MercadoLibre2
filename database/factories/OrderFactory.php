<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 100, 10000);
        $tax = $subtotal * 0.16; // IVA del 16%
        $shippingCost = $this->faker->randomFloat(2, 0, 200);
        $total = $subtotal + $tax + $shippingCost;
        
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        $paymentStatuses = ['pending', 'paid', 'failed'];
        $paymentMethods = ['credit_card', 'debit_card', 'paypal', 'mercado_pago', 'cash_on_delivery'];
        
        // Generar un número de orden único con formato ORD-YYMM-XXXXX
        $orderNumber = 'ORD-' . date('ym') . '-' . $this->faker->unique()->numberBetween(10000, 99999);
        
        return [
            'order_number' => $orderNumber,
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'address_id' => function (array $attributes) {
                // Asegurarse de que la dirección pertenezca al mismo usuario
                $userId = $attributes['user_id'];
                return Address::where('user_id', $userId)->inRandomOrder()->first()->id 
                    ?? Address::factory()->create(['user_id' => $userId])->id;
            },
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            'status' => $this->faker->randomElement($statuses),
            'payment_status' => $this->faker->randomElement($paymentStatuses),
            'payment_method' => $this->faker->randomElement($paymentMethods),
            'notes' => $this->faker->boolean(30) ? $this->faker->paragraph() : null,
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}