/*
SQLyog Enterprise - MySQL GUI v8.02 RC
MySQL - 5.5.5-10.4.21-MariaDB : Database - garage
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`garage` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `garage`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id`,`email`,`password`) values (1,'admin@gmail.com','fe01ce2a7fbac8fafaed7c982a04e229');

/*Table structure for table `bookings` */

DROP TABLE IF EXISTS `bookings`;

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `booking_type` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `mechanic_id` int(11) DEFAULT 0,
  `cost` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_bookings` (`vehicle_id`),
  KEY `FK_bookings_2` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Data for the table `bookings` */

insert  into `bookings`(`id`,`booking_id`,`user_id`,`vehicle_id`,`booking_type`,`description`,`booking_date`,`status`,`mechanic_id`,`cost`,`timestamp`) values (25,5343271,32324,4746455,1,'wesdfsdfsdfsdf','2022-01-27',1,0,NULL,'2022-01-19 22:57:58');

/*Table structure for table `mechanic` */

DROP TABLE IF EXISTS `mechanic`;

CREATE TABLE `mechanic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mechanic_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `mechanic` */

insert  into `mechanic`(`id`,`mechanic_id`,`name`,`email`,`phone`,`address`) values (1,1,'Conor','conor@gmail.com','1111111111','sdfsdsdfsd'),(2,2,'Patrick','patrick@gmail.com','222222222','sdfsdfdsf'),(3,3,'Darragh','darragh@gmail.com','233333333','sfdfsdfdsf'),(4,4,'Rian','rian@gmail.com','344444444','fsdfsdf'),(5,5,'Oscar','oscar@gmail.com','555555555','dfgdffds');

/*Table structure for table `parts` */

DROP TABLE IF EXISTS `parts`;

CREATE TABLE `parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cost` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_parts` (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

/*Data for the table `parts` */

insert  into `parts`(`id`,`part_id`,`booking_id`,`name`,`cost`) values (57,1101309,345435,'BATTERY TRAY','1.99'),(58,3186355,345435,'BELL HOUSING-CLUTCH','19.99'),(59,1267842,345435,'BELT TENSIONER W/BRACKET','13.99'),(60,6714721,353443,'BED LINER','43.99'),(61,1153981,353443,'BELT TENSIONER W/BRACKET','13.99');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`user_id`,`name`,`password`,`email`,`phone`,`address`) values (1,32324,'Guilherme Stach','81dc9bdb52d04dc20036dbd8313ed055','stach@gmail.com','1234567890','sdfasfdfsdfewf'),(43,1425397,'test','81dc9bdb52d04dc20036dbd8313ed055','test@gmail.com','4584654','sdcfdsafsdf'),(44,1100837,'test stach','81dc9bdb52d04dc20036dbd8313ed055','test@gmail.com','145695656','dfsfcsdfcsdfcsdf');

/*Table structure for table `vehicle` */

DROP TABLE IF EXISTS `vehicle`;

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT '',
  `make` varchar(255) DEFAULT '',
  `licence_details` varchar(255) DEFAULT '',
  `engine_type` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vehicle` */

insert  into `vehicle`(`id`,`vehicle_id`,`user_id`,`type`,`make`,`licence_details`,`engine_type`) values (28,4746455,32324,'Small Van','Daewoo','efssdfdsf','Petrol');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
