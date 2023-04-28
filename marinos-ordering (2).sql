-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2023 at 04:05 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marinos-ordering`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(100) NOT NULL,
  `totalprice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  `status` smallint(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`, `status`) VALUES
(3, 'pizza', 'Food_Category_790.jpg', 'Yes', 'Yes', 1),
(4, 'burger', 'Food_Category_139.jpg', 'Yes', 'Yes', 1),
(7, 'fingerfoods', 'Food_Category_822.jpg', 'Yes', 'Yes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `userType` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `full_name`, `username`, `userType`, `password`, `status`) VALUES
(13, 'administrator', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(14, 'Administrator1', 'admin1', 'admin', 'e00cf25ad42683b3df678c61f42c6bda', 1),
(18, 'leomarr123', 'cashierr', 'cashier', 'd41d8cd98f00b204e9800998ecf8427e', 1),
(20, 'Fema Rose', 'femfem', 'cashier', '0cc175b9c0f1b6a831c399e269772661', 1),
(29, 'calvin', 'calvin', 'cashier', '0d10816f0747122b364be502ad5a360c', 0),
(31, 'kiosk', 'kiosk', 'kiosk', '4b83c256a7ee37fef090378006304e15', 1),
(32, 'abab', 'abab', 'cashier', '585adf88cdd3693831b0748f409ce846', 1),
(33, 'calvin', 'calvin', 'cashier', '6ac2470ed8ccf204fd5ff89b32a355cf', 1),
(38, '1', 'admin@gmail.com', 'cashier', '37f113e732e039d9f9a5e9570b02d290', 1),
(39, 'kenneth1234', 'cs@gmail.com', 'cashier', 'dff84ee6607805e2764c81e23e6f22c0', 1),
(40, 'cashier', 'cashier@gmail.com', 'cashier', '3ed92fcab5552beca4ed926b85525332', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  `Stocks` int(11) NOT NULL,
  `status` tinyint(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`, `Stocks`, `status`) VALUES
(10, 'pzza', 'saddas12134', '111.00', 'Food Name6762.jpg', 3, 'Yes', 'Yes', 0, 1),
(25, 'dfgfd', 'sdafhjfhgds', '100.00', 'Food-Name7751.jpg', 3, 'Yes', 'Yes', 0, 1),
(26, 'sdfghj', 'sdfghj', '1.00', 'Food Name22.jpg', 3, 'Yes', 'Yes', 36, 1),
(27, 'fdgdxd', 'dfgdfx', '34.00', 'Food-Name4077.jpg', 3, 'No', 'Yes', 34, 1),
(28, 'patty', 'swabe lang', '123.00', 'Food-Name9162.jpg', 3, 'Yes', 'Yes', 87, 1),
(29, 'burnt fries', 'food description sunog', '50.00', 'Food Name9041.jpg', 3, 'Yes', 'Yes', 8, 1),
(30, 'shomai nga balabaw ', 'licking good', '2.00', 'Food Name6770.jpg', 7, 'Yes', 'Yes', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(100) NOT NULL,
  `cus_name` varchar(100) NOT NULL,
  `total` int(100) NOT NULL,
  `cash` decimal(10,2) DEFAULT NULL,
  `change_amount` decimal(10,2) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `order_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `cus_name`, `total`, `cash`, `change_amount`, `time`, `date`, `status`, `order_type`) VALUES
(42, 'leomar gwapo', 124, '200.00', '76.00', '15:57:16', '2023-04-23', 1, 'Take-out'),
(48, 'leomar gwapo', 123, NULL, NULL, NULL, '2023-04-26', 0, 'Take-out');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `item_name`, `price`, `qty`, `total_price`, `order_type`) VALUES
(2, 'pizzalicious', 222, 1, '0.00', ''),
(3, 'burgerking2', 111, 1, '0.00', ''),
(3, 'dumplings', 5, 1, '0.00', ''),
(4, 'burgerking2', 111, 1, '0.00', ''),
(4, 'pizzalicious', 222, 1, '0.00', ''),
(4, 'fried and fries', 500, 1, '0.00', ''),
(5, 'burgerking2', 111, 1, '0.00', ''),
(6, 'burgerking2', 111, 4, '0.00', ''),
(7, 'burgerking2', 111, 3, '0.00', ''),
(8, 'burgerking2', 111, 1, '0.00', ''),
(8, 'pzza', 111, 1, '0.00', ''),
(8, 'dumplings', 5, 1, '0.00', ''),
(8, 'pizzalicious', 222, 1, '0.00', ''),
(8, 'fried and fries', 500, 1, '0.00', ''),
(9, 'pizzalicious', 222, 1, '0.00', ''),
(9, 'dumplings', 5, 1, '0.00', ''),
(10, 'dumplings', 5, 1, '5.00', ''),
(11, 'pizzalicious', 222, 10, '5000.00', ''),
(11, 'burger3', 111, 9, '5000.00', ''),
(11, 'fried and fries', 500, 10, '5000.00', ''),
(12, 'dumplings', 5, 10, '50.00', ''),
(12, 'fried and fries', 500, 9, '4500.00', ''),
(12, 'burger3', 111, 7, '777.00', ''),
(13, 'burgerking2', 111, 8, '888.00', ''),
(13, 'burger3', 111, 4, '444.00', ''),
(13, 'pizzalicious', 222, 10, '2220.00', ''),
(13, 'pzza', 111, 9, '999.00', ''),
(14, 'burger3', 111, 4, '444.00', ''),
(14, 'pizzalicious', 222, 7, '1554.00', ''),
(14, 'fried and fries', 500, 5, '2500.00', ''),
(15, 'burgerking2', 111, 5, '555.00', ''),
(15, 'burger3', 111, 9, '999.00', ''),
(15, 'pizzalicious', 222, 8, '1776.00', ''),
(16, 'burgerking2', 111, 5, '555.00', ''),
(16, 'pzza', 111, 7, '777.00', ''),
(16, 'dumplings', 5, 10, '50.00', ''),
(16, 'pizzalicious', 222, 10, '2220.00', ''),
(17, 'burgerking2', 111, 5, '555.00', ''),
(17, 'pizzalicious', 222, 5, '1110.00', ''),
(18, 'pzza', 111, 5, '555.00', ''),
(18, 'fried and fries', 500, 5, '2500.00', ''),
(19, 'burgerking2', 111, 5, '555.00', ''),
(20, 'burgerking2', 111, 1, '111.00', ''),
(20, 'burger3', 111, 1, '111.00', ''),
(20, 'pizzalicious (large)', 200, 1, '200.00', ''),
(21, 'burgerking2', 111, 5, '555.00', ''),
(21, 'pizzalicious', 222, 1, '222.00', ''),
(21, 'dumplings', 5, 1, '5.00', ''),
(21, 'burger3', 111, 1, '111.00', ''),
(21, 'fried and fries', 500, 1, '500.00', ''),
(21, 'pzza', 111, 1, '111.00', ''),
(22, 'burger3', 111, 1, '111.00', ''),
(22, 'burgerking2', 111, 1, '111.00', ''),
(22, 'fried and fries', 500, 1, '500.00', ''),
(22, 'hawaiiaaan', 100, 1, '100.00', ''),
(22, 'pizzalicious (large)', 200, 1, '200.00', ''),
(23, 'burger3', 111, 1, '111.00', ''),
(23, 'pzza', 111, 1, '111.00', ''),
(23, 'hawaiiaaan', 100, 1, '100.00', ''),
(24, 'burgerking2', 111, 1, '111.00', ''),
(24, 'pizzalicious', 222, 1, '222.00', ''),
(24, 'burger3', 111, 1, '111.00', ''),
(25, 'dumplings', 5, 1, '5.00', ''),
(26, 'dumplings', 5, 1, '5.00', ''),
(27, 'burgerking2', 111, 1, '111.00', ''),
(28, 'pizzalicious', 222, 3, '666.00', ''),
(29, 'pizzalicious', 222, 1, '222.00', ''),
(30, 'gne', 200, 1, '200.00', ''),
(30, 'rapsa', 100, 1, '100.00', ''),
(30, 'gane man', 100, 1, '100.00', ''),
(31, 'gne', 200, 1, '200.00', ''),
(31, 'rapsa', 100, 1, '100.00', ''),
(31, 'gane man', 100, 1, '100.00', ''),
(32, 'burgerking2', 111, 5, '555.00', ''),
(32, 'pizzalicious', 222, 1, '222.00', ''),
(32, 'gane man', 100, 1, '100.00', ''),
(33, 'pizzalicious', 222, 1, '222.00', ''),
(33, 'fried and fries', 501, 1, '501.00', ''),
(34, 'pizzalicious', 222, 1, '222.00', ''),
(34, 'gane man', 100, 1, '100.00', ''),
(34, 'gne', 200, 1, '200.00', ''),
(35, 'pizzalicious', 222, 10, '2220.00', ''),
(36, 'fried and fries', 501, 1, '501.00', ''),
(37, 'pizzalicious', 222, 1, '222.00', ''),
(38, 'pzza', 111, 1, '111.00', ''),
(39, 'patty', 123, 1, '123.00', ''),
(39, 'sdfghj', 1, 1, '1.00', ''),
(39, 'pzza', 111, 2, '222.00', ''),
(40, 'patty', 123, 1, '123.00', ''),
(40, 'burnt fries', 50, 1, '50.00', ''),
(41, 'dfgfd', 100, 5, '500.00', ''),
(42, 'sdfghj', 1, 1, '1.00', ''),
(42, 'patty', 123, 1, '123.00', ''),
(43, 'sdfghj', 1, 1, '1.00', ''),
(44, 'patty', 123, 1, '123.00', ''),
(45, 'patty', 123, 1, '123.00', ''),
(46, 'sdfghj', 1, 1, '1.00', ''),
(47, 'patty', 123, 1, '123.00', ''),
(48, 'patty', 123, 1, '123.00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
