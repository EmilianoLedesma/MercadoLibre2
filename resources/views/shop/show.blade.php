@extends('layouts.app')

@section('title', $product->name)

@push('styles')
<style>
    .product-detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .product-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        margin-bottom: 80px;
    }

    /* Product Images */
    .product-images {
        position: sticky;
        top: 120px;
        height: fit-content;
    }

    .main-image-container {
        width: 100%;
        padding-top: 125%;
        position: relative;
        background-color: #F5F6F2;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .main-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-thumbnails {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    .thumbnail {
        padding-top: 100%;
        position: relative;
        background-color: #F5F6F2;
        border-radius: 4px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        transition: border-color 0.3s;
    }

    .thumbnail.active {
        border-color: #EE403D;
    }

    .thumbnail img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Product Info */
    .product-detail-info {
        font-family: 'Jost', sans-serif;
    }

    .product-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .star {
        color: #FFC107;
        font-size: 16px;
    }

    .star.empty {
        color: #E5E5E5;
    }

    .reviews-count {
        color: #666;
        font-size: 14px;
    }

    .product-detail-title {
        font-size: 36px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .product-detail-price {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }

    .current-price {
        font-size: 32px;
        font-weight: 700;
        color: #EE403D;
    }

    .original-price {
        font-size: 24px;
        color: #999;
        text-decoration: line-through;
    }

    .discount-badge {
        background-color: #28A745;
        color: white;
        padding: 4px 12px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
    }

    .product-description {
        color: #666;
        line-height: 1.8;
        margin-bottom: 32px;
        font-size: 16px;
    }

    .product-options {
        margin-bottom: 32px;
    }

    .option-group {
        margin-bottom: 24px;
    }

    .option-label {
        font-weight: 600;
        color: #212529;
        margin-bottom: 12px;
        display: block;
    }

    .option-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .option-btn {
        padding: 10px 20px;
        border: 2px solid #E5E5E5;
        background-color: white;
        color: #666;
        border-radius: 4px;
        cursor: pointer;
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        transition: all 0.3s;
    }

    .option-btn:hover,
    .option-btn.active {
        border-color: #EE403D;
        color: #EE403D;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 32px;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        border: 2px solid #E5E5E5;
        border-radius: 4px;
        overflow: hidden;
    }

    .qty-btn {
        padding: 12px 20px;
        background-color: white;
        border: none;
        cursor: pointer;
        font-size: 18px;
        color: #666;
        transition: background-color 0.3s;
    }

    .qty-btn:hover {
        background-color: #F8F8F8;
    }

    .qty-input {
        width: 60px;
        text-align: center;
        border: none;
        border-left: 1px solid #E5E5E5;
        border-right: 1px solid #E5E5E5;
        padding: 12px 0;
        font-family: 'Jost', sans-serif;
        font-size: 16px;
    }

    .product-actions {
        display: flex;
        gap: 16px;
        margin-bottom: 32px;
    }

    .btn-add-cart {
        flex: 1;
        padding: 16px 32px;
        background-color: #EE403D;
        color: white;
        border: none;
        border-radius: 4px;
        font-family: 'Jost', sans-serif;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-add-cart:hover {
        background-color: #E32020;
    }

    .btn-wishlist {
        padding: 16px 24px;
        background-color: white;
        color: #666;
        border: 2px solid #E5E5E5;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
        font-family: 'Jost', sans-serif;
        font-size: 16px;
    }

    .btn-wishlist:hover {
        border-color: #EE403D;
        color: #EE403D;
    }

    .btn-wishlist.in-wishlist {
        background-color: #EE403D;
        color: white;
        border-color: #EE403D;
    }

    .btn-wishlist.in-wishlist i {
        font-weight: 900;
    }

    .product-meta-info {
        border-top: 1px solid #E5E5E5;
        padding-top: 24px;
    }

    .meta-item {
        display: flex;
        margin-bottom: 12px;
        font-size: 15px;
    }

    .meta-label {
        font-weight: 600;
        color: #212529;
        min-width: 100px;
    }

    .meta-value {
        color: #666;
    }

    .stock-status {
        display: inline-block;
        padding: 4px 12px;
        background-color: #28A745;
        color: white;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
    }

    .stock-status.out {
        background-color: #DC3545;
    }

    /* Tabs Section */
    .product-tabs {
        margin-bottom: 80px;
    }

    .tabs-header {
        display: flex;
        gap: 32px;
        border-bottom: 2px solid #E5E5E5;
        margin-bottom: 32px;
    }

    .tab-btn {
        padding: 16px 0;
        background: none;
        border: none;
        border-bottom: 3px solid transparent;
        color: #666;
        font-family: 'Jost', sans-serif;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: -2px;
    }

    .tab-btn.active {
        color: #EE403D;
        border-bottom-color: #EE403D;
    }

    .tab-content {
        display: none;
        padding: 24px 0;
        color: #666;
        line-height: 1.8;
    }

    .tab-content.active {
        display: block;
    }

    /* Related Products */
    .related-products {
        margin-top: 80px;
    }

    .section-title {
        font-family: 'Jost', sans-serif;
        font-size: 32px;
        font-weight: 600;
        color: #212529;
        text-align: center;
        margin-bottom: 48px;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 32px;
    }

    .product-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
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
    }

    .product-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-info {
        padding: 20px;
    }

    .product-category {
        font-size: 13px;
        color: #999;
        margin-bottom: 8px;
    }

    .product-title {
        font-size: 16px;
        font-weight: 500;
        color: #212529;
        margin-bottom: 12px;
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
    }

    .price-current {
        font-size: 18px;
        font-weight: 600;
        color: #EE403D;
    }

    @media (max-width: 768px) {
        .product-detail-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .product-images {
            position: static;
        }

        .product-detail-title {
            font-size: 28px;
        }

        .current-price {
            font-size: 24px;
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
            <a href="{{ route('shop.index') }}" style="color: #EE403D; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif;">Shop</a>
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
            <a href="{{ route('shop.index') }}" style="color: #666; text-decoration: none;">Shop</a>
            <span style="margin: 0 8px;">/</span>
            <span style="color: #212529; font-weight: 500;">{{ $product->name }}</span>
        </nav>
    </div>
</div>

<!-- PRODUCT DETAIL -->
<div class="product-detail-container">
    <div class="product-detail-grid">
        <!-- Product Images -->
        <div class="product-images">
            @php
                $images = json_decode($product->images, true) ?? [];
                $mainImage = !empty($images) ? asset('storage/' . $images[0]) : 'https://via.placeholder.com/600x750';
            @endphp
            <div class="main-image-container">
                <img src="{{ $mainImage }}" alt="{{ $product->name }}" class="main-image" id="mainImage">
            </div>
            @if(count($images) > 1)
            <div class="image-thumbnails">
                @foreach($images as $index => $image)
                <div class="thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="changeImage('{{ asset('storage/' . $image) }}', this)">
                    <img src="{{ asset('storage/' . $image) }}" alt="Thumbnail {{ $index + 1 }}">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="product-detail-info">
            <div class="product-meta">
                <div class="product-rating">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star empty">★</span>
                </div>
                <span class="reviews-count">(24 reseñas)</span>
            </div>

            <h1 class="product-detail-title">{{ $product->name }}</h1>

            <div class="product-detail-price">
                @if($product->sale_price)
                    <span class="current-price">${{ number_format($product->sale_price, 2) }}</span>
                    <span class="original-price">${{ number_format($product->price, 2) }}</span>
                    @php
                        $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
                    @endphp
                    <span class="discount-badge">-{{ $discount }}%</span>
                @else
                    <span class="current-price">${{ number_format($product->price, 2) }}</span>
                @endif
            </div>

            <p class="product-description">
                {{ $product->short_description ?? $product->description }}
            </p>

            @php
                $nombreProducto = strtolower($product->name);
                $categoria = $product->category->name ?? '';
                
                // Detectar tipo de selector de talla necesario
                $tipoTalla = null;
                $requiereColor = false;
                
                // Productos de ropa (tallas S, M, L, XL)
                if (str_contains($nombreProducto, 'remera') || 
                    str_contains($nombreProducto, 'camiseta') ||
                    str_contains($nombreProducto, 'buzo') || 
                    str_contains($nombreProducto, 'hoodie') ||
                    str_contains($nombreProducto, 'campera') || 
                    str_contains($nombreProducto, 'jacket') ||
                    str_contains($nombreProducto, 'vestido') || 
                    str_contains($nombreProducto, 'jean') ||
                    str_contains($nombreProducto, 'pantalón') ||
                    str_contains($nombreProducto, 'shorts') ||
                    str_contains($nombreProducto, 'playera')) {
                    $tipoTalla = 'ropa';
                    $requiereColor = true;
                }
                
                // Calzado (números)
                elseif (str_contains($nombreProducto, 'zapatilla') || 
                        str_contains($nombreProducto, 'zapato') ||
                        str_contains($nombreProducto, 'bota') || 
                        str_contains($nombreProducto, 'botín') ||
                        str_contains($nombreProducto, 'sandalia') ||
                        str_contains($nombreProducto, 'ojotas')) {
                    $tipoTalla = 'calzado';
                    $requiereColor = true;
                }
                
                // Deportes con tamaño específico
                elseif (str_contains($nombreProducto, 'pelota') || 
                        str_contains($nombreProducto, 'balón')) {
                    $tipoTalla = 'pelota';
                    $requiereColor = true;
                }
                elseif (str_contains($nombreProducto, 'bicicleta') || 
                        str_contains($nombreProducto, 'bike')) {
                    $tipoTalla = 'bicicleta';
                    $requiereColor = true;
                }
                elseif (str_contains($nombreProducto, 'guantes')) {
                    $tipoTalla = 'guantes';
                    $requiereColor = true;
                }
                
                // Accesorios de moda
                elseif (($categoria === 'Moda' || $categoria === 'Deportes y Fitness') && 
                        (str_contains($nombreProducto, 'gorra') || 
                         str_contains($nombreProducto, 'mochila'))) {
                    $tipoTalla = 'unica';
                    $requiereColor = true;
                }
                
                // Productos de hogar con color
                elseif ($categoria === 'Hogar y Muebles' && 
                        (str_contains($nombreProducto, 'sábana') || 
                         str_contains($nombreProducto, 'toalla') ||
                         str_contains($nombreProducto, 'alfombra') ||
                         str_contains($nombreProducto, 'cortina') ||
                         str_contains($nombreProducto, 'cojín') ||
                         str_contains($nombreProducto, 'funda'))) {
                    $requiereColor = true;
                }
                
                // Electrodomésticos con color
                elseif ($categoria === 'Electrodomésticos' && 
                        (str_contains($nombreProducto, 'licuadora') || 
                         str_contains($nombreProducto, 'cafetera') ||
                         str_contains($nombreProducto, 'plancha') ||
                         str_contains($nombreProducto, 'ventilador'))) {
                    $requiereColor = true;
                }
            @endphp

            <!-- Size and Color Options -->
            @if($tipoTalla || $requiereColor)
            <div class="product-options">
                @if($tipoTalla)
                <!-- Size Options -->
                <div class="option-group">
                    @if($tipoTalla === 'ropa')
                        <label class="option-label">Talla:</label>
                        <div class="option-buttons">
                            <button class="option-btn">XS</button>
                            <button class="option-btn">S</button>
                            <button class="option-btn active">M</button>
                            <button class="option-btn">L</button>
                            <button class="option-btn">XL</button>
                            <button class="option-btn">XXL</button>
                        </div>
                    @elseif($tipoTalla === 'calzado')
                        <label class="option-label">Número:</label>
                        <div class="option-buttons">
                            <button class="option-btn">37</button>
                            <button class="option-btn">38</button>
                            <button class="option-btn">39</button>
                            <button class="option-btn active">40</button>
                            <button class="option-btn">41</button>
                            <button class="option-btn">42</button>
                            <button class="option-btn">43</button>
                            <button class="option-btn">44</button>
                        </div>
                    @elseif($tipoTalla === 'pelota')
                        <label class="option-label">Tamaño:</label>
                        <div class="option-buttons">
                            <button class="option-btn">Nro. 3</button>
                            <button class="option-btn">Nro. 4</button>
                            <button class="option-btn active">Nro. 5</button>
                        </div>
                    @elseif($tipoTalla === 'bicicleta')
                        <label class="option-label">Rodado:</label>
                        <div class="option-buttons">
                            <button class="option-btn">R26</button>
                            <button class="option-btn active">R29</button>
                        </div>
                    @elseif($tipoTalla === 'guantes')
                        <label class="option-label">Tamaño:</label>
                        <div class="option-buttons">
                            <button class="option-btn">10 oz</button>
                            <button class="option-btn active">12 oz</button>
                            <button class="option-btn">14 oz</button>
                            <button class="option-btn">16 oz</button>
                        </div>
                    @elseif($tipoTalla === 'unica')
                        <label class="option-label">Talla:</label>
                        <div class="option-buttons">
                            <button class="option-btn active">Talla Única</button>
                        </div>
                    @endif
                </div>
                @endif

                @if($requiereColor)
                <!-- Color Options -->
                <div class="option-group">
                    <label class="option-label">Color:</label>
                    <div class="option-buttons">
                        <button class="option-btn active">Negro</button>
                        <button class="option-btn">Blanco</button>
                        <button class="option-btn">Azul</button>
                        @if($tipoTalla === 'ropa' || $tipoTalla === 'calzado' || $tipoTalla === 'pelota' || $categoria === 'Deportes y Fitness')
                            <button class="option-btn">Rojo</button>
                            <button class="option-btn">Gris</button>
                        @endif
                        @if($tipoTalla === 'ropa')
                            <button class="option-btn">Verde</button>
                        @endif
                    </div>
                </div>
                @endif
            </div>
            @endif

            <!-- Quantity -->
            <div class="quantity-selector">
                <label class="option-label">Cantidad:</label>
                <div class="quantity-controls">
                    <button class="qty-btn" onclick="decrementQty()">−</button>
                    <input type="number" value="1" min="1" max="{{ $product->stock_quantity }}" class="qty-input" id="qtyInput">
                    <button class="qty-btn" onclick="incrementQty()">+</button>
                </div>
            </div>

            <!-- Actions -->
            <div class="product-actions">
                <form action="{{ route('cart.add', $product->id) }}" method="POST" id="addToCartForm">
                    @csrf
                    <input type="hidden" name="quantity" id="quantityInput" value="1">
                    <button type="submit" class="btn-add-cart">
                        <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                    </button>
                </form>
                @php
                    $wishlist = session()->get('wishlist', []);
                    $inWishlist = isset($wishlist[$product->id]);
                @endphp
                <button class="btn-wishlist {{ $inWishlist ? 'in-wishlist' : '' }}" 
                        onclick="toggleWishlist({{ $product->id }}, this)"
                        title="{{ $inWishlist ? 'Quitar de wishlist' : 'Agregar a wishlist' }}">
                    <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                </button>
            </div>

            <!-- Meta Info -->
            <div class="product-meta-info">
                <div class="meta-item">
                    <span class="meta-label">SKU:</span>
                    <span class="meta-value">{{ $product->sku }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Categoría:</span>
                    <span class="meta-value">{{ $product->category->name ?? 'Sin categoría' }}</span>
                </div>
                @if($product->user)
                <div class="meta-item">
                    <span class="meta-label">Vendedor:</span>
                    <span class="meta-value" style="display: flex; align-items: center; gap: 8px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28A745" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <strong style="color: #212529;">{{ $product->user->name }} {{ $product->user->last_name ?? '' }}</strong>
                    </span>
                </div>
                @endif
                <div class="meta-item">
                    <span class="meta-label">Stock:</span>
                    <span class="stock-status {{ $product->stock_quantity > 0 ? '' : 'out' }}">
                        {{ $product->stock_quantity > 0 ? 'Disponible (' . $product->stock_quantity . ')' : 'Agotado' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Tabs -->
    <div class="product-tabs">
        <div class="tabs-header">
            <button class="tab-btn active" onclick="switchTab('description')">Descripción</button>
            <button class="tab-btn" onclick="switchTab('info')">Información Adicional</button>
            <button class="tab-btn" onclick="switchTab('reviews')">Reseñas (24)</button>
        </div>

        <div class="tab-content active" id="description">
            <p>{{ $product->description }}</p>
        </div>

        <div class="tab-content" id="info">
            <table style="width: 100%; border-collapse: collapse;">
                <tr style="border-bottom: 1px solid #E5E5E5;">
                    <td style="padding: 12px 0; font-weight: 600;">Peso</td>
                    <td style="padding: 12px 0;">0.5 kg</td>
                </tr>
                <tr style="border-bottom: 1px solid #E5E5E5;">
                    <td style="padding: 12px 0; font-weight: 600;">Dimensiones</td>
                    <td style="padding: 12px 0;">20 × 15 × 5 cm</td>
                </tr>
                <tr>
                    <td style="padding: 12px 0; font-weight: 600;">Material</td>
                    <td style="padding: 12px 0;">Algodón 100%</td>
                </tr>
            </table>
        </div>

        <div class="tab-content" id="reviews">
            <p>Las reseñas de clientes aparecerán aquí.</p>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="related-products">
        <h2 class="section-title">Productos Relacionados</h2>
        <div class="related-grid">
            @foreach($relatedProducts as $relatedProduct)
            <div class="product-card">
                <div class="product-image-container">
                    @php
                        $relatedImages = json_decode($relatedProduct->images, true);
                        $relatedImagePath = !empty($relatedImages) ? asset('storage/' . $relatedImages[0]) : 'https://via.placeholder.com/300x375';
                    @endphp
                    <img src="{{ $relatedImagePath }}" alt="{{ $relatedProduct->name }}" class="product-image">
                </div>
                <div class="product-info">
                    <p class="product-category">{{ $relatedProduct->category->name ?? '' }}</p>
                    <h3 class="product-title">
                        <a href="{{ route('shop.show', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a>
                    </h3>
                    <div class="product-price">
                        <span class="price-current">${{ number_format($relatedProduct->price, 2) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- FOOTER -->
<footer style="background-color: #212529; color: white; padding: 60px 20px 20px; margin-top: 80px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; margin-bottom: 40px;">
            <div>
                <h3 style="font-family: 'Jost', sans-serif; font-size: 24px; margin-bottom: 16px;">SEALS</h3>
                <p style="color: #999; font-family: 'Jost', sans-serif; line-height: 1.6;">Tu tienda de moda en línea con los mejores productos y precios.</p>
            </div>
        </div>
        <div style="border-top: 1px solid #333; padding-top: 20px; text-align: center; color: #666; font-family: 'Jost', sans-serif;">
            <p>&copy; 2025 SEALS. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<script>
// Image Gallery
function changeImage(src, thumbnail) {
    document.getElementById('mainImage').src = src;
    document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
    thumbnail.classList.add('active');
}

// Quantity Controls
function incrementQty() {
    const input = document.getElementById('qtyInput');
    const max = parseInt(input.max);
    const current = parseInt(input.value);
    if (current < max) {
        input.value = current + 1;
        updateQuantityInput();
    }
}

function decrementQty() {
    const input = document.getElementById('qtyInput');
    const current = parseInt(input.value);
    if (current > 1) {
        input.value = current - 1;
        updateQuantityInput();
    }
}

function updateQuantityInput() {
    const qtyInput = document.getElementById('qtyInput');
    const quantityInput = document.getElementById('quantityInput');
    quantityInput.value = qtyInput.value;
}

// Update hidden input when user types directly in the input
document.getElementById('qtyInput').addEventListener('input', updateQuantityInput);

// Option Buttons
document.querySelectorAll('.option-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        this.parentElement.querySelectorAll('.option-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});

// Tabs
function switchTab(tabName) {
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

    event.target.classList.add('active');
    document.getElementById(tabName).classList.add('active');
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
</script>
@endsection
