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

    {{-- Fuente Jost de Weiboo --}}
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Estilos CSS --}}
    <link rel="stylesheet" href="{{ asset('css/weiboo-design-system.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    @stack('styles')
</head>
<body style="font-family: 'Jost', sans-serif; margin: 0; padding: 0; color: #212529;">
    {{-- Contenido principal --}}
    @yield('content')

    {{-- Scripts --}}
    @stack('scripts')
</body>
</html>
