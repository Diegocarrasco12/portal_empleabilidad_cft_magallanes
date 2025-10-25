{{-- Registro: profesional, minimalista y responsive --}}
@extends('layouts.app')

@section('content')
    <main class="container auth-page">
        <section class="auth-card" role="region" aria-labelledby="registerTitle">
            <header class="auth-head">
                <img src="{{ asset('img/iconos/logo.png') }}" alt="CFT Magallanes" class="auth-logo">
                <h1 id="registerTitle">Crear cuenta</h1>
                <p class="muted">Únete para postular a ofertas o publicar vacantes.</p>
            </header>

            {{-- Mensajes de ejemplo (si luego conectas validación) --}}
            @if ($errors->any())
                <div class="alert error">
                    <ul>
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="auth-form" method="POST" action="{{ url('/registrarse') }}" novalidate>
                @csrf

                {{-- Tipo de cuenta --}}
                <div class="field">
                    <label for="account_type">Tipo de cuenta</label>
                    <select id="account_type" name="account_type" required>
                        <option value="postulante" selected>Postulante / Estudiante</option>
                        <option value="empresa">Empresa</option>
                    </select>
                </div>

                {{-- Datos personales básicos --}}
                <div class="grid-2">
                    <div class="field">
                        <label for="name">Nombre</label>
                        <input id="name" name="name" type="text" placeholder="Tu nombre" required
                            autocomplete="given-name">
                    </div>
                    <div class="field">
                        <label for="lastname">Apellido</label>
                        <input id="lastname" name="lastname" type="text" placeholder="Tu apellido" required
                            autocomplete="family-name">
                    </div>
                </div>

                <div class="field">
                    <label for="email">Correo electrónico</label>
                    <input id="email" name="email" type="email" placeholder="tu@ejemplo.cl" required
                        autocomplete="email">
                </div>

                {{-- Campos específicos de empresa (se muestran si eliges Empresa) --}}
                <fieldset id="companyFields" class="company-fields" aria-hidden="true">
                    <legend>Datos de la empresa</legend>
                    <div class="field">
                        <label for="company_name">Nombre de la empresa</label>
                        <input id="company_name" name="company_name" type="text"
                            placeholder="Ej: Magallanes Logística SPA">
                    </div>
                    <div class="field">
                        <label for="company_rut">RUT (opcional)</label>
                        <input id="company_rut" name="company_rut" type="text" placeholder="11.111.111-1"
                            inputmode="numeric">
                    </div>
                </fieldset>

                {{-- Contraseña --}}
                <div class="grid-2">
                    <div class="field">
                        <label for="password">Contraseña</label>
                        <input id="password" name="password" type="password" placeholder="••••••••" required
                            autocomplete="new-password" minlength="8">
                        <small class="hint">Mínimo 8 caracteres.</small>
                    </div>
                    <div class="field">
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            placeholder="••••••••" required autocomplete="new-password">
                    </div>
                </div>

                <div class="auth-extra">
                    <label class="check">
                        <input type="checkbox" name="terms" required>
                        Acepto los <a href="#" class="auth-link">Términos y Condiciones</a>
                    </label>
                    <a class="auth-link" href="{{ url('/login') }}">¿Ya tienes cuenta? Ingresar</a>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Crear cuenta</button>
            </form>
        </section>
    </main>
@endsection

@push('styles')
    <style>
        /* Reutilizamos el estilo del login para coherencia visual */
        .auth-page {
            display: grid;
            place-items: center;
            padding: 2rem 0 3rem;
        }

        .auth-card {
            width: min(520px, 100%);
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

        .alert.error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert.error ul {
            margin: .25rem 0 0 1rem;
        }

        .auth-form {
            display: grid;
            gap: .85rem;
            margin-top: .25rem;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .85rem;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: .35rem;
        }

        .field input,
        .field select {
            padding: .7rem .85rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            outline: none;
            transition: .15s border-color ease;
        }

        .field input:focus,
        .field select:focus {
            border-color: #c91e25;
        }

        .hint {
            color: #6b7280;
            font-size: .8rem;
        }

        .company-fields {
            margin-top: .4rem;
            padding: 1rem;
            border: 1px dashed #e5e7eb;
            border-radius: 12px;
            display: none;
        }

        .company-fields legend {
            font-weight: 700;
            font-size: .95rem;
            color: #374151;
            padding: 0 .25rem;
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

        /* Responsive */
        @media (max-width:640px) {
            .auth-card {
                border-radius: 14px;
                padding: 1.25rem;
            }

            .auth-logo {
                width: 84px;
            }

            .grid-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Mostrar/ocultar campos de empresa según el tipo de cuenta
        (function() {
            const sel = document.getElementById('account_type');
            const box = document.getElementById('companyFields');

            function toggleCompany() {
                const isCompany = sel.value === 'empresa';
                box.style.display = isCompany ? 'block' : 'none';
                box.setAttribute('aria-hidden', isCompany ? 'false' : 'true');
                // Requeridos condicionales
                document.getElementById('company_name').toggleAttribute('required', isCompany);
            }
            sel.addEventListener('change', toggleCompany);
            toggleCompany(); // init
        })();
    </script>
@endpush
