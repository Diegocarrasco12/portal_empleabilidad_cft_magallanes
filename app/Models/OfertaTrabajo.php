<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AreaEmpleo;


class OfertaTrabajo extends Model
{
    protected $table = 'ofertas_trabajo';
    public $timestamps = true;

    protected $fillable = [
        'empresa_id',
        'titulo',
        'area_id',
        'tipo_contrato_id',
        'modalidad_id',
        'jornada_id',
        'vacantes',
        'region',
        'ciudad',
        'direccion',
        'sueldo_min',
        'sueldo_max',
        'mostrar_sueldo',
        'beneficios',
        'requisitos',
        'descripcion',
        'habilidades_deseadas',
        'ruta_archivo',
        'nombre_contacto',
        'correo_contacto',
        'telefono_contacto',
        'fecha_cierre',
        'estado',
        'creado_en',
        'actualizado_en',
    ];

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
        public function area()
    {
        return $this->belongsTo(AreaEmpleo::class, 'area_id');
    }
    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class, 'oferta_id');
    }
    public function getFechaPublicacionAttribute()
{
    /* ================================
   ACCESSOR PROFESIONAL
   ================================ */
    // 1) Caso ideal: creado_en tiene valor
    if (!empty($this->creado_en)) {
        return \Carbon\Carbon::parse($this->creado_en);
    }

    // 2) Segundo fallback: actualizado_en
    if (!empty($this->actualizado_en)) {
        return \Carbon\Carbon::parse($this->actualizado_en);
    }

    // 3) Último fallback: fecha actual
    return now();
}

}
