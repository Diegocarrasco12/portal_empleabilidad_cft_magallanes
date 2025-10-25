{{-- Vista: Postulaciones del estudiante/postulante --}}
{{-- Usa el layout general para mantener header y footer --}}
@extends('layouts.app')

@section('content')
    <main class="container user-apps">

        {{-- Encabezado y filtros (básicos por ahora) --}}
        <header class="apps-header">
            <h1 class="section-title">Mis Postulaciones</h1>
            <p class="muted">Revisa el estado de tus postulaciones y accede a los detalles de cada oferta.</p>

            <form class="apps-filters" action="#" method="GET" aria-label="Filtros de postulaciones">
                <div class="field">
                    <label for="f_estado">Estado</label>
                    <select id="f_estado" name="estado">
                        <option value="">Todos</option>
                        <option value="en-proceso">En proceso</option>
                        <option value="seleccionada">Seleccionada</option>
                        <option value="rechazada">Rechazada</option>
                    </select>
                </div>
                <div class="field">
                    <label for="f_fecha">Ordenar por</label>
                    <select id="f_fecha" name="orden">
                        <option value="recientes">Más recientes</option>
                        <option value="antiguas">Más antiguas</option>
                    </select>
                </div>
                <div class="field field-search">
                    <label for="f_q">Buscar</label>
                    <input id="f_q" type="text" name="q" placeholder="Puesto, empresa, ubicación…">
                </div>
                <div class="field field-actions">
                    <button class="btn btn-primary" type="submit">Aplicar filtros</button>
                </div>
            </form>
        </header>

        {{-- Lista de Postulaciones (estático de ejemplo) --}}
        <section class="apps-list">
            @for ($i = 0; $i < 6; $i++)
                <article class="app-card">
                    <div class="app-card-head">
                        <img class="company-logo" src="{{ asset('img/empresas/empresa (1).png') }}" alt="Logo empresa">
                        <div class="job-meta">
                            <h3 class="job-title">Técnico en Mantenimiento Industrial</h3>
                            <p class="company">Magallanes Logística SPA</p>
                            <p class="location">📍 Punta Arenas</p>
                        </div>
                        {{-- badge de estado (cambia la clase: .en-proceso / .seleccionada / .rechazada) --}}
                        <span class="badge status en-proceso">En proceso</span>
                    </div>

                    <div class="app-card-body">
                        <ul class="meta-inline">
                            <li>📅 Postulado: 10 oct 2025</li>
                            <li>🧭 Etapa: Revisión</li>
                        </ul>
                        <p class="excerpt">
                            Mantenimiento preventivo de equipos y maquinarias. Turnos rotativos. Oportunidad de crecimiento.
                        </p>
                    </div>

                    <div class="app-card-actions">
                        <a class="btn btn-light" href="#">Ver oferta</a>
                        <a class="btn btn-light" href="#">Ver empresa</a>
                        <a class="btn btn-danger" href="#">Retirar postulación</a>
                    </div>
                </article>
            @endfor
        </section>

        {{-- Paginación (mock) --}}
        <nav class="apps-pager" aria-label="Paginación">
            <a href="#" class="pager-link disabled" aria-disabled="true">« Anterior</a>
            <a href="#" class="pager-link is-active" aria-current="page">1</a>
            <a href="#" class="pager-link">2</a>
            <a href="#" class="pager-link">3</a>
            <a href="#" class="pager-link">Siguiente »</a>
        </nav>

    </main>
@endsection

@push('styles')
    <style>
        /* ====== Postulaciones (estilos locales) ====== */
        .user-apps {
            padding: 1.25rem 0 2rem;
        }

        .apps-header {
            margin-bottom: 1rem;
        }

        .apps-header .muted {
            color: #6b7280;
            margin: .25rem 0 .75rem;
        }

        /* Filtros */
        .apps-filters {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 1rem;
            display: grid;
            gap: 1rem;
            grid-template-columns: 180px 180px 1fr 160px;
            align-items: end;
        }

        .apps-filters .field {
            display: flex;
            flex-direction: column;
            gap: .35rem;
        }

        .apps-filters .field-search input {
            width: 100%;
        }

        .apps-filters .field-actions {
            display: flex;
            justify-content: flex-end;
        }

        /* Lista */
        .apps-list {
            display: grid;
            gap: 1rem;
            grid-template-columns: 1fr 1fr;
            margin-top: 1rem;
        }

        .app-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
            padding: 1rem;
        }

        .app-card-head {
            display: grid;
            grid-template-columns: 56px 1fr auto;
            gap: .75rem;
            align-items: center;
            margin-bottom: .5rem;
        }

        .company-logo {
            width: 56px;
            height: 56px;
            object-fit: cover;
            border-radius: 8px;
        }

        .job-title {
            margin: .1rem 0;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .company {
            margin: 0;
            color: #374151;
        }

        .location {
            margin: .1rem 0 0;
            color: #6b7280;
            font-size: .92rem;
        }

        .badge {
            display: inline-block;
            font-size: .78rem;
            padding: .25rem .6rem;
            border-radius: 999px;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .status.en-proceso {
            background: #f3f4f6;
            color: #374151;
            border-color: #e5e7eb;
        }

        .status.seleccionada {
            background: #d1fae5;
            color: #065f46;
            border-color: #a7f3d0;
        }

        .status.rechazada {
            background: #fee2e2;
            color: #991b1b;
            border-color: #fecaca;
        }

        .app-card-body {
            margin-top: .5rem;
        }

        .meta-inline {
            display: flex;
            gap: 1rem;
            padding: 0;
            margin: 0 0 .35rem;
            list-style: none;
            color: #4b5563;
            font-size: .92rem;
        }

        .excerpt {
            margin: .25rem 0 0;
            color: #4b5563;
        }

        .app-card-actions {
            margin-top: .75rem;
            display: flex;
            gap: .5rem;
            flex-wrap: wrap;
        }

        /* Botones (reutiliza tu línea) */
        .btn {
            display: inline-block;
            border-radius: 8px;
            padding: .6rem 1rem;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-primary {
            background: #c91e25;
            color: #fff;
        }

        .btn-primary:hover {
            background: #b01920;
        }

        .btn-light {
            background: #f3f4f6;
            color: #111827;
        }

        .btn-light:hover {
            background: #e5e7eb;
        }

        .btn-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-danger:hover {
            background: #fecaca;
        }

        /* Pager */
        .apps-pager {
            display: flex;
            gap: .4rem;
            justify-content: center;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .pager-link {
            display: inline-block;
            padding: .5rem .75rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            text-decoration: none;
            color: #111827;
            background: #fff;
        }

        .pager-link:hover {
            background: #f9fafb;
        }

        .pager-link.is-active {
            background: #c91e25;
            color: #fff;
            border-color: #c91e25;
        }

        .pager-link.disabled {
            color: #9ca3af;
            pointer-events: none;
        }

        /* ====== Responsive ====== */
        @media (max-width:1024px) {
            .apps-filters {
                grid-template-columns: 1fr 1fr;
            }

            .apps-list {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width:768px) {
            .apps-filters {
                grid-template-columns: 1fr;
            }

            .apps-list {
                grid-template-columns: 1fr;
            }

            .app-card-head {
                grid-template-columns: 48px 1fr;
            }

            .company-logo {
                width: 48px;
                height: 48px;
            }
        }
    </style>
@endpush
