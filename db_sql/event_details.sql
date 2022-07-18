-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 03:10 PM
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
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `event_id` int(11) NOT NULL,
  `event_title` varchar(300) DEFAULT NULL,
  `start_event` datetime DEFAULT NULL,
  `end_event` datetime DEFAULT NULL,
  `user_email` varchar(128) NOT NULL,
  `event_tags` varchar(128) NOT NULL,
  `event_description` varchar(512) NOT NULL,
  `reminder_date` date NOT NULL,
  `event_timestamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`event_id`, `event_title`, `start_event`, `end_event`, `user_email`, `event_tags`, `event_description`, `reminder_date`, `event_timestamp`) VALUES
(1, 'Google', '2022-07-18 11:00:00', '2022-07-21 04:00:00', 'dshah5383@gmail.com', 'SEO, Adsense', '', '0000-00-00', '2022-07-15 04:44:08'),
(2, 'YoutubeTestEvent', '2022-08-01 11:00:00', '2022-08-01 22:00:00', '0', '', '', '0000-00-00', '2022-07-15 05:11:43'),
(5, 'DayEvent', '2022-07-20 12:30:00', '2022-07-20 14:30:00', '0', 'EventData', '', '0000-00-00', '2022-07-15 07:03:15'),
(6, 'CryptoEvent', '2022-08-03 18:00:00', '2022-08-05 16:00:00', 'admin@admin.com,dshah5383@gmail.com', 'BTCUSD, XRPUSD, Cryptocurrency', '', '0000-00-00', '2022-07-15 10:16:56'),
(8, 'EventTwo', '2022-07-21 01:30:00', '2022-07-21 09:00:00', 'admin@admin.com', '', '', '0000-00-00', '2022-07-18 04:27:25'),
(9, 'testevent', '2022-07-28 10:00:00', '2022-07-28 20:00:00', 'dshah5383@gmail.com', 'testone, testtwo', '', '2022-07-24', '2022-07-18 05:30:48'),
(10, 'Ghadeer Event', '2022-07-26 19:00:00', '2022-07-20 11:00:00', 'admin@admin.com', 'Ghadeer,Khum_e_ghadeer', 'Eid-e Ghadir, marking the anniversary of an important event in Muslim history.', '0000-00-00', '2022-07-18 07:24:36'),
(11, 'MultiUsers', '2022-07-20 16:00:00', '2022-07-25 20:00:00', 'dshah5383@gmail.com,theshahzad2019@gmail.com,admin@admin.com', 'tags,multitags', 'LONG DESCRIPTION OF MULTIUSERS', '0000-00-00', '2022-07-18 09:36:32'),
(12, 'Telecommuication', '2022-07-22 10:00:00', '2022-07-26 18:00:00', 'dshah5383@gmail.com,theshahzad2019@gmail.com', 'PTCL,ufone,zong,Nayatel', 'Lorem Ipsum especio re tuore countreca', '2022-07-21', '2022-07-18 12:05:50');

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
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
