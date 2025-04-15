-- Tabla de Usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Categorías (para diferenciar entre categorías de eventos y tareas)
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `tipo` ENUM('evento', 'tarea') NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Eventos
CREATE TABLE IF NOT EXISTS `eventos` (
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
CREATE TABLE IF NOT EXISTS `tareas` (
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