-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 23, 2023 at 05:22 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `firstapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

DROP TABLE IF EXISTS `billings`;
CREATE TABLE IF NOT EXISTS `billings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_url` varchar(255) NOT NULL,
  `charge_id` varchar(255) NOT NULL,
  `gid` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_shop_url` (`shop_url`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billings`
--

INSERT INTO `billings` (`id`, `shop_url`, `charge_id`, `gid`, `status`, `date`) VALUES
(1, 'tessdemo.myshopify.com', '2995421505', 'gid://shopify/AppPurchaseOneTime/2995421505', 'ACTIVE', '2023-02-15 08:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `recurring_billings`
--

DROP TABLE IF EXISTS `recurring_billings`;
CREATE TABLE IF NOT EXISTS `recurring_billings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_url` varchar(255) NOT NULL,
  `charge_id` varchar(255) NOT NULL,
  `gid` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `recurring_shop_url` (`shop_url`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recurring_billings`
--

INSERT INTO `recurring_billings` (`id`, `shop_url`, `charge_id`, `gid`, `status`, `date`) VALUES
(1, 'tessdemo.myshopify.com', '28584968513', 'gid://shopify/AppSubscription/28584968513', 'ACTIVE', '2023-02-15 09:35:07');

-- --------------------------------------------------------

--
-- Table structure for table `session_tokens`
--

DROP TABLE IF EXISTS `session_tokens`;
CREATE TABLE IF NOT EXISTS `session_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_url` varchar(255) NOT NULL,
  `session_token` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_url` (`shop_url`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_tokens`
--

INSERT INTO `session_tokens` (`id`, `shop_url`, `session_token`) VALUES
(3, 'tessdemo.myshopify.com', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJodHRwczpcL1wvdGVzc2RlbW8ubXlzaG9waWZ5LmNvbVwvYWRtaW4iLCJkZXN0IjoiaHR0cHM6XC9cL3Rlc3NkZW1vLm15c2hvcGlmeS5jb20iLCJhdWQiOiI2OWM4YzBiZGE3NWZiNjVkM2M5Y2FiMmIwNGU4ODZiMiIsInN1YiI6Ijg5MzM3NTk0MTc3IiwiZXhwIjoxNjc2OTA5NTcyLCJuYmYiOjE2NzY5MDk1MTIsImlhdCI6MTY3NjkwOTUxMiwianRpIjoiZTdhZDE2ZjEtZWE3Yy00NmY5LWExZWMtOTZjNmZjN2ZkMGQ5Iiwic2lkIjoiOTg2YTA2YjdlNDMzYjZjYmYwNDdmNTJiZDAxMWUyYmI2YWM1NGJhOGQyNzcyZTViMzk1YjIyMGYzYzRkM2RkMCJ9.PNoDKKFQ_kndkK8c5m5veOpiVdNoUfaw4gOqYsMEV-g');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
CREATE TABLE IF NOT EXISTS `shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_url` varchar(255) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_url` (`shop_url`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `shop_url`, `access_token`, `created`) VALUES
(1, 'tessdemo.myshopify.com', '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', '2023-02-13 10:49:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
