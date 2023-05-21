-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 02:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assigment1`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(50) NOT NULL,
  `number` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `age` date NOT NULL,
  `annual_income` int(11) NOT NULL,
  `deductions` int(11) NOT NULL,
  `taxable_income` int(11) NOT NULL,
  `tax_new_regime` int(11) NOT NULL,
  `tax_old_regime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `number`, `email`, `age`, `annual_income`, `deductions`, `taxable_income`, `tax_new_regime`, `tax_old_regime`) VALUES
('aNANDSD', 245678, 'SFSF@FFF.COM', '0000-00-00', 2344444, 22, 2344422, 226663, 343884),
('aNANDSD', 245678, 'SFSF@FFF.COM', '0000-00-00', 2344444, 22, 2344422, 226663, 343884),
('aNANDSD', 245678, 'SFSF@FFF.COM', '0000-00-00', 2344444, 22, 2344422, 226663, 343884),
('aNANDSD', 245678, 'SFSF@FFF.COM', '0000-00-00', 2344444, 22, 2344422, 226663, 343884),
('aNANDSD', 245678, 'SFSF@FFF.COM', '0000-00-00', 2344444, 22, 2344422, 226663, 343884),
('aNANDSD', 245678, 'SFSF@FFF.COM', '0000-00-00', 2344444, 22, 2344422, 226663, 343884);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
