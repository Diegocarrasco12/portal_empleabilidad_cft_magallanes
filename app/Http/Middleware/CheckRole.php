<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Maneja el acceso según el rol (ID) almacenado en sesión.
     *
     * Uso: ->middleware('role:admin')
     * 
     * Roles:
     *  admin      → 1
     *  empresa    → 2
     *  postulante → 3
     */
    public function handle(Request $request, Closure $next, $roleName)
    {
        if (!session('autenticado')) {
            return redirect()->route('login');
        }

        // Mapeo interno de nombres → IDs reales en tu tabla
        $roles = [
            'admin'      => 1,
            'empresa'    => 2,
            'postulante' => 3,
        ];

        // Rol requerido según la ruta
        $requiredRoleId = $roles[$roleName] ?? null;

        // Rol del usuario cargado en sesión
        $userRoleId = session('usuario_rol');

        if ($requiredRoleId === null || $userRoleId !== $requiredRoleId) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
