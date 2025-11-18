<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'logo',
        'banner',
        'phone',
        'email',
        'address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relación: tienda pertenece a un vendedor (usuario)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: tienda tiene muchos productos
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
