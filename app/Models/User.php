<?php
namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'Provincia', 'idProv');
    }

    public function region()
    {
        return $this->belongsTo(Regione::class, 'Region', 'idReg');
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'Distrito', 'idDist');
    }


    // Otros atributos, métodos y configuraciones del modelo

    protected $fillable = [
        'TipoDoc',
        'Numdoc',
        'Nombre',
        'ApePaterno',
        'ApeMaterno',
        'Telefono',
        'Fechanac',
        'Genero',
        'Region',
        'Provincia',
        'Distrito',
        'Direccion',
        'Gmail',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthIdentifierName()
    {
        return 'Numdoc';  // Especifica que 'Numdoc' se usa como identificador de autenticación
    }

}

