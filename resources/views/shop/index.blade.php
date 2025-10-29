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
    }

    .action-btn:hover {
        background-color: #EE403D;
        color: white;
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
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif; transition: color 0.3s;">Inicio</a>
            <a href="{{ route('shop.index') }}" style="color: #EE403D; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif; transition: color 0.3s;">Shop</a>
            <a href="{{ route('categories') }}" style="color: #666; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif; transition: color 0.3s;">Categorías</a>
            <a href="{{ route('contact') }}" style="color: #666; text-decoration: none; font-size: 16px; font-weight: 500; font-family: 'Jost', sans-serif; transition: color 0.3s;">Contacto</a>
        </nav>

        <div style="display: flex; gap: 16px; align-items: center;">
            <button style="background: none; border: none; cursor: pointer; color: #212529; font-size: 20px;">
                <i class="fas fa-search"></i>
            </button>
            @auth
                <span style="color: #666; font-family: 'Jost', sans-serif;">Hola, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #666; cursor: pointer; font-family: 'Jost', sans-serif;">Salir</button>
                </form>
            @else
                <a href="{{ route('login') }}" style="color: #666; text-decoration: none;">
                    <i class="fas fa-user"></i>
                </a>
            @endauth
            <a href="{{ route('cart') }}" style="color: #212529; text-decoration: none; position: relative;">
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
            <span style="color: #212529; font-weight: 500;">Shop</span>
        </nav>
    </div>
</div>

<!-- SHOP CONTAINER -->
<div class="shop-container">
    <!-- SIDEBAR FILTERS -->
    <aside class="shop-sidebar">
        <form action="{{ route('shop.index') }}" method="GET" id="filterForm">
            <!-- Categories Filter -->
            <div class="filter-section">
                <h3 class="filter-title">Categorías</h3>
                @foreach($categories as $category)
                <div class="filter-option">
                    <input type="radio" name="category" value="{{ $category->id }}" id="cat_{{ $category->id }}"
                        {{ request('category') == $category->id ? 'checked' : '' }}>
                    <label for="cat_{{ $category->id }}">{{ $category->name }}</label>
                </div>
                @endforeach
                <div class="filter-option">
                    <input type="radio" name="category" value="" id="cat_all"
                        {{ !request('category') ? 'checked' : '' }}>
                    <label for="cat_all">Todas</label>
                </div>
            </div>

            <!-- Price Filter -->
            <div class="filter-section">
                <h3 class="filter-title">Rango de Precio</h3>
                <div class="price-inputs">
                    <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}">
                    <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}">
                </div>
            </div>

            <!-- Size Filter -->
            <div class="filter-section">
                <h3 class="filter-title">Talla</h3>
                <div class="filter-option">
                    <input type="checkbox" id="size_s" name="size[]" value="S">
                    <label for="size_s">S</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="size_m" name="size[]" value="M">
                    <label for="size_m">M</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="size_l" name="size[]" value="L">
                    <label for="size_l">L</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="size_xl" name="size[]" value="XL">
                    <label for="size_xl">XL</label>
                </div>
            </div>

            <button type="submit" class="filter-button">Aplicar Filtros</button>
        </form>
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
            <div class="product-card">
                <div class="product-image-container">
                    @php
                        $images = json_decode($product->images, true);
                        $imagePath = !empty($images) ? asset('storage/' . $images[0]) : 'https://via.placeholder.com/300x375';
                    @endphp
                    <img src="{{ $imagePath }}" alt="{{ $product->name }}" class="product-image">

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
                        <button class="action-btn" title="Wishlist">
                            <i class="far fa-heart"></i>
                        </button>
                        <button class="action-btn" title="Vista rápida">
                            <i class="far fa-eye"></i>
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
                        <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
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
</script>
@endsection
