<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Verificar si hay categorías, si no, crear las categorías básicas
        $categoriesCount = Category::count();
        if ($categoriesCount === 0) {
            $this->createDefaultCategories();
        }
        
        $categories = Category::where('is_active', true)->get();
        return view('products.create', compact('categories'));
    }
    
    /**
     * Crear categorías por defecto si no existen
     */
    private function createDefaultCategories()
    {
        $categories = [
            [
                'name' => 'Hombre',
                'description' => 'Ropa y accesorios para hombre',
            ],
            [
                'name' => 'Mujer',
                'description' => 'Moda femenina y accesorios',
            ],
            [
                'name' => 'Niños',
                'description' => 'Ropa y juguetes para niños',
            ],
            [
                'name' => 'Accesorios',
                'description' => 'Complementos y accesorios',
            ],
            [
                'name' => 'Calzado',
                'description' => 'Zapatos y zapatillas para todos',
            ],
            [
                'name' => 'Deportes',
                'description' => 'Ropa y equipamiento deportivo',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'description' => $categoryData['description'],
                'is_active' => true,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $productData = $request->except('images');
        $productData['slug'] = Str::slug($request->name);
        $productData['user_id'] = Auth::id();

        // Procesar imágenes
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = $path;
            }
        }
        $productData['images'] = json_encode($images);

        $product = Product::create($productData);

        return redirect()->route('products.index')
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category', 'user');
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Verificar si hay categorías, si no, crear las categorías básicas
        $categoriesCount = Category::count();
        if ($categoriesCount === 0) {
            $this->createDefaultCategories();
        }
        
        $categories = Category::where('is_active', true)->get();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'sku' => 'required|string|max:100|unique:products,sku,'.$product->id,
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'nullable|array'
        ]);

        $productData = $request->except(['images', 'delete_images']);
        $productData['slug'] = Str::slug($request->name);

        // Actualizar imágenes
        $currentImages = json_decode($product->images, true) ?? [];
        
        // Eliminar imágenes marcadas
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $index) {
                if (isset($currentImages[$index])) {
                    // Eliminar del almacenamiento
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

        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Eliminar imágenes asociadas
        $images = json_decode($product->images, true) ?? [];
        foreach ($images as $image) {
            Storage::disk('public')->delete($image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}