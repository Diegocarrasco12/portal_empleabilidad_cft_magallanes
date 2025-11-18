{{-- Vista: Postulaciones reales del estudiante --}}
@extends('layouts.app')

@section('content')
<main class="container user-apps">

    {{-- HEADER --}}
    <header class="apps-header">
        <h1 class="section-title">Mis Postulaciones</h1>

        <p class="muted">
            Revisa el estado de tus postulaciones y accede a los detalles de cada oferta.
        </p>

        {{-- Filtros (aún no funcionales) --}}
        <form class="apps-filters" method="GET">
            <div class="field">
                <label for="f_estado">Estado</label>
                <select id="f_estado" name="estado">
                    <option value="">Todos</option>
                    <option value="postulado">Postulado</option>
                    <option value="en_revision">En revisión</option>
                    <option value="seleccionado">Seleccionado</option>
                    <option value="descartado">Descartado</option>
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

    {{-- ===========================
        LISTA DE POSTULACIONES
    ============================ --}}
    <section class="apps-list">

        @if ($postulaciones->isEmpty())
            <p style="text-align:center; color:#6b7280; margin-top:1rem;">
                Aún no has postulado a ninguna oferta. Explora las vacantes disponibles.
            </p>
        @endif

        @foreach ($postulaciones as $postulacion)
            @php
                $oferta = $postulacion->oferta;
                $empresa = $oferta?->empresa;

                $titulo = $oferta->titulo ?? 'Oferta sin título';
                $empresaNombre = $empresa->nombre_comercial ?? 'Empresa no registrada';
                $ciudad = $oferta->ciudad ?? 'Ubicación no registrada';

                // Badge dinámico
                $estado = $postulacion->estado_postulacion;
                $badgeClass = match ($estado) {
                    'seleccionado' => 'seleccionada',
                    'descartado' => 'rechazada',
                    default => 'en-proceso'
                };

                $fecha = $postulacion->fecha_postulacion
                    ? \Carbon\Carbon::parse($postulacion->fecha_postulacion)->format('d M Y')
                    : 'Fecha no registrada';
            @endphp

            <article class="app-card">

                {{-- ENCABEZADO --}}
                <div class="app-card-head">

                    <img class="company-logo"
                         src="{{ asset('img/empresas/empresa (1).png') }}"
                         alt="Logo empresa">

                    <div class="job-meta">
                        <h3 class="job-title">{{ $titulo }}</h3>
                        <p class="company">{{ $empresaNombre }}</p>
                        <p class="location">📍 {{ $ciudad }}</p>
                    </div>

                    <span class="badge status {{ $badgeClass }}">
                        {{ ucfirst(str_replace('_', ' ', $estado)) }}
                    </span>
                </div>

                {{-- CUERPO --}}
                <div class="app-card-body">
                    <ul class="meta-inline">
                        <li>📅 Postulado: {{ $fecha }}</li>
                        <li>🧭 Etapa: {{ ucfirst(str_replace('_', ' ', $estado)) }}</li>
                    </ul>

                    <p class="excerpt">
                        {{ Str::limit($oferta->descripcion ?? 'Sin descripción disponible.', 140) }}
                    </p>
                </div>

                {{-- ACCIONES --}}
                <div class="app-card-actions">

                    <a class="btn btn-light"
                       href="{{ route('jobs.show', ['id' => $oferta->id]) }}">
                        Ver oferta
                    </a>

                    <a class="btn btn-light"
                       href="{{ route('empresas.perfil.publico', ['id' => $empresa->id]) }}">
                        Ver empresa
                    </a>

                    <a class="btn btn-danger"
                       href="{{ route('users.postulaciones.retirar', ['id' => $postulacion->id]) }}">
                        Retirar postulación
                    </a>

                </div>
            </article>
        @endforeach

    </section>

</main>
@endsection

{{-- ===========================
    ESTILOS LOCALES
=========================== --}}
@push('styles')
<style>
    .user-apps {
        padding: 1.25rem 0 2rem;
    }

    .apps-header .muted {
        color: #6b7280;
        margin-bottom: .75rem;
    }

    .apps-filters {
        background: #fff;
        padding: 1rem;
        border-radius: 12px;
        border: 1px solid #eee;
        display: grid;
        gap: 1rem;
        grid-template-columns: 180px 180px 1fr 160px;
        align-items: end;
    }

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
        padding: 1rem;
        box-shadow: 0 1px 3px rgba(0,0,0,.05);
    }

    .app-card-head {
        display: grid;
        grid-template-columns: 56px 1fr auto;
        gap: .75rem;
        align-items: center;
    }

    .company-logo {
        width: 56px;
        height: 56px;
        object-fit: cover;
        border-radius: 8px;
    }

    .job-title {
        font-size: 1.05rem;
        font-weight: 700;
    }

    .badge {
        padding: .25rem .6rem;
        border-radius: 999px;
        font-size: .78rem;
    }

    .status.en-proceso {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #e5e7eb;
    }

    .status.seleccionada {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .status.rechazada {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .meta-inline {
        display: flex;
        gap: 1rem;
        list-style: none;
        padding: 0;
        margin-bottom: .5rem;
        color: #4b5563;
        font-size: .92rem;
    }

    .app-card-actions {
        margin-top: .75rem;
        display: flex;
        gap: .5rem;
        flex-wrap: wrap;
    }

    .btn-light {
        background: #f3f4f6;
        color: #111827;
        padding: .6rem 1rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-light:hover {
        background: #e5e7eb;
    }

    .btn-danger {
        background: #fee2e2;
        color: #991b1b;
        padding: .6rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
    }

    @media (max-width:768px) {
        .apps-list {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush
