<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with('category:id,name,slug')
            ->select('id', 'name', 'slug', 'price', 'stock_quantity', 'is_active', 'category_id', 'created_at')
            ->latest()
            ->paginate(10);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $products,
            ]);
        }

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

        $categories = cache()->remember('active_categories', 3600, function () {
            return Category::where('is_active', true)
                ->select('id', 'name')
                ->get();
        });

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
    public function store(StoreProductRequest $request)
    {
        try {
            $productData = $request->validated();
            $productData['slug'] = Str::slug($request->name);

            // Asignar user_id: si hay usuario autenticado, usar su ID, sino usar ID 1 por defecto
            $productData['user_id'] = Auth::id() ?? 1;

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

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Producto creado correctamente',
                    'data' => $product,
                ], 201);
            }

            return redirect()->route('products.index')
                ->with('success', 'Producto creado correctamente.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al crear producto: ' . $e->getMessage(),
                ], 500);
            }

            return back()->withInput()
                ->with('error', 'Error al crear producto: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Product $product)
    {
        $product->load('category', 'user');

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $product,
            ]);
        }

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

        $categories = cache()->remember('active_categories', 3600, function () {
            return Category::where('is_active', true)
                ->select('id', 'name')
                ->get();
        });

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $productData = $request->validated();
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

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Producto actualizado correctamente',
                    'data' => $product,
                ]);
            }

            return redirect()->route('products.index')
                ->with('success', 'Producto actualizado correctamente.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar producto: ' . $e->getMessage(),
                ], 500);
            }

            return back()->withInput()
                ->with('error', 'Error al actualizar producto: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        try {
            // Eliminar imágenes asociadas
            $images = json_decode($product->images, true) ?? [];
            foreach ($images as $image) {
                Storage::disk('public')->delete($image);
            }

            $product->delete();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Producto eliminado correctamente',
                ]);
            }

            return redirect()->route('products.index')
                ->with('success', 'Producto eliminado correctamente.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al eliminar producto: ' . $e->getMessage(),
                ], 500);
            }

            return back()->with('error', 'Error al eliminar producto: ' . $e->getMessage());
        }
    }
}
