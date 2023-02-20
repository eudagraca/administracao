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
-- Table structure for table `adendas`
--

DROP TABLE IF EXISTS `adendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adendas` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrato_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aumento` double(5,2) NOT NULL,
  `apartir_de` date NOT NULL,
  `numero` int NOT NULL,
  `salario_anterior` double(10,2) NOT NULL,
  `salario_actual` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `adendas_contrato_id_foreign` (`contrato_id`),
  CONSTRAINT `adendas_contrato_id_foreign` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `advertencias`
--

DROP TABLE IF EXISTS `advertencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advertencias` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `para` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `adversor_id` bigint unsigned NOT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `advertencias_adversor_id_foreign` (`adversor_id`),
  KEY `advertencias_user_id_foreign` (`user_id`),
  CONSTRAINT `advertencias_adversor_id_foreign` FOREIGN KEY (`adversor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `advertencias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alerta_escalas`
--

DROP TABLE IF EXISTS `alerta_escalas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alerta_escalas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `foi_lida` tinyint(1) NOT NULL DEFAULT '0',
  `escala_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alerta_escalas_escala_id_foreign` (`escala_id`),
  CONSTRAINT `alerta_escalas_escala_id_foreign` FOREIGN KEY (`escala_id`) REFERENCES `escalas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alerta_ferias`
--

DROP TABLE IF EXISTS `alerta_ferias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alerta_ferias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `foi_lida` tinyint(1) NOT NULL DEFAULT '0',
  `feria_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alerta_ferias_feria_id_foreign` (`feria_id`),
  CONSTRAINT `alerta_ferias_feria_id_foreign` FOREIGN KEY (`feria_id`) REFERENCES `ferias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alerta_justificacaos`
--

DROP TABLE IF EXISTS `alerta_justificacaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alerta_justificacaos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `justificao_falta_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechada` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `alerta_justificacaos_justificao_falta_id_foreign` (`justificao_falta_id`),
  CONSTRAINT `alerta_justificacaos_justificao_falta_id_foreign` FOREIGN KEY (`justificao_falta_id`) REFERENCES `justificao_faltas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alerta_prolongamentos`
--

DROP TABLE IF EXISTS `alerta_prolongamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alerta_prolongamentos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `foi_lida` tinyint(1) NOT NULL DEFAULT '0',
  `prolongamento_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alerta_prolongamentos_prolongamento_id_foreign` (`prolongamento_id`),
  CONSTRAINT `alerta_prolongamentos_prolongamento_id_foreign` FOREIGN KEY (`prolongamento_id`) REFERENCES `prolongamentos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `anotacoes_avarias`
--

DROP TABLE IF EXISTS `anotacoes_avarias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anotacoes_avarias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `avaria_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anotacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foi_lida` enum('lida','não lida') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'não lida',
  PRIMARY KEY (`id`),
  KEY `anotacoes_avarias_avaria_id_foreign` (`avaria_id`),
  CONSTRAINT `anotacoes_avarias_avaria_id_foreign` FOREIGN KEY (`avaria_id`) REFERENCES `avarias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aumento_remuneracaos`
--

DROP TABLE IF EXISTS `aumento_remuneracaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aumento_remuneracaos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `sector_id` bigint unsigned NOT NULL,
  `motivacao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('Autorizado','Não Autorizado','Pendente','Enviada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Enviada',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aumento_remuneracaos_user_id_foreign` (`user_id`),
  KEY `aumento_remuneracaos_sector_id_foreign` (`sector_id`),
  CONSTRAINT `aumento_remuneracaos_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `aumento_remuneracaos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `estado` enum('pendente','andamento','concluido') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `estado_requisitante` enum('não concluida','concluida') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'não concluida',
  `diagnostico` longtext COLLATE utf8mb4_unicode_ci,
  `garantia` longtext COLLATE utf8mb4_unicode_ci,
  `mao_obra_inicial` double(50,2) DEFAULT '0.00',
  `mao_obra_final` double(50,2) DEFAULT '0.00',
  `valor_total` double(50,2) DEFAULT '0.00',
  `custo_do_material` double(50,2) DEFAULT '0.00',
  `horas_duracao` int DEFAULT '0',
  `minutos_duracao` int DEFAULT '0',
  `localizacao` enum('Matema Sede','Sucursal Cidade','Sucursal Moatize') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprovativo` enum('Factura','VD','ISP') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `avarias_sector_id_foreign` (`sector_id`),
  KEY `avarias_user_id_foreign` (`user_id`),
  CONSTRAINT `avarias_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avarias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `clausula_contratos`
--

DROP TABLE IF EXISTS `clausula_contratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clausula_contratos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nr_clausula` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao_clausula` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clausula` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrato_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clausula_contratos_contrato_id_foreign` (`contrato_id`),
  CONSTRAINT `clausula_contratos_contrato_id_foreign` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `clausulas`
--

DROP TABLE IF EXISTS `clausulas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clausulas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `paragrafo` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `adenda_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clausulas_adenda_id_foreign` (`adenda_id`),
  CONSTRAINT `clausulas_adenda_id_foreign` FOREIGN KEY (`adenda_id`) REFERENCES `adendas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contratos`
--

DROP TABLE IF EXISTS `contratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contratos` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_civil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nacionalidade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `residencia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `habilitacoes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_contrato_vigor` date NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salario_bruto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_assinatura` date NOT NULL,
  `estado` enum('Rescindido','Em Contrato','Expirado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Em Contrato',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `tipo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contratos_user_id_foreign` (`user_id`),
  CONSTRAINT `contratos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dados_escalas`
--

DROP TABLE IF EXISTS `dados_escalas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dados_escalas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `data_escala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_entrada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intervalo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_final` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_nova_escala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_inicio_nova_escala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intervalo_nova_escala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_fim_nova_escala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `escala_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dados_escalas_escala_id_foreign` (`escala_id`),
  CONSTRAINT `dados_escalas_escala_id_foreign` FOREIGN KEY (`escala_id`) REFERENCES `escalas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dados_prolongamentos`
--

DROP TABLE IF EXISTS `dados_prolongamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dados_prolongamentos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `data_prolongamento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_fim_prolongamento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_inicio_prolongamento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prolongamento_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dados_prolongamentos_prolongamento_id_foreign` (`prolongamento_id`),
  CONSTRAINT `dados_prolongamentos_prolongamento_id_foreign` FOREIGN KEY (`prolongamento_id`) REFERENCES `prolongamentos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `despensas`
--

DROP TABLE IF EXISTS `despensas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `despensas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `escalas`
--

DROP TABLE IF EXISTS `escalas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `escalas` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sector_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `tipo_colaborador` enum('Efectivo','Prestador') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('Alteração de escala') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pedido_de` enum('Colaborador','Chefe do sector','Direcção','Recursos Humanos') COLLATE utf8mb4_unicode_ci NOT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `forma_compensacao` enum('Alteração de turno / Escala','Horas extras','Trabalho voluntário') COLLATE utf8mb4_unicode_ci NOT NULL,
  `parecer_rh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `estado` enum('Lido','Recebido','Nao lido','Respondido') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nao lido',
  `parecer_chefe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `escalas_user_id_foreign` (`user_id`),
  KEY `escalas_sector_id_foreign` (`sector_id`),
  CONSTRAINT `escalas_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `escalas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ferias`
--

DROP TABLE IF EXISTS `ferias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ferias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `data_inicio` date NOT NULL,
  `data_termino` date NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `substituto_id` bigint unsigned NOT NULL,
  `anos_trabalho` int NOT NULL,
  `funcao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('lida','nao lida','aceite','negada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nao lida',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ferias_user_id_foreign` (`user_id`),
  KEY `ferias_substituto_id_foreign` (`substituto_id`),
  CONSTRAINT `ferias_substituto_id_foreign` FOREIGN KEY (`substituto_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ferias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `justificao_faltas`
--

DROP TABLE IF EXISTS `justificao_faltas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `justificao_faltas` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_colaborador` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_justificacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assunto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forma_compensacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacoes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `parecer_chefe` enum('Favorável','Não Favorável') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parecer_rh` enum('Reúne requisitos','Não Reúne requisitos') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `sector_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `justificao_faltas_user_id_foreign` (`user_id`),
  KEY `justificao_faltas_sector_id_foreign` (`sector_id`),
  CONSTRAINT `justificao_faltas_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `justificao_faltas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `manutencao_respostas`
--

DROP TABLE IF EXISTS `manutencao_respostas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manutencao_respostas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `observacao` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `avaria_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tecnico_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `manutencao_respostas_tecnico_id_foreign` (`tecnico_id`),
  KEY `manutencao_respostas_user_id_foreign` (`user_id`),
  KEY `manutencao_respostas_avaria_id_foreign` (`avaria_id`),
  CONSTRAINT `manutencao_respostas_avaria_id_foreign` FOREIGN KEY (`avaria_id`) REFERENCES `avarias` (`id`) ON DELETE CASCADE,
  CONSTRAINT `manutencao_respostas_tecnico_id_foreign` FOREIGN KEY (`tecnico_id`) REFERENCES `tecnicos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `manutencao_respostas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fornecedor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quatidade` int NOT NULL,
  `preco` double(8,2) NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avaria_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nr_requisicao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `materials_avaria_id_foreign` (`avaria_id`),
  CONSTRAINT `materials_avaria_id_foreign` FOREIGN KEY (`avaria_id`) REFERENCES `avarias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `motoristas`
--

DROP TABLE IF EXISTS `motoristas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `motoristas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `em_servico` tinyint(1) NOT NULL DEFAULT '0',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Masculino','Femenino','Outro') COLLATE utf8mb4_unicode_ci NOT NULL,
  `licence_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `motoristas_user_id_foreign` (`user_id`),
  CONSTRAINT `motoristas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pedido_rescisaos`
--

DROP TABLE IF EXISTS `pedido_rescisaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido_rescisaos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `motivo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `antecedencia` date NOT NULL,
  `estado` enum('nao lida','lida','negada','aceite') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nao lida',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_rescisaos_user_id_foreign` (`user_id`),
  CONSTRAINT `pedido_rescisaos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pre_requisicaos`
--

DROP TABLE IF EXISTS `pre_requisicaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pre_requisicaos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tipo_viajem` enum('Local','Nacional','Internacional') COLLATE utf8mb4_unicode_ci NOT NULL,
  `origem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destino` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempo_viajem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prioridade` enum('Alta','Média','Baixa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_saida` time NOT NULL,
  `dia_saida` date NOT NULL,
  `mercadoria` enum('Mercadoria','Pessoas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantidade` int DEFAULT '0',
  `estado` enum('pendente','entregue','andamento','atrasada','negada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `foi_aceite` enum('lida','não lida','aceite','negado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'não lida',
  `sector_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `pre_requisicaos_user_id_foreign` (`user_id`),
  KEY `pre_requisicaos_sector_id_foreign` (`sector_id`),
  CONSTRAINT `pre_requisicaos_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pre_requisicaos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `prolongamentos`
--

DROP TABLE IF EXISTS `prolongamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prolongamentos` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sector_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `tipo_colaborador` enum('Efectivo','Prestador') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('Prolongamento de turno') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pedido_de` enum('Colaborador','Chefe do sector','Direcção','Recursos Humanos') COLLATE utf8mb4_unicode_ci NOT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `forma_compensacao` enum('Alteração de turno / Escala','Horas extras','Trabalho voluntário') COLLATE utf8mb4_unicode_ci NOT NULL,
  `parecer_rh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `estado` enum('Lido','Nao lido','Respondido') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nao lido',
  `parecer_chefe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prolongamentos_user_id_foreign` (`user_id`),
  KEY `prolongamentos_sector_id_foreign` (`sector_id`),
  CONSTRAINT `prolongamentos_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `prolongamentos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `requisicao_transportes`
--

DROP TABLE IF EXISTS `requisicao_transportes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requisicao_transportes` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transporte_id` bigint unsigned NOT NULL,
  `pre_requisicao_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `motorista_id` bigint unsigned NOT NULL,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `dia_exata` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requisicao_transportes_user_id_foreign` (`user_id`),
  KEY `requisicao_transportes_motorista_id_foreign` (`motorista_id`),
  KEY `requisicao_transportes_transporte_id_foreign` (`transporte_id`),
  KEY `requisicao_transportes_pre_requisicao_id_foreign` (`pre_requisicao_id`),
  CONSTRAINT `requisicao_transportes_motorista_id_foreign` FOREIGN KEY (`motorista_id`) REFERENCES `motoristas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `requisicao_transportes_pre_requisicao_id_foreign` FOREIGN KEY (`pre_requisicao_id`) REFERENCES `pre_requisicaos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `requisicao_transportes_transporte_id_foreign` FOREIGN KEY (`transporte_id`) REFERENCES `transportes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `requisicao_transportes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `requisicoes_negadas`
--

DROP TABLE IF EXISTS `requisicoes_negadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requisicoes_negadas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `pre_requisicao_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `requisicoes_negadas_pre_requisicao_id_foreign` (`pre_requisicao_id`),
  CONSTRAINT `requisicoes_negadas_pre_requisicao_id_foreign` FOREIGN KEY (`pre_requisicao_id`) REFERENCES `pre_requisicaos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rescisaos`
--

DROP TABLE IF EXISTS `rescisaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rescisaos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contrato_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rescisaos_contrato_id_foreign` (`contrato_id`),
  KEY `rescisaos_user_id_foreign` (`user_id`),
  CONSTRAINT `rescisaos_contrato_id_foreign` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rescisaos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sectors`
--

DROP TABLE IF EXISTS `sectors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sectors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `sectors_user_id_foreign` (`user_id`),
  CONSTRAINT `sectors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tarefas`
--

DROP TABLE IF EXISTS `tarefas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tarefas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `requisicao_transporte_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tarefas_requisicao_transporte_id_foreign` (`requisicao_transporte_id`),
  CONSTRAINT `tarefas_requisicao_transporte_id_foreign` FOREIGN KEY (`requisicao_transporte_id`) REFERENCES `requisicao_transportes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tecnicos`
--

DROP TABLE IF EXISTS `tecnicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tecnicos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `gender` enum('Masculino','Femenino','Outro') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pagamento` enum('cash','cheque','transferência','conta corrente') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `morada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipo_cartas`
--

DROP TABLE IF EXISTS `tipo_cartas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_cartas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipo_cartas_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `transportes`
--

DROP TABLE IF EXISTS `transportes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transportes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `marca` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `veiculo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricula` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `em_servico` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_roles`
--

DROP TABLE IF EXISTS `users_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_roles` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `users_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `users_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_sectors`
--

DROP TABLE IF EXISTS `users_sectors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_sectors` (
  `user_id` bigint unsigned NOT NULL,
  `sector_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`sector_id`),
  KEY `users_sectors_sector_id_foreign` (`sector_id`),
  CONSTRAINT `users_sectors_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_sectors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
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

-- Dump completed on 2020-06-02 17:22:09
