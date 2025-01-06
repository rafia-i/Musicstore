-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2025 at 03:14 AM
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
-- Database: `musicstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `area` varchar(30) DEFAULT NULL,
  `district` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `phone` char(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `name`, `password`, `area`, `district`, `country`, `phone`, `email`, `birthdate`) VALUES
(1001, 'Shreya', '1234#', 'Nikunjo', 'Dhaka', 'Bangladesh', '01731118836', 'shreya@gmail.com', '2002-06-02'),
(1002, 'yakub', '1234#', 'Nikunjo', 'Dhaka', 'Bangladesh', '01736618836', 'yakub@gmail.com', '2001-08-02'),
(1003, 'nafee', '1234#', 'uttara', 'dhaka', 'bangladesh', '01745559978', 'nafee@yahoo.com', '2003-03-18'),
(1004, 'rafia', '1234#', 'uttara', 'dhaka', 'bangladesh', '01795559178', 'rafia@outlook.com', '2000-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `artistID` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artistID`, `name`, `type`) VALUES
(1, 'Minar Rahman', 'Bangla'),
(2, 'Tahsan', 'Bangla'),
(3, 'Anuv Jain', 'Hindi'),
(4, 'Arijit Singh', 'Hindi'),
(5, 'the Weeknd', 'English'),
(6, 'Ariana Grande', 'English'),
(7, 'Linkin Park', 'English'),
(8, 'Warfaze', 'Bangla'),
(9, 'Taylor Swift', 'English'),
(10, 'Bruno Mars', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `trackID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `trackID`, `customerID`) VALUES
(65, 10, 4),
(66, 9, 10),
(70, 7, 4),
(89, 6, 19),
(90, 13, 19),
(91, 4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` int(11) NOT NULL,
  `trackID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `trackID`, `customerID`, `comment`, `date`) VALUES
(1, 9, 1, 'my favv song', '2025-01-04 02:09:58'),
(2, 9, 1, 'My favourite song', '2025-01-05 00:00:03'),
(3, 7, 1, 'Such a dreamy song', '2025-01-06 01:50:59'),
(4, 3, 1, 'i used to listen to this nonstop', '2025-01-06 01:51:20'),
(5, 12, 1, 'nostalgic', '2025-01-06 01:51:58'),
(6, 15, 1, 'i dont like this song', '2025-01-06 01:52:19'),
(7, 16, 1, 'loveee', '2025-01-06 01:52:37'),
(8, 13, 5, 'cute song', '2025-01-06 01:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `district` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `phone` char(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `name`, `password`, `area`, `district`, `country`, `phone`, `email`, `birthdate`, `points`) VALUES
(1, 'Rafat Islam', '1234', 'Uttara', 'Dhaka', 'Bangladesh', '01678123456', 'rafat13@gmail.com', '2006-08-02', 40),
(2, 'Rayan Islam', '6789', 'dhaka', 'gram', 'bidesh', '01234567894', 'rayan@gmail.com', '2010-10-26', 25),
(3, 'xyz', '1234', 'dhaka', 'gram', 'bidesh', 'abcd', 'xzy@g.com', '2012-07-10', 0),
(4, 'rafia', '1234', 'Mirpur', 'Dhaka', 'Bangladesh', '01234567839', 'raf@yahoo.com', '1998-10-27', 0),
(5, 'abc', '123', 'Uttara', 'Dhaka', 'Bangladesh', '01678123456', 'abc@gmail.com', '2004-10-10', 60),
(6, 'apple', '1212', 'Birol', 'Dinajpur', 'Bangladesh', '01234567891', 'apple@yahoo.com', '2007-06-15', 0),
(7, 'Siara', 'siara123', 'Uttara', 'Dhaka', 'Bangladesh', '01234567811', 'siara@gmail.com', '1999-07-05', 0),
(9, 'safan', '1234', 'Uttara', 'Dhaka', 'Bangladesh', '01234567822', 'safan@gmail.com', '1999-07-10', 0),
(10, 'bubbles', 'bub', 'Mirpur', 'Dhaka', 'Bangladesh', '01342761422', 'bubb@gmail.com', '2003-06-10', 0),
(11, 'buttercup', 'butter', 'Mirpur', 'Dhaka', 'Bangladesh', '01342761400', 'butter@gmail.com', '2003-06-10', 0),
(12, 'ash', '1234', 'Birol', 'Dinajpur', 'Bangladesh', '01474635791', 'ash@gmail.com', '2009-06-11', 0),
(13, 'kuromi', 'kuro', 'Uttara', 'Dhaka', 'Bangladesh', '01736492618', 'kuro@gmail.com', '2000-06-05', 0),
(14, 'cinnamoroll', '1234', 'Uttara', 'Dhaka', 'Bangladesh', '01736492619', 'cinamo@gmail.com', '2000-06-05', 0),
(15, 'maria', '1234', 'Mirpur', 'Dhaka', 'Bangladesh', '01863926435', 'maria@yahoo.com', '2006-07-02', 0),
(16, 'raf', 'rafraf', 'Birol', 'Dinajpur', 'Bangladesh', '01743573472', 'raf@gmail.com', '1997-11-03', 0),
(17, 'bobatea', 'boba', 'Uttara', 'Dhaka', 'Bangladesh', '01743573470', 'bb@gmail.com', '2008-11-04', 50),
(18, 'Star', '1234', 'Birol', 'Dinajpur', 'Bangladesh', 'dwf', 'star@gmail.com', '2020-02-06', 0),
(19, 'Mars', 'mars', 'Birol', 'Dinajpur', 'Bangladesh', '01678123400', 'mars@gmail.com', '2003-07-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `favID` int(11) NOT NULL,
  `customerID` int(11) DEFAULT NULL,
  `artistID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`favID`, `customerID`, `artistID`) VALUES
(1, 4, 6),
(2, 1, 3),
(3, 7, 1),
(4, 7, 7),
(5, 2, 1),
(6, 2, 6),
(7, 2, 4),
(8, 2, 7),
(9, 2, 8),
(11, 1, 8),
(12, 10, 1),
(13, 10, 4),
(14, 10, 5),
(15, 10, 8),
(16, 15, 1),
(17, 15, 4),
(18, 1, 2),
(19, 1, 5),
(21, 4, 3),
(22, 1, 7),
(23, 5, 3),
(24, 1, 6),
(25, 1, 4),
(26, 2, 3),
(27, 17, 4),
(28, 17, 3),
(29, 1, 1),
(30, 5, 4),
(31, 19, 1),
(32, 19, 3),
(33, 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genreID` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genreID`, `name`) VALUES
(1, 'pop'),
(2, 'rock'),
(3, 'r&b'),
(4, 'country'),
(5, 'jazz'),
(6, 'classical');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceID` int(11) NOT NULL,
  `artistID` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `trackID` int(11) DEFAULT NULL,
  `genreID` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `totalprice` double DEFAULT NULL,
  `paymentmethod` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceID`, `artistID`, `customerID`, `trackID`, `genreID`, `date`, `totalprice`, `paymentmethod`) VALUES
(35, 6, 1, 10, 1, '2024-12-25', 550, 'Bkash'),
(36, 1, 1, 1, 1, '2024-12-25', 100, 'Bkash'),
(37, 3, 1, 6, 1, '2024-12-25', 250, 'Nagad'),
(38, 5, 1, 8, 3, '2024-12-25', 500, 'Nagad'),
(39, 5, 2, 9, 3, '2024-12-27', 550, 'Mastercard'),
(40, 3, 4, 6, 1, '2024-12-27', 250, 'Nagad'),
(41, 2, 4, 4, 1, '2024-12-27', 150, 'Nagad'),
(42, 5, 15, 8, 3, '2024-12-28', 500, 'Mastercard'),
(43, 5, 1, 9, 3, '2024-12-28', 550, 'Nagad'),
(44, 5, 5, 9, 3, '2024-12-28', 550, 'Nagad'),
(45, 5, 1, 15, 3, '2024-12-30', 600, 'Bkash'),
(46, 1, 1, 2, 1, '2025-01-01', 100, 'Mastercard'),
(47, 4, 1, 7, 6, '2025-01-01', 300, 'Mastercard'),
(48, 8, 1, 13, 2, '2025-01-02', 250, 'Mastercard'),
(49, 8, 5, 13, 2, '2025-01-02', 250, 'Mastercard'),
(50, 8, 5, 13, 2, '2025-01-02', 250, 'Mastercard'),
(51, 4, 5, 7, 6, '2025-01-02', 300, 'Mastercard'),
(52, 5, 17, 8, 3, '2025-01-04', 500, 'Mastercard'),
(53, 2, 1, 3, 1, '2025-01-05', 150, 'Mastercard'),
(54, 2, 1, 3, 1, '2025-01-05', 150, 'Mastercard'),
(55, 7, 1, 12, 2, '2025-01-05', 600, 'Mastercard'),
(56, 9, 1, 16, 4, '2025-01-05', 400, 'Mastercard'),
(57, 9, 1, 17, 4, '2025-01-05', 300, 'Mastercard'),
(58, 10, 1, 23, 5, '2025-01-05', 400, 'Mastercard'),
(59, 1, 2, 1, 1, '2025-01-05', 100, 'Mastercard'),
(60, 8, 2, 13, 2, '2025-01-05', 250, 'Mastercard'),
(61, 3, 5, 6, 1, '2025-01-05', 250, 'Mastercard'),
(62, 5, 5, 15, 3, '2025-01-05', 600, 'Mastercard');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `playlistID` int(11) NOT NULL,
  `trackID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`playlistID`, `trackID`, `customerID`) VALUES
(1, 8, 1),
(3, 7, 15),
(4, 8, 16),
(5, 6, 15),
(6, 13, 15),
(7, 7, 15),
(8, 13, 4),
(9, 8, 1),
(10, 7, 1),
(13, 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `ratingID` int(11) NOT NULL,
  `trackID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`ratingID`, `trackID`, `customerID`, `rating`) VALUES
(1, 7, 1, 2),
(2, 6, 1, 10),
(3, 9, 1, 8),
(4, 3, 1, 4),
(5, 1, 1, 7),
(6, 2, 1, 8),
(7, 12, 1, 9),
(8, 15, 1, 2),
(9, 16, 1, 9),
(10, 10, 1, 5),
(11, 7, 5, 9),
(12, 9, 5, 6),
(13, 13, 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `submitted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `type` varchar(255) NOT NULL,
  `track_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `user_id`, `description`, `submitted_at`, `type`, `track_id`) VALUES
(1, 2, 'page too slow', '2025-01-01 16:53:19', 'Bug', NULL),
(2, 1, 'slowwwwww', '2025-01-03 17:36:02', 'Bug', NULL),
(3, 1, 'er5ys54b', '2025-01-03 17:48:30', 'Violation', NULL),
(4, 1, 'a5byn t', '2025-01-03 17:49:54', 'Violation', NULL),
(5, 1, 'a5byn t', '2025-01-03 17:50:14', 'Violation', NULL),
(6, 1, 'a5by4b5 tn t', '2025-01-03 17:50:21', 'Bug', NULL),
(7, 2, 'erabvf', '2025-01-05 18:02:46', 'Violation', NULL),
(8, 1, 'eirghfnierghtiu', '2025-01-05 19:59:04', 'Bug', NULL),
(9, 1, 'yumgb86g8', '2025-01-05 19:59:25', 'Bug', NULL),
(10, 1, 'boring', '2025-01-05 20:11:22', 'Inappropriate_content', 7),
(11, 1, 'sfgbvarf', '2025-01-05 20:58:57', 'Bug', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `sessionID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`sessionID`, `customerID`) VALUES
(33, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `trackID` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `mediatype` varchar(10) DEFAULT NULL,
  `genreID` int(11) DEFAULT NULL,
  `artistID` int(11) DEFAULT NULL,
  `length` varchar(30) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `size` varchar(30) DEFAULT NULL,
  `composed_date` date DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `audio_path` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`trackID`, `name`, `mediatype`, `genreID`, `artistID`, `length`, `price`, `size`, `composed_date`, `link`, `audio_path`) VALUES
(1, 'jhoom', 'mp3', 1, 1, '4:33', 100, '5MB', '2016-06-16', 'https://www.youtube.com/watch?v=RWnFowWtT78', 'http://localhost/audio_path/MINAR RAHMAN  JHOOM   Official Video  Bangla New Song.mp3'),
(2, 'karone okarone', 'mp3', 1, 1, '5:17', 100, '5MB', '2017-06-16', 'https://www.youtube.com/watch?v=e8eSfqaaGXQ', 'http://localhost/audio_path/Karone Okarone  Minar Rahman  Official Music Video  Eagle Music.mp3'),
(3, 'Alo', 'mp3', 1, 2, '4:35', 150, '6MB', '2016-11-14', 'https://www.youtube.com/watch?v=C-0vOChcjHo', 'http://localhost/audio_path/Alo  আল  Tahsan  Album Ecche  Tahsan Art Track  Tahsan Lyrical Video 2019.mp3'),
(4, 'Koto dur', 'mp3', 1, 2, '5:21', 150, '6MB', '2014-11-14', 'https://www.youtube.com/watch?v=swDEojiBBbk', 'http://localhost/audio_path/Koto Dur.mp3'),
(5, 'Husn', 'mp3', 1, 3, '3:38', 250, '6MB', '2024-12-22', 'https://www.youtube.com/watch?v=gJLVTKhTnog', 'http://localhost/audio_path/Anuv jain - Husn (lyrics).mp3'),
(6, 'Alag Aasmaan', 'mp3', 1, 3, '3:38', 250, '6MB', '2020-12-22', 'https://www.youtube.com/watch?v=vA86QFrXoho', 'http://localhost/audio_path/Alag Aasmaan - Anuv Jain_64(MyMp3Song).mp3'),
(7, 'Aayat', 'mp3', 6, 4, '4:18', 300, '7MB', '2015-12-18', 'https://www.youtube.com/watch?v=vKDsAB1ccn0', 'http://localhost/audio_path/Aayat  Full Audio Song  Bajirao Mastani  Ranveer Singh, Deepika Padukone.mp3'),
(8, 'Save your tears', 'mp3', 3, 5, '4:09', 500, '8MB', '2022-06-23', 'https://www.youtube.com/watch?v=XXYlFuWEuKI', 'http://localhost/audio_path/The Weeknd - Save Your Tears (Official Music Video).mp3'),
(9, 'Blinding Lights', 'mp3', 3, 5, '4:23', 550, '8MB', '2020-01-22', 'https://www.youtube.com/watch?v=fHI8X4OXluQ', 'http://localhost/audio_path/The Weeknd - Blinding Lights (Official Audio).mp3'),
(10, 'We cant be friends', 'mp3', 1, 6, '4:44', 550, '8MB', '2024-03-08', 'https://www.youtube.com/watch?v=KNtJGQkC-WI', 'http://localhost/audio_path/Ariana-Grande-we-cant-be-friends-wait-for-your-love-(HipHopKit.com).mp3'),
(11, 'In the end', 'mp3', 2, 7, '3:39', 600, '8MB', '2001-09-11', 'https://www.youtube.com/watch?v=eVTXPUF4Oz4', 'http://localhost/audio_path/In The End [Official HD Music Video] - Linkin Park.mp3'),
(12, 'Numb', 'mp3', 2, 7, '3:13', 600, '8MB', '2003-09-08', 'https://www.youtube.com/watch?v=kXYiU_JCYtU', 'http://localhost/audio_path/Numb (Official Music Video) [4K UPGRADE]  Linkin Park.mp3'),
(13, 'Purnota', 'mp3', 2, 8, '6:00', 250, '8MB', '2012-06-08', 'https://www.youtube.com/watch?v=uB2rhjulY4Q', 'http://localhost/audio_path/Warfaze - Purnota.mp3'),
(14, 'Afsos', 'mp3', 1, 3, '3:15', 300, '5MB', '2025-01-12', 'https://www.youtube.com/watch?v=Su4ip3w2wss', 'http://localhost/audio_path/AFSOS - Anuv Jain  AP Dhillon  Unreleased Song  New Songs.mp3'),
(15, 'Sao Paulo', 'mp3', 3, 5, '5:00', 600, '9MB', '2024-12-30', 'https://www.youtube.com/watch?v=AQ5NlI-SJR0', 'http://localhost/audio_path/The Weeknd, Anitta - Sao Paulo (Official Audio).mp3'),
(16, 'teardrops on my guitar', 'mp3', 4, 9, '4:00', 400, '7MB', '2007-10-06', 'https://www.youtube.com/watch?v=xKCek6_dB0M', 'http://localhost/audio_path/Taylor Swift - Teardrops On My Guitar.mp3'),
(17, 'Mine', 'mp3', 4, 9, '5:00', 300, '5MB', '2010-06-05', 'https://www.youtube.com/watch?v=XPBwXKgDTdE', 'http://localhost/audio_path/Taylor Swift - Mine.mp3'),
(18, 'Bhule jabo', 'mp3', 1, 2, '3:34', 200, '5MB', '2025-02-01', 'https://www.youtube.com/watch?v=5fRB5HQ1XPw', 'http://localhost/audio_path/Bhule Jabo  Sanjoy  Tahsan  Muza (Official Music Video).mp3'),
(23, 'Locked out of heaven', 'mp3', 5, 10, '6:00', 400, '6MB', '2012-02-02', 'https://www.youtube.com/watch?v=e-fA-gBCkj0', 'http://localhost/audio_path/Bruno Mars - Locked Out Of Heaven (Official Music Video).mp3');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlistID` int(11) NOT NULL,
  `trackID` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlistID`, `trackID`, `customerID`) VALUES
(5, 14, 4),
(7, 14, 1),
(8, 14, 5),
(9, 14, 17),
(10, 14, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artistID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `trackID` (`trackID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `trackID` (`trackID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`favID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `artistID` (`artistID`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genreID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceID`),
  ADD KEY `artistID` (`artistID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `trackID` (`trackID`),
  ADD KEY `genreID` (`genreID`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`playlistID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `trackID` (`trackID`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`ratingID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `trackID` (`trackID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`sessionID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`trackID`),
  ADD KEY `genreID` (`genreID`),
  ADD KEY `artistID` (`artistID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlistID`),
  ADD KEY `trackID` (`trackID`),
  ADD KEY `customerID` (`customerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `artistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `favID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `playlistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `ratingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `sessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `trackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`ID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`trackID`) REFERENCES `tracks` (`trackID`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`trackID`) REFERENCES `tracks` (`trackID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`ID`);

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`ID`),
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`artistID`) REFERENCES `artist` (`artistID`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`artistID`) REFERENCES `artist` (`artistID`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`ID`),
  ADD CONSTRAINT `invoice_ibfk_3` FOREIGN KEY (`trackID`) REFERENCES `tracks` (`trackID`),
  ADD CONSTRAINT `invoice_ibfk_4` FOREIGN KEY (`genreID`) REFERENCES `genre` (`genreID`);

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`ID`),
  ADD CONSTRAINT `playlist_ibfk_2` FOREIGN KEY (`trackID`) REFERENCES `tracks` (`trackID`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`ID`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`trackID`) REFERENCES `tracks` (`trackID`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`ID`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`ID`);

--
-- Constraints for table `tracks`
--
ALTER TABLE `tracks`
  ADD CONSTRAINT `tracks_ibfk_2` FOREIGN KEY (`genreID`) REFERENCES `genre` (`genreID`),
  ADD CONSTRAINT `tracks_ibfk_3` FOREIGN KEY (`artistID`) REFERENCES `artist` (`artistID`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`trackID`) REFERENCES `tracks` (`trackID`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
