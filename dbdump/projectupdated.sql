-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: project
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Table structure for table `adminlogin`
--

DROP TABLE IF EXISTS `adminlogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adminlogin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminlogin`
--

LOCK TABLES `adminlogin` WRITE;
/*!40000 ALTER TABLE `adminlogin` DISABLE KEYS */;
INSERT INTO `adminlogin` VALUES ('Admin','12345');
/*!40000 ALTER TABLE `adminlogin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categories` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (3,'BUSINESS & MANAGEMENT',1),(2,'ENERGY MANAGEMENT',1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `overview` longtext NOT NULL,
  `audience_limit` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `price` float NOT NULL,
  `dates` date NOT NULL,
  `dates2` varchar(45) NOT NULL,
  `dates3` varchar(45) NOT NULL,
  `dates4` varchar(45) NOT NULL,
  `instructor_name` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL,
  `filename` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,3,'veshantineizzz','test','test1',5,2,140,'2020-10-31','2020-10-11','2020-10-12','2020-10-13','veshantinei','Approve',''),(2,3,'veshantinei1','test','test2',6,2,56,'2020-10-30','','','','veshantinei','Reject',''),(3,3,'veshantinei2','test3','test4',5,2,45,'2020-10-30','','','','veshantinei','Approve',''),(5,3,'no','test3','test4',5,2,450,'2020-10-30','','','','veshantinei','Approve',''),(6,3,'veshantineizzzz','test','test1',5,2,140,'2020-10-31','','','','veshantinei','Approve',''),(7,3,'tatatauuuuu','sdafgbxvbddsa','fdasdfsdgsfdgsfd',243,55,12323,'2020-11-02','2020-10-31','2020-11-17','2020-11-20','veshantinei','Approve',''),(8,3,'fdfsdafad','asdafgcvbv','fdshertyewreqw',123,3434,123,'2020-11-11','2020-11-01','2020-11-02','2020-11-19','veshantinei','Approve',''),(9,2,'tyrtrewtfsg','csvdfgsrftgwerfew','dasfshretgerw',1234,1234123,142334,'2020-11-11','2020-11-04','2020-10-31','2020-10-28','veshantinei','Approve','tccgvb.pdf');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enquiry_us`
--

DROP TABLE IF EXISTS `enquiry_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enquiry_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(155) NOT NULL,
  `phone` int(20) NOT NULL,
  `enquiry` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enquiry_us`
--

LOCK TABLES `enquiry_us` WRITE;
/*!40000 ALTER TABLE `enquiry_us` DISABLE KEYS */;
INSERT INTO `enquiry_us` VALUES (1,'NESENTHIRAN JEGABADUR','nishajeg27@gmail.com',2147483647,'test'),(2,'a','b',111,'d');
/*!40000 ALTER TABLE `enquiry_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor`
--

DROP TABLE IF EXISTS `instructor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructor` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `icnum` varchar(12) NOT NULL,
  `phonenum` varchar(13) NOT NULL,
  `verification_id` int(11) NOT NULL,
  `verification` int(1) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor`
--

LOCK TABLES `instructor` WRITE;
/*!40000 ALTER TABLE `instructor` DISABLE KEYS */;
INSERT INTO `instructor` VALUES (1,'veshantinei','vesha2797@gmail.com','vesha','3213456789','0987654321',453063267,1,''),(2,'Nishanthini','nishajeg27@gmail.com','nisha1','33455565','0987654321',461233588,1,'');
/*!40000 ALTER TABLE `instructor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice` (
  `idinvoice` int(11) NOT NULL AUTO_INCREMENT,
  `userID` varchar(45) DEFAULT NULL,
  `item` varchar(45) DEFAULT NULL,
  `quantity` varchar(45) DEFAULT NULL,
  `totalprice` varchar(45) DEFAULT NULL,
  `unitprice` varchar(45) DEFAULT NULL,
  `dates` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idinvoice`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (1,'5','veshantineizzz','13','1820',NULL,NULL);
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `EnquiryID` int(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `PhoneNo` int(20) DEFAULT NULL,
  `EnquiryContent` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`EnquiryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_front`
--

DROP TABLE IF EXISTS `users_front`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_front` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `icnum` varchar(12) NOT NULL,
  `phonenum` varchar(13) NOT NULL,
  `invoiceid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_front`
--

LOCK TABLES `users_front` WRITE;
/*!40000 ALTER TABLE `users_front` DISABLE KEYS */;
INSERT INTO `users_front` VALUES (5,'zzz','farhan','1234','zzzz','zzzz',NULL),(6,'zzzzzz','zzzzzz','zzzzz','zzzz','zzzzz',NULL),(7,'dsdsads','adsadsasadsad','dsadasd','dsadsadsa','asdsadasd',NULL),(8,'dsadas','dsadasd','sadasd','dasdasd','dsadsa',NULL),(9,'dsadasd','sadsadsdsa','sdsadsad','dasdsa','dasd',NULL),(10,'','','','','',NULL),(11,'dsadsa','dsadsad','sadsadasdsadas','dsadsadsa','sadsadsa',NULL),(12,'dsadsa','dsadsadas','sadsadsa','sadsadsad','dsadsadsd',NULL),(13,'sadasdsa','dsadsads','adsadsad','sadsadsads','adsadsad',NULL),(14,'sadsadsa','dasds','xcvxcvxc','vxcvcvxcv','vxcvvbx',NULL),(15,'czvxvbv','bvcbvcbcv','vbvcb','vcb','bvcbvcb',NULL);
/*!40000 ALTER TABLE `users_front` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-08 16:05:02
