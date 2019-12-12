
-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: foodie
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `foodie`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `foodie` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `foodie`;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `postId` binary(16) NOT NULL,
  `postTruckId` binary(16) DEFAULT NULL,
  `postUserId` binary(16) DEFAULT NULL,
  `postContent` varchar(144) DEFAULT NULL,
  `postDatetime` datetime(6) NOT NULL,
  PRIMARY KEY (`postId`),
  KEY `postTruckId` (`postTruckId`),
  KEY `postUserId` (`postUserId`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`postTruckId`) REFERENCES `truck` (`truckId`),
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`postUserId`) REFERENCES `user` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (_binary ')\�E5a\�N��·�p\��',_binary '\�߂�pFp��!\�n\�\��',_binary '��\�\"JEM\��x\�ݰ#�','This a third post for a food truck','2019-12-10 23:09:49.273929'),(_binary '<�P\�+�@ܔ�T;�D\�n',_binary '�Vd�<~K��\�`�\��?+',_binary '\�\�\"��@J��\\��\�\�','This is a post for a food truck','2019-12-10 23:09:49.272674'),(_binary '^KE�\�Fv�	�Ɉ\�R',_binary '\�\�\�wt+J��\�D\�Ck�h',_binary 'z�\�\�hG3�n�\��','This another post for a food truck','2019-12-10 23:09:49.273317'),(_binary '� �^׸MՌ�Ⱥ�\Zj',_binary '�Vd�<~K��\�`�\��?+',_binary '\�\�\"��@J��\\��\�\�','This is a post for  food truck 4','2019-12-10 23:09:49.274896'),(_binary '\���E�H���\��[ ql',_binary '�Vd�<~K��\�`�\��?+',_binary '\�\�\"��@J��\\��\�\�','This is a post for  food truck 5','2019-12-10 23:09:49.275450');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `truck`
--

DROP TABLE IF EXISTS `truck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `truck` (
  `truckId` binary(16) NOT NULL,
  `truckUserId` binary(16) NOT NULL,
  `truckAvatarUrl` varchar(255) DEFAULT NULL,
  `truckEmail` varchar(128) NOT NULL,
  `truckFoodType` varchar(50) NOT NULL,
  `truckMenuUrl` varchar(255) DEFAULT NULL,
  `truckName` varchar(144) DEFAULT NULL,
  `truckPhoneNumber` varchar(32) DEFAULT NULL,
  `truckVerifyImage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`truckId`),
  KEY `truckUserId` (`truckUserId`),
  CONSTRAINT `truck_ibfk_1` FOREIGN KEY (`truckUserId`) REFERENCES `user` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `truck`
--

LOCK TABLES `truck` WRITE;
/*!40000 ALTER TABLE `truck` DISABLE KEYS */;
INSERT INTO `truck` VALUES (_binary '\���7F��\�3�\�\��',_binary '\�\�\"��@J��\\��\�\�','https://s3-media0.fl.yelpcdn.com/bphoto/b0sUtPQa7Ne3vT6eVVKjaQ/o.jpg','leonela.naguti+8@gmail.com','Comfort Food','https://s3-media0.fl.yelpcdn.com/bphoto/_BR6u8RBYopIeWedZUIgQw/o.jpg','With Love Waffles Food Truck','505.933.0424',''),(_binary 'l2\�G�\�Im�ܰE`H�{',_binary '\�\�\"��@J��\\��\�\�','https://s3-media0.fl.yelpcdn.com/bphoto/z5r4JTsLk-Ib_C2A-_4d6w/o.jpg','leonela.naguti+9@gmail.com','Mexican','https://www.google.com/maps/uv?hl=en&pb=!1s0x872212b9cc4cafbf:0x91635cd3e370f456!3m1!7e115!4shttps://lh5.googleusercontent.com/p/AF1QipN7HALcl7Yr3IbY3TaPO4Rv2Vm8HJFquUtECq8s%3Dw130-h87-n-k-no!5sfood+trucks+in+albuquerque+new+mexico','Taco Locos grill','505.918.0964',''),(_binary '\�\�\�wt+J��\�D\�Ck�h',_binary 'z�\�\�hG3�n�\��','https://s3-media0.fl.yelpcdn.com/bphoto/jRMk8IwrTxC92VIO0fpK7g/o.jpg','leonela.naguti+3@gmail.com','Mexican','https://s3-media0.fl.yelpcdn.com/bphoto/3gX7YZxFBqlYG-JT6k96mw/o.jpg','Taco Bus','(505) 301-7512',''),(_binary '\�߂�pFp��!\�n\�\��',_binary '��\�\"JEM\��x\�ݰ#�','http://box5352.temp.domains/~diadelo2/wp-content/uploads/2019/04/DDLT-LogoR.jpg','leonela.naguti+1@gmail.com','Mexican','https://s3-media0.fl.yelpcdn.com/bphoto/BQZUZ_hKFvaNhnHVOXgVYQ/o.jpg','Dia De Los Takos','(505) 550-8540',''),(_binary '�Vd�<~K��\�`�\��?+',_binary '\�\�\"��@J��\\��\�\�','https://s3-media0.fl.yelpcdn.com/bphoto/dz9pL1Hk1fOL9sNJYNPMlg/o.jpg','leonela.naguti+4@gmail.com','Comfort Food','https://www.ilovesupper.com/menu','The Supper Truck','505.796.2181','');
/*!40000 ALTER TABLE `truck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userId` binary(16) NOT NULL,
  `userActivationToken` char(32) DEFAULT NULL,
  `userAvatarUrl` varchar(255) DEFAULT NULL,
  `userEmail` varchar(128) NOT NULL,
  `userHash` char(97) NOT NULL,
  `userName` varchar(16) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userEmail` (`userEmail`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (_binary 'C\\Q�R�IB���R\��\�\\',NULL,'https://www.google.com/maps/uv?hl=en&pb=!1s0x872212b9cc4cafbf:0x91635cd3e370f456!3m1!7e115!4shttps://lh5.googleusercontent.com','leonela.naguti+9@gmail.com','$argon2i$v=19$m=1024,t=384,p=2$SFh5bG5YUGFKSUVMdHE3Wg$J39g/7kMXMKR8TQo0baiTSGWCESSZeKrEY+fkJ0hSLw','Papa Joe Daddieo'),(_binary 'z�\�\�hG3�n�\��',NULL,'https://s3-media0.fl.yelpcdn.com/bphoto/UANJrdAtpwF8b1ygAPNrAA/o.jpg','leonela.naguti+3@gmail.com','$argon2i$v=19$m=1024,t=384,p=2$SFh5bG5YUGFKSUVMdHE3Wg$J39g/7kMXMKR8TQo0baiTSGWCESSZeKrEY+fkJ0hSLw','Bobby McGee'),(_binary '���e�\�H����J�o�\Z',NULL,'https://unsplash.com/photos/ozKgHSxluxQ','leonela.naguti+8@gmail.com','$argon2i$v=19$m=1024,t=384,p=2$SFh5bG5YUGFKSUVMdHE3Wg$J39g/7kMXMKR8TQo0baiTSGWCESSZeKrEY+fkJ0hSLw','Sweet pea'),(_binary '\�\�\"��@J��\\��\�\�',NULL,'https://static.wixstatic.com/media/2462fd_0d26898bbf88def0a5de05dee979da49.jpg/v1/fill/w_549,h_348,al_c,q_90,usm_0.66_1.00_0.01/2462fd_0d26898bbf88def0a5de05dee979da49.webp','leonela.naguti+4@gmail.com','$argon2i$v=19$m=1024,t=384,p=2$SFh5bG5YUGFKSUVMdHE3Wg$J39g/7kMXMKR8TQo0baiTSGWCESSZeKrEY+fkJ0hSLw','Kristen Galegor'),(_binary '��\�\"JEM\��x\�ݰ#�',NULL,'http://box5352.temp.domains/~diadelo2/wp-content/uploads/2019/04/takos-229.jpg','leonela.naguti+2@gmail.com','$argon2i$v=19$m=1024,t=384,p=2$SFh5bG5YUGFKSUVMdHE3Wg$J39g/7kMXMKR8TQo0baiTSGWCESSZeKrEY+fkJ0hSLw','Cheff Domonic');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-11 17:15:35
