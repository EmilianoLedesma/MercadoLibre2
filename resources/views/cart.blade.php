@extends('layouts.app')

@section('title', 'Carrito de Compras')

@push('styles')
<style>
    .cart-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .cart-title {
        font-family: 'Jost', sans-serif;
        font-size: 36px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 40px;
        text-align: center;
    }

    .cart-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 40px;
    }

    /* Cart Items Table */
    .cart-table {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #E5E5E5;
    }

    .cart-table-header {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr auto;
        gap: 20px;
        padding: 20px;
        background-color: #F5F6F2;
        font-family: 'Jost', sans-serif;
        font-weight: 600;
        color: #212529;
        border-bottom: 1px solid #E5E5E5;
    }

    .cart-item {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr auto;
        gap: 20px;
        padding: 24px 20px;
        align-items: center;
        border-bottom: 1px solid #E5E5E5;
        transition: background-color 0.3s;
    }

    .cart-item:hover {
        background-color: #F8F8F8;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .item-product {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .item-image {
        width: 80px;
        height: 100px;
        background-color: #F5F6F2;
        border-radius: 4px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-details h4 {
        font-family: 'Jost', sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 8px;
    }

    .item-meta {
        font-family: 'Jost', sans-serif;
        font-size: 14px;
        color: #666;
    }

    .item-price {
        font-family: 'Jost', sans-serif;
        font-size: 18px;
        font-weight: 600;
        color: #EE403D;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        border: 1px solid #E5E5E5;
        border-radius: 4px;
        overflow: hidden;
        width: fit-content;
    }

    .qty-btn {
        padding: 8px 14px;
        background-color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
        color: #666;
        transition: background-color 0.3s;
    }

    .qty-btn:hover {
        background-color: #F5F6F2;
    }

    .qty-input {
        width: 50px;
        text-align: center;
        border: none;
        border-left: 1px solid #E5E5E5;
        border-right: 1px solid #E5E5E5;
        padding: 8px 0;
        font-family: 'Jost', sans-serif;
    }

    .item-total {
        font-family: 'Jost', sans-serif;
        font-size: 18px;
        font-weight: 600;
        color: #212529;
    }

    .remove-btn {
        background: none;
        border: none;
        color: #999;
        font-size: 24px;
        cursor: pointer;
        transition: color 0.3s;
        padding: 8px;
    }

    .remove-btn:hover {
        color: #EE403D;
    }

    /* Cart Summary */
    .cart-summary {
        background: white;
        border: 1px solid #E5E5E5;
        border-radius: 8px;
        padding: 32px;
        height: fit-content;
        position: sticky;
        top: 120px;
    }

    .summary-title {
        font-family: 'Jost', sans-serif;
        font-size: 24px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #E5E5E5;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 16px;
        font-family: 'Jost', sans-serif;
        font-size: 16px;
        color: #666;
    }

    .summary-item span:last-child {
        font-weight: 600;
        color: #212529;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 24px;
        padding-top: 24px;
        border-top: 2px solid #E5E5E5;
        font-family: 'Jost', sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: #212529;
    }

    .summary-total span:last-child {
        color: #EE403D;
    }

    .checkout-btn {
        width: 100%;
        padding: 16px;
        background-color: #EE403D;
        color: white;
        border: none;
        border-radius: 4px;
        font-family: 'Jost', sans-serif;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 24px;
        transition: background-color 0.3s;
    }

    .checkout-btn:hover {
        background-color: #E32020;
    }

    .continue-shopping {
        display: block;
        text-align: center;
        margin-top: 16px;
        color: #666;
        text-decoration: none;
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        transition: color 0.3s;
    }

    .continue-shopping:hover {
        color: #EE403D;
    }

    .empty-cart {
        text-align: center;
        padding: 80px 20px;
        color: #666;
        font-family: 'Jost', sans-serif;
    }

    .empty-cart i {
        font-size: 64px;
        color: #E5E5E5;
        margin-bottom: 24px;
    }

    .empty-cart h3 {
        font-size: 24px;
        margin-bottom: 16px;
        color: #212529;
    }

    @media (max-width: 968px) {
        .cart-grid {
            grid-template-columns: 1fr;
        }

        .cart-table-header {
            display: none;
        }

        .cart-item {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .cart-summary {
            position: static;
        }
    }
</style>
@endpush

@section('content')
<!-- TOP BANNER -->
<div style="background-color: #EE403D; color: white; text-align: center; padding: 12px 0; font-family: 'Jost', sans-serif;">
    <p style="margin: 0;">Envío gratis en compras mayores a $100</p>
</div>

<!-- SECONDARY HEADER -->
<div style="background-color: #F5F6F2; padding: 12px 0;">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px;">
        <nav style="display: flex; gap: 24px;">
            <a href="#" style="color: #666; text-decoration: none; font-size: 14px; font-family: 'Jost', sans-serif;">Nosotros</a>
            <a href="#" style="color: #666; text-decoration: none; font-size: 14px; font-family: 'Jost', sans-serif;">Mi Cuenta</a>
            <a href="#" style="color: #666; text-decoration: none; font-size: 14px; font-family: 'Jost', sans-serif;">Wishlist</a>
            <a href="#" style="color: #666; text-decoration: none; font-size: 14px; font-family: 'Jost', sans-serif;">Rastreo</a>
        </nav>
        <div style="display: flex; gap: 16px; align-items: center;">
            <span style="font-size: 14px; color: #666; font-family: 'Jost', sans-serif;">Necesitas ayuda? <strong>+0020 500</strong></span>
        </div>
    </div>
</div>

<!-- MAIN HEADER -->
<header style="background-color: white; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 20px 0;">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px;">
        <div style="flex-shrink: 0;">
            <a href="{{ route('home') }}" style="font-size: 32px; font-weight: 700; color: #212529; text-decoration: none; font-family: 'Jost', sans-serif;">SEALS</a>
        </div>

        <nav style="display: flex; gap: 32px; align-items: center;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif;">Inicio</a>
            <a href="{{ route('shop.index') }}" style="color: #666; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif;">Shop</a>
            <a href="{{ route('categories') }}" style="color: #666; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif;">Categorías</a>
            <a href="{{ route('contact') }}" style="color: #666; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif;">Contacto</a>
        </nav>

        <div style="display: flex; gap: 16px; align-items: center;">
            <button style="background: none; border: none; cursor: pointer; color: #212529; font-size: 20px;">
                <i class="fas fa-search"></i>
            </button>
            @auth
                <span style="color: #666; font-family: 'Jost', sans-serif;">Hola, {{ Auth::user()->name }}</span>
            @else
                <a href="{{ route('login') }}" style="color: #666; text-decoration: none;">
                    <i class="fas fa-user"></i>
                </a>
            @endauth
            <a href="{{ route('cart') }}" style="color: #EE403D; text-decoration: none; position: relative;">
                <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                <span style="position: absolute; top: -8px; right: -8px; background-color: #EE403D; color: white; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-family: 'Jost', sans-serif;">3</span>
            </a>
        </div>
    </div>
</header>

<!-- BREADCRUMB -->
<div style="background-color: #F8F8F8; padding: 20px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <nav style="font-family: 'Jost', sans-serif; font-size: 14px; color: #666;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="margin: 0 8px;">/</span>
            <span style="color: #212529; font-weight: 500;">Carrito</span>
        </nav>
    </div>
</div>

<!-- CART CONTAINER -->
<div class="cart-container">
    <h1 class="cart-title">Carrito de Compras</h1>

    <div class="cart-grid">
        <!-- Cart Items Table -->
        <div class="cart-table">
            <div class="cart-table-header">
                <div>Producto</div>
                <div>Precio</div>
                <div>Cantidad</div>
                <div>Total</div>
                <div></div>
            </div>

            <!-- Cart Item 1 -->
            <div class="cart-item">
                <div class="item-product">
                    <div class="item-image">
                        <img src="https://via.placeholder.com/80x100" alt="Producto 1">
                    </div>
                    <div class="item-details">
                        <h4>Bali Underwire Bra</h4>
                        <p class="item-meta">Color: Negro | Talla: M</p>
                    </div>
                </div>
                <div class="item-price">$99.00</div>
                <div class="quantity-controls">
                    <button class="qty-btn" onclick="updateQty(this, -1)">−</button>
                    <input type="number" value="1" min="1" class="qty-input" onchange="calculateTotal()">
                    <button class="qty-btn" onclick="updateQty(this, 1)">+</button>
                </div>
                <div class="item-total">$99.00</div>
                <button class="remove-btn" onclick="removeItem(this)">×</button>
            </div>

            <!-- Cart Item 2 -->
            <div class="cart-item">
                <div class="item-product">
                    <div class="item-image">
                        <img src="https://via.placeholder.com/80x100" alt="Producto 2">
                    </div>
                    <div class="item-details">
                        <h4>Maidenform Bra</h4>
                        <p class="item-meta">Color: Azul | Talla: L</p>
                    </div>
                </div>
                <div class="item-price">$85.00</div>
                <div class="quantity-controls">
                    <button class="qty-btn" onclick="updateQty(this, -1)">−</button>
                    <input type="number" value="2" min="1" class="qty-input" onchange="calculateTotal()">
                    <button class="qty-btn" onclick="updateQty(this, 1)">+</button>
                </div>
                <div class="item-total">$170.00</div>
                <button class="remove-btn" onclick="removeItem(this)">×</button>
            </div>

            <!-- Cart Item 3 -->
            <div class="cart-item">
                <div class="item-product">
                    <div class="item-image">
                        <img src="https://via.placeholder.com/80x100" alt="Producto 3">
                    </div>
                    <div class="item-details">
                        <h4>Champion Bra</h4>
                        <p class="item-meta">Color: Blanco | Talla: S</p>
                    </div>
                </div>
                <div class="item-price">$110.00</div>
                <div class="quantity-controls">
                    <button class="qty-btn" onclick="updateQty(this, -1)">−</button>
                    <input type="number" value="1" min="1" class="qty-input" onchange="calculateTotal()">
                    <button class="qty-btn" onclick="updateQty(this, 1)">+</button>
                </div>
                <div class="item-total">$110.00</div>
                <button class="remove-btn" onclick="removeItem(this)">×</button>
            </div>
        </div>

        <!-- Cart Summary -->
        <div class="cart-summary">
            <h3 class="summary-title">Resumen del Pedido</h3>

            <div class="summary-item">
                <span>Subtotal</span>
                <span id="subtotal">$379.00</span>
            </div>
            <div class="summary-item">
                <span>Envío</span>
                <span>$15.00</span>
            </div>
            <div class="summary-item">
                <span>Impuestos</span>
                <span id="tax">$39.40</span>
            </div>

            <div class="summary-total">
                <span>Total</span>
                <span id="total">$433.40</span>
            </div>

            <button class="checkout-btn">Proceder al Pago</button>
            <a href="{{ route('shop.index') }}" class="continue-shopping">
                <i class="fas fa-arrow-left"></i> Continuar Comprando
            </a>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer style="background-color: #212529; color: white; padding: 60px 20px 20px; margin-top: 80px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; margin-bottom: 40px;">
            <div>
                <h3 style="font-family: 'Jost', sans-serif; font-size: 24px; margin-bottom: 16px;">SEALS</h3>
                <p style="color: #999; font-family: 'Jost', sans-serif; line-height: 1.6;">Tu tienda de moda en línea con los mejores productos y precios.</p>
            </div>
            <div>
                <h4 style="font-family: 'Jost', sans-serif; font-size: 16px; margin-bottom: 16px;">Enlaces</h4>
                <nav style="display: flex; flex-direction: column; gap: 8px;">
                    <a href="{{ route('home') }}" style="color: #999; text-decoration: none; font-family: 'Jost', sans-serif;">Inicio</a>
                    <a href="{{ route('shop.index') }}" style="color: #999; text-decoration: none; font-family: 'Jost', sans-serif;">Shop</a>
                    <a href="{{ route('categories') }}" style="color: #999; text-decoration: none; font-family: 'Jost', sans-serif;">Categorías</a>
                </nav>
            </div>
        </div>
        <div style="border-top: 1px solid #333; padding-top: 20px; text-align: center; color: #666; font-family: 'Jost', sans-serif;">
            <p>&copy; 2025 SEALS. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<script>
// Update quantity
function updateQty(btn, change) {
    const input = btn.parentElement.querySelector('.qty-input');
    const currentValue = parseInt(input.value);
    const newValue = currentValue + change;

    if (newValue >= 1) {
        input.value = newValue;
        updateItemTotal(btn.closest('.cart-item'));
        calculateTotal();
    }
}

// Update individual item total
function updateItemTotal(item) {
    const price = parseFloat(item.querySelector('.item-price').textContent.replace('$', ''));
    const qty = parseInt(item.querySelector('.qty-input').value);
    const total = price * qty;
    item.querySelector('.item-total').textContent = '$' + total.toFixed(2);
}

// Calculate cart totals
function calculateTotal() {
    let subtotal = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        const total = parseFloat(item.querySelector('.item-total').textContent.replace('$', ''));
        subtotal += total;
    });

    const shipping = 15.00;
    const tax = subtotal * 0.10;
    const total = subtotal + shipping + tax;

    document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
    document.getElementById('tax').textContent = '$' + tax.toFixed(2);
    document.getElementById('total').textContent = '$' + total.toFixed(2);
}

// Remove item
function removeItem(btn) {
    if (confirm('¿Eliminar este producto del carrito?')) {
        btn.closest('.cart-item').remove();
        calculateTotal();

        // Check if cart is empty
        if (document.querySelectorAll('.cart-item').length === 0) {
            const cartTable = document.querySelector('.cart-table');
            cartTable.innerHTML = `
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Tu carrito está vacío</h3>
                    <p>Agrega productos para continuar</p>
                    <a href="{{ route('shop.index') }}" class="checkout-btn" style="display: inline-block; width: auto; margin-top: 24px; text-decoration: none;">
                        Ir a la Tienda
                    </a>
                </div>
            `;
        }
    }
}
</script>
@endsection
