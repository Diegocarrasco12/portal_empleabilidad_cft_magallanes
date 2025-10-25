# 🎓 Portal de Empleabilidad — CFT Magallanes

Proyecto web institucional desarrollado para el **Centro de Formación Técnica de Magallanes**, con el objetivo de ofrecer un **portal de empleabilidad** donde estudiantes, egresados y empresas puedan interactuar en torno a ofertas laborales, postulaciones y perfiles profesionales.

Este repositorio contiene la **fase 1: Frontend completo del portal**, desarrollado con **Laravel**, **Blade** y **CSS puro**, estructurado para una integración posterior con el backend y base de datos.

---

## 📁 Estructura general del proyecto

```text
cft-empleabilidad/
├─ app/
├─ bootstrap/
├─ config/
├─ database/
├─ public/
│  ├─ css/
│  ├─ img/
│  ├─ js/
│  ├─ .htaccess
│  ├─ favicon.ico
│  ├─ index.php
│  └─ robots.txt
├─ resources/
│  ├─ css/
│  ├─ js/
│  └─ views/
│     ├─ admin/
│     │  └─ dashboard.blade.php
│     ├─ auth/
│     │  ├─ login.blade.php
│     │  └─ register.blade.php
│     ├─ empresas/
│     │  ├─ crear_oferta.blade.php
│     │  ├─ editar.blade.php
│     │  └─ perfil.blade.php
│     ├─ jobs/
│     │  └─ index.blade.php
│     ├─ layouts/
│     │  └─ app.blade.php
│     ├─ partials/
│     │  ├─ footer.blade.php
│     │  └─ header.blade.php
│     ├─ users/
│     │  ├─ editar.blade.php
│     │  ├─ perfil.blade.php
│     │  └─ postulaciones.blade.php
│     └─ landing.blade.php
├─ routes/
│  ├─ console.php
│  └─ web.php
├─ storage/
│  ├─ app/
│  ├─ framework/
│  └─ logs/
├─ tests/
│  ├─ Feature/
│  └─ Unit/
│     └─ TestCase.php
├─ .env.example
├─ .gitignore
├─ artisan
├─ composer.json
├─ composer.lock
├─ package.json
├─ vite.config.js
└─ README.md


Nota: La carpeta vendor/ existe localmente pero no se versiona (está ignorada por .gitignore).

🧩 Vistas implementadas
Landing

resources/views/landing.blade.php – Portada con CTA y navegación.

Usuarios (Postulantes)

users/perfil.blade.php – Perfil del postulante.

users/editar.blade.php – Formulario completo (identidad, contacto, formación, experiencia, CV, links).

users/postulaciones.blade.php – Listado de postulaciones (mock).

Empresas

empresas/perfil.blade.php – Dashboard (métricas, CTA “Publicar Nueva Oferta”).

empresas/editar.blade.php – Edición de perfil de empresa.

empresas/crear_oferta.blade.php – Formulario para nuevas vacantes.

Jobs

jobs/index.blade.php – Buscador/listado de ofertas (mock).

Admin

admin/dashboard.blade.php – Vista base del panel (maquetada).

Layouts & Partials

layouts/app.blade.php – Layout general.

partials/header.blade.php, partials/footer.blade.php – Encabezado y pie del sitio.

🧱 Rutas base (mock)

Las rutas de navegación para esta fase están definidas en routes/web.php e incluyen:

/ → landing.blade.php

/empleos → jobs/index.blade.php

/usuarios/perfil, /usuarios/editar

/empresas/perfil, /empresas/editar, /empresas/crear

/admin (dashboard mock)

/login, /registrarse (auth mock)

En esta entrega no hay lógica de autenticación real ni conexión a BD—solo frontend navegable.

⚠️ Importante — usar WSL (Ubuntu)

Para evitar problemas de entorno, todos los comandos deben correr en WSL:
# 1) Abrir WSL (Ubuntu)
wsl

# 2) Ir a la carpeta donde trabajas (ejemplo: Proyectos)
mkdir -p ~/Proyectos && cd ~/Proyectos

# 3) Clonar el repo (crea la carpeta 'portal_empleabilidad_cft_magallanes')
git clone https://github.com/Diegocarrasco12/portal_empleabilidad_cft_magallanes.git

# 4) Entrar a la carpeta del proyecto
cd portal_empleabilidad_cft_magallanes

# 5) (opcional) Abrir en VS Code
code .

 Verificar herramientas:
php -v
composer -V
node -v
npm -v

🔧 Requisitos

WSL 2 con Ubuntu
PHP 8.2+
Composer 2.x
Node 18+ / npm 9+
Git

🚀 Instalación y visualización (WSL)

1 - Clonar el repositorio
wsl
cd ~
git clone https://github.com/Diegocarrasco12/portal_empleabilidad_cft_magallanes.git
cd portal_empleabilidad_cft_magallanes

2- Instalar dependencias
composer install
npm install

3 - Configurar variables de entorno
cp .env.example .env
php artisan key:generate

4 - Levantar el servidor de desarrollo
php artisan serve

Abrir: http://localhost:8000

5 - (Opcional) Vite en modo desarrollo
npm run dev

Base de datos: no requerida en esta fase (frontend puro).

🎨 Estilos

Estilos declarados principalmente en public/css/ (p. ej. empresa.css, landing.css, app.css).

Componentes reutilizables: .btn, .btn-primary, .btn-publicar, .card, .grid-2, .grid-3.

Diseño responsive con Flexbox y CSS Grid.

Paleta acorde a la identidad del CFT Magallanes.

✅ Buenas prácticas aplicadas

Estructura Laravel estándar y ordenada.

Vistas por dominio (users/, empresas/, jobs/, admin/).

partials/ y layouts/ para reutilización.

.gitignore de Laravel (no se versiona vendor/, node_modules/, .env).

Preparado para integrar backend (controladores, modelos y DB en la próxima fase).



🔭 Próxima etapa (backend)

Autenticación (Breeze/Fortify)

Modelos/Migraciones: Company, Job, JobApplication

CRUD real + políticas/roles (postulante/empresa/admin)

Subida de archivos (logos, CVs) — storage:link

Filtros y paginación del buscador de empleos


✍️ Autor

Diego Carrasco Ordóñez
Desarrollador Full Stack (JS / PHP / Laravel) — Chile
📧 diegocarrasco.dev@gmail.com

📝 Licencia

Uso institucional/educativo; no comercial sin autorización.