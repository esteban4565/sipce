-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2016 a las 07:15:31
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_sipce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipce_estudiante_beca`
--

CREATE TABLE IF NOT EXISTS `sipce_estudiante_beca` (
  `ced_estudiante` varchar(20) NOT NULL,
  `distancia` int(2) NOT NULL,
  `numeroRuta` int(6) NOT NULL,
  `ingreso1` int(6) NOT NULL,
  `ingreso2` int(6) NOT NULL,
  `ingreso3` int(6) NOT NULL,
  `ingreso4` int(6) NOT NULL,
  `totalIngreso` int(6) NOT NULL,
  `totalMiembros` int(6) NOT NULL,
  `ced_encargadoCheque` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sipce_estudiante_beca`
--
ALTER TABLE `sipce_estudiante_beca`
 ADD PRIMARY KEY (`ced_estudiante`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
