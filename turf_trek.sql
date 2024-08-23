-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2024 at 01:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `turf_trek`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `turf_name` varchar(255) NOT NULL,
  `turf_id` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `user_id`, `turf_name`, `turf_id`, `customer_name`, `date`, `from_time`, `to_time`, `category`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'demo1', '123abc456efg1', 'demo_name_1', '2024-07-17', '18:34:00', '19:34:00', 'C', '300', '2024-07-15 10:04:50', '2024-07-15 10:04:50'),
(2, 1, 'demo2', '456acb123efg', 'demo_name_2', '2024-07-15', '15:36:00', '16:36:00', 'A', '300', '2024-07-15 10:06:52', '2024-07-15 10:06:52'),
(3, 1, 'demo3', '456acb123efg', 'demo_name_3', '2024-07-10', '16:00:00', '17:00:00', 'A+B', '600', '2024-07-15 10:29:58', '2024-07-15 10:29:58'),
(4, 1, 'demo4', '456acb123efg', 'demo_name_4', '2024-07-24', '19:00:00', '20:00:00', 'B', '300', '2024-07-15 10:37:35', '2024-07-15 10:37:35'),
(5, 1, 'demo5', '456acb123efg', 'demo_name_5', '2024-07-17', '10:00:00', '11:00:00', 'B+C', '600', '2024-07-17 04:30:28', '2024-07-17 04:30:28'),
(6, 1, 'demo6', '123abc456efg1', 'demo_name_6', '2024-07-22', '00:00:00', '01:00:00', 'C', '400', '2024-07-22 06:00:29', '2024-07-22 06:00:29'),
(7, 1, 'demo7', '123abc456efg1', 'demo_name_7', '2024-07-22', '01:00:00', '02:00:00', 'C', '300', '2024-07-22 06:05:28', '2024-07-22 06:05:28'),
(8, 1, 'demo8', '456acb123efg', 'demo_name_8', '2024-07-23', '13:30:00', '14:50:00', 'B+C', '600', '2024-07-23 09:02:42', '2024-07-23 09:02:42'),
(9, 1, 'demo9', '123abc456efg', 'demo_name_9', '2024-07-23', '15:00:00', '16:00:00', 'B+C', '600', '2024-07-23 09:03:51', '2024-07-23 09:03:51'),
(10, 1, 'demo10', '456acb123efg', 'demo_name_10', '2024-07-19', '16:34:00', '18:37:00', 'C', '3000', '2024-07-23 09:04:26', '2024-07-23 09:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `user_id`, `category_name`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'A', '300', 0, '2024-06-20 09:54:41', '2024-06-20 09:54:41'),
(2, 2, 'B', '300', 0, '2024-06-21 07:04:45', '2024-06-21 07:04:45'),
(3, 2, 'C', '300', 0, '2024-06-21 07:05:10', '2024-06-21 07:05:10'),
(4, 2, 'A+B', '600', 0, '2024-07-12 05:47:09', '2024-07-12 05:47:09'),
(5, 2, 'B+C', '600', 0, '2024-07-12 05:47:28', '2024-07-12 05:47:28'),
(6, 2, 'A+B+C', '1000', 0, '2024-07-12 05:47:48', '2024-07-12 05:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `user_id`, `city`, `state`, `code`, `country`, `created_at`, `updated_at`) VALUES
(1, 1, 'bhilwara', 'rajasthan', '313110', 'India', '2024-06-20 09:42:40', '2024-06-20 09:42:40'),
(2, 1, 'udaipur', 'rajasthan', '313001', 'India', '2024-06-21 07:10:55', '2024-06-21 07:10:55'),
(3, 1, 'jaipur', 'rajasthan', '302001', 'India', '2024-06-21 07:12:09', '2024-06-21 07:12:09');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `mobile_num` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games_category`
--

CREATE TABLE `games_category` (
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games_category`
--

INSERT INTO `games_category` (`game_id`, `user_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cricket', '2024-08-23 07:08:15', '2024-08-23 07:08:15'),
(2, 1, 'Football', '2024-08-23 07:08:34', '2024-08-23 07:08:34'),
(3, 1, 'Badminton', '2024-08-23 07:08:57', '2024-08-23 07:08:57'),
(4, 1, 'Basketball', '2024-08-23 07:09:33', '2024-08-23 07:09:33'),
(5, 1, 'Tennis', '2024-08-23 07:10:07', '2024-08-23 07:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `select_games`
--

CREATE TABLE `select_games` (
  `select_game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `select_games`
--

INSERT INTO `select_games` (`select_game_id`, `user_id`, `city_id`, `game_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-08-23 07:20:20', '2024-08-23 07:20:20'),
(2, 1, 1, 2, '2024-08-23 07:20:20', '2024-08-23 07:20:20'),
(3, 1, 1, 5, '2024-08-23 07:20:20', '2024-08-23 07:20:20'),
(4, 1, 2, 1, '2024-08-23 07:20:34', '2024-08-23 07:20:34'),
(5, 1, 2, 2, '2024-08-23 07:20:34', '2024-08-23 07:20:34'),
(6, 1, 2, 3, '2024-08-23 07:20:34', '2024-08-23 07:20:34'),
(7, 1, 2, 4, '2024-08-23 07:20:34', '2024-08-23 07:20:34'),
(8, 1, 3, 1, '2024-08-23 07:20:44', '2024-08-23 07:20:44'),
(9, 1, 3, 2, '2024-08-23 07:20:44', '2024-08-23 07:20:44'),
(10, 1, 3, 5, '2024-08-23 07:20:44', '2024-08-23 07:20:44'),
(11, 2, 2, 1, '2024-08-23 07:26:53', '2024-08-23 07:26:53'),
(12, 2, 2, 2, '2024-08-23 07:26:53', '2024-08-23 07:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `turf_name` varchar(255) NOT NULL,
  `turf_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(10) NOT NULL,
  `post_img` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `turf_name`, `turf_id`, `address`, `city`, `email`, `mobile`, `post_img`, `password`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '123abc456efg', 'demo turf address', 'bhilwara_main_ location', 'admin@gmail.com', 1234567890, 'Frame 7.png', '123456', 'admin', '2024-06-20 11:59:59', '2024-06-20 11:59:59'),
(2, 'demo turf 1', '456acb123efg', 'demo turf address 1', 'bhilwara_main_ location', 'demo_1@gmail.com', 1234567890, '53261.jfif', '1234', 'user', '2024-06-20 12:01:21', '2024-06-20 12:01:21'),
(3, 'demo turf 2', '123abc456efg', 'demo turf address 2', 'udaipur_main_ location', 'demo_2@gmail.com', 1234567890, 'synthetic-football-ground-500x500.webp', '1234', 'user', '2024-06-21 07:13:02', '2024-06-21 07:13:02'),
(4, 'demo turf 3', '123abc456efg1', 'demo turf address 3', 'jaipur_main_ location', 'demo_3@gmail.com', 1234567890, 'sports-turf-grounds-4-sports-turf-grounds-3-xfv44.jpg', '1234', 'user', '2024-06-21 07:14:42', '2024-06-21 07:14:42'),
(5, 'demo turf 4', '123abc456efg', 'demo turf address 4', 'udaipur_main_ location', 'demo_4@gmail.com', 1234567890, 'images.jfif', '1234', 'user', '2024-06-21 07:15:24', '2024-06-21 07:15:24'),
(6, 'demo turf 5', '123abc456efg1', 'demo turf address 5', 'udaipur_main_ location', 'demo_5@gmail.com', 1234567890, '1630669298_sky-turf.jpg', '1234', 'user', '2024-06-26 06:21:15', '2024-06-26 06:21:15'),
(7, 'demo', '123456', 'asdsd', 'bhilwara_main_ location', 'harshita1soni23@gmail.com', 1234567890, 'pngegg.png', '123456', 'user', '2024-08-21 09:51:53', '2024-08-21 09:51:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `games_category`
--
ALTER TABLE `games_category`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `select_games`
--
ALTER TABLE `select_games`
  ADD PRIMARY KEY (`select_game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games_category`
--
ALTER TABLE `games_category`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `select_games`
--
ALTER TABLE `select_games`
  MODIFY `select_game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
