@extends('layouts.app')

@section('title', 'Detalle de Orden #' . $order->order_number)

@section('content')
@include('layouts.navbar')

<!-- Page Title -->
<div style="background-color: #F5F6F2; padding: 60px 0 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1 style="font-family: 'Jost', sans-serif; font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0;">
            Detalle de Orden
        </h1>
        <nav style="display: flex; gap: 8px; align-items: center; font-size: 14px;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="color: #999;">›</span>
            <a href="{{ route('account') }}" style="color: #666; text-decoration: none;">Mi Cuenta</a>
            <span style="color: #999;">›</span>
            <span style="color: #EE403D; font-weight: 500;">Orden #{{ $order->order_number }}</span>
        </nav>
    </div>
</div>

<!-- Order Detail -->
<section style="padding: 60px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <!-- Back Button -->
        <div style="margin-bottom: 32px;">
            <a href="{{ route('account') }}#orders" style="display: inline-flex; align-items: center; gap: 8px; color: #666; text-decoration: none; font-family: 'Jost', sans-serif; font-weight: 500; font-size: 15px; transition: color 0.3s;" onmouseover="this.style.color='#EE403D'" onmouseout="this.style.color='#666'">
                <i class="fas fa-arrow-left"></i>
                Volver a Mis Compras
            </a>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
            <!-- Left Column - Order Info -->
            <div>
                <!-- Order Header -->
                <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px; margin-bottom: 24px;">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 24px;">
                        <div>
                            <h2 style="font-family: 'Jost', sans-serif; font-size: 28px; font-weight: 700; color: #212529; margin: 0 0 8px 0;">
                                Orden #{{ $order->order_number }}
                            </h2>
                            <p style="color: #666; margin: 0; font-size: 15px;">
                                Realizada el {{ $order->created_at->format('d/m/Y \a \l\a\s H:i') }}
                            </p>
                        </div>
                        <div>
                            @php
                                $statusColors = [
                                    'pending' => ['bg' => '#FEF3C7', 'text' => '#92400E', 'label' => 'Pendiente'],
                                    'processing' => ['bg' => '#DBEAFE', 'text' => '#1E40AF', 'label' => 'Procesando'],
                                    'shipped' => ['bg' => '#E0E7FF', 'text' => '#3730A3', 'label' => 'Enviado'],
                                    'delivered' => ['bg' => '#D1FAE5', 'text' => '#065F46', 'label' => 'Entregado'],
                                    'cancelled' => ['bg' => '#FEE2E2', 'text' => '#991B1B', 'label' => 'Cancelado'],
                                ];
                                $statusConfig = $statusColors[$order->status] ?? ['bg' => '#F3F4F6', 'text' => '#374151', 'label' => $order->status];
                            @endphp
                            <span style="display: inline-block; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; background: {{ $statusConfig['bg'] }}; color: {{ $statusConfig['text'] }};">
                                {{ $statusConfig['label'] }}
                            </span>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div style="padding: 20px; background: #FAFAFA; border-radius: 8px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <div style="font-size: 13px; color: #666; margin-bottom: 4px;">Método de Pago</div>
                            <div style="font-size: 15px; font-weight: 600; color: #212529; text-transform: capitalize;">
                                {{ str_replace('_', ' ', $order->payment_method) }}
                            </div>
                        </div>
                        <div>
                            <div style="font-size: 13px; color: #666; margin-bottom: 4px;">Estado de Pago</div>
                            @php
                                $paymentColors = [
                                    'pending' => ['bg' => '#FEF3C7', 'text' => '#92400E', 'label' => 'Pendiente'],
                                    'paid' => ['bg' => '#D1FAE5', 'text' => '#065F46', 'label' => 'Pagado'],
                                    'failed' => ['bg' => '#FEE2E2', 'text' => '#991B1B', 'label' => 'Fallido'],
                                ];
                                $paymentConfig = $paymentColors[$order->payment_status] ?? ['bg' => '#F3F4F6', 'text' => '#374151', 'label' => $order->payment_status];
                            @endphp
                            <span style="display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 13px; font-weight: 600; background: {{ $paymentConfig['bg'] }}; color: {{ $paymentConfig['text'] }};">
                                {{ $paymentConfig['label'] }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
                    <h3 style="font-family: 'Jost', sans-serif; font-size: 20px; font-weight: 600; color: #212529; margin: 0 0 24px 0; padding-bottom: 16px; border-bottom: 2px solid #F5F6F2;">
                        Productos
                    </h3>

                    <div style="display: flex; flex-direction: column; gap: 20px;">
                        @foreach($order->items as $item)
                            <div style="display: flex; gap: 20px; padding: 16px; background: #FAFAFA; border-radius: 8px;">
                                <div style="width: 80px; height: 80px; flex-shrink: 0; border-radius: 6px; overflow: hidden; background: #F5F6F2;">
                                    @if($item->product)
                                        @php
                                            $images = is_string($item->product->images) ? json_decode($item->product->images, true) : $item->product->images;
                                            $images = $images ?? [];
                                            $imagePath = !empty($images) ? $images[0] : null;

                                            if ($imagePath) {
                                                $storageFile = public_path('storage/' . $imagePath);
                                                $publicFile = public_path($imagePath);

                                                if (file_exists($storageFile)) {
                                                    $imageUrl = asset('storage/' . $imagePath);
                                                } elseif (file_exists($publicFile)) {
                                                    $imageUrl = asset($imagePath);
                                                } else {
                                                    $imageUrl = asset('images/placeholder-product.svg');
                                                }
                                            } else {
                                                $imageUrl = asset('images/placeholder-product.svg');
                                            }
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="{{ $item->product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #CCC;">
                                            <i class="fas fa-image" style="font-size: 32px;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div style="flex: 1;">
                                    <h4 style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 600; color: #212529; margin: 0 0 8px 0;">
                                        {{ $item->product->name ?? 'Producto no disponible' }}
                                    </h4>
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <div style="color: #666; font-size: 14px;">
                                            Cantidad: <span style="font-weight: 600; color: #212529;">{{ $item->quantity }}</span>
                                        </div>
                                        <div style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 700; color: #EE403D;">
                                            ${{ number_format($item->subtotal, 2) }}
                                        </div>
                                    </div>
                                    <div style="color: #999; font-size: 13px; margin-top: 4px;">
                                        Precio unitario: ${{ number_format($item->price, 2) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column - Summary and Address -->
            <div>
                <!-- Order Summary -->
                <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px; margin-bottom: 24px;">
                    <h3 style="font-family: 'Jost', sans-serif; font-size: 20px; font-weight: 600; color: #212529; margin: 0 0 24px 0; padding-bottom: 16px; border-bottom: 2px solid #F5F6F2;">
                        Resumen
                    </h3>

                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #666; font-size: 15px;">Subtotal</span>
                            <span style="font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 600; color: #212529;">${{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #666; font-size: 15px;">Impuestos</span>
                            <span style="font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 600; color: #212529;">${{ number_format($order->tax, 2) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #666; font-size: 15px;">Envío</span>
                            <span style="font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 600; color: #212529;">${{ number_format($order->shipping_cost, 2) }}</span>
                        </div>
                        <div style="border-top: 2px solid #E5E5E5; padding-top: 16px; margin-top: 8px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-family: 'Jost', sans-serif; font-size: 18px; font-weight: 700; color: #212529;">Total</span>
                            <span style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 700; color: #EE403D;">${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
                    <h3 style="font-family: 'Jost', sans-serif; font-size: 20px; font-weight: 600; color: #212529; margin: 0 0 24px 0; padding-bottom: 16px; border-bottom: 2px solid #F5F6F2;">
                        Dirección de Envío
                    </h3>

                    @if($order->address)
                        <div style="color: #666; font-size: 15px; line-height: 1.8;">
                            <div style="margin-bottom: 8px;">
                                <i class="fas fa-map-marker-alt" style="width: 20px; color: #EE403D;"></i>
                                <strong style="color: #212529;">{{ $order->address->address_line_1 }}</strong>
                            </div>
                            @if($order->address->address_line_2)
                                <div style="margin-bottom: 8px; padding-left: 28px;">
                                    {{ $order->address->address_line_2 }}
                                </div>
                            @endif
                            <div style="padding-left: 28px;">
                                {{ $order->address->city }}, {{ $order->address->state }}
                            </div>
                            <div style="padding-left: 28px;">
                                CP: {{ $order->address->postal_code }}
                            </div>
                            <div style="padding-left: 28px;">
                                {{ $order->address->country }}
                            </div>
                        </div>
                    @else
                        <p style="color: #999; font-style: italic;">No se especificó dirección de envío</p>
                    @endif
                </div>

                @if($order->notes)
                <!-- Notes -->
                <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px; margin-top: 24px;">
                    <h3 style="font-family: 'Jost', sans-serif; font-size: 20px; font-weight: 600; color: #212529; margin: 0 0 16px 0;">
                        Notas
                    </h3>
                    <p style="color: #666; font-size: 15px; line-height: 1.6; margin: 0;">
                        {{ $order->notes }}
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>


@push('styles')
<style>
@media (max-width: 768px) {
    section > div > div {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endpush

@endsection
