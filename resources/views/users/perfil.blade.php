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
                        <h2 class="user-name">Daniela Soto</h2>
                        <p class="user-status">📘 Estado Carrera: Egresado<br>🎓 Técnico en Enfermería</p>
                    </div>
                </div>

                <p class="user-intro">
                    Hola, Daniela, aquí puedes gestionar tus postulaciones y revisar las ofertas disponibles para ti.
                </p>

                <div class="user-actions">
                    <a href="{{ url('/usuarios/editar') }}" class="btn btn-primary">Editar Perfil</a>
                    <a href="{{ url('/usuarios/cv') }}" class="btn btn-outline">Ver CV</a>
                </div>
            </article>

            {{-- Tarjeta derecha: Actividad Reciente --}}
            <article class="card activity-card">
                <header class="card-header">
                    <h3>Actividad Reciente</h3>
                </header>

                <ul class="activity-list">
                    <li>✉️ <strong>3</strong> Postulaciones enviadas</li>
                    <li>👤 <strong>1</strong> Avance en tu postulación</li>
                    <li>💡 <strong>2</strong> Ofertas nuevas disponibles</li>
                </ul>

                <div class="activity-cta">
                    <a href="{{ url('/usuarios/postulaciones') }}" class="btn btn-primary">Mis Postulaciones</a>
                </div>
            </article>
        </section>

        {{-- Mis Postulaciones --}}
        <section class="user-section">
            <h3 class="section-title">Mis Postulaciones</h3>

            <div class="cards-grid-3">
                @for ($i = 0; $i < 3; $i++)
                    <article class="card job-card">
                        <header class="job-head">
                            <img src="{{ asset('img/empresas/empresa (3).png') }}" alt="Oferta" class="job-icon">
                            <h4 class="job-title">Técnico en Mantenimiento Industrial</h4>
                        </header>
                        <p class="job-company">Magallanes Logística SPA</p>

                        <div class="job-meta">
                            <div class="job-meta-item">⏳ En proceso</div>
                            <div class="job-meta-item">📅 10 de octubre de 2025</div>
                        </div>

                        <a href="#" class="job-link">Ver Detalles</a>
                    </article>
                @endfor
            </div>
        </section>

        {{-- Ofertas Recomendadas --}}
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

    @push('styles')
        <style>
            /* Contenedor general */
            .perfil-user {
                padding: 1.25rem 0 2rem;
            }

            /* Grids */
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

            /* Tarjetas base */
            .card {
                background: #fff;
                border: 1px solid #eee;
                border-radius: 12px;
                padding: 1.25rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
            }

            .card-header h3 {
                margin: 0;
                font-size: 1.05rem;
            }

            /* Header usuario */
            .user-card .user-head {
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
                margin: .15rem 0 0;
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

            /* Actividad reciente */
            .activity-card .activity-list {
                list-style: none;
                padding: 0;
                margin: .5rem 0 1rem;
            }

            .activity-card .activity-list li {
                margin: .45rem 0;
                font-size: .95rem;
                color: #111827;
            }

            .activity-cta {
                display: flex;
                justify-content: flex-start;
            }

            /* Job cards */
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
                color: #374151;
                font-size: .9rem;
                margin-bottom: .5rem;
            }

            .job-meta-item {
                background: #f9fafb;
                border: 1px solid #eef2f7;
                padding: .3rem .55rem;
                border-radius: 8px;
            }

            .job-link {
                color: #c91e25;
                text-decoration: none;
                font-weight: 600;
                font-size: .92rem;
            }

            /* Títulos de sección */
            .user-section {
                margin-top: 1.25rem;
            }

            .section-title {
                margin: .25rem 0 .75rem;
                font-size: 1.1rem;
                font-weight: 800;
                color: #c91e25;
                text-align: center;
                margin: .5rem 0 1rem;
            }

            .section-title.alt {
                color: #c91e25;
                text-align: center;
                margin: .5rem 0 1rem;
            }

            /* Botones (reutilizamos la línea pro que venías usando) */
            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: .4rem;
                border-radius: 10px;
                padding: .75rem 1.1rem;
                font-weight: 700;
                line-height: 1;
                border: 1px solid transparent;
                text-decoration: none;
                cursor: pointer;
                transition: background .2s ease, color .2s ease, border-color .2s ease, box-shadow .2s ease, transform .06s ease;
                box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            }

            .btn:active {
                transform: translateY(1px);
            }

            .btn-primary {
                background: #c91e25;
                color: #fff;
                border-color: #c91e25;
            }

            .btn-primary:hover {
                background: #b01920;
                border-color: #b01920;
            }

            .btn-primary:focus {
                outline: 0;
                box-shadow: 0 0 0 4px rgba(201, 30, 37, .18);
            }

            .btn-outline {
                background: #fff;
                color: #111827;
                border-color: #d1d5db;
            }

            .btn-outline:hover {
                background: #f9fafb;
                border-color: #cbd5e1;
            }

            .btn-outline:focus {
                outline: 0;
                box-shadow: 0 0 0 4px rgba(2, 132, 199, .15);
            }

            /* Responsive */
            @media (max-width:1024px) {
                .cards-grid-3 {
                    grid-template-columns: 1fr 1fr;
                }
            }

            @media (max-width:820px) {
                .grid-2 {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width:680px) {
                .cards-grid-3 {
                    display: flex;
                    gap: 1rem;
                    overflow-x: auto;
                    scroll-snap-type: x proximity;
                }

                .cards-grid-3>.card {
                    flex: 0 0 280px;
                    scroll-snap-align: start;
                }
            }
        </style>
    @endpush
@endsection
