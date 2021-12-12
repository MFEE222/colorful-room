-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2021 at 02:42 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `colorful`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(5) NOT NULL,
  `descriptions` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_before` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_after` varchar(50) NOT NULL,
  `dng_pkg` varchar(50) NOT NULL,
  `category_id` int(3) UNSIGNED DEFAULT NULL,
  `sold_total` int(10) NOT NULL,
  `create_date` datetime NOT NULL,
  `auto_create_date` datetime NOT NULL,
  `auto_delete_date` datetime NOT NULL,
  `valid` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `descriptions`, `image_before`, `image_after`, `dng_pkg`, `category_id`, `sold_total`, `create_date`, `auto_create_date`, `auto_delete_date`, `valid`) VALUES
(1, '濾鏡1', 100, '調色專用', 'image1.jpg', '', '', 1, 5, '2021-12-07 11:49:55', '2021-12-07 11:49:55', '2021-12-07 11:49:55', 1),
(2, '濾鏡2', 100, '調色專用', 'image2.jpg', '', '', 2, 10, '2021-12-07 11:49:55', '2021-12-07 11:49:55', '2021-12-07 11:49:55', 0),
(3, '濾鏡3', 100, '調色專用', 'image3.jpg', '', '', 3, 15, '2021-12-07 11:51:52', '2021-12-07 11:51:52', '2021-12-07 11:51:52', 1),
(4, '濾鏡4', 100, '調色專用', 'image4.jpg', '', '', 4, 20, '2021-12-07 11:51:52', '2021-12-07 11:51:52', '2021-12-07 11:51:52', 2),
(5, '濾鏡5', 100, '調色專用', 'image5.jpg', '', '', 5, 0, '2021-12-07 11:53:15', '2021-12-07 11:53:15', '2021-12-07 11:53:15', 0),
(25, '人像1', 100, '人像1', 'A人像_1.jpg', 'B人像_1.jpg', '人像_1.dng', 1, 0, '2021-12-09 16:14:57', '2021-12-09 16:14:57', '2021-12-09 16:14:57', 1),
(26, '人像2', 100, '人像2', 'B人像_2.jpg', 'A人像_2.jpg', '人像_2.dng', 2, 0, '2021-12-09 16:16:05', '2021-12-09 16:16:05', '2021-12-09 16:16:05', 1),
(27, '底片1', 100, '底片1', 'b-Film_1.jpg', 'a-Film_1.jpg', 'Film_1.dng', 3, 0, '2021-12-09 16:18:31', '2021-12-09 16:18:31', '2021-12-09 16:18:31', 1),
(28, '', 0, '', '', '', '', 0, 0, '2021-12-09 16:19:07', '2021-12-09 16:19:07', '2021-12-09 16:19:07', 1),
(29, '', 0, '', '', '', '', 0, 0, '2021-12-09 16:19:08', '2021-12-09 16:19:08', '2021-12-09 16:19:08', 1),
(30, '婚禮1', 100, '婚禮1', '婚禮測試AFTER.jpg', '婚禮測試BEFORE.jpg', '海风少女 DNG.dng', 0, 0, '2021-12-10 09:22:57', '2021-12-10 09:22:57', '2021-12-10 09:22:57', 1),
(31, '婚禮1', 100, '婚禮1', '婚禮測試BEFORE.jpg', '婚禮測試AFTER.jpg', '海风少女 DNG.dng', 4, 0, '2021-12-10 09:24:00', '2021-12-10 09:24:00', '2021-12-10 09:24:00', 1),
(32, '食物1', 100, '食物1', '食物01BRFORE.jpg', '食物01AFTER.jpg', '食物01.dng', 3, 0, '2021-12-10 09:26:10', '2021-12-10 09:26:10', '2021-12-10 09:26:10', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
