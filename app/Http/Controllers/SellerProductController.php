<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SellerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role !== 'seller') {
            return redirect()->route('home')->with('error', 'Acceso denegado');
        }

        $products = $user->products()->with('category')->latest()->paginate(10);

        return view('seller.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        
        if ($user->role !== 'seller') {
            return redirect()->route('home')->with('error', 'Acceso denegado');
        }

        $categories = Category::where('is_active', true)->get();

        return view('seller.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role !== 'seller') {
            return redirect()->route('home')->with('error', 'Acceso denegado');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'sku' => 'required|string|max:100|unique:products',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $productData = $validated;
        $productData['slug'] = Str::slug($request->name);
        $productData['user_id'] = $user->id;
        $productData['store_id'] = $user->store ? $user->store->id : null;
        $productData['is_active'] = $request->has('is_active') ? true : false;
        $productData['is_featured'] = $request->has('is_featured') ? true : false;

        // Procesar imágenes
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = $path;
            }
        }
        $productData['images'] = json_encode($images);

        Product::create($productData);

        return redirect()->route('seller.products.index')
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        
        if ($user->role !== 'seller') {
            return redirect()->route('home')->with('error', 'Acceso denegado');
        }

        $product = Product::where('user_id', $user->id)->findOrFail($id);
        $product->load('category', 'store');

        return view('seller.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        
        if ($user->role !== 'seller') {
            return redirect()->route('home')->with('error', 'Acceso denegado');
        }

        $product = Product::where('user_id', $user->id)->findOrFail($id);
        $categories = Category::where('is_active', true)->get();

        return view('seller.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        
        if ($user->role !== 'seller') {
            return redirect()->route('home')->with('error', 'Acceso denegado');
        }

        $product = Product::where('user_id', $user->id)->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'nullable|array',
        ]);

        $productData = $request->except(['images', 'delete_images']);
        $productData['slug'] = Str::slug($request->name);
        $productData['is_active'] = $request->has('is_active') ? true : false;
        $productData['is_featured'] = $request->has('is_featured') ? true : false;

        // Actualizar imágenes
        // El cast 'json' en el modelo ya deserializa automáticamente
        $currentImages = is_array($product->images) ? $product->images : (is_string($product->images) ? json_decode($product->images, true) : []);

        // Eliminar imágenes marcadas
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $index) {
                if (isset($currentImages[$index])) {
                    Storage::disk('public')->delete($currentImages[$index]);
                    unset($currentImages[$index]);
                }
            }
            $currentImages = array_values($currentImages);
        }

        // Añadir nuevas imágenes
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $currentImages[] = $path;
            }
        }

        $productData['images'] = json_encode($currentImages);

        $product->update($productData);

        return redirect()->route('seller.products.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        
        if ($user->role !== 'seller') {
            return redirect()->route('home')->with('error', 'Acceso denegado');
        }

        $product = Product::where('user_id', $user->id)->findOrFail($id);

        // Eliminar imágenes asociadas
        // El cast 'json' en el modelo ya deserializa automáticamente
        $images = is_array($product->images) ? $product->images : (is_string($product->images) ? json_decode($product->images, true) : []);
        foreach ($images as $image) {
            Storage::disk('public')->delete($image);
        }

        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
