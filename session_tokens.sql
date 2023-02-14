-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 14, 2023 at 08:58 PM
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
(3, 'tessdemo.myshopify.com', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJodHRwczpcL1wvdGVzc2RlbW8ubXlzaG9waWZ5LmNvbVwvYWRtaW4iLCJkZXN0IjoiaHR0cHM6XC9cL3Rlc3NkZW1vLm15c2hvcGlmeS5jb20iLCJhdWQiOiI2OWM4YzBiZGE3NWZiNjVkM2M5Y2FiMmIwNGU4ODZiMiIsInN1YiI6Ijg5MzM3NTk0MTc3IiwiZXhwIjoxNjc2NDAxMTA0LCJuYmYiOjE2NzY0MDEwNDQsImlhdCI6MTY3NjQwMTA0NCwianRpIjoiYTNkZjAzMmEtZWVkOS00NjE1LWEwYWUtNGY5YWM5YTUzM2Q5Iiwic2lkIjoiOTg2YTA2YjdlNDMzYjZjYmYwNDdmNTJiZDAxMWUyYmI2YWM1NGJhOGQyNzcyZTViMzk1YjIyMGYzYzRkM2RkMCJ9.Eip6VxFsKulS1_tHaiK0aQMeNhxmUr5WmChh2SNpJ5A');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
