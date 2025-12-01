@extends('layouts.app')

@section('title', 'Pedido Confirmado')

@push('styles')
<style>
    .confirmation-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .confirmation-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        animation: successPulse 2s ease-in-out infinite;
        position: relative;
    }

    .success-icon::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        opacity: 0.3;
        animation: successRipple 2s ease-out infinite;
    }

    @keyframes successPulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    @keyframes successRipple {
        0% {
            transform: scale(1);
            opacity: 0.3;
        }
        100% {
            transform: scale(1.4);
            opacity: 0;
        }
    }

    .success-icon i {
        font-size: 50px;
        color: white;
        position: relative;
        z-index: 1;
        animation: checkmark 0.8s ease;
    }

    @keyframes checkmark {
        0% {
            transform: scale(0) rotate(-45deg);
            opacity: 0;
        }
        50% {
            transform: scale(1.2) rotate(5deg);
        }
        100% {
            transform: scale(1) rotate(0deg);
            opacity: 1;
        }
    }

    .confirmation-title {
        font-family: 'Jost', sans-serif;
        font-size: 36px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 12px;
        animation: fadeInUp 0.6s ease;
    }

    .confirmation-subtitle {
        font-family: 'Jost', sans-serif;
        font-size: 17px;
        color: #666;
        margin-bottom: 12px;
        animation: fadeInUp 0.8s ease;
    }

    .order-number {
        font-family: 'Jost', sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: #EE403D;
        background: #FEF3F2;
        padding: 12px 24px;
        border-radius: 8px;
        display: inline-block;
        animation: fadeInUp 1s ease;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .order-details {
        background: white;
        border: 1px solid #E5E5E5;
        border-radius: 12px;
        padding: 36px;
        margin-bottom: 32px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .details-section {
        margin-bottom: 32px;
    }

    .details-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-family: 'Jost', sans-serif;
        font-size: 18px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #E5E5E5;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .info-item {
        font-family: 'Jost', sans-serif;
    }

    .info-label {
        font-size: 13px;
        color: #666;
        margin-bottom: 4px;
    }

    .info-value {
        font-size: 15px;
        font-weight: 500;
        color: #212529;
    }

    .order-items {
        margin-top: 20px;
    }

    .order-item {
        display: flex;
        gap: 16px;
        padding: 16px 0;
        border-bottom: 1px solid #F5F6F2;
    }

    .order-item:first-child {
        padding-top: 0;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 80px;
        height: 80px;
        background-color: #F5F6F2;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 4px;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 4px;
    }

    .item-qty {
        font-family: 'Jost', sans-serif;
        font-size: 14px;
        color: #666;
    }

    .item-price {
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: #EE403D;
        text-align: right;
    }

    .order-summary {
        background: linear-gradient(135deg, #F5F6F2 0%, #FAFAF9 100%);
        padding: 24px;
        border-radius: 12px;
        margin-top: 24px;
        border: 1px solid #E5E5E5;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        color: #666;
    }

    .summary-row span:last-child {
        font-weight: 600;
        color: #212529;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 2px solid #E5E5E5;
        font-family: 'Jost', sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: #212529;
    }

    .summary-total span:last-child {
        color: #EE403D;
    }

    .action-buttons {
        display: flex;
        gap: 16px;
        justify-content: center;
        margin-top: 40px;
    }

    .btn {
        padding: 14px 32px;
        border-radius: 8px;
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        width: 260px;
        height: 50px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #EE403D 0%, #E32020 100%);
        color: white;
        border: none;
    }

    .btn-primary:hover {
        box-shadow: 0 4px 12px rgba(238, 64, 61, 0.2);
        transform: translateY(-1px);
    }

    .btn-primary:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(238, 64, 61, 0.15);
    }

    .btn-secondary {
        background: white;
        color: #212529;
        border: 2px solid #E5E5E5;
    }

    .btn-secondary:hover {
        border-color: #EE403D;
        color: #EE403D;
        background: #FEFEFE;
        box-shadow: 0 4px 12px rgba(238, 64, 61, 0.1);
        transform: translateY(-1px);
    }

    .btn-secondary:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(238, 64, 61, 0.08);
    }

    .btn i {
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            text-align: center;
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
            <a href="{{ route('cart') }}" style="color: #666; text-decoration: none;">Carrito</a>
            <span style="margin: 0 8px;">/</span>
            <a href="{{ route('checkout.index') }}" style="color: #666; text-decoration: none;">Checkout</a>
            <span style="margin: 0 8px;">/</span>
            <span style="color: #212529; font-weight: 500;">Confirmación</span>
        </nav>
    </div>
</div>

<!-- CONFIRMATION CONTAINER -->
<div class="confirmation-container">
    <!-- Header -->
    <div class="confirmation-header">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h1 class="confirmation-title">¡Pedido Realizado con Éxito!</h1>
        <p class="confirmation-subtitle">Gracias por tu compra. Hemos recibido tu pedido.</p>
        <p class="order-number">Número de Pedido: {{ $order->order_number }}</p>
    </div>

    <!-- Order Details -->
    <div class="order-details">
        <!-- Customer Information -->
        <div class="details-section">
            <h2 class="section-title">Información de Envío</h2>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Nombre Completo</div>
                    <div class="info-value">{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Correo Electrónico</div>
                    <div class="info-value">{{ $order->shipping_email }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Teléfono</div>
                    <div class="info-value">{{ $order->shipping_phone }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Dirección</div>
                    <div class="info-value">{{ $order->shipping_address }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Ciudad</div>
                    <div class="info-value">{{ $order->shipping_city }}, {{ $order->shipping_state }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Código Postal</div>
                    <div class="info-value">{{ $order->shipping_postal_code }}</div>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="details-section">
            <h2 class="section-title">Información de Pago</h2>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Método de Pago</div>
                    <div class="info-value">
                        @if($order->payment_method == 'cash')
                            Pago contra entrega
                        @elseif($order->payment_method == 'card')
                            Tarjeta de Crédito/Débito
                        @elseif($order->payment_method == 'transfer')
                            Transferencia Bancaria
                        @endif
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Estado del Pago</div>
                    <div class="info-value">
                        @if($order->payment_status == 'pending')
                            Pendiente
                        @elseif($order->payment_status == 'paid')
                            Pagado
                        @elseif($order->payment_status == 'failed')
                            Fallido
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="details-section">
            <h2 class="section-title">Productos Pedidos</h2>
            <div class="order-items">
                @foreach($order->items as $item)
                    <div class="order-item">
                        <div class="item-image">
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}">
                        </div>
                        <div class="item-details">
                            <div class="item-name">{{ $item->product->name }}</div>
                            <div class="item-qty">Cantidad: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</div>
                        </div>
                        <div class="item-price">${{ number_format($item->subtotal, 2) }}</div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Envío</span>
                    <span>{{ $order->shipping_cost == 0 ? 'Gratis' : '$' . number_format($order->shipping_cost, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Impuestos</span>
                    <span>${{ number_format($order->tax, 2) }}</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span>${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        @if($order->notes)
            <div class="details-section">
                <h2 class="section-title">Notas del Pedido</h2>
                <p style="font-family: 'Jost', sans-serif; color: #666; line-height: 1.6;">{{ $order->notes }}</p>
            </div>
        @endif
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('shop.index') }}" class="btn btn-primary">
            <i class="fas fa-shopping-bag"></i>
            Continuar Comprando
        </a>
        @auth
            <a href="{{ route('account') }}" class="btn btn-secondary">
                Ver Mis Pedidos
                <i class="fas fa-arrow-right"></i>
            </a>
        @endauth
    </div>
</div>

@endsection
