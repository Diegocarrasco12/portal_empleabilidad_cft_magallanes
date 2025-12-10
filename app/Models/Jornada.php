<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    protected $table = 'jornadas';
    public $timestamps = false;

    protected $fillable = ['nombre'];

    public function ofertas()
    {
        return $this->hasMany(OfertaTrabajo::class, 'jornada_id');
    }
}
