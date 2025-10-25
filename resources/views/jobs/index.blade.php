@extends('layouts.app')

@section('content')
    <main class="jobs-page container">

        {{-- Barra superior de búsqueda --}}
        <section class="jobs-hero" role="search" aria-label="Buscador de empleos">
            <form class="jobs-search" action="{{ route('jobs.index') }}" method="GET" novalidate>
                <div class="input-wrap">
                    <img src="{{ asset('img/iconos/search.svg') }}" alt="" aria-hidden="true">
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Cargo, palabra clave o empresa…">
                </div>

                <div class="input-wrap">
                    <img src="{{ asset('img/iconos/location.svg') }}" alt="" aria-hidden="true">
                    <input type="text" name="l" value="{{ request('l') }}" placeholder="Ciudad o región">
                </div>

                <select name="j" class="select">
                    <option value="">Jornada</option>
                    <option value="full" @selected(request('j') === 'full')>Tiempo completo</option>
                    <option value="part" @selected(request('j') === 'part')>Part-time</option>
                    <option value="practice" @selected(request('j') === 'practice')>Práctica</option>
                </select>

                <button class="btn btn-primary">Buscar</button>
                <button type="button" class="btn btn-light filters-toggle" id="openFilters">Filtros</button>
            </form>

            {{-- Chips con filtros activos (mock) --}}
            @if (request()->hasAny(['q', 'l', 'j']))
                <div class="chips">
                    @if (request('q'))
                        <span class="chip">“{{ request('q') }}”</span>
                    @endif
                    @if (request('l'))
                        <span class="chip">{{ request('l') }}</span>
                    @endif
                    @if (request('j'))
                        <span class="chip">Jornada: {{ request('j') }}</span>
                    @endif
                    <a href="{{ route('jobs.index') }}" class="chip-clear">Limpiar filtros</a>
                </div>
            @endif
        </section>

        {{-- Layout principal: filtros + resultados --}}
        <section class="jobs-layout">
            {{-- Filtros (sidebar) --}}
            <aside class="filters" id="filtersPanel" aria-label="Filtros de búsqueda">
                <div class="filters-head">
                    <h2>Filtros</h2>
                    <button class="icon-btn" id="closeFilters" aria-label="Cerrar filtros">✕</button>
                </div>

                <form class="filters-form" action="{{ route('jobs.index') }}" method="GET">
                    {{-- Mantener query actual al aplicar filtros --}}
                    <input type="hidden" name="q" value="{{ request('q') }}">
                    <input type="hidden" name="l" value="{{ request('l') }}">
                    <input type="hidden" name="j" value="{{ request('j') }}">

                    <div class="filter-block">
                        <h3>Área</h3>
                        <label class="check"><input type="checkbox" name="area[]" value="salud"> Salud</label>
                        <label class="check"><input type="checkbox" name="area[]" value="industrial"> Industrial</label>
                        <label class="check"><input type="checkbox" name="area[]" value="administracion">
                            Administración</label>
                        <label class="check"><input type="checkbox" name="area[]" value="educacion"> Educación</label>
                    </div>

                    <div class="filter-block">
                        <h3>Tipo de contrato</h3>
                        <label class="check"><input type="checkbox" name="type[]" value="indefinido"> Indefinido</label>
                        <label class="check"><input type="checkbox" name="type[]" value="plazo"> Plazo fijo</label>
                        <label class="check"><input type="checkbox" name="type[]" value="honorarios"> Honorarios</label>
                        <label class="check"><input type="checkbox" name="type[]" value="practica"> Práctica</label>
                    </div>

                    <div class="filter-block">
                        <h3>Rango salarial (CLP)</h3>
                        <div class="range-row">
                            <input type="number" name="smin" placeholder="Mín.">
                            <input type="number" name="smax" placeholder="Máx.">
                        </div>
                    </div>

                    <div class="filter-block">
                        <h3>Fecha de publicación</h3>
                        <label class="radio"><input type="radio" name="age" value="1"> Últimas 24h</label>
                        <label class="radio"><input type="radio" name="age" value="3"> Últimos 3
                            días</label>
                        <label class="radio"><input type="radio" name="age" value="7"> Últimos 7
                            días</label>
                        <label class="radio"><input type="radio" name="age" value="" checked>
                            Cualquiera</label>
                    </div>

                    <div class="actions">
                        <button type="submit" class="btn-apply">Aplicar filtros</button>
                    </div>


                    <button class="btn btn-primary btn-full">Aplicar filtros</button>
                </form>
            </aside>

            {{-- Resultados --}}
            <div class="results">
                <div class="results-head">
                    <p class="muted">Mostrando <strong>128</strong> empleos (mock)</p>
                    <select class="select small">
                        <option value="relevance">Ordenar: Relevancia</option>
                        <option value="date">Más recientes</option>
                        <option value="salary">Mejor salario</option>
                    </select>
                </div>

                {{-- Tarjetas de ofertas (mock) --}}
                @for ($i = 0; $i < 8; $i++)
                    <article class="job-card">
                        <div class="job-logo">
                            <img src="{{ asset('img/empresas/empresa (1).png') }}" alt="Logo empresa">
                        </div>

                        <div class="job-main">
                            <h3 class="job-title"><a href="#">Técnico en Mantenimiento Industrial</a></h3>
                            <p class="job-company">Magallanes Logística SPA</p>
                            <ul class="job-meta">
                                <li>📍 Punta Arenas</li>
                                <li>⏱ Tiempo completo</li>
                                <li>💸 $900.000 – $1.200.000</li>
                            </ul>
                            <div class="job-tags">
                                <span class="tag">Industrial</span>
                                <span class="tag">Mecánica</span>
                                <span class="tag">Turnos</span>
                            </div>
                        </div>

                        <div class="job-cta">
                            <p class="job-date">Publicada hace 2 días</p>
                            <div class="cta-actions">
                                <button class="btn btn-light">Guardar</button>
                                <a href="#" class="btn btn-primary">Postular</a>
                            </div>
                        </div>
                    </article>
                @endfor

                {{-- Paginación (mock) --}}
                <nav class="pagination" aria-label="Paginación">
                    <a href="#" class="page">&laquo;</a>
                    <a href="#" class="page is-active">1</a>
                    <a href="#" class="page">2</a>
                    <a href="#" class="page">3</a>
                    <a href="#" class="page">&raquo;</a>
                </nav>
            </div>
        </section>
    </main>
@endsection

@push('styles')
    <style>
        /* ====== Jobs Page ====== */
        .jobs-page {
            padding: 1rem 0 2rem;
        }

        .jobs-hero {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 14px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .jobs-search {
            display: grid;
            grid-template-columns: 1fr 1fr 200px 140px 120px;
            gap: .6rem;
            align-items: center;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrap img {
            width: 18px;
            position: absolute;
            left: .75rem;
            opacity: .7;
        }

        .input-wrap input {
            width: 100%;
            padding: .7rem .9rem .7rem 2rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
        }

        .select {
            padding: .7rem .9rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #fff;
        }

        .select.small {
            padding: .55rem .7rem;
            font-size: .95rem;
        }

        .btn {
            display: inline-block;
            border-radius: 10px;
            padding: .7rem 1rem;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background: #c91e25;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background: #b01920;
        }

        .btn-light {
            background: #f3f4f6;
            color: #111827;
            border: 1px solid #e5e7eb;
        }

        .btn-full {
            width: 100%;
        }

        /* Chips */
        .chips {
            display: flex;
            gap: .5rem;
            flex-wrap: wrap;
            margin-top: .5rem;
        }

        .chip {
            background: #f3f4f6;
            border-radius: 999px;
            padding: .35rem .7rem;
            font-size: .9rem;
        }

        .chip-clear {
            color: #c91e25;
            text-decoration: none;
            font-weight: 600;
        }

        /* Layout */
        .jobs-layout {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 1rem;
        }

        .filters {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 14px;
            padding: 1rem;
            position: sticky;
            top: 1rem;
            height: max-content;
        }

        .filters-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: .25rem;
        }

        .icon-btn {
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: .3rem .5rem;
            cursor: pointer;
        }

        .filters-form {
            display: grid;
            gap: 1rem;
        }

        .filter-block h3 {
            margin: 0 0 .45rem;
            font-size: 1rem;
        }

        .check,
        .radio {
            display: block;
            color: #374151;
            margin: .25rem 0;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .5rem;
        }

        .filters-toggle {
            display: none;
        }

        .results {
            display: grid;
            gap: .6rem;
        }

        .results-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 14px;
            padding: .6rem .8rem;
        }

        .muted {
            color: #6b7280;
        }

        /* Job card */
        .job-card {
            display: grid;
            grid-template-columns: 72px 1fr 220px;
            gap: 1rem;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 14px;
            padding: .9rem;
        }

        .job-card:hover {
            box-shadow: 0 6px 16px rgba(0, 0, 0, .06);
        }

        .job-logo img {
            width: 72px;
            height: 72px;
            object-fit: contain;
            border-radius: 10px;
            background: #fafafa;
            border: 1px solid #f0f0f0;
        }

        .job-title {
            margin: .1rem 0 .25rem;
            font-size: 1.05rem;
        }

        .job-title a {
            color: #111827;
            text-decoration: none;
        }

        .job-title a:hover {
            color: #c91e25;
        }

        .job-company {
            margin: 0 0 .3rem;
            color: #374151;
            font-weight: 600;
        }

        .job-meta {
            display: flex;
            gap: .75rem;
            flex-wrap: wrap;
            margin: 0 0 .4rem;
            padding: 0;
            list-style: none;
            color: #4b5563;
            font-size: .95rem;
        }

        .job-tags {
            display: flex;
            gap: .4rem;
            flex-wrap: wrap;
        }

        .tag {
            background: #f3f4f6;
            border-radius: 999px;
            padding: .25rem .6rem;
            font-size: .85rem;
        }

        .job-cta {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: .4rem;
        }

        .job-date {
            color: #6b7280;
            font-size: .9rem;
            margin: .2rem 0;
        }

        .cta-actions {
            display: flex;
            gap: .4rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            gap: .4rem;
            justify-content: center;
            margin-top: .5rem;
        }

        .page {
            display: inline-block;
            padding: .5rem .7rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            text-decoration: none;
            color: #111827;
        }

        .page.is-active {
            background: #c91e25;
            color: #fff;
            border-color: #c91e25;
        }

        /* ====== Ajuste: Rango salarial + botón aplicar ====== */
        .filters .range-row {
            display: flex;
            gap: .5rem;
            margin-top: .25rem;
        }

        .filters .range-row input[type="number"],
        .filters .range-row input[type="text"] {
            flex: 1 1 0;
            min-width: 0;
            width: 100%;
            box-sizing: border-box;
            padding: .55rem .65rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: .95rem;
        }

        /* quitar flechas para mantener alto consistente */
        .filters .range-row input[type="number"]::-webkit-outer-spin-button,
        .filters .range-row input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .filters .range-row input[type="number"] {
            -moz-appearance: textfield;
        }

        /* Botón aplicar filtros a ancho completo */
        .filters .actions {
            margin-top: .75rem;
        }

        .filters .btn-apply {
            display: block;
            width: 100%;
            padding: .8rem 1rem;
            border: none;
            border-radius: 10px;
            background: #c91e25;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }

        .filters .btn-apply:hover {
            background: #a8181e;
        }

        /* ====== Responsive ====== */
        @media (max-width: 1024px) {
            .jobs-search {
                grid-template-columns: 1fr 1fr 160px 120px 120px;
            }

            .job-card {
                grid-template-columns: 56px 1fr 200px;
            }

            .job-logo img {
                width: 56px;
                height: 56px;
            }
        }

        @media (max-width: 840px) {
            .jobs-layout {
                grid-template-columns: 1fr;
            }

            .filters {
                position: fixed;
                inset: 0 0 0 auto;
                width: min(360px, 90%);
                transform: translateX(105%);
                transition: .2s;
                z-index: 50;
                box-shadow: -12px 0 24px rgba(0, 0, 0, .15);
            }

            .filters.is-open {
                transform: translateX(0);
            }

            .filters-toggle {
                display: inline-block;
            }
        }

        @media (max-width: 640px) {
            .jobs-search {
                grid-template-columns: 1fr;
            }

            .results-head {
                flex-direction: column;
                gap: .5rem;
                align-items: flex-start;
            }

            .job-card {
                grid-template-columns: 56px 1fr;
            }

            .job-cta {
                grid-column: 1/-1;
                align-items: flex-start;
                flex-direction: row;
                justify-content: space-between;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Drawer de filtros en mobile
        const openBtn = document.getElementById('openFilters');
        const closeBtn = document.getElementById('closeFilters');
        const panel = document.getElementById('filtersPanel');
        if (openBtn && panel) {
            openBtn.addEventListener('click', () => panel.classList.add('is-open'));
        }
        if (closeBtn && panel) {
            closeBtn.addEventListener('click', () => panel.classList.remove('is-open'));
        }
    </script>
@endpush
