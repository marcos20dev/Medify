<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Paciente extends Authenticatable

    {
        protected $table = 'loginpacientes';
        protected $fillable = ['TipoDoc', 'Numdoc', 'Nombre', 'ApePaterno', 'ApeMaterno', 'Telefono', 'Fechanac', 'Genero', 'Region', 'Provincia', 'Distrito', 'Direccion', 'Gmail', 'Contraseña'];
    }
