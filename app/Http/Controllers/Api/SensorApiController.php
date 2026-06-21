<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sensor;

class SensorApiController extends Controller
{
    public function index()
    {
        $sensores = Sensor::all()->map(function ($sensor) {
            return [
                'id'        => $sensor->Id_sensor,
                'nombre'    => $sensor->Nombre_sensor,
                'tipo'      => $sensor->Tipo_sensor,
                'tipo_daño' => $sensor->Tipo_daño,
                'nivel'     => $sensor->Nivel,
                'estado'    => $this->calcularEstado($sensor->Nivel),
            ];
        });
        return response()->json($sensores);
    }

    public function show($id)
    {
        $sensor = Sensor::findOrFail($id);
        return response()->json([
            'id'        => $sensor->Id_sensor,
            'nombre'    => $sensor->Nombre_sensor,
            'tipo'      => $sensor->Tipo_sensor,
            'tipo_daño' => $sensor->Tipo_daño,
            'nivel'     => $sensor->Nivel,
            'estado'    => $this->calcularEstado($sensor->Nivel),
        ]);
    }

    private function calcularEstado(int $nivel): string
    {
        if ($nivel < 40) return 'ok';
        if ($nivel < 70) return 'advertencia';
        return 'falla';
    }
}