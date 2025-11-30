@extends('layouts.app')

@section('title', 'Administración de Productos')

@section('content')
@include('layouts.navbar')

<!-- Page Title -->
<div style="background-color: #F5F6F2; padding: 60px 0 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1 style="font-family: 'Jost', sans-serif; font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0;">
            Administración de Productos
        </h1>
        <nav style="display: flex; gap: 8px; align-items: center; font-size: 14px;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="color: #999;">›</span>
            <span style="color: #EE403D; font-weight: 500;">Admin Productos</span>
        </nav>
    </div>
</div>

<!-- Products Section -->
<section style="padding: 60px 20px; background: white;">
    <div style="max-width: 1400px; margin: 0 auto;">
        @if(session('success'))
            <div style="background: #D1FAE5; border: 1px solid #10B981; color: #065F46; padding: 16px; border-radius: 8px; margin-bottom: 24px; font-size: 14px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: #FEE2E2; border: 1px solid #EF4444; color: #991B1B; padding: 16px; border-radius: 8px; margin-bottom: 24px; font-size: 14px;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filtros y Búsqueda -->
        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
            <form method="GET" action="{{ route('admin.products.index') }}" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr auto; gap: 12px; align-items: end;">
                <div>
                    <label style="display: block; margin-bottom: 6px; font-size: 13px; color: #666; font-weight: 500;">Buscar</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nombre, SKU o descripción..." 
                        style="width: 100%; padding: 10px 14px; border: 1px solid #E5E5E5; border-radius: 6px; font-size: 14px;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 6px; font-size: 13px; color: #666; font-weight: 500;">Categoría</label>
                    <select name="category" style="width: 100%; padding: 10px 14px; border: 1px solid #E5E5E5; border-radius: 6px; font-size: 14px; background: white;">
                        <option value="">Todas</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 6px; font-size: 13px; color: #666; font-weight: 500;">Vendedor</label>
                    <select name="seller" style="width: 100%; padding: 10px 14px; border: 1px solid #E5E5E5; border-radius: 6px; font-size: 14px; background: white;">
                        <option value="">Todos</option>
                        @foreach($sellers as $seller)
                            <option value="{{ $seller->id }}" {{ request('seller') == $seller->id ? 'selected' : '' }}>
                                {{ $seller->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 6px; font-size: 13px; color: #666; font-weight: 500;">Estado</label>
                    <select name="status" style="width: 100%; padding: 10px 14px; border: 1px solid #E5E5E5; border-radius: 6px; font-size: 14px; background: white;">
                        <option value="">Todos</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Activos</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactivos</option>
                    </select>
                </div>

                <button type="submit" style="padding: 10px 24px; background: #EE403D; color: white; border: none; border-radius: 6px; font-weight: 500; cursor: pointer; font-size: 14px;">
                    <i class="fas fa-search" style="margin-right: 6px;"></i>Buscar
                </button>
            </form>
        </div>

        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <div>
                    <h2 style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 700; color: #212529; margin: 0;">
                        Todos los Productos
                    </h2>
                    <p style="margin: 8px 0 0 0; color: #666; font-size: 14px;">
                        Total: {{ $products->total() }} productos
                    </p>
                </div>
            </div>

            @if($products->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 2px solid #E5E5E5;">
                                <th style="text-align: left; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Producto</th>
                                <th style="text-align: left; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Vendedor</th>
                                <th style="text-align: left; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Categoría</th>
                                <th style="text-align: left; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Precio</th>
                                <th style="text-align: left; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Stock</th>
                                <th style="text-align: left; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Estado</th>
                                <th style="text-align: center; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr style="border-bottom: 1px solid #F5F5F5;">
                                    <td style="padding: 16px;">
                                        <div style="display: flex; gap: 12px; align-items: center;">
                                            @php
                                                $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
                                                $firstImage = !empty($images) ? $images[0] : null;
                                                $imageUrl = $firstImage ? (filter_var($firstImage, FILTER_VALIDATE_URL) ? $firstImage : asset('storage/' . $firstImage)) : null;
                                            @endphp
                                            @if($imageUrl)
                                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" 
                                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid #E5E5E5;">
                                            @else
                                                <div style="width: 50px; height: 50px; background: #F5F5F5; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-image" style="color: #999;"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div style="font-weight: 500; color: #212529; margin-bottom: 4px;">{{ $product->name }}</div>
                                                <div style="font-size: 12px; color: #999;">SKU: {{ $product->sku }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding: 16px;">
                                        <div style="font-weight: 500; color: #212529;">{{ $product->user->name ?? 'N/A' }}</div>
                                        <div style="font-size: 12px; color: #999;">{{ $product->user->email ?? '' }}</div>
                                    </td>
                                    <td style="padding: 16px; color: #666;">{{ $product->category->name ?? 'N/A' }}</td>
                                    <td style="padding: 16px;">
                                        <div style="color: #212529; font-weight: 600;">${{ number_format($product->price, 2) }}</div>
                                        @if($product->sale_price)
                                            <div style="font-size: 12px; color: #10B981;">Oferta: ${{ number_format($product->sale_price, 2) }}</div>
                                        @endif
                                    </td>
                                    <td style="padding: 16px;">
                                        <span style="color: {{ $product->stock_quantity > 10 ? '#10B981' : ($product->stock_quantity > 0 ? '#F59E0B' : '#EF4444') }}; font-weight: 500;">
                                            {{ $product->stock_quantity }}
                                        </span>
                                    </td>
                                    <td style="padding: 16px;">
                                        <div style="display: flex; flex-direction: column; gap: 6px;">
                                            @if($product->is_active)
                                                <span style="background: #D1FAE5; color: #065F46; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500; text-align: center;">Activo</span>
                                            @else
                                                <span style="background: #FEE2E2; color: #991B1B; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500; text-align: center;">Inactivo</span>
                                            @endif
                                            @if($product->is_featured)
                                                <span style="background: #FEF3C7; color: #92400E; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500; text-align: center;">
                                                    <i class="fas fa-star" style="font-size: 10px;"></i> Destacado
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td style="padding: 16px; text-align: center;">
                                        <div style="display: flex; gap: 12px; justify-content: center;">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" style="color: #3B82F6; text-decoration: none; font-size: 18px;" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('¿Estás seguro de eliminar este producto? Esta acción no se puede deshacer.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: none; border: none; color: #EF4444; cursor: pointer; font-size: 18px;" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div style="margin-top: 24px;">
                    {{ $products->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 48px 20px;">
                    <i class="fas fa-box-open" style="font-size: 64px; color: #E5E5E5; margin-bottom: 16px;"></i>
                    <p style="color: #666; font-size: 16px; margin: 0;">No se encontraron productos con los filtros aplicados.</p>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection

<style>
table tr:hover {
    background-color: #F9FAFB;
}

a[href*="edit"]:hover,
button[type="submit"]:hover {
    transform: scale(1.1);
    transition: transform 0.2s;
}

input:focus, select:focus {
    outline: none;
    border-color: #EE403D !important;
    box-shadow: 0 0 0 3px rgba(238, 64, 61, 0.1);
}

button[type="submit"]:hover {
    background: #D63531 !important;
}
</style>
