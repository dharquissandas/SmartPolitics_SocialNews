-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2019 at 03:26 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sp`
--
CREATE DATABASE IF NOT EXISTS `sp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sp`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `parent_comment_id` int(11) NOT NULL,
  `comment` varchar(400) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entries_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `parent_comment_id`, `comment`, `userid`, `date`, `entries_id`) VALUES
(1, 0, 'Comments Chalej?', 2, '2019-07-11 14:13:42', 3),
(2, 1, 'Reply Chalej?', 2, '2019-07-11 14:13:52', 3),
(3, 2, 'Jay Shree Krishna', 2, '2019-07-11 14:14:17', 3),
(4, 0, 'Bijo Normal Comment', 2, '2019-07-11 14:14:35', 3),
(5, 4, 'Normal Comment no reply', 2, '2019-07-11 14:14:49', 3);

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `post` longtext,
  `timestamp` int(11) DEFAULT NULL,
  `upvotes` int(255) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`ID`, `title`, `topic`, `post`, `timestamp`, `upvotes`, `userid`) VALUES
(1, 'Trump Administration Drops Effort to Add Citizenship Question to 2020 Census', 'America', 'REFERENCES REFERENCES REFERENCES ', 1562321882, 0, 1),
(2, 'Trump Administration Drops Effort to Add Citizenship Question to 2020 Census', 'America', 'kala', 1562321996, 0, 2),
(3, 'this is a title', 'this is the topic', 'Lets see if the posterid is set automatically', 1562336312, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `ID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `followingid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`ID`, `userid`, `followingid`) VALUES
(1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `email` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`) VALUES
(1, 'Deep Harquissandas', '$2y$10$ggHwSdrSWZXswxiirkOO..CkqjF7fILvqMYnb3h53p.zJdMcvGWQi', 'dharquissandas@outlook.com'),
(2, 'admin', '$2y$10$olbpL2WI/DWRZueiuT2R.OGHGb8Q88iIe2KPMmF9DVONBT2AIDWR.', 'dharquissandas@gmail.com'),
(3, 'Moksh', '$2y$10$7kmBiLoZfm/DZfC9YstPnO4WE3plGyvCWyqX0EbO6B8mMp5BTXIu.', 'mokshpandya3744@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
