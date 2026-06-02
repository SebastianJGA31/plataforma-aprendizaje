# Plataforma de Aprendizaje y Gestión de Cursos

Sistema web universitario desarrollado con **Laravel 12**, **Bootstrap 5**, **MySQL** y **Breeze**.

Gestiona tres roles: **Administrador**, **Maestro** y **Alumno**, con cursos, carreras, inscripciones y control de cupos.

---

## Requisitos

- PHP 8.2+
- Composer
- MySQL / MariaDB
- Node.js y npm (para assets con Vite)
- Extensiones PHP: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`

---

## Instalación

```bash
# 1. Clonar o copiar el proyecto
cd plataforma-aprendizaje

# 2. Dependencias
composer install
npm install

# 3. Entorno
copy .env.example .env   # Windows
# cp .env.example .env   # Linux/Mac
php artisan key:generate

# 4. Configurar .env — base de datos
# DB_DATABASE=plataforma_aprendizaje
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Migraciones y datos demo
php artisan migrate --seed

# 6. Enlace para imágenes de cursos
php artisan storage:link

# 7. Compilar assets (opcional en desarrollo)
npm run build

# 8. Servidor
php artisan serve
```

Abrir: **http://127.0.0.1:8000**

---

## Usuarios de prueba

| Rol | Correo | Contraseña |
|-----|--------|------------|
| Administrador | admin@plataforma.com | admin123 |
| Maestro | maestro1@plataforma.com | maestro123 |
| Maestro | maestro2@plataforma.com | maestro123 |
| Alumno | alumno1@plataforma.com | alumno123 |
| Alumno | alumno2@plataforma.com | alumno123 |
| Alumno | alumno3@plataforma.com | alumno123 |

También puedes registrar nuevos alumnos desde `/register`.

---

## Guion de demostración (5 minutos)

1. Abrir la página de inicio (`/`) — presentar la plataforma.
2. Iniciar sesión como **Administrador** → dashboard, usuarios, carreras, cursos, inscripciones.
3. Cerrar sesión → entrar como **Alumno** (`alumno1`) → ver cursos, cupos disponibles, inscribirse.
4. Entrar como **Maestro** (`maestro1`) → Mis Cursos → aprobar/rechazar inscripciones pendientes.
5. Mostrar lista de espera y promoción automática al dar de baja un alumno aprobado.

---

## Estructura principal

```
app/Http/Controllers/
├── Admin/          Dashboard, Inscripciones
├── Maestro/        Dashboard, Cursos, Inscripciones
├── Alumno/         Dashboard, Cursos, Inscripciones
├── CursoController.php
├── UserController.php
└── CarreraController.php

app/Models/
├── User, Role, Carrera, Curso, Inscripcion
```

---

## Funcionalidades

- Autenticación y registro de alumnos con carrera
- Middleware por rol con redirección automática
- CRUD de usuarios, cursos y carreras (admin)
- Cursos filtrados por carrera del alumno
- Inscripciones con estados: Pendiente, Aprobado, Rechazado, Lista Espera, Baja
- Control de cupo y promoción desde lista de espera
- Paginación y filtros en listados principales

---

## Comandos útiles

```bash
php artisan migrate:fresh --seed   # Reiniciar BD con datos demo
php artisan test                   # Ejecutar pruebas
php artisan route:list             # Ver rutas
```

---

## Autor

Proyecto académico — Plataforma de Aprendizaje ITCV.
