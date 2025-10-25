@extends('layouts.app')

@section('content')
    <main class="container crear-oferta">

        {{-- Breadcrumbs --}}
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <ul>
                <li><a href="{{ route('empresas.perfil') }}">Perfil empresa</a></li>
                <li class="current" aria-current="page">Crear nueva oferta</li>
            </ul>
        </nav>


        {{-- Encabezado de página --}}
        <header class="page-header">
            <h1>Publicar Nueva Oferta</h1>
            <p class="muted">Completa los campos y revisa que la información sea clara para los postulantes.</p>
        </header>

        {{-- Formulario de creación (ajusta la ruta de acción a tu controlador) --}}
        <form method="POST" action="{{ route('empresas.ofertas.store') }}" class="form-create-oferta"
            enctype="multipart/form-data">
            @csrf

            {{-- 1) Información general --}}
            <section class="card">
                <h2>Información general</h2>
                <div class="grid-2">
                    <div class="field">
                        <label for="titulo">Título del puesto *</label>
                        <input id="titulo" name="titulo" type="text"
                            placeholder="Ej: Técnico en Mantenimiento Industrial" required>
                        @error('titulo')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="area">Área laboral *</label>
                        <select id="area" name="area" required>
                            <option value="">Selecciona un área</option>
                            <option>Industrial</option>
                            <option>Salud</option>
                            <option>Turismo</option>
                            <option>Administración</option>
                            <option>TI / Informática</option>
                        </select>
                        @error('area')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="tipo_contrato">Tipo de contrato *</label>
                        <select id="tipo_contrato" name="tipo_contrato" required>
                            <option value="">Selecciona</option>
                            <option>Plazo fijo</option>
                            <option>Indefinido</option>
                            <option>Práctica</option>
                            <option>Honorarios</option>
                        </select>
                        @error('tipo_contrato')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="modalidad">Modalidad *</label>
                        <select id="modalidad" name="modalidad" required>
                            <option value="">Selecciona</option>
                            <option>Presencial</option>
                            <option>Remoto</option>
                            <option>Híbrido</option>
                        </select>
                        @error('modalidad')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="grid-3">
                    <div class="field">
                        <label for="jornada">Jornada</label>
                        <select id="jornada" name="jornada">
                            <option>Full-time</option>
                            <option>Part-time</option>
                            <option>Por turnos</option>
                        </select>
                    </div>

                    <div class="field">
                        <label for="vacantes">Vacantes</label>
                        <input id="vacantes" name="vacantes" type="number" min="1" placeholder="1">
                    </div>

                    <div class="field">
                        <label for="cierre">Fecha de cierre</label>
                        <input id="cierre" name="cierre" type="date">
                    </div>
                </div>
            </section>

            {{-- 2) Ubicación --}}
            <section class="card">
                <h2>Ubicación</h2>
                <div class="grid-3">
                    <div class="field">
                        <label for="region">Región</label>
                        <input id="region" name="region" type="text"
                            placeholder="Magallanes y de la Antártica Chilena">
                    </div>
                    <div class="field">
                        <label for="ciudad">Ciudad / Comuna</label>
                        <input id="ciudad" name="ciudad" type="text" placeholder="Punta Arenas">
                    </div>
                    <div class="field">
                        <label for="direccion">Dirección (opcional)</label>
                        <input id="direccion" name="direccion" type="text" placeholder="Av. Ejemplo 1234">
                    </div>
                </div>
            </section>

            {{-- 3) Compensación y beneficios --}}
            <section class="card">
                <h2>Compensación y beneficios</h2>
                <div class="grid-3">
                    <div class="field">
                        <label for="salario_min">Salario mínimo (CLP)</label>
                        <input id="salario_min" name="salario_min" type="number" min="0" step="1000"
                            placeholder="700000">
                    </div>
                    <div class="field">
                        <label for="salario_max">Salario máximo (CLP)</label>
                        <input id="salario_max" name="salario_max" type="number" min="0" step="1000"
                            placeholder="1200000">
                    </div>
                    <div class="field">
                        <label for="renta_visible">Mostrar rango en la oferta</label>
                        <select id="renta_visible" name="renta_visible">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label for="beneficios">Beneficios (separados por coma)</label>
                    <input id="beneficios" name="beneficios" type="text"
                        placeholder="Colación, Movilización, Seguro de salud, etc.">
                </div>
            </section>

            {{-- 4) Descripción y requisitos --}}
            <section class="card">
                <h2>Descripción del cargo</h2>
                <div class="field">
                    <label for="descripcion">Descripción *</label>
                    <textarea id="descripcion" name="descripcion" rows="6" required
                        placeholder="Explica responsabilidades, equipo, tecnologías, herramientas, etc."></textarea>
                    @error('descripcion')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="grid-2">
                    <div class="field">
                        <label for="requisitos">Requisitos *</label>
                        <textarea id="requisitos" name="requisitos" rows="5" required
                            placeholder="Lista requisitos mínimos (bullets)."></textarea>
                        @error('requisitos')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="deseables">Conocimientos deseables</label>
                        <textarea id="deseables" name="deseables" rows="5" placeholder="Plus o deseables (bullets)."></textarea>
                    </div>
                </div>

                <div class="field">
                    <label for="archivo">Adjuntar documento (opcional)</label>
                    <input id="archivo" name="archivo" type="file" accept=".pdf,.doc,.docx">
                    <small class="hint">PDF o DOCX (máx. 5MB).</small>
                </div>
            </section>

            {{-- 5) Contacto --}}
            <section class="card">
                <h2>Contacto</h2>
                <div class="grid-3">
                    <div class="field">
                        <label for="contacto_nombre">Nombre *</label>
                        <input id="contacto_nombre" name="contacto_nombre" type="text" required
                            placeholder="Nombre y apellido">
                    </div>
                    <div class="field">
                        <label for="contacto_email">Email *</label>
                        <input id="contacto_email" name="contacto_email" type="email" required
                            placeholder="contacto@empresa.cl">
                    </div>
                    <div class="field">
                        <label for="contacto_telefono">Teléfono</label>
                        <input id="contacto_telefono" name="contacto_telefono" type="tel"
                            placeholder="+56 9 1234 5678">
                    </div>
                </div>
            </section>

            {{-- Acciones --}}
            <div class="form-actions">
                <a href="{{ route('empresas.perfil') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" name="borrador" value="1" class="btn btn-light">Guardar borrador</button>
                <button type="submit" class="btn btn-primary">Publicar oferta</button>
            </div>
        </form>
    </main>

    {{-- Estilos mínimos específicos (usa las utilidades existentes) --}}
    @push('styles')
        <style>
            /* ===== Encabezado de página ===== */
            .page-header h1 {
                margin: 0 0 .25rem;
                font-size: 1.5rem;
            }

            .page-header .muted {
                color: #6b7280;
                margin: 0 0 1rem;
            }

            /* ===== Breadcrumb (sin números) ===== */
            .breadcrumb ul {
                list-style: none;
                display: flex;
                gap: .5rem;
                padding: 0;
                margin: 0 0 .75rem;
                align-items: center;
                color: #6b7280;
                font-size: .92rem;
            }

            .breadcrumb li a {
                color: #6b7280;
                text-decoration: none;
            }

            .breadcrumb li a:hover {
                color: #374151;
                text-decoration: underline;
            }

            .breadcrumb li+li::before {
                content: '›';
                opacity: .6;
                margin: 0 .35rem 0 .15rem;
            }

            .breadcrumb .current {
                color: #111827;
                font-weight: 600;
            }

            /* ===== Cards / Layout ===== */
            .card {
                background: #fff;
                border: 1px solid #eee;
                border-radius: 12px;
                padding: 1.25rem 1.25rem 1rem;
                margin-bottom: 1rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
            }

            .card>h2 {
                margin: 0 0 1rem;
                font-size: 1.05rem;
            }

            .grid-2 {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }

            .grid-3 {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1rem;
            }

            .field {
                display: flex;
                flex-direction: column;
                gap: .4rem;
            }

            .field input,
            .field select,
            .field textarea {
                padding: .65rem .75rem;
                border: 1px solid #ddd;
                border-radius: 8px;
                font-size: .95rem;
                background: #fff;
            }

            .field textarea {
                resize: vertical;
            }

            .hint {
                color: #6b7280;
                font-size: .8rem;
            }

            .error {
                color: #c91e25;
            }

            /* ===== Botones profesionales ===== */
            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: .4rem;
                border-radius: 10px;
                padding: .8rem 1.25rem;
                font-weight: 600;
                text-decoration: none;
                line-height: 1;
                border: 1px solid transparent;
                transition:
                    background .2s ease,
                    color .2s ease,
                    border-color .2s ease,
                    box-shadow .2s ease,
                    transform .06s ease;
                box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
                cursor: pointer;
            }

            .btn:active {
                transform: translateY(1px);
            }

            /* Primario (rojo institucional) */
            .btn-primary {
                background: #c91e25;
                color: #fff;
                border-color: #c91e25;
            }

            .btn-primary:hover {
                background: #b01920;
                border-color: #b01920;
            }

            .btn-primary:focus {
                outline: 0;
                box-shadow: 0 0 0 4px rgba(201, 30, 37, .18);
            }

            /* Contorno (equivalente a tu antiguo .btn-light) */
            .btn-outline,
            .btn-light {
                background: #fff;
                color: #111827;
                border-color: #d1d5db;
            }

            .btn-outline:hover,
            .btn-light:hover {
                background: #f9fafb;
                border-color: #cbd5e1;
            }

            .btn-outline:focus,
            .btn-light:focus {
                outline: 0;
                box-shadow: 0 0 0 4px rgba(2, 132, 199, .15);
            }

            /* Fantasma (para “Cancelar”) */
            .btn-ghost {
                background: transparent;
                color: #c91e25;
                border-color: transparent;
            }

            .btn-ghost:hover {
                background: #fff1f2;
            }

            .btn-ghost:focus {
                outline: 0;
                box-shadow: 0 0 0 4px rgba(201, 30, 37, .15);
            }

            /* Acciones del formulario */
            .form-actions {
                display: flex;
                gap: .75rem;
                justify-content: flex-end;
                align-items: center;
                margin-top: 1rem;
            }

            /* ===== Responsive ===== */
            @media (max-width:1024px) {
                .grid-3 {
                    grid-template-columns: 1fr 1fr;
                }
            }

            @media (max-width:768px) {

                .grid-2,
                .grid-3 {
                    grid-template-columns: 1fr;
                }

                .form-actions {
                    flex-wrap: wrap;
                    justify-content: stretch;
                }

                .form-actions .btn {
                    flex: 1 0 100%;
                }
            }
        </style>
    @endpush
@endsection
