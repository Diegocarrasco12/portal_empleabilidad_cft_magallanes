@extends('layouts.app')

@section('content')
    <main class="container perfil-user">

        {{-- Header: tarjeta izquierda (avatar + datos) y derecha (actividad reciente) --}}
        <section class="user-top grid-2">

            {{-- Tarjeta izquierda --}}
            <article class="card user-card">
                <div class="user-head">
                    <img class="user-avatar" src="{{ asset('img/testimonios/test (2).png') }}" alt="Avatar estudiante">

                    <div class="user-meta">
                        <h2 class="user-name">
                            {{ $estudiante->usuario->nombre }} {{ $estudiante->usuario->apellido }}
                        </h2>

                        <p class="user-status">
                            📘 Estado Carrera:
                            <strong>{{ $estudiante->estado_carrera ?? 'No informado' }}</strong>
                            <br>
                            🎓 {{ $estudiante->carrera ?? 'Carrera no registrada' }}
                        </p>
                    </div>
                </div>

                <p class="user-intro">
                    {{ $estudiante->resumen
                        ? $estudiante->resumen
                        : 'Aquí puedes gestionar tus postulaciones y revisar las ofertas disponibles para ti.' }}
                </p>

                <div class="user-actions">
                    <a href="{{ url('/usuarios/editar') }}" class="btn btn-primary">Editar Perfil</a>

                    @if ($estudiante->ruta_cv)
                        <a href="{{ asset('storage/' . $estudiante->ruta_cv) }}" target="_blank" class="btn btn-outline">
                            Ver CV
                        </a>
                    @else
                        <a href="#" class="btn btn-outline disabled">Sin CV</a>
                    @endif
                </div>
            </article>


            {{-- Tarjeta derecha – Actividad Reciente (Mock por ahora) --}}
            <article class="card activity-card">
                <header class="card-header">
                    <h3>Actividad Reciente</h3>
                </header>

                <ul class="activity-list">
                    <li>✉️ <strong>0</strong> Postulaciones enviadas</li>
                    <li>👤 <strong>0</strong> Avance en tus postulaciones</li>
                    <li>💡 <strong>0</strong> Ofertas nuevas recomendadas</li>
                </ul>

                <div class="activity-cta">
                    <a href="{{ url('/usuarios/postulaciones') }}" class="btn btn-primary">Mis Postulaciones</a>
                </div>
            </article>

        </section>



        {{-- ======================
            MIS POSTULACIONES
        ======================= --}}
        <section class="user-section">
            <h3 class="section-title">Mis Postulaciones</h3>

            @if ($postulaciones->isEmpty())
                <p style="text-align:center; color:#6b7280; margin-bottom:1rem;">
                    Aún no has postulado a ninguna oferta. Explora las vacantes disponibles y envía tu primera postulación.
                </p>
            @else
                <div class="cards-grid-3">
                    @foreach ($postulaciones as $postulacion)
                        @php
                            $oferta = $postulacion->oferta;
                            $empresa = $oferta?->empresa;
                            $titulo = $oferta?->titulo ?? 'Oferta sin título';
                            $empresaNombre = $empresa?->nombre_comercial ?? 'Empresa no registrada';
                            $estado = $postulacion->estado_postulacion ?? 'postulado';
                            $fecha = $postulacion->fecha_postulacion
                                ? $postulacion->fecha_postulacion->format('d-m-Y')
                                : null;
                        @endphp

                        <article class="card job-card">
                            <header class="job-head">
                                <img src="{{ asset('img/empresas/empresa (3).png') }}" alt="Oferta" class="job-icon">
                                <h4 class="job-title">{{ $titulo }}</h4>
                            </header>

                            <p class="job-company">{{ $empresaNombre }}</p>

                            <div class="job-meta">
                                <div class="job-meta-item">
                                    ⏳ {{ ucfirst(str_replace('_', ' ', $estado)) }}
                                </div>

                                @if ($fecha)
                                    <div class="job-meta-item">
                                        📅 {{ $fecha }}
                                    </div>
                                @endif
                            </div>

                            <a href="{{ route('users.postulaciones') }}" class="job-link">
                                Ver detalle
                            </a>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>



        {{-- ======================
            OFERTAS RECOMENDADAS (mock)
        ======================= --}}
        <section class="user-section">
            <h3 class="section-title alt">Ofertas Recomendadas</h3>

            <div class="cards-grid-3">
                @for ($i = 0; $i < 3; $i++)
                    <article class="card job-card">
                        <header class="job-head">
                            <img src="{{ asset('img/empresas/empresa (4).png') }}" alt="Oferta" class="job-icon">

                            <h4 class="job-title">Asistente Laboratorio Clínico</h4>
                        </header>

                        <p class="job-company">Clínica Regional del Sur</p>

                        <div class="job-meta">
                            <div class="job-meta-item">📍 Punta Arenas</div>
                        </div>

                        <a href="#" class="job-link">Ver Detalles</a>
                    </article>
                @endfor
            </div>
        </section>

    </main>




    {{-- ======================
        ESTILOS
    ======================= --}}
    @push('styles')
        <style>
            /* Contenedor general */
            .perfil-user {
                padding: 1.25rem 0 2rem;
            }

            .grid-2 {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }

            .cards-grid-3 {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1rem;
            }

            .card {
                background: #fff;
                border: 1px solid #eee;
                border-radius: 12px;
                padding: 1.25rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
            }

            .user-head {
                display: flex;
                align-items: center;
                gap: .9rem;
                margin-bottom: .75rem;
            }

            .user-avatar {
                width: 64px;
                height: 64px;
                object-fit: cover;
                border-radius: 50%;
            }

            .user-name {
                margin: 0;
                font-size: 1.15rem;
                font-weight: 700;
            }

            .user-status {
                color: #555;
                font-size: .92rem;
                line-height: 1.35;
            }

            .user-intro {
                color: #555;
                margin: .5rem 0 1rem;
            }

            .user-actions {
                display: flex;
                gap: .6rem;
                flex-wrap: wrap;
            }

            .activity-list {
                list-style: none;
                margin: .5rem 0 1rem;
                padding: 0;
            }

            .activity-list li {
                margin: .45rem 0;
                font-size: .95rem;
            }

            .job-head {
                display: flex;
                align-items: center;
                gap: .6rem;
            }

            .job-icon {
                width: 36px;
                height: 36px;
                object-fit: contain;
            }

            .job-title {
                margin: 0;
                font-size: 1rem;
                font-weight: 700;
            }

            .job-company {
                color: #6b7280;
                margin: .35rem 0 .6rem;
            }

            .job-meta {
                display: flex;
                gap: .75rem;
                flex-wrap: wrap;
                font-size: .9rem;
                margin-bottom: .5rem;
            }

            .job-meta-item {
                background: #f9fafb;
                border: 1px solid #eef2f7;
                padding: .3rem .55rem;
                border-radius: 8px;
            }

            .section-title {
                text-align: center;
                font-size: 1.1rem;
                font-weight: 800;
                color: #c91e25;
                margin: .5rem 0 1rem;
            }

            @media (max-width:820px) {
                .grid-2 {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    @endpush

@endsection
