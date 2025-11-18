<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Postulacion;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * PERFIL DEL POSTULANTE
     */
    public function perfil()
    {
        $usuarioId = session('usuario_id');

        $estudiante = Estudiante::where('usuario_id', $usuarioId)->first();

        // 🔥 Cargar postulaciones para la vista del perfil
        $postulaciones = Postulacion::with(['oferta.empresa'])
            ->where('estudiante_id', $estudiante->id)
            ->orderBy('fecha_postulacion', 'desc')
            ->get();

        return view('users.perfil', [
            'estudiante' => $estudiante,
            'postulaciones' => $postulaciones,
        ]);
    }

    /**
     * FORMULARIO PARA EDITAR PERFIL
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
     * LISTA DE POSTULACIONES DEL USUARIO
     */
    public function postulaciones()
    {
        $usuarioId = session('usuario_id');
        $estudiante = Estudiante::where('usuario_id', $usuarioId)->first();

        // 🔥 Cargar postulaciones reales
        $postulaciones = Postulacion::with(['oferta.empresa'])
            ->where('estudiante_id', $estudiante->id)
            ->orderBy('fecha_postulacion', 'desc')
            ->get();

        return view('users.postulaciones', compact('postulaciones'));
    }
}
