-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2013 at 05:07 PM
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
-- Table structure for table `billing_data`
--

CREATE TABLE IF NOT EXISTS `billing_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forename` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `zip` int(11) NOT NULL,
  `city` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `tax_number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forename` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `appointment` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `payment_option` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `billing_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `forename`, `surname`, `appointment`, `payment_option`, `billing_id`) VALUES
(1, 'Billy', 'Bob', '1364479200', 'cache', 0),
(2, 'Mr', 'Hulk', '1364655600', 'bank', 0),
(3, 'Tony', 'Stark', '1364749200', 'cache', 0),
(4, 'Tony', 'Stark', '1365354000', 'cache', 0),
(5, 'Thor', 'Thunder', '1365357600', 'cache', 0),
(6, 'Kill', 'Frenzy', '1365444000', 'bank', 0),
(7, 'Mr', 'Hank', '1365447600', 'bank', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
