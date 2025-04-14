<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctor'; // Nombre de la tabla en la base de datos

    // Otros métodos y relaciones si es necesario
}
