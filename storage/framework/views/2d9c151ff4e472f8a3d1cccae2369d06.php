<footer class="site-footer">
    <div class="container footer-top">
        <div class="footer-column about">
            <div class="footer-logo">SEALS<span class="dot">.</span></div>
            <p class="muted">Tu tienda de moda favorita con las mejores marcas y precios</p>

            <ul class="contact-list">
                <li>
                    <strong>Horario:</strong> Lun - Vie: 9:00-20:00
                </li>
                <li>
                    <strong>Tel:</strong> (011) 4567-8900
                </li>
                <li>
                    <strong>Email:</strong> <a href="mailto:contacto@seals.com">contacto@seals.com</a>
                </li>
            </ul>

            <div class="socials">
                <a href="#" aria-label="facebook" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="instagram" class="social"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="twitter" class="social"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="tiktok" class="social"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>

        <div class="footer-column links">
            <h4>Sobre Nosotros</h4>
            <p class="muted">Descubre las últimas tendencias en moda y accesorios. Envíos a todo el país.</p>
            <a href="<?php echo e(route('contact')); ?>" class="btn-ghost">CONTÁCTANOS →</a>
        </div>

        <div class="footer-column navs">
            <div>
                <h4>Información</h4>
                <ul>
                    <li><a href="<?php echo e(route('about')); ?>">Nosotros</a></li>
                    <li><a href="<?php echo e(route('faq')); ?>">Preguntas Frecuentes</a></li>
                    <li><a href="<?php echo e(route('track.order')); ?>">Rastrear Pedido</a></li>
                    <li><a href="<?php echo e(route('returns')); ?>">Devoluciones</a></li>
                    <li><a href="<?php echo e(route('contact')); ?>">Contacto</a></li>
                </ul>
            </div>

            <div>
                <h4>Mi Cuenta</h4>
                <ul>
                    <?php if(auth()->guard()->check()): ?>
                        <li><a href="<?php echo e(route('account')); ?>">Mi Perfil</a></li>
                        <li><a href="<?php echo e(route('account')); ?>#orders">Mis Pedidos</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo e(route('login')); ?>">Iniciar Sesión</a></li>
                        <li><a href="<?php echo e(route('register')); ?>">Registrarse</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo e(route('wishlist.index')); ?>">Lista de Deseos</a></li>
                    <li><a href="<?php echo e(route('cart')); ?>">Carrito</a></li>
                    <li><a href="<?php echo e(route('shop.index')); ?>">Tienda</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-column newsletter">
            <h4>Newsletter</h4>
            <p class="muted">¡Suscríbete y obtén 10% de descuento en tu primera compra!</p>
            <form class="newsletter-form" action="#" method="POST">
                <input type="email" name="email" placeholder="Ingresa tu email" required />
                <button class="btn-primary">Suscribirse →</button>
            </form>

            <div class="app-badges">
                <img src="/images/app-store-badge.svg" alt="Descarga en App Store" class="app-badge" />
                <img src="/images/play-store-badge.svg" alt="Consíguelo en Google Play" class="app-badge" />
            </div>
        </div>
    </div>

    <div class="container footer-bottom">
        <div class="left">
            <p>¡Compra más rápido con nuestra App!</p>
        </div>
        <div class="right payments">
            <img src="/images/payment-visa.svg" alt="Visa" />
            <img src="/images/payment-mastercard.svg" alt="Mastercard" />
            <img src="/images/payment-mercadopago.svg" alt="MercadoPago" />
        </div>
    </div>

    <div class="container copyright">
        <p>&copy; <?php echo e(date('Y')); ?> SEALS. Todos los derechos reservados.</p>
    </div>
</footer><?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views/layouts/footer.blade.php ENDPATH**/ ?>