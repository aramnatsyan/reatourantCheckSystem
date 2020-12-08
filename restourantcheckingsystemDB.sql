-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 08, 2020 at 07:59 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `checkincanteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientlogs`
--

DROP TABLE IF EXISTS `clientlogs`;
CREATE TABLE IF NOT EXISTS `clientlogs` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `client_id` int(255) NOT NULL,
  `current_date_today` date NOT NULL DEFAULT current_timestamp(),
  `craphic_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `clientlogs`
--

INSERT INTO `clientlogs` (`id`, `client_id`, `current_date_today`, `craphic_id`) VALUES
(1, 10, '2020-12-08', 4),
(2, 10, '2020-12-08', 4),
(3, 1, '2020-12-08', 4),
(4, 1, '2020-12-08', 4),
(5, 1, '2020-12-08', 4),
(6, 1, '2020-12-08', 4),
(7, 10, '2020-12-21', 4),
(8, 10, '2020-12-07', 4),
(9, 1, '2020-12-07', 4);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `id_card_number` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `picture_path` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `surname`, `id_card_number`, `picture_path`) VALUES
(1, 'apeք', 'mnatsyanա', '%B4375111010079899^MNATSYAN/ARA              ^2112201121800000000000491000000?;4375111010079899=21122011218049100000?', 'images/profile-images/1/profilePic.jpg'),
(3, 'serj', 'azarich', NULL, 'images/profile-images/3/profilePic.jpg'),
(2, 'aper', 'chan', 'f65htrfe55245%B4375111010079899^MNATSYAN/ARA              ^2112201121800000000000491000000?;4375111010079899=21122011218049100000?', 'images/profile-images/6/profilePic.jpg'),
(8, 'ասդ', 'асд', 'ասդ', 'images/profile-images/8/profilePic.jpg'),
(7, 'john', 'doe', NULL, 'images/profile-images/7/profilePic.jpg'),
(9, 'hrach', 'jan', NULL, 'images/profile-images/9/profilePic.jpg'),
(10, 'ara', 'mnatsyan', '%B36151201024469^MNATSYAN/ARA              ^211010119100000000000000802000000?;36151201024469=2110101191000080200000?', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `graphics`
--

DROP TABLE IF EXISTS `graphics`;
CREATE TABLE IF NOT EXISTS `graphics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `graphic_name` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `start_time` time NOT NULL,
  `finish_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `graphics`
--

INSERT INTO `graphics` (`id`, `graphic_name`, `start_time`, `finish_time`) VALUES
(1, 'Նախաճաշ', '09:00:00', '11:00:00'),
(2, 'Ճաշ', '12:00:00', '15:00:00'),
(4, 'Ընթրիկ', '15:30:00', '22:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

DROP TABLE IF EXISTS `homes`;
CREATE TABLE IF NOT EXISTS `homes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_12_04_100408_create_homes_table', 1),
(2, '2020_12_04_134259_create_clients_logs_table', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
