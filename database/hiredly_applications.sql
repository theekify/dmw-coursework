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
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `application_id` int NOT NULL AUTO_INCREMENT,
  `job_id` int DEFAULT NULL,
  `freelanid` int DEFAULT NULL,
  `applied_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `app_full_name` varchar(100) NOT NULL,
  `app_email` varchar(100) NOT NULL,
  `app_phone` varchar(20) NOT NULL,
  `app_address` varchar(255) NOT NULL,
  `app_linkedin_link` varchar(255) DEFAULT NULL,
  `app_github_link` varchar(255) DEFAULT NULL,
  `app_cv_file` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending',
  PRIMARY KEY (`application_id`),
  KEY `job_id` (`job_id`),
  KEY `freelanid` (`freelanid`),
  CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`),
  CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`freelanid`) REFERENCES `freelan` (`freelanid`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (26,1,1,'2025-02-01 06:02:57','','','','',NULL,NULL,NULL,'Pending'),(27,1,1,'2025-02-01 06:03:05','','','','',NULL,NULL,NULL,'Pending'),(28,2,1,'2025-02-01 06:03:39','','','','',NULL,NULL,NULL,'Pending'),(29,NULL,NULL,'2025-02-01 14:36:53','Theekshana Akalanka','hatheekshana@gmail.com','0715452412','152/E/1','','','uploads/relational.drawio.pdf','Pending'),(30,NULL,NULL,'2025-02-01 14:46:33','test','test@gmail.com','071352523525','2523gs','','','uploads/a4class.drawio.pdf','Pending'),(31,NULL,NULL,'2025-02-01 14:47:42','Theekshana Akalanka','hatheekshana@gmail.com','0715452412','152/E/1','','','uploads/Employee details.pdf','Pending'),(32,NULL,NULL,'2025-02-01 17:52:53','get','24ga@hdh.bn','21','qeq','','','uploads/CW.pdf','Pending'),(33,NULL,NULL,'2025-02-01 18:08:27','r','r@g.com','21','fw','','','uploads/Untitled Diagram.pdf','Pending'),(34,NULL,NULL,'2025-02-01 18:15:05','t23','42@asf','213','rrff','','','uploads/CW.pdf','Pending'),(35,NULL,NULL,'2025-02-01 18:19:04','e','w@ga.com','1231','4d1','','','uploads/relational.pdf','Pending'),(36,NULL,NULL,'2025-02-01 18:23:01','213','123@faw','312','31','','','uploads/CW.pdf','Pending'),(37,NULL,NULL,'2025-02-02 06:31:39','1','13@fa','12','f2','','','uploads/CW.pdf','Pending'),(38,NULL,NULL,'2025-02-02 07:57:06','kalhara','nigara@gmail.com','12321421412','balangoda nigga','','','uploads/Employee details.pdf','Pending'),(39,12,NULL,'2025-02-02 08:27:35','5235','twet@ges.lk','3124124','412g','','','uploads/CW.pdf','Accepted'),(40,1,NULL,'2025-02-02 09:14:18','tew','twe@eg.vr','t25','53','','','uploads/CW.pdf','Pending'),(41,1,NULL,'2025-02-02 09:14:54','tew','twe@eg.vr','t25','53','','','uploads/CW.pdf','Pending'),(42,1,NULL,'2025-02-02 09:14:57','tew','twe@eg.vr','t25','53','','','uploads/CW.pdf','Pending'),(43,8,NULL,'2025-02-02 09:19:06','rw','da@fh.kj','35235','waf3','','','uploads/CW.pdf','Pending'),(44,8,NULL,'2025-02-02 09:20:19','rw','da@fh.kj','35235','waf3','','','uploads/CW.pdf','Pending'),(45,11,NULL,'2025-02-02 09:21:50','23','4214@ge','te','rtw','','','uploads/CW.pdf','Pending'),(46,12,NULL,'2025-02-02 09:22:58','32','532tg@ge','ttew','35w','','','uploads/CW.pdf','Pending'),(48,12,NULL,'2025-02-02 09:29:22','231','r2@ge','525','41','','','uploads/CW.pdf','Pending');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
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
