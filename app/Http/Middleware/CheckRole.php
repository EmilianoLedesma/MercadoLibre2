<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'No autenticado'], 401);
            }
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        $user = auth()->user();

        if (!in_array($user->role, $roles)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'No tienes permisos para acceder a este recurso'], 403);
            }
            abort(403, 'No tienes permisos para acceder a este recurso.');
        }

        return $next($request);
    }
}
