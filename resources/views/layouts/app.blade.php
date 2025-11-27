<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SEALS') - MercadoLibre2</title>

    {{-- Preconnect para optimización --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

    {{-- Fuente Jost de Weiboo con font-display swap para mejor rendimiento --}}
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Font Awesome cargado de forma asíncrona --}}
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>

    {{-- Estilos CSS --}}
    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/weiboo-design-system.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    @stack('styles')
</head>
<body style="font-family: 'Jost', sans-serif; margin: 0; padding: 0; color: #212529;">
    {{-- Preloader --}}
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

    {{-- Toast Notifications --}}
    <div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>

    {{-- Contenido principal --}}
    @yield('content')

    {{-- Scripts --}}
    @stack('scripts')

    {{-- Toast Notification Styles and Script --}}
    <style>
        .toast {
            min-width: 300px;
            max-width: 400px;
            padding: 16px 20px;
            margin-bottom: 12px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Jost', sans-serif;
            animation: slideIn 0.3s ease-out;
            border-left: 4px solid #EE403D;
        }

        .toast.success {
            border-left-color: #4CAF50;
        }

        .toast.error {
            border-left-color: #EE403D;
        }

        .toast.warning {
            border-left-color: #FF9800;
        }

        .toast.info {
            border-left-color: #2196F3;
        }

        .toast-icon {
            flex-shrink: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .toast.success .toast-icon {
            color: #4CAF50;
        }

        .toast.error .toast-icon {
            color: #EE403D;
        }

        .toast.warning .toast-icon {
            color: #FF9800;
        }

        .toast.info .toast-icon {
            color: #2196F3;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            font-size: 14px;
            color: #212529;
            margin-bottom: 4px;
        }

        .toast-message {
            font-size: 13px;
            color: #666;
            line-height: 1.4;
        }

        .toast-close {
            background: none;
            border: none;
            color: #999;
            font-size: 20px;
            cursor: pointer;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }

        .toast-close:hover {
            color: #212529;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        .toast.removing {
            animation: slideOut 0.3s ease-in forwards;
        }
    </style>

    <script>
        function showToast(message, type = 'success', title = '') {
            const container = document.getElementById('toast-container');

            // Create toast element
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;

            // Icon based on type
            const icons = {
                success: '<i class="fas fa-check-circle"></i>',
                error: '<i class="fas fa-exclamation-circle"></i>',
                warning: '<i class="fas fa-exclamation-triangle"></i>',
                info: '<i class="fas fa-info-circle"></i>'
            };

            // Default titles
            const defaultTitles = {
                success: '¡Éxito!',
                error: 'Error',
                warning: 'Advertencia',
                info: 'Información'
            };

            toast.innerHTML = `
                <div class="toast-icon">${icons[type] || icons.success}</div>
                <div class="toast-content">
                    <div class="toast-title">${title || defaultTitles[type]}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close" onclick="removeToast(this.parentElement)">×</button>
            `;

            container.appendChild(toast);

            // Auto remove after 4 seconds
            setTimeout(() => {
                removeToast(toast);
            }, 4000);
        }

        function removeToast(toast) {
            toast.classList.add('removing');
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.parentElement.removeChild(toast);
                }
            }, 300);
        }

        // Show flash messages on page load
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif

            @if(session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif

            @if(session('warning'))
                showToast("{{ session('warning') }}", 'warning');
            @endif

            @if(session('info'))
                showToast("{{ session('info') }}", 'info');
            @endif
        });
    </script>

    {{-- Script del Preloader --}}
    <script>
        // Ocultar preloader cuando la página termine de cargar
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');

            // Ocultar inmediatamente cuando la página termine de cargar
            preloader.classList.add('hidden');

            // Remover del DOM después de la transición
            setTimeout(function() {
                preloader.style.display = 'none';
            }, 600); // Tiempo de la transición CSS
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
