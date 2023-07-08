-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 03:22 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'brianne', 'briannedacanay@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(2, 'brianne', 'briannedacanay@gmail.com', '934b535800b1cba8f96a5d72f72f1611', 'admin'),
(3, 'althea', 'althea@gmail.com', '1221', 'user'),
(4, 'jian', 'jian@gmail.com', '2222', 'user'),
(5, 'brianne', 'briannedacanay@gmail.com', '12345', 'admin'),
(6, 'jayme', 'jayme@gmail.com', '12', 'admin'),
(7, 'jian', 'jian@gmail.com', '2323', 'user'),
(8, 'great', 'great@gmail.com', '1234', 'user'),
(9, 'are@gmail.com', '', '202cb962ac59075b964b07152d234b70', 'admin'),
(10, 'er', 'er@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(11, 'jian', 'jian@gmail.com', '1d72310edc006dadf2190caad5802983', 'admin'),
(12, 'ange', 'ange@gmail.com', 'a0a080f42e6f13b3a2df133f073095dd', 'user'),
(13, 'gege', 'gege@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(14, 'Althea padilla dacanay', 'altheadacanay@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'customer'),
(15, '', 'mavicaigue20@gmail.com', '1d72310edc006dadf2190caad5802983', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
