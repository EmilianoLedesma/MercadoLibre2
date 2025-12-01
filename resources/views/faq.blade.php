@extends('layouts.app')

@section('title', 'Preguntas Frecuentes')

@section('content')
@include('layouts.navbar')

<!-- Hero Section -->
<section style="background-color: #F8F8F8; padding: 60px 0 40px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 40px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 42px; font-weight: 700; color: #212529; margin: 0; font-family: 'Jost', sans-serif;">
                Faq
            </h1>
            <div style="font-size: 14px; color: #999; font-family: 'Jost', sans-serif;">
                <a href="{{ route('home') }}" style="color: #999; text-decoration: none;">Home</a>
                <span style="margin: 0 8px;">›</span>
                <span style="color: #EE403D; font-weight: 600;">Faq</span>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Content -->
<section style="padding: 80px 0; background-color: white;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 40px;">
        
        <!-- FAQ Grid - 2 columnas -->
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
            
            <!-- FAQ Item 1 -->
            <div class="faq-item" style="border: 1px solid #E5E5E5; border-radius: 0; overflow: hidden; transition: all 0.3s;">
                <button onclick="toggleFAQ(this)" style="width: 100%; text-align: left; padding: 24px 28px; background: white; border: none; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 600; color: #212529; display: flex; justify-content: space-between; align-items: center; text-transform: uppercase; letter-spacing: 0.5px;">
                    <span>¿Cuánto tiempo tarda el envío?</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#212529" stroke-width="2.5" class="faq-icon" style="transition: transform 0.3s; flex-shrink: 0; margin-left: 16px;">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                    <div style="padding: 0 28px 24px; color: #666; line-height: 1.8; font-family: 'Jost', sans-serif; font-size: 14px;">
                        Los envíos dentro de la ciudad llegan en 24-48 horas. Para el interior del país, el tiempo de entrega es de 3-7 días hábiles dependiendo de la ubicación. Todos los envíos incluyen número de seguimiento.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="faq-item" style="border: 1px solid #E5E5E5; border-radius: 0; overflow: hidden; transition: all 0.3s;">
                <button onclick="toggleFAQ(this)" style="width: 100%; text-align: left; padding: 24px 28px; background: white; border: none; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 600; color: #212529; display: flex; justify-content: space-between; align-items: center; text-transform: uppercase; letter-spacing: 0.5px;">
                    <span>¿Cuál es la política de devolución?</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#212529" stroke-width="2.5" class="faq-icon" style="transition: transform 0.3s; flex-shrink: 0; margin-left: 16px;">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                    <div style="padding: 0 28px 24px; color: #666; line-height: 1.8; font-family: 'Jost', sans-serif; font-size: 14px;">
                        Aceptamos devoluciones dentro de los 30 días posteriores a la recepción del producto. El artículo debe estar sin usar, con etiquetas originales y en su empaque original. Visita nuestra página de <a href="{{ route('returns') }}" style="color: #EE403D; text-decoration: none; font-weight: 600;">Devoluciones</a> para iniciar el proceso.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="faq-item" style="border: 1px solid #E5E5E5; border-radius: 0; overflow: hidden; transition: all 0.3s;">
                <button onclick="toggleFAQ(this)" style="width: 100%; text-align: left; padding: 24px 28px; background: white; border: none; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 600; color: #212529; display: flex; justify-content: space-between; align-items: center; text-transform: uppercase; letter-spacing: 0.5px;">
                    <span>¿El envío tiene costo?</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#212529" stroke-width="2.5" class="faq-icon" style="transition: transform 0.3s; flex-shrink: 0; margin-left: 16px;">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                    <div style="padding: 0 28px 24px; color: #666; line-height: 1.8; font-family: 'Jost', sans-serif; font-size: 14px;">
                        ¡El envío es GRATIS en compras superiores a $100! Para compras menores, el costo de envío es de $15 dentro de la ciudad y $25 para el interior del país.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="faq-item" style="border: 1px solid #E5E5E5; border-radius: 0; overflow: hidden; transition: all 0.3s;">
                <button onclick="toggleFAQ(this)" style="width: 100%; text-align: left; padding: 24px 28px; background: white; border: none; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 600; color: #212529; display: flex; justify-content: space-between; align-items: center; text-transform: uppercase; letter-spacing: 0.5px;">
                    <span>¿Cuánto tarda el reembolso?</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#212529" stroke-width="2.5" class="faq-icon" style="transition: transform 0.3s; flex-shrink: 0; margin-left: 16px;">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                    <div style="padding: 0 28px 24px; color: #666; line-height: 1.8; font-family: 'Jost', sans-serif; font-size: 14px;">
                        Una vez recibido y verificado el producto, procesamos el reembolso en 3-5 días hábiles. El tiempo que tarde en reflejarse en tu cuenta depende de tu banco o método de pago, generalmente entre 5-10 días hábiles.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 5 -->
            <div class="faq-item" style="border: 1px solid #E5E5E5; border-radius: 0; overflow: hidden; transition: all 0.3s;">
                <button onclick="toggleFAQ(this)" style="width: 100%; text-align: left; padding: 24px 28px; background: white; border: none; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 600; color: #212529; display: flex; justify-content: space-between; align-items: center; text-transform: uppercase; letter-spacing: 0.5px;">
                    <span>¿Cómo puedo rastrear mi pedido?</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#212529" stroke-width="2.5" class="faq-icon" style="transition: transform 0.3s; flex-shrink: 0; margin-left: 16px;">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                    <div style="padding: 0 28px 24px; color: #666; line-height: 1.8; font-family: 'Jost', sans-serif; font-size: 14px;">
                        Una vez que tu pedido sea enviado, recibirás un email con el número de seguimiento. También puedes verificar el estado en la sección "Mis Pedidos" de tu cuenta o usar nuestra página de <a href="{{ route('track.order') }}" style="color: #EE403D; text-decoration: none; font-weight: 600;">Rastreo de Pedidos</a>.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 6 -->
            <div class="faq-item" style="border: 1px solid #E5E5E5; border-radius: 0; overflow: hidden; transition: all 0.3s;">
                <button onclick="toggleFAQ(this)" style="width: 100%; text-align: left; padding: 24px 28px; background: white; border: none; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 600; color: #212529; display: flex; justify-content: space-between; align-items: center; text-transform: uppercase; letter-spacing: 0.5px;">
                    <span>¿Qué métodos de pago aceptan?</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#212529" stroke-width="2.5" class="faq-icon" style="transition: transform 0.3s; flex-shrink: 0; margin-left: 16px;">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                    <div style="padding: 0 28px 24px; color: #666; line-height: 1.8; font-family: 'Jost', sans-serif; font-size: 14px;">
                        Aceptamos tarjetas de crédito y débito (Visa, Mastercard, American Express), MercadoPago, transferencia bancaria y pago contra entrega (solo en ciudad). También ofrecemos cuotas sin interés con tarjetas seleccionadas.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 7 -->
            <div class="faq-item" style="border: 1px solid #E5E5E5; border-radius: 0; overflow: hidden; transition: all 0.3s;">
                <button onclick="toggleFAQ(this)" style="width: 100%; text-align: left; padding: 24px 28px; background: white; border: none; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 600; color: #212529; display: flex; justify-content: space-between; align-items: center; text-transform: uppercase; letter-spacing: 0.5px;">
                    <span>¿Es seguro comprar en SEALS?</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#212529" stroke-width="2.5" class="faq-icon" style="transition: transform 0.3s; flex-shrink: 0; margin-left: 16px;">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                    <div style="padding: 0 28px 24px; color: #666; line-height: 1.8; font-family: 'Jost', sans-serif; font-size: 14px;">
                        ¡Absolutamente! Utilizamos encriptación SSL de 256 bits para proteger toda tu información. No almacenamos datos de tarjetas de crédito en nuestros servidores. Todos los pagos son procesados por plataformas certificadas y seguras.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 8 -->
            <div class="faq-item" style="border: 1px solid #E5E5E5; border-radius: 0; overflow: hidden; transition: all 0.3s;">
                <button onclick="toggleFAQ(this)" style="width: 100%; text-align: left; padding: 24px 28px; background: white; border: none; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 600; color: #212529; display: flex; justify-content: space-between; align-items: center; text-transform: uppercase; letter-spacing: 0.5px;">
                    <span>¿Necesito una cuenta para comprar?</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#212529" stroke-width="2.5" class="faq-icon" style="transition: transform 0.3s; flex-shrink: 0; margin-left: 16px;">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                    <div style="padding: 0 28px 24px; color: #666; line-height: 1.8; font-family: 'Jost', sans-serif; font-size: 14px;">
                        No es obligatorio, pero te recomendamos crear una cuenta para disfrutar de beneficios como: seguimiento de pedidos, historial de compras, lista de deseos, direcciones guardadas y acceso exclusivo a ofertas especiales.
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

@push('scripts')
<script>
function toggleFAQ(button) {
    const item = button.parentElement;
    const answer = item.querySelector('.faq-answer');
    const icon = button.querySelector('.faq-icon');
    const isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';
    
    // Toggle el actual
    if (isOpen) {
        answer.style.maxHeight = '0';
        icon.style.transform = 'rotate(0deg)';
        item.style.borderColor = '#E5E5E5';
    } else {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        icon.style.transform = 'rotate(45deg)';
        item.style.borderColor = '#212529';
    }
}
</script>
@endpush

@endsection
