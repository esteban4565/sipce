-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-12-2016 a las 10:50:41
-- Versión del servidor: 5.1.44
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_sipce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipce_estudiante_beca_comedor`
--

CREATE TABLE IF NOT EXISTS `sipce_estudiante_beca_comedor` (
  `ced_estudiante` varchar(20) NOT NULL,
  `ingreso1` int(6) NOT NULL,
  `ingreso2` int(6) NOT NULL,
  `ingreso3` int(6) NOT NULL,
  `ingreso4` int(6) NOT NULL,
  `totalMiembros` int(6) NOT NULL,
  PRIMARY KEY (`ced_estudiante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `sipce_estudiante_beca_comedor`
--

