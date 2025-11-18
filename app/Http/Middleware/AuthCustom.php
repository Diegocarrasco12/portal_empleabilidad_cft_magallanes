<?php

namespace App\Http\Middleware;

use Closure;

class AuthCustom
{
    public function handle($request, Closure $next)
    {
        // Valida que exista la sesión manual creada en AuthController
        if (!session()->has('autenticado') || session('autenticado') !== true) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
