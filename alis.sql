-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: iblis
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.16.04.2

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
-- Table structure for table `adhoc_configs`
--

DROP TABLE IF EXISTS `adhoc_configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adhoc_configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adhoc_configs`
--

LOCK TABLES `adhoc_configs` WRITE;
/*!40000 ALTER TABLE `adhoc_configs` DISABLE KEYS */;
INSERT INTO `adhoc_configs` VALUES (1,'Report',1),(2,'ULIN',1),(3,'Clinician_UI',2);
/*!40000 ALTER TABLE `adhoc_configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `analytic_specimen_rejection_reasons`
--

DROP TABLE IF EXISTS `analytic_specimen_rejection_reasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `analytic_specimen_rejection_reasons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `specimen_id` int(10) unsigned NOT NULL,
  `rejection_id` int(10) unsigned NOT NULL,
  `reason_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `analytic_specimen_rejection_reasons_specimen_id_foreign` (`specimen_id`),
  KEY `analytic_specimen_rejection_reasons_rejection_id_foreign` (`rejection_id`),
  KEY `analytic_specimen_rejection_reasons_reason_id_foreign` (`reason_id`),
  CONSTRAINT `analytic_specimen_rejection_reasons_reason_id_foreign` FOREIGN KEY (`reason_id`) REFERENCES `rejection_reasons` (`id`),
  CONSTRAINT `analytic_specimen_rejection_reasons_rejection_id_foreign` FOREIGN KEY (`rejection_id`) REFERENCES `analytic_specimen_rejections` (`id`),
  CONSTRAINT `analytic_specimen_rejection_reasons_specimen_id_foreign` FOREIGN KEY (`specimen_id`) REFERENCES `analytic_specimen_rejections` (`specimen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `analytic_specimen_rejection_reasons`
--

LOCK TABLES `analytic_specimen_rejection_reasons` WRITE;
/*!40000 ALTER TABLE `analytic_specimen_rejection_reasons` DISABLE KEYS */;
/*!40000 ALTER TABLE `analytic_specimen_rejection_reasons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `analytic_specimen_rejections`
--

DROP TABLE IF EXISTS `analytic_specimen_rejections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `analytic_specimen_rejections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_id` int(10) unsigned NOT NULL,
  `specimen_id` int(10) unsigned NOT NULL,
  `rejected_by` int(10) unsigned NOT NULL,
  `rejection_reason_id` int(10) unsigned DEFAULT NULL,
  `reject_explained_to` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_rejected` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `analytic_specimen_rejections_rejected_by_index` (`rejected_by`),
  KEY `analytic_specimen_rejections_test_id_foreign` (`test_id`),
  KEY `analytic_specimen_rejections_specimen_id_foreign` (`specimen_id`),
  KEY `analytic_specimen_rejections_rejection_reason_id_foreign` (`rejection_reason_id`),
  CONSTRAINT `analytic_specimen_rejections_rejection_reason_id_foreign` FOREIGN KEY (`rejection_reason_id`) REFERENCES `rejection_reasons` (`id`),
  CONSTRAINT `analytic_specimen_rejections_specimen_id_foreign` FOREIGN KEY (`specimen_id`) REFERENCES `specimens` (`id`),
  CONSTRAINT `analytic_specimen_rejections_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `unhls_tests` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `analytic_specimen_rejections`
--

LOCK TABLES `analytic_specimen_rejections` WRITE;
/*!40000 ALTER TABLE `analytic_specimen_rejections` DISABLE KEYS */;
/*!40000 ALTER TABLE `analytic_specimen_rejections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assigned_roles`
--

DROP TABLE IF EXISTS `assigned_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assigned_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assigned_roles_user_id_foreign` (`user_id`),
  KEY `assigned_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `assigned_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `assigned_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assigned_roles`
--

LOCK TABLES `assigned_roles` WRITE;
/*!40000 ALTER TABLE `assigned_roles` DISABLE KEYS */;
INSERT INTO `assigned_roles` VALUES (1,1,1);
/*!40000 ALTER TABLE `assigned_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barcode_settings`
--

DROP TABLE IF EXISTS `barcode_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barcode_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `encoding_format` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `barcode_width` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `barcode_height` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `text_size` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barcode_settings`
--

LOCK TABLES `barcode_settings` WRITE;
/*!40000 ALTER TABLE `barcode_settings` DISABLE KEYS */;
INSERT INTO `barcode_settings` VALUES (1,'code39','2','30','11',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42');
/*!40000 ALTER TABLE `barcode_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinicians`
--

DROP TABLE IF EXISTS `clinicians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinicians` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `cadre` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinicians`
--

LOCK TABLES `clinicians` WRITE;
/*!40000 ALTER TABLE `clinicians` DISABLE KEYS */;
/*!40000 ALTER TABLE `clinicians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commodities`
--

DROP TABLE IF EXISTS `commodities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `metric_id` int(10) unsigned NOT NULL,
  `unit_price` decimal(8,2) NOT NULL,
  `item_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `storage_req` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `min_level` int(11) NOT NULL,
  `max_level` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `commodities_metric_id_foreign` (`metric_id`),
  CONSTRAINT `commodities_metric_id_foreign` FOREIGN KEY (`metric_id`) REFERENCES `metrics` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commodities`
--

LOCK TABLES `commodities` WRITE;
/*!40000 ALTER TABLE `commodities` DISABLE KEYS */;
/*!40000 ALTER TABLE `commodities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `control_measure_ranges`
--

DROP TABLE IF EXISTS `control_measure_ranges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `control_measure_ranges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `upper_range` decimal(6,2) DEFAULT NULL,
  `lower_range` decimal(6,2) DEFAULT NULL,
  `alphanumeric` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `control_measure_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `control_measure_ranges_control_measure_id_foreign` (`control_measure_id`),
  CONSTRAINT `control_measure_ranges_control_measure_id_foreign` FOREIGN KEY (`control_measure_id`) REFERENCES `control_measures` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `control_measure_ranges`
--

LOCK TABLES `control_measure_ranges` WRITE;
/*!40000 ALTER TABLE `control_measure_ranges` DISABLE KEYS */;
/*!40000 ALTER TABLE `control_measure_ranges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `control_measures`
--

DROP TABLE IF EXISTS `control_measures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `control_measures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `control_id` int(10) unsigned NOT NULL,
  `control_measure_type_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `control_measures_control_measure_type_id_foreign` (`control_measure_type_id`),
  KEY `control_measures_control_id_foreign` (`control_id`),
  CONSTRAINT `control_measures_control_id_foreign` FOREIGN KEY (`control_id`) REFERENCES `controls` (`id`),
  CONSTRAINT `control_measures_control_measure_type_id_foreign` FOREIGN KEY (`control_measure_type_id`) REFERENCES `measure_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `control_measures`
--

LOCK TABLES `control_measures` WRITE;
/*!40000 ALTER TABLE `control_measures` DISABLE KEYS */;
/*!40000 ALTER TABLE `control_measures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `control_results`
--

DROP TABLE IF EXISTS `control_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `control_results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `results` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `control_measure_id` int(10) unsigned NOT NULL,
  `control_test_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `control_results_control_test_id_foreign` (`control_test_id`),
  KEY `control_results_control_measure_id_foreign` (`control_measure_id`),
  CONSTRAINT `control_results_control_measure_id_foreign` FOREIGN KEY (`control_measure_id`) REFERENCES `control_measures` (`id`),
  CONSTRAINT `control_results_control_test_id_foreign` FOREIGN KEY (`control_test_id`) REFERENCES `control_tests` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `control_results`
--

LOCK TABLES `control_results` WRITE;
/*!40000 ALTER TABLE `control_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `control_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `control_tests`
--

DROP TABLE IF EXISTS `control_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `control_tests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entered_by` int(10) unsigned NOT NULL,
  `control_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `control_tests_control_id_foreign` (`control_id`),
  KEY `control_tests_entered_by_foreign` (`entered_by`),
  CONSTRAINT `control_tests_control_id_foreign` FOREIGN KEY (`control_id`) REFERENCES `controls` (`id`),
  CONSTRAINT `control_tests_entered_by_foreign` FOREIGN KEY (`entered_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `control_tests`
--

LOCK TABLES `control_tests` WRITE;
/*!40000 ALTER TABLE `control_tests` DISABLE KEYS */;
/*!40000 ALTER TABLE `control_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controls`
--

DROP TABLE IF EXISTS `controls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `controls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lot_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `controls_name_unique` (`name`),
  KEY `controls_lot_id_foreign` (`lot_id`),
  CONSTRAINT `controls_lot_id_foreign` FOREIGN KEY (`lot_id`) REFERENCES `lots` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controls`
--

LOCK TABLES `controls` WRITE;
/*!40000 ALTER TABLE `controls` DISABLE KEYS */;
/*!40000 ALTER TABLE `controls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `culture_durations`
--

DROP TABLE IF EXISTS `culture_durations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `culture_durations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `duration` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `culture_durations`
--

LOCK TABLES `culture_durations` WRITE;
/*!40000 ALTER TABLE `culture_durations` DISABLE KEYS */;
/*!40000 ALTER TABLE `culture_durations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `culture_observations`
--

DROP TABLE IF EXISTS `culture_observations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `culture_observations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `test_id` int(10) unsigned NOT NULL,
  `observation` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `culture_observations_user_id_foreign` (`user_id`),
  KEY `culture_observations_test_id_foreign` (`test_id`),
  CONSTRAINT `culture_observations_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `unhls_tests` (`id`),
  CONSTRAINT `culture_observations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `culture_observations`
--

LOCK TABLES `culture_observations` WRITE;
/*!40000 ALTER TABLE `culture_observations` DISABLE KEYS */;
/*!40000 ALTER TABLE `culture_observations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_alphanumeric_counts`
--

DROP TABLE IF EXISTS `daily_alphanumeric_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_alphanumeric_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `daily_test_type_count_id` int(10) unsigned NOT NULL,
  `measure_id` int(10) unsigned NOT NULL,
  `measure_range_id` int(10) unsigned NOT NULL,
  `result_interpretation_id` int(10) unsigned DEFAULT NULL,
  `count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `daily_alphanumeric_counts_daily_test_type_count_id_foreign` (`daily_test_type_count_id`),
  KEY `daily_alphanumeric_counts_measure_id_foreign` (`measure_id`),
  KEY `daily_alphanumeric_counts_measure_range_id_foreign` (`measure_range_id`),
  KEY `daily_alphanumeric_counts_result_interpretation_id_foreign` (`result_interpretation_id`),
  CONSTRAINT `daily_alphanumeric_counts_daily_test_type_count_id_foreign` FOREIGN KEY (`daily_test_type_count_id`) REFERENCES `daily_test_type_counts` (`id`),
  CONSTRAINT `daily_alphanumeric_counts_measure_id_foreign` FOREIGN KEY (`measure_id`) REFERENCES `measures` (`id`),
  CONSTRAINT `daily_alphanumeric_counts_measure_range_id_foreign` FOREIGN KEY (`measure_range_id`) REFERENCES `measure_ranges` (`id`),
  CONSTRAINT `daily_alphanumeric_counts_result_interpretation_id_foreign` FOREIGN KEY (`result_interpretation_id`) REFERENCES `result_interpretations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_alphanumeric_counts`
--

LOCK TABLES `daily_alphanumeric_counts` WRITE;
/*!40000 ALTER TABLE `daily_alphanumeric_counts` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_alphanumeric_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_gram_stain_result_counts`
--

DROP TABLE IF EXISTS `daily_gram_stain_result_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_gram_stain_result_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `daily_test_type_count_id` int(10) unsigned NOT NULL,
  `gram_stain_range_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `daily_gram_stain_result_counts_daily_test_type_count_id_foreign` (`daily_test_type_count_id`),
  CONSTRAINT `daily_gram_stain_result_counts_daily_test_type_count_id_foreign` FOREIGN KEY (`daily_test_type_count_id`) REFERENCES `daily_test_type_counts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_gram_stain_result_counts`
--

LOCK TABLES `daily_gram_stain_result_counts` WRITE;
/*!40000 ALTER TABLE `daily_gram_stain_result_counts` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_gram_stain_result_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_hiv_counts`
--

DROP TABLE IF EXISTS `daily_hiv_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_hiv_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `daily_test_type_count_id` int(10) unsigned NOT NULL,
  `purpose` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count` int(10) unsigned NOT NULL,
  `measure_id` int(10) unsigned DEFAULT NULL,
  `measure_range_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `daily_hiv_counts_daily_test_type_count_id_foreign` (`daily_test_type_count_id`),
  CONSTRAINT `daily_hiv_counts_daily_test_type_count_id_foreign` FOREIGN KEY (`daily_test_type_count_id`) REFERENCES `daily_test_type_counts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_hiv_counts`
--

LOCK TABLES `daily_hiv_counts` WRITE;
/*!40000 ALTER TABLE `daily_hiv_counts` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_hiv_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_negative_cultures`
--

DROP TABLE IF EXISTS `daily_negative_cultures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_negative_cultures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `organism_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_negative_cultures`
--

LOCK TABLES `daily_negative_cultures` WRITE;
/*!40000 ALTER TABLE `daily_negative_cultures` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_negative_cultures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_negative_gram_stains`
--

DROP TABLE IF EXISTS `daily_negative_gram_stains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_negative_gram_stains` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gram_stain_range_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_negative_gram_stains`
--

LOCK TABLES `daily_negative_gram_stains` WRITE;
/*!40000 ALTER TABLE `daily_negative_gram_stains` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_negative_gram_stains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_numeric_range_counts`
--

DROP TABLE IF EXISTS `daily_numeric_range_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_numeric_range_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `daily_test_type_count_id` int(10) unsigned NOT NULL,
  `measure_id` int(10) unsigned NOT NULL,
  `result` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `result_interpretation_id` int(10) unsigned DEFAULT NULL,
  `count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `daily_numeric_range_counts_daily_test_type_count_id_foreign` (`daily_test_type_count_id`),
  KEY `daily_numeric_range_counts_measure_id_foreign` (`measure_id`),
  KEY `daily_numeric_range_counts_result_interpretation_id_foreign` (`result_interpretation_id`),
  CONSTRAINT `daily_numeric_range_counts_daily_test_type_count_id_foreign` FOREIGN KEY (`daily_test_type_count_id`) REFERENCES `daily_test_type_counts` (`id`),
  CONSTRAINT `daily_numeric_range_counts_measure_id_foreign` FOREIGN KEY (`measure_id`) REFERENCES `measures` (`id`),
  CONSTRAINT `daily_numeric_range_counts_result_interpretation_id_foreign` FOREIGN KEY (`result_interpretation_id`) REFERENCES `result_interpretations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_numeric_range_counts`
--

LOCK TABLES `daily_numeric_range_counts` WRITE;
/*!40000 ALTER TABLE `daily_numeric_range_counts` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_numeric_range_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_organism_counts`
--

DROP TABLE IF EXISTS `daily_organism_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_organism_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `daily_test_type_count_id` int(10) unsigned NOT NULL,
  `organism_id` int(10) unsigned NOT NULL,
  `result_interpretation_id` int(10) unsigned DEFAULT NULL,
  `count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `daily_organism_counts_organism_id_foreign` (`organism_id`),
  KEY `daily_organism_counts_result_interpretation_id_foreign` (`result_interpretation_id`),
  CONSTRAINT `daily_organism_counts_organism_id_foreign` FOREIGN KEY (`organism_id`) REFERENCES `organisms` (`id`),
  CONSTRAINT `daily_organism_counts_result_interpretation_id_foreign` FOREIGN KEY (`result_interpretation_id`) REFERENCES `result_interpretations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_organism_counts`
--

LOCK TABLES `daily_organism_counts` WRITE;
/*!40000 ALTER TABLE `daily_organism_counts` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_organism_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_rejection_reason_counts`
--

DROP TABLE IF EXISTS `daily_rejection_reason_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_rejection_reason_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `daily_specimen_count_id` int(10) unsigned NOT NULL,
  `reason_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `daily_rejection_reason_counts_daily_specimen_count_id_foreign` (`daily_specimen_count_id`),
  KEY `daily_rejection_reason_counts_reason_id_foreign` (`reason_id`),
  CONSTRAINT `daily_rejection_reason_counts_daily_specimen_count_id_foreign` FOREIGN KEY (`daily_specimen_count_id`) REFERENCES `daily_specimen_counts` (`id`),
  CONSTRAINT `daily_rejection_reason_counts_reason_id_foreign` FOREIGN KEY (`reason_id`) REFERENCES `rejection_reasons` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_rejection_reason_counts`
--

LOCK TABLES `daily_rejection_reason_counts` WRITE;
/*!40000 ALTER TABLE `daily_rejection_reason_counts` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_rejection_reason_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_specimen_counts`
--

DROP TABLE IF EXISTS `daily_specimen_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_specimen_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `all` int(10) unsigned NOT NULL,
  `accepted` int(10) unsigned NOT NULL,
  `rejected` int(10) unsigned NOT NULL,
  `referred_in` int(10) unsigned DEFAULT NULL,
  `referred_out` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `daily_specimen_counts_date_unique` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_specimen_counts`
--

LOCK TABLES `daily_specimen_counts` WRITE;
/*!40000 ALTER TABLE `daily_specimen_counts` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_specimen_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_specimen_type_counts`
--

DROP TABLE IF EXISTS `daily_specimen_type_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_specimen_type_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `daily_specimen_count_id` int(10) unsigned NOT NULL,
  `specimen_type_id` int(10) unsigned NOT NULL,
  `all` int(10) unsigned NOT NULL,
  `accepted` int(10) unsigned NOT NULL,
  `rejected` int(10) unsigned NOT NULL,
  `referred_in` int(10) unsigned NOT NULL,
  `referred_out` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `daily_specimen_type_counts_daily_specimen_count_id_foreign` (`daily_specimen_count_id`),
  KEY `daily_specimen_type_counts_specimen_type_id_foreign` (`specimen_type_id`),
  CONSTRAINT `daily_specimen_type_counts_daily_specimen_count_id_foreign` FOREIGN KEY (`daily_specimen_count_id`) REFERENCES `daily_specimen_counts` (`id`),
  CONSTRAINT `daily_specimen_type_counts_specimen_type_id_foreign` FOREIGN KEY (`specimen_type_id`) REFERENCES `specimen_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_specimen_type_counts`
--

LOCK TABLES `daily_specimen_type_counts` WRITE;
/*!40000 ALTER TABLE `daily_specimen_type_counts` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_specimen_type_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_susceptibility_counts`
--

DROP TABLE IF EXISTS `daily_susceptibility_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_susceptibility_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `daily_organism_count_id` int(10) unsigned NOT NULL,
  `antibiotic_id` int(10) unsigned NOT NULL,
  `interpretation_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `daily_susceptibility_counts_daily_organism_count_id_foreign` (`daily_organism_count_id`),
  KEY `daily_susceptibility_counts_antibiotic_id_foreign` (`antibiotic_id`),
  KEY `daily_susceptibility_counts_interpretation_id_foreign` (`interpretation_id`),
  CONSTRAINT `daily_susceptibility_counts_antibiotic_id_foreign` FOREIGN KEY (`antibiotic_id`) REFERENCES `drugs` (`id`),
  CONSTRAINT `daily_susceptibility_counts_daily_organism_count_id_foreign` FOREIGN KEY (`daily_organism_count_id`) REFERENCES `daily_organism_counts` (`id`),
  CONSTRAINT `daily_susceptibility_counts_interpretation_id_foreign` FOREIGN KEY (`interpretation_id`) REFERENCES `drug_susceptibility_measures` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_susceptibility_counts`
--

LOCK TABLES `daily_susceptibility_counts` WRITE;
/*!40000 ALTER TABLE `daily_susceptibility_counts` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_susceptibility_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_test_counts`
--

DROP TABLE IF EXISTS `daily_test_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_test_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `all` int(10) unsigned NOT NULL,
  `referred_in` int(10) unsigned NOT NULL,
  `referred_out` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `daily_test_counts_date_unique` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_test_counts`
--

LOCK TABLES `daily_test_counts` WRITE;
/*!40000 ALTER TABLE `daily_test_counts` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_test_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_test_type_counts`
--

DROP TABLE IF EXISTS `daily_test_type_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_test_type_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `daily_test_count_id` int(10) unsigned NOT NULL,
  `test_type_id` int(10) unsigned NOT NULL,
  `age_upper_limit` int(10) unsigned NOT NULL,
  `age_lower_limit` int(10) unsigned NOT NULL,
  `gender` int(10) unsigned NOT NULL,
  `all` int(10) unsigned NOT NULL,
  `referred_in` int(10) unsigned NOT NULL,
  `referred_out` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `daily_test_type_counts_test_type_id_foreign` (`test_type_id`),
  KEY `daily_test_type_counts_daily_test_count_id_foreign` (`daily_test_count_id`),
  CONSTRAINT `daily_test_type_counts_daily_test_count_id_foreign` FOREIGN KEY (`daily_test_count_id`) REFERENCES `daily_test_counts` (`id`),
  CONSTRAINT `daily_test_type_counts_test_type_id_foreign` FOREIGN KEY (`test_type_id`) REFERENCES `test_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_test_type_counts`
--

LOCK TABLES `daily_test_type_counts` WRITE;
/*!40000 ALTER TABLE `daily_test_type_counts` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_test_type_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_turn_around_time`
--

DROP TABLE IF EXISTS `daily_turn_around_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_turn_around_time` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `daily_test_type_count_id` int(10) unsigned NOT NULL,
  `avg_reception_tostart` int(10) unsigned NOT NULL,
  `avg_start_tocompletion` int(10) unsigned NOT NULL,
  `avg_reception_tocompletion` int(10) unsigned NOT NULL,
  `avg_start_tovarification` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `daily_turn_around_time_daily_test_type_count_id_foreign` (`daily_test_type_count_id`),
  CONSTRAINT `daily_turn_around_time_daily_test_type_count_id_foreign` FOREIGN KEY (`daily_test_type_count_id`) REFERENCES `daily_test_type_counts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_turn_around_time`
--

LOCK TABLES `daily_turn_around_time` WRITE;
/*!40000 ALTER TABLE `daily_turn_around_time` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_turn_around_time` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diseases`
--

DROP TABLE IF EXISTS `diseases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diseases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diseases`
--

LOCK TABLES `diseases` WRITE;
/*!40000 ALTER TABLE `diseases` DISABLE KEYS */;
INSERT INTO `diseases` VALUES (1,'Malaria'),(2,'Typhoid'),(3,'Shigella Dysentry');
/*!40000 ALTER TABLE `diseases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drug_susceptibility`
--

DROP TABLE IF EXISTS `drug_susceptibility`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drug_susceptibility` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `drug_id` int(10) unsigned NOT NULL,
  `isolated_organism_id` int(10) unsigned NOT NULL,
  `drug_susceptibility_measure_id` int(10) unsigned NOT NULL,
  `zone_diameter` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `drug_susceptibility_user_id_foreign` (`user_id`),
  KEY `drug_susceptibility_drug_id_foreign` (`drug_id`),
  KEY `drug_susceptibility_isolated_organism_id_foreign` (`isolated_organism_id`),
  KEY `drug_susceptibility_drug_susceptibility_measure_id_foreign` (`drug_susceptibility_measure_id`),
  CONSTRAINT `drug_susceptibility_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`),
  CONSTRAINT `drug_susceptibility_drug_susceptibility_measure_id_foreign` FOREIGN KEY (`drug_susceptibility_measure_id`) REFERENCES `drug_susceptibility_measures` (`id`),
  CONSTRAINT `drug_susceptibility_isolated_organism_id_foreign` FOREIGN KEY (`isolated_organism_id`) REFERENCES `isolated_organisms` (`id`),
  CONSTRAINT `drug_susceptibility_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drug_susceptibility`
--

LOCK TABLES `drug_susceptibility` WRITE;
/*!40000 ALTER TABLE `drug_susceptibility` DISABLE KEYS */;
/*!40000 ALTER TABLE `drug_susceptibility` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drug_susceptibility_measures`
--

DROP TABLE IF EXISTS `drug_susceptibility_measures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drug_susceptibility_measures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `symbol` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `interpretation` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drug_susceptibility_measures`
--

LOCK TABLES `drug_susceptibility_measures` WRITE;
/*!40000 ALTER TABLE `drug_susceptibility_measures` DISABLE KEYS */;
INSERT INTO `drug_susceptibility_measures` VALUES (1,'S','Sensitive'),(2,'I','Intermediate'),(3,'R','Resistant');
/*!40000 ALTER TABLE `drug_susceptibility_measures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drugs`
--

DROP TABLE IF EXISTS `drugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drugs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `drugs_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drugs`
--

LOCK TABLES `drugs` WRITE;
/*!40000 ALTER TABLE `drugs` DISABLE KEYS */;
INSERT INTO `drugs` VALUES (1,'Amikacin',NULL,NULL,'2017-05-31 14:29:37','2017-05-31 14:29:37'),(2,'Ampicillin',NULL,NULL,'2017-05-31 14:29:38','2017-05-31 14:29:38'),(3,'Augmentin',NULL,NULL,'2017-05-31 14:29:38','2017-05-31 14:29:38'),(4,'Cefotaxime',NULL,NULL,'2017-05-31 14:29:38','2017-05-31 14:29:38'),(5,'Ceftazidime',NULL,NULL,'2017-05-31 14:29:38','2017-05-31 14:29:38'),(6,'Ceftriaxone',NULL,NULL,'2017-05-31 14:29:39','2017-05-31 14:29:39'),(7,'Ceftizoxime',NULL,NULL,'2017-05-31 14:29:39','2017-05-31 14:29:39'),(8,'Cefuroxime',NULL,NULL,'2017-05-31 14:29:39','2017-05-31 14:29:39'),(9,'Cefuroxime oral',NULL,NULL,'2017-05-31 14:29:39','2017-05-31 14:29:39'),(10,'Chloramphenicol',NULL,NULL,'2017-05-31 14:29:39','2017-05-31 14:29:39'),(11,'Ciprofloxacin',NULL,NULL,'2017-05-31 14:29:39','2017-05-31 14:29:39'),(12,'Co-trimoxazole',NULL,NULL,'2017-05-31 14:29:39','2017-05-31 14:29:39'),(13,'Gentamicin',NULL,NULL,'2017-05-31 14:29:39','2017-05-31 14:29:39'),(14,'Imipenem',NULL,NULL,'2017-05-31 14:29:40','2017-05-31 14:29:40'),(15,'Meropenem',NULL,NULL,'2017-05-31 14:29:40','2017-05-31 14:29:40'),(16,'Nalidixic acid',NULL,NULL,'2017-05-31 14:29:40','2017-05-31 14:29:40'),(17,'Peperacillintazobactam',NULL,NULL,'2017-05-31 14:29:40','2017-05-31 14:29:40'),(18,'Piperacillin',NULL,NULL,'2017-05-31 14:29:40','2017-05-31 14:29:40'),(19,'Nitrofurantoin',NULL,NULL,'2017-05-31 14:29:40','2017-05-31 14:29:40'),(20,'Trimethoprim',NULL,NULL,'2017-05-31 14:29:40','2017-05-31 14:29:40'),(21,'Amoxycillin',NULL,NULL,'2017-05-31 14:29:41','2017-05-31 14:29:41'),(22,'Cefepime',NULL,NULL,'2017-05-31 14:29:41','2017-05-31 14:29:41'),(23,'Colistin',NULL,NULL,'2017-05-31 14:29:42','2017-05-31 14:29:42'),(24,'Tetracycline',NULL,NULL,'2017-05-31 14:29:48','2017-05-31 14:29:48'),(25,'Erythromycin',NULL,NULL,'2017-05-31 14:29:53','2017-05-31 14:29:53'),(26,'Clindamycin',NULL,NULL,'2017-05-31 14:29:53','2017-05-31 14:29:53'),(27,'Vancomycin',NULL,NULL,'2017-05-31 14:29:53','2017-05-31 14:29:53'),(28,'Linezolid',NULL,NULL,'2017-05-31 14:29:53','2017-05-31 14:29:53'),(29,'Penicillin G',NULL,NULL,'2017-05-31 14:29:53','2017-05-31 14:29:53'),(30,'Cefoxitin',NULL,NULL,'2017-05-31 14:29:53','2017-05-31 14:29:53'),(31,'Rifampicin',NULL,NULL,'2017-05-31 14:29:54','2017-05-31 14:29:54'),(32,'Streptomycin',NULL,NULL,'2017-05-31 14:30:05','2017-05-31 14:30:05'),(33,'Minocycline',NULL,NULL,'2017-05-31 14:30:08','2017-05-31 14:30:08'),(34,'Cefexime',NULL,NULL,'2017-05-31 14:30:09','2017-05-31 14:30:09'),(35,'spectinomycin',NULL,NULL,'2017-05-31 14:30:09','2017-05-31 14:30:09'),(36,'Oxacillin',NULL,NULL,'2017-05-31 14:30:21','2017-05-31 14:30:21'),(37,'Levofloxacin',NULL,NULL,'2017-05-31 14:30:54','2017-05-31 14:30:54'),(38,'Cefuroxime Parentral',NULL,NULL,'2017-05-31 14:30:59','2017-05-31 14:30:59'),(39,'High level Gentamicin',NULL,NULL,'2017-05-31 14:31:06','2017-05-31 14:31:06');
/*!40000 ALTER TABLE `drugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equip_config`
--

DROP TABLE IF EXISTS `equip_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equip_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `equip_id` int(10) unsigned NOT NULL,
  `prop_id` int(10) unsigned NOT NULL,
  `prop_value` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `equip_config_equip_id_foreign` (`equip_id`),
  KEY `equip_config_prop_id_foreign` (`prop_id`),
  CONSTRAINT `equip_config_equip_id_foreign` FOREIGN KEY (`equip_id`) REFERENCES `interfaced_equipment` (`id`),
  CONSTRAINT `equip_config_prop_id_foreign` FOREIGN KEY (`prop_id`) REFERENCES `ii_quickcodes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equip_config`
--

LOCK TABLES `equip_config` WRITE;
/*!40000 ALTER TABLE `equip_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `equip_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `external_dump`
--

DROP TABLE IF EXISTS `external_dump`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `external_dump` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lab_no` int(11) NOT NULL,
  `parent_lab_no` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `requesting_clinician` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `investigation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provisional_diagnosis` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `request_date` timestamp NULL DEFAULT NULL,
  `order_stage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result` text COLLATE utf8_unicode_ci,
  `result_returned` int(11) DEFAULT NULL,
  `patient_visit_number` int(11) DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` datetime DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receipt_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receipt_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `waiver_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `system_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `external_dump_lab_no_unique` (`lab_no`),
  KEY `external_dump_parent_lab_no_index` (`parent_lab_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `external_dump`
--

LOCK TABLES `external_dump` WRITE;
/*!40000 ALTER TABLE `external_dump` DISABLE KEYS */;
/*!40000 ALTER TABLE `external_dump` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `external_users`
--

DROP TABLE IF EXISTS `external_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `external_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `internal_user_id` int(10) unsigned NOT NULL,
  `external_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `external_users_internal_user_id_unique` (`internal_user_id`),
  CONSTRAINT `external_users_internal_user_id_foreign` FOREIGN KEY (`internal_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `external_users`
--

LOCK TABLES `external_users` WRITE;
/*!40000 ALTER TABLE `external_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `external_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facilities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facilities`
--

LOCK TABLES `facilities` WRITE;
/*!40000 ALTER TABLE `facilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gram_break_points`
--

DROP TABLE IF EXISTS `gram_break_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gram_break_points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `drug_id` int(10) unsigned NOT NULL,
  `gram_stain_range_id` int(10) unsigned NOT NULL,
  `resistant_max` decimal(4,1) DEFAULT NULL,
  `intermediate_min` decimal(4,1) DEFAULT NULL,
  `intermediate_max` decimal(4,1) DEFAULT NULL,
  `sensitive_min` decimal(4,1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gram_break_points_drug_id_foreign` (`drug_id`),
  KEY `gram_break_points_gram_stain_range_id_foreign` (`gram_stain_range_id`),
  CONSTRAINT `gram_break_points_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`),
  CONSTRAINT `gram_break_points_gram_stain_range_id_foreign` FOREIGN KEY (`gram_stain_range_id`) REFERENCES `gram_stain_ranges` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gram_break_points`
--

LOCK TABLES `gram_break_points` WRITE;
/*!40000 ALTER TABLE `gram_break_points` DISABLE KEYS */;
/*!40000 ALTER TABLE `gram_break_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gram_drug_susceptibility`
--

DROP TABLE IF EXISTS `gram_drug_susceptibility`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gram_drug_susceptibility` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `drug_id` int(10) unsigned NOT NULL,
  `gram_stain_result_id` int(10) unsigned NOT NULL,
  `drug_susceptibility_measure_id` int(10) unsigned NOT NULL,
  `zone_diameter` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `gram_drug_susceptibility_user_id_foreign` (`user_id`),
  KEY `gram_drug_susceptibility_drug_id_foreign` (`drug_id`),
  KEY `gram_drug_susceptibility_gram_stain_result_id_foreign` (`gram_stain_result_id`),
  KEY `gram_drug_susceptibility_drug_susceptibility_measure_id_foreign` (`drug_susceptibility_measure_id`),
  CONSTRAINT `gram_drug_susceptibility_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`),
  CONSTRAINT `gram_drug_susceptibility_drug_susceptibility_measure_id_foreign` FOREIGN KEY (`drug_susceptibility_measure_id`) REFERENCES `drug_susceptibility_measures` (`id`),
  CONSTRAINT `gram_drug_susceptibility_gram_stain_result_id_foreign` FOREIGN KEY (`gram_stain_result_id`) REFERENCES `gram_stain_results` (`id`),
  CONSTRAINT `gram_drug_susceptibility_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gram_drug_susceptibility`
--

LOCK TABLES `gram_drug_susceptibility` WRITE;
/*!40000 ALTER TABLE `gram_drug_susceptibility` DISABLE KEYS */;
/*!40000 ALTER TABLE `gram_drug_susceptibility` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gram_stain_ranges`
--

DROP TABLE IF EXISTS `gram_stain_ranges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gram_stain_ranges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gram_stain_ranges`
--

LOCK TABLES `gram_stain_ranges` WRITE;
/*!40000 ALTER TABLE `gram_stain_ranges` DISABLE KEYS */;
INSERT INTO `gram_stain_ranges` VALUES (1,'No organism seen'),(2,'Gram positive cocci in singles'),(3,'Gram positive cocci in chains'),(4,'Gram positive cocci in clusters'),(5,'Gram positive diplococci'),(6,'Gram positive micrococci'),(7,'Gram positive rods'),(8,'Gram positive rods with terminal spores'),(9,'Gram positive rods with sub-terminal spores'),(10,'Gram positive rods with endospores'),(11,'Gram negative diplococci'),(12,'Gram negative intracellular diplococci'),(13,'Gram negative extracellular diplococci'),(14,'Gram negative rods'),(15,'Gram positive yeast cells'),(16,'Gram negative pleomorphic rods'),(17,'+ Gram positive cocci in singles'),(18,'+ Gram positive cocci in chains'),(19,'+ Gram positive cocci in clusters'),(20,'+ Gram positive diplococci'),(21,'+ Gram positive micrococci'),(22,'+ Gram positive rods'),(23,'+ Gram positive rods with terminal spores'),(24,'+ Gram positive rods with sub-terminal spores'),(25,'+ Gram positive rods with endospores'),(26,'+ Gram negative diplococci'),(27,'+ Gram negative intracellular diplococci'),(28,'+ Gram negative extracellular diplococci'),(29,'+ Gram negative rods'),(30,'+ Gram positive yeast cells'),(31,'+ Gram negative pleomorphic rods'),(32,'++ Gram positive cocci in singles'),(33,'++ Gram positive cocci in chains'),(34,'++ Gram positive cocci in clusters'),(35,'++ Gram positive diplococci'),(36,'++ Gram positive micrococci'),(37,'++ Gram positive rods'),(38,'++ Gram positive rods with terminal spores'),(39,'++ Gram positive rods with sub-terminal spores'),(40,'++ Gram positive rods with endospores'),(41,'++ Gram negative diplococci'),(42,'++ Gram negative intracellular diplococci'),(43,'++ Gram negative extracellular diplococci'),(44,'++ Gram negative rods'),(45,'++ Gram positive yeast cells'),(46,'++ Gram negative pleomorphic rods'),(47,'+++ Gram positive cocci in singles'),(48,'+++ Gram positive cocci in chains'),(49,'+++ Gram positive cocci in clusters'),(50,'+++ Gram positive diplococci'),(51,'+++ Gram positive micrococci'),(52,'+++ Gram positive rods'),(53,'+++ Gram positive rods with terminal spores'),(54,'+++ Gram positive rods with sub-terminal spores'),(55,'+++ Gram positive rods with endospores'),(56,'+++ Gram negative diplococci'),(57,'+++ Gram negative intracellular diplococci'),(58,'+++ Gram negative extracellular diplococci'),(59,'+++ Gram negative rods'),(60,'+++ Gram positive yeast cells'),(61,'+++ Gram negative pleomorphic rods');
/*!40000 ALTER TABLE `gram_stain_ranges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gram_stain_results`
--

DROP TABLE IF EXISTS `gram_stain_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gram_stain_results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `test_id` int(10) unsigned NOT NULL,
  `gram_stain_range_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gram_stain_results_user_id_foreign` (`user_id`),
  KEY `gram_stain_results_test_id_foreign` (`test_id`),
  KEY `gram_stain_results_gram_stain_range_id_foreign` (`gram_stain_range_id`),
  CONSTRAINT `gram_stain_results_gram_stain_range_id_foreign` FOREIGN KEY (`gram_stain_range_id`) REFERENCES `gram_stain_ranges` (`id`),
  CONSTRAINT `gram_stain_results_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `unhls_tests` (`id`),
  CONSTRAINT `gram_stain_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gram_stain_results`
--

LOCK TABLES `gram_stain_results` WRITE;
/*!40000 ALTER TABLE `gram_stain_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `gram_stain_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hubs`
--

DROP TABLE IF EXISTS `hubs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hubs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hubs`
--

LOCK TABLES `hubs` WRITE;
/*!40000 ALTER TABLE `hubs` DISABLE KEYS */;
/*!40000 ALTER TABLE `hubs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ii_quickcodes`
--

DROP TABLE IF EXISTS `ii_quickcodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ii_quickcodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `feed_source` tinyint(4) NOT NULL,
  `config_prop` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ii_quickcodes`
--

LOCK TABLES `ii_quickcodes` WRITE;
/*!40000 ALTER TABLE `ii_quickcodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ii_quickcodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instrument_testtypes`
--

DROP TABLE IF EXISTS `instrument_testtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instrument_testtypes` (
  `instrument_id` int(10) unsigned NOT NULL,
  `test_type_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `instrument_testtypes_instrument_id_test_type_id_unique` (`instrument_id`,`test_type_id`),
  KEY `instrument_testtypes_test_type_id_foreign` (`test_type_id`),
  CONSTRAINT `instrument_testtypes_instrument_id_foreign` FOREIGN KEY (`instrument_id`) REFERENCES `instruments` (`id`),
  CONSTRAINT `instrument_testtypes_test_type_id_foreign` FOREIGN KEY (`test_type_id`) REFERENCES `test_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instrument_testtypes`
--

LOCK TABLES `instrument_testtypes` WRITE;
/*!40000 ALTER TABLE `instrument_testtypes` DISABLE KEYS */;
INSERT INTO `instrument_testtypes` VALUES (1,6);
/*!40000 ALTER TABLE `instrument_testtypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instruments`
--

DROP TABLE IF EXISTS `instruments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instruments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `driver_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instruments`
--

LOCK TABLES `instruments` WRITE;
/*!40000 ALTER TABLE `instruments` DISABLE KEYS */;
INSERT INTO `instruments` VALUES (1,'Celltac F Mek 8222','192.168.1.12','HEMASERVER','Automatic analyzer with 22 parameters and WBC 5 part diff Hematology Analyzer','KBLIS\\Plugins\\CelltacFMachine','2019-03-29 08:55:43','2019-03-29 08:55:43');
/*!40000 ALTER TABLE `instruments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interfaced_equipment`
--

DROP TABLE IF EXISTS `interfaced_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interfaced_equipment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `equipment_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comm_type` tinyint(4) NOT NULL,
  `equipment_version` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lab_section` int(10) unsigned NOT NULL,
  `feed_source` tinyint(4) NOT NULL,
  `config_file` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `interfaced_equipment_lab_section_foreign` (`lab_section`),
  CONSTRAINT `interfaced_equipment_lab_section_foreign` FOREIGN KEY (`lab_section`) REFERENCES `test_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interfaced_equipment`
--

LOCK TABLES `interfaced_equipment` WRITE;
/*!40000 ALTER TABLE `interfaced_equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `interfaced_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `isolated_organisms`
--

DROP TABLE IF EXISTS `isolated_organisms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `isolated_organisms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `test_id` int(10) unsigned NOT NULL,
  `organism_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `isolated_organisms_user_id_foreign` (`user_id`),
  KEY `isolated_organisms_test_id_foreign` (`test_id`),
  KEY `isolated_organisms_organism_id_foreign` (`organism_id`),
  CONSTRAINT `isolated_organisms_organism_id_foreign` FOREIGN KEY (`organism_id`) REFERENCES `organisms` (`id`),
  CONSTRAINT `isolated_organisms_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `unhls_tests` (`id`),
  CONSTRAINT `isolated_organisms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `isolated_organisms`
--

LOCK TABLES `isolated_organisms` WRITE;
/*!40000 ALTER TABLE `isolated_organisms` DISABLE KEYS */;
/*!40000 ALTER TABLE `isolated_organisms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `receipt_id` int(10) unsigned NOT NULL,
  `topup_request_id` int(10) unsigned NOT NULL,
  `quantity_issued` int(11) NOT NULL,
  `issued_to` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `remarks` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `issues_topup_request_id_foreign` (`topup_request_id`),
  KEY `issues_receipt_id_foreign` (`receipt_id`),
  KEY `issues_issued_to_foreign` (`issued_to`),
  KEY `issues_user_id_foreign` (`user_id`),
  CONSTRAINT `issues_issued_to_foreign` FOREIGN KEY (`issued_to`) REFERENCES `users` (`id`),
  CONSTRAINT `issues_receipt_id_foreign` FOREIGN KEY (`receipt_id`) REFERENCES `receipts` (`id`),
  CONSTRAINT `issues_topup_request_id_foreign` FOREIGN KEY (`topup_request_id`) REFERENCES `topup_requests` (`id`),
  CONSTRAINT `issues_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issues`
--

LOCK TABLES `issues` WRITE;
/*!40000 ALTER TABLE `issues` DISABLE KEYS */;
/*!40000 ALTER TABLE `issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lots`
--

DROP TABLE IF EXISTS `lots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lots` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiry` date NOT NULL,
  `instrument_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `lots_number_unique` (`number`),
  KEY `lots_instrument_id_foreign` (`instrument_id`),
  CONSTRAINT `lots_instrument_id_foreign` FOREIGN KEY (`instrument_id`) REFERENCES `instruments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lots`
--

LOCK TABLES `lots` WRITE;
/*!40000 ALTER TABLE `lots` DISABLE KEYS */;
/*!40000 ALTER TABLE `lots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `measure_name_mappings`
--

DROP TABLE IF EXISTS `measure_name_mappings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `measure_name_mappings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_name_mapping_id` int(10) unsigned NOT NULL,
  `measure_id` int(10) unsigned DEFAULT NULL,
  `standard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `system_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `measure_name_mappings_system_name_unique` (`system_name`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `measure_name_mappings`
--

LOCK TABLES `measure_name_mappings` WRITE;
/*!40000 ALTER TABLE `measure_name_mappings` DISABLE KEYS */;
INSERT INTO `measure_name_mappings` VALUES (1,1,NULL,'WBC','wbc'),(2,1,NULL,'RBC','rbc'),(3,1,NULL,'hgb','hgb'),(4,2,NULL,'Hb','hb'),(5,3,NULL,'ESR','esr'),(6,4,NULL,'Bleeding time','bleeding_time'),(7,5,NULL,'Prothrombin Time','prothrombin_time'),(8,6,NULL,'Clotting Time','clotting_time'),(9,7,NULL,'ABO Grouping','abo_grouping'),(10,8,NULL,'Combs','combs'),(11,9,NULL,'Cross Matching','cross_matching'),(12,10,NULL,'Malaria Microscopy','malaria_microscopy'),(13,11,NULL,'Malaria RDTs','malaria_rdts'),(14,12,NULL,'Stool Microscopy','stool_microscopy'),(15,13,NULL,'VDRL/RPR','vdrl_rpr'),(16,14,NULL,'TPHA','tpha'),(17,15,NULL,'Shigella Dysentery','shigella_dysentery'),(18,16,NULL,'Hepatitis B','hepatitis_b'),(19,17,NULL,'Brucella','brucella'),(20,18,NULL,'Pregnancy Test','pregnancy_test'),(21,19,NULL,'Rheumatoid Factor','rheumatoid_factor'),(22,20,NULL,'CD4 tests','cd4_tests'),(23,21,NULL,'Viral Load Tests','viral_load_tests'),(24,22,NULL,'ZN for AFBs','zn_for_afbs'),(25,23,NULL,'Culture & Sensitivity','culture_sensitivity'),(26,24,NULL,'Gram Stain','gram_stain'),(27,25,NULL,'India Ink','india_ink'),(28,26,NULL,'Wet Preps','wet_preps'),(29,27,NULL,'Urine Microscopy','urine_microscopy'),(30,28,NULL,'Urea','urea'),(31,28,NULL,'Calcium','calcium'),(32,28,NULL,'Potassium','potassium'),(33,28,NULL,'Sodium','sodium'),(34,28,NULL,'Creatinine','creatinine'),(35,29,NULL,'ALT','alt'),(36,29,NULL,'AST','ast'),(37,29,NULL,'Albumin','albumin'),(38,29,NULL,'Total Protein','total_protein'),(39,30,NULL,'Triglycerides','triglycerides'),(40,30,NULL,'Cholesterol','cholesterol'),(41,30,NULL,'CK','ck'),(42,30,NULL,'LDH','ldh'),(43,30,NULL,'HDL','hdl'),(44,31,NULL,'Alkaline Phosphates','alkaline_phosphates'),(45,32,NULL,'Amylase','amylase'),(46,33,NULL,'Glucose','glucose'),(47,34,NULL,'Uric Acid','uric_acid'),(48,35,NULL,'Lactate','lactate'),(49,36,NULL,'Determine','determine'),(50,36,NULL,'Stat-pak','stat_pak'),(51,36,NULL,'Unigold','unigold');
/*!40000 ALTER TABLE `measure_name_mappings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `measure_ranges`
--

DROP TABLE IF EXISTS `measure_ranges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `measure_ranges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `measure_id` int(10) unsigned NOT NULL,
  `age_min` decimal(8,2) DEFAULT NULL,
  `age_max` decimal(8,2) DEFAULT NULL,
  `gender` tinyint(3) unsigned DEFAULT NULL,
  `range_lower` decimal(7,3) DEFAULT NULL,
  `range_upper` decimal(7,3) DEFAULT NULL,
  `alphanumeric` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `interpretation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `result_interpretation_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `measure_ranges_alphanumeric_index` (`alphanumeric`),
  KEY `measure_ranges_measure_id_foreign` (`measure_id`),
  CONSTRAINT `measure_ranges_measure_id_foreign` FOREIGN KEY (`measure_id`) REFERENCES `measures` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `measure_ranges`
--

LOCK TABLES `measure_ranges` WRITE;
/*!40000 ALTER TABLE `measure_ranges` DISABLE KEYS */;
INSERT INTO `measure_ranges` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,'Reactive','',NULL,NULL),(2,1,NULL,NULL,NULL,NULL,NULL,'Non-Reactive','',NULL,NULL),(3,2,NULL,NULL,NULL,NULL,NULL,'Reactive','',NULL,NULL),(4,2,NULL,NULL,NULL,NULL,NULL,'Non-Reactive','',NULL,NULL),(5,3,NULL,NULL,NULL,NULL,NULL,'Reactive','',NULL,NULL),(6,3,NULL,NULL,NULL,NULL,NULL,'Non-Reactive','',NULL,NULL),(7,4,NULL,NULL,NULL,NULL,NULL,'No mps seen','Negative',NULL,NULL),(8,4,NULL,NULL,NULL,NULL,NULL,'+','Positive',NULL,NULL),(9,4,NULL,NULL,NULL,NULL,NULL,'++','Positive',NULL,NULL),(10,4,NULL,NULL,NULL,NULL,NULL,'+++','Positive',NULL,NULL),(11,6,NULL,NULL,NULL,NULL,NULL,'O-',NULL,NULL,NULL),(12,6,NULL,NULL,NULL,NULL,NULL,'O+',NULL,NULL,NULL),(13,6,NULL,NULL,NULL,NULL,NULL,'A-',NULL,NULL,NULL),(14,6,NULL,NULL,NULL,NULL,NULL,'A+',NULL,NULL,NULL),(15,6,NULL,NULL,NULL,NULL,NULL,'B-',NULL,NULL,NULL),(16,6,NULL,NULL,NULL,NULL,NULL,'B+',NULL,NULL,NULL),(17,6,NULL,NULL,NULL,NULL,NULL,'AB-',NULL,NULL,NULL),(18,6,NULL,NULL,NULL,NULL,NULL,'AB+',NULL,NULL,NULL),(19,23,0.00,100.00,2,4.000,11.000,NULL,NULL,NULL,NULL),(20,24,0.00,100.00,2,1.500,4.000,NULL,NULL,NULL,NULL),(21,25,0.00,100.00,2,0.100,9.000,NULL,NULL,NULL,NULL),(22,26,0.00,100.00,2,2.500,7.000,NULL,NULL,NULL,NULL),(23,27,0.00,100.00,2,0.000,6.000,NULL,NULL,NULL,NULL),(24,28,0.00,100.00,2,0.000,2.000,NULL,NULL,NULL,NULL),(25,29,NULL,NULL,NULL,NULL,NULL,'Positive',NULL,NULL,NULL),(26,29,NULL,NULL,NULL,NULL,NULL,'Negative',NULL,NULL,NULL),(27,30,NULL,NULL,NULL,NULL,NULL,'Positive',NULL,NULL,NULL),(28,30,NULL,NULL,NULL,NULL,NULL,'Negative',NULL,NULL,NULL),(29,31,NULL,NULL,NULL,NULL,NULL,'Positive',NULL,NULL,NULL),(30,31,NULL,NULL,NULL,NULL,NULL,'Negative',NULL,NULL,NULL),(31,32,NULL,NULL,NULL,NULL,NULL,'Positive',NULL,NULL,NULL),(32,32,NULL,NULL,NULL,NULL,NULL,'Negative',NULL,NULL,NULL),(33,33,NULL,NULL,NULL,NULL,NULL,'Positive',NULL,NULL,NULL),(34,33,NULL,NULL,NULL,NULL,NULL,'Negative',NULL,NULL,NULL),(35,34,NULL,NULL,NULL,NULL,NULL,'Positive',NULL,NULL,NULL),(36,34,NULL,NULL,NULL,NULL,NULL,'Negative',NULL,NULL,NULL),(37,35,NULL,NULL,NULL,NULL,NULL,'Positive',NULL,NULL,NULL),(38,35,NULL,NULL,NULL,NULL,NULL,'Negative',NULL,NULL,NULL),(39,36,NULL,NULL,NULL,NULL,NULL,'Positive',NULL,NULL,NULL),(40,36,NULL,NULL,NULL,NULL,NULL,'Negative',NULL,NULL,NULL),(41,37,NULL,NULL,NULL,NULL,NULL,'Positive',NULL,NULL,NULL),(42,37,NULL,NULL,NULL,NULL,NULL,'Negative',NULL,NULL,NULL),(43,38,0.00,0.02,2,3.000,15.000,NULL,NULL,NULL,NULL),(44,38,0.02,0.08,2,3.000,15.000,NULL,NULL,NULL,NULL),(45,38,0.08,1.00,2,3.000,15.000,NULL,NULL,NULL,NULL),(46,38,1.00,12.00,2,3.000,15.000,NULL,NULL,NULL,NULL),(47,38,12.00,60.00,0,3.000,15.000,NULL,NULL,NULL,NULL),(48,38,12.00,60.00,1,4.000,11.000,NULL,NULL,NULL,NULL),(49,38,60.00,999.00,2,3.000,15.000,NULL,NULL,NULL,NULL),(50,39,0.00,0.02,2,2.500,5.500,NULL,NULL,NULL,NULL),(51,39,0.02,0.08,2,2.500,5.500,NULL,NULL,NULL,NULL),(52,39,0.08,1.00,2,2.500,5.500,NULL,NULL,NULL,NULL),(53,39,1.00,12.00,2,2.500,5.500,NULL,NULL,NULL,NULL),(54,39,12.00,60.00,0,2.500,5.500,NULL,NULL,NULL,NULL),(55,39,12.00,60.00,1,2.500,5.500,NULL,NULL,NULL,NULL),(56,39,60.00,999.00,2,2.500,5.500,NULL,NULL,NULL,NULL),(57,40,0.00,0.02,2,12.000,16.000,NULL,NULL,NULL,NULL),(58,40,0.02,0.08,2,8.000,17.000,NULL,NULL,NULL,NULL),(59,40,0.08,1.00,2,8.000,17.000,NULL,NULL,NULL,NULL),(60,40,1.00,12.00,2,8.000,17.000,NULL,NULL,NULL,NULL),(61,40,12.00,60.00,0,13.000,17.000,NULL,NULL,NULL,NULL),(62,40,12.00,60.00,1,12.000,14.000,NULL,NULL,NULL,NULL),(63,40,60.00,999.00,2,8.000,17.000,NULL,NULL,NULL,NULL),(64,41,0.00,0.02,2,26.000,50.000,NULL,NULL,NULL,NULL),(65,41,0.02,0.08,2,26.000,50.000,NULL,NULL,NULL,NULL),(66,41,0.08,1.00,2,26.000,50.000,NULL,NULL,NULL,NULL),(67,41,1.00,12.00,2,26.000,50.000,NULL,NULL,NULL,NULL),(68,41,12.00,60.00,0,26.000,50.000,NULL,NULL,NULL,NULL),(69,41,12.00,60.00,1,26.000,50.000,NULL,NULL,NULL,NULL),(70,41,60.00,999.00,2,26.000,50.000,NULL,NULL,NULL,NULL),(71,42,0.00,0.02,2,86.000,110.000,NULL,NULL,NULL,NULL),(72,42,0.02,0.08,2,86.000,110.000,NULL,NULL,NULL,NULL),(73,42,0.08,1.00,2,86.000,110.000,NULL,NULL,NULL,NULL),(74,42,1.00,12.00,2,86.000,110.000,NULL,NULL,NULL,NULL),(75,42,12.00,60.00,0,86.000,110.000,NULL,NULL,NULL,NULL),(76,42,12.00,60.00,1,86.000,110.000,NULL,NULL,NULL,NULL),(77,42,60.00,999.00,2,86.000,110.000,NULL,NULL,NULL,NULL),(78,43,0.00,0.02,2,26.000,38.000,NULL,NULL,NULL,NULL),(79,43,0.02,0.08,2,26.000,38.000,NULL,NULL,NULL,NULL),(80,43,0.08,1.00,2,26.000,38.000,NULL,NULL,NULL,NULL),(81,43,1.00,12.00,2,26.000,38.000,NULL,NULL,NULL,NULL),(82,43,12.00,60.00,0,26.000,38.000,NULL,NULL,NULL,NULL),(83,43,12.00,60.00,1,26.000,38.000,NULL,NULL,NULL,NULL),(84,43,60.00,999.00,2,26.000,38.000,NULL,NULL,NULL,NULL),(85,44,0.00,0.02,2,31.000,37.000,NULL,NULL,NULL,NULL),(86,44,0.02,0.08,2,31.000,37.000,NULL,NULL,NULL,NULL),(87,44,0.08,1.00,2,31.000,37.000,NULL,NULL,NULL,NULL),(88,44,1.00,12.00,2,31.000,37.000,NULL,NULL,NULL,NULL),(89,44,12.00,60.00,0,31.000,37.000,NULL,NULL,NULL,NULL),(90,44,12.00,60.00,1,31.000,37.000,NULL,NULL,NULL,NULL),(91,44,60.00,999.00,2,31.000,37.000,NULL,NULL,NULL,NULL),(92,45,0.00,0.02,2,50.000,400.000,NULL,NULL,NULL,NULL),(93,45,0.02,0.08,2,50.000,400.000,NULL,NULL,NULL,NULL),(94,45,0.08,1.00,2,50.000,400.000,NULL,NULL,NULL,NULL),(95,45,1.00,12.00,2,50.000,400.000,NULL,NULL,NULL,NULL),(96,45,12.00,60.00,0,50.000,400.000,NULL,NULL,NULL,NULL),(97,45,12.00,60.00,1,50.000,400.000,NULL,NULL,NULL,NULL),(98,45,60.00,999.00,2,50.000,400.000,NULL,NULL,NULL,NULL),(99,46,0.00,0.02,2,37.000,54.000,NULL,NULL,NULL,NULL),(100,46,0.02,0.08,2,37.000,54.000,NULL,NULL,NULL,NULL),(101,46,0.08,1.00,2,37.000,54.000,NULL,NULL,NULL,NULL),(102,46,1.00,12.00,2,37.000,54.000,NULL,NULL,NULL,NULL),(103,46,12.00,60.00,0,37.000,54.000,NULL,NULL,NULL,NULL),(104,46,12.00,60.00,1,37.000,54.000,NULL,NULL,NULL,NULL),(105,46,60.00,999.00,2,37.000,54.000,NULL,NULL,NULL,NULL),(106,47,0.00,0.02,2,11.000,16.000,NULL,NULL,NULL,NULL),(107,47,0.02,0.08,2,11.000,16.000,NULL,NULL,NULL,NULL),(108,47,0.08,1.00,2,11.000,16.000,NULL,NULL,NULL,NULL),(109,47,1.00,12.00,2,11.000,16.000,NULL,NULL,NULL,NULL),(110,47,12.00,60.00,0,11.000,16.000,NULL,NULL,NULL,NULL),(111,47,12.00,60.00,1,11.000,16.000,NULL,NULL,NULL,NULL),(112,47,60.00,999.00,2,11.000,16.000,NULL,NULL,NULL,NULL),(113,48,0.00,0.02,2,9.000,17.000,NULL,NULL,NULL,NULL),(114,48,0.02,0.08,2,9.000,17.000,NULL,NULL,NULL,NULL),(115,48,0.08,1.00,2,9.000,17.000,NULL,NULL,NULL,NULL),(116,48,1.00,12.00,2,9.000,17.000,NULL,NULL,NULL,NULL),(117,48,12.00,60.00,0,9.000,17.000,NULL,NULL,NULL,NULL),(118,48,12.00,60.00,1,9.000,17.000,NULL,NULL,NULL,NULL),(119,48,60.00,999.00,2,9.000,17.000,NULL,NULL,NULL,NULL),(120,49,0.00,0.02,2,9.000,13.000,NULL,NULL,NULL,NULL),(121,49,0.02,0.08,2,9.000,13.000,NULL,NULL,NULL,NULL),(122,49,0.08,1.00,2,9.000,13.000,NULL,NULL,NULL,NULL),(123,49,1.00,12.00,2,9.000,13.000,NULL,NULL,NULL,NULL),(124,49,12.00,60.00,0,9.000,13.000,NULL,NULL,NULL,NULL),(125,49,12.00,60.00,1,9.000,13.000,NULL,NULL,NULL,NULL),(126,49,60.00,999.00,2,9.000,13.000,NULL,NULL,NULL,NULL),(127,50,0.00,0.02,2,13.000,43.000,NULL,NULL,NULL,NULL),(128,50,0.02,0.08,2,13.000,43.000,NULL,NULL,NULL,NULL),(129,50,0.08,1.00,2,13.000,43.000,NULL,NULL,NULL,NULL),(130,50,1.00,12.00,2,13.000,43.000,NULL,NULL,NULL,NULL),(131,50,12.00,60.00,0,13.000,43.000,NULL,NULL,NULL,NULL),(132,50,12.00,60.00,1,13.000,43.000,NULL,NULL,NULL,NULL),(133,50,60.00,999.00,2,13.000,43.000,NULL,NULL,NULL,NULL),(134,51,0.00,0.02,2,0.170,0.350,NULL,NULL,NULL,NULL),(135,51,0.02,0.08,2,0.170,0.350,NULL,NULL,NULL,NULL),(136,51,0.08,1.00,2,0.170,0.350,NULL,NULL,NULL,NULL),(137,51,1.00,12.00,2,0.170,0.350,NULL,NULL,NULL,NULL),(138,51,12.00,60.00,0,0.170,0.350,NULL,NULL,NULL,NULL),(139,51,12.00,60.00,1,0.170,0.350,NULL,NULL,NULL,NULL),(140,51,60.00,999.00,2,0.170,0.350,NULL,NULL,NULL,NULL),(141,52,0.00,0.02,2,1.500,7.000,NULL,NULL,NULL,NULL),(142,52,0.02,0.08,2,1.500,7.000,NULL,NULL,NULL,NULL),(143,52,0.08,1.00,2,1.500,7.000,NULL,NULL,NULL,NULL),(144,52,1.00,12.00,2,1.500,7.000,NULL,NULL,NULL,NULL),(145,52,12.00,60.00,0,1.500,7.000,NULL,NULL,NULL,NULL),(146,52,12.00,60.00,1,1.500,7.000,NULL,NULL,NULL,NULL),(147,52,60.00,999.00,2,1.500,7.000,NULL,NULL,NULL,NULL),(148,53,0.00,0.02,2,1.000,3.700,NULL,NULL,NULL,NULL),(149,53,0.02,0.08,2,1.000,3.700,NULL,NULL,NULL,NULL),(150,53,0.08,1.00,2,1.000,3.700,NULL,NULL,NULL,NULL),(151,53,1.00,12.00,2,1.000,3.700,NULL,NULL,NULL,NULL),(152,53,12.00,60.00,0,1.000,3.700,NULL,NULL,NULL,NULL),(153,53,12.00,60.00,1,1.000,3.700,NULL,NULL,NULL,NULL),(154,53,60.00,999.00,2,1.000,3.700,NULL,NULL,NULL,NULL),(155,54,0.00,0.02,2,0.000,0.700,NULL,NULL,NULL,NULL),(156,54,0.02,0.08,2,0.000,0.700,NULL,NULL,NULL,NULL),(157,54,0.08,1.00,2,0.000,0.700,NULL,NULL,NULL,NULL),(158,54,1.00,12.00,2,0.000,0.700,NULL,NULL,NULL,NULL),(159,54,12.00,60.00,0,0.000,0.700,NULL,NULL,NULL,NULL),(160,54,12.00,60.00,1,0.000,0.700,NULL,NULL,NULL,NULL),(161,54,60.00,999.00,2,0.000,0.700,NULL,NULL,NULL,NULL),(162,55,0.00,0.02,2,0.000,0.400,NULL,NULL,NULL,NULL),(163,55,0.02,0.08,2,0.000,0.400,NULL,NULL,NULL,NULL),(164,55,0.08,1.00,2,0.000,0.400,NULL,NULL,NULL,NULL),(165,55,1.00,12.00,2,0.000,0.400,NULL,NULL,NULL,NULL),(166,55,12.00,60.00,0,0.000,0.400,NULL,NULL,NULL,NULL),(167,55,12.00,60.00,1,0.000,0.400,NULL,NULL,NULL,NULL),(168,55,60.00,999.00,2,0.000,0.400,NULL,NULL,NULL,NULL),(169,56,0.00,0.02,2,0.000,0.100,NULL,NULL,NULL,NULL),(170,56,0.02,0.08,2,0.000,0.100,NULL,NULL,NULL,NULL),(171,56,0.08,1.00,2,0.000,0.100,NULL,NULL,NULL,NULL),(172,56,1.00,12.00,2,0.000,0.100,NULL,NULL,NULL,NULL),(173,56,12.00,60.00,0,0.000,0.100,NULL,NULL,NULL,NULL),(174,56,12.00,60.00,1,0.000,0.100,NULL,NULL,NULL,NULL),(175,56,60.00,999.00,2,0.000,0.100,NULL,NULL,NULL,NULL),(176,57,0.00,0.02,2,37.000,72.000,NULL,NULL,NULL,NULL),(177,57,0.02,0.08,2,37.000,72.000,NULL,NULL,NULL,NULL),(178,57,0.08,1.00,2,37.000,72.000,NULL,NULL,NULL,NULL),(179,57,1.00,12.00,2,37.000,72.000,NULL,NULL,NULL,NULL),(180,57,12.00,60.00,0,37.000,72.000,NULL,NULL,NULL,NULL),(181,57,12.00,60.00,1,37.000,72.000,NULL,NULL,NULL,NULL),(182,57,60.00,999.00,2,37.000,72.000,NULL,NULL,NULL,NULL),(183,58,0.00,0.02,2,20.000,50.000,NULL,NULL,NULL,NULL),(184,58,0.02,0.08,2,20.000,50.000,NULL,NULL,NULL,NULL),(185,58,0.08,1.00,2,20.000,50.000,NULL,NULL,NULL,NULL),(186,58,1.00,12.00,2,20.000,50.000,NULL,NULL,NULL,NULL),(187,58,12.00,60.00,0,20.000,50.000,NULL,NULL,NULL,NULL),(188,58,12.00,60.00,1,20.000,50.000,NULL,NULL,NULL,NULL),(189,58,60.00,999.00,2,20.000,50.000,NULL,NULL,NULL,NULL),(190,59,0.00,0.02,2,0.000,14.000,NULL,NULL,NULL,NULL),(191,59,0.02,0.08,2,0.000,14.000,NULL,NULL,NULL,NULL),(192,59,0.08,1.00,2,0.000,14.000,NULL,NULL,NULL,NULL),(193,59,1.00,12.00,2,0.000,14.000,NULL,NULL,NULL,NULL),(194,59,12.00,60.00,0,0.000,14.000,NULL,NULL,NULL,NULL),(195,59,12.00,60.00,1,0.000,14.000,NULL,NULL,NULL,NULL),(196,59,60.00,999.00,2,0.000,14.000,NULL,NULL,NULL,NULL),(197,60,0.00,0.02,2,0.000,6.000,NULL,NULL,NULL,NULL),(198,60,0.02,0.08,2,0.000,6.000,NULL,NULL,NULL,NULL),(199,60,0.08,1.00,2,0.000,6.000,NULL,NULL,NULL,NULL),(200,60,1.00,12.00,2,0.000,6.000,NULL,NULL,NULL,NULL),(201,60,12.00,60.00,0,0.000,6.000,NULL,NULL,NULL,NULL),(202,60,12.00,60.00,1,0.000,6.000,NULL,NULL,NULL,NULL),(203,60,60.00,999.00,2,0.000,6.000,NULL,NULL,NULL,NULL),(204,61,0.00,0.02,2,0.000,1.000,NULL,NULL,NULL,NULL),(205,61,0.02,0.08,2,0.000,1.000,NULL,NULL,NULL,NULL),(206,61,0.08,1.00,2,0.000,1.000,NULL,NULL,NULL,NULL),(207,61,1.00,12.00,2,0.000,1.000,NULL,NULL,NULL,NULL),(208,61,12.00,60.00,0,0.000,1.000,NULL,NULL,NULL,NULL),(209,61,12.00,60.00,1,0.000,1.000,NULL,NULL,NULL,NULL),(210,61,60.00,999.00,2,0.000,1.000,NULL,NULL,NULL,NULL),(211,62,NULL,NULL,NULL,NULL,NULL,'Reactive',NULL,NULL,NULL),(212,62,NULL,NULL,NULL,NULL,NULL,'Non Reactive',NULL,NULL,NULL),(213,84,NULL,NULL,NULL,NULL,NULL,'Positive',NULL,NULL,NULL),(214,84,NULL,NULL,NULL,NULL,NULL,'Negative',NULL,NULL,NULL),(215,91,NULL,NULL,NULL,NULL,NULL,'Low',NULL,NULL,NULL),(216,91,NULL,NULL,NULL,NULL,NULL,'High',NULL,NULL,NULL),(217,91,NULL,NULL,NULL,NULL,NULL,'Normal',NULL,NULL,NULL),(218,92,NULL,NULL,NULL,NULL,NULL,'High',NULL,NULL,NULL),(219,92,NULL,NULL,NULL,NULL,NULL,'Low',NULL,NULL,NULL),(220,92,NULL,NULL,NULL,NULL,NULL,'Normal',NULL,NULL,NULL),(221,93,NULL,NULL,NULL,NULL,NULL,'High',NULL,NULL,NULL),(222,93,NULL,NULL,NULL,NULL,NULL,'Low',NULL,NULL,NULL),(223,93,NULL,NULL,NULL,NULL,NULL,'Normal',NULL,NULL,NULL),(224,94,NULL,NULL,NULL,NULL,NULL,'Positive',NULL,NULL,NULL),(225,94,NULL,NULL,NULL,NULL,NULL,'Negative',NULL,NULL,NULL),(226,95,NULL,NULL,NULL,NULL,NULL,'Positive',NULL,NULL,NULL),(227,95,NULL,NULL,NULL,NULL,NULL,'Negative',NULL,NULL,NULL),(228,96,NULL,NULL,NULL,NULL,NULL,'Positive',NULL,NULL,NULL),(229,96,NULL,NULL,NULL,NULL,NULL,'Negative',NULL,NULL,NULL);
/*!40000 ALTER TABLE `measure_ranges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `measure_types`
--

DROP TABLE IF EXISTS `measure_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `measure_types` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `measure_types_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `measure_types`
--

LOCK TABLES `measure_types` WRITE;
/*!40000 ALTER TABLE `measure_types` DISABLE KEYS */;
INSERT INTO `measure_types` VALUES (1,'Numeric Range',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(2,'Alphanumeric Values',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(3,'Autocomplete',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(4,'Free Text',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43');
/*!40000 ALTER TABLE `measure_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `measures`
--

DROP TABLE IF EXISTS `measures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `measures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `measure_type_id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `measures_measure_type_id_foreign` (`measure_type_id`),
  CONSTRAINT `measures_measure_type_id_foreign` FOREIGN KEY (`measure_type_id`) REFERENCES `measure_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `measures`
--

LOCK TABLES `measures` WRITE;
/*!40000 ALTER TABLE `measures` DISABLE KEYS */;
INSERT INTO `measures` VALUES (1,2,'Screening','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(2,2,'Confirmatory Test (Statpak)','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(3,2,'Unigold','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(4,2,'BS for mps','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(5,4,'GXM','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(6,2,'Blood Grouping','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(7,1,'HB','g/dL',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(8,4,'Pus cells','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(9,4,'S. haematobium','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(10,4,'T. vaginalis','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(11,4,'Yeast cells','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(12,4,'Red blood cells','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(13,4,'Bacteria','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(14,4,'Spermatozoa','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(15,4,'Epithelial cells','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(16,4,'Glucose','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(17,4,'Ketones','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(18,4,'Proteins','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(19,4,'Blood','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(20,4,'Bilirubin','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(21,4,'Urobilinogen Phenlpyruvic acid','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(22,4,'pH','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(23,1,'WBC','x10³/µL',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(24,1,'Lym','L',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(25,1,'Mon','*',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(26,1,'Neu','*',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(27,1,'Eos','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(28,1,'Baso','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(29,2,'Salmonella Antigen Test','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(30,2,'Direct COOMBS Test','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(31,2,'Du Test','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43',NULL),(32,2,'Sickling Test','',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(33,2,'Borrelia','',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(34,2,'VDRL','',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(35,2,'Pregnancy Test','',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(36,2,'Brucella','',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(37,2,'H. Pylori','',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(38,1,'WBC','x10³/µL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(39,1,'RBC','x10⁶/µL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(40,1,'HGB','g/dL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(41,1,'HCT','%',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(42,1,'MCV','fL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(43,1,'MCH','pg',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(44,1,'MCHC','g/dL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(45,1,'PLT','x10³/µL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(46,1,'RDW-SD','fL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(47,1,'RDW-CV','%',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(48,1,'PDW','fL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(49,1,'MPV','fL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(50,1,'P-LCR','%',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(51,1,'PCT','%',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(52,1,'NEUT#','x10³/µL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(53,1,'LYMPH#','x10³/µL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(54,1,'MONO#','x10³/µL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(55,1,'EO#','x10³/µL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(56,1,'BASO#','x10³/µL',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(57,1,'NEUT%','%',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(58,1,'LYMPH%','%',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(59,1,'MONO%','%',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(60,1,'EO%','%',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(61,1,'BASO%','%',NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44',NULL),(62,2,'Crag','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(63,4,'Differential','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(64,4,'Total Cell Count','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(65,4,'Lymphocytes','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(66,4,'Quantitative Culture','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(67,4,'RBC Count','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(68,4,'TPHA','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(69,4,'HCG','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(70,4,'Bilirubin','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(71,4,'Blood','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(72,4,'Glucose','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(73,4,'Ketones','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(74,4,'Leukocytes','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(75,4,'Microscopy','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(76,4,'Nitrite','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(77,4,'pH','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(78,4,'Protein','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(79,4,'Specific Gravity','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(80,4,'Urobilinogen','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(81,4,'Appearance','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(82,4,'Culture and Sensitivity',NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(83,4,'Gram Staining','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(84,2,'India Ink Staining',NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(85,4,'Protein',NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(86,4,'Wet preparation (saline preparation)',NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(87,4,'White Blood Cell Count',NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(88,4,'ZN Staining',NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(89,4,'Modified ZN','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(90,4,'Wet Saline Iodine Prep','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(91,2,'SERUM AMYLASE','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(92,2,'calcium','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(93,2,'SGOT','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(94,2,'Indirect COOMBS test','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(95,2,'Direct COOMBS test','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(96,2,'Du test','',NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45',NULL),(97,4,'RPR','',NULL,'2019-03-29 08:55:46','2019-03-29 08:55:46',NULL),(98,4,'Serum Crag','',NULL,'2019-03-29 08:55:46','2019-03-29 08:55:46',NULL);
/*!40000 ALTER TABLE `measures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metrics`
--

DROP TABLE IF EXISTS `metrics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metrics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metrics`
--

LOCK TABLES `metrics` WRITE;
/*!40000 ALTER TABLE `metrics` DISABLE KEYS */;
/*!40000 ALTER TABLE `metrics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_07_24_082711_CreatekBLIStables',1),('2014_09_02_114206_entrust_setup_tables',1),('2014_10_09_162222_externaldumptable',1),('2015_02_04_004704_add_index_to_parentlabno',1),('2015_02_11_112608_remove_unique_constraint_on_patient_number',1),('2015_02_17_104134_qc_tables',1),('2015_02_23_112018_create_microbiology_tables',1),('2015_02_27_084341_createInventoryTables',1),('2015_03_16_155558_create_surveillance',1),('2015_06_24_145526_update_test_types_table',1),('2015_06_24_154426_FreeTestsColumn',1),('2016_03_30_145749_lab_config_settings',1),('2016_07_26_095319_create_unhls_financial_years_table',1),('2016_07_26_095409_create_unhls_drugs_table',1),('2016_08_17_181955_create_rejection_reasons',1),('2016_08_31_135348_create_unhls_stockcard',1),('2016_08_31_135420_create_unhls_stockrequisition',1),('2016_09_28_091952_create_unhls_warehouse',1),('2016_09_28_095327_create_unhls_staff',1),('2016_10_03_220056_create_bbincidences_table',1),('2016_10_03_220511_create_bbactions_table',1),('2016_10_03_220622_create_bbcauses_table',1),('2016_10_03_220702_create_bbnatures_table',1),('2016_10_03_220852_create_bbincidences_action_table',1),('2016_10_03_220959_create_bbincidences_cause_table',1),('2016_10_03_221055_create_bbincidences_nature_table',1),('2016_10_13_170615_create_unhls_equipment_suppliers_table',1),('2016_10_19_115152_create_referral_reasons',1),('2017_01_16_103507_create_equipment_inventory_table',1),('2017_01_16_103533_create_equipment_maintenance_table',1),('2017_01_16_103546_create_equipment_breakdown_table',1),('2017_04_27_134821_create_wards_table',1),('2017_04_27_144035_update_visits_table',1),('2017_04_27_160407_create_therapy_table',1),('2017_05_25_131728_updateUNHLSBreakdown',1),('2017_06_19_094902_update_equipment_inventory_table',1),('2017_06_19_111831_update_equipment_breakdown_table',1),('2017_06_19_115028_update_unhls_stockcard_table',1),('2017_06_20_043838_alter_stockcard_table',1),('2017_06_30_183112_update_microbiology_functionalities',1),('2017_07_05_170430_create_reports_tables',1),('2017_07_27_160147_create_visit_status_table',1),('2017_07_27_160228_add_status_column_to_visit_table',1),('2017_07_28_113854_add_clinical_notes_column_to_table',1),('2017_07_28_120834_add_phone_contact_column_to_table',1),('2017_07_31_020011_create_uuids_table',1),('2017_08_02_192917_alter_specimen_id_nullable_unhls_tests',1),('2017_08_22_080201_create_test_name_mappings_table',1),('2017_10_10_094958_update_hiv_report_table',1),('2017_10_15_122554_adhoc_configs_table',1),('2017_11_07_160414_create_instrument_column_tables',1),('2017_11_15_121513_update_visit_table',1),('2018_01_12_152202_add_column_range_interpretion',1),('2018_03_06_194838_create_poc_tables',1),('2018_03_15_090759_alter_test_results_table',1),('2018_03_16_180358_create_poc_results',1),('2018_03_23_061054_alter_poc_results',1),('2018_05_14_172215_create_hubs',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisms`
--

DROP TABLE IF EXISTS `organisms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organisms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `organisms_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisms`
--

LOCK TABLES `organisms` WRITE;
/*!40000 ALTER TABLE `organisms` DISABLE KEYS */;
INSERT INTO `organisms` VALUES (1,'Pseudomonas aeruginosa',NULL,NULL,'2017-05-31 11:29:37','2017-05-31 11:29:37'),(2,'Escherichia coli',NULL,NULL,'2017-05-31 11:29:38','2017-05-31 11:29:38'),(3,'Enterobacteriacae',NULL,NULL,'2017-05-31 11:29:40','2017-05-31 11:29:40'),(5,'Pseudomonas flourescens',NULL,NULL,'2017-05-31 11:29:43','2017-05-31 11:29:43'),(6,'Pseudomonas spp',NULL,NULL,'2017-05-31 11:29:44','2017-05-31 11:29:44'),(12,'Acinetobacter spp',NULL,NULL,'2017-05-31 11:29:47','2017-05-31 11:29:47'),(13,'Acinetobacter baumannii',NULL,NULL,'2017-05-31 11:29:48','2017-05-31 11:29:48'),(16,'Salmonella spp',NULL,NULL,'2017-05-31 11:29:50','2017-05-31 11:29:50'),(17,'Salmonella typhi',NULL,NULL,'2017-05-31 11:29:51','2017-05-31 11:29:51'),(18,'Salmonella paratyphi B',NULL,NULL,'2017-05-31 11:29:51','2017-05-31 11:29:51'),(19,'Salmonella choleraesuis',NULL,NULL,'2017-05-31 11:29:52','2017-05-31 11:29:52'),(20,'Vibrio cholerae',NULL,NULL,'2017-05-31 11:29:52','2017-05-31 11:29:52'),(21,'Viridans streptococcus',NULL,NULL,'2017-05-31 11:29:52','2017-05-31 11:29:52'),(22,'Staphylococcus aureas',NULL,'2017-06-25 13:34:14','2017-05-31 11:29:53','2017-06-25 13:34:14'),(23,'Staphylococcus aureus',NULL,NULL,'2017-05-31 11:29:54','2017-05-31 11:29:54'),(24,'Staphylococcus epidermidis',NULL,NULL,'2017-05-31 11:29:55','2017-05-31 11:29:55'),(25,'Staphylococcus spp',NULL,NULL,'2017-05-31 11:29:56','2017-05-31 11:29:56'),(26,'Staphylococus aureus',NULL,'2017-06-25 13:35:55','2017-05-31 11:29:57','2017-06-25 13:35:55'),(29,'Staphylococcus horminis',NULL,NULL,'2017-05-31 11:30:00','2017-05-31 11:30:00'),(30,'Staphylococcus pasteuri.',NULL,NULL,'2017-05-31 11:30:01','2017-05-31 11:30:01'),(31,'Staphylococcus saprophyticus',NULL,NULL,'2017-05-31 11:30:02','2017-05-31 11:30:02'),(32,'Enterobacter spp',NULL,NULL,'2017-05-31 11:30:03','2017-05-31 11:30:03'),(33,'Enterobacter cloacae',NULL,NULL,'2017-05-31 11:30:04','2017-05-31 11:30:04'),(34,'Enterococcus spp',NULL,NULL,'2017-05-31 11:30:05','2017-05-31 11:30:05'),(35,'Enterococcus feacalis',NULL,NULL,'2017-05-31 11:30:06','2017-05-31 11:30:06'),(36,'Streptococcus spp',NULL,NULL,'2017-05-31 11:30:07','2017-05-31 11:30:07'),(37,'Burkholderia cepacia',NULL,NULL,'2017-05-31 11:30:07','2017-05-31 11:30:07'),(38,'Burkholderia mallei',NULL,NULL,'2017-05-31 11:30:08','2017-05-31 11:30:08'),(39,'Burkholderia pseudomallei',NULL,NULL,'2017-05-31 11:30:08','2017-05-31 11:30:08'),(40,'Neisseria spp',NULL,NULL,'2017-05-31 11:30:09','2017-05-31 11:30:09'),(41,'Neisseria gonorrhae',NULL,NULL,'2017-05-31 11:30:09','2017-05-31 11:30:09'),(42,'Neisseria gonorrhoeae',NULL,NULL,'2017-05-31 11:30:09','2017-05-31 11:30:09'),(43,'Neisseria meningitidis',NULL,NULL,'2017-05-31 11:30:10','2017-05-31 11:30:10'),(44,'Haemophilus spp',NULL,NULL,'2017-05-31 11:30:10','2017-05-31 11:30:10'),(45,'Haemophilus influenzae spp',NULL,NULL,'2017-05-31 11:30:11','2017-05-31 11:30:11'),(46,'Haemophilus influenzae type B',NULL,NULL,'2017-05-31 11:30:12','2017-05-31 11:30:12'),(47,'Haemophilus influenzae isolated',NULL,'2017-06-25 14:15:27','2017-05-31 11:30:12','2017-06-25 14:15:27'),(48,'Haemophilus influenzae nontypaeble',NULL,NULL,'2017-05-31 11:30:13','2017-05-31 11:30:13'),(52,'Haemophilus influenza',NULL,NULL,'2017-05-31 11:30:16','2017-05-31 11:30:16'),(53,'Haemophilus ducreyi',NULL,NULL,'2017-05-31 11:30:16','2017-05-31 11:30:16'),(54,'Haemophilus aphrophilus',NULL,NULL,'2017-05-31 11:30:17','2017-05-31 11:30:17'),(55,'Haemophilus aegyptius',NULL,NULL,'2017-05-31 11:30:17','2017-05-31 11:30:17'),(56,'Haemophilus parainfluenzae',NULL,NULL,'2017-05-31 11:30:18','2017-05-31 11:30:18'),(61,'Streptococcus pneumoniae',NULL,NULL,'2017-05-31 11:30:21','2017-05-31 11:30:21'),(67,'Enterobacter aerogenes',NULL,NULL,'2017-05-31 11:30:27','2017-05-31 11:30:27'),(68,'Edwardsiella tarda',NULL,NULL,'2017-05-31 11:30:28','2017-05-31 11:30:28'),(69,'Ehrlichia chaffeensis',NULL,NULL,'2017-05-31 11:30:29','2017-05-31 11:30:29'),(70,'Ehrlicia chaffeensis',NULL,'2017-06-25 13:28:41','2017-05-31 11:30:30','2017-06-25 13:28:41'),(71,'Eikenella corrodens',NULL,NULL,'2017-05-31 11:30:31','2017-05-31 11:30:31'),(72,'Klebsiella pneumoniae',NULL,NULL,'2017-05-31 11:30:32','2017-05-31 11:30:32'),(74,'Klebsiella oxytoca',NULL,NULL,'2017-05-31 11:30:35','2017-05-31 11:30:35'),(75,'Kelbsiella spp',NULL,NULL,'2017-05-31 11:30:36','2017-05-31 11:30:36'),(76,'Kingella kingae',NULL,NULL,'2017-05-31 11:30:38','2017-05-31 11:30:38'),(77,'Proteus mirabilis',NULL,NULL,'2017-05-31 11:30:39','2017-05-31 11:30:39'),(79,'Citrobacter freundi',NULL,'2017-06-25 13:27:19','2017-05-31 11:30:41','2017-06-25 13:27:19'),(80,'Citrobacter freundii',NULL,NULL,'2017-05-31 11:30:43','2017-05-31 11:30:43'),(81,'Citrobacter spp',NULL,NULL,'2017-05-31 11:30:44','2017-05-31 11:30:44'),(83,'Providencia spp',NULL,NULL,'2017-05-31 11:30:46','2017-05-31 11:30:46'),(84,'Proteus valgaris',NULL,NULL,'2017-05-31 11:30:48','2017-05-31 11:30:48'),(87,'Providentia rettgeri',NULL,NULL,'2017-05-31 11:30:51','2017-05-31 11:30:51'),(88,'Providentia stuartii',NULL,NULL,'2017-05-31 11:30:52','2017-05-31 11:30:52'),(89,'Salmonella nontyphi group B',NULL,NULL,'2017-05-31 11:30:53','2017-05-31 11:30:53'),(90,'Stenotrophomonas maltophilia',NULL,NULL,'2017-05-31 11:30:53','2017-05-31 11:30:53'),(91,'Morganella morganii',NULL,NULL,'2017-05-31 11:30:54','2017-05-31 11:30:54'),(95,'Morganella spp',NULL,NULL,'2017-05-31 11:30:58','2017-05-31 11:30:58'),(96,'Salmonella paratyphi A',NULL,NULL,'2017-05-31 11:30:59','2017-05-31 11:30:59'),(97,'Enterrococcus faecium',NULL,NULL,'2017-05-31 11:31:00','2017-05-31 11:31:00'),(98,'Shigella boydii',NULL,NULL,'2017-05-31 11:31:01','2017-05-31 11:31:01'),(99,'Shigella dysenteriae',NULL,NULL,'2017-05-31 11:31:01','2017-05-31 11:31:01'),(100,'Shigella flexneri',NULL,NULL,'2017-05-31 11:31:01','2017-05-31 11:31:01'),(101,'Shigella sonnei',NULL,NULL,'2017-05-31 11:31:02','2017-05-31 11:31:02'),(102,'Streptococcus pyogenes',NULL,NULL,'2017-05-31 11:31:02','2017-05-31 11:31:02'),(103,'Streptococcus pyogenes (Group A Strep)',NULL,NULL,'2017-05-31 11:31:03','2017-05-31 11:31:03'),(107,'Streptococcus salivarius',NULL,NULL,'2017-05-31 11:31:05','2017-05-31 11:31:05'),(108,'Streptococcus sanguis',NULL,NULL,'2017-05-31 11:31:05','2017-05-31 11:31:05'),(109,'Salmonella group B',NULL,NULL,'2017-05-31 11:31:06','2017-05-31 11:31:06'),(110,'Moraxella spp',NULL,NULL,'2017-05-31 11:31:07','2017-05-31 11:31:07'),(111,'Coagulase-negative Staphylococcus',NULL,NULL,'2017-05-31 11:31:07','2017-05-31 11:31:07');
/*!40000 ALTER TABLE `organisms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1,1),(2,2,1),(3,3,1),(4,4,1),(5,5,1),(6,6,1),(7,7,1),(8,8,1),(9,9,1),(10,10,1),(11,11,1),(12,12,1),(13,13,1),(14,14,1),(15,15,1),(16,16,1),(17,17,1),(18,18,1),(19,19,1),(20,20,1),(21,21,1),(22,22,1),(23,23,1),(24,24,1),(25,25,1),(26,26,1),(27,27,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'manage_incidents','Can Manage Biorisk & Biosecurity Incidents','2019-03-29 08:55:42','2019-03-29 08:55:42'),(2,'register_incident','Can Register BB Incidences','2019-03-29 08:55:42','2019-03-29 08:55:42'),(3,'summary_log','Can view BB summary log','2019-03-29 08:55:42','2019-03-29 08:55:42'),(4,'facility_report','Can create faility BB report','2019-03-29 08:55:42','2019-03-29 08:55:42'),(5,'view_names','Can view patient names','2019-03-29 08:55:42','2019-03-29 08:55:42'),(6,'manage_patients','Can add patients','2019-03-29 08:55:42','2019-03-29 08:55:42'),(7,'receive_external_test','Can receive test requests','2019-03-29 08:55:42','2019-03-29 08:55:42'),(8,'request_test','Can request new test','2019-03-29 08:55:42','2019-03-29 08:55:42'),(9,'accept_test_specimen','Can accept test specimen','2019-03-29 08:55:42','2019-03-29 08:55:42'),(10,'reject_test_specimen','Can reject test specimen','2019-03-29 08:55:42','2019-03-29 08:55:42'),(11,'change_test_specimen','Can change test specimen','2019-03-29 08:55:42','2019-03-29 08:55:42'),(12,'start_test','Can start tests','2019-03-29 08:55:42','2019-03-29 08:55:42'),(13,'enter_test_results','Can enter tests results','2019-03-29 08:55:42','2019-03-29 08:55:42'),(14,'edit_test_results','Can edit test results','2019-03-29 08:55:42','2019-03-29 08:55:42'),(15,'verify_test_results','Can verify test results','2019-03-29 08:55:42','2019-03-29 08:55:42'),(16,'send_results_to_external_system','Can send test results to external systems','2019-03-29 08:55:42','2019-03-29 08:55:42'),(17,'refer_specimens','Can refer specimens','2019-03-29 08:55:42','2019-03-29 08:55:42'),(18,'manage_users','Can manage users','2019-03-29 08:55:42','2019-03-29 08:55:42'),(19,'manage_test_catalog','Can manage test catalog','2019-03-29 08:55:42','2019-03-29 08:55:42'),(20,'manage_lab_configurations','Can manage lab configurations','2019-03-29 08:55:42','2019-03-29 08:55:42'),(21,'view_reports','Can view reports','2019-03-29 08:55:42','2019-03-29 08:55:42'),(22,'manage_inventory','Can manage inventory','2019-03-29 08:55:42','2019-03-29 08:55:42'),(23,'request_topup','Can request top-up','2019-03-29 08:55:42','2019-03-29 08:55:42'),(24,'manage_qc','Can manage Quality Control','2019-03-29 08:55:42','2019-03-29 08:55:42'),(25,'manage_appointments','Can manage appointments with Clinician','2019-03-29 08:55:49','2019-03-29 08:55:49'),(26,'make_labrequests','Can make lab requests(Only for Clinicians)','2019-03-29 08:55:49','2019-03-29 08:55:49'),(27,'manage_visits','Can manage visit content','2019-03-29 08:55:49','2019-03-29 08:55:49');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poc_results`
--

DROP TABLE IF EXISTS `poc_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poc_results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) unsigned NOT NULL,
  `results` enum('Negative','Positive','Error') COLLATE utf8_unicode_ci NOT NULL,
  `test_date` date NOT NULL,
  `tested_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dispatched_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dispatched_date` date NOT NULL,
  `test_time` time NOT NULL,
  `equipment_used` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `error_code` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `poc_results_patient_id_foreign` (`patient_id`),
  CONSTRAINT `poc_results_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `poc_tables` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poc_results`
--

LOCK TABLES `poc_results` WRITE;
/*!40000 ALTER TABLE `poc_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `poc_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poc_tables`
--

DROP TABLE IF EXISTS `poc_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poc_tables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facility_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` float(8,2) NOT NULL,
  `exp_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provisional_diagnosis` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caretaker_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entry_point` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `infant_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `breastfeeding_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mother_hiv_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `collection_date` date NOT NULL,
  `pcr_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pmtct_antenatal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pmtct_delivery` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pmtct_postnatal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admission_date` date NOT NULL,
  `sample_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `infant_pmtctarv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mother_pmtctarv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_entry_point` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poc_tables`
--

LOCK TABLES `poc_tables` WRITE;
/*!40000 ALTER TABLE `poc_tables` DISABLE KEYS */;
/*!40000 ALTER TABLE `poc_tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pre_analytic_specimen_rejections`
--

DROP TABLE IF EXISTS `pre_analytic_specimen_rejections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pre_analytic_specimen_rejections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `specimen_id` int(10) unsigned NOT NULL,
  `rejected_by` int(10) unsigned NOT NULL,
  `rejection_reason_id` int(10) unsigned DEFAULT NULL,
  `reject_explained_to` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_rejected` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pre_analytic_specimen_rejections_rejected_by_index` (`rejected_by`),
  KEY `pre_analytic_specimen_rejections_specimen_id_foreign` (`specimen_id`),
  KEY `pre_analytic_specimen_rejections_rejection_reason_id_foreign` (`rejection_reason_id`),
  CONSTRAINT `pre_analytic_specimen_rejections_rejection_reason_id_foreign` FOREIGN KEY (`rejection_reason_id`) REFERENCES `rejection_reasons` (`id`),
  CONSTRAINT `pre_analytic_specimen_rejections_specimen_id_foreign` FOREIGN KEY (`specimen_id`) REFERENCES `specimens` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pre_analytic_specimen_rejections`
--

LOCK TABLES `pre_analytic_specimen_rejections` WRITE;
/*!40000 ALTER TABLE `pre_analytic_specimen_rejections` DISABLE KEYS */;
/*!40000 ALTER TABLE `pre_analytic_specimen_rejections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipts`
--

DROP TABLE IF EXISTS `receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receipts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commodity_id` int(10) unsigned NOT NULL,
  `supplier_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `batch_no` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `expiry_date` date NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `receipts_commodity_id_foreign` (`commodity_id`),
  KEY `receipts_supplier_id_foreign` (`supplier_id`),
  KEY `receipts_user_id_foreign` (`user_id`),
  CONSTRAINT `receipts_commodity_id_foreign` FOREIGN KEY (`commodity_id`) REFERENCES `commodities` (`id`),
  CONSTRAINT `receipts_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  CONSTRAINT `receipts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipts`
--

LOCK TABLES `receipts` WRITE;
/*!40000 ALTER TABLE `receipts` DISABLE KEYS */;
/*!40000 ALTER TABLE `receipts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referral_reasons`
--

DROP TABLE IF EXISTS `referral_reasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referral_reasons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reason` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referral_reasons`
--

LOCK TABLES `referral_reasons` WRITE;
/*!40000 ALTER TABLE `referral_reasons` DISABLE KEYS */;
/*!40000 ALTER TABLE `referral_reasons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referrals`
--

DROP TABLE IF EXISTS `referrals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referrals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sample_obtainer` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `cadre_obtainer` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `sample_date` date NOT NULL,
  `sample_time` timestamp NULL DEFAULT NULL,
  `time_dispatch` timestamp NULL DEFAULT NULL,
  `storage_condition` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `transport_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(10) unsigned NOT NULL,
  `referral_reason` int(10) unsigned NOT NULL,
  `priority_specimen` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `facility_id` int(10) unsigned NOT NULL,
  `person` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `contacts` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `referrals_user_id_foreign` (`user_id`),
  KEY `referrals_facility_id_foreign` (`facility_id`),
  CONSTRAINT `referrals_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`),
  CONSTRAINT `referrals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referrals`
--

LOCK TABLES `referrals` WRITE;
/*!40000 ALTER TABLE `referrals` DISABLE KEYS */;
/*!40000 ALTER TABLE `referrals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rejection_reasons`
--

DROP TABLE IF EXISTS `rejection_reasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rejection_reasons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reason` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rejection_reasons`
--

LOCK TABLES `rejection_reasons` WRITE;
/*!40000 ALTER TABLE `rejection_reasons` DISABLE KEYS */;
INSERT INTO `rejection_reasons` VALUES (1,'Inadequate sample volume'),(2,'Haemolysed sample'),(3,'Specimen without lab request form'),(4,'No test ordered on  lab request form of sample'),(5,'No sample label or identifier'),(6,'Wrong sample label'),(7,'Unclear sample label'),(8,'Sample in wrong container'),(9,'Damaged/broken/leaking sample container'),(10,'Too old sample'),(11,'Date of sample collection not specified'),(12,'Time of sample collection not specified'),(13,'Improper transport media'),(14,'Sample type unacceptable for required test'),(15,'Other');
/*!40000 ALTER TABLE `rejection_reasons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_diseases`
--

DROP TABLE IF EXISTS `report_diseases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_diseases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_type_id` int(10) unsigned NOT NULL,
  `disease_id` int(10) unsigned NOT NULL,
  `result_interpretation_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `report_diseases_test_type_id_disease_id_unique` (`test_type_id`,`disease_id`),
  KEY `report_diseases_disease_id_foreign` (`disease_id`),
  CONSTRAINT `report_diseases_disease_id_foreign` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`),
  CONSTRAINT `report_diseases_test_type_id_foreign` FOREIGN KEY (`test_type_id`) REFERENCES `test_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_diseases`
--

LOCK TABLES `report_diseases` WRITE;
/*!40000 ALTER TABLE `report_diseases` DISABLE KEYS */;
INSERT INTO `report_diseases` VALUES (1,2,1,NULL),(2,7,2,NULL),(3,18,3,NULL);
/*!40000 ALTER TABLE `report_diseases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `result_interpretations`
--

DROP TABLE IF EXISTS `result_interpretations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `result_interpretations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `result_interpretations`
--

LOCK TABLES `result_interpretations` WRITE;
/*!40000 ALTER TABLE `result_interpretations` DISABLE KEYS */;
INSERT INTO `result_interpretations` VALUES (1,'High'),(2,'Normal'),(3,'Low'),(4,'HGB<8'),(5,'HGB≥8'),(6,'Positive'),(7,'Negative');
/*!40000 ALTER TABLE `result_interpretations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Superadmin',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(2,'Technologist',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(3,'Receptionist',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specimen_statuses`
--

DROP TABLE IF EXISTS `specimen_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specimen_statuses` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specimen_statuses`
--

LOCK TABLES `specimen_statuses` WRITE;
/*!40000 ALTER TABLE `specimen_statuses` DISABLE KEYS */;
INSERT INTO `specimen_statuses` VALUES (1,'specimen-not-collected'),(2,'specimen-accepted'),(3,'specimen-rejected');
/*!40000 ALTER TABLE `specimen_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specimen_types`
--

DROP TABLE IF EXISTS `specimen_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specimen_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specimen_types`
--

LOCK TABLES `specimen_types` WRITE;
/*!40000 ALTER TABLE `specimen_types` DISABLE KEYS */;
INSERT INTO `specimen_types` VALUES (1,'Ascitic Tap',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(2,'Dried Blood Spot',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(3,'Nasal Swab',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(4,'Pleural Tap',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(5,'Rectal Swab',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(6,'Semen',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(7,'Skin',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(8,'Vomitus',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(9,'Synovial Fluid',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(10,'Urethral Smear',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(11,'Vaginal Smear',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(12,'Water',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(13,'Stool',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(14,'CSF',NULL,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(15,'Wound swab',NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(16,'Pus swab',NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(17,'HVS',NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(18,'Eye swab',NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(19,'Ear swab',NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(20,'Throat swab',NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(21,'Pus Aspirate',NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(22,'Blood',NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(23,'BAL',NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(24,'Sputum',NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(25,'Uretheral swab',NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(26,'Urine',NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43');
/*!40000 ALTER TABLE `specimen_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specimens`
--

DROP TABLE IF EXISTS `specimens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specimens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `specimen_type_id` int(10) unsigned NOT NULL,
  `specimen_status_id` int(10) unsigned NOT NULL DEFAULT '2',
  `accepted_by` int(10) unsigned NOT NULL DEFAULT '0',
  `referral_id` int(10) unsigned DEFAULT NULL,
  `time_collected` timestamp NULL DEFAULT NULL,
  `time_accepted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `specimens_accepted_by_index` (`accepted_by`),
  KEY `specimens_specimen_type_id_foreign` (`specimen_type_id`),
  KEY `specimens_specimen_status_id_foreign` (`specimen_status_id`),
  KEY `specimens_referral_id_foreign` (`referral_id`),
  CONSTRAINT `specimens_referral_id_foreign` FOREIGN KEY (`referral_id`) REFERENCES `referrals` (`id`),
  CONSTRAINT `specimens_specimen_status_id_foreign` FOREIGN KEY (`specimen_status_id`) REFERENCES `specimen_statuses` (`id`),
  CONSTRAINT `specimens_specimen_type_id_foreign` FOREIGN KEY (`specimen_type_id`) REFERENCES `specimen_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specimens`
--

LOCK TABLES `specimens` WRITE;
/*!40000 ALTER TABLE `specimens` DISABLE KEYS */;
INSERT INTO `specimens` VALUES (1,22,2,1,NULL,'2019-03-29 08:58:00','2019-03-29 08:58:00'),(2,22,2,1,NULL,'2019-03-29 08:58:00','2019-03-29 08:58:00');
/*!40000 ALTER TABLE `specimens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `physical_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_categories`
--

DROP TABLE IF EXISTS `test_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `test_categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_categories`
--

LOCK TABLES `test_categories` WRITE;
/*!40000 ALTER TABLE `test_categories` DISABLE KEYS */;
INSERT INTO `test_categories` VALUES (1,'PARASITOLOGY','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(2,'MICROBIOLOGY','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(3,'HEMATOLOGY','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(4,'SEROLOGY','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(5,'BLOOD TRANSFUSION','',NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43');
/*!40000 ALTER TABLE `test_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_name_mappings`
--

DROP TABLE IF EXISTS `test_name_mappings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_name_mappings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_type_id` int(10) unsigned DEFAULT NULL,
  `standard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `system_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `test_name_mappings_system_name_unique` (`system_name`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_name_mappings`
--

LOCK TABLES `test_name_mappings` WRITE;
/*!40000 ALTER TABLE `test_name_mappings` DISABLE KEYS */;
INSERT INTO `test_name_mappings` VALUES (1,NULL,'CBC','cbc'),(2,NULL,'Hb','hb'),(3,NULL,'ESR','esr'),(4,NULL,'Bleeding time','bleeding_time'),(5,NULL,'Prothrombin Time','prothrombin_time'),(6,NULL,'Clotting Time','clotting_time'),(7,NULL,'ABO Grouping','abo_grouping'),(8,NULL,'Combs','combs'),(9,NULL,'Cross Matching','cross_matching'),(10,NULL,'Malaria Microscopy','malaria_microscopy'),(11,NULL,'Malaria RDTs','malaria_rdts'),(12,NULL,'Stool Microscopy','stool_microscopy'),(13,NULL,'VDRL/RPR','vdrl_rpr'),(14,NULL,'TPHA','tpha'),(15,NULL,'Shigella Dysentery','shigella_dysentery'),(16,NULL,'Hepatitis B','hepatitis_b'),(17,NULL,'Brucella','brucella'),(18,NULL,'Pregnancy Test','pregnancy_test'),(19,NULL,'Rheumatoid Factor','rheumatoid_factor'),(20,NULL,'CD4 tests','cd4_tests'),(21,NULL,'Viral Load Tests','viral_load_tests'),(22,NULL,'ZN for AFBs','zn_for_afbs'),(23,NULL,'Culture & Sensitivity','culture_sensitivity'),(24,NULL,'Gram Stain','gram_stain'),(25,NULL,'India Ink','india_ink'),(26,NULL,'Wet Preps','wet_preps'),(27,NULL,'Urine Microscopy','urine_microscopy'),(28,NULL,'Renal Profile','renal_profile'),(29,NULL,'Liver Profile','liver_profile'),(30,NULL,'Lipid/Cardiac Profile','lipid_cardiac_profile'),(31,NULL,'Alkaline Phosphates','alkaline_phosphates'),(32,NULL,'Amylase','amylase'),(33,NULL,'Glucose','glucose'),(34,NULL,'Uric Acid','uric_acid'),(35,NULL,'Lactate','lactate'),(36,NULL,'HIV','hiv');
/*!40000 ALTER TABLE `test_name_mappings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_phases`
--

DROP TABLE IF EXISTS `test_phases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_phases` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_phases`
--

LOCK TABLES `test_phases` WRITE;
/*!40000 ALTER TABLE `test_phases` DISABLE KEYS */;
INSERT INTO `test_phases` VALUES (1,'Pre-Analytical'),(2,'Analytical'),(3,'Post-Analytical');
/*!40000 ALTER TABLE `test_phases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_statuses`
--

DROP TABLE IF EXISTS `test_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_statuses` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `test_phase_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `test_statuses_test_phase_id_foreign` (`test_phase_id`),
  CONSTRAINT `test_statuses_test_phase_id_foreign` FOREIGN KEY (`test_phase_id`) REFERENCES `test_phases` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_statuses`
--

LOCK TABLES `test_statuses` WRITE;
/*!40000 ALTER TABLE `test_statuses` DISABLE KEYS */;
INSERT INTO `test_statuses` VALUES (1,'not-received',1),(2,'pending',1),(3,'started',2),(4,'completed',3),(5,'verified',3),(6,'specimen-rejected-at-analysis',3);
/*!40000 ALTER TABLE `test_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_types`
--

DROP TABLE IF EXISTS `test_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `test_category_id` int(10) unsigned NOT NULL,
  `targetTAT` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `orderable_test` int(11) DEFAULT NULL,
  `prevalence_threshold` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accredited` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `test_types_test_category_id_foreign` (`test_category_id`),
  CONSTRAINT `test_types_test_category_id_foreign` FOREIGN KEY (`test_category_id`) REFERENCES `test_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_types`
--

LOCK TABLES `test_types` WRITE;
/*!40000 ALTER TABLE `test_types` DISABLE KEYS */;
INSERT INTO `test_types` VALUES (1,'HIV',NULL,4,NULL,1,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(2,'BS for mps',NULL,1,NULL,1,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(3,'GXM',NULL,1,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(4,'HB',NULL,1,NULL,1,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(5,'Urinalysis',NULL,1,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(6,'WBC',NULL,1,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(7,'Salmonella Antigen Test',NULL,1,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(8,'Direct COOMBS Test',NULL,5,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(9,'DU Test',NULL,5,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(10,'Sickling Test',NULL,3,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(11,'Borrelia',NULL,1,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(12,'VDRL',NULL,4,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(13,'Pregnancy Test',NULL,4,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(14,'Brucella',NULL,4,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(15,'H. Pylori',NULL,4,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:43','2019-03-29 08:55:43'),(16,'CBC',NULL,3,NULL,1,NULL,NULL,NULL,'2019-03-29 08:55:44','2019-03-29 08:55:44'),(17,'Appearance',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(18,'Culture and Sensitivity',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(19,'Gram Staining',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(20,'India Ink Staining',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(21,'Protein',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(22,'Wet preparation (saline preparation)',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(23,'Wet Saline Iodine Prep',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(24,'White Blood Cell Count',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(25,'ZN Staining',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(26,'Modified ZN',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(27,'Crag',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(28,'Differential',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(29,'Total Cell Count',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(30,'Lymphocytes',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(31,'Quantitative Culture',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(32,'RBC Count',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(33,'TPHA',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(34,'HCG',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(35,'Bilirubin',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(36,'Blood',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(37,'Glucose',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(38,'Ketones',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(39,'Leukocytes',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(40,'Microscopy',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(41,'Nitrite',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(42,'pH',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(43,'Specific Gravity',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(44,'Urobilinogen',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:45','2019-03-29 08:55:45'),(45,'RPR',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:46','2019-03-29 08:55:46'),(46,'Serum Crag',NULL,2,NULL,NULL,NULL,NULL,NULL,'2019-03-29 08:55:46','2019-03-29 08:55:46');
/*!40000 ALTER TABLE `test_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testtype_measures`
--

DROP TABLE IF EXISTS `testtype_measures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testtype_measures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_type_id` int(10) unsigned NOT NULL,
  `measure_id` int(10) unsigned NOT NULL,
  `ordering` tinyint(4) DEFAULT NULL,
  `nesting` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `testtype_measures_test_type_id_measure_id_unique` (`test_type_id`,`measure_id`),
  KEY `testtype_measures_measure_id_foreign` (`measure_id`),
  CONSTRAINT `testtype_measures_measure_id_foreign` FOREIGN KEY (`measure_id`) REFERENCES `measures` (`id`),
  CONSTRAINT `testtype_measures_test_type_id_foreign` FOREIGN KEY (`test_type_id`) REFERENCES `test_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testtype_measures`
--

LOCK TABLES `testtype_measures` WRITE;
/*!40000 ALTER TABLE `testtype_measures` DISABLE KEYS */;
INSERT INTO `testtype_measures` VALUES (1,1,1,NULL,NULL),(2,1,2,NULL,NULL),(3,1,3,NULL,NULL),(4,2,4,NULL,NULL),(5,3,5,NULL,NULL),(6,3,6,NULL,NULL),(7,4,7,NULL,NULL),(8,5,8,NULL,NULL),(9,5,9,NULL,NULL),(10,5,10,NULL,NULL),(11,5,11,NULL,NULL),(12,5,12,NULL,NULL),(13,5,13,NULL,NULL),(14,5,14,NULL,NULL),(15,5,15,NULL,NULL),(16,5,16,NULL,NULL),(17,5,17,NULL,NULL),(18,5,18,NULL,NULL),(19,5,19,NULL,NULL),(20,5,20,NULL,NULL),(21,5,21,NULL,NULL),(22,5,22,NULL,NULL),(23,6,23,NULL,NULL),(24,6,24,NULL,NULL),(25,6,25,NULL,NULL),(26,6,26,NULL,NULL),(27,6,27,NULL,NULL),(28,6,28,NULL,NULL),(29,7,29,NULL,NULL),(30,8,30,NULL,NULL),(31,9,31,NULL,NULL),(32,10,32,NULL,NULL),(33,11,33,NULL,NULL),(34,12,34,NULL,NULL),(35,13,35,NULL,NULL),(36,14,36,NULL,NULL),(37,15,37,NULL,NULL),(38,16,38,NULL,NULL),(39,16,39,NULL,NULL),(40,16,40,NULL,NULL),(41,16,41,NULL,NULL),(42,16,42,NULL,NULL),(43,16,43,NULL,NULL),(44,16,44,NULL,NULL),(45,16,45,NULL,NULL),(46,16,46,NULL,NULL),(47,16,47,NULL,NULL),(48,16,48,NULL,NULL),(49,16,49,NULL,NULL),(50,16,50,NULL,NULL),(51,16,51,NULL,NULL),(52,16,52,NULL,NULL),(53,16,53,NULL,NULL),(54,16,54,NULL,NULL),(55,16,55,NULL,NULL),(56,16,56,NULL,NULL),(57,16,57,NULL,NULL),(58,16,58,NULL,NULL),(59,16,59,NULL,NULL),(60,16,60,NULL,NULL),(61,16,61,NULL,NULL),(62,34,69,NULL,NULL),(63,35,70,NULL,NULL),(64,36,71,NULL,NULL),(65,37,72,NULL,NULL),(66,38,73,NULL,NULL),(67,39,74,NULL,NULL),(68,40,75,NULL,NULL),(69,41,76,NULL,NULL),(70,42,77,NULL,NULL),(71,21,78,NULL,NULL),(72,43,79,NULL,NULL),(73,44,80,NULL,NULL),(74,27,62,NULL,NULL),(75,28,63,NULL,NULL),(76,29,64,NULL,NULL),(77,30,65,NULL,NULL),(78,31,66,NULL,NULL),(79,32,67,NULL,NULL),(80,33,68,NULL,NULL),(81,18,82,NULL,NULL),(82,19,83,NULL,NULL),(83,17,81,NULL,NULL),(84,20,84,NULL,NULL),(85,21,85,NULL,NULL),(86,22,86,NULL,NULL),(87,24,87,NULL,NULL),(88,25,88,NULL,NULL),(89,26,89,NULL,NULL),(90,45,97,NULL,NULL),(91,46,98,NULL,NULL);
/*!40000 ALTER TABLE `testtype_measures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testtype_specimentypes`
--

DROP TABLE IF EXISTS `testtype_specimentypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testtype_specimentypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_type_id` int(10) unsigned NOT NULL,
  `specimen_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `testtype_specimentypes_test_type_id_specimen_type_id_unique` (`test_type_id`,`specimen_type_id`),
  KEY `testtype_specimentypes_specimen_type_id_foreign` (`specimen_type_id`),
  CONSTRAINT `testtype_specimentypes_specimen_type_id_foreign` FOREIGN KEY (`specimen_type_id`) REFERENCES `specimen_types` (`id`),
  CONSTRAINT `testtype_specimentypes_test_type_id_foreign` FOREIGN KEY (`test_type_id`) REFERENCES `test_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testtype_specimentypes`
--

LOCK TABLES `testtype_specimentypes` WRITE;
/*!40000 ALTER TABLE `testtype_specimentypes` DISABLE KEYS */;
INSERT INTO `testtype_specimentypes` VALUES (1,1,22),(2,2,22),(3,3,22),(5,4,3),(6,4,4),(7,4,8),(4,4,22),(8,6,22),(9,7,22),(10,8,22),(11,9,22),(12,10,22),(13,11,26),(14,12,22),(15,13,26),(16,14,22),(17,15,13),(18,16,22),(32,17,13),(36,17,14),(55,17,15),(51,17,16),(63,17,17),(68,17,18),(69,17,19),(72,17,20),(77,17,21),(80,17,23),(85,17,24),(59,17,25),(35,17,26),(31,18,13),(42,18,14),(57,18,15),(53,18,16),(65,18,17),(67,18,18),(71,18,19),(74,18,20),(79,18,21),(91,18,22),(83,18,23),(87,18,24),(61,18,25),(34,18,26),(40,19,14),(54,19,15),(50,19,16),(64,19,17),(66,19,18),(70,19,19),(73,19,20),(76,19,21),(81,19,23),(86,19,24),(60,19,25),(38,20,14),(37,21,14),(75,21,21),(28,21,26),(62,22,17),(58,22,25),(39,24,14),(41,25,14),(56,25,15),(52,25,16),(78,25,21),(82,25,23),(84,25,24),(33,26,13),(43,27,14),(44,28,14),(45,29,14),(46,30,14),(48,31,14),(49,32,14),(47,33,14),(90,33,22),(19,34,26),(20,35,26),(21,36,26),(22,37,26),(23,38,26),(24,39,26),(25,40,26),(26,41,26),(27,42,26),(29,43,26),(30,44,26),(88,45,22),(89,46,22);
/*!40000 ALTER TABLE `testtype_specimentypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `therapy`
--

DROP TABLE IF EXISTS `therapy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `therapy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visit_id` int(10) unsigned NOT NULL,
  `patient_id` int(10) unsigned NOT NULL,
  `previous_therapy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_therapy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clinical_notes` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clinician` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `therapy`
--

LOCK TABLES `therapy` WRITE;
/*!40000 ALTER TABLE `therapy` DISABLE KEYS */;
INSERT INTO `therapy` VALUES (1,1,1,'','',NULL,NULL,NULL),(2,2,1,'','',NULL,NULL,NULL);
/*!40000 ALTER TABLE `therapy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokens` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `tokens_email_index` (`email`),
  KEY `tokens_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokens`
--

LOCK TABLES `tokens` WRITE;
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topup_requests`
--

DROP TABLE IF EXISTS `topup_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topup_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commodity_id` int(10) unsigned NOT NULL,
  `test_category_id` int(10) unsigned NOT NULL,
  `order_quantity` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `remarks` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `topup_requests_test_category_id_foreign` (`test_category_id`),
  KEY `topup_requests_commodity_id_foreign` (`commodity_id`),
  KEY `topup_requests_user_id_foreign` (`user_id`),
  CONSTRAINT `topup_requests_commodity_id_foreign` FOREIGN KEY (`commodity_id`) REFERENCES `commodities` (`id`),
  CONSTRAINT `topup_requests_test_category_id_foreign` FOREIGN KEY (`test_category_id`) REFERENCES `test_categories` (`id`),
  CONSTRAINT `topup_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topup_requests`
--

LOCK TABLES `topup_requests` WRITE;
/*!40000 ALTER TABLE `topup_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `topup_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_bbactions`
--

DROP TABLE IF EXISTS `unhls_bbactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_bbactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `actionname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_bbactions`
--

LOCK TABLES `unhls_bbactions` WRITE;
/*!40000 ALTER TABLE `unhls_bbactions` DISABLE KEYS */;
INSERT INTO `unhls_bbactions` VALUES (1,'Reported to administration for further action','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(2,'Referred to mental department','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(3,'Gave first aid (e.g. arrested bleeding)','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(4,'Referred to clinician for further management','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(5,'Conducted risk assessment','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(6,'Intervened to interrupt/arrest progress of incident (e.g. Used neutralizing agent, stopping a fight)','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(7,'Disposed off broken container to designated waste bin/sharps','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(8,'Patient sample taken & referred to testing lab Isolated suspected patient','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(9,'Reported to or engaged national level BRM for intervention','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(10,'Victim counseled','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(11,'Contacted Police','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(12,'Used spill kit','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(13,'Administered PEP','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(14,'Referred to disciplinary committee','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(15,'Contained the spillage','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(16,'Disinfected the place','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(17,'Switched off the Electricity Mains','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(18,'Washed punctured area','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(19,'Others','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL);
/*!40000 ALTER TABLE `unhls_bbactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_bbcauses`
--

DROP TABLE IF EXISTS `unhls_bbcauses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_bbcauses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `causename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_bbcauses`
--

LOCK TABLES `unhls_bbcauses` WRITE;
/*!40000 ALTER TABLE `unhls_bbcauses` DISABLE KEYS */;
INSERT INTO `unhls_bbcauses` VALUES (1,'Defective Equipment','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(2,'Hazardous Chemicals','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(3,'Unsafe Procedure','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(4,'Psychological causes (e.g. emotional condition, depression, mental confusion)','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(5,'Unsafe storage of laboratory chemicals','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(6,'Lack of Skill or Knowledge','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(7,'Lack of Personal Protective Equipment','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(8,'Unsafe Working Environment','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(9,'Lack of Adequate Physical Security','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(10,'Unsafe location of laboratory equipment','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL),(11,'Other','2019-03-29 08:55:42','2019-03-29 08:55:42',NULL);
/*!40000 ALTER TABLE `unhls_bbcauses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_bbincidences`
--

DROP TABLE IF EXISTS `unhls_bbincidences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_bbincidences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facility_id` int(10) unsigned NOT NULL,
  `serial_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `occurrence_date` date NOT NULL,
  `occurrence_time` time NOT NULL,
  `personnel_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personnel_surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personnel_othername` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personnel_gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personnel_dob` date NOT NULL,
  `personnel_age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personnel_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personnel_telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personnel_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nok_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nok_telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nok_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lab_section` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `occurrence` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ulin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `equip_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `equip_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `task` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `officer_fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `officer_lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `officer_cadre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `officer_telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstaid` text COLLATE utf8_unicode_ci NOT NULL,
  `intervention` text COLLATE utf8_unicode_ci NOT NULL,
  `intervention_date` date NOT NULL,
  `intervention_time` time NOT NULL,
  `intervention_followup` text COLLATE utf8_unicode_ci NOT NULL,
  `mo_fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cause` text COLLATE utf8_unicode_ci NOT NULL,
  `corrective_action` text COLLATE utf8_unicode_ci NOT NULL,
  `referral_status` text COLLATE utf8_unicode_ci NOT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL,
  `analysis_date` date NOT NULL,
  `analysis_time` time NOT NULL,
  `bo_fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bo_lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bo_designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bo_telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `findings` text COLLATE utf8_unicode_ci NOT NULL,
  `improvement_plan` text COLLATE utf8_unicode_ci NOT NULL,
  `response_date` date NOT NULL,
  `response_time` time NOT NULL,
  `brm_fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brm_lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brm_designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brm_telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdby` int(10) unsigned DEFAULT NULL,
  `updatedby` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `unhls_bbincidences_facility_id_foreign` (`facility_id`),
  KEY `unhls_bbincidences_createdby_foreign` (`createdby`),
  CONSTRAINT `unhls_bbincidences_createdby_foreign` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `unhls_bbincidences_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `unhls_facilities` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_bbincidences`
--

LOCK TABLES `unhls_bbincidences` WRITE;
/*!40000 ALTER TABLE `unhls_bbincidences` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_bbincidences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_bbincidences_action`
--

DROP TABLE IF EXISTS `unhls_bbincidences_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_bbincidences_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bbincidence_id` int(10) unsigned NOT NULL,
  `action_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `unhls_bbincidences_action_bbincidence_id_foreign` (`bbincidence_id`),
  KEY `unhls_bbincidences_action_action_id_foreign` (`action_id`),
  CONSTRAINT `unhls_bbincidences_action_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `unhls_bbactions` (`id`),
  CONSTRAINT `unhls_bbincidences_action_bbincidence_id_foreign` FOREIGN KEY (`bbincidence_id`) REFERENCES `unhls_bbincidences` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_bbincidences_action`
--

LOCK TABLES `unhls_bbincidences_action` WRITE;
/*!40000 ALTER TABLE `unhls_bbincidences_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_bbincidences_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_bbincidences_cause`
--

DROP TABLE IF EXISTS `unhls_bbincidences_cause`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_bbincidences_cause` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bbincidence_id` int(10) unsigned NOT NULL,
  `cause_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `unhls_bbincidences_cause_bbincidence_id_foreign` (`bbincidence_id`),
  KEY `unhls_bbincidences_cause_cause_id_foreign` (`cause_id`),
  CONSTRAINT `unhls_bbincidences_cause_bbincidence_id_foreign` FOREIGN KEY (`bbincidence_id`) REFERENCES `unhls_bbincidences` (`id`),
  CONSTRAINT `unhls_bbincidences_cause_cause_id_foreign` FOREIGN KEY (`cause_id`) REFERENCES `unhls_bbcauses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_bbincidences_cause`
--

LOCK TABLES `unhls_bbincidences_cause` WRITE;
/*!40000 ALTER TABLE `unhls_bbincidences_cause` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_bbincidences_cause` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_bbincidences_nature`
--

DROP TABLE IF EXISTS `unhls_bbincidences_nature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_bbincidences_nature` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bbincidence_id` int(10) unsigned NOT NULL,
  `nature_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `unhls_bbincidences_nature_bbincidence_id_foreign` (`bbincidence_id`),
  KEY `unhls_bbincidences_nature_nature_id_foreign` (`nature_id`),
  CONSTRAINT `unhls_bbincidences_nature_bbincidence_id_foreign` FOREIGN KEY (`bbincidence_id`) REFERENCES `unhls_bbincidences` (`id`),
  CONSTRAINT `unhls_bbincidences_nature_nature_id_foreign` FOREIGN KEY (`nature_id`) REFERENCES `unhls_bbnatures` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_bbincidences_nature`
--

LOCK TABLES `unhls_bbincidences_nature` WRITE;
/*!40000 ALTER TABLE `unhls_bbincidences_nature` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_bbincidences_nature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_bbnatures`
--

DROP TABLE IF EXISTS `unhls_bbnatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_bbnatures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priority` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_bbnatures`
--

LOCK TABLES `unhls_bbnatures` WRITE;
/*!40000 ALTER TABLE `unhls_bbnatures` DISABLE KEYS */;
INSERT INTO `unhls_bbnatures` VALUES (1,'Assault/Fight among staff','Physical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(2,'Fainting','Physical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(3,'Roof leakages','Physical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(4,'Machine cuts/bruises','Mechanical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(5,'Electric shock/burn','Mechanical','Major',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(6,'Death within lab','Ergonometric and Medical','Major',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(7,'Slip or fall','Physical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(8,'Unnecessary destruction of lab material','Physical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(9,'Theft of laboratory consumables','Physical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(10,'Breakage of sample container','Physical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(11,'Prick/cut by unused sharps','Physical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(12,'Injury caused by laboratory objects','Physical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(13,'Chemical burn','Chemical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(14,'Theft of chemical','Chemical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(15,'Chemical spillage','Chemical','Major',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(16,'Theft of equipment','Physical','Major',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(17,'Attack on the Lab','Physical','Major',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(18,'Collapsing building','Physical','Major',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(19,'Bike rider accident','Physical','Major',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(20,'Fire','Physical','Major',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(21,'Needle prick or cuts by used sharps','Biological','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(22,'Sample spillage','Biological','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(23,'Theft of samples','Biological','Major',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(24,'Contact with VHF suspect','Biological','Major',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(25,'Contact with radiological materials','Radiological','Major',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(26,'Theft of radiological materials','Radiological','Major',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(27,'Poor disposal of radiological materials','Radiological','Major',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(28,'Poor vision from inadequate light','Ergonometric and Medical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(29,'Back pain from posture effects','Ergonometric and Medical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(30,'Other occupational hazard','Ergonometric and Medical','Minor',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42'),(31,'Other','Other','Other',NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42');
/*!40000 ALTER TABLE `unhls_bbnatures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_districts`
--

DROP TABLE IF EXISTS `unhls_districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_districts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_districts`
--

LOCK TABLES `unhls_districts` WRITE;
/*!40000 ALTER TABLE `unhls_districts` DISABLE KEYS */;
INSERT INTO `unhls_districts` VALUES (1,'TORORO','2019-03-29 08:55:41','2019-03-29 08:55:41'),(2,'Buikwe','2019-03-29 08:55:41','2019-03-29 08:55:41'),(3,'Bukomansimbi','2019-03-29 08:55:41','2019-03-29 08:55:41'),(4,'Butambala','2019-03-29 08:55:41','2019-03-29 08:55:41'),(5,'Buvuma','2019-03-29 08:55:41','2019-03-29 08:55:41'),(6,'Gomba','2019-03-29 08:55:41','2019-03-29 08:55:41'),(7,'Kalangala','2019-03-29 08:55:41','2019-03-29 08:55:41'),(8,'Kalungu','2019-03-29 08:55:41','2019-03-29 08:55:41'),(9,'Kayunga','2019-03-29 08:55:41','2019-03-29 08:55:41'),(10,'Kiboga','2019-03-29 08:55:41','2019-03-29 08:55:41'),(11,'Kyankwanzi','2019-03-29 08:55:41','2019-03-29 08:55:41'),(12,'Luweero','2019-03-29 08:55:41','2019-03-29 08:55:41'),(13,'Lwengo','2019-03-29 08:55:41','2019-03-29 08:55:41'),(14,'Lyantonde','2019-03-29 08:55:41','2019-03-29 08:55:41'),(15,'Masaka','2019-03-29 08:55:41','2019-03-29 08:55:41'),(16,'Mityana','2019-03-29 08:55:41','2019-03-29 08:55:41'),(17,'Mpigi','2019-03-29 08:55:41','2019-03-29 08:55:41'),(18,'Mubende','2019-03-29 08:55:41','2019-03-29 08:55:41'),(19,'Mukono','2019-03-29 08:55:41','2019-03-29 08:55:41'),(20,'Nakaseke','2019-03-29 08:55:41','2019-03-29 08:55:41'),(21,'Nakasongola','2019-03-29 08:55:41','2019-03-29 08:55:41'),(22,'Rakai','2019-03-29 08:55:41','2019-03-29 08:55:41'),(23,'Ssembabule','2019-03-29 08:55:41','2019-03-29 08:55:41'),(24,'Wakiso','2019-03-29 08:55:41','2019-03-29 08:55:41'),(25,'Amuria','2019-03-29 08:55:41','2019-03-29 08:55:41'),(26,'Budaka','2019-03-29 08:55:41','2019-03-29 08:55:41'),(27,'Bududa','2019-03-29 08:55:41','2019-03-29 08:55:41'),(28,'Bugiri','2019-03-29 08:55:41','2019-03-29 08:55:41'),(29,'Bukedea','2019-03-29 08:55:41','2019-03-29 08:55:41'),(30,'Bukwa','2019-03-29 08:55:41','2019-03-29 08:55:41'),(31,'Bulambuli','2019-03-29 08:55:41','2019-03-29 08:55:41'),(32,'Busia','2019-03-29 08:55:41','2019-03-29 08:55:41'),(33,'Butaleja','2019-03-29 08:55:41','2019-03-29 08:55:41'),(34,'Buyende','2019-03-29 08:55:41','2019-03-29 08:55:41'),(35,'Iganga','2019-03-29 08:55:41','2019-03-29 08:55:41'),(36,'Jinja','2019-03-29 08:55:41','2019-03-29 08:55:41'),(37,'Kaberamaido','2019-03-29 08:55:41','2019-03-29 08:55:41'),(38,'Kaliro','2019-03-29 08:55:41','2019-03-29 08:55:41'),(39,'Kamuli','2019-03-29 08:55:41','2019-03-29 08:55:41'),(40,'Kapchorwa','2019-03-29 08:55:41','2019-03-29 08:55:41'),(41,'Katakwi','2019-03-29 08:55:41','2019-03-29 08:55:41'),(42,'Kibuku','2019-03-29 08:55:41','2019-03-29 08:55:41'),(43,'Kumi','2019-03-29 08:55:41','2019-03-29 08:55:41'),(44,'Kween','2019-03-29 08:55:41','2019-03-29 08:55:41'),(45,'Luuka','2019-03-29 08:55:41','2019-03-29 08:55:41'),(46,'Manafwa','2019-03-29 08:55:41','2019-03-29 08:55:41'),(47,'Mayuge','2019-03-29 08:55:41','2019-03-29 08:55:41'),(48,'Mbale','2019-03-29 08:55:41','2019-03-29 08:55:41'),(49,'Namayingo','2019-03-29 08:55:41','2019-03-29 08:55:41'),(50,'Namutumba','2019-03-29 08:55:41','2019-03-29 08:55:41'),(51,'Ngora','2019-03-29 08:55:41','2019-03-29 08:55:41'),(52,'Pallisa','2019-03-29 08:55:41','2019-03-29 08:55:41'),(53,'Serere','2019-03-29 08:55:41','2019-03-29 08:55:41'),(54,'Sironko','2019-03-29 08:55:41','2019-03-29 08:55:41'),(55,'Soroti','2019-03-29 08:55:41','2019-03-29 08:55:41'),(56,'Tororo','2019-03-29 08:55:41','2019-03-29 08:55:41'),(57,'Abim','2019-03-29 08:55:41','2019-03-29 08:55:41'),(58,'Adjumani','2019-03-29 08:55:41','2019-03-29 08:55:41'),(59,'Agago','2019-03-29 08:55:41','2019-03-29 08:55:41'),(60,'Alebtong','2019-03-29 08:55:41','2019-03-29 08:55:41'),(61,'Amolatar','2019-03-29 08:55:41','2019-03-29 08:55:41'),(62,'Amudat','2019-03-29 08:55:41','2019-03-29 08:55:41'),(63,'Amuru','2019-03-29 08:55:41','2019-03-29 08:55:41'),(64,'Apac','2019-03-29 08:55:41','2019-03-29 08:55:41'),(65,'Arua','2019-03-29 08:55:41','2019-03-29 08:55:41'),(66,'Dokolo','2019-03-29 08:55:41','2019-03-29 08:55:41'),(67,'Gulu','2019-03-29 08:55:41','2019-03-29 08:55:41'),(68,'Kaabong','2019-03-29 08:55:41','2019-03-29 08:55:41'),(69,'Kitgum','2019-03-29 08:55:41','2019-03-29 08:55:41'),(70,'Koboko','2019-03-29 08:55:41','2019-03-29 08:55:41'),(71,'Kole','2019-03-29 08:55:41','2019-03-29 08:55:41'),(72,'Kotido','2019-03-29 08:55:41','2019-03-29 08:55:41'),(73,'Lamwo','2019-03-29 08:55:41','2019-03-29 08:55:41'),(74,'Lira','2019-03-29 08:55:41','2019-03-29 08:55:41'),(75,'Maracha','2019-03-29 08:55:41','2019-03-29 08:55:41'),(76,'Moroto','2019-03-29 08:55:41','2019-03-29 08:55:41'),(77,'Moyo','2019-03-29 08:55:41','2019-03-29 08:55:41'),(78,'Nakapiripirit','2019-03-29 08:55:41','2019-03-29 08:55:41'),(79,'Napak','2019-03-29 08:55:41','2019-03-29 08:55:41'),(80,'Nebbi','2019-03-29 08:55:41','2019-03-29 08:55:41'),(81,'Nwoya','2019-03-29 08:55:41','2019-03-29 08:55:41'),(82,'Otuke','2019-03-29 08:55:41','2019-03-29 08:55:41'),(83,'Oyam','2019-03-29 08:55:41','2019-03-29 08:55:41'),(84,'Pader','2019-03-29 08:55:41','2019-03-29 08:55:41'),(85,'Yumbe','2019-03-29 08:55:41','2019-03-29 08:55:41'),(86,'Zombo','2019-03-29 08:55:41','2019-03-29 08:55:41'),(87,'Buhweju','2019-03-29 08:55:41','2019-03-29 08:55:41'),(88,'Buliisa','2019-03-29 08:55:41','2019-03-29 08:55:41'),(89,'Bundibugyo','2019-03-29 08:55:41','2019-03-29 08:55:41'),(90,'Bushenyi','2019-03-29 08:55:41','2019-03-29 08:55:41'),(91,'Hoima','2019-03-29 08:55:41','2019-03-29 08:55:41'),(92,'Ibanda','2019-03-29 08:55:41','2019-03-29 08:55:41'),(93,'Isingiro','2019-03-29 08:55:41','2019-03-29 08:55:41'),(94,'Kabale','2019-03-29 08:55:41','2019-03-29 08:55:41'),(95,'Kabarole','2019-03-29 08:55:41','2019-03-29 08:55:41'),(96,'Kamwenge','2019-03-29 08:55:41','2019-03-29 08:55:41'),(97,'Kanungu','2019-03-29 08:55:41','2019-03-29 08:55:41'),(98,'Kasese','2019-03-29 08:55:41','2019-03-29 08:55:41'),(99,'Kibaale','2019-03-29 08:55:41','2019-03-29 08:55:41'),(100,'Kiruhura','2019-03-29 08:55:41','2019-03-29 08:55:41'),(101,'Kiryandongo','2019-03-29 08:55:41','2019-03-29 08:55:41'),(102,'Kisoro','2019-03-29 08:55:41','2019-03-29 08:55:41'),(103,'Kyegegwa','2019-03-29 08:55:41','2019-03-29 08:55:41'),(104,'Kyenjojo','2019-03-29 08:55:41','2019-03-29 08:55:41'),(105,'Masindi','2019-03-29 08:55:41','2019-03-29 08:55:41'),(106,'Mbarara','2019-03-29 08:55:41','2019-03-29 08:55:41'),(107,'Mitooma','2019-03-29 08:55:41','2019-03-29 08:55:41'),(108,'Ntoroko','2019-03-29 08:55:41','2019-03-29 08:55:41'),(109,'Ntungamo','2019-03-29 08:55:41','2019-03-29 08:55:41'),(110,'Rubirizi','2019-03-29 08:55:41','2019-03-29 08:55:41'),(111,'Rukungiri','2019-03-29 08:55:41','2019-03-29 08:55:41'),(112,'Sheema','2019-03-29 08:55:41','2019-03-29 08:55:41'),(113,'Omoro','2019-03-29 08:55:41','2019-03-29 08:55:41'),(114,'Kagadi','2019-03-29 08:55:41','2019-03-29 08:55:41'),(115,'Kakumiro','2019-03-29 08:55:41','2019-03-29 08:55:41'),(116,'Rubanda','2019-03-29 08:55:41','2019-03-29 08:55:41'),(117,'Bukwo','2019-03-29 08:55:41','2019-03-29 08:55:41');
/*!40000 ALTER TABLE `unhls_districts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_drugs`
--

DROP TABLE IF EXISTS `unhls_drugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_drugs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `formulation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `strength` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pack_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_of_issue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `max_stock_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `min_stock_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_drugs`
--

LOCK TABLES `unhls_drugs` WRITE;
/*!40000 ALTER TABLE `unhls_drugs` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_drugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_equipment_breakdown`
--

DROP TABLE IF EXISTS `unhls_equipment_breakdown`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_equipment_breakdown` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `district_id` int(10) unsigned NOT NULL,
  `facility_id` int(10) unsigned NOT NULL,
  `year_id` int(10) unsigned NOT NULL,
  `equipment_id` int(10) unsigned NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `action_taken` text COLLATE utf8_unicode_ci NOT NULL,
  `hsd_request` text COLLATE utf8_unicode_ci NOT NULL,
  `in_charge_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `report_date` datetime DEFAULT NULL,
  `restored_by` int(11) DEFAULT NULL,
  `restore_date` datetime DEFAULT NULL,
  `comment` longtext COLLATE utf8_unicode_ci,
  `breakdown_type` int(11) NOT NULL,
  `reported_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `breakdown_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unhls_equipment_breakdown_district_id_foreign` (`district_id`),
  KEY `unhls_equipment_breakdown_facility_id_foreign` (`facility_id`),
  KEY `unhls_equipment_breakdown_year_id_foreign` (`year_id`),
  KEY `unhls_equipment_breakdown_equipment_id_foreign` (`equipment_id`),
  CONSTRAINT `unhls_equipment_breakdown_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `unhls_districts` (`id`),
  CONSTRAINT `unhls_equipment_breakdown_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `unhls_equipment_inventory` (`id`),
  CONSTRAINT `unhls_equipment_breakdown_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `unhls_facilities` (`id`),
  CONSTRAINT `unhls_equipment_breakdown_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `unhls_financial_years` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_equipment_breakdown`
--

LOCK TABLES `unhls_equipment_breakdown` WRITE;
/*!40000 ALTER TABLE `unhls_equipment_breakdown` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_equipment_breakdown` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_equipment_inventory`
--

DROP TABLE IF EXISTS `unhls_equipment_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_equipment_inventory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `district_id` int(10) unsigned NOT NULL,
  `facility_id` int(10) unsigned NOT NULL,
  `year_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` int(11) NOT NULL,
  `procurement_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purchase_date` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `verification_date` datetime NOT NULL,
  `installation_date` datetime NOT NULL,
  `spare_parts` tinyint(1) NOT NULL,
  `warranty` int(11) NOT NULL,
  `life_span` int(11) NOT NULL,
  `service_frequency` tinyint(1) NOT NULL,
  `service_contract` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `supplier_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `unhls_equipment_inventory_district_id_foreign` (`district_id`),
  KEY `unhls_equipment_inventory_facility_id_foreign` (`facility_id`),
  KEY `unhls_equipment_inventory_year_id_foreign` (`year_id`),
  KEY `unhls_equipment_inventory_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `unhls_equipment_inventory_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `unhls_districts` (`id`),
  CONSTRAINT `unhls_equipment_inventory_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `unhls_facilities` (`id`),
  CONSTRAINT `unhls_equipment_inventory_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `unhls_equipment_suppliers` (`id`),
  CONSTRAINT `unhls_equipment_inventory_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `unhls_financial_years` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_equipment_inventory`
--

LOCK TABLES `unhls_equipment_inventory` WRITE;
/*!40000 ALTER TABLE `unhls_equipment_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_equipment_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_equipment_maintenance`
--

DROP TABLE IF EXISTS `unhls_equipment_maintenance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_equipment_maintenance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `district_id` int(10) unsigned NOT NULL,
  `facility_id` int(10) unsigned NOT NULL,
  `year_id` int(10) unsigned NOT NULL,
  `equipment_id` int(10) unsigned NOT NULL,
  `last_service_date` datetime NOT NULL,
  `next_service_date` datetime NOT NULL,
  `serviced_by_name` text COLLATE utf8_unicode_ci NOT NULL,
  `serviced_by_contact` text COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `unhls_equipment_maintenance_district_id_foreign` (`district_id`),
  KEY `unhls_equipment_maintenance_facility_id_foreign` (`facility_id`),
  KEY `unhls_equipment_maintenance_year_id_foreign` (`year_id`),
  KEY `unhls_equipment_maintenance_equipment_id_foreign` (`equipment_id`),
  CONSTRAINT `unhls_equipment_maintenance_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `unhls_districts` (`id`),
  CONSTRAINT `unhls_equipment_maintenance_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `unhls_equipment_inventory` (`id`),
  CONSTRAINT `unhls_equipment_maintenance_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `unhls_facilities` (`id`),
  CONSTRAINT `unhls_equipment_maintenance_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `unhls_financial_years` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_equipment_maintenance`
--

LOCK TABLES `unhls_equipment_maintenance` WRITE;
/*!40000 ALTER TABLE `unhls_equipment_maintenance` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_equipment_maintenance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_equipment_suppliers`
--

DROP TABLE IF EXISTS `unhls_equipment_suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_equipment_suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_equipment_suppliers`
--

LOCK TABLES `unhls_equipment_suppliers` WRITE;
/*!40000 ALTER TABLE `unhls_equipment_suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_equipment_suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_facilities`
--

DROP TABLE IF EXISTS `unhls_facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_facilities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `district_id` int(10) unsigned NOT NULL,
  `level_id` int(10) unsigned NOT NULL,
  `ownership_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `unhls_facilities_level_id_foreign` (`level_id`),
  KEY `unhls_facilities_district_id_foreign` (`district_id`),
  KEY `unhls_facilities_ownership_id_foreign` (`ownership_id`),
  CONSTRAINT `unhls_facilities_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `unhls_districts` (`id`),
  CONSTRAINT `unhls_facilities_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `unhls_facility_level` (`id`),
  CONSTRAINT `unhls_facilities_ownership_id_foreign` FOREIGN KEY (`ownership_id`) REFERENCES `unhls_facility_ownership` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_facilities`
--

LOCK TABLES `unhls_facilities` WRITE;
/*!40000 ALTER TABLE `unhls_facilities` DISABLE KEYS */;
INSERT INTO `unhls_facilities` VALUES (1,'012','TORORO GENERAL HOSPITAL',1,2,1,'2019-03-29 08:55:41','2019-03-29 08:55:41');
/*!40000 ALTER TABLE `unhls_facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_facility_level`
--

DROP TABLE IF EXISTS `unhls_facility_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_facility_level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_facility_level`
--

LOCK TABLES `unhls_facility_level` WRITE;
/*!40000 ALTER TABLE `unhls_facility_level` DISABLE KEYS */;
INSERT INTO `unhls_facility_level` VALUES (1,'Public NRH','2019-03-29 08:55:41','2019-03-29 08:55:41'),(2,'Public RRH','2019-03-29 08:55:41','2019-03-29 08:55:41'),(3,'Public GH','2019-03-29 08:55:41','2019-03-29 08:55:41'),(4,'Public HCIV','2019-03-29 08:55:41','2019-03-29 08:55:41'),(5,'Public HCIII','2019-03-29 08:55:41','2019-03-29 08:55:41'),(6,'Hospital','2019-03-29 08:55:41','2019-03-29 08:55:41');
/*!40000 ALTER TABLE `unhls_facility_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_facility_ownership`
--

DROP TABLE IF EXISTS `unhls_facility_ownership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_facility_ownership` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_facility_ownership`
--

LOCK TABLES `unhls_facility_ownership` WRITE;
/*!40000 ALTER TABLE `unhls_facility_ownership` DISABLE KEYS */;
INSERT INTO `unhls_facility_ownership` VALUES (1,'Public','2019-03-29 08:55:41','2019-03-29 08:55:41'),(2,'PFP','2019-03-29 08:55:41','2019-03-29 08:55:41'),(3,'PNFP','2019-03-29 08:55:41','2019-03-29 08:55:41'),(4,'Other','2019-03-29 08:55:41','2019-03-29 08:55:41');
/*!40000 ALTER TABLE `unhls_facility_ownership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_financial_years`
--

DROP TABLE IF EXISTS `unhls_financial_years`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_financial_years` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_financial_years`
--

LOCK TABLES `unhls_financial_years` WRITE;
/*!40000 ALTER TABLE `unhls_financial_years` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_financial_years` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_patients`
--

DROP TABLE IF EXISTS `unhls_patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_patients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ulin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `village_residence` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `village_workplace` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `external_patient_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `unhls_patients_external_patient_number_index` (`external_patient_number`),
  KEY `unhls_patients_created_by_index` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_patients`
--

LOCK TABLES `unhls_patients` WRITE;
/*!40000 ALTER TABLE `unhls_patients` DISABLE KEYS */;
INSERT INTO `unhls_patients` VALUES (1,'01','012/1903/1/BO','','Benson Okello','1989-01-01',0,'','','','','','',NULL,1,NULL,'2019-03-29 08:58:55','2019-03-29 08:58:55');
/*!40000 ALTER TABLE `unhls_patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_rejection_reasons`
--

DROP TABLE IF EXISTS `unhls_rejection_reasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_rejection_reasons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reason` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_rejection_reasons`
--

LOCK TABLES `unhls_rejection_reasons` WRITE;
/*!40000 ALTER TABLE `unhls_rejection_reasons` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_rejection_reasons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_staff`
--

DROP TABLE IF EXISTS `unhls_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facility_id` int(10) unsigned NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `unhls_staff_facility_id_foreign` (`facility_id`),
  CONSTRAINT `unhls_staff_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `unhls_facilities` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_staff`
--

LOCK TABLES `unhls_staff` WRITE;
/*!40000 ALTER TABLE `unhls_staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_stockcard`
--

DROP TABLE IF EXISTS `unhls_stockcard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_stockcard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `district_id` int(10) unsigned NOT NULL,
  `facility_id` int(10) unsigned NOT NULL,
  `year_id` int(10) unsigned NOT NULL,
  `commodity_id` int(10) unsigned NOT NULL,
  `to_from` int(11) NOT NULL,
  `to_from_type` int(11) NOT NULL,
  `voucher_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `issue_date` datetime NOT NULL,
  `expiry_date` datetime NOT NULL,
  `initials` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `balance` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `transaction_date` datetime DEFAULT NULL,
  `quantity_in` int(11) DEFAULT NULL,
  `quantity_out` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unhls_stockcard_district_id_foreign` (`district_id`),
  KEY `unhls_stockcard_facility_id_foreign` (`facility_id`),
  KEY `unhls_stockcard_year_id_foreign` (`year_id`),
  KEY `unhls_stockcard_commodity_id_foreign` (`commodity_id`),
  CONSTRAINT `unhls_stockcard_commodity_id_foreign` FOREIGN KEY (`commodity_id`) REFERENCES `commodities` (`id`),
  CONSTRAINT `unhls_stockcard_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `unhls_districts` (`id`),
  CONSTRAINT `unhls_stockcard_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `unhls_facilities` (`id`),
  CONSTRAINT `unhls_stockcard_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `unhls_financial_years` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_stockcard`
--

LOCK TABLES `unhls_stockcard` WRITE;
/*!40000 ALTER TABLE `unhls_stockcard` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_stockcard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_stockrequisition`
--

DROP TABLE IF EXISTS `unhls_stockrequisition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_stockrequisition` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `district_id` int(10) unsigned NOT NULL,
  `facility_id` int(10) unsigned NOT NULL,
  `year_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `issued_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `voucher_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity_required` int(11) NOT NULL,
  `quantity_issued` int(11) NOT NULL,
  `issue_date` datetime NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `unhls_stockrequisition_district_id_foreign` (`district_id`),
  KEY `unhls_stockrequisition_facility_id_foreign` (`facility_id`),
  KEY `unhls_stockrequisition_year_id_foreign` (`year_id`),
  KEY `unhls_stockrequisition_item_id_foreign` (`item_id`),
  CONSTRAINT `unhls_stockrequisition_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `unhls_districts` (`id`),
  CONSTRAINT `unhls_stockrequisition_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `unhls_facilities` (`id`),
  CONSTRAINT `unhls_stockrequisition_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `commodities` (`id`),
  CONSTRAINT `unhls_stockrequisition_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `unhls_financial_years` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_stockrequisition`
--

LOCK TABLES `unhls_stockrequisition` WRITE;
/*!40000 ALTER TABLE `unhls_stockrequisition` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_stockrequisition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_test_results`
--

DROP TABLE IF EXISTS `unhls_test_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_test_results` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `test_id` int(10) unsigned NOT NULL,
  `measure_id` int(10) unsigned NOT NULL,
  `result` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sample_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unhls_test_results_test_id_measure_id_unique` (`test_id`,`measure_id`),
  KEY `unhls_test_results_measure_id_foreign` (`measure_id`),
  CONSTRAINT `unhls_test_results_measure_id_foreign` FOREIGN KEY (`measure_id`) REFERENCES `measures` (`id`),
  CONSTRAINT `unhls_test_results_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `unhls_tests` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_test_results`
--

LOCK TABLES `unhls_test_results` WRITE;
/*!40000 ALTER TABLE `unhls_test_results` DISABLE KEYS */;
INSERT INTO `unhls_test_results` VALUES (1,2,4,'No mps seen','2019-03-29 09:17:15',NULL);
/*!40000 ALTER TABLE `unhls_test_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_tests`
--

DROP TABLE IF EXISTS `unhls_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_tests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visit_id` bigint(20) unsigned NOT NULL,
  `test_type_id` int(10) unsigned NOT NULL,
  `specimen_id` int(10) unsigned DEFAULT NULL,
  `interpretation` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `test_status_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `tested_by` int(10) unsigned NOT NULL DEFAULT '0',
  `verified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `requested_by` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `purpose` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_started` timestamp NULL DEFAULT NULL,
  `time_completed` timestamp NULL DEFAULT NULL,
  `time_verified` timestamp NULL DEFAULT NULL,
  `time_sent` timestamp NULL DEFAULT NULL,
  `external_id` int(11) DEFAULT NULL,
  `instrument` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unhls_tests_created_by_index` (`created_by`),
  KEY `unhls_tests_tested_by_index` (`tested_by`),
  KEY `unhls_tests_verified_by_index` (`verified_by`),
  KEY `unhls_tests_visit_id_foreign` (`visit_id`),
  KEY `unhls_tests_test_type_id_foreign` (`test_type_id`),
  KEY `unhls_tests_specimen_id_foreign` (`specimen_id`),
  KEY `unhls_tests_test_status_id_foreign` (`test_status_id`),
  CONSTRAINT `unhls_tests_specimen_id_foreign` FOREIGN KEY (`specimen_id`) REFERENCES `specimens` (`id`),
  CONSTRAINT `unhls_tests_test_status_id_foreign` FOREIGN KEY (`test_status_id`) REFERENCES `test_statuses` (`id`),
  CONSTRAINT `unhls_tests_test_type_id_foreign` FOREIGN KEY (`test_type_id`) REFERENCES `test_types` (`id`),
  CONSTRAINT `unhls_tests_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `unhls_visits` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_tests`
--

LOCK TABLES `unhls_tests` WRITE;
/*!40000 ALTER TABLE `unhls_tests` DISABLE KEYS */;
INSERT INTO `unhls_tests` VALUES (1,1,2,1,'',2,1,0,0,'','','2019-03-29 08:59:14',NULL,NULL,NULL,NULL,NULL,NULL),(2,2,2,2,'',4,1,1,0,'','','2019-03-29 08:59:15','2019-03-29 09:17:10','2019-03-29 09:17:15',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `unhls_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_visits`
--

DROP TABLE IF EXISTS `unhls_visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_visits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) unsigned NOT NULL,
  `visit_type` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Out-patient',
  `visit_number` int(10) unsigned DEFAULT NULL,
  `visit_lab_number` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ward_id` int(11) DEFAULT NULL,
  `bed_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visit_status_id` int(11) DEFAULT NULL,
  `hospitalized` int(10) unsigned DEFAULT NULL,
  `on_antibiotics` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unhls_visits_visit_number_index` (`visit_number`),
  KEY `unhls_visits_patient_id_foreign` (`patient_id`),
  CONSTRAINT `unhls_visits_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `unhls_patients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_visits`
--

LOCK TABLES `unhls_visits` WRITE;
/*!40000 ALTER TABLE `unhls_visits` DISABLE KEYS */;
INSERT INTO `unhls_visits` VALUES (1,1,'Out-patient',NULL,NULL,'2019-03-29 08:59:14','2019-03-29 08:59:14',NULL,NULL,NULL,NULL,NULL),(2,1,'Out-patient',NULL,NULL,'2019-03-29 08:59:15','2019-03-29 08:59:15',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `unhls_visits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unhls_warehouse`
--

DROP TABLE IF EXISTS `unhls_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unhls_warehouse` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unhls_warehouse`
--

LOCK TABLES `unhls_warehouse` WRITE;
/*!40000 ALTER TABLE `unhls_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `unhls_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '0',
  `designation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facility_id` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `phone_contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_facility_id_foreign` (`facility_id`),
  CONSTRAINT `users_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `unhls_facilities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'administrator','$2y$10$b8hwMMfycFJAdKK5tx8/ieA2qkmP7FTiDPH8UjKFqrdZhPZozFXpa','','A-LIS Admin',0,'Systems Administrator',NULL,NULL,1,NULL,'2019-03-29 08:55:42','2019-03-29 08:55:42',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uuids`
--

DROP TABLE IF EXISTS `uuids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uuids` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `counter` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uuids`
--

LOCK TABLES `uuids` WRITE;
/*!40000 ALTER TABLE `uuids` DISABLE KEYS */;
INSERT INTO `uuids` VALUES (1,0);
/*!40000 ALTER TABLE `uuids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visit_statuses`
--

DROP TABLE IF EXISTS `visit_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visit_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visit_statuses`
--

LOCK TABLES `visit_statuses` WRITE;
/*!40000 ALTER TABLE `visit_statuses` DISABLE KEYS */;
INSERT INTO `visit_statuses` VALUES (1,'appointment-made'),(2,'test-request-made'),(3,'specimen_received'),(4,'tests-completed');
/*!40000 ALTER TABLE `visit_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ward_type`
--

DROP TABLE IF EXISTS `ward_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ward_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ward_type`
--

LOCK TABLES `ward_type` WRITE;
/*!40000 ALTER TABLE `ward_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `ward_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wards`
--

DROP TABLE IF EXISTS `wards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ward_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wards`
--

LOCK TABLES `wards` WRITE;
/*!40000 ALTER TABLE `wards` DISABLE KEYS */;
/*!40000 ALTER TABLE `wards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zone_diameters`
--

DROP TABLE IF EXISTS `zone_diameters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zone_diameters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `drug_id` int(10) unsigned NOT NULL,
  `organism_id` int(10) unsigned NOT NULL,
  `resistant_max` decimal(4,1) DEFAULT NULL,
  `intermediate_min` decimal(4,1) DEFAULT NULL,
  `intermediate_max` decimal(4,1) DEFAULT NULL,
  `sensitive_min` decimal(4,1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zone_diameters_drug_id_foreign` (`drug_id`),
  KEY `zone_diameters_organism_id_foreign` (`organism_id`),
  CONSTRAINT `zone_diameters_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`),
  CONSTRAINT `zone_diameters_organism_id_foreign` FOREIGN KEY (`organism_id`) REFERENCES `organisms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1314 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zone_diameters`
--

LOCK TABLES `zone_diameters` WRITE;
/*!40000 ALTER TABLE `zone_diameters` DISABLE KEYS */;
INSERT INTO `zone_diameters` VALUES (1,1,1,14.0,15.0,16.0,17.0),(2,2,2,13.0,14.0,16.0,17.0),(3,3,2,13.0,14.0,17.0,18.0),(4,4,2,22.0,23.0,25.0,26.0),(5,5,2,17.0,18.0,20.0,21.0),(6,6,2,19.0,20.0,22.0,23.0),(7,7,2,22.0,23.0,25.0,26.0),(8,8,2,14.0,15.0,17.0,18.0),(9,9,2,14.0,15.0,22.0,23.0),(10,10,2,12.0,13.0,17.0,18.0),(11,11,2,15.0,16.0,20.0,21.0),(12,12,2,10.0,11.0,15.0,16.0),(13,13,2,12.0,13.0,14.0,15.0),(14,14,2,19.0,20.0,22.0,23.0),(15,15,2,19.0,20.0,22.0,23.0),(16,16,2,13.0,14.0,18.0,19.0),(17,17,2,17.0,18.0,20.0,21.0),(18,18,2,17.0,18.0,20.0,21.0),(19,19,2,13.0,14.0,16.0,17.0),(20,20,2,10.0,11.0,15.0,16.0),(21,2,3,13.0,14.0,16.0,17.0),(22,8,3,14.0,15.0,17.0,18.0),(23,9,3,14.0,15.0,22.0,23.0),(24,21,3,13.0,14.0,17.0,18.0),(25,13,3,12.0,13.0,14.0,15.0),(26,12,3,10.0,11.0,15.0,16.0),(27,10,3,12.0,13.0,17.0,18.0),(28,11,3,15.0,16.0,20.0,21.0),(29,6,3,19.0,20.0,22.0,23.0),(30,7,3,22.0,23.0,25.0,26.0),(31,5,3,17.0,18.0,20.0,21.0),(32,22,3,NULL,NULL,NULL,25.0),(33,18,3,17.0,18.0,20.0,21.0),(34,17,3,17.0,18.0,20.0,21.0),(35,14,3,19.0,20.0,22.0,23.0),(36,16,3,13.0,14.0,18.0,19.0),(37,19,3,14.0,15.0,16.0,17.0),(38,18,1,14.0,15.0,20.0,21.0),(39,17,1,14.0,15.0,20.0,21.0),(40,5,1,14.0,15.0,17.0,18.0),(41,22,1,14.0,15.0,17.0,18.0),(42,13,1,12.0,13.0,14.0,15.0),(43,11,1,15.0,16.0,20.0,21.0),(44,14,1,13.0,14.0,15.0,16.0),(45,15,1,13.0,14.0,15.0,16.0),(46,23,1,10.0,NULL,NULL,12.0),(57,1,5,14.0,15.0,16.0,17.0),(58,22,5,14.0,15.0,17.0,18.0),(59,5,5,14.0,15.0,17.0,18.0),(60,11,5,15.0,16.0,20.0,21.0),(61,23,5,10.0,NULL,NULL,11.0),(62,13,5,12.0,13.0,14.0,15.0),(63,14,5,13.0,14.0,15.0,16.0),(64,15,5,13.0,14.0,15.0,16.0),(65,17,5,14.0,15.0,20.0,21.0),(66,18,5,14.0,15.0,20.0,21.0),(67,1,6,14.0,15.0,16.0,17.0),(68,22,6,14.0,15.0,17.0,18.0),(69,5,6,14.0,15.0,17.0,18.0),(70,11,6,15.0,16.0,20.0,21.0),(71,23,6,10.0,NULL,NULL,11.0),(72,13,6,12.0,13.0,14.0,15.0),(73,14,6,13.0,14.0,15.0,16.0),(74,15,6,13.0,14.0,15.0,16.0),(75,17,6,14.0,15.0,20.0,21.0),(76,18,6,14.0,15.0,20.0,21.0),(127,17,12,17.0,18.0,20.0,21.0),(128,20,12,10.0,11.0,15.0,16.0),(129,15,12,14.0,15.0,17.0,18.0),(130,1,12,14.0,15.0,16.0,17.0),(131,22,12,14.0,15.0,17.0,18.0),(132,5,12,14.0,15.0,17.0,18.0),(133,6,12,13.0,14.0,20.0,21.0),(134,11,12,15.0,16.0,20.0,21.0),(135,13,12,12.0,13.0,14.0,15.0),(136,24,12,11.0,12.0,14.0,15.0),(137,14,12,18.0,19.0,21.0,22.0),(138,18,12,17.0,18.0,20.0,21.0),(139,17,13,17.0,18.0,20.0,21.0),(140,18,13,17.0,18.0,20.0,21.0),(141,1,13,14.0,15.0,16.0,17.0),(142,14,13,18.0,19.0,21.0,22.0),(143,13,13,12.0,13.0,14.0,15.0),(144,11,13,15.0,16.0,20.0,21.0),(145,5,13,14.0,15.0,17.0,18.0),(146,6,13,13.0,14.0,20.0,21.0),(147,22,13,14.0,15.0,17.0,18.0),(148,24,13,11.0,12.0,14.0,15.0),(149,15,13,14.0,15.0,17.0,18.0),(150,20,13,10.0,11.0,15.0,16.0),(175,11,16,20.0,21.0,30.0,31.0),(176,2,16,13.0,14.0,16.0,17.0),(177,16,16,13.0,14.0,18.0,19.0),(178,12,16,10.0,11.0,15.0,16.0),(179,10,16,12.0,13.0,17.0,18.0),(180,6,16,19.0,20.0,22.0,23.0),(181,2,17,13.0,14.0,16.0,17.0),(182,11,17,20.0,21.0,30.0,31.0),(183,16,17,13.0,14.0,18.0,19.0),(184,12,17,10.0,11.0,15.0,16.0),(185,10,17,12.0,13.0,17.0,18.0),(186,6,17,19.0,20.0,22.0,23.0),(187,2,18,13.0,14.0,16.0,17.0),(188,6,18,19.0,20.0,22.0,23.0),(189,11,18,20.0,21.0,30.0,31.0),(190,16,18,13.0,14.0,18.0,19.0),(191,10,18,12.0,13.0,17.0,18.0),(192,12,18,10.0,11.0,15.0,16.0),(193,6,19,19.0,20.0,22.0,23.0),(194,2,19,13.0,14.0,16.0,17.0),(195,11,19,20.0,21.0,30.0,31.0),(196,10,19,12.0,13.0,17.0,18.0),(197,16,19,13.0,14.0,18.0,19.0),(198,12,19,10.0,11.0,15.0,16.0),(199,10,20,12.0,13.0,17.0,18.0),(200,24,20,14.0,15.0,18.0,19.0),(201,20,20,10.0,11.0,15.0,16.0),(202,2,20,13.0,14.0,16.0,17.0),(203,6,21,24.0,25.0,26.0,27.0),(204,25,21,15.0,16.0,20.0,21.0),(205,26,21,15.0,16.0,18.0,19.0),(206,10,21,17.0,18.0,20.0,21.0),(207,27,21,NULL,NULL,NULL,17.0),(208,28,21,NULL,NULL,NULL,21.0),(209,24,21,18.0,19.0,22.0,23.0),(223,1,23,14.0,15.0,16.0,17.0),(224,11,23,15.0,16.0,20.0,21.0),(225,10,23,12.0,13.0,17.0,18.0),(226,25,23,13.0,14.0,22.0,23.0),(227,26,23,14.0,15.0,20.0,21.0),(228,13,23,12.0,13.0,14.0,15.0),(229,19,23,14.0,15.0,16.0,17.0),(230,28,23,16.0,NULL,NULL,21.0),(231,31,23,16.0,17.0,19.0,20.0),(232,24,23,14.0,15.0,18.0,19.0),(233,20,23,10.0,11.0,15.0,16.0),(234,27,23,NULL,NULL,NULL,NULL),(235,30,23,21.0,NULL,NULL,22.0),(236,29,23,28.0,NULL,NULL,29.0),(238,1,24,14.0,15.0,16.0,17.0),(239,27,24,NULL,NULL,NULL,NULL),(240,20,24,10.0,11.0,15.0,16.0),(241,31,24,16.0,17.0,19.0,20.0),(242,24,24,14.0,15.0,18.0,19.0),(243,29,24,28.0,NULL,NULL,29.0),(244,19,24,14.0,15.0,16.0,17.0),(245,28,24,16.0,NULL,NULL,21.0),(246,13,24,12.0,13.0,14.0,15.0),(247,25,24,13.0,14.0,22.0,23.0),(248,26,24,14.0,15.0,20.0,21.0),(249,11,24,15.0,16.0,20.0,21.0),(250,10,24,12.0,13.0,17.0,18.0),(251,30,24,21.0,NULL,NULL,22.0),(252,28,25,16.0,NULL,NULL,21.0),(253,31,25,16.0,17.0,19.0,20.0),(254,19,25,14.0,15.0,16.0,17.0),(255,1,25,14.0,15.0,16.0,17.0),(256,13,25,12.0,13.0,14.0,15.0),(257,11,25,15.0,16.0,20.0,21.0),(258,10,25,12.0,13.0,17.0,18.0),(259,20,25,10.0,11.0,15.0,16.0),(260,24,25,14.0,15.0,18.0,19.0),(261,27,25,NULL,NULL,NULL,NULL),(262,26,25,14.0,15.0,20.0,21.0),(263,25,25,13.0,14.0,22.0,23.0),(264,30,25,21.0,NULL,NULL,22.0),(265,29,25,28.0,NULL,NULL,29.0),(308,27,29,NULL,NULL,NULL,NULL),(309,20,29,NULL,NULL,NULL,NULL),(310,24,29,NULL,NULL,NULL,NULL),(311,31,29,NULL,NULL,NULL,NULL),(312,29,29,NULL,NULL,NULL,NULL),(313,19,29,NULL,NULL,NULL,NULL),(314,28,29,NULL,NULL,NULL,NULL),(315,13,29,NULL,NULL,NULL,NULL),(316,25,29,NULL,NULL,NULL,NULL),(317,26,29,NULL,NULL,NULL,NULL),(318,11,29,NULL,NULL,NULL,NULL),(319,10,29,NULL,NULL,NULL,NULL),(320,30,29,NULL,NULL,NULL,NULL),(321,1,29,NULL,NULL,NULL,NULL),(322,1,30,NULL,NULL,NULL,NULL),(323,30,30,NULL,NULL,NULL,NULL),(324,27,30,NULL,NULL,NULL,NULL),(325,20,30,NULL,NULL,NULL,NULL),(326,24,30,NULL,NULL,NULL,NULL),(327,31,30,NULL,NULL,NULL,NULL),(328,29,30,NULL,NULL,NULL,NULL),(329,19,30,NULL,NULL,NULL,NULL),(330,28,30,NULL,NULL,NULL,NULL),(331,13,30,NULL,NULL,NULL,NULL),(332,25,30,NULL,NULL,NULL,NULL),(333,26,30,NULL,NULL,NULL,NULL),(334,11,30,NULL,NULL,NULL,NULL),(335,10,30,NULL,NULL,NULL,NULL),(336,1,31,NULL,NULL,NULL,NULL),(337,30,31,NULL,NULL,NULL,NULL),(338,27,31,NULL,NULL,NULL,NULL),(339,20,31,NULL,NULL,NULL,NULL),(340,24,31,NULL,NULL,NULL,NULL),(341,31,31,NULL,NULL,NULL,NULL),(342,29,31,NULL,NULL,NULL,NULL),(343,19,31,NULL,NULL,NULL,NULL),(344,28,31,NULL,NULL,NULL,NULL),(345,13,31,NULL,NULL,NULL,NULL),(346,25,31,NULL,NULL,NULL,NULL),(347,26,31,NULL,NULL,NULL,NULL),(348,10,31,NULL,NULL,NULL,NULL),(349,11,31,NULL,NULL,NULL,NULL),(350,18,32,17.0,18.0,20.0,21.0),(351,17,32,17.0,18.0,20.0,21.0),(352,19,32,14.0,15.0,16.0,17.0),(353,16,32,13.0,14.0,18.0,19.0),(354,14,32,19.0,20.0,22.0,23.0),(355,13,32,12.0,13.0,14.0,15.0),(356,12,32,10.0,11.0,15.0,16.0),(357,11,32,15.0,16.0,20.0,21.0),(358,10,32,12.0,13.0,17.0,18.0),(359,8,32,14.0,15.0,22.0,23.0),(360,6,32,13.0,14.0,20.0,21.0),(361,5,32,13.0,14.0,20.0,21.0),(362,2,32,13.0,14.0,16.0,17.0),(363,21,32,13.0,14.0,17.0,18.0),(364,18,33,17.0,18.0,20.0,21.0),(365,17,33,17.0,18.0,20.0,21.0),(366,19,33,13.0,14.0,16.0,17.0),(367,16,33,13.0,14.0,18.0,19.0),(368,14,33,19.0,20.0,22.0,23.0),(369,13,33,12.0,13.0,14.0,15.0),(370,11,33,15.0,16.0,20.0,21.0),(371,10,33,12.0,13.0,17.0,18.0),(372,12,33,10.0,11.0,15.0,16.0),(373,8,33,14.0,15.0,17.0,18.0),(374,6,33,13.0,14.0,20.0,21.0),(375,5,33,13.0,14.0,20.0,21.0),(376,22,33,NULL,NULL,NULL,25.0),(377,2,33,13.0,14.0,16.0,17.0),(378,28,34,20.0,21.0,22.0,23.0),(379,31,34,16.0,17.0,19.0,20.0),(380,19,34,14.0,15.0,16.0,17.0),(381,32,34,6.0,7.0,9.0,10.0),(382,11,34,15.0,16.0,20.0,21.0),(383,10,34,12.0,13.0,17.0,18.0),(384,27,34,14.0,15.0,17.0,18.0),(385,24,34,14.0,15.0,18.0,19.0),(386,25,34,13.0,14.0,22.0,23.0),(387,29,34,14.0,NULL,NULL,15.0),(388,2,34,16.0,NULL,NULL,17.0),(389,27,35,14.0,15.0,17.0,18.0),(390,24,35,14.0,15.0,18.0,19.0),(391,32,35,6.0,7.0,9.0,10.0),(392,31,35,16.0,17.0,19.0,20.0),(393,29,35,14.0,NULL,NULL,15.0),(394,19,35,14.0,15.0,16.0,17.0),(395,28,35,20.0,21.0,22.0,23.0),(396,13,35,6.0,7.0,9.0,10.0),(397,25,35,13.0,14.0,22.0,23.0),(398,11,35,15.0,16.0,20.0,21.0),(399,10,35,12.0,13.0,17.0,18.0),(400,2,35,16.0,NULL,NULL,17.0),(401,24,36,18.0,19.0,22.0,23.0),(402,27,36,NULL,NULL,NULL,17.0),(403,10,36,17.0,18.0,20.0,21.0),(404,26,36,15.0,16.0,18.0,19.0),(405,25,36,15.0,16.0,20.0,21.0),(406,6,36,NULL,NULL,NULL,24.0),(407,15,37,15.0,16.0,19.0,20.0),(408,20,37,10.0,11.0,15.0,16.0),(409,33,37,14.0,15.0,18.0,19.0),(410,5,37,17.0,18.0,20.0,21.0),(411,5,38,17.0,18.0,20.0,21.0),(412,15,38,15.0,16.0,19.0,20.0),(413,33,38,14.0,15.0,18.0,19.0),(414,20,38,10.0,11.0,15.0,16.0),(415,5,39,17.0,18.0,20.0,21.0),(416,15,39,15.0,16.0,19.0,20.0),(417,33,39,14.0,15.0,18.0,19.0),(418,20,39,10.0,11.0,15.0,16.0),(419,6,40,NULL,NULL,NULL,35.0),(420,34,40,NULL,NULL,NULL,31.0),(421,11,40,27.0,28.0,40.0,41.0),(422,29,40,26.0,27.0,46.0,47.0),(423,24,40,30.0,31.0,37.0,38.0),(424,35,40,14.0,15.0,17.0,18.0),(425,24,41,30.0,31.0,37.0,38.0),(426,35,41,14.0,15.0,17.0,18.0),(427,29,41,26.0,27.0,46.0,47.0),(428,11,41,27.0,28.0,40.0,41.0),(429,6,41,NULL,NULL,NULL,35.0),(430,24,42,30.0,31.0,37.0,38.0),(431,35,42,14.0,15.0,17.0,18.0),(432,29,42,26.0,27.0,46.0,47.0),(433,11,42,27.0,28.0,40.0,41.0),(434,6,42,NULL,NULL,NULL,35.0),(435,6,43,NULL,NULL,NULL,35.0),(436,11,43,27.0,28.0,40.0,41.0),(437,29,43,26.0,27.0,46.0,47.0),(438,35,43,14.0,15.0,17.0,18.0),(439,24,43,30.0,31.0,37.0,38.0),(440,24,44,25.0,26.0,28.0,29.0),(441,20,44,10.0,11.0,15.0,16.0),(442,15,44,NULL,NULL,NULL,20.0),(443,31,44,16.0,17.0,19.0,20.0),(444,8,44,16.0,17.0,19.0,20.0),(445,11,44,NULL,NULL,NULL,21.0),(446,10,44,25.0,26.0,28.0,29.0),(447,3,44,19.0,NULL,NULL,20.0),(448,2,44,18.0,19.0,21.0,22.0),(449,6,44,NULL,NULL,NULL,20.0),(450,20,45,10.0,11.0,15.0,16.0),(451,24,45,25.0,26.0,28.0,29.0),(452,31,45,16.0,17.0,19.0,20.0),(453,15,45,NULL,NULL,NULL,20.0),(454,11,45,NULL,NULL,NULL,21.0),(455,10,45,25.0,26.0,28.0,29.0),(456,8,45,16.0,17.0,19.0,20.0),(457,6,45,NULL,NULL,NULL,26.0),(458,3,45,19.0,NULL,NULL,20.0),(459,2,45,18.0,19.0,21.0,22.0),(460,6,46,NULL,NULL,NULL,26.0),(461,8,46,16.0,17.0,19.0,20.0),(462,20,46,10.0,11.0,15.0,16.0),(463,24,46,25.0,26.0,28.0,29.0),(464,31,46,16.0,17.0,19.0,20.0),(465,15,46,NULL,NULL,NULL,20.0),(466,11,46,NULL,NULL,NULL,21.0),(467,10,46,25.0,26.0,28.0,29.0),(468,3,46,19.0,NULL,NULL,20.0),(469,2,46,18.0,19.0,21.0,22.0),(480,20,48,10.0,11.0,15.0,16.0),(481,24,48,25.0,26.0,28.0,29.0),(482,31,48,16.0,17.0,19.0,20.0),(483,15,48,NULL,NULL,NULL,20.0),(484,11,48,NULL,NULL,NULL,21.0),(485,10,48,25.0,26.0,28.0,29.0),(486,8,48,16.0,17.0,19.0,20.0),(487,6,48,NULL,NULL,NULL,26.0),(488,3,48,19.0,NULL,NULL,20.0),(489,2,48,18.0,19.0,21.0,22.0),(519,3,52,19.0,NULL,NULL,20.0),(520,2,52,18.0,19.0,21.0,22.0),(521,20,52,10.0,11.0,15.0,16.0),(522,24,52,25.0,26.0,28.0,29.0),(523,31,52,16.0,17.0,19.0,20.0),(524,15,52,NULL,NULL,NULL,20.0),(525,8,52,16.0,17.0,19.0,20.0),(526,6,52,NULL,NULL,NULL,26.0),(527,11,52,NULL,NULL,NULL,21.0),(528,10,52,25.0,26.0,28.0,29.0),(529,20,53,10.0,11.0,15.0,16.0),(530,24,53,25.0,26.0,28.0,29.0),(531,31,53,16.0,17.0,19.0,20.0),(532,15,53,NULL,NULL,NULL,20.0),(533,11,53,NULL,NULL,NULL,21.0),(534,10,53,25.0,26.0,28.0,29.0),(535,8,53,16.0,17.0,19.0,20.0),(536,6,53,NULL,NULL,NULL,26.0),(537,3,53,19.0,NULL,NULL,20.0),(538,2,53,18.0,19.0,21.0,22.0),(539,31,54,16.0,17.0,19.0,20.0),(540,24,54,25.0,26.0,28.0,29.0),(541,20,54,10.0,11.0,15.0,16.0),(542,15,54,NULL,NULL,NULL,20.0),(543,11,54,NULL,NULL,NULL,21.0),(544,10,54,25.0,26.0,28.0,29.0),(545,8,54,16.0,17.0,19.0,20.0),(546,6,54,NULL,NULL,NULL,26.0),(547,3,54,19.0,NULL,NULL,20.0),(548,2,54,18.0,19.0,21.0,22.0),(549,20,55,10.0,11.0,15.0,16.0),(550,24,55,25.0,26.0,28.0,29.0),(551,31,55,16.0,17.0,19.0,20.0),(552,15,55,NULL,NULL,NULL,20.0),(553,11,55,NULL,NULL,NULL,21.0),(554,10,55,25.0,26.0,28.0,29.0),(555,8,55,16.0,17.0,19.0,20.0),(556,6,55,NULL,NULL,NULL,26.0),(557,3,55,19.0,NULL,NULL,20.0),(558,2,55,18.0,19.0,21.0,22.0),(559,20,56,10.0,11.0,15.0,16.0),(560,24,56,25.0,26.0,28.0,29.0),(561,31,56,16.0,17.0,19.0,20.0),(562,15,56,NULL,NULL,NULL,20.0),(563,11,56,NULL,NULL,NULL,21.0),(564,10,56,25.0,26.0,28.0,29.0),(565,8,56,16.0,17.0,19.0,20.0),(566,6,56,NULL,NULL,NULL,26.0),(567,3,56,19.0,NULL,NULL,20.0),(568,2,56,18.0,19.0,21.0,22.0),(601,20,61,15.0,16.0,18.0,19.0),(602,24,61,24.0,25.0,27.0,28.0),(603,31,61,16.0,17.0,18.0,19.0),(604,28,61,NULL,NULL,NULL,21.0),(605,10,61,20.0,NULL,NULL,21.0),(606,26,61,15.0,16.0,18.0,19.0),(607,25,61,15.0,16.0,20.0,21.0),(608,36,61,NULL,NULL,NULL,20.0),(699,18,67,NULL,NULL,NULL,NULL),(700,17,67,NULL,NULL,NULL,NULL),(701,19,67,NULL,NULL,NULL,NULL),(702,16,67,NULL,NULL,NULL,NULL),(703,15,67,NULL,NULL,NULL,NULL),(704,14,67,NULL,NULL,NULL,NULL),(705,13,67,NULL,NULL,NULL,NULL),(706,12,67,NULL,NULL,NULL,NULL),(707,11,67,NULL,NULL,NULL,NULL),(708,10,67,NULL,NULL,NULL,NULL),(709,9,67,NULL,NULL,NULL,NULL),(710,8,67,NULL,NULL,NULL,NULL),(711,6,67,NULL,NULL,NULL,NULL),(712,5,67,NULL,NULL,NULL,NULL),(713,4,67,NULL,NULL,NULL,NULL),(714,22,67,NULL,NULL,NULL,NULL),(715,2,67,13.0,14.0,16.0,17.0),(716,9,33,14.0,15.0,22.0,23.0),(717,18,68,17.0,18.0,20.0,21.0),(718,17,68,17.0,18.0,20.0,21.0),(719,19,68,13.0,14.0,16.0,17.0),(720,16,68,13.0,14.0,18.0,19.0),(721,15,68,19.0,20.0,22.0,23.0),(722,13,68,12.0,13.0,14.0,15.0),(723,14,68,19.0,20.0,22.0,23.0),(724,12,68,10.0,11.0,15.0,16.0),(725,11,68,15.0,16.0,20.0,21.0),(726,10,68,12.0,13.0,17.0,18.0),(727,9,68,14.0,15.0,22.0,23.0),(728,8,68,14.0,15.0,17.0,18.0),(729,6,68,19.0,20.0,22.0,23.0),(730,5,68,17.0,18.0,20.0,21.0),(731,4,68,22.0,23.0,25.0,26.0),(732,22,68,NULL,NULL,NULL,25.0),(733,2,68,13.0,14.0,16.0,17.0),(734,21,68,13.0,14.0,17.0,18.0),(735,16,69,13.0,14.0,18.0,19.0),(736,17,69,17.0,18.0,20.0,21.0),(737,18,69,17.0,18.0,20.0,21.0),(738,19,69,13.0,14.0,16.0,17.0),(739,21,69,13.0,14.0,17.0,18.0),(740,2,69,13.0,14.0,16.0,17.0),(741,22,69,NULL,NULL,NULL,25.0),(742,4,69,22.0,23.0,25.0,26.0),(743,5,69,17.0,18.0,20.0,21.0),(744,6,69,19.0,20.0,22.0,23.0),(745,9,69,14.0,15.0,22.0,23.0),(746,8,69,14.0,15.0,17.0,18.0),(747,10,69,12.0,13.0,17.0,18.0),(748,11,69,15.0,16.0,20.0,21.0),(749,12,69,10.0,11.0,15.0,16.0),(750,13,69,12.0,13.0,14.0,15.0),(751,15,69,19.0,20.0,22.0,23.0),(752,14,69,19.0,20.0,22.0,23.0),(771,18,71,17.0,18.0,20.0,21.0),(772,17,71,17.0,18.0,20.0,21.0),(773,19,71,13.0,14.0,16.0,17.0),(774,16,71,13.0,14.0,18.0,19.0),(775,15,71,19.0,20.0,22.0,23.0),(776,14,71,19.0,20.0,22.0,23.0),(777,13,71,12.0,13.0,14.0,15.0),(778,12,71,10.0,11.0,15.0,16.0),(779,9,71,14.0,15.0,22.0,23.0),(780,8,71,14.0,15.0,17.0,18.0),(781,6,71,19.0,20.0,22.0,23.0),(782,5,71,17.0,18.0,20.0,21.0),(783,4,71,22.0,23.0,25.0,26.0),(784,22,71,NULL,NULL,NULL,25.0),(785,21,71,13.0,14.0,17.0,18.0),(786,2,71,13.0,14.0,16.0,17.0),(787,11,71,15.0,16.0,20.0,21.0),(788,10,71,12.0,13.0,17.0,18.0),(789,18,72,17.0,18.0,20.0,21.0),(790,17,72,17.0,18.0,20.0,21.0),(791,19,72,13.0,14.0,16.0,17.0),(792,16,72,13.0,14.0,18.0,19.0),(793,15,72,19.0,20.0,22.0,23.0),(794,14,72,19.0,20.0,22.0,23.0),(795,13,72,12.0,13.0,14.0,15.0),(796,12,72,10.0,11.0,15.0,16.0),(797,11,72,15.0,16.0,20.0,21.0),(798,10,72,12.0,13.0,17.0,18.0),(799,9,72,14.0,15.0,22.0,23.0),(800,8,72,14.0,15.0,17.0,18.0),(801,6,72,19.0,20.0,22.0,23.0),(802,5,72,17.0,18.0,20.0,21.0),(803,4,72,22.0,23.0,25.0,26.0),(804,22,72,NULL,NULL,NULL,25.0),(805,2,72,13.0,14.0,16.0,17.0),(806,21,72,13.0,14.0,17.0,18.0),(825,18,74,17.0,18.0,20.0,21.0),(826,17,74,17.0,18.0,20.0,21.0),(827,19,74,13.0,14.0,16.0,17.0),(828,16,74,13.0,14.0,18.0,19.0),(829,15,74,19.0,20.0,22.0,23.0),(830,14,74,19.0,20.0,22.0,23.0),(831,13,74,12.0,13.0,14.0,15.0),(832,12,74,10.0,11.0,15.0,16.0),(833,11,74,15.0,16.0,20.0,21.0),(834,10,74,12.0,13.0,17.0,18.0),(835,9,74,14.0,15.0,22.0,23.0),(836,8,74,14.0,15.0,17.0,18.0),(837,6,74,19.0,20.0,22.0,23.0),(838,5,74,17.0,18.0,20.0,21.0),(839,4,74,22.0,23.0,25.0,26.0),(840,22,74,NULL,NULL,NULL,25.0),(841,2,74,13.0,14.0,16.0,17.0),(842,21,74,13.0,14.0,17.0,18.0),(843,18,75,17.0,18.0,20.0,21.0),(844,17,75,17.0,18.0,20.0,21.0),(845,19,75,13.0,14.0,16.0,17.0),(846,16,75,13.0,14.0,18.0,19.0),(847,15,75,19.0,20.0,22.0,23.0),(848,14,75,19.0,20.0,22.0,23.0),(849,13,75,12.0,13.0,14.0,15.0),(850,12,75,10.0,11.0,15.0,16.0),(851,10,75,12.0,13.0,17.0,18.0),(852,11,75,15.0,16.0,20.0,21.0),(853,9,75,14.0,15.0,22.0,23.0),(854,8,75,14.0,15.0,17.0,18.0),(855,6,75,19.0,20.0,22.0,23.0),(856,5,75,17.0,18.0,20.0,21.0),(857,4,75,22.0,23.0,25.0,26.0),(858,22,75,NULL,NULL,NULL,25.0),(859,2,75,13.0,14.0,16.0,17.0),(860,21,75,13.0,14.0,17.0,18.0),(861,18,76,17.0,18.0,20.0,21.0),(862,17,76,17.0,18.0,20.0,21.0),(863,19,76,13.0,14.0,16.0,17.0),(864,16,76,13.0,14.0,18.0,19.0),(865,15,76,19.0,20.0,22.0,23.0),(866,14,76,19.0,20.0,22.0,23.0),(867,13,76,12.0,13.0,14.0,15.0),(868,12,76,10.0,11.0,15.0,16.0),(869,10,76,12.0,13.0,17.0,18.0),(870,11,76,15.0,16.0,20.0,21.0),(871,9,76,14.0,15.0,22.0,23.0),(872,8,76,14.0,15.0,17.0,18.0),(873,6,76,19.0,20.0,22.0,23.0),(874,5,76,17.0,18.0,20.0,21.0),(875,4,76,22.0,23.0,25.0,26.0),(876,22,76,NULL,NULL,NULL,25.0),(877,2,76,13.0,14.0,16.0,17.0),(878,21,76,13.0,14.0,17.0,18.0),(879,18,77,17.0,18.0,20.0,21.0),(880,17,77,17.0,18.0,20.0,21.0),(881,19,77,13.0,14.0,16.0,17.0),(882,16,77,13.0,14.0,18.0,19.0),(883,15,77,19.0,20.0,22.0,23.0),(884,14,77,19.0,20.0,22.0,23.0),(885,13,77,12.0,13.0,14.0,15.0),(886,12,77,10.0,11.0,15.0,16.0),(887,11,77,15.0,16.0,20.0,21.0),(888,10,77,12.0,13.0,17.0,18.0),(889,9,77,14.0,15.0,22.0,23.0),(890,8,77,14.0,15.0,17.0,18.0),(891,6,77,19.0,20.0,22.0,23.0),(892,5,77,17.0,18.0,20.0,21.0),(893,4,77,22.0,23.0,25.0,26.0),(894,22,77,NULL,NULL,NULL,25.0),(895,2,77,13.0,14.0,16.0,17.0),(896,21,77,13.0,14.0,17.0,18.0),(933,18,80,17.0,18.0,20.0,21.0),(934,17,80,17.0,18.0,20.0,21.0),(935,19,80,13.0,14.0,16.0,17.0),(936,16,80,13.0,14.0,18.0,19.0),(937,15,80,19.0,20.0,22.0,23.0),(938,14,80,19.0,20.0,22.0,23.0),(939,13,80,12.0,13.0,14.0,15.0),(940,12,80,10.0,11.0,15.0,16.0),(941,10,80,12.0,13.0,17.0,18.0),(942,11,80,15.0,16.0,20.0,21.0),(943,9,80,14.0,15.0,22.0,23.0),(944,8,80,14.0,15.0,17.0,18.0),(945,6,80,19.0,20.0,22.0,23.0),(946,5,80,17.0,18.0,20.0,21.0),(947,4,80,22.0,23.0,25.0,26.0),(948,22,80,NULL,NULL,NULL,25.0),(949,2,80,13.0,14.0,16.0,17.0),(950,21,80,13.0,14.0,17.0,18.0),(951,18,81,17.0,18.0,20.0,21.0),(952,17,81,17.0,18.0,20.0,21.0),(953,19,81,13.0,14.0,16.0,17.0),(954,16,81,13.0,14.0,18.0,19.0),(955,15,81,19.0,20.0,22.0,23.0),(956,14,81,19.0,20.0,22.0,23.0),(957,13,81,12.0,13.0,14.0,15.0),(958,12,81,10.0,11.0,15.0,16.0),(959,10,81,12.0,13.0,17.0,18.0),(960,11,81,15.0,16.0,20.0,21.0),(961,9,81,14.0,15.0,22.0,23.0),(962,8,81,14.0,15.0,17.0,18.0),(963,6,81,19.0,20.0,22.0,23.0),(964,5,81,17.0,18.0,20.0,21.0),(965,4,81,22.0,23.0,25.0,26.0),(966,22,81,NULL,NULL,NULL,25.0),(967,21,81,13.0,14.0,17.0,18.0),(968,2,81,13.0,14.0,16.0,17.0),(987,18,83,17.0,18.0,20.0,21.0),(988,17,83,17.0,18.0,20.0,21.0),(989,19,83,13.0,14.0,16.0,17.0),(990,16,83,13.0,14.0,18.0,19.0),(991,15,83,19.0,20.0,22.0,23.0),(992,14,83,19.0,20.0,22.0,23.0),(993,13,83,12.0,13.0,14.0,15.0),(994,12,83,10.0,11.0,15.0,16.0),(995,11,83,15.0,16.0,20.0,21.0),(996,10,83,12.0,13.0,17.0,18.0),(997,9,83,14.0,15.0,22.0,23.0),(998,8,83,14.0,15.0,17.0,18.0),(999,6,83,19.0,20.0,22.0,23.0),(1000,5,83,17.0,18.0,20.0,21.0),(1001,4,83,22.0,23.0,25.0,26.0),(1002,22,83,NULL,NULL,NULL,25.0),(1003,2,83,13.0,14.0,16.0,17.0),(1004,21,83,13.0,14.0,17.0,18.0),(1005,16,84,NULL,NULL,NULL,NULL),(1006,15,84,NULL,NULL,NULL,NULL),(1007,14,84,NULL,NULL,NULL,NULL),(1008,13,84,NULL,NULL,NULL,NULL),(1009,12,84,NULL,NULL,NULL,NULL),(1010,11,84,NULL,NULL,NULL,NULL),(1011,10,84,NULL,NULL,NULL,NULL),(1012,9,84,NULL,NULL,NULL,NULL),(1013,8,84,NULL,NULL,NULL,NULL),(1014,6,84,NULL,NULL,NULL,NULL),(1015,5,84,NULL,NULL,NULL,NULL),(1016,4,84,NULL,NULL,NULL,NULL),(1017,22,84,NULL,NULL,NULL,NULL),(1018,2,84,NULL,NULL,NULL,NULL),(1019,21,84,NULL,NULL,NULL,NULL),(1020,18,84,NULL,NULL,NULL,NULL),(1021,17,84,NULL,NULL,NULL,NULL),(1022,19,84,NULL,NULL,NULL,NULL),(1023,15,3,19.0,20.0,22.0,23.0),(1060,18,87,17.0,18.0,20.0,21.0),(1061,17,87,17.0,18.0,20.0,21.0),(1062,19,87,13.0,14.0,16.0,17.0),(1063,16,87,13.0,14.0,18.0,19.0),(1064,15,87,19.0,20.0,22.0,23.0),(1065,14,87,19.0,20.0,22.0,23.0),(1066,13,87,12.0,13.0,14.0,15.0),(1067,12,87,10.0,11.0,15.0,16.0),(1068,11,87,15.0,16.0,20.0,21.0),(1069,10,87,12.0,13.0,17.0,18.0),(1070,9,87,14.0,15.0,22.0,23.0),(1071,8,87,14.0,15.0,17.0,18.0),(1072,6,87,19.0,20.0,22.0,23.0),(1073,5,87,17.0,18.0,20.0,21.0),(1074,4,87,22.0,23.0,25.0,26.0),(1075,22,87,NULL,NULL,NULL,25.0),(1076,2,87,13.0,14.0,16.0,17.0),(1077,21,87,13.0,14.0,17.0,18.0),(1078,18,88,17.0,18.0,20.0,21.0),(1079,17,88,17.0,18.0,20.0,21.0),(1080,19,88,13.0,14.0,16.0,17.0),(1081,16,88,13.0,14.0,18.0,19.0),(1082,15,88,19.0,20.0,22.0,23.0),(1083,14,88,19.0,20.0,22.0,23.0),(1084,13,88,12.0,13.0,14.0,15.0),(1085,12,88,10.0,11.0,15.0,16.0),(1086,11,88,15.0,16.0,20.0,21.0),(1087,10,88,12.0,13.0,17.0,18.0),(1088,8,88,14.0,15.0,17.0,18.0),(1089,9,88,14.0,15.0,22.0,23.0),(1090,6,88,19.0,20.0,22.0,23.0),(1091,5,88,17.0,18.0,20.0,21.0),(1092,22,88,NULL,NULL,NULL,25.0),(1093,4,88,22.0,23.0,25.0,26.0),(1094,2,88,13.0,14.0,16.0,17.0),(1095,21,88,13.0,14.0,17.0,18.0),(1096,2,89,NULL,NULL,NULL,NULL),(1097,6,89,NULL,NULL,NULL,NULL),(1098,10,89,NULL,NULL,NULL,NULL),(1099,11,89,NULL,NULL,NULL,NULL),(1100,12,89,NULL,NULL,NULL,NULL),(1101,16,89,NULL,NULL,NULL,NULL),(1102,20,90,10.0,11.0,15.0,16.0),(1103,33,90,14.0,15.0,18.0,19.0),(1104,37,90,13.0,14.0,16.0,17.0),(1105,9,91,14.0,15.0,22.0,23.0),(1106,18,91,17.0,18.0,20.0,21.0),(1107,17,91,17.0,18.0,20.0,21.0),(1108,19,91,13.0,14.0,16.0,17.0),(1109,16,91,13.0,14.0,18.0,19.0),(1110,15,91,19.0,20.0,22.0,23.0),(1111,14,91,19.0,20.0,22.0,23.0),(1112,13,91,12.0,13.0,14.0,15.0),(1113,12,91,10.0,11.0,15.0,16.0),(1114,10,91,12.0,13.0,17.0,18.0),(1115,11,91,15.0,16.0,20.0,21.0),(1116,8,91,14.0,15.0,17.0,18.0),(1117,6,91,19.0,20.0,22.0,23.0),(1118,5,91,17.0,18.0,20.0,21.0),(1119,4,91,22.0,23.0,25.0,26.0),(1120,22,91,NULL,NULL,NULL,25.0),(1121,2,91,13.0,14.0,16.0,17.0),(1122,21,91,13.0,14.0,17.0,18.0),(1177,18,95,17.0,18.0,20.0,21.0),(1178,17,95,17.0,18.0,20.0,21.0),(1179,19,95,13.0,14.0,16.0,17.0),(1180,16,95,13.0,14.0,18.0,19.0),(1181,15,95,19.0,20.0,22.0,23.0),(1182,14,95,19.0,20.0,22.0,23.0),(1183,13,95,12.0,13.0,14.0,15.0),(1184,12,95,10.0,11.0,15.0,16.0),(1185,11,95,15.0,16.0,20.0,21.0),(1186,10,95,12.0,13.0,17.0,18.0),(1187,9,95,14.0,15.0,22.0,23.0),(1188,8,95,14.0,15.0,17.0,18.0),(1189,6,95,19.0,20.0,22.0,23.0),(1190,5,95,17.0,18.0,20.0,21.0),(1191,4,95,22.0,23.0,25.0,26.0),(1192,22,95,NULL,NULL,NULL,25.0),(1193,2,95,13.0,14.0,16.0,17.0),(1194,21,95,13.0,14.0,17.0,18.0),(1195,38,91,14.0,15.0,17.0,18.0),(1196,2,96,NULL,NULL,NULL,NULL),(1197,6,96,NULL,NULL,NULL,NULL),(1198,10,96,NULL,NULL,NULL,NULL),(1199,11,96,NULL,NULL,NULL,NULL),(1200,12,96,NULL,NULL,NULL,NULL),(1201,16,96,NULL,NULL,NULL,NULL),(1202,27,97,14.0,15.0,17.0,18.0),(1203,24,97,14.0,15.0,18.0,19.0),(1204,32,97,6.0,7.0,9.0,10.0),(1205,31,97,16.0,17.0,19.0,20.0),(1206,29,97,14.0,NULL,NULL,15.0),(1207,19,97,14.0,15.0,16.0,17.0),(1208,28,97,20.0,21.0,22.0,23.0),(1209,13,97,6.0,7.0,9.0,10.0),(1210,25,97,13.0,14.0,22.0,23.0),(1211,11,97,15.0,16.0,20.0,21.0),(1212,10,97,12.0,13.0,17.0,18.0),(1213,2,97,16.0,NULL,NULL,17.0),(1214,2,98,13.0,14.0,16.0,17.0),(1215,11,98,15.0,16.0,20.0,21.0),(1216,12,98,10.0,11.0,15.0,16.0),(1217,16,98,13.0,14.0,18.0,19.0),(1218,2,99,13.0,14.0,16.0,17.0),(1219,11,99,15.0,16.0,20.0,21.0),(1220,12,99,10.0,11.0,15.0,16.0),(1221,16,99,13.0,14.0,18.0,19.0),(1222,2,100,13.0,14.0,16.0,17.0),(1223,11,100,15.0,16.0,20.0,21.0),(1224,12,100,10.0,11.0,15.0,16.0),(1225,16,100,13.0,14.0,18.0,19.0),(1226,2,101,13.0,14.0,16.0,17.0),(1227,11,101,15.0,16.0,20.0,21.0),(1228,12,101,10.0,11.0,15.0,16.0),(1229,16,101,13.0,14.0,18.0,19.0),(1230,29,36,NULL,NULL,NULL,24.0),(1231,29,102,NULL,NULL,NULL,24.0),(1232,6,102,NULL,NULL,NULL,24.0),(1233,25,102,15.0,16.0,20.0,21.0),(1234,26,102,15.0,16.0,18.0,19.0),(1235,10,102,17.0,18.0,20.0,21.0),(1236,27,102,NULL,NULL,NULL,17.0),(1237,24,102,18.0,19.0,22.0,23.0),(1238,27,103,NULL,NULL,NULL,17.0),(1239,24,103,18.0,19.0,22.0,23.0),(1240,29,103,NULL,NULL,NULL,24.0),(1241,25,103,15.0,16.0,20.0,21.0),(1242,26,103,15.0,16.0,18.0,19.0),(1243,10,103,17.0,18.0,20.0,21.0),(1244,6,103,NULL,NULL,NULL,24.0),(1266,27,107,NULL,NULL,NULL,17.0),(1267,24,107,18.0,19.0,22.0,23.0),(1268,29,107,NULL,NULL,NULL,24.0),(1269,25,107,15.0,16.0,20.0,21.0),(1270,26,107,15.0,16.0,18.0,19.0),(1271,10,107,17.0,18.0,20.0,21.0),(1272,6,107,NULL,NULL,NULL,24.0),(1273,27,108,NULL,NULL,NULL,17.0),(1274,24,108,18.0,19.0,22.0,23.0),(1275,29,108,NULL,NULL,NULL,24.0),(1276,25,108,15.0,16.0,20.0,21.0),(1277,26,108,15.0,16.0,18.0,19.0),(1278,10,108,17.0,18.0,20.0,21.0),(1279,6,108,NULL,NULL,NULL,24.0),(1280,22,32,18.0,19.0,24.0,25.0),(1281,1,32,14.0,15.0,16.0,17.0),(1282,2,109,13.0,14.0,16.0,17.0),(1283,10,109,12.0,13.0,17.0,18.0),(1284,11,109,15.0,16.0,20.0,21.0),(1285,12,109,10.0,11.0,15.0,16.0),(1286,6,109,13.0,14.0,20.0,21.0),(1287,16,109,13.0,14.0,18.0,19.0),(1288,39,34,6.0,7.0,9.0,10.0),(1289,3,33,13.0,14.0,17.0,18.0),(1290,15,33,19.0,20.0,22.0,23.0),(1291,4,33,22.0,23.0,25.0,26.0),(1292,25,110,13.0,14.0,22.0,23.0),(1293,26,110,14.0,15.0,20.0,21.0),(1294,24,110,14.0,15.0,18.0,19.0),(1295,12,110,10.0,11.0,15.0,16.0),(1296,10,110,12.0,13.0,17.0,18.0),(1297,11,110,15.0,16.0,20.0,21.0),(1298,13,110,12.0,13.0,14.0,15.0),(1299,19,110,13.0,14.0,16.0,17.0),(1300,31,110,16.0,17.0,19.0,20.0),(1301,28,110,16.0,17.0,20.0,21.0),(1302,24,111,14.0,15.0,18.0,19.0),(1303,27,111,NULL,NULL,NULL,15.0),(1304,31,111,16.0,17.0,19.0,20.0),(1305,19,111,14.0,15.0,16.0,17.0),(1306,28,111,NULL,NULL,NULL,20.0),(1307,11,111,15.0,16.0,20.0,21.0),(1308,10,111,12.0,13.0,17.0,18.0),(1309,36,111,19.0,NULL,NULL,25.0),(1310,29,111,28.0,NULL,NULL,29.0),(1311,26,111,14.0,15.0,20.0,21.0),(1312,12,111,10.0,11.0,15.0,16.0),(1313,13,111,12.0,13.0,14.0,15.0);
/*!40000 ALTER TABLE `zone_diameters` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-29 18:39:51
