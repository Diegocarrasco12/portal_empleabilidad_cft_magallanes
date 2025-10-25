@extends('layouts.app')

@section('content')
    <main class="container user-edit">

        {{-- Breadcrumb --}}
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <ul>
                <li><a href="{{ route('usuarios.perfil') }}">Perfil postulante</a></li>
                <li class="current" aria-current="page">Editar perfil</li>
            </ul>
        </nav>

        {{-- Encabezado de página --}}
        <header class="page-header">
            <h1>Editar Perfil</h1>
            <p class="muted">Actualiza tu información para mejorar tus postulaciones.</p>
        </header>

        <form action="{{ url('/usuarios/editar') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- === Avatar + Nombre / Titulación === --}}
            <section class="card">
                <h2>Identidad</h2>
                <div class="grid-2">
                    <div class="field">
                        <label for="avatar">Foto de perfil</label>
                        <div class="avatar-row">
                            <img class="avatar-preview" src="{{ asset('img/testimonios/test (2).png') }}"
                                alt="Avatar actual">
                            <div class="avatar-actions">
                                <input type="file" id="avatar" name="avatar" accept="image/*">
                                <p class="hint">Formatos: JPG o PNG, máx. 2MB.</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="grid-2">
                            <div class="field">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" name="nombre" type="text" value="Daniela Soto">
                            </div>
                            <div class="field">
                                <label for="run">RUN (opcional)</label>
                                <input id="run" name="run" type="text" placeholder="11.111.111-1">
                            </div>
                        </div>
                        <div class="grid-2">
                            <div class="field">
                                <label for="estado">Estado carrera</label>
                                <select id="estado" name="estado">
                                    <option>Egresado/a</option>
                                    <option>Estudiante</option>
                                    <option>Titulad@</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="titulo">Carrera / Título</label>
                                <input id="titulo" name="titulo" type="text" value="Técnico en Enfermería">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- === Contacto === --}}
            <section class="card">
                <h2>Contacto</h2>
                <div class="grid-3">
                    <div class="field">
                        <label for="email">Correo</label>
                        <input id="email" name="email" type="email" value="daniela@ejemplo.cl">
                    </div>
                    <div class="field">
                        <label for="telefono">Teléfono</label>
                        <input id="telefono" name="telefono" type="text" placeholder="+56 9 1234 5678">
                    </div>
                    <div class="field">
                        <label for="ciudad">Ciudad</label>
                        <input id="ciudad" name="ciudad" type="text" value="Punta Arenas">
                    </div>
                </div>
                <div class="field">
                    <label for="resumen">Resumen (extracto breve)</label>
                    <textarea id="resumen" name="resumen" rows="3"
                        placeholder="Cuenta en pocas líneas tu perfil profesional y lo que te interesa."></textarea>
                    <span class="hint">Máximo recomendado: 280–400 caracteres.</span>
                </div>
            </section>

            {{-- === Formación === --}}
            <section class="card">
                <h2>Formación</h2>
                <div class="grid-2">
                    <div class="field">
                        <label for="institucion">Institución</label>
                        <input id="institucion" name="institucion" type="text" value="CFT Magallanes">
                    </div>
                    <div class="field">
                        <label for="anio_egreso">Año de egreso</label>
                        <input id="anio_egreso" name="anio_egreso" type="number" min="1990" max="2099"
                            value="2025">
                    </div>
                </div>
                <div class="field">
                    <label for="cursos">Cursos / Certificaciones (opcional)</label>
                    <textarea id="cursos" name="cursos" rows="2" placeholder="Curso A (2024), Certificación B (2025)"></textarea>
                </div>
            </section>

            {{-- === Experiencia (dos bloques de ejemplo) === --}}
            <section class="card">
                <h2>Experiencia</h2>

                <div class="exp-block">
                    <div class="grid-3">
                        <div class="field">
                            <label>Puesto</label>
                            <input type="text" name="exp[0][puesto]" placeholder="Asistente de enfermería">
                        </div>
                        <div class="field">
                            <label>Empresa</label>
                            <input type="text" name="exp[0][empresa]" placeholder="Clínica Regional del Sur">
                        </div>
                        <div class="field">
                            <label>Periodo</label>
                            <input type="text" name="exp[0][periodo]" placeholder="03/2024 – 09/2024">
                        </div>
                    </div>
                    <div class="field">
                        <label>Funciones / Logros</label>
                        <textarea name="exp[0][detalle]" rows="2" placeholder="Describe brevemente tus tareas principales y logros."></textarea>
                    </div>
                </div>

                <div class="exp-block">
                    <div class="grid-3">
                        <div class="field">
                            <label>Puesto</label>
                            <input type="text" name="exp[1][puesto]" placeholder="Práctica profesional">
                        </div>
                        <div class="field">
                            <label>Empresa</label>
                            <input type="text" name="exp[1][empresa]" placeholder="Hospital Base">
                        </div>
                        <div class="field">
                            <label>Periodo</label>
                            <input type="text" name="exp[1][periodo]" placeholder="01/2024 – 02/2024">
                        </div>
                    </div>
                    <div class="field">
                        <label>Funciones / Logros</label>
                        <textarea name="exp[1][detalle]" rows="2" placeholder="Describe brevemente tus tareas principales y logros."></textarea>
                    </div>
                </div>

                <p class="hint">Puedes agregar más experiencias más adelante (funcionalidad dinámica).</p>
            </section>

            {{-- === CV / Portafolio === --}}
            <section class="card">
                <h2>CV y enlaces</h2>
                <div class="grid-2">
                    <div class="field">
                        <label for="cv">Subir CV (PDF)</label>
                        <input id="cv" name="cv" type="file" accept="application/pdf">
                        <span class="hint">Máx. 4MB. Formato PDF.</span>
                    </div>
                    <div class="field">
                        <label for="linkedin">LinkedIn (opcional)</label>
                        <input id="linkedin" name="linkedin" type="url"
                            placeholder="https://www.linkedin.com/in/tu-perfil">
                    </div>
                </div>
                <div class="field">
                    <label for="portfolio">Portafolio / Sitio (opcional)</label>
                    <input id="portfolio" name="portfolio" type="url" placeholder="https://tusitio.com">
                </div>
            </section>

            {{-- === Preferencias === --}}
            <section class="card">
                <h2>Preferencias</h2>
                <div class="grid-3">
                    <div class="field">
                        <label for="area">Área de interés</label>
                        <select id="area" name="area">
                            <option>Salud</option>
                            <option>Administración</option>
                            <option>Logística</option>
                            <option>Turismo</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="jornada">Jornada</label>
                        <select id="jornada" name="jornada">
                            <option>Completa</option>
                            <option>Media jornada</option>
                            <option>Práctica</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="modalidad">Modalidad</label>
                        <select id="modalidad" name="modalidad">
                            <option>Presencial</option>
                            <option>Híbrido</option>
                            <option>Remoto</option>
                        </select>
                    </div>
                </div>
            </section>

            {{-- === Visibilidad de perfil === --}}
            <section class="card">
                <h2>Visibilidad</h2>
                <div class="grid-2">
                    <div class="field">
                        <label for="visibilidad">Perfil visible para empresas</label>
                        <select id="visibilidad" name="visibilidad">
                            <option value="publico">Sí, hacer mi perfil visible</option>
                            <option value="privado">No, mantener mi perfil privado</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="alertas">Alertas de ofertas por email</label>
                        <select id="alertas" name="alertas">
                            <option value="diario">Diario</option>
                            <option value="semanal">Semanal</option>
                            <option value="off">Desactivar</option>
                        </select>
                    </div>
                </div>
            </section>

            {{-- Acciones --}}
            <div class="form-actions">
                <a href="{{ route('usuarios.perfil') }}" class="btn btn-ghost">Cancelar</a>
                <button type="submit" name="borrador" value="1" class="btn btn-outline">Guardar borrador</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </main>

    @push('styles')
        <style>
            /* Breadcrumb (igual al usado en páginas anteriores) */
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

            .user-edit {
                padding: 1.25rem 0 2rem;
            }

            .page-header h1 {
                margin: 0 0 .25rem;
                font-size: 1.5rem;
            }

            .page-header .muted {
                color: #6b7280;
                margin: 0 0 1rem;
            }

            .card {
                background: #fff;
                border: 1px solid #eee;
                border-radius: 12px;
                padding: 1.25rem;
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

            .avatar-row {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .avatar-preview {
                width: 72px;
                height: 72px;
                border-radius: 50%;
                object-fit: cover;
            }

            .avatar-actions input[type="file"] {
                padding: .55rem;
                border: 1px dashed #d1d5db;
                border-radius: 8px;
                background: #fafafa;
            }

            .exp-block {
                border: 1px dashed #e5e7eb;
                border-radius: 12px;
                padding: 1rem;
                margin-bottom: .8rem;
                background: #fcfcfc;
            }

            .form-actions {
                display: flex;
                gap: .75rem;
                justify-content: flex-end;
                align-items: center;
                margin-top: 1rem;
            }

            /* Botones (coherentes con los ya usados en el sitio) */
            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: .4rem;
                border-radius: 10px;
                padding: .8rem 1.25rem;
                font-weight: 700;
                line-height: 1;
                border: 1px solid transparent;
                text-decoration: none;
                cursor: pointer;
                transition: background .2s, color .2s, border-color .2s, box-shadow .2s, transform .06s;
                box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            }

            .btn:active {
                transform: translateY(1px);
            }

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

            .btn-outline {
                background: #fff;
                color: #111827;
                border-color: #d1d5db;
            }

            .btn-outline:hover {
                background: #f9fafb;
                border-color: #cbd5e1;
            }

            .btn-outline:focus {
                outline: 0;
                box-shadow: 0 0 0 4px rgba(2, 132, 199, .15);
            }

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

            /* ====== Responsive ====== */

            /* Tablet (≤ 1024px) */
            @media (max-width: 1024px) {
                .grid-3 {
                    grid-template-columns: 1fr 1fr;
                }
            }

            /* Mobile (≤ 768px) */
            @media (max-width: 768px) {

                .grid-2,
                .grid-3 {
                    grid-template-columns: 1fr;
                }

                /* Acciones del formulario: apilar y ocupar ancho completo */
                .form-actions {
                    display: flex;
                    flex-direction: column;
                    align-items: stretch;
                    /* ← stretch va en align-items, no en justify-content */
                    gap: .5rem;
                    margin-top: 1rem;
                }

                .form-actions .btn {
                    width: 100%;
                }
            }

            /* Small mobile (≤ 640px) */
            @media (max-width: 640px) {

                /* Contenedor y tarjetas */
                .user-edit {
                    padding: .75rem 0 1.25rem;
                }

                .card {
                    padding: .9rem;
                    border-radius: 12px;
                }

                /* Tipografía de cabecera */
                .page-header h1 {
                    font-size: 1.25rem;
                }

                .page-header .muted {
                    font-size: .9rem;
                }

                /* Breadcrumb con salto de línea */
                .breadcrumb ul {
                    flex-wrap: wrap;
                    row-gap: .25rem;
                }

                /* Avatar compacto */
                .avatar-row {
                    align-items: flex-start;
                    gap: .75rem;
                }

                .avatar-preview {
                    width: 56px;
                    height: 56px;
                }

                /* Inputs legibles y sin zoom iOS */
                .field input,
                .field select,
                .field textarea {
                    font-size: 16px;
                    /* evita el auto-zoom en iOS */
                    padding: .65rem .75rem;
                }

                /* File inputs a todo el ancho */
                .avatar-actions input[type="file"],
                #cv {
                    width: 100%;
                }

                /* Aire en bloques de experiencia */
                .exp-block {
                    padding: .85rem;
                }
            }
        </style>
    @endpush
@endsection
