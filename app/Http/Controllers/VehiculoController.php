<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
    public function create()
    {
        return view('vehiculos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_vehiculo' => ['required', 'string', 'max:60'],
            'Color'           => ['required', 'string', 'max:30'],
            'Marca'           => ['required', 'string', 'max:40'],
            'Modelo'          => ['required', 'string', 'max:20'],
            'Placa'           => ['required', 'string', 'max:10'],
            'Tipo_placa'      => ['required', 'string', 'max:20'],
        ]);

        Vehiculo::create([
            'Nombre_vehiculo' => $request->Nombre_vehiculo,
            'Color'           => $request->Color,
            'Marca'           => $request->Marca,
            'Modelo'          => $request->Modelo,
            'Placa'           => $request->Placa,
            'Tipo_placa'      => $request->Tipo_placa,
            'Id_cliente'      => Auth::user()->Id_cliente,
        ]);

        return redirect('/dashboard');
    }
}