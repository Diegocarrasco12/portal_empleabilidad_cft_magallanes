{{-- Login: profesional, minimalista y responsive --}}
@extends('layouts.app')

@section('content')
    <main class="container auth-page">
        <section class="auth-card" role="region" aria-labelledby="loginTitle">
            <header class="auth-head">
                <img src="{{ asset('img/iconos/logo.png') }}" alt="CFT Magallanes" class="auth-logo">
                <h1 id="loginTitle">Ingresar</h1>
                <p class="muted">Conecta para gestionar ofertas, postulaciones y perfiles.</p>
            </header>

            {{-- Mensajes de estado/errores (mock de ejemplo) --}}
            @if (session('status'))
                <div class="alert success">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert error">
                    <ul>
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="auth-form" method="POST" action="{{ url('/login') }}" novalidate>
                @csrf

                <div class="field">
                    <label for="email">Correo electrónico</label>
                    <input id="email" type="email" name="email" placeholder="tu@ejemplo.cl" required
                        autocomplete="username">
                </div>

                <div class="field">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" name="password" placeholder="••••••••" required
                        autocomplete="current-password">
                </div>

                <div class="auth-extra">
                    <label class="check">
                        <input type="checkbox" name="remember"> Mantener mi sesión iniciada
                    </label>
                    <a class="auth-link" href="{{ url('/password/forgot') }}">¿Olvidaste tu contraseña?</a>
                </div>

                <button class="btn btn-primary btn-full" type="submit">Ingresar</button>

                <p class="auth-foot">
                    ¿Aún no tienes cuenta?
                    <a class="auth-link" href="{{ url('/registrarse') }}">Crear cuenta</a>
                </p>
            </form>
        </section>
    </main>
@endsection

@push('styles')
    <style>
        /* ====== Login (scoped) ====== */
        .auth-page {
            display: grid;
            place-items: center;
            padding: 2rem 0 3rem;
        }

        .auth-card {
            width: min(460px, 100%);
            background: #fff;
            border: 1px solid #eee;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .06);
            padding: 1.5rem 1.5rem 1.25rem;
        }

        .auth-head {
            text-align: center;
            margin-bottom: 1rem;
        }

        .auth-logo {
            width: 96px;
            height: auto;
            margin-bottom: .25rem;
        }

        .auth-head h1 {
            margin: .25rem 0;
            font-size: 1.4rem;
            font-weight: 800;
        }

        .muted {
            color: #6b7280;
            margin: 0;
        }

        .alert {
            border-radius: 10px;
            padding: .75rem .9rem;
            font-size: .92rem;
            margin: .75rem 0;
        }

        .alert.success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert.error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert ul {
            margin: .25rem 0 0 1rem;
        }

        .auth-form {
            display: grid;
            gap: .85rem;
            margin-top: .25rem;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: .35rem;
        }

        .field input {
            padding: .7rem .85rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            outline: none;
            transition: .15s border-color ease;
        }

        .field input:focus {
            border-color: #c91e25;
        }

        .auth-extra {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .5rem;
            margin: .25rem 0 .25rem;
            flex-wrap: wrap;
        }

        .check {
            display: flex;
            align-items: center;
            gap: .5rem;
            color: #374151;
            font-size: .95rem;
        }

        .auth-link {
            color: #c91e25;
            text-decoration: none;
            font-weight: 600;
        }

        .auth-link:hover {
            text-decoration: underline;
        }

        .btn {
            display: inline-block;
            border-radius: 10px;
            padding: .8rem 1rem;
            font-weight: 700;
            text-decoration: none;
        }

        .btn-primary {
            background: #c91e25;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background: #b01920;
        }

        .btn-full {
            width: 100%;
        }

        .auth-foot {
            text-align: center;
            color: #4b5563;
            margin: .25rem 0 0;
        }

        /* Responsive */
        @media (max-width:640px) {
            .auth-card {
                border-radius: 14px;
                padding: 1.25rem;
            }

            .auth-logo {
                width: 84px;
            }
        }
    </style>
@endpush
