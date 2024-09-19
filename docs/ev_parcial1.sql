-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-08-2024 a las 08:55:49
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ev_parcial1`
--
CREATE DATABASE IF NOT EXISTS `ev_parcial1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ev_parcial1`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `autor_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nacionalidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`autor_id`, `nombre`, `apellido`, `fecha_nacimiento`, `nacionalidad`) VALUES
(1, 'Dan', 'Brown', '1964-06-22', 'Estados Unidos'),
(2, 'Stephen', 'King', '1947-09-21', 'Estados Unidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor_x_libro`
--

CREATE TABLE `autor_x_libro` (
  `autor_x_libro_id` int(11) NOT NULL,
  `libro_id` int(11) NOT NULL,
  `autor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `autor_x_libro`
--

INSERT INTO `autor_x_libro` (`autor_x_libro_id`, `libro_id`, `autor_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `libro_id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `isbn` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`libro_id`, `titulo`, `genero`, `fecha_publicacion`, `isbn`) VALUES
(1, 'El código Da Vinci', 'Suspenso', '2003-04-03', '0-385-50420-9'),
(3, 'El resplandor', 'terror psicológico', '1977-01-28', '9789588789774');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`autor_id`);

--
-- Indices de la tabla `autor_x_libro`
--
ALTER TABLE `autor_x_libro`
  ADD PRIMARY KEY (`autor_x_libro_id`),
  ADD KEY `libro_en_autor` (`libro_id`),
  ADD KEY `autor_en_libro` (`autor_id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`libro_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `autor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `autor_x_libro`
--
ALTER TABLE `autor_x_libro`
  MODIFY `autor_x_libro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `libro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autor_x_libro`
--
ALTER TABLE `autor_x_libro`
  ADD CONSTRAINT `autor_en_libro` FOREIGN KEY (`autor_id`) REFERENCES `autores` (`autor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `libro_en_autor` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`libro_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
