<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'order_number',
        'user_id',
        'address_id',
        'subtotal',
        'tax',
        'shipping_cost',
        'total',
        'status',
        'payment_status',
        'payment_method',
        'notes',
    ];

    /**
     * Los atributos que deben ser convertidos.
     *
     * @var array
     */
    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * Obtener el usuario que realizó el pedido.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener la dirección de entrega del pedido.
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Obtener todos los items (productos) del pedido.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}