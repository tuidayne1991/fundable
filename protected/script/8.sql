-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2013 at 07:49 AM
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fundy`
--
CREATE DATABASE IF NOT EXISTS `fundy` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fundy`;

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `begin_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `duration` int(11) NOT NULL,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `action_user_constraint` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id`, `owner_id`, `name`, `description`, `begin_time`, `duration`, `end_time`, `status`, `created_at`) VALUES
(48, 35, 'abc', 'abc', '2013-12-10 16:31:28', 2058, '0000-00-00 00:00:00', 1, '2013-12-10 16:31:28'),
(53, 35, 'adasd', 'asdasdas', '2013-12-10 16:44:50', 1316, '0000-00-00 00:00:00', 0, '2013-12-10 16:44:50'),
(54, 35, 'hfgh', 'gfhfhfg', '2013-12-10 16:47:04', 2135, '0000-00-00 00:00:00', 1, '2013-12-10 16:47:04'),
(55, 35, 'DASD', 'SADSAD', '2013-12-10 17:21:09', 714, '0000-00-00 00:00:00', 1, '2013-12-10 17:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `location` text NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `owner_id`, `name`, `type`, `location`, `date`, `start_time`, `end_time`, `description`) VALUES
(1, 7, 'sdfds', 'group_event', '', '0000-00-00', '00:00:00', '00:00:00', 'fdsfsd'),
(2, 7, 'Google Event', 'group_event', '', '0000-00-00', '00:00:00', '00:00:00', 'dasdasdasda'),
(3, 7, 'das', 'group_event', '', '0000-00-00', '00:00:00', '00:00:00', 'dsadsadas');

-- --------------------------------------------------------

--
-- Table structure for table `fundy_user`
--

CREATE TABLE IF NOT EXISTS `fundy_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'VND',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  `unique_id` text COLLATE utf8_unicode_ci NOT NULL,
  `activation_code` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `fundy_user`
--

INSERT INTO `fundy_user` (`id`, `email`, `currency`, `password`, `is_activated`, `unique_id`, `activation_code`) VALUES
(35, 'ctt.bk.hcmut2009@gmail.com', 'VND', 'e99a18c428cb38d5f260853678922e03', 1, '52a218d456fea', 'ics882v8um'),
(36, 'tuidayne1991@gmail.com', 'VND', 'e99a18c428cb38d5f260853678922e03', 1, '52a219308a828', 'zwar00aucy');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `description`) VALUES
(6, 'A', 'A'),
(7, 'GDG', 'GDG Group');

-- --------------------------------------------------------

--
-- Table structure for table `group_user`
--

CREATE TABLE IF NOT EXISTS `group_user` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_user`
--

INSERT INTO `group_user` (`group_id`, `user_id`, `type`) VALUES
(6, 35, 'owner'),
(7, 35, 'owner');

-- --------------------------------------------------------

--
-- Table structure for table `money_box`
--

CREATE TABLE IF NOT EXISTS `money_box` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `source` text COLLATE utf8_unicode_ci NOT NULL,
  `balance` double NOT NULL,
  `currency` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id_3` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `money_box`
--

INSERT INTO `money_box` (`id`, `owner_id`, `source`, `balance`, `currency`) VALUES
(20, 36, 'Dong A', 15000, 'VND'),
(22, 35, 'Vietcombank', 10000000000, 'VND');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `box_id` int(11) NOT NULL,
  `money` double NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `currency` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  KEY `box_id` (`box_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `owner_id`, `box_id`, `money`, `type`, `description`, `currency`, `created_at`) VALUES
(21, 36, 20, 10, 0, '', '', '2013-12-07 09:11:11'),
(22, 36, 20, 10, 1, '', '', '2013-12-07 09:11:24'),
(23, 36, 20, 20, 1, '', '', '2013-12-07 09:13:35'),
(28, 35, 22, 432423423, 1, 'asdasdsadsadas', '', '2013-12-10 15:30:43'),
(29, 35, 22, 4324324, 0, 'dasdsa', '', '2013-12-10 15:32:29');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `action_user_constraint` FOREIGN KEY (`owner_id`) REFERENCES `fundy_user` (`id`);

--
-- Constraints for table `group_user`
--
ALTER TABLE `group_user`
  ADD CONSTRAINT `group_constraint` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_constraint` FOREIGN KEY (`user_id`) REFERENCES `fundy_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `money_box`
--
ALTER TABLE `money_box`
  ADD CONSTRAINT `money_box_user_constraint` FOREIGN KEY (`owner_id`) REFERENCES `fundy_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `fundy_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
