CREATE DATABASE  IF NOT EXISTS `loc_veiculo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `loc_veiculo`;
-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: loc_veiculo
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu2

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
-- Table structure for table `locacao`
--

DROP TABLE IF EXISTS `locacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locacao` (
  `id_loc` int NOT NULL,
  `data_loc` date DEFAULT NULL,
  `cpf_locatario` char(11) DEFAULT NULL,
  `placa_veic` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_loc`),
  KEY `cpf_locatario_idx` (`cpf_locatario`),
  KEY `fk_placa_veic_idx` (`placa_veic`),
  CONSTRAINT `fk_cpf_locatario` FOREIGN KEY (`cpf_locatario`) REFERENCES `usuario` (`cpf`),
  CONSTRAINT `fk_placa_veic` FOREIGN KEY (`placa_veic`) REFERENCES `veiculo` (`placa_veiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locacao`
--

LOCK TABLES `locacao` WRITE;
/*!40000 ALTER TABLE `locacao` DISABLE KEYS */;
INSERT INTO `locacao` VALUES (1,'2022-12-10','11111111111','AAA-1234');
/*!40000 ALTER TABLE `locacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `cpf` char(11) NOT NULL,
  `p_nome` varchar(45) NOT NULL,
  `u_nome` varchar(45) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` char(1) NOT NULL,
  `senha` varchar(15) NOT NULL,
  `nivel_acesso` char(1) NOT NULL,
  PRIMARY KEY (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('11111111111','Samuel','Noronha','2001-05-23','M','1234','A'),('12546589624','Jonathan','Sales','0199-02-02','M','1245','A'),('17362927891','Fulana','Tal','1999-12-12','F','5641','C'),('22242424777','Camila','Souza','1998-12-15','F','5489','C'),('24544255255','Carlos','Nogueira','2000-03-25','M','7733','A'),('25015525012','José','Sales','1992-11-13','M','42333','C'),('25463214569','Maria','José','1995-05-12','F','123444354','A'),('44224141114','Joana','Bittencourt','1998-01-11','F','4434534','C'),('44457575757','João','Cardoso','1988-06-21','M','45345345','C'),('45214569852','Kelly','Key','1999-09-13','F','45452','C'),('45236541245','João','Souza','1995-12-12','M','54152','C'),('45689632145','Fernando','Silva','1995-02-02','M','45458485','C'),('45895652453','Carlos','Ferreira','1999-08-16','M','15151515','C'),('45896312453','Carla','Nogueira','1988-02-16','F','5454','C'),('45896321456','Josélia','Maria','1995-12-02','F','afas21','C'),('52654125698','João','Silva','1995-12-12','M','adf32','C'),('54632145632','João','Carlos','1995-12-08','M','45115','C'),('56456321456','Jonathan','Silva','1990-12-11','M','1244434','C'),('56563214578','Lucas ','Maranhão','1969-11-16','M','asfasf','C'),('65651514546','Marcos','Santos','1997-12-14','M','3333','A'),('77788855521','Maria','Santos','1999-07-24','F','4444','C');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veiculo`
--

DROP TABLE IF EXISTS `veiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `veiculo` (
  `placa_veiculo` varchar(10) NOT NULL,
  `tipo_veiculo` varchar(20) NOT NULL,
  `marca_veiculo` varchar(20) NOT NULL,
  `modelo_veiculo` varchar(20) NOT NULL,
  `km_rodados` int NOT NULL,
  `valor_locacao_diaria` float DEFAULT NULL,
  `cpf_locatario` char(11) DEFAULT NULL,
  `tempo_inicial_valido` date NOT NULL,
  `tempo_final_valido` date DEFAULT NULL,
  PRIMARY KEY (`placa_veiculo`,`tempo_inicial_valido`),
  KEY `cpf_locatario_idx` (`cpf_locatario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veiculo`
--

LOCK TABLES `veiculo` WRITE;
/*!40000 ALTER TABLE `veiculo` DISABLE KEYS */;
INSERT INTO `veiculo` VALUES ('AAA-1234','Carro','Volkswagen','Gol',1000,52.99,'11111111111','2022-12-01','2022-12-03'),('AAA-1234','Carro','Volkswagen','Gol',1200,52.99,NULL,'2022-12-04','2022-12-08'),('AAA-1234','Carro','Volkswagen','Gol',1550,52.99,NULL,'2022-12-09','2022-12-31'),('AAA-1234','Carro','Volkswagen','Gol',1550,52.99,'11111111111','2022-12-31',NULL),('AJD-1935','Carro','Fiat','Fastback',0,50,NULL,'2022-12-14','2022-12-18'),('AJD-1935','Carro','Fiat','Fastback',0,50,'56563214578','2022-12-19',NULL),('AKD-1726','Carro','Ford','Territory',0,55.99,NULL,'2022-12-14','2022-12-14'),('AKD-1726','Carro','Ford','Territory',0,55.99,'17362927891','2022-12-15','2022-12-31'),('AKD-1726','Carro','Ford','Territory',100,55.99,NULL,'2023-01-01',NULL),('ASF-9182','Carro','Fiat','Pickup',0,55.99,NULL,'2022-12-14','2022-12-28'),('ASF-9182','Carro','Fiat','Pickup',0,55.99,'44224141114','2022-12-29',NULL),('AWF-1935','Carro','Fiat','Pulse',0,56.99,NULL,'2022-12-14','2022-12-21'),('AWF-1935','Carro','Fiat','Pulse',0,56.99,'77788855521','2022-12-22',NULL),('BBB-1234','Moto','Honda','Titan 160',5000,45.99,NULL,'2022-11-08','2022-12-10'),('CCC-1234','Carro','Ford','Fiesta',0,61.99,NULL,'2022-10-11','2022-12-10'),('DDD-1234','Moto','Yamaha','Fluo',3254,35.99,NULL,'2022-07-29','2022-12-10'),('EEE-1234','Carro','Fiat','Sedan',150,60.99,'25015525012','2022-12-01',NULL),('FFF-1234','Carro','Chevrolet','Tahoe',600,55.99,'25015525012','2021-12-08',NULL),('GGG-1234','Moto','Honda','Biz 125',1500,40.99,NULL,'2022-05-12','2022-12-10'),('KKK-1234','Moto','Honda','Pop 100',0,30.99,NULL,'2022-12-11','2022-12-28'),('KKK-1234','Moto','Honda','Pop 100',0,30.99,'44224141114','2022-12-29','2022-12-31'),('KKK-1234','Moto','Honda','Pop 100',100,30.99,NULL,'2023-01-01',NULL);
/*!40000 ALTER TABLE `veiculo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-14 13:38:06
