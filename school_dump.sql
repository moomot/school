-- MySQL dump 10.16  Distrib 10.1.10-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: school_cms
-- ------------------------------------------------------
-- Server version	10.1.10-MariaDB

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','effc1aec7db3759b5ca360d35ce9826b',1,5),(3,'new','5q4n1q2p',1,6);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `private_messages`
--

DROP TABLE IF EXISTS `private_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `private_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(10) NOT NULL,
  `user_read` tinyint(1) NOT NULL DEFAULT '0',
  `school_read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=cp1251;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `private_messages`
--

LOCK TABLES `private_messages` WRITE;
/*!40000 ALTER TABLE `private_messages` DISABLE KEYS */;
INSERT INTO `private_messages` VALUES (1,2,5,'bla bla bla bla',1457304036,0,0),(2,5,3,'И так, вот и долгожданный мастер-класс от нашей студии для веб-дизайнеров! Смотрите, комментируйте, делитесь с друзьями! Будем рады любой поддержке!? \nНадеемся, что у нас получилось Вас порадовать\nПриятного просмотра!И так, вот и долгожданный мастер-класс от нашей студии для веб-дизайнеров! Смотрите, комментируйте, делитесь с друзьями! Будем рады любой поддержке!? \nНадеемся, что у нас получилось Вас порадовать\nПриятного просмотра!И так, вот и долгожданный мастер-класс от нашей студии для веб-дизайнеров! Смотрите, комментируйте, делитесь с друзьями! Будем рады любой поддержке!? \nНадеемся, что у нас получилось Вас порадовать\nПриятного просмотра!И так, вот и долгожданный мастер-класс от нашей студии для веб-дизайнеров! Смотрите, комментируйте, делитесь с друзьями! Будем рады любой поддержке!? \nНадеемся, что у нас получилось Вас порадовать\nПриятного просмотра!',1457304035,0,0),(3,5,1,'ура.',1457733939,0,0),(4,5,3,'sdfsdfdfs',1457817731,0,0),(5,5,1,'sdfsdffsd',1457817746,0,0),(6,5,2,'sdf,sdflsd',1457956172,0,0);
/*!40000 ALTER TABLE `private_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) DEFAULT NULL,
  `address` text NOT NULL,
  `password` text CHARACTER SET cp1250 NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `phone` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(45) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=cp1251;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
INSERT INTO `schools` VALUES (6,'fsdfsdfsdkiko','333333333333333333','33333333333333333333333333333333','333333333333333333',1,'33333333333333333333','3333333333333333333333333333333333','moomot@ukr.net',2),(7,'kiko','33333333333333333333','effc1aec7db3759b5ca360d35ce9826b','33333333333333',1,'33333333333333333333','3333333333333','moomot@ukr.ne',3),(8,'mymy','dasfsdfsdfsdfs','f5bb0c8de146c67b44babbf4e6584cc0','dsfksdsdfkfsdk',1,'32423423','kfsdlfkdslkdfsl','moomot@ukr.net',8);
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `param` varchar(100) NOT NULL,
  `val` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=cp1251;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'title','Автошкола'),(2,'description','описание'),(5,'template','candy'),(6,'onReconstruction','0'),(7,'reconstructionReason','');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `static_pages`
--

DROP TABLE IF EXISTS `static_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `static_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `comments_status` tinyint(1) NOT NULL DEFAULT '0',
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `static_pages`
--

LOCK TABLES `static_pages` WRITE;
/*!40000 ALTER TABLE `static_pages` DISABLE KEYS */;
INSERT INTO `static_pages` VALUES (1,'Про нас','Зеркала сделал??\r\nСегодня решил заняться чисткой цепи.....\r\nСнимается очень легко...самое главное-снял-- соединитель собрал --его почистил и положил в надёжное место-потерять очень просто.....искал полчаса....ушло поллитра бенза и понадобилась щётка(в магазе попалась с железной ворсой за14 гр-вот ей и чистил...), чтоб поставить цепь обратно пришлось снимать защиту цепи и передней звёздочки....потом протёр тряпочкой , установил и смазал..\r\n\r\nОбнаружил что передняя звезда имеет люфт где-то 1-1.5мм вдоль оси-я так понимаю-что этого не должно быть????болты на ней зажаты, если люфта не должно быть-можт шайбу подложить????','2016-01-12 03:11:11',1,0,'about');
/*!40000 ALTER TABLE `static_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unical_users_id`
--

DROP TABLE IF EXISTS `unical_users_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unical_users_id` (
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unical_users_id`
--

LOCK TABLES `unical_users_id` WRITE;
/*!40000 ALTER TABLE `unical_users_id` DISABLE KEYS */;
INSERT INTO `unical_users_id` VALUES (9);
/*!40000 ALTER TABLE `unical_users_id` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `address` text,
  `school_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `password` text NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'user_login','user_firstname','user_lastname','user_address',6,1,'effc1aec7db3759b5ca360d35ce9826b',4);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-17  0:08:36
