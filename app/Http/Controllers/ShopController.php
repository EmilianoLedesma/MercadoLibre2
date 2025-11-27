<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display the shop page with products and filters
     */
    public function index(Request $request)
    {
        $query = Product::with('category:id,name,slug')
            ->select('id', 'name', 'slug', 'price', 'sale_price', 'images', 'is_featured', 'category_id', 'created_at')
            ->where('is_active', true);

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Filter by price range
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Search by name
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        // Sort
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(12);

        // Cache categories for 1 hour
        $categories = cache()->remember('active_categories_with_count', 3600, function () {
            return Category::where('is_active', true)
                ->select('id', 'name', 'slug')
                ->withCount('products')
                ->get();
        });

        return view('shop.index', compact('products', 'categories'));
    }

    /**
     * Display a single product detail page
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category:id,name,slug', 'user:id,name,last_name,email'])
            ->firstOrFail();

        // Get related products from same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->select('id', 'name', 'slug', 'price', 'sale_price', 'images', 'category_id')
            ->limit(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }

    /**
     * Display products by category
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->select('id', 'name', 'slug', 'description')
            ->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->select('id', 'name', 'slug', 'price', 'sale_price', 'images', 'is_featured', 'category_id')
            ->paginate(12);

        // Cache categories for 1 hour
        $categories = cache()->remember('active_categories_with_count', 3600, function () {
            return Category::where('is_active', true)
                ->select('id', 'name', 'slug')
                ->withCount('products')
                ->get();
        });

        return view('shop.category', compact('category', 'products', 'categories'));
    }

    /**
     * Search products (API endpoint for AJAX)
     */
    public function search(Request $request)
    {
        try {
            $query = $request->get('q', '');
            
            if (strlen($query) < 2) {
                return response()->json([
                    'success' => false,
                    'message' => 'Query too short',
                    'products' => [],
                    'total' => 0
                ]);
            }

            $products = Product::with('category:id,name,slug')
                ->select('id', 'name', 'slug', 'price', 'sale_price', 'images', 'category_id')
                ->where('is_active', true)
                ->where('name', 'like', '%'.$query.'%')
                ->limit(10)
                ->get();

            return response()->json([
                'success' => true,
                'products' => $products->map(function($product) {
                    // El cast 'json' en el modelo ya deserializa automáticamente
                    $images = is_array($product->images) ? $product->images : (is_string($product->images) ? json_decode($product->images, true) : []);
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'price' => floatval($product->sale_price ?? $product->price),
                        'original_price' => $product->sale_price ? floatval($product->price) : null,
                        'image' => !empty($images) ? asset('storage/' . $images[0]) : null,
                        'category' => $product->category->name ?? 'Sin categoría',
                        'url' => route('shop.show', $product->slug)
                    ];
                }),
                'total' => $products->count()
            ]);
        } catch (\Exception $e) {
            \Log::error('Search error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al buscar productos',
                'products' => [],
                'total' => 0
            ], 500);
        }
    }
}
