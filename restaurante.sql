-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2025 a las 14:19:20
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
(3, 0);

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
(1, 'La Dorada 5.2%', 'Clásica rubia lager con 5.2% Alc.', 4, 273, 0, 1, 0),
(2, 'Tres Tristes Tigres 5.8%', 'Cerveza de trigo densa, suave y aromática con 5.8% Alc.', 4.8, 338, 0, 1, 0),
(3, 'Burguer de la Casa', 'Carne de vaca madurada, lechuga, tomate, cebolla, queso y salsa de la casa', 11.5, 96, 0, 2, 0),
(4, 'Cheese Bacon', 'Carne de vaca madurada, queso \r\nMonterrey Jack y bacon ahumado.', 12.5, 97, 0, 2, 0),
(5, 'Marcen 5.6%', 'Cerveza tostada con 5.6% Alc.', 5, 143, 0, 1, 0);

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
('51234567A', 'Juan', 'Pérez', '666666666', 'Calle Gran Vía 1', 'juanperez@gmail.com', '1234', 3, 0),
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
  MODIFY `idped` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido_producto`
--
ALTER TABLE `pedido_producto`
  MODIFY `id_linea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
