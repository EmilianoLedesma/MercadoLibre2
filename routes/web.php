<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Página de inicio
Route::get('/', function () {
    return view('home');
})->name('home');

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta de clientes (solo para usuarios autenticados)
Route::get('/clientes', [AuthController::class, 'showClientes'])->middleware('auth')->name('clientes');

// Carrito
Route::get('/cart', function () {
    return view('cart');
})->name('cart');

// Categorías
Route::get('/categories', function () {
    return view('categories');
})->name('categories');

// Contacto
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
