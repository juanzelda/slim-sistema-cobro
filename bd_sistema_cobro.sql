-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.6-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para sistema_cobro
CREATE DATABASE IF NOT EXISTS `sistema_cobro` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sistema_cobro`;

-- Volcando estructura para tabla sistema_cobro.colaborador
CREATE TABLE IF NOT EXISTS `colaborador` (
  `id` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL COMMENT 'union con su usuario',
  `puesto` int(11) DEFAULT NULL COMMENT 'puesto que desempeña aun no se confirma si sera en otra tabla',
  `email` int(11) DEFAULT NULL COMMENT 'correo del empleado',
  `foto` blob DEFAULT NULL COMMENT 'foto del empleado que se guradar en blod o sea en la misma tabla',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabla par almacenar los empleado que se relaccionan con una persona y un usuario';

-- Volcando datos para la tabla sistema_cobro.colaborador: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `colaborador` DISABLE KEYS */;
/*!40000 ALTER TABLE `colaborador` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.concepto
CREATE TABLE IF NOT EXISTS `concepto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` int(11) NOT NULL,
  `concepto` varchar(50) DEFAULT NULL,
  `importe` double DEFAULT NULL,
  `estatus` int(11) DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `Índice 2` (`clave`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.concepto: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `concepto` DISABLE KEYS */;
INSERT INTO `concepto` (`id`, `clave`, `concepto`, `importe`, `estatus`, `created_at`, `update_at`) VALUES
	(1, 1, 'pago contemporaneo mod', 900.5, 0, '2020-01-01 00:00:00', '2021-05-09 17:23:34'),
	(2, 2, 'pago contemporaneo', 800.5, 1, '2020-01-01 00:00:00', '2021-05-09 16:49:45'),
	(3, 3, 'Medicina Niueva Modificada mod', 650.5, 1, '2020-01-06 00:00:00', '2021-05-09 16:48:54'),
	(4, 4, 'rollo de plasticoz', 200, 1, '2020-01-03 00:00:00', '2021-05-09 16:48:23'),
	(5, 5, 'rollo de aluminio', 250, 1, '2021-05-09 18:06:02', '2021-05-09 18:06:04'),
	(6, 6, 'Vaso de Plastico', 35, 1, '2021-05-09 18:08:36', '2021-05-09 18:17:14');
/*!40000 ALTER TABLE `concepto` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.contribuyente
CREATE TABLE IF NOT EXISTS `contribuyente` (
  `id` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `email` int(11) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.contribuyente: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contribuyente` DISABLE KEYS */;
/*!40000 ALTER TABLE `contribuyente` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.direccion
CREATE TABLE IF NOT EXISTS `direccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calle` varchar(50) DEFAULT NULL,
  `colonia` varchar(50) DEFAULT NULL,
  `num_ext` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistema_cobro.direccion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `direccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `direccion` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.ejercicio_fiscal
CREATE TABLE IF NOT EXISTS `ejercicio_fiscal` (
  `id` int(11) DEFAULT NULL,
  `periodo` varchar(50) DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.ejercicio_fiscal: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ejercicio_fiscal` DISABLE KEYS */;
/*!40000 ALTER TABLE `ejercicio_fiscal` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.factura
CREATE TABLE IF NOT EXISTS `factura` (
  `id` int(11) DEFAULT NULL,
  `id_factura_api` int(11) DEFAULT NULL,
  `uuid` varchar(100) DEFAULT NULL,
  `rfc` varchar(13) DEFAULT NULL,
  `razon_social` varchar(100) DEFAULT NULL,
  `calle` varchar(50) DEFAULT NULL,
  `num_ext` varchar(50) DEFAULT NULL,
  `num_int` varchar(50) DEFAULT NULL,
  `colonia` varchar(50) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.factura: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estatus` bit(1) NOT NULL DEFAULT b'1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistema_cobro.perfil: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`id`, `perfil`, `descripcion`, `estatus`, `created_at`, `updated_at`) VALUES
	(3, 'administrador', 'perfil de administrador', b'1', '2021-04-18 21:22:45', '2021-04-18 21:22:48'),
	(4, 'administrador 22', 'es el perfil maximo', b'0', '2021-05-09 20:16:08', '2021-05-09 20:25:47'),
	(5, 'administrador', 'es el perfil maximo', b'1', '2021-05-09 20:17:19', '2021-05-09 20:17:19');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.personas
CREATE TABLE IF NOT EXISTS `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_direccion` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `paterno` varchar(45) DEFAULT NULL,
  `materno` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_personas_direccion` (`id_direccion`),
  CONSTRAINT `FK_personas_direccion` FOREIGN KEY (`id_direccion`) REFERENCES `direccion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistema_cobro.personas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.telefonos
CREATE TABLE IF NOT EXISTS `telefonos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `tipo` enum('Casa','Oficiona','Celular') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_telefonos_personas` (`id_persona`),
  CONSTRAINT `FK_telefonos_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistema_cobro.telefonos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `telefonos` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefonos` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistema_cobro.usuarios: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `username`, `password`, `estatus`, `created_at`, `updated_at`) VALUES
	(4, 'admin', 'admin', 1, '2021-04-18 21:22:15', '2021-04-18 21:22:17'),
	(5, 'admin2', 'admin2', 1, '2021-05-09 18:25:26', '2021-05-09 18:25:26'),
	(6, 'perfi', 'perfi', 0, '2021-05-09 18:26:09', '2021-05-09 19:20:30');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.usuario_perfil
CREATE TABLE IF NOT EXISTS `usuario_perfil` (
  `id_usuario` int(11) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabla de union de usuarios y perfiles';

-- Volcando datos para la tabla sistema_cobro.usuario_perfil: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario_perfil` DISABLE KEYS */;
INSERT INTO `usuario_perfil` (`id_usuario`, `id_perfil`) VALUES
	(4, 3);
/*!40000 ALTER TABLE `usuario_perfil` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
