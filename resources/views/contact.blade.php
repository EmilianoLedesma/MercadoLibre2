@extends('layouts.app')

@section('title', 'Contacto')

@push('styles')
<style>
    .contact-page {
        font-family: 'Jost', sans-serif;
    }

    .contact-hero {
        background: linear-gradient(135deg, #F5F6F2 0%, #FAFAF9 100%);
        padding: 100px 20px;
        text-align: center;
        position: relative;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #EE403D 0%, #E32020 100%);
    }

    .contact-hero h1 {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 16px;
        color: #212529;
    }

    .contact-hero h1 .highlight {
        color: #EE403D;
    }

    .contact-hero p {
        font-size: 18px;
        color: #666;
    }

    .contact-container {
        max-width: 1200px;
        margin: -60px auto 0;
        padding: 0 20px 120px;
        position: relative;
        z-index: 2;
        min-height: calc(100vh - 450px);
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 40px;
        margin-bottom: 100px;
    }

    .contact-info-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }

    .contact-info-title {
        font-size: 28px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 24px;
    }

    .contact-info-item {
        display: flex;
        gap: 20px;
        margin-bottom: 32px;
        align-items: flex-start;
    }

    .contact-info-icon {
        width: 50px;
        height: 50px;
        background-color: #F5F6F2;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #EE403D;
        font-size: 20px;
        flex-shrink: 0;
    }

    .contact-info-content h3 {
        font-size: 18px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 8px;
    }

    .contact-info-content p {
        font-size: 15px;
        color: #666;
        margin: 0;
        line-height: 1.6;
    }

    .contact-info-content a {
        color: #EE403D;
        text-decoration: none;
        transition: color 0.3s;
    }

    .contact-info-content a:hover {
        color: #E32020;
    }

    .contact-form-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }

    .contact-form-title {
        font-size: 28px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 12px;
    }

    .contact-form-subtitle {
        font-size: 15px;
        color: #666;
        margin-bottom: 32px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
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

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #E5E5E5;
        border-radius: 8px;
        font-size: 15px;
        font-family: 'Jost', sans-serif;
        transition: border-color 0.3s;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #EE403D;
    }

    .form-textarea {
        resize: vertical;
        min-height: 150px;
    }

    .btn-submit {
        padding: 16px 48px;
        background-color: #EE403D;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-submit:hover {
        background-color: #E32020;
    }

    .social-links {
        margin-top: 32px;
        padding-top: 32px;
        border-top: 1px solid #E5E5E5;
    }

    .social-links h4 {
        font-size: 16px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 16px;
    }

    .social-icons {
        display: flex;
        gap: 12px;
    }

    .social-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background-color: #F5F6F2;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        text-decoration: none;
        transition: all 0.3s;
    }

    .social-icon:hover {
        background-color: #EE403D;
        color: white;
        transform: translateY(-4px);
    }

    .map-section {
        margin-top: 80px;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }

    .map-placeholder {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #F5F6F2 0%, #E5E5E5 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        font-size: 18px;
    }

    @media (max-width: 768px) {
        .contact-hero h1 {
            font-size: 32px;
        }

        .contact-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .contact-form-card,
        .contact-info-card {
            padding: 24px;
        }
    }
</style>
@endpush

@section('content')
@include('layouts.navbar')

<!-- BREADCRUMB -->
<div style="background-color: #F8F8F8; padding: 20px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <nav style="font-family: 'Jost', sans-serif; font-size: 14px; color: #666;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="margin: 0 8px;">/</span>
            <span style="color: #212529; font-weight: 500;">Contacto</span>
        </nav>
    </div>
</div>

<div class="contact-page">
    <!-- Hero Section -->
    <div class="contact-hero">
        <h1><span class="highlight">Contáctanos</span></h1>
        <p>Estamos aquí para ayudarte. Envíanos un mensaje y te responderemos pronto.</p>
    </div>

    <!-- Contact Content -->
    <div class="contact-container">
        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info-card">
                <h2 class="contact-info-title">Información de Contacto</h2>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-info-content">
                        <h3>Dirección</h3>
                        <p>Av. Principal #123<br>Ciudad de México, CDMX 01234<br>México</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contact-info-content">
                        <h3>Teléfono</h3>
                        <p><a href="tel:+525512345678">+52 55 1234 5678</a><br>Lun - Vie: 9:00 AM - 6:00 PM</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-info-content">
                        <h3>Email</h3>
                        <p><a href="mailto:contacto@seals.com">contacto@seals.com</a><br><a href="mailto:soporte@seals.com">soporte@seals.com</a></p>
                    </div>
                </div>

                <div class="social-links">
                    <h4>Síguenos en Redes Sociales</h4>
                    <div class="social-icons">
                        <a href="#" class="social-icon" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-card">
                <h2 class="contact-form-title">Envíanos un Mensaje</h2>
                <p class="contact-form-subtitle">Completa el formulario y nos pondremos en contacto contigo lo antes posible.</p>

                <form action="#" method="POST">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre Completo</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-input"
                                placeholder="Juan Pérez"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-input"
                                placeholder="tu@email.com"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                class="form-input"
                                placeholder="+52 55 1234 5678"
                            >
                        </div>

                        <div class="form-group">
                            <label for="subject" class="form-label">Asunto</label>
                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                class="form-input"
                                placeholder="¿En qué podemos ayudarte?"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="form-label">Mensaje</label>
                        <textarea
                            id="message"
                            name="message"
                            class="form-textarea"
                            placeholder="Escribe tu mensaje aquí..."
                            required
                        ></textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>

        <!-- Map Section -->
        <div class="map-section">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3736.022891145228!2d-100.27737752492052!3d20.546244280985086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d3452b278e7259%3A0xeb40a967d716216c!2sUniversidad%20Polit%C3%A9cnica%20de%20Quer%C3%A9taro!5e0!3m2!1ses-419!2smx!4v1762357425208!5m2!1ses-419!2smx"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
