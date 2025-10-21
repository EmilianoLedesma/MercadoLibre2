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

// Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Register POST
Route::post('/register', function () {
    // Aquí irá la lógica de registro
    return redirect()->route('home');
})->name('register.post');

// Carrito
Route::get('/cart', function () {
    return view('cart');
})->name('cart');

// Categorías
Route::get('/categories', function () {
    return view('categories');
})->name('categories');
