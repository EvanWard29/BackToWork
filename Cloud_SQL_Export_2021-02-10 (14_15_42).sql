-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: mysql
-- ------------------------------------------------------
-- Server version	5.7.25-google-log

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
-- Current Database: `FamilyPlanner`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `FamilyPlanner` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `FamilyPlanner`;

--
-- Table structure for table `assigned_chore`
--

DROP TABLE IF EXISTS `assigned_chore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assigned_chore` (
  `userChoreID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `choreID` int(11) NOT NULL,
  `familyID` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`userChoreID`),
  KEY `user_chore_idx` (`userID`),
  KEY `chore_user_idx` (`choreID`),
  KEY `user_family_idx` (`familyID`),
  CONSTRAINT `chore_user` FOREIGN KEY (`choreID`) REFERENCES `chore` (`choreID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_chore` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_family` FOREIGN KEY (`familyID`) REFERENCES `family` (`familyID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assigned_chore`
--

LOCK TABLES `assigned_chore` WRITE;
/*!40000 ALTER TABLE `assigned_chore` DISABLE KEYS */;
INSERT INTO `assigned_chore` VALUES (1,1,3,1,'INCOMPLETE'),(2,2,6,2,'COMPLETE'),(3,3,2,1,'COMPLETE');
/*!40000 ALTER TABLE `assigned_chore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chore`
--

DROP TABLE IF EXISTS `chore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chore` (
  `choreID` int(11) NOT NULL AUTO_INCREMENT,
  `choreName` varchar(45) NOT NULL,
  `choreDescription` varchar(45) NOT NULL,
  PRIMARY KEY (`choreID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chore`
--

LOCK TABLES `chore` WRITE;
/*!40000 ALTER TABLE `chore` DISABLE KEYS */;
INSERT INTO `chore` VALUES (1,'Dishes','Wash the dishes'),(2,'Washing','Put a wash on'),(3,'Vacuum','Vacuum the floor'),(4,'Dusting','Dust the cuboards'),(5,'Drying','Put washing on the line'),(6,'Tidy Livingroom','Tidy up the livingroom'),(7,'Tidy Kitchen','Tidy up the kitchen'),(8,'Clean Fish Tank','Empty and clean the fish tank');
/*!40000 ALTER TABLE `chore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `family`
--

DROP TABLE IF EXISTS `family`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `family` (
  `familyID` int(11) NOT NULL AUTO_INCREMENT,
  `familyName` varchar(45) NOT NULL,
  `numMembers` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`familyID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `family`
--

LOCK TABLES `family` WRITE;
/*!40000 ALTER TABLE `family` DISABLE KEYS */;
INSERT INTO `family` VALUES (1,'Ward','9'),(2,'Booton','4');
/*!40000 ALTER TABLE `family` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `points` int(11) NOT NULL,
  `familyID` int(11) NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `familyID_idx` (`familyID`),
  CONSTRAINT `familyID` FOREIGN KEY (`familyID`) REFERENCES `family` (`familyID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Evan','Ward','Evan29Ward@gmail.com','password',7,1),(2,'Callum','Booton','Callum08Booton@gmail.com','password',3,2),(3,'Emilie','Ward','Emilie18Ward@gmail.com','password',11,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `feedback`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `feedback` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `feedback`;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `MYUSER` varchar(30) NOT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `WEBPAGE` varchar(100) NOT NULL,
  `DATUM` date NOT NULL,
  `SUMMARY` varchar(40) NOT NULL,
  `COMMENTS` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'lars','myemail@gmail.com','https://www.vogella.com/','2009-09-14','Summary','My first comment');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-10 14:15:58
