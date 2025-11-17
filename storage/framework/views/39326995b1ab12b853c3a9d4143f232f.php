<?php $__env->startSection('title', 'Pedido Confirmado'); ?>

<?php $__env->startPush('styles'); ?>
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
        width: 60px;
        height: 75px;
        background-color: #F5F6F2;
        border-radius: 4px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
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
        gap: 20px;
        justify-content: center;
        margin-top: 40px;
    }

    .btn {
        padding: 16px 40px;
        border-radius: 12px;
        font-family: 'Jost', sans-serif;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #EE403D 0%, #E32020 100%);
        color: white;
        border: none;
        box-shadow: 0 6px 20px rgba(238, 64, 61, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #E32020 0%, #D11A1A 100%);
        box-shadow: 0 8px 25px rgba(238, 64, 61, 0.4);
        transform: translateY(-3px);
    }

    .btn-primary:active {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(238, 64, 61, 0.3);
    }

    .btn-secondary {
        background: white;
        color: #212529;
        border: 2px solid #E5E5E5;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .btn-secondary:hover {
        border-color: #EE403D;
        color: #EE403D;
        background: #FEF3F2;
        box-shadow: 0 6px 20px rgba(238, 64, 61, 0.15);
        transform: translateY(-3px);
    }

    .btn-secondary:active {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(238, 64, 61, 0.1);
    }

    .btn i {
        font-size: 18px;
        transition: transform 0.3s ease;
    }

    .btn-primary:hover i {
        transform: scale(1.1);
    }

    .btn-secondary:hover i {
        transform: translateX(5px);
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- BREADCRUMB -->
<div style="background-color: #F8F8F8; padding: 20px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <nav style="font-family: 'Jost', sans-serif; font-size: 14px; color: #666;">
            <a href="<?php echo e(route('home')); ?>" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="margin: 0 8px;">/</span>
            <a href="<?php echo e(route('cart')); ?>" style="color: #666; text-decoration: none;">Carrito</a>
            <span style="margin: 0 8px;">/</span>
            <a href="<?php echo e(route('checkout.index')); ?>" style="color: #666; text-decoration: none;">Checkout</a>
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
        <p class="order-number">Número de Pedido: <?php echo e($order->order_number); ?></p>
    </div>

    <!-- Order Details -->
    <div class="order-details">
        <!-- Customer Information -->
        <div class="details-section">
            <h2 class="section-title">Información de Envío</h2>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Nombre Completo</div>
                    <div class="info-value"><?php echo e($order->shipping_first_name); ?> <?php echo e($order->shipping_last_name); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Correo Electrónico</div>
                    <div class="info-value"><?php echo e($order->shipping_email); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Teléfono</div>
                    <div class="info-value"><?php echo e($order->shipping_phone); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Dirección</div>
                    <div class="info-value"><?php echo e($order->shipping_address); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Ciudad</div>
                    <div class="info-value"><?php echo e($order->shipping_city); ?>, <?php echo e($order->shipping_state); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Código Postal</div>
                    <div class="info-value"><?php echo e($order->shipping_postal_code); ?></div>
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
                        <?php if($order->payment_method == 'cash'): ?>
                            Pago contra entrega
                        <?php elseif($order->payment_method == 'card'): ?>
                            Tarjeta de Crédito/Débito
                        <?php elseif($order->payment_method == 'transfer'): ?>
                            Transferencia Bancaria
                        <?php endif; ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Estado del Pago</div>
                    <div class="info-value">
                        <?php if($order->payment_status == 'pending'): ?>
                            Pendiente
                        <?php elseif($order->payment_status == 'paid'): ?>
                            Pagado
                        <?php elseif($order->payment_status == 'failed'): ?>
                            Fallido
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="details-section">
            <h2 class="section-title">Productos Pedidos</h2>
            <div class="order-items">
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="order-item">
                        <div class="item-image">
                            <?php
                                $images = is_string($item->product->images) ? json_decode($item->product->images, true) : $item->product->images;
                                $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
                            ?>
                            <?php if($firstImage): ?>
                                <img src="<?php echo e(asset('storage/' . $firstImage)); ?>" alt="<?php echo e($item->product->name); ?>">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/60x75" alt="<?php echo e($item->product->name); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="item-details">
                            <div class="item-name"><?php echo e($item->product->name); ?></div>
                            <div class="item-qty">Cantidad: <?php echo e($item->quantity); ?> × $<?php echo e(number_format($item->price, 2)); ?></div>
                        </div>
                        <div class="item-price">$<?php echo e(number_format($item->subtotal, 2)); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>$<?php echo e(number_format($order->subtotal, 2)); ?></span>
                </div>
                <div class="summary-row">
                    <span>Envío</span>
                    <span><?php echo e($order->shipping_cost == 0 ? 'Gratis' : '$' . number_format($order->shipping_cost, 2)); ?></span>
                </div>
                <div class="summary-row">
                    <span>Impuestos</span>
                    <span>$<?php echo e(number_format($order->tax, 2)); ?></span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span>$<?php echo e(number_format($order->total, 2)); ?></span>
                </div>
            </div>
        </div>

        <?php if($order->notes): ?>
            <div class="details-section">
                <h2 class="section-title">Notas del Pedido</h2>
                <p style="font-family: 'Jost', sans-serif; color: #666; line-height: 1.6;"><?php echo e($order->notes); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="<?php echo e(route('shop.index')); ?>" class="btn btn-primary">
            <i class="fas fa-shopping-bag"></i>
            Continuar Comprando
        </a>
        <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('account')); ?>" class="btn btn-secondary">
                Ver Mis Pedidos
                <i class="fas fa-arrow-right"></i>
            </a>
        <?php endif; ?>
    </div>
</div>

<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views/checkout/confirmation.blade.php ENDPATH**/ ?>