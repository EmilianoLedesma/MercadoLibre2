

<?php $__env->startSection('title', 'Registro de Vendedores'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .auth-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #F5F6F2 0%, #FFF 100%);
        padding: 40px 20px;
        font-family: 'Jost', sans-serif;
    }

    .auth-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        overflow: hidden;
        max-width: 1100px;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1.2fr;
    }

    .auth-banner {
        background: linear-gradient(135deg, #28A745 0%, #1E7E34 100%);
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
    }

    .auth-banner-logo {
        font-size: 42px;
        font-weight: 800;
        letter-spacing: 3px;
        margin-bottom: 12px;
    }

    .auth-banner-subtitle {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 24px;
        opacity: 0.95;
    }

    .auth-banner h2 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .auth-banner p {
        font-size: 15px;
        line-height: 1.6;
        opacity: 0.9;
        margin-bottom: 12px;
    }

    .seller-benefits {
        margin-top: 32px;
        text-align: left;
        width: 100%;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        font-size: 14px;
    }

    .benefit-icon {
        width: 24px;
        height: 24px;
        background-color: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .auth-form-section {
        padding: 60px 40px;
        max-height: 90vh;
        overflow-y: auto;
    }

    .auth-form-title {
        font-size: 28px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 12px;
    }

    .auth-form-subtitle {
        font-size: 15px;
        color: #666;
        margin-bottom: 32px;
    }

    .alert-error {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 24px;
        font-size: 14px;
        background-color: #F8D7DA;
        color: #721C24;
        border: 1px solid #F5C6CB;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 20px;
    }

    .form-section-title {
        font-size: 18px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid #E5E5E5;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 8px;
    }

    .form-input, .form-textarea {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #E5E5E5;
        border-radius: 8px;
        font-size: 15px;
        font-family: 'Jost', sans-serif;
        transition: all 0.3s;
    }

    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }

    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: #28A745;
    }

    .form-input::placeholder, .form-textarea::placeholder {
        color: #999;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .checkbox-label {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        color: #666;
        cursor: pointer;
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 24px;
    }

    .checkbox-label input {
        margin-top: 3px;
        cursor: pointer;
    }

    .checkbox-label a {
        color: #28A745;
        text-decoration: none;
    }

    .checkbox-label a:hover {
        text-decoration: underline;
    }

    .btn-auth {
        width: 100%;
        padding: 16px;
        background-color: #28A745;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        font-family: 'Jost', sans-serif;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-auth:hover {
        background-color: #1E7E34;
    }

    .auth-footer {
        text-align: center;
        margin-top: 24px;
        font-size: 15px;
        color: #666;
    }

    .auth-footer a {
        color: #28A745;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }

    .auth-footer a:hover {
        color: #1E7E34;
    }

    .back-home {
        text-align: center;
        margin-top: 24px;
    }

    .back-home a {
        color: #666;
        text-decoration: none;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: color 0.3s;
    }

    .back-home a:hover {
        color: #28A745;
    }

    @media (max-width: 768px) {
        .auth-container {
            grid-template-columns: 1fr;
        }

        .auth-banner {
            padding: 40px 20px;
        }

        .auth-form-section {
            padding: 40px 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-page">
    <div class="auth-container">
        <!-- Banner Section -->
        <div class="auth-banner">
            <div class="auth-banner-logo">SEALS</div>
            <div class="auth-banner-subtitle">SELLERS</div>
            <h2>¡Vende con Nosotros!</h2>
            <p>Únete a nuestra plataforma y llega a miles de clientes. Gestiona tu tienda, productos y ventas desde un solo lugar.</p>

            <div class="seller-benefits">
                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <span>Alcance a miles de clientes</span>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <span>Dashboard completo de ventas</span>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <span>Gestión fácil de productos</span>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <span>Sin costos de inicio</span>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <span>Pagos seguros y puntuales</span>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="auth-form-section">
            <h1 class="auth-form-title">Registro de Vendedor</h1>
            <p class="auth-form-subtitle">Completa el formulario para empezar a vender</p>

            <?php if($errors->any()): ?>
                <div class="alert-error">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('seller.register.post')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="form-section-title">Información Personal</div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="form-label">Nombre(s) *</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-input"
                            placeholder="Juan"
                            value="<?php echo e(old('name')); ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="form-label">Apellido(s) *</label>
                        <input
                            type="text"
                            name="last_name"
                            id="last_name"
                            class="form-input"
                            placeholder="Pérez García"
                            value="<?php echo e(old('last_name')); ?>"
                            required
                        >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="form-label">Correo Electrónico *</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-input"
                            placeholder="tu@email.com"
                            value="<?php echo e(old('email')); ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Teléfono *</label>
                        <input
                            type="tel"
                            name="phone"
                            id="phone"
                            class="form-input"
                            placeholder="555-123-4567"
                            value="<?php echo e(old('phone')); ?>"
                            required
                        >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">Contraseña *</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-input"
                            placeholder="••••••••"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña *</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-input"
                            placeholder="••••••••"
                            required
                        >
                    </div>
                </div>

                <div class="form-section-title" style="margin-top: 32px;">Información de la Tienda</div>

                <div class="form-group">
                    <label for="store_name" class="form-label">Nombre de la Tienda *</label>
                    <input
                        type="text"
                        name="store_name"
                        id="store_name"
                        class="form-input"
                        placeholder="Mi Tienda Online"
                        value="<?php echo e(old('store_name')); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="store_description" class="form-label">Descripción de la Tienda</label>
                    <textarea
                        name="store_description"
                        id="store_description"
                        class="form-textarea"
                        placeholder="Cuéntanos sobre tu tienda, los productos que vendes y qué te hace único..."
                    ><?php echo e(old('store_description')); ?></textarea>
                </div>

                <label class="checkbox-label">
                    <input type="checkbox" name="terms" required>
                    <span>
                        Acepto los <a href="#">Términos y Condiciones de Vendedores</a> y la
                        <a href="#">Política de Privacidad</a>
                    </span>
                </label>

                <button type="submit" class="btn-auth">
                    Crear Cuenta de Vendedor
                </button>
            </form>

            <div class="auth-footer">
                ¿Ya tienes una cuenta? <a href="<?php echo e(route('login')); ?>">Inicia sesión aquí</a>
            </div>

            <div class="back-home">
                <a href="<?php echo e(route('home')); ?>">
                    <i class="fas fa-arrow-left"></i>
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views/auth/seller-register.blade.php ENDPATH**/ ?>