<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AreaEmpleo;

class OfertaTrabajo extends Model
{
    protected $table = 'ofertas_trabajo';
    public $timestamps = true;

    /** ============================
     *  Estados del Workflow de Ofertas
     *  ============================ */
    const ESTADO_PENDIENTE   = 0;
    const ESTADO_APROBADA    = 1;
    const ESTADO_RECHAZADA   = 2;
    const ESTADO_REENVIADA   = 3;


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
    protected $casts = [
        'estado' => 'integer',
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

    /** ============================
     *  Accessor fecha publicación
     *  ============================ */
    public function getFechaPublicacionAttribute()
    {
        if (!empty($this->creado_en)) {
            return \Carbon\Carbon::parse($this->creado_en);
        }

        if (!empty($this->actualizado_en)) {
            return \Carbon\Carbon::parse($this->actualizado_en);
        }

        return now();
    }

    /** ============================
     *  Accessor legible para admin
     *  ============================ */
    public function getEstadoNombreAttribute()
    {
        return match ((int)$this->estado) {
            self::ESTADO_APROBADA    => 'Aprobada',
            self::ESTADO_RECHAZADA   => 'Rechazada',
            self::ESTADO_REENVIADA   => 'Reenviada',
            default                  => 'Pendiente',
        };
    }
}
