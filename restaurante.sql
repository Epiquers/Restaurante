-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2025 a las 09:11:20
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--
CREATE DATABASE IF NOT EXISTS `restaurante` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `restaurante`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `idc` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '0 - habilitado\r\n1 - deshabilitado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idc`, `nombre`, `estado`) VALUES
(1, 'Bebidas', 0),
(2, 'Hamburguesas', 0),
(3, 'Postres2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

DROP TABLE IF EXISTS `mesas`;
CREATE TABLE `mesas` (
  `idm` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`idm`, `estado`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `idped` int(11) NOT NULL,
  `fechaHora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario` varchar(10) NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '0 - pendiente\r\n1- pagado',
  `idm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idped`, `fechaHora`, `usuario`, `estado`, `idm`) VALUES
(6, '2025-11-20 08:29:34', '51234567A', 1, 1),
(7, '2025-11-20 08:30:17', '51234567A', 1, 1),
(8, '2025-11-20 08:38:15', '51234567A', 1, 1),
(9, '2025-11-20 08:40:26', '51234567A', 1, 1),
(10, '2025-11-20 08:40:47', '51234567A', 1, 1),
(11, '2025-11-20 08:50:41', '51234567A', 1, 1),
(12, '2025-11-20 09:09:01', '51234567A', 1, 1),
(13, '2025-12-01 11:14:59', '51234567A', 1, 1),
(14, '2025-12-01 11:19:52', '51234567A', 1, 1),
(15, '2025-12-09 07:59:48', '51234567A', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_producto`
--

DROP TABLE IF EXISTS `pedido_producto`;
CREATE TABLE `pedido_producto` (
  `id_linea` int(11) NOT NULL,
  `idped` int(11) NOT NULL,
  `idprod` int(11) NOT NULL,
  `comentario` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '0 - pendiente\r\n1 - servido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedido_producto`
--

INSERT INTO `pedido_producto` (`id_linea`, `idped`, `idprod`, `comentario`, `estado`) VALUES
(33, 6, 1, '', 1),
(34, 6, 2, '', 1),
(35, 6, 5, '', 1),
(36, 6, 3, '', 1),
(37, 6, 4, '', 1),
(38, 7, 1, '', 1),
(39, 7, 2, '', 1),
(40, 8, 1, '', 1),
(41, 8, 2, '', 1),
(42, 9, 1, '', 1),
(43, 9, 2, '', 1),
(44, 10, 1, '', 1),
(45, 10, 2, '', 1),
(46, 11, 1, '', 1),
(47, 11, 2, '', 1),
(48, 12, 1, '', 1),
(49, 12, 2, '', 1),
(50, 12, 3, '', 1),
(51, 12, 4, '', 1),
(56, 13, 1, '', 1),
(57, 13, 2, '', 1),
(58, 13, 1, '', 1),
(59, 13, 1, '', 1),
(60, 13, 1, '', 1),
(61, 13, 1, '', 1),
(62, 13, 2, '', 1),
(63, 13, 1, '', 1),
(64, 13, 1, '', 1),
(65, 13, 1, '', 1),
(66, 13, 3, '', 1),
(67, 13, 1, 'sfdfasdfasdfa', 1),
(68, 13, 3, 'sdfsfasdfads', 1),
(69, 13, 1, '', 1),
(70, 13, 2, '', 1),
(71, 13, 3, 'Con mucho de todo', 1),
(72, 13, 1, 'Bien fresquita', 1),
(73, 13, 2, 'Con solo 2 tigres, y los quiero contentos', 1),
(74, 13, 1, '', 1),
(75, 13, 2, '', 1),
(76, 13, 3, '', 1),
(77, 13, 4, '', 1),
(78, 13, 1, '', 1),
(79, 13, 2, '', 1),
(80, 13, 3, '', 1),
(81, 14, 1, 'Mu fresca', 1),
(82, 14, 3, 'Tenéis pasto seco?', 1),
(83, 15, 1, '', 1),
(84, 15, 2, '', 1),
(85, 15, 3, '', 1),
(86, 15, 3, 'Al punto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `idprod` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` float NOT NULL,
  `stock` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `categoria` int(11) NOT NULL,
  `estado_cat` tinyint(1) NOT NULL COMMENT '0 - activa\r\n1 - bloqueada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idprod`, `nombre`, `descripcion`, `precio`, `stock`, `estado`, `categoria`, `estado_cat`) VALUES
(1, 'La Dorada', 'Clásica rubia lager con 5.2% Alc.', 4, 243, 0, 1, 0),
(2, 'Tres Tristes Tigres', 'Cerveza de trigo densa, suave y aromática con 5.8% Alc.', 4.8, 318, 0, 1, 0),
(3, 'Burguer de la Casa', 'Carne de vaca madurada, lechuga, tomate, cebolla, queso y salsa de la casa', 11.5, 83, 0, 2, 0),
(4, 'Cheese Bacon', 'Carne de vaca madurada, queso \r\nMonterrey Jack y bacon ahumado.', 12.5, 92, 0, 2, 0),
(5, 'Marcen', 'Cerveza tostada con 5.6% Alc.', 5, 138, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE `reservas` (
  `usuario` varchar(10) NOT NULL,
  `idm` int(11) NOT NULL,
  `fechahora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `comensales` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '0 - activa\r\n1 - terminada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`usuario`, `idm`, `fechahora`, `comensales`, `estado`) VALUES
('51234567A', 1, '2025-11-20 08:29:34', 5, 1),
('51234567A', 1, '2025-11-20 08:30:17', 5, 1),
('51234567A', 1, '2025-11-20 08:38:15', 4, 1),
('51234567A', 1, '2025-11-20 08:40:26', 5, 1),
('51234567A', 1, '2025-11-20 08:40:47', 3, 1),
('51234567A', 1, '2025-11-20 08:50:41', 5, 1),
('51234567A', 1, '2025-11-20 09:09:01', 5, 1),
('51234567A', 1, '2025-12-01 11:14:59', 5, 1),
('51234567A', 1, '2025-12-01 11:19:52', 5, 1),
('51234567A', 1, '2025-12-09 07:59:48', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `dni` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `rol` int(11) NOT NULL COMMENT '1-encargado\r\n2-empleado\r\n3-cliente',
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre`, `apellidos`, `telefono`, `direccion`, `email`, `passwd`, `rol`, `estado`) VALUES
('51155115C', 'Benito', 'Camela', '657657657', 'Calle Falsa, 456', 'benito@camarero.es', '1234', 2, 0),
('51234567A', 'Juan', 'Pérez López', '666666666', 'Calle Gran Vía 1', 'juanperez@gmail.com', '1234', 3, 0),
('51464646B', 'Alex', 'Bejar', '698698698', 'Calle Falsa, 789', 'alex@encargado.es', '1234', 1, 0),
('55443322D', 'Lolo', 'Lolailo', '632632632', 'Calle Falsa, 111', 'Lolo@cliente.es', '1234', 3, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idc`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`idm`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idped`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `idm` (`idm`);

--
-- Indices de la tabla `pedido_producto`
--
ALTER TABLE `pedido_producto`
  ADD PRIMARY KEY (`id_linea`),
  ADD KEY `idped` (`idped`),
  ADD KEY `idprod` (`idprod`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idprod`),
  ADD KEY `categoria` (`categoria`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`usuario`,`idm`,`fechahora`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `idm` (`idm`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idped` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `pedido_producto`
--
ALTER TABLE `pedido_producto`
  MODIFY `id_linea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idprod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idm`) REFERENCES `mesas` (`idm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido_producto`
--
ALTER TABLE `pedido_producto`
  ADD CONSTRAINT `pedido_producto_ibfk_1` FOREIGN KEY (`idped`) REFERENCES `pedidos` (`idped`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_producto_ibfk_2` FOREIGN KEY (`idprod`) REFERENCES `productos` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`idc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`idm`) REFERENCES `mesas` (`idm`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
