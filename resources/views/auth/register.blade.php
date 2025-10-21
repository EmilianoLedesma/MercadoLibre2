@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="login-container">
    <div class="login-box register-box">
        <div class="logo">
            <h1>SEALS</h1>
        </div>

        <h2>Crear Cuenta</h2>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="login-form">
            @csrf

            <div class="form-group">
                <input type="text" name="name" id="name" placeholder="Nombre completo" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Contraseña" required>
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar contraseña" required>
            </div>

            <div class="form-options">
                <label>
                    <input type="checkbox" name="terms" required> Acepto los términos y condiciones
                </label>
            </div>

            <button type="submit" class="btn-primary">Crear Cuenta</button>
        </form>

        <div class="signup-link">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia Sesión</a>
        </div>
    </div>
</div>
@endsection
