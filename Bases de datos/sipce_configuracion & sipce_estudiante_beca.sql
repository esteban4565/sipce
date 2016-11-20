-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2016 a las 21:46:15
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
-- Estructura de tabla para la tabla `sipce_configuracion`
--

CREATE TABLE IF NOT EXISTS `sipce_configuracion` (
`id` int(1) NOT NULL,
  `annio_lectivo` int(4) NOT NULL,
  `director` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `sipce_configuracion`
--

INSERT INTO `sipce_configuracion` (`id`, `annio_lectivo`, `director`) VALUES
(1, 2016, 'Msc. Ingrid Jiménez López');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipce_estudiante_beca`
--

CREATE TABLE IF NOT EXISTS `sipce_estudiante_beca` (
  `ced_estudiante` varchar(20) NOT NULL,
  `distancia` int(2) NOT NULL,
  `ingreso1` int(6) NOT NULL,
  `ingreso2` int(6) NOT NULL,
  `ingreso3` int(6) NOT NULL,
  `ingreso4` int(6) NOT NULL,
  `totalIngreso` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sipce_estudiante_beca`
--

INSERT INTO `sipce_estudiante_beca` (`ced_estudiante`, `distancia`, `ingreso1`, `ingreso2`, `ingreso3`, `ingreso4`, `totalIngreso`) VALUES
('2-0787-0047', 5, 100000, 100000, 0, 0, 2),
('2-0825-0115', 8, 55, 0, 0, 0, 5),
('3-0540-0510', 8, 1, 1, 1, 1, 1),
('4-0245-0453', 6, 50000, 0, 0, 0, 1),
('4-0255-0118', 6, 10000, 10000, 10000, 0, 3),
('4-0256-0161', 0, 0, 0, 0, 0, 0),
('4-0256-0637', 6, 10000, 10000, 10000, 10000, 4),
('4-0258-0316', 8, 1000000, 0, 0, 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sipce_configuracion`
--
ALTER TABLE `sipce_configuracion`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sipce_estudiante_beca`
--
ALTER TABLE `sipce_estudiante_beca`
 ADD PRIMARY KEY (`ced_estudiante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sipce_configuracion`
--
ALTER TABLE `sipce_configuracion`
MODIFY `id` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
