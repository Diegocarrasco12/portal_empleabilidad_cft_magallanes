<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;

class UsuarioController extends Controller
{
    /**
     * Perfil del postulante/estudiante logueado.
     */
    public function perfil()
    {
        $usuarioId = session('usuario_id');

        $estudiante = Estudiante::where('usuario_id', $usuarioId)->first();

        $postulaciones = collect();

        if ($estudiante) {
            $postulaciones = $estudiante->postulaciones()
                ->with(['oferta.empresa'])
                ->orderByDesc('fecha_postulacion')
                ->limit(6)
                ->get();
        }

        return view('users.perfil', [
            'estudiante'    => $estudiante,
            'postulaciones' => $postulaciones,
        ]);
    }

    /**
     * Formulario para editar datos del postulante.
     */
    public function editar()
    {
        $usuarioId = session('usuario_id');
        $estudiante = Estudiante::where('usuario_id', $usuarioId)->first();

        return view('users.editar', [
            'estudiante' => $estudiante,
        ]);
    }

    /**
     * Lista completa de postulaciones del usuario.
     */
    public function postulaciones()
    {
        $usuarioId = session('usuario_id');
        $estudiante = Estudiante::where('usuario_id', $usuarioId)->first();

        $postulaciones = collect();

        if ($estudiante) {
            $postulaciones = $estudiante->postulaciones()
                ->with(['oferta.empresa'])
                ->orderByDesc('fecha_postulacion')
                ->get();
        }

        return view('users.postulaciones', [
            'estudiante'    => $estudiante,
            'postulaciones' => $postulaciones,
        ]);
    }
}
