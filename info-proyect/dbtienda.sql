-- phpMyAdmin SQL Dump Mejorado
-- Base de datos: `dbtienda`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Configuración de codificación
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

-- Tabla: compra
CREATE TABLE `compra` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_transaccion` VARCHAR(20) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` DATETIME DEFAULT NULL,
  `status` VARCHAR(20) COLLATE utf8_spanish_ci NOT NULL,
  `email` VARCHAR(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_cliente` VARCHAR(20) COLLATE utf8_spanish_ci NOT NULL,
  `total` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Datos de prueba
INSERT INTO `compra` (`id`, `id_transaccion`, `fecha`, `status`, `email`, `id_cliente`, `total`) VALUES
(1, '5KA315197H7749448', '2023-10-15 19:57:34', 'COMPLETED', 'sb-jn43ha27572853@personal.example.com', 'DKN2Z9Y65PYZS', 311.74),
(2, '4FL87389T8014515C', '2023-10-15 20:00:00', 'COMPLETED', 'sb-jn43ha27572853@personal.example.com', 'DKN2Z9Y65PYZS', 130.69),
(3, '4J846535NA4862627', '2023-10-15 20:05:15', 'COMPLETED', 'sb-jn43ha27572853@personal.example.com', 'DKN2Z9Y65PYZS', 53.37);

-- --------------------------------------------------------

-- Tabla: productos
CREATE TABLE `productos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` TEXT COLLATE utf8_spanish_ci NOT NULL,
  `precio` DECIMAL(10,2) NOT NULL,
  `descuento` SMALLINT(2) NOT NULL DEFAULT 0,
  `id_categoria` INT(11) NOT NULL,
  `activo` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Datos de prueba
INSERT INTO `productos` (`nombre`, `descripcion`, `precio`, `descuento`, `id_categoria`, `activo`) VALUES
('Zoom Freak 2', 'Zapatillas deportivas de alto rendimiento.', 25.18, 10, 1, 1),
('zapatillas bajas Rod Laver', 'Modelo clásico con diseño cómodo.', 53.37, 0, 1, 1),
('ASMC Winter Boot Cold Rdy', 'Botas de invierno resistentes al frío.', 77.32, 0, 1, 1),
('Zapatilla clásica 2750 Cotu', 'Estilo casual para uso diario.', 93.68, 5, 1, 1),
(' Zapatilla clásica 2750 Cotu', 'Variante con diseño clásico y elegante.', 93.68, 0, 1, 1),
('Sandalia Madrid Hebilla Grande', 'Sandalia cómoda con gran hebilla.', 76.24, 9, 1, 1),
('Zapatillas ZX 9000 A-ZX Series', 'Diseño moderno para runners.', 47.44, 4, 1, 1),
('zapatillas ultraboost 21', 'Ultraboost con amortiguación premium.', 79.81, 0, 1, 1),
('Delta del Jordán', 'Inspiradas en el estilo clásico de Jordan.', 60.98, 0, 1, 1),
('Zapatillas altas Chuck 70', 'Versión elevada del modelo Chuck Taylor.', 92.87, 10, 1, 1);

-- --------------------------------------------------------

-- Tabla: detalle_compra
CREATE TABLE `detalle_compra` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_compra` INT(11) NOT NULL,
  `id_producto` INT(11) NOT NULL,
  `nombre` VARCHAR(200) COLLATE utf8_spanish_ci NOT NULL,
  `precio` DECIMAL(10,2) NOT NULL,
  `cantidad` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_compra` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Datos de prueba
INSERT INTO `detalle_compra` (`id_compra`, `id_producto`, `nombre`, `precio`, `cantidad`) VALUES
(1, 2, 'zapatillas bajas Rod Laver', 53.37, 2),
(1, 3, 'ASMC Winter Boot Cold Rdy', 77.32, 2),
(1, 1, 'Zoom Freak 2', 22.66, 2),
(2, 2, 'zapatillas bajas Rod Laver', 53.37, 1),
(2, 3, 'ASMC Winter Boot Cold Rdy', 77.32, 1),
(3, 2, 'zapatillas bajas Rod Laver', 53.37, 1);

-- Finalización de la transacción
COMMIT;

-- Restauración de configuración original
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
