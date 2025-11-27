@extends('layouts.app')

@section('title', 'Shop')

@push('styles')
<style>
    .shop-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 40px;
    }

    /* Sidebar Filters */
    .shop-sidebar {
        position: sticky;
        top: 120px;
        height: fit-content;
    }

    .filter-section {
        margin-bottom: 32px;
        padding-bottom: 32px;
        border-bottom: 1px solid #E5E5E5;
    }

    .filter-section:last-child {
        border-bottom: none;
    }

    .filter-title {
        font-family: 'Jost', sans-serif;
        font-size: 18px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 16px;
    }

    .filter-option {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    .filter-option input[type="checkbox"],
    .filter-option input[type="radio"] {
        margin-right: 10px;
        cursor: pointer;
    }

    .filter-option label {
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        color: #666;
        cursor: pointer;
    }

    .price-inputs {
        display: flex;
        gap: 12px;
        margin-top: 12px;
    }

    .price-inputs input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #E5E5E5;
        border-radius: 4px;
        font-family: 'Jost', sans-serif;
    }

    .filter-button {
        width: 100%;
        padding: 12px;
        background-color: #EE403D;
        color: white;
        border: none;
        border-radius: 4px;
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .filter-button:hover {
        background-color: #E32020;
    }

    /* Collapsible Categories */
    .category-toggle {
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        padding: 8px 0;
        color: #212529;
        font-weight: 600;
        user-select: none;
    }

    .category-toggle:hover {
        color: #EE403D;
    }

    .category-toggle .toggle-icon {
        transition: transform 0.3s;
    }

    .category-toggle.active .toggle-icon {
        transform: rotate(90deg);
    }

    .category-submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        padding-left: 16px;
    }

    .category-submenu.active {
        max-height: 300px;
    }

    .category-submenu .filter-option {
        margin: 8px 0;
    }

    /* Color Filter */
    .color-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 12px;
    }

    .color-option {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        padding: 8px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .color-option:hover {
        background-color: #F5F6F2;
    }

    .color-circle {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid #E5E5E5;
        flex-shrink: 0;
    }

    .color-circle.black { background-color: #000; }
    .color-circle.blue { background-color: #2563EB; }
    .color-circle.gray { background-color: #6B7280; }
    .color-circle.green { background-color: #10B981; }
    .color-circle.red { background-color: #EF4444; }
    .color-circle.yellow { background-color: #FBBF24; }

    .color-option input[type="checkbox"] {
        display: none;
    }

    .color-option input[type="checkbox"]:checked + .color-label .color-circle {
        border-color: #EE403D;
        box-shadow: 0 0 0 2px #EE403D;
    }

    .color-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #666;
        cursor: pointer;
    }

    /* Brand Filter */
    .brand-list {
        max-height: 250px;
        overflow-y: auto;
        margin-top: 12px;
    }

    .brand-list::-webkit-scrollbar {
        width: 6px;
    }

    .brand-list::-webkit-scrollbar-track {
        background: #F5F6F2;
        border-radius: 3px;
    }

    .brand-list::-webkit-scrollbar-thumb {
        background: #E5E5E5;
        border-radius: 3px;
    }

    .brand-list::-webkit-scrollbar-thumb:hover {
        background: #D1D5DB;
    }

    .brand-option {
        margin-bottom: 8px;
    }

    .brand-option a {
        color: #666;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s;
    }

    .brand-option a:hover {
        color: #EE403D;
    }

    /* Promotional Banner */
    .promo-banner {
        background: linear-gradient(135deg, #EE403D 0%, #E32020 100%);
        padding: 24px;
        border-radius: 8px;
        color: white;
        text-align: center;
        margin-top: 24px;
        cursor: pointer;
        transition: transform 0.3s;
    }

    .promo-banner:hover {
        transform: translateY(-4px);
    }

    .promo-banner-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        opacity: 0.9;
    }

    .promo-banner-title {
        font-size: 20px;
        font-weight: 700;
        line-height: 1.3;
    }

    /* Product Grid */
    .shop-main {
        min-width: 0;
    }

    .shop-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .shop-results {
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        color: #666;
    }

    .shop-sort {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .shop-sort select {
        padding: 8px 16px;
        border: 1px solid #E5E5E5;
        border-radius: 4px;
        font-family: 'Jost', sans-serif;
        background-color: white;
        cursor: pointer;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 32px;
        margin-bottom: 48px;
    }

    .product-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
        cursor: pointer;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }

    .product-image-container {
        position: relative;
        width: 100%;
        padding-top: 125%;
        background-color: #F5F6F2;
        overflow: hidden;
    }

    .product-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-badges {
        position: absolute;
        top: 12px;
        left: 12px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        z-index: 2;
    }

    .badge {
        padding: 4px 12px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 4px;
        color: white;
        font-family: 'Jost', sans-serif;
    }

    .badge-new { background-color: #28A745; }
    .badge-hot { background-color: #EE403D; }
    .badge-sale { background-color: #E32020; }

    .product-actions {
        position: absolute;
        top: 12px;
        right: 12px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .product-card:hover .product-actions {
        opacity: 1;
    }

    .action-btn {
        width: 40px;
        height: 40px;
        background-color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s;
        z-index: 10;
    }

    .action-btn:hover {
        background-color: #EE403D;
        color: white;
    }

    .action-btn.in-wishlist {
        background-color: #EE403D;
        color: white;
    }

    .action-btn.in-wishlist i {
        font-weight: 900;
    }

    .product-info {
        padding: 20px;
    }

    .product-category {
        font-size: 13px;
        color: #999;
        margin-bottom: 8px;
        font-family: 'Jost', sans-serif;
    }

    .product-title {
        font-size: 16px;
        font-weight: 500;
        color: #212529;
        margin-bottom: 12px;
        font-family: 'Jost', sans-serif;
        line-height: 1.4;
    }

    .product-title a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s;
    }

    .product-title a:hover {
        color: #EE403D;
    }

    .product-price {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'Jost', sans-serif;
    }

    .price-current {
        font-size: 18px;
        font-weight: 600;
        color: #EE403D;
    }

    .price-original {
        font-size: 15px;
        color: #999;
        text-decoration: line-through;
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 12px;
    }

    .star {
        color: #FFC107;
        font-size: 14px;
    }

    .star.empty {
        color: #E5E5E5;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 48px;
    }

    .pagination a,
    .pagination span {
        padding: 8px 16px;
        border: 1px solid #E5E5E5;
        border-radius: 4px;
        color: #212529;
        text-decoration: none;
        font-family: 'Jost', sans-serif;
        transition: all 0.3s;
    }

    .pagination a:hover {
        background-color: #EE403D;
        color: white;
        border-color: #EE403D;
    }

    .pagination .active {
        background-color: #EE403D;
        color: white;
        border-color: #EE403D;
    }

    @media (max-width: 768px) {
        .shop-container {
            grid-template-columns: 1fr;
        }

        .shop-sidebar {
            position: static;
        }

        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
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
            <a href="{{ route('account') }}" style="color: #666; text-decoration: none; font-size: 14px; font-family: 'Jost', sans-serif;">Mi Cuenta</a>
            <a href="{{ route('wishlist.index') }}" style="color: #666; text-decoration: none; font-size: 14px; font-family: 'Jost', sans-serif;">Favoritos</a>
            <a href="#" style="color: #666; text-decoration: none; font-size: 14px; font-family: 'Jost', sans-serif;">Rastrear Pedido</a>
            @auth
                @if(Auth::user()->role === 'seller')
                    <a href="{{ route('seller.dashboard') }}" style="color: #666; text-decoration: none; font-size: 14px; font-family: 'Jost', sans-serif;">Mi Dashboard</a>
                @endif
            @endauth
        </nav>
        <div style="display: flex; gap: 16px; align-items: center;">
            <span style="font-size: 14px; color: #666; font-family: 'Jost', sans-serif;">¿Necesitas ayuda? <strong>Llámanos: <a href="tel:+1234567890" style="color: #EE403D; text-decoration: none;">+ 0020 500</a></strong></span>
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
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif; transition: color 0.3s;">Inicio</a>
            <a href="{{ route('shop.index') }}" style="color: #EE403D; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif; transition: color 0.3s;">Shop</a>
            <a href="{{ route('categories') }}" style="color: #666; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif; transition: color 0.3s;">Categorías</a>
            <a href="{{ route('contact') }}" style="color: #666; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif; transition: color 0.3s;">Contacto</a>
        </nav>

        <div style="display: flex; gap: 16px; align-items: center;">
            <button onclick="toggleSearch()" style="background: none; border: none; cursor: pointer; color: #212529; font-size: 20px;">
                <i class="fas fa-search"></i>
            </button>
            @auth
                <a href="{{ route('account') }}" style="color: #666; font-family: 'Jost', sans-serif; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-user"></i>
                    Hola, {{ Auth::user()->name }}
                </a>
            @else
                <a href="{{ route('login') }}" style="color: #666; text-decoration: none;">
                    <i class="fas fa-user"></i>
                </a>
            @endauth
            <a href="{{ route('cart') }}" style="color: #212529; text-decoration: none; position: relative;">
                <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                @php
                    $cart = session()->get('cart', []);
                    $cartCount = array_sum(array_column($cart, 'quantity'));
                @endphp
                @if($cartCount > 0)
                <span style="position: absolute; top: -8px; right: -8px; background-color: #EE403D; color: white; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-family: 'Jost', sans-serif;">{{ $cartCount }}</span>
                @endif
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
            <span style="color: #212529; font-weight: 500;">Shop</span>
        </nav>
    </div>
</div>

<!-- SHOP CONTAINER -->
<div class="shop-container">
    <!-- SIDEBAR FILTERS -->
    <aside class="shop-sidebar">
        <form action="{{ route('shop.index') }}" method="GET" id="filterForm">
            <!-- PRODUCT CATEGORY - Collapsible -->
            <div class="filter-section">
                <h3 class="filter-title">CATEGORÍAS</h3>

                @foreach($categories as $category)
                <div>
                    <div class="category-toggle" onclick="toggleCategory('cat_{{ $category->id }}')">
                        <span>{{ $category->name }} ({{ $category->products_count ?? 0 }})</span>
                        <span class="toggle-icon">▶</span>
                    </div>
                    <div class="category-submenu" id="submenu_cat_{{ $category->id }}">
                        <div class="filter-option">
                            <a href="{{ route('shop.category', $category->slug) }}" 
                               style="color: {{ request()->route('slug') == $category->slug ? '#EE403D' : '#666' }}; text-decoration: none; font-weight: {{ request()->route('slug') == $category->slug ? '600' : '400' }};">
                                Ver todos en {{ $category->name }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="filter-option" style="margin-top: 12px;">
                    <input type="radio" name="category" value="" id="cat_all"
                        {{ !request('category') ? 'checked' : '' }}
                        onchange="document.getElementById('filterForm').submit()">
                    <label for="cat_all">Todas las Categorías</label>
                </div>
            </div>

            <!-- FILTER BY PRICE -->
            <div class="filter-section">
                <h3 class="filter-title">FILTRAR POR PRECIO</h3>
                <div class="price-inputs">
                    <div style="display: flex; align-items: center; gap: 4px;">
                        <span style="color: #666; font-size: 14px;">Min: $</span>
                        <input type="number" name="min_price" placeholder="50" value="{{ request('min_price', 50) }}" style="width: 70px;">
                    </div>
                    <div style="display: flex; align-items: center; gap: 4px;">
                        <span style="color: #666; font-size: 14px;">Max: $</span>
                        <input type="number" name="max_price" placeholder="10000" value="{{ request('max_price', 10000) }}" style="width: 70px;">
                    </div>
                </div>
            </div>

            <!-- FILTER BY COLOR -->
            <div class="filter-section">
                <h3 class="filter-title">FILTRAR POR COLOR</h3>
                <div class="color-options">
                    <label class="color-option">
                        <input type="checkbox" name="color[]" value="black" id="color_black">
                        <span class="color-label">
                            <span class="color-circle black"></span>
                            <span>Negro</span>
                        </span>
                    </label>

                    <label class="color-option">
                        <input type="checkbox" name="color[]" value="blue" id="color_blue">
                        <span class="color-label">
                            <span class="color-circle blue"></span>
                            <span>Azul</span>
                        </span>
                    </label>

                    <label class="color-option">
                        <input type="checkbox" name="color[]" value="gray" id="color_gray">
                        <span class="color-label">
                            <span class="color-circle gray"></span>
                            <span>Gris</span>
                        </span>
                    </label>

                    <label class="color-option">
                        <input type="checkbox" name="color[]" value="green" id="color_green">
                        <span class="color-label">
                            <span class="color-circle green"></span>
                            <span>Verde</span>
                        </span>
                    </label>

                    <label class="color-option">
                        <input type="checkbox" name="color[]" value="red" id="color_red">
                        <span class="color-label">
                            <span class="color-circle red"></span>
                            <span>Rojo</span>
                        </span>
                    </label>

                    <label class="color-option">
                        <input type="checkbox" name="color[]" value="yellow" id="color_yellow">
                        <span class="color-label">
                            <span class="color-circle yellow"></span>
                            <span>Amarillo</span>
                        </span>
                    </label>
                </div>
            </div>

            <!-- FILTER BY BRAND -->
            <div class="filter-section">
                <h3 class="filter-title">FILTRAR POR MARCA</h3>
                <div class="brand-list">
                    @php
                    $brands = [
                        'Alexander McQueen', 'Adidas', 'Balenciaga', 'Balmain', 'Burberry',
                        'Chloé', 'Dsquared2', 'Givenchy', 'Kenzo', 'Leo',
                        'Maison Margiela', 'Moschino', 'Nike', 'Versace', 'Gucci',
                        'Prada', 'Dior', 'Armani', 'Calvin Klein', 'Tommy Hilfiger'
                    ];
                    @endphp

                    @foreach($brands as $brand)
                    <div class="brand-option">
                        <a href="{{ route('shop.index', ['brand' => strtolower(str_replace(' ', '-', $brand))]) }}">{{ $brand }}</a>
                    </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="filter-button">Aplicar Filtros</button>
        </form>

        <!-- PROMOTIONAL BANNER -->
        <a href="{{ route('shop.index') }}" style="text-decoration: none;">
            <div class="promo-banner">
                <div class="promo-banner-label">Moda de Invierno</div>
                <div class="promo-banner-title">Descubre Nuestra Nueva Colección</div>
            </div>
        </a>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="shop-main">
        <!-- Shop Header -->
        <div class="shop-header">
            <p class="shop-results">Mostrando {{ $products->count() }} de {{ $products->total() }} productos</p>
            <div class="shop-sort">
                <label for="sort">Ordenar por:</label>
                <select name="sort" id="sort" onchange="document.getElementById('filterForm').submit()">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Más recientes</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nombre A-Z</option>
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="products-grid">
            @forelse($products as $product)
            <div class="product-card" onclick="window.location.href='{{ route('shop.show', $product->slug) }}'">
                <div class="product-image-container">
                    @php
                        // El cast 'json' en el modelo ya deserializa automáticamente
                        $images = is_array($product->images) ? $product->images : (is_string($product->images) ? json_decode($product->images, true) : []);
                        $imagePath = !empty($images) ? asset('storage/' . $images[0]) : 'https://via.placeholder.com/300x375';
                        $wishlist = session()->get('wishlist', []);
                        $inWishlist = isset($wishlist[$product->id]);
                    @endphp
                    <img src="{{ $imagePath }}" alt="{{ $product->name }}" class="product-image" loading="lazy">

                    @if($product->sale_price)
                    <div class="product-badges">
                        <span class="badge badge-sale">SALE</span>
                    </div>
                    @elseif($product->is_featured)
                    <div class="product-badges">
                        <span class="badge badge-hot">HOT</span>
                    </div>
                    @endif

                    <div class="product-actions">
                        <button class="action-btn {{ $inWishlist ? 'in-wishlist' : '' }}" 
                                title="{{ $inWishlist ? 'Quitar de wishlist' : 'Agregar a wishlist' }}"
                                onclick="event.stopPropagation(); toggleWishlist({{ $product->id }}, this)">
                            <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                        </button>
                    </div>
                </div>

                <div class="product-info">
                    <p class="product-category">{{ $product->category->name ?? 'Sin categoría' }}</p>

                    <div class="product-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star empty">★</span>
                    </div>

                    <h3 class="product-title">
                        <a href="{{ route('shop.show', $product->slug) }}" onclick="event.stopPropagation()">{{ $product->name }}</a>
                    </h3>

                    <div class="product-price">
                        @if($product->sale_price)
                            <span class="price-current">${{ number_format($product->sale_price, 2) }}</span>
                            <span class="price-original">${{ number_format($product->price, 2) }}</span>
                        @else
                            <span class="price-current">${{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; color: #666; font-family: 'Jost', sans-serif;">
                <i class="fas fa-inbox" style="font-size: 48px; color: #E5E5E5; margin-bottom: 16px;"></i>
                <p style="font-size: 18px;">No se encontraron productos</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </main>
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
// Auto-submit form when sort changes
document.getElementById('sort').addEventListener('change', function() {
    const form = document.getElementById('filterForm');
    const sortInput = document.createElement('input');
    sortInput.type = 'hidden';
    sortInput.name = 'sort';
    sortInput.value = this.value;
    form.appendChild(sortInput);
    form.submit();
});

// Toggle category submenu
function toggleCategory(categoryId) {
    const toggle = event.currentTarget;
    const submenu = document.getElementById('submenu_' + categoryId);

    // Toggle active class
    toggle.classList.toggle('active');
    submenu.classList.toggle('active');
}

// Wishlist functionality
async function toggleWishlist(productId, button) {
    try {
        const isInWishlist = button.classList.contains('in-wishlist');
        const url = isInWishlist 
            ? `/wishlist/remove/${productId}`
            : `/wishlist/add/${productId}`;
        
        const method = isInWishlist ? 'DELETE' : 'POST';
        
        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (data.success) {
            // Toggle button state
            button.classList.toggle('in-wishlist');
            const icon = button.querySelector('i');
            
            if (button.classList.contains('in-wishlist')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                button.title = 'Quitar de wishlist';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                button.title = 'Agregar a wishlist';
            }

            // Show success message
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Error al actualizar wishlist', 'error');
    }
}

// Show notification
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        padding: 16px 24px;
        background-color: ${type === 'success' ? '#28A745' : '#EE403D'};
        color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        z-index: 9999;
        font-family: 'Jost', sans-serif;
        animation: slideIn 0.3s ease-out;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease-out';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Initialize - collapse all categories by default
document.addEventListener('DOMContentLoaded', function() {
    // Optionally expand the first category or the selected one
    const selectedCategory = document.querySelector('.category-submenu input[type="radio"]:checked');
    if (selectedCategory) {
        const submenu = selectedCategory.closest('.category-submenu');
        const toggle = submenu.previousElementSibling;
        if (submenu && toggle) {
            toggle.classList.add('active');
            submenu.classList.add('active');
        }
    }
});
</script>

<!-- Search Modal -->
@include('components.search-modal')

@endsection
