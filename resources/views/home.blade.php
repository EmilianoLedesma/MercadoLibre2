@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Header -->
<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <h1>SEALS</h1>
            </div>

            <nav class="nav">
                <a href="#" class="nav-link active">Home</a>
                <a href="#" class="nav-link">Shop</a>
                <a href="#" class="nav-link">Categories</a>
                <a href="{{ url('/contact') }}" class="nav-link">Contact</a>
            </nav>

            <div class="header-actions">
                <button class="icon-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>

                @auth
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="color: #333; font-weight: 500;">Hola, {{ Auth::user()->name }}</span>
                        <a href="{{ route('clientes') }}" class="nav-link" style="margin: 0;">Clientes</a>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="icon-btn" style="background: none; border: none; cursor: pointer;">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="icon-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>
                @endauth

                <button class="icon-btn cart">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span class="badge">3</span>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <span class="hero-tag">Nueva Colección 2025</span>
            <h2 class="hero-title">Descubre el Estilo que Define tu Personalidad</h2>
            <p class="hero-description">Explora nuestra selección exclusiva de productos diseñados para ti</p>
            <button class="btn-primary">Ver Colección</button>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="categories">
    <div class="container">
        <h3 class="section-title">Categorías Populares</h3>
        <div class="categories-grid">
            <div class="category-card">
                <div class="category-image"></div>
                <h4>Hombre</h4>
            </div>
            <div class="category-card">
                <div class="category-image"></div>
                <h4>Mujer</h4>
            </div>
            <div class="category-card">
                <div class="category-image"></div>
                <h4>Niños</h4>
            </div>
            <div class="category-card">
                <div class="category-image"></div>
                <h4>Accesorios</h4>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="products">
    <div class="container">
        <h3 class="section-title">Productos Destacados</h3>
        <div class="products-grid">
            <div class="product-card">
                <div class="product-badge new">NUEVO</div>
                <div class="product-image"></div>
                <h4 class="product-name">Nombre del Producto</h4>
                <p class="product-price">$99.00</p>
                <button class="btn-secondary">Agregar al Carrito</button>
            </div>
            <div class="product-card">
                <div class="product-badge sale">OFERTA</div>
                <div class="product-image"></div>
                <h4 class="product-name">Nombre del Producto</h4>
                <p class="product-price">
                    <span class="old-price">$120.00</span>
                    $85.00
                </p>
                <button class="btn-secondary">Agregar al Carrito</button>
            </div>
            <div class="product-card">
                <div class="product-image"></div>
                <h4 class="product-name">Nombre del Producto</h4>
                <p class="product-price">$110.00</p>
                <button class="btn-secondary">Agregar al Carrito</button>
            </div>
            <div class="product-card">
                <div class="product-badge hot">HOT</div>
                <div class="product-image"></div>
                <h4 class="product-name">Nombre del Producto</h4>
                <p class="product-price">$95.00</p>
                <button class="btn-secondary">Agregar al Carrito</button>
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
