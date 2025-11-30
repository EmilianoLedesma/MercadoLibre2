@extends('layouts.app')

@section('title', 'Shop')

@push('styles')
<style>
    .shop-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 60px 20px 80px;
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 32px;
        min-height: calc(100vh - 400px);
    }

    /* Sidebar Filters */
    .shop-sidebar {
        position: sticky;
        top: 120px;
        height: calc(100vh - 140px);
        overflow-y: auto;
        background-color: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }

    .shop-sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .shop-sidebar::-webkit-scrollbar-track {
        background: #F8F9FA;
        border-radius: 3px;
    }

    .shop-sidebar::-webkit-scrollbar-thumb {
        background: #E5E5E5;
        border-radius: 3px;
    }

    .shop-sidebar::-webkit-scrollbar-thumb:hover {
        background: #EE403D;
    }

    .filter-section {
        margin-bottom: 28px;
        padding-bottom: 28px;
        border-bottom: 1px solid #F0F0F0;
    }

    .filter-section:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .filter-title {
        font-family: 'Jost', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 18px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-option {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        padding: 8px 12px;
        border-radius: 6px;
        transition: background-color 0.2s;
    }

    .filter-option:hover {
        background-color: #F8F9FA;
    }

    .filter-option input[type="checkbox"],
    .filter-option input[type="radio"] {
        margin-right: 12px;
        cursor: pointer;
        width: 16px;
        height: 16px;
    }

    .filter-option label {
        font-family: 'Jost', sans-serif;
        font-size: 14px;
        color: #666;
        cursor: pointer;
        flex: 1;
    }

    .price-inputs {
        display: flex;
        gap: 10px;
        margin-top: 12px;
    }

    .price-inputs input {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #E5E5E5;
        border-radius: 8px;
        font-family: 'Jost', sans-serif;
        font-size: 14px;
        transition: border-color 0.2s;
    }

    .price-inputs input:focus {
        outline: none;
        border-color: #EE403D;
    }

    .filter-button {
        width: 100%;
        padding: 14px;
        background-color: #EE403D;
        color: white;
        border: none;
        border-radius: 8px;
        font-family: 'Jost', sans-serif;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s;
    }

    .filter-button:hover {
        background-color: #E32020;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(238, 64, 61, 0.3);
    }

    /* Collapsible Categories */
    .category-toggle {
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        padding: 12px 14px;
        color: #666;
        font-weight: 500;
        font-size: 14px;
        user-select: none;
        border-radius: 6px;
        transition: all 0.25s;
        border-left: 3px solid transparent;
    }

    .category-toggle:hover {
        background-color: #F8F9FA;
        color: #EE403D;
        border-left-color: #EE403D;
    }

    .category-toggle.active {
        background-color: #FFF5F5;
        color: #EE403D;
        border-left-color: #EE403D;
    }

    .category-toggle .toggle-icon {
        transition: transform 0.3s;
        font-size: 10px;
    }

    .category-toggle.active .toggle-icon {
        transform: rotate(90deg);
    }

    .category-submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        padding-left: 8px;
    }

    .category-submenu.active {
        max-height: 300px;
        margin-top: 8px;
    }

    .category-submenu .filter-option {
        margin: 6px 0;
        padding: 8px 12px;
    }

    /* Color Filter */
    .color-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 12px;
    }

    .color-option {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #F0F0F0;
        transition: all 0.2s;
    }

    .color-option:hover {
        background-color: #F8F9FA;
        border-color: #E5E5E5;
    }

    .color-circle {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        border: 2px solid #E5E5E5;
        flex-shrink: 0;
        transition: all 0.2s;
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

    .color-option input[type="checkbox"]:checked + .color-label {
        font-weight: 600;
        color: #EE403D;
    }

    .color-option input[type="checkbox"]:checked + .color-label .color-circle {
        border-color: #EE403D;
        box-shadow: 0 0 0 3px rgba(238, 64, 61, 0.15);
    }

    .color-label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #666;
        cursor: pointer;
        transition: all 0.2s;
    }

    /* Brand Filter */
    .brand-list {
        max-height: 240px;
        overflow-y: auto;
        margin-top: 12px;
    }

    .brand-list::-webkit-scrollbar {
        width: 5px;
    }

    .brand-list::-webkit-scrollbar-track {
        background: #F8F9FA;
        border-radius: 3px;
    }

    .brand-list::-webkit-scrollbar-thumb {
        background: #E5E5E5;
        border-radius: 3px;
    }

    .brand-list::-webkit-scrollbar-thumb:hover {
        background: #EE403D;
    }

    .brand-option {
        margin-bottom: 4px;
    }

    .brand-option a {
        display: block;
        color: #666;
        text-decoration: none;
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 6px;
        transition: all 0.2s;
        border-left: 3px solid transparent;
    }

    .brand-option a:hover {
        color: #EE403D;
        background-color: #F8F9FA;
        border-left-color: #EE403D;
    }

    /* Promotional Banner */
    .promo-banner {
        background: linear-gradient(135deg, #EE403D 0%, #E32020 100%);
        padding: 28px 20px;
        border-radius: 12px;
        color: white;
        text-align: center;
        margin-top: 24px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(238, 64, 61, 0.2);
    }

    .promo-banner:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(238, 64, 61, 0.35);
    }

    .promo-banner-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 10px;
        opacity: 0.85;
        font-weight: 600;
    }

    .promo-banner-title {
        font-size: 18px;
        font-weight: 700;
        line-height: 1.4;
    }

    /* Product Grid */
    .shop-main {
        min-width: 0;
    }

    .shop-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
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
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        margin-bottom: 60px;
    }

    .product-card {
        background: white;
        border: 1px solid #E5E5E5;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s;
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
        background-color: #FFFFFF;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-image {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 90%;
        max-height: 90%;
        width: auto;
        height: auto;
        object-fit: contain;
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
        align-items: center;
        gap: 4px;
        margin-top: 48px;
        font-family: 'Jost', sans-serif;
    }

    .pagination nav {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .pagination .flex {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .pagination a,
    .pagination span {
        min-width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 12px;
        border: 1px solid #E5E5E5;
        border-radius: 4px;
        color: #3483FA;
        background-color: white;
        text-decoration: none;
        font-size: 14px;
        font-weight: 400;
        transition: all 0.2s;
    }

    .pagination a:hover {
        background-color: #FFEBEA;
        border-color: #EE403D;
    }

    .pagination span[aria-current="page"] {
        background-color: #EE403D;
        color: white;
        border-color: #EE403D;
        font-weight: 600;
    }

    .pagination .disabled {
        color: #999;
        cursor: not-allowed;
        background-color: #F5F5F5;
        border-color: #E5E5E5;
    }

    .pagination .disabled:hover {
        background-color: #F5F5F5;
        border-color: #E5E5E5;
    }

    /* Ocultar texto de anterior/siguiente */
    .pagination .relative {
        display: flex;
        gap: 4px;
    }

    .pagination svg {
        width: 16px;
        height: 16px;
    }

    @media (max-width: 1024px) {
        .shop-container {
            grid-template-columns: 1fr;
            padding: 20px 15px;
        }

        .shop-sidebar {
            position: static;
            height: auto;
            overflow-y: visible;
            margin-bottom: 32px;
        }

        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
    }

    @media (max-width: 640px) {
        .products-grid {
            grid-template-columns: 1fr;
            gap: 16px;
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
            <a href="{{ route('track.order') }}" style="color: #666; text-decoration: none; font-size: 14px; font-family: 'Jost', sans-serif;">Rastrear Pedido</a>
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
            
            <!-- Categorías con Dropdown -->
            <div style="position: relative;" class="categories-dropdown">
                <a href="{{ route('categories') }}" style="color: #666; font-weight: 500; text-decoration: none; transition: color 0.25s; display: flex; align-items: center; gap: 6px; font-size: 16px; font-family: 'Jost', sans-serif;">
                    Categorías
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                
                <!-- Dropdown Menu -->
                <div class="dropdown-menu">
                    <div style="display: grid; gap: 12px;">
                        @php
                            $shopNavCategories = \App\Models\Category::where('is_active', true)->orderBy('name', 'asc')->get();
                        @endphp
                        @foreach($shopNavCategories as $category)
                        <a href="{{ route('shop.index', ['category' => $category->id]) }}" style="display: flex; align-items: center; padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #212529; transition: all 0.25s; background-color: #F8F9FA;" onmouseover="this.style.backgroundColor='#EE403D'; this.style.color='white';" onmouseout="this.style.backgroundColor='#F8F9FA'; this.style.color='#212529';">
                            <span style="font-weight: 500;">{{ $category->name }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            
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
                    @php
                        // Contar productos de la categoría principal y sus subcategorías
                        $subcategoryIds = \App\Models\Category::where('parent_id', $category->id)->pluck('id');
                        $totalProducts = \App\Models\Product::where('category_id', $category->id)
                            ->orWhereIn('category_id', $subcategoryIds)
                            ->count();
                    @endphp
                    <div class="category-toggle" onclick="toggleCategory('cat_{{ $category->id }}')">
                        <span>{{ $category->name }} ({{ $totalProducts }})</span>
                        <span class="toggle-icon">▶</span>
                    </div>
                    <div class="category-submenu" id="submenu_cat_{{ $category->id }}">
                        @php
                            $subcategories = \App\Models\Category::where('parent_id', $category->id)
                                ->where('is_active', true)
                                ->withCount('products')
                                ->get();
                        @endphp
                        
                        @if($subcategories->count() > 0)
                            @foreach($subcategories as $subcategory)
                            <div class="filter-option">
                                <input type="radio" name="category" value="{{ $subcategory->id }}" id="subcat_{{ $subcategory->id }}"
                                    {{ request('category') == $subcategory->id ? 'checked' : '' }}
                                    onchange="document.getElementById('filterForm').submit()">
                                <label for="subcat_{{ $subcategory->id }}">{{ $subcategory->name }} ({{ $subcategory->products_count }})</label>
                            </div>
                            @endforeach
                        @endif
                        
                        <div class="filter-option">
                            <input type="radio" name="category" value="{{ $category->id }}" id="cat_{{ $category->id }}"
                                {{ request('category') == $category->id ? 'checked' : '' }}
                                onchange="document.getElementById('filterForm').submit()">
                            <label for="cat_{{ $category->id }}">Ver todo en {{ $category->name }}</label>
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

            <!-- FILTER BY RATING -->
            <div class="filter-section">
                <h3 class="filter-title">CALIFICACIÓN</h3>
                <div class="filter-option">
                    <input type="radio" name="rating" value="" id="rating_all"
                        {{ !request('rating') ? 'checked' : '' }}
                        onchange="document.getElementById('filterForm').submit()">
                    <label for="rating_all">Todas</label>
                </div>
                
                @for($stars = 5; $stars >= 1; $stars--)
                <div class="filter-option">
                    <input type="radio" name="rating" value="{{ $stars }}" id="rating_{{ $stars }}"
                        {{ request('rating') == $stars ? 'checked' : '' }}
                        onchange="document.getElementById('filterForm').submit()">
                    <label for="rating_{{ $stars }}" style="display: flex; align-items: center; gap: 8px;">
                        <div style="display: flex; gap: 2px;">
                            @for($i = 1; $i <= 5; $i++)
                                <span style="color: {{ $i <= $stars ? '#F59E0B' : '#E5E5E5' }}; font-size: 16px;">★</span>
                            @endfor
                        </div>
                        <span>y más</span>
                    </label>
                </div>
                @endfor
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
                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Mejor Calificados</option>
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
                        // Si la imagen es una URL externa, usarla directamente; si no, usar asset storage
                        $imagePath = !empty($images) 
                            ? (filter_var($images[0], FILTER_VALIDATE_URL) ? $images[0] : asset('storage/' . $images[0]))
                            : 'https://via.placeholder.com/300x375';
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

                    @php
                        $avgRating = $product->reviews()->avg('rating') ?? 0;
                        $reviewCount = $product->reviews()->count();
                    @endphp
                    
                    @if($reviewCount > 0)
                    <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 8px;">
                        <div style="display: flex; gap: 2px;">
                            @for($i = 1; $i <= 5; $i++)
                                <span style="color: {{ $i <= round($avgRating) ? '#F59E0B' : '#E5E5E5' }}; font-size: 14px;">★</span>
                            @endfor
                        </div>
                        <span style="font-size: 12px; color: #666;">({{ $reviewCount }})</span>
                    </div>
                    @endif

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
            {{ $products->links('vendor.pagination.custom') }}
        </div>
    </main>
</div>

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

<!-- FOOTER -->

@endsection
