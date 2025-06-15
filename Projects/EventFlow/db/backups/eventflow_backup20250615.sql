-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2025 a las 21:05:26
-- Versión del servidor: 10.11.10-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u214508706_EventFlow`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `id_categoria_fk` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_evento`, `id_usuario_fk`, `titulo`, `descripcion`, `fecha_inicio`, `fecha_fin`, `ubicacion`, `id_categoria_fk`, `created_at`) VALUES
(2, 4, 'Prueba de Evento 2', 'sadasdasd', '2025-06-03 00:00:00', '2025-06-03 13:00:00', 'Lugar 222', 1, '2025-06-03 09:12:34'),
(3, 4, 'aaaaa', 'sadasdas', '2025-06-04 21:00:00', '2025-06-06 12:00:00', 'bbbbb', 5, '2025-06-03 09:20:53'),
(5, 6, 'afadasqw', 'qwe', '2025-06-25 00:00:00', '2025-06-26 12:00:00', 'Malaga', 4, '2025-06-09 10:36:18'),
(6, 6, 'Eyeh', 'Sysyha', '2025-06-04 00:00:00', '2025-06-13 12:38:00', 'Malaga', 7, '2025-06-09 10:38:48'),
(7, 4, 'Eppe', 'Lauti la cgupa', '2025-06-10 00:00:00', '2025-06-09 12:40:00', 'Fgid', 5, '2025-06-09 10:40:10'),
(8, 4, 'Felkr', 'Rikrj', '2025-06-10 00:00:00', '2025-04-08 12:40:00', 'Djdjdb', 5, '2025-06-09 10:40:27'),
(9, 4, 'Dkwkeb', 'Nddmdndn', '2025-07-09 00:00:00', '2025-07-09 13:42:00', 'Difjfj', 4, '2025-06-09 10:42:43'),
(11, 4, 'Krkrnf', 'Fbfneb', '2025-06-08 00:00:00', '2025-06-05 12:44:00', 'Djfb', 4, '2025-06-09 10:44:24'),
(13, 4, 'Poner la mesa', 'sadasd', '2025-06-12 00:00:00', '2025-06-12 12:00:00', 'Lugar 1', 4, '2025-06-11 12:43:33'),
(14, 1, 'Hshahs', 'Shshwh', '2025-06-01 00:00:00', '2025-06-04 00:00:00', 'Jssjjsj', 1, '2025-06-11 13:50:39'),
(15, 1, '5rc6ec', '7tv7rv', '2025-06-02 00:00:00', '2025-06-12 13:41:00', 'Yhyhh', 7, '2025-06-12 11:41:39'),
(19, 1, 'Hola como te va', 'wasdasa', '2025-06-23 00:00:00', '2025-06-26 12:00:00', 'sdadsa', 2, '2025-06-12 12:08:42'),
(20, 4, 'asddsada', 'sadsads', '2025-06-23 00:00:00', '2025-07-12 00:00:00', 'sadasd', 2, '2025-06-12 13:13:15'),
(21, 7, 'holaaa', 'dsadasd', '2025-06-15 22:00:00', '2025-06-18 00:00:00', 'asdasd', 1, '2025-06-15 16:38:07'),
(22, 8, 'Fechas Mal', 'sadas', '2025-06-18 00:00:00', '2025-06-26 12:00:00', 'dsadsada', 4, '2025-06-15 18:37:27'),
(27, 8, 'asdasd', 'sadsad', '2025-06-16 00:00:00', '2025-06-12 12:00:00', 'saddsa', 1, '2025-06-15 19:30:05'),
(28, 8, 'Hola como te va', 'dfdsfds', '2025-06-19 00:00:00', '2025-06-20 03:00:00', 'adassd', 2, '2025-06-15 19:43:06'),
(29, 8, 'asdasd', 'asdsad', '2025-06-14 22:00:00', '2025-06-19 10:00:00', 'sadsad', 1, '2025-06-15 20:56:59'),
(30, 8, 'Pepito CRack', 'asdasdasd', '2025-06-07 00:00:00', '2025-06-10 16:00:00', 'sadas', 3, '2025-06-15 21:02:05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`),
  ADD KEY `id_categoria_fk` (`id_categoria_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`id_categoria_fk`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
