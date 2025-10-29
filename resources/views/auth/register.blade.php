@extends('layouts.app')

@section('title', 'Registro')

@push('styles')
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
        color: #EE403D;
        text-decoration: none;
    }

    .checkbox-label a:hover {
        text-decoration: underline;
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

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="auth-page">
    <div class="auth-container">
        <!-- Banner Section -->
        <div class="auth-banner">
            <div class="auth-banner-logo">SEALS</div>
            <h2>¡Únete a nosotros!</h2>
            <p>Crea tu cuenta y disfruta de todos los beneficios de nuestra tienda en línea. Ofertas exclusivas, envío gratis y mucho más.</p>
        </div>

        <!-- Form Section -->
        <div class="auth-form-section">
            <h1 class="auth-form-title">Crear Cuenta</h1>
            <p class="auth-form-subtitle">Completa el formulario para registrarte</p>

            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Nombre Completo</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-input"
                        placeholder="Juan Pérez"
                        value="{{ old('name') }}"
                        required
                        autocomplete="name"
                    >
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-input"
                        placeholder="tu@email.com"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                    >
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">Contraseña</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-input"
                            placeholder="••••••••"
                            required
                            autocomplete="new-password"
                        >
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-input"
                            placeholder="••••••••"
                            required
                            autocomplete="new-password"
                        >
                    </div>
                </div>

                <label class="checkbox-label">
                    <input type="checkbox" name="terms" required>
                    <span>
                        Acepto los <a href="#">Términos y Condiciones</a> y la
                        <a href="#">Política de Privacidad</a>
                    </span>
                </label>

                <button type="submit" class="btn-auth">
                    Crear Cuenta
                </button>
            </form>

            <div class="auth-footer">
                ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
            </div>

            <div class="back-home">
                <a href="{{ route('home') }}">
                    <i class="fas fa-arrow-left"></i>
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
