CREATE DATABASE  IF NOT EXISTS `saberdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `saberdb`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 52.2.198.41    Database: sgc
-- ------------------------------------------------------
-- Server version	5.5.46

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
-- Table structure for table `competencia`
--

DROP TABLE IF EXISTS `competencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `competencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `competencia_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `nome` varchar(45) NOT NULL,
  `habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_competencia_competencia1_idx` (`competencia_id`),
  CONSTRAINT `fk_competencia_competencia1` FOREIGN KEY (`competencia_id`) REFERENCES `competencia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competencia`
--

LOCK TABLES `competencia` WRITE;
/*!40000 ALTER TABLE `competencia` DISABLE KEYS */;
INSERT INTO `competencia` VALUES 
	(1,NULL,10,15,'TI',1),
	(2,NULL,0,5,'Sap',1),
	(3,NULL,6,9,'RH',1),
	(4,1,11,12,'Word',1),
	(5,1,13,14,'Excel',1),
	(6,2,1,4,'Financial Accounting',1),
	(7,6,2,3,'Sales and Distribution',1),
	(8,NULL,16,17,'Facilities',1),
	(9,3,7,8,'Folha de pagamento',1),
	(10,NULL,18,19,'Logistica',1);
/*!40000 ALTER TABLE `competencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conhecimento`
--

DROP TABLE IF EXISTS `conhecimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conhecimento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profissional_id` int(11) NOT NULL,
  `competencia_id` int(11) NOT NULL,
  `nivel` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_conhecimentos_professores1_idx` (`profissional_id`),
  KEY `fk_conhecimentos_materias1_idx` (`competencia_id`),
  CONSTRAINT `fk_conhecimentos_materias1` FOREIGN KEY (`competencia_id`) REFERENCES `competencia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_conhecimentos_professores1` FOREIGN KEY (`profissional_id`) REFERENCES `profissional` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conhecimento`
--

LOCK TABLES `conhecimento` WRITE;
/*!40000 ALTER TABLE `conhecimento` DISABLE KEYS */;
INSERT INTO `conhecimento` VALUES (10,1,1,42),(11,1,2,51),(12,1,3,16),(13,1,4,13),(14,1,5,13),(15,10,5,25),(16,10,2,35),(17,10,3,68),(18,10,4,48),(19,10,7,51),(20,10,8,29),(21,1,7,11),(22,11,7,18),(23,11,9,44),(24,11,4,32),(25,11,5,28),(26,11,8,29),(27,12,10,0),(28,1,10,42),(29,13,7,61),(30,13,9,35),(31,13,4,41),(32,13,5,55),(33,13,8,82);
/*!40000 ALTER TABLE `conhecimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profissional`
--

DROP TABLE IF EXISTS `profissional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profissional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coordenador_id` int(11) DEFAULT NULL,
  `nome` varchar(45) NOT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_profissional_profisisonal1_idx` (`coordenador_id`),
  CONSTRAINT `fk_profissional_profisisonal1` FOREIGN KEY (`coordenador_id`) REFERENCES `profissional` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profissional`
--

LOCK TABLES `profissional` WRITE;
/*!40000 ALTER TABLE `profissional` DISABLE KEYS */;
INSERT INTO `profissional` VALUES 
	(1,10,'Joao','123123123','','joao@123.com',NULL,1),
	(10,NULL,'Paulo Coordenador','123','','paulo@coordenador.com.br',NULL,1),
	(11,11,'Vagner','','','vagner@teste.com',NULL,1),
	(12,NULL,'Welligton','','','wellington@teste.com',NULL,1),
	(13,1,'Adalberto','34234234234','2342423424324','adalberto@teste.com.br',NULL,1);
/*!40000 ALTER TABLE `profissional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

--
-- Dumping routines for database 'sgc'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-15 15:40:38
