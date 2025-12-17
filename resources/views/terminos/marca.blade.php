@extends('layouts.app')

@section('content')
<main class="container legal-page">

    <header class="legal-header">
        <h1>Términos de Difusión y Uso de Imagen de Marca</h1>
        <p class="muted">
            Plataforma CFT Magallanes Empleabilidad
        </p>
    </header>

    <section>
        <p>
            El presente documento regula la autorización otorgada por las empresas
            registradas en la plataforma <strong>CFT Magallanes Empleabilidad</strong>
            para el uso limitado de su imagen de marca.
        </p>

        <p>
            Al aceptar expresamente la opción de <strong>Difusión de Imagen de Marca</strong>
            durante el proceso de registro, la empresa declara haber leído y aceptado
            los presentes términos.
        </p>
    </section>

    <section>
        <h2>1. Alcance de la autorización</h2>
        <p>
            La empresa autoriza a CFT Magallanes a utilizar su logotipo,
            nombre comercial y elementos básicos de identidad visual
            exclusivamente dentro de la plataforma CFT Magallanes Empleabilidad.
        </p>
    </section>

    <section>
        <h2>2. Finalidad del uso</h2>
        <p>
            La utilización de la imagen de marca tendrá únicamente fines:
        </p>

        <ul>
            <li>Informativos</li>
            <li>Académicos</li>
            <li>Institucionales</li>
            <li>De vinculación laboral</li>
        </ul>

        <p>
            Lo anterior incluye, entre otros, la visualización del logotipo
            en ofertas laborales publicadas dentro de la plataforma.
        </p>
    </section>

    <section>
        <h2>3. Uso no comercial</h2>
        <p>
            La autorización otorgada no contempla el uso comercial,
            publicitario externo ni promocional de la imagen de marca.
        </p>

        <p>
            En ningún caso la imagen de marca será utilizada con fines
            lucrativos ni cedida a terceros ajenos a la plataforma.
        </p>
    </section>

    <section>
        <h2>4. Propiedad intelectual</h2>
        <p>
            La empresa conserva en todo momento la titularidad y derechos
            de propiedad intelectual sobre su marca, logotipo e identidad visual.
        </p>

        <p>
            La presente autorización no constituye cesión de derechos,
            sino un permiso de uso limitado y revocable.
        </p>
    </section>

    <section>
        <h2>5. Vigencia</h2>
        <p>
            La autorización tendrá vigencia mientras la empresa mantenga
            una cuenta activa en la plataforma CFT Magallanes Empleabilidad.
        </p>
    </section>

    <section>
        <h2>6. Revocación de la autorización</h2>
        <p>
            La empresa podrá revocar esta autorización en cualquier momento,
            solicitándolo a través de los canales oficiales de contacto
            de CFT Magallanes.
        </p>

        <p>
            Una vez recibida la solicitud, CFT Magallanes procederá a
            eliminar la imagen de marca de la plataforma en un plazo razonable.
        </p>
    </section>

    <section>
        <h2>7. Legislación aplicable</h2>
        <p>
            Estos términos se rigen por la legislación vigente de la
            República de Chile, especialmente por las normas relativas
            a propiedad intelectual y uso de marcas comerciales.
        </p>
    </section>

    <footer class="legal-footer">
        <p class="muted">
            Última actualización: {{ date('d/m/Y') }}
        </p>
    </footer>

</main>
@endsection
@push('styles')
<style>
.legal-page {
    max-width: 900px;
    margin: 2.5rem auto 4rem;
    background: #ffffff;
    padding: 2.5rem 3rem;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,.06);
}

.legal-header {
    margin-bottom: 2rem;
}

.legal-page h1 {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: .25rem;
}

.legal-page h2 {
    font-size: 1.25rem;
    margin-top: 2rem;
    margin-bottom: .5rem;
    font-weight: 700;
    color: #111827;
}

.legal-page p,
.legal-page li {
    font-size: 1rem;
    line-height: 1.7;
    color: #374151;
}

.legal-page ul {
    margin-left: 1.2rem;
    list-style: disc;
}

.legal-footer {
    margin-top: 3rem;
    border-top: 1px solid #e5e7eb;
    padding-top: 1rem;
}

.muted {
    color: #6b7280;
    font-size: .9rem;
}
</style>
@endpush
