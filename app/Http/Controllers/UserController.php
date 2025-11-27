<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filtro por rol
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        // Filtro por estado
        if ($request->has('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        // Búsqueda
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(15);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $users,
            ]);
        }

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            
            $user = User::create($data);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Usuario creado correctamente',
                    'data' => $user,
                ], 201);
            }

            return redirect()->route('users.index')
                ->with('success', 'Usuario creado correctamente.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al crear usuario: ' . $e->getMessage(),
                ], 500);
            }

            return back()->withInput()
                ->with('error', 'Error al crear usuario: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified user.
     */
    public function show(Request $request, User $user)
    {
        $user->load(['addresses', 'orders', 'products', 'store']);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            
            // Solo actualizar password si se proporcionó
            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = Hash::make($data['password']);
            }

            $user->update($data);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Usuario actualizado correctamente',
                    'data' => $user,
                ]);
            }

            return redirect()->route('users.index')
                ->with('success', 'Usuario actualizado correctamente.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar usuario: ' . $e->getMessage(),
                ], 500);
            }

            return back()->withInput()
                ->with('error', 'Error al actualizar usuario: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified user from storage (soft delete).
     */
    public function destroy(Request $request, User $user)
    {
        try {
            $user->delete();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Usuario eliminado correctamente',
                ]);
            }

            return redirect()->route('users.index')
                ->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al eliminar usuario: ' . $e->getMessage(),
                ], 500);
            }

            return back()->with('error', 'Error al eliminar usuario: ' . $e->getMessage());
        }
    }
}
