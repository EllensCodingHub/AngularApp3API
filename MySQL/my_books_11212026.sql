-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 21, 2026 at 09:07 PM
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
  `starRating` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mybooks`
--

INSERT INTO `mybooks` (`bookID`, `authorName`, `bookTitle`, `storyHook`, `genre`, `pubDate`, `publisher`, `recBy`, `starRating`) VALUES
(1, 'Dean Koontz', 'Lightning', 'Can one man change both the past and future for a single woman?', 'Thriller', '2026-11-03', 'Bantam Books', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `userName` varchar(50) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mybooks`
--
ALTER TABLE `mybooks`
  MODIFY `bookID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
