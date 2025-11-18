<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Muestra el perfil de la empresa logueada.
     * Más adelante cargaremos datos reales desde la BD.
     */
    public function perfil()
    {
        $usuarioId = session('usuario_id');

        // Búsqueda simple (mock inicial con BD real)
        $empresa = Empresa::where('usuario_id', $usuarioId)->first();

        return view('empresas.perfil', [
            'empresa' => $empresa,
        ]);
    }

    /**
     * Formulario para editar el perfil de la empresa.
     */
    public function editar()
    {
        $usuarioId = session('usuario_id');
        $empresa   = Empresa::where('usuario_id', $usuarioId)->first();

        return view('empresas.editar', [
            'empresa' => $empresa,
        ]);
    }

    /**
     * Actualiza datos básicos del perfil.
     * De momento solo validamos campos simples y redirigimos.
     * Más adelante definimos exactamente qué campos se pueden editar.
     */
    public function updatePerfil(Request $request)
    {
        $usuarioId = session('usuario_id');

        $request->validate([
            'nombre_comercial' => 'nullable|string|max:150',
            'rut'              => 'nullable|string|max:20',
            'correo_contacto'  => 'nullable|email|max:150',
            'telefono_contacto'=> 'nullable|string|max:50',
        ]);

        $empresa = Empresa::firstOrCreate(
            ['usuario_id' => $usuarioId],
            [
                'nombre_comercial'  => $request->input('nombre_comercial', 'Sin nombre'),
                'rut'               => $request->input('rut'),
                'correo_contacto'   => $request->input('correo_contacto', session('usuario_email')),
                'telefono_contacto' => $request->input('telefono_contacto', 'No informado'),
            ]
        );

        // Actualizar si ya existe
        $empresa->update($request->only([
            'nombre_comercial',
            'rut',
            'correo_contacto',
            'telefono_contacto',
        ]));

        return redirect()->route('empresas.perfil')
            ->with('ok', 'Perfil de empresa actualizado correctamente.');
    }

    /**
     * Formulario para crear una nueva oferta laboral.
     */
    public function crearOferta()
    {
        return view('empresas.crear_oferta');
    }

    /**
     * Guarda una nueva oferta laboral.
     * Por ahora es un stub: solo muestra mensaje de éxito.
     * Más adelante lo conectamos a la tabla ofertas_trabajo.
     */
    public function storeOferta(Request $request)
    {
        // TODO: implementar creación en tabla ofertas_trabajo

        return redirect()
            ->route('empresas.perfil')
            ->with('ok', 'Oferta publicada (pendiente implementar guardado real en BD).');
    }
}
