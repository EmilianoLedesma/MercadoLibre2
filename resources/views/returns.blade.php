@extends('layouts.app')

@section('title', 'Devoluciones')

@section('content')
@include('layouts.navbar')

<!-- Hero Section -->
<section style="background-color: #F8F8F8; padding: 60px 0 40px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 40px;">
        <div style="text-align: center;">
            <h1 style="font-size: 18px; font-weight: 400; color: #666; margin: 0; font-family: 'Jost', sans-serif;">
                Inicia tu solicitud de devolución de forma rápida y sencilla
            </h1>
        </div>
    </div>
</section>

@auth
<!-- Return Process -->
<section style="padding: 60px 0; background-color: white;">
    <div style="max-width: 1000px; margin: 0 auto; padding: 0 40px;">
        
        @if(session('success'))
        <div style="background-color: #D1FAE5; border: 1px solid #10B981; color: #065F46; padding: 20px; border-radius: 12px; margin-bottom: 30px; font-family: 'Jost', sans-serif;">
            <strong>✓ {{ session('success') }}</strong>
        </div>
        @endif

        @if(session('error'))
        <div style="background-color: #FEE2E2; border: 1px solid #DC2626; color: #991B1B; padding: 20px; border-radius: 12px; margin-bottom: 30px; font-family: 'Jost', sans-serif;">
            <strong>✗ {{ session('error') }}</strong>
        </div>
        @endif

        <!-- Progress Steps -->
        <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 60px; gap: 40px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div id="step1-indicator" style="width: 48px; height: 48px; border-radius: 50%; background-color: #EE403D; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-family: 'Jost', sans-serif; font-size: 20px;">
                    1
                </div>
                <span id="step1-text" style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 600; color: #212529;">Selecciona Pedido</span>
            </div>
            <div style="width: 80px; height: 2px; background-color: #E5E5E5;"></div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <div id="step2-indicator" style="width: 48px; height: 48px; border-radius: 50%; background-color: #E5E5E5; color: #999; display: flex; align-items: center; justify-content: center; font-weight: 700; font-family: 'Jost', sans-serif; font-size: 20px;">
                    2
                </div>
                <span id="step2-text" style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 400; color: #999;">Motivo</span>
            </div>
            <div style="width: 80px; height: 2px; background-color: #E5E5E5;"></div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <div id="step3-indicator" style="width: 48px; height: 48px; border-radius: 50%; background-color: #E5E5E5; color: #999; display: flex; align-items: center; justify-content: center; font-weight: 700; font-family: 'Jost', sans-serif; font-size: 20px;">
                    3
                </div>
                <span id="step3-text" style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 400; color: #999;">Confirmación</span>
            </div>
        </div>

        <!-- Step 1: Select Order -->
        <div id="step1-content">
            <h2 style="font-size: 28px; font-weight: 700; color: #212529; margin-bottom: 40px; font-family: 'Jost', sans-serif; text-align: center;">
                Selecciona el pedido que deseas devolver
            </h2>
            
            @if($orders->count() > 0)
            <div style="display: grid; gap: 20px;">
                @foreach($orders as $order)
                <div id="order-card-{{ $order->id }}" onclick="selectOrderForReturn({{ $order->id }})" style="border: 2px solid #E5E5E5; border-radius: 12px; padding: 24px; cursor: pointer; transition: all 0.3s;" data-order-number="{{ $order->order_number }}">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 20px;">
                        <div>
                            <div style="color: #999; font-size: 14px; margin-bottom: 4px; font-family: 'Jost', sans-serif;">
                                Pedido #{{ $order->order_number }} · {{ $order->created_at->format('d M Y') }}
                            </div>
                            <div style="font-size: 24px; font-weight: 700; color: #212529; font-family: 'Jost', sans-serif;">
                                ${{ number_format($order->total, 2) }}
                            </div>
                        </div>
                        <div>
                            @php
                                $statusColors = [
                                    'pending' => ['bg' => '#FEF3C7', 'text' => '#92400E'],
                                    'processing' => ['bg' => '#DBEAFE', 'text' => '#1E40AF'],
                                    'shipped' => ['bg' => '#E0E7FF', 'text' => '#3730A3'],
                                    'delivered' => ['bg' => '#D1FAE5', 'text' => '#065F46'],
                                    'cancelled' => ['bg' => '#FEE2E2', 'text' => '#991B1B'],
                                    'returned' => ['bg' => '#F3E8FF', 'text' => '#9333EA'],
                                ];
                                $status = $statusColors[$order->status] ?? ['bg' => '#F3F4F6', 'text' => '#374151'];
                            @endphp
                            <span style="background-color: {{ $status['bg'] }}; color: {{ $status['text'] }}; padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; font-family: 'Jost', sans-serif;">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Products in Order -->
                    <div style="background-color: #F8F9FA; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
                        @foreach($order->items as $item)
                        <div style="display: flex; gap: 16px; align-items: center; {{ !$loop->last ? 'margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid #E5E5E5;' : '' }}">
                            @if($item->product)
                            <div style="width: 70px; height: 70px; background-color: white; border-radius: 8px; padding: 4px; flex-shrink: 0;">
                                <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" style="width: 100%; height: 100%; object-fit: contain;">
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #212529; font-family: 'Jost', sans-serif; margin-bottom: 4px;">{{ $item->product->name }}</div>
                                <div style="color: #666; font-size: 14px; font-family: 'Jost', sans-serif;">Cantidad: {{ $item->quantity }}</div>
                            </div>
                            <div style="font-weight: 700; color: #212529; font-family: 'Jost', sans-serif;">
                                ${{ number_format($item->price * $item->quantity, 2) }}
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                    <button type="button" onclick="event.stopPropagation(); goToStep2({{ $order->id }})" style="width: 100%; padding: 16px; background-color: #EE403D; color: white; border: none; border-radius: 8px; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 16px; cursor: pointer; transition: all 0.3s;"
                            onmouseover="this.style.backgroundColor='#E32020'"
                            onmouseout="this.style.backgroundColor='#EE403D'">
                        Solicitar Devolución
                    </button>
                </div>
                @endforeach
            </div>
            @else
            <div style="text-align: center; padding: 60px 20px;">
                <div style="width: 80px; height: 80px; margin: 0 auto 24px; background-color: #F8F9FA; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#999" stroke-width="2">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
                <h3 style="font-size: 24px; color: #212529; margin-bottom: 12px; font-family: 'Jost', sans-serif;">No tienes pedidos</h3>
                <p style="color: #666; margin-bottom: 24px; font-family: 'Jost', sans-serif;">Aún no has realizado ninguna compra</p>
                <a href="{{ route('shop.index') }}" style="display: inline-block; background-color: #EE403D; color: white; padding: 14px 32px; border-radius: 8px; text-decoration: none; font-weight: 600; font-family: 'Jost', sans-serif;">
                    Ir a Comprar
                </a>
            </div>
            @endif
        </div>

        <!-- Step 2: Return Reason -->
        <div id="step2-content" style="display: none;">
            <h2 style="font-size: 28px; font-weight: 700; color: #212529; margin-bottom: 40px; font-family: 'Jost', sans-serif; text-align: center;">
                Cuéntanos el motivo de tu devolución
            </h2>

            <form id="returnForm" style="max-width: 700px; margin: 0 auto;">
                @csrf
                <input type="hidden" name="order_id" id="selectedOrderId">

                <div style="margin-bottom: 32px;">
                    <label style="display: block; font-weight: 600; color: #212529; margin-bottom: 16px; font-family: 'Jost', sans-serif; font-size: 16px;">Motivo de la devolución *</label>
                    <select name="reason" id="returnReason" required style="width: 100%; padding: 16px; border: 2px solid #E5E5E5; border-radius: 8px; font-family: 'Jost', sans-serif; font-size: 15px; background-color: white;">
                        <option value="">Selecciona un motivo</option>
                        <option value="defective">Producto defectuoso</option>
                        <option value="wrong_item">Producto incorrecto</option>
                        <option value="not_as_described">No es como se describe</option>
                        <option value="size_issue">Problema de talla</option>
                        <option value="changed_mind">Cambié de opinión</option>
                        <option value="other">Otro motivo</option>
                    </select>
                </div>

                <div style="margin-bottom: 32px;">
                    <label style="display: block; font-weight: 600; color: #212529; margin-bottom: 16px; font-family: 'Jost', sans-serif; font-size: 16px;">Describe el problema (opcional)</label>
                    <textarea name="description" id="returnDescription" rows="5" style="width: 100%; padding: 16px; border: 2px solid #E5E5E5; border-radius: 8px; font-family: 'Jost', sans-serif; font-size: 15px; resize: vertical;" placeholder="Cuéntanos más sobre el motivo de tu devolución..."></textarea>
                </div>

                <div style="background-color: #F8F9FA; padding: 24px; border-radius: 8px; margin-bottom: 32px; border-left: 4px solid #EE403D;">
                    <div style="font-size: 14px; color: #666; line-height: 1.8; font-family: 'Jost', sans-serif;">
                        <strong style="color: #212529; font-size: 16px; display: block; margin-bottom: 12px;">Política de Devolución:</strong>
                        • Tienes 30 días para devolver el producto<br>
                        • El producto debe estar sin usar y con etiquetas<br>
                        • El reembolso se procesará en 3-5 días hábiles
                    </div>
                </div>

                <div style="display: flex; gap: 16px;">
                    <button type="button" onclick="backToStep1()" style="flex: 1; padding: 16px; border: 2px solid #E5E5E5; background: white; color: #666; border-radius: 8px; font-weight: 600; font-family: 'Jost', sans-serif; cursor: pointer; font-size: 16px;">
                        ← Volver
                    </button>
                    <button type="button" onclick="goToStep3()" style="flex: 1; padding: 16px; border: none; background-color: #EE403D; color: white; border-radius: 8px; font-weight: 600; font-family: 'Jost', sans-serif; cursor: pointer; transition: all 0.3s; font-size: 16px;"
                            onmouseover="this.style.backgroundColor='#E32020'"
                            onmouseout="this.style.backgroundColor='#EE403D'">
                        Continuar →
                    </button>
                </div>
            </form>
        </div>

        <!-- Step 3: Confirmation -->
        <div id="step3-content" style="display: none;">
            <h2 style="font-size: 28px; font-weight: 700; color: #212529; margin-bottom: 40px; font-family: 'Jost', sans-serif; text-align: center;">
                Confirma tu solicitud de devolución
            </h2>

            <div style="max-width: 700px; margin: 0 auto;">
                <div style="background-color: #F8F9FA; border-radius: 12px; padding: 32px; margin-bottom: 32px;">
                    <h3 style="font-size: 18px; font-weight: 700; color: #212529; margin-bottom: 20px; font-family: 'Jost', sans-serif;">Resumen de tu devolución</h3>
                    
                    <div style="margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid #E5E5E5;">
                        <div style="color: #666; font-size: 14px; margin-bottom: 4px; font-family: 'Jost', sans-serif;">Pedido</div>
                        <div style="color: #212529; font-weight: 600; font-family: 'Jost', sans-serif;" id="confirmOrderNumber"></div>
                    </div>

                    <div style="margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid #E5E5E5;">
                        <div style="color: #666; font-size: 14px; margin-bottom: 4px; font-family: 'Jost', sans-serif;">Motivo</div>
                        <div style="color: #212529; font-weight: 600; font-family: 'Jost', sans-serif;" id="confirmReason"></div>
                    </div>

                    <div style="margin-bottom: 0;">
                        <div style="color: #666; font-size: 14px; margin-bottom: 4px; font-family: 'Jost', sans-serif;">Descripción</div>
                        <div style="color: #212529; font-weight: 600; font-family: 'Jost', sans-serif;" id="confirmDescription"></div>
                    </div>
                </div>

                <div style="background-color: #FEF2F2; padding: 24px; border-radius: 8px; margin-bottom: 32px;">
                    <p style="color: #666; line-height: 1.8; font-family: 'Jost', sans-serif; margin: 0;">
                        Al confirmar, el estado de tu pedido cambiará a <strong style="color: #9333EA;">"Devuelto"</strong> y nuestro equipo se pondrá en contacto contigo para coordinar la devolución del producto.
                    </p>
                </div>

                <div style="display: flex; gap: 16px;">
                    <button type="button" onclick="backToStep2()" style="flex: 1; padding: 16px; border: 2px solid #E5E5E5; background: white; color: #666; border-radius: 8px; font-weight: 600; font-family: 'Jost', sans-serif; cursor: pointer; font-size: 16px;">
                        ← Volver
                    </button>
                    <button type="button" onclick="submitReturn()" style="flex: 1; padding: 16px; border: none; background-color: #10B981; color: white; border-radius: 8px; font-weight: 600; font-family: 'Jost', sans-serif; cursor: pointer; transition: all 0.3s; font-size: 16px;"
                            onmouseover="this.style.backgroundColor='#059669'"
                            onmouseout="this.style.backgroundColor='#10B981'">
                        ✓ Confirmar Devolución
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>

@else
<!-- Not Logged In -->
<section style="padding: 80px 0; background-color: white;">
    <div style="max-width: 600px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <div style="width: 100px; height: 100px; margin: 0 auto 32px; background-color: #F8F9FA; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#999" stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
        </div>
        <h2 style="font-size: 32px; font-weight: 700; color: #212529; margin-bottom: 16px; font-family: 'Jost', sans-serif;">
            Inicia Sesión
        </h2>
        <p style="color: #666; margin-bottom: 32px; font-family: 'Jost', sans-serif; font-size: 16px;">
            Para solicitar una devolución, primero debes iniciar sesión en tu cuenta
        </p>
        <a href="{{ route('login') }}" style="display: inline-block; background-color: #EE403D; color: white; padding: 16px 40px; border-radius: 8px; text-decoration: none; font-weight: 600; font-family: 'Jost', sans-serif; transition: all 0.3s;"
           onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(238, 64, 61, 0.3)';"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            Iniciar Sesión
        </a>
    </div>
</section>
@endauth

@push('scripts')
<script>
let selectedOrder = null;
let orderData = {};

function selectOrderForReturn(orderId) {
    // Deselect all
    document.querySelectorAll('[id^="order-card-"]').forEach(el => {
        el.style.borderColor = '#E5E5E5';
        el.style.boxShadow = 'none';
    });
    
    // Select current
    const card = document.getElementById('order-card-' + orderId);
    card.style.borderColor = '#EE403D';
    card.style.boxShadow = '0 4px 16px rgba(238, 64, 61, 0.2)';
    
    selectedOrder = orderId;
}

function goToStep2(orderId) {
    if (!selectedOrder && orderId) {
        selectedOrder = orderId;
    }
    
    document.getElementById('selectedOrderId').value = selectedOrder;
    
    // Hide step 1, show step 2
    document.getElementById('step1-content').style.display = 'none';
    document.getElementById('step2-content').style.display = 'block';
    
    // Update progress
    updateStepIndicators(2);
    
    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function backToStep1() {
    document.getElementById('step2-content').style.display = 'none';
    document.getElementById('step1-content').style.display = 'block';
    updateStepIndicators(1);
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function goToStep3() {
    const reason = document.getElementById('returnReason').value;
    const description = document.getElementById('returnDescription').value;
    
    if (!reason) {
        alert('Por favor selecciona un motivo de devolución');
        return;
    }
    
    // Store data
    orderData.reason = reason;
    orderData.description = description;
    
    // Get reason text
    const reasonSelect = document.getElementById('returnReason');
    const reasonText = reasonSelect.options[reasonSelect.selectedIndex].text;
    
    // Update confirmation
    const orderCard = document.getElementById('order-card-' + selectedOrder);
    const orderNumber = orderCard.getAttribute('data-order-number');
    
    document.getElementById('confirmOrderNumber').textContent = 'Pedido #' + orderNumber;
    document.getElementById('confirmReason').textContent = reasonText;
    document.getElementById('confirmDescription').textContent = description || 'Sin descripción adicional';
    
    // Hide step 2, show step 3
    document.getElementById('step2-content').style.display = 'none';
    document.getElementById('step3-content').style.display = 'block';
    
    // Update progress
    updateStepIndicators(3);
    
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function backToStep2() {
    document.getElementById('step3-content').style.display = 'none';
    document.getElementById('step2-content').style.display = 'block';
    updateStepIndicators(2);
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function submitReturn() {
    const orderId = document.getElementById('selectedOrderId').value;
    const reason = document.getElementById('returnReason').value;
    const description = document.getElementById('returnDescription').value;
    
    if (!orderId) {
        alert('Error: No se ha seleccionado ningún pedido');
        return;
    }
    
    const formData = new FormData();
    formData.append('order_id', orderId);
    formData.append('reason', reason);
    formData.append('description', description);
    
    fetch('{{ route("returns.submit") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => Promise.reject(err));
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message);
            window.location.href = '{{ route("account") }}';
        } else {
            alert(data.message || 'Hubo un error al procesar tu solicitud');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(error.message || 'Hubo un error al procesar tu solicitud. Por favor, intenta de nuevo.');
    });
}

function updateStepIndicators(currentStep) {
    // Reset all
    for (let i = 1; i <= 3; i++) {
        const indicator = document.getElementById('step' + i + '-indicator');
        const text = document.getElementById('step' + i + '-text');
        
        if (i < currentStep) {
            // Completed
            indicator.style.backgroundColor = '#10B981';
            indicator.style.color = 'white';
            text.style.color = '#10B981';
            text.style.fontWeight = '600';
        } else if (i === currentStep) {
            // Active
            indicator.style.backgroundColor = '#EE403D';
            indicator.style.color = 'white';
            text.style.color = '#212529';
            text.style.fontWeight = '600';
        } else {
            // Inactive
            indicator.style.backgroundColor = '#E5E5E5';
            indicator.style.color = '#999';
            text.style.color = '#999';
            text.style.fontWeight = '400';
        }
    }
}
</script>
@endpush

@endsection
