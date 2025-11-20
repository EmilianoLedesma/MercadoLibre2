<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas API para tu aplicación.
| Estas rutas son cargadas por el RouteServiceProvider y todas se
| asignarán al grupo de middleware "api".
|
*/

// Rutas públicas de autenticación (no requieren token)
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('api.auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('api.auth.login');
});

// Rutas protegidas (requieren token JWT válido)
Route::middleware(['auth:api'])->group(function () {
    // Rutas de autenticación protegidas
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('api.auth.logout');
        Route::post('/refresh', [AuthController::class, 'refresh'])->name('api.auth.refresh');
        Route::get('/me', [AuthController::class, 'me'])->name('api.auth.me');
    });

    // Ejemplo de ruta protegida genérica
    Route::get('/user', function () {
        return response()->json([
            'success' => true,
            'message' => 'Usuario autenticado',
            'data' => auth()->user(),
        ]);
    })->name('api.user');

    // Rutas de productos (acceso público para lectura, admin/seller para escritura)
    Route::get('/products', [ProductController::class, 'index'])->name('api.products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('api.products.show');

    // Rutas de productos protegidas (solo admin y seller)
    Route::middleware(['role:admin,seller'])->group(function () {
        Route::post('/products', [ProductController::class, 'store'])->name('api.products.store');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('api.products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('api.products.destroy');
    });

    // Rutas de categorías (acceso público para lectura, admin para escritura)
    Route::get('/categories', [CategoryController::class, 'index'])->name('api.categories.index');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('api.categories.show');

    // Rutas de categorías protegidas (solo admin)
    Route::middleware(['role:admin'])->group(function () {
        Route::post('/categories', [CategoryController::class, 'store'])->name('api.categories.store');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('api.categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('api.categories.destroy');
    });
});

// Ruta de verificación de API
Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'message' => 'API funcionando correctamente',
        'version' => '1.0.0',
        'timestamp' => now()->toIso8601String(),
    ]);
})->name('api.health');
