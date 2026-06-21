<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;

class AuthController extends Controller
{
    // ── Show login form ──────────────────────────────────────
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    // ── Handle login ─────────────────────────────────────────
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    // ── Show register form ───────────────────────────────────
    public function showRegister()
    {
        return view('auth.register');
    }

    // ── Handle register ──────────────────────────────────────
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nombre_cliente'   => ['required', 'string', 'max:60'],
            'apellido_cliente' => ['required', 'string', 'max:60'],
            'correo'           => ['required', 'email', 'max:70', 'unique:clientes,correo'],
            'contrasena'       => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $cliente = Cliente::create([
            'nombre_cliente'   => $validated['nombre_cliente'],
            'apellido_cliente' => $validated['apellido_cliente'],
            'correo'           => $validated['correo'],
            'contrasena'       => Hash::make($validated['contrasena']),
        ]);

        Auth::login($cliente);

        return redirect()->route('dashboard');
    }

    // ── Logout ───────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
