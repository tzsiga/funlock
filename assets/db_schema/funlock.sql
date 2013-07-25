-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 25, 2013 at 09:56 AM
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
  `voucher_id` int(11) DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_hungarian_ci DEFAULT 'active',
  `payment_verified` varchar(10) COLLATE utf8_hungarian_ci DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=44 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `voucher_id`, `status`, `payment_verified`, `book_fname`, `book_sname`, `appointment`, `payment_option`, `bill_fname`, `bill_sname`, `email`, `phone`, `zip`, `city`, `street`, `house`, `tax_number`, `comment`, `notes`, `booking_date`) VALUES
(41, NULL, 'active', NULL, 'Hanky', 'Papa', 1374751800, 'cache', '', '', '', '', 0, '', '', '', 0, '', '', 1374735677),
(42, NULL, NULL, NULL, '', '', 1372251600, 'cache', '', '', '', '', 0, '', '', '', 0, '', '', 1374650424),
(43, 81, 'active', 'yes', 'Hanky', 'Papa', 1374854400, 'card', '', '', 'tzsiga@gmail.com', '578568', 1234, 'sdasd', 'asdasd', '1', 0, '', '', 1374735648);

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
(2, 'booking_limit', '99');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE IF NOT EXISTS `vouchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_hungarian_ci NOT NULL,
  `create_date` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8_hungarian_ci NOT NULL DEFAULT 'active',
  `discounted_price` int(11) NOT NULL,
  `label` text COLLATE utf8_hungarian_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=82 ;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `create_date`, `status`, `discounted_price`, `label`) VALUES
(1, '00b5ee', 1374127182, 'active', 8000, 'god mode voucher'),
(2, '00e662', 1374127182, 'active', 8000, NULL),
(3, '010ec7', 1374127182, 'active', 8000, NULL),
(4, '01dfcf', 1374127182, 'active', 8000, NULL),
(5, '02694c', 1374127182, 'active', 8000, NULL),
(6, '02a7ad', 1374127182, 'active', 8000, NULL),
(7, '02fce0', 1374127182, 'active', 8000, NULL),
(8, '046d9a', 1374127182, 'active', 8000, NULL),
(9, '046fa8', 1374127182, 'active', 8000, NULL),
(10, '0471a5', 1374127182, 'active', 8000, NULL),
(11, '04a699', 1374127182, 'active', 8000, NULL),
(12, '04b4e2', 1374127182, 'active', 8000, NULL),
(13, '06658f', 1374127182, 'active', 8000, NULL),
(14, '06c0f2', 1374127182, 'active', 8000, NULL),
(15, '06c670', 1374127182, 'active', 8000, NULL),
(16, '06d087', 1374127182, 'active', 8000, NULL),
(17, '070db1', 1374127182, 'active', 8000, NULL),
(18, '07788b', 1374127182, 'active', 8000, NULL),
(19, '07f517', 1374127182, 'active', 8000, NULL),
(20, '081c92', 1374127182, 'active', 8000, NULL),
(21, '082dd1', 1374127182, 'active', 8000, NULL),
(22, '08458e', 1374127182, 'active', 8000, NULL),
(23, '0864ed', 1374127182, 'active', 8000, NULL),
(24, '087f3c', 1374127182, 'active', 8000, NULL),
(25, '088c05', 1374127182, 'active', 8000, NULL),
(26, '08dfb9', 1374127182, 'active', 8000, NULL),
(27, '09262b', 1374127182, 'active', 8000, NULL),
(28, '095c3a', 1374127182, 'active', 8000, NULL),
(29, '0967fb', 1374127182, 'active', 8000, NULL),
(30, '09811a', 1374127182, 'active', 8000, NULL),
(31, '098dde', 1374127182, 'active', 8000, NULL),
(32, '09e2ee', 1374127182, 'active', 8000, NULL),
(33, '09f819', 1374127182, 'active', 8000, NULL),
(34, '0a6486', 1374127182, 'active', 8000, NULL),
(35, '0ae7c5', 1374127182, 'active', 8000, NULL),
(36, '0c2472', 1374127182, 'active', 8000, NULL),
(37, '0c436b', 1374127182, 'active', 8000, NULL),
(38, '0c45d2', 1374127182, 'active', 8000, NULL),
(39, '0c544c', 1374127182, 'active', 8000, NULL),
(40, '0c7d5a', 1374127182, 'active', 8000, NULL),
(41, '0cca73', 1374127182, 'active', 8000, NULL),
(42, '0d4fa6', 1374127182, 'active', 8000, NULL),
(43, '0d995a', 1374127182, 'active', 8000, NULL),
(44, '0df922', 1374127182, 'active', 8000, NULL),
(45, '0eb20a', 1374127182, 'active', 8000, NULL),
(46, '0eebcc', 1374127182, 'active', 8000, NULL),
(47, '0f6cbd', 1374127182, 'active', 8000, NULL),
(48, '105d28', 1374127182, 'active', 8000, NULL),
(49, '10be61', 1374127182, 'active', 8000, NULL),
(50, '10c48f', 1374127182, 'active', 8000, NULL),
(51, '111dec', 1374127182, 'active', 8000, NULL),
(52, '112e9c', 1374127182, 'active', 8000, NULL),
(53, '11629d', 1374127182, 'active', 8000, NULL),
(54, '119da0', 1374127182, 'active', 8000, NULL),
(55, '11c7b1', 1374127182, 'active', 8000, NULL),
(56, '12044e', 1374127182, 'active', 8000, NULL),
(57, '127bcb', 1374127182, 'active', 8000, NULL),
(58, '12ae31', 1374127182, 'active', 8000, NULL),
(59, '13ddc1', 1374127182, 'active', 8000, NULL),
(60, '144c94', 1374127182, 'active', 8000, NULL),
(61, '156e2d', 1374127182, 'active', 8000, NULL),
(62, '15c717', 1374127182, 'active', 8000, NULL),
(63, '16bc55', 1374127182, 'active', 8000, NULL),
(64, '18cf53', 1374127182, 'active', 8000, NULL),
(65, '18dfbb', 1374127182, 'active', 8000, NULL),
(66, '18ea9e', 1374127182, 'active', 8000, NULL),
(67, '1968f6', 1374127182, 'active', 8000, NULL),
(68, '19a524', 1374127182, 'active', 8000, NULL),
(69, '19a70c', 1374127182, 'active', 8000, NULL),
(70, '1bd790', 1374127182, 'active', 8000, NULL),
(71, '1c1f2e', 1374127182, 'active', 8000, NULL),
(72, '1c3f56', 1374127182, 'active', 8000, NULL),
(73, '1c44a9', 1374127182, 'active', 8000, NULL),
(74, '1cc871', 1374127182, 'active', 8000, NULL),
(75, '1d2c0b', 1374127182, 'active', 8000, NULL),
(76, '1d4686', 1374127182, 'active', 8000, NULL),
(77, '1db2d0', 1374127182, 'active', 8000, NULL),
(78, '1dc35a', 1374127182, 'active', 8000, NULL),
(79, '1dd55b', 1374127182, 'active', 8000, NULL),
(80, '1e0c19', 1374127182, 'active', 8000, NULL),
(81, 'B2533A69', 1374731451, 'used', 1000, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
