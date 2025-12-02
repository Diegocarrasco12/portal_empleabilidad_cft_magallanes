@extends('layouts.app')

@section('content')
    <main class="empresa-dashboard container">

        {{-- === Header Empresa === --}}
        <section class="empresa-header container">
            <div class="empresa-grid">

                {{-- Bloque Izquierdo --}}
                <div class="empresa-info">

                    @if ($empresa->logo)
                        <img src="{{ asset('storage/' . $empresa->logo) }}" alt="Logo empresa" class="empresa-logo" />
                    @else
                        <img src="{{ asset('img/otros/default-logo.png') }}" class="empresa-logo">
                    @endif

                    <p class="empresa-descripcion">
                        Hola, {{ $empresa->nombre }}, aquí puedes gestionar tus ofertas laborales
                        y revisar los candidatos interesados en tus vacantes.
                    </p>

                    <a href="{{ route('empresas.editar') }}" class="btn btn-danger">Editar Perfil</a>
                </div>

                {{-- Bloque Derecho --}}
                <div class="empresa-detalle">
                    <ul class="stats-list">
                        <li>📦 <strong>Ofertas publicadas:</strong> {{ $totalOfertas }}</li>
                        <li>👥 <strong>Postulaciones recibidas:</strong> {{ $totalPostulaciones }}</li>
                    </ul>

                    <img src="{{ asset('img/otros/Fuentes-de-tráfico.jpg') }}" alt="Gráfico actividad" class="chart-img" />

                    <a href="{{ route('empresas.crear') }}" class="btn btn-publicar">Publicar Nueva Oferta</a>

                    <a href="{{ route('empresas.ofertas.index') }}" class="btn btn-outline-secondary"
                        style="margin-top:10px; display:block; text-align:center;">
                        Ver todas mis ofertas publicadas
                    </a>

                </div>

            </div>
        </section>



        {{-- === Sección Mis Ofertas Activas === --}}
        <section class="empresa-ofertas">
            <h3>Mis Ofertas Activas</h3>

            <div class="ofertas-grid">

                @foreach ($ofertas as $oferta)
                    <article class="oferta-card">

                        <div class="oferta-icon">
                            <img src="{{ asset('img/iconos/4310877.png') }}" alt="Icono oferta de trabajo">
                        </div>

                        <div class="oferta-body">
                            <h4>{{ $oferta->titulo }}</h4>

                            <p>{{ Str::limit($oferta->descripcion, 80) }}</p>

                            <p class="lugar">📍 {{ $oferta->ciudad }}</p>

                            <a href="{{ route('ofertas.detalle', $oferta->id) }}" class="link">Ver Detalles</a>
                        </div>

                    </article>
                @endforeach

                {{-- Sin ofertas --}}
                @if ($ofertas->count() == 0)
                    <p class="no-ofertas">Aún no tienes ofertas publicadas.</p>
                @endif

            </div>

            {{-- Botón Ver Todas --}}
            @if ($totalOfertas > 4)
                <div style="margin-top: 20px;">
                    <a href="{{ route('empresas.ofertas.index') }}" class="btn btn-primary">
                        Ver todas las ofertas
                    </a>
                </div>
            @endif
        </section>



        {{-- === Sección Publicar Nueva Oferta === --}}
        <section class="empresa-publicar">
            <h3>Publicar Nueva Oferta</h3>

            <div class="publicar-contenedor">
                <p>¿Tienes una nueva vacante disponible? Publica tu oferta y llega a cientos de estudiantes y egresados.</p>

                <a href="{{ route('empresas.crear') }}" class="btn-publicar">+ Crear Nueva Oferta</a>
            </div>
        </section>



        {{-- === Postulaciones Recientes === --}}
        <section class="empresa-postulaciones">
            <h3>Postulaciones</h3>

            <div class="postulaciones-grid">

                @foreach ($postulaciones as $post)
                    <article class="postulante-card">
                        <img src="{{ $post->estudiante->avatar ? asset('storage/' . $post->estudiante->avatar) : asset('img/otros/no-user.png') }}"
                            alt="Foto postulante">

                        <div class="postulante-info">
                            <h4>{{ $post->estudiante->usuario->nombre }} {{ $post->estudiante->usuario->apellido }}</h4>

                            <p>{{ $post->oferta->titulo }}</p>

                            <p>📅 {{ \Carbon\Carbon::parse($post->fecha_postulacion)->format('d-m-Y') }}</p>

                            <a href="{{ route('empresas.postulante', $post->estudiante_id) }}" class="btn-perfil">
                                Ver perfil completo
                            </a>
                        </div>
                    </article>
                @endforeach

                @if ($postulaciones->count() == 0)
                    <p class="no-ofertas">Aún no tienes postulaciones.</p>
                @endif

            </div>

            {{-- Ver todos --}}
            <a href="{{ route('empresas.postulaciones.index') }}" class="ver-todos">Ver todos</a>

        </section>

    </main>
@endsection
