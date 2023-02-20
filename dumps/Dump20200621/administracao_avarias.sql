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
-- Table structure for table `avarias`
--

DROP TABLE IF EXISTS `avarias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avarias` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `referencia` longtext COLLATE utf8mb4_unicode_ci,
  `fornecedor_servico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_id` bigint unsigned NOT NULL,
  `data_para_resolucao` datetime DEFAULT NULL,
  `hora_para_resolucao` time DEFAULT NULL,
  `responsavel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `plano_reparacao` longtext COLLATE utf8mb4_unicode_ci,
  `plano_prevencao` longtext COLLATE utf8mb4_unicode_ci,
  `proximo_passo` longtext COLLATE utf8mb4_unicode_ci,
  `foi_lida` enum('não lida','lida') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'não lida',
  `prioridade` enum('alta','baixa','média') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baixa',
  `natureza` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compartimento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechar` tinyint(1) DEFAULT '0',
  `estado` enum('pendente','concluido') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `estado_requisitante` enum('não concluida','concluida') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'não concluida',
  `diagnostico` longtext COLLATE utf8mb4_unicode_ci,
  `garantia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mao_obra_inicial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mao_obra_final` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custo_do_material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `horas_duracao` int DEFAULT '0',
  `minutos_duracao` int DEFAULT '0',
  `localizacao` enum('Matema Sede','Sucursal Cidade','Sucursal Moatize') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprovativo` enum('Factura','VD','ISP') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forma_pagamento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempo_prioridade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `avarias_sector_id_foreign` (`sector_id`),
  KEY `avarias_user_id_foreign` (`user_id`),
  CONSTRAINT `avarias_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avarias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
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

-- Dump completed on 2020-06-21 18:05:05
