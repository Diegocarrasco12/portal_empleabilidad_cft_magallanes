<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    // =============================
    // RUTEO DE LA APLICACIÓN
    // =============================
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    // =============================
    // REGISTRO DE MIDDLEWARES (Laravel 11)
    // Aquí registramos alias como "role" y "auth.custom"
    // =============================
    ->withMiddleware(function (Middleware $middleware): void {

        // Alias personalizados
        $middleware->alias([
            'role'        => \App\Http\Middleware\CheckRole::class,
            'auth.custom' => \App\Http\Middleware\AuthCustom::class,   // <-- FALTABA ESTO
        ]);

    })

    // =============================
    // MANEJO DE EXCEPCIONES
    // =============================
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();
