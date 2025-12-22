@extends('layouts.app')

@section('content')
    <main class="container mt-4">

        {{-- TÍTULO PRINCIPAL --}}
        <h1 class="page-title">Postulaciones Recibidas</h1>
        <p class="page-subtitle">Revisa todos los candidatos interesados en tus ofertas laborales.</p>

        {{-- TOTAL --}}
        <div class="total-box">
            Total: <strong>{{ $postulaciones->count() }}</strong>
        </div>

        {{-- GRID DE POSTULACIONES --}}
        <div class="postulaciones-grid">

            @forelse ($postulaciones as $post)
                <article class="post-card">

                    {{-- Foto --}}
                    <img src="{{ $post->estudiante->avatar ? asset($post->estudiante->avatar) : asset('img/otros/no-user.png') }}"
                        alt="Foto postulante">
        </div>

        {{-- Info principal --}}
        <div class="post-info">
            <h3>{{ $post->estudiante->usuario->nombre }}</h3>

            <p class="puesto">{{ $post->oferta->titulo }}</p>

            <p class="fecha">
                📅 Postulado el:
                {{ \Carbon\Carbon::parse($post->fecha_postulacion)->format('d M Y') }}
            </p>

            <a href="{{ route('empresas.postulante', $post->estudiante->id) }}" class="btn-detail">
                Ver perfil completo
            </a>
        </div>

        </article>

    @empty

        <p class="no-data">Aún no has recibido postulaciones.</p>
        @endforelse
        </div>

    </main>
@endsection


@push('styles')
    <style>
        /* ===== TITULOS ===== */
        .page-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: #666;
            margin-bottom: 20px;
        }

        /* ===== TOTAL BOX ===== */
        .total-box {
            background: #f8f8f8;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 16px;
            margin-bottom: 25px;
            border: 1px solid #e5e5e5;
        }

        /* ===== GRID ===== */
        .postulaciones-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
            gap: 20px;
            margin-bottom: 60px;
        }

        /* ===== CARD ===== */
        .post-card {
            background: #fff;
            border-radius: 14px;
            padding: 20px;
            display: flex;
            gap: 20px;
            border: 1px solid #ececec;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: .2s ease;
        }

        .post-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        /* Foto */
        .post-img img {
            width: 90px;
            height: 90px;
            border-radius: 10px;
            object-fit: cover;
        }

        /* Info */
        .post-info h3 {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }

        .puesto {
            color: #444;
            margin: 5px 0 10px;
            font-size: 15px;
        }

        .fecha {
            color: #888;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .btn-detail {
            display: inline-block;
            background: #c91e25;
            color: #fff;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s;
        }

        .btn-detail:hover {
            background: #a5161c;
        }

        /* No data */
        .no-data {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px 0;
            color: #777;
            font-size: 18px;
        }

        .post-card {
            display: flex;
            align-items: stretch;
            /* importante */
        }

        .post-info {
            display: flex;
            flex-direction: column;
            flex: 1;
            /* importante */
            min-height: 100%;
        }

        .btn-detail {
            margin-top: auto;
            /* esto lo baja al fondo */
            display: inline-block;
            text-align: center;
            min-height: 44px;
            /* para que todos queden igual */
            line-height: 28px;
            white-space: nowrap;
            /* evita que “Ver perfil completo” se parta en 2 líneas */
        }
    </style>
@endpush
