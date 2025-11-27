@extends('layouts.app')

@section('title', 'Mis Ofertas Laborales')

@section('content')
    <main class="container py-4">

        {{-- Breadcrumb --}}
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <ul>
                <li><a href="{{ route('empresas.perfil') }}">Perfil empresa</a></li>
                <li class="current" aria-current="page">Mis ofertas</li>
            </ul>
        </nav>

        {{-- Encabezado --}}
        <header class="page-header">
            <h1>Mis ofertas publicadas</h1>
            <p class="muted">Aquí puedes revisar todas las ofertas creadas por tu empresa.</p>
        </header>

        {{-- Mensajes --}}
        @if (session('ok'))
            <div class="alert-success-custom">{{ session('ok') }}</div>
        @endif

        @if (session('error'))
            <div class="alert-error-custom">{{ session('error') }}</div>
        @endif

        {{-- Si no existen ofertas --}}
        @if ($ofertas->isEmpty())
            <section class="card mt-3">
                <p class="muted">Aún no has creado ninguna oferta laboral.</p>
                <a href="{{ route('empresas.crear') }}" class="btn btn-primary mt-2">
                    Crear mi primera oferta
                </a>
            </section>
        @else
            {{-- Listado de ofertas --}}
            <section class="card mt-3">
                <h2 class="mb-3">Listado de ofertas</h2>

                <div class="listado-ofertas">
                    @foreach ($ofertas as $oferta)
                        <div class="oferta-item">
                            <div class="oferta-info">
                                <h3 class="oferta-titulo">{{ $oferta->titulo }}</h3>

                                <p class="oferta-meta">
                                    Publicada el
                                    <strong>{{ \Carbon\Carbon::parse($oferta->creado_en)->format('d-m-Y') }}</strong>
                                </p>

                                {{-- Estado --}}
                                @if ($oferta->estado === 'borrador')
                                    <span class="badge badge-warning">Borrador</span>
                                @else
                                    <span class="badge badge-success">Publicada</span>
                                @endif
                            </div>

                            <div class="oferta-actions">
                                <a href="{{ route('empresas.ofertas.editar', $oferta->id) }}" class="btn btn-primary">
                                    Ver / Editar
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

        @endif

    </main>

    {{-- Estilos específicos --}}
    @push('styles')
        <style>
            .alert-success-custom {
                background: #eafaf1;
                border: 1px solid #a7e3c1;
                padding: .75rem 1rem;
                border-radius: 8px;
                color: #1e7b47;
                margin-bottom: 1rem;
            }

            .alert-error-custom {
                background: #feecec;
                border: 1px solid #f2b4b4;
                padding: .75rem 1rem;
                border-radius: 8px;
                color: #9f1c1c;
                margin-bottom: 1rem;
            }

            .listado-ofertas {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .oferta-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: .9rem 1rem;
                border-radius: 10px;
                border: 1px solid #eee;
                background: #fff;
                box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
            }

            .oferta-info h3 {
                margin: 0;
                font-size: 1.1rem;
            }

            .oferta-meta {
                margin: .25rem 0;
                color: #6b7280;
                font-size: .9rem;
            }

            .badge {
                display: inline-block;
                padding: .25rem .6rem;
                border-radius: 6px;
                font-size: .8rem;
                font-weight: 600;
            }

            .badge-success {
                background-color: #d1fae5;
                color: #065f46;
            }

            .badge-warning {
                background-color: #fef3c7;
                color: #92400e;
            }

            .oferta-actions .btn {
                padding: .6rem 1rem;
            }

            @media(max-width:768px) {
                .oferta-item {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: .75rem;
                }

                .oferta-actions {
                    width: 100%;
                }

                .oferta-actions .btn {
                    width: 100%;
                }
            }
        </style>
    @endpush

@endsection
