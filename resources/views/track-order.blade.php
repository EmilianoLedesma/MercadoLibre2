@extends('layouts.app')

@section('title', 'Rastrear Pedido')

@push('styles')
<style>
    .track-page {
        font-family: 'Jost', sans-serif;
    }

    .track-hero {
        background: linear-gradient(135deg, #F5F6F2 0%, #FAFAF9 100%);
        padding: 80px 20px;
        text-align: center;
        position: relative;
    }

    .track-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #EE403D 0%, #E32020 100%);
    }

    .track-hero h1 {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 16px;
        color: #212529;
    }

    .track-hero h1 .highlight {
        color: #EE403D;
    }

    .track-hero p {
        font-size: 18px;
        color: #666;
    }

    .track-container {
        max-width: 900px;
        margin: -60px auto 120px;
        padding: 0 20px;
        position: relative;
        z-index: 2;
        min-height: calc(100vh - 500px);
    }

    .track-form-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        margin-bottom: 40px;
    }

    .track-form-title {
        font-size: 24px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 12px;
        text-align: center;
    }

    .track-form-subtitle {
        font-size: 15px;
        color: #666;
        margin-bottom: 32px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 8px;
    }

    .form-input {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #E5E5E5;
        border-radius: 8px;
        font-size: 15px;
        font-family: 'Jost', sans-serif;
        transition: border-color 0.3s;
    }

    .form-input:focus {
        outline: none;
        border-color: #EE403D;
    }

    .form-input::placeholder {
        color: #999;
    }

    .btn-track {
        width: 100%;
        padding: 16px;
        background-color: #EE403D;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-track:hover {
        background-color: #E32020;
    }

    .btn-track:disabled {
        background-color: #CCC;
        cursor: not-allowed;
    }

    .order-result {
        display: none;
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }

    .order-result.show {
        display: block;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding-bottom: 24px;
        border-bottom: 2px solid #F5F6F2;
        margin-bottom: 32px;
    }

    .order-number {
        font-size: 20px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 4px;
    }

    .order-date {
        font-size: 14px;
        color: #666;
    }

    .order-status-badge {
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background-color: #FFF3CD;
        color: #856404;
    }

    .status-processing {
        background-color: #CCE5FF;
        color: #004085;
    }

    .status-shipped {
        background-color: #D1ECF1;
        color: #0C5460;
    }

    .status-delivered {
        background-color: #D4EDDA;
        color: #155724;
    }

    .status-cancelled {
        background-color: #F8D7DA;
        color: #721C24;
    }

    .tracking-timeline {
        margin: 32px 0;
    }

    .timeline-item {
        position: relative;
        padding-left: 48px;
        padding-bottom: 32px;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 24px;
        width: 2px;
        height: calc(100% - 8px);
        background-color: #E5E5E5;
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-dot {
        position: absolute;
        left: 0;
        top: 0;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #E5E5E5;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
    }

    .timeline-item.active .timeline-dot {
        background-color: #EE403D;
        color: white;
        box-shadow: 0 0 0 4px rgba(238, 64, 61, 0.1);
    }

    .timeline-content h3 {
        font-size: 16px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 4px;
    }

    .timeline-content .timeline-date {
        font-size: 13px;
        color: #999;
        margin-bottom: 8px;
    }

    .timeline-content p {
        font-size: 14px;
        color: #666;
        margin: 0;
        line-height: 1.5;
    }

    .order-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-top: 32px;
        padding-top: 32px;
        border-top: 2px solid #F5F6F2;
    }

    .info-section h4 {
        font-size: 14px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-section p {
        font-size: 14px;
        color: #666;
        margin: 4px 0;
        line-height: 1.6;
    }

    .help-box {
        background: #F5F6F2;
        border-left: 4px solid #EE403D;
        padding: 20px;
        border-radius: 8px;
        margin-top: 32px;
    }

    .help-box h4 {
        font-size: 16px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 8px;
    }

    .help-box p {
        font-size: 14px;
        color: #666;
        margin: 0;
        line-height: 1.6;
    }

    .help-box a {
        color: #EE403D;
        text-decoration: none;
        font-weight: 600;
    }

    .help-box a:hover {
        text-decoration: underline;
    }

    .order-not-found {
        display: none;
        background: white;
        border-radius: 16px;
        padding: 60px 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        text-align: center;
    }

    .order-not-found.show {
        display: block;
    }

    .not-found-icon {
        font-size: 120px;
        color: #E5E5E5;
        margin-bottom: 24px;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .not-found-title {
        font-size: 32px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 12px;
    }

    .not-found-message {
        font-size: 16px;
        color: #666;
        margin-bottom: 32px;
        line-height: 1.6;
    }

    .not-found-suggestions {
        background: #F5F6F2;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 32px;
        text-align: left;
    }

    .not-found-suggestions h4 {
        font-size: 16px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 16px;
        text-align: center;
    }

    .not-found-suggestions ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .not-found-suggestions li {
        padding: 8px 0;
        color: #666;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .not-found-suggestions li i {
        color: #EE403D;
        font-size: 12px;
    }

    .btn-try-again {
        display: inline-block;
        padding: 14px 32px;
        background-color: #EE403D;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
    }

    .btn-try-again:hover {
        background-color: #E32020;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(238, 64, 61, 0.3);
    }

    @media (max-width: 768px) {
        .track-hero h1 {
            font-size: 32px;
        }

        .track-form-card,
        .order-result {
            padding: 24px;
        }

        .order-header {
            flex-direction: column;
            gap: 16px;
        }

        .order-info-grid {
            grid-template-columns: 1fr;
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
            <span style="color: #212529; font-weight: 500;">Rastrear Pedido</span>
        </nav>
    </div>
</div>

<div class="track-page">
    <!-- Hero Section -->
    <div class="track-hero">
        <h1>Rastrear <span class="highlight">Pedido</span></h1>
        <p>Ingresa tu número de pedido para ver el estado de tu envío</p>
    </div>

    <!-- Track Content -->
    <div class="track-container">
        <!-- Track Form -->
        <div class="track-form-card">
            <h2 class="track-form-title">Buscar tu Pedido</h2>
            <p class="track-form-subtitle">Ingresa el número de pedido que recibiste en tu correo de confirmación</p>

            <form id="trackForm">
                @auth
                <!-- Selector de pedidos para usuarios autenticados -->
                <div class="form-group">
                    <label for="orderSelector" class="form-label">Selecciona uno de tus pedidos</label>
                    <select id="orderSelector" class="form-input" style="cursor: pointer;">
                        <option value="">-- Selecciona un pedido --</option>
                        @php
                            $userOrders = \App\Models\Order::where('user_id', auth()->id())
                                ->orderBy('created_at', 'desc')
                                ->get();
                        @endphp
                        @foreach($userOrders as $order)
                        <option value="{{ $order->order_number }}">
                            Pedido #{{ $order->order_number }} - {{ $order->created_at->format('d/m/Y') }} - ${{ number_format($order->total, 2) }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div style="text-align: center; margin: 20px 0; color: #999; font-size: 14px;">
                    <span>o ingresa manualmente</span>
                </div>
                @endauth

                <div class="form-group">
                    <label for="orderNumber" class="form-label">Número de Pedido</label>
                    <input
                        type="text"
                        id="orderNumber"
                        name="orderNumber"
                        class="form-input"
                        placeholder="Ej: ORD-2024-001234"
                        required
                    >
                </div>

                <button type="submit" class="btn-track">
                    <i class="fas fa-search"></i>
                    Rastrear Pedido
                </button>
            </form>
        </div>

        <!-- Order Not Found (Initially Hidden) -->
        <div id="orderNotFound" class="order-not-found">
            <div class="not-found-icon">
                <i class="fas fa-search"></i>
            </div>
            <h2 class="not-found-title">¡Oops! Pedido no encontrado</h2>
            <p class="not-found-message">
                No pudimos encontrar ningún pedido con el número que ingresaste.<br>
                ¿Tal vez un paquete perdido en el espacio-tiempo? 
            </p>
            
            <div class="not-found-suggestions">
                <h4><i class="" style="color: #FFC107; margin-right: 8px;"></i>Sugerencias</h4>
                <ul>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Verifica que hayas ingresado el número correctamente</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Revisa tu correo de confirmación para el número exacto</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>El formato correcto es: ORD-2024-XXXXXX</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Si acabas de hacer el pedido, intenta en unos minutos</span>
                    </li>
                </ul>
            </div>
            
            <button class="btn-try-again" onclick="tryAgain()">
                <i class="fas fa-redo"></i>
                Intentar de Nuevo
            </button>
            
            <div style="margin-top: 24px;">
                <a href="{{ route('contact') }}" style="color: #EE403D; text-decoration: none; font-weight: 600;">
                    ¿Necesitas ayuda? Contáctanos →
                </a>
            </div>
        </div>

        <!-- Order Result (Initially Hidden) -->
        <div id="orderResult" class="order-result">
            <!-- Order Header -->
            <div class="order-header">
                <div>
                    <div class="order-number">Pedido #<span id="displayOrderNumber"></span></div>
                    <div class="order-date">Realizado el <span id="displayOrderDate"></span></div>
                </div>
                <div>
                    <span id="statusBadge" class="order-status-badge"></span>
                </div>
            </div>

            <!-- Tracking Timeline -->
            <div class="tracking-timeline">
                <h3 style="font-size: 18px; font-weight: 600; color: #212529; margin-bottom: 24px;">
                    <i class="fas fa-shipping-fast" style="color: #EE403D; margin-right: 8px;"></i>
                    Estado del Envío
                </h3>

                <div class="timeline-item active">
                    <div class="timeline-dot">
                        <i class="fas fa-check" style="font-size: 12px;"></i>
                    </div>
                    <div class="timeline-content">
                        <h3>Pedido Confirmado</h3>
                        <div id="confirmed-date" class="timeline-date">Fecha de compra</div>
                        <p>Tu pedido ha sido recibido y confirmado exitosamente.</p>
                    </div>
                </div>

                <div class="timeline-item active">
                    <div class="timeline-dot">
                        <i class="fas fa-check" style="font-size: 12px;"></i>
                    </div>
                    <div class="timeline-content">
                        <h3>En Preparación</h3>
                        <div id="preparation-date" class="timeline-date" style="display: none;"></div>
                        <p>Estamos preparando tu pedido con mucho cuidado.</p>
                    </div>
                </div>

                <div class="timeline-item active">
                    <div class="timeline-dot">
                        <i class="fas fa-truck" style="font-size: 12px;"></i>
                    </div>
                    <div class="timeline-content">
                        <h3>En Camino</h3>
                        <div id="shipped-date" class="timeline-date" style="display: none;"></div>
                        <p>Tu pedido está en camino a la dirección de entrega.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot">
                        <i class="fas fa-box" style="font-size: 12px;"></i>
                    </div>
                    <div class="timeline-content">
                        <h3>Entregado</h3>
                        <div id="delivered-date" class="timeline-date">Fecha estimada</div>
                        <p>Llegaremos pronto a tu dirección.</p>
                    </div>
                </div>
            </div>

            <!-- Order Information -->
            <div class="order-info-grid">
                <div class="info-section">
                    <h4>Dirección de Envío</h4>
                    <p id="displayShippingAddress"></p>
                </div>

                <div class="info-section">
                    <h4>Resumen del Pedido</h4>
                    <p id="displayOrderSummary"></p>
                </div>
            </div>

            <!-- Help Box -->
            <div class="help-box">
                <h4>¿Necesitas ayuda con tu pedido?</h4>
                <p>
                    Si tienes alguna pregunta o problema con tu pedido, 
                    <a href="{{ route('contact') }}">contáctanos</a> y te ayudaremos encantados.
                    También puedes llamarnos al <strong>+52 55 1234 5678</strong>
                </p>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection

@push('scripts')
<script>
// Selector de pedidos (solo para usuarios autenticados)
const orderSelector = document.getElementById('orderSelector');
if (orderSelector) {
    orderSelector.addEventListener('change', function() {
        const orderNumber = this.value;
        if (orderNumber) {
            document.getElementById('orderNumber').value = orderNumber;
        }
    });
}

document.getElementById('trackForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const orderNumber = document.getElementById('orderNumber').value.trim();
    const btn = this.querySelector('.btn-track');
    const resultDiv = document.getElementById('orderResult');
    
    if (!orderNumber) {
        showToast('Por favor ingresa un número de pedido', 'error');
        return;
    }
    
    // Disable button
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Buscando...';
    resultDiv.classList.remove('show');
    
    try {
        const response = await fetch(`/api/track-order/${orderNumber}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            document.getElementById('orderNotFound').classList.remove('show');
            showOrderResult(data.order);
        } else {
            document.getElementById('orderResult').classList.remove('show');
            showOrderNotFound();
        }
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('orderResult').classList.remove('show');
        showOrderNotFound('Hubo un problema al buscar tu pedido. Por favor intenta de nuevo.');
    } finally {
        // Reset button
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-search"></i> Rastrear Pedido';
    }
});

function showOrderResult(order) {
    // Update order details
    document.getElementById('displayOrderNumber').textContent = order.order_number;
    document.getElementById('displayOrderDate').textContent = order.created_at;

    // Status mapping
    const statusMap = {
        'pending': { text: 'Pendiente', class: 'status-pending' },
        'processing': { text: 'En Proceso', class: 'status-processing' },
        'shipped': { text: 'Enviado', class: 'status-shipped' },
        'delivered': { text: 'Entregado', class: 'status-delivered' },
        'cancelled': { text: 'Cancelado', class: 'status-cancelled' }
    };

    const status = statusMap[order.status] || { text: order.status, class: 'status-pending' };
    document.getElementById('statusBadge').textContent = status.text;
    document.getElementById('statusBadge').className = `order-status-badge ${status.class}`;

    // Shipping address
    document.getElementById('displayShippingAddress').innerHTML = `
        <strong>${order.shipping_name}</strong><br>
        ${order.shipping_address}<br>
        ${order.shipping_city}, ${order.shipping_state} ${order.shipping_zip}<br>
        Tel: ${order.shipping_phone}
    `;

    // Order summary
    const shipping = order.shipping_cost > 0 ? `$${order.shipping_cost}` : 'Gratis';
    document.getElementById('displayOrderSummary').innerHTML = `
        <strong>${order.items_count} artículo(s)</strong><br>
        Subtotal: $${order.subtotal}<br>
        Envío: ${shipping}<br>
        <strong>Total: $${order.total}</strong>
    `;

    // Update timeline based on status and order data
    updateTimeline(order.status, order);

    // Show result and scroll to it
    const resultDiv = document.getElementById('orderResult');
    resultDiv.classList.add('show');

    setTimeout(() => {
        resultDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 100);
}

function updateTimeline(status, order) {
    const timelineItems = document.querySelectorAll('.timeline-item');

    // Remove active class from all
    timelineItems.forEach(item => item.classList.remove('active'));

    // Hide all dates by default
    document.getElementById('preparation-date').style.display = 'none';
    document.getElementById('shipped-date').style.display = 'none';

    // Set purchase date (always shown)
    document.getElementById('confirmed-date').textContent = order.created_at_full;

    // Set estimated delivery date (always shown)
    document.getElementById('delivered-date').textContent = 'Estimado: ' + order.estimated_delivery;

    // Map status to timeline index
    const statusIndex = {
        'pending': 0,
        'processing': 1,
        'shipped': 2,
        'delivered': 3,
        'cancelled': 0
    };

    const activeIndex = statusIndex[status] || 0;

    // Activate items up to current status
    for (let i = 0; i <= activeIndex; i++) {
        if (timelineItems[i]) {
            timelineItems[i].classList.add('active');
        }
    }
}

function showOrderNotFound(customMessage = null) {
    const notFoundDiv = document.getElementById('orderNotFound');
    
    if (customMessage) {
        const messageEl = notFoundDiv.querySelector('.not-found-message');
        if (messageEl) {
            messageEl.innerHTML = customMessage;
        }
    }
    
    notFoundDiv.classList.add('show');
    
    setTimeout(() => {
        notFoundDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 100);
}

function tryAgain() {
    document.getElementById('orderNotFound').classList.remove('show');
    document.getElementById('orderNumber').value = '';
    document.getElementById('orderNumber').focus();
    
    // Scroll back to form
    document.querySelector('.track-form-card').scrollIntoView({ behavior: 'smooth', block: 'center' });
}
</script>
@endpush
