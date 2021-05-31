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

-- Volcando estructura para tabla sistema_cobro.cargo
CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_recibo` int(11) DEFAULT NULL COMMENT 'id_recibo al que pertenece el cargo',
  `id_concepto` int(11) DEFAULT NULL COMMENT 'id de concepto al que se liga el cargo',
  `fecha_cargo` datetime DEFAULT current_timestamp() COMMENT 'fecha en la que se realiza el cargo',
  `clave` int(11) DEFAULT NULL COMMENT 'clave del concepto ',
  `concepto` varchar(500) DEFAULT NULL COMMENT 'descripcion del concepto',
  `precio_unitario` double DEFAULT 0 COMMENT 'precio del concepto',
  `cantidad` int(11) DEFAULT 1 COMMENT 'cntidad que se carga del concepto',
  `total` double DEFAULT 0 COMMENT 'total es la multiplicacion del precio unitario por la cantidad',
  `estatus` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_cargo_recibo` (`id_recibo`),
  KEY `FK_cargo_concepto` (`id_concepto`),
  CONSTRAINT `FK_cargo_concepto` FOREIGN KEY (`id_concepto`) REFERENCES `concepto` (`id`),
  CONSTRAINT `FK_cargo_recibo` FOREIGN KEY (`id_recibo`) REFERENCES `recibo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.cargo: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` (`id`, `id_recibo`, `id_concepto`, `fecha_cargo`, `clave`, `concepto`, `precio_unitario`, `cantidad`, `total`, `estatus`) VALUES
	(2, 3, 4, '2021-05-16 22:27:49', 4, 'rollo plastico', 200, 1, 200, 1),
	(3, 4, 4, '2021-05-16 22:37:50', 4, 'rollo plastico', 200, 1, 200, 1),
	(4, 4, 5, '2021-05-16 22:37:50', 5, 'rollo aluminio', 250, 1, 250, 1),
	(5, 4, 6, '2021-05-16 22:37:50', 6, 'vaso de plastico', 35, 2, 70, 1);
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.colaborador
CREATE TABLE IF NOT EXISTS `colaborador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `rfc` varchar(13) DEFAULT NULL,
  `puesto` varchar(50) DEFAULT NULL COMMENT 'puesto que desempeña aun no se confirma si sera en otra tabla',
  `email` varchar(50) DEFAULT NULL COMMENT 'correo del empleado',
  `foto` varchar(50) DEFAULT NULL COMMENT 'foto del empleado que se guradar en blod o sea en la misma tabla',
  `estatus` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_colaborador_personas` (`id_persona`),
  CONSTRAINT `FK_colaborador_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='tabla par almacenar los empleado que se relaccionan con una persona y un usuario';

-- Volcando datos para la tabla sistema_cobro.colaborador: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `colaborador` DISABLE KEYS */;
INSERT INTO `colaborador` (`id`, `id_persona`, `nip`, `rfc`, `puesto`, `email`, `foto`, `estatus`, `created_at`, `updated_at`) VALUES
	(1, 5, '0001', 'ROPL890311I87', 'programador', 'ejemplo@gmail.com', 'ruta imagen', 0, '2021-05-16 15:00:12', '2021-05-16 15:14:27'),
	(2, 6, '0001', 'ROPL890311I87', 'programador', 'ejemplo@gmail.com', 'ruta imagen', 1, '2021-05-16 15:00:39', '2021-05-16 15:00:39'),
	(3, 7, '0001', 'ROPL890311I88', 'programador', 'ejemplo@gmail.com', 'ruta imagen', 1, '2021-05-16 15:06:35', '2021-05-16 15:11:59'),
	(4, 11, '0002', 'ROPL890311I87', 'ADMINISTRADOR', 'ejemplo@gmail.com', NULL, 1, '2021-05-30 19:26:16', '2021-05-30 19:26:16'),
	(5, 12, '0002', 'ROPL890311I87', 'ADMINISTRADOR', 'ejemplo@gmail.com', NULL, 1, '2021-05-30 19:27:27', '2021-05-30 19:27:27'),
	(6, 13, '0003', 'ROPL890311I87', 'ADMIN', 'ejemplo@gmail.com', NULL, 1, '2021-05-30 19:29:14', '2021-05-30 19:29:14');
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.concepto: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `concepto` DISABLE KEYS */;
INSERT INTO `concepto` (`id`, `clave`, `concepto`, `importe`, `estatus`, `created_at`, `update_at`) VALUES
	(1, 1, 'pago contemporaneo mod', 900.5, 0, '2020-01-01 00:00:00', '2021-05-09 17:23:34'),
	(2, 2, 'PAGO CONTEMPORANEO', 800.5, 1, '2020-01-01 00:00:00', '2021-05-30 01:50:04'),
	(3, 3, 'Medicina Niueva Modificada mod', 650.5, 1, '2020-01-06 00:00:00', '2021-05-09 16:48:54'),
	(4, 4, 'rollo de plasticoz', 200, 1, '2020-01-03 00:00:00', '2021-05-09 16:48:23'),
	(5, 5, 'rollo de aluminio', 250, 1, '2021-05-09 18:06:02', '2021-05-09 18:06:04'),
	(6, 6, 'Vaso de Plastico', 35, 1, '2021-05-09 18:08:36', '2021-05-09 18:17:14'),
	(7, 7, 'COLA COLA DE LITRO Y MEDIO', 25, 1, '2021-05-30 01:06:52', '2021-05-30 01:06:52'),
	(12, 8, 'Cola cola de litro y medio', 25, 1, '2021-05-30 01:13:04', '2021-05-30 01:13:04'),
	(13, 9, 'LECHE SAN MARCOS', 14, 1, '2021-05-30 01:15:36', '2021-05-30 01:15:36'),
	(14, 10, 'CEREAL CORN FLAKES', 55, 1, '2021-05-30 01:17:25', '2021-05-30 01:17:25'),
	(15, 11, 'CEREAL CORN FLAKES CHOCOLATE', 75, 1, '2021-05-30 01:18:08', '2021-05-30 01:18:08'),
	(17, 12, 'CEREAL CORN FLAKES CHOCOLATE', 75, 1, '2021-05-30 01:19:07', '2021-05-30 01:19:07'),
	(19, 13, 'CEREAL CORN FLAKES CHOCOLATE 2', 75.53, 1, '2021-05-30 01:19:47', '2021-05-30 01:19:47'),
	(22, 14, 'CEREAL CORN FLAKES CHOCOLATE 2', 75.53, 1, '2021-05-30 01:20:58', '2021-05-30 01:20:58'),
	(23, 15, 'ROLLO MEDIANO DE TELA', 589.52, 1, '2021-05-30 01:23:47', '2021-05-30 01:23:47');
/*!40000 ALTER TABLE `concepto` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.contribuyente
CREATE TABLE IF NOT EXISTS `contribuyente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `estatus` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_contribuyente_personas` (`id_persona`),
  CONSTRAINT `FK_contribuyente_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.contribuyente: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `contribuyente` DISABLE KEYS */;
INSERT INTO `contribuyente` (`id`, `id_persona`, `email`, `telefono`, `estatus`, `created_at`, `updated_at`) VALUES
	(1, 9, 'ejemplo@gmail.com', 'ruta imagen', 0, '2021-05-16 15:56:36', '2021-05-16 15:56:36'),
	(2, 10, NULL, NULL, 1, '2021-05-16 19:26:35', '2021-05-16 19:26:35');
/*!40000 ALTER TABLE `contribuyente` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.datos_facturacion
CREATE TABLE IF NOT EXISTS `datos_facturacion` (
  `id` int(11) DEFAULT NULL,
  `rfc` varchar(13) DEFAULT NULL COMMENT 'rfc ya sea persona fisica o moral',
  `razon_social` varchar(100) DEFAULT NULL COMMENT 'razon social',
  `calle` varchar(50) DEFAULT NULL COMMENT 'calle',
  `num_ext` varchar(50) DEFAULT NULL,
  `num_int` varchar(50) DEFAULT NULL,
  `colonia` varchar(50) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  UNIQUE KEY `rfc` (`rfc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.datos_facturacion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `datos_facturacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `datos_facturacion` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.descuento
CREATE TABLE IF NOT EXISTS `descuento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cargo` int(11) DEFAULT NULL COMMENT 'id del crgo al que se le otorga el descuento',
  `persona_otorga` int(11) DEFAULT NULL COMMENT 'perosna colabordor que otorga el descuento',
  `fecha_otorga` datetime DEFAULT current_timestamp() COMMENT 'fecha en la que se realizo el alta del descuento',
  `monto` double DEFAULT 1 COMMENT 'monto del desceunto no debe ser mayo del monto del cargo',
  `motivo` int(11) DEFAULT NULL,
  `estatus` int(11) DEFAULT 1 COMMENT 'estatus del desceunto',
  PRIMARY KEY (`id`),
  KEY `FK_descuento_cargo` (`id_cargo`),
  KEY `FK_descuento_usuarios` (`persona_otorga`),
  CONSTRAINT `FK_descuento_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`),
  CONSTRAINT `FK_descuento_usuarios` FOREIGN KEY (`persona_otorga`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.descuento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `descuento` DISABLE KEYS */;
/*!40000 ALTER TABLE `descuento` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.direccion
CREATE TABLE IF NOT EXISTS `direccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL DEFAULT 0,
  `calle` varchar(50) DEFAULT NULL,
  `colonia` varchar(50) DEFAULT NULL,
  `num_ext` varchar(5) DEFAULT NULL,
  `num_int` varchar(5) DEFAULT '0',
  `ciudad` varchar(50) DEFAULT '0',
  `estado` varchar(50) DEFAULT '0',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_direccion_personas` (`id_persona`),
  CONSTRAINT `FK_direccion_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistema_cobro.direccion: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `direccion` DISABLE KEYS */;
INSERT INTO `direccion` (`id`, `id_persona`, `calle`, `colonia`, `num_ext`, `num_int`, `ciudad`, `estado`, `created_at`, `updated_at`) VALUES
	(9, 5, 'VALLE MESOREA', 'VALLE DE SAN JOSE', '206', '', 'LEON', 'GUANAJUATO', NULL, NULL),
	(10, 6, 'VALLE MESOREA', 'VALLE DE SAN JOSE', '206', '', 'LEON', 'GUANAJUATO', NULL, NULL),
	(11, 7, 'VALLE MESOREAm', 'VALLE DE SAN JOSE', '206', '', 'LEON', 'GUANAJUATO', NULL, NULL),
	(12, 11, 'MADRE ESTELA', 'DIEZ DE MAYO', '205', '', 'LEON', 'GUANAJUATO', '2021-05-30 19:26:16', '2021-05-30 19:26:16'),
	(13, 12, 'MADRE ESTELA', 'DIEZ DE MAYO', '205', '', 'LEON', 'GUANAJUATO', '2021-05-30 19:27:27', '2021-05-30 19:27:27'),
	(14, 13, 'SAN ISIDRO', 'SANTA ROSA DE LIMA', '451', '', 'LEON', 'GUANAJUATO', '2021-05-30 19:29:14', '2021-05-30 19:29:14');
/*!40000 ALTER TABLE `direccion` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.ejercicio_fiscal
CREATE TABLE IF NOT EXISTS `ejercicio_fiscal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo` varchar(50) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estatus` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.ejercicio_fiscal: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ejercicio_fiscal` DISABLE KEYS */;
INSERT INTO `ejercicio_fiscal` (`id`, `periodo`, `fecha_inicio`, `fecha_fin`, `estatus`, `created_at`, `updated_at`) VALUES
	(1, '2020-2021 mod', '2020-01-01', '2021-01-01', 0, '2021-05-16 19:26:57', '2021-05-16 19:29:07'),
	(2, '2020-2021', '2020-01-01', '2021-01-01', 1, '2021-05-16 19:27:59', '2021-05-16 19:27:59'),
	(3, 'periodo 2021-2022', '2021-05-02', '2022-05-18', 1, '2021-05-30 23:36:12', '2021-05-30 23:36:12');
/*!40000 ALTER TABLE `ejercicio_fiscal` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.factura
CREATE TABLE IF NOT EXISTS `factura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_datos_facturacion` int(11) DEFAULT NULL COMMENT 'id de losndatos de facturacion',
  `id_recibo` int(11) DEFAULT NULL COMMENT 'id del recibo al cual se factura',
  `fecha_factura` datetime DEFAULT current_timestamp() COMMENT 'fecha en la que se crea la factura',
  `folio_factura` int(11) DEFAULT NULL COMMENT 'folio de la factura expendido por facturapi proveedor externo de timbrado',
  `uuid` varchar(50) DEFAULT NULL COMMENT 'folio fiscal de facturacion',
  `estatus` int(11) DEFAULT NULL COMMENT 'estatus en el que se encuentra la factura',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.factura: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.modulo
CREATE TABLE IF NOT EXISTS `modulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave_router` varchar(50) DEFAULT NULL,
  `modulo` varchar(50) DEFAULT NULL,
  `path` varchar(50) DEFAULT NULL,
  `is_modulo` int(11) DEFAULT NULL,
  `estatus` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.modulo: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` (`id`, `clave_router`, `modulo`, `path`, `is_modulo`, `estatus`, `created_at`, `updated_at`) VALUES
	(1, 'MODULO_CAJA', 'modulo de caja', 'caja', 1, 1, '2021-05-23 18:32:58', '2021-05-23 18:32:58'),
	(2, 'MODULO_USUARIOS', 'alta de usuarios', 'usuarios', 1, 1, '2021-05-23 18:33:27', '2021-05-30 23:42:02'),
	(3, 'MODULO_CONCEPTO', 'Catalogo de conceptos', 'conceptos', 1, 1, '2021-05-23 18:34:03', '2021-05-30 12:20:47'),
	(4, 'MODULO_COLABORADOR', 'Catalogo de colaboradores', 'colaboradores', 1, 1, '2021-05-23 18:35:30', '2021-05-30 12:21:57'),
	(5, 'MODULO_EJERCICIO_FISCAL', 'Catalogo ejercicio fiscal', 'ejercicio-fiscal', 1, 1, '2021-05-23 18:36:35', '2021-05-30 23:18:25'),
	(6, 'MODULO_PERFIL', 'Catalogo de perfiles', 'perfiles', 1, 1, '2021-05-30 19:31:39', '2021-05-30 19:31:39');
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.modulo_perfil
CREATE TABLE IF NOT EXISTS `modulo_perfil` (
  `id_perfil` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  UNIQUE KEY `Índice 1` (`id_perfil`,`id_modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.modulo_perfil: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `modulo_perfil` DISABLE KEYS */;
INSERT INTO `modulo_perfil` (`id_perfil`, `id_modulo`) VALUES
	(3, 1),
	(3, 2),
	(3, 3),
	(3, 4),
	(3, 5),
	(3, 6),
	(4, 1),
	(4, 2),
	(4, 3),
	(5, 1),
	(5, 2),
	(5, 3),
	(5, 4),
	(5, 5),
	(5, 6);
/*!40000 ALTER TABLE `modulo_perfil` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.pago
CREATE TABLE IF NOT EXISTS `pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_recibo` int(11) DEFAULT NULL COMMENT 'id del recibo al cual se paga o abona',
  `fecha_cobro` datetime DEFAULT current_timestamp() COMMENT 'fecha en cual se realizo el pago o abono',
  `cajero_cobro` int(11) DEFAULT NULL COMMENT 'persona que cobra es el cajero',
  `monto` double DEFAULT 1 COMMENT 'cantidad de dinero pagado o abonado',
  `estatus` int(11) DEFAULT NULL COMMENT 'estatus del pago',
  PRIMARY KEY (`id`),
  KEY `FK_pago_recibo` (`id_recibo`),
  CONSTRAINT `FK_pago_recibo` FOREIGN KEY (`id_recibo`) REFERENCES `recibo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.pago: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `pago` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estatus` bit(1) NOT NULL DEFAULT b'1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistema_cobro.perfil: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`id`, `perfil`, `descripcion`, `estatus`, `created_at`, `updated_at`) VALUES
	(3, 'ADMINISTRADOR', 'PERFIL DE ADMINISTRADOR', b'1', '2021-04-18 21:22:45', '2021-05-30 23:16:32'),
	(4, 'ADMINISTRADOR 22', 'ES EL PERFIL MAXIMO', b'0', '2021-05-09 20:16:08', '2021-05-30 23:11:52'),
	(5, 'ADMINISTRADOR', 'ES EL PERFIL MAXIMO', b'1', '2021-05-09 20:17:19', '2021-05-30 23:12:26'),
	(6, 'PERFIL DE PRUEBA', 'ES UN PERFIL PARA REALIZAR UNAS PRUEBAS', b'1', '2021-05-23 21:03:37', '2021-05-30 23:12:57'),
	(7, 'CAJERO', 'PERFIL QUE ADMINISTRARA EL MODULO DE CAJA', b'1', '2021-05-30 20:00:51', '2021-05-30 20:00:51');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.personas
CREATE TABLE IF NOT EXISTS `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `paterno` varchar(45) DEFAULT NULL,
  `materno` varchar(45) DEFAULT NULL,
  `genero` enum('Masculino','Femenino') DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistema_cobro.personas: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` (`id`, `nombre`, `paterno`, `materno`, `genero`, `fecha_nacimiento`, `created_at`, `updated_at`) VALUES
	(5, 'JOSE LEON', 'RODRIGUEZ', 'PIÑA', 'Masculino', '1989-03-11', '2021-05-16 15:00:12', '2021-05-16 15:00:12'),
	(6, 'JOSE LEON', 'RODRIGUEZ', 'PIÑA', 'Masculino', '1989-03-11', '2021-05-16 15:00:39', '2021-05-16 15:00:39'),
	(7, 'JOSE LEON', 'RODRIGUEZ', 'PIÑA', 'Masculino', NULL, '2021-05-16 15:06:35', '2021-05-16 15:11:26'),
	(9, 'JOSE LEON', 'RODRIGUEZ', 'PIÑA', 'Masculino', NULL, '2021-05-16 15:56:36', '2021-05-16 15:59:06'),
	(10, NULL, NULL, NULL, NULL, NULL, '2021-05-16 19:26:35', '2021-05-16 19:26:35'),
	(11, 'VICTOR HUGO', 'RODRIGUEZ', 'PIÑA', 'Masculino', '1997-05-08', '2021-05-30 19:26:16', '2021-05-30 19:26:16'),
	(12, 'VICTOR HUGO', 'RODRIGUEZ', 'PIÑA', 'Masculino', '1997-05-08', '2021-05-30 19:27:27', '2021-05-30 19:27:27'),
	(13, 'MARTHA ELENA', 'PISCINA', 'BARCENAS', 'Femenino', '1987-08-13', '2021-05-30 19:29:14', '2021-05-30 19:29:14');
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.recibo
CREATE TABLE IF NOT EXISTS `recibo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_contribuyente` int(11) DEFAULT NULL COMMENT 'persona aquien se le carga ',
  `folio` int(9) unsigned zerofill NOT NULL COMMENT 'folio del documento a crear',
  `cajero` int(11) DEFAULT NULL COMMENT 'persona que carga es el cajero',
  `fecha_creacion` datetime DEFAULT current_timestamp() COMMENT 'fecha que se crea el recibo',
  `estatus` int(11) DEFAULT 1 COMMENT 'estatus del recibo ',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `folio` (`folio`),
  KEY `FK_recibo_contribuyente` (`id_contribuyente`),
  KEY `FK_recibo_usuarios` (`cajero`),
  CONSTRAINT `FK_recibo_contribuyente` FOREIGN KEY (`id_contribuyente`) REFERENCES `contribuyente` (`id`),
  CONSTRAINT `FK_recibo_usuarios` FOREIGN KEY (`cajero`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_cobro.recibo: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `recibo` DISABLE KEYS */;
INSERT INTO `recibo` (`id`, `id_contribuyente`, `folio`, `cajero`, `fecha_creacion`, `estatus`, `created_at`, `updated_at`) VALUES
	(3, 1, 000000001, 4, '2021-05-16 22:27:49', 1, '2021-05-16 22:27:49', '2021-05-16 22:27:49'),
	(4, 1, 000000002, 4, '2021-05-16 22:37:50', 1, '2021-05-16 22:37:50', '2021-05-16 22:37:50');
/*!40000 ALTER TABLE `recibo` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_colaborador` int(11) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_usuarios_colaborador` (`id_colaborador`),
  KEY `FK_usuarios_perfil` (`id_perfil`),
  CONSTRAINT `FK_usuarios_colaborador` FOREIGN KEY (`id_colaborador`) REFERENCES `colaborador` (`id`),
  CONSTRAINT `FK_usuarios_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistema_cobro.usuarios: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `id_colaborador`, `id_perfil`, `username`, `password`, `estatus`, `created_at`, `updated_at`) VALUES
	(4, 1, 3, 'admin', 'admin', 1, '2021-04-18 21:22:15', '2021-05-23 18:38:07'),
	(5, 2, 5, 'admin2', 'admin2', 0, '2021-05-09 18:25:26', '2021-05-23 18:38:30'),
	(6, 3, 4, 'perfi', 'perfi', 0, '2021-05-09 18:26:09', '2021-05-23 18:38:23');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla sistema_cobro.usuario_modulo
CREATE TABLE IF NOT EXISTS `usuario_modulo` (
  `id_usuario` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  KEY `FK_usuario_modulo_usuarios` (`id_usuario`),
  KEY `FK_usuario_modulo_modulo` (`id_modulo`),
  CONSTRAINT `FK_usuario_modulo_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id`),
  CONSTRAINT `FK_usuario_modulo_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabla de union de usuarios y perfiles';

-- Volcando datos para la tabla sistema_cobro.usuario_modulo: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario_modulo` DISABLE KEYS */;
INSERT INTO `usuario_modulo` (`id_usuario`, `id_modulo`) VALUES
	(4, 1),
	(4, 2),
	(4, 3);
/*!40000 ALTER TABLE `usuario_modulo` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
