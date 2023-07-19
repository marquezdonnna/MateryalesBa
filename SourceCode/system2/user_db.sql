-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 09:48 AM
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
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `size` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `seller_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `material_list`
--

CREATE TABLE `material_list` (
  `id` int(11) NOT NULL,
  `material_name` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registration_hardware`
--

CREATE TABLE `registration_hardware` (
  `id` int(255) NOT NULL,
  `seller_id` int(255) DEFAULT NULL,
  `hardware_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `owners_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration_hardware`
--

INSERT INTO `registration_hardware` (`id`, `seller_id`, `hardware_name`, `address`, `owners_name`, `image`, `date`) VALUES
(5, 0, 'Ace', 'Bagong Pook, Lian Batangas', 'Brianne Dacanay', '64b232ba6b474.png', '2023-07-15'),
(6, 0, 'Tableria', 'Bagong Pook, Lian, Batangas', 'Angelo Delasalas', '64b6f1e9eaad5.png', '2023-07-19'),
(7, 0, 'Calumpit Hardware', 'Bagong Pook, Lian, Batangas', 'Briane Dacanay', '64b6f2ed01970.png', '2023-07-19'),
(8, 0, 'Angeles Hardware', 'Bagong Pook, Lian, Batangas', 'Briane Dacanay', '64b6f57b608df.png', '2023-07-19'),
(9, 0, 'Angeles Hardware', 'Bagong Pook, Lian, Batangas', 'Briane Dacanay', '64b6f5b7ab68b.png', '2023-07-19'),
(10, 0, 'ABC', 'Bagong Pook, Lian, Batangas', 'Briane Dacanay', '64b78c288c1f2.png', '2023-07-19'),
(12, 33, '123', 'Bagong Pook, Lian, Batangas', 'Briane Dacanay', '64b791ef2224d.png', '2023-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `registration_hardwares`
--

CREATE TABLE `registration_hardwares` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `hardware_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `owners_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `seller_product`
--

CREATE TABLE `seller_product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller_product`
--

INSERT INTO `seller_product` (`id`, `product_name`, `product_description`, `product_price`, `image`, `seller_id`) VALUES
(1, 'Bolt', 'UGKIH', '234.00', '64b6f9428f4ff.png', 33);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `gender`, `address`, `contact`, `email`, `username`, `password`, `user_type`, `image`, `date`) VALUES
(28, 'Brianne Padilla', 'male', 'Lian Batangas', '09066181916', 'briannedacanay@gmail.com', 'brianne21', 'c20ad4d76fe97759aa27a0c99bff6710', 'customer', 'anime.png', '2023-07-18'),
(29, 'Donna ', ' female ', 'Bagong Pook, Lian, Batangas', '09069548491', 'donnamae@gmail.com', 'Donna', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'customer', 'prof.png', '2023-07-18'),
(31, 'Eliza', 'female', 'Bagong Pook, Lian, Batangas', '09069548491', 'donna@gmail.com', 'Eliza', 'd41d8cd98f00b204e9800998ecf8427e', 'customer', 'prof.png', '2023-07-18'),
(32, 'Angelo Delasalas', 'male', 'Kapito, Lian, Batangas', '09069548491', 'angelo@gmail.com', 'Angelo', 'd41d8cd98f00b204e9800998ecf8427e', 'customer', 'prof.png', '2023-07-18'),
(33, 'Donna Mae Marquez', ' female ', 'Bagong Pook, Lian, Batangas', '09069548491', 'donna@gmail.com', 'Donnamae', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'seller', 'prof.png', '2023-07-18'),
(34, 'Vernalyn', 'female', 'Bagong Pook, Lian, Batangas', ' 09203481610 ', 'verna@gmail.com', 'Verna', '827ccb0eea8a706c4c34a16891f84e7b', 'admin', 'prof.png', '2023-07-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `material_list`
--
ALTER TABLE `material_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `registration_hardware`
--
ALTER TABLE `registration_hardware`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration_hardwares`
--
ALTER TABLE `registration_hardwares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_product`
--
ALTER TABLE `seller_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_list`
--
ALTER TABLE `material_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_hardware`
--
ALTER TABLE `registration_hardware`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `registration_hardwares`
--
ALTER TABLE `registration_hardwares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_product`
--
ALTER TABLE `seller_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `user_form` (`id`);

--
-- Constraints for table `material_list`
--
ALTER TABLE `material_list`
  ADD CONSTRAINT `material_list_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `user_form` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
