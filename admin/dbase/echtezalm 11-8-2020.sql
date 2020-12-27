-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2020 at 10:00 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `echtezalm`
--

-- --------------------------------------------------------

--
-- Table structure for table `prd_order`
--

CREATE TABLE `prd_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_date` varchar(30) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `total_amount` varchar(10) DEFAULT NULL,
  `delivery_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prd_order`
--

INSERT INTO `prd_order` (`id`, `user_id`, `product_id`, `quantity`, `order_date`, `status`, `total_amount`, `delivery_date`) VALUES
(1, 2, 5, 2, '2020-11-07', 'Pending', '6000', NULL),
(2, 2, 5, 1, '2020-11-07', 'Pending', '3000', NULL),
(3, 2, 5, 1, '2020-11-07', 'Pending', '3000', NULL),
(4, 3, 2, 1, '2020-11-08', 'Pending', '3000', NULL),
(5, 3, 1, 3, '2020-11-08', 'Pending', '9000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_date` varchar(20) NOT NULL,
  `plan` varchar(50) NOT NULL,
  `del_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `status`, `user_id`, `sub_date`, `plan`, `del_date`) VALUES
(1, 'Pending', 3, '2020-11-08', 'Custom', NULL),
(2, 'Pending', 3, '2020-11-08', 'Custom', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_custom_product`
--

CREATE TABLE `tbl_custom_product` (
  `id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_custom_product`
--

INSERT INTO `tbl_custom_product` (`id`, `subscription_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prd_order`
--
ALTER TABLE `prd_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_custom_product`
--
ALTER TABLE `tbl_custom_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `tbl_custom_product_ibfk_1` (`subscription_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prd_order`
--
ALTER TABLE `prd_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_custom_product`
--
ALTER TABLE `tbl_custom_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_custom_product`
--
ALTER TABLE `tbl_custom_product`
  ADD CONSTRAINT `tbl_custom_product_ibfk_1` FOREIGN KEY (`subscription_id`) REFERENCES `subscriber` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
