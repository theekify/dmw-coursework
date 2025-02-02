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
-- Table structure for table `freelan`
--

DROP TABLE IF EXISTS `freelan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `freelan` (
  `freelanid` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`freelanid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freelan`
--

LOCK TABLES `freelan` WRITE;
/*!40000 ALTER TABLE `freelan` DISABLE KEYS */;
INSERT INTO `freelan` VALUES (1,'John Doe','1234567890','johndoe@example.com','password123','2025-02-01 11:31:43'),(2,'testf','242342352','testf@gmail.com','12345678','2025-02-01 23:21:51'),(3,'testf','242342352','testfr@gmail.com','12345678','2025-02-01 23:22:15'),(4,'ken','123','ken@ken.com','123123123123','2025-02-01 23:37:57'),(5,'travis','121','travis@la.com','laflame69','2025-02-01 23:44:48'),(6,'lone','11','lone@des.com','loneeeeeee','2025-02-01 23:48:39'),(7,'testttt','131','niga@niga.com','123456789','2025-02-01 23:51:57'),(8,'testttt','131','niga2@niga.com','21312313123123','2025-02-01 23:52:39'),(9,'yew','242','yyy@gmail.com','123121323243','2025-02-02 13:24:07'),(10,'52','25','geshgh@ge.luy','24153634743','2025-02-02 14:31:00'),(11,'hrhehe','heheh','hehz@hes.gj','21655rtfsvdg','2025-02-02 14:43:57'),(12,'43634','43634','t3tg@ge.lk','525edggh23456yyu','2025-02-02 14:52:43'),(13,'wtwt','tewtwt','hrtw3@hdh.kl','253etrfghtyr43','2025-02-02 14:58:17');
/*!40000 ALTER TABLE `freelan` ENABLE KEYS */;
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
