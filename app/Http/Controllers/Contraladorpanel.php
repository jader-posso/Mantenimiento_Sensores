<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehiculo;
use App\Models\Sensor;
use App\Models\Cliente;

class DashboardController extends Controller
{
    public function index()
    {
        $cliente = Auth::user();

        $vehiculos = Vehiculo::where('id_cliente', $cliente->id_cliente)
                             ->with('sensores')
                             ->get();

        $totalSensores    = $vehiculos->flatMap->sensores->count();
        $sensoresFalla    = $vehiculos->flatMap->sensores->filter(fn($s) => $s->pivot->estado === 'falla')->count();
        $sensoresOk       = $vehiculos->flatMap->sensores->filter(fn($s) => $s->pivot->estado === 'ok')->count();
        $sensoresAdvertencia = $vehiculos->flatMap->sensores->filter(fn($s) => $s->pivot->estado === 'advertencia')->count();

        return view('pages.dashboard', compact(
            'cliente', 'vehiculos',
            'totalSensores', 'sensoresFalla', 'sensoresOk', 'sensoresAdvertencia'
        ));
    }
}