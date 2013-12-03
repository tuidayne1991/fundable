-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2013 at 06:11 AM
-- Server version: 5.5.34-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fundy`
--

-- --------------------------------------------------------

--
-- Table structure for table `fundy_user`
--

CREATE TABLE IF NOT EXISTS `fundy_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fundy_user`
--

INSERT INTO `fundy_user` (`id`, `email`, `password`, `is_activated`) VALUES
(1, 'tuidayne1991@gmail.com', 'e99a18c428cb38d5f260853678922e03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `money_box`
--

CREATE TABLE IF NOT EXISTS `money_box` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `balance` double NOT NULL,
  `capacity` double NOT NULL,
  `currency` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id_3` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `money_box`
--

INSERT INTO `money_box` (`id`, `owner_id`, `balance`, `capacity`, `currency`) VALUES
(5, 1, 4234, 3123, 'asda'),
(6, 1, 1312, 123124, '1231sasa'),
(7, 1, 4234, 123214, 'dasdas'),
(8, 1, 100, 50, 'sfsdf'),
(9, 1, 500, 10, 'sdfsdfs'),
(10, 1, 4234, 12321, 'd23d23d'),
(11, 1, 4234, 1, 'addas'),
(12, 1, 0, 543, 'fvdsvsd');

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `owner_id` (`owner_id`),
  UNIQUE KEY `box_id` (`box_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `money_box`
--
ALTER TABLE `money_box`
  ADD CONSTRAINT `money_box_user_constraint` FOREIGN KEY (`owner_id`) REFERENCES `fundy_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_box_constraint` FOREIGN KEY (`box_id`) REFERENCES `money_box` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_user_constraint` FOREIGN KEY (`owner_id`) REFERENCES `fundy_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
