<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Vehiculo;
use App\Models\Sensor;
use App\Models\Usuario;

class AdminController extends Controller
{
    // Dashboard admin
    public function index()
    {
        $vehiculos = Vehiculo::all();
        $sensores  = Sensor::all();
        $usuarios  = Usuario::all();
        return view('admin.dashboard', compact('vehiculos', 'sensores', 'usuarios'));
    }

    // Vehículos
    public function editarVehiculo($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('admin.vehiculo-editar', compact('vehiculo'));
    }

    public function actualizarVehiculo(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->update([
            'Nombre_vehiculo' => $request->Nombre_vehiculo,
            'Color'           => $request->Color,
            'Marca'           => $request->Marca,
            'Modelo'          => $request->Modelo . '-01-01',
            'Placa'           => $request->Placa,
            'Tipo_placa'      => $request->Tipo_placa,
        ]);
        return redirect('/admin')->with('ok', 'Vehículo actualizado.');
    }

    public function eliminarVehiculo($id)
    {
        Vehiculo::findOrFail($id)->delete();
        return redirect('/admin')->with('ok', 'Vehículo eliminado.');
    }

    // Sensores
    public function editarSensor($id)
    {
        $sensor = Sensor::findOrFail($id);
        return view('admin.sensor-editar', compact('sensor'));
    }

    public function actualizarSensor(Request $request, $id)
    {
        $sensor = Sensor::findOrFail($id);
        $sensor->update([
            'Nombre_sensor' => $request->Nombre_sensor,
            'Tipo_sensor'   => $request->Tipo_sensor,
            'Tipo_daño'     => $request->Tipo_daño,
            'Nivel'         => $request->Nivel,
        ]);
        return redirect('/admin')->with('ok', 'Sensor actualizado.');
    }

    public function eliminarSensor($id)
    {
        Sensor::findOrFail($id)->delete();
        return redirect('/admin')->with('ok', 'Sensor eliminado.');
    }

    public function crearSensor(Request $request)
    {
        Sensor::create([
            'Nombre_sensor' => $request->Nombre_sensor,
            'Tipo_sensor'   => $request->Tipo_sensor,
            'Tipo_daño'     => $request->Tipo_daño,
            'Nivel'         => $request->Nivel ?? 0,
        ]);
        return redirect('/admin')->with('ok', 'Sensor creado.');
    }
}