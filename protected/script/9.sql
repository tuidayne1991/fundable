-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2013 at 11:26 PM
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
(55, 35, 'DASD', 'SADSAD', '2013-12-10 17:21:09', 1197, '0000-00-00 00:00:00', 1, '2013-12-10 17:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `AuthAssignment`
--

CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('member', '36', 'return !Yii::app()->user->isGuest && in_array(Yii::app()->user->_id, $params["group"]->getMemberIds());', 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `AuthItem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('aaa', 1, 'group aaa', NULL, 'N;'),
('authenticated', 2, '', NULL, 'N;'),
('member', 2, '', NULL, 'N;'),
('viewGroupInternal', 0, 'view Group Internal', 'return !Yii::app()->user->isGuest && in_array(Yii::app()->user->_id, $params["group"]->getMemberIds());', 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `AuthItemChild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AuthItemChild`
--

INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES
('authenticated', 'aaa'),
('aaa', 'viewGroupInternal');

-- --------------------------------------------------------

--
-- Table structure for table `connection`
--

CREATE TABLE IF NOT EXISTS `connection` (
  `group_1_id` int(11) NOT NULL,
  `group_2_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  KEY `group_1_id` (`group_1_id`),
  KEY `group_2_id` (`group_2_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `owner_id`, `name`, `type`, `location`, `start_time`, `end_time`, `description`) VALUES
(10, 7, 'Hello', 'group_event', 'Abc', '2013-12-14 03:59:00', '2013-12-15 03:59:00', 'abcdef'),
(11, 7, 'dasdasdasd', 'group_event', 'asdasdas', '2013-12-13 04:00:00', '2013-12-13 04:00:00', 'dasdas');

-- --------------------------------------------------------

--
-- Table structure for table `fundy_user`
--

CREATE TABLE IF NOT EXISTS `fundy_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'VND',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  `unique_id` text COLLATE utf8_unicode_ci NOT NULL,
  `activation_code` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `fundy_user`
--

INSERT INTO `fundy_user` (`id`, `email`, `name`, `currency`, `password`, `is_activated`, `unique_id`, `activation_code`) VALUES
(35, 'ctt.bk.hcmut2009@gmail.com', 'Thanh Cao', 'VND', 'e99a18c428cb38d5f260853678922e03', 1, '52a218d456fea', 'ics882v8um'),
(36, 'tuidayne1991@gmail.com', 'tuidayne', 'VND', 'e99a18c428cb38d5f260853678922e03', 1, '52a219308a828', 'zwar00aucy'),
(37, 'abc123@gmail.com', 'abc', 'VND', 'e99a18c428cb38d5f260853678922e03', 1, '52ab04a531678', 'rvi58rjjap');

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
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`group_id`,`user_id`),
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_user`
--

INSERT INTO `group_user` (`group_id`, `user_id`, `type`, `status`) VALUES
(6, 35, 'owner', 'confirmed'),
(7, 35, 'owner', 'confirmed'),
(7, 36, 'member', 'pending'),
(7, 37, 'member', 'pending');

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
-- Constraints for table `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `AuthItemChild`
--
ALTER TABLE `AuthItemChild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `connection`
--
ALTER TABLE `connection`
  ADD CONSTRAINT `group_connection_1_constraint` FOREIGN KEY (`group_1_id`) REFERENCES `group` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_connection_2_constraint` FOREIGN KEY (`group_2_id`) REFERENCES `group` (`id`) ON DELETE CASCADE;

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
