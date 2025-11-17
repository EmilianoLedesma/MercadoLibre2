<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MiCuentaController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;

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
Route::get('/clientes', [ClienteController::class, 'index'])->middleware('auth')->name('clientes');
Route::put('/clientes', [ClienteController::class, 'update'])->middleware('auth')->name('clientes.update');
Route::post('/clientes/addresses', [ClienteController::class, 'saveAddresses'])->middleware('auth')->name('clientes.addresses.save');

// Rutas para 'Mi cuenta' (misma funcionalidad, ruta amigable)
Route::get('/account', [MiCuentaController::class, 'index'])->middleware('auth')->name('account');
Route::put('/account', [MiCuentaController::class, 'update'])->middleware('auth')->name('account.update');
Route::post('/account/addresses', [MiCuentaController::class, 'saveAddresses'])->middleware('auth')->name('account.addresses.save');
Route::delete('/account', [MiCuentaController::class, 'destroy'])->middleware('auth')->name('account.destroy');

// Carrito
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/confirmation/{orderId}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

// Wishlist (Lista de deseos)
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::post('/wishlist/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');
Route::post('/wishlist/move-to-cart/{id}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');

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