<!--
  Pie de página del sitio.  Presenta logotipos, un resumen de la misión de
  empleabilidad, enlaces de navegación y datos de contacto.  El diseño sigue
  el prototipo para escritorio y móvil con un fondo oscuro y tipografía clara.
-->
<footer class="site-footer">
    <div class="footer-container">

        <!-- Col 1: Logos + descripción -->
        <div class="footer-col footer-brand">
            <div class="footer-logo-group">
                <img src="{{ asset('img/iconos/logo.png') }}" alt="CFT Magallanes" />
            </div>

            <p class="footer-heading">CFT MAGALLANES EMPLEABILIDAD</p>
            <p class="footer-desc">
                Conectamos talento técnico con las empresas que impulsan el desarrollo de la región.
                Tu futuro profesional comienza aquí.
            </p>
        </div>

        <!-- Col 2: Enlaces -->
        <div class="footer-col">
            <h4>Enlaces</h4>
            <ul>
                <li><a href="{{ route('home') }}">Inicio</a></li>
                <li><a href="{{ route('empleos.index') }}">Buscar empleo</a></li>
                <li><a href="https://cftdemagallanes.cl/">Sitio Oficial CFT Magallanes</a></li>
                <li><a href="https://cftdemagallanes.cl/contacto/">Contacto</a></li>
            </ul>
        </div>

        <!-- Col 3: Recursos -->
        <div class="footer-col">
            <h4>Recursos</h4>
            <ul>
                <li><a href="https://www.mineduc.cl/">Ministerio de Educación</a></li>
                <li><a href="https://portal.beneficiosestudiantiles.cl/">Beneficios Estudiantiles</a></li>
                <li><a href="https://buscatubeneficio.junaeb.cl/">Busca Tu Beneficio Junaeb</a></li>
                <li><a
                        href="https://www.portaltransparencia.cl/PortalPdT/directorio-de-organismos-regulados/?org=CF010">Ley
                        de Transparencia</a></li>
            </ul>
        </div>

        <!-- Col 4: Contacto (columna separada) -->
        <div class="footer-col footer-contact">
            <h4>Contacto</h4>
            <ul class="contact-list">
                <li><span class="contact-icon">📍</span> Francisco Sampaio 580, Porvenir, Tierra del fuego</li>
                <li><span class="contact-icon">📞</span> +56 9 4138 2777</li>
                <li><span class="contact-icon">✉️</span> admision@cftdemagallanes.cl</li>
                <li><span class="contact-icon">🌐</span> www.cftmagallanes.cl</li>
            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        © 2025 CFT Magallanes — Todos los derechos reservados.
    </div>
</footer>
