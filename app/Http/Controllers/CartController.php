<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the shopping cart
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        // Prices in DB and seeders are normalized; no runtime heuristic required.
        return view('cart', compact('cart'));
    }

    /**
     * Add item to cart
     */
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $cart = session()->get('cart', []);

        // Get quantity from request, default to 1
        $quantity = $request->input('quantity', 1);

        // Check stock
        if ($product->stock_quantity < $quantity) {
            return redirect()->back()->with('error', 'No hay suficiente stock disponible');
        }

        // If product already in cart, update quantity
        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + $quantity;

            // Check if new quantity exceeds stock
            if ($product->stock_quantity < $newQuantity) {
                return redirect()->back()->with('error', 'No hay suficiente stock disponible');
            }

            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            // Add new item to cart
            $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
            $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;

            // Use sale_price when available, otherwise price (assume stored as decimal units)
            $price = (float) ($product->sale_price ?? $product->price);

            // Determine image URL - check if it's already a full URL
            $imageUrl = 'https://via.placeholder.com/60x75';
            if ($firstImage) {
                if (filter_var($firstImage, FILTER_VALIDATE_URL)) {
                    $imageUrl = $firstImage;
                } else {
                    $imageUrl = asset('storage/' . $firstImage);
                }
            }

            $cart[$productId] = [
                'name' => $product->name,
                'price' => round($price, 2),
                'quantity' => $quantity,
                'image' => $imageUrl,
                'stock' => $product->stock_quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $quantity = $request->input('quantity', 1);

            // Validate stock
            $product = Product::findOrFail($productId);
            if ($product->stock_quantity < $quantity) {
                return response()->json(['error' => 'No hay suficiente stock disponible'], 400);
            }

            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);

            return response()->json(['success' => true, 'message' => 'Cantidad actualizada']);
        }

        return response()->json(['error' => 'Producto no encontrado en el carrito'], 404);
    }

    /**
     * Remove item from cart
     */
    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Producto eliminado del carrito');
        }

        return redirect()->back()->with('error', 'Producto no encontrado en el carrito');
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart')->with('success', 'Carrito vaciado');
    }

    /**
     * Get cart count (for navbar)
     */
    public function count()
    {
        $cart = session()->get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));

        return response()->json(['count' => $count]);
    }
}
