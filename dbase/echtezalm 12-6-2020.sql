-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2020 at 03:59 AM
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
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `blog_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `blog_title`, `meta_keyword`, `meta_description`, `content`, `image`, `tag`, `created_on`, `created_by`) VALUES
(1, 'testing ', 'dghtghkuj', 'fjkyku', 'fhjtgu.kksfeyrhtggkjydhuihuhvdjkldndjlvjckvljdiovj dfih uh kjsbduidgsaftbfhf kjh dyiovyndhskln ciuvdb8viudnvhd iuh uid<br>', 'wwgrfhgh.png', 'sfedgrhth', '', '19');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `receiver` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `m_date` varchar(255) DEFAULT NULL,
  `m_time` varchar(255) DEFAULT NULL,
  `status` varchar(11) NOT NULL DEFAULT '0' COMMENT '0=waiting,1=chatting, 2= end'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender`, `message`, `receiver`, `file`, `m_date`, `m_time`, `status`) VALUES
(1, 2, 'Hello', 19, NULL, '2020-12-03', '00:35:32', '2'),
(2, 19, 'Hi Mr. Mutolib', 2, NULL, '2020-12-04', '00:35:51', '2'),
(3, 2, 'Good day sir', 19, NULL, '2020-12-04', '00:37:44', '2'),
(4, 19, 'How Can i Help you', 2, NULL, '2020-12-04', '00:38:05', '2'),
(5, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 19, NULL, '2020-12-04', '00:38:40', '2'),
(6, 2, 'hi', 19, NULL, '2020-12-04', '01:41:27', '2'),
(7, 19, 'How are you', 2, NULL, '2020-12-04', '01:41:46', '2'),
(8, 2, 'I am actually doing well sir', 19, NULL, '2020-12-04', '01:45:59', '2'),
(9, 19, 'WOW, that\'s nice to hear', 2, NULL, '2020-12-04', '01:46:17', '2'),
(10, 4, 'nnn', 4, '5', '5', '5', '0'),
(11, 2, 'Hello', 19, NULL, '2020-12-04', '02:06:01', '2'),
(12, 19, 'hello', 2, NULL, '2020-12-04', '02:09:03', '2'),
(13, 2, 'Hello good morning', 19, NULL, '2020-12-04', '09:33:39', '2'),
(14, 19, 'Good morning Mr. Mutolib', 2, NULL, '2020-12-04', '09:35:37', '2'),
(15, 2, 'I am currently in need of your help concerning my subscription payment', 19, NULL, '2020-12-04', '09:37:47', '2'),
(16, 2, 'Morning', 19, NULL, '2020-12-04', '09:41:47', '2');

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
(1, 'Dutch collection', 'The Dutch Collection', 3000, 100, 1, 'Dutch.png', '					  						  	<p>Dutch Collection is Awesome</p>					  					  ', '					  						  	<p>It has Alot of Advantages</p>					  					  ', '2020-11-19', 1),
(2, 'Classic collection', 'The Classic Collection', 300, 50, 0, 'Classic.png', '<p>The Classic Edition</p>', '<p>It has alot of classical Advantages</p>', '2020-10-29', 1),
(3, 'Premium collection', 'Customize your collection type', 0, 0, 0, '.png', '					  	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nibh nibh vestibulum malesuada lorem egestas non id. Amet, tincidunt quisque et non tincidunt pellentesque. Erat laoreet nisl sed dignissim sit est nulla. Id purus, quis porta quis. Sit in nisl viverra nam nulla pharetra. Integer tempor tempor, orci gravida blandit morbi cursus eget. Vestibulum vitae.					  ', '					  	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nibh nibh vestibulum malesuada lorem egestas non id. Amet, tincidunt quisque et non tincidunt pellentesque. Erat laoreet nisl sed dignissim sit est nulla. Id purus, quis porta quis. Sit in nisl viverra nam nulla pharetra. Integer tempor tempor, orci gravida blandit morbi cursus eget. Vestibulum vitae.					  ', '2020-11-18', 1),
(4, 'new', 'f', 44, 44, 0, 'new.png', 'f					  						  ', 'f					  						  ', '2020-11-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `delv_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `sub_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `order_id`, `user_id`, `delv_date`, `status`, `sub_type`) VALUES
(1, '463212', '2', '2020-12-06 04:44:37', 'Processing', NULL),
(2, '707293', '2', '2021-Jan-07 18:11:30', 'Expired', 'collection'),
(3, '189831', '2', '2020-12-07 18:19:12', 'processing', 'collection'),
(4, '18857', '21', '2020-12-08 03:02:24', 'Expired', 'product');

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

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `inv_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `user_id`, `order_id`, `invoice`, `created`, `inv_type`) VALUES
(1, 'Ariyo Morenikeji Rashidat', '74723', '6323e17b523719f0514625246a01f2af.pdf', '02-Dec-2020 18:01:46', NULL),
(2, 'Ariyo Morenikeji Rashidat', '35482', '6f71602e9ab6822ea5d0351f40cb2ece.pdf', '02-Dec-2020 18:02:02', NULL),
(3, 'Ariyo Morenikeji Rashidat', '55495', 'bc2765b7bc17a997ea4cd7d201402f39.pdf', '02-Dec-2020 18:03:32', NULL),
(4, 'Ariyo Morenikeji Rashidat', '81022', '7e7b8dac104444eb91d869cb5c9c0ffd.pdf', '02-Dec-2020 18:03:57', NULL),
(5, 'Ariyo Morenikeji Rashidat', '54363', 'd458fb812582d29e39c29bcb19400ca4.pdf', '02-Dec-2020 18:05:20', NULL),
(6, 'Mutolib Sodiq', '22588', 'a0f88e9238dc45e86d46e95290b7d8f4.pdf', '02-Dec-2020 18:08:21', NULL),
(7, 'Ariyo Morenikeji Rashidat', '94827', 'e9f3fbb785060ede0ce329f4889f32d4.pdf', '02-Dec-2020 18:11:17', NULL),
(8, 'Mutolib Sodiq Akinpelumi', '97534', '9f0158001276513b3f89e6f3d490ef64.pdf', '02-Dec-2020 18:12:06', NULL),
(9, 'Mutolib Sodiq Younghallaji', '57738', 'ce22c0d634d247d1431921e3a437553a.pdf', '02-Dec-2020 18:20:39', NULL),
(10, 'Mutolib Sodiq Younghallaji', '43464', 'b75c467754d42958c82b40cc6bda9344.pdf', '02-Dec-2020 18:23:13', NULL),
(11, 'Mutolib Sodiq Akinpelumi', '6153', 'aaa6c17a0653109784bac1bb058d8d50.pdf', '02-Dec-2020 18:30:58', NULL),
(12, '2', '707293', '790a762aa2cf71dda138e260d6b9f996.pdf', '2020-12-05', 'collection'),
(13, '2', '707293', '1bfe423da36feacbebdedd7aac2976ad.pdf', '2020-12-05', 'collection'),
(14, '2', '707293', '61152198098bf907510786c9594c8b1f.pdf', '2020-12-05', 'collection'),
(15, '2', '707293', 'dd2571a98620a134753de09b98fe3c79.pdf', '2020-12-05', 'collection'),
(16, '2', '189831', '83f2befc61a1af4fc06b1e3e0e7d5027.pdf', '2020-12-05', 'collection'),
(17, '21', '18857', '4365b9e6ca7828d31be18504761321fc.pdf', '2020-Dec-06 03:02:24', 'product');

-- --------------------------------------------------------

--
-- Table structure for table `job_info`
--

CREATE TABLE `job_info` (
  `id` int(11) NOT NULL,
  `job_app` varchar(255) DEFAULT NULL,
  `workplace` varchar(255) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_info`
--

INSERT INTO `job_info` (`id`, `job_app`, `workplace`, `salary`, `user_id`) VALUES
(3, 'Administrator', 'Amstadam', '10000', 19),
(4, 'Sales Girl', 'Amstadam', '5000', 20);

-- --------------------------------------------------------

--
-- Table structure for table `job_shift`
--

CREATE TABLE `job_shift` (
  `id` int(11) NOT NULL,
  `mon` varchar(30) DEFAULT NULL,
  `tue` varchar(30) DEFAULT NULL,
  `wed` varchar(30) DEFAULT NULL,
  `thu` varchar(30) DEFAULT NULL,
  `fri` varchar(30) DEFAULT NULL,
  `sat` varchar(30) DEFAULT NULL,
  `sun` varchar(30) DEFAULT NULL,
  `user_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_shift`
--

INSERT INTO `job_shift` (`id`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `sun`, `user_id`) VALUES
(1, '12:58 - 12:59', '12:59 - 12:59', 'Off day', '12:59 - 12:59', '12:59 - 12:59', '12:59 - 12:59', 'Off day', '19'),
(2, '12:59 - 12:59', '12:59 - 12:59', '12:59 - 12:59', 'Off day', 'Off day', 'Off day', 'Off day', '20');

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
(1, 'Home', 'Een bijzondere ervaring van smaak en traditie', '1', 'images/slidder/home-visual-dark.jpg', 'images/slidder/home-visual-dark.jpg', 'images/slidder/home-visual-dark.jpg', '2020-11-19 12:46:15', '19'),
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
  `payment_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `total_amount` varchar(10) DEFAULT NULL,
  `order_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prd_order`
--

INSERT INTO `prd_order` (`id`, `user_id`, `product_id`, `quantity`, `order_date`, `status`, `payment_status`, `total_amount`, `order_id`) VALUES
(1, 2, 5, 2, '2020-11-07', 'Pending', 'Pending', '6000', NULL),
(2, 2, 5, 1, '2020-11-07', 'Pending', 'Pending', '3000', NULL),
(3, 2, 5, 1, '2020-11-07', 'Pending', 'Pending', '3000', NULL),
(4, 3, 2, 1, '2020-11-08', 'Pending', 'Pending', '3000', NULL),
(5, 3, 1, 3, '2020-11-08', 'Pending', 'Pending', '9000', NULL),
(6, 16, 1, 2, '2020-11-13', 'Pending', 'Pending', '6000', NULL),
(10, 2, 2, 1, '2020-11-20', 'Pending', 'Pending', '3000', NULL),
(11, NULL, 1, 1, '2020-11-20', 'Pending', 'Pending', '3000', NULL),
(12, NULL, 3, 1, '2020-11-20', 'Pending', 'Pending', '3000', NULL),
(13, NULL, 1, 1, '2020-11-20', 'Pending', 'Pending', '3000', NULL),
(14, NULL, NULL, 1, '2020-11-21', 'Pending', 'Pending', '0', NULL),
(15, NULL, NULL, 1, '2020-11-21', 'Pending', 'Pending', '0', NULL),
(16, 2, 3, 1, '2020-11-21', 'Pending', 'Pending', NULL, NULL),
(17, 2, 3, 1, '2020-11-21', 'Pending', 'Pending', NULL, NULL),
(18, 2, 3, 1, '2020-11-21', 'Pending', 'Pending', NULL, NULL),
(19, 2, 7, 1, '2020-11-22', 'Pending', 'Pending', NULL, NULL),
(20, 2, 3, 1, '2020-11-22', 'Pending', 'Pending', '3000', NULL),
(21, 2, 5, 1, '2020-11-22', 'Pending', 'Pending', '3000', NULL),
(22, 21, 2, 2, '2020-11-22', 'Pending', 'Pending', '6000', NULL),
(23, 21, 2, 1, '2020-11-22', 'Pending', 'Pending', '3000', NULL),
(25, 2, 5, 1, '2020-11-22', 'Pending', 'Pending', '3000', NULL),
(26, 2, 7, 1, '2020-11-22', 'Pending', 'Pending', '1000000', NULL),
(27, 21, 2, 1, '2020-11-22', 'Pending', 'Pending', '3000', NULL),
(28, 21, 6, 1, '2020-11-22', 'Pending', 'Pending', '10000', NULL),
(29, 2, 4, 1, '2020-11-22', 'Pending', 'Paid', '4000', '00079'),
(40, 21, 2, 1, '2020-11-23', 'Pending', 'Pending', '3000', '18857'),
(42, 19, 2, 4, '2020-11-23', 'Pending', 'Pending', '12000', '7331'),
(43, 5, 2, 1, '2020-11-23', 'Pending', 'Pending', '3000', '90354'),
(44, 2, 2, 1, '2020-11-23', 'Pending', 'Pending', '3000', '81759'),
(47, 22, 2, 1, '2020-11-25', 'Pending', 'Pending', '3000', '40357'),
(48, 22, 3, 1, '2020-11-25', 'Pending', 'Pending', '3000', '40357'),
(49, 22, 3, 1, '2020-11-25', 'Pending', 'Pending', '3000', '60711'),
(50, 19, 3, 5, '2020-11-25', 'Pending', 'Pending', '15000', NULL),
(51, 19, 3, 1, '2020-11-25', 'Pending', 'Pending', '3000', NULL),
(52, 19, 3, 3, '2020-11-25', 'Pending', 'Pending', '9000', NULL),
(53, 19, 2, 1, '2020-11-25', 'Pending', 'Pending', '3000', NULL),
(54, 19, 2, 2, '2020-11-25', 'Pending', 'Pending', '6000', NULL),
(55, 19, 3, 1, '2020-11-25', 'Pending', 'Pending', '3000', NULL),
(56, 19, 3, 1, '2020-11-25', 'Pending', 'Pending', '3000', NULL),
(57, 19, 3, 1, '2020-11-25', 'Pending', 'Pending', '3000', NULL),
(58, 19, 3, 2, '2020-11-25', 'Pending', 'Pending', '6000', NULL),
(59, 19, 3, 1, '2020-11-25', 'Pending', 'Pending', '3000', NULL),
(61, 19, 1, 1, '2020-11-25', 'Pending', 'Pending', '3000', NULL),
(65, 21, 2, 1, '2020-11-30', 'Pending', 'Pending', '3000', '19816'),
(66, 19, 3, 1, '2020-12-02', 'Pending', 'Pending', '3000', '7331'),
(67, 19, 3, 1, '2020-12-02', 'Pending', 'Pending', '3000', '7331'),
(68, 24, 2, 1, '2020-12-04', 'Pending', 'Pending', '3000', '58190'),
(69, 24, 6, 1, '2020-12-04', 'Pending', 'Pending', '10000', '58190'),
(70, NULL, 2, 2, '2020-12-05', 'Pending', 'Pending', '6000', '30177'),
(71, 2, 2, 1, '2020-12-05', 'Pending', 'Pending', '3000', '81759');

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
(4, 'New Product', '4000', 100, 'New Product.jpg', '<p>style=\"color:#DAC08E;<br></p>', '<p>style=\"color:#DAC08E;<br></p>', 0, 1, '2020-12-03'),
(5, 'Image Product', '3000', 100, 'Image Product.jpg', '<p>sss</p>', '<p>ss</p>', 1, 0, '2020-10-29'),
(6, 'Live Product', '10000', 500, 'Live Product.jpg', '<p>This product is a product that is added from the live server<br></p>', '<p>This product is a product that is added from the live server<br></p>', 1, 0, '2020-11-17'),
(7, 'Live Products', '1000000', 500, 'Live Products.jpg', '<p>helllo&nbsp;&nbsp;&nbsp;&nbsp;</p>', '<p>hello</p>', 1, 0, '2020-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

CREATE TABLE `quote` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` text,
  `date` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0=pending,1=processing,2=cancelled,3=delivered',
  `payment_status` tinyint(1) NOT NULL COMMENT '0=pending,1=paid',
  `total` varchar(255) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `order_id` varchar(10) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quote`
--

INSERT INTO `quote` (`id`, `name`, `email`, `description`, `date`, `status`, `payment_status`, `total`, `createdby`, `order_id`, `file`) VALUES
(1, 'Mutolib Sodiq Akinpelumi', 'younghallajinoni@gmail.com', 'Quote Description', '02-Dec-2020 18:30:58', 0, 0, NULL, 19, '6153', 'aaa6c17a0653109784bac1bb058d8d50.pdf'),
(2, 'Abdulhammed Ridwan Adio', 'adioridwan784@gmail.com', 'This is where the description will stay This is where the description will stay This is where the description will stay This is where the description will stay This is where the description will stay', '03-Dec-2020 05:09:36', 0, 0, NULL, 19, '89831', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quote_items`
--

CREATE TABLE `quote_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quote_items`
--

INSERT INTO `quote_items` (`id`, `product_id`, `user_id`, `total_amount`, `quantity`, `order_id`) VALUES
(1, 3, 1, '15000.00', 5, 6153),
(2, 5, 1, '12000.00', 4, 6153),
(3, 1, 2, '9000.00', 3, 89831),
(4, 6, 2, '60000.00', 6, 89831),
(5, 7, 2, '1000000.00', 1, 89831),
(6, 2, 2, '6000.00', 2, 89831);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_id` int(25) NOT NULL,
  `prd_id` int(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `rating` int(40) NOT NULL,
  `title` varchar(200) NOT NULL,
  `message` varchar(255) NOT NULL,
  `visibility` tinyint(1) DEFAULT '0',
  `created` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `user_id`, `prd_id`, `status`, `rating`, `title`, `message`, `visibility`, `created`) VALUES
(1, 19, 2, '2', 5, 'wdws', 'wefrerfefedf', 0, NULL),
(2, 19, 2, '2', 4, 'qswqswq', 'adwsdwwd', 0, NULL),
(3, 19, 2, '2', 4, 'qswqswq', 'adwsdwwd', 0, NULL),
(4, 19, 2, '2', 4, 'qswqswq', 'adwsdwwd', 1, NULL),
(5, 19, 2, '2', 4, 'qswqswq', 'adwsdwwd', 0, NULL),
(6, 19, 2, '2', 4, 'qswqswq', 'adwsdwwd', 0, NULL),
(7, 19, 2, '2', 4, 'rrgr', 'esr4gtrgrer', 0, NULL),
(8, 19, 2, 'collection', 5, 'wsdt', 'sddergrerdgsdfsdafwe', 0, NULL),
(9, 19, 3, 'collection', 2, 'Nice and Amazing product\r\n', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dol', 0, NULL);

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
-- Table structure for table `shipping_details`
--

CREATE TABLE `shipping_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `lga` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `age_agree` tinyint(1) DEFAULT NULL,
  `save_add` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_details`
--

INSERT INTO `shipping_details` (`id`, `user_id`, `order_id`, `email`, `fname`, `lname`, `company`, `country`, `state`, `lga`, `zip_code`, `apartment`, `phone`, `age_agree`, `save_add`) VALUES
(1, 2, '00079', 'younghallajinoni@gmail.com', 'Mutolib', 'Sodiq', '', 'Nigeria', 'Lagos', 'Ojo', '0009', '', '07068581708', 0, 1),
(2, 19, '08890', 'younghallajinoni@gmail.com', 'Mutolib', 'Sodiq', '', 'Nigeria', 'Lagos', 'Ojo', '0009', '', '07068581708', 1, 1),
(3, 22, '40357', 'me@gmail.com', 'mutolib', 'sodi', 'golden touch', 'Nigeria', 'Osun', 'irewole', '00900', 'sunmola estate', '0706858708', 1, 1),
(4, 19, '7331', 'younghallajinoni@gmail.com', 'Mutolib', 'Sodiq', 'g', 'Nigeria', 'Lagos', 'Ojo', '90', 'jkl;', '09090909090', 1, 1),
(5, 16, '542741', 'adioridwan784@gmail.com', 'Ridwan', 'Abdulhammed', 'Excel Global', 'Nigeria', 'Oyo', 'Lagelu', '9009', 'Onikoyi', '09099898787', 1, 1),
(8, 19, '751157', 'adebola.slimmy@gmail.com', 'Ariyo', 'Rashidat', 'Golden Touch', 'Netherland', 'Limburg', 'Lagos', '234', 'WDEFRDFR', '08180341606', 1, 1),
(9, 24, '58190', 'orshinfawaz333@gmail.com', 'oshin', 'fawaz', 'Cyber Tech', 'Netherland', 'Limburg', 'lagos', '101242', '86, odo streert', '07012670169', 1, 1),
(10, 2, '81759', 'adebola.slimmy@gmail.com', 'Ariyo', 'Rashidat', 'Golden Touch', 'Netherland', 'Noord Holland', 'Lagos', '234', 'WDEFRDFR', '08180341606', 1, 1),
(11, 2, '81759', 'younghallajinoni@gmail.com', 'Mutolib', 'Sodiq', 'Golden Touch Intertech', 'Netherland', 'Noord Brabant', 'Filled', '40900', 'Block 30, random street', '07068581708', 1, 1),
(12, 2, '291287', 'younghallajinoni@gmail.com', 'Mutolib', 'Sodiq', 'Golden Touch Intertech', 'Netherland', 'Overijssel', 'igbesa', '900', 'itekun road', '07068581708', 1, 0);

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
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `stateName` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `stateName`) VALUES
(1, 'Amsterdam'),
(2, 'Drenthe'),
(3, 'Friesland'),
(4, 'Gelderland'),
(5, 'Groningen'),
(6, 'Limburg'),
(7, 'Noord Brabant'),
(8, 'Noord Holland'),
(9, 'Overijssel'),
(10, 'Utrecht');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `order_id` varchar(25) NOT NULL,
  `status` varchar(20) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_date` varchar(20) NOT NULL,
  `plan` varchar(50) NOT NULL,
  `month` int(25) NOT NULL,
  `duration` int(25) NOT NULL,
  `payment_type` varchar(25) NOT NULL,
  `sub_total` varchar(255) DEFAULT NULL,
  `invoice` int(11) NOT NULL,
  `file` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `del_date` varchar(20) DEFAULT NULL,
  `amountPaid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `order_id`, `status`, `payment_status`, `user_id`, `sub_date`, `plan`, `month`, `duration`, `payment_type`, `sub_total`, `invoice`, `file`, `del_date`, `amountPaid`) VALUES
(1, '542741', 'Expired', 'Paid', 16, '2020-11-30', '1', 3, 3, '', '9000', 1, '8b60d5419c6823a6adab94fba2259737.pdf', '2020-10-11 04:11:11', NULL),
(21, '751157', 'Cancelled', 'Paid', 19, '2020-12-01', '0', 2, 0, 'Ideal', '160000', 0, '', NULL, '160000'),
(22, '335290', 'Pending', 'Pending', 19, '2020-12-02', '1', 1, 1, '', '3000', 0, '', NULL, NULL),
(23, '821484', 'Pending', 'Pending', 19, '2020-12-02', '0', 2, 0, '', '6000', 0, '', NULL, NULL),
(24, '599738', 'Pending', 'Pending', 19, '2020-12-02', '3', 1, 1, '', '0', 0, '', NULL, NULL),
(25, '463212', 'Pending', 'Paid', 2, '2020-12-04', '2', 2, 2, 'Ideal', '600', 0, '', '2020-1', '600'),
(26, '707293', 'Expired', 'Paid', 2, '2020-12-05', '0', 2, 0, 'Ideal', '6000', 1, 'dd2571a98620a134753de09b98fe3c79.pdf', '2021-Feb-07 18:11:30', NULL),
(27, '189831', 'Processing', 'Paid', 2, '2020-12-05', '1', 2, 2, 'Ideal', '6000', 1, '83f2befc61a1af4fc06b1e3e0e7d5027.pdf', '2020-12-07 18:19:12', '6000'),
(28, '291287', 'Cancelled', 'Paid', 2, '2020-12-05', '4', 3, 3, 'Ideal', '132', 0, '', NULL, '132');

-- --------------------------------------------------------

--
-- Table structure for table `sub_duration`
--

CREATE TABLE `sub_duration` (
  `id` int(11) NOT NULL,
  `sub_id` varchar(25) NOT NULL,
  `user` varchar(25) NOT NULL,
  `delv_date` varchar(27) NOT NULL,
  `delv_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_duration`
--

INSERT INTO `sub_duration` (`id`, `sub_id`, `user`, `delv_date`, `delv_status`) VALUES
(1, '542741', '16', '2020-Nov-30', 'Delivered'),
(2, '542741', '16', '2020-Nov-30', 'Delivered'),
(3, '542741', '16', '2020-Nov-30', 'Delivered'),
(6, '751157', '19', '0000-00-00', 'Pending'),
(7, '751157', '19', '0000-00-00', 'Pending'),
(8, '821484', '19', '0000-00-00', 'Pending'),
(9, '821484', '19', '0000-00-00', 'Pending'),
(10, '463212', '2', '', 'Pending'),
(11, '463212', '2', '', 'Pending'),
(12, '707293', '2', '2020-Dec-05', 'Delivered'),
(13, '707293', '2', '2020-Dec-05', 'Delivered'),
(14, '189831', '2', '', 'Pending'),
(15, '189831', '2', '', 'Pending'),
(16, '291287', '2', '0000-00-00', 'Pending'),
(17, '291287', '2', '0000-00-00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity`
--

CREATE TABLE `tbl_activity` (
  `id` int(11) NOT NULL,
  `user_id` int(25) NOT NULL,
  `activity` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` time NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_activity`
--

INSERT INTO `tbl_activity` (`id`, `user_id`, `activity`, `time`, `date`) VALUES
(1, 16, 'logged in', '02:03:16', '2020-11-19'),
(2, 1, 'logged in', '04:12:12', '2020-11-04'),
(3, 1, 'logged in', '03:21:09', '2020-11-12'),
(4, 16, 'logged in', '05:06:05', '2020-11-22'),
(5, 16, 'logged in', '04:22:07', '2020-11-06'),
(6, 1, 'logged in', '04:05:10', '2020-11-21'),
(7, 1, 'logged in', '02:04:09', '2020-11-20'),
(8, 1, 'logged in', '04:10:07', '2020-10-20'),
(9, 1, 'logged in', '03:06:06', '2020-10-20'),
(10, 16, 'Created holiday', '03:56:40', '2020-11-19'),
(11, 16, 'Created holiday Ester Holiday', '03:59:24', '2020-11-19'),
(12, 16, 'Created holiday Ester Holiday', '04:03:29', '2020-11-19'),
(13, 16, 'Created holiday Ester Holiday', '04:07:07', '2020-11-19'),
(14, 16, 'Created holiday Ester Holiday', '04:07:23', '2020-11-19'),
(15, 16, 'Created holiday Ester Holiday', '05:43:23', '2020-11-19'),
(16, 16, 'Created holiday Ester Holiday', '05:43:56', '2020-11-19'),
(17, 16, 'Created holiday Ester Holiday', '05:44:05', '2020-11-19'),
(18, 16, 'Created holiday Ester Holiday', '05:44:27', '2020-11-19'),
(19, 16, 'Created holiday Ester Holiday', '05:44:39', '2020-11-19'),
(20, 16, 'Created holiday Ester Holiday', '05:46:33', '2020-11-19'),
(21, 16, 'Created holiday Ester Holiday', '05:47:02', '2020-11-19'),
(22, 16, 'Created holiday Ester Holiday', '05:47:59', '2020-11-19'),
(23, 2, 'logged in', '14:17:19', '2020-11-19'),
(24, 1, 'logged in', '14:44:11', '2020-11-19'),
(25, 2, 'logged in', '16:42:21', '2020-11-19'),
(26, 16, 'logged in', '00:15:50', '2020-11-20'),
(27, 2, 'logged in', '23:39:20', '2020-11-21'),
(28, 2, 'logged in', '23:40:19', '2020-11-21'),
(29, 2, 'logged in', '23:52:00', '2020-11-21'),
(30, 2, 'logged in', '23:54:58', '2020-11-21'),
(31, 2, 'logged in', '23:58:18', '2020-11-21'),
(32, 2, 'logged in', '00:00:38', '2020-11-22'),
(33, 2, 'logged in', '06:35:25', '2020-11-22'),
(34, 21, 'logged in', '06:47:25', '2020-11-22'),
(35, 2, 'logged in', '06:51:51', '2020-11-22'),
(36, 21, 'logged in', '06:52:23', '2020-11-22'),
(37, 19, 'logged in', '06:53:18', '2020-11-22'),
(38, 2, 'logged in', '07:13:08', '2020-11-22'),
(39, 2, 'logged in', '07:14:13', '2020-11-22'),
(40, 21, 'logged in', '07:17:25', '2020-11-22'),
(41, 21, 'logged in', '07:18:33', '2020-11-22'),
(42, 2, 'logged in', '07:27:51', '2020-11-22'),
(43, 19, 'logged in', '07:31:46', '2020-11-22'),
(44, 19, 'logged in', '07:57:55', '2020-11-22'),
(45, 19, 'logged in', '03:07:51', '2020-11-23'),
(46, 19, 'logged in', '03:08:52', '2020-11-23'),
(47, 19, 'logged in', '03:09:15', '2020-11-23'),
(48, 21, 'logged in', '06:11:16', '2020-11-23'),
(49, 21, 'logged in', '06:12:51', '2020-11-23'),
(50, 19, 'logged in', '06:16:40', '2020-11-23'),
(51, 2, 'logged in', '06:19:06', '2020-11-23'),
(52, 19, 'logged in', '06:19:28', '2020-11-23'),
(53, 2, 'logged in', '14:52:48', '2020-11-23'),
(54, 19, 'logged in', '16:13:58', '2020-11-23'),
(55, 19, 'logged in', '17:08:25', '2020-11-23'),
(56, 19, 'logged in', '17:36:44', '2020-11-23'),
(57, 22, 'logged in', '03:34:47', '2020-11-25'),
(58, 22, 'logged in', '06:35:19', '2020-11-25'),
(59, 19, 'logged in', '07:20:31', '2020-11-25'),
(60, 19, 'logged in', '14:28:51', '2020-11-25'),
(61, 22, 'logged in', '16:19:52', '2020-11-25'),
(62, 19, 'logged in', '10:12:57', '2020-11-26'),
(63, 2, 'logged in', '17:21:33', '2020-11-26'),
(64, 19, 'logged in', '17:21:55', '2020-11-26'),
(65, 19, 'logged in', '01:22:57', '2020-11-27'),
(66, 19, 'logged in', '02:15:50', '2020-11-27'),
(67, 19, 'Created holiday 10', '02:37:03', '2020-11-27'),
(68, 19, 'Created holiday New year Holiday', '02:38:09', '2020-11-27'),
(69, 19, 'logged in', '03:28:03', '2020-11-27'),
(70, 16, 'logged in', '00:23:57', '2020-11-28'),
(71, 19, 'logged in', '07:21:36', '2020-11-28'),
(72, 19, 'logged in', '01:29:51', '2020-11-29'),
(73, 19, 'logged in', '06:56:16', '2020-11-29'),
(74, 2, 'logged in', '09:33:23', '2020-11-29'),
(75, 19, 'logged in', '10:35:49', '2020-11-29'),
(76, 16, 'logged in', '11:41:12', '2020-11-29'),
(77, 16, 'logged in', '11:49:41', '2020-11-29'),
(78, 2, 'logged in', '03:43:29', '2020-11-30'),
(79, 19, 'logged in', '03:43:51', '2020-11-30'),
(80, 19, 'logged in', '03:44:52', '2020-11-30'),
(81, 16, 'logged in', '03:46:11', '2020-11-30'),
(82, 2, 'logged in', '04:53:34', '2020-11-30'),
(83, 21, 'logged in', '05:29:47', '2020-11-30'),
(84, 2, 'logged in', '05:30:28', '2020-11-30'),
(85, 19, 'logged in', '05:34:26', '2020-11-30'),
(86, 2, 'logged in', '15:15:37', '2020-11-30'),
(87, 19, 'logged in', '15:16:55', '2020-11-30'),
(88, 2, 'logged in', '05:38:53', '2020-12-02'),
(89, 19, 'logged in', '12:43:44', '2020-12-02'),
(90, 19, 'logged in', '16:08:06', '2020-12-02'),
(91, 19, 'Created holiday Corona Holiday', '16:30:34', '2020-12-02'),
(92, 2, 'logged in', '06:07:36', '2020-12-03'),
(93, 23, 'logged in', '10:32:26', '2020-12-03'),
(94, 16, 'logged in', '11:08:24', '2020-12-03'),
(95, 2, 'logged in', '15:09:32', '2020-12-03'),
(96, 16, 'logged in', '21:08:27', '2020-12-03'),
(97, 22, 'logged in', '21:11:12', '2020-12-03'),
(98, 19, 'logged in', '00:34:57', '2020-12-04'),
(99, 2, 'logged in', '00:35:21', '2020-12-04'),
(100, 24, 'logged in', '09:44:06', '2020-12-04'),
(101, 19, 'logged in', '16:54:09', '2020-12-04'),
(102, 2, 'logged in', '17:31:21', '2020-12-04'),
(103, 2, 'logged in', '17:30:55', '2020-12-05'),
(104, 19, 'logged in', '17:46:31', '2020-12-05'),
(105, 2, 'logged in', '02:15:24', '2020-12-06'),
(106, 2, 'logged in', '02:36:02', '2020-12-06'),
(107, 21, 'logged in', '03:04:28', '2020-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_custom_product`
--

CREATE TABLE `tbl_custom_product` (
  `id` int(11) NOT NULL,
  `order_id` varchar(10) DEFAULT NULL,
  `subscription_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_custom_product`
--

INSERT INTO `tbl_custom_product` (`id`, `order_id`, `subscription_id`, `product_id`, `quantity`) VALUES
(6, '751157', 21, 1, 1),
(7, '751157', 21, 2, 2),
(8, '751157', 21, 3, 3),
(9, '751157', 21, 5, 4),
(10, '821484', 23, 2, 1),
(11, '707293', 26, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holiday`
--

CREATE TABLE `tbl_holiday` (
  `id` int(11) NOT NULL,
  `holiday_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_holiday`
--

INSERT INTO `tbl_holiday` (`id`, `holiday_name`, `date`, `created_on`, `created_by`) VALUES
(1, 'Christmas', '25/12/2020', '20/11/2020', 1),
(2, '10', '2020-11-27', '2020-11-27', 19),
(3, 'New year Holiday', '2021-01-01', '2020-11-27', 19),
(4, 'Corona Holiday', '2020-11-30', '2020-12-02', 19);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `del_date` varchar(20) DEFAULT NULL,
  `del_status` varchar(20) DEFAULT NULL,
  `ord_date` varchar(30) DEFAULT NULL,
  `invoice` tinyint(1) DEFAULT '0',
  `payment_type` varchar(20) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `order_id`, `user_id`, `payment_status`, `del_date`, `del_status`, `ord_date`, `invoice`, `payment_type`, `amount`, `file`) VALUES
(1, '00079', 2, 'Paid', '2020-12-02 04:44:37', 'Processing', '2020-10-11', 1, 'ideal', '4000', '01045149c849196023c416589acfa800.pdf'),
(2, '08890', 19, 'Paid', '2020-11-30 05:42:14', 'Delivered', '2020-10-11', 1, 'invoice', '28000', '33932a59a4d197bb943d2b55020867a1.pdf'),
(3, '90090', 16, 'Paid', NULL, 'Delivered', '2020-23-11', 0, 'idal', '1000', NULL),
(8, '94826', 19, 'Paid', '2020-11-30 05:43:32', 'Delivered', '2020-11-23', 1, NULL, '', 'bb5fd6f62e264bd6840411909edff9ce.pdf'),
(10, '18857', 21, 'Paid', '2020-12-06 03:06:48', 'Delivered', '2020-11-23', 1, NULL, '26000', '4365b9e6ca7828d31be18504761321fc.pdf'),
(11, '7331', 19, 'Pending', NULL, 'Pending', '2020-11-23', 0, NULL, '', NULL),
(12, '81759', 2, 'Pending', NULL, 'Pending', '2020-11-23', 0, NULL, '', NULL),
(13, '90354', 5, 'Pending', NULL, 'Pending', '2020-11-23', 0, NULL, '', NULL),
(14, '40357', 22, 'Paid', '2020-12-06 02:59:56', 'Delivered', '2020-11-25', 1, 'ideal', '7000', '649dd1374232ad526e0abf86045b9759.pdf'),
(15, '60711', 22, 'Pending', NULL, 'Pending', '2020-11-25', 0, NULL, '', NULL),
(16, '82331', 16, 'Pending', NULL, 'Pending', '2020-11-29', 0, NULL, '', NULL),
(17, '19816', 21, 'Pending', NULL, 'Pending', '2020-11-30', 0, NULL, '', NULL),
(18, '5946', 23, 'Pending', NULL, 'Pending', '2020-12-03', 0, NULL, '', NULL),
(19, '58190', 24, 'Paid', '2020-12-04 10:04:27', 'Delivered', '2020-12-04', 1, 'Ideal', '13000', 'ed1f488cf580ade723c39f9d486c3452.pdf'),
(20, '30177', NULL, 'Pending', NULL, 'Pending', '2020-12-05', 0, NULL, '', NULL);

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
(16, 'Abdulhammed', 'Adio', 'adio', 'adioridwan784@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Amsterdam', NULL, NULL, '2020-11-13', 'Admin', 1),
(19, 'admin', 'admin', 'admin', 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Amsterdam', NULL, NULL, '2020-11-13', 'Admin', 1),
(20, 'Ariyo', 'Rashidat', 'Young', 'adebola.slimmy@gmail.com', 'ab86a1e1ef70dff97959067b723c5c24', NULL, NULL, NULL, '2020-11-13', 'Admin', 0),
(21, 'sodiq', 'Akin', NULL, 'mutolibsodiq@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Name', 'Male', '2020-11-13', '2020-11-19', 'user', NULL),
(22, 'sodiq', 'akin', NULL, 'me@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Name', 'Male', '2020-11-25', '2020-11-25', 'user', NULL),
(23, 'Owolu', 'Opeyemi', NULL, 'opeyemiowolu@yahoo.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Name', 'Male', '2020-12-31', '2020-12-03', 'user', NULL),
(24, 'oshin', 'fawaz', NULL, 'orshinfawaz333@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Name', 'Male', '2000-12-02', '2020-12-04', 'user', NULL);

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
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
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
-- Indexes for table `quote`
--
ALTER TABLE `quote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quote_items`
--
ALTER TABLE `quote_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_details`
--
ALTER TABLE `shipping_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_duration`
--
ALTER TABLE `sub_duration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_custom_product`
--
ALTER TABLE `tbl_custom_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `tbl_custom_product_ibfk_1` (`subscription_id`);

--
-- Indexes for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quote`
--
ALTER TABLE `quote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quote_items`
--
ALTER TABLE `quote_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_details`
--
ALTER TABLE `shipping_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `sub_duration`
--
ALTER TABLE `sub_duration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tbl_custom_product`
--
ALTER TABLE `tbl_custom_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_role_management`
--
ALTER TABLE `user_role_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
