-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2013 at 11:08 PM
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
  `phone` varchar(50) NOT NULL,
  `zip` int(11) DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci DEFAULT NULL,
  `street` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci DEFAULT NULL,
  `house` int(11) DEFAULT NULL,
  `tax_number` int(11) DEFAULT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_hungarian_ci,
  `notes` text CHARACTER SET utf8 COLLATE utf8_hungarian_ci,
  `booking_date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `appointment` (`appointment`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `book_fname`, `book_sname`, `appointment`, `payment_option`, `bill_fname`, `bill_sname`, `email`, `phone`, `zip`, `city`, `street`, `house`, `tax_number`, `comment`, `notes`, `booking_date`) VALUES
(1, 'Funky', 'Monkey', 1365678000, 'card', '', '', '', '', 0, NULL, NULL, NULL, 0, '', '', 1367917200),
(3, 'Daniel', 'Jackson', 1365523200, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365518640),
(4, 'Hank', 'Moodey', 1365613200, 'cache', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365519360),
(5, 'Billy', 'Bob', 1365696000, 'cache', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365519360),
(6, 'Funky', 'Monkey', 1365699600, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365606480),
(7, 'Daniel', 'Monkey', 1365786000, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365606480),
(8, 'Hank', 'Monkey', 1366038000, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365606540),
(9, 'Funky', 'Jackson', 1365764400, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365606720),
(10, 'Hank', 'Bob', 1365881400, 'cache', '', '', '', '', 0, NULL, NULL, NULL, 0, '', '', 1365697140),
(11, 'Funky', 'Monkey', 1365778800, 'cache', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365698760),
(12, 'Daniel', 'Monkey', 1365706800, 'cache', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365698760),
(13, 'Bob', 'Monkey', 1365796800, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365701220),
(14, 'Billy', 'Monkey', 1366313400, 'card', '', '', '', '', 0, NULL, NULL, NULL, 0, '', '', 1365701280),
(15, 'Daniel', 'Monkey', 1365962400, 'card', '', '', '', '', 0, NULL, NULL, NULL, 0, '', '', 1365842880),
(16, 'Billy', 'Jackson', 1365957000, 'card', '', '', '', '', 0, NULL, NULL, NULL, 0, '', '', 1365855780),
(18, 'Tony', 'Stark', 1366135200, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365857580),
(21, 'Eddie', 'Stark', 1366221600, 'cache', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365857700),
(22, 'Funky', 'Moodey', 1366389000, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365857820),
(23, 'Billy', 'Jackson', 1366567200, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365946080),
(24, 'Funky', 'Bob', 1366556400, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365946380),
(25, 'ads', 'dsa', 1366561800, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365946680),
(26, 'Billy', 'Bob', 1366734600, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365946680),
(27, 'Billy', 'Jackson', 1366821000, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365946740),
(28, 'Billy', 'Jackson', 1366907400, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365947280),
(31, 'Funky', 'Bob', 1366394400, 'cache', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365948600),
(58, 'Billy', 'Jackson', 1366993800, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365948660),
(71, 'Funky', 'Jackson', 1367080200, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365950040),
(81, 'Funky', 'Jackson', 1366308000, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365950820),
(83, 'Funky', 'Jackson', 1367074800, 'cache', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365950820),
(88, 'Funky', 'Bob', 1366551000, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365951060),
(105, 'Funky', 'Bob', 1367253000, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365952380),
(107, 'Billy', 'Jackson', 1367247600, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365953340),
(109, 'Billy', 'Bob', 1367258400, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365954060),
(111, 'Billy', 'Jackson', 1367263800, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365954240),
(113, 'Foglalt', 'Ferenc', 1367334000, 'card', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1365954780);

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
