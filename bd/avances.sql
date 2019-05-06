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
-- Base de datos: 'avances_db'
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'aplicaciones'
--

CREATE TABLE aplicaciones (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(300) NOT NULL,
  url varchar(300) NOT NULL
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla 'aplicaciones'
--

INSERT INTO aplicaciones (nombre, url) VALUES
('Habilitar Aplicaciones Usuario', 'roles.php'),
('Gestionar Avances', 'avance1.php'),
('Gestionar Usuarios', 'usuarios1.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'usuarios'
--

CREATE TABLE usuarios (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(300) NOT NULL,
  apellidos varchar(300) NOT NULL,
  usuarios varchar(50) NOT NULL,
  clave varchar(50) NOT NULL
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla 'usuarios'
--

INSERT INTO usuarios (id, nombre, apellidos, usuarios, clave) VALUES
(1, 'Jhon', 'Cuervo', '123456', '123456'),
(2, 'Mauricio', 'Arroyave Quintero', 'clase', 'clave'),
(3, 'wilmar', 'gonzalez', 'wilmar', '123'),
(4, 'hernan', 'perez', 'hernan.perez', '123'),
(5, 'carlos', 'valderrama', 'carlos', '123'),
(6, 'faustino', 'asprilla', 'asprilla', '123'),
(7, 'julio', 'mario', 'julio', '123456'),
(8, 'pablo', 'picasso', 'p.picaso', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'tbavances'
--

CREATE TABLE tbavances (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  codigo int(11) NOT NULL,
  requerimiento varchar(50) NOT NULL,
  avance longtext NOT NULL,
  fecha datetime NOT NULL,
  porcentaje_avance int(3) NOT NULL,
  id_usuario int(11) NOT NULL,
  KEY id_usuario (id_usuario),
  CONSTRAINT tbavances_ibfk_1 FOREIGN KEY (id_usuario) REFERENCES usuarios (id)
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla 'tbavances'
--

INSERT INTO tbavances (codigo, requerimiento, avance, fecha, id_usuario, porcentaje_avance) VALUES
(22, 'Sprint3. iteración 1.', 'Se Ejecutan los casos de prueba.', '0000-00-00 00:00:00', 2, 1),
(12, 'Sprint3. iteración 2.', 'Se realizan los casos de prueba del requerimiento.', '2019-03-15 09:25:33', 3, 2),
(312, 'Sprint2. iteración 2.', 'Se encuentran incidencias por lo que se reporta al programador Juan.', '0000-00-00 00:00:00', 4, 3),
(532, 'Sprint2. iteración 1.', 'Se genera el ticket 001 para atender las incidencia presentada.', '0000-00-00 00:00:00', 4, 4),
(456, 'Sprint1. iteración 2.', 'Luego de que se resuelve la incidencia, se continuan las pruebas.', '0000-00-00 00:00:00', 3, 1),
(611, 'Sprint1. iteración 1.', 'No se encuentran más incidencias, procede a certificar.', '0000-00-00 00:00:00', 2, 2),
(177, 'Sprint3. iteración 2.', 'Se realiza la certificación del plan de pruebas, el informe se encuentra en el link http://172.17.35.23:8080/testlink/index.php?caller=login', '0000-00-00 00:00:00', 1, 3),
(158, 'Sprint3. iteración 1.', 'adicionando un avance \r\na las 5:52pm', '2019-03-14 17:52:48', 2, 4),
(9154, 'Sprint2. iteración 2.', 'Se soluciona la incidencia 2233', '2019-03-14 17:37:21', 3, 1),
(4510, 'Sprint2. iteración 1.', 'El avance que surge por segunda vez luego de insertar la fecha actual. Este si funciona al editarlo', '2019-03-15 08:42:52', 4, 2),
(5411, 'Sprint1. iteración 2.', 'Se encuentra incidencia 11200', '2019-03-15 12:11:24', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'usu_apli'
--

CREATE TABLE usu_apli (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  id_usuario int(11) NOT NULL,
  id_apli int(11) NOT NULL,
  CONSTRAINT usu_apli_usuarios FOREIGN KEY (id_usuario) REFERENCES usuarios (id),
  CONSTRAINT usu_apli_aplicaciones FOREIGN KEY (id_apli) REFERENCES aplicaciones (id)
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla 'usu_apli'
--

INSERT INTO usu_apli (id_usuario, id_apli) VALUES
(2, 1),
(1, 1),
(3, 2),
(2, 3),
(1, 3),
(3, 1),
(2, 1),
(3, 3),
(1, 2);

COMMIT;
