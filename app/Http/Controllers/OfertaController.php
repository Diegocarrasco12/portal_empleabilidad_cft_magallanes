<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfertaTrabajo;

class OfertaController extends Controller
{
    /**
     * Mostrar el detalle de una oferta de trabajo
     */
    public function show($id)
    {
        $oferta = OfertaTrabajo::find($id);

        if (!$oferta) {
            abort(404, 'La oferta no existe.');
        }

        return view('ofertas.detalle', compact('oferta'));
    }
}
