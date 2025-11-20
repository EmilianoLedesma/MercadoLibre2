<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Verifica que el usuario autenticado tenga uno de los roles permitidos.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  Roles permitidos (admin, seller, customer)
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Verificar si el usuario está autenticado
        if (! auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'No autenticado',
            ], 401);
        }

        $user = auth()->user();

        // Verificar si el usuario está activo
        if (! $user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario inactivo. Contacte al administrador.',
            ], 403);
        }

        // Verificar si el usuario tiene alguno de los roles permitidos
        if (! empty($roles) && ! in_array($user->role, $roles)) {
            return response()->json([
                'success' => false,
                'message' => 'No tiene permisos para acceder a este recurso',
                'required_roles' => $roles,
                'user_role' => $user->role,
            ], 403);
        }

        return $next($request);
    }
}
