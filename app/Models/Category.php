<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'is_active',
    ];

    /**
     * Los atributos que deben ser convertidos.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Obtener la categoría padre.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Obtener las subcategorías.
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Obtener todos los productos de esta categoría.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Obtener todos los productos incluyendo los de subcategorías.
     */
    public function allProducts()
    {
        $productIds = $this->products()->pluck('id');
        
        // Si tiene subcategorías, agregar sus productos
        $subcategoryIds = $this->children()->pluck('id');
        if ($subcategoryIds->isNotEmpty()) {
            $subcategoryProducts = Product::whereIn('category_id', $subcategoryIds)->pluck('id');
            $productIds = $productIds->merge($subcategoryProducts);
        }
        
        return Product::whereIn('id', $productIds);
    }
}