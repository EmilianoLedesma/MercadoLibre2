@extends('layouts.app')

@section('title', 'Panel de Vendedor')

@section('content')
@include('layouts.navbar')

<!-- Page Title -->
<div style="background-color: #F5F6F2; padding: 60px 0 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1 style="font-family: 'Jost', sans-serif; font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0;">
            Panel de Vendedor
        </h1>
        <nav style="display: flex; gap: 8px; align-items: center; font-size: 14px;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="color: #999;">›</span>
            <span style="color: #EE403D; font-weight: 500;">Panel de Vendedor</span>
        </nav>
    </div>
</div>

<!-- Seller Dashboard -->
<section style="padding: 60px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 30px;">

            <!-- Sidebar Navigation -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <a href="{{ route('seller.dashboard') }}" class="seller-nav-btn active" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: #EE403D; color: white; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s; text-decoration: none;">
                    <i class="fas fa-chart-line" style="width: 20px;"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('seller.products.index') }}" class="seller-nav-btn" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s; text-decoration: none;">
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

            <!-- Main Content Area -->
            <div>
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

                <!-- Store Profile Header -->
                <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px; margin-bottom: 24px;">
                    <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px;">
                        <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #EE403D 0%, #E32020 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 32px; font-weight: 700; flex-shrink: 0;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-size: 14px; color: #999; margin-bottom: 4px;">Vendedor</div>
                            <div style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 600; color: #212529;">
                                @if($store)
                                    {{ $store->name }}
                                @else
                                    {{ Auth::user()->name }}
                                @endif
                            </div>
                            <div style="font-size: 14px; color: #999; margin-top: 4px;">{{ now()->format('F d, Y') }}</div>
                        </div>
                    </div>
                    <p style="color: #666; line-height: 1.6; margin: 0; font-size: 15px;">
                        Bienvenido a tu panel de vendedor. Aquí puedes gestionar tus productos, ver estadísticas de ventas y administrar tu tienda.
                    </p>
                </div>

                <!-- Stats Grid -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 32px;">
                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onclick="window.location.href='{{ route('seller.products.index') }}'" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                        <div style="width: 50px; height: 50px; background: #FEF3F2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                            <i class="fas fa-box" style="color: #EE403D; font-size: 24px;"></i>
                        </div>
                        <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Total Productos</div>
                        <div style="font-size: 28px; font-weight: 700; color: #212529;">{{ $totalProducts }}</div>
                    </div>

                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                        <div style="width: 50px; height: 50px; background: #F0FDF4; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                            <i class="fas fa-check-circle" style="color: #10B981; font-size: 24px;"></i>
                        </div>
                        <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Productos Activos</div>
                        <div style="font-size: 28px; font-weight: 700; color: #212529;">{{ $activeProducts }}</div>
                    </div>

                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                        <div style="width: 50px; height: 50px; background: #F0F9FF; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                            <i class="fas fa-dollar-sign" style="color: #3B82F6; font-size: 24px;"></i>
                        </div>
                        <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Ventas Totales</div>
                        <div style="font-size: 28px; font-weight: 700; color: #212529;">${{ number_format($totalSales, 2) }}</div>
                    </div>
                </div>

                <!-- Recent Products -->
                <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                        <h2 style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 700; color: #212529; margin: 0;">
                            Productos Recientes
                        </h2>
                        <a href="{{ route('seller.products.create') }}" style="background: #EE403D; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; transition: all 0.3s;">
                            <i class="fas fa-plus" style="margin-right: 8px;"></i>Nuevo Producto
                        </a>
                    </div>

                    @if($products->count() > 0)
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="border-bottom: 1px solid #E5E5E5;">
                                        <th style="text-align: left; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Producto</th>
                                        <th style="text-align: left; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Categoría</th>
                                        <th style="text-align: left; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Precio</th>
                                        <th style="text-align: left; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Stock</th>
                                        <th style="text-align: left; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Estado</th>
                                        <th style="text-align: left; padding: 12px; font-size: 14px; color: #666; font-weight: 600;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products->take(5) as $product)
                                        <tr style="border-bottom: 1px solid #F5F5F5;">
                                            <td style="padding: 16px;">
                                                <div style="font-weight: 500; color: #212529;">{{ $product->name }}</div>
                                                <div style="font-size: 12px; color: #999;">SKU: {{ $product->sku }}</div>
                                            </td>
                                            <td style="padding: 16px; color: #666;">{{ $product->category->name ?? 'N/A' }}</td>
                                            <td style="padding: 16px; color: #212529; font-weight: 600;">${{ number_format($product->price, 2) }}</td>
                                            <td style="padding: 16px; color: #666;">{{ $product->stock_quantity }}</td>
                                            <td style="padding: 16px;">
                                                @if($product->is_active)
                                                    <span style="background: #D1FAE5; color: #065F46; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500;">Activo</span>
                                                @else
                                                    <span style="background: #FEE2E2; color: #991B1B; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500;">Inactivo</span>
                                                @endif
                                            </td>
                                            <td style="padding: 16px;">
                                                <a href="{{ route('seller.products.edit', $product->id) }}" style="color: #EE403D; text-decoration: none; margin-right: 12px;">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        @if($products->count() > 5)
                            <div style="text-align: center; margin-top: 24px;">
                                <a href="{{ route('seller.products.index') }}" style="color: #EE403D; text-decoration: none; font-weight: 500;">
                                    Ver todos los productos →
                                </a>
                            </div>
                        @endif
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

@include('layouts.footer')
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
</style>
