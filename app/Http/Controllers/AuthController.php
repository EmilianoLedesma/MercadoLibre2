<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registro exitoso!');
    }

    // Mostrar formulario de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Redirigir según el rol del usuario
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->route('admin.products.index')->with('success', 'Bienvenido Administrador!');
            }
            
            if ($user->role === 'seller') {
                return redirect()->route('seller.dashboard')->with('success', 'Bienvenido a tu panel de vendedor!');
            }
            
            return redirect()->route('home')->with('success', 'Bienvenido!');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }

    // Mostrar formulario de registro de vendedor
    public function showSellerRegister()
    {
        return view('auth.seller-register');
    }

    // Procesar registro de vendedor
    public function registerSeller(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'store_name' => 'required|string|max:255',
            'store_description' => 'nullable|string|max:1000',
        ]);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'seller',
        ]);

        // Aquí podrías crear un registro en una tabla sellers si existe
        // con store_name, store_description, etc.

        Auth::login($user);

        return redirect()->route('seller.dashboard')->with('success', '¡Bienvenido! Tu cuenta de vendedor ha sido creada exitosamente.');
    }

    // Listar todos los usuarios/clientes
    public function showClientes()
    {
        $clientes = User::all();
        return view('clientes.index', compact('clientes'));
    }
}
