/*
SQLyog Community v12.2.5 (64 bit)
MySQL - 5.7.11 : Database - test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`test` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `test`;

/*Table structure for table `clima` */

DROP TABLE IF EXISTS `clima`;

CREATE TABLE `clima` (
  `idcaso` int(11) DEFAULT NULL,
  `general` varchar(10) DEFAULT NULL,
  `temperatura` varchar(10) DEFAULT NULL,
  `humedad` varchar(10) DEFAULT NULL,
  `viento` varchar(2) DEFAULT NULL,
  `clase` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `clima` */

insert  into `clima`(`idcaso`,`general`,`temperatura`,`humedad`,`viento`,`clase`) values 
(1,'asoleado','caliente','alta','no','N'),
(2,'asoleado','caliente','alta','si','N'),
(3,'nublado','caliente','alta','no','P'),
(4,'lluvioso','templada','alta','no','P'),
(5,'lluvioso','fria','normal','no','P'),
(6,'lluvioso','fria','normal','si','N'),
(7,'nublado','fria','normal','si','P'),
(8,'asoleado','templada','alta','no','N'),
(9,'asoleado','fria','normal','no','P'),
(10,'lluvioso','templada','normal','no','P'),
(11,'asoleado','templada','normal','si','P'),
(12,'nublado','templada','alta','si','P'),
(13,'nublado','caliente','normal','no','P'),
(14,'lluvioso','templada','alta','si','N');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
