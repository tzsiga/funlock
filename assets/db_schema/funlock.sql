-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 14, 2013 at 08:07 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `funlock`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(10) COLLATE utf8_hungarian_ci NOT NULL DEFAULT 'active',
  `book_fname` varchar(35) COLLATE utf8_hungarian_ci NOT NULL,
  `book_sname` varchar(35) COLLATE utf8_hungarian_ci NOT NULL,
  `appointment` int(11) NOT NULL,
  `payment_option` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `bill_fname` varchar(35) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `bill_sname` varchar(35) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `zip` int(4) DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `street` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `house` varchar(10) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `tax_number` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_hungarian_ci NOT NULL,
  `notes` text COLLATE utf8_hungarian_ci NOT NULL,
  `booking_date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `appointment` (`appointment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `status`, `book_fname`, `book_sname`, `appointment`, `payment_option`, `bill_fname`, `bill_sname`, `email`, `phone`, `zip`, `city`, `street`, `house`, `tax_number`, `comment`, `notes`, `booking_date`) VALUES
(1, 'active', 'Funky', 'Bob', 1374066000, 'card', '', '', 'tzsiga@gmail.com', '2571657', 1234, 'Budapest', 'sfd', '33', 0, '', '', 1373353468),
(2, 'active', 'Hank', 'Jackson', 1373887800, 'card', '', '', 'admin@admin.com', '2571657', 1234, 'Budapest', 'dsad', '33', 0, '', '', 1373353401),
(3, 'active', 'Billy', 'Jackson', 1373742000, 'cache', '', '', 'tzsiga@gmail.com', '2571657', 1234, 'Budapest', 'fsd', '33', 0, '', '', 1373353346),
(4, 'active', 'Funky', 'Bob', 1374319800, 'cache', '', '', 'admin@admin.com', '2571657', 2134, 'Budapest', 'sfd', '432', 0, '', '', 1373353517),
(5, 'active', 'Hank', 'Bob', 1373828400, 'cache', '', '', 'tzsiga@gmail.com', '2571657', 2332, 'Budapest', 'dsf', '33', 0, '', '', 1373353389),
(10, 'active', 'Funky', 'Bob', 1373472000, 'card', '', '', 'tzshl@freemail.hu', '2571657', 1122, 'Budapest', 'asd', '12', 0, '', '', 1373353310),
(12, 'active', 'Daniel', 'Moodey', 1374152400, 'card', '', '', 'tzshl@freemail.hu', '2571657', 1234, 'Budapest', 'fds', '556', 0, '', '', 1373353506),
(13, 'active', 'Hank', 'Moodey', 1373968800, 'card', '', '', 'tzshl@freemail.hu', '2571657', 2322, 'Budapest', 'dsf', '11', 0, '', '', 1373353412),
(14, 'active', 'Hank', 'Moodey', 1373569200, 'card', '', '', 'admin@admin.com', '2571657', 1234, 'Budapest', 'asd', '11', 0, '', '', 1373353491),
(15, 'active', 'Hanky', 'Papa', 1373796000, 'cache', '', '', '', '', 0, '', '', '0', 0, '', '', 1373608734),
(16, '', 'Hanky', 'Papa', 1373715000, 'card', '', '', '', '', 0, '', '', '0', 0, '', '', 1373609028),
(18, '', 'Hanky', 'Papa', 1373817600, 'cache', '', '', '', '', 0, '', '', '', 0, '', '', 1373610180),
(19, 'active', 'Hanky', 'Papa', 1373731200, 'cache', '', '', '', '', 0, '', '', '', 0, '', '', 1373610204),
(20, 'active', 'Hanky', 'Papa', 1373823000, 'cache', '', '', '', '', 0, '', '', '', 0, '', '', 1373611939),
(21, 'active', 'Hanky', 'Papa', 1373736600, 'cache', '', '', '', '', 0, '', '', '', 0, '', '', 1373612225),
(22, 'active', 'Hanky', 'Papa', 1374438600, 'cache', '', '', '', '', 0, '', '', '', 0, '', '', 1373624369),
(23, '', 'Hanky', 'Papa', 1374487200, 'cache', '', '', '', '', 0, '', '', '', 0, '', '', 1373639228),
(24, 'active', 'Hanky', 'Papa', 1375043400, 'cache', '', '', '', '', 0, '', '', '', 0, '', '', 1373625262),
(25, 'active', '', '', 1373720400, 'cache', '', '', '', '', 0, '', '', '', 0, '', '', 1373637911),
(26, 'active', '', '', 1373806800, 'cache', '', '', '', '', 0, '', '', '', 0, '', '', 1373637965),
(27, '', '', '', 1373801400, 'cache', '', '', '', '', 0, '', '', '', 0, '', '', 1373793948);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` text COLLATE utf8_hungarian_ci NOT NULL,
  `value` text COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `option_name`, `value`) VALUES
(1, 'admin_password', '78f366c6f4aa3686245e4b2729bd0c9ab93d6c2a'),
(2, 'booking_limit', '6');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE IF NOT EXISTS `vouchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_hungarian_ci NOT NULL,
  `create_date` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8_hungarian_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=70 ;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `create_date`, `status`) VALUES
(55, '07DB01DE', 1373522955, 'active'),
(58, '0AD7025F', 1373523126, 'active'),
(59, '07F801DD', 1373523131, 'active'),
(60, '099A0236', 1373523139, 'active'),
(61, 'DF104E80', 1373523167, 'active'),
(62, 'A82009C0', 1373523169, 'active'),
(63, '292001C0', 1373523171, 'active'),
(64, 'C5204090', 1373523173, 'active'),
(65, '8020CA80', 1373523177, 'active'),
(66, 'C2209E90', 1373523181, 'active'),
(67, '33208AA0', 1373523184, 'active'),
(68, '5D10B880', 1373523187, 'active'),
(69, 'd3726a22b7', 1373523308, 'active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
