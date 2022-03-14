
-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 14-03-2022 a las 12:20:54
-- Versión del servidor: 5.7.30
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `Todolist`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tareas`
--

CREATE TABLE `Tareas` (
  `idTareas` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `descripcion` varchar(120) DEFAULT NULL,
  `estado` text NOT NULL,
  `fec_creacion` date NOT NULL,
  `fec_modif` date NOT NULL,
  `fec_fintarea` date DEFAULT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Tareas`
--

INSERT INTO `Tareas` (`idTareas`, `titulo`, `descripcion`, `estado`, `fec_creacion`, `fec_modif`, `fec_fintarea`, `idUsuario`) VALUES
(1, 'Añadir login a la aplicación Tareas', 'Añadir toda la funcionalidad de login para que cada usuario tenga sus propias tareas.', 'pendiente', '2022-03-09', '2022-03-09', NULL, 18),
(2, 'Añadir funcionalidad PDO', 'Añadir la funcionalidad de PDO a la aplicación Tasks. Ahora mismo solo está con jSon.', 'pendiente', '2022-03-09', '2022-03-09', NULL, 5),
(3, 'Formulario Contacto Error 232 v3', 'Formulario Contacto Error 232 en Internet Explorer v3', 'inprogress', '2022-03-11', '2022-03-14', '2022-03-22', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Tareas`
--
ALTER TABLE `Tareas`
  ADD PRIMARY KEY (`idTareas`),
  ADD KEY `idUsuario_idx` (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Tareas`
--
ALTER TABLE `Tareas`
  MODIFY `idTareas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Tareas`
--
ALTER TABLE `Tareas`
  ADD CONSTRAINT `idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;
