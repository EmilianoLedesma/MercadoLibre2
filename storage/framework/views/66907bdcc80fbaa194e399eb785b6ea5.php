<!-- Newsletter Popup -->
<div id="newsletterPopup" class="newsletter-popup-overlay" style="display: none;">
    <div class="newsletter-popup">
        <button class="popup-close" onclick="closeNewsletterPopup()">
            <i class="fas fa-times"></i>
        </button>

        <!-- Contenido del formulario -->
        <div class="popup-content" id="popupFormContent">
            <div class="popup-icon">
                <i class="fas fa-envelope"></i>
            </div>

            <h2 class="popup-title">¡Suscríbete a nuestro Newsletter!</h2>
            <p class="popup-subtitle">Recibe ofertas exclusivas, nuevos productos y descuentos especiales directamente en tu correo.</p>

            <form action="#" method="POST" class="popup-form" onsubmit="subscribeNewsletter(event)">
                <?php echo csrf_field(); ?>
                <div class="popup-input-wrapper">
                    <input
                        type="text"
                        name="newsletter_name"
                        id="newsletter_name"
                        placeholder="Tu nombre"
                        required
                        class="popup-input"
                    >
                    <input
                        type="email"
                        name="newsletter_email"
                        id="newsletter_email"
                        placeholder="Tu correo electrónico"
                        required
                        class="popup-input"
                    >
                </div>

                <button type="submit" class="popup-submit">
                    Suscribirse
                </button>

                <label class="popup-checkbox">
                    <input type="checkbox" id="dontShowAgain">
                    <span>No volver a mostrar este mensaje</span>
                </label>
            </form>

            <p class="popup-disclaimer">
                Al suscribirte, aceptas nuestra <a href="#">Política de Privacidad</a>
            </p>
        </div>

        <!-- Contenido de éxito (inicialmente oculto) -->
        <div class="popup-success" id="popupSuccessContent" style="display: none;">
            <div class="success-animation">
                <div class="success-icon">
                    <div class="success-icon-circle">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
                <div class="success-confetti">
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                </div>
            </div>

            <h2 class="success-title">¡Suscripción Exitosa!</h2>
            <p class="success-message">
                Gracias por suscribirte, <strong id="successName"></strong>! <br>
                Te enviaremos las mejores ofertas a <strong id="successEmail"></strong>
            </p>

            <button class="success-button" onclick="closeNewsletterPopup()">
                Continuar
            </button>
        </div>
    </div>
</div>

<style>
.newsletter-popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.newsletter-popup-overlay.show {
    opacity: 1;
}

.newsletter-popup {
    background: white;
    border-radius: 16px;
    max-width: 500px;
    width: 100%;
    padding: 48px 40px;
    position: relative;
    transform: scale(0.9);
    transition: transform 0.3s ease;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

.newsletter-popup-overlay.show .newsletter-popup {
    transform: scale(1);
}

.popup-close {
    position: absolute;
    top: 16px;
    right: 16px;
    background: none;
    border: none;
    font-size: 24px;
    color: #999;
    cursor: pointer;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s;
}

.popup-close:hover {
    background-color: #F5F6F2;
    color: #EE403D;
}

.popup-content {
    text-align: center;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.popup-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #EE403D 0%, #E32020 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    color: white;
    font-size: 36px;
}

.popup-title {
    font-family: 'Jost', sans-serif;
    font-size: 28px;
    font-weight: 700;
    color: #212529;
    margin-bottom: 12px;
}

.popup-subtitle {
    font-family: 'Jost', sans-serif;
    font-size: 15px;
    color: #666;
    line-height: 1.6;
    margin-bottom: 32px;
}

.popup-form {
    margin-bottom: 16px;
}

.popup-input-wrapper {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 20px;
}

.popup-input {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #E5E5E5;
    border-radius: 8px;
    font-size: 15px;
    font-family: 'Jost', sans-serif;
    transition: border-color 0.3s;
}

.popup-input:focus {
    outline: none;
    border-color: #EE403D;
}

.popup-submit {
    width: 100%;
    padding: 14px 28px;
    background-color: #EE403D;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    font-family: 'Jost', sans-serif;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-bottom: 16px;
}

.popup-submit:hover {
    background-color: #E32020;
}

.popup-checkbox {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 14px;
    color: #666;
    cursor: pointer;
    font-family: 'Jost', sans-serif;
}

.popup-checkbox input {
    cursor: pointer;
}

.popup-disclaimer {
    font-size: 13px;
    color: #999;
    font-family: 'Jost', sans-serif;
}

.popup-disclaimer a {
    color: #EE403D;
    text-decoration: none;
}

.popup-disclaimer a:hover {
    text-decoration: underline;
}

/* Success State Styles */
.popup-success {
    text-align: center;
    opacity: 0;
    transform: scale(0.95);
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.success-animation {
    position: relative;
    margin-bottom: 32px;
}

.success-icon {
    position: relative;
    z-index: 2;
}

.success-icon-circle {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: white;
    font-size: 48px;
    animation: successIconPop 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
    box-shadow: 0 10px 40px rgba(16, 185, 129, 0.3);
}

.success-icon-circle i {
    animation: checkmarkDraw 0.3s 0.3s ease-out forwards;
    opacity: 0;
}

.success-title {
    font-family: 'Jost', sans-serif;
    font-size: 28px;
    font-weight: 700;
    color: #212529;
    margin-bottom: 16px;
    animation: fadeInUp 0.5s 0.2s ease-out backwards;
}

.success-message {
    font-family: 'Jost', sans-serif;
    font-size: 15px;
    color: #666;
    line-height: 1.8;
    margin-bottom: 32px;
    animation: fadeInUp 0.5s 0.3s ease-out backwards;
}

.success-message strong {
    color: #10b981;
}

.success-button {
    width: 100%;
    padding: 14px 28px;
    background-color: #10b981;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    font-family: 'Jost', sans-serif;
    cursor: pointer;
    transition: all 0.3s;
    animation: fadeInUp 0.5s 0.4s ease-out backwards;
}

.success-button:hover {
    background-color: #059669;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
}

/* Confetti Animation */
.success-confetti {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.confetti {
    position: absolute;
    width: 10px;
    height: 10px;
    background-color: #EE403D;
    top: 50%;
    left: 50%;
    opacity: 0;
    animation: confettiFall 1.5s ease-out forwards;
}

.confetti:nth-child(1) {
    background-color: #EE403D;
    animation-delay: 0.1s;
    transform: translate(-30px, 0) rotate(45deg);
}

.confetti:nth-child(2) {
    background-color: #FFD93D;
    animation-delay: 0.2s;
    transform: translate(30px, 0) rotate(-45deg);
}

.confetti:nth-child(3) {
    background-color: #10b981;
    animation-delay: 0.15s;
    transform: translate(-50px, -10px) rotate(90deg);
}

.confetti:nth-child(4) {
    background-color: #3b82f6;
    animation-delay: 0.25s;
    transform: translate(50px, -10px) rotate(-90deg);
}

.confetti:nth-child(5) {
    background-color: #a855f7;
    animation-delay: 0.3s;
    transform: translate(-40px, 20px) rotate(135deg);
}

.confetti:nth-child(6) {
    background-color: #ec4899;
    animation-delay: 0.2s;
    transform: translate(40px, 20px) rotate(-135deg);
}

.confetti:nth-child(7) {
    background-color: #f97316;
    animation-delay: 0.35s;
    transform: translate(-60px, 30px) rotate(180deg);
}

.confetti:nth-child(8) {
    background-color: #06b6d4;
    animation-delay: 0.4s;
    transform: translate(60px, 30px) rotate(225deg);
}

.confetti:nth-child(9) {
    background-color: #8b5cf6;
    animation-delay: 0.3s;
    transform: translate(-20px, -30px) rotate(270deg);
}

.confetti:nth-child(10) {
    background-color: #14b8a6;
    animation-delay: 0.45s;
    transform: translate(20px, -30px) rotate(315deg);
}

/* Animations */
@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes successIconPop {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes checkmarkDraw {
    to {
        opacity: 1;
    }
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

@keyframes confettiFall {
    0% {
        opacity: 1;
        transform: translate(var(--x, 0), var(--y, 0)) rotate(0deg);
    }
    100% {
        opacity: 0;
        transform: translate(calc(var(--x, 0) * 2), 150px) rotate(720deg);
    }
}

@media (max-width: 576px) {
    .newsletter-popup {
        padding: 32px 24px;
    }

    .popup-title {
        font-size: 24px;
    }

    .popup-icon {
        width: 64px;
        height: 64px;
        font-size: 28px;
    }

    .success-icon-circle {
        width: 80px;
        height: 80px;
        font-size: 36px;
    }

    .success-title {
        font-size: 24px;
    }
}
</style>

<script>
// Show popup after 3 seconds if not dismissed before
window.addEventListener('load', function() {
    const popupDismissed = localStorage.getItem('newsletterPopupDismissed');

    if (!popupDismissed) {
        setTimeout(function() {
            showNewsletterPopup();
        }, 3000);
    }
});

function showNewsletterPopup() {
    const popup = document.getElementById('newsletterPopup');
    popup.style.display = 'flex';
    setTimeout(() => {
        popup.classList.add('show');
    }, 10);
}

function closeNewsletterPopup() {
    const popup = document.getElementById('newsletterPopup');
    const dontShowAgain = document.getElementById('dontShowAgain');

    popup.classList.remove('show');
    setTimeout(() => {
        popup.style.display = 'none';

        // Resetear el modal a su estado inicial
        setTimeout(() => {
            const formContent = document.getElementById('popupFormContent');
            const successContent = document.getElementById('popupSuccessContent');

            formContent.style.display = 'block';
            formContent.style.opacity = '1';
            formContent.style.transform = 'scale(1)';

            successContent.style.display = 'none';
            successContent.style.opacity = '0';
            successContent.style.transform = 'scale(0.95)';

            // Limpiar el formulario
            document.getElementById('newsletter_name').value = '';
            document.getElementById('newsletter_email').value = '';
            if (dontShowAgain) dontShowAgain.checked = false;
        }, 300);
    }, 300);

    if (dontShowAgain && dontShowAgain.checked) {
        localStorage.setItem('newsletterPopupDismissed', 'true');
    }
}

function subscribeNewsletter(event) {
    event.preventDefault();

    const name = document.getElementById('newsletter_name').value;
    const email = document.getElementById('newsletter_email').value;

    // Aquí puedes agregar la lógica para enviar el nombre y email al servidor
    // Por ahora solo mostramos un mensaje de éxito

    // Ocultar el formulario y mostrar el mensaje de éxito
    const formContent = document.getElementById('popupFormContent');
    const successContent = document.getElementById('popupSuccessContent');

    // Actualizar los datos en el mensaje de éxito
    document.getElementById('successName').textContent = name;
    document.getElementById('successEmail').textContent = email;

    // Transición suave
    formContent.style.opacity = '0';
    formContent.style.transform = 'scale(0.95)';

    setTimeout(() => {
        formContent.style.display = 'none';
        successContent.style.display = 'block';

        // Trigger animation
        setTimeout(() => {
            successContent.style.opacity = '1';
            successContent.style.transform = 'scale(1)';
        }, 10);
    }, 300);

    // Guardar que ya se suscribió
    localStorage.setItem('newsletterPopupDismissed', 'true');
}

// Close popup when clicking outside
document.addEventListener('click', function(event) {
    const popup = document.getElementById('newsletterPopup');
    if (event.target === popup) {
        closeNewsletterPopup();
    }
});

// Close popup with ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const popup = document.getElementById('newsletterPopup');
        if (popup.classList.contains('show')) {
            closeNewsletterPopup();
        }
    }
});
</script>
<?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views/components/newsletter-popup.blade.php ENDPATH**/ ?>