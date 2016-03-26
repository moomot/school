-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2016 at 10:38 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`, `status`, `uid`) VALUES
(1, 'admin', 'effc1aec7db3759b5ca360d35ce9826b', 1, 5),
(3, 'new', '5q4n1q2p', 1, 6),
(6, 'roma', 'c4ca4238a0b923820dcc509a6f75849b', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

DROP TABLE IF EXISTS `lectures`;
CREATE TABLE `lectures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL,
  `name` text CHARACTER SET cp1251 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `number`, `name`) VALUES
(1, 1, 'Lection 1. Name of the lecture?'),
(5, 2, 'Lecture 2'),
(9, 3, 'Lecture 3');

-- --------------------------------------------------------

--
-- Table structure for table `private_messages`
--

DROP TABLE IF EXISTS `private_messages`;
CREATE TABLE `private_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(10) NOT NULL,
  `user_read` tinyint(1) NOT NULL DEFAULT '0',
  `school_read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Dumping data for table `private_messages`
--

INSERT INTO `private_messages` (`id`, `user_id`, `user2_id`, `message`, `timestamp`, `user_read`, `school_read`) VALUES
(1, 2, 5, 'bla bla bla bla', 1457304036, 0, 0),
(2, 5, 3, 'И так, вот и долгожданный мастер-класс от нашей студии для веб-дизайнеров! Смотрите, комментируйте, делитесь с друзьями! Будем рады любой поддержке!? \nНадеемся, что у нас получилось Вас порадовать\nПриятного просмотра!И так, вот и долгожданный мастер-класс от нашей студии для веб-дизайнеров! Смотрите, комментируйте, делитесь с друзьями! Будем рады любой поддержке!? \nНадеемся, что у нас получилось Вас порадовать\nПриятного просмотра!И так, вот и долгожданный мастер-класс от нашей студии для веб-дизайнеров! Смотрите, комментируйте, делитесь с друзьями! Будем рады любой поддержке!? \nНадеемся, что у нас получилось Вас порадовать\nПриятного просмотра!И так, вот и долгожданный мастер-класс от нашей студии для веб-дизайнеров! Смотрите, комментируйте, делитесь с друзьями! Будем рады любой поддержке!? \nНадеемся, что у нас получилось Вас порадовать\nПриятного просмотра!', 1457304035, 0, 0),
(3, 5, 1, 'ура.', 1457733939, 0, 0),
(4, 5, 3, 'sdfsdfdfs', 1457817731, 0, 0),
(5, 5, 1, 'sdfsdffsd', 1457817746, 0, 0),
(6, 5, 2, 'sdf,sdflsd', 1457956172, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lecture` int(11) NOT NULL,
  `question` text CHARACTER SET cp1251 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `lecture`, `question`) VALUES
(4, 2, 'fdwffr451'),
(5, 2, '432'),
(7, 1, 'Питання 1'),
(9, 1, 'gf'),
(10, 2, '.!.');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `login` varchar(25) DEFAULT NULL,
  `address` text NOT NULL,
  `password` text CHARACTER SET cp1250 NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `phone` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(45) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `login`, `address`, `password`, `full_name`, `status`, `phone`, `description`, `email`, `uid`) VALUES
(6, 'fsdfsdfsdkiko', '333333333333333333', '33333333333333333333333333333333', '333333333333333333', 1, '33333333333333333333', '3333333333333333333333333333333333', 'moomot@ukr.net', 2),
(8, 'kiko', 'dasfsdfsdfsdfs', 'effc1aec7db3759b5ca360d35ce9826b', 'dsfksdsdfkfsdk', 1, '32423423', 'kfsdlfkdslkdfsl', 'moomot@ukr.net', 8);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `param` varchar(100) NOT NULL,
  `val` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `param`, `val`) VALUES
(1, 'title', 'Автошкола'),
(2, 'description', 'описание'),
(5, 'template', 'candy'),
(6, 'onReconstruction', '0'),
(7, 'reconstructionReason', '');

-- --------------------------------------------------------

--
-- Table structure for table `static_pages`
--

DROP TABLE IF EXISTS `static_pages`;
CREATE TABLE `static_pages` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `comments_status` tinyint(1) NOT NULL DEFAULT '0',
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Dumping data for table `static_pages`
--

INSERT INTO `static_pages` (`id`, `title`, `content`, `date`, `status`, `comments_status`, `url`) VALUES
(1, 'Про нас', 'Зеркала сделал??\r\nСегодня решил заняться чисткой цепи.....\r\nСнимается очень легко...самое главное-снял-- соединитель собрал --его почистил и положил в надёжное место-потерять очень просто.....искал полчаса....ушло поллитра бенза и понадобилась щётка(в магазе попалась с железной ворсой за14 гр-вот ей и чистил...), чтоб поставить цепь обратно пришлось снимать защиту цепи и передней звёздочки....потом протёр тряпочкой , установил и смазал..\r\n\r\nОбнаружил что передняя звезда имеет люфт где-то 1-1.5мм вдоль оси-я так понимаю-что этого не должно быть????болты на ней зажаты, если люфта не должно быть-можт шайбу подложить????', '2016-01-12 03:11:11', 1, 0, 'about');

-- --------------------------------------------------------

--
-- Table structure for table `unical_users_id`
--

DROP TABLE IF EXISTS `unical_users_id`;
CREATE TABLE `unical_users_id` (
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Dumping data for table `unical_users_id`
--

INSERT INTO `unical_users_id` (`uid`) VALUES
(10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(25) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `address` text,
  `school_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `password` text NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `firstname`, `lastname`, `address`, `school_id`, `status`, `password`, `uid`) VALUES
(1, 'user_login', 'user_firstname', 'user_lastname', 'user_address', 6, 1, 'effc1aec7db3759b5ca360d35ce9826b', 4);

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

DROP TABLE IF EXISTS `variants`;
CREATE TABLE `variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` bigint(20) UNSIGNED NOT NULL,
  `answer` text CHARACTER SET cp1251 NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `question`, `answer`, `correct`) VALUES
(1, 4, 'er', 0),
(3, 4, 'r3', 1),
(4, 7, 'вараиант', 1),
(5, 7, 'выаыва', 0),
(6, 7, '12', 0),
(7, 9, 'tref', 1),
(8, 9, 't', 1),
(9, 9, '23', 0),
(10, 9, '453', 0),
(11, 7, '12', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`number`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `private_messages`
--
ALTER TABLE `private_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `lection` (`lecture`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_pages`
--
ALTER TABLE `static_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `question` (`question`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `private_messages`
--
ALTER TABLE `private_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `static_pages`
--
ALTER TABLE `static_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `lecture_fk` FOREIGN KEY (`lecture`) REFERENCES `lectures` (`number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `variants`
--
ALTER TABLE `variants`
  ADD CONSTRAINT `question` FOREIGN KEY (`question`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
