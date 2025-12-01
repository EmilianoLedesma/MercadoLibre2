@extends('layouts.app')

@section('title', 'Checkout')

@push('styles')
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

    .card-details {
        display: none;
        margin-top: 24px;
        padding: 24px;
        background-color: #F8F9FA;
        border-radius: 8px;
        border: 1px solid #E5E5E5;
    }

    .card-details.active {
        display: block;
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card-icon {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 8px;
        color: #666;
        font-size: 24px;
    }

    .card-number-wrapper {
        position: relative;
    }

    .card-brand-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 24px;
        color: #666;
    }

    .cvv-info {
        font-size: 12px;
        color: #666;
        margin-top: 4px;
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
        background-color: #F8F9FA;
        border-radius: 4px;
        overflow: hidden;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 6px;
    }

    .summary-item-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
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
            <span style="color: #212529; font-weight: 500;">Checkout</span>
        </nav>
    </div>
</div>

<!-- CHECKOUT CONTAINER -->
<div class="checkout-container">
    <h1 class="checkout-title">Finalizar Compra</h1>

    <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
        @csrf
        <div class="checkout-grid">
            <!-- Checkout Form -->
            <div class="checkout-form">
                <!-- Billing Information -->
                <div class="form-section">
                    <h2 class="section-title">Información de Facturación</h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">Nombre <span>*</span></label>
                            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', $userInfo['name'] ?? '') }}" required>
                            @error('first_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellido <span>*</span></label>
                            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', $userInfo['last_name'] ?? '') }}" required>
                            @error('last_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="email">Correo Electrónico <span>*</span></label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $userInfo['email'] ?? '') }}" required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="phone">Teléfono <span>*</span></label>
                        <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone', $userInfo['phone'] ?? '') }}" required>
                        @error('phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="address">Dirección <span>*</span></label>
                        <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $defaultAddress['address'] ?? '') }}" placeholder="Calle y número" required>
                        @error('address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">Ciudad <span>*</span></label>
                            <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $defaultAddress['city'] ?? '') }}" required>
                            @error('city')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="state">Estado <span>*</span></label>
                            <input type="text" id="state" name="state" class="form-control" value="{{ old('state', $defaultAddress['state'] ?? '') }}" required>
                            @error('state')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="postal_code">Código Postal <span>*</span></label>
                            <input type="text" id="postal_code" name="postal_code" class="form-control" value="{{ old('postal_code', $defaultAddress['postal_code'] ?? '') }}" required>
                            @error('postal_code')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="country">País <span>*</span></label>
                            <input type="text" id="country" name="country" class="form-control" value="{{ old('country', $defaultAddress['country'] ?? 'México') }}" required>
                            @error('country')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Additional Notes -->
                <div class="form-section">
                    <h2 class="section-title">Notas del Pedido (Opcional)</h2>
                    <div class="form-group">
                        <label for="notes">Comentarios especiales o instrucciones de entrega</label>
                        <textarea id="notes" name="notes" class="form-control" placeholder="Ej: Dejar el paquete con el portero">{{ old('notes') }}</textarea>
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
                    @error('payment_method')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                    <!-- Card Details Section -->
                    <div class="card-details" id="cardDetails">
                        <h3 style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 600; color: #212529; margin-bottom: 20px;">
                            Información de la Tarjeta
                        </h3>

                        <div class="form-group" style="margin-bottom: 20px;">
                            <label for="card_name">Nombre del Titular <span>*</span></label>
                            <input type="text" id="card_name" name="card_name" class="form-control card-field" placeholder="Nombre como aparece en la tarjeta" value="{{ old('card_name') }}">
                            <span class="error-message" id="card_name_error" style="display: none;"></span>
                        </div>

                        <div class="form-group" style="margin-bottom: 20px;">
                            <label for="card_number">Número de Tarjeta <span>*</span></label>
                            <div class="card-number-wrapper">
                                <input type="text" id="card_number" name="card_number" class="form-control card-field" placeholder="1234 5678 9012 3456" maxlength="19" value="{{ old('card_number') }}">
                                <span class="card-brand-icon" id="cardBrandIcon"></span>
                            </div>
                            <span class="error-message" id="card_number_error" style="display: none;"></span>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="card_expiry">Fecha de Expiración <span>*</span></label>
                                <input type="text" id="card_expiry" name="card_expiry" class="form-control card-field" placeholder="MM/AA" maxlength="5" value="{{ old('card_expiry') }}">
                                <span class="error-message" id="card_expiry_error" style="display: none;"></span>
                            </div>
                            <div class="form-group">
                                <label for="card_cvv">CVV <span>*</span></label>
                                <input type="text" id="card_cvv" name="card_cvv" class="form-control card-field" placeholder="123" maxlength="4" value="{{ old('card_cvv') }}">
                                <div class="cvv-info">
                                    <i class="fas fa-info-circle"></i> 3 o 4 dígitos en el reverso
                                </div>
                                <span class="error-message" id="card_cvv_error" style="display: none;"></span>
                            </div>
                        </div>

                        <div class="card-icon">
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                            <i class="fab fa-cc-amex"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <h3 class="summary-title">Tu Pedido</h3>

                <div class="summary-items">
                    @php
                        $cart = session()->get('cart', []);
                        $subtotal = 0;
                    @endphp

                    @forelse($cart as $id => $item)
                        @php
                            $itemTotal = $item['price'] * $item['quantity'];
                            $subtotal += $itemTotal;
                        @endphp
                        <div class="summary-item">
                            <div class="summary-item-image">
                                <img src="{{ $item['image'] ?? asset('images/placeholder-product.svg') }}" alt="{{ $item['name'] }}">
                            </div>
                            <div class="summary-item-details">
                                <div class="summary-item-name">{{ $item['name'] }}</div>
                                <div class="summary-item-qty">Cantidad: {{ $item['quantity'] }}</div>
                            </div>
                            <div class="summary-item-price">${{ number_format($itemTotal, 2) }}</div>
                        </div>
                    @empty
                        <p style="text-align: center; color: #666; font-family: 'Jost', sans-serif;">Tu carrito está vacío</p>
                    @endforelse
                </div>

                @if(count($cart) > 0)
                    <div class="summary-totals">
                        @php
                            $shipping = $subtotal >= 100 ? 0 : 15;
                            $tax = $subtotal * 0.10;
                            $total = $subtotal + $shipping + $tax;
                        @endphp

                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Envío</span>
                            <span>{{ $shipping == 0 ? 'Gratis' : '$' . number_format($shipping, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Impuestos (10%)</span>
                            <span>${{ number_format($tax, 2) }}</span>
                        </div>

                        <div class="summary-total">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>

                        <button type="submit" class="place-order-btn">
                            Realizar Pedido
                        </button>
                        <a href="{{ route('cart') }}" class="back-to-cart">
                            <i class="fas fa-arrow-left"></i> Volver al Carrito
                        </a>
                    </div>
                @else
                    <a href="{{ route('shop.index') }}" class="place-order-btn" style="text-decoration: none; text-align: center; display: block;">
                        Ir a la Tienda
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>


@push('scripts')
<script>
    // Toggle card details visibility
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const cardDetails = document.getElementById('cardDetails');
    const cardFields = document.querySelectorAll('.card-field');

    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            if (this.value === 'card') {
                cardDetails.classList.add('active');
                // Make card fields required
                cardFields.forEach(field => field.setAttribute('required', 'required'));
            } else {
                cardDetails.classList.remove('active');
                // Remove required from card fields
                cardFields.forEach(field => {
                    field.removeAttribute('required');
                    field.classList.remove('error');
                });
                // Clear error messages
                clearCardErrors();
            }
        });
    });

    // Card number formatting and validation
    const cardNumberInput = document.getElementById('card_number');
    const cardBrandIcon = document.getElementById('cardBrandIcon');

    cardNumberInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\s/g, '');
        let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
        e.target.value = formattedValue;

        // Detect card brand
        detectCardBrand(value);

        // Validate card number
        if (value.length > 0) {
            validateCardNumber(value);
        }
    });

    function detectCardBrand(number) {
        const brands = {
            visa: /^4/,
            mastercard: /^5[1-5]/,
            amex: /^3[47]/,
            discover: /^6(?:011|5)/
        };

        let brand = '';
        for (let key in brands) {
            if (brands[key].test(number)) {
                brand = key;
                break;
            }
        }

        switch(brand) {
            case 'visa':
                cardBrandIcon.innerHTML = '<i class="fab fa-cc-visa" style="color: #1A1F71;"></i>';
                break;
            case 'mastercard':
                cardBrandIcon.innerHTML = '<i class="fab fa-cc-mastercard" style="color: #EB001B;"></i>';
                break;
            case 'amex':
                cardBrandIcon.innerHTML = '<i class="fab fa-cc-amex" style="color: #006FCF;"></i>';
                break;
            case 'discover':
                cardBrandIcon.innerHTML = '<i class="fab fa-cc-discover" style="color: #FF6000;"></i>';
                break;
            default:
                cardBrandIcon.innerHTML = '';
        }
    }

    function validateCardNumber(number) {
        // Luhn algorithm
        let sum = 0;
        let isEven = false;
        
        for (let i = number.length - 1; i >= 0; i--) {
            let digit = parseInt(number.charAt(i));
            
            if (isEven) {
                digit *= 2;
                if (digit > 9) {
                    digit -= 9;
                }
            }
            
            sum += digit;
            isEven = !isEven;
        }
        
        const isValid = (sum % 10 === 0) && number.length >= 13 && number.length <= 19;
        
        if (!isValid && number.length >= 13) {
            showCardError('card_number', 'Número de tarjeta inválido');
            return false;
        } else {
            hideCardError('card_number');
            return true;
        }
    }

    // Card expiry formatting and validation
    const cardExpiryInput = document.getElementById('card_expiry');
    
    cardExpiryInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        if (value.length >= 2) {
            value = value.slice(0, 2) + '/' + value.slice(2, 4);
        }
        
        e.target.value = value;

        if (value.length === 5) {
            validateCardExpiry(value);
        }
    });

    function validateCardExpiry(expiry) {
        const parts = expiry.split('/');
        if (parts.length !== 2) {
            showCardError('card_expiry', 'Formato inválido (MM/AA)');
            return false;
        }

        const month = parseInt(parts[0]);
        const year = parseInt('20' + parts[1]);
        const now = new Date();
        const currentYear = now.getFullYear();
        const currentMonth = now.getMonth() + 1;

        if (month < 1 || month > 12) {
            showCardError('card_expiry', 'Mes inválido');
            return false;
        }

        if (year < currentYear || (year === currentYear && month < currentMonth)) {
            showCardError('card_expiry', 'Tarjeta expirada');
            return false;
        }

        hideCardError('card_expiry');
        return true;
    }

    // CVV validation
    const cardCvvInput = document.getElementById('card_cvv');
    
    cardCvvInput.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '');
        
        if (e.target.value.length >= 3) {
            validateCVV(e.target.value);
        }
    });

    function validateCVV(cvv) {
        if (cvv.length < 3 || cvv.length > 4) {
            showCardError('card_cvv', 'CVV debe tener 3 o 4 dígitos');
            return false;
        }
        hideCardError('card_cvv');
        return true;
    }

    // Card name validation
    const cardNameInput = document.getElementById('card_name');
    
    cardNameInput.addEventListener('blur', function() {
        if (this.value.trim().length < 3) {
            showCardError('card_name', 'Ingrese el nombre completo del titular');
            return false;
        }
        hideCardError('card_name');
        return true;
    });

    // Helper functions for error display
    function showCardError(fieldId, message) {
        const field = document.getElementById(fieldId);
        const errorSpan = document.getElementById(fieldId + '_error');
        
        field.classList.add('error');
        errorSpan.textContent = message;
        errorSpan.style.display = 'block';
    }

    function hideCardError(fieldId) {
        const field = document.getElementById(fieldId);
        const errorSpan = document.getElementById(fieldId + '_error');
        
        field.classList.remove('error');
        errorSpan.style.display = 'none';
    }

    function clearCardErrors() {
        const errorFields = ['card_name', 'card_number', 'card_expiry', 'card_cvv'];
        errorFields.forEach(field => hideCardError(field));
    }

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

        // Additional validation for card fields if card payment is selected
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked').value;
        if (selectedPayment === 'card') {
            const cardNumber = document.getElementById('card_number').value.replace(/\s/g, '');
            const cardExpiry = document.getElementById('card_expiry').value;
            const cardCvv = document.getElementById('card_cvv').value;
            const cardName = document.getElementById('card_name').value;

            if (!validateCardNumber(cardNumber)) {
                isValid = false;
            }
            if (!validateCardExpiry(cardExpiry)) {
                isValid = false;
            }
            if (!validateCVV(cardCvv)) {
                isValid = false;
            }
            if (cardName.trim().length < 3) {
                showCardError('card_name', 'Ingrese el nombre completo del titular');
                isValid = false;
            }
        }

        if (!isValid) {
            e.preventDefault();
            alert('Por favor completa todos los campos requeridos correctamente');
        }
    });

    // Remove error class on input
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('error');
        });
    });
</script>
@endpush
@endsection
