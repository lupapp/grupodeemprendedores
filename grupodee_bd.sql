-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-04-2018 a las 10:03:53
-- Versión del servidor: 5.6.32-78.1
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `grupodee_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `icono` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `icono`, `descripcion`) VALUES
(1, 'Conferencias', '', 'Sobre PNL, Couching, Formación, Reinvención Profecional.'),
(2, 'Talleres', '', 'Didacticos para Empresas e Instituciones, Grupos abiertos.'),
(3, 'Consultoría', '', 'Consultoría, LOREM'),
(4, 'Cursos training', '', 'Accusantium quam, ultricies eget tempor'),
(5, 'Libros', '', 'Accusantium quam, ultricies eget tempor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frase`
--

CREATE TABLE IF NOT EXISTS `frase` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `profesion` text NOT NULL,
  `frase` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `id` int(11) NOT NULL,
  `categoria` text,
  `nombre` text,
  `descripcion` text,
  `valor` text,
  `imagen` text,
  `fecha_inicio` text,
  `duracion` text,
  `orador` text,
  `itinerario` text,
  `publico` text,
  `calificacion` text,
  `nuevo` text,
  `estado` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `categoria`, `nombre`, `descripcion`, `valor`, `imagen`, `fecha_inicio`, `duracion`, `orador`, `itinerario`, `publico`, `calificacion`, `nuevo`, `estado`) VALUES
(1, '5', 'ASDASD', '<p>ASDASD</p>\r\n', 'ASDASD', 'SERV-180324-114316descarga.jpg', '2018-03-08', 'ASDAS', 'DASDASD', '<p>ASDASD</p>\r\n', 'AASDASD', NULL, '1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_album_categorias`
--

CREATE TABLE IF NOT EXISTS `tbl_album_categorias` (
  `id` int(11) NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonio`
--

CREATE TABLE IF NOT EXISTS `testimonio` (
  `id` int(11) NOT NULL,
  `id_usuario` text NOT NULL,
  `fecha` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` text NOT NULL,
  `clave` text NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `tipo`) VALUES
(1, 'admin', 'admin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `frase`
--
ALTER TABLE `frase`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `testimonio`
--
ALTER TABLE `testimonio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `frase`
--
ALTER TABLE `frase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `testimonio`
--
ALTER TABLE `testimonio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
