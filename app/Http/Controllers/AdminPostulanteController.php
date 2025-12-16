<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Postulacion;

class AdminPostulanteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $postulantes = Usuario::query()
            ->withTrashed()
            ->where('rol_id', 3)
            ->select('usuarios.*')
            ->selectSub(
                "SELECT COUNT(*) FROM postulaciones 
             JOIN estudiantes ON estudiantes.id = postulaciones.estudiante_id
             WHERE estudiantes.usuario_id = usuarios.id",
                'postulaciones_count'
            )
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('usuarios.nombre', 'LIKE', "%{$search}%")
                        ->orWhere('usuarios.apellido', 'LIKE', "%{$search}%")
                        ->orWhere('usuarios.email', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy('usuarios.creado_en', 'desc')
            ->paginate(10);

        return view('admin.postulantes.index', compact('postulantes', 'search'));
    }

    public function show($id)
    {
        $postulante = Usuario::withTrashed()
            ->where('rol_id', 3)
            ->findOrFail($id);

        // Intentar cargar estudiante con postulaciones
        $estudiante = $postulante->estudiante()
            ->with('postulaciones.oferta')
            ->first();

        // Si NO tiene registro en estudiantes
        if (!$estudiante) {
            return view('admin.postulantes.show', [
                'postulante'   => $postulante,
                'estudiante'   => null,
                'postulaciones' => collect(),
                'warning'      => 'Este usuario no tiene perfil de estudiante asociado.'
            ]);
        }

        return view('admin.postulantes.show', [
            'postulante'   => $postulante,
            'estudiante'   => $estudiante,
            'postulaciones' => $estudiante->postulaciones
        ]);
    }
}
