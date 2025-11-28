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
                    // Badge de estado
                    $estadoTexto = [
                        0 => 'Borrador',
                        1 => 'Publicada',
                        2 => 'Cerrada',
                    ][$oferta->estado ?? 1];

                    $estadoClase = [
                        'Borrador' => 'badge-gray',
                        'Publicada' => 'badge-green',
                        'Cerrada' => 'badge-red',
                    ][$estadoTexto];
                @endphp

                <div class="oferta-card">

                    {{-- Logo --}}
                    <div class="oferta-logo">
                        @if ($empresa->logo ?? false)
                            <img src="{{ asset('storage/' . $empresa->logo) }}" alt="Logo empresa">
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

                        <a href="{{ route('ofertas.detalle', $oferta->id) }}" class="btn-detalle">
                            Ver detalle
                        </a>

                        <a href="{{ route('empresas.ofertas.editar', $oferta->id) }}" class="btn-empresa">
                            Editar
                        </a>
                        <form action="{{ route('empresas.ofertas.destroy', $oferta->id) }}" method="POST"
                            class="form-eliminar-oferta">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-retirar"
                                onclick="return confirm('¿Seguro que deseas eliminar esta oferta?')">
                                Eliminar
                            </button>
                        </form>


                    </div>

                </div>

            @empty

                <p class="no-ofertas">Aún no has creado ofertas laborales.</p>
            @endforelse

        </div>

    </div>
@endsection
