<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Empresa;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /* ============================================================
       LOGIN
    ============================================================ */
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario) {
            return back()->withErrors(['email' => 'El correo no está registrado.'])
                         ->withInput();
        }

        if (!Hash::check($request->password, $usuario->contrasena)) {
            return back()->withErrors(['password' => 'La contraseña es incorrecta.'])
                         ->withInput();
        }

        // Sesión manual
        session([
            'usuario_id'     => $usuario->id,
            'usuario_nombre' => $usuario->nombre,
            'usuario_rol'    => $usuario->rol_id,
            'autenticado'    => true,
        ]);

        // Redirección por rol
        return match ((int)$usuario->rol_id) {
            1 => redirect()->route('admin.dashboard'),
            2 => redirect()->route('empresas.perfil'),
            default => redirect()->route('usuarios.perfil'),
        };
    }

    /* ============================================================
       LOGOUT
    ============================================================ */
    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }

    /* ============================================================
       REGISTRO
    ============================================================ */
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'account_type' => 'required|in:postulante,empresa',
            'name'         => 'required|string',
            'lastname'     => 'required|string',
            'email'        => 'required|email|unique:usuarios,email',
            'password'     => 'required|min:8|confirmed',
        ]);

        $usuario = Usuario::create([
            'rol_id'     => $request->account_type === 'empresa' ? 2 : 3,
            'nombre'     => $request->name,
            'apellido'   => $request->lastname,
            'email'      => $request->email,
            'contrasena' => $request->password, // Mutator hashea automáticamente
        ]);

        if ($request->account_type === 'empresa') {
            Empresa::create([
                'usuario_id'        => $usuario->id,
                'nombre_comercial'  => $request->company_name,
                'rut'               => $request->company_rut,
                'correo_contacto'   => $usuario->email,
                'telefono_contacto' => 'No informado',
            ]);
        } else {
            Estudiante::create([
                'usuario_id' => $usuario->id,
            ]);
        }

        return redirect('/login')->with('status', 'Cuenta creada con éxito.');
    }
}
