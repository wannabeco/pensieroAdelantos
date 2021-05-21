/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.1.31-MariaDB : Database - kerrodal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `app_detalle_pedido` */

DROP TABLE IF EXISTS `app_detalle_pedido`;

CREATE TABLE `app_detalle_pedido` (
  `idDetalle` bigint(20) NOT NULL AUTO_INCREMENT,
  `idPedido` bigint(20) DEFAULT NULL,
  `idProducto` bigint(20) DEFAULT NULL,
  `idPresentacion` bigint(20) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `direccion` text,
  `persona` text,
  `telefono` text,
  `texto` text,
  `idPersona` bigint(20) DEFAULT NULL,
  `fechaSolicitud` date DEFAULT NULL,
  `horaSolicitud` time DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `lat` text,
  `lon` text,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`idDetalle`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `app_detalle_pedido` */

LOCK TABLES `app_detalle_pedido` WRITE;

insert  into `app_detalle_pedido`(`idDetalle`,`idPedido`,`idProducto`,`idPresentacion`,`cantidad`,`direccion`,`persona`,`telefono`,`texto`,`idPersona`,`fechaSolicitud`,`horaSolicitud`,`ip`,`lat`,`lon`,`estado`) values (1,1,1,1,2,NULL,NULL,NULL,NULL,2,'2021-05-12','15:42:46',NULL,NULL,NULL,1),(2,1,1,2,4,NULL,NULL,NULL,NULL,2,'2021-05-21','13:40:44',NULL,NULL,NULL,1),(3,1,1,2,2,NULL,NULL,NULL,NULL,2,'2021-05-21','13:59:54',NULL,NULL,NULL,1),(4,2,1,1,3,NULL,NULL,NULL,NULL,2,'2021-05-21','14:05:14',NULL,NULL,NULL,1);

UNLOCK TABLES;

/*Table structure for table `app_estado_pedido` */

DROP TABLE IF EXISTS `app_estado_pedido`;

CREATE TABLE `app_estado_pedido` (
  `idEstadoPedido` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreEstadoPedido` text,
  `label` varchar(20) NOT NULL,
  PRIMARY KEY (`idEstadoPedido`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `app_estado_pedido` */

LOCK TABLES `app_estado_pedido` WRITE;

insert  into `app_estado_pedido`(`idEstadoPedido`,`nombreEstadoPedido`,`label`) values (2,'Pendiente','label-default'),(4,'Despachado','label-info'),(5,'Cancelado','label-danger'),(6,'En trámite','label-warning');

UNLOCK TABLES;

/*Table structure for table `app_pedido_temporal` */

DROP TABLE IF EXISTS `app_pedido_temporal`;

CREATE TABLE `app_pedido_temporal` (
  `idPedidoTemp` bigint(20) NOT NULL AUTO_INCREMENT,
  `idProducto` bigint(20) NOT NULL,
  `idPresentacion` bigint(20) NOT NULL,
  `idVariacion` bigint(20) DEFAULT NULL,
  `proveedor` text,
  `idPersona` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `identificador` int(11) NOT NULL,
  `idTienda` bigint(20) DEFAULT NULL,
  `valor` double(15,2) NOT NULL,
  `eliminado` int(11) DEFAULT '0',
  PRIMARY KEY (`idPedidoTemp`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `app_pedido_temporal` */

LOCK TABLES `app_pedido_temporal` WRITE;

UNLOCK TABLES;

/*Table structure for table `app_pedidos` */

DROP TABLE IF EXISTS `app_pedidos`;

CREATE TABLE `app_pedidos` (
  `idPedido` bigint(20) NOT NULL AUTO_INCREMENT,
  `fechaPedido` datetime DEFAULT NULL,
  `mesPedido` int(11) DEFAULT NULL,
  `anoPedido` int(11) DEFAULT NULL,
  `idPersona` bigint(20) DEFAULT NULL,
  `pedidoPara` bigint(20) NOT NULL DEFAULT '0',
  `pedidoPadre` bigint(20) NOT NULL DEFAULT '0',
  `idCiudad` bigint(20) NOT NULL,
  `direccion` text NOT NULL,
  `personaContacto` text NOT NULL,
  `telefono` text NOT NULL,
  `observacion` text NOT NULL,
  `ip` text,
  `lat` text,
  `lon` text,
  `estadoPedido` int(11) DEFAULT '2',
  `cobrado` int(11) DEFAULT '0',
  `formaPago` int(11) DEFAULT '1',
  `estadoPago` varchar(3) NOT NULL DEFAULT '000',
  `transactionId` text NOT NULL,
  `reference_pol` text NOT NULL,
  `valor` double(15,2) NOT NULL,
  `valorDomicilio` double(15,2) DEFAULT '0.00',
  `moneda` varchar(10) NOT NULL,
  `entidad` text NOT NULL,
  `codigoPedido` text NOT NULL,
  `fechaPago` datetime NOT NULL,
  `fechaEntrega` datetime NOT NULL,
  PRIMARY KEY (`idPedido`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `app_pedidos` */

LOCK TABLES `app_pedidos` WRITE;

insert  into `app_pedidos`(`idPedido`,`fechaPedido`,`mesPedido`,`anoPedido`,`idPersona`,`pedidoPara`,`pedidoPadre`,`idCiudad`,`direccion`,`personaContacto`,`telefono`,`observacion`,`ip`,`lat`,`lon`,`estadoPedido`,`cobrado`,`formaPago`,`estadoPago`,`transactionId`,`reference_pol`,`valor`,`valorDomicilio`,`moneda`,`entidad`,`codigoPedido`,`fechaPago`,`fechaEntrega`) values (1,'2021-05-21 13:59:54',5,2021,2,0,0,0,'','','','',NULL,NULL,NULL,2,0,1,'000','','',100000.00,0.00,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'2021-05-21 14:05:14',5,2021,2,0,0,0,'','','','',NULL,NULL,NULL,2,0,1,'000','','',150000.00,0.00,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
