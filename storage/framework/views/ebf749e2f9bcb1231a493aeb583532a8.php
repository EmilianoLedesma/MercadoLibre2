<?php $__env->startSection('title', 'Checkout'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .checkout-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .checkout-title {
        font-family: 'Jost', sans-serif;
        font-size: 36px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 40px;
        text-align: center;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 40px;
    }

    /* Checkout Form */
    .checkout-form {
        background: white;
        border: 1px solid #E5E5E5;
        border-radius: 8px;
        padding: 32px;
    }

    .form-section {
        margin-bottom: 32px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-family: 'Jost', sans-serif;
        font-size: 20px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #E5E5E5;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-family: 'Jost', sans-serif;
        font-size: 14px;
        font-weight: 500;
        color: #212529;
        margin-bottom: 8px;
    }

    .form-group label span {
        color: #EE403D;
    }

    .form-control {
        padding: 12px 16px;
        border: 1px solid #E5E5E5;
        border-radius: 4px;
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        color: #212529;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: #EE403D;
    }

    .form-control.error {
        border-color: #EE403D;
    }

    .error-message {
        font-family: 'Jost', sans-serif;
        font-size: 13px;
        color: #EE403D;
        margin-top: 6px;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .payment-methods {
        display: grid;
        gap: 12px;
    }

    .payment-option {
        display: flex;
        align-items: center;
        padding: 16px;
        border: 2px solid #E5E5E5;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .payment-option:hover {
        border-color: #EE403D;
        background-color: #FFF5F5;
    }

    .payment-option input[type="radio"] {
        margin-right: 12px;
        accent-color: #EE403D;
    }

    .payment-option label {
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        font-weight: 500;
        color: #212529;
        cursor: pointer;
        margin: 0;
    }

    /* Order Summary */
    .order-summary {
        background: white;
        border: 1px solid #E5E5E5;
        border-radius: 8px;
        padding: 32px;
        height: fit-content;
        position: sticky;
        top: 120px;
    }

    .summary-title {
        font-family: 'Jost', sans-serif;
        font-size: 24px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #E5E5E5;
    }

    .summary-items {
        max-height: 300px;
        overflow-y: auto;
        margin-bottom: 24px;
    }

    .summary-item {
        display: flex;
        gap: 12px;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 1px solid #F5F6F2;
    }

    .summary-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .summary-item-image {
        width: 60px;
        height: 75px;
        background-color: #F5F6F2;
        border-radius: 4px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .summary-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .summary-item-details {
        flex: 1;
    }

    .summary-item-name {
        font-family: 'Jost', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 4px;
    }

    .summary-item-qty {
        font-family: 'Jost', sans-serif;
        font-size: 13px;
        color: #666;
    }

    .summary-item-price {
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: #EE403D;
        text-align: right;
    }

    .summary-totals {
        padding-top: 24px;
        border-top: 2px solid #E5E5E5;
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
        border-top: 1px solid #E5E5E5;
        font-family: 'Jost', sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: #212529;
    }

    .summary-total span:last-child {
        color: #EE403D;
    }

    .place-order-btn {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #EE403D 0%, #E32020 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-family: 'Jost', sans-serif;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 24px;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(238, 64, 61, 0.25);
        position: relative;
        overflow: hidden;
    }

    .place-order-btn:hover {
        background: linear-gradient(135deg, #E32020 0%, #D11A1A 100%);
        box-shadow: 0 6px 16px rgba(238, 64, 61, 0.35);
        transform: translateY(-2px);
    }

    .place-order-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(238, 64, 61, 0.2);
    }

    .place-order-btn:disabled {
        background: linear-gradient(135deg, #999 0%, #888 100%);
        cursor: not-allowed;
        box-shadow: none;
        transform: none;
    }

    .back-to-cart {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        text-align: center;
        margin-top: 12px;
        padding: 12px;
        color: #666;
        text-decoration: none;
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .back-to-cart:hover {
        color: #EE403D;
        background-color: #FEF3F2;
    }
        font-size: 15px;
        transition: color 0.3s;
    }

    .back-to-cart {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        text-align: center;
        margin-top: 12px;
        padding: 12px;
        color: #666;
        text-decoration: none;
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .back-to-cart:hover {
        color: #EE403D;
        background-color: #FEF3F2;
    }

    @media (max-width: 968px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .order-summary {
            position: static;
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
            <span style="color: #212529; font-weight: 500;">Checkout</span>
        </nav>
    </div>
</div>

<!-- CHECKOUT CONTAINER -->
<div class="checkout-container">
    <h1 class="checkout-title">Finalizar Compra</h1>

    <form action="<?php echo e(route('checkout.store')); ?>" method="POST" id="checkoutForm">
        <?php echo csrf_field(); ?>
        <div class="checkout-grid">
            <!-- Checkout Form -->
            <div class="checkout-form">
                <!-- Billing Information -->
                <div class="form-section">
                    <h2 class="section-title">Información de Facturación</h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">Nombre <span>*</span></label>
                            <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo e(old('first_name', $userInfo['name'] ?? '')); ?>" required>
                            <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error-message"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellido <span>*</span></label>
                            <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo e(old('last_name', $userInfo['last_name'] ?? '')); ?>" required>
                            <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error-message"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="email">Correo Electrónico <span>*</span></label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo e(old('email', $userInfo['email'] ?? '')); ?>" required>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="phone">Teléfono <span>*</span></label>
                        <input type="tel" id="phone" name="phone" class="form-control" value="<?php echo e(old('phone', $userInfo['phone'] ?? '')); ?>" required>
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="address">Dirección <span>*</span></label>
                        <input type="text" id="address" name="address" class="form-control" value="<?php echo e(old('address', $defaultAddress['address'] ?? '')); ?>" placeholder="Calle y número" required>
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">Ciudad <span>*</span></label>
                            <input type="text" id="city" name="city" class="form-control" value="<?php echo e(old('city', $defaultAddress['city'] ?? '')); ?>" required>
                            <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error-message"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="state">Estado <span>*</span></label>
                            <input type="text" id="state" name="state" class="form-control" value="<?php echo e(old('state', $defaultAddress['state'] ?? '')); ?>" required>
                            <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error-message"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="postal_code">Código Postal <span>*</span></label>
                            <input type="text" id="postal_code" name="postal_code" class="form-control" value="<?php echo e(old('postal_code', $defaultAddress['postal_code'] ?? '')); ?>" required>
                            <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error-message"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="country">País <span>*</span></label>
                            <input type="text" id="country" name="country" class="form-control" value="<?php echo e(old('country', $defaultAddress['country'] ?? 'México')); ?>" required>
                            <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error-message"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Additional Notes -->
                <div class="form-section">
                    <h2 class="section-title">Notas del Pedido (Opcional)</h2>
                    <div class="form-group">
                        <label for="notes">Comentarios especiales o instrucciones de entrega</label>
                        <textarea id="notes" name="notes" class="form-control" placeholder="Ej: Dejar el paquete con el portero"><?php echo e(old('notes')); ?></textarea>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="form-section">
                    <h2 class="section-title">Método de Pago</h2>
                    <div class="payment-methods">
                        <div class="payment-option">
                            <input type="radio" id="payment_cash" name="payment_method" value="cash" checked>
                            <label for="payment_cash">Pago contra entrega</label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" id="payment_card" name="payment_method" value="card">
                            <label for="payment_card">Tarjeta de Crédito/Débito</label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" id="payment_transfer" name="payment_method" value="transfer">
                            <label for="payment_transfer">Transferencia Bancaria</label>
                        </div>
                    </div>
                    <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-message"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <h3 class="summary-title">Tu Pedido</h3>

                <div class="summary-items">
                    <?php
                        $cart = session()->get('cart', []);
                        $subtotal = 0;
                    ?>

                    <?php $__empty_1 = true; $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $itemTotal = $item['price'] * $item['quantity'];
                            $subtotal += $itemTotal;
                        ?>
                        <div class="summary-item">
                            <div class="summary-item-image">
                                <img src="<?php echo e($item['image'] ?? 'https://via.placeholder.com/60x75'); ?>" alt="<?php echo e($item['name']); ?>">
                            </div>
                            <div class="summary-item-details">
                                <div class="summary-item-name"><?php echo e($item['name']); ?></div>
                                <div class="summary-item-qty">Cantidad: <?php echo e($item['quantity']); ?></div>
                            </div>
                            <div class="summary-item-price">$<?php echo e(number_format($itemTotal, 2)); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p style="text-align: center; color: #666; font-family: 'Jost', sans-serif;">Tu carrito está vacío</p>
                    <?php endif; ?>
                </div>

                <?php if(count($cart) > 0): ?>
                    <div class="summary-totals">
                        <?php
                            $shipping = $subtotal >= 100 ? 0 : 15;
                            $tax = $subtotal * 0.10;
                            $total = $subtotal + $shipping + $tax;
                        ?>

                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>$<?php echo e(number_format($subtotal, 2)); ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Envío</span>
                            <span><?php echo e($shipping == 0 ? 'Gratis' : '$' . number_format($shipping, 2)); ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Impuestos (10%)</span>
                            <span>$<?php echo e(number_format($tax, 2)); ?></span>
                        </div>

                        <div class="summary-total">
                            <span>Total</span>
                            <span>$<?php echo e(number_format($total, 2)); ?></span>
                        </div>

                        <button type="submit" class="place-order-btn">
                            Realizar Pedido
                        </button>
                        <a href="<?php echo e(route('cart')); ?>" class="back-to-cart">
                            <i class="fas fa-arrow-left"></i> Volver al Carrito
                        </a>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('shop.index')); ?>" class="place-order-btn" style="text-decoration: none; text-align: center; display: block;">
                        Ir a la Tienda
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>

<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Form validation feedback
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('error');
                isValid = false;
            } else {
                field.classList.remove('error');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Por favor completa todos los campos requeridos');
        }
    });

    // Remove error class on input
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('error');
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views/checkout.blade.php ENDPATH**/ ?>