<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $table      = 'alertas';
    protected $primaryKey = 'Id_alerta';
    public $timestamps    = false;

    protected $fillable = [
        'Id_sensor',
        'Id_vehiculo',
        'Tipo',
        'Mensaje',
        'Leida',
        'Fecha_alerta',
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