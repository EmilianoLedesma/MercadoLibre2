<?php

namespace App\Providers;

use App\Models\Category;
use App\Observers\CategoryObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.custom');
        Paginator::defaultSimpleView('vendor.pagination.custom');

        // Register observers for cache invalidation
        Category::observe(CategoryObserver::class);

        // Register global helper function for product images
        if (!function_exists('getProductImage')) {
            function getProductImage($imagesData, $defaultPlaceholder = 'https://via.placeholder.com/300x375')
            {
                // Handle different data structures

                // Case 1: Already processed URL (from session cart)
                if (is_string($imagesData) && filter_var($imagesData, FILTER_VALIDATE_URL)) {
                    return $imagesData;
                }

                // Case 2: Product model's images field (array or string)
                $images = null;

                if (is_array($imagesData)) {
                    $images = $imagesData;
                } elseif (is_string($imagesData)) {
                    $images = json_decode($imagesData, true);
                }

                // Process the images array
                if (is_array($images) && !empty($images)) {
                    $firstImage = $images[0];

                    // If it's already a full URL, use it
                    if (filter_var($firstImage, FILTER_VALIDATE_URL)) {
                        return $firstImage;
                    }

                    // Otherwise, assume it's a storage path
                    return asset('storage/' . $firstImage);
                }

                // Fallback to placeholder
                return $defaultPlaceholder;
            }
        }
    }
}
