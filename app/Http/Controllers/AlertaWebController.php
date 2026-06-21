<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Alerta;

class AlertaWebController extends Controller
{
    public function index()
    {
        $cliente = Auth::user();

        $alertas = Alerta::with(['sensor', 'vehiculo'])
            ->whereHas('vehiculo', function ($q) use ($cliente) {
                $q->where('Id_cliente', $cliente->Id_cliente);
            })
            ->orderByDesc('Fecha_alerta')
            ->get();

        $fallas       = $alertas->where('Tipo', 'falla');
        $advertencias = $alertas->where('Tipo', 'advertencia');

        return view('paginas.alertas', compact('cliente', 'alertas', 'fallas', 'advertencias'));
    }
}