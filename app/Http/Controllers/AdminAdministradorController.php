<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminAdministradorController extends Controller
{
    /* =========================================================
       LISTADO DE ADMINISTRADORES
       ========================================================= */
    public function index(Request $request)
    {
        $query = DB::table('usuarios')
            ->where('rol_id', 1); // 1 = Administrador

        // 🔍 Buscador simple (nombre, apellido, email, rut)
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                    ->orWhere('apellido', 'like', "%{$buscar}%")
                    ->orWhere('email', 'like', "%{$buscar}%")
                    ->orWhere('rut', 'like', "%{$buscar}%");
            });
        }

        $administradores = $query
            ->orderBy('creado_en', 'desc')
            ->paginate(10);

        return view('admin.administradores.index', compact('administradores'));
    }

    /* =========================================================
       FORMULARIO CREAR ADMINISTRADOR
       ========================================================= */
    public function create()
    {
        return view('admin.administradores.create');
    }

    /* =========================================================
       GUARDAR NUEVO ADMINISTRADOR
       ========================================================= */
    public function store(Request $request)
    {
        // ✅ Validación
        $request->validate([
            'nombre'       => 'required|string|max:100',
            'apellido'     => 'required|string|max:100',
            'rut'          => 'required|string|max:20|unique:usuarios,rut',
            'email'        => 'required|email|max:150|unique:usuarios,email',
            'contrasena'   => 'required|string|min:6|confirmed',
        ]);

        // ✅ Insertar administrador
        DB::table('usuarios')->insert([
            'nombre'        => $request->nombre,
            'apellido'      => $request->apellido,
            'rut'           => $request->rut,
            'email'         => $request->email,
            'contrasena'    => bcrypt($request->contrasena),
            'rol_id'        => 1, // ADMIN
            'creado_en'     => now(),
            'actualizado_en' => now(),
        ]);


        return redirect()
            ->route('admin.administradores.index')
            ->with('success', 'Administrador creado correctamente.');
    }
}
