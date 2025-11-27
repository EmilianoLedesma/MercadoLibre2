@extends('layouts.app')

@section('title', 'Categorías')

@push('styles')
<style>
    .categories-hero {
        background: linear-gradient(135deg, #EE403D 0%, #E32020 100%);
        padding: 60px 20px;
        text-align: center;
        color: white;
        font-family: 'Jost', sans-serif;
    }

    .categories-hero h1 {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .categories-hero p {
        font-size: 17px;
        opacity: 0.95;
    }

    .categories-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 24px;
    }

    .category-card {
        background: white;
        border: 1px solid #E5E5E5;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        flex-direction: column;
    }

    .category-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        border-color: #EE403D;
    }

    .category-image {
        width: 100%;
        height: 200px;
        position: relative;
        background: linear-gradient(135deg, #F5F6F2 0%, #E5E5E5 100%);
        overflow: hidden;
    }

    .category-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .category-card:hover .category-image img {
        transform: scale(1.08);
    }

    .category-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(238, 64, 61, 0.95);
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        font-family: 'Jost', sans-serif;
        backdrop-filter: blur(4px);
    }

    .category-content {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .category-title {
        font-size: 20px;
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
        flex: 1;
    }

    .category-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #EE403D;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        font-family: 'Jost', sans-serif;
        transition: gap 0.3s ease;
    }

    .category-link:hover {
        gap: 10px;
    }

    .category-link i {
        font-size: 12px;
    }

    .stats-section {
        background: linear-gradient(135deg, #F5F6F2 0%, #FAFAF9 100%);
        padding: 50px 20px;
        margin-top: 60px;
    }

    .stats-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 32px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 40px;
        font-weight: 700;
        color: #EE403D;
        margin-bottom: 6px;
        font-family: 'Jost', sans-serif;
    }

    .stat-label {
        font-size: 15px;
        color: #666;
        font-family: 'Jost', sans-serif;
    }

    @media (max-width: 768px) {
        .categories-hero h1 {
            font-size: 32px;
        }

        .categories-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .stats-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }
    }
</style>
@endpush

@section('content')
@include('layouts.navbar')

<!-- BREADCRUMB -->
<div style="background-color: #F8F8F8; padding: 20px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <nav style="font-family: 'Jost', sans-serif; font-size: 14px; color: #666;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="margin: 0 8px;">/</span>
            <span style="color: #212529; font-weight: 500;">Categorías</span>
        </nav>
    </div>
</div>

<!-- HERO SECTION -->
<div class="categories-hero">
    <h1>Explora Nuestras Categorías</h1>
    <p>Encuentra exactamente lo que buscas en nuestra amplia selección</p>
</div>

<!-- CATEGORIES GRID -->
<div class="categories-container">
    <div class="categories-grid">
        @forelse($categories as $category)
        <a href="{{ route('shop.category', $category->slug) }}" class="category-card" style="text-decoration: none;">
            <div class="category-image">
                @if($category->image)
                    <img loading="lazy" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                @else
                    <img loading="lazy" src="https://via.placeholder.com/400x300/F5F6F2/666?text={{ urlencode($category->name) }}" alt="{{ $category->name }}">
                @endif
                <span class="category-badge">{{ $category->products_count }} productos</span>
            </div>
            <div class="category-content">
                <h3 class="category-title">{{ $category->name }}</h3>
                <p class="category-description">{{ $category->description ?? 'Descubre nuestra selección de productos' }}</p>
                <span class="category-link">
                    Ver Productos
                    <i class="fas fa-arrow-right"></i>
                </span>
            </div>
        </a>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: #666;">
            <i class="fas fa-box-open" style="font-size: 48px; margin-bottom: 16px; opacity: 0.3;"></i>
            <p style="font-family: 'Jost', sans-serif; font-size: 18px;">No hay categorías disponibles en este momento</p>
        </div>
        @endforelse
    </div>
</div>

<!-- STATS SECTION -->
<div class="stats-section">
    <div class="stats-container">
        <div class="stat-item">
            <div class="stat-number">{{ $totalProducts }}+</div>
            <div class="stat-label">Productos</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $totalCategories }}</div>
            <div class="stat-label">Categorías</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $completedOrders }}+</div>
            <div class="stat-label">Pedidos Completados</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">24/7</div>
            <div class="stat-label">Soporte</div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
