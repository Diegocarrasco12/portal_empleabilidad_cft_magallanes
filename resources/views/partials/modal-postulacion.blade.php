<div class="modal-overlay">
    <div class="modal-card">

        {{-- Botón cerrar --}}
        <button class="modal-close">&times;</button>

        {{-- TÍTULO --}}
        <h2 class="modal-title">{{ $postulacion->oferta->titulo }}</h2>

        {{-- EMPRESA --}}
        <p class="modal-meta">
            <strong>Empresa:</strong>
            {{ $postulacion->oferta->empresa->nombre_comercial ?? 'No registrada' }}
        </p>

        {{-- UBICACIÓN --}}
        <p class="modal-meta">
            <strong>Ubicación:</strong>
            {{ $postulacion->oferta->ciudad ?? 'Sin ciudad' }},
            {{ $postulacion->oferta->region ?? '' }}
        </p>

        {{-- ESTADO --}}
        <p class="modal-meta">
            <strong>Estado de tu postulación:</strong>
            {{ ucfirst(str_replace('_', ' ', $postulacion->estado_postulacion)) }}
        </p>

        <hr>

        {{-- DESCRIPCIÓN --}}
        <h4>Descripción del cargo</h4>
        <p>{{ $postulacion->oferta->descripcion }}</p>

        {{-- REQUISITOS --}}
        <h4>Requisitos</h4>
        <p>{{ $postulacion->oferta->requisitos }}</p>

        {{-- BENEFICIOS --}}
        @if ($postulacion->oferta->beneficios)
            <h4>Beneficios</h4>
            <p>{{ $postulacion->oferta->beneficios }}</p>
        @endif

        {{-- CONTACTO --}}
        <h4>Contacto</h4>
        <p>
            <strong>Nombre:</strong> {{ $postulacion->oferta->nombre_contacto ?? '—' }}<br>
            <strong>Email:</strong> {{ $postulacion->oferta->correo_contacto ?? '—' }}<br>
            <strong>Teléfono:</strong> {{ $postulacion->oferta->telefono_contacto ?? '—' }}
        </p>

    </div>
</div>

<style>
/* Fondo oscuro */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.55);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem;
    z-index: 9999;
    opacity: 0;
    pointer-events: none;
    transition: .25s ease;
}

/* Mostrar */
.modal-overlay.show {
    opacity: 1;
    pointer-events: all;
}

/* Tarjeta del modal */
.modal-card {
    background: #ffffff;
    padding: 2rem;
    border-radius: 14px;
    max-width: 640px;
    width: 100%;
    max-height: 85vh;
    overflow-y: auto;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    position: relative;
}

/* Botón cerrar */
.modal-close {
    position: absolute;
    top: 12px;
    right: 12px;
    font-size: 1.6rem;
    background: transparent;
    border: none;
    cursor: pointer;
}
</style>
