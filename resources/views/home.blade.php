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
            <a href="#" style="color: #212529; text-decoration: none; transition: color 0.25s;">Mi Cuenta</a>
            <a href="#" style="color: #212529; text-decoration: none; transition: color 0.25s;">Favoritos</a>
            <a href="#" style="color: #212529; text-decoration: none; transition: color 0.25s;">Rastrear Pedido</a>
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
        <nav style="display: flex; gap: 32px; flex: 1; justify-content: center;">
            <a href="{{ route('home') }}" style="color: #EE403D; font-weight: 500; text-decoration: none; transition: color 0.25s;">Inicio</a>
            <a href="{{ route('shop.index') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s;">Shop</a>
            <a href="{{ route('categories') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s;">Categorías</a>
            <a href="{{ route('contact') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s;">Contacto</a>
        </nav>

        <!-- Header Actions -->
        <div style="display: flex; align-items: center; gap: 20px;">
            <!-- Search -->
            <button style="background: none; border: none; cursor: pointer; padding: 8px;" aria-label="Buscar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </button>

            <!-- User -->
            @auth
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="color: #212529; font-weight: 500;">Hola, {{ Auth::user()->name }}</span>
                    <a href="{{ route('clientes') }}" style="color: #212529; text-decoration: none;">Clientes</a>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" style="background: #EE403D; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-weight: 500;">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
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
                <span style="position: absolute; top: 0; right: 0; background-color: #EE403D; color: white; font-size: 10px; font-weight: 600; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;">3</span>
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
<section style="padding: 80px 20px; background-color: white;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h3 style="text-align: center; font-size: 36px; font-weight: 700; color: #212529; margin: 0 0 50px 0;">Categorías Populares</h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px;">
            <!-- Category Card 1 -->
            <div style="position: relative; border-radius: 8px; overflow: hidden; cursor: pointer; transition: transform 0.25s;">
                <div style="width: 100%; height: 350px; background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%), url('https://via.placeholder.com/300x400/FFB6C1/FFFFFF?text=WOMEN') center/cover;"></div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 20px; color: white;">
                    <p style="margin: 0 0 5px 0; font-size: 14px;"><span style="font-weight: 600;">20</span> <span style="opacity: 0.8;">items</span></p>
                    <h4 style="margin: 0; font-size: 20px; font-weight: 700; text-transform: uppercase;">FOR WOMEN'S</h4>
                </div>
            </div>

            <!-- Category Card 2 -->
            <div style="position: relative; border-radius: 8px; overflow: hidden; cursor: pointer; transition: transform 0.25s;">
                <div style="width: 100%; height: 350px; background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%), url('https://via.placeholder.com/300x400/87CEEB/FFFFFF?text=MEN') center/cover;"></div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 20px; color: white;">
                    <p style="margin: 0 0 5px 0; font-size: 14px;"><span style="font-weight: 600;">33</span> <span style="opacity: 0.8;">items</span></p>
                    <h4 style="margin: 0; font-size: 20px; font-weight: 700; text-transform: uppercase;">FOR MAN'S</h4>
                </div>
            </div>

            <!-- Category Card 3 -->
            <div style="position: relative; border-radius: 8px; overflow: hidden; cursor: pointer; transition: transform 0.25s;">
                <div style="width: 100%; height: 350px; background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%), url('https://via.placeholder.com/300x400/FFD700/FFFFFF?text=KIDS') center/cover;"></div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 20px; color: white;">
                    <p style="margin: 0 0 5px 0; font-size: 14px;"><span style="font-weight: 600;">25</span> <span style="opacity: 0.8;">items</span></p>
                    <h4 style="margin: 0; font-size: 20px; font-weight: 700; text-transform: uppercase;">FOR KIDS</h4>
                </div>
            </div>

            <!-- Category Card 4 -->
            <div style="position: relative; border-radius: 8px; overflow: hidden; cursor: pointer; transition: transform 0.25s;">
                <div style="width: 100%; height: 350px; background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%), url('https://via.placeholder.com/300x400/DDA0DD/FFFFFF?text=ACCESSORIES') center/cover;"></div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 20px; color: white;">
                    <p style="margin: 0 0 5px 0; font-size: 14px;"><span style="font-weight: 600;">33</span> <span style="opacity: 0.8;">items</span></p>
                    <h4 style="margin: 0; font-size: 20px; font-weight: 700; text-transform: uppercase;">ACCESORIES</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== FEATURED PRODUCTS SECTION ========== -->
<section style="padding: 80px 20px; background-color: #F8F8F8;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 50px;">
            <span style="display: inline-block; background-color: #F5F6F2; padding: 8px 20px; border-radius: 4px; font-size: 14px; font-weight: 600; color: #777; margin-bottom: 10px;">Featured</span>
            <h3 style="font-size: 36px; font-weight: 700; color: #212529; margin: 0;">PRODUCTOS DESTACADOS</h3>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;">
            <!-- Product Card 1 -->
            <div style="background-color: white; border-radius: 8px; overflow: hidden; transition: all 0.25s; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div style="position: relative; width: 100%; height: 350px; overflow: hidden;">
                    <span style="position: absolute; top: 12px; right: 12px; background-color: #28A745; color: white; padding: 6px 12px; font-size: 11px; font-weight: 700; border-radius: 3px; z-index: 10;">NEW</span>
                    <img src="https://via.placeholder.com/300x400/F0E68C/FFFFFF?text=Product+1" alt="Producto" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 20px;">
                    <h4 style="font-size: 16px; font-weight: 500; color: #212529; margin: 0 0 12px 0;">Producto Destacado 1</h4>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                        <span style="font-size: 20px; font-weight: 700; color: #404040;">$99.00</span>
                    </div>
                    <button style="width: 100%; background-color: transparent; color: #212529; border: 2px solid #212529; padding: 12px; font-size: 14px; font-weight: 600; border-radius: 4px; cursor: pointer; text-transform: uppercase; transition: all 0.25s;">
                        Agregar al Carrito
                    </button>
                </div>
            </div>

            <!-- Product Card 2 -->
            <div style="background-color: white; border-radius: 8px; overflow: hidden; transition: all 0.25s; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div style="position: relative; width: 100%; height: 350px; overflow: hidden;">
                    <span style="position: absolute; top: 12px; right: 12px; background-color: #E32020; color: white; padding: 6px 12px; font-size: 11px; font-weight: 700; border-radius: 3px; z-index: 10;">-38%</span>
                    <span style="position: absolute; top: 45px; right: 12px; background-color: #EE403D; color: white; padding: 6px 12px; font-size: 11px; font-weight: 700; border-radius: 3px; z-index: 10;">HOT</span>
                    <img src="https://via.placeholder.com/300x400/F08080/FFFFFF?text=Product+2" alt="Producto" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 20px;">
                    <h4 style="font-size: 16px; font-weight: 500; color: #212529; margin: 0 0 12px 0;">Producto en Oferta</h4>
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
                        <span style="font-size: 14px; color: #999; text-decoration: line-through;">$120.00</span>
                        <span style="font-size: 20px; font-weight: 700; color: #E32020;">$85.00</span>
                    </div>
                    <button style="width: 100%; background-color: transparent; color: #212529; border: 2px solid #212529; padding: 12px; font-size: 14px; font-weight: 600; border-radius: 4px; cursor: pointer; text-transform: uppercase; transition: all 0.25s;">
                        Agregar al Carrito
                    </button>
                </div>
            </div>

            <!-- Product Card 3 -->
            <div style="background-color: white; border-radius: 8px; overflow: hidden; transition: all 0.25s; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div style="position: relative; width: 100%; height: 350px; overflow: hidden;">
                    <img src="https://via.placeholder.com/300x400/98FB98/FFFFFF?text=Product+3" alt="Producto" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 20px;">
                    <h4 style="font-size: 16px; font-weight: 500; color: #212529; margin: 0 0 12px 0;">Producto Regular</h4>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                        <span style="font-size: 20px; font-weight: 700; color: #404040;">$110.00</span>
                    </div>
                    <button style="width: 100%; background-color: transparent; color: #212529; border: 2px solid #212529; padding: 12px; font-size: 14px; font-weight: 600; border-radius: 4px; cursor: pointer; text-transform: uppercase; transition: all 0.25s;">
                        Agregar al Carrito
                    </button>
                </div>
            </div>

            <!-- Product Card 4 -->
            <div style="background-color: white; border-radius: 8px; overflow: hidden; transition: all 0.25s; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div style="position: relative; width: 100%; height: 350px; overflow: hidden;">
                    <span style="position: absolute; top: 12px; right: 12px; background-color: #EE403D; color: white; padding: 6px 12px; font-size: 11px; font-weight: 700; border-radius: 3px; z-index: 10;">HOT</span>
                    <img src="https://via.placeholder.com/300x400/FFB6C1/FFFFFF?text=Product+4" alt="Producto" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 20px;">
                    <h4 style="font-size: 16px; font-weight: 500; color: #212529; margin: 0 0 12px 0;">Producto Popular</h4>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                        <span style="font-size: 20px; font-weight: 700; color: #404040;">$95.00</span>
                    </div>
                    <button style="width: 100%; background-color: transparent; color: #212529; border: 2px solid #212529; padding: 12px; font-size: 14px; font-weight: 600; border-radius: 4px; cursor: pointer; text-transform: uppercase; transition: all 0.25s;">
                        Agregar al Carrito
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== FOOTER ========== -->
@include('layouts.footer')
@endsection
