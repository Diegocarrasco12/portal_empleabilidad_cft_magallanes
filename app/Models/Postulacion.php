<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'postulaciones';
    public $timestamps = false;

    protected $fillable = [
        'estudiante_id',
        'oferta_id',
        'estado_postulacion',
        'fecha_postulacion',
        'notas',
        'creado_en',
        'actualizado_en',
    ];

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function oferta()
    {
        return $this->belongsTo(OfertaTrabajo::class, 'oferta_id');
    }
}
