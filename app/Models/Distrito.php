<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $table = 'distritos'; // Nombre de la tabla en tu base de datos
    protected $primaryKey = 'idDist'; // Clave primaria de tu tabla (en este caso, 'idDist')
    public $timestamps = false; // Si tu tabla no tiene campos de created_at y updated_at
}
