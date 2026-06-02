<div align="center">
  <h1>🎓 Plataforma de Aprendizaje Institucional</h1>
  <p><strong>Instituto Tecnológico de Ciudad Victoria — TecNM</strong></p>
  <p><em>Sistema centralizado para la gestión académica, automatización de inscripciones y control de oferta formativa continua.</em></p>
</div>

---

## 📌 1. Introducción y Contexto
El Instituto Tecnológico de Ciudad Victoria requiere una infraestructura digital sólida para administrar de manera eficiente sus cursos, talleres, conferencias y webinars. Esta plataforma ha sido diseñada bajo el ecosistema de **Laravel 12** para resolver la fragmentación operativa actual, centralizando el proceso desde que un maestro oferta un curso hasta que el alumno es aprobado o asignado a una lista de espera automatizada.

## 🎯 2. Objetivos del Sistema

### 🔹 Objetivo General
Proveer al plantel de un sistema web integral y automatizado que optimice la configuración de la oferta educativa, la asignación de cupos y el seguimiento de los alumnos, garantizando seguridad y escalabilidad técnica.

### 🔹 Objetivos Específicos
- **Control de Acceso Riguroso:** Implementar un middleware robusto que separe jerárquicamente las vistas y acciones (Admin, Maestro, Alumno).
- **Automatización de Cupos:** Desplegar una lógica de negocio capaz de detectar cursos llenos y gestionar listas de espera en tiempo real.
- **Filtros Académicos:** Mostrar a los alumnos únicamente la oferta educativa pertinente a su propia carrera institucional.
- **Seguimiento y Trazabilidad:** Mantener un historial inmutable del ciclo de vida de cada solicitud (Pendiente, Aprobada, Rechazada, Baja).

## 🚀 3. Alcance del Proyecto

### ✅ Lo que incluye la Plataforma:
- **Gestión de Identidades:** CRUD completo de usuarios institucionales con atributos como número de control y carrera.
- **Catálogo de Cursos:** Administración de fechas, modalidades, instructores y cupos máximos.
- **Motor de Inscripciones:** Lógica de validación de cupo y asignación de prioridades.
- **Dashboards Dinámicos:** Paneles estadísticos específicos según el rol del usuario autenticado.
- **Identidad Gráfica Institucional:** Integración de componentes visuales (Bootstrap 5) adaptados a la imagen del TecNM.

### ❌ Fuera del Alcance Actual:
- Pasarelas de pagos o transacciones económicas.
- Aulas virtuales, foros, o repositorio de materiales tipo LMS.
- Videoconferencias nativas dentro del sistema.
- Generación automatizada de certificados PDF.

## ⚙️ 4. Requerimientos del Sistema (SRS)

### 📋 Requerimientos Funcionales (RF)
- **RF-01 (Usuarios y Roles):** El Administrador puede gestionar el padrón total de usuarios y sus privilegios.
- **RF-02 (Creación de Oferta):** El sistema permite crear cursos con restricciones estrictas de cupo y carrera.
- **RF-03 (Flujo de Inscripción):** El alumno puede solicitar ingreso justificando sus motivos y experiencia técnica.
- **RF-04 (Gestión Docente):** Los maestros tienen autoridad exclusiva sobre la aprobación o rechazo de solicitudes en sus propias materias.
- **RF-05 (Reasignación de Cupo):** Al liberar un lugar, el sistema recorre la Lista de Espera automáticamente.

### 🛡️ Requerimientos No Funcionales (RNF)
- **Seguridad (RNF-01):** Protección de rutas con middlewares y encriptación de credenciales vía Bcrypt (estándar de Laravel). Vulnerabilidades CSRF cubiertas nativamente.
- **Rendimiento (RNF-02):** Consultas SQL optimizadas a través de Eloquent ORM y carga ansiosa (*Eager Loading*) para evitar cuellos de botella (Problema N+1).
- **Usabilidad (RNF-03):** Interfaz totalmente adaptativa (Responsive Web Design) para dispositivos móviles y de escritorio.

## 💻 5. Stack Tecnológico y Arquitectura
El sistema respeta rigurosamente el patrón de diseño **Modelo-Vista-Controlador (MVC)**, asegurando un código limpio, mantenible y testeable.

| Capa | Tecnología | Justificación |
|---|---|---|
| **Backend** | `PHP 8.2+` & `Laravel 12` | Framework líder en seguridad, enrutamiento rápido e inyección de dependencias. |
| **Base de Datos** | `MySQL` (o SQLite para Dev) | Manejo relacional íntegro indispensable para la gestión de inscripciones (tablas pivote N:M). |
| **Frontend** | `Blade` & `Bootstrap 5` | Motor de plantillas robusto acoplado con el framework de CSS para interfaces ágiles. |
| **Auth** | `Laravel Breeze` | Scaffolding de autenticación moderno y libre de brechas de seguridad comunes. |

## 👥 6. Flujo de Trabajo por Rol

1. **Administrador:** Es el orquestador principal. Prepara las carreras y los cursos, asegurándose de asignar un Maestro a cada uno.
2. **Alumno:** Entra a su panel, observa los cursos dictados *para su carrera*, y aplica a uno. Dependiendo del llenado del curso, su estado inicial será `Aprobado`, `Pendiente` o `Lista Espera`.
3. **Maestro:** Accede para revisar las postulaciones de estado `Pendiente`. Decide admitir o denegar el acceso al alumno. Puede expulsar (`Dar de baja`) a un alumno activo.

---

## 🛠️ 7. Guía de Instalación y Despliegue

La plataforma está diseñada para ser fácilmente montada en cualquier servidor local como XAMPP o Laragon.

**Paso 1:** Ubicar la terminal en tu entorno de servidor local (`C:\xampp\htdocs`).
**Paso 2:** Clonar o descargar este proyecto en dicha ruta.
**Paso 3:** Instalar dependencias del núcleo PHP ejecutando:
```bash
composer install
```
**Paso 4:** Compilar la paquetería de Frontend (Vite) para inyectar CSS y JS:
```bash
npm install
npm run build
```
**Paso 5:** Copiar las credenciales de entorno:
```bash
copy .env.example .env
```
**Paso 6:** Sellar el proyecto con su llave criptográfica:
```bash
php artisan key:generate
```
**Paso 7:** Enlazar el sistema de almacenamiento de imágenes públicas:
```bash
php artisan storage:link
```
**Paso 8:** Levantar base de datos: Crear una DB llamada `plataforma_aprendizaje` y reflejar los datos en tu `.env`.
**Paso 9:** Migrar la estructura de la base de datos:
```bash
php artisan migrate
```
**Paso 10:** Poblar la base de datos con usuarios de prueba:
```bash
php artisan db:seed
```
**Paso 11:** Levantar el servidor interno de Laravel:
```bash
php artisan serve
```

## 👤 8. Usuarios de Prueba
El comando del **Paso 10** crea automáticamente tres perfiles preconfigurados para que la maestra pueda evaluar todas las funciones y roles de la plataforma de inmediato:

| Rol | Correo Electrónico | Contraseña |
|---|---|---|
| **Administrador** | `admin@itcv.edu.mx` | `password123` |
| **Maestro** | `maestro@itcv.edu.mx` | `password123` |
| **Alumno** | `alumno@itcv.edu.mx` | `password123` |
