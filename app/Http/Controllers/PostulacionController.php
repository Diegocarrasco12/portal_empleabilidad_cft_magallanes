<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\OfertaTrabajo;
use App\Models\Postulacion;

class PostulacionController extends Controller
{
    /**
     * Registrar una nueva postulación
     */
    public function store(Request $request, $id)
    {
        // 1. Obtener el usuario logueado (CORREGIDO)
        $usuarioId = session('usuario_id');

        if (!$usuarioId) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        // 2. Obtener el estudiante asociado al usuario
        $estudiante = Estudiante::where('usuario_id', $usuarioId)->first();

        if (!$estudiante) {
            return back()->with('error', 'Debes completar tu perfil de estudiante antes de postular.');
        }

        // 3. Verificar que la oferta exista
        $oferta = OfertaTrabajo::find($id);

        if (!$oferta) {
            return back()->with('error', 'La oferta de trabajo no existe.');
        }

        // 4. Validar que la oferta esté publicada (1 = publicada)
        if ($oferta->estado != 1) {
            return back()->with('error', 'Esta oferta no está disponible para postulación.');
        }


        // Validar fecha de cierre
        if ($oferta->fecha_cierre && $oferta->fecha_cierre < now()) {
            return back()->with('error', 'La oferta ya cerró su proceso de postulación.');
        }

        // 5. Evitar postulaciones duplicadas
        $yaExiste = Postulacion::where('estudiante_id', $estudiante->id)
            ->where('oferta_id', $id)
            ->exists();

        if ($yaExiste) {
            return back()->with('error', 'Ya postulaste a esta oferta.');
        }

        // 6. Crear la nueva postulación
        Postulacion::create([
            'estudiante_id'      => $estudiante->id,
            'oferta_id'          => $id,
            'estado_postulacion' => 'pendiente',
            'fecha_postulacion'  => now(),
            'creado_en'          => now(),
            'actualizado_en'     => now(),
        ]);

        // 7. Devolver mensaje
        return back()->with('success', '¡Tu postulación fue enviada exitosamente!');
    }

    /**
     * Mostrar las postulaciones del estudiante
     */
    public function index()
    {
        // 1. Usuario logueado (CORREGIDO)
        $usuarioId = session('usuario_id');

        if (!$usuarioId) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        // 2. Obtener el estudiante asociado
        $estudiante = Estudiante::where('usuario_id', $usuarioId)->first();

        if (!$estudiante) {
            return back()->with('error', 'No se encontró tu perfil de estudiante.');
        }

        // 3. Obtener postulaciones
        $postulaciones = Postulacion::with(['oferta.empresa'])
            ->where('estudiante_id', $estudiante->id)
            ->orderBy('fecha_postulacion', 'desc')
            ->get();

        return view('users.mis-postulaciones', compact('postulaciones'));
    }

    /**
     * Mostrar detalle de una postulación específica
     */
    public function show($id)
    {
        // 1. Usuario logueado
        $usuarioId = session('usuario_id');

        if (!$usuarioId) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        // 2. Obtener estudiante
        $estudiante = Estudiante::where('usuario_id', $usuarioId)->first();

        if (!$estudiante) {
            return back()->with('error', 'No se encontró tu perfil de estudiante.');
        }

        // 3. Obtener la postulación
        $postulacion = Postulacion::with(['oferta.empresa'])
            ->where('id', $id)
            ->where('estudiante_id', $estudiante->id)
            ->first();

        if (!$postulacion) {
            return back()->with('error', 'No se encontró esta postulación.');
        }

        return view('users.detalle-postulacion', compact('postulacion'));
    }
    public function modal($id)
    {
        $usuarioId = session('usuario_id');

        if (!$usuarioId) {
            return response()->json(['error' => 'No autenticado'], 403);
        }

        $estudiante = Estudiante::where('usuario_id', $usuarioId)->first();

        if (!$estudiante) {
            return response()->json(['error' => 'Perfil no encontrado'], 404);
        }

        $postulacion = Postulacion::with(['oferta.empresa'])
            ->where('id', $id)
            ->where('estudiante_id', $estudiante->id)
            ->first();

        if (!$postulacion) {
            return response()->json(['error' => 'Postulación no encontrada'], 404);
        }

        $html = view('partials.modal-postulacion', compact('postulacion'))->render();

        return response()->json(['html' => $html]);
    }
}
