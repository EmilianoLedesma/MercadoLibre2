<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    /**
     * Dashboard del vendedor
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Verificar que el usuario sea vendedor
        if ($user->role !== 'seller') {
            return redirect()->route('home')->with('error', 'Acceso denegado');
        }

        $store = $user->store;
        $products = $user->products()->with('category')->latest()->get();
        $totalProducts = $products->count();
        $activeProducts = $products->where('is_active', true)->count();
        $totalSales = 0; // Aquí podrías calcular ventas reales

        return view('seller.dashboard', compact('store', 'products', 'totalProducts', 'activeProducts', 'totalSales'));
    }

    /**
     * Mostrar perfil del vendedor
     */
    public function profile()
    {
        $user = Auth::user();
        
        if ($user->role !== 'seller') {
            return redirect()->route('home')->with('error', 'Acceso denegado');
        }

        $store = $user->store;

        return view('seller.profile', compact('store'));
    }

    /**
     * Actualizar perfil del vendedor
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role !== 'seller') {
            return redirect()->route('home')->with('error', 'Acceso denegado');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return back()->with('success', 'Perfil actualizado correctamente');
    }

    /**
     * Actualizar información de la tienda
     */
    public function updateStore(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role !== 'seller') {
            return redirect()->route('home')->with('error', 'Acceso denegado');
        }

        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'store_description' => 'nullable|string',
            'store_phone' => 'nullable|string|max:20',
            'store_email' => 'nullable|email|max:255',
            'store_address' => 'nullable|string',
        ]);

        $store = $user->store;

        if (!$store) {
            // Crear tienda si no existe
            $store = Store::create([
                'user_id' => $user->id,
                'name' => $validated['store_name'],
                'slug' => Str::slug($validated['store_name']),
                'description' => $validated['store_description'] ?? null,
                'phone' => $validated['store_phone'] ?? null,
                'email' => $validated['store_email'] ?? null,
                'address' => $validated['store_address'] ?? null,
            ]);
        } else {
            // Actualizar tienda existente
            $store->update([
                'name' => $validated['store_name'],
                'slug' => Str::slug($validated['store_name']),
                'description' => $validated['store_description'] ?? null,
                'phone' => $validated['store_phone'] ?? null,
                'email' => $validated['store_email'] ?? null,
                'address' => $validated['store_address'] ?? null,
            ]);
        }

        return back()->with('success', 'Información de la tienda actualizada correctamente');
    }
}
