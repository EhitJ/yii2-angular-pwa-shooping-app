-- MySQL dump 10.13  Distrib 8.0.0-dmr, for Linux (x86_64)
--
-- Host: localhost    Database: admin
-- ------------------------------------------------------
-- Server version	8.0.0-dmr

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Test','1','2020-05-08 11:17:18'),(2,'TEst','0','2020-05-08 11:31:03');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` int(11) NOT NULL,
  `status` enum('1','2','3') NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `payment_type` (`payment_type`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,'2',1,'2020-05-09 10:46:58'),(2,1,'2',1,'2020-05-09 10:47:04'),(3,1,'2',1,'2020-05-09 10:48:00'),(4,1,'2',1,'2020-05-09 10:48:24'),(5,1,'2',1,'2020-05-09 10:58:55'),(6,1,'2',1,'2020-05-09 10:59:56'),(7,1,'2',1,'2020-05-09 11:02:22'),(8,1,'2',1,'2020-05-09 11:02:27'),(9,1,'2',1,'2020-05-09 11:03:15'),(10,1,'2',1,'2020-05-09 11:04:24'),(11,1,'2',1,'2020-05-09 11:05:11'),(12,1,'2',1,'2020-05-09 11:05:28'),(13,1,'2',1,'2020-05-09 11:05:43'),(14,1,'2',1,'2020-05-09 11:05:52'),(15,1,'2',1,'2020-05-09 11:07:00'),(16,1,'2',1,'2020-05-09 11:07:15'),(17,1,'2',1,'2020-05-09 11:07:18'),(18,1,'2',1,'2020-05-09 11:07:20'),(19,1,'2',1,'2020-05-09 12:28:32'),(20,1,'2',1,'2020-05-09 12:29:09'),(21,1,'2',1,'2020-05-09 12:29:09'),(22,1,'2',1,'2020-05-09 12:29:45'),(23,1,'2',1,'2020-05-09 12:29:46'),(24,1,'2',1,'2020-05-09 12:29:47'),(25,1,'2',1,'2020-05-09 12:30:01'),(26,1,'2',1,'2020-05-09 12:40:21'),(27,1,'2',1,'2020-05-09 12:47:32'),(28,1,'2',1,'2020-05-09 12:47:33'),(29,1,'2',1,'2020-05-09 12:57:38'),(30,1,'2',1,'2020-05-09 12:57:38'),(31,1,'2',1,'2020-05-09 13:00:52'),(32,1,'2',1,'2020-05-09 13:00:52'),(33,1,'2',1,'2020-05-09 13:00:52');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_details`
--

DROP TABLE IF EXISTS `orders_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `orders_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_details`
--

LOCK TABLES `orders_details` WRITE;
/*!40000 ALTER TABLE `orders_details` DISABLE KEYS */;
INSERT INTO `orders_details` VALUES (1,3,22.00,2,'2020-05-09 10:47:04'),(2,3,22.00,3,'2020-05-09 10:48:00'),(3,3,22.00,4,'2020-05-09 10:48:24'),(4,3,22.00,5,'2020-05-09 10:58:56'),(5,3,22.00,6,'2020-05-09 10:59:56'),(6,3,22.00,7,'2020-05-09 11:02:22'),(7,3,22.00,8,'2020-05-09 11:02:28'),(8,3,22.00,9,'2020-05-09 11:03:16'),(9,3,22.00,10,'2020-05-09 11:04:25'),(10,3,22.00,11,'2020-05-09 11:05:12'),(11,3,22.00,12,'2020-05-09 11:05:28'),(12,3,22.00,13,'2020-05-09 11:05:43'),(13,2,33.00,14,'2020-05-09 11:05:52'),(14,3,22.00,15,'2020-05-09 11:07:00'),(15,3,22.00,16,'2020-05-09 11:07:15'),(16,2,33.00,17,'2020-05-09 11:07:18'),(17,1,333.00,18,'2020-05-09 11:07:20'),(18,1,333.00,19,'2020-05-09 12:28:32'),(19,3,22.00,20,'2020-05-09 12:29:09'),(20,3,22.00,21,'2020-05-09 12:29:09'),(21,1,333.00,22,'2020-05-09 12:29:45'),(22,2,33.00,23,'2020-05-09 12:29:46'),(23,3,22.00,24,'2020-05-09 12:29:47'),(24,1,333.00,25,'2020-05-09 12:30:01'),(25,1,333.00,26,'2020-05-09 12:40:22'),(26,1,333.00,27,'2020-05-09 12:47:32'),(27,2,33.00,28,'2020-05-09 12:47:33'),(28,2,33.00,29,'2020-05-09 12:57:38'),(29,3,22.00,30,'2020-05-09 12:57:38'),(30,1,333.00,31,'2020-05-09 13:00:52'),(31,1,333.00,32,'2020-05-09 13:00:52'),(32,1,333.00,33,'2020-05-09 13:00:53');
/*!40000 ALTER TABLE `orders_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_mode`
--

DROP TABLE IF EXISTS `payment_mode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_mode`
--

LOCK TABLES `payment_mode` WRITE;
/*!40000 ALTER TABLE `payment_mode` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_mode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `cat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'dfg','sdf',333.00,'dsfds','1',1,'2020-05-08 11:46:02'),(2,'dfdsf','sdfsd',33.00,'','1',1,'2020-05-08 12:27:16'),(3,'sdfsd','sdfsd',22.00,'favicon-we_125221.png','1',1,'2020-05-08 12:45:53');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(200) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin@test.com','$2y$13$9e2pcGTeg5hs5xm.4qPdS.XR3ZdaoPOmxfcV2yyLpScXZOq1Wm8zC','0000000000','test addres',1),(3,'New User 1','user2@test.com','$2y$13$ANTeDJVCiyAMOlZjdhuUrujfsHSgBuAvGq9Ayg6DE8v24pJwTCeMW','9987118793','HOUSE NO 27, NEAR HANUMAN MANDIR',1),(4,'sdsdf','SHAILESH.PTMB@GMAIL.COM','$2y$13$AzpQyioHYMraG8nfZHaZJe2rsPsManbaS2wm93gtvpAqfw39RYETW','99871187931','HOUSE NO 27, NEAR HANUMAN MANDIR',1),(5,'afafs','SHAILESH.P1TMB@GMAIL.COM','$2y$13$.Bk4cd0wWUycVl1tsKOexOLFQ8trjM85NtdG0uBU97pbSWy/bLsUi','998711879322','HOUSE NO 27, NEAR HANUMAN MANDIR',1),(6,'sddsfsfdsf','test@test.com','$2y$13$42nUh3o8gCr9IStysXHcEO6aSfTm5xYSQ3cCDPjJMto5xBduGycq6','99871187934','sdfas',1);
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

-- Dump completed on 2020-05-09 13:10:10
