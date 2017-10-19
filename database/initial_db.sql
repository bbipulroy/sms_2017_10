-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: localhost    Database: arm_sms_2017_10
-- ------------------------------------------------------
-- Server version	5.6.24

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
-- Table structure for table `system_assigned_group`
--

DROP TABLE IF EXISTS `system_assigned_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_assigned_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_group` int(11) NOT NULL,
  `revision` int(4) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_updated` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_assigned_group`
--

LOCK TABLES `system_assigned_group` WRITE;
/*!40000 ALTER TABLE `system_assigned_group` DISABLE KEYS */;
INSERT INTO `system_assigned_group` VALUES (1,1,1,1,0,0,NULL,NULL),(2,2,2,1,0,0,NULL,NULL);
/*!40000 ALTER TABLE `system_assigned_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_history`
--

DROP TABLE IF EXISTS `system_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(255) DEFAULT NULL,
  `table_id` int(11) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `data` varchar(255) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `action` varchar(20) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_history`
--

LOCK TABLES `system_history` WRITE;
/*!40000 ALTER TABLE `system_history` DISABLE KEYS */;
INSERT INTO `system_history` VALUES (1,'sys_user_group',1,'arm_bms_2017_08.system_user_group_role','{\"date_updated\":1500821766,\"user_updated\":\"1\"}','1','UPDATE',1500821766),(2,'sys_user_group',2,'arm_bms_2017_08.system_user_group_role','{\"action0\":1,\"action1\":1,\"action2\":1,\"action3\":1,\"action4\":1,\"action5\":1,\"action6\":1,\"task_id\":2,\"user_group_id\":\"1\",\"user_created\":\"1\",\"date_created\":1500821766}','1','INSERT',1500821766),(3,'sys_user_group',3,'arm_bms_2017_08.system_user_group_role','{\"action0\":1,\"action1\":1,\"action2\":1,\"action3\":1,\"action4\":1,\"action5\":1,\"action6\":1,\"task_id\":3,\"user_group_id\":\"1\",\"user_created\":\"1\",\"date_created\":1500821766}','1','INSERT',1500821766),(4,'sys_user_group',4,'arm_bms_2017_08.system_user_group_role','{\"action0\":1,\"action1\":1,\"action2\":1,\"action3\":1,\"action4\":1,\"action5\":1,\"action6\":1,\"task_id\":4,\"user_group_id\":\"1\",\"user_created\":\"1\",\"date_created\":1500821766}','1','INSERT',1500821766),(5,'sys_user_group',5,'arm_bms_2017_08.system_user_group_role','{\"action0\":1,\"action1\":1,\"action2\":1,\"action3\":1,\"action4\":1,\"action5\":1,\"action6\":1,\"task_id\":5,\"user_group_id\":\"1\",\"user_created\":\"1\",\"date_created\":1500821766}','1','INSERT',1500821766);
/*!40000 ALTER TABLE `system_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_history_hack`
--

DROP TABLE IF EXISTS `system_history_hack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_history_hack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT 'Active',
  `action_id` int(11) DEFAULT '99',
  `other_info` text,
  `date_created` int(11) DEFAULT '0',
  `date_created_string` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_history_hack`
--

LOCK TABLES `system_history_hack` WRITE;
/*!40000 ALTER TABLE `system_history_hack` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_history_hack` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_session`
--

DROP TABLE IF EXISTS `system_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_session` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `system_session_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_session`
--

LOCK TABLES `system_session` WRITE;
/*!40000 ALTER TABLE `system_session` DISABLE KEYS */;
INSERT INTO `system_session` VALUES ('ocq18i1bubv51egg6uo46jd28ra9an8q','::1',1500821715,'__ci_last_regenerate|i:1500821275;user_id|s:0:\"\";'),('pn9cl7vjdtklvhmt7fm3iu2nfshl230u','::1',1508395687,'__ci_last_regenerate|i:1508394913;user_id|s:0:\"\";'),('q7b4ecutvls2puvs22n47d6ptfkhdbp8','::1',1500821855,'__ci_last_regenerate|i:1500821719;user_id|s:1:\"1\";');
/*!40000 ALTER TABLE `system_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_site_offline`
--

DROP TABLE IF EXISTS `system_site_offline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_site_offline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(11) NOT NULL DEFAULT 'Active',
  `date_created` int(11) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_site_offline`
--

LOCK TABLES `system_site_offline` WRITE;
/*!40000 ALTER TABLE `system_site_offline` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_site_offline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_task`
--

DROP TABLE IF EXISTS `system_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'TASK',
  `parent` int(11) NOT NULL DEFAULT '0',
  `controller` varchar(500) NOT NULL,
  `ordering` smallint(6) NOT NULL DEFAULT '9999',
  `icon` varchar(255) NOT NULL DEFAULT 'menu.png',
  `status` varchar(11) NOT NULL DEFAULT 'Active',
  `date_created` int(11) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_updated` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_task`
--

LOCK TABLES `system_task` WRITE;
/*!40000 ALTER TABLE `system_task` DISABLE KEYS */;
INSERT INTO `system_task` VALUES (1,'System Settings','MODULE',0,'',1,'menu.png','Active',0,0,NULL,NULL),(2,'Module & Task','TASK',1,'Sys_module_task',1,'menu.png','Active',0,0,NULL,NULL),(3,'User Group','TASK',1,'Sys_user_group',2,'menu.png','Active',0,0,NULL,NULL),(4,'Users','TASK',1,'Sys_users',4,'menu.png','Active',0,0,NULL,NULL),(5,'Site Offline','TASK',1,'Sys_site_offline',5,'menu.png','Active',0,0,NULL,NULL);
/*!40000 ALTER TABLE `system_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_user_group`
--

DROP TABLE IF EXISTS `system_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'Active',
  `ordering` tinyint(4) NOT NULL DEFAULT '99',
  `date_created` int(11) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_updated` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_user_group`
--

LOCK TABLES `system_user_group` WRITE;
/*!40000 ALTER TABLE `system_user_group` DISABLE KEYS */;
INSERT INTO `system_user_group` VALUES (1,'Super Admin','Active',1,0,0,NULL,NULL),(2,'Admin','Active',1,0,0,NULL,NULL);
/*!40000 ALTER TABLE `system_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_user_group_role`
--

DROP TABLE IF EXISTS `system_user_group_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_user_group_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `action0` tinyint(4) NOT NULL DEFAULT '0',
  `action1` tinyint(4) NOT NULL DEFAULT '0',
  `action2` tinyint(4) NOT NULL DEFAULT '0',
  `action3` tinyint(4) NOT NULL DEFAULT '0',
  `action4` tinyint(4) NOT NULL DEFAULT '0',
  `action5` tinyint(4) NOT NULL DEFAULT '0',
  `action6` tinyint(4) NOT NULL DEFAULT '0',
  `revision` int(11) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_updated` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_user_group_role`
--

LOCK TABLES `system_user_group_role` WRITE;
/*!40000 ALTER TABLE `system_user_group_role` DISABLE KEYS */;
INSERT INTO `system_user_group_role` VALUES (1,1,3,1,1,1,1,1,1,1,2,0,0,1500821766,1),(2,1,2,1,1,1,1,1,1,1,1,1500821766,1,NULL,NULL),(3,1,3,1,1,1,1,1,1,1,1,1500821766,1,NULL,NULL),(4,1,4,1,1,1,1,1,1,1,1,1500821766,1,NULL,NULL),(5,1,5,1,1,1,1,1,1,1,1,1500821766,1,NULL,NULL);
/*!40000 ALTER TABLE `system_user_group_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-19 12:51:15
