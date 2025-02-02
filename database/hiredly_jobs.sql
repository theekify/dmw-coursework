-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: hiredly
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `job_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `salary_min` decimal(10,2) NOT NULL,
  `salary_max` decimal(10,2) NOT NULL,
  `description` varchar(700) NOT NULL,
  `requirements` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `empid` int DEFAULT NULL,
  PRIMARY KEY (`job_id`),
  KEY `empid` (`empid`),
  CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `emp` (`empid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'Senior Web Developer','Tech Solutions Inc.','Remoteee',80000.00,120000.00,'We are looking for a Senior Web Developer to build and maintain web applications.','5+ years of experience, expertise in JavaScript, PHP, and React.','2025-02-01 05:52:44',NULL),(2,'UX Designer','Creative Designs Co.','New York, NY',70000.00,100000.00,'Join our team to create user-friendly designs and prototypes.','3+ years of experience, proficiency in Figma, Adobe XD, and UX research.','2025-02-01 05:52:44',NULL),(3,'Full Stack Developer','Innovative Apps LLC','San Francisco, CA',90000.00,130000.00,'We need a Full Stack Developer to work on cutting-edge web applications.','4+ years of experience, knowledge of Node.js, React, and databases.','2025-02-01 05:52:44',NULL),(4,'Backend Developer','Server Side Solutions','Austin, TX',75000.00,110000.00,'Responsible for developing and maintaining backend APIs and databases.','3+ years of experience, expertise in PHP, MySQL, and cloud services.','2025-02-01 05:52:44',NULL),(5,'Data Analyst','Data Insights Ltd.','Boston, MA',65000.00,95000.00,'Analyze data trends and provide business insights.','2+ years of experience, knowledge of SQL, Python, and Tableau.','2025-02-01 05:52:44',NULL),(6,'Mobile App Developer','App Creators Inc.','Seattle, WA',85000.00,115000.00,'Develop and maintain mobile applications for iOS and Android.','3+ years of experience, proficiency in Flutter or React Native.','2025-02-01 05:52:44',NULL),(8,'test','test','test',1.00,11.00,'test','test','2025-02-01 16:10:34',NULL),(11,'tst','tst','s',2.00,4.00,'st','stw','2025-02-02 06:28:12',7),(12,'Certified nigga ','niga','africa',1.00,2.00,'cotton picking ','BLACK!!!!!!','2025-02-02 07:54:52',8);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-02 16:38:12
