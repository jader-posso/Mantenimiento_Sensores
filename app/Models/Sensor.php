<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $table      = 'sensores';
    protected $primaryKey = 'Id_sensor';
    public $timestamps    = false;

    protected $fillable = [
        'Nombre_sensor',
        'Tipo_sensor',
        'Tipo_daño',
        'Nivel',
    ];
}