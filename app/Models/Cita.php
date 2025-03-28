<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    // Incluir el campo estado_perdido para que sea asignable masivamente
    protected $fillable = ['doctor_id', 'horario_id', 'users_id', 'estado', 'estado_perdido'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'dni');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'horario_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
