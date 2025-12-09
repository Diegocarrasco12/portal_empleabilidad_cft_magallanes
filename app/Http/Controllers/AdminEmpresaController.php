<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminEmpresaController extends Controller
{
    /**
     * Listado de empresas (incluye eliminadas)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $empresas = Usuario::where('rol_id', 2)
            ->with(['empresa'])
            ->withTrashed()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('rut', 'like', "%$search%");
                });
            })
            ->get();

        return view('admin.empresas.index', compact('empresas', 'search'));
    }


    /**
     * Formulario creación empresa
     */
    public function create()
    {
        return view('admin.empresas.create');
    }


    /**
     * Guardar nueva empresa
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'        => 'required|string|max:255',
            'email'         => 'required|email|unique:usuarios,email',
            'rut'           => 'required|unique:usuarios,rut',
            'contrasena'    => 'required|confirmed|min:6',
            'razon_social'  => 'required|string|max:255',
        ]);

        // Crear usuario
        $usuario = Usuario::create([
            'rol_id' => 2,
            'nombre' => $validated['nombre'],
            'apellido' => null, // ← NECESARIO
            'email' => $validated['email'],
            'rut' => $validated['rut'],
            'contrasena' => $validated['contrasena'], // mutator lo hash
        ]);


        // Crear empresa asociada
        $usuario->empresa()->create([
            'rut' => $validated['rut'],
            'telefono_contacto' => $request->telefono,
            'razon_social' => $validated['razon_social'],
            'sitio_web' => $request->sitio_web,
            'correo_contacto' => $validated['email'], 
        ]);


        return redirect()->route('admin.empresas.index')
            ->with('success', 'Empresa registrada correctamente.');
    }


    /**
     * Formulario edición
     */
    public function edit($id)
    {
        $empresa = Usuario::with(['empresa'])->withTrashed()->findOrFail($id);
        return view('admin.empresas.edit', compact('empresa'));
    }


    /**
     * Actualizar empresa
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre'        => 'required',
            'email'         => "required|email|unique:usuarios,email,$id",
            'rut'           => "required|unique:usuarios,rut,$id",
            'razon_social'  => 'required',
        ]);

        $usuario->update([
            'nombre' => $request->nombre,
            'apellido' => null, // ← también aquí
            'email' => $request->email,
            'rut' => $request->rut,
        ]);

        $usuario->empresa()->update([
            'telefono_contacto' => $request->telefono,
            'razon_social'      => $request->razon_social,
            'sitio_web'         => $request->sitio_web,
        ]);

        return redirect()->route('admin.empresas.index')
            ->with('success', 'Empresa actualizada correctamente.');
    }


    /**
     * Eliminar (soft delete)
     */
    public function destroy($id)
    {
        Usuario::findOrFail($id)->delete();

        return back()->with('success', 'Empresa eliminada.');
    }


    /**
     * Restaurar
     */
    public function restore($id)
    {
        Usuario::withTrashed()->findOrFail($id)->restore();

        return back()->with('success', 'Empresa restaurada.');
    }
}
