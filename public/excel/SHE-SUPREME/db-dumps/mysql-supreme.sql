
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
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (192,'default','{\"displayName\":\"App\\\\Mail\\\\AccidentActionMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":3:{s:8:\\\"mailable\\\";O:27:\\\"App\\\\Mail\\\\AccidentActionMail\\\":23:{s:6:\\\"record\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":3:{s:5:\\\"class\\\";s:36:\\\"App\\\\Models\\\\Accident\\\\ReportActionPlan\\\";s:2:\\\"id\\\";i:9;s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:5:\\\"title\\\";s:48:\\\"There is new Accident\\/Incident for you to action\\\";s:4:\\\"urls\\\";s:44:\\\"http:\\/\\/supreme-hse.test:88\\/accident\\/review\\/9\\\";s:8:\\\"subtitle\\\";s:48:\\\"There is new Accident\\/Incident for you to action\\\";s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"adriyana.pragma@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:11:\\\"\\u0000*\\u0000markdown\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;}\"}}',0,NULL,1566882082,1566882082);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `jobs_deadline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_deadline` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `form_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `jobs_deadline` WRITE;
/*!40000 ALTER TABLE `jobs_deadline` DISABLE KEYS */;
INSERT INTO `jobs_deadline` VALUES (1,'2019-06-10',1,NULL,NULL,'2019-07-09 04:12:20','2019-07-24 08:34:51','8','equipment',NULL),(2,'2019-07-10',1,NULL,NULL,'2019-07-29 09:16:12','2019-07-29 09:16:12','33','inspection_record',NULL),(3,'2019-07-10',1,NULL,NULL,'2019-07-29 09:16:42','2019-07-29 09:16:42','32','inspection_record',NULL),(4,'2019-07-10',1,NULL,NULL,'2019-07-30 03:58:43','2019-07-30 03:58:43','31','inspection_record',NULL),(5,'2019-07-10',1,NULL,NULL,'2019-07-30 03:59:13','2019-07-30 03:59:13','30','inspection_record',NULL),(6,'2019-07-24',1,NULL,NULL,'2019-07-30 05:57:09','2019-07-30 05:57:09','34','inspection_record',NULL),(7,'2019-07-15',1,NULL,NULL,'2019-08-06 08:45:17','2019-08-06 08:45:17','10','equipment',NULL),(8,'2019-07-16',1,NULL,NULL,'2019-08-06 08:50:46','2019-08-06 08:50:46','13','equipment',NULL),(9,'2019-07-15',1,NULL,NULL,'2019-08-06 08:53:45','2019-08-06 10:16:27','17','equipment',NULL),(10,'2019-07-10',1,NULL,NULL,'2019-08-16 03:33:03','2019-08-16 03:33:03','29','inspection_record',NULL),(11,'2019-07-10',1,NULL,NULL,'2019-08-16 03:35:28','2019-08-16 03:35:28','28','inspection_record',NULL);
/*!40000 ALTER TABLE `jobs_deadline` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `jobs_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_notification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fullurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `jobs_notification` WRITE;
/*!40000 ALTER TABLE `jobs_notification` DISABLE KEYS */;
INSERT INTO `jobs_notification` VALUES (148,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/4','There is new bulletin for you to view','1','bulletin','4','1',NULL,NULL,'2019-06-26 03:24:13','2019-08-14 11:53:36','http://supreme-hse.test:88/communication/bulletin'),(149,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/5','There is new bulletin for you to view','1','bulletin','5','1',NULL,NULL,'2019-06-26 03:24:43','2019-08-14 11:53:36','http://supreme-hse.test:88/communication/bulletin'),(150,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/8','There is new bulletin for you to view','1','bulletin','8','1',NULL,NULL,'2019-08-13 03:33:53','2019-08-14 11:53:36','http://supreme-hse.test:88/communication/bulletin'),(151,'Policy Report','http://supreme-hse.test:88/communication/policy/6','There is new policy for you to view','1','policy','6','1',NULL,NULL,'2019-08-12 01:52:38','2019-08-14 11:53:37','http://supreme-hse.test:88/communication/policy'),(152,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/9','There is new bulletin for you to view','1','bulletin','9','1',NULL,NULL,'2019-08-15 02:53:09','2019-08-15 02:58:53','http://supreme-hse.test:88/communication/bulletin'),(153,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/10','There is new bulletin for you to view','1','bulletin','10','1',NULL,NULL,'2019-08-15 02:53:59','2019-08-15 02:58:53','http://supreme-hse.test:88/communication/bulletin'),(154,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/11','There is new bulletin for you to view','1','bulletin','11','1',NULL,NULL,'2019-08-15 02:54:10','2019-08-15 02:58:54','http://supreme-hse.test:88/communication/bulletin'),(155,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/12','There is new bulletin for you to view','1','bulletin','12','1',NULL,NULL,'2019-08-15 02:56:04','2019-08-15 02:58:54','http://supreme-hse.test:88/communication/bulletin'),(156,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/13','There is new bulletin for you to view','1','bulletin','13','1',NULL,NULL,'2019-08-15 02:58:19','2019-08-15 02:58:54','http://supreme-hse.test:88/communication/bulletin'),(157,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/14','There is new bulletin for you to view','1','bulletin','14','1',NULL,NULL,'2019-08-15 02:59:16','2019-08-15 02:59:32','http://supreme-hse.test:88/communication/bulletin'),(158,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/4','There is new bulletin for you to view','2','bulletin','4','1',NULL,NULL,'2019-06-26 03:24:13','2019-08-15 03:01:01','http://supreme-hse.test:88/communication/bulletin'),(159,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/5','There is new bulletin for you to view','2','bulletin','5','1',NULL,NULL,'2019-06-26 03:24:43','2019-08-15 03:01:01','http://supreme-hse.test:88/communication/bulletin'),(160,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/8','There is new bulletin for you to view','2','bulletin','8','1',NULL,NULL,'2019-08-13 03:33:53','2019-08-15 03:01:01','http://supreme-hse.test:88/communication/bulletin'),(161,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/9','There is new bulletin for you to view','2','bulletin','9','1',NULL,NULL,'2019-08-15 02:53:09','2019-08-15 03:01:01','http://supreme-hse.test:88/communication/bulletin'),(162,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/10','There is new bulletin for you to view','2','bulletin','10','1',NULL,NULL,'2019-08-15 02:53:59','2019-08-15 03:01:02','http://supreme-hse.test:88/communication/bulletin'),(163,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/11','There is new bulletin for you to view','2','bulletin','11','1',NULL,NULL,'2019-08-15 02:54:10','2019-08-15 03:01:02','http://supreme-hse.test:88/communication/bulletin'),(164,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/12','There is new bulletin for you to view','2','bulletin','12','1',NULL,NULL,'2019-08-15 02:56:04','2019-08-15 03:01:02','http://supreme-hse.test:88/communication/bulletin'),(165,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/13','There is new bulletin for you to view','2','bulletin','13','1',NULL,NULL,'2019-08-15 02:58:19','2019-08-15 03:01:02','http://supreme-hse.test:88/communication/bulletin'),(166,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/14','There is new bulletin for you to view','2','bulletin','14','1',NULL,NULL,'2019-08-15 02:59:16','2019-08-15 03:01:02','http://supreme-hse.test:88/communication/bulletin'),(167,'Policy Report','http://supreme-hse.test:88/communication/policy/6','There is new policy for you to view','2','policy','6','1',NULL,NULL,'2019-08-12 01:52:38','2019-08-15 03:01:02','http://supreme-hse.test:88/communication/policy'),(168,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/15','There is new bulletin for you to view','1','bulletin','15','1',NULL,NULL,'2019-08-15 03:04:50','2019-08-15 03:05:18','http://supreme-hse.test:88/communication/bulletin'),(169,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/16','There is new bulletin for you to view','1','bulletin','16','1',NULL,NULL,'2019-08-15 03:05:01','2019-08-15 03:05:18','http://supreme-hse.test:88/communication/bulletin'),(170,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/17','There is new bulletin for you to view','1','bulletin','17','1',NULL,NULL,'2019-08-15 03:05:28','2019-08-15 03:11:03','http://supreme-hse.test:88/communication/bulletin'),(171,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/18','There is new bulletin for you to view','1','bulletin','18','1',NULL,NULL,'2019-08-15 03:05:46','2019-08-15 03:11:04','http://supreme-hse.test:88/communication/bulletin'),(172,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/19','There is new bulletin for you to view','1','bulletin','19','1',NULL,NULL,'2019-08-15 03:06:04','2019-08-15 03:11:04','http://supreme-hse.test:88/communication/bulletin'),(173,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/20','There is new bulletin for you to view','1','bulletin','20','1',NULL,NULL,'2019-08-15 03:06:36','2019-08-15 03:11:04','http://supreme-hse.test:88/communication/bulletin'),(174,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/21','There is new bulletin for you to view','1','bulletin','21','1',NULL,NULL,'2019-08-15 03:07:27','2019-08-15 03:11:04','http://supreme-hse.test:88/communication/bulletin'),(175,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/22','There is new bulletin for you to view','1','bulletin','22','1',NULL,NULL,'2019-08-15 03:08:24','2019-08-15 03:11:04','http://supreme-hse.test:88/communication/bulletin'),(176,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/23','There is new bulletin for you to view','1','bulletin','23','1',NULL,NULL,'2019-08-15 03:09:06','2019-08-15 03:11:04','http://supreme-hse.test:88/communication/bulletin'),(177,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/24','There is new bulletin for you to view','1','bulletin','24','1',NULL,NULL,'2019-08-15 03:10:13','2019-08-15 03:11:04','http://supreme-hse.test:88/communication/bulletin'),(178,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/25','There is new bulletin for you to view','1','bulletin','25','1',NULL,NULL,'2019-08-15 03:11:23','2019-08-15 03:18:06','http://supreme-hse.test:88/communication/bulletin'),(179,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/26','There is new bulletin for you to view','1','bulletin','26','1',NULL,NULL,'2019-08-15 03:12:15','2019-08-15 03:18:07','http://supreme-hse.test:88/communication/bulletin'),(180,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/27','There is new bulletin for you to view','1','bulletin','27','1',NULL,NULL,'2019-08-15 03:14:17','2019-08-15 03:18:07','http://supreme-hse.test:88/communication/bulletin'),(181,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/28','There is new bulletin for you to view','1','bulletin','28','1',NULL,NULL,'2019-08-15 03:17:27','2019-08-15 03:18:07','http://supreme-hse.test:88/communication/bulletin'),(182,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/29','There is new bulletin for you to view','1','bulletin','29','1',NULL,NULL,'2019-08-15 03:20:41','2019-08-15 03:23:02','http://supreme-hse.test:88/communication/bulletin'),(183,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/30','There is new bulletin for you to view','1','bulletin','30','1',NULL,NULL,'2019-08-15 03:20:53','2019-08-15 03:23:02','http://supreme-hse.test:88/communication/bulletin'),(184,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/31','There is new bulletin for you to view','1','bulletin','31','1',NULL,NULL,'2019-08-15 03:21:36','2019-08-15 03:23:02','http://supreme-hse.test:88/communication/bulletin'),(185,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/32','There is new bulletin for you to view','1','bulletin','32','1',NULL,NULL,'2019-08-15 03:23:11','2019-08-15 03:26:26','http://supreme-hse.test:88/communication/bulletin'),(186,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/33','There is new bulletin for you to view','1','bulletin','33','1',NULL,NULL,'2019-08-15 03:23:36','2019-08-15 03:26:26','http://supreme-hse.test:88/communication/bulletin'),(187,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/34','There is new bulletin for you to view','1','bulletin','34','1',NULL,NULL,'2019-08-15 03:24:40','2019-08-15 03:26:26','http://supreme-hse.test:88/communication/bulletin'),(188,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/35','There is new bulletin for you to view','1','bulletin','35','1',NULL,NULL,'2019-08-15 03:25:22','2019-08-15 03:26:26','http://supreme-hse.test:88/communication/bulletin'),(189,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/36','There is new bulletin for you to view','1','bulletin','36','1',NULL,NULL,'2019-08-15 03:25:56','2019-08-15 03:26:26','http://supreme-hse.test:88/communication/bulletin'),(190,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/37','There is new bulletin for you to view','1','bulletin','37','1',NULL,NULL,'2019-08-15 03:26:35','2019-08-15 03:27:23','http://supreme-hse.test:88/communication/bulletin'),(191,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/38','There is new bulletin for you to view','1','bulletin','38','1',NULL,NULL,'2019-08-15 03:27:33','2019-08-15 03:28:51','http://supreme-hse.test:88/communication/bulletin'),(192,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/39','There is new bulletin for you to view','1','bulletin','39','1',NULL,NULL,'2019-08-15 03:28:58','2019-08-15 03:29:18','http://supreme-hse.test:88/communication/bulletin'),(193,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/40','There is new bulletin for you to view','1','bulletin','40','1',NULL,NULL,'2019-08-15 03:29:48','2019-08-15 03:31:15','http://supreme-hse.test:88/communication/bulletin'),(194,'Bulletin Report','http://supreme-hse.test:88/communication/bulletin/41','There is new bulletin for you to view','1','bulletin','41','1',NULL,NULL,'2019-08-15 03:31:22','2019-08-15 03:33:38','http://supreme-hse.test:88/communication/bulletin'),(195,'Policy Report','http://supreme-hse.test:88/communication/policy/7','There is new policy for you to view','1','policy','7','1',NULL,NULL,'2019-08-15 03:34:01','2019-08-15 03:48:07','http://supreme-hse.test:88/communication/policy'),(196,'Hazard / Near Miss Reporting','http://supreme-hse.test:88/hnmr/monitoring/13','Hazard / Near Miss Reporting','1','hnmr','13','1',NULL,NULL,'2019-08-15 03:49:55','2019-08-15 03:49:55','http://supreme-hse.test:88/hnmr/monitoring'),(197,'Accident/Incident Action','http://supreme-hse.test:88/accident/review/6','There is new Accident/Incident for you to action','1','accident','6','2',NULL,NULL,'2019-08-16 02:57:23','2019-09-09 08:18:43','http://supreme-hse.test:88/accident/review'),(198,'Accident/Incident Action','http://supreme-hse.test:88/accident/review/7','There is new Accident/Incident for you to action','1','accident','7','2',NULL,NULL,'2019-08-16 03:07:50','2019-09-09 08:18:44','http://supreme-hse.test:88/accident/review'),(199,'Inspection & Visit Action','http://supreme-hse.test:88/inspection-visit/action/29/edit','You Have Been a Sign for Action','2','inspection_record','29','1',NULL,NULL,'2019-08-16 03:33:03','2019-08-16 03:33:03','http://supreme-hse.test:88/inspection-visit/action'),(200,'Inspection & Visit Action','http://supreme-hse.test:88/inspection-visit/action/28/edit','You Have Been a Sign for Action','1','inspection_record','28','1',NULL,NULL,'2019-08-16 03:35:28','2019-08-16 03:35:28','http://supreme-hse.test:88/inspection-visit/action'),(201,'Hazard / Near Miss Reporting','http://supreme-hse.test:88/hnmr/action/13','Hazard / Near Miss Reporting','1','hnmr','13','1',NULL,NULL,'2019-08-21 02:58:23','2019-08-21 02:58:23','http://supreme-hse.test:88/hnmr/action'),(202,'Hazard / Near Miss Reporting','http://supreme-hse.test:88/hnmr/reporting/13','Hazard / Near Miss Reporting','1','hnmr','13','1',NULL,NULL,'2019-08-21 02:58:23','2019-08-21 02:58:23','http://supreme-hse.test:88/hnmr/reporting'),(203,'Hazard / Near Miss Reporting','http://supreme-hse.test:88/hnmr/monitoring/review/13','Hazard / Near Miss Reporting','1','hnmr','13','1',NULL,NULL,'2019-08-21 02:59:59','2019-08-21 02:59:59','http://supreme-hse.test:88/hnmr/monitoring/review'),(204,'Hazard / Near Miss Reporting','http://supreme-hse.test:88/hnmr/reporting/13','Hazard / Near Miss Reporting','1','hnmr','13','1',NULL,NULL,'2019-08-21 02:59:59','2019-08-21 02:59:59','http://supreme-hse.test:88/hnmr/reporting'),(205,'Hazard / Near Miss Reporting','http://supreme-hse.test:88/hnmr/monitoring/review/3','Hazard / Near Miss Reporting','1','hnmr','3','1',NULL,NULL,'2019-08-21 03:02:50','2019-08-21 03:02:50','http://supreme-hse.test:88/hnmr/monitoring/review'),(206,'Hazard / Near Miss Reporting','http://supreme-hse.test:88/hnmr/reporting/3','Hazard / Near Miss Reporting','1','hnmr','3','1',NULL,NULL,'2019-08-21 03:02:50','2019-08-21 03:02:50','http://supreme-hse.test:88/hnmr/reporting'),(207,'Hazard Identification and Risk Assessment','http://supreme-hse.test:88/hira/review/confirm/4','Hazard Identification and Risk Assessment','1','hira','4','1',NULL,NULL,'2019-08-21 03:29:18','2019-08-21 03:29:18','http://supreme-hse.test:88/hira/review/confirm'),(208,'Hazard Identification and Risk Assessment','http://supreme-hse.test:88/hira/review/confirm/4','Hazard Identification and Risk Assessment','1','hira','4','1',NULL,NULL,'2019-08-21 03:31:27','2019-08-21 03:31:27','http://supreme-hse.test:88/hira/review/confirm'),(209,'Hazard Identification and Risk Assessment','http://supreme-hse.test:88/hira/analysis/4','Hazard Identification and Risk Assessment','1','hira','4','1',NULL,NULL,'2019-08-21 04:02:14','2019-08-21 04:02:14','http://supreme-hse.test:88/hira/analysis'),(210,'Hazard Identification and Risk Assessment','http://supreme-hse.test:88/hira/approval/confirm/4','Hazard Identification and Risk Assessment','1','hira','4','1',NULL,NULL,'2019-08-21 04:02:14','2019-08-21 04:02:14','http://supreme-hse.test:88/hira/approval/confirm'),(211,'Hazard Identification and Risk Assessment','http://supreme-hse.test:88/hira/analysis/4','Hazard Identification and Risk Assessment','1','hira','4','1',NULL,NULL,'2019-08-21 04:02:43','2019-08-21 04:02:43','http://supreme-hse.test:88/hira/analysis'),(212,'Hazard Identification and Risk Assessment','http://supreme-hse.test:88/hira/review/4','Hazard Identification and Risk Assessment','1','hira','4','1',NULL,NULL,'2019-08-21 04:02:43','2019-08-21 04:02:43','http://supreme-hse.test:88/hira/review'),(213,'Accident/Incident Action','http://supreme-hse.test:88/accident/review/9','There is new Accident/Incident for you to action','1','accident','9','2',NULL,NULL,'2019-08-27 05:01:22','2019-09-09 08:18:44','http://supreme-hse.test:88/accident/review');
/*!40000 ALTER TABLE `jobs_notification` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\Authentication\\User',1),(2,'App\\Models\\Authentication\\User',2),(1,'App\\Models\\Authentication\\User',4),(1,'App\\Models\\Authentication\\User',5),(1,'App\\Models\\Authentication\\User',6);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=435 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'dashboard-view','web','2019-03-14 09:58:05','2019-03-14 09:58:05'),(2,'master-pegawai-view','web','2019-03-14 09:58:05','2019-03-14 09:58:05'),(3,'master-pegawai-add','web','2019-03-14 09:58:05','2019-03-14 09:58:05'),(4,'master-pegawai-edit','web','2019-03-14 09:58:05','2019-03-14 09:58:05'),(5,'master-pegawai-delete','web','2019-03-14 09:58:05','2019-03-14 09:58:05'),(6,'konfigurasi-users-view','web','2019-03-14 09:58:05','2019-03-14 09:58:05'),(7,'konfigurasi-users-add','web','2019-03-14 09:58:05','2019-03-14 09:58:05'),(8,'konfigurasi-users-edit','web','2019-03-14 09:58:05','2019-03-14 09:58:05'),(9,'konfigurasi-users-delete','web','2019-03-14 09:58:05','2019-03-14 09:58:05'),(10,'konfigurasi-roles-view','web','2019-03-14 09:58:06','2019-03-14 09:58:06'),(11,'konfigurasi-roles-add','web','2019-03-14 09:58:06','2019-03-14 09:58:06'),(12,'konfigurasi-roles-edit','web','2019-03-14 09:58:06','2019-03-14 09:58:06'),(13,'konfigurasi-roles-delete','web','2019-03-14 09:58:06','2019-03-14 09:58:06'),(14,'trans-documents-view','web','2019-03-14 09:58:35','2019-03-14 09:58:35'),(15,'trans-documents-add','web','2019-03-14 09:58:35','2019-03-14 09:58:35'),(16,'trans-documents-edit','web','2019-03-14 09:58:35','2019-03-14 09:58:35'),(17,'trans-documents-delete','web','2019-03-14 09:58:35','2019-03-14 09:58:35'),(18,'trans-regulations-view','web','2019-03-15 02:44:49','2019-03-15 02:44:49'),(19,'trans-regulations-add','web','2019-03-15 02:44:49','2019-03-15 02:44:49'),(20,'trans-regulations-edit','web','2019-03-15 02:44:49','2019-03-15 02:44:49'),(21,'trans-regulations-delete','web','2019-03-15 02:44:49','2019-03-15 02:44:49'),(22,'master-type-regulations-standard-view','web','2019-03-15 03:54:02','2019-03-15 03:54:02'),(23,'master-type-regulations-standard-add','web','2019-03-15 03:54:03','2019-03-15 03:54:03'),(24,'master-type-regulations-standard-edit','web','2019-03-15 03:54:03','2019-03-15 03:54:03'),(25,'master-type-regulations-standard-delete','web','2019-03-15 03:54:03','2019-03-15 03:54:03'),(26,'master-type-equipment-view','web','2019-03-18 04:22:08','2019-03-18 04:22:08'),(27,'master-type-equipment-add','web','2019-03-18 04:22:08','2019-03-18 04:22:08'),(28,'master-type-equipment-edit','web','2019-03-18 04:22:08','2019-03-18 04:22:08'),(29,'master-type-equipment-delete','web','2019-03-18 04:22:08','2019-03-18 04:22:08'),(30,'master-departemen-view','web','2019-03-18 04:40:46','2019-03-18 04:40:46'),(31,'master-departemen-add','web','2019-03-18 04:40:46','2019-03-18 04:40:46'),(32,'master-departemen-edit','web','2019-03-18 04:40:46','2019-03-18 04:40:46'),(33,'master-departemen-delete','web','2019-03-18 04:40:46','2019-03-18 04:40:46'),(34,'master-type-project-view','web','2019-03-18 04:58:53','2019-03-18 04:58:53'),(35,'master-type-project-add','web','2019-03-18 04:58:53','2019-03-18 04:58:53'),(36,'master-type-project-edit','web','2019-03-18 04:58:53','2019-03-18 04:58:53'),(37,'master-type-project-delete','web','2019-03-18 04:58:53','2019-03-18 04:58:53'),(38,'master-title-data-view','web','2019-03-18 05:05:29','2019-03-18 05:05:29'),(39,'master-title-data-add','web','2019-03-18 05:05:30','2019-03-18 05:05:30'),(40,'master-title-data-edit','web','2019-03-18 05:05:30','2019-03-18 05:05:30'),(41,'master-title-data-delete','web','2019-03-18 05:05:30','2019-03-18 05:05:30'),(42,'master-sub-contractor-view','web','2019-03-18 05:42:11','2019-03-18 05:42:11'),(43,'master-sub-contractor-add','web','2019-03-18 05:42:11','2019-03-18 05:42:11'),(44,'master-sub-contractor-edit','web','2019-03-18 05:42:12','2019-03-18 05:42:12'),(45,'master-sub-contractor-delete','web','2019-03-18 05:42:12','2019-03-18 05:42:12'),(46,'master-project-view','web','2019-03-18 09:14:49','2019-03-18 09:14:49'),(47,'master-project-add','web','2019-03-18 09:14:49','2019-03-18 09:14:49'),(48,'master-project-edit','web','2019-03-18 09:14:49','2019-03-18 09:14:49'),(49,'master-project-delete','web','2019-03-18 09:14:49','2019-03-18 09:14:49'),(50,'master-type-observation-card-view','web','2019-03-18 09:58:38','2019-03-18 09:58:38'),(51,'master-type-observation-card-add','web','2019-03-18 09:58:39','2019-03-18 09:58:39'),(52,'master-type-observation-card-edit','web','2019-03-18 09:58:39','2019-03-18 09:58:39'),(53,'master-type-observation-card-delete','web','2019-03-18 09:58:39','2019-03-18 09:58:39'),(54,'master-type-bulletin-view','web','2019-03-18 10:06:03','2019-03-18 10:06:03'),(55,'master-type-bulletin-add','web','2019-03-18 10:06:03','2019-03-18 10:06:03'),(56,'master-type-bulletin-edit','web','2019-03-18 10:06:03','2019-03-18 10:06:03'),(57,'master-type-bulletin-delete','web','2019-03-18 10:06:03','2019-03-18 10:06:03'),(58,'master-hse-plan-view','web','2019-03-18 10:17:24','2019-03-18 10:17:24'),(59,'master-hse-plan-add','web','2019-03-18 10:17:24','2019-03-18 10:17:24'),(60,'master-hse-plan-edit','web','2019-03-18 10:17:24','2019-03-18 10:17:24'),(61,'master-hse-plan-delete','web','2019-03-18 10:17:24','2019-03-18 10:17:24'),(62,'master-component-view','web','2019-03-19 03:58:41','2019-03-19 03:58:41'),(63,'master-component-add','web','2019-03-19 03:58:42','2019-03-19 03:58:42'),(64,'master-component-edit','web','2019-03-19 03:58:42','2019-03-19 03:58:42'),(65,'master-component-delete','web','2019-03-19 03:58:42','2019-03-19 03:58:42'),(66,'master-sub-component-view','web','2019-03-19 03:58:42','2019-03-19 03:58:42'),(67,'master-sub-component-add','web','2019-03-19 03:58:42','2019-03-19 03:58:42'),(68,'master-sub-component-edit','web','2019-03-19 03:58:42','2019-03-19 03:58:42'),(69,'master-sub-component-delete','web','2019-03-19 03:58:42','2019-03-19 03:58:42'),(70,'trans-equipment-view','web','2019-03-19 07:39:55','2019-03-19 07:39:55'),(71,'trans-equipment-add','web','2019-03-19 07:39:55','2019-03-19 07:39:55'),(72,'trans-equipment-edit','web','2019-03-19 07:39:55','2019-03-19 07:39:55'),(73,'trans-equipment-delete','web','2019-03-19 07:39:55','2019-03-19 07:39:55'),(74,'master-site-view','web','2019-03-20 09:54:21','2019-03-20 09:54:21'),(75,'master-site-add','web','2019-03-20 09:54:22','2019-03-20 09:54:22'),(76,'master-site-edit','web','2019-03-20 09:54:22','2019-03-20 09:54:22'),(77,'master-site-delete','web','2019-03-20 09:54:22','2019-03-20 09:54:22'),(78,'trans-induction-view','web','2019-03-21 02:55:42','2019-03-21 02:55:42'),(79,'trans-induction-add','web','2019-03-21 02:55:43','2019-03-21 02:55:43'),(80,'trans-induction-edit','web','2019-03-21 02:55:43','2019-03-21 02:55:43'),(81,'trans-induction-delete','web','2019-03-21 02:55:43','2019-03-21 02:55:43'),(82,'tbm-view','web','2019-03-22 08:52:43','2019-03-22 08:52:43'),(83,'tbm-add','web','2019-03-22 08:52:43','2019-03-22 08:52:43'),(84,'tbm-edit','web','2019-03-22 08:52:43','2019-03-22 08:52:43'),(85,'tbm-delete','web','2019-03-22 08:52:43','2019-03-22 08:52:43'),(86,'documents-view','web','2019-03-22 09:05:23','2019-03-22 09:05:23'),(87,'documents-add','web','2019-03-22 09:05:23','2019-03-22 09:05:23'),(88,'documents-edit','web','2019-03-22 09:05:23','2019-03-22 09:05:23'),(89,'documents-delete','web','2019-03-22 09:05:24','2019-03-22 09:05:24'),(90,'equipment-view','web','2019-03-22 09:11:12','2019-03-22 09:11:12'),(91,'equipment-add','web','2019-03-22 09:11:12','2019-03-22 09:11:12'),(92,'equipment-edit','web','2019-03-22 09:11:12','2019-03-22 09:11:12'),(93,'equipment-delete','web','2019-03-22 09:11:12','2019-03-22 09:11:12'),(94,'regulations-view','web','2019-03-22 09:15:56','2019-03-22 09:15:56'),(95,'regulations-add','web','2019-03-22 09:15:56','2019-03-22 09:15:56'),(96,'regulations-edit','web','2019-03-22 09:15:56','2019-03-22 09:15:56'),(97,'regulations-delete','web','2019-03-22 09:15:56','2019-03-22 09:15:56'),(98,'industrial-view','web','2019-03-22 09:28:40','2019-03-22 09:28:40'),(99,'industrial-add','web','2019-03-22 09:28:40','2019-03-22 09:28:40'),(100,'industrial-edit','web','2019-03-22 09:28:40','2019-03-22 09:28:40'),(101,'industrial-delete','web','2019-03-22 09:28:40','2019-03-22 09:28:40'),(102,'accident-record-view','web','2019-03-25 03:54:04','2019-03-25 03:54:04'),(103,'accident-record-add','web','2019-03-25 03:54:04','2019-03-25 03:54:04'),(104,'accident-record-edit','web','2019-03-25 03:54:04','2019-03-25 03:54:04'),(105,'accident-record-delete','web','2019-03-25 03:54:04','2019-03-25 03:54:04'),(106,'accident-record-approval','web','2019-03-25 03:54:04','2019-03-25 03:54:04'),(107,'accident-record-review','web','2019-03-25 03:54:04','2019-03-25 03:54:04'),(108,'accident-investigation-view','web','2019-03-25 03:54:04','2019-03-25 03:54:04'),(109,'accident-investigation-add','web','2019-03-25 03:54:05','2019-03-25 03:54:05'),(110,'accident-investigation-edit','web','2019-03-25 03:54:05','2019-03-25 03:54:05'),(111,'accident-investigation-delete','web','2019-03-25 03:54:05','2019-03-25 03:54:05'),(112,'accident-investigation-approval','web','2019-03-25 03:54:05','2019-03-25 03:54:05'),(113,'accident-investigation-review','web','2019-03-25 03:54:05','2019-03-25 03:54:05'),(114,'audit-view','web','2019-03-25 03:54:05','2019-03-25 03:54:05'),(115,'audit-add','web','2019-03-25 03:54:05','2019-03-25 03:54:05'),(116,'audit-edit','web','2019-03-25 03:54:05','2019-03-25 03:54:05'),(117,'audit-delete','web','2019-03-25 03:54:06','2019-03-25 03:54:06'),(118,'communication-bulletin-view','web','2019-03-25 03:54:06','2019-03-25 03:54:06'),(119,'communication-bulletin-add','web','2019-03-25 03:54:06','2019-03-25 03:54:06'),(120,'communication-bulletin-edit','web','2019-03-25 03:54:06','2019-03-25 03:54:06'),(121,'communication-bulletin-delete','web','2019-03-25 03:54:06','2019-03-25 03:54:06'),(122,'communication-policy-view','web','2019-03-25 03:54:06','2019-03-25 03:54:06'),(123,'communication-policy-add','web','2019-03-25 03:54:06','2019-03-25 03:54:06'),(124,'communication-policy-edit','web','2019-03-25 03:54:06','2019-03-25 03:54:06'),(125,'communication-policy-delete','web','2019-03-25 03:54:06','2019-03-25 03:54:06'),(126,'hse-plan-record-view','web','2019-03-25 03:54:07','2019-03-25 03:54:07'),(127,'hse-plan-record-add','web','2019-03-25 03:54:07','2019-03-25 03:54:07'),(128,'hse-plan-record-edit','web','2019-03-25 03:54:07','2019-03-25 03:54:07'),(129,'hse-plan-record-delete','web','2019-03-25 03:54:07','2019-03-25 03:54:07'),(130,'hse-plan-monitoring-view','web','2019-03-25 03:54:07','2019-03-25 03:54:07'),(131,'hse-plan-monitoring-add','web','2019-03-25 03:54:07','2019-03-25 03:54:07'),(132,'hse-plan-monitoring-edit','web','2019-03-25 03:54:07','2019-03-25 03:54:07'),(133,'hse-plan-monitoring-delete','web','2019-03-25 03:54:08','2019-03-25 03:54:08'),(134,'hazard-identification-view','web','2019-03-25 08:24:56','2019-03-25 08:24:56'),(135,'hazard-identification-add','web','2019-03-25 08:24:56','2019-03-25 08:24:56'),(136,'hazard-identification-edit','web','2019-03-25 08:24:56','2019-03-25 08:24:56'),(137,'hazard-identification-delete','web','2019-03-25 08:24:56','2019-03-25 08:24:56'),(138,'hazard-risk-assesments-view','web','2019-03-25 08:24:57','2019-03-25 08:24:57'),(139,'hazard-risk-assesments-add','web','2019-03-25 08:24:57','2019-03-25 08:24:57'),(140,'hazard-risk-assesments-edit','web','2019-03-25 08:24:57','2019-03-25 08:24:57'),(141,'hazard-risk-assesments-delete','web','2019-03-25 08:24:57','2019-03-25 08:24:57'),(142,'hazard-miss-reporting-view','web','2019-03-25 08:24:57','2019-03-25 08:24:57'),(143,'hazard-miss-reporting-add','web','2019-03-25 08:24:57','2019-03-25 08:24:57'),(144,'hazard-miss-reporting-edit','web','2019-03-25 08:24:57','2019-03-25 08:24:57'),(145,'hazard-miss-reporting-delete','web','2019-03-25 08:24:57','2019-03-25 08:24:57'),(146,'man-power-view','web','2019-03-25 08:33:50','2019-03-25 08:33:50'),(147,'man-power-add','web','2019-03-25 08:33:50','2019-03-25 08:33:50'),(148,'man-power-edit','web','2019-03-25 08:33:50','2019-03-25 08:33:50'),(149,'man-power-delete','web','2019-03-25 08:33:50','2019-03-25 08:33:50'),(150,'training-view','web','2019-03-26 03:16:09','2019-03-26 03:16:09'),(151,'training-add','web','2019-03-26 03:16:09','2019-03-26 03:16:09'),(152,'training-edit','web','2019-03-26 03:16:09','2019-03-26 03:16:09'),(153,'training-delete','web','2019-03-26 03:16:09','2019-03-26 03:16:09'),(154,'induction-view','web','2019-03-26 03:16:09','2019-03-26 03:16:09'),(155,'induction-add','web','2019-03-26 03:16:09','2019-03-26 03:16:09'),(156,'induction-edit','web','2019-03-26 03:16:09','2019-03-26 03:16:09'),(157,'induction-delete','web','2019-03-26 03:16:10','2019-03-26 03:16:10'),(158,'wp-view','web','2019-03-26 03:16:10','2019-03-26 03:16:10'),(159,'wp-add','web','2019-03-26 03:16:10','2019-03-26 03:16:10'),(160,'wp-edit','web','2019-03-26 03:16:10','2019-03-26 03:16:10'),(161,'wp-delete','web','2019-03-26 03:16:10','2019-03-26 03:16:10'),(162,'she-meetings-view','web','2019-03-26 03:16:10','2019-03-26 03:16:10'),(163,'she-meetings-add','web','2019-03-26 03:16:10','2019-03-26 03:16:10'),(164,'she-meetings-edit','web','2019-03-26 03:16:10','2019-03-26 03:16:10'),(165,'she-meetings-delete','web','2019-03-26 03:16:10','2019-03-26 03:16:10'),(166,'emergency-drill-view','web','2019-03-26 03:16:10','2019-03-26 03:16:10'),(167,'emergency-drill-add','web','2019-03-26 03:16:10','2019-03-26 03:16:10'),(168,'emergency-drill-edit','web','2019-03-26 03:16:10','2019-03-26 03:16:10'),(169,'emergency-drill-delete','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(170,'inspection-view','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(171,'inspection-add','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(172,'inspection-edit','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(173,'inspection-delete','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(174,'bbs-view','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(175,'bbs-add','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(176,'bbs-edit','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(177,'bbs-delete','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(178,'hazard-view','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(179,'hazard-add','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(180,'hazard-edit','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(181,'hazard-delete','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(182,'hazard-report-view','web','2019-03-26 03:16:11','2019-03-26 03:16:11'),(183,'hazard-report-add','web','2019-03-26 03:16:12','2019-03-26 03:16:12'),(184,'hazard-report-edit','web','2019-03-26 03:16:12','2019-03-26 03:16:12'),(185,'hazard-report-delete','web','2019-03-26 03:16:12','2019-03-26 03:16:12'),(186,'contractor-view','web','2019-03-26 03:16:12','2019-03-26 03:16:12'),(187,'contractor-add','web','2019-03-26 03:16:12','2019-03-26 03:16:12'),(188,'contractor-edit','web','2019-03-26 03:16:12','2019-03-26 03:16:12'),(189,'contractor-delete','web','2019-03-26 03:16:12','2019-03-26 03:16:12'),(190,'master-type-policy-view','web','2019-03-26 03:16:12','2019-03-26 03:16:12'),(191,'master-type-policy-add','web','2019-03-26 03:16:12','2019-03-26 03:16:12'),(192,'master-type-policy-edit','web','2019-03-26 03:16:12','2019-03-26 03:16:12'),(193,'master-type-policy-delete','web','2019-03-26 03:16:12','2019-03-26 03:16:12'),(194,'master-type-procedure-view','web','2019-03-26 03:16:12','2019-03-26 03:16:12'),(195,'master-type-procedure-add','web','2019-03-26 03:16:13','2019-03-26 03:16:13'),(196,'master-type-procedure-edit','web','2019-03-26 03:16:13','2019-03-26 03:16:13'),(197,'master-type-procedure-delete','web','2019-03-26 03:16:13','2019-03-26 03:16:13'),(198,'master-type-incident-view','web','2019-03-26 03:16:13','2019-03-26 03:16:13'),(199,'master-type-incident-add','web','2019-03-26 03:16:13','2019-03-26 03:16:13'),(200,'master-type-incident-edit','web','2019-03-26 03:16:13','2019-03-26 03:16:13'),(201,'master-type-incident-delete','web','2019-03-26 03:16:13','2019-03-26 03:16:13'),(202,'master-division-view','web','2019-03-26 03:16:13','2019-03-26 03:16:13'),(203,'master-division-add','web','2019-03-26 03:16:13','2019-03-26 03:16:13'),(204,'master-division-edit','web','2019-03-26 03:16:13','2019-03-26 03:16:13'),(205,'master-division-delete','web','2019-03-26 03:16:14','2019-03-26 03:16:14'),(206,'master-type-document-view','web','2019-03-26 03:16:14','2019-03-26 03:16:14'),(207,'master-type-document-add','web','2019-03-26 03:16:14','2019-03-26 03:16:14'),(208,'master-type-document-edit','web','2019-03-26 03:16:14','2019-03-26 03:16:14'),(209,'master-type-document-delete','web','2019-03-26 03:16:14','2019-03-26 03:16:14'),(210,'master-type-induction-view','web','2019-03-26 03:16:14','2019-03-26 03:16:14'),(211,'master-type-induction-add','web','2019-03-26 03:16:14','2019-03-26 03:16:14'),(212,'master-type-induction-edit','web','2019-03-26 03:16:14','2019-03-26 03:16:14'),(213,'master-type-induction-delete','web','2019-03-26 03:16:14','2019-03-26 03:16:14'),(214,'master-bulletin-view','web','2019-03-26 03:57:22','2019-03-26 03:57:22'),(215,'master-bulletin-add','web','2019-03-26 03:57:23','2019-03-26 03:57:23'),(216,'master-bulletin-edit','web','2019-03-26 03:57:23','2019-03-26 03:57:23'),(217,'master-bulletin-delete','web','2019-03-26 03:57:23','2019-03-26 03:57:23'),(218,'master-policy-view','web','2019-03-26 03:57:23','2019-03-26 03:57:23'),(219,'master-policy-add','web','2019-03-26 03:57:23','2019-03-26 03:57:23'),(220,'master-policy-edit','web','2019-03-26 03:57:23','2019-03-26 03:57:23'),(221,'master-policy-delete','web','2019-03-26 03:57:23','2019-03-26 03:57:23'),(222,'master-contractor-view','web','2019-04-08 06:33:15','2019-04-08 06:33:15'),(223,'master-contractor-add','web','2019-04-08 06:33:15','2019-04-08 06:33:15'),(224,'master-contractor-edit','web','2019-04-08 06:33:15','2019-04-08 06:33:15'),(225,'master-contractor-delete','web','2019-04-08 06:33:15','2019-04-08 06:33:15'),(226,'master-man-power-record-view','web','2019-04-08 07:41:09','2019-04-08 07:41:09'),(227,'master-man-power-record-add','web','2019-04-08 07:41:09','2019-04-08 07:41:09'),(228,'master-man-power-record-edit','web','2019-04-08 07:41:09','2019-04-08 07:41:09'),(229,'master-man-power-record-delete','web','2019-04-08 07:41:09','2019-04-08 07:41:09'),(230,'master-she-category-view','web','2019-04-15 05:48:21','2019-04-15 05:48:21'),(231,'master-she-category-add','web','2019-04-15 05:48:21','2019-04-15 05:48:21'),(232,'master-she-category-edit','web','2019-04-15 05:48:21','2019-04-15 05:48:21'),(233,'master-she-category-delete','web','2019-04-15 05:48:21','2019-04-15 05:48:21'),(234,'master-type-she-meeting-view','web','2019-04-15 05:48:22','2019-04-15 05:48:22'),(235,'master-type-she-meeting-add','web','2019-04-15 05:48:22','2019-04-15 05:48:22'),(236,'master-type-she-meeting-edit','web','2019-04-15 05:48:22','2019-04-15 05:48:22'),(237,'master-type-she-meeting-delete','web','2019-04-15 05:48:22','2019-04-15 05:48:22'),(238,'inspection-visit-view','web','2019-04-15 06:20:32','2019-04-15 06:20:32'),(239,'inspection-visit-add','web','2019-04-15 06:20:32','2019-04-15 06:20:32'),(240,'inspection-visit-edit','web','2019-04-15 06:20:32','2019-04-15 06:20:32'),(241,'inspection-visit-delete','web','2019-04-15 06:20:33','2019-04-15 06:20:33'),(242,'hira-analysis-view','web','2019-04-15 07:36:58','2019-04-15 07:36:58'),(243,'hira-analysis-add','web','2019-04-15 07:36:58','2019-04-15 07:36:58'),(244,'hira-analysis-edit','web','2019-04-15 07:36:58','2019-04-15 07:36:58'),(245,'hira-analysis-delete','web','2019-04-15 07:36:58','2019-04-15 07:36:58'),(246,'hira-review-view','web','2019-04-15 07:36:58','2019-04-15 07:36:58'),(247,'hira-review-add','web','2019-04-15 07:36:58','2019-04-15 07:36:58'),(248,'hira-review-edit','web','2019-04-15 07:36:58','2019-04-15 07:36:58'),(249,'hira-review-delete','web','2019-04-15 07:36:58','2019-04-15 07:36:58'),(250,'hira-review-approval','web','2019-04-15 07:36:59','2019-04-15 07:36:59'),(251,'hira-approval-view','web','2019-04-15 07:36:59','2019-04-15 07:36:59'),(252,'hira-approval-add','web','2019-04-15 07:36:59','2019-04-15 07:36:59'),(253,'hira-approval-edit','web','2019-04-15 07:36:59','2019-04-15 07:36:59'),(254,'hira-approval-delete','web','2019-04-15 07:36:59','2019-04-15 07:36:59'),(255,'hira-approval-approval','web','2019-04-15 07:36:59','2019-04-15 07:36:59'),(256,'hira-approval-review','web','2019-04-15 07:36:59','2019-04-15 07:36:59'),(257,'hnmr-reporting-view','web','2019-04-16 03:27:37','2019-04-16 03:27:37'),(258,'hnmr-reporting-add','web','2019-04-16 03:27:37','2019-04-16 03:27:37'),(259,'hnmr-reporting-edit','web','2019-04-16 03:27:38','2019-04-16 03:27:38'),(260,'hnmr-reporting-delete','web','2019-04-16 03:27:38','2019-04-16 03:27:38'),(261,'hnmr-monitoring-view','web','2019-04-16 03:27:38','2019-04-16 03:27:38'),(262,'hnmr-monitoring-add','web','2019-04-16 03:27:38','2019-04-16 03:27:38'),(263,'hnmr-monitoring-edit','web','2019-04-16 03:27:38','2019-04-16 03:27:38'),(264,'hnmr-monitoring-delete','web','2019-04-16 03:27:38','2019-04-16 03:27:38'),(265,'hnmr-action-view','web','2019-04-16 03:27:39','2019-04-16 03:27:39'),(266,'hnmr-action-add','web','2019-04-16 03:27:39','2019-04-16 03:27:39'),(267,'hnmr-action-edit','web','2019-04-16 03:27:39','2019-04-16 03:27:39'),(268,'hnmr-action-delete','web','2019-04-16 03:27:39','2019-04-16 03:27:39'),(269,'hse-plan-record-approval','web','2019-04-16 03:27:39','2019-04-16 03:27:39'),(270,'hse-plan-record-review','web','2019-04-16 03:27:39','2019-04-16 03:27:39'),(271,'target-view','web','2019-04-16 03:27:39','2019-04-16 03:27:39'),(272,'target-add','web','2019-04-16 03:27:40','2019-04-16 03:27:40'),(273,'target-edit','web','2019-04-16 03:27:40','2019-04-16 03:27:40'),(274,'target-delete','web','2019-04-16 03:27:40','2019-04-16 03:27:40'),(275,'inspection-visit-record-view','web','2019-04-16 04:24:22','2019-04-16 04:24:22'),(276,'inspection-visit-record-add','web','2019-04-16 04:24:22','2019-04-16 04:24:22'),(277,'inspection-visit-record-edit','web','2019-04-16 04:24:22','2019-04-16 04:24:22'),(278,'inspection-visit-record-delete','web','2019-04-16 04:24:22','2019-04-16 04:24:22'),(279,'inspection-visit-action-view','web','2019-04-18 06:50:20','2019-04-18 06:50:20'),(280,'inspection-visit-action-add','web','2019-04-18 06:50:21','2019-04-18 06:50:21'),(281,'inspection-visit-action-edit','web','2019-04-18 06:50:21','2019-04-18 06:50:21'),(282,'inspection-visit-action-delete','web','2019-04-18 06:50:21','2019-04-18 06:50:21'),(283,'inspection-visit-monitoring-view','web','2019-04-29 07:41:17','2019-04-29 07:41:17'),(284,'inspection-visit-monitoring-add','web','2019-04-29 07:41:17','2019-04-29 07:41:17'),(285,'inspection-visit-monitoring-edit','web','2019-04-29 07:41:17','2019-04-29 07:41:17'),(286,'inspection-visit-monitoring-delete','web','2019-04-29 07:41:17','2019-04-29 07:41:17'),(287,'accident-report-view','web','2019-04-29 09:14:39','2019-04-29 09:14:39'),(288,'accident-report-add','web','2019-04-29 09:14:39','2019-04-29 09:14:39'),(289,'accident-report-edit','web','2019-04-29 09:14:39','2019-04-29 09:14:39'),(290,'accident-report-delete','web','2019-04-29 09:14:39','2019-04-29 09:14:39'),(291,'accident-report-approval','web','2019-04-29 09:14:40','2019-04-29 09:14:40'),(292,'accident-report-review','web','2019-04-29 09:14:40','2019-04-29 09:14:40'),(293,'scaffold-permit-register-view','web','2019-05-02 03:22:17','2019-05-02 03:22:17'),(294,'scaffold-permit-register-add','web','2019-05-02 03:22:17','2019-05-02 03:22:17'),(295,'scaffold-permit-register-edit','web','2019-05-02 03:22:17','2019-05-02 03:22:17'),(296,'scaffold-permit-register-delete','web','2019-05-02 03:22:17','2019-05-02 03:22:17'),(297,'work-permit-scaffold-permit-register-view','web','2019-05-09 05:52:28','2019-05-09 05:52:28'),(298,'work-permit-scaffold-permit-register-add','web','2019-05-09 05:52:28','2019-05-09 05:52:28'),(299,'work-permit-scaffold-permit-register-edit','web','2019-05-09 05:52:28','2019-05-09 05:52:28'),(300,'work-permit-scaffold-permit-register-delete','web','2019-05-09 05:52:28','2019-05-09 05:52:28'),(301,'work-permit-wbso-view','web','2019-05-10 03:32:02','2019-05-10 03:32:02'),(302,'work-permit-wbso-add','web','2019-05-10 03:32:02','2019-05-10 03:32:02'),(303,'work-permit-wbso-edit','web','2019-05-10 03:32:02','2019-05-10 03:32:02'),(304,'work-permit-wbso-delete','web','2019-05-10 03:32:03','2019-05-10 03:32:03'),(305,'work-permit-jsa-view','web','2019-05-10 04:30:11','2019-05-10 04:30:11'),(306,'work-permit-jsa-add','web','2019-05-10 04:30:11','2019-05-10 04:30:11'),(307,'work-permit-jsa-edit','web','2019-05-10 04:30:11','2019-05-10 04:30:11'),(308,'work-permit-jsa-delete','web','2019-05-10 04:30:12','2019-05-10 04:30:12'),(309,'work-permit-request-view','web','2019-05-15 07:06:37','2019-05-15 07:06:37'),(310,'work-permit-request-add','web','2019-05-15 07:06:37','2019-05-15 07:06:37'),(311,'work-permit-request-edit','web','2019-05-15 07:06:37','2019-05-15 07:06:37'),(312,'work-permit-request-delete','web','2019-05-15 07:06:37','2019-05-15 07:06:37'),(313,'master-area-view','web','2019-05-22 08:38:53','2019-05-22 08:38:53'),(314,'master-area-add','web','2019-05-22 08:38:54','2019-05-22 08:38:54'),(315,'master-area-edit','web','2019-05-22 08:38:54','2019-05-22 08:38:54'),(316,'master-area-delete','web','2019-05-22 08:38:54','2019-05-22 08:38:54'),(317,'master-unit-view','web','2019-05-22 08:43:00','2019-05-22 08:43:00'),(318,'master-unit-add','web','2019-05-22 08:43:00','2019-05-22 08:43:00'),(319,'master-unit-edit','web','2019-05-22 08:43:00','2019-05-22 08:43:00'),(320,'master-unit-delete','web','2019-05-22 08:43:00','2019-05-22 08:43:00'),(321,'accident-review-view','web','2019-05-23 06:41:50','2019-05-23 06:41:50'),(322,'accident-review-add','web','2019-05-23 06:41:50','2019-05-23 06:41:50'),(323,'accident-review-edit','web','2019-05-23 06:41:50','2019-05-23 06:41:50'),(324,'accident-review-delete','web','2019-05-23 06:41:50','2019-05-23 06:41:50'),(325,'accident-review-review','web','2019-05-23 06:41:50','2019-05-23 06:41:50'),(326,'accident-approval-view','web','2019-05-23 06:41:51','2019-05-23 06:41:51'),(327,'accident-approval-add','web','2019-05-23 06:41:51','2019-05-23 06:41:51'),(328,'accident-approval-edit','web','2019-05-23 06:41:51','2019-05-23 06:41:51'),(329,'accident-approval-delete','web','2019-05-23 06:41:51','2019-05-23 06:41:51'),(330,'accident-approval-approval','web','2019-05-23 06:41:51','2019-05-23 06:41:51'),(331,'hira-review-review','web','2019-05-23 06:41:51','2019-05-23 06:41:51'),(332,'hnmr-monitoring-supervisor','web','2019-05-23 06:41:51','2019-05-23 06:41:51'),(333,'master-company-view','web','2019-05-23 06:41:51','2019-05-23 06:41:51'),(334,'master-company-add','web','2019-05-23 06:41:51','2019-05-23 06:41:51'),(335,'master-company-edit','web','2019-05-23 06:41:51','2019-05-23 06:41:51'),(336,'master-company-delete','web','2019-05-23 06:41:51','2019-05-23 06:41:51'),(337,'master-training-view','web','2019-05-23 06:41:52','2019-05-23 06:41:52'),(338,'master-training-add','web','2019-05-23 06:41:52','2019-05-23 06:41:52'),(339,'master-training-edit','web','2019-05-23 06:41:52','2019-05-23 06:41:52'),(340,'master-training-delete','web','2019-05-23 06:41:52','2019-05-23 06:41:52'),(341,'master-hazard-category-view','web','2019-05-23 06:41:52','2019-05-23 06:41:52'),(342,'master-hazard-category-add','web','2019-05-23 06:41:52','2019-05-23 06:41:52'),(343,'master-hazard-category-edit','web','2019-05-23 06:41:52','2019-05-23 06:41:52'),(344,'master-hazard-category-delete','web','2019-05-23 06:41:52','2019-05-23 06:41:52'),(345,'master-lagging-indicator-view','web','2019-05-23 06:41:52','2019-05-23 06:41:52'),(346,'master-lagging-indicator-add','web','2019-05-23 06:41:52','2019-05-23 06:41:52'),(347,'master-lagging-indicator-edit','web','2019-05-23 06:41:52','2019-05-23 06:41:52'),(348,'master-lagging-indicator-delete','web','2019-05-23 06:41:52','2019-05-23 06:41:52'),(349,'master-leading-indicator-view','web','2019-05-23 06:41:53','2019-05-23 06:41:53'),(350,'master-leading-indicator-add','web','2019-05-23 06:41:53','2019-05-23 06:41:53'),(351,'master-leading-indicator-edit','web','2019-05-23 06:41:53','2019-05-23 06:41:53'),(352,'master-leading-indicator-delete','web','2019-05-23 06:41:53','2019-05-23 06:41:53'),(353,'master-plan-view','web','2019-05-23 06:41:53','2019-05-23 06:41:53'),(354,'master-plan-add','web','2019-05-23 06:41:53','2019-05-23 06:41:53'),(355,'master-plan-edit','web','2019-05-23 06:41:53','2019-05-23 06:41:53'),(356,'master-plan-delete','web','2019-05-23 06:41:53','2019-05-23 06:41:53'),(357,'emergency-drill-approval','web','2019-05-23 07:09:57','2019-05-23 07:09:57'),(358,'emergency-drill-review','web','2019-05-23 07:09:57','2019-05-23 07:09:57'),(359,'industrial-hazardous-view','web','2019-06-11 03:12:46','2019-06-11 03:12:46'),(360,'industrial-hazardous-add','web','2019-06-11 03:12:46','2019-06-11 03:12:46'),(361,'industrial-hazardous-edit','web','2019-06-11 03:12:46','2019-06-11 03:12:46'),(362,'industrial-hazardous-delete','web','2019-06-11 03:12:47','2019-06-11 03:12:47'),(363,'industrial-hazardous-approval','web','2019-06-11 03:12:47','2019-06-11 03:12:47'),(364,'industrial-hazardous-review','web','2019-06-11 03:12:47','2019-06-11 03:12:47'),(365,'industrial-inspection-view','web','2019-06-11 03:12:47','2019-06-11 03:12:47'),(366,'industrial-inspection-add','web','2019-06-11 03:12:47','2019-06-11 03:12:47'),(367,'industrial-inspection-edit','web','2019-06-11 03:12:47','2019-06-11 03:12:47'),(368,'industrial-inspection-delete','web','2019-06-11 03:12:47','2019-06-11 03:12:47'),(369,'industrial-inspection-approval','web','2019-06-11 03:12:47','2019-06-11 03:12:47'),(370,'industrial-inspection-review','web','2019-06-11 03:12:47','2019-06-11 03:12:47'),(371,'master-audit-type-view','web','2019-07-12 03:04:11','2019-07-12 03:04:11'),(372,'master-audit-type-add','web','2019-07-12 03:04:11','2019-07-12 03:04:11'),(373,'master-audit-type-edit','web','2019-07-12 03:04:11','2019-07-12 03:04:11'),(374,'master-audit-type-delete','web','2019-07-12 03:04:11','2019-07-12 03:04:11'),(375,'master-observation-category-view','web','2019-07-12 03:04:12','2019-07-12 03:04:12'),(376,'master-observation-category-add','web','2019-07-12 03:04:12','2019-07-12 03:04:12'),(377,'master-observation-category-edit','web','2019-07-12 03:04:12','2019-07-12 03:04:12'),(378,'master-observation-category-delete','web','2019-07-12 03:04:12','2019-07-12 03:04:12'),(379,'offline-training-view','web','2019-07-19 06:36:09','2019-07-19 06:36:09'),(380,'offline-training-add','web','2019-07-19 06:36:09','2019-07-19 06:36:09'),(381,'offline-training-edit','web','2019-07-19 06:36:09','2019-07-19 06:36:09'),(382,'offline-training-delete','web','2019-07-19 06:36:09','2019-07-19 06:36:09'),(383,'kpi-reporting-view','web','2019-07-19 06:36:09','2019-07-19 06:36:09'),(384,'kpi-reporting-add','web','2019-07-19 06:36:09','2019-07-19 06:36:09'),(385,'kpi-reporting-edit','web','2019-07-19 06:36:10','2019-07-19 06:36:10'),(386,'kpi-reporting-delete','web','2019-07-19 06:36:10','2019-07-19 06:36:10'),(387,'kpi-reporting-approval','web','2019-07-19 06:36:10','2019-07-19 06:36:10'),(388,'kpi-reporting-review','web','2019-07-19 06:36:10','2019-07-19 06:36:10'),(389,'audit-record-view','web','2019-07-19 06:36:10','2019-07-19 06:36:10'),(390,'audit-record-add','web','2019-07-19 06:36:10','2019-07-19 06:36:10'),(391,'audit-record-edit','web','2019-07-19 06:36:10','2019-07-19 06:36:10'),(392,'audit-record-delete','web','2019-07-19 06:36:10','2019-07-19 06:36:10'),(393,'audit-monitoring-view','web','2019-07-19 06:36:10','2019-07-19 06:36:10'),(394,'permit-to-work-record-view','web','2019-07-24 04:44:09','2019-07-24 04:44:09'),(395,'permit-to-work-record-add','web','2019-07-24 04:44:09','2019-07-24 04:44:09'),(396,'permit-to-work-record-edit','web','2019-07-24 04:44:09','2019-07-24 04:44:09'),(397,'permit-to-work-record-delete','web','2019-07-24 04:44:09','2019-07-24 04:44:09'),(398,'accident-review-supervisor','web','2019-08-01 03:24:19','2019-08-01 03:24:19'),(399,'induction-material-view','web','2019-08-02 03:10:38','2019-08-02 03:10:38'),(400,'induction-material-add','web','2019-08-02 03:10:38','2019-08-02 03:10:38'),(401,'induction-material-edit','web','2019-08-02 03:10:38','2019-08-02 03:10:38'),(402,'induction-material-delete','web','2019-08-02 03:10:38','2019-08-02 03:10:38'),(403,'master-category-incident-view','web','2019-08-12 11:23:07','2019-08-12 11:23:07'),(404,'master-category-incident-add','web','2019-08-12 11:23:08','2019-08-12 11:23:08'),(405,'master-category-incident-edit','web','2019-08-12 11:23:08','2019-08-12 11:23:08'),(406,'master-category-incident-delete','web','2019-08-12 11:23:08','2019-08-12 11:23:08'),(407,'master-causes-incident-view','web','2019-08-12 11:23:08','2019-08-12 11:23:08'),(408,'master-causes-incident-add','web','2019-08-12 11:23:08','2019-08-12 11:23:08'),(409,'master-causes-incident-edit','web','2019-08-12 11:23:08','2019-08-12 11:23:08'),(410,'master-causes-incident-delete','web','2019-08-12 11:23:08','2019-08-12 11:23:08'),(411,'master-causes-detail-incident-view','web','2019-08-12 11:23:08','2019-08-12 11:23:08'),(412,'master-causes-detail-incident-add','web','2019-08-12 11:23:08','2019-08-12 11:23:08'),(413,'master-causes-detail-incident-edit','web','2019-08-12 11:23:08','2019-08-12 11:23:08'),(414,'master-causes-detail-incident-delete','web','2019-08-12 11:23:08','2019-08-12 11:23:08'),(415,'master-mechanism-incident-view','web','2019-08-12 11:23:09','2019-08-12 11:23:09'),(416,'master-mechanism-incident-add','web','2019-08-12 11:23:09','2019-08-12 11:23:09'),(417,'master-mechanism-incident-edit','web','2019-08-12 11:23:09','2019-08-12 11:23:09'),(418,'master-mechanism-incident-delete','web','2019-08-12 11:23:09','2019-08-12 11:23:09'),(419,'master-agent-of-incident-view','web','2019-08-12 11:23:09','2019-08-12 11:23:09'),(420,'master-agent-of-incident-add','web','2019-08-12 11:23:09','2019-08-12 11:23:09'),(421,'master-agent-of-incident-edit','web','2019-08-12 11:23:09','2019-08-12 11:23:09'),(422,'master-agent-of-incident-delete','web','2019-08-12 11:23:09','2019-08-12 11:23:09'),(423,'konfigurasi-dashboard-img-view','web','2019-08-12 11:23:09','2019-08-12 11:23:09'),(424,'konfigurasi-dashboard-img-add','web','2019-08-12 11:23:09','2019-08-12 11:23:09'),(425,'konfigurasi-dashboard-img-edit','web','2019-08-12 11:23:09','2019-08-12 11:23:09'),(426,'konfigurasi-dashboard-img-delete','web','2019-08-12 11:23:10','2019-08-12 11:23:10'),(427,'master-induction-view','web','2019-08-20 04:00:22','2019-08-20 04:00:22'),(428,'master-induction-add','web','2019-08-20 04:00:22','2019-08-20 04:00:22'),(429,'master-induction-edit','web','2019-08-20 04:00:22','2019-08-20 04:00:22'),(430,'master-induction-delete','web','2019-08-20 04:00:22','2019-08-20 04:00:22'),(431,'master-regulations-view','web','2019-08-30 03:40:41','2019-08-30 03:40:41'),(432,'master-regulations-add','web','2019-08-30 03:40:41','2019-08-30 03:40:41'),(433,'master-regulations-edit','web','2019-08-30 03:40:41','2019-08-30 03:40:41'),(434,'master-regulations-delete','web','2019-08-30 03:40:41','2019-08-30 03:40:41');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_agent_of_incident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_agent_of_incident` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_agent_of_incident` WRITE;
/*!40000 ALTER TABLE `ref_agent_of_incident` DISABLE KEYS */;
INSERT INTO `ref_agent_of_incident` VALUES (1,'HNM/SERD-1908009	HNM/SERD-1908009	HNM/SERD-1908009',1,NULL,'2019-08-21 03:07:36',NULL);
/*!40000 ALTER TABLE `ref_agent_of_incident` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_answer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `number` int(11) NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `true` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: not true answer; 1: true answer',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_answer_question_id_foreign` (`question_id`),
  CONSTRAINT `ref_answer_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `ref_question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_answer` WRITE;
/*!40000 ALTER TABLE `ref_answer` DISABLE KEYS */;
INSERT INTO `ref_answer` VALUES (33,11,1,'a',0,1,1,'2019-07-29 07:35:37','2019-07-29 07:42:28'),(34,11,2,'b',1,1,1,'2019-07-29 07:35:37','2019-07-29 07:42:28'),(35,11,3,'c',0,1,1,'2019-07-29 07:35:37','2019-07-29 07:42:28'),(36,11,4,'d',0,1,1,'2019-07-29 07:35:37','2019-07-29 07:42:28'),(37,12,1,'asd',1,1,1,'2019-07-29 08:01:05','2019-07-29 10:15:33'),(38,12,2,'asd',0,1,1,'2019-07-29 08:01:05','2019-07-29 10:15:33'),(39,12,3,'asd',0,1,1,'2019-07-29 08:01:05','2019-07-29 10:15:33'),(40,12,4,'asd',0,1,1,'2019-07-29 08:01:05','2019-07-29 10:15:33'),(41,13,1,'d',1,1,NULL,'2019-07-29 10:18:31',NULL),(42,13,2,'d',0,1,NULL,'2019-07-29 10:18:31',NULL),(43,13,3,'d',0,1,NULL,'2019-07-29 10:18:31',NULL),(44,13,4,'d',0,1,NULL,'2019-07-29 10:18:31',NULL),(45,14,1,'asd',1,1,1,'2019-07-30 05:09:29','2019-07-30 09:06:26'),(46,14,2,'sad',0,1,1,'2019-07-30 05:09:29','2019-07-30 09:06:26'),(47,14,3,'asd',0,1,1,'2019-07-30 05:09:29','2019-07-30 09:06:27'),(48,14,4,'asd',0,1,1,'2019-07-30 05:09:29','2019-07-30 09:06:27');
/*!40000 ALTER TABLE `ref_answer` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_area` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_area` WRITE;
/*!40000 ALTER TABLE `ref_area` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_area` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_audit_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_audit_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_audit_type` WRITE;
/*!40000 ALTER TABLE `ref_audit_type` DISABLE KEYS */;
INSERT INTO `ref_audit_type` VALUES (1,'A','A',1,NULL,'2019-07-19 06:42:10',NULL);
/*!40000 ALTER TABLE `ref_audit_type` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_bulletin_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_bulletin_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_bulletin_type` WRITE;
/*!40000 ALTER TABLE `ref_bulletin_type` DISABLE KEYS */;
INSERT INTO `ref_bulletin_type` VALUES (3,'Ampas Bulletin','-',1,NULL,'2019-03-26 04:04:07',NULL),(4,'Bulletin','-',1,NULL,'2019-03-26 04:04:16',NULL),(5,'Cek','Cek',1,NULL,'2019-06-26 03:25:32',NULL);
/*!40000 ALTER TABLE `ref_bulletin_type` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_category_incident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_category_incident` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_category_incident` WRITE;
/*!40000 ALTER TABLE `ref_category_incident` DISABLE KEYS */;
INSERT INTO `ref_category_incident` VALUES (1,'HNM/SERD-1908009',1,NULL,'2019-08-21 03:06:48',NULL);
/*!40000 ALTER TABLE `ref_category_incident` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_causes_incident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_causes_incident` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_causes_incident` WRITE;
/*!40000 ALTER TABLE `ref_causes_incident` DISABLE KEYS */;
INSERT INTO `ref_causes_incident` VALUES (1,'HNM/SERD-1908009',1,NULL,'2019-08-21 03:07:01',NULL);
/*!40000 ALTER TABLE `ref_causes_incident` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_causes_incident_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_causes_incident_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `causes_incident_id` int(10) unsigned NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_causes_incident_detail_causes_incident_id_foreign` (`causes_incident_id`),
  CONSTRAINT `ref_causes_incident_detail_causes_incident_id_foreign` FOREIGN KEY (`causes_incident_id`) REFERENCES `ref_causes_incident` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_causes_incident_detail` WRITE;
/*!40000 ALTER TABLE `ref_causes_incident_detail` DISABLE KEYS */;
INSERT INTO `ref_causes_incident_detail` VALUES (1,1,'HNM/SERD-1908009',1,NULL,'2019-08-21 03:07:13',NULL);
/*!40000 ALTER TABLE `ref_causes_incident_detail` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_component` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `component` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_component_type_id_foreign` (`type_id`),
  CONSTRAINT `ref_component_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `ref_type_equipment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_component` WRITE;
/*!40000 ALTER TABLE `ref_component` DISABLE KEYS */;
INSERT INTO `ref_component` VALUES (1,1,'Ampas',NULL,1,1,'2019-03-19 04:30:07','2019-03-19 07:28:10'),(2,1,'Component2',NULL,1,NULL,'2019-03-20 04:56:39',NULL),(3,1,'Component3',NULL,1,NULL,'2019-03-20 08:26:24',NULL),(4,1,'Component 4',NULL,1,NULL,'2019-03-20 08:26:35',NULL),(5,1,'Component 6',NULL,1,NULL,'2019-03-20 08:26:45',NULL),(6,1,'Component 5',NULL,1,NULL,'2019-03-20 08:26:55',NULL),(7,1,'Component7',NULL,1,NULL,'2019-03-20 08:27:07',NULL);
/*!40000 ALTER TABLE `ref_component` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_contractor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_contractor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_contractor` WRITE;
/*!40000 ALTER TABLE `ref_contractor` DISABLE KEYS */;
INSERT INTO `ref_contractor` VALUES (1,'s','sadasdas','October 11, 2019','asdasd','asdasd','sadasdas','asdasd','asdasd',NULL,4,'2019-07-19 12:09:53','2019-07-19 12:38:04',4),(2,'ss','sadasdas','October 11, 2019','asdasd','asdasd','sadasdas','asdasd','asdasd',NULL,4,'2019-07-19 12:44:22','2019-07-19 12:53:50',4),(3,'Legron','1','August 11, 2019','Legron','Test','Test','legron@gmail.com','892371',NULL,1,'2019-09-10 03:51:45','2019-09-10 07:53:12',1),(4,'Legrons','11','August 11, 2019','Legrons','Tests','Tests','legron@gmail.com','892371',NULL,1,'2019-09-10 07:45:53','2019-09-10 07:47:24',1);
/*!40000 ALTER TABLE `ref_contractor` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contents` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fileurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: unpublished; 1: published',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `site_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_course_site_id_foreign` (`site_id`),
  CONSTRAINT `ref_course_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_course` WRITE;
/*!40000 ALTER TABLE `ref_course` DISABLE KEYS */;
INSERT INTO `ref_course` VALUES (1,'OK','OK',NULL,NULL,0,1,NULL,'2019-05-23 07:15:25',NULL,NULL),(2,'OK2','ok2',NULL,NULL,0,1,NULL,'2019-05-23 07:56:30',NULL,NULL),(3,'BEDEBAH','BEDEBAH',NULL,NULL,0,1,NULL,'2019-06-27 05:37:51',NULL,NULL),(4,'BEDEBAHS','BEDEBAH',NULL,NULL,0,1,NULL,'2019-06-27 05:38:40',NULL,NULL),(5,'BEDEBAHSs','BEDEBAH',NULL,NULL,0,1,NULL,'2019-06-27 05:45:53',NULL,NULL),(6,'BEDEBAHSss','BEDEBAH',NULL,NULL,0,1,NULL,'2019-06-27 05:46:12',NULL,NULL),(7,'BEDEBAHSsssda','BEDEBAH',NULL,NULL,0,1,NULL,'2019-06-27 05:49:29',NULL,NULL),(8,'BEDEBAHSsssdaddd','BEDEBAH',NULL,NULL,0,1,NULL,'2019-06-27 05:49:43',NULL,NULL),(9,'BEDEBAHSsssdadddasd','BEDEBAH',NULL,NULL,0,1,NULL,'2019-06-27 05:51:22',NULL,NULL),(10,'BEDEH','BEDEBAH',NULL,NULL,0,1,NULL,'2019-06-27 05:53:29',NULL,NULL),(11,'asd','asd',NULL,NULL,0,1,NULL,'2019-08-01 04:17:40',NULL,1);
/*!40000 ALTER TABLE `ref_course` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_course_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_course_users` (
  `course_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`course_id`,`user_id`),
  KEY `ref_course_users_user_id_foreign` (`user_id`),
  CONSTRAINT `ref_course_users_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `ref_course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ref_course_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_course_users` WRITE;
/*!40000 ALTER TABLE `ref_course_users` DISABLE KEYS */;
INSERT INTO `ref_course_users` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2);
/*!40000 ALTER TABLE `ref_course_users` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_dashboard_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_dashboard_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `base_url` text COLLATE utf8mb4_unicode_ci,
  `type` text COLLATE utf8mb4_unicode_ci,
  `taken_at` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_dashboard_img` WRITE;
/*!40000 ALTER TABLE `ref_dashboard_img` DISABLE KEYS */;
INSERT INTO `ref_dashboard_img` VALUES (1,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','master/dashboard/232170be8bbd449303e1b2141d0a6f0f.jpg','master','dashboard',NULL,NULL,1,NULL,'2019-08-28 03:51:05',NULL);
/*!40000 ALTER TABLE `ref_dashboard_img` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_departement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_departement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pic` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_departement_pic_foreign` (`pic`),
  CONSTRAINT `ref_departement_pic_foreign` FOREIGN KEY (`pic`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_departement` WRITE;
/*!40000 ALTER TABLE `ref_departement` DISABLE KEYS */;
INSERT INTO `ref_departement` VALUES (1,'Ampas Departemen','Ampas Departemen',1,NULL,'2019-03-18 04:41:06',NULL,NULL),(2,'Om','Ampas',1,NULL,'2019-04-02 05:01:45',NULL,1);
/*!40000 ALTER TABLE `ref_departement` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_division`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_division` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_division` WRITE;
/*!40000 ALTER TABLE `ref_division` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_division` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_geothermal_incident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_geothermal_incident` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_geothermal_incident` WRITE;
/*!40000 ALTER TABLE `ref_geothermal_incident` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_geothermal_incident` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_hse_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_hse_plan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_hse_plan` WRITE;
/*!40000 ALTER TABLE `ref_hse_plan` DISABLE KEYS */;
INSERT INTO `ref_hse_plan` VALUES (1,'Hse Plan','Hse Plan',1,NULL,'2019-03-18 10:20:00',NULL);
/*!40000 ALTER TABLE `ref_hse_plan` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_induction_materi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_induction_materi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `type_materi` int(11) DEFAULT NULL,
  `fileurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_yt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_induction_materi_type_id_foreign` (`type_id`),
  CONSTRAINT `ref_induction_materi_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `ref_induction_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_induction_materi` WRITE;
/*!40000 ALTER TABLE `ref_induction_materi` DISABLE KEYS */;
INSERT INTO `ref_induction_materi` VALUES (1,1,'XADSW',0,0,NULL,NULL,NULL,'SADSAD','2019-09-09 08:27:28','2019-09-09 08:27:28');
/*!40000 ALTER TABLE `ref_induction_materi` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_induction_set_induction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_induction_set_induction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `materi_id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_induction_start` date DEFAULT NULL,
  `date_induction_end` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_induction_set_induction_materi_id_foreign` (`materi_id`),
  CONSTRAINT `ref_induction_set_induction_materi_id_foreign` FOREIGN KEY (`materi_id`) REFERENCES `ref_induction_materi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_induction_set_induction` WRITE;
/*!40000 ALTER TABLE `ref_induction_set_induction` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_induction_set_induction` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_induction_set_participant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_induction_set_participant` (
  `set_induction_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`set_induction_id`,`user_id`),
  KEY `ref_induction_set_participant_user_id_foreign` (`user_id`),
  CONSTRAINT `ref_induction_set_participant_set_induction_id_foreign` FOREIGN KEY (`set_induction_id`) REFERENCES `ref_induction_set_induction` (`id`),
  CONSTRAINT `ref_induction_set_participant_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_induction_set_participant` WRITE;
/*!40000 ALTER TABLE `ref_induction_set_participant` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_induction_set_participant` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_induction_set_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_induction_set_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `materi_id` int(10) unsigned NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_induction_set_question_materi_id_foreign` (`materi_id`),
  CONSTRAINT `ref_induction_set_question_materi_id_foreign` FOREIGN KEY (`materi_id`) REFERENCES `ref_induction_materi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_induction_set_question` WRITE;
/*!40000 ALTER TABLE `ref_induction_set_question` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_induction_set_question` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_induction_set_question_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_induction_set_question_answer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `answer_1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_3` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_4` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_induction_set_question_answer_question_id_foreign` (`question_id`),
  CONSTRAINT `ref_induction_set_question_answer_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `ref_induction_set_question` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_induction_set_question_answer` WRITE;
/*!40000 ALTER TABLE `ref_induction_set_question_answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_induction_set_question_answer` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_induction_set_question_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_induction_set_question_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `fileurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_induction_set_question_file_question_id_foreign` (`question_id`),
  CONSTRAINT `ref_induction_set_question_file_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `ref_induction_set_question` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_induction_set_question_file` WRITE;
/*!40000 ALTER TABLE `ref_induction_set_question_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_induction_set_question_file` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_induction_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_induction_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_induction_type` WRITE;
/*!40000 ALTER TABLE `ref_induction_type` DISABLE KEYS */;
INSERT INTO `ref_induction_type` VALUES (1,'asdsa','2019-09-09 08:25:14','2019-09-09 08:25:14');
/*!40000 ALTER TABLE `ref_induction_type` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_man_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_man_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_man_record` WRITE;
/*!40000 ALTER TABLE `ref_man_record` DISABLE KEYS */;
INSERT INTO `ref_man_record` VALUES (188,'Contractor Occupational Fatality',1,NULL,'2019-09-10 07:48:44','2019-09-10 07:53:13'),(189,'Contractors Occupational Lost Time Accident',1,NULL,'2019-09-10 07:48:44','2019-09-10 07:53:13'),(190,'Total Contractor Days Lost due to Worker Occupational Lost Time Accidents',1,NULL,'2019-09-10 07:48:44','2019-09-10 07:53:13'),(191,'Contractor Medically Treated Incident',1,NULL,'2019-09-10 07:48:45','2019-09-10 07:53:13'),(192,'Contractor First Aid Treatment',1,NULL,'2019-09-10 07:48:45','2019-09-10 07:53:13'),(193,'High Potential Serious Incidents or High Potential Near Misses/Near Hits',1,NULL,'2019-09-10 07:48:45','2019-09-10 07:53:13'),(194,'Near Misses/Near Hits',1,NULL,'2019-09-10 07:48:45','2019-09-10 07:53:13'),(195,'Unsafe Act or Unsafe Conditions Reported',1,NULL,'2019-09-10 07:48:45','2019-09-10 07:53:13'),(196,'Near Miss & Unsafe Acts / Conditions Closed',1,NULL,'2019-09-10 07:48:45','2019-09-10 07:53:13'),(197,'Number of Safety Walks / Visits Peformed',1,NULL,'2019-09-10 07:48:45','2019-09-10 07:53:13'),(198,'Number of Registered SHE Related Training Hours',1,NULL,'2019-09-10 07:48:45','2019-09-10 07:53:13'),(199,'Number of General SHE Weekly Talk',1,NULL,'2019-09-10 07:48:45','2019-09-10 07:53:14'),(200,'Number of Toolbox Talks Performed',1,NULL,'2019-09-10 07:48:45','2019-09-10 07:53:14'),(201,'Number of HSE Committee Meeting (P2K3)',1,NULL,'2019-09-10 07:48:45','2019-09-10 07:53:14'),(202,'Task Risk Assessments Provided & Accepted',1,NULL,'2019-09-10 07:48:45','2019-09-10 07:53:14'),(203,'Number of Work Risk Assessment performed',1,NULL,'2019-09-10 07:48:45','2019-09-10 07:53:14'),(204,'Number of Permits to Work Issued',1,NULL,'2019-09-10 07:48:46','2019-09-10 07:53:14'),(205,'Number of Emergency Drills Performed',1,NULL,'2019-09-10 07:48:46','2019-09-10 07:53:14'),(206,'Number of Health Monitoring or Surveillance Analysis Performed',1,NULL,'2019-09-10 07:48:46','2019-09-10 07:53:14'),(207,'Number of Fresh Eyes Observations (Behaviour Based Safety) Performed',1,NULL,'2019-09-10 07:48:46','2019-09-10 07:53:14'),(208,'Permits to Work Issued in Accordance with Task Risk Assessment Control Measures',1,NULL,'2019-09-10 07:48:46','2019-09-10 07:53:14'),(209,'Number of Call for Psychological Support (EAP)',1,NULL,'2019-09-10 07:48:46','2019-09-10 07:53:14'),(210,'Number of Safety Audits Performed',1,NULL,'2019-09-10 07:48:46','2019-09-10 07:53:14'),(211,'Number of Hours Driven (km)',1,NULL,'2019-09-10 07:48:46','2019-09-10 07:53:14'),(212,'Number of Cars',1,NULL,'2019-09-10 07:48:46','2019-09-10 07:53:15');
/*!40000 ALTER TABLE `ref_man_record` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_mechanism_incident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_mechanism_incident` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_mechanism_incident` WRITE;
/*!40000 ALTER TABLE `ref_mechanism_incident` DISABLE KEYS */;
INSERT INTO `ref_mechanism_incident` VALUES (1,'HNM/SERD-1908009',1,NULL,'2019-08-21 03:07:24',NULL);
/*!40000 ALTER TABLE `ref_mechanism_incident` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_observation_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_observation_card` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_observation_card` WRITE;
/*!40000 ALTER TABLE `ref_observation_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_observation_card` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_observation_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_observation_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `position` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_observation_category` WRITE;
/*!40000 ALTER TABLE `ref_observation_category` DISABLE KEYS */;
INSERT INTO `ref_observation_category` VALUES (1,'Ucing',1,NULL,'2019-07-12 04:04:39',NULL,2),(2,'sdfsdf',1,1,'2019-07-17 09:12:18','2019-07-22 04:01:57',55555);
/*!40000 ALTER TABLE `ref_observation_category` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_observation_category_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_observation_category_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `observation_category_id` int(10) unsigned DEFAULT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_observation_category_detail_observation_category_id_foreign` (`observation_category_id`),
  CONSTRAINT `ref_observation_category_detail_observation_category_id_foreign` FOREIGN KEY (`observation_category_id`) REFERENCES `ref_observation_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_observation_category_detail` WRITE;
/*!40000 ALTER TABLE `ref_observation_category_detail` DISABLE KEYS */;
INSERT INTO `ref_observation_category_detail` VALUES (1,1,'Bedebah',1,NULL,'2019-07-12 04:04:39',NULL),(2,1,NULL,1,NULL,'2019-07-12 04:04:39',NULL),(8,2,'sdsd',1,1,'2019-07-22 04:02:19','2019-07-22 09:03:22'),(9,2,'ssasaassa',1,1,'2019-07-22 09:02:24','2019-07-22 09:03:29');
/*!40000 ALTER TABLE `ref_observation_category_detail` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_policy_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_policy_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_policy_type` WRITE;
/*!40000 ALTER TABLE `ref_policy_type` DISABLE KEYS */;
INSERT INTO `ref_policy_type` VALUES (2,'Policy1','-',1,NULL,'2019-03-26 04:50:42',NULL),(3,'sda','j',1,NULL,'2019-06-26 03:30:36',NULL),(4,'asd','okmo',1,NULL,'2019-06-26 03:30:42',NULL);
/*!40000 ALTER TABLE `ref_policy_type` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_project` int(10) unsigned NOT NULL,
  `project` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_project_type_project_foreign` (`type_project`),
  CONSTRAINT `ref_project_type_project_foreign` FOREIGN KEY (`type_project`) REFERENCES `ref_type_project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_project` WRITE;
/*!40000 ALTER TABLE `ref_project` DISABLE KEYS */;
INSERT INTO `ref_project` VALUES (1,1,'PIC Bangunan',1,NULL,'2019-03-26 03:54:14',NULL,'123');
/*!40000 ALTER TABLE `ref_project` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` int(10) unsigned NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_question_quiz_id_foreign` (`quiz_id`),
  CONSTRAINT `ref_question_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `ref_quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_question` WRITE;
/*!40000 ALTER TABLE `ref_question` DISABLE KEYS */;
INSERT INTO `ref_question` VALUES (1,1,'Apakah AMpas itu Ampas?',1,NULL,'2019-05-23 07:19:50',NULL),(2,2,'APA ITU ?',1,NULL,'2019-05-23 08:12:58',NULL),(11,3,'a',1,1,'2019-07-29 07:35:37','2019-07-29 07:39:10'),(12,4,'sad',1,1,'2019-07-29 08:01:05','2019-07-29 10:12:19'),(13,4,'d',1,NULL,'2019-07-29 10:18:31',NULL),(14,5,'asd',1,1,'2019-07-30 05:09:29','2019-07-30 09:06:26');
/*!40000 ALTER TABLE `ref_question` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_question_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_question_image` (
  `question_id` int(10) unsigned NOT NULL,
  `filepath` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `ref_question_image_question_id_foreign` (`question_id`),
  CONSTRAINT `ref_question_image_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `ref_question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_question_image` WRITE;
/*!40000 ALTER TABLE `ref_question_image` DISABLE KEYS */;
INSERT INTO `ref_question_image` VALUES (1,'training/question/5b60afcd1f840f1fec713d26535e5edc.jpg'),(2,'training/question/8350855043aaf7d3331b6a4423250206.jpg'),(11,'training/question/917d824b7f759243f5a9350772b540a9.png'),(12,'training/question/a3befd7ece9412a0bc240dddaa2f75b4.jpg'),(12,'training/question/739158dd73a97e0e2f2d010d0aa64ffd.png'),(13,'training/question/c0697b760e22031f154556f4c9444a7f.jpg'),(13,'training/question/6fa64daff833416b22b20b839f3a44e3.jpg'),(14,'training/question/08b40042e3be6d3ddc9300168d603eca.png'),(14,'training/question/ee9bfe6ece0b45d6a27c7767231384f8.png');
/*!40000 ALTER TABLE `ref_question_image` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_quiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_quiz` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contents` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_limit` tinyint(4) NOT NULL DEFAULT '0',
  `time_limit_minutes` int(11) DEFAULT NULL,
  `min_score` tinyint(4) NOT NULL DEFAULT '0',
  `min_score_percentage` int(11) DEFAULT NULL,
  `retake` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: none; 1: immediately; 2: days;',
  `retake_days` int(11) DEFAULT NULL,
  `effective_date` date DEFAULT NULL,
  `expired` tinyint(4) NOT NULL DEFAULT '0',
  `expired_date` date DEFAULT NULL,
  `repeat` tinyint(4) NOT NULL DEFAULT '0',
  `repeat_months` int(11) DEFAULT NULL,
  `sent_email` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fileurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `typefile` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: file; 1: embed youtube; 2: website url',
  `youtube_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: unpublished, 1: published',
  `mandatory` int(11) DEFAULT '1' COMMENT '1:Mandatory, 2:Not Mandatory',
  PRIMARY KEY (`id`),
  KEY `ref_quiz_course_id_foreign` (`course_id`),
  CONSTRAINT `ref_quiz_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `ref_course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_quiz` WRITE;
/*!40000 ALTER TABLE `ref_quiz` DISABLE KEYS */;
INSERT INTO `ref_quiz` VALUES (1,1,'Ampasssss','Ampasssss',1,5,1,100,1,NULL,'2019-05-31',1,'2019-06-01',1,NULL,1,1,1,'2019-05-23 07:18:31','2019-05-23 07:20:11','training/materials/39131e9a598684a8d3f5be000369c683.jpg','99c91963-f90e-47dd-b696-46f63ecfd641.jpg',0,NULL,NULL,1,1),(2,2,'TITLE 2','TITLE 2',1,9,1,1,1,NULL,'2019-05-17',0,NULL,1,12,1,1,1,'2019-05-23 08:07:43','2019-05-23 08:13:17','training/materials/906f408e8556c0a2c868fdf38c7d2efe.jpg','99c91963-f90e-47dd-b696-46f63ecfd641.jpg',0,NULL,NULL,1,1),(3,10,'Title ONE','TITLE ONE',1,120,1,10,2,1,'2019-07-31',1,'2019-08-28',1,1,1,1,1,'2019-07-29 06:12:21','2019-07-29 10:22:15','training/materials/53a59559a5197268427855c4fdf23ba3.jpg','32-99c91963-f90e-47dd-b696-46f63ecfd641(1).jpg',0,NULL,NULL,1,1),(4,10,'asd','asd',0,NULL,0,NULL,0,NULL,NULL,0,NULL,0,NULL,NULL,1,1,'2019-07-29 07:51:52','2019-07-29 10:22:11','training/materials/33a255eceb67dd523a43cc34fd2798f2.jpg','32-99c91963-f90e-47dd-b696-46f63ecfd641(1)(1).jpg',0,NULL,NULL,1,1),(5,9,'QUIZE','QUIZE',1,10,0,NULL,0,NULL,NULL,0,NULL,0,NULL,NULL,1,NULL,'2019-07-30 05:06:59',NULL,'training/materials/c30bb663c9e2f83a4c0b3281c5e1098c.png','file.png',0,NULL,NULL,0,1),(6,11,'asdasdasdas','asdasd',0,NULL,0,NULL,0,NULL,NULL,0,NULL,0,NULL,NULL,1,NULL,'2019-08-13 05:45:05',NULL,'training/materials/7ded1be63ad39b31b15c33a76bf8c503.jpg','3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg',0,NULL,NULL,0,1);
/*!40000 ALTER TABLE `ref_quiz` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_quiz_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_quiz_users` (
  `quiz_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`quiz_id`,`user_id`),
  KEY `ref_quiz_users_user_id_foreign` (`user_id`),
  CONSTRAINT `ref_quiz_users_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `ref_quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ref_quiz_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_quiz_users` WRITE;
/*!40000 ALTER TABLE `ref_quiz_users` DISABLE KEYS */;
INSERT INTO `ref_quiz_users` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(1,2),(2,2),(3,2),(4,2),(5,2);
/*!40000 ALTER TABLE `ref_quiz_users` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_regulations_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_regulations_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0: Regulation, 1: Standard',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_regulations_type` WRITE;
/*!40000 ALTER TABLE `ref_regulations_type` DISABLE KEYS */;
INSERT INTO `ref_regulations_type` VALUES (1,'0','Ampas','Ampas',1,NULL,'2019-03-18 08:06:18',NULL),(2,'0','Name Of Regulations','-',1,NULL,'2019-03-26 07:00:16',NULL),(3,'1','Standard','AMpas',1,NULL,'2019-04-02 06:33:45',NULL);
/*!40000 ALTER TABLE `ref_regulations_type` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_she_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_she_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_she_category` WRITE;
/*!40000 ALTER TABLE `ref_she_category` DISABLE KEYS */;
INSERT INTO `ref_she_category` VALUES (1,'Asu',1,NULL,'2019-04-16 07:43:10',NULL);
/*!40000 ALTER TABLE `ref_she_category` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_site` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_site` WRITE;
/*!40000 ALTER TABLE `ref_site` DISABLE KEYS */;
INSERT INTO `ref_site` VALUES (1,'Supreme Energy Jakart (Head Office Shoulder Matematik)','Ampas',1,1,'2019-03-20 09:54:40','2019-08-06 10:20:45','AMPS'),(2,'Site12','-',1,1,'2019-03-26 05:05:06','2019-07-15 04:49:04','SERD');
/*!40000 ALTER TABLE `ref_site` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_sub_component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_sub_component` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `component_id` int(10) unsigned NOT NULL,
  `sub_component` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_sub_component_type_id_foreign` (`type_id`),
  KEY `ref_sub_component_component_id_foreign` (`component_id`),
  CONSTRAINT `ref_sub_component_component_id_foreign` FOREIGN KEY (`component_id`) REFERENCES `ref_component` (`id`),
  CONSTRAINT `ref_sub_component_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `ref_type_equipment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_sub_component` WRITE;
/*!40000 ALTER TABLE `ref_sub_component` DISABLE KEYS */;
INSERT INTO `ref_sub_component` VALUES (1,1,1,'OK',NULL,1,1,'2019-03-19 07:02:24','2019-03-19 07:22:43'),(2,1,1,'OK1',NULL,1,NULL,'2019-03-20 06:33:28',NULL),(3,1,2,'SubComponent1',NULL,1,NULL,'2019-03-20 06:34:21',NULL),(4,1,2,'b',NULL,1,NULL,'2019-03-20 09:22:53',NULL),(5,1,2,'C',NULL,1,NULL,'2019-03-20 09:23:04',NULL),(6,1,5,'A',NULL,1,NULL,'2019-03-20 09:23:24',NULL),(7,1,5,'B',NULL,1,NULL,'2019-03-20 09:23:32',NULL);
/*!40000 ALTER TABLE `ref_sub_component` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_title_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_title_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_title_data` WRITE;
/*!40000 ALTER TABLE `ref_title_data` DISABLE KEYS */;
INSERT INTO `ref_title_data` VALUES (1,'Title Data','Desc',1,NULL,'2019-03-18 05:06:34',NULL);
/*!40000 ALTER TABLE `ref_title_data` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_type_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_type_document` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_type_document` WRITE;
/*!40000 ALTER TABLE `ref_type_document` DISABLE KEYS */;
INSERT INTO `ref_type_document` VALUES (1,'Dcoument','-',1,NULL,'2019-03-26 05:16:54',NULL);
/*!40000 ALTER TABLE `ref_type_document` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_type_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_type_equipment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_equipment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_type_equipment` WRITE;
/*!40000 ALTER TABLE `ref_type_equipment` DISABLE KEYS */;
INSERT INTO `ref_type_equipment` VALUES (1,'AmpasComponent','Ampas',1,NULL,'2019-03-19 04:10:11',NULL,'Type Ampas Component'),(2,'NameEquipment','Ampas',1,NULL,'2019-03-20 03:58:25',NULL,'TypeEquipment'),(3,'NamaEquipment','s',1,NULL,'2019-03-20 04:00:48',NULL,'TypeEquipments');
/*!40000 ALTER TABLE `ref_type_equipment` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_type_incident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_type_incident` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_type_incident` WRITE;
/*!40000 ALTER TABLE `ref_type_incident` DISABLE KEYS */;
INSERT INTO `ref_type_incident` VALUES (1,'Name',1,NULL,'2019-03-26 05:15:51',NULL),(2,'Nam1',1,NULL,'2019-08-01 03:32:45',NULL),(3,'HNM/SERD-1908009',1,NULL,'2019-08-21 03:07:51',NULL);
/*!40000 ALTER TABLE `ref_type_incident` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_type_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_type_project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_type_project` WRITE;
/*!40000 ALTER TABLE `ref_type_project` DISABLE KEYS */;
INSERT INTO `ref_type_project` VALUES (1,'Project Bangunan','OK',1,NULL,'2019-03-18 04:59:09',NULL);
/*!40000 ALTER TABLE `ref_type_project` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_type_she_meeting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_type_she_meeting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_type_she_meeting` WRITE;
/*!40000 ALTER TABLE `ref_type_she_meeting` DISABLE KEYS */;
INSERT INTO `ref_type_she_meeting` VALUES (1,'A','as',1,NULL,'2019-06-21 06:51:06',NULL);
/*!40000 ALTER TABLE `ref_type_she_meeting` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ref_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_unit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ref_unit` WRITE;
/*!40000 ALTER TABLE `ref_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_unit` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(46,1),(47,1),(48,1),(49,1),(54,1),(55,1),(56,1),(57,1),(82,1),(83,1),(84,1),(85,1),(86,1),(87,1),(88,1),(89,1),(90,1),(91,1),(92,1),(93,1),(94,1),(95,1),(96,1),(97,1),(118,1),(119,1),(120,1),(121,1),(122,1),(123,1),(124,1),(125,1),(126,1),(127,1),(128,1),(129,1),(146,1),(147,1),(148,1),(149,1),(150,1),(151,1),(152,1),(153,1),(154,1),(155,1),(156,1),(157,1),(166,1),(167,1),(168,1),(169,1),(174,1),(175,1),(176,1),(177,1),(190,1),(191,1),(192,1),(193,1),(198,1),(199,1),(200,1),(201,1),(210,1),(211,1),(212,1),(213,1),(214,1),(215,1),(216,1),(217,1),(218,1),(219,1),(220,1),(221,1),(222,1),(223,1),(224,1),(225,1),(226,1),(227,1),(228,1),(229,1),(230,1),(231,1),(232,1),(233,1),(234,1),(235,1),(236,1),(237,1),(242,1),(243,1),(244,1),(245,1),(255,1),(257,1),(258,1),(259,1),(260,1),(265,1),(269,1),(270,1),(275,1),(276,1),(277,1),(278,1),(279,1),(280,1),(281,1),(282,1),(283,1),(284,1),(285,1),(286,1),(287,1),(288,1),(289,1),(290,1),(309,1),(310,1),(311,1),(312,1),(330,1),(331,1),(332,1),(333,1),(334,1),(335,1),(336,1),(337,1),(338,1),(339,1),(340,1),(357,1),(358,1),(359,1),(360,1),(361,1),(362,1),(363,1),(364,1),(365,1),(366,1),(367,1),(368,1),(369,1),(370,1),(371,1),(372,1),(373,1),(374,1),(375,1),(376,1),(377,1),(378,1),(379,1),(380,1),(381,1),(382,1),(383,1),(384,1),(385,1),(386,1),(387,1),(388,1),(389,1),(390,1),(391,1),(392,1),(393,1),(394,1),(395,1),(396,1),(397,1),(398,1),(399,1),(400,1),(401,1),(402,1),(403,1),(404,1),(405,1),(406,1),(407,1),(408,1),(409,1),(410,1),(411,1),(412,1),(413,1),(414,1),(415,1),(416,1),(417,1),(418,1),(419,1),(420,1),(421,1),(422,1),(423,1),(424,1),(425,1),(426,1),(427,1),(428,1),(429,1),(430,1),(431,1),(432,1),(433,1),(434,1),(1,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,2),(36,2),(37,2),(46,2),(47,2),(48,2),(49,2),(54,2),(55,2),(56,2),(57,2),(90,2),(91,2),(92,2),(93,2),(94,2),(95,2),(96,2),(97,2),(118,2),(119,2),(120,2),(121,2),(122,2),(123,2),(124,2),(125,2),(190,2),(191,2),(192,2),(193,2),(198,2),(199,2),(200,2),(201,2),(210,2),(211,2),(212,2),(213,2),(214,2),(215,2),(216,2),(217,2),(218,2),(219,2),(220,2),(221,2),(222,2),(223,2),(224,2),(225,2),(226,2),(227,2),(228,2),(229,2),(230,2),(231,2),(232,2),(233,2),(234,2),(235,2),(236,2),(237,2),(275,2),(276,2),(277,2),(278,2),(279,2),(280,2),(281,2),(282,2),(283,2),(284,2),(285,2),(286,2),(333,2),(334,2),(335,2),(336,2),(337,2),(338,2),(339,2),(340,2),(359,2),(360,2),(361,2),(362,2),(363,2),(364,2),(365,2),(366,2),(367,2),(368,2),(369,2),(370,2),(371,2),(372,2),(373,2),(374,2),(375,2),(376,2),(377,2),(378,2),(403,2),(404,2),(405,2),(406,2),(407,2),(408,2),(409,2),(410,2),(411,2),(412,2),(413,2),(414,2),(415,2),(416,2),(417,2),(418,2),(419,2),(420,2),(421,2),(422,2),(423,2),(424,2),(425,2),(426,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2019-03-14 09:58:06','2019-03-14 09:58:06'),(2,'GM','web','2019-08-12 11:21:57','2019-08-12 11:21:57');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sys_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sys_migrations` WRITE;
/*!40000 ALTER TABLE `sys_migrations` DISABLE KEYS */;
INSERT INTO `sys_migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_10_18_071644_entrust_setup_tables',1),(4,'2019_03_11_111728_create_permission_tables',1),(5,'2019_03_13_134609_delete_entrust_permissions',1),(6,'2019_03_14_134614_create_sys_file_and_documents',1),(10,'2019_03_15_095111_create_type_of_regulation_and_regulation',2),(11,'2019_03_18_104356_create_ref_equipment_type_data',2),(12,'2019_03_18_104724_create_table_type-policy',3),(14,'2019_03_18_150920_create_ref_observation_card',4),(15,'2019_03_19_103405_create_ref_component',5),(18,'2019_03_19_142745_create_master_site',6),(19,'2019_03_19_144605_create_trans_equipment',6),(20,'2019_03_20_110244_remove_type_bulletin_policy_duplicate',7),(21,'2019_03_20_110654_create_trans_tbm',7),(55,'2019_03_14_103056_create_ref_bulletin_type',8),(56,'2019_03_14_103157_create_ref_policy_type',8),(57,'2019_03_14_110310_create_trans_bulletin',8),(58,'2019_03_14_142235_create_trans_bulletin_reviews',8),(59,'2019_03_14_162725_create_trans_policy',8),(60,'2019_03_14_162827_create_trans_policy_reviews',8),(61,'2019_03_15_104642_create_trans_bulletin_lampiran',8),(62,'2019_03_15_104751_create_trans_policy_lampiran',8),(63,'2019_03_21_093556_create_trans_induction',8),(64,'2019_03_21_093609_create_trans_induction_attendance',8),(65,'2019_03_21_110637_trans_equipment_file',8),(66,'2019_03_28_102559_create_trans_man_power',9),(67,'2019_03_27_112304_alter_trans_induction_attendance',10),(68,'2019_03_28_105656_clearence',10),(69,'2019_03_29_130543_add_attribut_fileurl_on_documents_and_regulations',11),(74,'2019_03_25_163325_create_hse_plan_record_table_and_file',12),(75,'2019_03_29_131334_create_tbm_files_upload',12),(76,'2019_04_01_111238_create_trans_hnmr_reporting',12),(77,'2019_04_02_115248_add_pic_on_department',12),(78,'2019_04_02_140149_create_trans_hnmr_monitoring',13),(79,'2019_04_02_165843_create_trans_hnmr_action',13),(80,'2019_04_04_113328_create_trans_work_permit',13),(81,'2019_04_04_132442_create_trans_work_permit_attachment',13),(82,'2019_04_04_132851_create_trans_work_permit_attachment_hiradc',13),(83,'2019_04_04_133101_create_trans_work_permit_attachment_kkkl',13),(84,'2019_04_05_125101_create_add_no_dokumen_hse_plan',13),(85,'2019_04_08_105513_add_birthdate_to_user',13),(86,'2019_04_08_132117_change_ref_sub_contractor',13),(96,'2019_04_08_143306_ref_man_record',14),(97,'2019_04_08_144936_drop_trans_man_power',14),(98,'2019_04_08_105249_alter_table_tbm_to_she_meeting',15),(99,'2019_04_11_155803_create_new_man_power',15),(100,'2019_04_09_140218_create_trans_emergency_drill',16),(101,'2019_04_09_165639_create_hnmr_reporting_evidences',16),(102,'2019_04_10_095308_create_trans_hnmr_reporting_solvedpic',16),(103,'2019_04_11_142419_create_trans_hira',16),(104,'2019_04_12_150939_alter_table_hse_plan_change_site_id',16),(106,'2019_04_15_110858_create_trans_inspection_visit',17),(107,'2019_04_18_142113_edit_trans_attribut_inspection',18),(118,'2019_04_18_111634_create_trans_accident_incident',19),(119,'2019_04_18_114623_create_trans_accident_incident_type',19),(120,'2019_04_22_143259_create_ref_lagging_leading_indicator',19),(121,'2019_04_23_103151_create_ref_course',19),(122,'2019_04_23_141756_create_trans_kpi',19),(123,'2019_04_24_101312_alter_trans_induction_attendance_2',19),(124,'2019_04_24_135449_alter_table_emergency_drill_user_user',19),(125,'2019_04_25_114359_alter_table_trans_kpi',19),(126,'2019_04_26_132503_add_attribute_for_man_power',19),(128,'2019_04_26_113000_create_trans_accident_incident_approver',20),(129,'2019_04_30_112707_add_attribute_on_ref_project',21),(130,'2019_04_30_114459_create_trans_work_permit',22),(131,'2019_05_02_103753_add_attribute_trans_work_permit',22),(132,'2019_05_07_132025_add_trans_in_wp_permit',23),(133,'2019_05_09_102712_drop_unique_from_inspection_viisit',24),(134,'2019_04_30_111729_create_ref_quiz',25),(135,'2019_04_30_114459_create_trans_work_permit_2',26),(136,'2019_05_03_131622_create_ref_question_table',26),(137,'2019_05_03_143140_create_trans_accident_incident_type',26),(138,'2019_05_07_103337_alter_ref_quiz',26),(139,'2019_05_08_103209_alter_nullable_ref_quiz',27),(140,'2019_05_08_111034_add_typefile_to_ref_quiz',27),(141,'2019_05_08_124759_add_published_ref_quiz',27),(142,'2019_05_09_180749_add_and_drop_trans_inspection_detail',27),(144,'2019_05_10_103353_create_trans_wp_wbso',28),(180,'2019_05_13_153015_create_trans_attendece_jsa',29),(181,'2019_05_14_102504_alter_trans_hnmr_reporting_add_number',29),(182,'2019_05_14_140249_create_trans_permit_request',29),(183,'2019_05_15_140827_alter_table_kpi_relasions',29),(184,'2019_05_15_154603_create_trans_quiz_answer_user',29),(185,'2019_05_17_102629_drop_type_induction_in_trans_induction',29),(204,'2019_05_20_101515_alter_trans_induction',30),(205,'2019_05_20_110842_alter_accident_table',30),(206,'2019_05_22_150814_edit_ref_site_to_company',30),(207,'2019_05_22_200949_add_and_edit_trans_man_power',30),(208,'2019_05_23_103821_add_attribut_in_trans_equipment_and_inspection',30),(209,'2019_05_23_125523_add_attribute_in_trans_equipment',30),(212,'2019_05_23_150401_add_attributes_trans_training',31),(213,'2019_06_07_051312_create_trans_wp_request_excavation',31),(214,'2019_06_08_094055_add_trans_wp_request_hazard_attribute',32),(215,'2019_06_11_093507_create_trans_industrial_hygien',33),(216,'2019_06_11_103056_add_site_id_trans_induction_attendance',34),(217,'2019_06_12_140404_create_jobs_table',34),(218,'2019_05_20_145535_create_master_ref_observation_category',35),(219,'2019_05_23_135554_add_site_id_on_trans_emergency_drill',35),(220,'2019_06_11_105127_alter_table_ref_observation_category',35),(221,'2019_06_12_100613_create_tbl_trans_bbs',35),(222,'2019_06_13_142928_create_ref_audit_type',35),(223,'2019_06_13_161816_create_trans_audit',35),(224,'2019_06_18_125654_create_jobs_notification',35),(225,'2019_06_19_101403_alter_table_trans_audit_file_and_evidence',36),(226,'2019_06_19_111356_add_no_report_trans_hnmr_reporting',36),(227,'2019_06_19_143442_edit_trans_jobs_email',37),(228,'2019_06_19_142055_add_no_report_trans_inspection_visit',38),(229,'2019_06_21_102659_custom_kpi_structure_table',38),(230,'2019_06_25_114922_add_trans_electrical_work',38),(231,'2019_06_24_111408_add_no_report_trans_hira_table',39),(232,'2019_06_26_103403_add_site_id_to_ref_policy',39),(233,'2016_06_01_000001_create_oauth_auth_codes_table',40),(234,'2016_06_01_000002_create_oauth_access_tokens_table',40),(235,'2016_06_01_000003_create_oauth_refresh_tokens_table',40),(236,'2016_06_01_000004_create_oauth_clients_table',40),(237,'2016_06_01_000005_create_oauth_personal_access_clients_table',40),(238,'2019_07_10_105608_create_trans_offline_training',40),(239,'2019_07_12_113117_add_sys_users_site_table',40),(240,'2019_07_15_112458_add_date_trans_hiras',41),(241,'2019_07_15_112431_alter_trans_course_add_site_id',42),(242,'2019_07_16_103021_alter_table_trans_bbs_length_feedback',42),(243,'2019_07_16_145045_change_attribute_trans_wp',43),(244,'2019_07_16_170303_alter_table_trans_industrial_hazardous_add_contractor',44),(245,'2019_07_17_110049_update_trans_man_power_date',45),(246,'2019_07_19_191536_add_attrs_in_man_power',46),(247,'2019_07_23_121414_add_attribute_to__trans_industrial_hazards',47),(250,'2019_07_23_141846_add_multiple_site_bulleti_policy',48),(253,'2019_07_25_104100_edit_trans_scaffold_permit',49),(254,'2019_07_23_093415_alter_ref_type_incident',50),(255,'2019_07_23_093808_create_category_incident_table',50),(256,'2019_07_23_093828_create_causes_incident_table',50),(257,'2019_07_23_093837_create_causes_incident_detail_table',50),(258,'2019_07_23_093900_create_mechanism_incident_table',50),(259,'2019_07_23_094048_create_agent_of_incident_table',50),(260,'2019_07_23_104851_create_geothermal_incident_table',50),(261,'2019_07_24_104647_create_trans_reg_accident',50),(262,'2019_07_30_151607_custom_action_review_accident_update',51),(265,'2019_08_01_111342_add_reject_val_in_accident_action_approval',52),(266,'2019_08_02_104411_create_trans_induction_material',52),(267,'2019_08_02_114537_create_trans_audit_multiple_pic',53),(268,'2019_08_06_152624_create_trans_equipment_file',54),(269,'2019_08_06_104515_create_table_dashboard_img',55),(270,'2019_08_09_131220_reset_table_all_induction_master_and_trans',56),(271,'2019_08_09_133400_create_induction_v2_ref_and_trans',56),(272,'2019_08_13_110302_add_end_date_trans_offline_training',56),(273,'2019_08_14_144049_add_attr_to_jobs_notification',56),(274,'2019_08_15_123055_add_slug_trans_accident_incident_action_plan',57),(275,'2019_08_18_230659_create_has_induction_and_not_yet_induction',58),(276,'2019_08_20_120904_create_failed_user_induction_material',58),(279,'2019_08_22_112722_create_trans_induction_record_oflline',59),(280,'2019_08_30_095048_remake_trans_regulations',59);
/*!40000 ALTER TABLE `sys_migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sys_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `sys_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sys_password_resets` WRITE;
/*!40000 ALTER TABLE `sys_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_password_resets` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sys_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `last_login` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `gender` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: Female, 0: Male',
  `fotopath` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signaturepath` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sys_users_username_unique` (`username`),
  UNIQUE KEY `sys_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sys_users` WRITE;
/*!40000 ALTER TABLE `sys_users` DISABLE KEYS */;
INSERT INTO `sys_users` VALUES (1,'admin','adriyana.pragma@gmail.com','$2y$10$5m7Et75e/aZdEP3Iyzb19e/FPTV.OUxzvXUXS2ZYtcyDXleliBdsi','e75e1ab2-0436-41dd-957e-59fb526a2245','2019-07-22 10:18:44',1,'2019-03-14 09:58:07','2019-08-20 05:12:47','Bedebahs','Cek',0,'profile/a8897c7e0f9e9a4a4ac6caed8163598f.png','profile/a35b5c26b99f604898f5d5af78e7cde8.png','2019-08-16'),(2,'legron','legron123asdsadasd@gmail.com','$2y$10$5m7Et75e/aZdEP3Iyzb19e/FPTV.OUxzvXUXS2ZYtcyDXleliBdsi','','2019-06-19 15:51:42',1,'2019-04-30 08:27:46','2019-07-03 09:14:57',NULL,NULL,0,NULL,NULL,NULL),(4,'aa','aa@gmail.com','$2y$10$/r/G5.Lytt6pNqtzQQB2Be8jPRgw8eIzbo7bi013Q3nYcD61BY4E6','','2019-07-19 13:55:28',1,'2019-07-19 06:54:26','2019-07-19 06:55:28',NULL,NULL,0,NULL,NULL,NULL),(5,'cek','cek@gmail.com','$2y$10$uPvtpvM9NHeOX0QlP6oJ0O14vleJevjDY9EfPymEtDLdEHy0d39YW','','2019-08-13 10:36:47',1,'2019-08-13 03:36:47','2019-08-13 03:36:47',NULL,NULL,0,NULL,NULL,NULL),(6,'Ampas','Ampas@gmail.com','$2y$10$GnemzNi6JpFkWcJorUslZuiFFES5OOgO3beaj4Ez0HMPUGuX5Qjbm','','2019-09-03 11:10:57',1,'2019-09-03 04:10:57','2019-09-03 04:10:57',NULL,NULL,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `sys_users` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sys_users_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_users_site` (
  `user_id` int(10) unsigned NOT NULL,
  `site_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`site_id`),
  KEY `sys_users_site_site_id_foreign` (`site_id`),
  CONSTRAINT `sys_users_site_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sys_users_site_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sys_users_site` WRITE;
/*!40000 ALTER TABLE `sys_users_site` DISABLE KEYS */;
INSERT INTO `sys_users_site` VALUES (1,1),(2,1),(4,1),(5,1),(1,2),(2,2),(6,2);
/*!40000 ALTER TABLE `sys_users_site` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_accident_incident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_accident_incident` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(10) unsigned NOT NULL,
  `incident_location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Incident Location',
  `incident_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Incident Number',
  `type_of_incident` tinyint(4) NOT NULL COMMENT 'Type of Incident, 0: on the job, 1: off the job',
  `date_of_incident` datetime DEFAULT NULL COMMENT 'Datetime of Incident',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'title',
  `other_incident` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: not choosen, 1:choosen',
  `other_incident_type` text COLLATE utf8mb4_unicode_ci,
  `actual_loss` tinyint(4) NOT NULL COMMENT 'Actual Loss Severity, 0: major, 1: serious, 2:moderate, 3:minor',
  `potential_loss` tinyint(4) NOT NULL COMMENT 'Potential Loss Severity, 0: major, 1: serious, 2:moderate, 3:minor',
  `probability` tinyint(4) NOT NULL COMMENT 'Probability of reccurence, 0: frequent, 1: occasional, 2:seldom, 3:rare',
  `factual_information` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Factual Information',
  `cost_estimate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `immediate_actions` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Immediate Action',
  `incident_mechanism` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_investigations` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `root_cause` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prepared_by` int(10) unsigned NOT NULL COMMENT 'User ID',
  `preparedby_job_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervised_by` int(10) unsigned NOT NULL COMMENT 'User ID',
  `supervisedby_job_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervised_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Supervised status, 0: not acknowledged, 1: supervisor acknowledged',
  `investigation_request_by` int(10) unsigned NOT NULL,
  `feedback` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: no, 1:yes',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: On Analysis; 1: On Review; 2: On Approval; 3: On Investigation; 4: Closed',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_accident_incident_site_id_foreign` (`site_id`),
  KEY `trans_accident_incident_prepared_by_foreign` (`prepared_by`),
  KEY `trans_accident_incident_supervised_by_foreign` (`supervised_by`),
  KEY `trans_accident_incident_investigation_request_by_foreign` (`investigation_request_by`),
  CONSTRAINT `trans_accident_incident_investigation_request_by_foreign` FOREIGN KEY (`investigation_request_by`) REFERENCES `sys_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trans_accident_incident_prepared_by_foreign` FOREIGN KEY (`prepared_by`) REFERENCES `sys_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trans_accident_incident_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trans_accident_incident_supervised_by_foreign` FOREIGN KEY (`supervised_by`) REFERENCES `sys_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_accident_incident` WRITE;
/*!40000 ALTER TABLE `trans_accident_incident` DISABLE KEYS */;
INSERT INTO `trans_accident_incident` VALUES (1,1,'asdasd','HSE/AMPS-PSE/1908-001',0,'2019-08-26 10:00:00','asdasd',0,'sadsad',1,0,2,'sad','asd','sad','sad','asd','sadsa','asdasd',1,'sadasd',1,'sda',0,1,0,1,1,NULL,'2019-08-01 03:25:39',NULL),(2,1,'sasasaas','HSE/AMPS-PSE/1908-002',0,'2019-08-05 01:00:00','asas',0,NULL,2,2,2,'sa','sasa','assa','ass','sas','assa','as',2,'sasa',1,'asas',0,1,0,1,1,NULL,'2019-08-09 07:01:15',NULL),(3,1,'sasasaas','HSE/AMPS-PSE/1908-003',0,'2019-08-05 01:00:00','asas',0,NULL,2,2,2,'sa','sasa','assa','ass','sas','assa','as',2,'sasa',1,'asas',0,1,0,1,1,NULL,'2019-08-09 07:05:19',NULL),(4,2,'sasasaas','HSE/SERD-PSE/1908-001',0,'2019-08-05 01:00:00','asas',0,NULL,2,2,2,'sa','sasa','assa','ass','sas','assa','as',1,'sasa',1,'asas',0,1,0,1,1,1,'2019-08-09 07:07:33','2019-08-09 07:15:57'),(5,1,'thrh','HSE/AMPS-PSE/1908-004',0,'2019-08-23 10:25:00','rhtrh',0,NULL,0,0,0,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using','kasndkjas dkjasndkjas dkjasndkjas dkjasdnkjas dkajsdkas d','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',1,'thr',1,'htr',0,1,0,1,1,1,'2019-08-15 03:19:18','2019-08-16 03:07:49'),(6,2,'Acc','HSE/SERD-PSE/1908-002',0,'2019-08-28 06:40:00','v',0,NULL,1,1,2,'Acc','Acc','Acc','Acc','Acc','Acc','Acc',1,'Acc',1,'Acc',0,1,0,1,1,NULL,'2019-08-27 05:01:02',NULL),(7,2,'Acc','HSE/SERD-PSE/1908-003',0,'2019-08-28 06:40:00','v',0,NULL,1,1,2,'Acc','Acc','Acc','Acc','Acc','Acc','Acc',1,'Acc',1,'Acc',0,1,0,1,1,NULL,'2019-08-27 05:01:19',NULL);
/*!40000 ALTER TABLE `trans_accident_incident` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_accident_incident_action_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_accident_incident_action_plan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `accident_incident_id` int(10) unsigned NOT NULL,
  `recomendation` text COLLATE utf8mb4_unicode_ci,
  `pic_id` int(10) unsigned NOT NULL,
  `due_date` date DEFAULT NULL,
  `evidence` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rejected` text COLLATE utf8mb4_unicode_ci,
  `slug` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `trans_accident_incident_action_plan_accident_incident_id_foreign` (`accident_incident_id`),
  KEY `trans_accident_incident_action_plan_pic_id_foreign` (`pic_id`),
  CONSTRAINT `trans_accident_incident_action_plan_accident_incident_id_foreign` FOREIGN KEY (`accident_incident_id`) REFERENCES `trans_accident_incident` (`id`),
  CONSTRAINT `trans_accident_incident_action_plan_pic_id_foreign` FOREIGN KEY (`pic_id`) REFERENCES `sys_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_accident_incident_action_plan` WRITE;
/*!40000 ALTER TABLE `trans_accident_incident_action_plan` DISABLE KEYS */;
INSERT INTO `trans_accident_incident_action_plan` VALUES (1,2,'assa',1,'2019-08-19',NULL,0,1,NULL,'2019-08-09 07:01:15',NULL,NULL,0),(2,3,'assa',1,'2019-08-20',NULL,0,1,NULL,'2019-08-09 07:05:19',NULL,NULL,0),(4,4,'assa',1,'2019-08-20','sadasd',0,1,1,'2019-08-09 07:08:24','2019-08-09 07:26:22',NULL,0),(7,5,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',1,'2019-08-20',NULL,0,1,NULL,'2019-08-16 03:07:50',NULL,NULL,0),(8,6,'Acc',1,'2019-08-14',NULL,0,1,NULL,'2019-08-27 05:01:03',NULL,NULL,0),(9,7,'Acc',1,'2019-08-14',NULL,0,1,NULL,'2019-08-27 05:01:19',NULL,NULL,0);
/*!40000 ALTER TABLE `trans_accident_incident_action_plan` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_accident_incident_approver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_accident_incident_approver` (
  `accident_id` int(10) unsigned NOT NULL,
  `approver_id` int(10) unsigned NOT NULL,
  `approval` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: not approved yet, 1:approved, 2:not approved',
  `date_of_approval` date DEFAULT NULL COMMENT 'Date of Approval',
  KEY `trans_accident_incident_approver_accident_id_foreign` (`accident_id`),
  KEY `trans_accident_incident_approver_approver_id_foreign` (`approver_id`),
  CONSTRAINT `trans_accident_incident_approver_accident_id_foreign` FOREIGN KEY (`accident_id`) REFERENCES `trans_accident_incident` (`id`),
  CONSTRAINT `trans_accident_incident_approver_approver_id_foreign` FOREIGN KEY (`approver_id`) REFERENCES `sys_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_accident_incident_approver` WRITE;
/*!40000 ALTER TABLE `trans_accident_incident_approver` DISABLE KEYS */;
INSERT INTO `trans_accident_incident_approver` VALUES (1,1,0,NULL),(2,1,0,NULL),(3,1,0,NULL),(4,1,0,NULL),(5,1,0,NULL),(6,1,0,NULL),(7,1,0,NULL);
/*!40000 ALTER TABLE `trans_accident_incident_approver` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_accident_incident_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_accident_incident_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL,
  `filename` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `base_url` text COLLATE utf8mb4_unicode_ci,
  `type` text COLLATE utf8mb4_unicode_ci,
  `taken_at` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_accident_incident_file` WRITE;
/*!40000 ALTER TABLE `trans_accident_incident_file` DISABLE KEYS */;
INSERT INTO `trans_accident_incident_file` VALUES (1,2,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','accident/reporting/85359c41100b2db8182628c763118b93.jpg','incident','action-plan',NULL,NULL,1,NULL,'2019-08-09 07:01:15',NULL),(2,2,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','accident/reporting/c80268faadd6a487761dbca597d63580.jpg','investigation','action-plan',NULL,NULL,1,NULL,'2019-08-09 07:01:15',NULL),(3,3,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','accident/reporting/513a160e0f893d8764491de6304bf1e8.jpg','incident','action-plan',NULL,NULL,1,NULL,'2019-08-09 07:05:19',NULL),(4,3,'avatar04.png','accident/reporting/82b99b5169ae928bc2fa3790e951c211.png','investigation','action-plan',NULL,NULL,1,NULL,'2019-08-09 07:05:19',NULL),(5,4,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','accident/reporting/3ca5adcecffec13bfa857e8e3195729f.jpg','incident','action-plan',NULL,NULL,1,NULL,'2019-08-09 07:07:33',NULL),(6,4,'avatar04.png','accident/reporting/3ba039d8cdf836aec58d8c52e33da90e.png','investigation','action-plan',NULL,NULL,1,NULL,'2019-08-09 07:07:33',NULL),(7,4,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','accident/action/530c2dd82f12f3ce09581f2e42ee1d2f.jpg','evidence','action',NULL,NULL,1,NULL,'2019-08-09 07:15:57',NULL),(8,4,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','accident/action/530c2dd82f12f3ce09581f2e42ee1d2f.jpg','evidence','action',NULL,NULL,1,NULL,'2019-08-09 07:17:56',NULL),(9,4,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','accident/action/530c2dd82f12f3ce09581f2e42ee1d2f.jpg','evidence','action',NULL,NULL,1,NULL,'2019-08-09 07:18:21',NULL),(10,4,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','accident/action/530c2dd82f12f3ce09581f2e42ee1d2f.jpg','evidence','action',NULL,NULL,1,NULL,'2019-08-09 07:19:51',NULL),(11,4,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','accident/action/530c2dd82f12f3ce09581f2e42ee1d2f.jpg','evidence','action',NULL,NULL,1,NULL,'2019-08-09 07:20:26',NULL),(12,4,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','accident/action/530c2dd82f12f3ce09581f2e42ee1d2f.jpg','evidence','action',NULL,NULL,1,NULL,'2019-08-09 07:21:16',NULL),(13,4,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','accident/action/530c2dd82f12f3ce09581f2e42ee1d2f.jpg','evidence','action',NULL,NULL,1,NULL,'2019-08-09 07:22:26',NULL),(14,5,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','accident/reporting/b2bf8b56f1e785e27831b2768744f5f4.jpg','incident','action-plan',NULL,NULL,1,NULL,'2019-08-15 03:19:18',NULL),(15,5,'99c91963-f90e-47dd-b696-46f63ecfd641.jpg','accident/reporting/962bcfcd43acccae8e35edfaa042767f.jpg','investigation','action-plan',NULL,NULL,1,NULL,'2019-08-15 03:19:18',NULL),(16,6,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','accident/reporting/43e03ccc7e9556e504cdd7e1c174f571.jpg','incident','action-plan',NULL,NULL,1,NULL,'2019-08-27 05:01:02',NULL),(17,6,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','accident/reporting/9bef28c2923ee44c0a7aba96560f5ebc.jpg','investigation','action-plan',NULL,NULL,1,NULL,'2019-08-27 05:01:03',NULL),(18,7,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','accident/reporting/43e03ccc7e9556e504cdd7e1c174f571.jpg','incident','action-plan',NULL,NULL,1,NULL,'2019-08-27 05:01:19',NULL),(19,7,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','accident/reporting/9bef28c2923ee44c0a7aba96560f5ebc.jpg','investigation','action-plan',NULL,NULL,1,NULL,'2019-08-27 05:01:19',NULL);
/*!40000 ALTER TABLE `trans_accident_incident_file` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_accident_incident_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_accident_incident_type` (
  `accident_id` int(10) unsigned NOT NULL,
  `type_incident_id` int(10) unsigned NOT NULL,
  KEY `trans_accident_incident_type_accident_id_foreign` (`accident_id`),
  KEY `trans_accident_incident_type_type_incident_id_foreign` (`type_incident_id`),
  CONSTRAINT `trans_accident_incident_type_accident_id_foreign` FOREIGN KEY (`accident_id`) REFERENCES `trans_accident_incident` (`id`),
  CONSTRAINT `trans_accident_incident_type_type_incident_id_foreign` FOREIGN KEY (`type_incident_id`) REFERENCES `ref_type_incident` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_accident_incident_type` WRITE;
/*!40000 ALTER TABLE `trans_accident_incident_type` DISABLE KEYS */;
INSERT INTO `trans_accident_incident_type` VALUES (1,1),(2,2),(3,2),(4,2),(5,1),(6,2),(7,2);
/*!40000 ALTER TABLE `trans_accident_incident_type` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_audit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `audit_by` int(10) unsigned DEFAULT NULL,
  `site_id` int(10) unsigned DEFAULT NULL,
  `type_id` int(10) unsigned DEFAULT NULL,
  `pic_id` int(10) unsigned DEFAULT NULL,
  `personnel_id` int(10) unsigned DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finding` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_audit` date DEFAULT NULL,
  `action` text COLLATE utf8mb4_unicode_ci,
  `nature` text COLLATE utf8mb4_unicode_ci,
  `recommendation` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `evidence` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `trans_audit_site_id_foreign` (`site_id`),
  KEY `trans_audit_type_id_foreign` (`type_id`),
  KEY `trans_audit_audit_by_foreign` (`audit_by`),
  KEY `trans_audit_pic_id_foreign` (`pic_id`),
  KEY `trans_audit_personnel_id_foreign` (`personnel_id`),
  CONSTRAINT `trans_audit_audit_by_foreign` FOREIGN KEY (`audit_by`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_audit_personnel_id_foreign` FOREIGN KEY (`personnel_id`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_audit_pic_id_foreign` FOREIGN KEY (`pic_id`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_audit_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`),
  CONSTRAINT `trans_audit_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `ref_audit_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_audit` WRITE;
/*!40000 ALTER TABLE `trans_audit` DISABLE KEYS */;
INSERT INTO `trans_audit` VALUES (4,NULL,1,1,NULL,NULL,'2019','SE/MSHE/AUDIT-1908001','2019-08-22','1','asd','sda',1,1,1,'2019-08-02 05:53:58','2019-08-02 06:17:59','asdasd'),(5,NULL,2,1,NULL,NULL,'2019','SE/MSHE/AUDIT-1908002','2019-08-14','1','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',1,1,1,'2019-08-21 02:54:32','2019-08-21 02:56:19','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).'),(6,NULL,2,1,NULL,NULL,'2019','SE/MSHE/AUDIT-1908003','2019-08-08','2','Test','Test',0,1,NULL,'2019-08-22 03:16:47',NULL,NULL);
/*!40000 ALTER TABLE `trans_audit` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_audit_all_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_audit_all_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `audit_id` int(10) unsigned NOT NULL,
  `pic` int(10) unsigned NOT NULL,
  `flag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_audit_all_user_audit_id_foreign` (`audit_id`),
  CONSTRAINT `trans_audit_all_user_audit_id_foreign` FOREIGN KEY (`audit_id`) REFERENCES `trans_audit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_audit_all_user` WRITE;
/*!40000 ALTER TABLE `trans_audit_all_user` DISABLE KEYS */;
INSERT INTO `trans_audit_all_user` VALUES (11,4,1,'1',1,NULL,'2019-08-02 06:11:58',NULL),(12,4,2,'1',1,NULL,'2019-08-02 06:11:59',NULL),(13,4,1,'2',1,NULL,'2019-08-02 06:11:59',NULL),(14,4,2,'2',1,NULL,'2019-08-02 06:11:59',NULL),(15,4,1,'3',1,NULL,'2019-08-02 06:11:59',NULL),(16,4,2,'3',1,NULL,'2019-08-02 06:11:59',NULL),(22,5,1,'1',1,NULL,'2019-08-21 02:55:37',NULL),(23,5,2,'1',1,NULL,'2019-08-21 02:55:37',NULL),(24,5,1,'2',1,NULL,'2019-08-21 02:55:37',NULL),(25,5,2,'2',1,NULL,'2019-08-21 02:55:37',NULL),(26,5,1,'3',1,NULL,'2019-08-21 02:55:37',NULL),(27,6,2,'1',1,NULL,'2019-08-22 03:16:47',NULL),(28,6,2,'2',1,NULL,'2019-08-22 03:16:47',NULL),(29,6,2,'3',1,NULL,'2019-08-22 03:16:47',NULL);
/*!40000 ALTER TABLE `trans_audit_all_user` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_audit_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_audit_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fileurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_audit_file_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_audit_file_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_audit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_audit_file` WRITE;
/*!40000 ALTER TABLE `trans_audit_file` DISABLE KEYS */;
INSERT INTO `trans_audit_file` VALUES (1,5,NULL,'audit/record/99fdb90eccd9475ca6e6aa2f6fc2715e.png',0,1,NULL,'2019-08-21 02:54:32',NULL,'report'),(2,5,NULL,'audit/record/355fcfa3fbb7d60f9ac7a29466310def.png',0,1,NULL,'2019-08-21 02:54:32',NULL,'report'),(3,5,NULL,'audit/record/c9dc500abf9e1279c55df176231de2a9.png',0,1,NULL,'2019-08-21 02:54:32',NULL,'report'),(4,5,NULL,'audit/record/98b2e3f77d713611b6cdde2e83fa63db.jpg',0,1,NULL,'2019-08-21 02:54:32',NULL,'report'),(6,6,NULL,'audit/record/eef28c2f4ad8e163616f4c254c2b34f3.jpg',0,1,NULL,'2019-08-22 03:16:48',NULL,'report');
/*!40000 ALTER TABLE `trans_audit_file` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_bbs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_bbs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(10) unsigned DEFAULT NULL,
  `observer_id` int(10) unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_workers` bigint(20) DEFAULT NULL,
  `employee` bigint(20) DEFAULT NULL,
  `number_contractor` bigint(20) DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_safe` bigint(20) DEFAULT NULL,
  `total_risk` bigint(20) DEFAULT NULL,
  `feedback` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_bbs_site_id_foreign` (`site_id`),
  KEY `trans_bbs_observer_id_foreign` (`observer_id`),
  CONSTRAINT `trans_bbs_observer_id_foreign` FOREIGN KEY (`observer_id`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_bbs_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_bbs` WRITE;
/*!40000 ALTER TABLE `trans_bbs` DISABLE KEYS */;
INSERT INTO `trans_bbs` VALUES (1,1,4,'2019-07-01','7:00 PM',12,1,1,'sda',11,57,'asd',1,1,'2019-07-22 09:01:42','2019-07-22 09:03:02');
/*!40000 ALTER TABLE `trans_bbs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_bbs_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_bbs_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bbs_id` int(10) unsigned DEFAULT NULL,
  `observation_category_id` int(10) unsigned DEFAULT NULL,
  `observation_category_detail_id` int(10) unsigned DEFAULT NULL,
  `safe` bigint(20) DEFAULT NULL,
  `at_risk` bigint(20) DEFAULT NULL,
  `explanation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_bbs_detail_bbs_id_foreign` (`bbs_id`),
  KEY `trans_bbs_detail_observation_category_id_foreign` (`observation_category_id`),
  KEY `trans_bbs_detail_observation_category_detail_id_foreign` (`observation_category_detail_id`),
  CONSTRAINT `trans_bbs_detail_bbs_id_foreign` FOREIGN KEY (`bbs_id`) REFERENCES `trans_bbs` (`id`),
  CONSTRAINT `trans_bbs_detail_observation_category_detail_id_foreign` FOREIGN KEY (`observation_category_detail_id`) REFERENCES `ref_observation_category_detail` (`id`),
  CONSTRAINT `trans_bbs_detail_observation_category_id_foreign` FOREIGN KEY (`observation_category_id`) REFERENCES `ref_observation_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_bbs_detail` WRITE;
/*!40000 ALTER TABLE `trans_bbs_detail` DISABLE KEYS */;
INSERT INTO `trans_bbs_detail` VALUES (4,1,1,1,1,1,'2',1,NULL,'2019-07-22 09:03:03',NULL),(5,1,1,2,2,2,'2',1,NULL,'2019-07-22 09:03:03',NULL),(6,1,2,8,4,45,'4',1,NULL,'2019-07-22 09:03:03',NULL),(7,1,2,9,4,9,'2',1,NULL,'2019-07-22 09:03:03',NULL);
/*!40000 ALTER TABLE `trans_bbs_detail` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_bulletin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_bulletin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `print_page` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:all;1:3 page',
  `publish_date` date DEFAULT NULL,
  `publisher_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `site_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_bulletin_type_id_foreign` (`type_id`),
  CONSTRAINT `trans_bulletin_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `ref_bulletin_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_bulletin` WRITE;
/*!40000 ALTER TABLE `trans_bulletin` DISABLE KEYS */;
INSERT INTO `trans_bulletin` VALUES (1,3,'Title','Content',1,1,NULL,NULL,1,1,'2019-03-26 04:05:04','2019-07-19 04:14:15',NULL),(2,4,'Bulletin2','Content2',1,0,NULL,NULL,1,1,'2019-03-26 04:06:51','2019-03-26 04:46:59',NULL),(3,3,'sadmaskjdmaksdnj','aslkdnalskdn',1,0,NULL,NULL,1,NULL,'2019-05-23 06:39:08',NULL,NULL),(4,3,'Title Content v Content Content','Content',1,0,NULL,NULL,1,1,'2019-06-26 03:24:13','2019-08-12 07:48:12',1),(5,3,'Nama','lk',1,0,NULL,NULL,1,1,'2019-06-26 03:24:43','2019-08-06 03:02:53',1),(6,3,'Cek','k',1,0,NULL,NULL,1,1,'2019-06-26 03:26:53','2019-07-11 03:54:18',2),(7,3,'l','l',1,0,NULL,NULL,1,NULL,'2019-07-19 04:14:51',NULL,1),(8,3,'Legron','Content',1,0,NULL,NULL,1,1,'2019-08-13 03:33:53','2019-08-13 03:35:31',NULL),(9,4,'sassa','sasaas',1,0,NULL,NULL,1,NULL,'2019-08-15 02:53:09',NULL,NULL),(10,4,'sassa','sasaas',1,0,NULL,NULL,1,NULL,'2019-08-15 02:53:59',NULL,NULL),(11,4,'sassa','sasaas',1,0,NULL,NULL,1,NULL,'2019-08-15 02:54:10',NULL,NULL),(12,4,'sassa','sasaas',1,0,NULL,NULL,1,NULL,'2019-08-15 02:56:04',NULL,NULL),(13,4,'sassa','sasaas',1,0,NULL,NULL,1,NULL,'2019-08-15 02:58:19',NULL,NULL),(14,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 02:59:16',NULL,NULL),(15,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:04:50',NULL,NULL),(16,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:05:01',NULL,NULL),(17,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:05:28',NULL,NULL),(18,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:05:46',NULL,NULL),(19,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:06:04',NULL,NULL),(20,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:06:36',NULL,NULL),(21,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:07:27',NULL,NULL),(22,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:08:24',NULL,NULL),(23,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:09:06',NULL,NULL),(24,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:10:13',NULL,NULL),(25,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:11:23',NULL,NULL),(26,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:12:15',NULL,NULL),(27,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:14:17',NULL,NULL),(28,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:17:27',NULL,NULL),(29,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:20:41',NULL,NULL),(30,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:20:53',NULL,NULL),(31,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:21:36',NULL,NULL),(32,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:23:11',NULL,NULL),(33,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:23:36',NULL,NULL),(34,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:24:40',NULL,NULL),(35,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:25:22',NULL,NULL),(36,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:25:56',NULL,NULL),(37,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:26:35',NULL,NULL),(38,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:27:33',NULL,NULL),(39,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:28:58',NULL,NULL),(40,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:29:48',NULL,NULL),(41,4,'sdasd','asd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:31:22',NULL,NULL);
/*!40000 ALTER TABLE `trans_bulletin` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_bulletin_lampiran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_bulletin_lampiran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bulletin_id` int(10) unsigned NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_bulletin_lampiran_bulletin_id_foreign` (`bulletin_id`),
  CONSTRAINT `trans_bulletin_lampiran_bulletin_id_foreign` FOREIGN KEY (`bulletin_id`) REFERENCES `trans_bulletin` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_bulletin_lampiran` WRITE;
/*!40000 ALTER TABLE `trans_bulletin_lampiran` DISABLE KEYS */;
INSERT INTO `trans_bulletin_lampiran` VALUES (24,5,'logoFOOTERHOME.png','lampiran/logoFOOTERHOME.png',1,NULL,'2019-08-06 03:24:38',NULL),(25,5,'logo-man2.jpg','lampiran/logo-man2.jpg',1,NULL,'2019-08-06 03:24:38',NULL),(26,5,'kaliadem1IMG_6504.jpg','lampiran/kaliadem1IMG_6504.jpg',1,NULL,'2019-08-06 10:05:35',NULL),(27,5,'kaliadem5IMG_6528.jpg','lampiran/kaliadem5IMG_6528.jpg',1,NULL,'2019-08-06 10:05:35',NULL),(28,4,'AYOKULAKAN.jpg','lampiran/AYOKULAKAN.jpg',1,NULL,'2019-08-12 07:48:13',NULL),(29,8,'k3.jpg','lampiran/k3.jpg',1,NULL,'2019-08-13 03:33:54',NULL),(30,9,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','lampiran/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg',1,NULL,'2019-08-15 02:53:10',NULL),(31,10,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','lampiran/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg',1,NULL,'2019-08-15 02:53:59',NULL),(32,11,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','lampiran/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg',1,NULL,'2019-08-15 02:54:10',NULL),(33,12,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','lampiran/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg',1,NULL,'2019-08-15 02:56:04',NULL),(34,13,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','lampiran/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg',1,NULL,'2019-08-15 02:58:19',NULL),(35,14,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','lampiran/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg',1,NULL,'2019-08-15 02:59:16',NULL),(36,15,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:04:50',NULL),(37,16,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:05:01',NULL),(38,17,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:05:29',NULL),(39,18,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:05:46',NULL),(40,19,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:06:04',NULL),(41,20,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:06:36',NULL),(42,21,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:07:27',NULL),(43,22,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:08:24',NULL),(44,23,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:09:06',NULL),(45,24,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:10:13',NULL),(46,25,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:11:23',NULL),(47,26,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:12:15',NULL),(48,27,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:14:17',NULL),(49,28,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:17:27',NULL),(50,29,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:20:42',NULL),(51,30,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:20:53',NULL),(52,31,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:21:36',NULL),(53,32,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','lampiran/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg',1,NULL,'2019-08-15 03:23:11',NULL),(54,33,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','lampiran/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg',1,NULL,'2019-08-15 03:23:36',NULL),(55,34,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','lampiran/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg',1,NULL,'2019-08-15 03:24:40',NULL),(56,35,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','lampiran/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg',1,NULL,'2019-08-15 03:25:22',NULL),(57,36,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','lampiran/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg',1,NULL,'2019-08-15 03:25:57',NULL),(58,37,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:26:35',NULL),(59,38,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:27:33',NULL),(60,39,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:28:58',NULL),(61,40,'99c91963-f90e-47dd-b696-46f63ecfd641.jpg','lampiran/99c91963-f90e-47dd-b696-46f63ecfd641.jpg',1,NULL,'2019-08-15 03:29:48',NULL),(62,41,'99c91963-f90e-47dd-b696-46f63ecfd641.jpg','lampiran/99c91963-f90e-47dd-b696-46f63ecfd641.jpg',1,NULL,'2019-08-15 03:31:22',NULL);
/*!40000 ALTER TABLE `trans_bulletin_lampiran` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_bulletin_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_bulletin_reviews` (
  `bulletin_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`bulletin_id`,`user_id`),
  KEY `trans_bulletin_reviews_user_id_foreign` (`user_id`),
  CONSTRAINT `trans_bulletin_reviews_bulletin_id_foreign` FOREIGN KEY (`bulletin_id`) REFERENCES `trans_bulletin` (`id`),
  CONSTRAINT `trans_bulletin_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_bulletin_reviews` WRITE;
/*!40000 ALTER TABLE `trans_bulletin_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_bulletin_reviews` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_bulletin_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_bulletin_site` (
  `bulletin_id` int(10) unsigned NOT NULL,
  `site_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`bulletin_id`,`site_id`),
  KEY `trans_bulletin_site_site_id_foreign` (`site_id`),
  CONSTRAINT `trans_bulletin_site_bulletin_id_foreign` FOREIGN KEY (`bulletin_id`) REFERENCES `trans_bulletin` (`id`),
  CONSTRAINT `trans_bulletin_site_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_bulletin_site` WRITE;
/*!40000 ALTER TABLE `trans_bulletin_site` DISABLE KEYS */;
INSERT INTO `trans_bulletin_site` VALUES (4,1),(5,1),(8,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(4,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,2),(36,2),(37,2),(38,2),(39,2),(40,2),(41,2);
/*!40000 ALTER TABLE `trans_bulletin_site` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revision` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fileurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_documents_site_id_foreign` (`site_id`),
  CONSTRAINT `trans_documents_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_documents` WRITE;
/*!40000 ALTER TABLE `trans_documents` DISABLE KEYS */;
INSERT INTO `trans_documents` VALUES (81,NULL,'AAA',NULL,NULL,NULL,0,1,NULL,'2019-08-05 10:49:30',NULL,NULL,1),(83,NULL,'AA','A','avatars.png',NULL,0,1,1,'2019-08-05 10:50:12','2019-08-05 10:50:12','documents/avatars.png',1),(84,NULL,'OK','OK',NULL,NULL,0,1,NULL,'2019-08-05 10:51:24',NULL,NULL,1),(85,NULL,'BB','BB','asd.png',NULL,0,1,1,'2019-08-05 10:53:11','2019-08-05 10:53:11','documents/asd.png',1),(86,NULL,'AMPASSSs',NULL,NULL,NULL,0,1,1,'2019-08-05 10:58:46','2019-08-05 13:51:37',NULL,2),(87,NULL,'MAPS','MAP','9884464ea-e1554988741406.jpg',NULL,0,1,1,'2019-08-05 10:59:18','2019-08-05 10:59:18','documents/9884464ea-e1554988741406.jpg',2),(90,86,'AMPAS1',NULL,NULL,NULL,0,1,NULL,'2019-08-05 11:05:35','2019-08-05 13:51:37',NULL,2),(91,86,'AMPAS3',NULL,NULL,NULL,0,1,NULL,'2019-08-05 11:08:16','2019-08-05 13:51:37',NULL,2),(92,86,'AMPAS5','asd5',NULL,NULL,0,1,NULL,'2019-08-05 11:09:46','2019-08-05 13:51:37',NULL,2),(93,86,'AMPAS6',NULL,NULL,NULL,0,1,NULL,'2019-08-05 11:14:19','2019-08-05 13:51:37',NULL,2),(94,86,'AMPAS7',NULL,NULL,NULL,0,1,NULL,'2019-08-05 11:15:11','2019-08-05 13:51:37',NULL,2),(95,86,'AMPAS8',NULL,NULL,NULL,0,1,NULL,'2019-08-05 11:16:36','2019-08-05 13:51:37',NULL,2),(96,86,'AMPAS9',NULL,NULL,NULL,0,1,NULL,'2019-08-05 11:17:00','2019-08-05 13:51:37',NULL,2),(97,86,'AMPAS10',NULL,NULL,NULL,0,1,NULL,'2019-08-05 11:18:42','2019-08-05 13:51:37',NULL,2),(98,86,'AMPAS11',NULL,NULL,NULL,0,1,NULL,'2019-08-05 11:20:38','2019-08-05 13:51:37',NULL,2),(99,86,'AMPAS12',NULL,NULL,NULL,0,1,NULL,'2019-08-05 11:22:00','2019-08-05 13:51:37',NULL,2),(100,86,'AMPAS13',NULL,NULL,NULL,0,1,NULL,'2019-08-05 11:22:53','2019-08-05 13:51:37',NULL,2),(102,86,'AMPASFILE','a','avatar04.png',NULL,0,1,1,'2019-08-05 11:36:21','2019-08-05 13:52:12','documents/avatar04.png',2),(104,84,'OK1',NULL,NULL,NULL,0,1,NULL,'2019-08-05 11:39:11',NULL,NULL,1),(105,84,'OKK',NULL,NULL,NULL,0,1,NULL,'2019-08-05 11:39:32',NULL,NULL,1),(108,84,'OK2',NULL,NULL,NULL,0,1,NULL,'2019-08-05 12:18:08',NULL,NULL,1),(109,84,'OK3',NULL,NULL,NULL,0,1,NULL,'2019-08-05 12:19:33',NULL,NULL,1),(110,84,'OK4',NULL,NULL,NULL,0,1,NULL,'2019-08-05 12:28:41',NULL,NULL,1);
/*!40000 ALTER TABLE `trans_documents` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_emergency_drill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_emergency_drill` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `time_alarm` text COLLATE utf8mb4_unicode_ci,
  `time_drill` text COLLATE utf8mb4_unicode_ci,
  `time_evacuate` text COLLATE utf8mb4_unicode_ci,
  `type` text COLLATE utf8mb4_unicode_ci,
  `notification` text COLLATE utf8mb4_unicode_ci,
  `weather` text COLLATE utf8mb4_unicode_ci,
  `situation` text COLLATE utf8mb4_unicode_ci,
  `management_trained` text COLLATE utf8mb4_unicode_ci,
  `employees_trained` text COLLATE utf8mb4_unicode_ci,
  `incident_command` text COLLATE utf8mb4_unicode_ci,
  `extenuating` text COLLATE utf8mb4_unicode_ci,
  `explain_corrective` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_doc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` int(10) unsigned DEFAULT NULL,
  `desc_incident_command` int(10) unsigned DEFAULT NULL,
  `operations_chief` int(10) unsigned DEFAULT NULL,
  `site_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_emergency_drill_title_foreign` (`title`),
  KEY `trans_emergency_drill_desc_incident_command_foreign` (`desc_incident_command`),
  KEY `trans_emergency_drill_operations_chief_foreign` (`operations_chief`),
  KEY `trans_emergency_drill_site_id_foreign` (`site_id`),
  CONSTRAINT `trans_emergency_drill_desc_incident_command_foreign` FOREIGN KEY (`desc_incident_command`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_emergency_drill_operations_chief_foreign` FOREIGN KEY (`operations_chief`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_emergency_drill_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `trans_emergency_drill_title_foreign` FOREIGN KEY (`title`) REFERENCES `sys_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_emergency_drill` WRITE;
/*!40000 ALTER TABLE `trans_emergency_drill` DISABLE KEYS */;
INSERT INTO `trans_emergency_drill` VALUES (1,'2019-06-09','9:25 AM','4:00 AM','4:00 AM','Fire / Evacuation','Bell or Buzzer','Cloudy','Peak Business Hours','0','0','1','kj','jk','1',1,NULL,'2019-06-21 03:16:49',NULL,'1',1,1,1,1);
/*!40000 ALTER TABLE `trans_emergency_drill` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_emergency_drill_mitigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_emergency_drill_mitigation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emergency_drill_id` int(10) unsigned NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_emergency_drill_mitigation_emergency_drill_id_foreign` (`emergency_drill_id`),
  CONSTRAINT `trans_emergency_drill_mitigation_emergency_drill_id_foreign` FOREIGN KEY (`emergency_drill_id`) REFERENCES `trans_emergency_drill` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_emergency_drill_mitigation` WRITE;
/*!40000 ALTER TABLE `trans_emergency_drill_mitigation` DISABLE KEYS */;
INSERT INTO `trans_emergency_drill_mitigation` VALUES (1,1,'Additional staff training',1,NULL,'2019-06-21 03:16:50',NULL);
/*!40000 ALTER TABLE `trans_emergency_drill_mitigation` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_emergency_drill_participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_emergency_drill_participants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emergency_drill_id` int(10) unsigned NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_emergency_drill_participants_emergency_drill_id_foreign` (`emergency_drill_id`),
  CONSTRAINT `trans_emergency_drill_participants_emergency_drill_id_foreign` FOREIGN KEY (`emergency_drill_id`) REFERENCES `trans_emergency_drill` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_emergency_drill_participants` WRITE;
/*!40000 ALTER TABLE `trans_emergency_drill_participants` DISABLE KEYS */;
INSERT INTO `trans_emergency_drill_participants` VALUES (1,1,'SHE Personnel',1,NULL,'2019-06-21 03:16:49',NULL);
/*!40000 ALTER TABLE `trans_emergency_drill_participants` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_emergency_drill_problems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_emergency_drill_problems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emergency_drill_id` int(10) unsigned NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_emergency_drill_problems_emergency_drill_id_foreign` (`emergency_drill_id`),
  CONSTRAINT `trans_emergency_drill_problems_emergency_drill_id_foreign` FOREIGN KEY (`emergency_drill_id`) REFERENCES `trans_emergency_drill` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_emergency_drill_problems` WRITE;
/*!40000 ALTER TABLE `trans_emergency_drill_problems` DISABLE KEYS */;
INSERT INTO `trans_emergency_drill_problems` VALUES (1,1,'Windows left open',1,NULL,'2019-06-21 03:16:49',NULL);
/*!40000 ALTER TABLE `trans_emergency_drill_problems` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_equipment` (
  `register_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `site_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_sertifikat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merek` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_berakhir` date DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `filename` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fileurl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_equipment_site_id_foreign` (`site_id`),
  KEY `trans_equipment_type_id_foreign` (`type_id`),
  CONSTRAINT `trans_equipment_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`),
  CONSTRAINT `trans_equipment_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `ref_type_equipment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_equipment` WRITE;
/*!40000 ALTER TABLE `trans_equipment` DISABLE KEYS */;
INSERT INTO `trans_equipment` VALUES ('asd',17,1,1,'das','asd','sda','2019-08-15','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing LoremLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem',1,1,'2019-08-06 08:53:44','2019-08-06 10:16:27',NULL,NULL);
/*!40000 ALTER TABLE `trans_equipment` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_equipment_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_equipment_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_equipment_file_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_equipment_file_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_equipment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_equipment_file` WRITE;
/*!40000 ALTER TABLE `trans_equipment_file` DISABLE KEYS */;
INSERT INTO `trans_equipment_file` VALUES (7,17,'kaliadem1IMG_6504.jpg','equipment/kaliadem1IMG_6504.jpg',NULL,1,NULL,'2019-08-06 09:26:37',NULL),(8,17,'kaliadem5IMG_6528.jpg','equipment/kaliadem5IMG_6528.jpg',NULL,1,NULL,'2019-08-06 09:26:37',NULL),(9,17,'kaliademIMG_6488.jpg','equipment/kaliademIMG_6488.jpg',NULL,1,NULL,'2019-08-06 09:26:37',NULL),(10,17,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','equipment/kaliadem1IMG_6504.jpg',NULL,1,NULL,'2019-08-06 10:05:11',NULL);
/*!40000 ALTER TABLE `trans_equipment_file` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_hira`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_hira` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_report` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification_number` int(11) NOT NULL,
  `site_id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `analysis_by` int(10) unsigned DEFAULT NULL,
  `analysis_at` date DEFAULT NULL,
  `reviewed_by` int(10) unsigned DEFAULT NULL,
  `reviewed_at` date DEFAULT NULL,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `approved_at` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `position` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: On Analysis; 1: On Imitigation; 2: On Review; 3: On Approval; 4: Closed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_hira_site_id_foreign` (`site_id`),
  KEY `trans_hira_analysis_by_foreign` (`analysis_by`),
  KEY `trans_hira_reviewed_by_foreign` (`reviewed_by`),
  KEY `trans_hira_approved_by_foreign` (`approved_by`),
  CONSTRAINT `trans_hira_analysis_by_foreign` FOREIGN KEY (`analysis_by`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_hira_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_hira_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_hira_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_hira` WRITE;
/*!40000 ALTER TABLE `trans_hira` DISABLE KEYS */;
INSERT INTO `trans_hira` VALUES (1,NULL,1,1,'Tite',1,NULL,1,NULL,1,NULL,1,1,1,'2019-04-16 03:26:07','2019-04-16 03:26:34',NULL),(2,'AMPS/ED/EB-RA-1907001',1,1,'AMPS',1,NULL,1,NULL,1,NULL,1,1,4,'2019-07-15 04:52:36','2019-07-15 05:06:28','2019-07-30'),(3,'AMPS/ED/EB-RA-1907002',2,1,'kjnk',4,NULL,4,NULL,1,NULL,4,NULL,0,'2019-07-19 11:08:54',NULL,'2019-07-17'),(4,'AMPS/ED/EB-RA-1907003',3,1,'Til',1,NULL,1,NULL,1,NULL,1,1,4,'2019-07-23 03:15:13','2019-08-21 04:02:42','2019-07-16');
/*!40000 ALTER TABLE `trans_hira` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_hira_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_hira_steps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hira_id` int(10) unsigned NOT NULL,
  `process_step` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `potential_hazard` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `risk_level_consequence` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: Insignificant; 2: Minor; 3: Serious; 4: Major',
  `risk_level_likelihood` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: Exceptional; 2: Unusual; 3: Quite Possible; 4: Nearly Certain',
  `control_measures` text COLLATE utf8mb4_unicode_ci,
  `residual_risk_consequence` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: Insignificant; 2: Minor; 3: Serious; 4: Major',
  `residual_risk_likelihood` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: Exceptional; 2: Unusual; 3: Quite Possible; 4: Nearly Certain',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_hira_steps_hira_id_foreign` (`hira_id`),
  CONSTRAINT `trans_hira_steps_hira_id_foreign` FOREIGN KEY (`hira_id`) REFERENCES `trans_hira` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_hira_steps` WRITE;
/*!40000 ALTER TABLE `trans_hira_steps` DISABLE KEYS */;
INSERT INTO `trans_hira_steps` VALUES (1,1,'asjkn','jnkjnkjn',4,4,NULL,0,0,1,1,'2019-04-16 03:26:07','2019-04-16 03:26:34'),(2,2,'A','A',4,4,'L',4,4,1,1,'2019-07-15 04:52:36','2019-07-15 04:59:28'),(3,3,'kjnk','kj',4,4,NULL,0,0,4,NULL,'2019-07-19 11:08:54',NULL),(4,4,'asd','oijoasd',4,3,'What is Lorem Ipsum?\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',3,4,1,1,'2019-07-23 03:15:13','2019-08-21 03:31:27');
/*!40000 ALTER TABLE `trans_hira_steps` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_hnmr_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_hnmr_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `monitoring_id` int(10) unsigned NOT NULL,
  `action` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_hnmr_action_monitoring_id_foreign` (`monitoring_id`),
  CONSTRAINT `trans_hnmr_action_monitoring_id_foreign` FOREIGN KEY (`monitoring_id`) REFERENCES `trans_hnmr_monitoring` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_hnmr_action` WRITE;
/*!40000 ALTER TABLE `trans_hnmr_action` DISABLE KEYS */;
INSERT INTO `trans_hnmr_action` VALUES (1,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 09:54:09',NULL),(2,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 09:54:25',NULL),(3,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 09:54:43',NULL),(4,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:01:02',NULL),(5,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:02:40',NULL),(6,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:05:57',NULL),(7,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:06:11',NULL),(8,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:06:25',NULL),(9,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:08:16',NULL),(10,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:08:42',NULL),(11,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:11:12',NULL),(12,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:11:16',NULL),(13,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:11:31',NULL),(14,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:12:20',NULL),(15,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:12:43',NULL),(16,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:13:09',NULL),(17,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:14:30',NULL),(18,1,'fdffd','2019-07-30',1,NULL,'2019-07-30 10:14:38',NULL),(19,2,'HNM/SERD-1908009','2019-08-21',1,NULL,'2019-08-21 02:59:25',NULL),(20,2,'HNM/SERD-1908009','2019-08-21',1,NULL,'2019-08-21 02:59:58',NULL),(21,1,'fdffd','2019-07-30',1,NULL,'2019-08-21 03:02:49',NULL);
/*!40000 ALTER TABLE `trans_hnmr_action` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_hnmr_monitoring`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_hnmr_monitoring` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reporting_id` int(10) unsigned NOT NULL,
  `planning` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: minor, 1:moderate, 2:major',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_hnmr_monitoring_reporting_id_foreign` (`reporting_id`),
  CONSTRAINT `trans_hnmr_monitoring_reporting_id_foreign` FOREIGN KEY (`reporting_id`) REFERENCES `trans_hnmr_reporting` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_hnmr_monitoring` WRITE;
/*!40000 ALTER TABLE `trans_hnmr_monitoring` DISABLE KEYS */;
INSERT INTO `trans_hnmr_monitoring` VALUES (1,3,'sdas',1,1,NULL,'2019-07-30 09:28:12',NULL),(2,13,'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',1,1,NULL,'2019-08-21 02:58:22',NULL);
/*!40000 ALTER TABLE `trans_hnmr_monitoring` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_hnmr_reporting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_hnmr_reporting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_report` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reportby` int(10) unsigned NOT NULL,
  `supervisor` int(10) unsigned NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `report` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: draft, 1: publish',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `identification_number` int(11) NOT NULL DEFAULT '0',
  `site_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_hnmr_reporting_reportby_foreign` (`reportby`),
  KEY `trans_hnmr_reporting_supervisor_foreign` (`supervisor`),
  KEY `trans_hnmr_reporting_department_id_foreign` (`department_id`),
  KEY `trans_hnmr_reporting_site_id_foreign` (`site_id`),
  CONSTRAINT `trans_hnmr_reporting_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `ref_departement` (`id`),
  CONSTRAINT `trans_hnmr_reporting_reportby_foreign` FOREIGN KEY (`reportby`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_hnmr_reporting_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`),
  CONSTRAINT `trans_hnmr_reporting_supervisor_foreign` FOREIGN KEY (`supervisor`) REFERENCES `sys_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_hnmr_reporting` WRITE;
/*!40000 ALTER TABLE `trans_hnmr_reporting` DISABLE KEYS */;
INSERT INTO `trans_hnmr_reporting` VALUES (3,'HNM/AMPS-1907001',1,1,2,'2019-07-17','sd','asd',3,1,1,'2019-07-30 09:09:26','2019-08-21 03:02:49',1,1),(4,'HNM/AMPS-1908001',1,1,2,'2019-08-01','asd','sd',0,1,1,'2019-08-01 04:09:54','2019-08-01 04:10:11',1,1),(5,'HNM/SERD-1908001',1,1,2,'2019-08-06','asd','dsa',0,1,NULL,'2019-08-09 03:23:03',NULL,1,2),(6,'HNM/SERD-1908002',1,1,2,'2019-08-06','asd','dsa',0,1,1,'2019-08-09 03:24:41','2019-08-09 03:56:52',2,2),(7,'HNM/SERD-1908003',1,1,2,'2019-08-09','Report','Lokasi',1,1,NULL,'2019-08-09 06:27:20',NULL,3,2),(8,'HNM/SERD-1908004',1,1,2,'2019-08-09','Report','Lokasi',1,1,NULL,'2019-08-09 06:27:26',NULL,4,2),(9,'HNM/SERD-1908005',1,1,2,'2019-08-08','assas','as',0,1,NULL,'2019-08-09 06:29:29',NULL,5,2),(10,'HNM/SERD-1908006',1,1,2,'2019-08-08','assas','as',0,1,NULL,'2019-08-09 06:29:47',NULL,6,2),(11,'HNM/SERD-1908007',1,1,2,'2019-06-18','hazard','lokasi',1,1,NULL,'2019-08-09 06:30:15',NULL,7,2),(12,'HNM/SERD-1908008',1,1,2,'2019-04-30','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using','assasa',0,1,1,'2019-08-15 03:49:32','2019-08-21 02:57:45',8,2),(13,'HNM/SERD-1908009',1,1,2,'2019-04-23','asas','assasa',3,1,1,'2019-08-15 03:49:52','2019-08-21 02:59:59',9,2);
/*!40000 ALTER TABLE `trans_hnmr_reporting` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_hnmr_reporting_evidences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_hnmr_reporting_evidences` (
  `reporting_id` int(10) unsigned NOT NULL,
  `filepath` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `trans_hnmr_reporting_evidences_reporting_id_foreign` (`reporting_id`),
  CONSTRAINT `trans_hnmr_reporting_evidences_reporting_id_foreign` FOREIGN KEY (`reporting_id`) REFERENCES `trans_hnmr_reporting` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_hnmr_reporting_evidences` WRITE;
/*!40000 ALTER TABLE `trans_hnmr_reporting_evidences` DISABLE KEYS */;
INSERT INTO `trans_hnmr_reporting_evidences` VALUES (3,'hnmr/reporting/09e9767ceeb392e17161337d4cdd6ac5.png'),(4,'hnmr/reporting/37a98e472569f1ec48b6596947bad7d1.png'),(4,'hnmr/reporting/b4c014428c97a33337aa9f5f814722ac.png'),(5,'hnmr/reporting/071ca77db594cafa462fc03707a6b93f.jpg'),(7,'hnmr/reporting/f93e20738744e5d2d88c76cff9b0dd7f.png'),(8,'hnmr/reporting/f93e20738744e5d2d88c76cff9b0dd7f.png'),(6,'hnmr/reporting/071ca77db594cafa462fc03707a6b93f.jpg'),(11,'hnmr/reporting/54012b1943868ca4ea7e405d84df2786.png'),(13,'hnmr/reporting/db93ce0cc67ad403d0a359fbe169f3a9.jpg'),(12,'hnmr/reporting/3e31d9a76bf52673bd646ddf779f9d16.jpg');
/*!40000 ALTER TABLE `trans_hnmr_reporting_evidences` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_hnmr_reporting_solvedpic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_hnmr_reporting_solvedpic` (
  `reporting_id` int(10) unsigned NOT NULL,
  `filepath` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `trans_hnmr_reporting_solvedpic_reporting_id_foreign` (`reporting_id`),
  CONSTRAINT `trans_hnmr_reporting_solvedpic_reporting_id_foreign` FOREIGN KEY (`reporting_id`) REFERENCES `trans_hnmr_reporting` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_hnmr_reporting_solvedpic` WRITE;
/*!40000 ALTER TABLE `trans_hnmr_reporting_solvedpic` DISABLE KEYS */;
INSERT INTO `trans_hnmr_reporting_solvedpic` VALUES (13,'hnmr/action/d7b021c7389856c2068f8c0ca7553efc.jpg'),(3,'hnmr/action/c135d24e837b60d48c80474c3a409d3d.png');
/*!40000 ALTER TABLE `trans_hnmr_reporting_solvedpic` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_hse_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_hse_plan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `project_id` int(10) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `date_issued` date NOT NULL,
  `client` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `revision` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_doc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contractor_id` int(10) unsigned DEFAULT NULL,
  `site_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_hse_plan_project_id_foreign` (`project_id`),
  KEY `trans_hse_plan_contractor_id_foreign` (`contractor_id`),
  CONSTRAINT `trans_hse_plan_contractor_id_foreign` FOREIGN KEY (`contractor_id`) REFERENCES `ref_contractor` (`id`),
  CONSTRAINT `trans_hse_plan_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `ref_project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_hse_plan` WRITE;
/*!40000 ALTER TABLE `trans_hse_plan` DISABLE KEYS */;
INSERT INTO `trans_hse_plan` VALUES (1,NULL,1,'2019-05-18','2019-05-04','kjasdnkjasdnk','jsndkjasndkjasndk',1,1,1,NULL,'2019-05-23 06:58:16',NULL,'HSE-PSE/05/19/0001',6,NULL),(2,NULL,1,'2019-08-21','2019-08-21','Client Name','What is Lorem Ipsum?\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?',1,5,1,1,'2019-08-21 02:49:39','2019-08-21 02:52:07','Doc',1,2),(3,2,1,'2019-08-21','2019-08-21','Client Name','What is Lorem Ipsum?\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?',2,1,1,NULL,'2019-08-21 02:52:07',NULL,'Doc',1,2);
/*!40000 ALTER TABLE `trans_hse_plan` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_hse_plan_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_hse_plan_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hse_plan_id` int(10) unsigned DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taken_at` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_hse_plan_file_hse_plan_id_foreign` (`hse_plan_id`),
  CONSTRAINT `trans_hse_plan_file_hse_plan_id_foreign` FOREIGN KEY (`hse_plan_id`) REFERENCES `trans_hse_plan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_hse_plan_file` WRITE;
/*!40000 ALTER TABLE `trans_hse_plan_file` DISABLE KEYS */;
INSERT INTO `trans_hse_plan_file` VALUES (1,1,'99c91963-f90e-47dd-b696-46f63ecfd641.jpg','hse-plan/0b9553ed229db9a02c5a52515252cff4.jpg','-',NULL,NULL,NULL,1,NULL,'2019-05-23 06:58:16',NULL),(2,2,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','hse-plan/e36a2b54e5dd7d3e879c3dae93636a75.jpg','-',NULL,NULL,NULL,1,NULL,'2019-08-21 02:49:39',NULL),(3,2,'99c91963-f90e-47dd-b696-46f63ecfd641.jpg','hse-plan/bfc1919ee2565770508ee2b649125150.jpg','-',NULL,NULL,NULL,1,NULL,'2019-08-21 02:49:39',NULL),(4,3,'avatar04.png','hse-plan/25612139f3925ea7d03d0f1fb1bffcf5.png','-',NULL,NULL,NULL,1,NULL,'2019-08-21 02:52:07',NULL);
/*!40000 ALTER TABLE `trans_hse_plan_file` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_hse_plan_revision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_hse_plan_revision` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hse_plan_id` int(10) unsigned DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_hse_plan_revision_hse_plan_id_foreign` (`hse_plan_id`),
  CONSTRAINT `trans_hse_plan_revision_hse_plan_id_foreign` FOREIGN KEY (`hse_plan_id`) REFERENCES `trans_hse_plan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_hse_plan_revision` WRITE;
/*!40000 ALTER TABLE `trans_hse_plan_revision` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_hse_plan_revision` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_induction_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_induction_answer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `answer` int(11) DEFAULT NULL,
  `result` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_induction_answer_plan_id_foreign` (`plan_id`),
  KEY `trans_induction_answer_user_id_foreign` (`user_id`),
  KEY `trans_induction_answer_question_id_foreign` (`question_id`),
  CONSTRAINT `trans_induction_answer_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `ref_induction_set_induction` (`id`),
  CONSTRAINT `trans_induction_answer_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `ref_induction_set_question` (`id`),
  CONSTRAINT `trans_induction_answer_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_induction_answer` WRITE;
/*!40000 ALTER TABLE `trans_induction_answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_induction_answer` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_induction_failed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_induction_failed` (
  `plan_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`plan_id`,`user_id`),
  KEY `trans_induction_failed_user_id_foreign` (`user_id`),
  CONSTRAINT `trans_induction_failed_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `ref_induction_set_induction` (`id`),
  CONSTRAINT `trans_induction_failed_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_induction_failed` WRITE;
/*!40000 ALTER TABLE `trans_induction_failed` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_induction_failed` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_induction_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_induction_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(10) unsigned NOT NULL,
  `parent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fileurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_induction_files_record_id_foreign` (`record_id`),
  CONSTRAINT `trans_induction_files_record_id_foreign` FOREIGN KEY (`record_id`) REFERENCES `trans_induction_record` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_induction_files` WRITE;
/*!40000 ALTER TABLE `trans_induction_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_induction_files` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_induction_participant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_induction_participant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_induction_participant_record_id_foreign` (`record_id`),
  KEY `trans_induction_participant_user_id_foreign` (`user_id`),
  CONSTRAINT `trans_induction_participant_record_id_foreign` FOREIGN KEY (`record_id`) REFERENCES `trans_induction_record` (`id`),
  CONSTRAINT `trans_induction_participant_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_induction_participant` WRITE;
/*!40000 ALTER TABLE `trans_induction_participant` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_induction_participant` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_induction_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_induction_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_induction_record_site_id_foreign` (`site_id`),
  CONSTRAINT `trans_induction_record_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_induction_record` WRITE;
/*!40000 ALTER TABLE `trans_induction_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_induction_record` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_industrial_hazardous`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_industrial_hazardous` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contract_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `facility` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peer` longtext COLLATE utf8mb4_unicode_ci,
  `specific` longtext COLLATE utf8mb4_unicode_ci,
  `inventory` longtext COLLATE utf8mb4_unicode_ci,
  `storage` longtext COLLATE utf8mb4_unicode_ci,
  `rooms` longtext COLLATE utf8mb4_unicode_ci,
  `procces` longtext COLLATE utf8mb4_unicode_ci,
  `form` longtext COLLATE utf8mb4_unicode_ci,
  `concentration` longtext COLLATE utf8mb4_unicode_ci,
  `adquate` longtext COLLATE utf8mb4_unicode_ci,
  `procceses` longtext COLLATE utf8mb4_unicode_ci,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agents` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exposure` longtext COLLATE utf8mb4_unicode_ci,
  `potential` longtext COLLATE utf8mb4_unicode_ci,
  `sampling` longtext COLLATE utf8mb4_unicode_ci,
  `training` longtext COLLATE utf8mb4_unicode_ci,
  `routine` longtext COLLATE utf8mb4_unicode_ci,
  `enginner` longtext COLLATE utf8mb4_unicode_ci,
  `administrative` longtext COLLATE utf8mb4_unicode_ci,
  `personal` longtext COLLATE utf8mb4_unicode_ci,
  `other` longtext COLLATE utf8mb4_unicode_ci,
  `comments` longtext COLLATE utf8mb4_unicode_ci,
  `request` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `follow` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `follow_report` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `follow_letter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documents` longtext COLLATE utf8mb4_unicode_ci,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contractor_id` int(10) unsigned DEFAULT NULL,
  `contractor_other` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_industrial_hazardous_contractor_id_foreign` (`contractor_id`),
  CONSTRAINT `trans_industrial_hazardous_contractor_id_foreign` FOREIGN KEY (`contractor_id`) REFERENCES `ref_contractor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_industrial_hazardous` WRITE;
/*!40000 ALTER TABLE `trans_industrial_hazardous` DISABLE KEYS */;
INSERT INTO `trans_industrial_hazardous` VALUES (17,'Contractor#1907001',1,'sdkjn','nkj','n','2019-04-01','1','1','a','a','a','a','a','a','msdfm','mskl','dmfdskl','dklmsd','dij','kgndkjf','klmlkmlsd','dlkmfl','ldkfmgl','dflmgl','dfmfgmlkm','lksdmf','skdfmlksdm','klsm','sdflk','sdf','mslkdm','msdlkfm','msdlfm','dsmfl','dlfm',1,1,1,'2019-07-23 06:43:46','2019-07-23 07:43:15',NULL,'ds'),(18,'Contractor#1907002',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-07-23 06:44:00',NULL,NULL,'dsdsds'),(19,'Contractor#1907003',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-07-23 06:45:06',NULL,1,NULL),(20,'Contractor#1907004',1,'wewewwe','SDSADA','ASD','2019-04-01','1','1','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Bandung','Agent kemitraan','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A','A','A','A','A','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A',1,1,1,'2019-07-23 06:45:38','2019-08-12 00:10:46',2,NULL);
/*!40000 ALTER TABLE `trans_industrial_hazardous` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_industrial_inspection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_industrial_inspection` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_inspection` date DEFAULT NULL,
  `inspected_by` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '1:Request,2:Routine,3:Complaint',
  `operation` longtext COLLATE utf8mb4_unicode_ci,
  `material` longtext COLLATE utf8mb4_unicode_ci,
  `procedures` longtext COLLATE utf8mb4_unicode_ci,
  `employees` longtext COLLATE utf8mb4_unicode_ci,
  `monitoring` longtext COLLATE utf8mb4_unicode_ci,
  `remarks` longtext COLLATE utf8mb4_unicode_ci,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_industrial_inspection` WRITE;
/*!40000 ALTER TABLE `trans_industrial_inspection` DISABLE KEYS */;
INSERT INTO `trans_industrial_inspection` VALUES (1,'2019-06-05',1,1,'Location','Contractor#1906000','kjadsn','skjf','2','aks','nk','kj','jk','nj','k',1,1,1,'2019-06-11 05:38:39','2019-06-11 05:40:21'),(2,'2019-06-10',1,1,'Location','Contractor#1906001','Building','Area','1','sdas','asdasdads','A','D','F','G',1,1,NULL,'2019-06-21 08:29:31',NULL),(3,'2019-07-05',1,1,'Location','10','Building','Area','1','A','a','a','a','a','a',1,1,NULL,'2019-07-16 10:15:45',NULL),(4,'2019-07-21',1,1,'Location Bandung Jawa Barat','1','Gedung Serba Guna','Area Parkir','1','zLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-','zLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-','zLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-','zLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-','zLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-','zLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-',1,1,1,'2019-07-16 10:16:28','2019-08-19 03:03:47'),(5,'2019-08-20',1,1,'Location','1','asd','asd','2','asd','asd','asd','sad','asd','asd',1,1,NULL,'2019-08-20 03:48:13',NULL);
/*!40000 ALTER TABLE `trans_industrial_inspection` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_inspection_visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_inspection_visit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_report` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finding` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inspected_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_inspection` date DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hazard_category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contractor_id` int(10) unsigned NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `she_category_id` int(10) unsigned NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `site_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_inspection_visit_contractor_id_foreign` (`contractor_id`),
  KEY `trans_inspection_visit_department_id_foreign` (`department_id`),
  KEY `trans_inspection_visit_she_category_id_foreign` (`she_category_id`),
  KEY `trans_inspection_visit_site_id_foreign` (`site_id`),
  CONSTRAINT `trans_inspection_visit_contractor_id_foreign` FOREIGN KEY (`contractor_id`) REFERENCES `ref_contractor` (`id`),
  CONSTRAINT `trans_inspection_visit_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `ref_departement` (`id`),
  CONSTRAINT `trans_inspection_visit_she_category_id_foreign` FOREIGN KEY (`she_category_id`) REFERENCES `ref_she_category` (`id`),
  CONSTRAINT `trans_inspection_visit_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_inspection_visit` WRITE;
/*!40000 ALTER TABLE `trans_inspection_visit` DISABLE KEYS */;
INSERT INTO `trans_inspection_visit` VALUES (1,NULL,'1','1','2019-06-01','2019','Open','Location',6,1,1,3,1,1,'2019-06-19 09:59:33','2019-06-19 10:41:15',1),(2,NULL,'2','1','2019-06-01','2019','Open','Location',6,1,1,3,1,1,'2019-06-19 09:59:40','2019-06-19 10:28:14',1),(4,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','1','1','2019-07-10','2019','Open','loca',6,1,1,1,1,NULL,'2019-07-03 05:56:18',NULL,1),(5,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','2','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 06:18:50',NULL,1),(6,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','3','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 08:15:52',NULL,1),(7,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','4','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 08:59:35',NULL,1),(8,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','5','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 09:00:51',NULL,1),(9,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','6','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 09:01:22',NULL,1),(10,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','7','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 09:01:50',NULL,1),(11,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','8','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 09:02:29',NULL,1),(12,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','9','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 09:03:16',NULL,1),(13,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','10','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 09:03:20',NULL,1),(14,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','10','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 09:03:23',NULL,1),(15,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','10','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 09:04:03',NULL,1),(16,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','10','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 09:04:06',NULL,1),(17,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','10','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 09:04:08',NULL,1),(18,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','10','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 09:04:55',NULL,1),(19,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','10','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 09:06:14',NULL,1),(20,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','10','1','2019-07-01','2019','A','L',6,1,1,1,1,NULL,'2019-07-03 09:08:28',NULL,1),(21,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','1','1','2019-07-08','2019','A','l',1,1,1,1,1,NULL,'2019-07-03 09:12:05',NULL,2),(22,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','2','1','2019-07-08','2019','A','l',1,1,1,1,1,NULL,'2019-07-03 09:12:10',NULL,2),(23,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','3','1','2019-07-08','2019','A','l',1,1,1,1,1,NULL,'2019-07-03 09:14:22',NULL,2),(24,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','4','1','2019-07-08','2019','A','l',1,1,1,1,1,NULL,'2019-07-03 09:15:02',NULL,2),(25,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','5','1','2019-07-08','2019','A','l',1,1,1,1,1,NULL,'2019-07-03 09:15:55',NULL,2),(26,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','6','1','2019-07-08','2019','A','l',1,1,1,1,1,NULL,'2019-07-03 09:20:13',NULL,2),(27,'SE/MSHE/AMPS/INSP-FRM-1908001','1','1','2019-07-08','2019','A','l',1,1,1,1,1,1,'2019-07-03 09:20:45','2019-08-16 03:49:45',1),(28,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','8','1','2019-07-08','2019','A','l',1,1,1,2,1,1,'2019-07-03 09:21:16','2019-08-16 03:35:28',2),(29,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','9','1','2019-07-08','2019','A','l',1,1,1,2,1,1,'2019-07-03 09:22:36','2019-08-16 03:33:03',2),(30,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','10','1','2019-07-08','2019','A','l',1,1,1,3,1,1,'2019-07-03 09:36:49','2019-07-30 04:02:30',2),(31,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','10','1','2019-07-08','2019','A','l',1,1,1,2,1,1,'2019-07-03 09:38:47','2019-07-30 03:58:40',2),(32,'SE/MSHE/[Company Code Not Set]/INSP-FRM-1907001','10','1','2019-07-08','2019','A','l',1,1,1,3,1,1,'2019-07-03 09:40:50','2019-07-29 09:39:10',2),(33,'SE/MSHE/AMPS/INSP-FRM-1907010','10','1','2019-07-08','2019','A','l',1,1,1,2,1,1,'2019-07-03 09:41:21','2019-07-29 09:16:10',1),(34,'SE/MSHE/AMPS/INSP-FRM-1907010','10','1','2019-07-02','2019','A','AAA',1,1,1,3,1,1,'2019-07-30 05:32:10','2019-07-30 06:03:40',1);
/*!40000 ALTER TABLE `trans_inspection_visit` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_inspection_visit_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_inspection_visit_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `due_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nature` longtext COLLATE utf8mb4_unicode_ci,
  `recommendation` longtext COLLATE utf8mb4_unicode_ci,
  `actual` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `trans_inspection_visit_detail_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_inspection_visit_detail_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_inspection_visit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_inspection_visit_detail` WRITE;
/*!40000 ALTER TABLE `trans_inspection_visit_detail` DISABLE KEYS */;
INSERT INTO `trans_inspection_visit_detail` VALUES (1,1,'2019-06-01','Remark',2,1,1,'2019-06-19 09:59:33','2019-06-19 10:43:58','AA','AA','actual'),(2,2,'2019-06-19',NULL,2,1,NULL,'2019-06-19 09:59:40',NULL,'AA','AA',NULL),(4,4,'2019-07-10',NULL,1,1,NULL,'2019-07-03 05:56:18',NULL,'Nature','Nature',NULL),(5,5,'2019-07-01',NULL,1,1,NULL,'2019-07-03 06:18:50',NULL,'N','n',NULL),(6,6,'2019-07-01',NULL,1,1,NULL,'2019-07-03 08:15:52',NULL,'N','n',NULL),(7,7,'2019-07-01',NULL,1,1,NULL,'2019-07-03 08:59:35',NULL,'N','n',NULL),(8,8,'2019-07-01',NULL,1,1,NULL,'2019-07-03 09:00:51',NULL,'N','n',NULL),(9,9,'2019-07-01',NULL,1,1,NULL,'2019-07-03 09:01:22',NULL,'N','n',NULL),(10,10,'2019-07-01',NULL,1,1,NULL,'2019-07-03 09:01:50',NULL,'N','n',NULL),(11,11,'2019-07-01',NULL,1,1,NULL,'2019-07-03 09:02:29',NULL,'N','n',NULL),(12,12,'2019-07-01',NULL,1,1,NULL,'2019-07-03 09:03:16',NULL,'N','n',NULL),(13,13,'2019-07-01',NULL,1,1,NULL,'2019-07-03 09:03:20',NULL,'N','n',NULL),(14,14,'2019-07-01',NULL,1,1,NULL,'2019-07-03 09:03:23',NULL,'N','n',NULL),(15,15,'2019-07-01',NULL,1,1,NULL,'2019-07-03 09:04:03',NULL,'N','n',NULL),(16,16,'2019-07-01',NULL,1,1,NULL,'2019-07-03 09:04:06',NULL,'N','n',NULL),(17,17,'2019-07-01',NULL,1,1,NULL,'2019-07-03 09:04:08',NULL,'N','n',NULL),(18,18,'2019-07-01',NULL,1,1,NULL,'2019-07-03 09:04:55',NULL,'N','n',NULL),(19,19,'2019-07-01',NULL,1,1,NULL,'2019-07-03 09:06:15',NULL,'N','n',NULL),(20,20,'2019-07-01',NULL,1,1,NULL,'2019-07-03 09:08:28',NULL,'N','n',NULL),(21,21,'2019-07-17',NULL,1,1,NULL,'2019-07-03 09:12:05',NULL,'k','k',NULL),(22,22,'2019-07-17',NULL,1,1,NULL,'2019-07-03 09:12:10',NULL,'k','k',NULL),(23,23,'2019-07-17',NULL,1,1,NULL,'2019-07-03 09:14:22',NULL,'k','k',NULL),(24,24,'2019-07-17',NULL,1,1,NULL,'2019-07-03 09:15:02',NULL,'k','k',NULL),(25,25,'2019-07-17',NULL,1,1,NULL,'2019-07-03 09:15:55',NULL,'k','k',NULL),(26,26,'2019-07-17',NULL,1,1,NULL,'2019-07-03 09:20:13',NULL,'k','k',NULL),(27,27,'2019-07-17',NULL,1,1,1,'2019-07-03 09:20:45','2019-08-16 03:49:45','k','k',NULL),(28,28,'2019-07-17','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',2,1,1,'2019-07-03 09:21:16','2019-08-16 03:35:53','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to usingk','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using'),(29,29,'2019-07-17',NULL,2,1,1,'2019-07-03 09:22:36','2019-08-16 03:33:03','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using','kLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',NULL),(30,30,'2019-07-17','asdasd',3,1,1,'2019-07-03 09:36:49','2019-07-30 04:02:30','k','k','A'),(31,31,'2019-07-17',NULL,2,1,1,'2019-07-03 09:38:47','2019-07-30 03:58:40','k','k',NULL),(32,32,'2019-07-17','The Thousand Character Classic (Bahasa Cina : 千字文 ; pinyin : Qiānzì Wén ), juga dikenal sebagai Thousand Character Text , adalah puisi Tiongkok yang telah digunakan sebagai primer untuk mengajarkan karakter Cina kepada anak-anak sejak abad keenam dan seterusnya. Berisi persis seribu karakter, masing-masing hanya digunakan sekali, disusun menjadi 250 baris empat karakter masing-masing dan dikelompokkan menjadi empat baris bait berima untuk membuatnya mudah dihafal. Lagu ini dinyanyikan dengan cara yang mirip dengan anak-anak yang belajar alfabet Latin menyanyikan \" lagu alfabet .\" Seiring dengan Tiga Karakter Klasik dan Ratusan Nama Keluarga , itu membentuk dasar pelatihan melek huruf di Cina tradisionalhuruf di Cina tradisional.huruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina di Cina di Cina 0000000',3,1,1,'2019-07-03 09:40:50','2019-07-29 09:39:11','The Thousand Character Classic (Bahasa Cina : 千字文 ; pinyin : Qiānzì Wén ), juga dikenal sebagai Thousand Character Text , adalah puisi Tiongkok yang telah digunakan sebagai primer untuk mengajarkan karakter Cina kepada anak-anak sejak abad keenam dan seterusnya. Berisi persis seribu karakter, masing-masing hanya digunakan sekali, disusun menjadi 250 baris empat karakter masing-masing dan dikelompokkan menjadi empat baris bait berima untuk membuatnya mudah dihafal. Lagu ini dinyanyikan dengan cara yang mirip dengan anak-anak yang belajar alfabet Latin menyanyikan \" lagu alfabet .\" Seiring dengan Tiga Karakter Klasik dan Ratusan Nama Keluarga , itu membentuk dasar pelatihan melek huruf di Cina tradisionalhuruf di Cina tradisional.huruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina di Cina di Cina 0000000','The Thousand Character Classic (Bahasa Cina : 千字文 ; pinyin : Qiānzì Wén ), juga dikenal sebagai Thousand Character Text , adalah puisi Tiongkok yang telah digunakan sebagai primer untuk mengajarkan karakter Cina kepada anak-anak sejak abad keenam dan seterusnya. Berisi persis seribu karakter, masing-masing hanya digunakan sekali, disusun menjadi 250 baris empat karakter masing-masing dan dikelompokkan menjadi empat baris bait berima untuk membuatnya mudah dihafal. Lagu ini dinyanyikan dengan cara yang mirip dengan anak-anak yang belajar alfabet Latin menyanyikan \" lagu alfabet .\" Seiring dengan Tiga Karakter Klasik dan Ratusan Nama Keluarga , itu membentuk dasar pelatihan melek huruf di Cina tradisionalhuruf di Cina tradisional.huruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina di Cina di Cina 0000000','The Thousand Character Classic (Bahasa Cina : 千字文 ; pinyin : Qiānzì Wén ), juga dikenal sebagai Thousand Character Text , adalah puisi Tiongkok yang telah digunakan sebagai primer untuk mengajarkan karakter Cina kepada anak-anak sejak abad keenam dan seterusnya. Berisi persis seribu karakter, masing-masing hanya digunakan sekali, disusun menjadi 250 baris empat karakter masing-masing dan dikelompokkan menjadi empat baris bait berima untuk membuatnya mudah dihafal. Lagu ini dinyanyikan dengan cara yang mirip dengan anak-anak yang belajar alfabet Latin menyanyikan \" lagu alfabet .\" Seiring dengan Tiga Karakter Klasik dan Ratusan Nama Keluarga , itu membentuk dasar pelatihan melek huruf di Cina tradisionalhuruf di Cina tradisional.huruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina tradisionalhuruf di Cina di Cina di Cina 0000000'),(33,33,'2019-07-17',NULL,2,1,1,'2019-07-03 09:41:21','2019-07-29 09:16:11','aa','aak',NULL),(34,34,'2019-07-31',NULL,3,1,1,'2019-07-30 05:32:10','2019-08-12 01:44:41','AAAAIndustrial Hygiene and Hazardous Materials EvaluationIndustrial Hazardous Evaluation ReportProject No./Contract No: sadasdasName: ssCompany: Supreme Energy Jakart (Head Office Shoulder Matematik)Facility Name: wewewweArea: ASDBuilding: SDSADAEvaluation of Biological / Chemical / Physcal Hazards Documentation Online :Date: 2019-04-01To: adminFrom: adminPeer Review By: Lorem  Ipsum  is  simply  dummy  text  of  the  printing  and  typesetting  industry.  Lorem  Ipsum  has  been  the  industry\'s  standard  dummy  text  ever  since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,  but  also  the  leap  into  electronic  typesetting,  remaining  essentially  unchanged.  It  was  popularised  in  the  1960s  with  the  release  of  Letraset  sheets  containing  Lorem  Ipsum  passages,','Industrial Hygiene and Hazardous Materials EvaluationIndustrial Hazardous  (Head Office Shoulder Matematik)Facility Name: wewewweArea: ASDBuilding: SDSADAEvaluation of Biological / Chemical / Physcal Hazards Documentation Online :Date: 2019-04-01To: adminFrom: adminPeer Review By: Lorem  Ipsum  is  simply  dummy  text  of  the  printing  and  typesetting  industry.  Lorem  Ipsum  has  been  the  industry\'s  standard  dummy  text  ever  since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,  but  also  the  leap  into  electronic  typesetting,  remaining  essentially  unchanged.  It  was  popularised  in  the  1960s  with  the  release  of  Letraset  sheets  containing  Lorem  Ipsum  passages,  and  more  recently  with  desktop  publishing  software  like  Aldus  PageMaker  including  versions of Lorem Ipsum','sddffds');
/*!40000 ALTER TABLE `trans_inspection_visit_detail` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_inspection_visit_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_inspection_visit_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fileurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_inspection_visit_file_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_inspection_visit_file_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_inspection_visit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_inspection_visit_file` WRITE;
/*!40000 ALTER TABLE `trans_inspection_visit_file` DISABLE KEYS */;
INSERT INTO `trans_inspection_visit_file` VALUES (1,1,NULL,'inspection-record/reporting/3d94d1aa78309646dbe0bced41b74fee.jpg',1,1,NULL,'2019-06-19 09:59:33',NULL),(2,2,NULL,'inspection-record/reporting/3d94d1aa78309646dbe0bced41b74fee.jpg',1,1,NULL,'2019-06-19 09:59:40',NULL),(3,1,NULL,'inspection-record/reporting/8ed2078f22e6ebc3ea44941ffcf1bd15.jpg',2,1,NULL,'2019-06-19 10:43:58',NULL),(4,5,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 06:18:50',NULL),(5,6,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 08:15:52',NULL),(6,7,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 08:59:35',NULL),(7,8,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 09:00:51',NULL),(8,9,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 09:01:22',NULL),(9,10,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 09:01:50',NULL),(10,11,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 09:02:29',NULL),(11,12,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 09:03:16',NULL),(12,13,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 09:03:20',NULL),(13,14,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 09:03:23',NULL),(14,15,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 09:04:03',NULL),(15,16,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 09:04:06',NULL),(16,17,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 09:04:08',NULL),(17,18,NULL,'inspection-record/reporting/735494af37f80b839060172f8aee2dc6.jpg',1,1,NULL,'2019-07-03 09:04:55',NULL),(18,21,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-07-03 09:12:05',NULL),(19,22,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-07-03 09:12:10',NULL),(20,23,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-07-03 09:14:22',NULL),(21,24,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-07-03 09:15:02',NULL),(22,25,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-07-03 09:15:55',NULL),(23,26,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-07-03 09:20:13',NULL),(52,33,NULL,'inspection-record/reporting/becca33943dff438a4105968a3017761.jpg',1,1,NULL,'2019-07-29 09:16:11',NULL),(53,32,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-07-29 09:16:41',NULL),(59,32,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-07-29 09:24:37',NULL),(60,32,NULL,'inspection-record/reporting/fa61240f14f47b969332c83f5c27c2ac.jpg',1,1,NULL,'2019-07-29 09:24:37',NULL),(61,32,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-07-29 09:26:42',NULL),(62,32,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-07-29 09:26:42',NULL),(63,32,NULL,'inspection-record/reporting/fa61240f14f47b969332c83f5c27c2ac.jpg',1,1,NULL,'2019-07-29 09:26:42',NULL),(64,32,NULL,'inspection-record/reporting/fa61240f14f47b969332c83f5c27c2ac.jpg',1,1,NULL,'2019-07-29 09:26:42',NULL),(65,32,NULL,'inspection-record/reporting/e4a81444fe083741854c3ff5551d8910.jpg',1,1,NULL,'2019-07-29 09:27:36',NULL),(75,32,NULL,'inspection-record/reporting/5ca077f037c88cb113530b3deea9465b.jpg',2,1,NULL,'2019-07-29 09:39:11',NULL),(76,31,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-07-30 03:58:40',NULL),(77,30,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-07-30 03:59:13',NULL),(79,30,NULL,'inspection-record/reporting/df764bbfb0a8bb779df5404968129b8a.jpg',2,1,NULL,'2019-07-30 04:02:30',NULL),(90,34,NULL,'inspection-record/reporting/c6b7d6132cedda524c533d67c64e2b08.jpg',1,1,NULL,'2019-08-12 01:44:42',NULL),(91,34,NULL,'inspection-record/reporting/10904bd670047be76a02a0ee41695832.png',1,1,NULL,'2019-08-12 01:44:42',NULL),(92,29,NULL,'inspection-record/reporting/616deeb0f3b79901fca2ec6a232a263d.jpg',1,1,NULL,'2019-08-16 03:33:03',NULL),(94,28,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-08-16 03:35:28',NULL),(95,27,NULL,'inspection-record/reporting/226c66146a9f7a6e5876aa01168f64b9.jpg',1,1,NULL,'2019-08-16 03:49:45',NULL);
/*!40000 ALTER TABLE `trans_inspection_visit_file` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_inspection_visit_pic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_inspection_visit_pic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `pic` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_inspection_visit_pic_pic_foreign` (`pic`),
  KEY `trans_inspection_visit_pic_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_inspection_visit_pic_pic_foreign` FOREIGN KEY (`pic`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_inspection_visit_pic_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_inspection_visit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_inspection_visit_pic` WRITE;
/*!40000 ALTER TABLE `trans_inspection_visit_pic` DISABLE KEYS */;
INSERT INTO `trans_inspection_visit_pic` VALUES (2,2,1,1,NULL,'2019-06-19 09:59:40',NULL),(5,1,1,1,NULL,'2019-06-19 10:10:23',NULL),(7,4,1,1,NULL,'2019-07-03 05:56:18',NULL),(8,5,1,1,NULL,'2019-07-03 06:18:50',NULL),(9,6,1,1,NULL,'2019-07-03 08:15:52',NULL),(10,7,1,1,NULL,'2019-07-03 08:59:35',NULL),(11,8,1,1,NULL,'2019-07-03 09:00:51',NULL),(12,9,1,1,NULL,'2019-07-03 09:01:22',NULL),(13,10,1,1,NULL,'2019-07-03 09:01:50',NULL),(14,11,1,1,NULL,'2019-07-03 09:02:29',NULL),(15,12,1,1,NULL,'2019-07-03 09:03:16',NULL),(16,13,1,1,NULL,'2019-07-03 09:03:20',NULL),(17,14,1,1,NULL,'2019-07-03 09:03:23',NULL),(18,15,1,1,NULL,'2019-07-03 09:04:03',NULL),(19,16,1,1,NULL,'2019-07-03 09:04:06',NULL),(20,17,1,1,NULL,'2019-07-03 09:04:08',NULL),(21,18,1,1,NULL,'2019-07-03 09:04:55',NULL),(22,19,1,1,NULL,'2019-07-03 09:06:15',NULL),(23,20,1,1,NULL,'2019-07-03 09:08:28',NULL),(24,21,1,1,NULL,'2019-07-03 09:12:05',NULL),(25,22,2,1,NULL,'2019-07-03 09:12:10',NULL),(26,23,2,1,NULL,'2019-07-03 09:14:22',NULL),(27,24,2,1,NULL,'2019-07-03 09:15:02',NULL),(28,25,2,1,NULL,'2019-07-03 09:15:55',NULL),(29,26,2,1,NULL,'2019-07-03 09:20:13',NULL),(46,33,2,1,NULL,'2019-07-29 09:16:11',NULL),(47,32,1,1,NULL,'2019-07-29 09:16:41',NULL),(48,31,2,1,NULL,'2019-07-30 03:58:40',NULL),(49,30,1,1,NULL,'2019-07-30 03:59:13',NULL),(57,34,1,1,NULL,'2019-08-12 01:44:42',NULL),(58,29,2,1,NULL,'2019-08-16 03:33:03',NULL),(60,28,1,1,NULL,'2019-08-16 03:35:28',NULL),(61,27,2,1,NULL,'2019-08-16 03:49:45',NULL);
/*!40000 ALTER TABLE `trans_inspection_visit_pic` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_kpi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_kpi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `site_id` int(10) unsigned DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `revision` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_kpi_site_id_foreign` (`site_id`),
  CONSTRAINT `trans_kpi_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_kpi` WRITE;
/*!40000 ALTER TABLE `trans_kpi` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_kpi` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_kpi_lagging`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_kpi_lagging` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kpi_id` int(10) unsigned DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `target_one` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_two` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `realization` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_kpi_lagging_kpi_id_foreign` (`kpi_id`),
  CONSTRAINT `trans_kpi_lagging_kpi_id_foreign` FOREIGN KEY (`kpi_id`) REFERENCES `trans_kpi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_kpi_lagging` WRITE;
/*!40000 ALTER TABLE `trans_kpi_lagging` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_kpi_lagging` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_kpi_leading`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_kpi_leading` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kpi_id` int(10) unsigned DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `realization` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_kpi_leading_kpi_id_foreign` (`kpi_id`),
  CONSTRAINT `trans_kpi_leading_kpi_id_foreign` FOREIGN KEY (`kpi_id`) REFERENCES `trans_kpi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_kpi_leading` WRITE;
/*!40000 ALTER TABLE `trans_kpi_leading` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_kpi_leading` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_kpi_revisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_kpi_revisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kpi_id` int(10) unsigned DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_kpi_revisions_kpi_id_foreign` (`kpi_id`),
  CONSTRAINT `trans_kpi_revisions_kpi_id_foreign` FOREIGN KEY (`kpi_id`) REFERENCES `trans_kpi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_kpi_revisions` WRITE;
/*!40000 ALTER TABLE `trans_kpi_revisions` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_kpi_revisions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_man_power`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_man_power` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contractor_id` int(10) unsigned NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_taken` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_id` int(10) unsigned DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fileurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_man_power_site_id_foreign` (`site_id`),
  CONSTRAINT `trans_man_power_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_man_power` WRITE;
/*!40000 ALTER TABLE `trans_man_power` DISABLE KEYS */;
INSERT INTO `trans_man_power` VALUES (30,3,'2019',NULL,'2019-09-10',2,1,1,'2019-09-10 07:48:44','2019-09-10 07:53:15','09',1,'ManPower20190910104854.xlsx','ManPower/ManPower20190910104854.xlsx'),(31,4,'2019',NULL,'2019-09-10',2,1,1,'2019-09-10 07:49:19','2019-09-10 07:49:22','09',1,'ManPower20190910104856.xlsx','ManPower/ManPower20190910104856.xlsx');
/*!40000 ALTER TABLE `trans_man_power` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_man_power_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_man_power_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `record_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jan` int(11) DEFAULT NULL,
  `feb` int(11) DEFAULT NULL,
  `mar` int(11) DEFAULT NULL,
  `apr` int(11) DEFAULT NULL,
  `may` int(11) DEFAULT NULL,
  `jun` int(11) DEFAULT NULL,
  `jul` int(11) DEFAULT NULL,
  `aug` int(11) DEFAULT NULL,
  `sep` int(11) DEFAULT NULL,
  `oct` int(11) DEFAULT NULL,
  `nov` int(11) DEFAULT NULL,
  `dec` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_man_power_detail_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_man_power_detail_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_man_power` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=961 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_man_power_detail` WRITE;
/*!40000 ALTER TABLE `trans_man_power_detail` DISABLE KEYS */;
INSERT INTO `trans_man_power_detail` VALUES (907,31,'smk',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2019-09-10 07:49:20',NULL),(908,31,'ohsas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2019-09-10 07:49:20',NULL),(909,31,'188',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:20',NULL),(910,31,'189',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:20',NULL),(911,31,'190',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:20',NULL),(912,31,'191',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:20',NULL),(913,31,'192',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:20',NULL),(914,31,'193',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:20',NULL),(915,31,'194',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:20',NULL),(916,31,'195',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:20',NULL),(917,31,'196',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:21',NULL),(918,31,'197',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:21',NULL),(919,31,'198',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:21',NULL),(920,31,'199',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:21',NULL),(921,31,'200',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:21',NULL),(922,31,'201',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:21',NULL),(923,31,'202',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:21',NULL),(924,31,'203',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:21',NULL),(925,31,'204',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:21',NULL),(926,31,'205',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:21',NULL),(927,31,'206',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:21',NULL),(928,31,'207',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:21',NULL),(929,31,'208',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:22',NULL),(930,31,'209',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:22',NULL),(931,31,'210',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:22',NULL),(932,31,'211',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:22',NULL),(933,31,'212',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:49:22',NULL),(934,30,'smk',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2019-09-10 07:53:13',NULL),(935,30,'ohsas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2019-09-10 07:53:13',NULL),(936,30,'188',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:13',NULL),(937,30,'189',1,1,1,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:13',NULL),(938,30,'190',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:13',NULL),(939,30,'191',2,2,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:13',NULL),(940,30,'192',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:13',NULL),(941,30,'193',0,3,4,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:13',NULL),(942,30,'194',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:13',NULL),(943,30,'195',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:13',NULL),(944,30,'196',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:13',NULL),(945,30,'197',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:13',NULL),(946,30,'198',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(947,30,'199',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(948,30,'200',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(949,30,'201',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(950,30,'202',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(951,30,'203',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(952,30,'204',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(953,30,'205',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(954,30,'206',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(955,30,'207',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(956,30,'208',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(957,30,'209',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(958,30,'210',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(959,30,'211',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:14',NULL),(960,30,'212',0,0,0,0,0,0,6,5,1,0,0,0,NULL,NULL,1,NULL,'2019-09-10 07:53:15',NULL);
/*!40000 ALTER TABLE `trans_man_power_detail` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_offline_training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_offline_training` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dept` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `participant` int(11) DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_offline_training_site_id_foreign` (`site_id`),
  CONSTRAINT `trans_offline_training_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_offline_training` WRITE;
/*!40000 ALTER TABLE `trans_offline_training` DISABLE KEYS */;
INSERT INTO `trans_offline_training` VALUES (1,'ds','sd',2,'2019-07-09',NULL,'sd',2233,NULL,1,1,'2019-07-23 08:23:41','2019-07-23 08:26:19'),(2,'asasas','assa',2,'2019-07-18',NULL,'sdsdds',5555,'ssasasa',1,NULL,'2019-07-23 08:24:26',NULL);
/*!40000 ALTER TABLE `trans_offline_training` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_policy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_policy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `print_page` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:all;1:3 page',
  `publish_date` date DEFAULT NULL,
  `publisher_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `site_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_policy_type_id_foreign` (`type_id`),
  CONSTRAINT `trans_policy_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `ref_policy_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_policy` WRITE;
/*!40000 ALTER TABLE `trans_policy` DISABLE KEYS */;
INSERT INTO `trans_policy` VALUES (1,2,'Policy','Policy Content',0,0,NULL,NULL,1,NULL,'2019-03-26 04:59:07',NULL,NULL),(2,2,'Policy2','Content Policy',1,1,NULL,NULL,1,1,'2019-03-26 04:59:36','2019-03-26 05:03:07',NULL),(3,2,'asdlmaskldm','maslkdmaslkdmlaskm',1,0,NULL,NULL,1,1,'2019-05-23 06:19:48','2019-05-23 06:25:52',NULL),(4,2,'asdlmaskldm','maslkdmaslkdmlaskm',0,0,NULL,NULL,1,NULL,'2019-05-23 06:19:48',NULL,NULL),(5,4,'dsa','asd',1,0,NULL,NULL,1,1,'2019-06-26 03:35:25','2019-06-26 03:35:41','1'),(6,3,'ilkknjhbgvfcdxs','fcgvhbjgcfvb',1,0,NULL,NULL,1,1,'2019-08-12 01:52:38','2019-08-12 01:53:42',NULL),(7,3,'Komik','asdasdasd',1,0,NULL,NULL,1,NULL,'2019-08-15 03:34:01',NULL,NULL);
/*!40000 ALTER TABLE `trans_policy` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_policy_lampiran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_policy_lampiran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `policy_id` int(10) unsigned NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_policy_lampiran_policy_id_foreign` (`policy_id`),
  CONSTRAINT `trans_policy_lampiran_policy_id_foreign` FOREIGN KEY (`policy_id`) REFERENCES `trans_policy` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_policy_lampiran` WRITE;
/*!40000 ALTER TABLE `trans_policy_lampiran` DISABLE KEYS */;
INSERT INTO `trans_policy_lampiran` VALUES (1,1,'99c91963-f90e-47dd-b696-46f63ecfd641.jpg','lampiran/92460e10e13691527f76c4bfdd71a01a1553576347.jpg',1,NULL,'2019-03-26 04:59:08',NULL),(2,1,'1046485pantai-21780x390.jpg','lampiran/d10708094b563fe7981fca809e8eda821553576348.jpg',1,NULL,'2019-03-26 04:59:08',NULL),(3,3,'1771979.jpg','lampiran/2fb6de4605dbda93b2ad3dce5b5d84d31558592388.jpg',1,NULL,'2019-05-23 06:19:48',NULL),(4,4,'1771979.jpg','lampiran/2fb6de4605dbda93b2ad3dce5b5d84d31558592388.jpg',1,NULL,'2019-05-23 06:19:48',NULL),(5,5,'99c91963-f90e-47dd-b696-46f63ecfd641.jpg','lampiran/92460e10e13691527f76c4bfdd71a01a1561520125.jpg',1,NULL,'2019-06-26 03:35:25',NULL),(6,6,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-12 01:52:39',NULL),(7,6,'AYOKULAKAN.jpg','lampiran/AYOKULAKAN.jpg',1,NULL,'2019-08-12 01:55:30',NULL),(8,7,'8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg','lampiran/8d8a37dc-a602-43ef-9708-b974e3b21b12.jpg',1,NULL,'2019-08-15 03:34:01',NULL);
/*!40000 ALTER TABLE `trans_policy_lampiran` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_policy_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_policy_reviews` (
  `policy_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`policy_id`,`user_id`),
  KEY `trans_policy_reviews_user_id_foreign` (`user_id`),
  CONSTRAINT `trans_policy_reviews_policy_id_foreign` FOREIGN KEY (`policy_id`) REFERENCES `trans_policy` (`id`),
  CONSTRAINT `trans_policy_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_policy_reviews` WRITE;
/*!40000 ALTER TABLE `trans_policy_reviews` DISABLE KEYS */;
INSERT INTO `trans_policy_reviews` VALUES (2,1),(7,1);
/*!40000 ALTER TABLE `trans_policy_reviews` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_policy_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_policy_site` (
  `policy_id` int(10) unsigned NOT NULL,
  `site_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`policy_id`,`site_id`),
  KEY `trans_policy_site_site_id_foreign` (`site_id`),
  CONSTRAINT `trans_policy_site_policy_id_foreign` FOREIGN KEY (`policy_id`) REFERENCES `trans_policy` (`id`),
  CONSTRAINT `trans_policy_site_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_policy_site` WRITE;
/*!40000 ALTER TABLE `trans_policy_site` DISABLE KEYS */;
INSERT INTO `trans_policy_site` VALUES (6,1),(6,2),(7,2);
/*!40000 ALTER TABLE `trans_policy_site` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_quiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_quiz` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `done` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_quiz_quiz_id_foreign` (`quiz_id`),
  KEY `trans_quiz_user_id_foreign` (`user_id`),
  CONSTRAINT `trans_quiz_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `ref_quiz` (`id`),
  CONSTRAINT `trans_quiz_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_quiz` WRITE;
/*!40000 ALTER TABLE `trans_quiz` DISABLE KEYS */;
INSERT INTO `trans_quiz` VALUES (1,2,1,NULL,8,1,1,1,'2019-07-09 04:14:38','2019-07-09 04:14:54'),(2,1,1,NULL,3,1,1,0,'2019-07-29 10:21:20','2019-07-29 10:21:23'),(3,4,1,NULL,342,1,1,0,'2019-07-29 10:24:17','2019-07-29 10:30:50'),(4,3,1,NULL,65,1,1,1,'2019-07-29 10:31:08','2019-07-29 10:32:57'),(5,3,1,NULL,24,1,1,1,'2019-07-29 10:34:04','2019-07-29 10:34:28');
/*!40000 ALTER TABLE `trans_quiz` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_quiz_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_quiz_answer` (
  `quiz_id` int(10) unsigned NOT NULL,
  `answer_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`quiz_id`,`answer_id`),
  KEY `trans_quiz_answer_answer_id_foreign` (`answer_id`),
  CONSTRAINT `trans_quiz_answer_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `ref_answer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trans_quiz_answer_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `trans_quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_quiz_answer` WRITE;
/*!40000 ALTER TABLE `trans_quiz_answer` DISABLE KEYS */;
INSERT INTO `trans_quiz_answer` VALUES (5,34);
/*!40000 ALTER TABLE `trans_quiz_answer` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_reg_accident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_reg_accident` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_incident_id` int(10) unsigned NOT NULL,
  `site_incident_report_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `site_id` int(10) unsigned NOT NULL,
  `datetime` datetime NOT NULL,
  `category_incident_id` int(10) unsigned NOT NULL,
  `geothermal` tinyint(4) NOT NULL DEFAULT '5' COMMENT '1: Light, 2:Heavy, 3: Die, 4: Dangerous Event, 5: N/A',
  `report_to_ebtke` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: Yes, 0: No',
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `severity_level` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: Minor, 2: Moderate, 3: Serious, 4: Major',
  `department_id` int(10) unsigned NOT NULL,
  `brief_incident_notification` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_by` int(10) unsigned NOT NULL,
  `short_term` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: Yes, 0: No',
  `long_term` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: Yes, 0: No',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: Open, 1: On Action',
  `investigation` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: No, 1: Yes',
  `final_investigation_completion_date` date DEFAULT NULL,
  `close_out_verification_submission_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: NULL, 1: Open, 2: Closed',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_reg_accident_type_incident_id_foreign` (`type_incident_id`),
  KEY `trans_reg_accident_project_id_foreign` (`project_id`),
  KEY `trans_reg_accident_site_id_foreign` (`site_id`),
  KEY `trans_reg_accident_category_incident_id_foreign` (`category_incident_id`),
  KEY `trans_reg_accident_department_id_foreign` (`department_id`),
  KEY `trans_reg_accident_report_by_foreign` (`report_by`),
  CONSTRAINT `trans_reg_accident_category_incident_id_foreign` FOREIGN KEY (`category_incident_id`) REFERENCES `ref_category_incident` (`id`),
  CONSTRAINT `trans_reg_accident_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `ref_departement` (`id`),
  CONSTRAINT `trans_reg_accident_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `ref_project` (`id`),
  CONSTRAINT `trans_reg_accident_report_by_foreign` FOREIGN KEY (`report_by`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_reg_accident_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`),
  CONSTRAINT `trans_reg_accident_type_incident_id_foreign` FOREIGN KEY (`type_incident_id`) REFERENCES `ref_type_incident` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_reg_accident` WRITE;
/*!40000 ALTER TABLE `trans_reg_accident` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_reg_accident` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_reg_accident_agent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_reg_accident_agent` (
  `reg_accident_id` int(10) unsigned NOT NULL,
  `agent_of_incident_id` int(10) unsigned NOT NULL,
  KEY `trans_reg_accident_agent_reg_accident_id_foreign` (`reg_accident_id`),
  KEY `trans_reg_accident_agent_agent_of_incident_id_foreign` (`agent_of_incident_id`),
  CONSTRAINT `trans_reg_accident_agent_agent_of_incident_id_foreign` FOREIGN KEY (`agent_of_incident_id`) REFERENCES `ref_agent_of_incident` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trans_reg_accident_agent_reg_accident_id_foreign` FOREIGN KEY (`reg_accident_id`) REFERENCES `trans_reg_accident` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_reg_accident_agent` WRITE;
/*!40000 ALTER TABLE `trans_reg_accident_agent` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_reg_accident_agent` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_reg_accident_causes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_reg_accident_causes` (
  `reg_accident_id` int(10) unsigned NOT NULL,
  `causes_incident_id` int(10) unsigned NOT NULL,
  KEY `trans_reg_accident_causes_reg_accident_id_foreign` (`reg_accident_id`),
  KEY `trans_reg_accident_causes_causes_incident_id_foreign` (`causes_incident_id`),
  CONSTRAINT `trans_reg_accident_causes_causes_incident_id_foreign` FOREIGN KEY (`causes_incident_id`) REFERENCES `ref_causes_incident` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trans_reg_accident_causes_reg_accident_id_foreign` FOREIGN KEY (`reg_accident_id`) REFERENCES `trans_reg_accident` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_reg_accident_causes` WRITE;
/*!40000 ALTER TABLE `trans_reg_accident_causes` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_reg_accident_causes` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_reg_accident_causes_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_reg_accident_causes_detail` (
  `reg_accident_id` int(10) unsigned NOT NULL,
  `causes_incident_detail_id` int(10) unsigned NOT NULL,
  KEY `trans_reg_accident_causes_detail_reg_accident_id_foreign` (`reg_accident_id`),
  KEY `fk_accident_cause_detail` (`causes_incident_detail_id`),
  CONSTRAINT `fk_accident_cause_detail` FOREIGN KEY (`causes_incident_detail_id`) REFERENCES `ref_causes_incident_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trans_reg_accident_causes_detail_reg_accident_id_foreign` FOREIGN KEY (`reg_accident_id`) REFERENCES `trans_reg_accident` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_reg_accident_causes_detail` WRITE;
/*!40000 ALTER TABLE `trans_reg_accident_causes_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_reg_accident_causes_detail` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_reg_accident_lt_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_reg_accident_lt_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reg_accident_id` int(10) unsigned NOT NULL,
  `pic_id` int(10) unsigned NOT NULL,
  `recommended` text COLLATE utf8mb4_unicode_ci,
  `actions` text COLLATE utf8mb4_unicode_ci,
  `completion_date` date DEFAULT NULL,
  `completion_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: Open; 1:Closed',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_reg_accident_lt_action_pic_id_foreign` (`pic_id`),
  KEY `trans_reg_accident_lt_action_reg_accident_id_foreign` (`reg_accident_id`),
  CONSTRAINT `trans_reg_accident_lt_action_pic_id_foreign` FOREIGN KEY (`pic_id`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_reg_accident_lt_action_reg_accident_id_foreign` FOREIGN KEY (`reg_accident_id`) REFERENCES `trans_reg_accident` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_reg_accident_lt_action` WRITE;
/*!40000 ALTER TABLE `trans_reg_accident_lt_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_reg_accident_lt_action` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_reg_accident_mechanism`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_reg_accident_mechanism` (
  `reg_accident_id` int(10) unsigned NOT NULL,
  `mechanism_incident_id` int(10) unsigned NOT NULL,
  KEY `trans_reg_accident_mechanism_reg_accident_id_foreign` (`reg_accident_id`),
  KEY `trans_reg_accident_mechanism_mechanism_incident_id_foreign` (`mechanism_incident_id`),
  CONSTRAINT `trans_reg_accident_mechanism_mechanism_incident_id_foreign` FOREIGN KEY (`mechanism_incident_id`) REFERENCES `ref_mechanism_incident` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trans_reg_accident_mechanism_reg_accident_id_foreign` FOREIGN KEY (`reg_accident_id`) REFERENCES `trans_reg_accident` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_reg_accident_mechanism` WRITE;
/*!40000 ALTER TABLE `trans_reg_accident_mechanism` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_reg_accident_mechanism` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_reg_accident_party`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_reg_accident_party` (
  `reg_accident_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  KEY `trans_reg_accident_party_reg_accident_id_foreign` (`reg_accident_id`),
  KEY `trans_reg_accident_party_user_id_foreign` (`user_id`),
  CONSTRAINT `trans_reg_accident_party_reg_accident_id_foreign` FOREIGN KEY (`reg_accident_id`) REFERENCES `trans_reg_accident` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trans_reg_accident_party_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_reg_accident_party` WRITE;
/*!40000 ALTER TABLE `trans_reg_accident_party` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_reg_accident_party` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_reg_accident_st_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_reg_accident_st_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pic_id` int(10) unsigned NOT NULL,
  `reg_accident_id` int(10) unsigned NOT NULL,
  `recommended` text COLLATE utf8mb4_unicode_ci,
  `actions` text COLLATE utf8mb4_unicode_ci,
  `completion_date` date DEFAULT NULL,
  `completion_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: Open; 1:Closed',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_reg_accident_st_action_pic_id_foreign` (`pic_id`),
  KEY `trans_reg_accident_st_action_reg_accident_id_foreign` (`reg_accident_id`),
  CONSTRAINT `trans_reg_accident_st_action_pic_id_foreign` FOREIGN KEY (`pic_id`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_reg_accident_st_action_reg_accident_id_foreign` FOREIGN KEY (`reg_accident_id`) REFERENCES `trans_reg_accident` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_reg_accident_st_action` WRITE;
/*!40000 ALTER TABLE `trans_reg_accident_st_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_reg_accident_st_action` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_regulations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_regulations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revision` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fileurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_regulations_type_id_foreign` (`type_id`),
  KEY `trans_regulations_site_id_foreign` (`site_id`),
  CONSTRAINT `trans_regulations_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `trans_regulations_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `ref_regulations_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_regulations` WRITE;
/*!40000 ALTER TABLE `trans_regulations` DISABLE KEYS */;
INSERT INTO `trans_regulations` VALUES (79,1,NULL,'asdas','asd',NULL,NULL,1,1,1,'2019-08-30 06:21:01','2019-08-30 06:50:01',NULL,NULL),(80,1,NULL,'AA','asd',NULL,NULL,1,1,NULL,'2019-08-30 06:52:28',NULL,NULL,NULL);
/*!40000 ALTER TABLE `trans_regulations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_regulations_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_regulations_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fileurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_regulations_file_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_regulations_file_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_regulations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_regulations_file` WRITE;
/*!40000 ALTER TABLE `trans_regulations_file` DISABLE KEYS */;
INSERT INTO `trans_regulations_file` VALUES (8,79,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','regulations_standards/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','2019-08-30 06:21:02',NULL,1,NULL),(9,80,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','regulations_standards/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','2019-08-30 06:52:28',NULL,1,NULL);
/*!40000 ALTER TABLE `trans_regulations_file` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_regulations_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_regulations_review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_regulations_review_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_regulations_review_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_regulations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_regulations_review` WRITE;
/*!40000 ALTER TABLE `trans_regulations_review` DISABLE KEYS */;
INSERT INTO `trans_regulations_review` VALUES (1,80,'1',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `trans_regulations_review` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_regulations_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_regulations_site` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `site_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_regulations_site_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_regulations_site_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_regulations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_regulations_site` WRITE;
/*!40000 ALTER TABLE `trans_regulations_site` DISABLE KEYS */;
INSERT INTO `trans_regulations_site` VALUES (7,79,'2',NULL,NULL,NULL,NULL),(8,80,'2',NULL,NULL,NULL,NULL),(9,80,'1',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `trans_regulations_site` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_tbm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_tbm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(10) unsigned NOT NULL,
  `leader_id` int(10) unsigned NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_participants` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `topic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_tbm_site_id_foreign` (`site_id`),
  KEY `trans_tbm_leader_id_foreign` (`leader_id`),
  KEY `trans_tbm_type_id_foreign` (`type_id`),
  CONSTRAINT `trans_tbm_leader_id_foreign` FOREIGN KEY (`leader_id`) REFERENCES `sys_users` (`id`),
  CONSTRAINT `trans_tbm_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`),
  CONSTRAINT `trans_tbm_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `ref_type_she_meeting` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_tbm` WRITE;
/*!40000 ALTER TABLE `trans_tbm` DISABLE KEYS */;
INSERT INTO `trans_tbm` VALUES (1,1,1,'as','12','2019-03-15','1:00 PM','as',1,1,'2019-03-26 08:31:03','2019-06-21 06:51:34','A',1),(2,1,1,'asdasd','12','2019-08-13','6:00 PM','asd',1,1,'2019-08-13 10:37:00','2019-08-13 10:46:51','asdasd',1);
/*!40000 ALTER TABLE `trans_tbm` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_tbm_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_tbm_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tbm_id` int(10) unsigned DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taken_at` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_tbm_file_tbm_id_foreign` (`tbm_id`),
  CONSTRAINT `trans_tbm_file_tbm_id_foreign` FOREIGN KEY (`tbm_id`) REFERENCES `trans_tbm` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_tbm_file` WRITE;
/*!40000 ALTER TABLE `trans_tbm_file` DISABLE KEYS */;
INSERT INTO `trans_tbm_file` VALUES (1,1,'32-99c91963-f90e-47dd-b696-46f63ecfd641.jpg','tbm/8262c3a28c6e219a5b3f5476b697ea87.jpg','-',NULL,NULL,NULL,1,NULL,'2019-06-21 06:51:34',NULL),(2,1,'IMG_1424.jpg','tbm/fd15265cc3f99691b3cb8bec923787cf.jpg','-',NULL,NULL,NULL,1,NULL,'2019-06-21 06:51:34',NULL),(3,2,'[BAGAS31] KMSpico 10.1.5.zip','tbm/avatar04.png','',NULL,NULL,NULL,1,NULL,'2019-08-13 10:37:00',NULL),(4,2,'avatar04.png','tbm/avatars.png','',NULL,NULL,NULL,1,NULL,'2019-08-13 10:37:00',NULL),(6,2,'3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','tbm/3-0-6a42bb0786da-H8rq9I-1-1512173552938.jpg','',NULL,NULL,NULL,1,NULL,'2019-08-13 10:47:14',NULL);
/*!40000 ALTER TABLE `trans_tbm_file` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `sheet_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `detail` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_project_id_foreign` (`project_id`),
  CONSTRAINT `trans_wp_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `ref_project` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp` WRITE;
/*!40000 ALTER TABLE `trans_wp` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_wp` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_jsa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_jsa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(11) DEFAULT NULL,
  `jsa_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `job_desc` longtext COLLATE utf8mb4_unicode_ci,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spv` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_leader` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reviewed_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisior` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `others` longtext COLLATE utf8mb4_unicode_ci,
  `assembly_area` longtext COLLATE utf8mb4_unicode_ci,
  `date` date DEFAULT NULL,
  `status_revised` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fileurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_jsa_project_id_foreign` (`project_id`),
  CONSTRAINT `trans_wp_jsa_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `ref_project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_jsa` WRITE;
/*!40000 ALTER TABLE `trans_wp_jsa` DISABLE KEYS */;
INSERT INTO `trans_wp_jsa` VALUES (1,1,'1',1,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','Location',NULL,'1','1','1','1',2,'Other','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','2019-08-30',NULL,1,NULL,NULL,1,1,'2019-08-19 04:21:50','2019-08-19 04:26:37');
/*!40000 ALTER TABLE `trans_wp_jsa` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_jsa_attendece`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_jsa_attendece` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_jsa_attendece_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_jsa_attendece_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_jsa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_jsa_attendece` WRITE;
/*!40000 ALTER TABLE `trans_wp_jsa_attendece` DISABLE KEYS */;
INSERT INTO `trans_wp_jsa_attendece` VALUES (5,1,'Ampas','Company','Sign',1,1,NULL,'2019-08-19 04:41:37',NULL);
/*!40000 ALTER TABLE `trans_wp_jsa_attendece` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_jsa_checklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_jsa_checklist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_jsa_checklist_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_jsa_checklist_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_jsa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_jsa_checklist` WRITE;
/*!40000 ALTER TABLE `trans_wp_jsa_checklist` DISABLE KEYS */;
INSERT INTO `trans_wp_jsa_checklist` VALUES (125,'#0','0',NULL,1,1,NULL,'2019-08-19 04:41:37',NULL,NULL,1),(126,'#0','1',NULL,1,1,NULL,'2019-08-19 04:41:37',NULL,NULL,1),(127,'#0','2',NULL,1,1,NULL,'2019-08-19 04:41:37',NULL,NULL,1),(128,'#0','3','1',1,1,NULL,'2019-08-19 04:41:37',NULL,NULL,1),(129,'#0','4','1',1,1,NULL,'2019-08-19 04:41:37',NULL,NULL,1),(130,'#0','5','1',1,1,NULL,'2019-08-19 04:41:37',NULL,NULL,1),(131,'#1','0',NULL,1,1,NULL,'2019-08-19 04:41:37',NULL,NULL,1),(132,'#1','1',NULL,1,1,NULL,'2019-08-19 04:41:37',NULL,NULL,1),(133,'#1','2','1',1,1,NULL,'2019-08-19 04:41:37',NULL,NULL,1),(134,'#1','3','1',1,1,NULL,'2019-08-19 04:41:37',NULL,NULL,1),(135,'#1','4',NULL,1,1,NULL,'2019-08-19 04:41:37',NULL,NULL,1),(136,'#2','0',NULL,1,1,NULL,'2019-08-19 04:41:37',NULL,NULL,1),(137,'#2','1',NULL,1,1,NULL,'2019-08-19 04:41:37',NULL,NULL,1),(138,'#2','2','1',1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(139,'#2','3',NULL,1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(140,'#2','4','1',1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(141,'#2','5',NULL,1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(142,'#2','6',NULL,1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(143,'#3','0','1',1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(144,'#3','1',NULL,1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(145,'#3','2',NULL,1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(146,'#3','3',NULL,1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(147,'#3','4',NULL,1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(148,'#3','5',NULL,1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(149,'#4','0','1',1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(150,'#4','1',NULL,1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(151,'#4','2',NULL,1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(152,'#4','3',NULL,1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(153,'#5','0','1',1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(154,'#5','1',NULL,1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1),(155,'#5','2',NULL,1,1,NULL,'2019-08-19 04:41:38',NULL,NULL,1);
/*!40000 ALTER TABLE `trans_wp_jsa_checklist` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_jsa_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_jsa_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `fileurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_jsa_file_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_jsa_file_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_jsa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_jsa_file` WRITE;
/*!40000 ALTER TABLE `trans_wp_jsa_file` DISABLE KEYS */;
INSERT INTO `trans_wp_jsa_file` VALUES (6,1,'jsa/record/ef4eb5a51b4dfc016f37f15551068c8a.png',NULL,NULL,1,1,NULL,'2019-08-19 04:41:36',NULL),(7,1,'jsa/record/f2fee49f68598e6cafb02a6eaa8ddb31.png',NULL,NULL,1,1,NULL,'2019-08-19 04:41:37',NULL),(8,1,'jsa/record/6f5d7530dd99f2b59b890d5932e695fb.jpg',NULL,NULL,1,1,NULL,'2019-08-19 04:41:37',NULL),(9,1,'jsa/record/d3bd0d25ee1d9e2d395e023d0100796c.png',NULL,NULL,1,1,NULL,'2019-08-19 04:41:37',NULL),(10,1,'jsa/record/0c1ab5f61d9de7d201b90c9d4bc3c78e.jpg',NULL,NULL,1,1,NULL,'2019-08-19 04:41:37',NULL),(11,1,'jsa/record/14425862896a8684ffa9dc8d4f390b93.jpg',NULL,NULL,1,1,NULL,'2019-08-19 04:41:37',NULL),(12,1,'jsa/record/8355a2ea0a3789e563769a0c2c44c8d7.jpg',NULL,NULL,1,1,NULL,'2019-08-19 04:41:37',NULL),(13,1,'jsa/record/7e28c102511e8515d89d11a652bd8f84.jpg',NULL,NULL,1,1,NULL,'2019-08-19 04:41:37',NULL),(14,1,'jsa/record/af926166f3cd4b1ffd504c80dd2853b4.jpg',NULL,NULL,1,1,NULL,'2019-08-19 04:41:37',NULL),(15,1,'jsa/record/5b75c500066a783b96f0d1e593906c35.jpg',NULL,NULL,1,1,NULL,'2019-08-19 04:41:37',NULL),(16,1,'jsa/record/d65cc0638531d1cb66a8e0a91298fa1a.jpg',NULL,NULL,1,1,NULL,'2019-08-19 04:41:37',NULL),(17,1,'jsa/record/0e005743170b55dc5f0c0401bb88caba.jpg',NULL,NULL,1,1,NULL,'2019-08-19 04:41:37',NULL);
/*!40000 ALTER TABLE `trans_wp_jsa_file` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_jsa_who`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_jsa_who` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sequence` longtext COLLATE utf8mb4_unicode_ci,
  `potential_hazard` longtext COLLATE utf8mb4_unicode_ci,
  `recommendation` longtext COLLATE utf8mb4_unicode_ci,
  `pic` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `trans_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_jsa_who_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_jsa_who_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_jsa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_jsa_who` WRITE;
/*!40000 ALTER TABLE `trans_wp_jsa_who` DISABLE KEYS */;
INSERT INTO `trans_wp_jsa_who` VALUES (5,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum',1,NULL,1,1,NULL,'2019-08-19 04:41:37',NULL,1);
/*!40000 ALTER TABLE `trans_wp_jsa_who` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned DEFAULT NULL,
  `wo_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `describe` longtext COLLATE utf8mb4_unicode_ci,
  `request_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_date` date DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `site_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_site_id_foreign` (`site_id`),
  CONSTRAINT `trans_wp_request_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `ref_site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request` WRITE;
/*!40000 ALTER TABLE `trans_wp_request` DISABLE KEYS */;
INSERT INTO `trans_wp_request` VALUES (1,NULL,'REF/01/19/09/19 Permit Request','2019-08-23','12','Area Gedung A','System Integretet','Location Bandung Jabar','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when','1','2019-08-19',1,1,1,'2019-08-19 03:13:28','2019-08-19 03:23:13',1),(2,NULL,'Man','2019-08-13','12','Area','Syten','das','asd','asd','asd','1','2019-08-19',1,1,1,'2019-08-19 07:49:17','2019-08-19 08:39:35',1);
/*!40000 ALTER TABLE `trans_wp_request` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_atmospheric`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_atmospheric` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `atc_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equipment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` longtext COLLATE utf8mb4_unicode_ci,
  `oxygen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `toxic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flammble` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_oxygen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_toxic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_flammble` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `re_testing` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_atmospheric_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_atmospheric_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request_confined` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_atmospheric` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_atmospheric` DISABLE KEYS */;
INSERT INTO `trans_wp_request_atmospheric` VALUES (1,1,'4','2019-08-19',NULL,'Area Gedung A','System Integretet',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2019-08-19 03:23:13','2019-08-19 05:02:19'),(2,2,NULL,'2019-08-19',NULL,'Area','Syten',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(3,2,NULL,'2019-08-19',NULL,'Area','Syten',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:40',NULL);
/*!40000 ALTER TABLE `trans_wp_request_atmospheric` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_atmospheric_testing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_atmospheric_testing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oxygen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `toxic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `auth_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_atmospheric_testing_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_atmospheric_testing_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request_atmospheric` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_atmospheric_testing` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_atmospheric_testing` DISABLE KEYS */;
INSERT INTO `trans_wp_request_atmospheric_testing` VALUES (5,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(7,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:40',NULL);
/*!40000 ALTER TABLE `trans_wp_request_atmospheric_testing` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_confined`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_confined` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `gwp_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `csep_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `valid_form` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `until` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `reason_entry` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atmospheric_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atmospheric_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotwork_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotwork_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_time_start` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_time_end` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_auth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit1_time_start` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit1_time_end` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit1_auth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc1_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc1_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc1_time_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `proces_isolation` longtext COLLATE utf8mb4_unicode_ci,
  `op_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_confined_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_confined_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_confined` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_confined` DISABLE KEYS */;
INSERT INTO `trans_wp_request_confined` VALUES (1,1,'GWP#1908001','1','2019-08-19','August 19, 2019','August 20, 2019','zLorem  Ipsum  is  simply  dummy  text  of  the  printing  and  typesetting  industry.  Lorem  Ipsum  has  been  the  industry\'s  standard  dummy  text  ever  since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,  but  also  the  leap  into  electronic  typesetting,  remaining  essentially  unchanged.  It  was  popularised  in  the  1960s  with  the  release  of  Letraset  sheets  containing  Lorem  Ipsum  passages,  and  more  recently  with  desktop  publishing  software  like  Aldus  PageMaker  including  versions of Lorem Ipsum. Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-',NULL,NULL,NULL,'1','HWP#1908001','Adriyana',NULL,'August 21, 2019 5:00 PM','Adriyana',NULL,'August 30, 2019 11:00 PM','Alex',NULL,'August 30, 2019 6:00 PM','10:00 AM','6:00 PM','August 7, 2019',NULL,NULL,NULL,'Adriyana',NULL,'August 22, 2019 6:00 PM','Adriyana','August 14, 2019 1:50 PM',NULL,1,1,1,'2019-08-19 03:23:12','2019-08-19 05:00:55','zLorem  Ipsum  is  simply  dummy  text  of  the  printing  and  typesetting  industry.  Lorem  Ipsum  has  been  the  industry\'s  standard  dummy  text  ever  since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,  but  also  the  leap  into  electronic  typesetting,  remaining  essentially  unchanged.  It  was  popularised  in  the  1960s  with  the  release  of  Letraset  sheets  containing  Lorem  Ipsum  passages,  and  more  recently  with  desktop  publishing  software  like  Aldus  PageMaker  including  versions of Lorem Ipsum. Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-','ALex',NULL,NULL),(2,2,'-','2','2019-08-19','August 19, 2019','August 20, 2019',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL,NULL,NULL,NULL,NULL),(3,2,'-','3','2019-08-19','August 19, 2019','August 20, 2019',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `trans_wp_request_confined` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_confined_condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_confined_condition` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `entry_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exit_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_confined_condition_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_confined_condition_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request_confined` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_confined_condition` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_confined_condition` DISABLE KEYS */;
INSERT INTO `trans_wp_request_confined_condition` VALUES (5,1,'Adriyana','-','2019-08-26','9:00 PM','10:55 PM',1,1,NULL,'2019-08-19 05:02:19',NULL),(7,2,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:40',NULL);
/*!40000 ALTER TABLE `trans_wp_request_confined_condition` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_confined_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_confined_entry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_confined_entry_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_confined_entry_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request_confined` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_confined_entry` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_confined_entry` DISABLE KEYS */;
INSERT INTO `trans_wp_request_confined_entry` VALUES (65,1,'0','Hazardous residue present','1',NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(66,1,'1','Physical Stress (Heat/Cold)','1',NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(67,1,'2','Oxygen Deficiency','1',NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(68,1,'3','Noise',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(69,1,'4','Combustible gas/vapors',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(70,1,'5','Toxic gas/vapors (H2S)',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(71,1,'6','Chemical contact',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(72,1,'7','Electrical/Mechanical',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(73,1,'8','Vacating / Draining / Venting',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(74,1,'9','Flushing / Purging',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(75,1,'10','Area Barricaded',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(76,1,'11','Continuous atmospheric testing and ventilation',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(77,1,'12','Lighting',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(78,1,'13','Life lines',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(79,1,'14','First Aider and equipment',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(80,1,'15','Communication Plan Made',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(90,2,'9','Flushing / Purging',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(91,2,'0','Hazardous residue present',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(92,2,'10','Area Barricaded',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(93,2,'1','Physical Stress (Heat/Cold)',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(94,2,'11','Continuous atmospheric testing and ventilation',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(95,2,'2','Oxygen Deficiency',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(96,2,'12','Lighting',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(97,2,'3','Noise',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(98,2,'13','Life lines',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(99,2,'4','Combustible gas/vapors',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(100,2,'14','First Aider and equipment',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(101,2,'5','Toxic gas/vapors (H2S)',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(102,2,'15','Communication Plan Made',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(103,2,'6','Chemical contact',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(104,2,'7','Electrical/Mechanical',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(105,2,'8','Vacating / Draining / Venting',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(106,2,'9','Flushing / Purging',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:40',NULL),(107,2,'10','Area Barricaded',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:40',NULL),(108,2,'11','Continuous atmospheric testing and ventilation',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:40',NULL),(109,2,'12','Lighting',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:40',NULL),(110,2,'13','Life lines',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:40',NULL),(111,2,'14','First Aider and equipment',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:40',NULL),(112,2,'15','Communication Plan Made',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:40',NULL);
/*!40000 ALTER TABLE `trans_wp_request_confined_entry` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_confined_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_confined_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_confined_item_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_confined_item_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request_confined` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_confined_item` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_confined_item` DISABLE KEYS */;
INSERT INTO `trans_wp_request_confined_item` VALUES (9,1,'Blind Flanged Installed','123',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(10,1,'Spool Pieces / Valve Removes','123',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(13,2,'Blind Flanged Installed',NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL),(14,2,'Spool Pieces / Valve Removes',NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:39',NULL);
/*!40000 ALTER TABLE `trans_wp_request_confined_item` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_electrical`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_electrical` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `eic_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equipment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cb_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` longtext COLLATE utf8mb4_unicode_ci,
  `pow_req_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pow_req_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pow_req_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pow_req_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pow_elect_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pow_elect_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pow_elect_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pow_elect_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elect_req_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elect_req_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elect_req_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elect_req_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elect_elect_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elect_elect_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elect_elect_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elect_elect_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `equipment_tag_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_electrical_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_electrical_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_electrical` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_electrical` DISABLE KEYS */;
INSERT INTO `trans_wp_request_electrical` VALUES (1,1,'1','2019-08-19','Area Gedung A','System Integretet',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2019-08-19 05:00:55','2019-08-19 05:02:18',NULL),(2,1,'2','2019-08-19','Area Gedung A','System Integretet',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:00:56',NULL,NULL),(3,1,'3','2019-08-19','Area Gedung A','System Integretet',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:01:28',NULL,NULL),(4,2,'4','2019-08-19','Area','Syten',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL,NULL),(5,2,'5','2019-08-19','Area','Syten',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL,NULL);
/*!40000 ALTER TABLE `trans_wp_request_electrical` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_excavation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_excavation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `ep_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gwp_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` longtext COLLATE utf8mb4_unicode_ci,
  `electric_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `electric_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `electric_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mechanic_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mechanic_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mechanic_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specific` longtext COLLATE utf8mb4_unicode_ci,
  `auth_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_excavation_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_excavation_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_excavation` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_excavation` DISABLE KEYS */;
INSERT INTO `trans_wp_request_excavation` VALUES (1,1,'1','GWP#1908001','2019-08-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2019-08-19 05:00:55','2019-08-19 05:02:18'),(2,1,'2','GWP#1908001','2019-08-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:00:56',NULL),(3,1,'3','GWP#1908001','2019-08-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:01:28',NULL),(4,2,'4','-','2019-08-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL),(5,2,'5','-','2019-08-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL);
/*!40000 ALTER TABLE `trans_wp_request_excavation` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_general`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_general` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `gwp_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `valid_form` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `until` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equipment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `service` longtext COLLATE utf8mb4_unicode_ci,
  `hot_wp_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confined_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hazard_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excavation_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `electric_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_time_start` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_time_end` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_auth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit1_time_start` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit1_time_end` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit1_auth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc1_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc1_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc1_time_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_general_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_general_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_general` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_general` DISABLE KEYS */;
INSERT INTO `trans_wp_request_general` VALUES (1,1,'1','2019-08-19','August 19, 2019','August 26, 2019','System Integretet','Area Gedung A',NULL,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when','HWP#1908001','CSEP#1908001','HAEP#1908001','EP#1908001','EIC#1908001','asd',NULL,'August 26, 2019 4:15 PM','asd',NULL,'August 19, 2019 12:15 PM','asd',NULL,'August 28, 2019 10:55 PM','11:00 AM','10:40 AM','asdasd',NULL,NULL,NULL,'asd',NULL,'August 27, 2019 5:20 PM','asd','August 8, 2019 6:40 AM',NULL,1,1,1,'2019-08-19 05:00:51','2019-08-19 05:02:15'),(2,1,'2','2019-08-19','August 19, 2019','August 26, 2019','System Integretet','Area Gedung A',NULL,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when','HWP#1908001','CSEP#1908001','HAEP#1908001','EP#1908001','EIC#1908001','asd',NULL,'August 26, 2019 4:15 PM','asd',NULL,'August 19, 2019 12:15 PM','asd',NULL,'August 28, 2019 10:55 PM','11:00 AM','10:40 AM','asdasd',NULL,NULL,NULL,'asd',NULL,'August 27, 2019 5:20 PM','asd','August 8, 2019 6:40 AM',NULL,1,1,NULL,'2019-08-19 05:00:51',NULL),(3,1,'3','2019-08-19','August 19, 2019','August 26, 2019','System Integretet','Area Gedung A',NULL,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when','HWP#1908001','CSEP#1908001','HAEP#1908001','EP#1908001','EIC#1908001','asd',NULL,'August 26, 2019 4:15 PM','asd',NULL,'August 19, 2019 12:15 PM','asd',NULL,'August 28, 2019 10:55 PM','11:00 AM','10:40 AM','asdasd',NULL,NULL,NULL,'asd',NULL,'August 27, 2019 5:20 PM','asd','August 8, 2019 6:40 AM',NULL,1,1,NULL,'2019-08-19 05:01:25',NULL);
/*!40000 ALTER TABLE `trans_wp_request_general` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_general_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_general_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_general_item_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_general_item_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request_general` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_general_item` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_general_item` DISABLE KEYS */;
INSERT INTO `trans_wp_request_general_item` VALUES (115,1,'Nature of hazards','Stored energy (steam, pressure, electrical)','1','asd',NULL,1,1,NULL,'2019-08-19 05:02:15',NULL),(116,1,'Nature of hazards','Noise','1','ads',NULL,1,1,NULL,'2019-08-19 05:02:15',NULL),(117,1,'Nature of hazards','Toxic substance','1','asdasdasdas',NULL,1,1,NULL,'2019-08-19 05:02:15',NULL),(118,1,'Nature of hazards','Heat',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:15',NULL),(119,1,'Nature of hazards','Elevation',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(120,1,'Nature of hazards','Traffic',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(121,1,'Nature of hazards','Flammable Vapors',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(122,1,'Nature of hazards','Ignition Source',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(123,1,'Nature of hazards','Restricted access',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(124,1,'Nature of hazards','Other',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(125,1,'Precautions','Isolations in Place',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(126,1,'Precautions','Ventilation','1','asdasdasdas',NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(127,1,'Precautions','Crew Rotation','1','asdasdasdas',NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(128,1,'Precautions','Life Lines Installed',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(129,1,'Precautions','Roads Closed',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(130,1,'Precautions','Mats Installed',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(131,1,'Precautions','Combustibles Removed',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(132,1,'Precautions','Drains covered',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(133,1,'Precautions','Materials Drained',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(134,1,'Precautions','Ground Fault Circuit Interrupter',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(135,1,'Precautions','MSDS available',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(136,1,'Precautions','Scaffolding Inspected',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(137,1,'Precautions','Emergency Station',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(138,1,'Precautions','Others Precautions',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(139,1,'Eye / Ear','Goggles','1',NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(140,1,'Eye / Ear','Safety Glasses','1',NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(141,1,'Eye / Ear','Face Shield',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(142,1,'Eye / Ear','Earplug',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(143,1,'Eye / Ear','Muffs',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(144,1,'Extremities','Gloves',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(145,1,'Extremities','Boots',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(146,1,'Extremities','Hard hat',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(147,1,'Extremities','Chemical Resistant',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:16',NULL),(148,1,'Fall Protection','Harness',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(149,1,'Fall Protection','Lifeline',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(150,1,'Respirator','SCBA',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(151,1,'Respirator','Cartridge',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(152,1,'Respirator','Dust mask',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL);
/*!40000 ALTER TABLE `trans_wp_request_general_item` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_hazard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_hazard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `gwp_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `haep_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `valid_form` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `until` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hazard_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spec_precaution` longtext COLLATE utf8mb4_unicode_ci,
  `auth_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_time_start` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_time_end` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_auth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit1_time_start` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit1_time_end` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit1_auth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc1_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc1_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc1_time_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `op_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_hazard_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_hazard_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_hazard` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_hazard` DISABLE KEYS */;
INSERT INTO `trans_wp_request_hazard` VALUES (1,1,'GWP#1908001','1','2019-08-19','August 19, 2019','August 20, 2019','Area Gedung A','asdasdasdas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,'2019-08-19 05:00:54','2019-08-19 05:02:17',NULL,NULL,NULL),(2,1,'GWP#1908001','2','2019-08-19','August 19, 2019','August 20, 2019','Area Gedung A','asdasdasdas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:00:55',NULL,NULL,NULL,NULL),(3,1,'GWP#1908001','3','2019-08-19','August 19, 2019','August 20, 2019','Area Gedung A','asdasdasdas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:01:27',NULL,NULL,NULL,NULL),(4,2,'-','4','2019-08-19','August 19, 2019','August 20, 2019','Area',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL,NULL,NULL,NULL),(5,2,'-','5','2019-08-19','August 19, 2019','August 20, 2019','Area',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `trans_wp_request_hazard` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_hazard_condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_hazard_condition` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_hazard_condition_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_hazard_condition_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request_hazard` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_hazard_condition` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_hazard_condition` DISABLE KEYS */;
INSERT INTO `trans_wp_request_hazard_condition` VALUES (4,1,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(6,4,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL);
/*!40000 ALTER TABLE `trans_wp_request_hazard_condition` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_hazard_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_hazard_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_hazard_item_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_hazard_item_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request_hazard` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_hazard_item` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_hazard_item` DISABLE KEYS */;
INSERT INTO `trans_wp_request_hazard_item` VALUES (31,1,'Nature of hazards to personnel','Stored Energy (steam, pressure, electrical)','1','asdasdasdas',NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(32,1,'Nature of hazards to personnel','Ignition Source',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(33,1,'Nature of hazards to personnel','Flammable material',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(34,1,'Nature of hazards to personnel','Explosive material',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(35,1,'Nature of hazards to personnel','Toxic substances',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(36,1,'Nature of hazards to personnel','Elevasi / Depth',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(37,1,'Nature of hazards to personnel','Noise',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(38,1,'Nature of hazards to personnel','Heat',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(39,1,'Nature of hazards to personnel','Dust',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(40,1,'Nature of hazards to personnel','Other','1','asdasdasdas',NULL,1,1,NULL,'2019-08-19 05:02:18',NULL),(48,4,'Nature of hazards to personnel','Heat',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL),(49,4,'Nature of hazards to personnel','Stored Energy (steam, pressure, electrical)',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL),(50,4,'Nature of hazards to personnel','Dust',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL),(51,4,'Nature of hazards to personnel','Ignition Source',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL),(52,4,'Nature of hazards to personnel','Other',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL),(53,4,'Nature of hazards to personnel','Flammable material',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL),(54,4,'Nature of hazards to personnel','Explosive material',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL),(55,4,'Nature of hazards to personnel','Toxic substances',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL),(56,4,'Nature of hazards to personnel','Elevasi / Depth',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL),(57,4,'Nature of hazards to personnel','Noise',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL),(58,4,'Nature of hazards to personnel','Heat',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL),(59,4,'Nature of hazards to personnel','Dust',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL),(60,4,'Nature of hazards to personnel','Other',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:38',NULL);
/*!40000 ALTER TABLE `trans_wp_request_hazard_item` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_hot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_hot` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `hot_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `valid_form` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `until` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equipment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `ignition` longtext COLLATE utf8mb4_unicode_ci,
  `testing_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perform_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fire_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fire_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fire_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_datetime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_time_start` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_time_end` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_auth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit1_time_start` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit1_time_end` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit1_auth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc1_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc1_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc1_time_signed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_hot_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_hot_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_hot` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_hot` DISABLE KEYS */;
INSERT INTO `trans_wp_request_hot` VALUES (1,1,'1','2019-08-19','August 19, 2019','August 20, 2019','System Integretet','Area Gedung A','17','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when','asdasd',NULL,'sad',NULL,'August 7, 2019 1:50 PM','asdasdasd',NULL,'August 7, 2019 9:35 AM','asdasdasdas',NULL,'August 26, 2019 4:30 PM','asdasdasdas',NULL,'August 19, 2019 12:15 PM','1:00 PM','9:00 PM','asdasdasdas',NULL,NULL,NULL,'asdasdasd',NULL,'August 20, 2019 1:20 PM','sad','August 27, 2019 10:55 PM',NULL,1,1,1,'2019-08-19 05:00:53','2019-08-19 05:02:17'),(2,1,'2','2019-08-19','August 19, 2019','August 20, 2019','System Integretet','Area Gedung A','17','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when','asdasd',NULL,'sad',NULL,'August 7, 2019 1:50 PM','asdasdasd',NULL,'August 7, 2019 9:35 AM','asdasdasdas',NULL,'August 26, 2019 4:30 PM','asdasdasdas',NULL,'August 19, 2019 12:15 PM','1:00 PM','9:00 PM','asdasdasdas',NULL,NULL,NULL,'asdasdasd',NULL,'August 20, 2019 1:20 PM','sad','August 27, 2019 10:55 PM',NULL,1,1,NULL,'2019-08-19 05:00:53',NULL),(3,1,'3','2019-08-19','August 19, 2019','August 20, 2019','System Integretet','Area Gedung A','17','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when','asdasd',NULL,'sad',NULL,'August 7, 2019 1:50 PM','asdasdasd',NULL,'August 7, 2019 9:35 AM','asdasdasdas',NULL,'August 26, 2019 4:30 PM','asdasdasdas',NULL,'August 19, 2019 12:15 PM','1:00 PM','9:00 PM','asdasdasdas',NULL,NULL,NULL,'asdasdasd',NULL,'August 20, 2019 1:20 PM','sad','August 27, 2019 10:55 PM',NULL,1,1,NULL,'2019-08-19 05:01:27',NULL),(4,2,'4',NULL,NULL,NULL,'Syten','Area',NULL,'asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:35',NULL),(5,2,'5',NULL,NULL,NULL,'Syten','Area',NULL,'asd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL);
/*!40000 ALTER TABLE `trans_wp_request_hot` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_hot_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_hot_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_hot_item_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_hot_item_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request_hot` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_hot_item` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_hot_item` DISABLE KEYS */;
INSERT INTO `trans_wp_request_hot_item` VALUES (52,1,'Nature of hazards','Ignition source within 12 meter of fuel source','1',NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(53,1,'Nature of hazards','Open drains with Hydrocarbons','1',NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(54,1,'Nature of hazards','Combustibles in the Area',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(55,1,'Nature of hazards','Non Intrinsically Safe (IS)',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(56,1,'Nature of hazards','Welding process',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(57,1,'Nature of hazards','Compressed Gas Cylinders',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(58,1,'Nature of hazards','Radiation',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(59,1,'Precautions','Charged Fire Hose',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(60,1,'Precautions','Shields, Blankets',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(61,1,'Precautions','Drains covered',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(62,1,'Precautions','Area Wet',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(63,1,'Precautions','Fire Extinguisher',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(64,1,'Precautions','Ventilation',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(65,1,'Precautions','Welding Machine Grounded','1',NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(66,1,'Precautions','Welding Equipment Inspected','1',NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(67,1,'Precautions','Cylinders secured',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(68,1,'Precautions','Continuous Atmospheric Monitoring',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:17',NULL),(75,4,'Nature of hazards','Radiation',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(76,4,'Nature of hazards','Ignition source within 12 meter of fuel source',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(77,4,'Precautions','Charged Fire Hose',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(78,4,'Nature of hazards','Open drains with Hydrocarbons',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(79,4,'Precautions','Shields, Blankets',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(80,4,'Nature of hazards','Combustibles in the Area',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(81,4,'Precautions','Drains covered',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(82,4,'Nature of hazards','Non Intrinsically Safe (IS)',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(83,4,'Precautions','Area Wet',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(84,4,'Nature of hazards','Welding process',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(85,4,'Precautions','Fire Extinguisher',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(86,4,'Nature of hazards','Compressed Gas Cylinders',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(87,4,'Precautions','Ventilation',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(88,4,'Nature of hazards','Radiation',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(89,4,'Precautions','Welding Machine Grounded',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(90,4,'Precautions','Charged Fire Hose',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(91,4,'Precautions','Welding Equipment Inspected',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(92,4,'Precautions','Shields, Blankets',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(93,4,'Precautions','Cylinders secured',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(94,4,'Precautions','Drains covered',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:36',NULL),(95,4,'Precautions','Continuous Atmospheric Monitoring',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL),(96,4,'Precautions','Area Wet',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL),(97,4,'Precautions','Fire Extinguisher',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL),(98,4,'Precautions','Ventilation',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL),(99,4,'Precautions','Welding Machine Grounded',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL),(100,4,'Precautions','Welding Equipment Inspected',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL),(101,4,'Precautions','Cylinders secured',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL),(102,4,'Precautions','Continuous Atmospheric Monitoring',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:37',NULL);
/*!40000 ALTER TABLE `trans_wp_request_hot_item` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_request_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_request_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1:General, 2:Hot Work, 3:Hazardouse Area, 4:Confined Space Entry, 5:Exacvation',
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_request_type_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_request_type_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_request_type` WRITE;
/*!40000 ALTER TABLE `trans_wp_request_type` DISABLE KEYS */;
INSERT INTO `trans_wp_request_type` VALUES (26,1,'1',1,1,NULL,'2019-08-19 06:20:37',NULL),(27,1,'2',1,1,NULL,'2019-08-19 06:20:37',NULL),(28,1,'3',1,1,NULL,'2019-08-19 06:20:37',NULL),(29,1,'4',1,1,NULL,'2019-08-19 06:20:37',NULL),(30,1,'5',1,1,NULL,'2019-08-19 06:20:38',NULL),(31,1,'6',1,1,NULL,'2019-08-19 06:20:38',NULL),(32,1,'7',1,1,NULL,'2019-08-19 06:20:38',NULL),(41,2,'2',1,1,NULL,'2019-08-19 08:41:52',NULL),(42,2,'3',1,1,NULL,'2019-08-19 08:41:52',NULL),(43,2,'4',1,1,NULL,'2019-08-19 08:41:52',NULL),(44,2,'5',1,1,NULL,'2019-08-19 08:41:52',NULL),(45,2,'6',1,1,NULL,'2019-08-19 08:41:52',NULL),(46,2,'7',1,1,NULL,'2019-08-19 08:41:52',NULL);
/*!40000 ALTER TABLE `trans_wp_request_type` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_scafolding_permit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_scafolding_permit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contractor_id` int(10) unsigned NOT NULL,
  `disciplin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `use_of_scafold` longtext COLLATE utf8mb4_unicode_ci,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `erected_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_scafolding_permit_project_id_foreign` (`project_id`),
  KEY `trans_wp_scafolding_permit_contractor_id_foreign` (`contractor_id`),
  KEY `trans_wp_scafolding_permit_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_scafolding_permit_contractor_id_foreign` FOREIGN KEY (`contractor_id`) REFERENCES `ref_contractor` (`id`),
  CONSTRAINT `trans_wp_scafolding_permit_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `ref_project` (`id`),
  CONSTRAINT `trans_wp_scafolding_permit_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_scafolding_permit` WRITE;
/*!40000 ALTER TABLE `trans_wp_scafolding_permit` DISABLE KEYS */;
INSERT INTO `trans_wp_scafolding_permit` VALUES (1,1,1,'1',1,'asdasdasdas','asasdasdasdas','asdasdasdas','asdasdasdas','2019-08-26','2019-08-30','asdasdasdas','asdasdasdas',1,1,1,'2019-08-19 05:01:29','2019-08-19 05:02:19','2019-08-13'),(2,2,1,'2',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:40',NULL,NULL),(3,2,1,'3',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL,NULL);
/*!40000 ALTER TABLE `trans_wp_scafolding_permit` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_scafolding_permit_inspected`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_scafolding_permit_inspected` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `client` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_scafolding_permit_inspected_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_scafolding_permit_inspected_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_scafolding_permit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_scafolding_permit_inspected` WRITE;
/*!40000 ALTER TABLE `trans_wp_scafolding_permit_inspected` DISABLE KEYS */;
INSERT INTO `trans_wp_scafolding_permit_inspected` VALUES (4,1,'asdasdasdas','asdasdasdas',1,1,NULL,'2019-08-19 05:02:20',NULL),(5,1,'asdasdasdas','asdasdasdas',1,1,NULL,'2019-08-19 05:02:20',NULL),(6,1,NULL,NULL,1,1,NULL,'2019-08-19 05:02:20',NULL),(10,2,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(11,2,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(12,2,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL);
/*!40000 ALTER TABLE `trans_wp_scafolding_permit_inspected` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `trans_wp_scafolding_permit_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_wp_scafolding_permit_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trans_id` int(10) unsigned NOT NULL,
  `items` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '1' COMMENT '1: Yes, 2: No',
  `date` date DEFAULT NULL,
  `inital` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_wp_scafolding_permit_item_trans_id_foreign` (`trans_id`),
  CONSTRAINT `trans_wp_scafolding_permit_item_trans_id_foreign` FOREIGN KEY (`trans_id`) REFERENCES `trans_wp_scafolding_permit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `trans_wp_scafolding_permit_item` WRITE;
/*!40000 ALTER TABLE `trans_wp_scafolding_permit_item` DISABLE KEYS */;
INSERT INTO `trans_wp_scafolding_permit_item` VALUES (15,1,'TUBES','No','2019-08-14','asdasdasdas',1,1,NULL,'2019-08-19 05:02:19',NULL),(16,1,'FRAMES',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(17,1,'BASES',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(18,1,'LADDERS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(19,1,'ACCESS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(20,1,'PLANKS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(21,1,'KICK BOARDS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:19',NULL),(22,1,'HAND RAILS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:20',NULL),(23,1,'TIE OFFS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:20',NULL),(24,1,'FALGGING',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:20',NULL),(25,1,'SIGNS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:20',NULL),(26,1,'BARRICADES',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:20',NULL),(27,1,'LIGHTING',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:20',NULL),(28,1,'TAGGED',NULL,NULL,NULL,1,1,NULL,'2019-08-19 05:02:20',NULL),(42,2,'TAGGED',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(43,2,'TUBES',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(44,2,'FRAMES',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(45,2,'BASES',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(46,2,'LADDERS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(47,2,'ACCESS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(48,2,'PLANKS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(49,2,'KICK BOARDS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(50,2,'HAND RAILS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(51,2,'TIE OFFS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(52,2,'FALGGING',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(53,2,'SIGNS',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(54,2,'BARRICADES',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(55,2,'LIGHTING',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL),(56,2,'TAGGED',NULL,NULL,NULL,1,1,NULL,'2019-08-19 08:42:41',NULL);
/*!40000 ALTER TABLE `trans_wp_scafolding_permit_item` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

