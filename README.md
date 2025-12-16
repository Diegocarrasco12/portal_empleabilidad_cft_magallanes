🎓 Portal de Empleabilidad — CFT Magallanes

Proyecto web institucional desarrollado para el Centro de Formación Técnica de Magallanes.
El objetivo principal es ofrecer una plataforma integral de empleabilidad para que estudiantes y egresados gestionen su perfil profesional y postulaciones, las empresas publiquen y administren sus vacantes, y el CFT mantenga control y trazabilidad de todo el proceso.

Este repositorio contiene el frontend completo (Blade + CSS) y el backend funcional basado en Laravel 10+, con base de datos relacional, autenticación personalizada y control de roles.

🧠 Objetivos del proyecto

Facilitar la inserción laboral de estudiantes y egresados del CFT.

Centralizar la publicación de ofertas laborales validadas por la institución.

Ofrecer a las empresas un canal formal de reclutamiento y gestión de postulantes.

Permitir al CFT control, validación y trazabilidad de ofertas, postulaciones y recursos.

Proveer una base escalable para futuras funcionalidades institucionales.

👥 Perfiles y alcance funcional

El sistema contempla tres perfiles diferenciados, protegidos por middleware y control de roles:

Rol	ID	Descripción
Admin	1	Acceso total al sistema: gestiona usuarios, empresas, ofertas y recursos.
Empresa	2	Publica y administra ofertas laborales, revisa postulantes.
Postulante	3	Gestiona su perfil profesional, CV y postula a ofertas.
🏗️ Arquitectura general

Framework: Laravel 10+

Lenguaje: PHP 8.2+

Patrón: MVC (Model‑View‑Controller)

Frontend: Blade + CSS puro, sin frameworks de JS

Backend: Controladores, modelos y middleware de Laravel

Base de datos: MySQL o MariaDB

Autenticación: Sistema propio (no se utiliza Breeze); middleware auth.custom y role

Subida de archivos: storage/app/public con enlace simbólico (php artisan storage:link)

Entorno recomendado: WSL 2 (Ubuntu) para desarrollo local

📁 Estructura general del proyecto
portal_empleabilidad_cft_magallanes/
├─ app/
│  ├─ Http/
│  │  ├─ Controllers/      ← Controladores de negocio y de panel de administración
│  │  │  ├─ AuthController.php
│  │  │  ├─ UsuarioController.php
│  │  │  ├─ EmpresaController.php
│  │  │  ├─ OfertaController.php
│  │  │  ├─ PostulacionController.php
│  │  │  ├─ EmpleabilidadController.php (blog de recursos)
│  │  │  ├─ AdminController.php
│  │  │  ├─ AdminEstudianteController.php
│  │  │  ├─ AdminEmpresaController.php
│  │  │  ├─ AdminOfertaApprovalController.php
│  │  │  └─ ...
│  │  └─ Middleware/
│  │     ├─ AuthCustom.php
│  │     └─ RoleMiddleware.php
│  ├─ Models/              ← Modelos Eloquent
│  │  ├─ Usuario.php
│  │  ├─ Empresa.php
│  │  ├─ OfertaTrabajo.php
│  │  ├─ Postulacion.php
│  │  └─ RecursoEmpleabilidad.php
│  └─ ...
├─ database/
│  └─ migrations/
│     ├─ create_usuarios_table.php
│     ├─ create_empresas_table.php
│     ├─ create_ofertas_trabajo_table.php
│     ├─ create_postulaciones_table.php
│     ├─ create_recursos_empleabilidad_table.php
│     └─ alter_usuarios_add_avatar_cv.php
├─ public/
│  ├─ css/                 ← Archivos CSS públicos
│  ├─ img/                 ← Imágenes públicas
│  ├─ js/                  ← JS mínimo para interacciones (opcional)
│  ├─ index.php            ← Front controller de Laravel
│  └─ ...
├─ resources/
│  ├─ views/
│  │  ├─ landing.blade.php
│  │  ├─ users/            ← Vistas para postulantes
│  │  │  ├─ perfil.blade.php
│  │  │  ├─ editar.blade.php
│  │  │  └─ postulaciones.blade.php
│  │  ├─ empresas/        ← Vistas para empresas
│  │  │  ├─ perfil.blade.php
│  │  │  ├─ editar.blade.php
│  │  │  └─ crear_oferta.blade.php
│  │  ├─ jobs/             ← Buscador/listado de ofertas
│  │  │  └─ index.blade.php
│  │  ├─ admin/            ← Panel de administración
│  │  │  └─ dashboard.blade.php
│  │  ├─ auth/             ← Login/registro personalizados
│  │  ├─ layouts/
│  │  │  └─ app.blade.php
│  │  └─ partials/         ← Header, footer y otros parciales
│  └─ ...
├─ routes/
│  ├─ web.php               ← Rutas web (agrupadas por rol)
│  └─ console.php
├─ storage/
│  ├─ app/public/          ← Almacén de archivos subidos (avatars, CV, imágenes)
│  ├─ framework/
│  └─ logs/
├─ .env.example
├─ .gitignore              ← Se ignoran `vendor/`, `node_modules/`, `.env` y `storage` privado
├─ composer.json
├─ package.json
└─ README.md


Nota: la carpeta vendor/ y node_modules/ existen localmente pero no se versionan.

🎨 Frontend (Blade + CSS)
Vistas públicas y privadas

Landing (landing.blade.php): portada del portal con llamada a la acción y navegación principal.

Postulantes

users/perfil.blade.php — Perfil del postulante.

users/editar.blade.php — Formulario completo (identidad, contacto, formación, experiencia, CV, links).

users/postulaciones.blade.php — Listado de postulaciones del usuario.

Empresas

empresas/perfil.blade.php — Dashboard con métricas y CTA "Publicar Nueva Oferta".

empresas/editar.blade.php — Edición de perfil de empresa.

empresas/crear_oferta.blade.php — Formulario para publicar nuevas vacantes.

Ofertas (jobs/index.blade.php): buscador y listado de ofertas de empleo, filtrable y paginado.

Panel de administración (admin/dashboard.blade.php): vista base del panel con acceso a gestión de estudiantes, empresas, ofertas y recursos.

Estilos y buenas prácticas

Estilos organizados en public/css/ (ejemplo: empresa.css, landing.css, app.css).

Componentes reutilizables: .btn, .btn-primary, .btn-publicar, .card, .grid-2, .grid-3.

Diseño responsive mediante Flexbox y CSS Grid.

Paleta y tipografía acorde a la identidad visual del CFT Magallanes.

Vistas ordenadas por dominio (users/, empresas/, jobs/, admin/), reutilizando layouts/ y partials/.

🔧 Backend (Laravel)
Controladores y rutas principales

El backend utiliza controladores dedicados para cada dominio, agrupando lógica y rutas según el rol:

AuthController: gestiona registro, login y cierre de sesión utilizando autenticación personalizada (Auth::attempt, Auth::login, etc.).

UsuarioController: CRUD de postulantes: edición de datos, visualización de postulaciones, subida de avatar y CV.

EmpresaController: CRUD de empresas y gestión de información empresarial.

OfertaController: CRUD completo de ofertas de trabajo. Incluye flujo de aprobación (pendiente → aprobada → rechazada) mediante el Admin.

PostulacionController: gestión de postulaciones de usuarios a ofertas; permite que los postulantes postulen y las empresas revisen postulantes.

EmpleabilidadController: administración de recursos de empleabilidad (blog de artículos y tips). Permite subir imágenes y publicar entradas.

AdminController y sub‑controllers: panel de administración para el rol Admin, gestionando usuarios (estudiantes y empresas), ofertas, postulaciones y recursos.

Las rutas se definen en routes/web.php agrupadas por middleware auth.custom y role:X para asegurar el acceso adecuado a cada sección.

Ejemplo de agrupación de rutas protegidas:

Route::middleware(['auth.custom', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard']);
    Route::resource('/admin/estudiantes', AdminEstudianteController::class);
    Route::resource('/admin/empresas', AdminEmpresaController::class);
    Route::get('/admin/ofertas/pendientes', [AdminOfertaApprovalController::class, 'pendientes']);
    // ...otras rutas de administración
});

Modelos y migraciones

El proyecto utiliza Eloquent ORM con migraciones versionadas que permiten recrear la base de datos automáticamente:

Usuario — información personal, rol, avatar y CV del postulante.

Empresa — datos de la empresa (razón social, descripción, logo, etc.).

OfertaTrabajo — datos de cada vacante: título, descripción, requisitos, estado (pendiente/aprobada/rechazada).

Postulacion — tabla pivote que relaciona usuarios y ofertas; almacena estado de la postulación y notas.

RecursoEmpleabilidad — artículos del blog con título, contenido y ruta de la imagen.

Tras clonar el repositorio es necesario ejecutar las migraciones:

php artisan migrate


Cada nueva funcionalidad incorpora su propia migración, permitiendo a otros desarrolladores actualizar su base de datos con un simple git pull + php artisan migrate.

Autenticación y control de roles

Se implementa una autenticación personalizada para registro y login de usuarios y empresas.

Uso de sesiones de Laravel (Auth::login) en lugar de paquetes como Breeze.

Middleware auth.custom protege las rutas que requieren sesión iniciada.

Middleware role:X verifica que el usuario tenga el rol adecuado (1: admin, 2: empresa, 3: postulante) antes de acceder a cada módulo.

Funcionalidades implementadas
Postulantes (Usuarios)

Registro y login personalizados.

Edición de perfil profesional (datos personales, formación, experiencia, links).

Subida de foto de perfil (avatar) y Curriculum Vitae (PDF).

Consulta del histórico de postulaciones realizadas.

Empresas

Registro y login de empresas.

Perfil empresarial editable (nombre, descripción, rubro, redes, logo).

Publicación y edición de ofertas laborales.

Revisión y gestión de postulantes para cada oferta.

Ofertas laborales

CRUD completo de vacantes.

Flujo de aprobación por parte del Admin antes de su publicación.

Estados definidos: pendiente, aprobada, rechazada y reenviada (solicitud de cambios).

Paginación y búsqueda por palabras clave y filtros.

Postulaciones

Los postulantes pueden postular a cualquier oferta aprobada.

Las empresas visualizan los perfiles de los postulantes y actualizan el estado de cada postulación.

Relación n:m entre usuarios y ofertas.

Recursos de empleabilidad (blog)

CRUD completo desde el panel de administración.

Posibilidad de subir imágenes e incrustarlas en las entradas.

Visualización pública de artículos para ayudar a estudiantes y empresas.

Gestión de archivos

Todos los archivos subidos (avatars, CVs, imágenes) se almacenan en storage/app/public/.

Es obligatorio generar el enlace simbólico con:

php artisan storage:link


Las rutas públicas quedan disponibles en http://localhost:8000/storage/avatars/, storage/cv/, storage/recursos/, etc.

Panel de administración

El rol Admin cuenta con un panel centralizado que le permite:

Gestionar estudiantes (postulantes): revisar y editar sus perfiles.

Gestionar empresas: aprobar registros y modificar datos.

Validar, aprobar o rechazar ofertas laborales y administrar su publicación.

Gestionar postulaciones: revisar postulantes de cada oferta y registrar notas.

Administrar recursos de empleabilidad (blog): publicar, editar y eliminar artículos.

Todo el panel se encuentra protegido por el middleware auth.custom y role:admin.

Base de datos

La configuración de conexión (host, puerto, base de datos, usuario y contraseña) se define en el archivo .env.

Las migraciones automatizan la creación de tablas y campos.

Para actualizar cambios de estructura, sólo es necesario ejecutar php artisan migrate.

🔨 Instalación y puesta en marcha (WSL recomendado)

Abrir WSL (Ubuntu)

wsl


Clonar el repositorio

mkdir -p ~/Proyectos && cd ~/Proyectos
git clone https://github.com/Diegocarrasco12/portal_empleabilidad_cft_magallanes.git
cd portal_empleabilidad_cft_magallanes


Instalar dependencias

composer install
npm install


Configurar variables de entorno

cp .env.example .env
php artisan key:generate
# Editar .env para establecer credenciales de base de datos y correo


Ejecutar migraciones y crear enlace a storage

php artisan migrate
php artisan storage:link


Levantar servidores de desarrollo

# servidor PHP (Laravel)
php artisan serve
# (opcional) Vite en modo desarrollo para recargar assets
npm run dev


Acceder a la aplicación

Abrir http://localhost:8000
 en el navegador para ver el portal.

Nota importante: para evitar problemas de entorno, todos los comandos deben ejecutarse desde WSL (Ubuntu). Verificar versiones de PHP, Composer, Node y npm antes de iniciar.

📋 Requisitos

WSL 2 con Ubuntu (o cualquier entorno Linux compatible).

PHP 8.2 o superior

Composer 2.x

Node 18+ y npm 9+

Git para clonar el repositorio

Servidor de base de datos MySQL/MariaDB para desarrollo y producción

🚀 Despliegue en producción

Para desplegar la aplicación en un servidor Linux se recomienda:

# 1. Obtener el código
git clone https://github.com/Diegocarrasco12/portal_empleabilidad_cft_magallanes.git

# 2. Instalar dependencias sin paquetes de desarrollo
composer install --no-dev
npm ci --production

# 3. Configurar .env con las credenciales de producción
cp .env.example .env
# editar valores de APP_KEY, DB_*, MAIL_*, etc.
php artisan key:generate

# 4. Ejecutar migraciones y enlaces
php artisan migrate --force
php artisan storage:link

# 5. Limpiar cachés
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 6. Servir la aplicación (Apache, Nginx o servidor integrado)


Asegúrese de configurar correctamente los permisos de escritura de las carpetas storage/ y bootstrap/cache/, así como la versión de PHP y base de datos.

📦 Estado del proyecto

✔️ Frontend completo (vistas Blade + CSS)

✔️ Backend funcional (autenticación, modelos, migraciones)

✔️ Control de roles y permisos

✔️ Panel de administración operativo

✔️ CRUDs principales: usuarios, empresas, ofertas, postulaciones y blog

La aplicación se encuentra en fase avanzada y lista para puesta en producción. Puede servir como base para integrar nuevas características.

🔭 Próximas mejoras sugeridas

Integración de notificaciones por correo para postulaciones y aprobaciones.

Jobs programados para recomendación de ofertas y tareas automáticas.

Dashboard de métricas para empresas y administradores.

Logs y auditoría de acciones clave.

Optimización de rendimiento y SEO.

🙌 Contribuciones

Se anima a otros desarrolladores a revisar el código, proponer mejoras y enviar pull requests.
Mantener una estructura clara y seguir las buenas prácticas de Laravel y desarrollo web.

✍️ Autores


Bryan Jara Castillo - Diego Carrasco Ordóñez
Desarrollador Full Stack (JS / PHP / Laravel) — Chile

📝 Licencia

Uso institucional y educativo para el CFT Magallanes.
Prohibida su explotación comercial sin autorización expresa.