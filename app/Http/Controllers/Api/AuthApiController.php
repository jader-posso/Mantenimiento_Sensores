<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Cliente;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'correo'     => ['required', 'email'],
            'contrasena' => ['required'],
        ]);

        $cliente = Cliente::where('Correo', $request->correo)->first();

        if (! $cliente || ! Hash::check($request->contrasena, $cliente->Contrasena)) {
            throw ValidationException::withMessages([
                'correo' => ['Las credenciales no coinciden con nuestros registros.'],
            ]);
        }

        $token = $cliente->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'cliente' => [
                'id'       => $cliente->Id_cliente,
                'nombre'   => $cliente->Nombre_cliente,
                'apellido' => $cliente->Apellido_cliente,
                'correo'   => $cliente->Correo,
            ],
        ]);
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

        $token = $cliente->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'cliente' => [
                'id'       => $cliente->Id_cliente,
                'nombre'   => $cliente->Nombre_cliente,
                'apellido' => $cliente->Apellido_cliente,
                'correo'   => $cliente->Correo,
            ],
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['mensaje' => 'Sesión cerrada correctamente.']);
    }

    public function me(Request $request)
    {
        $cliente = $request->user();
        return response()->json([
            'id'       => $cliente->Id_cliente,
            'nombre'   => $cliente->Nombre_cliente,
            'apellido' => $cliente->Apellido_cliente,
            'correo'   => $cliente->Correo,
        ]);
    }
}