-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2021 at 11:37 PM
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
CREATE DATABASE IF NOT EXISTS `colorful` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `colorful`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(6) UNSIGNED NOT NULL,
  `admin_account` varchar(30) DEFAULT NULL,
  `admin_password` varchar(50) DEFAULT NULL,
  `admin_name` varchar(30) DEFAULT NULL,
  `admin_valid` tinyint(4) NOT NULL DEFAULT 1,
  `admin_hint` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_account`, `admin_password`, `admin_name`, `admin_valid`, `admin_hint`) VALUES
(1, 'colorful', 'abc123', 'Chris', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(6) UNSIGNED NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'wedding', ''),
(2, 'food', ''),
(3, 'film', ''),
(4, 'scenery', ''),
(5, 'portrait', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(6) UNSIGNED NOT NULL,
  `account` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `edit_at` datetime DEFAULT NULL,
  `valid` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `account`, `name`, `password`, `email`, `phone`, `created_at`, `edit_at`, `valid`) VALUES
(1, '1', 'John', '12345', 'john@test.com', 123456789, '2021-12-02 19:30:52', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(6) UNSIGNED NOT NULL,
  `account` varchar(30) DEFAULT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(20) NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(20) NOT NULL,
  `subscribe` int(6) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `edit_at` datetime DEFAULT NULL,
  `valid` tinyint(4) DEFAULT NULL,
  `tag_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `account`, `name`, `birthday`, `gender`, `password`, `email`, `phone`, `subscribe`, `created_at`, `edit_at`, `valid`, `tag_id`) VALUES
(1, 'anna', '多多', '1990/12/01', 1, '12345', 'anna@test.com', 123456789, 0, '2021-12-02 14:06:49', '2021-12-04 18:00:09', 1, '2'),
(2, 'flower', '花花花', '1990/12/01', 1, '827ccb0eea8a706c4c34a16891f84e', 'anna@test.com', 123456789, 0, '2021-12-02 23:15:38', '2021-12-06 19:29:31', 1, '2'),
(3, 'momo', '毛毛', '1990/12/01', 1, '827ccb0eea8a706c4c34a16891f84e', 'anna@test.com', 123456789, 0, '2021-12-02 23:35:48', '2021-12-04 18:04:42', 1, '2'),
(4, 'bubble', '泡泡', '1990/12/12', 0, '827ccb0eea8a706c4c34a16891f84e', 'anna@test.com', 123456789, 0, '2021-12-03 12:45:38', '2021-12-04 18:12:22', 1, '2'),
(5, 'dodo', '多多', '1990/12/01', 1, '827ccb0eea8a706c4c34a16891f84e', 'anna@test.com', 123456789, 0, '2021-12-04 14:48:12', '2021-12-04 18:00:09', 1, '2'),
(6, 'chuchu', '魔人啾啾', '1990/12/01', 1, 'eccbc87e4b5ce2fe28308fd9f2a7ba', 'anna@test.com', 123456789, 0, '2021-12-04 16:18:20', '2021-12-06 17:21:31', 1, '2'),
(7, '666', '陶靖宇', '', 1, '45c48cce2e2d7fbdea1afc51c7c6ad', 'queena40723@gmail.com', 911890023, 1, '2021-12-06 18:56:04', NULL, 1, '2'),
(15, '1', '1', '1', 1, 'c4ca4238a0b923820dcc509a6f75849b', '1', 1, 2, '2021-12-08 23:29:14', NULL, 1, '2');

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
(5, '濾鏡5', 100, '調色專用', 'image5.jpg', '', '', 5, 0, '2021-12-07 11:53:15', '2021-12-07 11:53:15', '2021-12-07 11:53:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

DROP TABLE IF EXISTS `subscribe`;
CREATE TABLE `subscribe` (
  `id` int(3) UNSIGNED NOT NULL,
  `subscribe_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribe_describe` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `subscribe_name`, `subscribe_describe`) VALUES
(1, '1', '30天'),
(2, '2', '60天'),
(3, '3', '90天'),
(4, '4', '1年');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'VIP'),
(2, '一般會員');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
