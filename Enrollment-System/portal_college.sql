-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: portal_college
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `applicant`
--

DROP TABLE IF EXISTS `applicant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applicant` (
  `applicant_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `Date_of_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`applicant_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applicant`
--

LOCK TABLES `applicant` WRITE;
/*!40000 ALTER TABLE `applicant` DISABLE KEYS */;
INSERT INTO `applicant` VALUES (1,'Wuer Shaw Yao','wuershawyao19@gmail.com','wuer123','Tacloban City','2003-07-19','Male','','Economics','Rejected'),(3,'Shaw Jie Yao','shawjieyao@yahoo.com','shawjie123','Tacloban City','2002-09-12','Male','','Pending','Pending'),(6,'Juan dela Cruz','cruz123@gmail.com','cruz123','Tacloban','1999-09-19','Male','','Economics','Pending');
/*!40000 ALTER TABLE `applicant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applicant_info`
--

DROP TABLE IF EXISTS `applicant_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applicant_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `language_score` int DEFAULT NULL,
  `science_score` int DEFAULT NULL,
  `math_score` int DEFAULT NULL,
  `reading_score` int DEFAULT NULL,
  `chosen_program` varchar(255) NOT NULL,
  `grades_path` varchar(255) DEFAULT NULL,
  `program_requirement_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applicant_info`
--

LOCK TABLES `applicant_info` WRITE;
/*!40000 ALTER TABLE `applicant_info` DISABLE KEYS */;
INSERT INTO `applicant_info` VALUES (1,'Wuer Shaw Yao','wuershawyao19@gmail.com',90,100,100,100,'Economics','uploads/Report Card Grade 12 (1st Semester) 2021.pdf','uploads/Good Moral Character 2021.pdf'),(2,'Shaw Jie Yao','shawjieyao@yahoo.com',80,80,90,90,'Economics','uploads/Report Card Grade 12 (1st Semester) 2021.pdf','uploads/Good Moral Character 2021.pdf');
/*!40000 ALTER TABLE `applicant_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programcoordinator`
--

DROP TABLE IF EXISTS `programcoordinator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `programcoordinator` (
  `programcoordinator_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `Date_of_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `program` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`programcoordinator_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programcoordinator`
--

LOCK TABLES `programcoordinator` WRITE;
/*!40000 ALTER TABLE `programcoordinator` DISABLE KEYS */;
INSERT INTO `programcoordinator` VALUES (3,'Diana Thea Ticao','dianaticao@gmail.com','diana123','Tacloban City','1992-09-05','Female','','Economics'),(6,'Jackie Chan','chan123@gmail.com','chan123','Tacloban','2000-09-19','Male','','Computer Science');
/*!40000 ALTER TABLE `programcoordinator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `programs` (
  `program_id` int NOT NULL AUTO_INCREMENT,
  `program` varchar(255) NOT NULL,
  `program_requirements` varchar(9999) NOT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programs`
--

LOCK TABLES `programs` WRITE;
/*!40000 ALTER TABLE `programs` DISABLE KEYS */;
INSERT INTO `programs` VALUES (1,'Economics','GMC - Good Moral Characters'),(12,'Management','Certificates of Completion of Work Immersion');
/*!40000 ALTER TABLE `programs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-06 20:37:05
