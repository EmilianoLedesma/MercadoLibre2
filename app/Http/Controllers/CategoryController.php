<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index()
    {
        // Cache categories for 1 hour - solo categorías principales
        $categories = Cache::remember('categories_active_with_count', 3600, function () {
            return Category::where('is_active', true)
                ->whereNull('parent_id') // Solo categorías principales
                ->get()
                ->map(function ($category) {
                    // Obtener IDs de subcategorías
                    $subcategoryIds = Category::where('parent_id', $category->id)->pluck('id');

                    // Contar productos de la categoría padre y sus subcategorías
                    $productsCount = Product::where('is_active', true)->where(function($query) use ($category, $subcategoryIds) {
                        $query->where('category_id', $category->id)
                              ->orWhereIn('category_id', $subcategoryIds);
                    })->count();

                    $category->products_count = $productsCount;
                    return $category;
                });
        });

        // Cache stats for 1 hour
        $totalProducts = Cache::remember('stats_total_products', 3600, function () {
            return Product::count();
        });

        $totalCategories = Cache::remember('stats_total_categories', 3600, function () {
            return Category::where('is_active', true)->count();
        });

        $completedOrders = Cache::remember('stats_completed_orders', 3600, function () {
            return Order::where('status', 'completed')->count();
        });

        return view('categories', compact('categories', 'totalProducts', 'totalCategories', 'completedOrders'));
    }
}
