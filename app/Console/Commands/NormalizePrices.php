<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class NormalizePrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prices:normalize {--dry : Show changes but do not persist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Normalize product prices stored in cents to decimal units (divide by 100 when appropriate)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dry = $this->option('dry');

        $this->info('Scanning products for price normalization...');

        $products = Product::all();
        $count = 0;

        foreach ($products as $product) {
            $updated = false;

            // Normalize price
            $price = (float) $product->price;
            if ($price > 1000) {
                $newPrice = round($price / 100.0, 2);
                $this->line("Product {$product->id} ({$product->name}): price {$price} -> {$newPrice}");
                if (!$dry) {
                    $product->price = $newPrice;
                    $updated = true;
                }
            }

            // Normalize sale_price if present
            if (!is_null($product->sale_price)) {
                $sale = (float) $product->sale_price;
                if ($sale > 1000) {
                    $newSale = round($sale / 100.0, 2);
                    $this->line("Product {$product->id} ({$product->name}): sale_price {$sale} -> {$newSale}");
                    if (!$dry) {
                        $product->sale_price = $newSale;
                        $updated = true;
                    }
                }
            }

            if ($updated) {
                $product->save();
                $count++;
            }
        }

        $this->info("Done. Updated {$count} product(s)." . ($dry ? ' (dry run)' : ''));

        return 0;
    }
}
