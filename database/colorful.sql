<<<<<<< HEAD
git-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-12-06 17:27:33
-- 伺服器版本： 10.4.21-MariaDB
-- PHP 版本： 8.0.12
=======
-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2021 at 05:39 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
<<<<<<< HEAD
-- 資料庫: `colorful`
=======
-- Database: `colorful`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--
CREATE DATABASE IF NOT EXISTS `colorful` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `colorful`;

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- 資料表結構 `admin`
=======
-- Table structure for table `admin`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(6) UNSIGNED NOT NULL,
  `admin_account` varchar(30) DEFAULT NULL,
  `admin_password` varchar(50) DEFAULT NULL,
  `admin_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
<<<<<<< HEAD
-- 傾印資料表的資料 `admin`
=======
-- Dumping data for table `admin`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--

INSERT INTO `admin` (`admin_id`, `admin_account`, `admin_password`, `admin_name`) VALUES
(1, 'colorful', 'abc123', 'Chris');

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- 資料表結構 `category`
=======
-- Table structure for table `category`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(6) UNSIGNED NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
<<<<<<< HEAD
-- 傾印資料表的資料 `category`
=======
-- Dumping data for table `category`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'wedding', ''),
(2, 'food', ''),
(3, 'film', ''),
(4, 'scenery', ''),
(5, 'portrait', '');

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- 資料表結構 `customer`
=======
-- Table structure for table `customer`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
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
<<<<<<< HEAD
-- 傾印資料表的資料 `customer`
=======
-- Dumping data for table `customer`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--

INSERT INTO `customer` (`id`, `account`, `name`, `password`, `email`, `phone`, `created_at`, `edit_at`, `valid`) VALUES
(1, '1', 'John', '12345', 'john@test.com', 123456789, '2021-12-02 19:30:52', NULL, 1);

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- 資料表結構 `member`
=======
-- Table structure for table `member`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(6) UNSIGNED NOT NULL,
  `account` varchar(30) DEFAULT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(20) NOT NULL,
  `password` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(20) NOT NULL,
  `subscribe` int(6) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `edit_at` datetime DEFAULT NULL,
  `valid` tinyint(4) DEFAULT NULL,
  `tag_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
<<<<<<< HEAD
-- 傾印資料表的資料 `member`
=======
-- Dumping data for table `member`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--

INSERT INTO `member` (`id`, `account`, `name`, `birthday`, `gender`, `password`, `email`, `phone`, `subscribe`, `created_at`, `edit_at`, `valid`, `tag_id`) VALUES
(1, 'anna', '多多', '1990/12/01', 1, '12345', 'anna@test.com', 123456789, 0, '2021-12-02 14:06:49', '2021-12-04 18:00:09', 0, '2'),
(2, 'anna', '花花', '1990/12/01', 1, '827ccb0eea8a706c4c34a16891f84e', 'anna@test.com', 123456789, 0, '2021-12-02 23:15:38', '2021-12-04 18:04:25', 1, '2'),
(3, 'anna', '毛毛', '1990/12/01', 1, '827ccb0eea8a706c4c34a16891f84e', 'anna@test.com', 123456789, 0, '2021-12-02 23:35:48', '2021-12-04 18:04:42', 1, '2'),
(4, 'anna', '泡泡', '1990/12/12', 0, '827ccb0eea8a706c4c34a16891f84e', 'anna@test.com', 123456789, 0, '2021-12-03 12:45:38', '2021-12-04 18:12:22', 1, '2'),
(5, 'anna', '多多', '1990/12/01', 1, '827ccb0eea8a706c4c34a16891f84e', 'anna@test.com', 123456789, 0, '2021-12-04 14:48:12', '2021-12-04 18:00:09', 1, '2'),
<<<<<<< HEAD
(6, 'poop', '魔人啾啾', '1990/12/01', 1, 'eccbc87e4b5ce2fe28308fd9f2a7ba', 'anna@test.com', 123456789, 0, '2021-12-04 16:18:20', '2021-12-06 17:21:31', 1, '2');
=======
(6, 'anna', '魔人啾啾', '1990/12/01', 1, 'eccbc87e4b5ce2fe28308fd9f2a7ba', 'anna@test.com', 123456789, 0, '2021-12-04 16:18:20', '2021-12-04 18:05:13', 1, '2');
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- 資料表結構 `subscribe`
=======
-- Table structure for table `subscribe`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--

DROP TABLE IF EXISTS `subscribe`;
CREATE TABLE `subscribe` (
  `id` int(3) UNSIGNED NOT NULL,
  `subscribe_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribe_describe` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
<<<<<<< HEAD
-- 傾印資料表的資料 `subscribe`
=======
-- Dumping data for table `subscribe`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--

INSERT INTO `subscribe` (`id`, `subscribe_name`, `subscribe_describe`) VALUES
(1, '1', '30天'),
(2, '2', '60天'),
(3, '3', '90天'),
(4, '4', '1年');

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- 資料表結構 `tag`
=======
-- Table structure for table `tag`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
<<<<<<< HEAD
-- 傾印資料表的資料 `tag`
=======
-- Dumping data for table `tag`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'VIP'),
(2, '一般會員');

--
<<<<<<< HEAD
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
=======
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
<<<<<<< HEAD
-- 資料表索引 `category`
=======
-- Indexes for table `category`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
<<<<<<< HEAD
-- 資料表索引 `customer`
=======
-- Indexes for table `customer`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
<<<<<<< HEAD
-- 資料表索引 `member`
=======
-- Indexes for table `member`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
<<<<<<< HEAD
-- 資料表索引 `subscribe`
=======
-- Indexes for table `subscribe`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
<<<<<<< HEAD
-- 資料表索引 `tag`
=======
-- Indexes for table `tag`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
<<<<<<< HEAD
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admin`
=======
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
<<<<<<< HEAD
-- 使用資料表自動遞增(AUTO_INCREMENT) `category`
=======
-- AUTO_INCREMENT for table `category`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--
ALTER TABLE `category`
  MODIFY `category_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
<<<<<<< HEAD
-- 使用資料表自動遞增(AUTO_INCREMENT) `customer`
=======
-- AUTO_INCREMENT for table `customer`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--
ALTER TABLE `customer`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
<<<<<<< HEAD
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
=======
-- AUTO_INCREMENT for table `member`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--
ALTER TABLE `member`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
<<<<<<< HEAD
-- 使用資料表自動遞增(AUTO_INCREMENT) `subscribe`
=======
-- AUTO_INCREMENT for table `subscribe`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--
ALTER TABLE `subscribe`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
<<<<<<< HEAD
-- 使用資料表自動遞增(AUTO_INCREMENT) `tag`
=======
-- AUTO_INCREMENT for table `tag`
>>>>>>> bca4caf62176a4d87ddd599993af2b4a26ac8ff7
--
ALTER TABLE `tag`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
