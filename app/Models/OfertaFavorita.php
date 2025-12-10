<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfertaFavorita extends Model
{
    protected $table = 'ofertas_favoritas';

    /** 
     * Esta tabla NO tiene los timestamps de Laravel,
     * así que los apagamos.
     */
    public $timestamps = false;

    protected $fillable = [
        'estudiante_id',
        'oferta_id',
        'fecha_guardado'
    ];

    /** ============================
     *  Relaciones
     *  ============================ */

    public function oferta()
    {
        return $this->belongsTo(OfertaTrabajo::class, 'oferta_id');
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }
}
