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
            <a href="{{ route('about') }}" style="color: #212529; text-decoration: none; transition: color 0.25s;">Nosotros</a>
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
            
            <a href="{{ route('deals') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s;">Ofertas</a>
            
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
<section style="background-color: #F8F9FA; padding: 0; margin-top: 0;">
    <div style="max-width: 100%; margin: 0 auto; padding: 0 80px;">
        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 20px;">
        <!-- Sidebar de Categorías -->
        <div style="background-color: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <div style="background-color: white; color: #212529; padding: 18px 24px; font-size: 16px; font-weight: 600; border-bottom: 1px solid #E5E5E5;">
                Categorías
            </div>
            
            <div style="padding: 8px 0;">
                @php
                    $heroCategories = \App\Models\Category::whereNull('parent_id')
                        ->where('is_active', true)
                        ->withCount('products')
                        ->orderBy('name', 'asc')
                        ->limit(12)
                        ->get();
                @endphp
                
                @foreach($heroCategories as $category)
                <a href="{{ route('shop.index', ['category' => $category->id]) }}" 
                   style="display: block; padding: 14px 24px; text-decoration: none; color: #666; font-size: 14px; transition: all 0.2s; border-left: 3px solid transparent;"
                   onmouseover="this.style.backgroundColor='#F8F9FA'; this.style.color='#EE403D'; this.style.borderLeftColor='#EE403D';" 
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='#666'; this.style.borderLeftColor='transparent';">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>
        </div>

        <div>
        <!-- Hero Banner -->
        <div style="margin-bottom: 60px;">
            <div style="display: grid; grid-template-columns: 1fr 300px; gap: 20px; height: 550px;">
                <!-- Main Slider -->
                <div style="position: relative; overflow: hidden; border-radius: 16px;">
                    <div class="swiper heroSwiper" style="height: 100%;">
                        <div class="swiper-wrapper">
                            <!-- Slide 1 -->
                            <div class="swiper-slide">
                                <div style="height: 100%; background: linear-gradient(135deg, #FFF5F5 0%, #FFE8E8 100%); display: flex; align-items: center; padding: 0 60px; position: relative;">
                                    <div style="max-width: 500px; z-index: 2;">
                                        <div style="color: #EE403D; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px;">
                                            NUEVA TEMPORADA
                                        </div>
                                        <h1 style="font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0; line-height: 1.1;">
                                            Estilo que<br>te representa
                                        </h1>
                                        <p style="font-size: 14px; color: #666; margin-bottom: 24px; line-height: 1.6;">
                                            Encuentra productos únicos de vendedores verificados.<br>Calidad garantizada en cada compra.
                                        </p>
                                        <a href="{{ route('shop.index') }}" style="display: inline-block; background-color: #EE403D; color: white; padding: 14px 32px; font-size: 13px; font-weight: 600; border-radius: 4px; text-decoration: none; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
                                           onmouseover="this.style.backgroundColor='#E32020'; this.style.transform='translateY(-2px)';"
                                           onmouseout="this.style.backgroundColor='#EE403D'; this.style.transform='translateY(0)';">
                                            Comprar Ahora
                                        </a>
                                    </div>
                                    <div style="position: absolute; right: 40px; top: 50%; transform: translateY(-50%); width: 280px; height: 350px; background: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=400&h=500&fit=crop') center/cover; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);"></div>
                                </div>
                            </div>

                            <!-- Slide 2 -->
                            <div class="swiper-slide">
                                <div style="height: 100%; background: linear-gradient(135deg, #F5F9FF 0%, #E8F2FF 100%); display: flex; align-items: center; padding: 0 60px; position: relative;">
                                    <div style="max-width: 500px; z-index: 2;">
                                        <div style="color: #2196F3; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px;">
                                            OFERTAS ESPECIALES
                                        </div>
                                        <h1 style="font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0; line-height: 1.1;">
                                            Hasta 50%<br>de descuento
                                        </h1>
                                        <p style="font-size: 14px; color: #666; margin-bottom: 24px; line-height: 1.6;">
                                            Aprovecha nuestras promociones en productos<br>seleccionados. ¡Solo por tiempo limitado!
                                        </p>
                                        <a href="{{ route('shop.index') }}" style="display: inline-block; background-color: #2196F3; color: white; padding: 14px 32px; font-size: 13px; font-weight: 600; border-radius: 4px; text-decoration: none; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
                                           onmouseover="this.style.backgroundColor='#1976D2'; this.style.transform='translateY(-2px)';"
                                           onmouseout="this.style.backgroundColor='#2196F3'; this.style.transform='translateY(0)';">
                                            Ver Ofertas
                                        </a>
                                    </div>
                                    <div style="position: absolute; right: 40px; top: 50%; transform: translateY(-50%); width: 280px; height: 350px; background: url('https://images.unsplash.com/photo-1607082349566-187342175e2f?w=400&h=500&fit=crop') center/cover; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);"></div>
                                </div>
                            </div>

                            <!-- Slide 3 -->
                            <div class="swiper-slide">
                                <div style="height: 100%; background: linear-gradient(135deg, #F5FFF9 0%, #E8FFE8 100%); display: flex; align-items: center; padding: 0 60px; position: relative;">
                                    <div style="max-width: 500px; z-index: 2;">
                                        <div style="color: #4CAF50; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px;">
                                            TENDENCIAS 2025
                                        </div>
                                        <h1 style="font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0; line-height: 1.1;">
                                            Lo más<br>popular
                                        </h1>
                                        <p style="font-size: 14px; color: #666; margin-bottom: 24px; line-height: 1.6;">
                                            Descubre los productos favoritos de nuestra<br>comunidad. Calidad y estilo garantizados.
                                        </p>
                                        <a href="{{ route('shop.index') }}" style="display: inline-block; background-color: #4CAF50; color: white; padding: 14px 32px; font-size: 13px; font-weight: 600; border-radius: 4px; text-decoration: none; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
                                           onmouseover="this.style.backgroundColor='#388E3C'; this.style.transform='translateY(-2px)';"
                                           onmouseout="this.style.backgroundColor='#4CAF50'; this.style.transform='translateY(0)';">
                                            Explorar
                                        </a>
                                    </div>
                                    <div style="position: absolute; right: 40px; top: 50%; transform: translateY(-50%); width: 280px; height: 350px; background: url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=400&h=500&fit=crop') center/cover; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="swiper-pagination hero-pagination"></div>
                    </div>
                </div>

                <!-- Side Banners -->
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <!-- Top Banner -->
                    <a href="{{ route('shop.index', ['category' => 2]) }}" style="position: relative; display: block; height: 265px; background: linear-gradient(135deg, #FFE8E8 0%, #FFD4D4 100%); border-radius: 12px; overflow: hidden; text-decoration: none; transition: all 0.3s;"
                       onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.12)';"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <div style="position: absolute; top: 20px; left: 20px; z-index: 2;">
                            <div style="color: #EE403D; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px;">
                                ELECTRODOMÉSTICOS
                            </div>
                            <h3 style="font-size: 20px; font-weight: 700; color: #212529; margin: 0 0 8px 0; line-height: 1.2;">
                                Para tu<br>hogar
                            </h3>
                            <span style="color: #EE403D; font-size: 12px; font-weight: 600;">
                                Ver más →
                            </span>
                        </div>
                        <div style="position: absolute; bottom: -10px; right: -10px; width: 160px; height: 160px; background: url('https://images.unsplash.com/photo-1626806819282-2c1dc01a5e0c?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D?w=200&h=200&fit=crop') center/cover; border-radius: 50%; opacity: 0.9;"></div>
                    </a>

                    <!-- Bottom Banner -->
                    <a href="{{ route('shop.index', ['category' => 1]) }}" style="position: relative; display: block; height: 265px; background: linear-gradient(135deg, #E8F2FF 0%, #D4E6FF 100%); border-radius: 12px; overflow: hidden; text-decoration: none; transition: all 0.3s;"
                       onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.12)';"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <div style="position: absolute; top: 20px; left: 20px; z-index: 2;">
                            <div style="color: #2196F3; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px;">
                                ELECTRÓNICA
                            </div>
                            <h3 style="font-size: 20px; font-weight: 700; color: #212529; margin: 0 0 8px 0; line-height: 1.2;">
                                Lo último<br>en tech
                            </h3>
                            <span style="color: #2196F3; font-size: 12px; font-weight: 600;">
                                Descubrir →
                            </span>
                        </div>
                        <div style="position: absolute; bottom: -10px; right: -10px; width: 160px; height: 160px; background: url('https://images.unsplash.com/photo-1498049794561-7780e7231661?w=200&h=200&fit=crop') center/cover; border-radius: 50%; opacity: 0.9;"></div>
                    </a>
                </div>
            </div>
        </div>
        </div>
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
                            @php
                                $categoryImages = [
                                    'Tecnología' => 'images/tecnologia.jpg',
                                    'Electrodomésticos' => 'images/electrodomesticos.jpg',
                                    'Hogar y Muebles' => 'images/muebles.jpg',
                                    'Moda' => 'images/moda.jpg',
                                    'Deportes y Fitness' => 'images/Deportes_y_fitness.jpg',
                                    'Juguetes y Bebés' => 'images/Juguetes.jpg',
                                    'Belleza y Cuidado Personal' => 'images/belleza_cuidado_personal.jpg',
                                    'Herramientas' => 'images/herramientas.jpg',
                                    'Libros y Entretenimiento' => 'images/entretenimiento.jpg',
                                    'Automotriz' => 'images/Automotriz.jpg',
                                    'Jardín y Exterior' => 'images/jardineria.jpg',
                                    'Alimentos y Bebidas' => 'images/alimentos.jpg',
                                ];
                                $categoryImage = $categoryImages[$category->name] ?? 'images/placeholder-product.svg';
                            @endphp
                            <div style="width: 100%; height: 350px; background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%), url('{{ asset($categoryImage) }}') center/cover;"></div>
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

<!-- ========== DEAL OF THE WEEK SECTION ========== -->
<section style="padding: 80px 0; background-color: #F8F8F8;">
    <div style="max-width: 100%; margin: 0 auto; padding: 0 80px;">
        <div style="background-color: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06); display: grid; grid-template-columns: 1fr 1fr; min-height: 500px;">
            <!-- Image Side -->
            <div style="position: relative; background: linear-gradient(135deg, #E8F4F8 0%, #D4E9F2 100%);">
                <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=800&h=800&fit=crop" 
                     alt="Oferta de la Semana" 
                     style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
            </div>

            <!-- Content Side -->
            <div style="padding: 50px 45px; display: flex; flex-direction: column; justify-content: center; background-color: white;">
                <!-- Badge -->
                <div style="display: inline-flex; align-items: center; gap: 6px; align-self: flex-start; margin-bottom: 20px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#EE403D" stroke-width="2.5">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span style="font-size: 12px; font-weight: 700; color: #EE403D; text-transform: uppercase; letter-spacing: 1.5px;">Oferta de la Semana</span>
                </div>

                <!-- Product Title -->
                <h2 style="font-size: 38px; font-weight: 700; color: #212529; margin: 0 0 16px 0; line-height: 1.2;">
                    Conjunto Deportivo<br>Amarillo Vibrante
                </h2>

                <!-- Description -->
                <p style="font-size: 15px; color: #666; margin-bottom: 32px; line-height: 1.7;">
                    Set completo de sudadera con capucha y pantalones. Diseño moderno y llamativo, perfecto para entrenar o un look casual urbano.
                </p>

                <!-- Countdown Timer -->
                <div style="background-color: #F8F9FA; border-radius: 10px; padding: 20px 24px; display: inline-flex; align-items: center; gap: 18px; margin-bottom: 32px; width: fit-content;">
                    <div style="text-align: center;">
                        <div id="deal-days" style="font-size: 32px; font-weight: 700; color: #212529; line-height: 1;">2</div>
                        <div style="font-size: 10px; color: #999; margin-top: 4px; font-weight: 600; letter-spacing: 0.5px;">DÍAS</div>
                    </div>
                    <div style="font-size: 24px; color: #E5E5E5; font-weight: 300;">:</div>
                    <div style="text-align: center;">
                        <div id="deal-hours" style="font-size: 32px; font-weight: 700; color: #212529; line-height: 1;">12</div>
                        <div style="font-size: 10px; color: #999; margin-top: 4px; font-weight: 600; letter-spacing: 0.5px;">HRS</div>
                    </div>
                    <div style="font-size: 24px; color: #E5E5E5; font-weight: 300;">:</div>
                    <div style="text-align: center;">
                        <div id="deal-minutes" style="font-size: 32px; font-weight: 700; color: #212529; line-height: 1;">30</div>
                        <div style="font-size: 10px; color: #999; margin-top: 4px; font-weight: 600; letter-spacing: 0.5px;">MIN</div>
                    </div>
                    <div style="font-size: 24px; color: #E5E5E5; font-weight: 300;">:</div>
                    <div style="text-align: center;">
                        <div id="deal-seconds" style="font-size: 32px; font-weight: 700; color: #212529; line-height: 1;">45</div>
                        <div style="font-size: 10px; color: #999; margin-top: 4px; font-weight: 600; letter-spacing: 0.5px;">SEG</div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div>
                    <a href="{{ route('shop.index') }}" 
                       style="display: inline-block; background-color: #212529; color: white; padding: 16px 40px; font-size: 13px; font-weight: 700; border-radius: 8px; text-decoration: none; text-transform: uppercase; letter-spacing: 1.2px; transition: all 0.3s;"
                       onmouseover="this.style.backgroundColor='#EE403D'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(238, 64, 61, 0.25)';"
                       onmouseout="this.style.backgroundColor='#212529'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        Ver Oferta
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== COLLECTIONS SECTION ========== -->
<section style="padding: 80px 0; background-color: white;">
    <div style="max-width: 100%; margin: 0 auto; padding: 0 80px;">
        <div style="text-align: center; margin-bottom: 50px;">
            <span style="display: inline-block; background-color: #F5F6F2; padding: 8px 20px; border-radius: 4px; font-size: 14px; font-weight: 600; color: #777; margin-bottom: 10px;">Colecciones</span>
            <h3 style="font-size: 36px; font-weight: 700; color: #212529; margin: 0;">COMPRA POR ESTILO</h3>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <!-- Collection 1: Tech Essentials -->
            <a href="{{ route('shop.index', ['category' => 1]) }}" style="position: relative; display: block; height: 400px; background: linear-gradient(135deg, #E8F4F8 0%, #D4E9F2 100%); border-radius: 12px; overflow: hidden; text-decoration: none; transition: all 0.3s;"
               onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 28px rgba(0,0,0,0.15)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <div style="position: absolute; top: 30px; left: 30px; z-index: 2;">
                    <div style="color: #2196F3; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px;">
                        Colección
                    </div>
                    <h3 style="font-size: 28px; font-weight: 700; color: #212529; margin: 0 0 12px 0; line-height: 1.2;">
                        Tech<br>Essentials
                    </h3>
                    <p style="color: #666; font-size: 14px; margin-bottom: 20px;">Lo último en tecnología</p>
                    <span style="color: #2196F3; font-size: 14px; font-weight: 600;">
                        Explorar →
                    </span>
                </div>
                <div style="position: absolute; bottom: -20px; right: -20px; width: 280px; height: 280px; background: url('https://images.unsplash.com/photo-1498049794561-7780e7231661?w=400&h=400&fit=crop') center/cover; border-radius: 50%; opacity: 0.9;"></div>
            </a>

            <!-- Collection 2: Home Style -->
            <a href="{{ route('shop.index', ['category' => 14]) }}" style="position: relative; display: block; height: 400px; background: linear-gradient(135deg, #FFF5F5 0%, #FFE8E8 100%); border-radius: 12px; overflow: hidden; text-decoration: none; transition: all 0.3s;"
               onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 28px rgba(0,0,0,0.15)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <div style="position: absolute; top: 30px; left: 30px; z-index: 2;">
                    <div style="color: #EE403D; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px;">
                        Colección
                    </div>
                    <h3 style="font-size: 28px; font-weight: 700; color: #212529; margin: 0 0 12px 0; line-height: 1.2;">
                        Home<br>Style
                    </h3>
                    <p style="color: #666; font-size: 14px; margin-bottom: 20px;">Renueva tu hogar</p>
                    <span style="color: #EE403D; font-size: 14px; font-weight: 600;">
                        Explorar →
                    </span>
                </div>
                <div style="position: absolute; bottom: -20px; right: -20px; width: 280px; height: 280px; background: url('https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?w=400&h=400&fit=crop') center/cover; border-radius: 50%; opacity: 0.9;"></div>
            </a>

            <!-- Collection 3: Active Life -->
            <a href="{{ route('shop.index', ['category' => 28]) }}" style="position: relative; display: block; height: 400px; background: linear-gradient(135deg, #F5FFF9 0%, #E8FFE8 100%); border-radius: 12px; overflow: hidden; text-decoration: none; transition: all 0.3s;"
               onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 28px rgba(0,0,0,0.15)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <div style="position: absolute; top: 30px; left: 30px; z-index: 2;">
                    <div style="color: #4CAF50; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px;">
                        Colección
                    </div>
                    <h3 style="font-size: 28px; font-weight: 700; color: #212529; margin: 0 0 12px 0; line-height: 1.2;">
                        Active<br>Life
                    </h3>
                    <p style="color: #666; font-size: 14px; margin-bottom: 20px;">Para tu estilo de vida</p>
                    <span style="color: #4CAF50; font-size: 14px; font-weight: 600;">
                        Explorar →
                    </span>
                </div>
                <div style="position: absolute; bottom: -20px; right: -20px; width: 280px; height: 280px; background: url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=400&h=400&fit=crop') center/cover; border-radius: 50%; opacity: 0.9;"></div>
            </a>
        </div>
    </div>
</section>

<!-- ========== FASHION LOOKBOOK SECTION ========== -->
<section style="padding: 80px 0; background-color: #F8F8F8;">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 40px;">
        <!-- Header -->
        <div style="text-align: center; margin-bottom: 50px;">
            <span style="display: inline-block; background-color: white; padding: 8px 20px; border-radius: 4px; font-size: 14px; font-weight: 600; color: #777; margin-bottom: 10px;">Fashion</span>
            <h3 style="font-size: 36px; font-weight: 700; color: #212529; margin: 0;">TENDENCIAS DE LA TEMPORADA</h3>
        </div>

        <!-- Grid de 2 banners grandes -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
            <!-- Banner 1: Mujer con Vestido - Ropa Mujer -->
            <a href="{{ route('shop.index', ['category' => 23]) }}" style="position: relative; display: block; height: 600px; background-color: #F5F5F0; border-radius: 8px; overflow: hidden; text-decoration: none; transition: all 0.3s;"
               onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 28px rgba(0,0,0,0.15)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <!-- Imagen de modelo -->
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100%; background: url('https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=800&h=1200&fit=crop') center bottom/cover; background-position: center 20%;"></div>
                
                <!-- Overlay gradient -->
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, transparent 50%);"></div>
                
                <!-- Content -->
                <div style="position: absolute; top: 40px; left: 40px; z-index: 2;">
                    <div style="background-color: white; padding: 6px 16px; border-radius: 20px; display: inline-block; margin-bottom: 16px;">
                        <span style="font-size: 12px; font-weight: 700; color: #212529; text-transform: uppercase; letter-spacing: 1px;">Nueva Colección</span>
                    </div>
                    <h4 style="font-size: 32px; font-weight: 700; color: white; margin: 0 0 12px 0; line-height: 1.2; text-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                        Elegancia<br>Urbana
                    </h4>
                    <p style="font-size: 15px; color: white; margin: 0 0 20px 0; text-shadow: 0 2px 6px rgba(0,0,0,0.4);">Descubre la nueva moda</p>
                    <div style="display: inline-flex; align-items: center; gap: 8px; background-color: white; color: #212529; padding: 12px 24px; border-radius: 6px; font-weight: 600; font-size: 14px; transition: all 0.3s;">
                        Comprar Ahora
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Banner 2: Hombre con Ropa Casual - Ropa Hombre -->
            <a href="{{ route('shop.index', ['category' => 22]) }}" style="position: relative; display: block; height: 600px; background-color: #E8E8E3; border-radius: 8px; overflow: hidden; text-decoration: none; transition: all 0.3s;"
               onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 28px rgba(0,0,0,0.15)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <!-- Imagen de modelo -->
                <div style="position: absolute; bottom: 0; right: 0; width: 100%; height: 100%; background: url('https://images.unsplash.com/photo-1617137968427-85924c800a22?w=800&h=1200&fit=crop') center bottom/cover; background-position: center 30%;"></div>
                
                <!-- Overlay gradient -->
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, transparent 50%);"></div>
                
                <!-- Content -->
                <div style="position: absolute; top: 40px; right: 40px; z-index: 2; text-align: right;">
                    <div style="background-color: #212529; padding: 6px 16px; border-radius: 20px; display: inline-block; margin-bottom: 16px;">
                        <span style="font-size: 12px; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 1px;">Estilo Moderno</span>
                    </div>
                    <h4 style="font-size: 32px; font-weight: 700; color: white; margin: 0 0 12px 0; line-height: 1.2; text-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                        Casual<br>Premium
                    </h4>
                    <p style="font-size: 15px; color: white; margin: 0 0 20px 0; text-shadow: 0 2px 6px rgba(0,0,0,0.4);">Lo mejor para ti</p>
                    <div style="display: inline-flex; align-items: center; gap: 8px; background-color: #EE403D; color: white; padding: 12px 24px; border-radius: 6px; font-weight: 600; font-size: 14px; transition: all 0.3s;">
                        Ver Colección
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <!-- Grid de 3 banners pequeños -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <!-- Mini Banner 1: Accesorios -->
            <a href="{{ route('shop.index', ['category' => 26]) }}" style="position: relative; display: block; height: 350px; background-color: #FFF; border-radius: 8px; overflow: hidden; text-decoration: none; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: all 0.3s;"
               onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.12)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)';">
                <div style="width: 100%; height: 70%; background: url('https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=600&h=400&fit=crop') center/cover;"></div>
                <div style="padding: 20px; text-align: center;">
                    <h5 style="font-size: 18px; font-weight: 700; color: #212529; margin: 0 0 8px 0;">Accesorios</h5>
                    <p style="font-size: 13px; color: #666; margin: 0;">Complementa tu estilo</p>
                </div>
            </a>

            <!-- Mini Banner 2: Zapatos -->
            <a href="{{ route('shop.index', ['category' => 25]) }}" style="position: relative; display: block; height: 350px; background-color: #FFF; border-radius: 8px; overflow: hidden; text-decoration: none; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: all 0.3s;"
               onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.12)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)';">
                <div style="width: 100%; height: 70%; background: url('https://images.unsplash.com/photo-1543163521-1bf539c55dd2?w=600&h=400&fit=crop') center/cover;"></div>
                <div style="padding: 20px; text-align: center;">
                    <h5 style="font-size: 18px; font-weight: 700; color: #212529; margin: 0 0 8px 0;">Calzado</h5>
                    <p style="font-size: 13px; color: #666; margin: 0;">Desde casual hasta formal</p>
                </div>
            </a>

            <!-- Mini Banner 3: Bolsos -->
            <a href="{{ route('shop.index', ['category' => 26]) }}" style="position: relative; display: block; height: 350px; background-color: #FFF; border-radius: 8px; overflow: hidden; text-decoration: none; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: all 0.3s;"
               onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.12)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)';">
                <div style="width: 100%; height: 70%; background: url('https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=600&h=400&fit=crop') center/cover;"></div>
                <div style="padding: 20px; text-align: center;">
                    <h5 style="font-size: 18px; font-weight: 700; color: #212529; margin: 0 0 8px 0;">Bolsos</h5>
                    <p style="font-size: 13px; color: #666; margin: 0;">Elegancia y funcionalidad</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- ========== BEST SELLERS SECTION ========== -->
<section style="padding: 80px 0; background-color: white;">
    <div style="max-width: 100%; margin: 0 auto; padding: 0 80px;">
        <!-- Header -->
        <div style="text-align: center; margin-bottom: 50px;">
            <span style="display: inline-block; background-color: #F5F6F2; padding: 8px 20px; border-radius: 4px; font-size: 14px; font-weight: 600; color: #777; margin-bottom: 10px;">Best Sellers</span>
            <h3 style="font-size: 36px; font-weight: 700; color: #212529; margin: 0;">LOS MÁS VENDIDOS</h3>
        </div>

        <!-- Products Carousel -->
        <div class="swiper bestSellersSwiper" style="padding: 20px 0;">
            <div class="swiper-wrapper">
                @foreach($bestSellers as $product)
                <!-- Product Card -->
                <div class="swiper-slide">
                    <div style="background-color: white; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.08); cursor: pointer; display: flex; flex-direction: column; height: 100%;" 
                         onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 16px 32px rgba(0,0,0,0.12)';" 
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)';" 
                         onclick="window.location.href='{{ route('shop.show', $product->slug) }}'">
                        
                        <div style="position: relative; width: 100%; height: 320px; overflow: hidden; background-color: #F8F9FA; display: flex; align-items: center; justify-content: center; padding: 20px;">
                            @php
                                $badgeTop = 12;
                            @endphp
                            
                            @if($product->hasDiscount())
                                <span style="position: absolute; top: {{ $badgeTop }}px; right: 12px; background-color: #E32020; color: white; padding: 8px 14px; font-size: 12px; font-weight: 700; border-radius: 6px; z-index: 10; box-shadow: 0 2px 8px rgba(227, 32, 32, 0.3);">-{{ $product->discount_percentage }}%</span>
                                @php $badgeTop += 38; @endphp
                            @endif
                            
                            @if($product->isNew())
                                <span style="position: absolute; top: {{ $badgeTop }}px; right: 12px; background-color: #28A745; color: white; padding: 8px 14px; font-size: 12px; font-weight: 700; border-radius: 6px; z-index: 10; box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);">NEW</span>
                                @php $badgeTop += 38; @endphp
                            @endif
                            
                            <!-- Best Seller Badge -->
                            <span style="position: absolute; top: {{ $badgeTop }}px; right: 12px; background-color: #FFB800; color: white; padding: 8px 14px; font-size: 12px; font-weight: 700; border-radius: 6px; z-index: 10; box-shadow: 0 2px 8px rgba(255, 184, 0, 0.3);">⭐ TOP</span>
                            
                            @php
                                $images = is_array($product->images) ? $product->images : (is_string($product->images) ? json_decode($product->images, true) : []);
                                $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
                                $imageUrl = $firstImage ? (filter_var($firstImage, FILTER_VALIDATE_URL) ? $firstImage : asset('storage/' . $firstImage)) : asset('images/placeholder-product.svg');
                            @endphp
                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: contain; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';" loading="lazy">
                        </div>
                        
                        <div style="padding: 24px; flex: 1; display: flex; flex-direction: column;">
                            <h4 style="font-size: 15px; font-weight: 600; color: #212529; margin: 0 0 10px 0; line-height: 1.4; min-height: 42px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $product->name }}</h4>
                            
                            @if($product->hasDiscount())
                                <div style="display: flex; align-items: baseline; gap: 10px; margin-bottom: 18px;">
                                    <span style="font-size: 13px; color: #999; text-decoration: line-through; font-weight: 500;">${{ number_format($product->price, 2) }}</span>
                                    <span style="font-size: 22px; font-weight: 700; color: #E32020;">${{ number_format($product->sale_price, 2) }}</span>
                                </div>
                            @else
                                <div style="margin-bottom: 18px;">
                                    <span style="font-size: 22px; font-weight: 700; color: #212529;">${{ number_format($product->price, 2) }}</span>
                                </div>
                            @endif
                            
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" onclick="event.stopPropagation();" style="margin-top: auto;">
                                @csrf
                                <button type="submit" style="width: 100%; background-color: #212529; color: white; border: none; padding: 14px; font-size: 13px; font-weight: 700; border-radius: 6px; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s;" 
                                    onmouseover="this.style.backgroundColor='#EE403D'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(238, 64, 61, 0.3)';" 
                                    onmouseout="this.style.backgroundColor='#212529'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
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

<!-- ========== FEATURED PRODUCTS SECTION ========== -->
<section style="padding: 100px 0 120px; background-color: #F8F8F8;">
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
                    <div style="background-color: white; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.08); cursor: pointer; height: 100%; display: flex; flex-direction: column;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 16px 32px rgba(0,0,0,0.12)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)';" onclick="window.location.href='{{ route('shop.show', $product->slug) }}'">
                        <div style="position: relative; width: 100%; height: 320px; overflow: hidden; background-color: #F8F9FA; display: flex; align-items: center; justify-content: center; padding: 20px;">
                            @php
                                $badgeTop = 12;
                            @endphp
                            
                            @if($product->hasDiscount())
                                <span style="position: absolute; top: {{ $badgeTop }}px; right: 12px; background-color: #E32020; color: white; padding: 8px 14px; font-size: 12px; font-weight: 700; border-radius: 6px; z-index: 10; box-shadow: 0 2px 8px rgba(227, 32, 32, 0.3);">-{{ $product->discount_percentage }}%</span>
                                @php $badgeTop += 38; @endphp
                            @endif
                            
                            @if($product->isNew())
                                <span style="position: absolute; top: {{ $badgeTop }}px; right: 12px; background-color: #28A745; color: white; padding: 8px 14px; font-size: 12px; font-weight: 700; border-radius: 6px; z-index: 10; box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);">NEW</span>
                                @php $badgeTop += 38; @endphp
                            @endif
                            
                            @if($product->is_featured)
                                <span style="position: absolute; top: {{ $badgeTop }}px; right: 12px; background-color: #EE403D; color: white; padding: 8px 14px; font-size: 12px; font-weight: 700; border-radius: 6px; z-index: 10; box-shadow: 0 2px 8px rgba(238, 64, 61, 0.3);">HOT</span>
                            @endif
                            
                            @if($product->images && is_array($product->images) && count($product->images) > 0)
                                @php
                                    $imageUrl = $product->images[0];
                                    if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                                        $imageUrl = asset('storage/' . $imageUrl);
                                    }
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: contain; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';" loading="lazy">
                            @else
                                <img src="{{ asset('images/placeholder-product.svg') }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: contain;" loading="lazy">
                            @endif
                        </div>
                        <div style="padding: 24px; flex: 1; display: flex; flex-direction: column;">
                            <h4 style="font-size: 15px; font-weight: 600; color: #212529; margin: 0 0 10px 0; line-height: 1.4; min-height: 42px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $product->name }}</h4>
                            
                            @if($product->hasDiscount())
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 18px;">
                                    <span style="font-size: 13px; color: #999; text-decoration: line-through; font-weight: 500;">${{ number_format($product->price, 2) }}</span>
                                    <span style="font-size: 22px; font-weight: 700; color: #E32020;">${{ number_format($product->sale_price, 2) }}</span>
                                </div>
                            @else
                                <div style="margin-bottom: 18px;">
                                    <span style="font-size: 22px; font-weight: 700; color: #212529;">${{ number_format($product->price, 2) }}</span>
                                </div>
                            @endif
                            
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" onclick="event.stopPropagation();" style="margin-top: auto;">
                                @csrf
                                <button type="submit" style="width: 100%; background-color: #212529; color: white; border: none; padding: 14px; font-size: 13px; font-weight: 700; border-radius: 6px; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s;" onmouseover="this.style.backgroundColor='#EE403D'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(238, 64, 61, 0.3)';" onmouseout="this.style.backgroundColor='#212529'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
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

@push('styles')
<style>
/* Ocultar las flechas de navegación para los carousels de categorías y productos */
.categoriesSwiper .swiper-button-next,
.categoriesSwiper .swiper-button-prev,
.productsSwiper .swiper-button-next,
.productsSwiper .swiper-button-prev,
.bestSellersSwiper .swiper-button-next,
.bestSellersSwiper .swiper-button-prev {
    display: none !important;
}

/* Mostrar las flechas solo para el hero */
.heroSwiper .swiper-button-next,
.heroSwiper .swiper-button-prev {
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

/* Hero pagination custom style */
.hero-pagination {
    bottom: 32px !important;
    left: 50% !important;
    transform: translateX(-50%) !important;
    width: auto !important;
}

.hero-pagination .swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background-color: #666;
    opacity: 0.4;
    margin: 0 6px;
}

.hero-pagination .swiper-pagination-bullet-active {
    background-color: #EE403D;
    opacity: 1;
    width: 28px;
    border-radius: 5px;
}

/* Best Sellers pagination custom style */
.swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background-color: #999;
    opacity: 0.5;
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

/* Responsive para hero section */
@media (max-width: 1200px) {
    section > div[style*="grid-template-columns: 280px 1fr"] {
        grid-template-columns: 1fr !important;
    }
    
    section > div > div:first-child {
        display: none !important;
    }
}

@media (max-width: 768px) {
    .heroSwiper h1 {
        font-size: 38px !important;
    }
    
    .heroSwiper .swiper-slide > div {
        padding: 40px 30px !important;
    }
    
    .heroSwiper .swiper-slide > div > div:last-child {
        display: none !important;
    }
}

/* Deal of the Week Responsive */
@media (max-width: 1024px) {
    section > div > div[style*="grid-template-columns: 1fr 1fr"] {
        grid-template-columns: 1fr !important;
    }
    
    section > div > div[style*="grid-template-columns: 1fr 1fr"] > div:first-child {
        min-height: 400px !important;
    }
    
    section > div > div[style*="grid-template-columns: 1fr 1fr"] > div:last-child {
        padding: 40px 30px !important;
    }
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

    // Swiper para Best Sellers
    const bestSellersSwiper = new Swiper('.bestSellersSwiper', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        pagination: {
            el: '.bestSellersSwiper .swiper-pagination',
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

    // Countdown Timer for Deal of the Week (3 días desde ahora)
    const countdownDate = new Date();
    countdownDate.setDate(countdownDate.getDate() + 3);
    
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = countdownDate - now;
        
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        const dealDaysEl = document.getElementById('deal-days');
        const dealHoursEl = document.getElementById('deal-hours');
        const dealMinutesEl = document.getElementById('deal-minutes');
        const dealSecondsEl = document.getElementById('deal-seconds');
        
        if (dealDaysEl) dealDaysEl.textContent = days;
        if (dealHoursEl) dealHoursEl.textContent = hours;
        if (dealMinutesEl) dealMinutesEl.textContent = minutes;
        if (dealSecondsEl) dealSecondsEl.textContent = seconds;
        
        if (distance < 0) {
            clearInterval(countdownInterval);
            if (dealDaysEl) dealDaysEl.textContent = '0';
            if (dealHoursEl) dealHoursEl.textContent = '0';
            if (dealMinutesEl) dealMinutesEl.textContent = '0';
            if (dealSecondsEl) dealSecondsEl.textContent = '0';
        }
    }
    
    updateCountdown();
    const countdownInterval = setInterval(updateCountdown, 1000);

    // Swiper para Hero Banner
    const heroSwiper = new Swiper('.heroSwiper', {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.hero-pagination',
            clickable: true,
        },
        speed: 800,
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


<!-- Search Modal -->
@include('components.search-modal')

<!-- Newsletter Popup -->
@include('components.newsletter-popup')

@endsection