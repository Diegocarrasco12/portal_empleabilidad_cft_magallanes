@extends('layouts.app')

@section('content')
    <main class="job-detail container py-5" style="padding-top: 4rem !important; padding-bottom: 4rem !important;">

        {{-- =========================================================
        CONTENEDOR PRINCIPAL – ESTILO TRABAJANDO.COM
        Layout en 2 columnas:
        - Izquierda: contenido principal de la oferta
        - Derecha: panel de resumen y postulación
    ========================================================== --}}
        <section class="job-wrapper">

            {{-- =====================================================
            HEADER DE LA OFERTA
            Título, empresa, ubicación, tags y CTA principal
        ====================================================== --}}
            <header class="job-main-header card job-header-card">

                <div class="job-header-left">
                    {{-- TÍTULO DE LA OFERTA --}}
                    <h1 class="job-title">
                        {{ $oferta->titulo }}
                    </h1>

                    {{-- NOMBRE DE EMPRESA --}}
                    <p class="job-company">
                        {{ $oferta->empresa->nombre_fantasia ?? 'Empresa no registrada' }}
                    </p>

                    {{-- UBICACIÓN --}}
                    <p class="job-location">
                        <span class="job-location-icon">📍</span>
                        {{ $oferta->ciudad ?? 'Sin ciudad' }},
                        {{ $oferta->region ?? 'Sin región' }}
                    </p>

                    {{-- TAGS / ETIQUETAS (JORNADA – MODALIDAD – REGIÓN) --}}
                    <div class="job-chips">
                        @if ($oferta->jornada?->nombre)
                            <span class="job-chip">
                                {{ $oferta->jornada->nombre }}
                            </span>
                        @endif

                        @if ($oferta->modalidad?->nombre)
                            <span class="job-chip">
                                {{ $oferta->modalidad->nombre }}
                            </span>
                        @endif

                        @if ($oferta->region)
                            <span class="job-chip chip-soft">
                                {{ $oferta->region }}
                            </span>
                        @endif
                    </div>

                    {{-- FECHA DE PUBLICACIÓN --}}
                    @php
                        $fechaPublicacion = $oferta->creado_en
                            ? \Carbon\Carbon::parse($oferta->creado_en)->diffForHumans()
                            : null;
                    @endphp

                    @if ($fechaPublicacion)
                        <p class="job-published">
                            Publicada {{ $fechaPublicacion }}
                        </p>
                    @endif
                </div>

                {{-- COLUMNA DERECHA DEL HEADER: SUELDO + BOTÓN POSTULAR --}}
                <div class="job-header-right">
                    @if ($oferta->mostrar_sueldo)
                        <div class="job-salary-badge">
                            <span class="job-salary-label">Sueldo</span>
                            <span class="job-salary-range">
                                {{ number_format($oferta->sueldo_min, 0, ',', '.') }}
                                – {{ number_format($oferta->sueldo_max, 0, ',', '.') }} CLP
                            </span>
                        </div>
                    @endif

                    {{-- BOTÓN PRINCIPAL PARA POSTULAR --}}
                    <form action="{{ route('postulaciones.store', $oferta->id) }}" method="POST" class="job-apply-form">
                        @csrf
                        <button type="submit" class="btn btn-primary job-apply-btn">
                            Postular a esta oferta
                        </button>
                    </form>

                    {{-- BOTÓN SECUNDARIO (FUTURO: GUARDAR OFERTA) --}}
                    <button type="button" class="btn btn-outline-secondary job-save-btn" disabled>
                        Guardar oferta
                    </button>
                </div>

            </header>


            {{-- =====================================================
            LAYOUT PRINCIPAL – 2 COLUMNAS
        ====================================================== --}}
            <div class="job-layout">

                {{-- ================================================
                COLUMNA IZQUIERDA – CONTENIDO DETALLADO
            ================================================= --}}
                <article class="job-main card">

                    {{-- DESCRIPCIÓN DEL CARGO --}}
                    <section class="job-section">
                        <h2 class="section-title">Descripción del cargo</h2>
                        <p class="section-text">
                            {{ $oferta->descripcion ?? 'Sin descripción detallada para esta oferta.' }}
                        </p>
                    </section>

                    {{-- PRINCIPALES FUNCIONES (USAMOS HABILIDADES / EXTRA SI EXISTE) --}}
                    @if ($oferta->habilidades_deseadas)
                        <section class="job-section">
                            <h2 class="section-title">Principales funciones</h2>
                            <p class="section-text">
                                {{ $oferta->habilidades_deseadas }}
                            </p>
                        </section>
                    @endif

                    {{-- REQUISITOS --}}
                    @if ($oferta->requisitos)
                        <section class="job-section">
                            <h2 class="section-title">Perfil deseado / Requisitos</h2>
                            <p class="section-text">
                                {{ $oferta->requisitos }}
                            </p>
                        </section>
                    @endif

                    {{-- BENEFICIOS --}}
                    @if ($oferta->beneficios)
                        <section class="job-section">
                            <h2 class="section-title">Beneficios</h2>
                            <p class="section-text">
                                {{ $oferta->beneficios }}
                            </p>
                        </section>
                    @endif

                </article>


                {{-- ================================================
                COLUMNA DERECHA – PANEL RESUMEN / CONTACTO
            ================================================= --}}
                <aside class="job-sidebar">

                    {{-- TARJETA: INFORMACIÓN DEL EMPLEO --}}
                    <div class="card job-info-card">
                        <h3 class="sidebar-title">Información del empleo</h3>

                        <ul class="job-info-list">
                            <li>
                                <span class="job-info-label">Ubicación</span>
                                <span class="job-info-value">
                                    {{ $oferta->ciudad ?? 'Sin ciudad' }},
                                    {{ $oferta->region ?? 'Sin región' }}
                                </span>
                            </li>

                            <li>
                                <span class="job-info-label">Jornada</span>
                                <span class="job-info-value">
                                    {{ $oferta->jornada->nombre ?? 'No especificada' }}
                                </span>
                            </li>

                            <li>
                                <span class="job-info-label">Modalidad</span>
                                <span class="job-info-value">
                                    {{ $oferta->modalidad->nombre ?? 'No especificada' }}
                                </span>
                            </li>

                            <li>
                                <span class="job-info-label">Vacantes</span>
                                <span class="job-info-value">
                                    {{ $oferta->vacantes ?? 1 }}
                                </span>
                            </li>

                            @if ($oferta->mostrar_sueldo)
                                <li>
                                    <span class="job-info-label">Rango de sueldo</span>
                                    <span class="job-info-value">
                                        {{ number_format($oferta->sueldo_min, 0, ',', '.') }}
                                        – {{ number_format($oferta->sueldo_max, 0, ',', '.') }} CLP
                                    </span>
                                </li>
                            @endif

                            @if ($oferta->fecha_cierre)
                                <li>
                                    <span class="job-info-label">Fecha de cierre</span>
                                    <span class="job-info-value">
                                        {{ \Carbon\Carbon::parse($oferta->fecha_cierre)->format('d-m-Y') }}
                                    </span>
                                </li>
                            @endif
                        </ul>

                        {{-- CTA SECUNDARIA EN LATERAL (MISMA LÓGICA DE POSTULACIÓN) --}}
                        <form action="{{ route('postulaciones.store', $oferta->id) }}" method="POST"
                            class="job-apply-form-sidebar">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block job-apply-btn-secondary">
                                Postular ahora
                            </button>
                        </form>
                    </div>


                    {{-- TARJETA: CONTACTO --}}
                    <div class="card job-contact-card">
                        <h3 class="sidebar-title">Contacto</h3>

                        <ul class="job-info-list">
                            <li>
                                <span class="job-info-label">Nombre</span>
                                <span class="job-info-value">
                                    {{ $oferta->nombre_contacto ?? 'No informado' }}
                                </span>
                            </li>
                            <li>
                                <span class="job-info-label">Email</span>
                                <span class="job-info-value">
                                    {{ $oferta->correo_contacto ?? 'No informado' }}
                                </span>
                            </li>
                            <li>
                                <span class="job-info-label">Teléfono</span>
                                <span class="job-info-value">
                                    {{ $oferta->telefono_contacto ?? 'No informado' }}
                                </span>
                            </li>
                        </ul>
                    </div>

                </aside>

            </div> {{-- /job-layout --}}

        </section> {{-- /job-wrapper --}}

    </main>
@endsection


{{-- =========================================================
    ESTILOS LOCALES – VISTA DETALLE TIPO TRABAJANDO.COM
    Adaptado a la identidad visual de CFT Magallanes
========================================================= --}}
@push('styles')
    <style>
        /* ===== CONTEXTO GENERAL ===== */
        .job-detail {
            max-width: 1120px;
        }

        .job-wrapper {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .job-detail .card {
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 6px rgba(15, 23, 42, .06);
            background: #ffffff;
        }

        /* ===== HEADER PRINCIPAL ===== */
        .job-header-card {
            padding: 1.5rem 1.75rem;
            display: flex;
            justify-content: space-between;
            gap: 1.5rem;
            align-items: flex-start;
        }

        .job-header-left {
            flex: 1.8;
            min-width: 0;
        }

        .job-header-right {
            flex: 1;
            max-width: 280px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: .75rem;
        }

        .job-title {
            font-size: 1.9rem;
            font-weight: 800;
            margin: 0 0 .3rem;
            color: #111827;
        }

        .job-company {
            font-size: 1.05rem;
            color: #374151;
            margin: 0 0 .25rem;
            font-weight: 600;
        }

        .job-location {
            margin: 0;
            font-size: .98rem;
            color: #4b5563;
            display: flex;
            align-items: center;
            gap: .25rem;
        }

        .job-location-icon {
            font-size: 1.05rem;
        }

        .job-chips {
            margin-top: .6rem;
            display: flex;
            flex-wrap: wrap;
            gap: .4rem;
        }

        .job-chip {
            display: inline-flex;
            align-items: center;
            padding: .22rem .6rem;
            font-size: .8rem;
            border-radius: 999px;
            background-color: #fee2e2;
            /* rojo suave CFT */
            color: #991b1b;
            border: 1px solid #fecaca;
            font-weight: 600;
        }

        .job-chip.chip-soft {
            background-color: #f3f4f6;
            color: #374151;
            border-color: #e5e7eb;
        }

        .job-published {
            margin-top: .7rem;
            font-size: .85rem;
            color: #6b7280;
        }

        /* ===== HEADER DERECHO: SUELDO + BOTONES ===== */
        .job-salary-badge {
            background: #ecfdf3;
            border-radius: 12px;
            border: 1px solid #bbf7d0;
            padding: .55rem .75rem;
            text-align: right;
            width: 100%;
        }

        .job-salary-label {
            display: block;
            font-size: .8rem;
            color: #047857;
            text-transform: uppercase;
            letter-spacing: .04em;
            font-weight: 700;
            margin-bottom: .1rem;
        }

        .job-salary-range {
            font-size: 1.05rem;
            color: #065f46;
            font-weight: 700;
        }

        .job-apply-form {
            width: 100%;
        }

        .job-apply-btn {
            width: 100%;
            font-weight: 700;
            border-radius: 12px;
            background-color: #C91E25;
            /* rojo CFT */
            border: none;
            padding: 12px 20px;
            font-size: 1rem;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
            transition: all .2s ease-in-out;
        }

        .job-apply-btn:hover {
            background-color: #A8161C;
            transform: translateY(-1px);
        }


        .job-save-btn {
            font-size: .85rem;
            border-radius: 999px;
            padding: .35rem .9rem;
        }

        /* ===== LAYOUT 2 COLUMNAS ===== */
        .job-layout {
            display: grid;
            grid-template-columns: minmax(0, 2.3fr) minmax(260px, 1fr);
            gap: 1.5rem;
            align-items: flex-start;
        }

        .job-main {
            padding: 1.5rem 1.75rem;
        }

        .job-sidebar {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        /* ===== SECCIONES DEL CUERPO ===== */
        .job-section+.job-section {
            margin-top: 1.75rem;
        }

        .section-title {
            font-weight: 700;
            color: #111827;
            margin: 0 0 .45rem;
            font-size: 1.25rem;
        }

        .section-text {
            font-size: .98rem;
            color: #374151;
            line-height: 1.6rem;
            margin: 0;
            white-space: pre-line;
        }

        /* ===== TARJETAS LATERALES ===== */
        .job-info-card,
        .job-contact-card {
            padding: 1.25rem 1.4rem;
        }

        .sidebar-title {
            font-size: 1rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 .8rem;
        }

        .job-info-list {
            list-style: none;
            padding: 0;
            margin: 0 0 .9rem;
            display: flex;
            flex-direction: column;
            gap: .4rem;
        }

        .job-info-list li {
            display: flex;
            flex-direction: column;
            font-size: .9rem;
        }

        .job-info-label {
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #6b7280;
            font-weight: 600;
            margin-bottom: .05rem;
        }

        .job-info-value {
            color: #111827;
            font-weight: 500;
        }

        .job-apply-form-sidebar {
            margin-top: .3rem;
        }

        .job-apply-btn-secondary {
            width: 100%;
            border-radius: 12px;
            font-weight: 700;
            background-color: #C91E25;
            border: none;
            padding: 12px 18px;
            font-size: 1rem;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
            transition: all .2s ease-in-out;
        }

        .job-apply-btn-secondary:hover {
            background-color: #A8161C;
            transform: translateY(-1px);
        }


        /* ===== RESPONSIVE ===== */
        @media (max-width: 960px) {
            .job-header-card {
                flex-direction: column;
            }

            .job-header-right {
                align-items: stretch;
                max-width: 100%;
            }

            .job-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .job-title {
                font-size: 1.5rem;
            }

            .job-header-card,
            .job-main,
            .job-info-card,
            .job-contact-card {
                padding: 1.1rem 1.1rem;
            }
        }

        /* ================================
       CENTRAR HEADER EN MOBILE
    ================================ */
        @media (max-width: 820px) {

            /* Centrar bloque izquierdo del header */
            .job-header-left {
                text-align: center !important;
                align-items: center !important;
            }

            .job-title,
            .job-company,
            .job-location,
            .job-published {
                text-align: center !important;
                width: 100%;
            }

            /* Centrar chips */
            .job-chips {
                justify-content: center !important;
            }

            /* Centrar columna derecha (sueldo + botones) */
            .job-header-right {
                align-items: center !important;
                text-align: center !important;
                width: 100%;
            }

            .job-salary-badge {
                text-align: center !important;
                margin-left: auto;
                margin-right: auto;
            }

            /* Botones en centro */
            .job-apply-btn,
            .job-save-btn {
                width: 100%;
            }
        }
    </style>
@endpush
