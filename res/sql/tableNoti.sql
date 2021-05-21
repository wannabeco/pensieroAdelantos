/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.4.14-MariaDB : Database - kerrodal
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kerrodal` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `kerrodal`;

/*Table structure for table `app_noti` */

DROP TABLE IF EXISTS `app_noti`;

CREATE TABLE `app_noti` (
  `idNoti` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `idPersona` bigint(20) DEFAULT NULL,
  `tipoUsuario` enum('movil','escritorio') DEFAULT 'movil',
  `tipo` varchar(20) DEFAULT 'mensaje',
  `titulo` text DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `estado` int(11) DEFAULT 0,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`idNoti`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;



-- me dice si ya la adenda esta pagada
ALTER TABLE app_empleados ADD COLUMN `cupo` INT DEFAULT 250000 AFTER `cargo`;

ALTER TABLE app_empleados ADD COLUMN `cupoDisp` INT DEFAULT 250000 AFTER `cupo`;
-- inserto una variable global
INSERT INTO `app_variablesglobales` (variable,valor) VALUES('_CUPO_EMPLEADOS','250000');

