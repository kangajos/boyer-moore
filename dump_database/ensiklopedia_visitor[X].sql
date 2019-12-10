-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2019 at 06:19 AM
-- Server version: 10.1.39-MariaDB
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
-- Database: `app_ensiklopedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `ensiklopedia_visitor`
--

CREATE TABLE `ensiklopedia_visitor` (
  `visitor_id` int(11) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ensiklopedia_visitor`
--

INSERT INTO `ensiklopedia_visitor` (`visitor_id`, `ip`, `os`, `browser`, `created_at`) VALUES
(1, '::1', 'Linux', 'Google Chrome v.77.0.3865.90', '2019-10-15 06:12:58'),
(2, '::1', 'Linux', 'Google Chrome v.77.0.3865.90', '2019-10-15 06:53:46'),
(3, '::1', 'Linux', 'Google Chrome v.77.0.3865.90', '2019-11-30 04:28:16'),
(4, '::1', 'Linux', 'Google Chrome v.77.0.3865.90', '2019-12-04 16:32:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ensiklopedia_visitor`
--
ALTER TABLE `ensiklopedia_visitor`
  ADD PRIMARY KEY (`visitor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ensiklopedia_visitor`
--
ALTER TABLE `ensiklopedia_visitor`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
