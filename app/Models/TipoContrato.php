<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoContrato extends Model
{
    protected $table = 'tipos_contrato';
    public $timestamps = false;

    protected $fillable = ['nombre'];

    public function ofertas()
    {
        return $this->hasMany(OfertaTrabajo::class, 'tipo_contrato_id');
    }
}
