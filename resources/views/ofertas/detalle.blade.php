@extends('layouts.app')

@section('content')
<main class="job-detail container py-4">

    {{-- MENSAJES --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif


    {{-- ===========================
         HEADER DE LA OFERTA
    ============================ --}}
    <section class="job-header card p-4 mb-4">

        <div class="job-title-box">
            <h2 class="job-title">{{ $oferta->titulo }}</h2>

            <p class="job-company">
                <span>Publicado por:</span>
                {{ $oferta->empresa->nombre_fantasia ?? 'Empresa no registrada' }}
            </p>

            <p class="job-location">
                📍 {{ $oferta->ciudad ?? 'Sin ciudad' }},
                {{ $oferta->region ?? 'Sin región' }}
            </p>
        </div>

        @if($oferta->mostrar_sueldo)
            <div class="job-salary mt-3">
                💰 <strong>Sueldo:</strong>
                {{ number_format($oferta->sueldo_min, 0, ',', '.') }}
                -
                {{ number_format($oferta->sueldo_max, 0, ',', '.') }} CLP
            </div>
        @endif

        <div class="job-meta mt-3">
            <p><strong>Modalidad:</strong> {{ $oferta->modalidad->nombre ?? '—' }}</p>
            <p><strong>Jornada:</strong> {{ $oferta->jornada->nombre ?? '—' }}</p>
        </div>

        <div class="mt-4">
            <form action="{{ route('postulaciones.store', $oferta->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg px-4">
                    Postular a esta oferta
                </button>
            </form>
        </div>
    </section>


    {{-- ===========================
         CUERPO DE LA OFERTA
    ============================ --}}
    <section class="job-body card p-4 mb-4">

        {{-- DESCRIPCIÓN --}}
        <h4 class="section-title">Descripción del cargo</h4>
        <p>{{ $oferta->descripcion }}</p>

        {{-- REQUISITOS --}}
        <h4 class="section-title mt-4">Requisitos</h4>
        <p>{{ $oferta->requisitos }}</p>

        {{-- BENEFICIOS --}}
        @if($oferta->beneficios)
            <h4 class="section-title mt-4">Beneficios</h4>
            <p>{{ $oferta->beneficios }}</p>
        @endif

    </section>


    {{-- ===========================
         CONTACTO
    ============================ --}}
    <section class="job-contact card p-4 mb-4">
        <h4 class="section-title">Contacto</h4>

        <p><strong>Nombre:</strong> {{ $oferta->nombre_contacto ?? '—' }}</p>
        <p><strong>Email:</strong> {{ $oferta->correo_contacto ?? '—' }}</p>
        <p><strong>Teléfono:</strong> {{ $oferta->telefono_contacto ?? '—' }}</p>
    </section>

</main>
@endsection


{{-- ===========================
     ESTILOS LOCALES PREMIUM
=========================== --}}
@push('styles')
<style>

    /* ======= TARJETAS ======= */
    .job-detail .card {
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 6px rgba(0,0,0,.05);
    }

    /* ======= HEADER ======= */
    .job-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: .3rem;
        color: #111827;
    }

    .job-company span {
        color: #6b7280;
        font-weight: 600;
    }

    .job-company {
        font-size: 1.05rem;
        color: #374151;
    }

    .job-location {
        color: #374151;
        font-size: 1rem;
        margin-top: .25rem;
    }

    .job-salary {
        font-size: 1.1rem;
        font-weight: 600;
        color: #065f46;
        background: #d1fae5;
        padding: .5rem .75rem;
        border-radius: 8px;
        display: inline-block;
        border: 1px solid #a7f3d0;
    }

    .job-meta p {
        margin: 0;
        font-size: .97rem;
        color: #4b5563;
    }

    /* ======= SECCIONES ======= */
    .section-title {
        font-weight: 700;
        color: #111827;
        margin-bottom: .35rem;
        font-size: 1.25rem;
    }

    .job-body p {
        font-size: 1rem;
        color: #374151;
        line-height: 1.55rem;
    }

    /* ======= CONTACTO ======= */
    .job-contact p {
        margin: .2rem 0;
        color: #374151;
    }

    /* ======= RESPONSIVE ======= */
    @media (max-width: 768px) {
        .job-title {
            font-size: 1.45rem;
        }
    }

</style>
@endpush
