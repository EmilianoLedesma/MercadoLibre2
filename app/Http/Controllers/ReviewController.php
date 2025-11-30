<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'order_id' => 'nullable|exists:orders,id',
        ]);

        // Verificar si el usuario ya dejó una reseña
        $existingReview = Review::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'Ya has dejado una reseña para este producto');
        }

        // Verificar si es una compra verificada
        $isVerifiedPurchase = false;
        if ($request->order_id) {
            $order = Order::where('id', $request->order_id)
                ->where('user_id', Auth::id())
                ->whereHas('items', function ($query) use ($product) {
                    $query->where('product_id', $product->id);
                })
                ->first();

            $isVerifiedPurchase = $order !== null;
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_verified_purchase' => $isVerifiedPurchase,
        ]);

        return back()->with('success', '¡Gracias por tu reseña!');
    }

    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            return back()->with('error', 'No tienes permiso para editar esta reseña');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Reseña actualizada correctamente');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            return back()->with('error', 'No tienes permiso para eliminar esta reseña');
        }

        $review->delete();

        return back()->with('success', 'Reseña eliminada correctamente');
    }
}
