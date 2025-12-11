<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    /**
     * Mostrar listado de recursos (vista admin)
     */
    public function index()
    {
        $recursos = Recurso::orderBy('creado_en', 'desc')->get();
        return view('admin.recursos.index', compact('recursos'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        return view('admin.recursos.create');
    }

    /**
     * Guardar recurso nuevo
     */
    public function store(Request $request)
    {
        // VALIDACIONES
        $request->validate([
            'titulo'   => 'required|string|max:255',
            'resumen'  => 'nullable|string|max:250',
            'contenido' => 'nullable|string',
            'imagen'   => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'estado'   => 'required|boolean',
        ]);

        // NUEVO RECURSO
        $recurso = new Recurso();
        $recurso->titulo     = $request->titulo;
        $recurso->resumen    = $request->resumen;
        $recurso->contenido  = $request->contenido;
        $recurso->estado     = $request->estado;
        $recurso->creado_en  = now();
        $recurso->actualizado_en = now();

        // GUARDAR IMAGEN (si existe)
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('recursos', 'public');
            $recurso->imagen = $path;
        }

        // GUARDAR EN DB
        $recurso->save();

        return redirect()->route('admin.recursos.index')
            ->with('success', 'Recurso creado correctamente.');
    }


    /**
     * Formulario de edición
     */
    public function edit($id)
    {
        $recurso = Recurso::findOrFail($id);
        return view('admin.recursos.edit', compact('recurso'));
    }

    /**
     * Actualizar recurso
     */
    public function update(Request $request, $id)
    {
        // VALIDACIONES
        $request->validate([
            'titulo'   => 'required|string|max:255',
            'resumen'  => 'nullable|string|max:250',
            'contenido' => 'nullable|string',
            'imagen'   => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'estado'   => 'required|boolean',
        ]);

        $recurso = Recurso::findOrFail($id);

        // ACTUALIZAR CAMPOS
        $recurso->titulo        = $request->titulo;
        $recurso->resumen       = $request->resumen;
        $recurso->contenido     = $request->contenido;
        $recurso->estado        = $request->estado;
        $recurso->actualizado_en = now();

        // SI SUBE UNA NUEVA IMAGEN, SE REEMPLAZA
        if ($request->hasFile('imagen')) {

            // eliminar la imagen anterior si existe
            if ($recurso->imagen && Storage::disk('public')->exists($recurso->imagen)) {
                Storage::disk('public')->delete($recurso->imagen);
            }

            // guardar nueva
            $path = $request->file('imagen')->store('recursos', 'public');
            $recurso->imagen = $path;
        }

        // GUARDAR
        $recurso->save();

        return redirect()->route('admin.recursos.index')
            ->with('success', 'Recurso actualizado correctamente.');
    }


    /**
     * Eliminar recurso (soft delete)
     */
    public function destroy($id)
    {
        $recurso = Recurso::findOrFail($id);
        $recurso->delete();

        return redirect()->route('admin.recursos.index')
            ->with('success', 'Recurso eliminado correctamente');
    }

    /**
     * Cambiar estado Publicado / No publicado
     */
    public function toggleStatus($id)
    {
        $recurso = Recurso::findOrFail($id);
        $recurso->estado = !$recurso->estado;
        $recurso->save();

        return redirect()->back()->with('success', 'Estado actualizado correctamente');
    }
}
