<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Perfil del postulante/estudiante logueado.
     */
    public function perfil()
    {
        $usuarioId = session('usuario_id');

        $estudiante = Estudiante::where('usuario_id', $usuarioId)->first();

        return view('users.perfil', [
            'estudiante' => $estudiante,
        ]);
    }

    /**
     * Formulario para editar datos del postulante.
     * Más adelante definimos los campos editables.
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
     * Lista de postulaciones del usuario.
     * De momento solo cargamos la vista; luego se conectará
     * a la tabla "postulaciones" para mostrar datos reales.
     */
    public function postulaciones()
    {
        // TODO: traer postulaciones reales del estudiante logueado
        return view('users.postulaciones');
    }
}
