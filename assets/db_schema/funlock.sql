-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2013 at 09:27 PM
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_fname` varchar(35) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `book_sname` varchar(35) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `appointment` int(11) NOT NULL,
  `payment_option` varchar(20) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `bill_fname` varchar(35) CHARACTER SET utf8 COLLATE utf8_hungarian_ci DEFAULT NULL,
  `bill_sname` varchar(35) CHARACTER SET utf8 COLLATE utf8_hungarian_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci DEFAULT NULL,
  `street` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci DEFAULT NULL,
  `house` int(11) DEFAULT NULL,
  `tax_number` int(11) DEFAULT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_hungarian_ci,
  `notes` text CHARACTER SET utf8 COLLATE utf8_hungarian_ci,
  `booking_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `book_fname`, `book_sname`, `appointment`, `payment_option`, `bill_fname`, `bill_sname`, `email`, `zip`, `city`, `street`, `house`, `tax_number`, `comment`, `notes`, `booking_date`) VALUES
(1, 'Funky', 'Monkey', 1365678000, 'card', '', '', '', 0, NULL, NULL, NULL, 0, '', '', 1367917200),
(3, 'Daniel', 'Jackson', 1365523200, 'card', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365518640),
(4, 'Hank', 'Moodey', 1365613200, 'cache', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365519360),
(5, 'Billy', 'Bob', 1365696000, 'cache', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365519360),
(6, 'Funky', 'Monkey', 1365699600, 'card', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365606480),
(7, 'Daniel', 'Monkey', 1365786000, 'card', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365606480),
(8, 'Hank', 'Monkey', 1366038000, 'card', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365606540),
(9, 'Funky', 'Jackson', 1365764400, 'card', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365606720),
(10, 'Hank', 'Bob', 1365872400, 'card', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365697140),
(11, 'Funky', 'Monkey', 1365778800, 'cache', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365698760),
(12, 'Daniel', 'Monkey', 1365706800, 'cache', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365698760),
(13, 'Bob', 'Monkey', 1365796800, 'card', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365701220),
(14, 'Billy', 'Monkey', 1365858000, 'card', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365701280);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `option_name` text COLLATE utf8_hungarian_ci NOT NULL,
  `value` text COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`option_name`, `value`) VALUES
('admin_password', '8cb2237d0679ca88db6464eac60da96345513964');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
