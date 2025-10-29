@extends('layouts.app')

@section('title', 'Categorías')

@push('styles')
<style>
    .categories-hero {
        background: linear-gradient(135deg, #EE403D 0%, #E32020 100%);
        padding: 80px 20px;
        text-align: center;
        color: white;
        font-family: 'Jost', sans-serif;
    }

    .categories-hero h1 {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .categories-hero p {
        font-size: 18px;
        opacity: 0.95;
    }

    .categories-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 80px 20px;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 32px;
    }

    .category-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        cursor: pointer;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    }

    .category-image {
        width: 100%;
        padding-top: 75%;
        position: relative;
        background: linear-gradient(135deg, #F5F6F2 0%, #E5E5E5 100%);
        overflow: hidden;
    }

    .category-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .category-card:hover .category-image img {
        transform: scale(1.1);
    }

    .category-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background-color: #EE403D;
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        font-family: 'Jost', sans-serif;
    }

    .category-content {
        padding: 24px;
        text-align: center;
    }

    .category-title {
        font-size: 22px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 8px;
        font-family: 'Jost', sans-serif;
    }

    .category-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 16px;
        font-family: 'Jost', sans-serif;
        line-height: 1.5;
    }

    .category-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #EE403D;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        font-family: 'Jost', sans-serif;
        transition: gap 0.3s;
    }

    .category-link:hover {
        gap: 12px;
    }

    .stats-section {
        background-color: #F5F6F2;
        padding: 60px 20px;
        margin-top: 80px;
    }

    .stats-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 48px;
        font-weight: 700;
        color: #EE403D;
        margin-bottom: 8px;
        font-family: 'Jost', sans-serif;
    }

    .stat-label {
        font-size: 16px;
        color: #666;
        font-family: 'Jost', sans-serif;
    }

    @media (max-width: 768px) {
        .categories-hero h1 {
            font-size: 32px;
        }

        .categories-grid {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
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
        </nav>
        <div>
            <span style="font-size: 14px; color: #666; font-family: 'Jost', sans-serif;">Necesitas ayuda? <strong>+0020 500</strong></span>
        </div>
    </div>
</div>

<!-- MAIN HEADER -->
<header style="background-color: white; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 20px 0;">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px;">
        <div>
            <a href="{{ route('home') }}" style="font-size: 32px; font-weight: 700; color: #212529; text-decoration: none; font-family: 'Jost', sans-serif;">SEALS</a>
        </div>

        <nav style="display: flex; gap: 32px; align-items: center;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif;">Inicio</a>
            <a href="{{ route('shop.index') }}" style="color: #666; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif;">Shop</a>
            <a href="{{ route('categories') }}" style="color: #EE403D; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif;">Categorías</a>
            <a href="{{ route('contact') }}" style="color: #666; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif;">Contacto</a>
        </nav>

        <div style="display: flex; gap: 16px; align-items: center;">
            <button style="background: none; border: none; cursor: pointer;">
                <i class="fas fa-search"></i>
            </button>
            @auth
                <span style="color: #666; font-family: 'Jost', sans-serif;">{{ Auth::user()->name }}</span>
            @else
                <a href="{{ route('login') }}" style="color: #666; text-decoration: none;">
                    <i class="fas fa-user"></i>
                </a>
            @endauth
            <a href="{{ route('cart') }}" style="color: #212529; text-decoration: none; position: relative;">
                <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                <span style="position: absolute; top: -8px; right: -8px; background-color: #EE403D; color: white; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 11px;">3</span>
            </a>
        </div>
    </div>
</header>

<!-- HERO SECTION -->
<div class="categories-hero">
    <h1>Explora Nuestras Categorías</h1>
    <p>Encuentra exactamente lo que buscas en nuestra amplia selección</p>
</div>

<!-- CATEGORIES GRID -->
<div class="categories-container">
    <div class="categories-grid">
        <!-- Women's Category -->
        <div class="category-card" onclick="window.location.href='#'">
            <div class="category-image">
                <span class="category-badge">20 productos</span>
                <img src="https://via.placeholder.com/400x300/F5F6F2/666?text=MUJER" alt="Para Mujer">
            </div>
            <div class="category-content">
                <h3 class="category-title">Para Mujer</h3>
                <p class="category-description">Moda femenina y accesorios exclusivos</p>
                <a href="#" class="category-link">
                    Ver Productos
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Men's Category -->
        <div class="category-card" onclick="window.location.href='#'">
            <div class="category-image">
                <span class="category-badge">33 productos</span>
                <img src="https://via.placeholder.com/400x300/F5F6F2/666?text=HOMBRE" alt="Para Hombre">
            </div>
            <div class="category-content">
                <h3 class="category-title">Para Hombre</h3>
                <p class="category-description">Ropa y accesorios masculinos</p>
                <a href="#" class="category-link">
                    Ver Productos
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Kids Category -->
        <div class="category-card" onclick="window.location.href='#'">
            <div class="category-image">
                <span class="category-badge">25 productos</span>
                <img src="https://via.placeholder.com/400x300/F5F6F2/666?text=NIÑOS" alt="Para Niños">
            </div>
            <div class="category-content">
                <h3 class="category-title">Para Niños</h3>
                <p class="category-description">Ropa y juguetes para los más pequeños</p>
                <a href="#" class="category-link">
                    Ver Productos
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Accessories Category -->
        <div class="category-card" onclick="window.location.href='#'">
            <div class="category-image">
                <span class="category-badge">33 productos</span>
                <img src="https://via.placeholder.com/400x300/F5F6F2/666?text=ACCESORIOS" alt="Accesorios">
            </div>
            <div class="category-content">
                <h3 class="category-title">Accesorios</h3>
                <p class="category-description">Complementos para tu estilo</p>
                <a href="#" class="category-link">
                    Ver Productos
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Shoes Category -->
        <div class="category-card" onclick="window.location.href='#'">
            <div class="category-image">
                <span class="category-badge">28 productos</span>
                <img src="https://via.placeholder.com/400x300/F5F6F2/666?text=CALZADO" alt="Calzado">
            </div>
            <div class="category-content">
                <h3 class="category-title">Calzado</h3>
                <p class="category-description">Zapatos para toda ocasión</p>
                <a href="#" class="category-link">
                    Ver Productos
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Sports Category -->
        <div class="category-card" onclick="window.location.href='#'">
            <div class="category-image">
                <span class="category-badge">45 productos</span>
                <img src="https://via.placeholder.com/400x300/F5F6F2/666?text=DEPORTES" alt="Deportes">
            </div>
            <div class="category-content">
                <h3 class="category-title">Deportes</h3>
                <p class="category-description">Equipamiento deportivo y ropa fitness</p>
                <a href="#" class="category-link">
                    Ver Productos
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- STATS SECTION -->
<div class="stats-section">
    <div class="stats-container">
        <div class="stat-item">
            <div class="stat-number">500+</div>
            <div class="stat-label">Productos</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">6</div>
            <div class="stat-label">Categorías</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">10K+</div>
            <div class="stat-label">Clientes Felices</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">24/7</div>
            <div class="stat-label">Soporte</div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer style="background-color: #212529; color: white; padding: 60px 20px 20px; margin-top: 0;">
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
@endsection
