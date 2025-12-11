<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminEstudianteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Usuario::where('rol_id', 3)->withTrashed();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%$search%")
                    ->orWhere('apellido', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('rut', 'LIKE', "%$search%");
            });
        }

        $estudiantes = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.estudiantes.index', compact('estudiantes', 'search'));
    }
    public function create()
    {
        return view('admin.estudiantes.create');
    }


    public function store(Request $request)
    {
        // 1) Validación con mensajes personalizados
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'rut' => 'required|string|max:20|unique:usuarios,rut',
            'email' => 'required|email|unique:usuarios,email',
            'contrasena' => 'required|confirmed|min:6',

            // Opcionales pero validados
            'telefono' => 'nullable|string|max:20',
            'ciudad' => 'nullable|string|max:100',
            'carrera' => 'nullable|string|max:150',
            'institucion' => 'nullable|string|max:150',
            'estado_carrera' => 'nullable|string|max:50',
            'anio_egreso' => 'nullable|integer|min:1990|max:2100',
            'resumen' => 'nullable|string|max:1000',
            'cursos' => 'nullable|string|max:1000',
            'linkedin_url' => 'nullable|url|max:255',
            'portfolio_url' => 'nullable|url|max:255',
        ], [
            'required' => 'Este campo es obligatorio.',
            'email.email' => 'Debes ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'rut.unique' => 'El RUT ingresado ya existe en el sistema.',
            'contrasena.confirmed' => 'Las contraseñas no coinciden.',
            'contrasena.min' => 'La contraseña debe tener mínimo 6 caracteres.',
        ]);

        // 2) Crear registro en tabla usuarios
        $usuario = Usuario::create([
            'rol_id' => 3, // Estudiante fijo
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'rut' => $validated['rut'],
            'email' => $validated['email'],
            'contrasena' => $validated['contrasena'],  // Mutator lo hasheará
        ]);

        // 3) Crear registro en tabla estudiantes
        $usuario->estudiante()->create([
            'telefono' => $validated['telefono'] ?? null,
            'ciudad' => $validated['ciudad'] ?? null,
            'carrera' => $validated['carrera'] ?? null,
            'institucion' => $validated['institucion'] ?? 'CFT Magallanes',
            'estado_carrera' => $validated['estado_carrera'] ?? null,
            'anio_egreso' => $validated['anio_egreso'] ?? null,
            'resumen' => $validated['resumen'] ?? null,
            'cursos' => $validated['cursos'] ?? null,
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'portfolio_url' => $validated['portfolio_url'] ?? null,
        ]);

        // 4) Redirección con mensaje de éxito
        return redirect()
            ->route('admin.estudiantes.index')
            ->with('success', 'Estudiante registrado correctamente.');
    }



    public function edit($id)
    {
        $estudiante = Usuario::findOrFail($id);
        return view('admin.estudiantes.edit', compact('estudiante'));
    }

    public function update(Request $request, $id)
    {
        $estudiante = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rut' => "required|string|max:20|unique:usuarios,rut,$id",
            'email' => "required|email|unique:usuarios,email,$id",
        ]);

        $estudiante->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'rut' => $request->rut,
            'email' => $request->email,
            'actualizado_en' => now(),
        ]);

        return redirect()->route('admin.estudiantes.index')
            ->with('success', 'Estudiante actualizado correctamente.');
    }


    public function destroy($id)
    {
        Usuario::findOrFail($id)->delete();
        return redirect()->route('admin.estudiantes.index')
            ->with('success', 'Estudiante eliminado correctamente.');
    }

    public function restore($id)
    {
        Usuario::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.estudiantes.index')
            ->with('success', 'Estudiante restaurado correctamente.');
    }
}
