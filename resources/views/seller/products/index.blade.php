@extends('layouts.app')

@section('title', 'Mis Productos')

@section('content')
@include('layouts.navbar')

<!-- Page Title -->
<div style="background-color: #F5F6F2; padding: 60px 0 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1 style="font-family: 'Jost', sans-serif; font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0;">
            Mis Productos
        </h1>
        <nav style="display: flex; gap: 8px; align-items: center; font-size: 14px;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="color: #999;">›</span>
            <a href="{{ route('seller.dashboard') }}" style="color: #666; text-decoration: none;">Panel de Vendedor</a>
            <span style="color: #999;">›</span>
            <span style="color: #EE403D; font-weight: 500;">Mis Productos</span>
        </nav>
    </div>
</div>

<!-- Products Section -->
<section style="padding: 60px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 30px;">

            <!-- Sidebar Navigation -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <a href="{{ route('seller.dashboard') }}" class="seller-nav-btn" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s; text-decoration: none;">
                    <i class="fas fa-chart-line" style="width: 20px;"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('seller.products.index') }}" class="seller-nav-btn active" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: #EE403D; color: white; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s; text-decoration: none;">
                    <i class="fas fa-box" style="width: 20px;"></i>
                    <span>Mis Productos</span>
                </a>

                <a href="{{ route('seller.profile') }}" class="seller-nav-btn" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s; text-decoration: none;">
                    <i class="fas fa-store" style="width: 20px;"></i>
                    <span>Mi Tienda</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="width: 100%; display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s;">
                        <i class="fas fa-sign-out-alt" style="width: 20px;"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>

            <!-- Main Content -->
            <div>
                @if(session('success'))
                    <div style="background: #D1FAE5; border: 1px solid #10B981; color: #065F46; padding: 16px; border-radius: 8px; margin-bottom: 24px; font-size: 14px;">
                        {{ session('success') }}
                    </div>
                @endif

                <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                        <h2 style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 700; color: #212529; margin: 0;">
                            Listado de Productos
                        </h2>
                        <a href="{{ route('seller.products.create') }}" style="background: #EE403D; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; transition: all 0.3s;">
                            <i class="fas fa-plus" style="margin-right: 8px;"></i>Nuevo Producto
                        </a>
                    </div>

                    @if($products->count() > 0)
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="border-bottom: 2px solid #E5E5E5;">
                                        <th style="text-align: left; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Producto</th>
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
                                                <div style="font-weight: 500; color: #212529; margin-bottom: 4px;">{{ $product->name }}</div>
                                                <div style="font-size: 12px; color: #999;">SKU: {{ $product->sku }}</div>
                                            </td>
                                            <td style="padding: 16px; color: #666;">{{ $product->category->name ?? 'N/A' }}</td>
                                            <td style="padding: 16px;">
                                                <div style="color: #212529; font-weight: 600;">${{ number_format($product->price, 2) }}</div>
                                                @if($product->sale_price)
                                                    <div style="font-size: 12px; color: #10B981;">Oferta: ${{ number_format($product->sale_price, 2) }}</div>
                                                @endif
                                            </td>
                                            <td style="padding: 16px; color: #666;">{{ $product->stock_quantity }}</td>
                                            <td style="padding: 16px;">
                                                @if($product->is_active)
                                                    <span style="background: #D1FAE5; color: #065F46; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500;">Activo</span>
                                                @else
                                                    <span style="background: #FEE2E2; color: #991B1B; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500;">Inactivo</span>
                                                @endif
                                            </td>
                                            <td style="padding: 16px; text-align: center;">
                                                <div style="display: flex; gap: 12px; justify-content: center;">
                                                    <a href="{{ route('seller.products.edit', $product->id) }}" style="color: #3B82F6; text-decoration: none; font-size: 18px;" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
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
                            <p style="color: #666; font-size: 16px; margin-bottom: 24px;">No tienes productos aún. ¡Comienza a vender ahora!</p>
                            <a href="{{ route('seller.products.create') }}" style="background: #EE403D; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; display: inline-block;">
                                <i class="fas fa-plus" style="margin-right: 8px;"></i>Crear mi primer producto
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

<style>
.seller-nav-btn:hover {
    background: #F5F5F5 !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.seller-nav-btn.active {
    background: #EE403D !important;
    color: white !important;
}

a[href*="seller.products.create"]:hover {
    background: #D63531;
}
</style>
