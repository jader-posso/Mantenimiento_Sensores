<?php

namespace App\Http\Controllers;

use App\Models\Sensor;

class SensorController extends Controller
{
    public function index()
    {
        $sensores = Sensor::all();
        return view('sensores.index', compact('sensores'));
    }
}