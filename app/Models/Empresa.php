<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'ruta_logo',
        'nombre_comercial',
        'razon_social',
        'rut',
        'rubro_id',
        'tamano_id',
        'correo_contacto',
        'telefono_contacto',
        'sitio_web',
        'region',
        'ciudad',
        'direccion',
        'descripcion',
        'linkedin',
        'instagram',
        'facebook',
        'recepcion_postulaciones',
        'correo_postulaciones',
        'url_postulaciones',
        'mostrar_sueldo',
        'mostrar_logo',
        'nombre_representante',
        'cargo_representante',
        'correo_representante',
        'creado_en',
        'actualizado_en',
    ];

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
