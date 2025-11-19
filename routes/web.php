<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpleabilidadController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\OfertaController;


/*
|--------------------------------------------------------------------------
| WEB ROUTES – CFT Empleabilidad
|--------------------------------------------------------------------------
| Estructura:
| 1) Rutas públicas (landing, login, registro, recursos)
| 2) Rutas protegidas por sesión manual  (auth.custom)
| 3) Rutas protegidas por rol           (role:admin/empresa/postulante)
|
| La autenticación se maneja en AuthController usando la tabla "usuarios".
|--------------------------------------------------------------------------
*/


/* ============================================================
   1) RUTA PRINCIPAL / LANDING (Pública)
============================================================ */

Route::view('/', 'landing')->name('home');
Route::get('/ofertas/{id}', [OfertaController::class, 'show'])
    ->name('ofertas.detalle');



/* ============================================================
   2) AUTENTICACIÓN REAL – AuthController (Público)
============================================================ */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/registrarse', [AuthController::class, 'showRegister'])->name('register');
Route::post('/registrarse', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



/* ============================================================
   3) RUTAS PROTEGIDAS POR SESIÓN MANUAL – auth.custom
============================================================ */
Route::middleware('auth.custom')->group(function () {

    /* ------------------------- ADMIN (rol: admin) ------------------------- */
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');
    });


    /* ------------------------- EMPRESAS (rol: empresa) ------------------------- */
    Route::middleware('role:empresa')
        ->prefix('empresas')
        ->group(function () {

            Route::get('/perfil', [EmpresaController::class, 'perfil'])
                ->name('empresas.perfil');

            Route::get('/editar', [EmpresaController::class, 'editar'])
                ->name('empresas.editar');

            Route::post('/perfil/update', [EmpresaController::class, 'updatePerfil'])
                ->name('empresas.perfil.update');

            Route::get('/crear', [EmpresaController::class, 'crearOferta'])
                ->name('empresas.crear');

            Route::post('/ofertas', [EmpresaController::class, 'storeOferta'])
                ->name('empresas.ofertas.store');
        });


    /* -------------------- POSTULANTES / USUARIOS (rol: postulante) -------------------- */
    Route::middleware('role:postulante')
        ->prefix('usuarios')
        ->group(function () {

            Route::get('/perfil', [UsuarioController::class, 'perfil'])
                ->name('usuarios.perfil');

            Route::get('/editar', [UsuarioController::class, 'editar'])
                ->name('usuarios.editar');
            // POSTULAR A UNA OFERTA
            Route::post('/postular/{id}', [PostulacionController::class, 'store'])
                ->name('postulaciones.store');

            // VER MIS POSTULACIONES
            Route::get('/mis-postulaciones', [PostulacionController::class, 'index'])
                ->name('postulaciones.index');
            // VER DETALLE DE UNA POSTULACIÓN
            Route::get('/mis-postulaciones/{id}', [PostulacionController::class, 'show'])
                ->name('postulaciones.show');
            // Ruta AJAX para cargar modal de detalle de postulación
            Route::get('/postulacion-detalle/{id}', [PostulacionController::class, 'modal'])
                ->middleware(['auth.custom', 'role:postulante'])
                ->name('postulaciones.modal');
        });
});



/* ============================================================
   4) BUSCADOR DE EMPLEOS (PÚBLICO – mock)
============================================================ */
Route::get('/empleos', function () {
    return view('jobs.index');
})->name('jobs.index');



/* ============================================================
   5) RECURSOS DE EMPLEABILIDAD (Controlador real)
============================================================ */
Route::get('/recursos-empleabilidad', [EmpleabilidadController::class, 'index'])
    ->name('empleabilidad.index');

Route::get('/recursos-empleabilidad/{slug}', [EmpleabilidadController::class, 'show'])
    ->name('empleabilidad.show');
