-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2020 at 05:55 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `mkey`
--

CREATE TABLE `mkey` (
  `user1` bigint(20) NOT NULL,
  `user2` bigint(20) NOT NULL,
  `mskey` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mkey`
--

INSERT INTO `mkey` (`user1`, `user2`, `mskey`) VALUES
(1, 5, 'Tl9x2UdayWVSGy65Oel5LplzKDkdRQabfDnZd1omTGAyRxt5wr4rwDx2Wyb6QZjD'),
(1, 2, 'hkyiT6w6aA/lTwtnxjeBViuqZF/ar8G1tn4xUeVYJ6f2Y2jBr1d/HXKuSTRKOTjz'),
(1, 6, 'KhV2xunAb/tPxLrA6wvI6LcU5azmkw460oI3u+xLyBjzyvt6se/rIJ2zxI3hVOhB');

-- --------------------------------------------------------

--
-- Table structure for table `private`
--

CREATE TABLE `private` (
  `id` bigint(20) NOT NULL,
  `title` varchar(256) NOT NULL,
  `sender` bigint(20) NOT NULL,
  `recipient` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(10) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `private`
--

INSERT INTO `private` (`id`, `title`, `sender`, `recipient`, `message`, `timestamp`, `tag`) VALUES
(10, 'kjaskjasak', 1, 2, 'xTM1WfxkbLhZ1d4uskzdjCFMA7zEXPCvl/Qu/UIR0Yh8CcyBQLND8yXxzFpxjrq8ksVRs4NC+vqRbVXIQEsabA==', 1602948790, ''),
(9, 'asas', 1, 6, 'tUs5UTEaB0b6gQ+Q3ExHIgEVvytyDGLiMVXxm9+KtmBDND0GQ6BlxzClqBfo0uzr+QWqS+s4NeE5N+gGPOZM8A==', 1602948385, '');

-- --------------------------------------------------------

--
-- Table structure for table `usernames`
--

CREATE TABLE `usernames` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usernames`
--

INSERT INTO `usernames` (`id`, `username`, `password`, `salt`, `email`) VALUES
(1, 'asd', '3666b6f672ca0f27f01418e5cd7964f3a6bade6fc3fda7aea4e958aeaf77ac783388afbf942bc298d18bbd684ce8f5bfc1c9a2a90c91362b8e607cd4baeaa95b', '80669', 'i-roo@hotmail.com'),
(2, 'mona', '187deebb7ef3cae3b5f16ff4337ef4d2491b26a1c934f7022fb5017a1a273bc1bfdb0da5e7af2bc62bbfce979ecd1a2b22ee54ec1228f6bfd3ea2367010ae95f', '46570', 'i-roosds@hotmail.com'),
(3, 'asd1', '037815e1e63771cb92c742b45edfcc54f6f9845392e3054dc8ff1989a2358e309621bbd311c5ce0022d552d4a572d207cbc8c69e45be821082b3f478427fb9dc', '80548', 'i-roo@hotmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mkey`
--
ALTER TABLE `mkey`
  ADD KEY `user1` (`user1`),
  ADD KEY `user2` (`user2`);

--
-- Indexes for table `private`
--
ALTER TABLE `private`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender` (`sender`),
  ADD KEY `recipient` (`recipient`);

--
-- Indexes for table `usernames`
--
ALTER TABLE `usernames`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `private`
--
ALTER TABLE `private`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usernames`
--
ALTER TABLE `usernames`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
