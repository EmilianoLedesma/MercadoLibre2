<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
        'short_description',
        'sku',
        'price',
        'sale_price',
        'stock_quantity',
        'category_id',
        'user_id',
        'images',
        'is_active',
        'is_featured'
    ];

    /**
     * Los atributos que deben ser convertidos.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'stock_quantity' => 'integer',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'images' => 'json',
    ];

    /**
     * Obtener la categoría a la que pertenece el producto.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Obtener el vendedor (usuario) del producto.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}