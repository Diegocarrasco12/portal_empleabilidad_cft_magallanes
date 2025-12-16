@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/empresas-mis-ofertas.css') }}">
@endpush

@section('content')
    <div class="container-mis-ofertas">

        {{-- Encabezado --}}
        <div class="header-section">
            <h1 class="titulo-section">Mis Ofertas</h1>
            <p class="subtitulo-section">
                Administra tus ofertas laborales y accede rápidamente a sus detalles o edición.
            </p>
        </div>

        {{-- Contenedor de tarjetas --}}
        <div class="ofertas-grid">

            @forelse ($ofertas as $oferta)
                @php
                    $estadoTexto =
                        [
                            \App\Models\OfertaTrabajo::ESTADO_PENDIENTE => 'Pendiente revisión',
                            \App\Models\OfertaTrabajo::ESTADO_APROBADA => 'Publicada',
                            \App\Models\OfertaTrabajo::ESTADO_RECHAZADA => 'Rechazada',
                            \App\Models\OfertaTrabajo::ESTADO_REENVIADA => 'Reenviada',
                        ][$oferta->estado] ?? 'Pendiente revisión';

                    $estadoClase = match ($estadoTexto) {
                        'Publicada' => 'badge-green',
                        'Rechazada' => 'badge-red',
                        'Reenviada' => 'badge-blue',
                        default => 'badge-gray',
                    };
                @endphp
                <div class="oferta-card">

                    {{-- Logo --}}
                    <div class="oferta-logo">
                        @if ($empresa->ruta_logo)
                            <img src="{{ asset('storage/' . $empresa->ruta_logo) }}" alt="Logo empresa">
                        @else
                            <img src="{{ asset('img/logo-placeholder.png') }}" alt="Logo empresa">
                        @endif
                    </div>

                    {{-- Título y estado --}}
                    <div class="oferta-header">
                        <h3 class="oferta-titulo">{{ $oferta->titulo }}</h3>
                        <span class="badge-estado {{ $estadoClase }}">{{ $estadoTexto }}</span>
                    </div>

                    {{-- Datos principales --}}
                    <div class="oferta-datos">
                        <p class="dato-item">
                            <i class="bi bi-geo-alt"></i>
                            {{ $oferta->ciudad ?? 'Sin ubicación' }}
                        </p>

                        <p class="dato-item">
                            <i class="bi bi-calendar3"></i>
                            Publicada:
                            {{ $oferta->creado_en ? \Carbon\Carbon::parse($oferta->creado_en)->format('d M Y') : '—' }}
                        </p>

                        @if ($oferta->fecha_cierre)
                            <p class="dato-item">
                                <i class="bi bi-hourglass-split"></i>
                                Cierre: {{ \Carbon\Carbon::parse($oferta->fecha_cierre)->format('d M Y') }}
                            </p>
                        @endif

                        <p class="dato-item">
                            <i class="bi bi-people"></i>
                            Vacantes: {{ $oferta->vacantes ?? 1 }}
                        </p>
                    </div>

                    {{-- Descripción breve --}}
                    <p class="oferta-descripcion">
                        {{ Str::limit($oferta->descripcion, 160) }}
                    </p>

                    {{-- Botonera --}}
                    <div class="oferta-actions">

                        @if ($oferta->estado == \App\Models\OfertaTrabajo::ESTADO_PENDIENTE)
                            <span class="info-msg">⏳ En revisión — No puedes editar</span>
                        @elseif ($oferta->estado == \App\Models\OfertaTrabajo::ESTADO_APROBADA)
                            <a href="{{ route('empresas.ofertas.editar', $oferta->id) }}" class="btn-empresa">Editar</a>
                        @elseif ($oferta->estado == \App\Models\OfertaTrabajo::ESTADO_RECHAZADA)
                            <span class="info-msg error">❌ Rechazada — revisa el motivo y corrige</span>
                            <a href="{{ route('empresas.ofertas.editar', $oferta->id) }}" class="btn-empresa">Editar</a>

                            <form action="{{ route('empresas.ofertas.enviarRevision', $oferta->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-publicar">Reenviar para revisión</button>
                            </form>

                            <form action="{{ route('empresas.ofertas.destroy', $oferta->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-retirar">Eliminar</button>
                            </form>
                        @elseif($oferta->estado == \App\Models\OfertaTrabajo::ESTADO_REENVIADA)
                            <span class="info-msg">📤 Enviada nuevamente — esperando revisión</span>
                        @endif

                    </div>


                </div>

            @empty

                <p class="no-ofertas">Aún no has creado ofertas laborales.</p>
            @endforelse

        </div>

    </div>
@endsection
