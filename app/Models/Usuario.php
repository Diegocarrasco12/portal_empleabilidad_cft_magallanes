<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'rol_id',
        'rut',
        'nombre',
        'apellido',
        'email',
        'contrasena',
        'email_verificado_en',
        'token_recordar',
        'creado_en',
        'actualizado_en',
    ];

    // Mapear timestamps personalizados
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    // Mutator: Hash automático para "contrasena"
    public function setContrasenaAttribute($value)
    {
        $this->attributes['contrasena'] = Hash::make($value);
    }

    // Relaciones
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function empresa()
    {
        return $this->hasOne(Empresa::class, 'usuario_id');
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'usuario_id');
    }
}
