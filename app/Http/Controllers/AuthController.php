<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo'     => ['required', 'email'],
            'contrasena' => ['required'],
        ]);

      if (Auth::attempt(['Correo' => $request->correo, 'password' => $request->contrasena])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'correo' => 'Correo o contraseña incorrectos.',
        ])->onlyInput('correo');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre_cliente'   => ['required', 'string', 'max:60'],
            'apellido_cliente' => ['required', 'string', 'max:60'],
            'correo'           => ['required', 'email', 'max:70', 'unique:cliente,Correo'],
            'contrasena'       => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $cliente = Cliente::create([
            'Nombre_cliente'   => $request->nombre_cliente,
            'Apellido_cliente' => $request->apellido_cliente,
            'Correo'           => $request->correo,
            'Contrasena'       => Hash::make($request->contrasena),
        ]);

        Auth::login($cliente);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}