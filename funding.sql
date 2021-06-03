-- MariaDB dump 10.19  Distrib 10.5.9-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: funding_pdo
-- ------------------------------------------------------
-- Server version	10.5.9-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `funders`
--

DROP TABLE IF EXISTS `funders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(900) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `deadline` varchar(200) NOT NULL,
  `details` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funders`
--

LOCK TABLES `funders` WRITE;
/*!40000 ALTER TABLE `funders` DISABLE KEYS */;
INSERT INTO `funders` VALUES (1,'Lloyds Bank Foundation','Small and local charities helping people dealing with complex social issues','up to £45,000 and £100,000','Rolling','https://lloydsbankfoundation.org.uk'),(2,'Weavers’ Company Benevolent Fund','Smaller charities providing direct services to young offenders, ex-offenders and disadvantaged young people','up to £15,000 (one-year grants)','Friday 19 November 2021, midday','https://weavers.org.uk/charity/charitable-grants'),(3,'Equality and Diversity Community Fund LBBD','Local charities and community groups for equality and diversity events in Barking & Dagenham','up to £500','Application windows quarterly, next deadline: 30 June','https://lbbd.gov.uk/equality-and-diversity-community-fund'),(4,'Esmee Fairbairn Collections Fund','Museums, galleries and heritage organisations for 2-year projects delivering collections engagement and social impact','up to £90,000','Application rounds twice a year, next deadline: 13 September','https://museumsassociation.org/funding/esmee-fairbairn-collections-fund'),(5,'Garfield Weston Foundation','Wide range of causes and charities: arts, community, education, environment, faith, health, museums and heritage, youth ','Various according to charity size and work being undertaken','Rolling','https://garfieldweston.org'),(6,'Screwfix Foundation','National and local charity projects to fix, repair, maintain and improve properties and community facilities','up to £5,000','Quarterly: March, June, September and December','https://screwfix.com/help/screwfixfoundation'),(7,'Wakeham Trust','Very small projects, groups of people getting together to make a difference in their communities','£125 to £2,500','Rolling','https://thewakehamtrust.org/');
/*!40000 ALTER TABLE `funders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'funding_pdo'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-03 16:41:46
