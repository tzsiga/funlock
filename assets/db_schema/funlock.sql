-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2013 at 08:44 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=141 ;

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
('admin_password', '78f366c6f4aa3686245e4b2729bd0c9ab93d6c2a'),
('booking_limit', '3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
