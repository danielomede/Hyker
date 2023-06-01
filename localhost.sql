-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2023 at 12:13 AM
-- Server version: 5.7.42-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trfinanc_hyker`
--
CREATE DATABASE IF NOT EXISTS `trfinanc_hyker` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `trfinanc_hyker`;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` varchar(20) NOT NULL,
  `user1` varchar(50) NOT NULL,
  `user2` varchar(50) NOT NULL,
  `lastmsg` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL,
  `chat_id` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `name`, `message`, `chat_id`, `timestamp`) VALUES
(1, '', 'Yt46', '', '2023-04-19 15:12:40'),
(2, '', '', '', '2023-04-19 15:12:43'),
(3, '', 'Rrr', '', '2023-04-19 15:14:40'),
(4, '', 'yyy', '', '2023-04-19 15:25:39'),
(5, 'Apethief', '777', '', '2023-04-20 10:29:46'),
(6, 'Apethief', '777', '', '2023-04-20 10:29:46'),
(7, 'Apethief', '6ygv', '', '2023-04-20 10:29:56'),
(8, 'Apethief', '6ygv', '', '2023-04-20 10:29:56'),
(9, 'Apethief', '67', '', '2023-04-20 10:30:45'),
(10, 'Apethief', 'gg', '', '2023-04-20 10:30:51'),
(11, 'Apethief', 'ty', '', '2023-04-20 10:33:52'),
(12, 'Apethief', '6tchv', '', '2023-04-20 10:33:57'),
(13, 'Apethief', 'Unbelievable', '', '2023-04-20 10:34:06'),
(14, 'Apethief', 'Nice one', '', '2023-04-20 10:34:11'),
(15, 'Apethief', '', '', '2023-04-25 16:19:33'),
(16, 'Apethief', 'iyiyb', '', '2023-04-25 16:20:40'),
(17, 'Apethief', 'Test', '', '2023-04-25 16:27:12'),
(18, 'Apethief', 'kkk', '', '2023-04-25 16:29:12'),
(19, 'Apethief', 'uuu', '', '2023-04-25 16:30:16'),
(20, 'Apethief', 'Status', '', '2023-04-25 16:33:03'),
(21, 'Apethief', '675', '', '2023-04-25 16:38:11'),
(22, 'Apethief', '333', '', '2023-04-25 16:42:02'),
(23, 'Apethief', '999', '', '2023-04-25 16:46:38'),
(24, 'Apethief', 'yhdhws', '', '2023-04-25 16:54:59'),
(25, 'Apethief', 'Windows', '', '2023-04-25 16:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `createdby` varchar(50) NOT NULL,
  `admin` varchar(10) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `details` varchar(100) NOT NULL,
  `datecreated` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `eventdate` date NOT NULL,
  `eventtime` time NOT NULL,
  `location` varchar(100) NOT NULL,
  `rallypoint` varchar(100) NOT NULL,
  `imgurl` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `cost` decimal(10,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `createdby`, `admin`, `reference`, `details`, `datecreated`, `status`, `eventdate`, `eventtime`, `location`, `rallypoint`, `imgurl`, `category`, `cost`) VALUES
(1, 'Fitness Meetup', '1', '', 'EVNT7485135987', ' We will be exercising all day', '2023-04-28', 'Upcoming', '2023-04-30', '12:32:00', 'My House', 'Your house', 'default-banner.jpg', 'Aerobics', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `event_members`
--

CREATE TABLE `event_members` (
  `id` int(10) NOT NULL,
  `event_reference` varchar(20) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_members`
--

INSERT INTO `event_members` (`id`, `event_reference`, `userid`, `timestamp`) VALUES
(1, 'EVNT7485135987', '1 ', '2023-04-28 09:36:46');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdby` varchar(50) NOT NULL,
  `imgurl` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `reference`, `state`, `status`, `datecreated`, `createdby`, `imgurl`) VALUES
(1, 'Abj City Run', '', 'GRP9123889476', '', 'new', '2023-04-20 14:12:43', ' ', 'media/7996704028'),
(2, 'Abuja run', '', 'GRP2342765618', '', 'new', '2023-04-20 14:15:38', '2 ', 'media/7089613515'),
(3, 'Benue Cruise', ' For the benefit', 'GRP7429848875', 'BORNO', 'new', '2023-04-20 14:18:09', '2 ', 'media/5413594559'),
(4, 'Mystique', ' For the culture', 'GRP5316783445', 'ABUJA FCT', 'new', '2023-04-20 14:53:41', '1 ', 'media/5319295060'),
(5, 'Mystic 2', ' The best group', 'GRP5434388400', 'ABUJA FCT', 'new', '2023-04-20 14:54:51', '1 ', 'media/6056163188'),
(6, 'Test group', ' ', 'GRP7191057299', 'ABUJA FCT', 'new', '2023-05-01 16:46:51', '1 ', 'media/1816345093');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` int(10) NOT NULL,
  `group_reference` varchar(20) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`id`, `group_reference`, `userid`, `timestamp`) VALUES
(6, 'GRP7191057299', '1 ', '2023-05-01 16:46:51'),
(5, 'GRP5434388400', '1 ', '2023-04-20 14:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `trails`
--

CREATE TABLE `trails` (
  `id` int(10) NOT NULL,
  `startpoint` varchar(30) NOT NULL,
  `traildata` varchar(500) NOT NULL,
  `endpoint` varchar(30) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `recordedby` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reference` varchar(20) NOT NULL,
  `difficulty` varchar(20) NOT NULL,
  `details` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trail_members`
--

CREATE TABLE `trail_members` (
  `id` int(10) NOT NULL,
  `hike_ref` varchar(20) NOT NULL,
  `trail_ref` varchar(20) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trail_visits`
--

CREATE TABLE `trail_visits` (
  `id` int(10) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `imgurl` varchar(20) NOT NULL,
  `pin` varchar(32) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `imgurl`, `pin`, `reference`, `date_created`, `last_login`) VALUES
(1, 'Apethief23', 'danielomede@gmail.com', '09096060158', 'media/5545621486', 'b3f3d1d6a03bb893c6fe0329ddb917c6', '2732850529', '2023-05-01 17:35:34', '0000-00-00'),
(2, 'Truelink', 'danielomede@hotmail.com', '09034745400', 'assets/user.png', 'b3f3d1d6a03bb893c6fe0329ddb917c6', '1589600236', '2023-04-26 14:51:41', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_members`
--
ALTER TABLE `event_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trails`
--
ALTER TABLE `trails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trail_members`
--
ALTER TABLE `trail_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trail_visits`
--
ALTER TABLE `trail_visits`
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
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_members`
--
ALTER TABLE `event_members`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trails`
--
ALTER TABLE `trails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trail_members`
--
ALTER TABLE `trail_members`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trail_visits`
--
ALTER TABLE `trail_visits`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
