-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 26, 2026 at 04:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_books_2026`
--

-- --------------------------------------------------------

--
-- Table structure for table `mybooks`
--

CREATE TABLE `mybooks` (
  `bookID` int(50) NOT NULL,
  `authorName` text NOT NULL,
  `bookTitle` varchar(255) NOT NULL,
  `storyHook` varchar(500) NOT NULL,
  `genre` text NOT NULL,
  `pubDate` date NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `recBy` int(50) DEFAULT NULL,
  `starRating` tinyint(4) DEFAULT NULL,
  `imageName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mybooks`
--

INSERT INTO `mybooks` (`bookID`, `authorName`, `bookTitle`, `storyHook`, `genre`, `pubDate`, `publisher`, `recBy`, `starRating`, `imageName`) VALUES
(1, 'Dean Koontz', 'Lightning', 'Can one man change both the past and future for a single woman?', 'Thriller', '2026-11-03', 'Bantam Books', NULL, NULL, NULL),
(2, 'Tiffany Yates Martin', 'Intuitive Editing', 'A creative & practical guide to revising your writ', 'non-fiction', '2026-11-02', 'FoxPrint Ink LLC', 1, 1, 'placeholder_100.jpg'),
(7, 'Dean Koontz', 'Odd Thomas', 'Dead people help a fry cook solve murders.', 'Thriller', '2003-12-09', 'Bantam Publishing', NULL, 5, 'Odd_Thomas.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `userID` int(4) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `failedAttempts` int(4) DEFAULT 0,
  `lastFailedLogin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`userID`, `userName`, `emailAddress`, `password`, `failedAttempts`, `lastFailedLogin`) VALUES
(1, 'bbunny2026', 'bbunny@ltunes.com', '$2y$10$S.pZZu/htm1jjlLklBf7Au1f62vN24bP6IKLTh90uFhseFNj.Wq7e', 0, NULL),
(2, 'EBoyd', 'ellen@thewritestory.net', '$2y$10$R6OT5Kc2vUmCcg5VH6H3Z.iH7RCFvoVb.tc.9mFj4VfPvscNu23dm', NULL, NULL),
(3, 'efudd', 'efudd@ltunes.com', '$2y$10$821D2bj2pRen3b0BluNWJ.BSdyYuzoKdhPlXnAXnNOK6vSRrDYymC', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `genre` varchar(250) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mybooks`
--
ALTER TABLE `mybooks`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mybooks`
--
ALTER TABLE `mybooks`
  MODIFY `bookID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `userID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
