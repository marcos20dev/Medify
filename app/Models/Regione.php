<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regione extends Model
{
    protected $table = 'regiones'; // Nombre de la tabla en tu base de datos
    protected $primaryKey = 'idReg'; // Clave primaria de tu tabla (en este caso, 'idReg')
    public $timestamps = false; // Si tu tabla no tiene campos de created_at y updated_at
}
