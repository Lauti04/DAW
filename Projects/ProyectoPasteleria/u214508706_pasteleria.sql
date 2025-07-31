-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-03-2025 a las 23:16:27
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
-- Base de datos: `u214508706_pasteleria`
--
CREATE DATABASE IF NOT EXISTS `u214508706_pasteleria` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `u214508706_pasteleria`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fabricacion`
--

DROP TABLE IF EXISTS `fabricacion`;
CREATE TABLE `fabricacion` (
  `id_fabricacion` int(11) NOT NULL,
  `id_receta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `caducidad` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `fabricacion`
--

INSERT INTO `fabricacion` (`id_fabricacion`, `id_receta`, `fecha`, `caducidad`) VALUES
(2, 2, '2023-09-16', '2023-09-23'),
(3, 3, '2023-09-17', '2023-09-24'),
(4, 4, '2023-10-01', '2023-10-08'),
(5, 7, '2023-10-02', '2023-10-09'),
(6, 10, '2023-10-03', '2023-10-10'),
(7, 12, '2023-10-04', '2023-10-11'),
(8, 13, '2023-10-05', '2023-10-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

DROP TABLE IF EXISTS `recetas`;
CREATE TABLE `recetas` (
  `id_receta` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `ingredientes` text NOT NULL,
  `como_se_hace` text NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `dificultad` tinyint(1) NOT NULL CHECK (`dificultad` between 1 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id_receta`, `titulo`, `ingredientes`, `como_se_hace`, `imagen`, `dificultad`) VALUES
(2, 'Cupcakes de Vainilla', 'Harina, azúcar, huevos, leche, esencia de vainilla', 'Preparar la masa, verter en moldes, hornear durante 20 minutos y decorar a gusto.', '../assets/images/productos/2.webp', 2),
(3, 'Brownie de Chocolate', 'Chocolate, harina, azúcar, mantequilla, huevos', 'Derretir el chocolate, mezclar con los ingredientes, hornear a 175°C durante 30 minutos y cortar en cuadrados.', '../assets/images/productos/3.webp', 4),
(4, 'Torta de Chocolate', 'harina, huevos, chocolate, azúcar, mantequilla', 'Mezclar ingredientes secos y húmedos por separado. Combinar y hornear a 180°C por 35 minutos. Decorar con virutas de chocolate.', '../assets/images/productos/torta-de-chocolate.webp', 3),
(5, 'Cheesecake Oreo', 'queso crema, galletas oreo, crema batida, azúcar', 'Hacer base con galletas trituradas. Mezclar queso crema con azúcar. Hornear en baño María a 160°C por 1 hora.', '../assets/images/productos/cheesecake-oreo.webp', 4),
(6, 'Macarons surtidos', 'almendra, azúcar glas, clara de huevo, colorantes naturales', 'Preparar merengue francés. Mezclar con almendra molida. Hornear a 150°C por 12 minutos. Rellenar con ganache.', '../assets/images/productos/macarons-surtidos.webp', 5),
(7, 'Tarta de Frutillas', 'harina, mantequilla, frutillas, crema pastelera', 'Estirar masa quebrada. Hornear a 180°C por 20 minutos. Rellenar con crema y decorar con frutillas frescas.', '../assets/images/productos/tarta-de-frutillas.webp', 2),
(8, 'Cupcake Red Velvet', 'harina, cacao, colorante rojo, queso crema', 'Mezclar ingredientes y dividir en moldes. Hornear a 175°C por 25 minutos. Frosting de queso crema.', '../assets/images/productos/cupcake-red-velvet.webp', 3),
(9, 'Panettone Navideño', 'harina, mantequilla, huevos, frutas confitadas, vainilla', 'Preparar masa madre. Mezclar ingredientes y dejar levar 12 horas. Hornear a 170°C por 45 minutos.', '../assets/images/productos/panettone-navideño.webp', 4),
(10, 'Mousse de Maracuyá', 'maracuyá, crema, gelatina, galleta', 'Mezclar pulpa de maracuyá con gelatina disuelta. Montar crema e incorporar. Refrigerar 4 horas.', '../assets/images/productos/mousse-de-maracuya.webp', 2),
(11, 'Tarta de Manzana', 'manzana, canela, masa quebrada, mermelada', 'Disponer láminas de manzana en espiral sobre masa. Hornear a 190°C por 40 minutos. Brillo de mermelada.', '../assets/images/productos/tarta-de-manzana.webp', 3),
(12, 'Alfajor Clásico', 'harina, dulce de leche, chocolate, coco', 'Cocer galletas. Armar sándwich con dulce de leche. Bañar en chocolate y espolvorear coco.', '../assets/images/productos/alfajor-clasico.webp', 2),
(13, 'Chocotorta Clásica', 'galletas chocolinas, dulce de leche, queso crema, café', 'Hacer crema mezclando dulce con queso. Armar capas con galletas humedecidas en café. Refrigerar.', '../assets/images/productos/chocotorta-clasica.webp', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nacimiento` date NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `nacimiento`, `user`, `pass`) VALUES
(1, 'Lautaro1', 'Johnston', '2004-08-09', 'lauti04', '123'),
(2, 'Juan', 'Pérez', '1990-05-20', 'juanp', 'contrasena000'),
(3, 'María', 'García', '1985-10-15', 'mariag', 'oreo1988'),
(4, 'Carlos', 'López', '1992-03-30', 'carlosl', 'carlitos123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fabricacion`
--
ALTER TABLE `fabricacion`
  ADD PRIMARY KEY (`id_fabricacion`),
  ADD KEY `id_receta` (`id_receta`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id_receta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fabricacion`
--
ALTER TABLE `fabricacion`
  MODIFY `id_fabricacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fabricacion`
--
ALTER TABLE `fabricacion`
  ADD CONSTRAINT `fabricacion_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
