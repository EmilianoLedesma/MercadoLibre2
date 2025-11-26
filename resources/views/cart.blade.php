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

    /* Confirmation Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 12px;
        padding: 32px;
        max-width: 450px;
        width: 90%;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        animation: slideUp 0.3s ease;
        position: relative;
    }

    .modal-icon {
        width: 64px;
        height: 64px;
        background: #FEF2F2;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .modal-icon i {
        font-size: 32px;
        color: #EE403D;
    }

    .modal-title {
        font-family: 'Jost', sans-serif;
        font-size: 24px;
        font-weight: 700;
        color: #212529;
        text-align: center;
        margin-bottom: 12px;
    }

    .modal-message {
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        color: #666;
        text-align: center;
        margin-bottom: 28px;
        line-height: 1.6;
    }

    .modal-actions {
        display: flex;
        gap: 12px;
    }

    .modal-btn {
        flex: 1;
        padding: 12px 24px;
        border-radius: 8px;
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
    }

    .modal-btn-cancel {
        background: white;
        color: #666;
        border: 2px solid #E5E5E5;
    }

    .modal-btn-cancel:hover {
        background: #F5F6F2;
        border-color: #D1D5DB;
    }

    .modal-btn-confirm {
        background: #EE403D;
        color: white;
    }

    .modal-btn-confirm:hover {
        background: #E32020;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from {
            transform: translateY(30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
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
@include('layouts.navbar')

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
            @if(count($cart) > 0)
                <div class="cart-table-header">
                    <div>Producto</div>
                    <div>Precio</div>
                    <div>Cantidad</div>
                    <div>Total</div>
                    <div></div>
                </div>

                @php $subtotal = 0; @endphp
                @foreach($cart as $id => $item)
                    @php
                        $itemTotal = $item['price'] * $item['quantity'];
                        $subtotal += $itemTotal;
                    @endphp
                    <div class="cart-item" data-id="{{ $id }}">
                        <div class="item-product">
                            <div class="item-image">
                                @php
                                    // Handle both 'image' and 'images' keys for backward compatibility
                                    if (isset($item['image'])) {
                                        $imageSrc = $item['image'];
                                    } elseif (isset($item['images'])) {
                                        $images = is_string($item['images']) ? json_decode($item['images'], true) : $item['images'];
                                        $imageSrc = is_array($images) && count($images) > 0 
                                            ? asset('storage/' . $images[0]) 
                                            : 'https://via.placeholder.com/60x75';
                                    } else {
                                        $imageSrc = 'https://via.placeholder.com/60x75';
                                    }
                                @endphp
                                <img src="{{ $imageSrc }}" alt="{{ $item['name'] }}">
                            </div>
                            <div class="item-details">
                                <h4>{{ $item['name'] }}</h4>
                                <p class="item-meta">Stock disponible: {{ $item['stock'] ?? $item['stock_quantity'] ?? 0 }}</p>
                            </div>
                        </div>
                        <div class="item-price">${{ number_format($item['price'], 2) }}</div>
                        <div class="quantity-controls">
                            <button class="qty-btn" onclick="updateQty(this, -1)">−</button>
                            <input type="number" value="{{ $item['quantity'] }}" min="1" max="{{ $item['stock'] ?? $item['stock_quantity'] ?? 999 }}" class="qty-input" onchange="qtyChanged(this)">
                            <button class="qty-btn" onclick="updateQty(this, 1)">+</button>
                        </div>
                        <div class="item-total">${{ number_format($itemTotal, 2) }}</div>
                        <button type="button" class="remove-btn" onclick="showRemoveModal({{ $id }})">×</button>
                    </div>
                @endforeach
            @else
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Tu carrito está vacío</h3>
                    <p>Agrega productos para continuar</p>
                    <a href="{{ route('shop.index') }}" class="checkout-btn" style="display: inline-block; width: auto; margin-top: 24px; text-decoration: none;">
                        Ir a la Tienda
                    </a>
                </div>
            @endif
        </div>

        <!-- Cart Summary -->
        <div class="cart-summary">
            <h3 class="summary-title">Resumen del Pedido</h3>

            @if(count($cart) > 0)
                @php
                    $shipping = $subtotal >= 100 ? 0 : 15;
                    $tax = $subtotal * 0.10;
                    $total = $subtotal + $shipping + $tax;
                @endphp

                <div class="summary-item">
                    <span>Subtotal</span>
                    <span id="subtotal">${{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="summary-item">
                    <span>Envío</span>
                    <span id="shipping">{{ $shipping == 0 ? 'Gratis' : '$' . number_format($shipping, 2) }}</span>
                </div>
                <div class="summary-item">
                    <span>Impuestos (10%)</span>
                    <span id="tax">${{ number_format($tax, 2) }}</span>
                </div>

                <div class="summary-total">
                    <span>Total</span>
                    <span id="total">${{ number_format($total, 2) }}</span>
                </div>

                <a href="{{ route('checkout.index') }}" class="checkout-btn" style="text-decoration: none; text-align: center; display: block;">Proceder al Pago</a>
            @else
                <p style="text-align: center; color: #666; font-family: 'Jost', sans-serif; padding: 20px;">Tu carrito está vacío</p>
            @endif

            <a href="{{ route('shop.index') }}" class="continue-shopping">
                <i class="fas fa-arrow-left"></i> Continuar Comprando
            </a>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="removeModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-icon">
            <i class="fas fa-trash-alt"></i>
        </div>
        <h3 class="modal-title">¿Eliminar producto?</h3>
        <p class="modal-message">¿Estás seguro de que deseas eliminar este producto del carrito?</p>
        <div class="modal-actions">
            <button class="modal-btn modal-btn-cancel" onclick="closeRemoveModal()">Cancelar</button>
            <button class="modal-btn modal-btn-confirm" onclick="confirmRemove()">Eliminar</button>
        </div>
    </div>
</div>

@include('layouts.footer')

<!-- Toast container -->
<div id="toast-container" style="position: fixed; bottom: 24px; right: 24px; z-index: 9999;"></div>

@push('scripts')
<script>
const CSRF_TOKEN = '{{ csrf_token() }}';

// Update quantity
async function updateQty(btn, change) {
    const itemEl = btn.closest('.cart-item');
    const input = itemEl.querySelector('.qty-input');
    const currentValue = parseInt(input.value);
    const newValue = currentValue + change;
    const productId = itemEl.getAttribute('data-id');

    if (newValue < 1) return;

    // Optimistically set value
    input.value = newValue;
    // Try to persist on server
    const ok = await sendQtyUpdate(productId, newValue);
    if (!ok) {
        // revert
        input.value = currentValue;
        return;
    }

    updateItemTotal(itemEl);
    calculateTotal();
}

    // Simple toast notification
    function showToast(message, type = 'info', timeout = 4000) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = 'simple-toast ' + type;
        toast.style = `background: ${type === 'error' ? '#ff4d4f' : '#333'}; color: white; padding: 12px 16px; margin-top: 8px; border-radius: 6px; box-shadow: 0 6px 18px rgba(0,0,0,0.12); font-family: 'Jost', sans-serif;`;
        toast.textContent = message;
        container.appendChild(toast);

        setTimeout(() => {
            toast.style.transition = 'opacity 300ms ease';
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, timeout);
    }

// Update individual item total
function updateItemTotal(item) {
    const price = parseFloat(item.querySelector('.item-price').textContent.replace('$', '').replace(/,/g, ''));
    const qty = parseInt(item.querySelector('.qty-input').value);
    const total = price * qty;
    item.querySelector('.item-total').textContent = '$' + total.toFixed(2);
}

// Calculate cart totals
function calculateTotal() {
    let subtotal = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        const total = parseFloat(item.querySelector('.item-total').textContent.replace('$', '').replace(/,/g, ''));
        subtotal += total;
    });

    // Match server-side: free shipping when subtotal >= 100
    const shipping = subtotal >= 100 ? 0 : 15.00;
    const tax = subtotal * 0.10;
    const total = subtotal + shipping + tax;

    document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
    document.getElementById('tax').textContent = '$' + tax.toFixed(2);
    document.getElementById('total').textContent = '$' + total.toFixed(2);

    // Update shipping display text
    const shippingEl = document.getElementById('shipping');
    if (shippingEl) {
        shippingEl.textContent = shipping === 0 ? 'Gratis' : '$' + shipping.toFixed(2);
    }
}

// Send quantity update to server and handle response (returns true if ok)
async function sendQtyUpdate(productId, quantity) {
    try {
        const resp = await fetch(`/cart/update/${productId}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ quantity })
        });

        if (!resp.ok) {
            const data = await resp.json().catch(() => null);
            showToast((data && data.error) ? data.error : 'No se pudo actualizar la cantidad', 'error');
            return false;
        }

        return true;
    } catch (err) {
        showToast('Error de red al actualizar cantidad', 'error');
        return false;
    }
}

// Handler for manual input change
async function qtyChanged(input) {
    const itemEl = input.closest('.cart-item');
    const productId = itemEl.getAttribute('data-id');
    let newValue = parseInt(input.value) || 1;
    const max = parseInt(input.max) || 999999;
    if (newValue < 1) newValue = 1;
    if (newValue > max) {
        showToast('No puedes seleccionar más unidades que el stock disponible', 'error');
        input.value = max;
        newValue = max;
    }

    const ok = await sendQtyUpdate(productId, newValue);
    if (!ok) {
        // Optionally, reload to sync
        location.reload();
        return;
    }

    updateItemTotal(itemEl);
    calculateTotal();
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

// Modal functions
let productToRemove = null;

function showRemoveModal(productId) {
    productToRemove = productId;
    const modal = document.getElementById('removeModal');
    modal.classList.add('active');
}

function closeRemoveModal() {
    const modal = document.getElementById('removeModal');
    modal.classList.remove('active');
    productToRemove = null;
}

function confirmRemove() {
    if (productToRemove) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/cart/remove/${productToRemove}`;
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(csrfInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('removeModal');
    if (e.target === modal) {
        closeRemoveModal();
    }
});

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeRemoveModal();
    }
});
</script>
@endpush
@endsection
