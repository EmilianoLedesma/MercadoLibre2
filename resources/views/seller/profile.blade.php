@extends('layouts.app')

@section('title', 'Mi Tienda - Perfil del Vendedor')

@section('content')
@include('layouts.navbar')

<!-- Page Title -->
<div style="background-color: #F5F6F2; padding: 60px 0 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1 style="font-family: 'Jost', sans-serif; font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0;">
            Mi Tienda
        </h1>
        <nav style="display: flex; gap: 8px; align-items: center; font-size: 14px;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="color: #999;">›</span>
            <a href="{{ route('seller.dashboard') }}" style="color: #666; text-decoration: none;">Panel de Vendedor</a>
            <span style="color: #999;">›</span>
            <span style="color: #EE403D; font-weight: 500;">Mi Tienda</span>
        </nav>
    </div>
</div>

<!-- Profile Section -->
<section style="padding: 60px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 30px;">

            <!-- Sidebar Navigation -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <a href="{{ route('seller.dashboard') }}" class="seller-nav-btn" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s; text-decoration: none;">
                    <i class="fas fa-chart-line" style="width: 20px;"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('seller.products.index') }}" class="seller-nav-btn" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s; text-decoration: none;">
                    <i class="fas fa-box" style="width: 20px;"></i>
                    <span>Mis Productos</span>
                </a>

                <a href="{{ route('seller.profile') }}" class="seller-nav-btn active" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: #EE403D; color: white; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s; text-decoration: none;">
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

                @if(session('error'))
                    <div style="background: #FEE2E2; border: 1px solid #EF4444; color: #991B1B; padding: 16px; border-radius: 8px; margin-bottom: 24px; font-size: 14px;">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- User Profile -->
                <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px; margin-bottom: 24px;">
                    <h2 style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 700; color: #212529; margin: 0 0 24px 0;">
                        Información Personal
                    </h2>

                    <form action="{{ route('seller.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 500; color: #212529; margin-bottom: 8px;">Nombre</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-size: 14px; font-family: 'Jost', sans-serif;">
                                @error('name')
                                    <span style="color: #EF4444; font-size: 12px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 500; color: #212529; margin-bottom: 8px;">Email</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-size: 14px; font-family: 'Jost', sans-serif;">
                                @error('email')
                                    <span style="color: #EF4444; font-size: 12px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 14px; font-weight: 500; color: #212529; margin-bottom: 8px;">Teléfono</label>
                            <input type="text" name="phone" value="{{ Auth::user()->phone }}" style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-size: 14px; font-family: 'Jost', sans-serif;">
                            @error('phone')
                                <span style="color: #EF4444; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" style="background: #EE403D; color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: 500; font-size: 14px; cursor: pointer; transition: all 0.3s;">
                            Actualizar Perfil
                        </button>
                    </form>
                </div>

                <!-- Store Information -->
                <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
                    <h2 style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 700; color: #212529; margin: 0 0 24px 0;">
                        Información de la Tienda
                    </h2>

                    <form action="{{ route('seller.store.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 14px; font-weight: 500; color: #212529; margin-bottom: 8px;">Nombre de la Tienda *</label>
                            <input type="text" name="store_name" value="{{ $store->name ?? '' }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-size: 14px; font-family: 'Jost', sans-serif;">
                            @error('store_name')
                                <span style="color: #EF4444; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 14px; font-weight: 500; color: #212529; margin-bottom: 8px;">Descripción</label>
                            <textarea name="store_description" rows="4" style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-size: 14px; font-family: 'Jost', sans-serif; resize: vertical;">{{ $store->description ?? '' }}</textarea>
                            @error('store_description')
                                <span style="color: #EF4444; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 500; color: #212529; margin-bottom: 8px;">Teléfono de la Tienda</label>
                                <input type="text" name="store_phone" value="{{ $store->phone ?? '' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-size: 14px; font-family: 'Jost', sans-serif;">
                                @error('store_phone')
                                    <span style="color: #EF4444; font-size: 12px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 500; color: #212529; margin-bottom: 8px;">Email de la Tienda</label>
                                <input type="email" name="store_email" value="{{ $store->email ?? '' }}" style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-size: 14px; font-family: 'Jost', sans-serif;">
                                @error('store_email')
                                    <span style="color: #EF4444; font-size: 12px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 14px; font-weight: 500; color: #212529; margin-bottom: 8px;">Dirección</label>
                            <textarea name="store_address" rows="2" style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-size: 14px; font-family: 'Jost', sans-serif; resize: vertical;">{{ $store->address ?? '' }}</textarea>
                            @error('store_address')
                                <span style="color: #EF4444; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" style="background: #EE403D; color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: 500; font-size: 14px; cursor: pointer; transition: all 0.3s;">
                            Actualizar Tienda
                        </button>
                    </form>
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

button[type="submit"]:hover {
    background: #D63531;
}
</style>
