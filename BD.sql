-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: domicilios
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
-- Table structure for table `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ciudades` (
  `codCiudad` int NOT NULL AUTO_INCREMENT,
  `codParroquia` int DEFAULT NULL,
  `nombreCiudad` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`codCiudad`),
  KEY `codParroquia` (`codParroquia`),
  CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`codParroquia`) REFERENCES `parroquias` (`codParroquia`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudades`
--

LOCK TABLES `ciudades` WRITE;
/*!40000 ALTER TABLE `ciudades` DISABLE KEYS */;
INSERT INTO `ciudades` VALUES (1,1,'Ciudad La Plaza de Paraguachí'),(2,1,'Ciudad El Cardón'),(3,1,'Ciudad El Salado'),(4,2,'Ciudad La Asunción'),(5,2,'Ciudad Atamo'),(6,2,'Ciudad Atamo Sur.'),(7,3,'Ciudad San Juan Bautista'),(8,3,'Ciudad Boquerón'),(9,3,'Ciudad El Macho'),(10,4,'Ciudad Zabala'),(11,4,'Ciudad El Hatico'),(12,4,'Ciudad El Dátil.'),(13,5,'Ciudad El Valle del Espíritu Santo'),(14,6,'Ciudad La Asuncion'),(15,6,'Ciudad La Sierra'),(16,7,'Ciudad El Maco'),(17,7,'Ciudad La Guardia'),(18,7,'Ciudad Altagracia'),(19,8,'Ciudad Tacarigua'),(20,8,'Ciudad Pedro González'),(21,8,'Ciudad El Cercado.'),(22,9,'Ciudad Santa Ana'),(23,9,'Ciudad El Cercado'),(24,9,'Ciudad El Maco'),(25,10,'Ciudad Los Robles'),(26,11,'Ciudad Maneiro'),(27,11,'Ciudad Pampatar'),(28,12,'Ciudad Juan Griego'),(29,12,'Ciudad Pedregales'),(30,12,'Ciudad Las Cabreras'),(31,12,'Ciudad Los Millanes'),(32,13,'Ciudad Porlamar'),(33,13,'Ciudad Bella Vista.'),(34,14,'Ciudad Boca de Río'),(35,14,'Ciudad El Junquito'),(36,15,'Ciudad El Maguey'),(37,16,'Ciudad Punta de Piedras'),(38,16,'Ciudad Punta Arena'),(39,16,'Ciudad La Blanquilla'),(40,17,'Ciudad El Guamache'),(41,17,'Ciudad Punta de Mangle'),(42,17,'Ciudad Los Barales'),(43,18,'Ciudad San Pedro de Coche'),(44,18,'Ciudad Las Lapas'),(45,18,'Ciudad El Rincón'),(46,19,'Ciudad Güinima'),(47,19,'Ciudad Guamache'),(48,19,'Ciudad Zulica');
/*!40000 ALTER TABLE `ciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estados` (
  `codEstado` int NOT NULL AUTO_INCREMENT,
  `codPais` int DEFAULT NULL,
  `nombreEstado` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`codEstado`),
  KEY `codPais` (`codPais`),
  CONSTRAINT `estados_ibfk_1` FOREIGN KEY (`codPais`) REFERENCES `paises` (`codPais`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES (1,1,'Nueva Esparta');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipios`
--

DROP TABLE IF EXISTS `municipios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `municipios` (
  `codMunicipio` int NOT NULL AUTO_INCREMENT,
  `codEstado` int DEFAULT NULL,
  `nombreMunicipio` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`codMunicipio`),
  KEY `municipios_ibfk_1` (`codEstado`),
  CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`codEstado`) REFERENCES `estados` (`codEstado`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipios`
--

LOCK TABLES `municipios` WRITE;
/*!40000 ALTER TABLE `municipios` DISABLE KEYS */;
INSERT INTO `municipios` VALUES (1,1,'Municipio Antolín del Campo'),(2,1,'Municipio Arismendi'),(3,1,'Municipio Díaz'),(4,1,'Municipio García'),(5,1,'Municipio Gómez'),(6,1,'Municipio Maneiro'),(7,1,'Municipio Marcano'),(8,1,'Municipio Mariño'),(9,1,'Municipio Península de Macanao'),(10,1,'Municipio Tubores'),(11,1,'Municipio Villalba');
/*!40000 ALTER TABLE `municipios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paises` (
  `codPais` int NOT NULL AUTO_INCREMENT,
  `estatus` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT 'Inactivo',
  `nombrePais` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`codPais`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` VALUES (1,'Activo','Venezuela');
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parroquias`
--

DROP TABLE IF EXISTS `parroquias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parroquias` (
  `codParroquia` int NOT NULL AUTO_INCREMENT,
  `codMunicipio` int DEFAULT NULL,
  `nombreParroquia` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`codParroquia`),
  KEY `codMunicipio` (`codMunicipio`),
  CONSTRAINT `parroquias_ibfk_1` FOREIGN KEY (`codMunicipio`) REFERENCES `municipios` (`codMunicipio`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parroquias`
--

LOCK TABLES `parroquias` WRITE;
/*!40000 ALTER TABLE `parroquias` DISABLE KEYS */;
INSERT INTO `parroquias` VALUES (1,1,'Parroquia Antolín del Campo'),(2,2,'Parroquia Arismendi'),(3,3,'Parroquia San Juan Bautista'),(4,3,'Parroquia Zabala'),(5,4,'Parroquia García'),(6,4,'Parroquia Francisco Fajardo'),(7,5,'Parroquia Sucre'),(8,5,'Parroquia Matasiete'),(9,5,'Parroquia Bolívar'),(10,6,'Parroquia Aguirre'),(11,6,'Parroquia Maneiro'),(12,7,'Parroquia Juan Griego'),(13,8,'Parroquia Mariño'),(14,9,'Parroquia Boca de Río'),(15,9,'Parroquia San Francisco de Macanao'),(16,10,'Parroquia Punta de Piedras'),(17,10,'Parroquia Los Barales'),(18,11,'Parroquia San Pedro de Coche'),(19,11,'Parroquia Vicente Fuentes');
/*!40000 ALTER TABLE `parroquias` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-19 14:46:54
