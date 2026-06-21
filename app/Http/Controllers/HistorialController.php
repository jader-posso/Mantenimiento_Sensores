<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Lectura;

class HistorialController extends Controller
{
    public function index()
    {
        $cliente = Auth::user();

        $lecturas = Lectura::with(['sensor', 'vehiculo'])
            ->whereHas('vehiculo', function ($q) use ($cliente) {
                $q->where('Id_cliente', $cliente->Id_cliente);
            })
            ->orderByDesc('Fecha_lectura')
            ->get();

        return view('paginas.historial', compact('cliente', 'lecturas'));
    }
}