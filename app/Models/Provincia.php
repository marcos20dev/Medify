<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincias'; // Nombre de la tabla en tu base de datos
    protected $primaryKey = 'idProv'; // Clave primaria de tu tabla (en este caso, 'idProv')
    public $timestamps = false; // Si tu tabla no tiene campos de created_at y updated_at
}
