<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alerta;

class AlertaApiController extends Controller
{
    /**
     * GET /api/alertas
     * Retorna las alertas activas del cliente autenticado.
     */
    public function index(Request $request)
    {
        $alertas = Alerta::with(['sensor', 'vehiculo'])
            ->whereHas('vehiculo', function ($q) use ($request) {
                $q->where('Id_cliente', $request->user()->Id_cliente);
            })
            ->where('Leida', false)
            ->orderByDesc('Fecha_alerta')
            ->get()
            ->map(function ($a) {
                return [
                    'id'       => $a->Id_alerta,
                    'sensor'   => $a->sensor->Nombre_sensor,
                    'vehiculo' => $a->vehiculo->Nombre_vehiculo,
                    'tipo'     => $a->Tipo,
                    'mensaje'  => $a->Mensaje,
                    'fecha'    => $a->Fecha_alerta,
                ];
            });

        return response()->json($alertas);
    }

    /**
     * POST /api/alertas/{id}/leer
     * Marca una alerta como leída.
     */
    public function marcarLeida(Request $request, $id)
    {
        $alerta = Alerta::whereHas('vehiculo', function ($q) use ($request) {
            $q->where('Id_cliente', $request->user()->Id_cliente);
        })->findOrFail($id);

        $alerta->update(['Leida' => true]);

        return response()->json(['mensaje' => 'Alerta marcada como leída.']);
    }
}