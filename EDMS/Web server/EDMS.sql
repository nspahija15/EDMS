CREATE DATABASE  IF NOT EXISTS `EDMS` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `EDMS`;
-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: EDMS
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
-- Table structure for table `discipline`
--

DROP TABLE IF EXISTS `discipline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discipline` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `discipline_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `birthday` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `phone_nr` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `fathersname` varchar(100) DEFAULT NULL,
  `fatherssurname` varchar(100) DEFAULT NULL,
  `fathersphone_nr` varchar(20) DEFAULT NULL,
  `mothersname` varchar(100) DEFAULT NULL,
  `motherssurname` varchar(100) DEFAULT NULL,
  `mothersphone_nr` varchar(20) DEFAULT NULL,
  `parent_marit_status` varchar(10) DEFAULT NULL,
  `isAccepted` tinyint(1) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dormApplication`
--

LOCK TABLES `dormApplication` WRITE;
/*!40000 ALTER TABLE `dormApplication` DISABLE KEYS */;
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
  `name` varchar(100) DEFAULT NULL,
  `amount` int(2) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorm_objects`
--

LOCK TABLES `dorm_objects` WRITE;
/*!40000 ALTER TABLE `dorm_objects` DISABLE KEYS */;
/*!40000 ALTER TABLE `dorm_objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dorm_support`
--

DROP TABLE IF EXISTS `dorm_support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dorm_support` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `assistant_id` int(11) DEFAULT NULL,
  `use_start_date` date DEFAULT NULL,
  `use_end_date` date DEFAULT NULL,
  `isApproved` tinyint(1) DEFAULT NULL,
  `isDelivered` tinyint(1) DEFAULT NULL,
  `descrition` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assistant_id` (`assistant_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `dorm_support_ibfk_1` FOREIGN KEY (`assistant_id`) REFERENCES `person` (`id`),
  CONSTRAINT `dorm_support_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorm_support`
--

LOCK TABLES `dorm_support` WRITE;
/*!40000 ALTER TABLE `dorm_support` DISABLE KEYS */;
/*!40000 ALTER TABLE `dorm_support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `date_p` date DEFAULT NULL,
  `academic_year` smallint(6) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `isProcessed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
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
  `student_id` int(11) NOT NULL,
  `assistant_id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `date_assigned` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `assistant_id` (`assistant_id`),
  CONSTRAINT `performances_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `person` (`id`),
  CONSTRAINT `performances_ibfk_2` FOREIGN KEY (`assistant_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `performances`
--

LOCK TABLES `performances` WRITE;
/*!40000 ALTER TABLE `performances` DISABLE KEYS */;
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
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  `nationality` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_nr` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fathersname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fatherssurname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fathersphone_nr` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mothersname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motherssurname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mothersphone_nr` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_marit_status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isAccepted` tinyint(1) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_34DCD176F85E0677` (`username`),
  UNIQUE KEY `UNIQ_34DCD1764ACC9A20` (`card_id`),
  UNIQUE KEY `UNIQ_34DCD176E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES (2,'Nail','Spahija','nspahija',234343423,'nspahija','nspahija@gmail.com','[\"ROLE_DIRECT\"]',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(3,'Kristian','Pashollari','KPashollari',879432598,'254663Kristian','kpashollari16@epoka.edu.al','[\"ROLE_ASSIST\"]',NULL,'2013-03-17',NULL,'56354633456',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL);
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `require_dorm_objects`
--

DROP TABLE IF EXISTS `require_dorm_objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `require_dorm_objects` (
  `dorm_support_id` smallint(6) NOT NULL,
  `dorm_objects_id` smallint(6) NOT NULL,
  PRIMARY KEY (`dorm_support_id`,`dorm_objects_id`),
  KEY `dorm_objects_id` (`dorm_objects_id`),
  CONSTRAINT `require_dorm_objects_ibfk_1` FOREIGN KEY (`dorm_support_id`) REFERENCES `dorm_support` (`id`),
  CONSTRAINT `require_dorm_objects_ibfk_2` FOREIGN KEY (`dorm_objects_id`) REFERENCES `dorm_objects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `is_confirmed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tech_problems`
--

LOCK TABLES `tech_problems` WRITE;
/*!40000 ALTER TABLE `tech_problems` DISABLE KEYS */;
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

-- Dump completed on 2018-05-03 11:08:59