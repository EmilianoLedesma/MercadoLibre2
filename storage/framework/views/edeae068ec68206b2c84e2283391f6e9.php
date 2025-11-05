<!-- ========== TOP BANNER ========== -->
<div style="background-color: #EE403D; color: white; text-align: center; padding: 12px 0; font-size: 14px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <p style="margin: 0;">
            Envío gratis en compras mayores a $100
            <a href="#" style="color: white; text-decoration: underline; margin-left: 8px;">Descubre Ahora</a>
        </p>
    </div>
</div>

<!-- ========== SECONDARY HEADER ========== -->
<div style="background-color: #F5F6F2; padding: 12px 0; font-size: 14px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
        <nav style="display: flex; gap: 20px;">
            <a href="#" style="color: #212529; text-decoration: none; transition: color 0.25s;">Nosotros</a>
            <a href="<?php echo e(route('account')); ?>" style="color: #212529; text-decoration: none; transition: color 0.25s;">Mi Cuenta</a>
            <a href="<?php echo e(route('wishlist.index')); ?>" style="color: #212529; text-decoration: none; transition: color 0.25s;">Favoritos</a>
            <a href="#" style="color: #212529; text-decoration: none; transition: color 0.25s;">Rastrear Pedido</a>
        </nav>

        <div style="display: flex; align-items: center; gap: 15px;">
            <span style="color: #212529;">
                ¿Necesitas ayuda?
                <strong>Llámanos: <a href="tel:+1234567890" style="color: #EE403D; text-decoration: none;">+ 0020 500</a></strong>
            </span>
        </div>
    </div>
</div>

<!-- ========== MAIN HEADER ========== -->
<header style="background-color: white; padding: 20px 0; box-shadow: 0 2px 4px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center;">
        <!-- Logo -->
        <div style="flex-shrink: 0;">
            <a href="<?php echo e(route('home')); ?>" style="font-size: 32px; font-weight: 800; color: #212529; text-decoration: none; letter-spacing: 2px;">SEALS</a>
        </div>

        <!-- Main Navigation -->
        <nav style="display: flex; gap: 32px; flex: 1; justify-content: center;">
            <a href="<?php echo e(route('home')); ?>" style="color: <?php echo e(request()->routeIs('home') ? '#EE403D' : '#212529'); ?>; font-weight: 500; text-decoration: none; transition: color 0.25s;">Inicio</a>
            <a href="<?php echo e(route('shop.index')); ?>" style="color: <?php echo e(request()->routeIs('shop.*') ? '#EE403D' : '#212529'); ?>; font-weight: 500; text-decoration: none; transition: color 0.25s;">Shop</a>
            <a href="<?php echo e(route('categories')); ?>" style="color: <?php echo e(request()->routeIs('categories') ? '#EE403D' : '#212529'); ?>; font-weight: 500; text-decoration: none; transition: color 0.25s;">Categorías</a>
            <a href="<?php echo e(route('contact')); ?>" style="color: <?php echo e(request()->routeIs('contact') ? '#EE403D' : '#212529'); ?>; font-weight: 500; text-decoration: none; transition: color 0.25s;">Contacto</a>
        </nav>

        <!-- Header Actions -->
        <div style="display: flex; align-items: center; gap: 20px;">
            <!-- Search -->
            <button style="background: none; border: none; cursor: pointer; padding: 8px;" aria-label="Buscar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </button>

            <!-- User -->
            <?php if(auth()->guard()->check()): ?>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <a href="<?php echo e(route('account')); ?>" style="color: #212529; font-weight: 500; text-decoration: none;">Hola, <?php echo e(Auth::user()->name); ?></a>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin: 0;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" style="background: #EE403D; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-weight: 500;">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" style="background: none; border: none; cursor: pointer; padding: 8px;" aria-label="Cuenta">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
            <?php endif; ?>

            <!-- Cart -->
            <a href="<?php echo e(route('cart')); ?>" style="position: relative; background: none; border: none; cursor: pointer; padding: 8px; text-decoration: none; color: inherit;" aria-label="Carrito">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <?php
                    $cartCount = count(session()->get('cart', []));
                ?>
                <?php if($cartCount > 0): ?>
                <span style="position: absolute; top: 0; right: 0; background-color: #EE403D; color: white; font-size: 10px; font-weight: 600; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;"><?php echo e($cartCount); ?></span>
                <?php endif; ?>
            </a>
        </div>
    </div>
</header>
<?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>