<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    private $positiveComments = [
        'Excelente producto, justo lo que esperaba',
        'Muy buena calidad, totalmente recomendado',
        'El producto llegó en perfectas condiciones',
        'Superó mis expectativas, muy satisfecho',
        'Producto de excelente calidad, lo volvería a comprar',
        'Tal como se describe, muy contento con la compra',
        'Llegó rápido y bien empacado',
        'Increíble producto, 100% recomendado',
        'La mejor compra que he hecho',
        'Perfecto para lo que necesitaba',
        'Excelente relación calidad-precio',
        'Muy recomendable, superó expectativas',
        'Producto de primera calidad, muy feliz',
    ];

    private $neutralComments = [
        'Buena relación calidad-precio',
        'Cumple perfectamente con lo que promete',
        'Muy bueno, aunque podría mejorar en algunos detalles',
        'Satisfecho con la compra, buen producto',
        'Calidad aceptable por el precio',
        'El producto es bueno pero esperaba más',
        'Está bien, cumple su función',
        'Normal, ni bueno ni malo',
        'Aceptable para el precio que tiene',
    ];

    private $negativeComments = [
        'Regular, cumple pero nada extraordinario',
        'No es lo que esperaba, calidad mejorable',
        'Producto básico, cumple lo mínimo',
        'Decepcionante, esperaba mejor calidad',
        'No lo recomendaría, hay mejores opciones',
        'La calidad no es buena, material de baja gama',
        'No vale la pena por el precio',
        'Llegó con defectos, tuve que devolverlo',
        'Mala experiencia, no cumple lo prometido',
        'Muy por debajo de las expectativas',
        'Calidad muy inferior a lo mostrado',
        'No funciona correctamente, defectuoso',
    ];

    public function run(): void
    {
        $products = Product::all();
        $users = User::where('role', '!=', 'admin')->get();

        if ($products->isEmpty() || $users->isEmpty()) {
            $this->command->warn('No hay productos o usuarios para crear reseñas');
            return;
        }

        // Asignar calidad a cada producto
        foreach ($products as $index => $product) {
            $reviewedUsers = [];
            
            // Determinar el tipo de producto (20% malos, 30% regulares, 50% buenos)
            $rand = rand(1, 100);
            if ($rand <= 20) {
                $productQuality = 'bad';      // 20% productos malos
                $numReviews = rand(5, 10);    // Más reseñas para productos malos
            } elseif ($rand <= 50) {
                $productQuality = 'average';  // 30% productos regulares
                $numReviews = rand(4, 8);
            } else {
                $productQuality = 'good';     // 50% productos buenos
                $numReviews = rand(3, 8);
            }

            for ($i = 0; $i < $numReviews; $i++) {
                $availableUsers = $users->whereNotIn('id', $reviewedUsers);
                
                if ($availableUsers->isEmpty()) {
                    break;
                }

                $user = $availableUsers->random();
                $reviewedUsers[] = $user->id;

                // Verificar si el usuario tiene una orden con este producto
                $order = Order::where('user_id', $user->id)
                    ->whereHas('items', function ($query) use ($product) {
                        $query->where('product_id', $product->id);
                    })
                    ->first();

                $isVerifiedPurchase = $order !== null;

                // Generar rating y comentario según la calidad del producto
                [$rating, $comment] = $this->getRatingAndComment($productQuality);

                Review::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'order_id' => $order?->id,
                    'rating' => $rating,
                    'comment' => $comment,
                    'is_verified_purchase' => $isVerifiedPurchase,
                    'created_at' => now()->subDays(rand(1, 90)),
                ]);
            }
        }

        $this->command->info('Reseñas creadas exitosamente');
    }

    private function getRatingAndComment(string $quality): array
    {
        if ($quality === 'good') {
            // Productos buenos: 80% 5 estrellas, 15% 4 estrellas, 5% 3 estrellas
            $rand = rand(1, 100);
            if ($rand <= 80) {
                $rating = 5;
                $comment = $this->positiveComments[array_rand($this->positiveComments)];
            } elseif ($rand <= 95) {
                $rating = 4;
                $comment = rand(1, 100) <= 70 
                    ? $this->positiveComments[array_rand($this->positiveComments)]
                    : $this->neutralComments[array_rand($this->neutralComments)];
            } else {
                $rating = 3;
                $comment = $this->neutralComments[array_rand($this->neutralComments)];
            }
        } elseif ($quality === 'average') {
            // Productos regulares: distribución más balanceada
            $rand = rand(1, 100);
            if ($rand <= 30) {
                $rating = 5;
                $comment = $this->positiveComments[array_rand($this->positiveComments)];
            } elseif ($rand <= 55) {
                $rating = 4;
                $comment = $this->positiveComments[array_rand($this->positiveComments)];
            } elseif ($rand <= 80) {
                $rating = 3;
                $comment = $this->neutralComments[array_rand($this->neutralComments)];
            } elseif ($rand <= 95) {
                $rating = 2;
                $comment = rand(1, 100) <= 60
                    ? $this->neutralComments[array_rand($this->neutralComments)]
                    : $this->negativeComments[array_rand($this->negativeComments)];
            } else {
                $rating = 1;
                $comment = $this->negativeComments[array_rand($this->negativeComments)];
            }
        } else { // bad
            // Productos malos: mayoría de reseñas negativas
            $rand = rand(1, 100);
            if ($rand <= 10) {
                $rating = 5;
                $comment = $this->positiveComments[array_rand($this->positiveComments)];
            } elseif ($rand <= 25) {
                $rating = 4;
                $comment = $this->positiveComments[array_rand($this->positiveComments)];
            } elseif ($rand <= 40) {
                $rating = 3;
                $comment = $this->neutralComments[array_rand($this->neutralComments)];
            } elseif ($rand <= 70) {
                $rating = 2;
                $comment = $this->negativeComments[array_rand($this->negativeComments)];
            } else {
                $rating = 1;
                $comment = $this->negativeComments[array_rand($this->negativeComments)];
            }
        }

        return [$rating, $comment];
    }
}
