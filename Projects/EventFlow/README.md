# EventFlow

EventFlow es una aplicación web para la gestión integrada de eventos, tareas y recordatorios en contextos laborales y personales.

## Características Principales
- **Autenticación:** Registro, login y recuperación de contraseña.
- **Dashboard:** Vista general de eventos y tareas próximas.
- **Gestión de Eventos y Tareas:** Crear, editar y eliminar actividades con detalles y categorías.
- **Notificaciones:** Alertas configurables para fechas y tareas importantes.

## Tecnologías Utilizadas
- **Frontend:** HTML, CSS, JavaScript y React (para componentes interactivos).
- **Backend:** PHP (organizado en módulos).
- **Base de Datos:** MySQL/MariaDB, gestionada mediante phpMyAdmin.
- **Estilizado:** Tailwind CSS.
- **Control de Versiones:** Git y GitHub.

## Estructura del Proyecto
/assets        # Recursos estáticos: CSS, imágenes, etc.
├── /css
├── /img
/backend       # Lógica del servidor (autenticación, eventos, tareas, API, etc.)
├── /api
├── /auth
├── /eventos
├── /tareas
/db            # Script de la base de datos (esquema.sql)
/frontend      # Archivos del cliente (HTML, JavaScript)
/node_modules  # Dependencias de Node.js
FLUJO_APP.md  # Documento con el flujo de la aplicación
README.md     # Este archivo