@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <div class="login-box">
        <div class="logo">
            <h1>SEALS</h1>
        </div>

        <h2>Iniciar Sesión</h2>

        <form action="{{ route('login') }}" method="POST" class="login-form">
            @csrf

            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Contraseña" required>
            </div>

            <div class="form-options">
                <label>
                    <input type="checkbox" name="remember"> Recordarme
                </label>
                <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit" class="btn-primary">Iniciar Sesión</button>
        </form>

        <div class="signup-link">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
        </div>
    </div>
</div>
@endsection
