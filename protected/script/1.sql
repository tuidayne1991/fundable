-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2013 at 11:20 AM
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
CREATE DATABASE IF NOT EXISTS `fundy` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `fundy`;

-- --------------------------------------------------------

--
-- Table structure for table `fundy_user`
--

CREATE TABLE IF NOT EXISTS `fundy_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  `unique_id` text COLLATE utf8_unicode_ci NOT NULL,
  `activation_code` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `fundy_user`
--

INSERT INTO `fundy_user` (`id`, `email`, `password`, `is_activated`, `unique_id`, `activation_code`) VALUES
(8, 'ctt.bk.hcmut2009@gmail.com', 'e99a18c428cb38d5f260853678922e03', 0, '52a1a2989c2fc', 'ycgwh8ggvj');

-- --------------------------------------------------------

--
-- Table structure for table `money_box`
--

CREATE TABLE IF NOT EXISTS `money_box` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `source` text COLLATE utf8_unicode_ci NOT NULL,
  `balance` double NOT NULL,
  `capacity` double NOT NULL,
  `currency` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id_3` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `Transaction`
--

CREATE TABLE IF NOT EXISTS `Transaction` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `money_box`
--
ALTER TABLE `money_box`
  ADD CONSTRAINT `money_box_user_constraint` FOREIGN KEY (`owner_id`) REFERENCES `fundy_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Transaction`
--
ALTER TABLE `Transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `fundy_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
