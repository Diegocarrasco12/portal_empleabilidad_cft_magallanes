@extends('layouts.app')

@section('content')
    <main class="empresa-dashboard container">

        {{-- === Header Empresa=== --}}
        <section class="empresa-header container">
            <div class="empresa-grid">
                {{-- Bloque Izquierdo --}}
                <div class="empresa-info">
                    <img src="{{ asset('img/empresas/global-marketing-logo.png') }}" alt="Logo empresa" class="empresa-logo" />
                    <p class="empresa-descripcion">
                        Hola, Constructora Austral, aquí puedes gestionar tus ofertas laborales y revisar los candidatos
                        interesados en tus vacantes.
                    </p>
                    <a href="{{ route('empresas.editar') }}" class="btn btn-danger">Editar Perfil</a>
                </div>

                {{-- Bloque Derecho --}}
                <div class="empresa-detalle">
                    <ul class="stats-list">
                        <li>📦 <strong>Ofertas activas:</strong> 3</li>
                        <li>👥 <strong>Postulaciones recibidas:</strong> 12</li>
                        <li>⏳ <strong>Ofertas en revisión:</strong> 1</li>
                        <li>📈 <strong>Tasa de visualización:</strong> 85%</li>
                    </ul>
                    <img src="{{ asset('img/otros/Fuentes-de-tráfico.jpg') }}" alt="Gráfico actividad" class="chart-img" />
                    <a href="{{ route('empresas.crear') }}" class="btn btn-publicar">Publicar Nueva Oferta</a>
                </div>
            </div>
        </section>



        {{-- === Sección Mis Ofertas Activas === --}}
        <section class="empresa-ofertas">
            <h3>Mis Ofertas Activas</h3>
            <div class="ofertas-grid">
                @for ($i = 0; $i < 4; $i++)
                    <article class="oferta-card">
                        <div class="oferta-icon">
                            <img src="{{ asset('img/iconos/4310877.png') }}" alt="Icono oferta de trabajo">
                        </div>
                        <div class="oferta-body">
                            <h4>Mantenimiento Industrial</h4>
                            <p>Mantenimiento preventivo de equipos y maquinarias.</p>
                            <p class="lugar">📍 Punta Arenas</p>
                            <a href="#" class="link">Ver Detalles</a>
                        </div>
                    </article>
                @endfor
            </div>
        </section>


        {{-- === Sección Publicar Nueva Oferta === --}}
        <section class="empresa-publicar">
            <h3>Publicar Nueva Oferta</h3>
            <div class="publicar-contenedor">
                <p>¿Tienes una nueva vacante disponible? Publica tu oferta y llega a cientos de estudiantes y egresados del
                    CFT Magallanes.</p>
                <a href="{{ route('empresas.crear') }}" class="btn-publicar">+ Crear Nueva Oferta</a>
            </div>
        </section>


        {{-- === Postulaciones Recientes === --}}
        <section class="empresa-postulaciones">
            <h3>Postulaciones</h3>
            <div class="postulaciones-grid">
                @for ($i = 0; $i < 3; $i++)
                    <article class="postulante-card">
                        <img src="/img/testimonios/test (1).png" alt="Foto postulante">
                        <div class="postulante-info">
                            <h4>Daniela Soto</h4>
                            <p>Asistente en Laboratorio Clínico</p>
                            <p>📅 15-10-2025</p>
                            <a href="#" class="btn-secondary">Ver Perfil Completo</a>
                        </div>
                    </article>
                @endfor
            </div>
            <a href="#" class="ver-todos">Ver todos</a>
        </section>

    </main>
@endsection
