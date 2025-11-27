<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /**
     * Display a listing of all products in the system.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'user']);

        // Búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filtro por categoría
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filtro por vendedor
        if ($request->filled('seller')) {
            $query->where('user_id', $request->seller);
        }

        // Filtro por estado
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Ordenamiento
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $products = $query->paginate(20)->withQueryString();
        $categories = Category::all();
        $sellers = User::where('role', 'seller')->get();

        return view('admin.products.index', compact('products', 'categories', 'sellers'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $sellers = User::where('role', 'seller')->get();

        return view('admin.products.edit', compact('product', 'categories', 'sellers'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Generar slug si el nombre cambió
        if ($product->name !== $validated['name']) {
            $baseSlug = Str::slug($validated['name']);
            $slug = $baseSlug;
            $counter = 1;

            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            $validated['slug'] = $slug;
        }

        // Procesar imágenes
        if ($request->hasFile('images')) {
            // Eliminar imágenes antiguas
            $oldImages = is_array($product->images) ? $product->images : json_decode($product->images, true);
            if ($oldImages) {
                foreach ($oldImages as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            // Guardar nuevas imágenes
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
            $validated['images'] = json_encode($imagePaths);
        }

        // Generar short_description si no se proporcionó
        if (empty($validated['short_description'])) {
            $validated['short_description'] = Str::limit($validated['description'], 150);
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        try {
            // Eliminar imágenes
            $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
            if ($images) {
                foreach ($images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            $product->delete();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.products.index')
                ->with('error', 'No se puede eliminar este producto porque tiene pedidos asociados.');
        }
    }

    /**
     * Toggle product active status.
     */
    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $product->is_active,
            'message' => $product->is_active ? 'Producto activado' : 'Producto desactivado'
        ]);
    }

    /**
     * Toggle product featured status.
     */
    public function toggleFeatured(Product $product)
    {
        $product->update(['is_featured' => !$product->is_featured]);

        return response()->json([
            'success' => true,
            'is_featured' => $product->is_featured,
            'message' => $product->is_featured ? 'Producto destacado' : 'Producto no destacado'
        ]);
    }
}
