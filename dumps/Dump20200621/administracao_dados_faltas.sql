-- MySQL dump 10.13  Distrib 8.0.20, for Linux (x86_64)
--
-- Host: localhost    Database: administracao
-- ------------------------------------------------------
-- Server version	8.0.20-0ubuntu0.19.10.1

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
-- Table structure for table `dados_faltas`
--

DROP TABLE IF EXISTS `dados_faltas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dados_faltas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `data_escala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_inicio_escala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intervalo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_fim_escala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_inicio_falta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_fim_falta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `justificao_falta_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_rh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora_inicio_rh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intervalo_rh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora_fim_rh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dados_faltas_justificao_falta_id_foreign` (`justificao_falta_id`),
  CONSTRAINT `dados_faltas_justificao_falta_id_foreign` FOREIGN KEY (`justificao_falta_id`) REFERENCES `justificao_faltas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-21 18:05:07
