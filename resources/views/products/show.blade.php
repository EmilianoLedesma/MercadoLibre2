@extends('layouts.app')

@section('title', 'Detalle de Producto')

@section('content')
<!-- Header -->
<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <h1>SEALS</h1>
            </div>

            <nav class="nav">
                <a href="{{ route('home') }}" class="nav-link">Inicio</a>
                <a href="{{ route('products.index') }}" class="nav-link active">Productos</a>
                <a href="{{ route('categories') }}" class="nav-link">Categorías</a>
                <a href="#" class="nav-link">Contacto</a>
            </nav>

            <div class="header-actions">
                <button class="icon-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>

                @auth
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="color: #333; font-weight: 500;">Hola, {{ Auth::user()->name }}</span>
                        <a href="{{ route('clientes') }}" class="nav-link" style="margin: 0;">Clientes</a>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="icon-btn" style="background: none; border: none; cursor: pointer;">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="icon-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>
                @endauth

                <a href="{{ route('cart') }}" class="icon-btn cart">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span class="cart-count">0</span>
                </a>
            </div>
        </div>
    </div>
</header>

<main class="product-detail-page">
    <div class="container">
        <div class="page-header">
            <h1>Detalles del Producto</h1>
            <div class="header-actions">
                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Editar</a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver a Lista</a>
            </div>
        </div>

        <div class="product-detail-container">
            <div class="product-gallery">
                @php
                    $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                    $images = $images ?? [];
                @endphp
                
                @if(count($images) > 0)
                    <div class="product-main-image">
                        <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $product->name }}" id="mainImage">
                    </div>
                    
                    @if(count($images) > 1)
                        <div class="product-thumbnails">
                            @foreach($images as $index => $image)
                                <div class="thumbnail {{ $index === 0 ? 'active' : '' }}" data-image="{{ asset('storage/' . $image) }}">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }} - imagen {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="no-image">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                        <span>Sin imágenes disponibles</span>
                    </div>
                @endif
            </div>
            
            <div class="product-info">
                <div class="product-badges">
                    @if($product->is_featured)
                        <span class="badge featured">Destacado</span>
                    @endif
                    
                    @if(!$product->is_active)
                        <span class="badge inactive">Inactivo</span>
                    @endif
                    
                    @if($product->stock_quantity <= 0)
                        <span class="badge out-of-stock">Agotado</span>
                    @elseif($product->stock_quantity < 10)
                        <span class="badge low-stock">Pocas unidades</span>
                    @endif
                </div>
                
                <h2 class="product-title">{{ $product->name }}</h2>
                
                <div class="product-meta">
                    <div class="meta-item">
                        <span class="meta-label">SKU:</span>
                        <span class="meta-value">{{ $product->sku }}</span>
                    </div>
                    
                    <div class="meta-item">
                        <span class="meta-label">Categoría:</span>
                        <span class="meta-value">{{ $product->category->name ?? 'Sin categoría' }}</span>
                    </div>
                    
                    <div class="meta-item">
                        <span class="meta-label">Stock:</span>
                        <span class="meta-value">{{ $product->stock_quantity }} unidades</span>
                    </div>
                </div>
                
                <div class="product-pricing">
                    @if($product->sale_price)
                        <div class="original-price">${{ number_format($product->price, 2) }}</div>
                        <div class="sale-price">${{ number_format($product->sale_price, 2) }}</div>
                        @php
                            $discount = (($product->price - $product->sale_price) / $product->price) * 100;
                        @endphp
                        <div class="discount-tag">{{ round($discount) }}% OFF</div>
                    @else
                        <div class="current-price">${{ number_format($product->price, 2) }}</div>
                    @endif
                </div>
                
                <div class="product-short-description">
                    <p>{{ $product->short_description ?? 'Sin descripción corta disponible.' }}</p>
                </div>
                
                <div class="product-actions">
                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar Producto</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="product-tabs">
            <div class="tabs-header">
                <button class="tab-btn active" data-tab="description">Descripción Completa</button>
                <button class="tab-btn" data-tab="details">Detalles Adicionales</button>
            </div>
            
            <div class="tabs-content">
                <div class="tab-panel active" id="description">
                    <div class="product-description">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
                
                <div class="tab-panel" id="details">
                    <div class="product-details">
                        <table class="details-table">
                            <tbody>
                                <tr>
                                    <th>ID del Producto</th>
                                    <td>{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $product->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de Creación</th>
                                    <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Última Actualización</th>
                                    <td>{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Vendedor</th>
                                    <td>{{ $product->user->name ?? 'Desconocido' }}</td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td>
                                        <span class="status {{ $product->is_active ? 'active' : 'inactive' }}">
                                            {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Destacado</th>
                                    <td>{{ $product->is_featured ? 'Sí' : 'No' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} SEALS. Todos los derechos reservados.</p>
    </div>
</footer>

<style>
    /* Estilos específicos para la página de detalle de producto */
    .product-detail-page {
        padding: 40px 0;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-header h1 {
        font-size: 28px;
        color: #333;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: #667eea;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background: #5a6acf;
    }

    .btn-secondary {
        background: #64748b;
        color: white;
        border: none;
    }

    .btn-secondary:hover {
        background: #475569;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .product-detail-container {
        display: grid;
        grid-template-columns: minmax(300px, 1fr) minmax(300px, 1fr);
        gap: 40px;
        margin-bottom: 40px;
        align-items: start;
    }
    
    @media (max-width: 768px) {
        .product-detail-container {
            grid-template-columns: 1fr;
        }
    }

    /* Estilos para la galería de imágenes */
    .product-gallery {
        border-radius: 8px;
        overflow: hidden;
        max-width: 100%;
    }

    .product-main-image {
        width: 100%;
        max-height: 500px;
        background-color: #f8fafc;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 10px;
        text-align: center;
    }

    .product-main-image img {
        max-width: 100%;
        max-height: 500px;
        object-fit: contain;
        display: block;
        margin: 0 auto;
    }

    .product-thumbnails {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding: 5px 0;
        flex-wrap: wrap;
        justify-content: center;
    }

    .thumbnail {
        width: 80px;
        height: 80px;
        border-radius: 4px;
        overflow: hidden;
        cursor: pointer;
        opacity: 0.7;
        transition: all 0.2s ease;
    }

    .thumbnail:hover,
    .thumbnail.active {
        opacity: 1;
        box-shadow: 0 0 0 2px #667eea;
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        height: 100%;
        object-fit: cover;
    }

    .no-image {
        width: 100%;
        aspect-ratio: 1 / 1;
        background-color: #f8fafc;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        color: #64748b;
    }

    .no-image svg {
        margin-bottom: 10px;
    }

    /* Estilos para la información del producto */
    .product-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 15px;
    }

    .badge {
        display: inline-block;
        padding: 4px 8px;
        font-size: 12px;
        font-weight: 500;
        border-radius: 20px;
    }

    .badge.featured {
        background-color: #fef9c3;
        color: #854d0e;
    }

    .badge.inactive {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .badge.out-of-stock {
        background-color: #f9fafb;
        color: #6b7280;
    }

    .badge.low-stock {
        background-color: #fffbeb;
        color: #92400e;
    }

    .product-title {
        font-size: 24px;
        color: #111827;
        margin-bottom: 15px;
    }

    .product-meta {
        margin-bottom: 20px;
    }

    .meta-item {
        display: flex;
        margin-bottom: 8px;
    }

    .meta-label {
        width: 100px;
        font-weight: 500;
        color: #64748b;
    }

    .meta-value {
        color: #334155;
    }

    .product-pricing {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .current-price,
    .sale-price {
        font-size: 24px;
        font-weight: 600;
        color: #111827;
    }

    .original-price {
        font-size: 18px;
        color: #94a3b8;
        text-decoration: line-through;
    }

    .discount-tag {
        background-color: #ef4444;
        color: white;
        font-size: 12px;
        font-weight: 500;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .product-short-description {
        margin-bottom: 30px;
        color: #64748b;
        line-height: 1.6;
    }

    .product-actions {
        margin-top: 30px;
    }

    /* Estilos para las pestañas */
    .product-tabs {
        margin-top: 40px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }

    .tabs-header {
        display: flex;
        background-color: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .tab-btn {
        padding: 15px 20px;
        background: none;
        border: none;
        font-weight: 500;
        color: #64748b;
        cursor: pointer;
        transition: all 0.2s ease;
        border-bottom: 2px solid transparent;
    }

    .tab-btn.active {
        color: #667eea;
        border-bottom: 2px solid #667eea;
    }

    .tabs-content {
        padding: 20px;
    }

    .tab-panel {
        display: none;
    }

    .tab-panel.active {
        display: block;
    }

    .product-description {
        color: #334155;
        line-height: 1.7;
    }

    .details-table {
        width: 100%;
        border-collapse: collapse;
    }

    .details-table tr {
        border-bottom: 1px solid #e2e8f0;
    }

    .details-table th,
    .details-table td {
        padding: 12px 0;
        text-align: left;
    }

    .details-table th {
        width: 200px;
        color: #64748b;
    }

    .details-table td {
        color: #334155;
    }

    .status {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status.active {
        background-color: #d1fae5;
        color: #065f46;
    }

    .status.inactive {
        background-color: #fee2e2;
        color: #991b1b;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Galería de imágenes
        const thumbnails = document.querySelectorAll('.thumbnail');
        const mainImage = document.getElementById('mainImage');
        
        if (thumbnails.length > 0 && mainImage) {
            // Asegurar que la imagen principal tenga el tamaño correcto al cargar
            mainImage.onload = function() {
                const imageContainer = mainImage.parentElement;
                imageContainer.style.height = 'auto';
            };
            
            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    // Crear una nueva imagen para precargar
                    const img = new Image();
                    img.onload = function() {
                        // Actualizar la imagen principal solo cuando esté cargada
                        mainImage.src = img.src;
                    };
                    img.src = this.dataset.image;
                    
                    // Actualizar la clase activa
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        }
        
        // Pestañas de contenido
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabPanels = document.querySelectorAll('.tab-panel');
        
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Desactivar todas las pestañas
                tabBtns.forEach(b => b.classList.remove('active'));
                tabPanels.forEach(p => p.classList.remove('active'));
                
                // Activar la pestaña actual
                this.classList.add('active');
                document.getElementById(this.dataset.tab).classList.add('active');
            });
        });
    });
</script>
@endsection