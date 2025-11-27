<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaEmpleo extends Model
{
    protected $table = 'areas_empleo';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    public function ofertas()
    {
        return $this->hasMany(OfertaTrabajo::class, 'area_id');
    }
}
