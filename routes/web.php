<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpleabilidadController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\AdminEstudianteController;
use App\Http\Controllers\AdminEmpresaController;
use App\Http\Controllers\AdminOfertaApprovalController;
use App\Http\Controllers\AdminPostulanteController;


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
    Route::middleware('role:admin')
        ->prefix('admin')
        ->group(function () {

            // DASHBOARD ADMIN
            Route::get('/', [AdminController::class, 'dashboard'])
                ->name('admin.dashboard');

            /* ===============================
              MÓDULO ADMIN: GESTIÓN ESTUDIANTES
              =============================== */

            Route::get('/estudiantes', [AdminEstudianteController::class, 'index'])
                ->name('admin.estudiantes.index');

            Route::get('/estudiantes/crear', [AdminEstudianteController::class, 'create'])
                ->name('admin.estudiantes.create');

            Route::post('/estudiantes', [AdminEstudianteController::class, 'store'])
                ->name('admin.estudiantes.store');

            Route::get('/estudiantes/{id}/editar', [AdminEstudianteController::class, 'edit'])
                ->name('admin.estudiantes.edit');

            Route::put('/estudiantes/{id}', [AdminEstudianteController::class, 'update'])
                ->name('admin.estudiantes.update');

            Route::delete('/estudiantes/{id}', [AdminEstudianteController::class, 'destroy'])
                ->name('admin.estudiantes.destroy');

            Route::patch('/estudiantes/{id}/restaurar', [AdminEstudianteController::class, 'restore'])
                ->name('admin.estudiantes.restore');
            /* ===============================
              MÓDULO ADMIN: GESTIÓN EMPRESAS
             =============================== */

            Route::get('/empresas', [AdminEmpresaController::class, 'index'])
                ->name('admin.empresas.index');

            Route::get('/empresas/crear', [AdminEmpresaController::class, 'create'])
                ->name('admin.empresas.create');

            Route::post('/empresas', [AdminEmpresaController::class, 'store'])
                ->name('admin.empresas.store');

            Route::get('/empresas/{id}/editar', [AdminEmpresaController::class, 'edit'])
                ->name('admin.empresas.edit');

            Route::put('/empresas/{id}', [AdminEmpresaController::class, 'update'])
                ->name('admin.empresas.update');

            Route::delete('/empresas/{id}', [AdminEmpresaController::class, 'destroy'])
                ->name('admin.empresas.destroy');

            Route::patch('/empresas/{id}/restaurar', [AdminEmpresaController::class, 'restore'])
                ->name('admin.empresas.restore');

            /* ===============================
              MÓDULO ADMIN: VALIDACIÓN OFERTAS
            =============================== */

            Route::get('/ofertas', [AdminOfertaApprovalController::class, 'index'])
                ->name('admin.ofertas.index');

            Route::get('/ofertas/{id}', [AdminOfertaApprovalController::class, 'show'])
                ->name('admin.ofertas.show');

            Route::patch('/ofertas/{id}/aprobar', [AdminOfertaApprovalController::class, 'approve'])
                ->name('admin.ofertas.approve');

            Route::patch('/ofertas/{id}/rechazar', [AdminOfertaApprovalController::class, 'reject'])
                ->name('admin.ofertas.reject');
            Route::patch('/ofertas/{id}/resubmit', [AdminOfertaApprovalController::class, 'resubmit'])
                ->name('admin.ofertas.resubmit');

            /* ===============================
              MÓDULO ADMIN: POSTULANTES
            =============================== */

            Route::get('/postulantes', [AdminPostulanteController::class, 'index'])
                ->name('admin.postulantes.index');

            Route::get('/postulantes/{id}', [AdminPostulanteController::class, 'show'])
                ->name('admin.postulantes.show');
            /* ===============================
               MÓDULO ADMIN: POSTULACIONES
            =============================== */

            Route::get('/postulaciones', [\App\Http\Controllers\AdminPostulacionesController::class, 'index'])
                ->name('admin.postulaciones.index');
        });

    /* ------------------------- EMPRESAS (rol: empresa) ------------------------- */
    Route::middleware('role:empresa')
        ->prefix('empresas')
        ->group(function () {
            Route::get('/postulaciones', [EmpresaController::class, 'verPostulaciones'])
                ->name('empresas.postulaciones.index');
            Route::get('/postulante/{id}', [EmpresaController::class, 'verPostulante'])
                ->name('empresas.postulante');
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
            Route::put('/ofertas/{id}', [EmpresaController::class, 'updateOferta'])
                ->name('empresas.ofertas.update');
            Route::get('/ofertas/{id}/editar', [EmpresaController::class, 'editarOferta'])
                ->name('empresas.ofertas.editar');
            Route::delete('/ofertas/{id}', [EmpresaController::class, 'destroyOferta'])
                ->name('empresas.ofertas.destroy');
            Route::get('/ofertas', [EmpresaController::class, 'misOfertas'])
                ->name('empresas.ofertas.index');
            Route::post('/ofertas/{id}/enviar', [EmpresaController::class, 'enviarRevision'])
                ->name('empresas.ofertas.enviarRevision');

            Route::post('/ofertas/{id}/pausar', [EmpresaController::class, 'pausar'])
                ->name('empresas.ofertas.pausar');
            Route::post('/ofertas/{id}/reactivar', [EmpresaController::class, 'reactivar'])
                ->name('empresas.ofertas.reactivar');

            Route::post('/ofertas/{id}/cerrar', [EmpresaController::class, 'cerrar'])
                ->name('empresas.ofertas.cerrar');
        });


    /* -------------------- POSTULANTES / USUARIOS (rol: postulante) -------------------- */
    Route::middleware('role:postulante')
        ->prefix('usuarios')
        ->group(function () {

            Route::get('/perfil', [UsuarioController::class, 'perfil'])
                ->name('usuarios.perfil');

            Route::get('/editar', [UsuarioController::class, 'editar'])
                ->name('usuarios.editar');
            Route::post('/editar', [UsuarioController::class, 'update'])
                ->name('usuarios.update');

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
