<!--
  Encabezado del sitio. Contiene el logotipo, la navegación principal
  y controles según el rol del usuario.
-->
<header class="site-header">
    <div class="container header-inner">

        {{-- Logotipo --}}
        <a href="{{ url('/') }}" class="logo" aria-label="Ir al inicio">
            <img src="{{ asset('img/iconos/logo.png') }}" alt="CFT Magallanes" width="180" height="50">
        </a>

        @php
            // Sesión manual
            $isLogged = session('autenticado') === true;
            $userName = session('usuario_nombre');
            $userRole = session('usuario_rol');
            // Puede venir como nombre ('postulante','empresa','admin') o como id (1,2,3)
        @endphp

        {{-- Navegación principal --}}
        <nav class="main-nav" id="mainNav" aria-label="Navegación principal">
            <ul>
                <li><a href="{{ url('/') }}">Inicio</a></li>
                <li><a href="{{ route('jobs.index') }}">Ofertas</a></li>

                {{-- Visitante sin sesión --}}
                @if (!$isLogged)
                    <li><a href="{{ route('login') }}">Ingresar</a></li>
                    <li><a href="{{ route('register') }}">Registrarse</a></li>

                    {{-- Usuario con sesión --}}
                @else
                    {{-- Bienvenida --}}
                    <li style="margin-right: 20px; font-weight:bold; color:#222;">
                        Bienvenido, {{ $userName }}
                    </li>

                    {{-- Enlace según rol --}}
                    @if ($userRole === 'postulante' || (int) $userRole === 3)
                        <li><a href="{{ route('usuarios.perfil') }}">Mi Perfil</a></li>
                    @elseif ($userRole === 'empresa' || (int) $userRole === 2)
                        <li><a href="{{ route('empresas.perfil') }}">Mi Empresa</a></li>
                    @elseif ($userRole === 'admin' || (int) $userRole === 1)
                        <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                    @endif

                    {{-- Cerrar sesión --}}
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit"
                                style="background:none; border:none; padding:0; color:inherit; font:inherit; cursor:pointer;">
                                Cerrar sesión
                            </button>
                        </form>
                    </li>

                @endif
            </ul>
        </nav>
        {{-- Menú hamburguesa --}}
        <button class="burger" id="burgerBtn" aria-label="Abrir menú" aria-controls="mainNav" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>

    </div>
</header>
