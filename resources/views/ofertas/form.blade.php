{{-- 
===============================================================================
FORMULARIO PROFESIONAL DE OFERTAS LABORALES
Usado por:
 - empresas.crear_oferta
 - empresas.editar_oferta
Mantiene diseño institucional del módulo Empresa / Empleabilidad
===============================================================================
--}}

{{-- Determina si es edición o creación --}}
@php
    $editando = isset($oferta);
@endphp

<section class="card">
    <form 
        method="POST" 
        action="{{ $editando ? route('empresas.ofertas.update', $oferta->id) : route('empresas.ofertas.store') }}"
        enctype="multipart/form-data"
        class="form-create-oferta"

    >
        @csrf
        @if($editando)
            @method('PUT')
        @endif


        {{-- =====================================================================
            1) INFORMACIÓN GENERAL
        ===================================================================== --}}
        <section class="card mt-3">
            <h3>Información general</h3>

            <div class="grid-2">

                {{-- Título --}}
                <div class="field">
                    <label for="titulo">Título del puesto *</label>
                    <input
                        id="titulo"
                        name="titulo"
                        type="text"
                        value="{{ old('titulo', $editando ? $oferta->titulo : '') }}"
                        placeholder="Ej: Técnico en Mantenimiento Industrial"
                        required
                    >
                    @error('titulo') <small class="error">{{ $message }}</small> @enderror
                </div>

                {{-- Área laboral --}}
                <div class="field">
                    <label for="area_id">Área laboral *</label>
                    <select id="area_id" name="area_id" required>
                        <option value="">Selecciona un área</option>
                        <option value="1" {{ old('area_id', $editando ? $oferta->area_id : '') == 1 ? 'selected' : '' }}>Industrial</option>
                        <option value="2" {{ old('area_id', $editando ? $oferta->area_id : '') == 2 ? 'selected' : '' }}>Salud</option>
                        <option value="3" {{ old('area_id', $editando ? $oferta->area_id : '') == 3 ? 'selected' : '' }}>Turismo</option>
                        <option value="4" {{ old('area_id', $editando ? $oferta->area_id : '') == 4 ? 'selected' : '' }}>Administración</option>
                        <option value="5" {{ old('area_id', $editando ? $oferta->area_id : '') == 5 ? 'selected' : '' }}>TI / Informática</option>
                    </select>
                    @error('area_id') <small class="error">{{ $message }}</small> @enderror
                </div>

                {{-- Tipo de contrato --}}
                <div class="field">
                    <label for="tipo_contrato_id">Tipo de contrato *</label>
                    <select id="tipo_contrato_id" name="tipo_contrato_id" required>
                        <option value="">Selecciona</option>
                        <option value="1" {{ old('tipo_contrato_id', $editando ? $oferta->tipo_contrato_id : '') == 1 ? 'selected' : '' }}>Plazo fijo</option>
                        <option value="2" {{ old('tipo_contrato_id', $editando ? $oferta->tipo_contrato_id : '') == 2 ? 'selected' : '' }}>Indefinido</option>
                        <option value="3" {{ old('tipo_contrato_id', $editando ? $oferta->tipo_contrato_id : '') == 3 ? 'selected' : '' }}>Práctica</option>
                        <option value="4" {{ old('tipo_contrato_id', $editando ? $oferta->tipo_contrato_id : '') == 4 ? 'selected' : '' }}>Honorarios</option>
                    </select>
                    @error('tipo_contrato_id') <small class="error">{{ $message }}</small> @enderror
                </div>

                {{-- Modalidad --}}
                <div class="field">
                    <label for="modalidad_id">Modalidad *</label>
                    <select id="modalidad_id" name="modalidad_id" required>
                        <option value="">Selecciona</option>
                        <option value="1" {{ old('modalidad_id', $editando ? $oferta->modalidad_id : '') == 1 ? 'selected' : '' }}>Presencial</option>
                        <option value="2" {{ old('modalidad_id', $editando ? $oferta->modalidad_id : '') == 2 ? 'selected' : '' }}>Remoto</option>
                        <option value="3" {{ old('modalidad_id', $editando ? $oferta->modalidad_id : '') == 3 ? 'selected' : '' }}>Híbrido</option>
                    </select>
                    @error('modalidad_id') <small class="error">{{ $message }}</small> @enderror
                </div>

            </div>

            <div class="grid-3 mt-2">

                {{-- Jornada --}}
                <div class="field">
                    <label for="jornada_id">Jornada</label>
                    <select id="jornada_id" name="jornada_id">
                        <option value="">Selecciona</option>
                        <option value="1" {{ old('jornada_id', $editando ? $oferta->jornada_id : '') == 1 ? 'selected' : '' }}>Full-time</option>
                        <option value="2" {{ old('jornada_id', $editando ? $oferta->jornada_id : '') == 2 ? 'selected' : '' }}>Part-time</option>
                        <option value="3" {{ old('jornada_id', $editando ? $oferta->jornada_id : '') == 3 ? 'selected' : '' }}>Por turnos</option>
                    </select>
                </div>

                {{-- Vacantes --}}
                <div class="field">
                    <label for="vacantes">Vacantes</label>
                    <input
                        id="vacantes"
                        name="vacantes"
                        type="number"
                        min="1"
                        value="{{ old('vacantes', $editando ? $oferta->vacantes : '') }}"
                        placeholder="1"
                    >
                </div>

                {{-- Fecha cierre --}}
                <div class="field">
                    <label for="fecha_cierre">Fecha de cierre</label>
                    <input
                        id="fecha_cierre"
                        name="fecha_cierre"
                        type="date"
                        value="{{ old('fecha_cierre', $editando ? $oferta->fecha_cierre : '') }}"
                    >
                </div>

            </div>
        </section>


        {{-- =====================================================================
            2) UBICACIÓN
        ===================================================================== --}}
        <section class="card mt-3">
            <h3>Ubicación</h3>

            <div class="grid-3">

                <div class="field">
                    <label for="region">Región</label>
                    <input
                        id="region"
                        name="region"
                        type="text"
                        value="{{ old('region', $editando ? $oferta->region : '') }}"
                        placeholder="Magallanes y de la Antártica Chilena"
                    >
                </div>

                <div class="field">
                    <label for="ciudad">Ciudad / Comuna</label>
                    <input
                        id="ciudad"
                        name="ciudad"
                        type="text"
                        value="{{ old('ciudad', $editando ? $oferta->ciudad : '') }}"
                        placeholder="Punta Arenas"
                    >
                </div>

                <div class="field">
                    <label for="direccion">Dirección (opcional)</label>
                    <input
                        id="direccion"
                        name="direccion"
                        type="text"
                        value="{{ old('direccion', $editando ? $oferta->direccion : '') }}"
                        placeholder="Av. Ejemplo 1234"
                    >
                </div>

            </div>
        </section>


        {{-- =====================================================================
            3) COMPENSACIÓN Y BENEFICIOS
        ===================================================================== --}}
        <section class="card mt-3">
            <h3>Compensación y beneficios</h3>

            <div class="grid-3">

                <div class="field">
                    <label for="sueldo_min">Salario mínimo (CLP)</label>
                    <input id="sueldo_min"
                        name="sueldo_min"
                        type="number"
                        min="0"
                        step="1000"
                        value="{{ old('sueldo_min', $editando ? $oferta->sueldo_min : '') }}"
                        placeholder="700000">
                </div>

                <div class="field">
                    <label for="sueldo_max">Salario máximo (CLP)</label>
                    <input id="sueldo_max"
                        type="number"
                        min="0"
                        step="1000"
                        name="sueldo_max"
                        value="{{ old('sueldo_max', $editando ? $oferta->sueldo_max : '') }}"
                        placeholder="1200000">
                </div>

                <div class="field">
                    <label for="mostrar_sueldo">Mostrar rango en la oferta</label>
                    <select id="mostrar_sueldo" name="mostrar_sueldo">
                        <option value="1" {{ old('mostrar_sueldo', $editando ? $oferta->mostrar_sueldo : '') == 1 ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('mostrar_sueldo', $editando ? $oferta->mostrar_sueldo : '') == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>

            </div>

            <div class="field mt-2">
                <label for="beneficios">Beneficios (separados por coma)</label>
                <input
                    id="beneficios"
                    name="beneficios"
                    type="text"
                    value="{{ old('beneficios', $editando ? $oferta->beneficios : '') }}"
                    placeholder="Colación, Movilización, Seguro de salud, etc."
                >
            </div>
        </section>


        {{-- =====================================================================
            4) DESCRIPCIÓN Y REQUISITOS
        ===================================================================== --}}
        <section class="card mt-3">
            <h3>Descripción del cargo</h3>

            {{-- Descripción --}}
            <div class="field">
                <label for="descripcion">Descripción *</label>
                <textarea
                    id="descripcion"
                    name="descripcion"
                    rows="6"
                    required
                    placeholder="Explica responsabilidades, equipo, tecnologías, herramientas, etc."
                >{{ old('descripcion', $editando ? $oferta->descripcion : '') }}</textarea>
            </div>

            <div class="grid-2 mt-2">

                {{-- Requisitos --}}
                <div class="field">
                    <label for="requisitos">Requisitos *</label>
                    <textarea
                        id="requisitos"
                        name="requisitos"
                        rows="5"
                        required
                        placeholder="Lista requisitos mínimos (bullets)."
                    >{{ old('requisitos', $editando ? $oferta->requisitos : '') }}</textarea>
                </div>

                {{-- Deseables --}}
                <div class="field">
                    <label for="habilidades_deseadas">Conocimientos deseables</label>
                    <textarea
                        id="habilidades_deseadas"
                        name="habilidades_deseadas"
                        rows="5"
                        placeholder="Plus o deseables (bullets)."
                    >{{ old('habilidades_deseadas', $editando ? $oferta->habilidades_deseadas : '') }}</textarea>
                </div>

            </div>

        </section>


        {{-- =====================================================================
            5) CONTACTO
        ===================================================================== --}}
        <section class="card mt-3">
            <h3>Contacto</h3>

            <div class="grid-3">

                <div class="field">
                    <label for="nombre_contacto">Nombre *</label>
                    <input
                        id="nombre_contacto"
                        name="nombre_contacto"
                        type="text"
                        required
                        value="{{ old('nombre_contacto', $editando ? $oferta->nombre_contacto : '') }}"
                        placeholder="Nombre y apellido"
                    >
                </div>

                <div class="field">
                    <label for="correo_contacto">Email *</label>
                    <input
                        id="correo_contacto"
                        name="correo_contacto"
                        type="email"
                        required
                        value="{{ old('correo_contacto', $editando ? $oferta->correo_contacto : '') }}"
                        placeholder="contacto@empresa.cl"
                    >
                </div>

                <div class="field">
                    <label for="telefono_contacto">Teléfono</label>
                    <input
                        id="telefono_contacto"
                        name="telefono_contacto"
                        type="tel"
                        value="{{ old('telefono_contacto', $editando ? $oferta->telefono_contacto : '') }}"
                        placeholder="+56 9 1234 5678"
                    >
                </div>

            </div>
        </section>


        {{-- =====================================================================
            ACCIONES
        ===================================================================== --}}
        <div class="form-actions mt-3">
            <a href="{{ route('empresas.ofertas.index') }}" class="btn btn-secondary">
                Cancelar
            </a>

            {{-- Solo mostrar "Guardar borrador" cuando se crea --}}
            @unless($editando)
                <button type="submit" name="borrador" value="1" class="btn btn-light">
                    Guardar borrador
                </button>
            @endunless

            <button type="submit" class="btn btn-primary">
                {{ $editando ? 'Guardar cambios' : 'Publicar oferta' }}
            </button>
        </div>

    </form>

</section>
