@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <div class="login-box">
        <div class="logo">
            <h1>SEALS</h1>
        </div>

        <h2>Iniciar Sesión</h2>

        @if (session('success'))
            <div style="color: green; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="login-form">
            @csrf

            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
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
