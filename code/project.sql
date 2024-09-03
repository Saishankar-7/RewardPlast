-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 04:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` int(10) NOT NULL,
  `image` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `username`, `street`, `city`, `state`, `postal_code`, `image`) VALUES
(12, 'saishankar__7', 'bekkampalem', 'vizag', 'Andhra pradesh', 531001, '66d713956ae04.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `s.no` int(2) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `confirmpassword` varchar(500) NOT NULL,
  `user_type` varchar(500) NOT NULL DEFAULT 'user',
  `plasticAmount` int(200) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`s.no`, `name`, `email`, `username`, `password`, `confirmpassword`, `user_type`, `plasticAmount`) VALUES
(1, 'saishankar', 'tumpalasaisankar@gmail.com', 'sai__7', 'Apt123123@', 'Apt123123@', 'admin', NULL),
(2, 'jayraj', 'jayaraj@gmail.com', 'jay__7', 'Apt123123@', 'Apt123123@', 'admin', 0),
(4, 'kal', 'kal12@gmail.com', 'kumar', 'Kalyan@123', 'Kalyan@123', 'user', 0),
(5, '  jayraj', 'tumpalasaisankar@gmail.com', 'jayyy_7', 'Apt123123@', 'Apt123123@', 'user', NULL),
(8, 'charan', 'chra@gmail.com', 'charan', 'Apt123123@', 'Apt123123@', 'user', 5000),
(10, 'Laxmi Narasimha', 'nara420@gmail.com', 'lucky_143', 'Apt123123@', 'Apt123123@', 'user', 0),
(17, 'urvasi', 'ursavi1232@gmail.com', 'urvasi_122', 'Apt123123@', 'Apt123123@', 'admin', 0),
(19, 'Sai shankar', 'tumpalasaisankar@gmail.com', 'saishankar__7', 'Sai@2009', 'Sai@2009', 'user', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `s.no` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `plasticAmount` int(10) NOT NULL DEFAULT 0,
  `payment_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`s.no`, `username`, `plasticAmount`, `payment_time`) VALUES
(2, 'sam__7', 133, '2024-09-01 14:15:20.896099'),
(3, 'Sri__7', 155, '2024-09-01 14:15:20.896099'),
(4, 'yadhi_7', 185, '2024-09-01 14:15:20.896099'),
(5, 'sam__7', 200, '2024-09-01 14:15:20.896099'),
(6, 'sam__7', 300, '2024-09-01 14:15:20.896099'),
(7, 'charan', 5000, '2024-09-01 14:18:34.000000'),
(8, 'Saishankar__7', 9000, '2024-09-03 11:42:03.000000');

-- --------------------------------------------------------

--
-- Table structure for table `resetpasswords`
--

CREATE TABLE `resetpasswords` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resetpasswords`
--

INSERT INTO `resetpasswords` (`id`, `code`, `username`) VALUES
(5, '166d6f9c8d2428', 'saishankar__7'),
(7, '166d6fb1b9831a', 'saishankar__7'),
(9, '166d707aad83ab', 'saishankar__7');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`) VALUES
(3, 'demo', 'demo_1', 'for@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `username`, `image`) VALUES
(1, 'sam__7', '6517bec2186fb.jpg'),
(2, 'rajasri', '6517b0ece4e47.jpg'),
(3, 'sai__7', '651973f168a80.jpg'),
(4, 'saishankar__7', '66d71313d1ff7.jpg'),
(5, 'charan', '66d4783f28bc9.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`s.no`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`s.no`);

--
-- Indexes for table `resetpasswords`
--
ALTER TABLE `resetpasswords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `s.no` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `s.no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `resetpasswords`
--
ALTER TABLE `resetpasswords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
