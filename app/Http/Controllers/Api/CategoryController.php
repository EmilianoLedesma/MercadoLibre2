<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Listar categorías con paginación
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Category::withCount('products');

            // Filtro por estado activo
            if ($request->has('is_active')) {
                $query->where('is_active', filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN));
            }

            // Búsqueda por nombre
            if ($request->has('search')) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('description', 'like', '%'.$request->search.'%');
                });
            }

            // Ordenamiento
            $sortBy = $request->get('sort_by', 'name');
            $sortOrder = $request->get('sort_order', 'asc');
            $query->orderBy($sortBy, $sortOrder);

            // Paginación
            $perPage = $request->get('per_page', 15);
            $categories = $query->paginate($perPage);

            return $this->successResponse([
                'categories' => $categories->items(),
                'pagination' => [
                    'total' => $categories->total(),
                    'per_page' => $categories->perPage(),
                    'current_page' => $categories->currentPage(),
                    'last_page' => $categories->lastPage(),
                    'from' => $categories->firstItem(),
                    'to' => $categories->lastItem(),
                ],
            ], 'Categorías obtenidas exitosamente');
        } catch (\Exception $e) {
            return $this->serverErrorResponse('Error al obtener categorías: '.$e->getMessage());
        }
    }

    /**
     * Mostrar una categoría específica con sus productos
     */
    public function show($id): JsonResponse
    {
        try {
            $category = Category::with('products')->find($id);

            if (! $category) {
                return $this->notFoundResponse('Categoría no encontrada');
            }

            return $this->successResponse($category, 'Categoría obtenida exitosamente');
        } catch (\Exception $e) {
            return $this->serverErrorResponse('Error al obtener categoría: '.$e->getMessage());
        }
    }

    /**
     * Crear una nueva categoría
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse(
                $validator->errors()->toArray(),
                'Error de validación'
            );
        }

        try {
            $category = Category::create([
                'name' => $request->name,
                'slug' => \Illuminate\Support\Str::slug($request->name),
                'description' => $request->description,
                'is_active' => $request->get('is_active', true),
            ]);

            return $this->successResponse(
                $category,
                'Categoría creada exitosamente',
                201
            );
        } catch (\Exception $e) {
            return $this->serverErrorResponse('Error al crear categoría: '.$e->getMessage());
        }
    }

    /**
     * Actualizar una categoría existente
     */
    public function update(Request $request, $id): JsonResponse
    {
        $category = Category::find($id);

        if (! $category) {
            return $this->notFoundResponse('Categoría no encontrada');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255|unique:categories,name,'.$id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
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
                'is_active',
            ]);

            if (isset($updateData['name'])) {
                $updateData['slug'] = \Illuminate\Support\Str::slug($updateData['name']);
            }

            $category->update($updateData);

            return $this->successResponse(
                $category,
                'Categoría actualizada exitosamente'
            );
        } catch (\Exception $e) {
            return $this->serverErrorResponse('Error al actualizar categoría: '.$e->getMessage());
        }
    }

    /**
     * Eliminar una categoría
     */
    public function destroy($id): JsonResponse
    {
        try {
            $category = Category::find($id);

            if (! $category) {
                return $this->notFoundResponse('Categoría no encontrada');
            }

            // Verificar si tiene productos asociados
            if ($category->products()->count() > 0) {
                return $this->errorResponse(
                    'No se puede eliminar la categoría porque tiene productos asociados',
                    400
                );
            }

            $category->delete();

            return $this->successResponse(null, 'Categoría eliminada exitosamente');
        } catch (\Exception $e) {
            return $this->serverErrorResponse('Error al eliminar categoría: '.$e->getMessage());
        }
    }
}
