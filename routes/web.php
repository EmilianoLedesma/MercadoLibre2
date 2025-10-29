<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;

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

// Tienda - Vistas públicas para clientes
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/category/{slug}', [ShopController::class, 'category'])->name('shop.category');

// Rutas de productos - CRUD completo (Admin/Management)
Route::resource('products', ProductController::class);