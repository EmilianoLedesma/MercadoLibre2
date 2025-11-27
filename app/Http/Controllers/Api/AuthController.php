<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ApiResponseTrait;

    /**
     * Registro de nuevos usuarios
     */
    public function register(Request $request): JsonResponse
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'role' => 'nullable|in:admin,seller,customer',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse(
                $validator->errors()->toArray(),
                'Error de validación en el registro'
            );
        }

        try {
            // Crear nuevo usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => $request->role ?? 'customer',
                'is_active' => true,
            ]);

            // Generar token JWT para el nuevo usuario
            $token = JWTAuth::fromUser($user);

            return $this->successResponse([
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'role' => $user->role,
                    'is_active' => $user->is_active,
                ],
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl') * 60, // en segundos
            ], 'Usuario registrado exitosamente', 201);
        } catch (\Exception $e) {
            return $this->serverErrorResponse('Error al registrar usuario: '.$e->getMessage());
        }
    }

    /**
     * Inicio de sesión de usuarios
     */
    public function login(Request $request): JsonResponse
    {
        // Validación de credenciales
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse(
                $validator->errors()->toArray(),
                'Error de validación en el login'
            );
        }

        $credentials = $request->only('email', 'password');

        try {
            // Intentar autenticar y generar token
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->unauthorizedResponse('Credenciales incorrectas');
            }

            // Obtener usuario autenticado usando JWTAuth
            $user = JWTAuth::user();

            // Verificar que se obtuvo el usuario
            if (! $user) {
                return $this->unauthorizedResponse('No se pudo obtener el usuario autenticado');
            }

            // Verificar si el usuario está activo
            if (! $user->is_active) {
                // Invalidar el token si el usuario está inactivo
                JWTAuth::invalidate($token);
                return $this->unauthorizedResponse('Usuario inactivo. Contacte al administrador.');
            }

            return $this->successResponse([
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'role' => $user->role,
                    'is_active' => $user->is_active,
                ],
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl') * 60, // en segundos
            ], 'Inicio de sesión exitoso');
        } catch (JWTException $e) {
            return $this->serverErrorResponse('No se pudo crear el token: '.$e->getMessage());
        }
    }

    /**
     * Obtener información del usuario autenticado
     */
    public function me(): JsonResponse
    {
        try {
            $user = Auth::guard('api')->user();

            if (! $user) {
                return $this->unauthorizedResponse('No autenticado');
            }

            return $this->successResponse([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'avatar' => $user->avatar,
                'role' => $user->role,
                'is_active' => $user->is_active,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ], 'Usuario autenticado');
        } catch (\Exception $e) {
            return $this->serverErrorResponse('Error al obtener usuario: '.$e->getMessage());
        }
    }

    /**
     * Cerrar sesión (invalidar token)
     */
    public function logout(): JsonResponse
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return $this->successResponse(
                null,
                'Sesión cerrada exitosamente'
            );
        } catch (JWTException $e) {
            return $this->serverErrorResponse('Error al cerrar sesión: '.$e->getMessage());
        }
    }

    /**
     * Refrescar token
     */
    public function refresh(): JsonResponse
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());

            return $this->successResponse([
                'access_token' => $newToken,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl') * 60, // en segundos
            ], 'Token refrescado exitosamente');
        } catch (JWTException $e) {
            return $this->serverErrorResponse('No se pudo refrescar el token: '.$e->getMessage());
        }
    }
}
