<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    protected $table = 'modalidades';
    public $timestamps = false;

    protected $fillable = ['nombre'];

    public function ofertas()
    {
        return $this->hasMany(OfertaTrabajo::class, 'modalidad_id');
    }
}
