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
        @if (! $isLogged)
            <li><a href="{{ route('login') }}">Ingresar</a></li>
            <li><a href="{{ route('register') }}">Registrarse</a></li>

        {{-- Usuario con sesión --}}
        @else
            {{-- Bienvenida --}}
            <li style="margin-right: 20px; font-weight:bold; color:#222;">
              Bienvenido, {{ $userName }}
            </li>

            {{-- Enlace según rol --}}
            @if ($userRole === 'postulante' || (int)$userRole === 3)
                <li><a href="{{ route('usuarios.perfil') }}">Mi Perfil</a></li>

            @elseif ($userRole === 'empresa' || (int)$userRole === 2)
                <li><a href="{{ route('empresas.perfil') }}">Mi Empresa</a></li>

            @elseif ($userRole === 'admin' || (int)$userRole === 1)
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

    {{-- Bloque admin solo visible en rutas admin.* --}}
    @if (request()->routeIs('admin.*'))
      <div class="admin-topbar" role="group" aria-label="Información de administrador">
        <div class="admin-meta">
          <span class="admin-welcome">
            Bienvenida {{ $adminName ?? $userName ?? 'Administrador' }}
          </span>
          <span class="admin-role">Admin CFT Magallanes</span>
        </div>

        <button class="icon-btn" aria-label="Notificaciones">
          <svg viewBox="0 0 24 24" width="20" height="20">
            <path d="M12 22a2 2 0 0 0 2-2H10a2 2 0 0 0 2 2Zm6-6V11a6 6 0 1 0-12 0v5l-2 2v1h16v-1l-2-2Z"/>
          </svg>
        </button>

        <button class="icon-btn" aria-label="Configuración">
          <svg viewBox="0 0 24 24" width="20" height="20">
            <path d="M19.14,12.94a7.43,7.43,0,0,0,.05-1,7.43,7.43,0,0,0-.05-1l2.11-1.65a.5.5,0,0,0,.12-.64l-2-3.46a.5.5,0,0,0-.6-.22l-2.49,1a7.35,7.35,0,0,0-1.73-1l-.38-2.65A.5.5,0,0,0,13,.5H11a.5.5,0,0,0-.5.42L10.12,3.57a7.35,7.35,0,0,0-1.73,1l-2.49-1a.5.5,0,0,0-.6.22l-2,3.46a.5.5,0,0,0,.12.64L2.54,10a7.43,7.43,0,0,0-.05,1,7.43,7.43,0,0,0,.05,1L.43,13.65a.5.5,0,0,0-.12.64l2,3.46a.5.5,0,0,0,.6.22l2.49-1a7.35,7.35,0,0,0,1.73,1l.38,2.65A.5.5,0,0,0,11,23.5h2a.5.5,0,0,0,.5-.42l.38-2.65a7.35,7.35,0,0,0,1.73-1l2.49,1a.5.5,0,0,0,.6-.22l2-3.46a.5.5,0,0,0-.12-.64ZM12,16a4,4,0,1,1,4-4A4,4,0,0,1,12,16Z"/>
          </svg>
        </button>

        <img class="admin-avatar" src="{{ asset('img/testimonios/test (2).png') }}" alt="Avatar admin">
      </div>
    @endif

    {{-- Menú hamburguesa --}}
    <button class="burger" id="burgerBtn" aria-label="Abrir menú" aria-controls="mainNav" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>

  </div>
</header>
