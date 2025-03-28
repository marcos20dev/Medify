<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table = 'horarios';

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'dni_doctor', 'dni');
    }
}
