<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WishlistController extends Controller
{
    /**
     * Display the wishlist
     */
    public function index()
    {
        $wishlist = session()->get('wishlist', []);

        // Get full product details for wishlist items
        if (!empty($wishlist)) {
            $wishlistItems = Product::whereIn('id', array_keys($wishlist))->get();
        } else {
            $wishlistItems = collect(); // Return empty collection instead of array
        }

        return view('wishlist.index', compact('wishlistItems'));
    }

    /**
     * Add product to wishlist
     */
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $wishlist = session()->get('wishlist', []);

        // Add product to wishlist if not already there
        if (!isset($wishlist[$productId])) {
            $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
            
            $wishlist[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->sale_price ?? $product->price,
                'original_price' => $product->price,
                'images' => $images,
                'stock_quantity' => $product->stock_quantity,
                'added_at' => now()->toDateTimeString()
            ];

            session()->put('wishlist', $wishlist);

            return response()->json([
                'success' => true,
                'message' => 'Producto agregado a la lista de deseos',
                'count' => count($wishlist)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'El producto ya está en tu lista de deseos'
        ]);
    }

    /**
     * Remove product from wishlist
     */
    public function remove($productId)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$productId])) {
            unset($wishlist[$productId]);
            session()->put('wishlist', $wishlist);

            return response()->json([
                'success' => true,
                'message' => 'Producto eliminado de la lista de deseos',
                'count' => count($wishlist)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Producto no encontrado en la lista de deseos'
        ]);
    }

    /**
     * Clear entire wishlist
     */
    public function clear()
    {
        session()->forget('wishlist');

        return redirect()->route('wishlist.index')->with('success', 'Lista de deseos vaciada');
    }

    /**
     * Move product from wishlist to cart
     */
    public function moveToCart($productId)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$productId])) {
            // Get product details
            $product = Product::findOrFail($productId);
            
            // Check stock
            if ($product->stock_quantity < 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Producto sin stock disponible'
                ], 400);
            }

            // Add to cart
            $cart = session()->get('cart', []);
            $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
            $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;

            if (isset($cart[$productId])) {
                // Check if adding one more exceeds stock
                if ($product->stock_quantity < $cart[$productId]['quantity'] + 1) {
                    return response()->json([
                        'success' => false,
                        'message' => 'No hay suficiente stock disponible'
                    ], 400);
                }
                $cart[$productId]['quantity']++;
            } else {
                $cart[$productId] = [
                    'name' => $product->name,
                    'price' => round((float)($product->sale_price ?? $product->price), 2),
                    'quantity' => 1,
                    'image' => $firstImage ? asset('storage/' . $firstImage) : 'https://via.placeholder.com/60x75',
                    'stock' => $product->stock_quantity,
                ];
            }

            session()->put('cart', $cart);

            // Remove from wishlist
            unset($wishlist[$productId]);
            session()->put('wishlist', $wishlist);

            return response()->json([
                'success' => true,
                'message' => 'Producto agregado al carrito',
                'wishlist_count' => count($wishlist),
                'cart_count' => array_sum(array_column($cart, 'quantity'))
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Producto no encontrado en la lista de deseos'
        ], 404);
    }
}
