<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table      = 'usuario';
    protected $primaryKey = 'Id_usuario';
    public $timestamps    = false;

    protected $fillable = [
        'Nombre',
        'Correo',
        'Contrasena',
        'Rol',
    ];

    public function getAuthPassword()
    {
        return $this->Contrasena;
    }

    public function esAdmin()
    {
        return $this->Rol === 'admin';
    }
}