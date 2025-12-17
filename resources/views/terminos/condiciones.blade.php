@extends('layouts.app')

@section('content')
<main class="container legal-page">

    <header class="legal-header">
        <h1>Términos y Condiciones de Uso</h1>
        <p class="muted">
            Plataforma CFT Magallanes Empleabilidad
        </p>
    </header>

    <section>
        <p>
            El presente documento regula el acceso y uso de la plataforma
            <strong>CFT Magallanes Empleabilidad</strong>, administrada por el
            Centro de Formación Técnica de Magallanes, en adelante “CFT Magallanes”.
        </p>

        <p>
            Al registrarse o utilizar esta plataforma, el usuario declara haber leído,
            comprendido y aceptado íntegramente los presentes Términos y Condiciones.
        </p>
    </section>

    <section>
        <h2>1. Objeto de la plataforma</h2>
        <p>
            La plataforma CFT Magallanes Empleabilidad tiene como finalidad
            facilitar la vinculación laboral entre estudiantes, egresados,
            titulados y empresas, promoviendo oportunidades de empleo,
            prácticas profesionales y pasantías, sin fines comerciales.
        </p>
    </section>

    <section>
        <h2>2. Usuarios</h2>
        <p>
            Podrán registrarse como usuarios:
        </p>
        <ul>
            <li>Estudiantes y titulados del CFT Magallanes.</li>
            <li>Empresas e instituciones que deseen publicar ofertas laborales.</li>
        </ul>

        <p>
            El usuario se compromete a proporcionar información veraz,
            actualizada y completa durante su registro y uso de la plataforma.
        </p>
    </section>

    <section>
        <h2>3. Responsabilidad del usuario</h2>
        <p>
            El usuario es responsable del uso que realice de la plataforma,
            comprometiéndose a no utilizarla para fines ilícitos, fraudulentos
            o contrarios a la legislación vigente.
        </p>
    </section>

    <section>
        <h2>4. Publicación de ofertas laborales</h2>
        <p>
            Las empresas son las únicas responsables del contenido,
            veracidad y condiciones de las ofertas publicadas.
        </p>

        <p>
            CFT Magallanes actúa únicamente como intermediario
            y no participa en los procesos de selección, contratación
            ni relaciones laborales derivadas.
        </p>
    </section>

    <section>
        <h2>5. Protección de datos personales</h2>
        <p>
            El tratamiento de los datos personales se realizará conforme
            a lo dispuesto en la <strong>Ley N° 19.628 sobre Protección de la Vida Privada</strong>.
        </p>

        <p>
            Los datos serán utilizados exclusivamente para fines académicos,
            laborales e institucionales, y no serán cedidos a terceros
            sin autorización del titular, salvo obligación legal.
        </p>
    </section>

    <section>
        <h2>6. Propiedad intelectual</h2>
        <p>
            Todos los contenidos de la plataforma, incluyendo textos,
            logotipos, diseños y código, son propiedad de CFT Magallanes
            o de sus respectivos titulares, y están protegidos por la
            legislación chilena vigente.
        </p>
    </section>

    <section>
        <h2>7. Modificaciones</h2>
        <p>
            CFT Magallanes se reserva el derecho de modificar estos
            Términos y Condiciones en cualquier momento.
        </p>

        <p>
            Las modificaciones serán publicadas en la plataforma
            y entrarán en vigencia desde su publicación.
        </p>
    </section>

    <section>
        <h2>8. Legislación aplicable</h2>
        <p>
            Los presentes Términos y Condiciones se rigen por las leyes
            de la República de Chile. Cualquier controversia será
            sometida a los tribunales competentes del territorio chileno.
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
