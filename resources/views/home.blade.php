@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- ========== TOP BANNER ========== -->
<div style="background-color: #EE403D; color: white; text-align: center; padding: 12px 0; font-size: 14px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <p style="margin: 0;">
            Envío gratis en compras mayores a $100
            <a href="#" style="color: white; text-decoration: underline; margin-left: 8px;">Descubre Ahora</a>
        </p>
    </div>
</div>

<!-- ========== SECONDARY HEADER ========== -->
<div style="background-color: #F5F6F2; padding: 12px 0; font-size: 14px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
        <nav style="display: flex; gap: 20px;">
            <a href="#" style="color: #212529; text-decoration: none; transition: color 0.25s;">Nosotros</a>
            <a href="{{ route('account') }}" style="color: #212529; text-decoration: none; transition: color 0.25s;">Mi Cuenta</a>
            <a href="{{ route('wishlist.index') }}" style="color: #212529; text-decoration: none; transition: color 0.25s;">Favoritos</a>
            <a href="{{ route('track.order') }}" style="color: #212529; text-decoration: none; transition: color 0.25s;">Rastrear Pedido</a>
            @auth
                @if(Auth::user()->role === 'seller')
                    <a href="{{ route('seller.dashboard') }}" style="color: #212529; text-decoration: none; transition: color 0.25s;">Mi Dashboard</a>
                @endif
            @endauth
        </nav>

        <div style="display: flex; align-items: center; gap: 15px;">
            <span style="color: #212529;">
                ¿Necesitas ayuda?
                <strong>Llámanos: <a href="tel:+1234567890" style="color: #EE403D; text-decoration: none;">+ 0020 500</a></strong>
            </span>
        </div>
    </div>
</div>

<!-- ========== MAIN HEADER ========== -->
<header style="background-color: white; padding: 20px 0; box-shadow: 0 2px 4px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center;">
        <!-- Logo -->
        <div style="flex-shrink: 0;">
            <a href="{{ route('home') }}" style="font-size: 32px; font-weight: 800; color: #212529; text-decoration: none; letter-spacing: 2px;">SEALS</a>
        </div>

        <!-- Main Navigation -->
        <nav style="display: flex; gap: 32px; flex: 1; justify-content: center; align-items: center;">
            <a href="{{ route('home') }}" style="color: #EE403D; font-weight: 500; text-decoration: none; transition: color 0.25s;">Inicio</a>
            <a href="{{ route('shop.index') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s;">Shop</a>
            
            <!-- Categorías con Dropdown -->
            <div style="position: relative;" class="categories-dropdown">
                <a href="{{ route('categories') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s; display: flex; align-items: center; gap: 6px;">
                    Categorías
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                
                <!-- Dropdown Menu -->
                <div class="dropdown-menu">
                    <div style="display: grid; gap: 12px;">
                        @php
                            $homeNavCategories = \App\Models\Category::where('is_active', true)->orderBy('name', 'asc')->get();
                        @endphp
                        @foreach($homeNavCategories as $category)
                        <a href="{{ route('shop.index', ['category' => $category->id]) }}" style="display: flex; align-items: center; padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #212529; transition: all 0.25s; background-color: #F8F9FA;" onmouseover="this.style.backgroundColor='#EE403D'; this.style.color='white';" onmouseout="this.style.backgroundColor='#F8F9FA'; this.style.color='#212529';">
                            <span style="font-weight: 500;">{{ $category->name }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <a href="{{ route('contact') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s;">Contacto</a>
        </nav>

        <!-- Header Actions -->
        <div style="display: flex; align-items: center; gap: 20px;">
            <!-- Search -->
            <button onclick="toggleSearch()" style="background: none; border: none; cursor: pointer; padding: 8px;" aria-label="Buscar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </button>

            <!-- User -->
            @auth
                <a href="{{ route('account') }}" style="color: #212529; font-weight: 500; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Hola, {{ Auth::user()->name }}
                </a>
            @else
                <a href="{{ route('login') }}" style="background: none; border: none; cursor: pointer; padding: 8px;" aria-label="Cuenta">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
            @endauth

            <!-- Cart -->
            <a href="{{ route('cart') }}" style="position: relative; background: none; border: none; cursor: pointer; padding: 8px; text-decoration: none; color: inherit;" aria-label="Carrito">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                @php
                    $cart = session()->get('cart', []);
                    $cartCount = array_sum(array_column($cart, 'quantity'));
                @endphp
                @if($cartCount > 0)
                <span style="position: absolute; top: 0; right: 0; background-color: #EE403D; color: white; font-size: 10px; font-weight: 600; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
    </div>
</header>

<!-- ========== HERO SECTION ========== -->
<section style="background: linear-gradient(135deg, #F5F6F2 0%, #E7E8E0 100%); padding: 80px 20px; text-align: center;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <span style="display: inline-block; background-color: #EE403D; color: white; padding: 8px 20px; border-radius: 20px; font-size: 14px; font-weight: 600; margin-bottom: 20px;">Nueva Colección 2025</span>
        <h2 style="font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 20px 0; line-height: 1.2;">
            Descubre el Estilo que<br>Define tu Personalidad
        </h2>
        <p style="font-size: 18px; color: #404040; margin-bottom: 30px;">
            Explora nuestra selección exclusiva de productos diseñados para ti
        </p>
        <button style="background-color: #EE403D; color: white; border: none; padding: 16px 40px; font-size: 16px; font-weight: 600; border-radius: 4px; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; transition: all 0.25s;">
            Ver Colección
        </button>
    </div>
</section>

<!-- ========== CATEGORIES SECTION ========== -->
<section style="padding: 80px 0; background-color: white;">
    <div style="max-width: 100%; margin: 0 auto; padding: 0 40px;">
        <h3 style="text-align: center; font-size: 36px; font-weight: 700; color: #212529; margin: 0 0 50px 0;">Categorías Populares</h3>

        <!-- Swiper Container for Categories -->
        <div class="swiper categoriesSwiper" style="padding: 20px 0;">
            <div class="swiper-wrapper">
                @foreach($categories as $category)
                <!-- Category Card -->
                <div class="swiper-slide">
                    <a href="{{ route('shop.index', ['category' => $category->id]) }}" style="text-decoration: none; display: block;">
                        <div style="position: relative; border-radius: 8px; overflow: hidden; cursor: pointer; transition: transform 0.3s ease, box-shadow 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.1);" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)';">
                            @if($category->image)
                                <div style="width: 100%; height: 350px; background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%), url('{{ asset($category->image) }}') center/cover;"></div>
                            @else
                                <div style="width: 100%; height: 350px; background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%), url('{{ asset('images/placeholder-product.svg') }}') center/cover; background-color: #f0f0f0;"></div>
                            @endif
                            <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 20px;">
                                <p style="margin: 0 0 5px 0; font-size: 14px; color: white;"><span style="font-weight: 600;">{{ $category->products_count }}</span> <span style="opacity: 0.8;">items</span></p>
                                <h4 style="margin: 0; font-size: 20px; font-weight: 700; text-transform: uppercase; color: white;">{{ $category->name }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="swiper-pagination" style="margin-top: 30px;"></div>
        </div>
    </div>
</section>

<!-- ========== FEATURED PRODUCTS SECTION ========== -->
<section style="padding: 80px 0; background-color: #F8F8F8;">
    <div style="max-width: 100%; margin: 0 auto; padding: 0 40px;">
        <div style="text-align: center; margin-bottom: 50px;">
            <span style="display: inline-block; background-color: #F5F6F2; padding: 8px 20px; border-radius: 4px; font-size: 14px; font-weight: 600; color: #777; margin-bottom: 10px;">Featured</span>
            <h3 style="font-size: 36px; font-weight: 700; color: #212529; margin: 0;">PRODUCTOS DESTACADOS</h3>
        </div>

        <!-- Swiper Container for Products -->
        <div class="swiper productsSwiper" style="padding: 20px 0;">
            <div class="swiper-wrapper">
                @foreach($featuredProducts as $product)
                <!-- Product Card -->
                <div class="swiper-slide">
                    <div style="background-color: white; border-radius: 8px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.1); cursor: pointer; height: 100%;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)';" onclick="window.location.href='{{ route('products.show', $product->id) }}'">
                        <div style="position: relative; width: 100%; height: 350px; overflow: hidden;">
                            @php
                                $badgeTop = 12;
                            @endphp
                            
                            @if($product->hasDiscount())
                                <span style="position: absolute; top: {{ $badgeTop }}px; right: 12px; background-color: #E32020; color: white; padding: 6px 12px; font-size: 11px; font-weight: 700; border-radius: 3px; z-index: 10;">-{{ $product->discount_percentage }}%</span>
                                @php $badgeTop += 33; @endphp
                            @endif
                            
                            @if($product->isNew())
                                <span style="position: absolute; top: {{ $badgeTop }}px; right: 12px; background-color: #28A745; color: white; padding: 6px 12px; font-size: 11px; font-weight: 700; border-radius: 3px; z-index: 10;">NEW</span>
                                @php $badgeTop += 33; @endphp
                            @endif
                            
                            @if($product->is_featured)
                                <span style="position: absolute; top: {{ $badgeTop }}px; right: 12px; background-color: #EE403D; color: white; padding: 6px 12px; font-size: 11px; font-weight: 700; border-radius: 3px; z-index: 10;">HOT</span>
                            @endif
                            
                            @if($product->images && is_array($product->images) && count($product->images) > 0)
                                <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                            @else
                                <img src="{{ asset('images/placeholder-product.svg') }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                            @endif
                        </div>
                        <div style="padding: 20px;">
                            <h4 style="font-size: 16px; font-weight: 500; color: #212529; margin: 0 0 12px 0;">{{ Str::limit($product->name, 40) }}</h4>
                            
                            @if($product->hasDiscount())
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
                                    <span style="font-size: 14px; color: #999; text-decoration: line-through;">${{ number_format($product->price, 2) }}</span>
                                    <span style="font-size: 20px; font-weight: 700; color: #E32020;">${{ number_format($product->sale_price, 2) }}</span>
                                </div>
                            @else
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                                    <span style="font-size: 20px; font-weight: 700; color: #404040;">${{ number_format($product->price, 2) }}</span>
                                </div>
                            @endif
                            
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" onclick="event.stopPropagation();">
                                @csrf
                                <button type="submit" style="width: 100%; background-color: transparent; color: #212529; border: 2px solid #212529; padding: 12px; font-size: 14px; font-weight: 600; border-radius: 4px; cursor: pointer; text-transform: uppercase; transition: all 0.25s;">
                                    Agregar al Carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="swiper-pagination" style="margin-top: 30px;"></div>
        </div>
    </div>
</section>

<!-- ========== FOOTER ========== -->
@include('layouts.footer')

<!-- Search Modal -->
@include('components.search-modal')

<!-- Newsletter Popup -->
@include('components.newsletter-popup')

@push('styles')
<style>
/* Ocultar las flechas de navegación */
.swiper-button-next,
.swiper-button-prev {
    display: none !important;
}

.swiper-pagination-bullet {
    background-color: #999;
    opacity: 0.5;
    width: 10px;
    height: 10px;
    transition: all 0.3s ease;
}

.swiper-pagination-bullet-active {
    background-color: #EE403D;
    opacity: 1;
    width: 24px;
    border-radius: 5px;
}

/* Asegurar que las tarjetas en el carousel tengan altura uniforme */
.swiper-slide {
    height: auto;
    display: flex;
}

.swiper-slide > * {
    width: 100%;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Swiper para Categorías
    const categoriesSwiper = new Swiper('.categoriesSwiper', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        pagination: {
            el: '.categoriesSwiper .swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 24,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 24,
            },
        },
    });

    // Swiper para Productos Destacados
    const productsSwiper = new Swiper('.productsSwiper', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        pagination: {
            el: '.productsSwiper .swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 24,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 24,
            },
        },
    });
});
</script>
@endpush

@endsection
