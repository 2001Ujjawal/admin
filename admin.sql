-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2025 at 08:12 AM
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
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uid` varchar(121) DEFAULT NULL,
  `name` varchar(121) DEFAULT NULL,
  `email` varchar(121) DEFAULT NULL,
  `image` varchar(121) DEFAULT NULL,
  `address_json` varchar(121) DEFAULT NULL,
  `lat` varchar(121) DEFAULT NULL,
  `long` varchar(121) DEFAULT NULL,
  `geo_hash` varchar(121) DEFAULT NULL,
  `password` varchar(121) DEFAULT NULL,
  `type` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(121) DEFAULT NULL,
  `last_updated_by` varchar(121) DEFAULT NULL,
  `last_updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_setting`
--

CREATE TABLE `user_setting` (
  `id` int(11) NOT NULL,
  `uid` varchar(121) NOT NULL,
  `user_id` varchar(121) NOT NULL,
  `is_two_steup_authentication` tinyint(1) NOT NULL DEFAULT 0,
  `allow_login_device` int(11) DEFAULT NULL,
  `created_at` varchar(121) NOT NULL,
  `created_by` varchar(121) NOT NULL,
  `last_updated_by` varchar(121) NOT NULL,
  `last_updated_at` varchar(121) NOT NULL,
  `otp_send_type` enum('email','phone','whatapp','device_permission') NOT NULL DEFAULT 'email'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_uid` (`uid`);

--
-- Indexes for table `user_setting`
--
ALTER TABLE `user_setting`
  ADD UNIQUE KEY `user_setting_uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
