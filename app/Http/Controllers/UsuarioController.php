<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use App\Services\OfertaRecommendationService;

class UsuarioController extends Controller
{
    /**
     * PERFIL DEL POSTULANTE
     */
    public function perfil(OfertaRecommendationService $service)
    {
        $usuarioId = session('usuario_id');

        $estudiante = Estudiante::where('usuario_id', $usuarioId)->first();

        // 🔥 Cargar postulaciones para la vista del perfil
        $postulaciones = Postulacion::with(['oferta.empresa'])
            ->where('estudiante_id', $estudiante->id)
            ->orderBy('fecha_postulacion', 'desc')
            ->get();

        // 🔥 Obtener ofertas recomendadas usando el Service
        $ofertasRecomendadas = $service->getRecomendadas($estudiante);

        return view('users.perfil', [
            'estudiante' => $estudiante,
            'postulaciones' => $postulaciones,
            'ofertasRecomendadas' => $ofertasRecomendadas, // ← enviado a la vista
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

    public function update(Request $request)
    {
        $usuarioId = session('usuario_id');

        // ===========================
        // 1. OBTENER MODELOS
        // ===========================
        $estudiante = Estudiante::where('usuario_id', $usuarioId)->first();
        $usuario = $estudiante->usuario;

        // ===========================
        // 2. VALIDAR DATOS
        // ===========================
        $request->validate([
            'nombre'   => 'required|string|max:150',
            'apellido' => 'required|string|max:150',
            'email'    => 'required|email|max:150',

            'run'            => 'nullable|string|max:20',
            'estado'         => 'nullable|string|max:50',
            'titulo'         => 'nullable|string|max:255',
            'telefono'       => 'nullable|string|max:50',
            'ciudad'         => 'nullable|string|max:150',
            'resumen'        => 'nullable|string|max:800',
            'institucion'    => 'nullable|string|max:255',
            'anio_egreso'    => 'nullable|integer|min:1990|max:2099',
            'cursos'         => 'nullable|string',

            'linkedin'       => 'nullable|url|max:255',
            'portfolio'      => 'nullable|url|max:255',

            'area'           => 'nullable|integer',
            'jornada'        => 'nullable|integer',
            'modalidad'      => 'nullable|integer',

            // Archivos
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cv'     => 'nullable|mimes:pdf|max:4096',
        ]);

        // ===========================
        // 3. ACTUALIZAR USUARIO
        // ===========================
        $usuario->nombre   = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->email    = $request->email;
        $usuario->save();

        // ===========================
        // 4. ACTUALIZAR ESTUDIANTE
        // ===========================
        $estudiante->run                     = $request->run;
        $estudiante->estado_carrera         = $request->estado;
        $estudiante->carrera                = $request->titulo;
        $estudiante->telefono               = $request->telefono;
        $estudiante->ciudad                 = $request->ciudad;
        $estudiante->resumen                = $request->resumen;
        $estudiante->institucion            = $request->institucion;
        $estudiante->anio_egreso            = $request->anio_egreso;
        $estudiante->cursos                 = $request->cursos;

        $estudiante->linkedin_url           = $request->linkedin;
        $estudiante->portfolio_url          = $request->portfolio;

        $estudiante->area_interes_id        = $request->area;
        $estudiante->jornada_preferencia_id = $request->jornada;
        $estudiante->modalidad_preferencia_id = $request->modalidad;

        // ===========================
        // 5. MANEJO DE AVATAR
        // ===========================
        if ($request->hasFile('avatar')) {

            // Borrar archivo anterior si existe
            if ($estudiante->avatar && file_exists(storage_path('app/public/' . $estudiante->avatar))) {
                unlink(storage_path('app/public/' . $estudiante->avatar));
            }

            // Guardar nuevo avatar
            $avatarName = 'avatar_' . time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $avatarName);

            $estudiante->avatar = 'avatars/' . $avatarName;
        }

        // ===========================
        // 6. MANEJO DE CV
        // ===========================
        if ($request->hasFile('cv')) {

            // Borrar CV anterior si existe
            if ($estudiante->ruta_cv && file_exists(storage_path('app/public/' . $estudiante->ruta_cv))) {
                unlink(storage_path('app/public/' . $estudiante->ruta_cv));
            }

            // Guardar nuevo CV
            $cvName = 'cv_' . time() . '.' . $request->cv->extension();
            $request->cv->storeAs('public/cv', $cvName);

            $estudiante->ruta_cv = 'cv/' . $cvName;
        }

        $estudiante->save();

        // ===========================
        // 7. REDIRIGIR
        // ===========================
        return redirect('/usuarios/perfil')->with('success', 'Perfil actualizado correctamente.');
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
