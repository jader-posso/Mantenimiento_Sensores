<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;

class VehiculoApiController extends Controller
{
    public function index(Request $request)
    {
        $vehiculos = Vehiculo::where('Id_cliente', $request->user()->Id_cliente)->get();
        return response()->json($vehiculos);
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

        $vehiculo = Vehiculo::create([
            'Nombre_vehiculo' => $request->Nombre_vehiculo,
            'Color'           => $request->Color,
            'Marca'           => $request->Marca,
            'Modelo'          => $request->Modelo,
            'Placa'           => $request->Placa,
            'Tipo_placa'      => $request->Tipo_placa,
            'Id_cliente'      => $request->user()->Id_cliente,
        ]);

        return response()->json($vehiculo, 201);
    }

    public function show(Request $request, $id)
    {
        $vehiculo = Vehiculo::where('Id_vehiculo', $id)
            ->where('Id_cliente', $request->user()->Id_cliente)
            ->firstOrFail();
        return response()->json($vehiculo);
    }

    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::where('Id_vehiculo', $id)
            ->where('Id_cliente', $request->user()->Id_cliente)
            ->firstOrFail();

        $request->validate([
            'Nombre_vehiculo' => ['sometimes', 'string', 'max:60'],
            'Color'           => ['sometimes', 'string', 'max:30'],
            'Marca'           => ['sometimes', 'string', 'max:40'],
            'Modelo'          => ['sometimes', 'string', 'max:20'],
            'Placa'           => ['sometimes', 'string', 'max:10'],
            'Tipo_placa'      => ['sometimes', 'string', 'max:20'],
        ]);

        $vehiculo->update($request->only([
            'Nombre_vehiculo', 'Color', 'Marca', 'Modelo', 'Placa', 'Tipo_placa',
        ]));

        return response()->json($vehiculo);
    }

    public function destroy(Request $request, $id)
    {
        $vehiculo = Vehiculo::where('Id_vehiculo', $id)
            ->where('Id_cliente', $request->user()->Id_cliente)
            ->firstOrFail();
        $vehiculo->delete();
        return response()->json(['mensaje' => 'Vehículo eliminado correctamente.']);
    }
}