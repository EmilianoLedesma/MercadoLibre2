<?php $__env->startSection('title', 'Login'); ?>

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
        max-width: 1000px;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .auth-banner {
        background: linear-gradient(135deg, #EE403D 0%, #E32020 100%);
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
    }

    .auth-banner-logo {
        font-size: 48px;
        font-weight: 800;
        letter-spacing: 3px;
        margin-bottom: 24px;
    }

    .auth-banner h2 {
        font-size: 32px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .auth-banner p {
        font-size: 16px;
        line-height: 1.6;
        opacity: 0.95;
    }

    .auth-form-section {
        padding: 60px 40px;
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

    .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 24px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #D4EDDA;
        color: #155724;
        border: 1px solid #C3E6CB;
    }

    .alert-error {
        background-color: #F8D7DA;
        color: #721C24;
        border: 1px solid #F5C6CB;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 8px;
    }

    .form-input {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #E5E5E5;
        border-radius: 8px;
        font-size: 15px;
        font-family: 'Jost', sans-serif;
        transition: all 0.3s;
    }

    .form-input:focus {
        outline: none;
        border-color: #EE403D;
    }

    .form-input::placeholder {
        color: #999;
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        font-size: 14px;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
        cursor: pointer;
    }

    .checkbox-label input {
        cursor: pointer;
    }

    .forgot-link {
        color: #EE403D;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .forgot-link:hover {
        color: #E32020;
    }

    .btn-auth {
        width: 100%;
        padding: 16px;
        background-color: #EE403D;
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
        background-color: #E32020;
    }

    .auth-divider {
        display: flex;
        align-items: center;
        margin: 24px 0;
        color: #999;
        font-size: 14px;
    }

    .auth-divider::before,
    .auth-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background-color: #E5E5E5;
    }

    .auth-divider::before {
        margin-right: 16px;
    }

    .auth-divider::after {
        margin-left: 16px;
    }

    .auth-footer {
        text-align: center;
        margin-top: 24px;
        font-size: 15px;
        color: #666;
    }

    .auth-footer a {
        color: #EE403D;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }

    .auth-footer a:hover {
        color: #E32020;
    }

    .back-home {
        text-align: center;
        margin-top: 32px;
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
        color: #EE403D;
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
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-page">
    <div class="auth-container">
        <!-- Banner Section -->
        <div class="auth-banner">
            <div class="auth-banner-logo">SEALS</div>
            <h2>¡Bienvenido de vuelta!</h2>
            <p>Ingresa a tu cuenta para acceder a todas las funciones de nuestra tienda en línea.</p>
        </div>

        <!-- Form Section -->
        <div class="auth-form-section">
            <h1 class="auth-form-title">Iniciar Sesión</h1>
            <p class="auth-form-subtitle">Ingresa tus credenciales para continuar</p>

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-error">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('login.post')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-input"
                        placeholder="tu@email.com"
                        value="<?php echo e(old('email')); ?>"
                        required
                        autocomplete="email"
                    >
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-input"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                </div>

                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember">
                        <span>Recordarme</span>
                    </label>
                    <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="btn-auth">
                    Iniciar Sesión
                </button>
            </form>

            <div class="auth-footer">
                ¿No tienes una cuenta? <a href="<?php echo e(route('register')); ?>">Regístrate aquí</a>
            </div>

            <div style="text-align: center; margin-top: 24px; padding-top: 24px; border-top: 1px solid #E5E5E5;">
                <p style="font-size: 14px; color: #666; margin-bottom: 12px; font-family: 'Jost', sans-serif;">¿Quieres vender tus productos?</p>
                <a href="<?php echo e(route('seller.register')); ?>" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background-color: white; color: #212529; text-decoration: none; border: 2px solid #E5E5E5; border-radius: 8px; font-weight: 500; font-family: 'Jost', sans-serif; transition: all 0.3s;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Vende con Nosotros
                </a>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views/auth/login.blade.php ENDPATH**/ ?>