-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2023 a las 03:02:02
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbtienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` smallint(2) NOT NULL DEFAULT '0',
  `id_categoria` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `descuento`, `id_categoria`, `activo`) VALUES
(1, 'Zoom Freak 2', 'Con el diseño ondulado original inspirado en los trenes bala japoneses, el Nike Air Max 97 te permite impulsar tu estilo a toda velocidad.\r\n', '25.18', 10, 1, 1),
(2, 'zapatillas bajas Rod Laver', 'Con el diseño ondulado original inspirado en los trenes bala japoneses, el Nike Air Max 97 te permite impulsar tu estilo a toda velocidad.\r\n', '53.37', 0, 1, 1),
(3, 'ASMC Winter Boot Cold Rdy', 'Con el diseño ondulado original inspirado en los trenes bala japoneses, el Nike Air Max 97 te permite impulsar tu estilo a toda velocidad.\r\n', '77.32', 0, 1, 1),
(4, 'Zapatilla clásica 2750 Cotu', 'Con el diseño ondulado original inspirado en los trenes bala japoneses, el Nike Air Max 97 te permite impulsar tu estilo a toda velocidad.\r\n', '93.68', 5, 1, 1),
(5, ' Zapatilla clásica 2750 Cotu', 'Con el diseño ondulado original inspirado en los trenes bala japoneses, el Nike Air Max 97 te permite impulsar tu estilo a toda velocidad.\r\n', '93.68', 0, 1, 1),
(6, 'Sandalia Madrid Hebilla Grande', 'Con el diseño ondulado original inspirado en los trenes bala japoneses, el Nike Air Max 97 te permite impulsar tu estilo a toda velocidad.\r\n', '76.24', 9, 1, 1),
(7, 'Zapatillas ZX 9000 A-ZX Series', 'Con el diseño ondulado original inspirado en los trenes bala japoneses, el Nike Air Max 97 te permite impulsar tu estilo a toda velocidad.\r\n', '47.44', 4, 1, 1),
(8, 'zapatillas ultraboost 21', 'Con el diseño ondulado original inspirado en los trenes bala japoneses, el Nike Air Max 97 te permite impulsar tu estilo a toda velocidad.\r\n', '79.81', 0, 1, 1),
(9, 'Delta del Jordán', 'Con el diseño ondulado original inspirado en los trenes bala japoneses, el Nike Air Max 97 te permite impulsar tu estilo a toda velocidad.\r\n', '60.98', 0, 1, 1),
(10, 'Zapatillas altas Chuck 70', 'Con el diseño ondulado original inspirado en los trenes bala japoneses, el Nike Air Max 97 te permite impulsar tu estilo a toda velocidad.\r\n', '92.87', 10, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
