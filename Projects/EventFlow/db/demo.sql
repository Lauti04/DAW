-- EventFlow: demo database (schema + sample data). Safe to re-run: it resets the demo.
-- Import into an EMPTY database you already created (phpMyAdmin > Import). No CREATE DATABASE / users here.
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `recordatorios`, `tareas`, `eventos`, `categorias`, `usuarios`;
SET FOREIGN_KEY_CHECKS = 1;

-- Tabla de Usuarios
CREATE TABLE `usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Categorías (para diferenciar entre categorías de eventos y tareas)
CREATE TABLE `categorias` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `tipo` ENUM('evento', 'tarea') NOT NULL,
  `color` VARCHAR(7),
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Eventos
CREATE TABLE `eventos` (
  `id_evento` INT NOT NULL AUTO_INCREMENT,
  `id_usuario_fk` INT NOT NULL,
  `titulo` VARCHAR(255) NOT NULL,
  `descripcion` TEXT,
  `fecha_inicio` DATETIME NOT NULL,
  `fecha_fin` DATETIME DEFAULT NULL,
  `ubicacion` VARCHAR(255) DEFAULT NULL,
  `id_categoria_fk` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_evento`),
  FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE,
  FOREIGN KEY (`id_categoria_fk`) REFERENCES `categorias`(`id_categoria`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Tareas
CREATE TABLE `tareas` (
  `id_tarea` INT NOT NULL AUTO_INCREMENT,
  `id_usuario_fk` INT NOT NULL,
  `titulo` VARCHAR(255) NOT NULL,
  `descripcion` TEXT,
  `fecha_vencimiento` DATETIME NOT NULL,
  `estado` ENUM('pendiente', 'completada') DEFAULT 'pendiente',
  `prioridad` ENUM('baja', 'media', 'alta') DEFAULT 'media',
  `id_categoria_fk` INT NOT NULL,
  `id_evento_fk` INT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tarea`),
  FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE,
  FOREIGN KEY (`id_categoria_fk`) REFERENCES `categorias`(`id_categoria`) ON DELETE RESTRICT,
  FOREIGN KEY (`id_evento_fk`) REFERENCES `eventos`(`id_evento`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `recordatorios` (
  `id_recordatorio` INT NOT NULL AUTO_INCREMENT,
  `id_usuario_fk` INT NOT NULL,
  `mensaje` VARCHAR(255) NOT NULL,
  `fecha_hora` DATETIME NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_recordatorio`),
  FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Demo account:  demo@eventflow.demo  /  demo1234
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `password`) VALUES
  (1, 'Demo', 'demo@eventflow.demo', '$2y$10$KmisY3ZH8LQytLU3C5D.t.R6urHG7dyGjjg7rzhlmgrdiHk6FVlMm');

INSERT INTO `categorias` (`id_categoria`, `nombre`, `tipo`, `color`) VALUES
  (1, 'Trabajo',  'evento', '#4f46e5'),
  (2, 'Personal', 'evento', '#10b981'),
  (3, 'Estudios', 'evento', '#f59e0b'),
  (4, 'Salud',    'evento', '#ef4444'),
  (5, 'Social',   'evento', '#ec4899'),
  (6, 'Trabajo',  'tarea',  '#4f46e5'),
  (7, 'Personal', 'tarea',  '#10b981'),
  (8, 'Estudios', 'tarea',  '#f59e0b'),
  (9, 'Hogar',    'tarea',  '#06b6d4');

-- Sample events, dated relative to the import day so the calendar is never empty.
INSERT INTO `eventos` (`id_evento`, `id_usuario_fk`, `titulo`, `descripcion`, `fecha_inicio`, `fecha_fin`, `ubicacion`, `id_categoria_fk`) VALUES
  (1, 1, 'Reunión de equipo',        'Revisión semanal de objetivos y bloqueos.',        TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 1 DAY),  '10:00:00'), TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 1 DAY),  '11:00:00'), 'Sala Málaga',            1),
  (2, 1, 'Entrega del proyecto',     'Última revisión y entrega al cliente.',            TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 3 DAY),  '09:00:00'), TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 3 DAY),  '14:00:00'), 'Oficina',                1),
  (3, 1, 'Clase de inglés',          'Preparación del examen de speaking.',              TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 2 DAY),  '18:00:00'), TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 2 DAY),  '19:30:00'), 'Online',                 3),
  (4, 1, 'Revisión médica',          'Chequeo anual.',                                   TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 5 DAY),  '08:30:00'), TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 5 DAY),  '09:30:00'), 'Centro de salud',        4),
  (5, 1, 'Cena con amigos',          'Reserva a las 21:00 en el puerto.',                TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 6 DAY),  '21:00:00'), TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 6 DAY),  '23:30:00'), 'Puerto Marina',          5),
  (6, 1, 'Entrenamiento',            'Sesión de fuerza y movilidad.',                    TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 4 DAY),  '19:00:00'), TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 4 DAY),  '20:00:00'), 'Gimnasio',               2),
  (7, 1, 'Demo con el cliente',      'Presentación de la nueva versión.',                TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 8 DAY),  '12:00:00'), TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 8 DAY),  '13:00:00'), 'Videollamada',           1),
  (8, 1, 'Escapada de fin de semana','Ronda y senderismo.',                              TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 10 DAY), '09:00:00'), TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 11 DAY), '20:00:00'), 'Serranía de Ronda',      2);

INSERT INTO `tareas` (`id_tarea`, `id_usuario_fk`, `titulo`, `descripcion`, `fecha_vencimiento`, `estado`, `prioridad`, `id_categoria_fk`, `id_evento_fk`) VALUES
  (1, 1, 'Preparar la presentación',   'Diapositivas y guion para la demo.',      TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '17:00:00'), 'pendiente',  'alta',  6, 7),
  (2, 1, 'Enviar informe semanal',      'Resumen de avances al equipo.',           TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 1 DAY), '09:00:00'), 'pendiente',  'media', 6, 1),
  (3, 1, 'Repasar vocabulario',         '50 palabras nuevas.',                     TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '12:00:00'), 'pendiente',  'baja',  8, 3),
  (4, 1, 'Comprar material de oficina', 'Cuadernos y rotuladores.',                TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 3 DAY), '18:00:00'), 'completada', 'baja',  7, NULL),
  (5, 1, 'Limpiar el escritorio',       'Ordenar cables y archivos.',              TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 4 DAY), '20:00:00'), 'pendiente',  'media', 9, NULL),
  (6, 1, 'Reservar restaurante',        'Mesa para 6 personas.',                   TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 5 DAY), '11:00:00'), 'completada', 'alta',  7, 5);

INSERT INTO `recordatorios` (`id_recordatorio`, `id_usuario_fk`, `mensaje`, `fecha_hora`) VALUES
  (1, 1, 'Llevar el portátil a la reunión', TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 1 DAY), '09:30:00')),
  (2, 1, 'Pagar la factura de internet',    TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '10:00:00')),
  (3, 1, 'Llamar al dentista',              TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 3 DAY), '16:00:00'));
