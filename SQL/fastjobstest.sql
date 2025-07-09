-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2025 at 07:15 PM
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
-- Database: `fastjobstest`
--
CREATE DATABASE IF NOT EXISTS `fastjobstest` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fastjobstest`;

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
(1, 'carpenter', 'c'),
(2, 'plumber', 'c');

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
(2, 1, -1, NULL);

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
(1, 1, 0, 0, 0, '2025-04-04 21:14:01'),
(3, 1, 0, 0, 0, '2025-04-04 21:14:01');

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
(3, 1, 1, 'kkkt', 1, '2025-02-17 23:56:26', 0);

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
(1, 'carlson', '2003-08-20', 'carl@gmail.com', '$2y$10$k7wHjcq1AuRR0xqTBrN/d./kgzDl3rkIudC8LmpLMLM/8vDN2xk5.', 1, '', '', NULL, 'u', '2025-02-15 15:03:02'),
(2, 'Jhon', '1990-10-16', 'jhon@gmail.com', '', 2, NULL, NULL, NULL, 'u', '2025-02-17 23:05:27'),
(3, 'paul', '2000-06-06', 'paul@gmail.com', 'hhh', 2, '', '', NULL, 'u', '2025-02-17 23:08:57');

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
(1, 2),
(2, 3);

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
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `inboxId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
