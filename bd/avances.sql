-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-03-2019 a las 00:04:32
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `avances_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicaciones`
--

CREATE TABLE `aplicaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `url` varchar(300) NOT NULL
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `aplicaciones`
--

INSERT INTO `aplicaciones` (`id`, `nombre`, `url`) VALUES
(2, 'Habilitar Aplicaciones Usuario', 'roles.php'),
(3, 'Gestionar Avances', 'avance1.php'),
(4, 'Gestionar Usuarios', 'usuarios1.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbavances`
--

CREATE TABLE `tbavances` (
  `id` int(11) NOT NULL,
  `requerimiento` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `avance` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `tbavances`
--

INSERT INTO `tbavances` (`id`, `requerimiento`, `avance`, `fecha`) VALUES
(2, '', 'Se Ejecutan los casos de prueba.', '0000-00-00 00:00:00'),
(1, 'sprint3. iteración 2.', 'Se realizan los casos de prueba del requerimiento.', '2019-03-15 09:25:33'),
(3, '', 'Se encuentran incidencias por lo que se reporta al programador Juan.', '0000-00-00 00:00:00'),
(5, '', 'Se genera el ticket 001 para atender las incidencia presentada.', '0000-00-00 00:00:00'),
(4, '', 'Luego de que se resuelve la incidencia, se continuan las pruebas.', '0000-00-00 00:00:00'),
(6, '', 'No se encuentran más incidencias, procede a certificar.', '0000-00-00 00:00:00'),
(7, '', 'Se realiza la certificación del plan de pruebas, el informe se encuentra en el link http://172.17.35.23:8080/testlink/index.php?caller=login', '0000-00-00 00:00:00'),
(8, '', 'adicionando un avance \r\na las 5:52pm', '2019-03-14 17:52:48'),
(9, '', 'asjd askjdf\r\nasklhjklashfko', '2019-03-14 17:37:21'),
(10, '', 'El avance que surge por segunda vez luego de insertar la fecha actual. Este si funciona al editarlo', '2019-03-15 08:42:52'),
(234234, 'asassas', 'aas', '2019-03-15 12:11:24'),
(8876, 'p\r\nr\r\nu\r\ne\r\nb\r\na', 'p\r\nr\r\nu\r\ne\r\nb\r\na', '2019-03-15 12:11:41'),
(8888, 'pr<br />\r\nue<br />\r\nba', 'pr<br />\r\nue<br />\r\nba', '2019-03-15 12:12:25'),
(444, 'a\r\na\r\na\r\n', 'a\r\na\r\na\r\na', '2019-03-15 12:13:40'),
(555, 'kkk\r\na\r\na\r\na\r\na\r\ns\r\ns\r\ns', 'ppp\r\na\r\na\r\na\r\na\r\ns\r\ns\r\ns', '2019-03-15 12:33:55'),
(987, 'Ã¡Ã©Ã­\r\nÃ³ÃºÃ±\r\nÃ‘', 'Ã¡Ã©Ã­\r\nÃ³ÃºÃ±\r\nÃ‘', '2019-03-15 12:39:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `apellidos` varchar(300) NOT NULL,
  `usuarios` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `usuarios`, `clave`) VALUES
(1, 'Jhon', 'Cuervo', '123456', '123456'),
(2, 'Hernan Mauricio', 'Arroyave Quintero', 'clase', 'clave'),
(5, 'wilmar', 'gonzalez', 'wilmar', '123'),
(6, 'hernan', 'perez', 'hernan.perez', '123'),
(7, 'carlos', 'valderrama', 'carlos', '123'),
(8, 'faustino', 'asprilla', 'asprilla', '123'),
(10, 'julio', 'mario', 'julio', '123456'),
(11, 'pablo', 'picasso', 'p.picaso', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usu_apli`
--

CREATE TABLE `usu_apli` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_apli` int(11) NOT NULL
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `usu_apli`
--

INSERT INTO `usu_apli` (`id`, `id_usuario`, `id_apli`) VALUES
(1, 2, 1),
(4, 1, 1),
(7, 1, 2),
(8, 2, 3),
(10, 1, 3),
(12, 1, 4),
(13, 2, 4),
(14, 11, 3),
(15, 2, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aplicaciones`
--
ALTER TABLE `aplicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usu_apli`
--
ALTER TABLE `usu_apli`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aplicaciones`
--
ALTER TABLE `aplicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usu_apli`
--
ALTER TABLE `usu_apli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
