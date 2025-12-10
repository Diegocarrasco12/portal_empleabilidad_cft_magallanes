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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Hoja de estilos principal (landing) -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}" />
    <!-- Estilos base para todos los formularios institucionales -->
    <link rel="stylesheet" href="{{ asset('css/forms-base.css') }}">

    {{-- Estilos solo para dashboard principal admin --}}
    @if (request()->routeIs('admin.dashboard'))
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @endif

    {{-- Estilos CRUD (estudiantes, empresas, ofertas, postulaciones...) --}}
    @if (request()->routeIs('admin.estudiantes.*') ||
            request()->routeIs('admin.empresas.*') ||
            request()->routeIs('admin.ofertas.*') ||
            request()->routeIs('admin.postulantes.*') ||
            request()->routeIs('admin.postulaciones.*'))
        <link rel="stylesheet" href="{{ asset('css/panel-admin.css') }}">
    @endif

    {{-- Estilos para vistas de empresas externas --}}
    @if (request()->is('empresas/*'))
        <link rel="stylesheet" href="{{ asset('css/empresa.css') }}">
    @endif
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Punto de extensión para estilos específicos de cada vista --}}
    @stack('styles')
    <style>
        /* Fondo crema suave para todas las páginas internas */
        .bg-crema {
            background-color: #f1f3f5 !important;
            /* crema/hueso moderno */
        }
    </style>

</head>

<body class="{{ request()->is('/') ? '' : 'bg-crema' }}" style="min-height:100vh;display:flex;flex-direction:column;">

    @include('partials.header')

    <!-- Contenido específico de cada página -->
    <main style="flex:1;">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Script principal para interacciones básicas -->
    <script src="{{ asset('js/landing.js') }}"></script>

    {{-- Punto de extensión para scripts específicos de cada vista --}}
    @stack('scripts')
    <!-- ============ LOADER GLOBAL ============ -->
    <div id="global-loader"
        style="
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(3px);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999999;
        visibility: hidden;
        opacity: 0;
        transition: opacity .3s ease-in-out;
     ">
        <div style="text-align:center;">
            <div class="spinner-border text-primary" style="width: 4rem; height: 4rem;" role="status">
            </div>
            <p class="mt-3 fs-5 fw-bold text-dark">Cargando, por favor espera...</p>
        </div>
    </div>

    <script>
        const loader = document.getElementById("global-loader");

        function showLoader() {
            loader.style.visibility = "visible";
            loader.style.opacity = "1";
        }

        function hideLoader() {
            loader.style.opacity = "0";
            setTimeout(() => loader.style.visibility = "hidden", 300);
        }

        // Mostrar loader al cambiar página
        window.addEventListener("beforeunload", showLoader);

        // Mostrar loader al enviar formularios
        document.addEventListener("submit", function(e) {
            if (!e.target.hasAttribute("data-no-loader")) {
                showLoader();
            }
        });

        // Ocultar loader cuando la página carga normal
        window.addEventListener("load", hideLoader);

        // --- FIX PARA NAVEGAR HACIA ATRÁS ---
        window.addEventListener("pageshow", function(event) {
            if (event.persisted) {
                hideLoader();
            }
        });
    </script>
    {{-- ===========================
 MODAL GLOBAL DE ALERTAS (SOPORTA success, info, warning, error)
=========================== --}}

    @php
        $alertType = null;
        $alertMessage = null;

        if (session('success')) {
            $alertType = 'success';
            $alertMessage = session('success');
        } elseif (session('info')) {
            $alertType = 'info';
            $alertMessage = session('info');
        } elseif (session('warning')) {
            $alertType = 'warning';
            $alertMessage = session('warning');
        } elseif (session('error')) {
            $alertType = 'error';
            $alertMessage = session('error');
        }
    @endphp

    @if ($alertType && $alertMessage)
        <div id="modalAlerta" class="modal-fondo">
            <div class="modal-contenido">

                <div class="modal-icono">
                    @if ($alertType === 'success')
                        <span style="color:#28a745;font-size:48px;">✔</span>
                    @elseif ($alertType === 'info')
                        <span style="color:#0d6efd;font-size:48px;">ℹ</span>
                    @elseif ($alertType === 'warning')
                        <span style="color:#ffc107;font-size:48px;">⚠</span>
                    @elseif ($alertType === 'error')
                        <span style="color:#dc3545;font-size:48px;">✖</span>
                    @endif
                </div>

                <h3 class="modal-titulo">{{ $alertMessage }}</h3>

                <button onclick="cerrarModalAlerta()" class="modal-boton">Aceptar</button>
            </div>
        </div>
    @endif

    <script>
        function cerrarModalAlerta() {
            const modal = document.getElementById('modalAlerta');
            if (modal) modal.remove();
        }

        setTimeout(cerrarModalAlerta, 4000);
    </script>

    <style>
        .modal-fondo {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.45);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999999;
            animation: fadeIn .3s ease;
        }

        .modal-contenido {
            background: white;
            padding: 30px 40px;
            border-radius: 14px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            animation: popUp .3s ease;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
        }

        .modal-icono span {
            font-size: 48px;
            display: block;
            margin-bottom: 10px;
        }

        .icono-exito {
            color: #28a745;
        }

        .icono-error {
            color: #dc3545;
        }

        .modal-titulo {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .modal-boton {
            background: #c91e25;
            border: none;
            color: white;
            padding: 10px 22px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
        }

        .modal-boton:hover {
            background: #a8171f;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes popUp {
            from {
                transform: scale(.7);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

    <script>
        function cerrarModalAlerta() {
            const modal = document.getElementById('modalAlerta');
            if (modal) modal.remove();
        }

        // Autocerrar después de 4 segundos
        setTimeout(cerrarModalAlerta, 4000);

        // FIX para navegación atrás (Chrome/Firefox/Edge)
        window.addEventListener("pageshow", function(event) {
            if (event.persisted) cerrarModalAlerta();
        });
    </script>

</body>

</html>
