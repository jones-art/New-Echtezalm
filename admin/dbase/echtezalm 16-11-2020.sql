-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2020 at 12:05 PM
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
-- Table structure for table `ayas`
--

CREATE TABLE `ayas` (
  `id` int(11) NOT NULL,
  `page_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `file1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `uploaded_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text,
  `pnum` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `datetime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `pnum`, `image`, `datetime`) VALUES
(1, 'Ariyo Morenikeji Rashidat', 'adebola.slimmy@gmail.com', 'New feedback', '08180341606', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_info`
--

CREATE TABLE `job_info` (
  `id` int(11) NOT NULL,
  `job_app` varchar(255) DEFAULT NULL,
  `workplace` int(255) DEFAULT NULL,
  `salary` int(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_info`
--

INSERT INTO `job_info` (`id`, `job_app`, `workplace`, `salary`, `user_id`) VALUES
(1, 'Delivery', 0, 0, 17),
(2, 'Sales Girl', 0, 0, 18),
(3, 'Administrator', 0, 0, 19),
(4, 'Sales Girl', 0, 0, 20);

-- --------------------------------------------------------

--
-- Table structure for table `job_shift`
--

CREATE TABLE `job_shift` (
  `id` int(11) NOT NULL,
  `mon` varchar(30) DEFAULT NULL,
  `tues` varchar(30) DEFAULT NULL,
  `wed` varchar(30) DEFAULT NULL,
  `thur` varchar(30) DEFAULT NULL,
  `fri` varchar(30) DEFAULT NULL,
  `sat` varchar(30) DEFAULT NULL,
  `sun` varchar(30) DEFAULT NULL,
  `user_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_shift`
--

INSERT INTO `job_shift` (`id`, `mon`, `tues`, `wed`, `thur`, `fri`, `sat`, `sun`, `user_id`) VALUES
(1, '12:58 - 12:59', '12:59 - 12:59', 'Off day', '12:59 - 12:59', '12:59 - 12:59', '12:59 - 12:59', 'Off day', '19'),
(2, '12:59 - 12:59', '12:59 - 12:59', '12:59 - 12:59', 'Off day', '12:59 - 12:59', 'Off day', 'Off day', '20');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `icon_name` varchar(255) DEFAULT NULL,
  `level` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`, `link`, `icon_name`, `level`) VALUES
(1, 'Dashboard', 'dashboard.php', 'icon-home active', 1),
(2, 'Orders', 'order.php', 'icon-calendar', 1),
(3, 'Subscribers', 'subscriber.php', 'icon-calendar', 1),
(4, 'Customers', 'customer.php', 'icon-calendar', 1),
(5, 'Invoices', 'invoice.php', 'icon-calendar', 1),
(6, 'Quotes', 'quote.php', 'icon-calendar', 1),
(7, 'Live Chat', 'chat.php', 'icon-calendar', 1),
(8, 'Customers Feedback', 'feedback.php', 'icon-calendar', 1),
(9, 'Pages', 'pages.php', NULL, 2),
(10, 'Blog', 'blog.php', NULL, 2),
(11, 'Product', 'product.php', NULL, 2),
(12, 'Review', 'review.php', NULL, 2),
(13, 'Manage Staff', 'manage-staff.php', NULL, 3),
(14, 'Staffs', 'staff.php', NULL, 3),
(15, 'Shift & Time', 'shift-and-time.php', NULL, 3),
(16, 'Salary', 'salary.php', NULL, 3),
(17, 'Manage Users', 'manage-users.php', NULL, 4),
(18, 'Add a User', 'registration.php', NULL, 4),
(19, 'Payments', 'payment.php', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `status` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `file1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `file2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file3` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `uploaded_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `page_title`, `status`, `file1`, `file2`, `file3`, `uploaded_on`, `uploaded_by`) VALUES
(1, 'Home', 'A Special Experience Of Taste And Tradition', '1', 'images/slidder/premium-edition.png', 'images/slidder/dutch-edition.png', 'images/slidder/classic-edition.png', '2020-11-16 10:26:20', '19'),
(2, 'Collection', 'A Special Experience Of Taste And Tradition on Collection page', '1', 'images/slidder/1.png', '', '', '2020-11-16 10:33:59', '19'),
(3, 'About', 'About echtezalm title from backend', '1', 'images/slidder/2.png', '', '', '2020-11-16 10:42:30', '19'),
(4, 'Webshop', 'A Special Experience Of Taste And Tradition on Web shop page from backend', '1', 'images/slidder/webshop_banner.png', '', '', '2020-11-16 10:52:57', '19'),
(5, 'Contact', 'Contact Us from backend', '1', 'Igbesa, Ogun state', '07068581708', 'younghallajinoni@gmail.com', '2020-11-16 10:54:32', '19');

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
(5, 3, 1, 3, '2020-11-08', 'Pending', '9000', NULL),
(6, 16, 1, 2, '2020-11-13', 'Pending', '6000', NULL);

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
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `uploaded_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `file_name`, `uploaded_on`, `uploaded_by`) VALUES
(9, 'images/sponsors/partner5.png', '2020-11-16 10:48:03', '19'),
(10, 'images/sponsors/partner6.png', '2020-11-16 10:48:03', '19'),
(11, 'images/sponsors/partner7.png', '2020-11-16 10:48:03', '19'),
(12, 'images/sponsors/partner8.png', '2020-11-16 10:48:03', '19'),
(13, 'images/sponsors/partner1.png', '2020-11-16 10:48:03', '19'),
(14, 'images/sponsors/partner2.png', '2020-11-16 10:48:04', '19'),
(15, 'images/sponsors/partner3.png', '2020-11-16 10:48:04', '19'),
(16, 'images/sponsors/partner4.png', '2020-11-16 10:48:04', '19');

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
(2, 'Pending', 3, '2020-11-08', 'Custom', NULL),
(3, 'Pending', 19, '2020-11-15', 'Custom', NULL);

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
(2, 1, 2, 1),
(3, 3, 1, 2),
(4, 3, 2, 1),
(5, 3, 3, 2),
(6, 3, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `joined` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `password`, `country`, `sex`, `dob`, `joined`, `role`, `status`) VALUES
(1, 'Mutolib', 'Sodiq', NULL, 'user@user.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Name', 'Male', '1999-07-25', '2020-09-26', 'user', NULL),
(2, 'Mutolib', 'Mutolib', NULL, 'younghallajinoni@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Name', 'Male', '2009-01-31', '2020-10-04', 'user', NULL),
(16, 'Abdulhammed', 'Adio', 'adio', 'adioridwan784@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, NULL, '2020-11-13', 'Admin', 1),
(19, 'admin', 'admin', 'admin', 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, NULL, '2020-11-13', 'Admin', 1),
(20, 'Ariyo', 'Rashidat', 'Young', 'adebola.slimmy@gmail.com', 'ab86a1e1ef70dff97959067b723c5c24', NULL, NULL, NULL, '2020-11-13', 'Admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_role_management`
--

CREATE TABLE `user_role_management` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role_management`
--

INSERT INTO `user_role_management` (`id`, `user_id`, `menu_id`, `status`) VALUES
(1, 15, 1, 1),
(2, 15, 2, 1),
(3, 15, 3, 1),
(4, 15, 4, 1),
(5, 15, 5, 1),
(6, 15, 6, 1),
(7, 15, 9, 1),
(8, 15, 13, 1),
(9, 15, 14, 1),
(10, 15, 15, 1),
(11, 15, 16, 1),
(12, 15, 17, 1),
(13, 16, 1, 1),
(14, 16, 2, 1),
(15, 16, 3, 1),
(16, 16, 4, 1),
(17, 16, 5, 1),
(18, 16, 6, 1),
(19, 16, 7, 1),
(20, 16, 8, 1),
(21, 16, 9, 1),
(22, 16, 10, 1),
(23, 16, 11, 1),
(24, 16, 12, 1),
(25, 16, 13, 1),
(26, 16, 14, 1),
(27, 16, 15, 1),
(28, 16, 16, 1),
(29, 16, 17, 1),
(30, 16, 18, 1),
(31, 16, 19, 1),
(32, 17, 1, 1),
(33, 17, 2, 1),
(34, 17, 3, 1),
(35, 17, 4, 1),
(36, 17, 5, 1),
(37, 17, 6, 1),
(38, 17, 7, 1),
(39, 17, 8, 1),
(40, 18, 1, 1),
(41, 18, 2, 1),
(42, 18, 3, 1),
(43, 18, 4, 1),
(44, 18, 5, 1),
(45, 18, 6, 1),
(46, 18, 7, 1),
(47, 18, 8, 1),
(48, 19, 1, 1),
(49, 19, 2, 1),
(50, 19, 3, 1),
(51, 19, 4, 1),
(52, 19, 5, 1),
(53, 19, 6, 1),
(54, 19, 7, 1),
(55, 19, 8, 1),
(56, 19, 9, 1),
(57, 19, 10, 1),
(58, 19, 11, 1),
(59, 19, 12, 1),
(60, 19, 13, 1),
(61, 19, 14, 1),
(62, 19, 15, 1),
(63, 19, 16, 1),
(64, 19, 17, 1),
(65, 19, 18, 1),
(66, 19, 19, 1),
(67, 20, 1, 1),
(68, 20, 2, 1),
(69, 20, 3, 1),
(70, 20, 4, 1),
(71, 20, 5, 1),
(72, 20, 6, 1),
(73, 20, 7, 1),
(74, 20, 8, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ayas`
--
ALTER TABLE `ayas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_info`
--
ALTER TABLE `job_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_shift`
--
ALTER TABLE `job_shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
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
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
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
-- Indexes for table `user_role_management`
--
ALTER TABLE `user_role_management`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ayas`
--
ALTER TABLE `ayas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_info`
--
ALTER TABLE `job_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_shift`
--
ALTER TABLE `job_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prd_order`
--
ALTER TABLE `prd_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_custom_product`
--
ALTER TABLE `tbl_custom_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_role_management`
--
ALTER TABLE `user_role_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

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
