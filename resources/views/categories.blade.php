@extends('layouts.app')

@section('title', 'Categorías')

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
                <a href="{{ route('categories') }}" class="nav-link active">Categories</a>
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
                <a href="{{ route('cart') }}" class="icon-btn cart">
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

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Todas las Categorías</h1>
        <p>Explora nuestras categorías y encuentra lo que buscas</p>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-page">
    <div class="container">
        <div class="categories-grid-large">
            <!-- Hombre -->
            <div class="category-card-large">
                <div class="category-image-large men"></div>
                <div class="category-info">
                    <h3>Hombre</h3>
                    <p>Ropa y accesorios para hombre</p>
                    <a href="#" class="btn-secondary">Ver Productos</a>
                </div>
            </div>

            <!-- Mujer -->
            <div class="category-card-large">
                <div class="category-image-large women"></div>
                <div class="category-info">
                    <h3>Mujer</h3>
                    <p>Moda femenina y accesorios</p>
                    <a href="#" class="btn-secondary">Ver Productos</a>
                </div>
            </div>

            <!-- Niños -->
            <div class="category-card-large">
                <div class="category-image-large kids"></div>
                <div class="category-info">
                    <h3>Niños</h3>
                    <p>Ropa y juguetes para niños</p>
                    <a href="#" class="btn-secondary">Ver Productos</a>
                </div>
            </div>

            <!-- Accesorios -->
            <div class="category-card-large">
                <div class="category-image-large accessories"></div>
                <div class="category-info">
                    <h3>Accesorios</h3>
                    <p>Complementos y accesorios</p>
                    <a href="#" class="btn-secondary">Ver Productos</a>
                </div>
            </div>

            <!-- Calzado -->
            <div class="category-card-large">
                <div class="category-image-large shoes"></div>
                <div class="category-info">
                    <h3>Calzado</h3>
                    <p>Zapatos y zapatillas para todos</p>
                    <a href="#" class="btn-secondary">Ver Productos</a>
                </div>
            </div>

            <!-- Deportes -->
            <div class="category-card-large">
                <div class="category-image-large sports"></div>
                <div class="category-info">
                    <h3>Deportes</h3>
                    <p>Ropa y equipamiento deportivo</p>
                    <a href="#" class="btn-secondary">Ver Productos</a>
                </div>
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
