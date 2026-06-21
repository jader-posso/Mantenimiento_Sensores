<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lectura;
use App\Models\Alerta;
use App\Models\Sensor;

class LecturaApiController extends Controller
{
    /**
     * POST /api/lecturas
     * Recibe una lectura desde la app Kotlin y genera alerta si es necesario.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Id_sensor'   => ['required', 'exists:sensores,Id_sensor'],
            'Id_vehiculo' => ['required', 'exists:vehiculo,Id_vehiculo'],
            'Nivel'       => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        // Calcular estado
        $nivel  = $request->Nivel;
        $estado = match(true) {
            $nivel >= 70 => 'falla',
            $nivel >= 40 => 'advertencia',
            default      => 'ok',
        };

        // Guardar lectura
        $lectura = Lectura::create([
            'Id_sensor'   => $request->Id_sensor,
            'Id_vehiculo' => $request->Id_vehiculo,
            'Nivel'       => $nivel,
            'Estado'      => $estado,
        ]);

        // Actualizar nivel del sensor
        Sensor::where('Id_sensor', $request->Id_sensor)
            ->update(['Nivel' => $nivel]);

        // Generar alerta si hay falla o advertencia
        $alerta = null;
        if ($estado !== 'ok') {
            $sensor  = Sensor::find($request->Id_sensor);
            $mensaje = $estado === 'falla'
                ? "Falla crítica en {$sensor->Nombre_sensor}: nivel {$nivel}%. {$sensor->Tipo_daño}."
                : "Advertencia en {$sensor->Nombre_sensor}: nivel {$nivel}%. Monitorear.";

            $alerta = Alerta::create([
                'Id_sensor'   => $request->Id_sensor,
                'Id_vehiculo' => $request->Id_vehiculo,
                'Tipo'        => $estado,
                'Mensaje'     => $mensaje,
            ]);
        }

        return response()->json([
            'lectura' => $lectura,
            'alerta'  => $alerta,
            'estado'  => $estado,
        ], 201);
    }

    /**
     * GET /api/lecturas
     * Retorna el historial de lecturas del cliente autenticado.
     */
    public function index(Request $request)
    {
        $lecturas = Lectura::with(['sensor', 'vehiculo'])
            ->whereHas('vehiculo', function ($q) use ($request) {
                $q->where('Id_cliente', $request->user()->Id_cliente);
            })
            ->orderByDesc('Fecha_lectura')
            ->limit(50)
            ->get()
            ->map(function ($l) {
                return [
                    'id'            => $l->Id_lectura,
                    'sensor'        => $l->sensor->Nombre_sensor,
                    'tipo_sensor'   => $l->sensor->Tipo_sensor,
                    'vehiculo'      => $l->vehiculo->Nombre_vehiculo,
                    'nivel'         => $l->Nivel,
                    'estado'        => $l->Estado,
                    'fecha'         => $l->Fecha_lectura,
                ];
            });

        return response()->json($lecturas);
    }
}