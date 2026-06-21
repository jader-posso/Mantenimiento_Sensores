<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Vehiculo;
use App\Models\Sensor;

class DashboardController extends Controller
{
    public function index()
    {
        $cliente  = Auth::user();

        $vehiculos = Vehiculo::where('Id_cliente', $cliente->Id_cliente)->get();

        $sensores            = Sensor::all();
        $totalSensores       = $sensores->count();
        $sensoresOk          = $sensores->filter(fn($s) => $s->Nivel < 40)->count();
        $sensoresAdvertencia = $sensores->filter(fn($s) => $s->Nivel >= 40 && $s->Nivel < 70)->count();
        $sensoresFalla       = $sensores->filter(fn($s) => $s->Nivel >= 70)->count();

        return view('paginas.dashbord', compact(
            'cliente', 'vehiculos',
            'totalSensores', 'sensoresFalla', 'sensoresOk', 'sensoresAdvertencia'
        ));
    }

  public function vehiculos()
{
    $cliente   = Auth::user();
    $vehiculos = Vehiculo::where('Id_cliente', $cliente->Id_cliente)->get();
    return view('carros.mis-vehiculos', compact('vehiculos'));
}

    public function nosotros()
    {
        return view('paginas.nosotros');
    }
}