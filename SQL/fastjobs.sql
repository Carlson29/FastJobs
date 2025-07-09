-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2025 at 07:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fastjobs`
--
CREATE DATABASE IF NOT EXISTS `fastjobs` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fastjobs`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(54) NOT NULL,
  `searchDiff` text NOT NULL DEFAULT 'c'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`, `searchDiff`) VALUES
(1, 'carpenter', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

DROP TABLE IF EXISTS `inbox`;
CREATE TABLE `inbox` (
  `inboxId` int(11) NOT NULL,
  `inboxType` int(11) NOT NULL DEFAULT 1,
  `adminId` int(11) DEFAULT NULL,
  `groupName` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`inboxId`, `inboxType`, `adminId`, `groupName`) VALUES
(1, 1, -1, ''),
(2, 1, -1, '');

-- --------------------------------------------------------

--
-- Table structure for table `inboxparticipants`
--

DROP TABLE IF EXISTS `inboxparticipants`;
CREATE TABLE `inboxparticipants` (
  `userId` int(11) NOT NULL,
  `inboxId` int(11) NOT NULL,
  `deletedState` tinyint(1) NOT NULL DEFAULT 0,
  `unseenMessages` int(3) NOT NULL DEFAULT 0,
  `isOpen` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'this signifies if the inbox is currently open',
  `lastSent` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inboxparticipants`
--

INSERT INTO `inboxparticipants` (`userId`, `inboxId`, `deletedState`, `unseenMessages`, `isOpen`, `lastSent`) VALUES
(1, 1, 0, 0, 1, '2025-05-01 17:54:34'),
(3, 1, 0, 0, 1, '2025-05-01 17:54:34'),
(1, 2, 0, 0, 0, '2025-05-03 17:48:57'),
(2, 2, 0, 2, 0, '2025-05-03 17:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `postId` int(11) NOT NULL,
  `media` varchar(254) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `messageId` int(11) NOT NULL,
  `inboxId` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `message` varchar(535) NOT NULL,
  `messageType` int(11) NOT NULL DEFAULT 1 COMMENT '1 for text,2 for picture,3 for video, 4 for any other file',
  `timeSent` datetime NOT NULL DEFAULT current_timestamp(),
  `deletedState` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'FALSE(0) for not deleted and TRUE for deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageId`, `inboxId`, `senderId`, `message`, `messageType`, `timeSent`, `deletedState`) VALUES
(1, 1, 1, 'hello', 1, '2025-02-05 18:08:57', 0),
(2, 1, 1, 'hello', 1, '2025-02-05 18:13:47', 0),
(3, 1, 1, 'kkkt', 1, '2025-02-17 23:56:26', 0),
(4, 1, 1, 'okay', 1, '2025-02-17 23:58:09', 0),
(5, 1, 1, 'kuu', 1, '2025-02-18 16:21:19', 0),
(6, 1, 1, 'KC', 1, '2025-02-18 16:22:48', 0),
(7, 1, 1, 'hey', 1, '2025-02-18 18:53:51', 0),
(8, 1, 1, 'gh', 1, '2025-02-18 18:55:43', 0),
(9, 1, 1, 'jd', 1, '2025-02-18 18:58:30', 0),
(10, 1, 1, 'kkk', 1, '2025-02-18 19:09:43', 0),
(11, 1, 3, 'hey carl', 1, '2025-02-19 18:38:11', 0),
(12, 1, 3, 'hey', 1, '2025-02-19 18:43:31', 0),
(13, 1, 3, 'hi', 1, '2025-02-19 18:48:28', 0),
(14, 1, 3, 'it is carl', 1, '2025-02-19 18:48:53', 0),
(15, 1, 3, 'yes', 1, '2025-02-20 16:23:37', 0),
(16, 1, 3, 'what\'s up', 1, '2025-02-20 16:26:06', 0),
(17, 1, 3, 'yeah', 1, '2025-02-20 16:27:40', 0),
(18, 1, 3, 'alright', 1, '2025-02-20 16:28:24', 0),
(19, 1, 1, 'how r u', 1, '2025-02-20 16:35:02', 0),
(20, 1, 1, 'good?', 1, '2025-02-20 16:36:07', 0),
(21, 1, 3, 'yeah good', 1, '2025-02-20 16:38:34', 0),
(22, 1, 3, 'alright', 1, '2025-02-20 16:44:52', 0),
(23, 1, 3, 'ndn', 1, '2025-02-20 16:47:25', 0),
(24, 1, 1, 'yh', 1, '2025-02-20 16:53:56', 0),
(25, 1, 1, 'dj', 1, '2025-02-20 16:57:57', 0),
(26, 1, 3, 'hj', 1, '2025-02-20 17:12:49', 0),
(27, 1, 1, 'hey', 1, '2025-02-20 18:19:08', 0),
(28, 1, 1, 'no', 1, '2025-02-20 18:19:42', 0),
(29, 1, 1, 'yh', 1, '2025-02-20 18:24:52', 0),
(30, 2, 1, 'yoo', 1, '2025-02-20 18:39:44', 0),
(31, 2, 1, 'good', 1, '2025-02-20 18:40:03', 0),
(32, 1, 1, 'Screenshot 2025-02-20 191749.png', 2, '2025-02-20 20:14:26', 0),
(33, 1, 1, 'good', 1, '2025-03-05 23:28:55', 0),
(34, 1, 1, 'yeah', 1, '2025-03-05 23:31:12', 0),
(35, 2, 2, 'yoo', 1, '2025-03-06 13:15:26', 0),
(36, 1, 1, 'hey', 1, '2025-03-06 14:50:18', 0),
(37, 2, 1, 'hey', 1, '2025-03-06 14:50:37', 0),
(46, 2, 1, 'hj', 1, '2025-03-21 16:18:17', 0),
(47, 2, 1, 'hello', 1, '2025-03-26 11:30:58', 0),
(48, 1, 1, 'hi', 1, '2025-03-26 11:45:23', 0),
(56, 1, 1, '2025-04-04 22-08-22.jpg', 2, '2025-04-04 21:08:22', 0),
(57, 1, 1, '2025-04-04 22-13-31.jpg', 2, '2025-04-04 21:13:31', 0),
(58, 1, 3, '2025-04-04 22-14-01.jpg', 2, '2025-04-04 21:14:01', 0),
(59, 1, 1, 'no worries', 1, '2025-04-25 14:38:15', 0),
(60, 1, 1, 'yeah', 1, '2025-05-01 17:46:48', 0),
(61, 1, 3, 'no worries', 1, '2025-05-01 17:54:34', 0),
(62, 2, 1, '2025-05-03 18-48-37.png', 2, '2025-05-03 17:48:37', 0),
(63, 2, 1, 'yeah', 1, '2025-05-03 17:48:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `type` int(11) NOT NULL DEFAULT 1,
  `userType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `reviewId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `review` varchar(534) NOT NULL,
  `reviewerId` int(11) NOT NULL,
  `dateReviewed` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `name` varchar(24) NOT NULL,
  `dateOfBirth` date NOT NULL DEFAULT current_timestamp(),
  `email` varchar(535) NOT NULL,
  `password` varchar(535) NOT NULL,
  `userType` int(11) NOT NULL DEFAULT 1,
  `longitude` varchar(24) DEFAULT NULL,
  `latitude` varchar(24) DEFAULT NULL,
  `profilePic` varchar(535) DEFAULT NULL,
  `searchDiff` text NOT NULL DEFAULT 'u',
  `dateJoint` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `dateOfBirth`, `email`, `password`, `userType`, `longitude`, `latitude`, `profilePic`, `searchDiff`, `dateJoint`) VALUES
(1, 'carlson', '2003-08-20', 'carl@gmail.com', '$2y$10$k7wHjcq1AuRR0xqTBrN/d./kgzDl3rkIudC8LmpLMLM/8vDN2xk5.', 1, '-6.378094315661951', '53.9961487122443', NULL, 'u', '2025-02-15 15:03:02'),
(2, 'Jhon', '1990-10-16', 'jhon@gmail.com', '$2y$10$vPh6yXIk9CksLnhSnUKqhO13a1/jZPbDv7UaGtVQE/6SJiCt5Q7uC', 2, '-6.377918453140311', '53.99640935117936', NULL, 'u', '2025-02-17 23:05:27'),
(3, 'paul', '2000-06-06', 'paul@gmail.com', '$2y$10$/mALtp7jnso2Rx7RLXEvS.VTuL1JzEDulCW65n5UWSm8yCiUpyR6C', 1, '-6.1407232', '53.231616', NULL, 'u', '2025-02-17 23:08:57'),
(4, 'jacob', '2002-08-30', 'jacob@gmail.com', '$2y$10$CB2BUxjWRSZuQZiqf2ra4uOlTVEqC2fl4TFQKl6wFoxGxT5sNX6qi', 2, '-6.39209436728087', '53.98166042490533', '', 'u', '2025-03-26 13:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `userscategory`
--

DROP TABLE IF EXISTS `userscategory`;
CREATE TABLE `userscategory` (
  `categoryId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userscategory`
--

INSERT INTO `userscategory` (`categoryId`, `userId`) VALUES
(1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`inboxId`);

--
-- Indexes for table `inboxparticipants`
--
ALTER TABLE `inboxparticipants`
  ADD KEY `userId` (`userId`),
  ADD KEY `inboxId` (`inboxId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `inboxId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
