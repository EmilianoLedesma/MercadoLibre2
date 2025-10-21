<?php

use Illuminate\Support\Facades\Route;

// Página de inicio
Route::get('/', function () {
    return view('home');
})->name('home');

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Login POST (para cuando hagas el controlador)
Route::post('/login', function () {
    // Aquí irá la lógica de autenticación
    return redirect()->route('home');
})->name('login.post');
