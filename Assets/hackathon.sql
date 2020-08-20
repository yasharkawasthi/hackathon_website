-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 20, 2020 at 07:47 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hackathon`
--

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

DROP TABLE IF EXISTS `registrations`;
CREATE TABLE IF NOT EXISTS `registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teamname` varchar(255) NOT NULL,
  `leadername` varchar(255) NOT NULL,
  `leaderclgname` varchar(255) NOT NULL,
  `leaderemail` varchar(255) NOT NULL,
  `leadercontact` varchar(255) NOT NULL,
  `member1name` varchar(255) DEFAULT NULL,
  `member1clgname` varchar(255) DEFAULT NULL,
  `member1email` varchar(255) DEFAULT NULL,
  `member1contact` varchar(255) DEFAULT NULL,
  `member2name` varchar(255) DEFAULT NULL,
  `member2clgname` varchar(255) DEFAULT NULL,
  `member2email` varchar(255) DEFAULT NULL,
  `member2contact` varchar(255) DEFAULT NULL,
  `member3name` varchar(255) DEFAULT NULL,
  `member3clgname` varchar(255) DEFAULT NULL,
  `member3email` varchar(255) DEFAULT NULL,
  `member3contact` varchar(255) DEFAULT NULL,
  `member4name` varchar(255) DEFAULT NULL,
  `member4clgname` varchar(255) DEFAULT NULL,
  `member4email` varchar(255) DEFAULT NULL,
  `member4contact` varchar(255) DEFAULT NULL,
  `ideaname` varchar(255) NOT NULL,
  `themename` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teamname` (`teamname`),
  UNIQUE KEY `ideaname` (`ideaname`),
  UNIQUE KEY `file` (`file`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
