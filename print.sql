/*
SQLyog Community v13.0.1 (64 bit)
MySQL - 10.1.34-MariaDB : Database - print
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`print` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `print`;

/*Table structure for table `detalle_pro` */

DROP TABLE IF EXISTS `detalle_pro`;

CREATE TABLE `detalle_pro` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `img_detalle` varchar(50) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `cantidad_min` int(11) DEFAULT NULL,
  `cantidad_max` int(11) DEFAULT NULL,
  `id_sub` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detalle`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `detalle_pro` */

insert  into `detalle_pro`(`id_detalle`,`img_detalle`,`precio`,`cantidad_min`,`cantidad_max`,`id_sub`) values 
(1,'4',4,4,4,2),
(2,'ssa',45,78,78,1);

/*Table structure for table `login_user` */

DROP TABLE IF EXISTS `login_user`;

CREATE TABLE `login_user` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_log` varchar(50) DEFAULT NULL,
  `password_log` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `login_user` */

insert  into `login_user`(`id_login`,`cargo_log`,`password_log`) values 
(1,'admin','4444'),
(2,'emp','4566');

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `img_pro` varchar(50) DEFAULT NULL,
  `nom_producto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `productos` */

insert  into `productos`(`id_producto`,`img_pro`,`nom_producto`) values 
(1,'dad','d'),
(2,'s','fs');

/*Table structure for table `sub_productos` */

DROP TABLE IF EXISTS `sub_productos`;

CREATE TABLE `sub_productos` (
  `id_sub` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sub`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `sub_productos` */

insert  into `sub_productos`(`id_sub`,`tipo`,`id_producto`) values 
(1,'asdassd',1),
(2,'iuoiuio',1);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido_p` varchar(50) DEFAULT NULL,
  `apellido_m` varchar(50) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id_user`,`nombre`,`apellido_p`,`apellido_m`,`fecha_nac`,`email`,`telefono`) values 
(2,'dsadasdasd','o','o','2019-10-12','otakufans2009@hotmail.com',78745);

/*Table structure for table `venta` */

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(2000) DEFAULT NULL,
  `fecha_pedido` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `observacion` varchar(500) DEFAULT NULL,
  `id_detalle` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `venta` */

insert  into `venta`(`id_venta`,`descripcion`,`fecha_pedido`,`fecha_entrega`,`observacion`,`id_detalle`,`id_user`) values 
(2,'ererÃ±','2019-10-12','2019-10-09','ds',1,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
