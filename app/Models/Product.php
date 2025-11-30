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
        'specifications',
        'sku',
        'price',
        'sale_price',
        'stock_quantity',
        'category_id',
        'user_id',
        'store_id',
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
        'specifications' => 'json',
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

    /**
     * Obtener la tienda del producto.
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Obtener las reseñas del producto.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Calcular el rating promedio del producto.
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    /**
     * Calcular el porcentaje de descuento.
     */
    public function getDiscountPercentageAttribute()
    {
        if ($this->sale_price && $this->sale_price < $this->price) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    /**
     * Obtener el precio final (sale_price si existe, sino price).
     */
    public function getFinalPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }

    /**
     * Verificar si el producto es nuevo (creado en los últimos 30 días).
     */
    public function isNew()
    {
        return $this->created_at && $this->created_at->diffInDays(now()) <= 30;
    }

    /**
     * Verificar si el producto tiene descuento.
     */
    public function hasDiscount()
    {
        return $this->sale_price && $this->sale_price < $this->price;
    }
}