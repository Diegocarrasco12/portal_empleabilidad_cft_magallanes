@extends('layouts.app')

@section('content')
    <main class="container auth-page">
        <section class="auth-card" role="region" aria-labelledby="forgotTitle">

            <header class="auth-head">
                <h1 id="forgotTitle">Recuperar contraseña</h1>
                <p class="muted">
                    Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                </p>
            </header>

            {{-- Mensaje de estado (correo enviado) --}}
            @if (session('status'))
                <div class="alert success">
                    {{ session('status') }}
                </div>

                {{-- Redirección automática al login --}}
                <meta http-equiv="refresh" content="4;url={{ route('login') }}">
                <p class="auth-foot">
                    Serás redirigido al inicio de sesión en unos segundos…
                    <br>
                    <a class="auth-link" href="{{ route('login') }}">Ir ahora</a>
                </p>
            @else
                {{-- Errores de validación --}}
                @if ($errors->any())
                    <div class="alert error">
                        <ul>
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="auth-form" method="POST" action="{{ route('password.email') }}" novalidate>
                    @csrf

                    <div class="field">
                        <label for="email">Correo electrónico</label>
                        <input id="email" type="email" name="email" placeholder="tu@ejemplo.cl"
                            value="{{ old('email') }}" required autofocus>
                    </div>

                    <button class="btn btn-primary btn-full" type="submit">
                        Enviar enlace de recuperación
                    </button>

                    <p class="auth-foot">
                        <a class="auth-link" href="{{ route('login') }}">
                            Volver al inicio de sesión
                        </a>
                    </p>
                </form>

            @endif
        </section>
    </main>
@endsection

@push('styles')
    <style>
        .alert {
            border-radius: 10px;
            padding: .75rem .9rem;
            font-size: .95rem;
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
    </style>
@endpush
