# Flujo Básico de la Aplicación - EventFlow

## 1. Autenticación
- **Registro:** El usuario se registra proporcionando sus datos (nombre, email, contraseña).
- **Login:** El usuario ingresa sus credenciales para iniciar sesión.
- **Recuperación de contraseña (opcional):** Funcionalidad para restablecer la contraseña en caso de olvido.

## 2. Dashboard
- **Vista general:** Al iniciar sesión, el usuario es dirigido al dashboard, que muestra un resumen de eventos y tareas próximas.
- **Acceso:** Desde el dashboard se accede a las secciones de eventos, tareas y notificaciones.
- **Alertas:** Notificaciones emergentes o integradas para recordar eventos o fechas límite.

## 3. Gestión de Eventos y Tareas
- **Eventos:**
  - Permite crear, editar y eliminar eventos.
  - Los eventos incluyen detalles como título, fecha, descripción y categoría.
- **Tareas:**
  - Permite gestionar tareas: creación, edición, asignación de prioridades y cambio de estado (pendiente, en progreso, completada).
  - Las tareas pueden vincularse a eventos para tener un control integrado de las actividades.

## 4. Notificaciones
- **Recordatorios:** Sistema que envía alertas (dentro de la aplicación y/o por correo electrónico) sobre eventos y tareas próximas.
- **Configurables:** El usuario puede configurar la frecuencia y el tipo de notificaciones según sus necesidades.

## 5. Cierre de sesión (Logout)
- Funcionalidad para que el usuario cierre la sesión y retorne a la pantalla de login de forma segura.