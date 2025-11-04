@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<!-- TOP BANNER -->
<div style="background-color: #EE403D; color: white; text-align: center; padding: 12px 0; font-size: 14px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <p style="margin: 0;">
            Panel de Administración de Productos
            <a href="{{ route('home') }}" style="color: white; text-decoration: underline; margin-left: 8px;">Volver a la Tienda</a>
        </p>
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
            @auth
                <div style="display: flex; align-items: center; gap: 16px;">
                    <span style="color: #212529; font-weight: 500;">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" style="background: #EE403D; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-weight: 500; cursor: pointer; transition: background-color 0.3s;">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</header>

<main style="background: linear-gradient(135deg, #F5F6F2 0%, #E7E8E0 100%); min-height: calc(100vh - 180px); padding: 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <!-- Page Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
            <div>
                <span style="display: inline-block; background-color: #EE403D; color: white; padding: 8px 20px; border-radius: 20px; font-size: 14px; font-weight: 600; margin-bottom: 12px;">
                    Panel de Control
                </span>
                <h1 style="font-size: 32px; font-weight: 700; color: #212529; margin: 0;">Gestión de Productos</h1>
            </div>
            <a href="{{ route('products.create') }}" style="background: #EE403D; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: background-color 0.3s; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-plus"></i>
                Nuevo Producto
            </a>
        </div>

        @if(session('success'))
            <div style="background: #DEF7EC; color: #03543F; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div style="background: #FDE8E8; color: #9B1C1C; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Products Table -->
        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr style="background: #F5F6F2;">
                            <th style="padding: 16px; text-align: left; font-weight: 600; color: #374151; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB; font-size: 14px;">ID</th>
                            <th style="padding: 16px; text-align: left; font-weight: 600; color: #374151; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB; font-size: 14px;">Imagen</th>
                            <th style="padding: 16px; text-align: left; font-weight: 600; color: #374151; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB; font-size: 14px;">Nombre</th>
                            <th style="padding: 16px; text-align: left; font-weight: 600; color: #374151; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB; font-size: 14px;">SKU</th>
                            <th style="padding: 16px; text-align: left; font-weight: 600; color: #374151; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB; font-size: 14px;">Precio</th>
                            <th style="padding: 16px; text-align: left; font-weight: 600; color: #374151; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB; font-size: 14px;">Stock</th>
                            <th style="padding: 16px; text-align: left; font-weight: 600; color: #374151; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB; font-size: 14px;">Categoría</th>
                            <th style="padding: 16px; text-align: left; font-weight: 600; color: #374151; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB; font-size: 14px;">Estado</th>
                            <th style="padding: 16px; text-align: left; font-weight: 600; color: #374151; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB; font-size: 14px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $product)
                        <tr style="border-bottom: 1px solid #E5E7EB; {{ $product->deleted_at ? 'background-color: #FEFBEA;' : '' }}">
                            <td style="padding: 16px; color: #6B7280; font-size: 14px;">
                                #{{ $product->id }}
                                @if($product->deleted_at)
                                    <span style="display: inline-block; background-color: #FEF3C7; color: #92400E; padding: 2px 6px; border-radius: 4px; font-size: 12px; margin-left: 4px;">
                                        Archivado
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 16px;">
                                @php
                                    $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                                    $images = $images ?? [];
                                    $imagePath = !empty($images) ? $images[0] : null;
                                @endphp
                                @php
                                    $storageFile = $imagePath ? public_path('storage/' . $imagePath) : null;
                                    $publicFile = $imagePath ? public_path($imagePath) : null;
                                @endphp
                                @if($imagePath && $storageFile && file_exists($storageFile))
                                    <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $product->name }}">
                                @elseif($imagePath && $publicFile && file_exists($publicFile))
                                    <img src="{{ asset($imagePath) }}" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('images/placeholder-product.svg') }}" alt="Sin imagen">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock_quantity }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>
                                <span style="display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 13px; font-weight: 500; 
                                    {{ $product->is_active ? 'background-color: #DEF7EC; color: #03543F;' : 'background-color: #FDE8E8; color: #9B1C1C;' }}">
                                    {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="actions" style="padding: 16px;">
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('products.show', $product) }}" class="btn-action view" 
                                       style="padding: 8px; border-radius: 6px; color: #1F2937; background-color: #F3F4F6; border: none; cursor: pointer;" 
                                       title="Ver detalles">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>
                                    @if(!$product->deleted_at)
                                        <a href="{{ route('products.edit', $product) }}" class="btn-action edit" 
                                           style="padding: 8px; border-radius: 6px; color: #1F2937; background-color: #F3F4F6; border: none; cursor: pointer;" 
                                           title="Editar">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="delete-form" 
                                              onsubmit="return confirm('{{ $product->orderItems()->exists() ? '¿Estás seguro de archivar este producto?' : '¿Estás seguro de eliminar este producto?' }}');" 
                                              style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action delete" 
                                                    style="padding: 8px; border-radius: 6px; color: #991B1B; background-color: #FDE8E8; border: none; cursor: pointer;" 
                                                    title="{{ $product->orderItems()->exists() ? 'Archivar' : 'Eliminar' }}">
                                                @if($product->orderItems()->exists())
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                                                    </svg>
                                                @else
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>
                                                @endif
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="padding: 32px; text-align: center;">
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 16px;">
                                    <div style="width: 64px; height: 64px; background: #F5F6F2; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-box-open" style="font-size: 24px; color: #9CA3AF;"></i>
                                    </div>
                                    <div style="color: #6B7280; font-size: 16px;">No hay productos disponibles</div>
                                    <a href="{{ route('products.create') }}" style="color: #EE403D; text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 8px;">
                                        <i class="fas fa-plus"></i>
                                        Agregar Primer Producto
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="margin-top: 24px;">
            {{ $products->links('vendor.pagination.custom') }}
        </div>
    </div>
</main>

<!-- Footer -->
<footer style="background: white; padding: 24px 0; border-top: 1px solid #E5E7EB; margin-top: auto;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; text-align: center; color: #6B7280;">
        <p style="margin: 0;">&copy; {{ date('Y') }} SEALS. Todos los derechos reservados.</p>
    </div>
</footer>

<style>
/* Estilos para los botones de acción */
.btn-action {
    transition: all 0.2s ease;
}

.btn-action:hover {
    transform: translateY(-1px);
}

/* Hover states para los botones de acción */
[style*="background: #F3F4F6"]:hover {
    background: #E5E7EB !important;
}

[style*="background: #EE403D"]:hover {
    background: #DC2626 !important;
}

[style*="background: #FEE2E2"]:hover {
    background: #FCA5A5 !important;
}

/* Transición suave para todos los elementos interactivos */
a, button {
    transition: all 0.3s ease !important;
}

/* Estilos para el hover de las filas de la tabla */
tr:hover {
    background-color: #F9FAFB;
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
        padding: 8px;
        width: 120px;
        text-align: center;
        vertical-align: middle;
        background: none; /* evitar franjas o fondos inesperados */
        position: relative;
        overflow: visible;
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
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
        background-color: #f8f9fa;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
        padding: 6px;
        transition: transform 0.18s ease, box-shadow 0.18s ease;
        display: block;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .product-image img:hover {
        transform: scale(1.06);
        box-shadow: 0 6px 14px rgba(0,0,0,0.12);
    }

    .no-image {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e2e8f0;
        border-radius: 6px;
        font-size: 12px;
        color: #64748b;
        margin: 0 auto;
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