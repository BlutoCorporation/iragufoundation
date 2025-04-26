-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 09:52 AM
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
-- Database: `getmyslot`
--

-- --------------------------------------------------------

--
-- Table structure for table `apts`
--

CREATE TABLE `apts` (
  `id` int(11) NOT NULL,
  `apt_name` varchar(100) NOT NULL,
  `apt_email` varchar(255) NOT NULL,
  `apt_num` varchar(50) NOT NULL,
  `apt_dt` varchar(100) NOT NULL,
  `owner` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apts`
--

INSERT INTO `apts` (`id`, `apt_name`, `apt_email`, `apt_num`, `apt_dt`, `owner`) VALUES
(2, 'saran', 'saranmass685@gmail.com', '9597236423', '25 Jan 2025 12:00 PM', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `created_at` date NOT NULL,
  `otp` varchar(11) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `username`, `password`, `email`, `phone`, `created_at`, `otp`, `otp_expiry`, `status`) VALUES
(77, 'test', '$2y$09$qGraOKiDkWQ.1OvIF.fd9uOLNLL.WSzeCIPpBVbHBZ89nBO2NfhgO', 'info.trymywebsites@gmail.com', '9597236423', '2025-01-04', NULL, NULL, 'verified'),
(78, 'saran', '$2y$09$GhYxt6ZAmUuCCq5gIiGANuvIoGvb3yqK2w7NufRsb3/3noXlmWh6q', 'saranmass685@gmail.com', '9597236423', '2025-01-18', NULL, NULL, 'verified'),
(81, 'saga', '$2y$09$Ai2cLNpE5jOlVPYUw/fAx.zqjbPASlFwxQLMXcW7nwS0Bd53x5Bhi', 'sagasaran43@gmail.com', '9345367423', '2025-01-18', NULL, NULL, 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `available_time`
--

CREATE TABLE `available_time` (
  `id` int(11) NOT NULL,
  `days` varchar(50) NOT NULL,
  `times` varchar(50) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `weeks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `available_time`
--

INSERT INTO `available_time` (`id`, `days`, `times`, `owner`, `weeks`) VALUES
(3, '2025-01-25', '12:00 PM', 'test', 'Monday'),
(4, '2025-02-25', '12:00 PM', 'saran', 'Sunday'),
(5, '2025-01-25', '01:00 PM', 'test', 'Monday'),
(6, '2025-01-26', '10:10 AM', 'test', 'Wednesday');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `uploaded_time` datetime NOT NULL,
  `owner` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `userid`, `rating`, `review`, `uploaded_time`, `owner`, `user`) VALUES
(1, 2, 4, 'this is very good', '2025-01-07 11:36:03', 'test', 'saran'),
(3, 4, 2, 'this is my second reviews', '2025-01-07 12:21:20', 'test', 'saga'),
(5, 2, 1, 'this is my second review', '2025-01-09 10:36:15', 'test', 'saran'),
(6, 4, 2, 'this is my 4th review', '2025-01-18 11:18:50', 'saran', 'saga'),
(9, 1, 3, 'hi test', '2025-01-18 16:16:22', 'saran', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `Facebook` text NOT NULL,
  `Instagram` text NOT NULL,
  `X` text NOT NULL,
  `LinkedIn` text NOT NULL,
  `owner` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `Facebook`, `Instagram`, `X`, `LinkedIn`, `owner`, `userid`) VALUES
(1, 'fb', 'insta', 'x', 'link', 'test', 77);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` varchar(5) NOT NULL,
  `bio` longtext NOT NULL,
  `avatar` varchar(1024) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `location` varchar(100) NOT NULL,
  `languages` varchar(100) NOT NULL,
  `status` varchar(45) NOT NULL,
  `uploaded_time` datetime DEFAULT NULL,
  `owner` varchar(50) NOT NULL,
  `role` varchar(100) NOT NULL,
  `field` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `bio`, `avatar`, `gender`, `location`, `languages`, `status`, `uploaded_time`, `owner`, `role`, `field`) VALUES
(1, '77', 'MBBS', 'assets/img/user.png', 'Male', 'Coimbatore, TN', 'Tamil, English', 'I am Available Now', '2025-01-04 10:38:41', 'test', 'Gynecologist', 'Doctor'),
(2, '78', '', 'uploads/avatars/avatar_678b2ee125d459.40209122.png', '', '', '', '', '2025-01-18 09:57:48', 'saran', 'Dentist', 'Doctor'),
(4, '81', 'ECE', 'assets/img/user.png', 'Male', 'coimbatore', 'Tamil', 'I am Available Now', '2025-01-18 14:25:47', 'saga', 'Water wash car & bike', 'Mechanic');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apts`
--
ALTER TABLE `apts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `available_time`
--
ALTER TABLE `available_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apts`
--
ALTER TABLE `apts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `available_time`
--
ALTER TABLE `available_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
