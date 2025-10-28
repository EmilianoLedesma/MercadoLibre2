@extends('layouts.app')

@section('title', 'Productos')

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

<main class="products-page">
    <div class="container">
        <div class="page-header">
            <h1>Gestión de Productos</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Nuevo Producto</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="products-table-container">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>SKU</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td class="product-image">
                                @php
                                    $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                                    $images = $images ?? [];
                                    $imagePath = !empty($images) ? $images[0] : null;
                                @endphp
                                @if($imagePath)
                                    <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $product->name }}">
                                @else
                                    <div class="no-image">Sin imagen</div>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock_quantity }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>
                                <span class="status {{ $product->is_active ? 'active' : 'inactive' }}">
                                    {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="actions">
                                <a href="{{ route('products.show', $product) }}" class="btn-action view" title="Ver detalles">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a href="{{ route('products.edit', $product) }}" class="btn-action edit" title="Editar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="delete-form" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action delete" title="Eliminar">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="no-data">No hay productos disponibles</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-container">
            {{ $products->links('vendor.pagination.custom') }}
        </div>
    </div>
</main>

<footer class="footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} SEALS. Todos los derechos reservados.</p>
    </div>
</footer>

<style>
    /* Estilos específicos para la página de productos */
    .products-page {
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

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .products-table-container {
        overflow-x: auto;
    }

    .products-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .products-table th,
    .products-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .products-table td.product-image {
        padding: 12px;
        width: 120px;
        text-align: center;
        vertical-align: middle;
    }
    
    .product-image img:hover {
        transform: scale(1.1);
    }
    
    .no-image {
        width: 100px;
        height: 100px;
        border-radius: 6px;
        background-color: #f1f1f1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 12px;
        margin: 0 auto;
    }

    .products-table th {
        background-color: #f8fafc;
        font-weight: 600;
    }

    .products-table tbody tr:hover {
        background-color: #f1f5f9;
    }

    .product-image img {
        width: 100px;
        height: 100px;
        object-fit: contain;
        border-radius: 6px;
        background-color: #f8f9fa;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        padding: 8px;
        transition: transform 0.2s ease;
        transition: transform 0.3s ease;
    }
    
    .product-image img:hover {
        transform: scale(1.5);
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        z-index: 10;
        position: relative;
    }

    .no-image {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e2e8f0;
        border-radius: 4px;
        font-size: 12px;
        color: #64748b;
    }

    .status {
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

    .actions {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #64748b;
        background-color: transparent;
        border: none;
    }

    .btn-action.view:hover {
        color: #3b82f6;
        background-color: #eff6ff;
    }

    .btn-action.edit:hover {
        color: #10b981;
        background-color: #ecfdf5;
    }

    .btn-action.delete:hover {
        color: #ef4444;
        background-color: #fef2f2;
    }

    .delete-form {
        margin: 0;
        padding: 0;
    }

    .no-data {
        text-align: center;
        color: #64748b;
        padding: 20px 0;
    }

    .pagination-container {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }

    /* Estilos para los enlaces de paginación */
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        gap: 5px;
    }

    .pagination li {
        display: inline-block;
    }

    .pagination li a,
    .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 6px;
        text-decoration: none;
        color: #64748b;
        background-color: #f8fafc;
        transition: all 0.2s ease;
        font-weight: 500;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        margin: 0 2px;
    }

    .pagination li.active span {
        background-color: #667eea;
        color: white;
        box-shadow: 0 2px 4px rgba(102, 126, 234, 0.3);
    }

    .pagination li a:hover {
        background-color: #e2e8f0;
        transform: translateY(-2px);
    }
    
    /* Estilos para las flechas de paginación */
    .pagination svg {
        width: 20px;
        height: 20px;
        stroke-width: 2px;
    }
    
    .pagination li:first-child a,
    .pagination li:last-child a {
        background-color: #667eea;
        color: white;
    }
    
    .pagination li:first-child a:hover,
    .pagination li:last-child a:hover {
        background-color: #5a6acf;
    }
    
    /* Estilos para elementos deshabilitados */
    .pagination li.disabled span {
        background-color: #f1f5f9;
        color: #cbd5e1;
        box-shadow: none;
        cursor: not-allowed;
    }
    
    /* Mejorar la apariencia general de la tabla */
    .products-table {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }
    
    .products-table th {
        background-color: #f1f5f9;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 12px;
    }
</style>
@endsection