<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $productId = $this->route('product')->id ?? $this->route('product');

        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'sku' => 'required|string|max:100|unique:products,sku,' . $productId,
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'delete_images' => 'nullable|array',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'sku.required' => 'El SKU es obligatorio.',
            'sku.unique' => 'Este SKU ya está en uso.',
            'price.required' => 'El precio es obligatorio.',
            'price.min' => 'El precio debe ser mayor o igual a 0.',
            'sale_price.lt' => 'El precio de oferta debe ser menor al precio normal.',
            'stock_quantity.required' => 'La cantidad en stock es obligatoria.',
            'stock_quantity.min' => 'La cantidad en stock debe ser mayor o igual a 0.',
            'category_id.required' => 'La categoría es obligatoria.',
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'images.*.image' => 'El archivo debe ser una imagen.',
            'images.*.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif, webp.',
            'images.*.max' => 'La imagen no debe ser mayor a 2MB.',
        ];
    }
}
