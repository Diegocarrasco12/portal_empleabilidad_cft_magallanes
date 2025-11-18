<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Dashboard principal del administrador.
     *
     * Middleware:
     *  - auth.custom  → exige sesión iniciada (session('autenticado') === true)
     *  - role:admin   → exige que el usuario tenga rol "admin" en la tabla roles
     */
    public function dashboard()
    {
        return view('admin.dashboard', [
            // Tomamos el nombre desde la sesión manual configurada en AuthController
            'adminName' => session('usuario_nombre'),
        ]);
    }
}
