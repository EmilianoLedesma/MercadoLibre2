@extends('layouts.app')

@section('title', 'Detalle de Producto')

@section('content')
<!-- TOP BANNER -->
<div style="background-color: #EE403D; color: white; text-align: center; padding: 12px 0; font-size: 14px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <p style="margin: 0;">
            Envío gratis en compras mayores a $100
            <a href="#" style="color: white; text-decoration: underline; margin-left: 8px;">Descubre Ahora</a>
        </p>
    </div>
</div>

<!-- SECONDARY HEADER -->
<div style="background-color: #F5F6F2; padding: 12px 0; font-size: 14px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center;">
        <nav style="display: flex; gap: 20px;">
            <a href="#" style="color: #212529; text-decoration: none; transition: color 0.25s;">Nosotros</a>
            <a href="{{ route('account') }}" style="color: #212529; text-decoration: none; transition: color 0.25s;">Mi Cuenta</a>
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

<!-- MAIN HEADER -->
<header style="background-color: white; padding: 20px 0; box-shadow: 0 2px 4px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center;">
        <!-- Logo -->
        <div style="flex-shrink: 0;">
            <a href="{{ route('home') }}" style="font-size: 32px; font-weight: 800; color: #212529; text-decoration: none; letter-spacing: 2px;">SEALS</a>
        </div>

        <!-- Main Navigation -->
        <nav style="display: flex; gap: 32px; flex: 1; justify-content: center;">
            <a href="{{ route('home') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s;">Inicio</a>
            <a href="{{ route('products.index') }}" style="color: #EE403D; font-weight: 500; text-decoration: none; transition: color 0.25s;">Productos</a>
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

<main class="product-detail-page" style="background: linear-gradient(135deg, #F5F6F2 0%, #E7E8E0 100%); padding: 40px 0;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
            <div>
                <span style="display: inline-block; background-color: #EE403D; color: white; padding: 8px 20px; border-radius: 20px; font-size: 14px; font-weight: 600; margin-bottom: 12px;">Detalle de Producto</span>
                <h1 style="font-size: 32px; font-weight: 700; color: #212529; margin: 0; line-height: 1.2;">{{ $product->name }}</h1>
            </div>
            <div class="header-actions" style="display: flex; gap: 12px;">
                <a href="{{ route('products.edit', $product) }}" style="background: #EE403D; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: background-color 0.3s;">
                    <i class="fas fa-edit" style="margin-right: 8px;"></i>Editar
                </a>
                <a href="{{ route('products.index') }}" style="background: #F5F6F2; color: #666; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: all 0.3s; border: 2px solid #E5E6E2;">
                    <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>Volver
                </a>
            </div>
        </div>

        <div class="product-detail-container" style="background: white; border-radius: 16px; padding: 40px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <div class="product-gallery" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
                @php
                    $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                    $images = $images ?? [];
                @endphp
                
                @if(count($images) > 0)
                    @php
                        $mainImage = $images[0] ?? null;
                        $mainStorage = $mainImage ? public_path('storage/' . $mainImage) : null;
                        $mainPublic = $mainImage ? public_path($mainImage) : null;
                        if ($mainImage && $mainStorage && file_exists($mainStorage)) {
                            $mainUrl = asset('storage/' . $mainImage);
                        } elseif ($mainImage && $mainPublic && file_exists($mainPublic)) {
                            $mainUrl = asset($mainImage);
                        } else {
                            $mainUrl = asset('images/placeholder-product.svg');
                        }
                    @endphp
                    <div class="product-main-image">
                        <img src="{{ $mainUrl }}" alt="{{ $product->name }}" id="mainImage">
                    </div>
                    
                    @if(count($images) > 1)
                        <div class="product-thumbnails">
                            @foreach($images as $index => $image)
                                @php
                                    $storagePath = public_path('storage/' . $image);
                                    $publicPath = public_path($image);
                                    if ($image && file_exists($storagePath)) {
                                        $thumbUrl = asset('storage/' . $image);
                                    } elseif ($image && file_exists($publicPath)) {
                                        $thumbUrl = asset($image);
                                    } else {
                                        $thumbUrl = asset('images/placeholder-product.svg');
                                    }
                                @endphp
                                <div class="thumbnail {{ $index === 0 ? 'active' : '' }}" data-image="{{ $thumbUrl }}">
                    @if(!empty($images))
                        <div style="width: 100%; aspect-ratio: 1; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                            <img src="{{ asset('storage/' . $mainImage) }}" alt="{{ $product->name }}" 
                                style="width: 100%; height: 100%; object-fit: cover;" id="mainImage">
                        </div>

                        @if(count($images) > 1)
                            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                                @foreach($images as $index => $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}"
                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; cursor: pointer; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.05)'" 
                                        onmouseout="this.style.transform='scale(1)'"
                                        onclick="updateMainImage(this.src)">
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div style="width: 100%; aspect-ratio: 1; border-radius: 16px; background: #F5F6F2; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 16px;">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <span style="color: #666; font-size: 14px;">Sin imágenes disponibles</span>
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div style="display: flex; flex-direction: column; gap: 32px;">
                    <!-- Status Badges -->
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        @if($product->is_featured)
                            <span style="background: #FEF3C7; color: #D97706; padding: 6px 12px; border-radius: 20px; font-size: 14px;">
                                <i class="fas fa-star" style="margin-right: 4px;"></i>Destacado
                            </span>
                        @endif
                        
                        @if(!$product->is_active)
                            <span style="background: #FEE2E2; color: #DC2626; padding: 6px 12px; border-radius: 20px; font-size: 14px;">
                                <i class="fas fa-times-circle" style="margin-right: 4px;"></i>Inactivo
                            </span>
                        @endif
                        
                        @if($product->stock_quantity <= 0)
                            <span style="background: #FEE2E2; color: #DC2626; padding: 6px 12px; border-radius: 20px; font-size: 14px;">
                                <i class="fas fa-exclamation-circle" style="margin-right: 4px;"></i>Agotado
                            </span>
                        @elseif($product->stock_quantity < 10)
                            <span style="background: #FEF3C7; color: #D97706; padding: 6px 12px; border-radius: 20px; font-size: 14px;">
                                <i class="fas fa-exclamation-triangle" style="margin-right: 4px;"></i>Pocas unidades
                            </span>
                        @endif
                    </div>

                    <!-- Basic Info -->
                    <div>
                        <div style="display: flex; gap: 16px; margin-bottom: 24px;">
                            <span style="display: inline-block; background: #F5F6F2; color: #666; padding: 6px 12px; border-radius: 12px; font-size: 14px;">
                                SKU: {{ $product->sku }}
                            </span>
                            <span style="display: inline-block; background: #F5F6F2; color: #666; padding: 6px 12px; border-radius: 12px; font-size: 14px;">
                                Stock: {{ $product->stock_quantity }} unidades
                            </span>
                        </div>

                        <!-- Pricing -->
                        <div style="margin-bottom: 24px;">
                            @if($product->sale_price)
                                <div style="font-size: 20px; color: #666; text-decoration: line-through;">
                                    ${{ number_format((float)$product->regular_price, 2) }}
                                </div>
                                <div style="font-size: 32px; font-weight: 700; color: #EE403D;">
                                    ${{ number_format((float)$product->sale_price, 2) }}
                                </div>
                                @php
                                    $discount = (($product->regular_price - $product->sale_price) / $product->regular_price) * 100;
                                @endphp
                                <div style="display: inline-block; background: #FEE2E2; color: #DC2626; padding: 4px 8px; border-radius: 20px; font-size: 14px; margin-top: 8px;">
                                    {{ round($discount) }}% OFF
                                </div>
                            @else
                                <div style="font-size: 32px; font-weight: 700; color: #EE403D;">
                                    ${{ number_format((float)$product->regular_price, 2) }}
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($product->short_description)
                        <div style="background: #F5F6F2; border-radius: 12px; padding: 16px;">
                            <p style="color: #666; line-height: 1.6; margin: 0;">{{ $product->short_description }}</p>
                        </div>
                    @endif
                
                    <!-- Actions -->
                    <div style="display: flex; gap: 12px; margin-top: 16px;">
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="width: 100%;" id="deleteForm">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete()" 
                                style="width: 100%; background: #FEE2E2; color: #DC2626; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 500; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px;">
                                <i class="fas fa-trash-alt"></i>
                                Eliminar Producto
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Section -->
        <div style="margin-top: 40px;">
            <div style="border-bottom: 2px solid #F5F6F2; margin-bottom: 24px;">
                <div style="display: flex; gap: 32px;">
                    <button onclick="switchTab('description')" id="descriptionTab" 
                        style="padding: 16px 24px; font-weight: 500; color: #EE403D; border: none; background: none; cursor: pointer; position: relative;">
                        Descripción Completa
                        <span style="position: absolute; bottom: -2px; left: 0; width: 100%; height: 2px; background: #EE403D;"></span>
                    </button>
                    <button onclick="switchTab('details')" id="detailsTab"
                        style="padding: 16px 24px; font-weight: 500; color: #666; border: none; background: none; cursor: pointer; position: relative;">
                        Detalles Adicionales
                    </button>
                </div>
            </div>

            <div id="descriptionPanel" style="display: block;">
                <div style="background: white; border-radius: 16px; padding: 32px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>

            <div id="detailsPanel" style="display: none;">
                <div style="background: white; border-radius: 16px; padding: 32px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
                        <div style="display: flex; gap: 12px; align-items: start;">
                            <i class="fas fa-hashtag" style="color: #EE403D; margin-top: 3px;"></i>
                            <div>
                                <span style="display: block; color: #666; font-size: 12px;">ID del Producto</span>
                                <span style="color: #212529; font-weight: 500;">{{ $product->id }}</span>
                            </div>
                        </div>
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
<script>
function updateMainImage(src) {
    document.getElementById('mainImage').src = src;
}

function switchTab(tabName) {
    // Update tabs
    document.getElementById('descriptionTab').style.color = tabName === 'description' ? '#EE403D' : '#666';
    document.getElementById('detailsTab').style.color = tabName === 'details' ? '#EE403D' : '#666';
    
    // Update panels
    document.getElementById('descriptionPanel').style.display = tabName === 'description' ? 'block' : 'none';
    document.getElementById('detailsPanel').style.display = tabName === 'details' ? 'block' : 'none';
    
    // Update indicators
    document.getElementById('descriptionTab').innerHTML = 'Descripción Completa' + (tabName === 'description' ? '<span style="position: absolute; bottom: -2px; left: 0; width: 100%; height: 2px; background: #EE403D;"></span>' : '');
    document.getElementById('detailsTab').innerHTML = 'Detalles Adicionales' + (tabName === 'details' ? '<span style="position: absolute; bottom: -2px; left: 0; width: 100%; height: 2px; background: #EE403D;"></span>' : '');
}

function confirmDelete() {
    if (confirm('¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>

@endsection