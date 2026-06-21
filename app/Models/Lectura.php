<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lectura extends Model
{
    protected $table      = 'lecturas';
    protected $primaryKey = 'Id_lectura';
    public $timestamps    = false;

    protected $fillable = [
        'Id_sensor',
        'Id_vehiculo',
        'Nivel',
        'Estado',
        'Fecha_lectura',
    ];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class, 'Id_sensor', 'Id_sensor');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'Id_vehiculo', 'Id_vehiculo');
    }
}