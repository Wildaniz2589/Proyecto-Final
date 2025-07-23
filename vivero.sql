-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.4.3 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para vivero
CREATE DATABASE IF NOT EXISTS `vivero` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `vivero`;

-- Volcando estructura para tabla vivero.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla vivero.categorias: ~5 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `nombre`) VALUES
	(1, 'Interior'),
	(2, 'Exterior'),
	(3, 'Suculentas'),
	(4, 'Interior'),
	(5, 'Exterior');

-- Volcando estructura para tabla vivero.plantas
CREATE TABLE IF NOT EXISTS `plantas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `id_categoria` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `plantas_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla vivero.plantas: ~5 rows (aproximadamente)
INSERT INTO `plantas` (`id`, `nombre`, `precio`, `stock`, `id_categoria`) VALUES
	(1, 'Aloe Vera', 10.00, 6, 3),
	(2, 'Helecho', 8.50, 15, 1),
	(3, 'Cactus', 12.00, 7, 2),
	(4, 'coco', 15.50, 5, 2),
	(11, 'frutilla', 1.00, 40, 2);

-- Volcando estructura para tabla vivero.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla vivero.roles: ~3 rows (aproximadamente)
INSERT INTO `roles` (`id`, `nombre`) VALUES
	(1, 'Administrador'),
	(2, 'Vendedor'),
	(3, 'Encargado');

-- Volcando estructura para tabla vivero.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `id_rol` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla vivero.usuarios: ~3 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `id_rol`) VALUES
	(3, 'Admin', 'admin@admin.com', '123456', 1),
	(4, 'Vendedor 1', 'vendedor1@example.com', '123456', 2),
	(5, 'Encargado', 'encargado@vivero.com', '123456', 3);

-- Volcando estructura para tabla vivero.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla vivero.ventas: ~10 rows (aproximadamente)
INSERT INTO `ventas` (`id`, `fecha`, `id_usuario`, `total`) VALUES
	(1, '2025-07-23 12:59:27', 4, 20.00),
	(2, '2025-07-23 12:59:59', 4, 24.00),
	(3, '2025-07-23 13:04:32', 4, 46.50),
	(4, '2025-07-23 13:12:17', 4, 100.00),
	(5, '2025-07-23 13:22:48', 4, 15.50),
	(6, '2025-07-23 15:14:58', 4, 100.00),
	(7, '2025-07-23 15:15:19', 4, 15.50),
	(8, '2025-07-23 15:18:16', 4, 12.00),
	(9, '2025-07-23 15:20:14', 4, 10.00),
	(10, '2025-07-23 15:28:55', 4, 10.00),
	(11, '2025-07-23 15:59:28', 4, 10.00);

-- Volcando estructura para tabla vivero.venta_detalle
CREATE TABLE IF NOT EXISTS `venta_detalle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_venta` int DEFAULT NULL,
  `id_planta` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_venta` (`id_venta`),
  KEY `id_planta` (`id_planta`),
  CONSTRAINT `venta_detalle_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`),
  CONSTRAINT `venta_detalle_ibfk_2` FOREIGN KEY (`id_planta`) REFERENCES `plantas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla vivero.venta_detalle: ~10 rows (aproximadamente)
INSERT INTO `venta_detalle` (`id`, `id_venta`, `id_planta`, `cantidad`, `precio_unitario`) VALUES
	(1, 1, 1, 2, 10.00),
	(2, 2, 3, 2, 12.00),
	(3, 3, 4, 3, 15.50),
	(4, 4, 1, 10, 10.00),
	(5, 5, 4, 1, 15.50),
	(6, 6, 1, 10, 10.00),
	(7, 7, 4, 1, 15.50),
	(8, 8, 3, 1, 12.00),
	(9, 9, 11, 10, 1.00),
	(10, 10, 1, 1, 10.00),
	(11, 11, 1, 1, 10.00);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
