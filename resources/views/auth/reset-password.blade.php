@extends('layouts.app')

@section('content')
    <main class="container auth-page">
        <section class="auth-card" role="region" aria-labelledby="resetTitle">
            <header class="auth-head">
                <h1 id="resetTitle">Restablecer contraseña</h1>
                <p class="muted">Define una nueva contraseña para tu cuenta.</p>
            </header>

            {{-- Mensajes --}}
            @if ($errors->any())
                <div class="alert error">
                    <ul>
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="auth-form" method="POST" action="{{ route('password.update') }}">
                @csrf

                {{-- Token --}}
                <input type="hidden" name="token" value="{{ $token }}">

                {{-- Email --}}
                <div class="field">
                    <label for="email">Correo electrónico</label>
                    <input id="email" type="email" name="email" value="{{ request('email') }}" readonly required>
                </div>

                {{-- Nueva contraseña --}}
                <div class="field">
                    <label for="password">Nueva contraseña</label>
                    <input id="password" type="password" name="password" placeholder="••••••••" required>
                </div>

                {{-- Confirmar contraseña --}}
                <div class="field">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="••••••••"
                        required>
                </div>

                <button class="btn btn-primary btn-full" type="submit">
                    Guardar nueva contraseña
                </button>

                <p class="auth-foot">
                    <a class="auth-link" href="{{ route('login') }}">
                        Volver al inicio de sesión
                    </a>
                </p>
            </form>
        </section>
    </main>
@endsection
