@extends('layouts.app')

@section('title', 'Nosotros')

@push('styles')
<style>
    .about-page {
        font-family: 'Jost', sans-serif;
    }

    /* Hero Section */
    .about-hero {
        padding: 100px 20px 80px;
        text-align: center;
        background-color: #F8F9FA;
    }

    .about-hero-content {
        max-width: 800px;
        margin: 0 auto;
    }

    .about-hero h1 {
        font-size: 56px;
        font-weight: 700;
        margin-bottom: 24px;
        letter-spacing: -1px;
        color: #212529;
        line-height: 1.2;
    }

    .about-hero p {
        font-size: 20px;
        font-weight: 400;
        line-height: 1.7;
        color: #666;
        max-width: 640px;
        margin: 0 auto;
    }

    /* Stats Section */
    .stats-section {
        padding: 80px 20px;
        background-color: white;
    }

    .stats-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 40px;
    }

    .stat-item {
        text-align: center;
        padding: 40px 20px;
        background-color: #FAFAFA;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .stat-item:hover {
        background-color: #F5F6F2;
        transform: translateY(-4px);
    }

    .stat-number {
        font-size: 48px;
        font-weight: 700;
        color: #EE403D;
        margin-bottom: 12px;
    }

    .stat-label {
        font-size: 14px;
        color: #666;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Story Section */
    .story-section {
        padding: 100px 20px;
        background-color: #F8F9FA;
    }

    .story-content {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
    }

    .story-image {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    }

    .story-image img {
        width: 100%;
        height: 450px;
        object-fit: cover;
    }

    .story-text h2 {
        font-size: 42px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 24px;
        line-height: 1.2;
    }

    .story-text p {
        font-size: 17px;
        line-height: 1.8;
        color: #666;
        margin-bottom: 20px;
    }

    /* Mission Vision Section */
    .mission-section {
        padding: 100px 20px;
        background-color: white;
    }

    .mission-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
    }

    .mission-card {
        padding: 50px 40px;
        border-radius: 12px;
        background-color: #FAFAFA;
        position: relative;
        transition: all 0.3s;
    }

    .mission-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    }

    .mission-card .icon {
        width: 70px;
        height: 70px;
        background-color: #EE403D;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
    }

    .mission-card .icon i {
        font-size: 32px;
        color: white;
    }

    .mission-card h3 {
        font-size: 28px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 16px;
    }

    .mission-card p {
        font-size: 16px;
        line-height: 1.8;
        color: #666;
    }

    /* CTA Section */
    .cta-section {
        padding: 100px 20px;
        background-color: white;
        text-align: center;
    }

    .cta-content {
        max-width: 700px;
        margin: 0 auto;
    }

    .cta-section h2 {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #212529;
    }

    .cta-section p {
        font-size: 18px;
        margin-bottom: 40px;
        color: #666;
    }

    .cta-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .cta-btn {
        padding: 18px 40px;
        font-size: 14px;
        font-weight: 700;
        border-radius: 8px;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s;
    }

    .cta-btn-primary {
        background-color: #EE403D;
        color: white;
    }

    .cta-btn-primary:hover {
        background-color: #E32020;
        transform: translateY(-4px);
    }

    .cta-btn-secondary {
        background-color: white;
        color: #212529;
        border: 2px solid #212529;
    }

    .cta-btn-secondary:hover {
        background-color: #212529;
        color: white;
        transform: translateY(-4px);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .about-hero h1 {
            font-size: 42px;
        }

        .stats-container,
        .mission-container,
        .story-content {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .about-hero h1 {
            font-size: 36px;
        }

        .story-text h2,
        .mission-card h3,
        .cta-section h2 {
            font-size: 28px;
        }

        .stats-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }
    }
</style>
@endpush

@section('content')
@include('layouts.navbar')

<div class="about-page">
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="about-hero-content">
            <h1>Conectando México,<br>un producto a la vez</h1>
            <p>Somos el marketplace que impulsa a emprendedores y facilita experiencias de compra excepcionales en toda la república.</p>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-number">15K+</div>
                <div class="stat-label">Productos</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">8K+</div>
                <div class="stat-label">Vendedores</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">100K+</div>
                <div class="stat-label">Clientes</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">99.5%</div>
                <div class="stat-label">Satisfacción</div>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="story-content">
            <div class="story-image">
                <img src="https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?w=600&h=450&fit=crop" alt="SEALS Team">
            </div>
            <div class="story-text">
                <h2>Nuestra Historia</h2>
                <p>
                    Fundado en 2020 en plena transformación digital, SEALS nació con una misión clara: democratizar el comercio electrónico en México.
                </p>
                <p>
                    Lo que comenzó con 100 vendedores valientes se ha convertido en una comunidad vibrante de miles de emprendedores que cada día construyen sus sueños.
                </p>
                <p>
                    Hoy procesamos miles de transacciones, pero nunca olvidamos que detrás de cada número hay una persona con una historia única.
                </p>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="mission-section">
        <div class="mission-container">
            <div class="mission-card">
                <div class="icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3>Nuestra Misión</h3>
                <p>Empoderar a emprendedores mexicanos proporcionándoles una plataforma segura, confiable y accesible para vender sus productos, mientras ofrecemos a los compradores una experiencia de compra excepcional.</p>
            </div>
            
            <div class="mission-card">
                <div class="icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Nuestra Visión</h3>
                <p>Ser el marketplace líder en México, reconocido por nuestra innovación, confianza y compromiso con el crecimiento de la economía digital local.</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Únete a SEALS</h2>
            <p>Miles de personas ya están construyendo su futuro con nosotros. ¿Qué esperas?</p>
            <div class="cta-buttons">
                <a href="{{ route('shop.index') }}" class="cta-btn cta-btn-primary">
                    Explorar Productos
                </a>
                <a href="{{ route('register') }}" class="cta-btn cta-btn-secondary">
                    Crear Cuenta
                </a>
            </div>
        </div>
    </section>
</div>

@endsection
