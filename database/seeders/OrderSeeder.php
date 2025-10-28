<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Address;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que existan usuarios, direcciones y productos
        $userCount = User::count();
        if ($userCount === 0) {
            User::factory(5)->create();
        }
        
        $addressCount = Address::count();
        if ($addressCount === 0) {
            $this->call(AddressSeeder::class);
        }
        
        $productCount = Product::count();
        if ($productCount === 0) {
            $this->call(ProductSeeder::class);
        }
        
        // Crear 20 órdenes
        Order::factory(20)->create()->each(function ($order) {
            // Para cada orden, crear entre 1 y 5 items (productos)
            $itemCount = rand(1, 5);
            
            // Obtener productos aleatorios sin repetir
            $products = Product::inRandomOrder()->limit($itemCount)->get();
            
            foreach ($products as $product) {
                $quantity = rand(1, 3);
                $price = $product->sale_price ?? $product->price;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $price * $quantity
                ]);
            }
            
            // Actualizar el subtotal de la orden basado en los items
            $items = $order->items;
            $subtotal = $items->sum('subtotal');
            $tax = $subtotal * 0.16; // IVA del 16%
            $total = $subtotal + $tax + $order->shipping_cost;
            
            $order->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total
            ]);
        });
    }
}