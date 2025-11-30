@extends('layouts.app')

@section('title', 'Mi Cuenta')

@section('content')
@include('layouts.navbar')

<!-- Page Title -->
<div style="background-color: #F5F6F2; padding: 60px 0 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1 style="font-family: 'Jost', sans-serif; font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0;">
            Mi Cuenta
        </h1>
        <nav style="display: flex; gap: 8px; align-items: center; font-size: 14px;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="color: #999;">›</span>
            <span style="color: #EE403D; font-weight: 500;">Mi Cuenta</span>
        </nav>
    </div>
</div>

<!-- Account Dashboard -->
<section style="padding: 60px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 30px;">

            <!-- Sidebar Navigation -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <button class="account-nav-btn active" data-section="dashboard" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: #EE403D; color: white; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s;">
                    <i class="fas fa-chart-line" style="width: 20px;"></i>
                    <span>Dashboard</span>
                </button>

                <button class="account-nav-btn" data-section="orders" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s;">
                    <i class="fas fa-shopping-cart" style="width: 20px;"></i>
                    <span>Compras</span>
                </button>

                <button class="account-nav-btn" data-section="address" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s;">
                    <i class="fas fa-map-marker-alt" style="width: 20px;"></i>
                    <span>Direcciones</span>
                </button>

                <button class="account-nav-btn" data-section="details" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s;">
                    <i class="fas fa-user" style="width: 20px;"></i>
                    <span>Detalles de la Cuenta</span>
                </button>

                <a href="{{ route('wishlist.index') }}" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s; text-decoration: none;">
                    <i class="fas fa-heart" style="width: 20px;"></i>
                    <span>Wishlist</span>
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
                @auth
                <!-- Dashboard Section -->
                <div id="section-dashboard" class="account-section">
                    <!-- User Profile Header -->
                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px; margin-bottom: 24px;">
                        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px;">
                            <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #EE403D 0%, #E32020 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 32px; font-weight: 700; flex-shrink: 0;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-size: 14px; color: #999; margin-bottom: 4px;">Hola,</div>
                                <div style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 600; color: #212529;">{{ Auth::user()->name }}</div>
                                <div style="font-size: 14px; color: #999; margin-top: 4px;">{{ now()->format('F d, Y') }}</div>
                            </div>
                        </div>
                        <p style="color: #666; line-height: 1.6; margin: 0; font-size: 15px;">
                            Desde el dashboard de tu cuenta puedes ver tus compras recientes, manejar tus dirección de envío y facturación, y editar tu contraseña y detalles de la cuenta.
                        </p>
                    </div>

                    <!-- Stats Grid -->
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onclick="showSection('orders')" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                            <div style="width: 50px; height: 50px; background: #FEF3F2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <i class="fas fa-shopping-cart" style="color: #EE403D; font-size: 24px;"></i>
                            </div>
                            <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Compras</div>
                            <div style="font-size: 28px; font-weight: 700; color: #212529;">{{ isset($orders) ? $orders->count() : 0 }}</div>
                        </div>

                        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                            <div style="width: 50px; height: 50px; background: #F0F9FF; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <i class="fas fa-download" style="color: #3B82F6; font-size: 24px;"></i>
                            </div>
                            <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Facturación</div>
                            <div style="font-size: 28px; font-weight: 700; color: #212529;">0</div>
                        </div>

                        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onclick="showSection('address')" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                            <div style="width: 50px; height: 50px; background: #F0FDF4; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <i class="fas fa-map-marker-alt" style="color: #10B981; font-size: 24px;"></i>
                            </div>
                            <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Direcciones  </div>
                            <div style="font-size: 14px; font-weight: 500; color: #212529; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                                @if(isset($addresses) && count($addresses) > 0)
                                    {{ $addresses[0]['street'] ?? 'Agregar Dirección' }}
                                @else
                                    Agregar Dirección
                                @endif
                            </div>
                        </div>

                        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onclick="showSection('details')" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                            <div style="width: 50px; height: 50px; background: #FEF3F2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <i class="fas fa-user" style="color: #EE403D; font-size: 24px;"></i>
                            </div>
                            <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Detalles de la Cuenta</div>
                            <div style="font-size: 14px; font-weight: 500; color: #212529;">{{ Auth::user()->email }}</div>
                        </div>

                        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onclick="window.location.href='{{ route('wishlist.index') }}'" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                            <div style="width: 50px; height: 50px; background: #FFF1F2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <i class="fas fa-heart" style="color: #F43F5E; font-size: 24px;"></i>
                            </div>
                            <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Wishlist</div>
                            <div style="font-size: 28px; font-weight: 700; color: #212529;">{{ count(session()->get('wishlist', [])) }}</div>
                        </div>

                        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onclick="document.querySelector('form[action=\\'{{ route('logout') }}\\']').submit()" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                            <div style="width: 50px; height: 50px; background: #F5F5F5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <i class="fas fa-sign-out-alt" style="color: #666; font-size: 24px;"></i>
                            </div>
                            <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Logout</div>
                            <div style="font-size: 14px; font-weight: 500; color: #212529;">Sign Out</div>
                        </div>
                    </div>
                </div>

                <!-- Orders Section -->
                <div id="section-orders" class="account-section" style="display: none;">
                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
                        <h2 style="font-family: 'Jost', sans-serif; font-size: 28px; font-weight: 700; color: #212529; margin: 0 0 24px 0;">
                            Mis compras
                        </h2>

                        @if(isset($orders) && $orders->count() > 0)
                            @foreach($orders as $order)
                            <div style="border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; margin-bottom: 20px;">
                                <!-- Order Header -->
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #F5F5F5;">
                                    <div>
                                        <div style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 700; color: #212529; margin-bottom: 4px;">
                                            Pedido #{{ $order->order_number }}
                                        </div>
                                        <div style="font-size: 13px; color: #666;">
                                            {{ $order->created_at->format('d M, Y') }}
                                        </div>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="margin-bottom: 8px;">
                                            @if($order->status === 'pending')
                                                <span style="display: inline-block; padding: 6px 12px; background: #FEF3C7; color: #D97706; border-radius: 6px; font-size: 13px; font-weight: 500;">Pendiente</span>
                                            @elseif($order->status === 'processing')
                                                <span style="display: inline-block; padding: 6px 12px; background: #DBEAFE; color: #2563EB; border-radius: 6px; font-size: 13px; font-weight: 500;">Procesando</span>
                                            @elseif($order->status === 'completed')
                                                <span style="display: inline-block; padding: 6px 12px; background: #D1FAE5; color: #059669; border-radius: 6px; font-size: 13px; font-weight: 500;">Completado</span>
                                            @elseif($order->status === 'cancelled')
                                                <span style="display: inline-block; padding: 6px 12px; background: #FEE2E2; color: #DC2626; border-radius: 6px; font-size: 13px; font-weight: 500;">Cancelado</span>
                                            @else
                                                <span style="display: inline-block; padding: 6px 12px; background: #F3F4F6; color: #6B7280; border-radius: 6px; font-size: 13px; font-weight: 500;">{{ ucfirst($order->status) }}</span>
                                            @endif
                                        </div>
                                        <div style="font-size: 16px; font-weight: 700; color: #212529;">
                                            ${{ number_format($order->total, 2) }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Items -->
                                <div style="display: grid; gap: 12px; margin-bottom: 16px;">
                                    @foreach($order->items as $item)
                                        @if($item->product)
                                        <div style="display: grid; grid-template-columns: 90px 1fr auto; gap: 16px; padding: 16px; border-radius: 8px; background: #F8F9FA;">
                                            <!-- Product Image -->
                                            <div style="width: 90px; height: 90px; border-radius: 8px; overflow: hidden; background: white; flex-shrink: 0;">
                                                <img src="{{ getProductImage($item->product->images, 'https://via.placeholder.com/90x90') }}" alt="{{ $item->product->name }}" style="width: 100%; height: 100%; object-fit: contain; padding: 8px;">
                                            </div>
                                            
                                            <!-- Product Info -->
                                            <div>
                                                <a href="{{ route('shop.show', $item->product->slug) }}" style="font-weight: 600; color: #212529; text-decoration: none; display: block; margin-bottom: 4px; font-size: 15px;">
                                                    {{ $item->product->name }}
                                                </a>
                                                <div style="font-size: 13px; color: #999; margin-bottom: 4px;">
                                                    Cantidad: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}
                                                </div>
                                                @php
                                                    $existingReview = $item->product->reviews()->where('user_id', Auth::id())->first();
                                                @endphp
                                                @if($existingReview)
                                                    <div style="display: flex; align-items: center; gap: 8px; margin-top: 8px;">
                                                        <div style="display: flex; gap: 2px;">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <span style="color: {{ $i <= $existingReview->rating ? '#F59E0B' : '#E5E5E5' }}; font-size: 14px;">★</span>
                                                            @endfor
                                                        </div>
                                                        <span style="font-size: 12px; color: #666;">Tu reseña</span>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            <!-- Review Button -->
                                            <div style="display: flex; align-items: center;">
                                                @php
                                                    $existingReview = $item->product->reviews()->where('user_id', Auth::id())->first();
                                                @endphp
                                                @if(!$existingReview)
                                                    <button onclick="openReviewModal({{ $item->product->id }}, '{{ addslashes($item->product->name) }}', {{ $order->id }})" style="background: #10B981; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: 500; font-size: 13px; white-space: nowrap; transition: background 0.3s;" onmouseover="this.style.background='#059669'" onmouseout="this.style.background='#10B981'">
                                                        Dejar Reseña
                                                    </button>
                                                @else
                                                    <button onclick="editReviewModal({{ $item->product->id }}, '{{ addslashes($item->product->name) }}', {{ $existingReview->id }}, {{ $existingReview->rating }}, '{{ addslashes($existingReview->comment ?? '') }}')" style="background: #3B82F6; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: 500; font-size: 13px; white-space: nowrap;">
                                                        Editar Reseña
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>

                                <!-- View Details Button -->
                                <div style="text-align: right;">
                                    <a href="{{ route('checkout.confirmation', $order->id) }}" style="display: inline-block; padding: 10px 20px; background: #EE403D; color: white; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 500; transition: background 0.3s;" onmouseover="this.style.background='#E32020'" onmouseout="this.style.background='#EE403D'">
                                        Ver Detalles del Pedido
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div style="text-align: center; padding: 48px 16px; color: #999; font-size: 15px;">
                                Sin compras. <a href="{{ route('shop.index') }}" style="color: #EE403D; text-decoration: none; font-weight: 500;">Empieza a comprar</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Address Section -->
                <div id="section-address" class="account-section" style="display: none;">
                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                            <h2 style="font-family: 'Jost', sans-serif; font-size: 28px; font-weight: 700; color: #212529; margin: 0;">
                                Direcciones
                            </h2>
                            <button id="add-address" type="button" style="background: #10B981; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 14px; transition: background 0.3s;">
                                <i class="fas fa-plus" style="margin-right: 8px;"></i>Agregar Dirección
                            </button>
                        </div>

                        <form method="POST" action="{{ route('account.addresses.save') }}" id="addresses-form">
                            @csrf
                            <div id="addresses-list" style="display: grid; gap: 20px;">
                                @if(isset($addresses) && count($addresses))
                                    @foreach($addresses as $idx => $addr)
                                    <div class="address-item" style="border: 1px solid #E5E5E5; padding: 24px; border-radius: 12px; position: relative; background: #FAFAFA;">
                                        <input type="hidden" name="addresses[{{ $idx }}][id]" value="{{ $addr['id'] ?? '' }}">
                                        <button type="button" class="remove-address" style="position: absolute; right: 16px; top: 16px; background: #FEF2F2; border: none; color: #EF4444; cursor: pointer; padding: 8px 12px; border-radius: 6px; font-size: 13px; font-weight: 500; transition: all 0.3s;">
                                            <i class="fas fa-trash" style="margin-right: 6px;"></i>Eliminar
                                        </button>

                                        <div style="display: grid; grid-template-columns: 1fr 150px; gap: 16px; margin-bottom: 16px;">
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Calle</label>
                                                <input name="addresses[{{ $idx }}][street]" value="{{ old('addresses.'.$idx.'.street', $addr['street'] ?? '') }}" placeholder="Nombre de la calle" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Número</label>
                                                <input name="addresses[{{ $idx }}][number]" value="{{ old('addresses.'.$idx.'.number', $addr['number'] ?? '') }}" placeholder="Número" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                        </div>

                                        <div style="display: grid; grid-template-columns: 180px 1fr; gap: 16px;">
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Código Postal</label>
                                                <input name="addresses[{{ $idx }}][postal_code]" value="{{ old('addresses.'.$idx.'.postal_code', $addr['postal_code'] ?? '') }}" placeholder="Código postal" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Información Adicional</label>
                                                <input name="addresses[{{ $idx }}][note]" value="{{ old('addresses.'.$idx.'.note', $addr['note'] ?? '') }}" placeholder="Ciudad / Estado o referencia" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="address-item" style="border: 1px solid #E5E5E5; padding: 24px; border-radius: 12px; position: relative; background: #FAFAFA;">
                                        <button type="button" class="remove-address" style="position: absolute; right: 16px; top: 16px; background: #FEF2F2; border: none; color: #EF4444; cursor: pointer; padding: 8px 12px; border-radius: 6px; font-size: 13px; font-weight: 500; transition: all 0.3s;">
                                            <i class="fas fa-trash" style="margin-right: 6px;"></i>Eliminar
                                        </button>

                                        <div style="display: grid; grid-template-columns: 1fr 150px; gap: 16px; margin-bottom: 16px;">
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Calle</label>
                                                <input name="addresses[0][street]" placeholder="Nombre de la calle" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Número</label>
                                                <input name="addresses[0][number]" placeholder="Número" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                        </div>

                                        <div style="display: grid; grid-template-columns: 180px 1fr; gap: 16px;">
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Código Postal</label>
                                                <input name="addresses[0][postal_code]" placeholder="Código postal" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Información Adicional</label>
                                                <input name="addresses[0][note]" placeholder="Ciudad / Estado o referencia" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div style="display: flex; gap: 12px; margin-top: 24px;">
                                <button type="submit" style="background: #EE403D; color: white; border: none; padding: 14px 32px; border-radius: 8px; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 15px; cursor: pointer; transition: background 0.3s;">
                                    Save All Direcciones
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Detalles de la Cuenta Section -->
                <div id="section-details" class="account-section" style="display: none;">
                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
                        <h2 style="font-family: 'Jost', sans-serif; font-size: 28px; font-weight: 700; color: #212529; margin: 0 0 24px 0;">
                            Detalles de la Cuenta
                        </h2>

                        <!-- Personal Info (Read-only) -->
                        <div style="margin-bottom: 32px; padding: 24px; background: #FAFAFA; border-radius: 8px;">
                            <h3 style="font-family: 'Jost', sans-serif; font-size: 18px; font-weight: 600; color: #212529; margin: 0 0 20px 0;">
                                Información Personal
                            </h3>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div>
                                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #666; font-size: 13px;">Nombre Completo</label>
                                    <div style="padding: 12px 16px; background: white; border-radius: 6px; border: 1px solid #E5E5E5; color: #212529;">
                                        {{ Auth::user()->name }}
                                    </div>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #666; font-size: 13px;">Correo Electrónico</label>
                                    <div style="padding: 12px 16px; background: white; border-radius: 6px; border: 1px solid #E5E5E5; color: #212529;">
                                        {{ Auth::user()->email }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actualizar Teléfono -->
                        <form method="POST" action="{{ route('account.update') }}" style="margin-bottom: 32px;">
                            @csrf
                            @method('PUT')

                            <h3 style="font-family: 'Jost', sans-serif; font-size: 18px; font-weight: 600; color: #212529; margin: 0 0 20px 0;">
                                Actualizar Número de Teléfono
                            </h3>

                            <div style="margin-bottom: 20px;">
                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Número de Teléfono</label>
                                <input type="tel" name="phone" value="{{ old('phone', optional(Auth::user())->phone) }}" placeholder="Tu número de teléfono" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                @error('phone')
                                <div style="color: #EF4444; font-size: 13px; margin-top: 6px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" style="background: #EE403D; color: white; border: none; padding: 12px 28px; border-radius: 8px; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 15px; cursor: pointer; transition: background 0.3s;">
                                Actualizar Teléfono
                            </button>
                        </form>

                        <!-- Zona Peligrosa -->
                        <div style="border-top: 1px solid #E5E5E5; padding-top: 32px;">
                            <h3 style="font-family: 'Jost', sans-serif; font-size: 18px; font-weight: 600; color: #EF4444; margin: 0 0 12px 0;">
                                Zona Peligrosa
                            </h3>
                            <p style="color: #666; margin: 0 0 16px 0; font-size: 14px;">
                                Una vez que elimines tu cuenta, no hay vuelta atrás. Por favor, ten certeza.
                            </p>
                            <button type="button" onclick="showDeleteModal()" style="background: #FEF2F2; color: #EF4444; border: 1px solid #EF4444; padding: 12px 28px; border-radius: 8px; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 15px; cursor: pointer; transition: all 0.3s;">
                                <i class="fas fa-exclamation-triangle" style="margin-right: 8px;"></i>Eliminar Cuenta
                            </button>
                        </div>
                    </div>
                </div>

                @else
                <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 48px; text-align: center;">
                    <i class="fas fa-user-lock" style="font-size: 64px; color: #E5E5E5; margin-bottom: 24px;"></i>
                    <h2 style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 600; color: #212529; margin: 0 0 12px 0;">
                        Please Sign In
                    </h2>
                    <p style="color: #666; margin: 0 0 24px 0;">You need to be logged in to access your account dashboard.</p>
                    <a href="{{ route('login') }}" style="display: inline-block; background: #EE403D; color: white; padding: 14px 32px; border-radius: 8px; text-decoration: none; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 15px;">
                        Sign In
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</section>


@include('components.delete-account-modal')

@push('styles')
<style>
.account-nav-btn:hover {
    background: #FEF3F2 !important;
    border-color: #EE403D !important;
    color: #EE403D !important;
}

.account-nav-btn.active {
    background: #EE403D !important;
    color: white !important;
    border-color: #EE403D !important;
}

.remove-address:hover {
    background: #EF4444 !important;
    color: white !important;
}

#add-address:hover {
    background: #059669 !important;
}

@media (max-width: 768px) {
    section > div > div {
        grid-template-columns: 1fr !important;
    }

    #section-dashboard > div:last-child {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Section Navigation
function showSection(sectionName) {
    // Hide all sections
    document.querySelectorAll('.account-section').forEach(section => {
        section.style.display = 'none';
    });

    // Show selected section
    document.getElementById('section-' + sectionName).style.display = 'block';

    // Update active button
    document.querySelectorAll('.account-nav-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.style.background = 'white';
        btn.style.color = '#666';
        btn.style.borderColor = '#E5E5E5';
    });

    const activeBtn = document.querySelector(`[data-section="${sectionName}"]`);
    if (activeBtn) {
        activeBtn.classList.add('active');
        activeBtn.style.background = '#EE403D';
        activeBtn.style.color = 'white';
        activeBtn.style.borderColor = '#EE403D';
    }
}

// Navigation button click handlers
document.querySelectorAll('.account-nav-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const section = this.getAttribute('data-section');
        showSection(section);
    });
});

// Address Management
document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-address');
    const list = document.getElementById('addresses-list');

    function createAddressItem(index) {
        const wrapper = document.createElement('div');
        wrapper.className = 'address-item';
        wrapper.style = 'border: 1px solid #E5E5E5; padding: 24px; border-radius: 12px; position: relative; background: #FAFAFA;';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'remove-address';
        removeBtn.innerHTML = '<i class="fas fa-trash" style="margin-right: 6px;"></i>Eliminar';
        removeBtn.style = 'position: absolute; right: 16px; top: 16px; background: #FEF2F2; border: none; color: #EF4444; cursor: pointer; padding: 8px 12px; border-radius: 6px; font-size: 13px; font-weight: 500; transition: all 0.3s;';
        removeBtn.addEventListener('click', () => wrapper.remove());

        wrapper.appendChild(removeBtn);

        const row1 = document.createElement('div');
        row1.style = 'display: grid; grid-template-columns: 1fr 150px; gap: 16px; margin-bottom: 16px;';

        const streetDiv = document.createElement('div');
        const streetLabel = document.createElement('label');
        streetLabel.textContent = 'Calle';
        streetLabel.style = 'display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;';
        const street = document.createElement('input');
        street.name = `addresses[${index}][street]`;
        street.placeholder = 'Nombre de la calle';
        street.style = 'width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: \'Jost\', sans-serif; font-size: 15px;';
        streetDiv.appendChild(streetLabel);
        streetDiv.appendChild(street);

        const numberDiv = document.createElement('div');
        const numberLabel = document.createElement('label');
        numberLabel.textContent = 'Número';
        numberLabel.style = 'display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;';
        const number = document.createElement('input');
        number.name = `addresses[${index}][number]`;
        number.placeholder = 'Número';
        number.style = 'width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: \'Jost\', sans-serif; font-size: 15px;';
        numberDiv.appendChild(numberLabel);
        numberDiv.appendChild(number);

        row1.appendChild(streetDiv);
        row1.appendChild(numberDiv);

        const row2 = document.createElement('div');
        row2.style = 'display: grid; grid-template-columns: 180px 1fr; gap: 16px;';

        const postalDiv = document.createElement('div');
        const postalLabel = document.createElement('label');
        postalLabel.textContent = 'Código Postal';
        postalLabel.style = 'display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;';
        const postal = document.createElement('input');
        postal.name = `addresses[${index}][postal_code]`;
        postal.placeholder = 'Código postal';
        postal.style = 'width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: \'Jost\', sans-serif; font-size: 15px;';
        postalDiv.appendChild(postalLabel);
        postalDiv.appendChild(postal);

        const noteDiv = document.createElement('div');
        const noteLabel = document.createElement('label');
        noteLabel.textContent = 'Información Adicional';
        noteLabel.style = 'display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;';
        const note = document.createElement('input');
        note.name = `addresses[${index}][note]`;
        note.placeholder = 'Ciudad / Estado o referencia';
        note.style = 'width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: \'Jost\', sans-serif; font-size: 15px;';
        noteDiv.appendChild(noteLabel);
        noteDiv.appendChild(note);

        row2.appendChild(postalDiv);
        row2.appendChild(noteDiv);

        wrapper.appendChild(row1);
        wrapper.appendChild(row2);

        return wrapper;
    }

    addBtn && addBtn.addEventListener('click', function () {
        const cur = list.querySelectorAll('.address-item').length;
        const item = createAddressItem(cur);
        list.appendChild(item);
    });

    document.querySelectorAll('.remove-address').forEach(btn => btn.addEventListener('click', function () {
        this.closest('.address-item')?.remove();
    }));

    // Review Modal Functions
    function openReviewModal(productId, productName, orderId) {
        const modal = document.getElementById('reviewModal');
        const form = document.getElementById('reviewForm');
        const title = document.getElementById('reviewModalTitle');
        
        title.textContent = `Reseñar: ${productName}`;
        form.action = `/products/${productId}/reviews`;
        form.querySelector('[name="order_id"]').value = orderId;
        form.querySelector('[name="rating"]').value = '5';
        form.querySelector('[name="comment"]').value = '';
        form.querySelector('[name="_method"]')?.remove();
        
        updateStars(5);
        modal.style.display = 'flex';
    }

    function editReviewModal(productId, productName, reviewId, rating, comment) {
        const modal = document.getElementById('reviewModal');
        const form = document.getElementById('reviewForm');
        const title = document.getElementById('reviewModalTitle');
        
        title.textContent = `Editar reseña: ${productName}`;
        form.action = `/reviews/${reviewId}`;
        form.querySelector('[name="rating"]').value = rating;
        form.querySelector('[name="comment"]').value = comment;
        
        if (!form.querySelector('[name="_method"]')) {
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PUT';
            form.appendChild(methodField);
        }
        
        updateStars(rating);
        modal.style.display = 'flex';
    }

    function closeReviewModal() {
        document.getElementById('reviewModal').style.display = 'none';
    }

    function setRating(rating) {
        document.querySelector('[name="rating"]').value = rating;
        updateStars(rating);
    }

    function updateStars(rating) {
        for (let i = 1; i <= 5; i++) {
            const star = document.getElementById(`star-${i}`);
            if (star) {
                star.style.color = i <= rating ? '#F59E0B' : '#E5E5E5';
            }
        }
    }

    window.openReviewModal = openReviewModal;
    window.editReviewModal = editReviewModal;
    window.closeReviewModal = closeReviewModal;
    window.setRating = setRating;
});
</script>

<!-- Review Modal -->
<div id="reviewModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 12px; padding: 32px; max-width: 500px; width: 90%;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h3 id="reviewModalTitle" style="font-family: 'Jost', sans-serif; font-size: 20px; font-weight: 700; color: #212529; margin: 0;">
                Dejar Reseña
            </h3>
            <button onclick="closeReviewModal()" style="background: none; border: none; font-size: 24px; color: #999; cursor: pointer;">×</button>
        </div>
        
        <form id="reviewForm" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="">
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 12px; color: #212529;">Calificación</label>
                <div style="display: flex; gap: 8px; font-size: 32px;">
                    <span id="star-1" onclick="setRating(1)" style="cursor: pointer; color: #F59E0B;">★</span>
                    <span id="star-2" onclick="setRating(2)" style="cursor: pointer; color: #F59E0B;">★</span>
                    <span id="star-3" onclick="setRating(3)" style="cursor: pointer; color: #F59E0B;">★</span>
                    <span id="star-4" onclick="setRating(4)" style="cursor: pointer; color: #F59E0B;">★</span>
                    <span id="star-5" onclick="setRating(5)" style="cursor: pointer; color: #F59E0B;">★</span>
                </div>
                <input type="hidden" name="rating" value="5">
            </div>
            
            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529;">Comentario (opcional)</label>
                <textarea name="comment" rows="4" placeholder="Cuéntanos sobre tu experiencia con este producto..." style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px; resize: vertical;"></textarea>
            </div>
            
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="closeReviewModal()" style="background: #F3F4F6; color: #666; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 500;">
                    Cancelar
                </button>
                <button type="submit" style="background: #10B981; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 500;">
                    Enviar Reseña
                </button>
            </div>
        </form>
    </div>
</div>

@endpush

@endsection
