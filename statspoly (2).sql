-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 16, 2023 at 08:46 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `statspoly`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `admn` smallint NOT NULL,
  `name` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mobile` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mail` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL,
  `sem` tinyint(1) NOT NULL,
  `tid` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`admn`, `name`, `mobile`, `mail`, `password`, `type`, `sem`, `tid`) VALUES
(5798, 'Adithyan Manayil', '9072835246', 'manayiladithyan@gmail.com', 'Daffodil', 2, 0, 0),
(1212, 'Sakura', '9638527410', 'sakura@konoha.com', '12121212', 0, 1, 1111),
(1515, 'Sasuke Uchiha', '3692581470', 'anavenger@konoha.com', '12345678', 0, 1, 1111),
(1578, 'Sai', '789456123', 'sai@gmail.com', '12345678', 0, 1, 1111),
(2344, 'Konahamaru', '9874563210', 'konahamaru@konoha.com', '12345678', 0, 1, 1111),
(1111, 'Dinuli Mendis', '9080706050', 'dinulimendis@gmail.com', '12345678', 1, 1, 0),
(2222, 'Kakashi Hatake', '3214569870', 'thecopyninja@konoha.com', '12345678', 1, 2, 0),
(4444, 'Naruto Uzumaki', '1472583690', 'narutouzumaki@konoha.com', '12345678', 0, 2, 2222),
(4444, 'Naruto Uzumaki', '1472583690', 'narutouzumaki@konoha.com', '12345678', 0, 1, 1111),
(7676, 'Madara', '1478523690', 'ghostofuchiha@konoha.com', '12121212', 1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
CREATE TABLE IF NOT EXISTS `results` (
  `admn` smallint NOT NULL,
  `code` smallint NOT NULL,
  `grade` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `imark` smallint NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `sem` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`admn`, `code`, `grade`, `imark`, `verified`, `sem`) VALUES
(1515, 1001, 'B', 32, 1, 1),
(1515, 1002, 'B', 23, 1, 1),
(1515, 1003, 'B', 12, 1, 1),
(1515, 1004, 'B', 23, 1, 1),
(1515, 1005, 'A', 21, 1, 1),
(1515, 1007, 'A', 23, 1, 1),
(1515, 1008, 'S', 43, 1, 1),
(1515, 1009, 'S', 44, 1, 1),
(1212, 1001, 'S', 32, 1, 1),
(1212, 1002, 'A', 54, 1, 1),
(1212, 1003, 'S', 23, 1, 1),
(1212, 1004, 'A', 52, 1, 1),
(1212, 1005, 'S', 53, 1, 1),
(1212, 1007, 'A', 65, 1, 1),
(1212, 1008, 'S', 22, 1, 1),
(1212, 1009, 'A', 34, 1, 1),
(4444, 1001, '10', 32, 1, 1),
(4444, 1002, '9', 54, 1, 1),
(4444, 1003, '8', 23, 1, 1),
(4444, 1004, '9', 52, 1, 1),
(4444, 1005, '10', 53, 1, 1),
(4444, 1007, '7', 65, 1, 1),
(4444, 1008, '6', 22, 1, 1),
(4444, 1009, '5', 33, 1, 1),
(4444, 2002, 'A', 3, 1, 2),
(4444, 2003, 'B', 2, 1, 2),
(4444, 2006, 'B', 1, 1, 2),
(4444, 2008, 'A', 5, 1, 2),
(4444, 2009, 'B', 3, 1, 2),
(4444, 2031, 'B', 7, 1, 2),
(4444, 2131, 'A', 5, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `code` smallint NOT NULL,
  `name` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `credit` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sem` tinyint(1) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`code`, `name`, `credit`, `sem`) VALUES
(1001, 'Communication Skills in English ', '4', 1),
(1002, 'Mathematics 1', '5', 1),
(1003, 'Applied Physics 1 ', '3', 1),
(1004, 'Applied Chemistry', '3', 1),
(1005, 'Engineering Graphics', '1.5', 1),
(1007, 'Applied Chemistry Lab', '1', 1),
(1008, 'Introduction to IT Systems Lab ', '2', 1),
(1009, 'Sports and Yoga', '1', 1),
(2002, 'Mathematics 11', '4', 2),
(2003, 'Applied Physics 11', '3', 2),
(2006, 'Applied Physics Lab', '2', 2),
(2008, 'Communication Skills in English Lab', '1.5', 2),
(2009, 'Engineering Workshop Practice', '1.5', 2),
(2031, 'Fundamentals of Electrical and Electronics Engineering', '3', 2),
(2131, 'Problem Solving and Programming', '3', 2),
(3131, 'Computer Organisation', '4', 3),
(3132, 'Programming in C', '3', 3),
(3133, 'Database Management System', '3', 3),
(3134, 'Digital Computer Fundamentals', '3', 3),
(3135, 'Programming in C Lab', '1.5', 3),
(3136, 'Database Management System Lab', '1.5', 3),
(3137, 'Digital Computer Fundamentals Lab', '1.5', 3),
(3138, 'Web Technology Lab', '2.5', 3),
(4006, 'Minor Project', '2', 4),
(4131, 'Object Oriented Programming', '4', 4),
(4132, 'Computer Communication and Networks', '3', 4),
(4133, 'Data Structure', '4', 4),
(4136, 'Object Oriented Programming Lab', '1.5', 4),
(4138, 'Data Structure Lab', '1.5', 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
