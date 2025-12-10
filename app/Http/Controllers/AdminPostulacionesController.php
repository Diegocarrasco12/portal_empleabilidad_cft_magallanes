<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPostulacionesController extends Controller
{
    public function index()
    {
        $postulaciones = \App\Models\Postulacion::with([
            'estudiante.usuario',
            'oferta.empresa'
        ])
            ->orderBy('fecha_postulacion', 'desc')
            ->paginate(12);

        return view('admin.postulaciones.index', compact('postulaciones'));
    }
}
