<?php

namespace App\Http\Controllers;

use App\Models\Recurso;

class RecursoPublicoController extends Controller
{
    /**
     * Página pública con todos los recursos publicados.
     */
    public function index()
    {
        $recursos = Recurso::where('estado', 1) // solo publicados
            ->orderBy('creado_en', 'desc')
            ->get();

        return view('empleabilidad.recursos.index', compact('recursos'));
    }

    /**
     * Mostrar detalle de un recurso.
     */
    public function show($id)
    {
        $recurso = Recurso::where('estado', 1) // seguridad: solo publicados
            ->findOrFail($id);

        return view('empleabilidad.recursos.show', compact('recurso'));

    }
}
