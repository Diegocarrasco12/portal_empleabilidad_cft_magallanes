<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'landing')->name('home');
Route::get('/admin', function () {
    // Datos “mock” para el saludo (opcional)
    return view('admin.dashboard', [
        'adminName' => 'Macarena Navarro',
    ]);
    // Perfil admin    
})->name('admin.dashboard');
// Perfil empresa
Route::get('/empresas/perfil', function () {
    return view('empresas.perfil');
})->name('empresas.perfil');
// Editar perfil empresa (form)
Route::get('/empresas/editar', function () {
    return view('empresas.editar');
})->name('empresas.editar');

// Guardar perfil empresa (mock)
Route::post('/empresas/perfil/update', function (\Illuminate\Http\Request $request) {
    // TODO: validar/guardar en BD
    return redirect()->route('empresas.perfil')->with('ok', 'Perfil de empresa actualizado');
})->name('empresas.perfil.update');


// Crear nueva oferta Vista de creación
Route::get('/empresas/crear', function () {
    return view('empresas.crear_oferta');
})->name('empresas.crear');

// Envío del formulario (ajusta a tu controlador real)
Route::post('/empresas/ofertas', function () {
    // TODO: validar/guardar -> redirigir
    return redirect()->route('empresas.perfil')->with('ok', 'Oferta publicada');
})->name('empresas.ofertas.store');
// Perfil usuario
Route::get('/usuarios/perfil', function () {
    return view('users.perfil');
})->name('usuarios.perfil');
Route::get('/usuarios/editar', function () {
    return view('users.editar');
})->name('usuarios.editar');
// Perfil postulante: lista de postulaciones
Route::get('/usuarios/postulaciones', function () {
    return view('users.postulaciones');
})->name('users.postulaciones');
// Mostrar login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Procesar login (mock: sólo redirige)
// Cuando integres Auth real, reemplaza por tu controlador.
Route::post('/login', function (\Illuminate\Http\Request $request) {
    // Aquí iría tu lógica real de autenticación
    return redirect('/'); // o a /admin, /usuarios/perfil, etc.
});
// Mostrar registro
Route::get('/registrarse', function () {
    return view('auth.register');
})->name('register');

// Procesar registro (demo: redirige; luego conectas a tu lógica real)
Route::post('/registrarse', function (\Illuminate\Http\Request $request) {
    // Aquí conectarás con tu UserController/validator/creación de cuenta
    return redirect('/login')->with('status', 'Cuenta creada. Revisa tu correo para confirmar (demo).');
});
// Buscador de empleos (mock)
Route::get('/empleos', function () {
    // en el futuro aquí leerás request()->query() para filtrar en BD
    return view('jobs.index');
})->name('jobs.index');
