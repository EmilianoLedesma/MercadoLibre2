<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ApiResponseTrait;

    /**
     * Listar productos con paginación y filtros
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Product::with('category');

            // Filtro por categoría
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            // Filtro por estado activo
            if ($request->has('is_active')) {
                $query->where('is_active', filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN));
            }

            // Filtro por destacados
            if ($request->has('is_featured')) {
                $query->where('is_featured', filter_var($request->is_featured, FILTER_VALIDATE_BOOLEAN));
            }

            // Filtro por rango de precio
            if ($request->has('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }
            if ($request->has('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }

            // Búsqueda por nombre
            if ($request->has('search')) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('description', 'like', '%'.$request->search.'%')
                        ->orWhere('sku', 'like', '%'.$request->search.'%');
                });
            }

            // Ordenamiento
            $sortBy = $request->get('sort_by', 'created_at');
            $sortOrder = $request->get('sort_order', 'desc');
            $query->orderBy($sortBy, $sortOrder);

            // Paginación
            $perPage = $request->get('per_page', 15);
            $products = $query->paginate($perPage);

            return $this->successResponse([
                'products' => $products->items(),
                'pagination' => [
                    'total' => $products->total(),
                    'per_page' => $products->perPage(),
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'from' => $products->firstItem(),
                    'to' => $products->lastItem(),
                ],
            ], 'Productos obtenidos exitosamente');
        } catch (\Exception $e) {
            return $this->serverErrorResponse('Error al obtener productos: '.$e->getMessage());
        }
    }

    /**
     * Mostrar un producto específico
     */
    public function show($id): JsonResponse
    {
        try {
            $product = Product::with('category')->find($id);

            if (! $product) {
                return $this->notFoundResponse('Producto no encontrado');
            }

            return $this->successResponse($product, 'Producto obtenido exitosamente');
        } catch (\Exception $e) {
            return $this->serverErrorResponse('Error al obtener producto: '.$e->getMessage());
        }
    }

    /**
     * Crear un nuevo producto
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse(
                $validator->errors()->toArray(),
                'Error de validación'
            );
        }

        try {
            $product = Product::create([
                'name' => $request->name,
                'slug' => \Illuminate\Support\Str::slug($request->name),
                'description' => $request->description,
                'sku' => $request->sku,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'stock_quantity' => $request->stock_quantity,
                'category_id' => $request->category_id,
                'images' => $request->images ?? [],
                'is_active' => $request->get('is_active', true),
                'is_featured' => $request->get('is_featured', false),
                'user_id' => auth()->id(),
            ]);

            return $this->successResponse(
                $product->load('category'),
                'Producto creado exitosamente',
                201
            );
        } catch (\Exception $e) {
            return $this->serverErrorResponse('Error al crear producto: '.$e->getMessage());
        }
    }

    /**
     * Actualizar un producto existente
     */
    public function update(Request $request, $id): JsonResponse
    {
        $product = Product::find($id);

        if (! $product) {
            return $this->notFoundResponse('Producto no encontrado');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'sometimes|required|string|unique:products,sku,'.$id,
            'price' => 'sometimes|required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'sometimes|required|integer|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
            'images' => 'nullable|array',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse(
                $validator->errors()->toArray(),
                'Error de validación'
            );
        }

        try {
            $updateData = $request->only([
                'name',
                'description',
                'sku',
                'price',
                'sale_price',
                'stock_quantity',
                'category_id',
                'images',
                'is_active',
                'is_featured',
            ]);

            if (isset($updateData['name'])) {
                $updateData['slug'] = \Illuminate\Support\Str::slug($updateData['name']);
            }

            $product->update($updateData);

            return $this->successResponse(
                $product->load('category'),
                'Producto actualizado exitosamente'
            );
        } catch (\Exception $e) {
            return $this->serverErrorResponse('Error al actualizar producto: '.$e->getMessage());
        }
    }

    /**
     * Eliminar un producto
     */
    public function destroy($id): JsonResponse
    {
        try {
            $product = Product::find($id);

            if (! $product) {
                return $this->notFoundResponse('Producto no encontrado');
            }

            $product->delete();

            return $this->successResponse(null, 'Producto eliminado exitosamente');
        } catch (\Exception $e) {
            return $this->serverErrorResponse('Error al eliminar producto: '.$e->getMessage());
        }
    }
}
