<?php

use App\Http\Controllers\Api\AuthController;
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

    // Aquí puedes agregar más rutas protegidas según tus necesidades
    // Por ejemplo:
    // Route::apiResource('products', ProductApiController::class);
    // Route::apiResource('categories', CategoryApiController::class);
    // Route::apiResource('orders', OrderApiController::class);
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
