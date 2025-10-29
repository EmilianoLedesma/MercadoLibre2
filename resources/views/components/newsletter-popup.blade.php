<!-- Newsletter Popup -->
<div id="newsletterPopup" class="newsletter-popup-overlay" style="display: none;">
    <div class="newsletter-popup">
        <button class="popup-close" onclick="closeNewsletterPopup()">
            <i class="fas fa-times"></i>
        </button>

        <div class="popup-content">
            <div class="popup-icon">
                <i class="fas fa-envelope"></i>
            </div>

            <h2 class="popup-title">¡Suscríbete a nuestro Newsletter!</h2>
            <p class="popup-subtitle">Recibe ofertas exclusivas, nuevos productos y descuentos especiales directamente en tu correo.</p>

            <form action="#" method="POST" class="popup-form" onsubmit="subscribeNewsletter(event)">
                @csrf
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
    const dontShowAgain = document.getElementById('dontShowAgain').checked;

    popup.classList.remove('show');
    setTimeout(() => {
        popup.style.display = 'none';
    }, 300);

    if (dontShowAgain) {
        localStorage.setItem('newsletterPopupDismissed', 'true');
    }
}

function subscribeNewsletter(event) {
    event.preventDefault();

    const name = document.getElementById('newsletter_name').value;
    const email = document.getElementById('newsletter_email').value;

    // Aquí puedes agregar la lógica para enviar el nombre y email al servidor
    // Por ahora solo mostramos un mensaje de éxito

    alert('¡Gracias por suscribirte, ' + name + '! Te enviaremos las mejores ofertas a ' + email);

    closeNewsletterPopup();
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
