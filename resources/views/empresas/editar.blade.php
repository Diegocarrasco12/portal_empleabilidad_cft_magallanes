@extends('layouts.app')

@section('content')
    <main class="container company-edit">

        {{-- Breadcrumb --}}
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <ul>
                <li><a href="{{ route('empresas.perfil') }}">Perfil empresa</a></li>
                <li class="current" aria-current="page">Editar perfil</li>
            </ul>
        </nav>

        {{-- Encabezado --}}
        <header class="page-header">
            <h1>Editar Perfil</h1>
            <p class="muted">Actualiza la información de tu empresa para publicar ofertas y recibir mejores postulaciones.
            </p>
        </header>

        <form action="{{ route('empresas.perfil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- === Identidad === --}}
            <section class="card">
                <h2>Identidad</h2>
                <div class="grid-2">
                    <div class="field">
                        <label for="logo">Logo</label>
                        <div class="avatar-row">
                            <img class="avatar-preview" src="{{ asset('img/empresas/global-marketing-logo.png') }}"
                                alt="Logo actual">
                            <div class="avatar-actions">
                                <input type="file" id="logo" name="logo" accept="image/png,image/jpeg">
                                <p class="hint">Formatos: JPG o PNG, máx. 2MB.</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="grid-2">
                            <div class="field">
                                <label for="nombre_comercial">Nombre comercial *</label>
                                <input id="nombre_comercial" name="nombre_comercial" type="text"
                                    value="Global Marketing">
                            </div>
                            <div class="field">
                                <label for="razon_social">Razón social (opcional)</label>
                                <input id="razon_social" name="razon_social" type="text"
                                    placeholder="Global Marketing SpA">
                            </div>
                        </div>

                        <div class="grid-3">
                            <div class="field">
                                <label for="rut">RUT empresa (opcional)</label>
                                <input id="rut" name="rut" type="text" placeholder="76.123.456-7">
                            </div>
                            <div class="field">
                                <label for="rubro">Rubro / Área *</label>
                                <select id="rubro" name="rubro">
                                    <option value="">Selecciona</option>
                                    <option>Construcción</option>
                                    <option>Industrial</option>
                                    <option>Salud</option>
                                    <option>Educación</option>
                                    <option>Servicios</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="tamano">Tamaño empresa</label>
                                <select id="tamano" name="tamano">
                                    <option>1-10</option>
                                    <option>11-50</option>
                                    <option>51-200</option>
                                    <option>201-500</option>
                                    <option>500+</option>
                                </select>
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
                        <label for="email">Correo de contacto *</label>
                        <input id="email" name="email" type="email" value="contacto@empresa.cl">
                    </div>
                    <div class="field">
                        <label for="telefono">Teléfono *</label>
                        <input id="telefono" name="telefono" type="text" placeholder="+56 9 1234 5678">
                    </div>
                    <div class="field">
                        <label for="web">Sitio web</label>
                        <input id="web" name="web" type="url" placeholder="https://www.empresa.cl">
                    </div>
                </div>

                <div class="grid-3">
                    <div class="field">
                        <label for="region">Región</label>
                        <input id="region" name="region" type="text" value="Magallanes y de la Antártica Chilena">
                    </div>
                    <div class="field">
                        <label for="ciudad">Ciudad / Comuna</label>
                        <input id="ciudad" name="ciudad" type="text" value="Punta Arenas">
                    </div>
                    <div class="field">
                        <label for="direccion">Dirección</label>
                        <input id="direccion" name="direccion" type="text" placeholder="Av. Ejemplo 1234">
                    </div>
                </div>
            </section>

            {{-- === Sobre la empresa === --}}
            <section class="card">
                <h2>Sobre la empresa</h2>

                <div class="field">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="4"
                        placeholder="Describe brevemente a qué se dedica la empresa, misión, cultura, etc."></textarea>
                    <span class="hint">Recomendado: 280–600 caracteres.</span>
                </div>

                <div class="grid-3">
                    <div class="field">
                        <label for="linkedin">LinkedIn</label>
                        <input id="linkedin" name="linkedin" type="url"
                            placeholder="https://www.linkedin.com/company/...">
                    </div>
                    <div class="field">
                        <label for="instagram">Instagram</label>
                        <input id="instagram" name="instagram" type="url" placeholder="https://instagram.com/...">
                    </div>
                    <div class="field">
                        <label for="facebook">Facebook</label>
                        <input id="facebook" name="facebook" type="url" placeholder="https://facebook.com/...">
                    </div>
                </div>
            </section>

            {{-- === Representante (opcional) === --}}
            <section class="card">
                <h2>Representante (opcional)</h2>
                <div class="grid-3">
                    <div class="field">
                        <label for="rep_nombre">Nombre</label>
                        <input id="rep_nombre" name="rep_nombre" type="text" placeholder="Macarena Navarro">
                    </div>
                    <div class="field">
                        <label for="rep_cargo">Cargo</label>
                        <input id="rep_cargo" name="rep_cargo" type="text" placeholder="Encargada de RR.HH.">
                    </div>
                    <div class="field">
                        <label for="rep_email">Correo</label>
                        <input id="rep_email" name="rep_email" type="email" placeholder="mnavarro@empresa.cl">
                    </div>
                </div>
            </section>

            {{-- Acciones --}}
            <div class="form-actions">
                <a href="{{ route('empresas.perfil') }}" class="btn btn-ghost">Cancelar</a>
                <button type="submit" name="borrador" value="1" class="btn btn-outline">Guardar borrador</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </main>

    @push('styles')
        <style>
            /* ====== Base y breadcrumb ====== */
            .company-edit {
                padding: 1.25rem 0 2rem;
            }

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

            /* ====== Encabezado ====== */
            .page-header h1 {
                margin: 0 0 .25rem;
                font-size: 1.5rem;
            }

            .page-header .muted {
                color: #6b7280;
                margin: 0 0 1rem;
            }

            /* ====== Tarjetas ====== */
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

            /* ====== Grid ====== */
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

            /* ====== Campos ====== */
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

            /* ====== Logo / avatar ====== */
            .avatar-row {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .avatar-preview {
                width: 72px;
                height: 72px;
                border-radius: 8px;
                object-fit: cover;
                background: #f3f4f6;
            }

            .avatar-actions input[type="file"] {
                padding: .55rem;
                border: 1px dashed #d1d5db;
                border-radius: 8px;
                background: #fafafa;
            }

            /* ====== Acciones ====== */
            .form-actions {
                display: flex;
                gap: .75rem;
                justify-content: flex-end;
                align-items: center;
                margin-top: 1rem;
            }

            /* ====== Botones ====== (coherentes con users.editar) */
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
            @media (max-width: 1024px) {
                .grid-3 {
                    grid-template-columns: 1fr 1fr;
                }
            }

            @media (max-width: 768px) {

                .grid-2,
                .grid-3 {
                    grid-template-columns: 1fr;
                }

                .form-actions {
                    flex-direction: column;
                    align-items: stretch;
                    gap: .5rem;
                    margin-top: 1rem;
                }

                .form-actions .btn {
                    width: 100%;
                }
            }

            @media (max-width: 640px) {
                .company-edit {
                    padding: .75rem 0 1.25rem;
                }

                .card {
                    padding: .9rem;
                    border-radius: 12px;
                }

                .page-header h1 {
                    font-size: 1.25rem;
                }

                .page-header .muted {
                    font-size: .9rem;
                }

                .breadcrumb ul {
                    flex-wrap: wrap;
                    row-gap: .25rem;
                }

                .avatar-row {
                    align-items: flex-start;
                    gap: .75rem;
                }

                .avatar-preview {
                    width: 60px;
                    height: 60px;
                    border-radius: 8px;
                }

                .field input,
                .field select,
                .field textarea {
                    font-size: 16px;
                }
            }
        </style>
    @endpush
@endsection
