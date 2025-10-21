@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<!-- Header -->
<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <a href="{{ route('home') }}"><h1>SEALS</h1></a>
            </div>

            <nav class="nav">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="#" class="nav-link">Shop</a>
                <a href="{{ route('categories') }}" class="nav-link">Categories</a>
                <a href="#" class="nav-link">Contact</a>
            </nav>

            <div class="header-actions">
                <button class="icon-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
                <a href="{{ route('login') }}" class="icon-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
                <a href="{{ route('cart') }}" class="icon-btn cart active">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span class="badge">3</span>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Cart Section -->
<section class="cart-section">
    <div class="container">
        <h2 class="page-title">Carrito de Compras</h2>

        <div class="cart-content">
            <!-- Cart Items -->
            <div class="cart-items">
                <div class="cart-item">
                    <div class="item-image"></div>
                    <div class="item-details">
                        <h4>Nombre del Producto 1</h4>
                        <p class="item-meta">Color: Negro | Talla: M</p>
                        <p class="item-price">$99.00</p>
                    </div>
                    <div class="item-quantity">
                        <button class="qty-btn">-</button>
                        <input type="number" value="1" min="1">
                        <button class="qty-btn">+</button>
                    </div>
                    <button class="remove-btn">×</button>
                </div>

                <div class="cart-item">
                    <div class="item-image"></div>
                    <div class="item-details">
                        <h4>Nombre del Producto 2</h4>
                        <p class="item-meta">Color: Azul | Talla: L</p>
                        <p class="item-price">$85.00</p>
                    </div>
                    <div class="item-quantity">
                        <button class="qty-btn">-</button>
                        <input type="number" value="2" min="1">
                        <button class="qty-btn">+</button>
                    </div>
                    <button class="remove-btn">×</button>
                </div>

                <div class="cart-item">
                    <div class="item-image"></div>
                    <div class="item-details">
                        <h4>Nombre del Producto 3</h4>
                        <p class="item-meta">Color: Blanco | Talla: S</p>
                        <p class="item-price">$110.00</p>
                    </div>
                    <div class="item-quantity">
                        <button class="qty-btn">-</button>
                        <input type="number" value="1" min="1">
                        <button class="qty-btn">+</button>
                    </div>
                    <button class="remove-btn">×</button>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="cart-summary">
                <h3>Resumen del Pedido</h3>

                <div class="summary-item">
                    <span>Subtotal</span>
                    <span>$379.00</span>
                </div>
                <div class="summary-item">
                    <span>Envío</span>
                    <span>$15.00</span>
                </div>
                <div class="summary-item">
                    <span>Impuestos</span>
                    <span>$39.40</span>
                </div>
                <hr>
                <div class="summary-total">
                    <span>Total</span>
                    <span>$433.40</span>
                </div>

                <button class="btn-primary">Proceder al Pago</button>
                <a href="{{ route('home') }}" class="continue-shopping">Continuar Comprando</a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p>&copy; 2025 SEALS. Todos los derechos reservados.</p>
    </div>
</footer>
@endsection
