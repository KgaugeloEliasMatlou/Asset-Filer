CREATE DATABASE  IF NOT EXISTS `assets_management_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `assets_management_db`;
-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: 192.168.1.71    Database: assets_management_db
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Assets`
--

DROP TABLE IF EXISTS `Assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Assets` (
  `a_id` int NOT NULL AUTO_INCREMENT,
  `a_name` varchar(100) NOT NULL,
  `a_model` varchar(100) NOT NULL,
  `a_uniquecode` varchar(100) NOT NULL,
  `a_category` varchar(100) NOT NULL,
  `a_cost` decimal(10,0) NOT NULL,
  `a_assignedto` varchar(100) NOT NULL,
  `a_status` varchar(100) NOT NULL,
  `a_company` varchar(100) NOT NULL,
  `a_sitefloor` varchar(100) NOT NULL,
  `a_vendor` varchar(100) NOT NULL,
  `a_datereceived` date NOT NULL,
  `a_dateissued` date NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Assets`
--

LOCK TABLES `Assets` WRITE;
/*!40000 ALTER TABLE `Assets` DISABLE KEYS */;
INSERT INTO `Assets` VALUES (33,'Thunder World Gaming Rack','THW-300','WGHT-HYUO-XCB','all in one computer',20000,'Jane Wayne','S','Sva Holdings','ground floor','Tech IV PCs','2023-07-18','2023-07-20'),(34,'Intel Nuc','Nuc12345','YPLJJHNS','computer box',10000,'Jane Wayne','A','Sva Holdings','ground floor','Tech IV PCs','2024-04-07','2024-04-08');
/*!40000 ALTER TABLE `Assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin101','$2y$10$LqZgTtU1bVpxho5m903FAeQrOptlGRBbQNin/Ww7xeuaDQbflMiYO','2023-07-04 15:23:25');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assets_status`
--

DROP TABLE IF EXISTS `assets_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assets_status` (
  `as_id` int NOT NULL AUTO_INCREMENT,
  `as_code` varchar(10) NOT NULL,
  `as_description` varchar(50) NOT NULL,
  PRIMARY KEY (`as_id`),
  UNIQUE KEY `as_id_UNIQUE` (`as_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assets_status`
--

LOCK TABLES `assets_status` WRITE;
/*!40000 ALTER TABLE `assets_status` DISABLE KEYS */;
INSERT INTO `assets_status` VALUES (1,'S','In Stock'),(2,'D','Damaged'),(3,'A','Assigned');
/*!40000 ALTER TABLE `assets_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `d_id` int NOT NULL AUTO_INCREMENT,
  `d_name` varchar(100) NOT NULL,
  `d_sitelocation` varchar(100) DEFAULT NULL,
  `d_sitefloor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `e_id` int NOT NULL AUTO_INCREMENT,
  `e_firstname` varchar(45) NOT NULL,
  `e_last_name` varchar(45) NOT NULL,
  `e_emp_number` varchar(15) NOT NULL,
  PRIMARY KEY (`e_id`),
  UNIQUE KEY `e_id_UNIQUE` (`e_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (8,'Jane','Wayne','E001'),(9,'Fairy','Tales','E202');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `positions` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `p_name` varchar(100) NOT NULL,
  `p_sitefloor` varchar(100) DEFAULT NULL,
  `p_sitelocation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_floors`
--

DROP TABLE IF EXISTS `site_floors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_floors` (
  `sf_id` int NOT NULL AUTO_INCREMENT,
  `sf_site_floor` varchar(50) NOT NULL,
  PRIMARY KEY (`sf_id`),
  UNIQUE KEY `sf_id_UNIQUE` (`sf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_floors`
--

LOCK TABLES `site_floors` WRITE;
/*!40000 ALTER TABLE `site_floors` DISABLE KEYS */;
INSERT INTO `site_floors` VALUES (1,'ground floor'),(2,'first floor'),(3,'second floor'),(4,'third floor'),(5,'fourth floor'),(6,'other floors'),(7,'second floor');
/*!40000 ALTER TABLE `site_floors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_locations`
--

DROP TABLE IF EXISTS `site_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_locations` (
  `sl_id` int NOT NULL AUTO_INCREMENT,
  `sl_name` varchar(100) NOT NULL,
  `sl_address` varchar(100) NOT NULL,
  PRIMARY KEY (`sl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_locations`
--

LOCK TABLES `site_locations` WRITE;
/*!40000 ALTER TABLE `site_locations` DISABLE KEYS */;
INSERT INTO `site_locations` VALUES (10,'Sva Holdings','14 Burke St');
/*!40000 ALTER TABLE `site_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'admin101','$2y$10$LqZgTtU1bVpxho5m903FAeQrOptlGRBbQNin/Ww7xeuaDQbflMiYO','2023-07-04 15:23:25'),(4,'JaneDoe','$2y$10$aTD0yAzirIJT.cMBmiccZ.dmwxTJ3wJ1xtYvZZnkW7IZXqg.UIN6a','2023-07-28 09:13:30'),(5,'frankocean','$2y$10$9BoOHr9J8wIOrSzjnYNMbOG06rxno.00y1443BItco3aKTletJ9W.','2023-08-04 11:25:34'),(6,'super_user','infoman','2024-08-04 11:25:34'),(7,'admin12345','$2y$10$HYTSK16./xS3xMKg1O3eouAf3J819IxXgXPRgAVHUnxAc29bc41dy','2024-04-09 12:47:52');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendor` (
  `v_id` int NOT NULL AUTO_INCREMENT,
  `v_name` varchar(50) NOT NULL,
  `v_contact` varchar(50) NOT NULL,
  `v_address` varchar(100) NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor`
--

LOCK TABLES `vendor` WRITE;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` VALUES (11,'Tech IV PCs','0947646473','13 Road,Downtown');
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'assets_management_db'
--

--
-- Dumping routines for database 'assets_management_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-09 12:55:29
