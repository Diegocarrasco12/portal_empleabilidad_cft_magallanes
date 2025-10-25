<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CFT Magallanes – Empleabilidad</title>
    <!--
      Esta plantilla base define la estructura general de la aplicación web.  Se
      incluyen enlaces a las hojas de estilos y scripts compartidos.  Las
      secciones de contenido se insertan mediante directivas Blade.
    -->

    <!-- Google Fonts: Poppins para una tipografía moderna y legible -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- Hoja de estilos principal (landing) -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}" />

    {{-- Estilos compartidos (componentes/header admin, dashboard, etc.) --}}
    {{-- Cárgalo siempre o, si prefieres, sólo para rutas admin: --}}
    {{-- @if(request()->routeIs('admin.*')) <link rel="stylesheet" href="{{ asset('css/app.css') }}"> @endif --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

    {{-- (Adición) Estilos específicos para el panel de administración en CSS plano.
        No afecta a la landing ni al resto del sitio. --}}
    @if (request()->routeIs('admin.*'))
      <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @endif

    {{-- Estilos específicos para vistas de empresa --}}
    @if (request()->is('empresas/*'))
      <link rel="stylesheet" href="{{ asset('css/empresa.css') }}">
    @endif

    {{-- Punto de extensión para estilos específicos de cada vista --}}
    @stack('styles')
  </head>
  <body>
    @include('partials.header')

    <!-- Contenido específico de cada página -->
    <main>
      @yield('content')
    </main>

    @include('partials.footer')

    <!-- Script principal para interacciones básicas -->
    <script src="{{ asset('js/landing.js') }}"></script>

    {{-- Punto de extensión para scripts específicos de cada vista --}}
    @stack('scripts')
  </body>
</html>
