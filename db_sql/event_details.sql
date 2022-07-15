-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2022 at 01:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_details`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar_plugin`
--

CREATE TABLE `calendar_plugin` (
  `fw_id` int(11) NOT NULL,
  `fw_title` varchar(300) DEFAULT NULL,
  `fw_start_event` datetime DEFAULT NULL,
  `fw_end_event` datetime DEFAULT NULL,
  `user_email` varchar(128) NOT NULL,
  `event_tags` varchar(128) NOT NULL,
  `fw_timestamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calendar_plugin`
--

INSERT INTO `calendar_plugin` (`fw_id`, `fw_title`, `fw_start_event`, `fw_end_event`, `user_email`, `event_tags`, `fw_timestamp`) VALUES
(1, 'Google', '2022-07-18 11:00:00', '2022-07-22 04:00:00', 'dshah5383@gmail.com', 'SEO, Adsense', '2022-07-15 04:44:08'),
(2, 'YoutubeTestEvent', '2022-08-01 11:00:00', '2022-08-01 22:00:00', '0', '', '2022-07-15 05:11:43'),
(3, 'Testing', '2022-07-26 14:00:00', '2022-07-27 00:00:00', 'dshah5383@gmail.com', 'Test, Testing, testtwo', '2022-07-15 05:29:34'),
(5, 'DayEvent', '2022-07-15 17:00:00', '2022-07-15 19:00:00', '0', '', '2022-07-15 07:03:15'),
(6, 'CryptoEvent', '2022-07-27 18:00:00', '2022-07-29 16:00:00', 'admin@admin.com', 'BTCUSD. XRPUSD, Cryptocurrency', '2022-07-15 10:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `code` varchar(20) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `code`, `active`) VALUES
(1, 'Dshah', 'dshah5383@gmail.com', 'dshah123', 'Y5dgmZ8bEA3T', 0),
(2, 'shahzad', 'theshahzad2019@gmail.com', 'test123', 'Cp7TVsSq3oP2', 0),
(3, 'admin', 'admin@admin.com', 'admin', 'kSmhQdIxt87D', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar_plugin`
--
ALTER TABLE `calendar_plugin`
  ADD PRIMARY KEY (`fw_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar_plugin`
--
ALTER TABLE `calendar_plugin`
  MODIFY `fw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
