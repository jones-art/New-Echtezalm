-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2020 at 09:57 PM
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
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `Coll_details` varchar(255) DEFAULT NULL,
  `info_details` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `highlight` text,
  `description` text,
  `created` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`id`, `Coll_details`, `info_details`, `price`, `quantity`, `featured`, `images`, `highlight`, `description`, `created`, `status`) VALUES
(1, 'Dutch', 'The Dutch Collection', 3000, 100, 1, 'Dutch.png', '<p>Dutch Collection is Awesome</p>', '<p>It has Alot of Advantages</p>', '2020-10-29', 1),
(2, 'Classic', 'The Classic Collection', 300, 50, 0, 'Classic.png', '<p>The Classic Edition</p>', '<p>It has alot of classical Advantages</p>', '2020-10-29', 1),
(3, 'Custom', 'Customize your collection type', NULL, NULL, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nibh nibh vestibulum malesuada lorem egestas non id. Amet, tincidunt quisque et non tincidunt pellentesque. Erat laoreet nisl sed dignissim sit est nulla. Id purus, quis porta quis. Sit in nisl viverra nam nulla pharetra. Integer tempor tempor, orci gravida blandit morbi cursus eget. Vestibulum vitae.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nibh nibh vestibulum malesuada lorem egestas non id. Amet, tincidunt quisque et non tincidunt pellentesque. Erat laoreet nisl sed dignissim sit est nulla. Id purus, quis porta quis. Sit in nisl viverra nam nulla pharetra. Integer tempor tempor, orci gravida blandit morbi cursus eget. Vestibulum vitae.', '2020-10-20', 1);

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
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `prd_name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `highlight` text,
  `description` text,
  `status` tinyint(1) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `prd_name`, `price`, `quantity`, `image`, `highlight`, `description`, `status`, `featured`, `created`) VALUES
(1, 'salman', '3000', 100, '1.png', 'highlight', 'description', 1, 0, '2020-12-09'),
(2, 'Salman fish', '3000', 100, '1.png', '<p>echo \"&lt;script&gt;alert(\'Product description is Required\');&lt;/script&gt;\";</p>', '<p>echo \"&lt;script&gt;alert(\'Product description is Required\');&lt;/script&gt;\";</p>', 1, 0, '2020-10-28'),
(3, 'Salman fish', '3000', 100, '1.png', '<p>echo \"&lt;script&gt;alert(\'Product description is Required\');&lt;/script&gt;\";</p>', '<p>echo \"&lt;script&gt;alert(\'Product description is Required\');&lt;/script&gt;\";</p>', 1, 0, '2020-10-28'),
(4, 'New Product', '4000', 100, NULL, '<p>style=\"color:#DAC08E;<br></p>', '<p>style=\"color:#DAC08E;<br></p>', 0, 1, '2020-10-29'),
(5, 'Image Product', '3000', 100, 'Image Product.jpg', '<p>sss</p>', '<p>ss</p>', 1, 0, '2020-10-29');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `title`) VALUES
(1, 'Admin'),
(2, 'User');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `joined` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `country`, `sex`, `dob`, `joined`, `role`) VALUES
(1, 'Mutolib', 'Sodiq', 'user@user.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Name', 'Male', '1999-07-25', '2020-09-26', 'user'),
(2, 'Mutolib', 'Mutolib', 'younghallajinoni@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Name', 'Male', '2009-01-31', '2020-10-04', 'user'),
(3, 'admin', 'admin', 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Nigeria', 'Male', '99999', '24-1090', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prd_order`
--
ALTER TABLE `prd_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prd_order`
--
ALTER TABLE `prd_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
