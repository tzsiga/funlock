-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 27, 2013 at 11:58 PM
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
  `book_fname` varchar(35) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `book_sname` varchar(35) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `appointment` int(11) NOT NULL,
  `payment_option` varchar(20) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `bill_fname` varchar(35) CHARACTER SET utf8 COLLATE utf8_hungarian_ci DEFAULT NULL,
  `bill_sname` varchar(35) CHARACTER SET utf8 COLLATE utf8_hungarian_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `zip` int(11) DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci DEFAULT NULL,
  `street` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci DEFAULT NULL,
  `house` int(11) DEFAULT NULL,
  `tax_number` int(11) DEFAULT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_hungarian_ci,
  `notes` text CHARACTER SET utf8 COLLATE utf8_hungarian_ci,
  `booking_date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `appointment` (`appointment`),
  KEY `appointment_2` (`appointment`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `book_fname`, `book_sname`, `appointment`, `payment_option`, `bill_fname`, `bill_sname`, `email`, `phone`, `zip`, `city`, `street`, `house`, `tax_number`, `comment`, `notes`, `booking_date`) VALUES
(1, 'Funky', 'Bob', 1372510800, 'card', '', '', 'tzsiga@gmail.com', '2571657', 1234, 'Budapest', 'sfd', 33, 0, '', '', 1371982293),
(2, 'Hank', 'Jackson', 1372591800, 'card', '', '', 'admin@admin.com', '2571657', 1234, 'Budapest', 'dsad', 33, 0, '', '', 1372229717),
(3, 'Billy', 'Jackson', 1372618800, 'cache', '', '', 'tzsiga@gmail.com', '2571657', 1234, 'Budapest', 'fsd', 33, 0, '', '', 1372015907),
(4, 'Funky', 'Bob', 1372068000, 'cache', '', '', 'admin@admin.com', '2571657', 2134, 'Budapest', 'sfd', 432, 0, '', '', 1371991739),
(5, 'Hank', 'Bob', 1372446000, 'cache', '', '', 'tzsiga@gmail.com', '2571657', 2332, 'Budapest', 'dsf', 33, 0, '', '', 1371991666),
(10, 'Funky', 'Bob', 1372262400, 'card', '', '', 'tzshl@freemail.hu', '2571657', 1122, 'Budapest', 'asd', 12, 0, '', '', 1371982234),
(11, 'Funky', 'Jackson', 1372354200, 'card', '', '', 'tzsiga@gmail.com', '2571657', 3333, 'sa', 'fds', 3, 0, NULL, NULL, 1371982250),
(12, 'Daniel', 'Moodey', 1372024800, 'card', '', '', 'tzshl@freemail.hu', '2571657', 1234, 'Budapest', 'fds', 556, 0, NULL, NULL, 1371933135),
(13, 'Hank', 'Moodey', 1372170600, 'card', '', '', 'tzshl@freemail.hu', '2571657', 2322, 'Budapest', 'dsf', 11, 0, NULL, NULL, 1371978977),
(14, 'Hank', 'Moodey', 1372532400, 'card', '', '', 'admin@admin.com', '2571657', 1234, 'Budapest', 'asd', 11, 0, NULL, NULL, 1372313392);

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
(2, 'booking_limit', '5');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `create_date`, `status`) VALUES
(1, '828953', 1372368714, 'active'),
(3, '02694c', 1372370058, 'active'),
(4, 'dc167b', 1372370126, 'active'),
(5, '0d995a', 1372370130, 'active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
