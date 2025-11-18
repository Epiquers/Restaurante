-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-11-2021 a las 11:31:04
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurant`
--
CREATE DATABASE IF NOT EXISTS `restaurant` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `restaurant`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

DROP TABLE IF EXISTS `platos`;
CREATE TABLE IF NOT EXISTS `platos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id`, `descripcion`, `nombre`, `imagen`) VALUES
(1, 'Plato de caldo con pasta, arroz, sémola, hortalizas, u otros alimentos troceados que se cuecen en ese caldo.', 'Sopa de sobre', 'imagen/sopa.jpg'),
(2, 'La palabra nugget en inglés significa pepita, y son eso, unas pepitas o nueces hechas de carne de pollo triturada y rebozada con huevo y pan rallado, fritos en abundante aceite.', 'Nuggets de pollo', 'imagen/nuggets-de-pollo.jpg'),
(3, 'Pieza de carnicería (de ternera, de cordero o de cerdo) que comprende el conjunto de las primeras y segundas costillas. El costillar suele cortarse en porciones individuales (chuletas y costillas), para asar o cocer en sartén.', 'Costillar', 'imagen/Costillar.jpg'),
(4, 'Plato que se prepara mezclando distintos alimentos, crudos o cocidos, principalmente hortalizas troceadas, y se sirve frío o tibio, y aliñado o aderezado con alguna salsa.', 'Ensalada', 'imagen/ensalada.jpg'),
(5, 'Los palitos de mozzarella (mozzarella sticks) son trozos alargados de queso mozzarella rebozados o empanados y fritos.', 'Fingers de queso', 'imagen/fingers-de-formatge.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
