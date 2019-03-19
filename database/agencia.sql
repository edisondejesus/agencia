-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for agencia
CREATE DATABASE IF NOT EXISTS `agencia` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `agencia`;

-- Dumping structure for table agencia.agencia
CREATE TABLE IF NOT EXISTS `agencia` (
  `id_agencia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_agencia` varchar(100) DEFAULT NULL,
  `pagina_web` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefono` varchar(200) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_agencia`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table agencia.agencia: ~2 rows (approximately)
/*!40000 ALTER TABLE `agencia` DISABLE KEYS */;
INSERT INTO `agencia` (`id_agencia`, `nombre_agencia`, `pagina_web`, `email`, `telefono`, `direccion`) VALUES
	(6, 'Laravels20s', 'www.laravel.com', 'edisondja@hotmail.com', '8096093310', 'jacobo  majluta azar, Santo Domingo'),
	(11, 'GoroTecasss', 'www.meteoroS.com', 'edisondja@gmail.com', '8096093310', 'Residencial antonia, manoguayabo, santo domingo Oeste, Caova, Calle 4ta'),
	(12, 'Goro Ninja 2019', 'goroninga.com', 'goroninja.com.do', '809-560-211', 'Santo Domingo, Caova');
/*!40000 ALTER TABLE `agencia` ENABLE KEYS */;

-- Dumping structure for table agencia.locacion
CREATE TABLE IF NOT EXISTS `locacion` (
  `locacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_locacion` varchar(200) DEFAULT NULL,
  `pagina_web` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `telefono` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`locacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table agencia.locacion: ~3 rows (approximately)
/*!40000 ALTER TABLE `locacion` DISABLE KEYS */;
INSERT INTO `locacion` (`locacion_id`, `nombre_locacion`, `pagina_web`, `email`, `direccion`, `telefono`) VALUES
	(2, 'Barba', 'edisondja@gmail.com', 'edisondja@gmail.com', 'Residencial antonia, manoguayabo, santo domingo Oeste, Caova', '809655'),
	(3, 'TR', 'goroperra@gmail.com', 'REW', 'RWER', '84165416'),
	(5, 'Punta Cana', 'www.puntacana.com', 'puntacana@hotmail.com', 'Santo Domingo, Caova', NULL),
	(6, 'F556', 'www.planetarios.com', 'puntacana@hotmail.com', 'eweqweqw', NULL),
	(7, 'Ripio', 'www.ripio.com', 'elementos.com', 'Santo Domingo, Caova', NULL),
	(8, 'Pedro Martines', 'www.pedromartines.com', 'edisondja@gmail.com', 'Residencial antonia, manoguayabo, santo domingo Oeste, Caova, Calle 4ta', '8096093310');
/*!40000 ALTER TABLE `locacion` ENABLE KEYS */;

-- Dumping structure for table agencia.reservacion
CREATE TABLE IF NOT EXISTS `reservacion` (
  `reservacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(200) DEFAULT NULL,
  `nombre_pax` varchar(200) DEFAULT NULL,
  `no_pax` int(3) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_servicio` date DEFAULT NULL,
  `vuelo` varchar(200) DEFAULT NULL,
  `hora_servicio` int(11) DEFAULT NULL,
  `servicio_id` int(11) DEFAULT NULL,
  `locacion_id` int(11) DEFAULT NULL,
  `id_agencia` int(11) DEFAULT NULL,
  `comentarios` text,
  PRIMARY KEY (`reservacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table agencia.reservacion: ~9 rows (approximately)
/*!40000 ALTER TABLE `reservacion` DISABLE KEYS */;
INSERT INTO `reservacion` (`reservacion_id`, `referencia`, `nombre_pax`, `no_pax`, `fecha_creacion`, `fecha_servicio`, `vuelo`, `hora_servicio`, `servicio_id`, `locacion_id`, `id_agencia`, `comentarios`) VALUES
	(1, '456', 'Limon', 532, NULL, '2019-11-02', '45q', 5, 21, NULL, 4, 'very good'),
	(2, 'dadasd', 'dsa', 0, NULL, '0000-00-00', 'ddsadas', 0, 21, NULL, 4, 'dasdd'),
	(3, 'dadasd', 'dsa', 0, NULL, '0000-00-00', 'ddsadas', 0, 21, 1, 4, 'dasdd'),
	(4, '456', 'David cabreras', 123, NULL, '2019-12-10', 'asd68', 9, 21, 1, 4, 'Preparado'),
	(11, '495', 'David cabreras', 468, NULL, '2019-09-10', 'S568', 9, 23, 2, 11, 'Vuelo estable'),
	(12, '1235', 'Rafael x3', 245, NULL, '2019-03-20', 's59', 9, 23, 2, 12, 'vuelo epic'),
	(13, '1239', 'Jerry x3', 280, NULL, '2019-03-21', 's59', 9, 22, 5, 12, 'vuelo epic disponible'),
	(14, '1239', 'Fela x3', 288, NULL, '2019-03-22', 's591', 9, 23, 3, 12, 'vuelo epic disponibles'),
	(15, '516', 'Jefray', 23, NULL, '2019-03-19', 's656', 9, 22, 3, 11, 'very'),
	(16, '516s', 'James Jhonson', 234, NULL, '2019-03-20', 's655', 9, 23, 5, 6, 'verys'),
	(17, '621', 'Lenin Jose', 235, NULL, '2019-03-21', 's659', 9, 22, 3, 12, 'verys good'),
	(18, '166', 'F60', 32, NULL, '2019-03-22', 's56', 9, 22, 3, 11, 'ultra'),
	(19, '166S', 'Elias', 323, NULL, '2019-03-23', 's56s', 10, 23, 2, 12, 'Berry'),
	(20, '156', 'Electron48', 235, NULL, '0000-00-00', 's56', 5, 22, 3, 6, 'ewe'),
	(21, '5163', 'Element', 56, NULL, '2019-03-23', 'ds5', 5, 23, 3, 11, 'ewe');
/*!40000 ALTER TABLE `reservacion` ENABLE KEYS */;

-- Dumping structure for table agencia.servicios
CREATE TABLE IF NOT EXISTS `servicios` (
  `servicio_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_servicio` varchar(200) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`servicio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table agencia.servicios: ~1 rows (approximately)
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` (`servicio_id`, `nombre_servicio`, `description`) VALUES
	(22, 'Express Fire', 'Estados unidos'),
	(23, 'Magneto', 'x516');
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;

-- Dumping structure for table agencia.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(200) DEFAULT NULL,
  `clave` varchar(200) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table agencia.usuario: ~0 rows (approximately)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id_usuario`, `usuario`, `clave`, `fecha_creacion`, `nombre`, `apellido`) VALUES
	(1, 'Pedro', 'pedroasd', '2019-03-19', 'Pedro', 'Guzman');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
