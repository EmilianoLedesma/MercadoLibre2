<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'SEALS'); ?> - MercadoLibre2</title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    
    <link rel="stylesheet" href="<?php echo e(asset('css/preloader.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/weiboo-design-system.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/footer.css')); ?>">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body style="font-family: 'Jost', sans-serif; margin: 0; padding: 0; color: #212529;">
    
    <div class="preloader-wrapper" id="preloader">
        <div class="preloader-new">
            <svg class="cart_preloader" role="img" aria-label="Shopping cart preloader line animation" viewBox="0 0 128 128" width="128px" height="128px" xmlns="http://www.w3.org/2000/svg">
                <g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="8">
                    <g class="cart__track" stroke="hsla(0,10%,10%,0.1)">
                        <polyline points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80"></polyline>
                        <circle cx="43" cy="111" r="13"></circle>
                        <circle cx="102" cy="111" r="13"></circle>
                    </g>
                    <g class="cart__lines" stroke="currentColor">
                        <polyline class="cart__top" points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80" stroke-dasharray="338 338" stroke-dashoffset="-338"></polyline>
                        <g class="cart__wheel1" transform="rotate(-90,43,111)">
                            <circle class="cart__wheel-stroke" cx="43" cy="111" r="13" stroke-dasharray="81.68 81.68" stroke-dashoffset="81.68"></circle>
                        </g>
                        <g class="cart__wheel2" transform="rotate(90,102,111)">
                            <circle class="cart__wheel-stroke" cx="102" cy="111" r="13" stroke-dasharray="81.68 81.68" stroke-dashoffset="81.68"></circle>
                        </g>
                    </g>
                </g>
            </svg>
        </div>
    </div>

    
    <?php echo $__env->yieldContent('content'); ?>

    
    <?php echo $__env->yieldPushContent('scripts'); ?>

    
    <script>
        // Ocultar preloader cuando la página termine de cargar
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');

            // Esperar un momento para asegurar que todo esté cargado
            setTimeout(function() {
                preloader.classList.add('hidden');

                // Remover del DOM después de la transición (opcional)
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 600); // Tiempo de la transición CSS
            }, 500); // Mostrar el preloader por al menos 500ms
        });

        // También ocultar si el usuario navega hacia atrás/adelante
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                const preloader = document.getElementById('preloader');
                preloader.classList.add('hidden');
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 600);
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views\layouts\app.blade.php ENDPATH**/ ?>