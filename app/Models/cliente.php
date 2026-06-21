<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable
{

    use HasApiTokens;
    protected $table      = 'cliente';
    protected $primaryKey = 'Id_cliente';

    public $timestamps = false;

    protected $fillable = [
        'Nombre_cliente',
        'Apellido_cliente',
        'Correo',
        'Contrasena',
    ];

    // Le dice a Laravel cuál columna usar como password
    public function getAuthPassword()
    {
        return $this->Contrasena;
    }
}