<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table      = 'vehiculo';
    protected $primaryKey = 'Id_vehiculo';
    public $timestamps    = false;

    protected $fillable = [
        'Nombre_vehiculo',
        'Color',
        'Marca',
        'Modelo',
        'Placa',
        'Tipo_placa',
        'Id_cliente',
    ];
}