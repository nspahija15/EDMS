CREATE DATABASE  IF NOT EXISTS `EDMS` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `EDMS`;
-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: EDMS
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

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
-- Table structure for table `academic_year`
--

DROP TABLE IF EXISTS `academic_year`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `academic_year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `academic_year`
--

LOCK TABLES `academic_year` WRITE;
/*!40000 ALTER TABLE `academic_year` DISABLE KEYS */;
INSERT INTO `academic_year` VALUES (1,'2018-2018','Winter','2018-05-05','2018-09-11');
/*!40000 ALTER TABLE `academic_year` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discipline`
--

DROP TABLE IF EXISTS `discipline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discipline` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75BEEE3FCB944F1A` (`student_id`),
  CONSTRAINT `FK_75BEEE3FCB944F1A` FOREIGN KEY (`student_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discipline`
--

LOCK TABLES `discipline` WRITE;
/*!40000 ALTER TABLE `discipline` DISABLE KEYS */;
/*!40000 ALTER TABLE `discipline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dormApplication`
--

DROP TABLE IF EXISTS `dormApplication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dormApplication` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `academic_year_id` int(11) DEFAULT NULL,
  `card_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_nr` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fathersname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fatherssurname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fathersphone_nr` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fathers_job` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mothersname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motherssurname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mothersphone_nr` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mothers_job` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_marit_status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isAccepted` tinyint(1) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E0CD5F6B4ACC9A20` (`card_id`),
  KEY `IDX_E0CD5F6BC54F3401` (`academic_year_id`),
  CONSTRAINT `FK_E0CD5F6BC54F3401` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_year` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dormApplication`
--

LOCK TABLES `dormApplication` WRITE;
/*!40000 ALTER TABLE `dormApplication` DISABLE KEYS */;
INSERT INTO `dormApplication` VALUES (1,1,2142341,'asdfa','jkalfdhsjfas','sjhdvlskfdhgld','1992-07-07','ajkfhsdlkah','98328437','lasfkhlsdkfhdljsk','alasdfasdisi15@epoka.edu.al','adsklfhsldfakh','alkdfhalskdfh','aksjflsfalhs','398739742','lkhjdlfasdhkjfh','aslkfjshdl','lkafjhsldkfh','332432423','afdkjhalskdfhla','Married',1,'4e567ada08b3c341e19fadd94123ac09.jpeg','applicant'),(2,1,34563646,'sdgdfh','dfghdfg','dfh','1997-09-10','dfghdfgh','34563456346','dfghfhdfhh','sdfgsdf@hotmail.com','dfghdfhdfh','dfghdfh','dfhfgh','456457457','dfghdfghdfh','hjgfj','fghjh','457','gfjfh','Married',0,'f6b5ff20b05256d07828e336fe8a3778.jpeg','applicant');
/*!40000 ALTER TABLE `dormApplication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dorm_objects`
--

DROP TABLE IF EXISTS `dorm_objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dorm_objects` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorm_objects`
--

LOCK TABLES `dorm_objects` WRITE;
/*!40000 ALTER TABLE `dorm_objects` DISABLE KEYS */;
/*!40000 ALTER TABLE `dorm_objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dorm_objects_supported`
--

DROP TABLE IF EXISTS `dorm_objects_supported`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dorm_objects_supported` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `support_id` smallint(6) DEFAULT NULL,
  `supp_dorm_objects_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2ED1E44C315B405` (`support_id`),
  KEY `IDX_2ED1E44CFFE9C347` (`supp_dorm_objects_id`),
  CONSTRAINT `FK_2ED1E44C315B405` FOREIGN KEY (`support_id`) REFERENCES `dorm_support` (`id`),
  CONSTRAINT `FK_2ED1E44CFFE9C347` FOREIGN KEY (`supp_dorm_objects_id`) REFERENCES `dorm_objects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorm_objects_supported`
--

LOCK TABLES `dorm_objects_supported` WRITE;
/*!40000 ALTER TABLE `dorm_objects_supported` DISABLE KEYS */;
/*!40000 ALTER TABLE `dorm_objects_supported` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dorm_support`
--

DROP TABLE IF EXISTS `dorm_support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dorm_support` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `assistant_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `use_start_date` date DEFAULT NULL,
  `use_end_date` date DEFAULT NULL,
  `isApproved` tinyint(1) DEFAULT NULL,
  `isDelivered` tinyint(1) DEFAULT NULL,
  `descrition` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5D531501E05387EF` (`assistant_id`),
  KEY `IDX_5D531501CB944F1A` (`student_id`),
  CONSTRAINT `FK_5D531501CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `person` (`id`),
  CONSTRAINT `FK_5D531501E05387EF` FOREIGN KEY (`assistant_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorm_support`
--

LOCK TABLES `dorm_support` WRITE;
/*!40000 ALTER TABLE `dorm_support` DISABLE KEYS */;
/*!40000 ALTER TABLE `dorm_support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_participants`
--

DROP TABLE IF EXISTS `event_participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participating_stud_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `is_participating` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9C7A7A61C4362572` (`participating_stud_id`),
  KEY `IDX_9C7A7A6171F7E88B` (`event_id`),
  CONSTRAINT `FK_9C7A7A6171F7E88B` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  CONSTRAINT `FK_9C7A7A61C4362572` FOREIGN KEY (`participating_stud_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_participants`
--

LOCK TABLES `event_participants` WRITE;
/*!40000 ALTER TABLE `event_participants` DISABLE KEYS */;
INSERT INTO `event_participants` VALUES (1,1,1,0),(2,2,1,0),(3,3,1,1),(4,4,1,0),(5,5,1,0),(6,6,1,0);
/*!40000 ALTER TABLE `event_participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_manager_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5387574A20D0ED4C` (`event_manager_id`),
  CONSTRAINT `FK_5387574A20D0ED4C` FOREIGN KEY (`event_manager_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,2,'Maklube','2018-06-29 00:00:00','Epoka Dormitory',1);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `academic_year_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `date_p` date DEFAULT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isProcessed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_65D29B32C54F3401` (`academic_year_id`),
  KEY `IDX_65D29B32CB944F1A` (`student_id`),
  CONSTRAINT `FK_65D29B32C54F3401` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_year` (`id`),
  CONSTRAINT `FK_65D29B32CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (5,1,1,'2014-02-14','sdfg','sdfg','345','sdfgsdfg',1),(6,1,3,'2019-09-15','afsadfasdf','dfssdgdfgfg','200','cash',1);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `performances`
--

DROP TABLE IF EXISTS `performances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `performances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `assistant_id` int(11) DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_assigned` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8133AB2BCB944F1A` (`student_id`),
  KEY `IDX_8133AB2BE05387EF` (`assistant_id`),
  CONSTRAINT `FK_8133AB2BCB944F1A` FOREIGN KEY (`student_id`) REFERENCES `person` (`id`),
  CONSTRAINT `FK_8133AB2BE05387EF` FOREIGN KEY (`assistant_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `performances`
--

LOCK TABLES `performances` WRITE;
/*!40000 ALTER TABLE `performances` DISABLE KEYS */;
INSERT INTO `performances` VALUES (1,3,2,NULL,'problem1 ','2018-06-07'),(2,6,2,NULL,'problem 2','2019-06-12'),(3,3,2,NULL,'problem 4','2018-06-24'),(4,6,2,NULL,'problem 3','2018-06-29');
/*!40000 ALTER TABLE `performances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `academic_year_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` json NOT NULL COMMENT '(DC2Type:json_array)',
  `type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_nr` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fathersname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fatherssurname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fathersphone_nr` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fathers_job` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mothersname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motherssurname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mothersphone_nr` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mothers_job` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_marit_status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isAccepted` tinyint(1) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exist_on_server` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_34DCD176F85E0677` (`username`),
  UNIQUE KEY `UNIQ_34DCD1764ACC9A20` (`card_id`),
  UNIQUE KEY `UNIQ_34DCD176E7927C74` (`email`),
  KEY `IDX_34DCD176C54F3401` (`academic_year_id`),
  CONSTRAINT `FK_34DCD176C54F3401` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_year` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES (1,1,'Director','Director','director',42543254,'director','nspahija@dsafsdf','[\"ROLE_DIRECT\"]','director',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,0),(2,1,'Assistant','Assistant','assistant',18188,'assistant','t@sjajj','[\"ROLE_ASSIST\"]','assistant','Albania','1991-03-06','Shkoder','727717','Nowhere','Cen',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,0),(3,1,'Student1','Student1','student',2324343,'student','alasdfasdisi15@epoka.edu.al','[\"ROLE_STUDENT\"]','student','shqipee','1992-07-07','ajkfhsdlkah','98328437','lasfkhlsdkfhdljsk','adsklfhsldfakh','alkdfhalskdfh','aksjflsfalhs','398739742','lkhjdlfasdhkjfh','aslkfjshdl','lkafjhsldkfh','332432423','afdkjhalskdfhla','Married',1,'4e567ada08b3c341e19fadd94123ac09.jpeg',0),(4,1,'Finance','Finance','finance',322323,'finance','finance@epoka.edu.al','[\"ROLE_FINANCE\"]','finance','sjhdvlskfdhgld','1992-07-07','ajkfhsdlkah','98328437','lasfkhlsdkfhdljsk','adsklfhsldfakh','alkdfhalskdfh','aksjflsfalhs','398739742','lkhjdlfasdhkjfh','aslkfjshdl','lkafjhsldkfh','332432423','afdkjhalskdfhla','Married',1,'4e567ada08b3c341e19fadd94123ac09.jpeg',0),(5,1,'Tech','Tech','tech',54653,'tech','technique@epoka.edu.al','[\"ROLE_TECH\"]','tech','sjhdvlskfdhgld','1992-07-07','ajkfhsdlkah','98328437','lasfkhlsdkfhdljsk','adsklfhsldfakh','alkdfhalskdfh','aksjflsfalhs','398739742','lkhjdlfasdhkjfh','aslkfjshdl','lkafjhsldkfh','332432423','afdkjhalskdfhla','Married',1,'4e567ada08b3c341e19fadd94123ac09.jpeg',0),(6,1,'Student2','Student2','student2',34564,'student2','student2@epoka.edu.al','[\"ROLE_STUDENT\"]','student','sjhdvlskfdhgld','1992-07-07','ajkfhsdlkah','98328437','lasfkhlsdkfhdljsk','adsklfhsldfakh','alkdfhalskdfh','aksjflsfalhs','398739742','lkhjdlfasdhkjfh','aslkfjshdl','lkafjhsldkfh','332432423','afdkjhalskdfhla','Married',1,'4e567ada08b3c341e19fadd94123ac09.jpeg',0);
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `require_dorm_objects`
--

DROP TABLE IF EXISTS `require_dorm_objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `require_dorm_objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requiring_student_id` int(11) DEFAULT NULL,
  `dorm_objects_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9103BEB5EA136403` (`requiring_student_id`),
  KEY `IDX_9103BEB5EAAF9436` (`dorm_objects_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `require_dorm_objects`
--

LOCK TABLES `require_dorm_objects` WRITE;
/*!40000 ALTER TABLE `require_dorm_objects` DISABLE KEYS */;
/*!40000 ALTER TABLE `require_dorm_objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tech_problems`
--

DROP TABLE IF EXISTS `tech_problems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tech_problems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_confirmed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tech_problems`
--

LOCK TABLES `tech_problems` WRITE;
/*!40000 ALTER TABLE `tech_problems` DISABLE KEYS */;
INSERT INTO `tech_problems` VALUES (1,'Door e Prishme','Esht prisht dera . Kam ngel brenda helppp','Kati pare 101','fixed',0),(2,'Door','Plase take into consideration','2nd floor study hall','fixed',0),(3,'Dera 103','Me eshte prishur dera. Kam ngel brenda. Helpppp','Kati pare Dhoma 103','pending',0);
/*!40000 ALTER TABLE `tech_problems` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-08 11:18:48
