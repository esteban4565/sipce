-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2015 a las 01:46:35
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
-- Estructura de tabla para la tabla `sipce_escuelas`
--

CREATE TABLE IF NOT EXISTS `sipce_escuelas` (
`id` int(6) NOT NULL,
  `codPresupuestario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `IdProvincia` int(5) NOT NULL,
  `IdCanton` int(5) NOT NULL,
  `IdDistrito` int(5) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3833 ;

--
-- Volcado de datos para la tabla `sipce_escuelas`
--

INSERT INTO `sipce_escuelas` (`id`, `codPresupuestario`, `nombre`, `IdProvincia`, `IdCanton`, `IdDistrito`, `tipo`) VALUES
(0, 9999, 'Escuela no encontrada', 0, 0, 0, 'Diurna');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sipce_escuelas`
--
ALTER TABLE `sipce_escuelas`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sipce_escuelas`
--
ALTER TABLE `sipce_escuelas`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3833;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
