-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 08, 2022 at 01:51 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs306_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `Directs`
--

CREATE TABLE `Directs` (
  `per_id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Directs`
--

INSERT INTO `Directs` (`per_id`, `med_id`) VALUES
(11, 1),
(13, 2),
(14, 2),
(16, 3),
(17, 3),
(22, 4),
(23, 4),
(27, 7),
(28, 7),
(31, 8),
(33, 9),
(35, 14);

-- --------------------------------------------------------

--
-- Table structure for table `Favorite`
--

CREATE TABLE `Favorite` (
  `usr_id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Favorite`
--

INSERT INTO `Favorite` (`usr_id`, `med_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 7),
(1, 8),
(1, 12),
(4, 1),
(4, 2),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Genre`
--

CREATE TABLE `Genre` (
  `gen_id` int(11) NOT NULL,
  `gen_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Genre`
--

INSERT INTO `Genre` (`gen_id`, `gen_name`) VALUES
(3, 'Action'),
(7, 'Adventure'),
(9, 'Animation'),
(4, 'Comedy'),
(5, 'Crime'),
(1, 'Drama'),
(11, 'Fantasy'),
(12, 'Horror'),
(8, 'Romance'),
(10, 'Sci-Fi'),
(6, 'Thriller');

-- --------------------------------------------------------

--
-- Table structure for table `Has_genre`
--

CREATE TABLE `Has_genre` (
  `med_id` int(11) NOT NULL,
  `gen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Has_genre`
--

INSERT INTO `Has_genre` (`med_id`, `gen_id`) VALUES
(1, 1),
(1, 3),
(1, 5),
(2, 1),
(2, 5),
(2, 6),
(3, 4),
(4, 1),
(4, 3),
(4, 7),
(7, 4),
(7, 8),
(8, 4),
(8, 7),
(8, 9),
(9, 1),
(10, 3),
(10, 7),
(10, 10),
(11, 1),
(11, 3),
(11, 5),
(12, 1),
(12, 11),
(12, 12),
(13, 4),
(13, 8),
(14, 3),
(14, 7),
(14, 12);

-- --------------------------------------------------------

--
-- Table structure for table `Media`
--

CREATE TABLE `Media` (
  `med_id` int(11) NOT NULL,
  `med_name` varchar(50) NOT NULL,
  `med_rating` decimal(9,1) DEFAULT NULL,
  `med_release` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Media`
--

INSERT INTO `Media` (`med_id`, `med_name`, `med_rating`, `med_release`) VALUES
(1, 'The Batman', '8.2', '2022-03-04'),
(2, 'Breaking Bad', '9.4', '2008-01-01'),
(3, 'The Office', '8.9', '2005-01-01'),
(4, 'Game of Thrones', '9.3', '2011-04-17'),
(7, 'Friends', '8.8', '1994-09-22'),
(8, 'Rick and Morty', '9.1', '2013-12-03'),
(9, 'Fight Club', '8.8', '1999-12-10'),
(10, 'Inception', '8.7', '2010-07-30'),
(11, 'Kill Bill: Vol. 1', '8.2', '2004-01-02'),
(12, 'Stranger Things', '8.7', '2016-07-15'),
(13, 'How I Met Your Mother', '8.4', '2005-09-19'),
(14, 'World War Z', '7.0', '2013-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE `Person` (
  `per_id` int(11) NOT NULL,
  `per_name` varchar(50) NOT NULL,
  `per_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`per_id`, `per_name`, `per_role`) VALUES
(10, 'Robert Pattinson', 'Actor'),
(11, 'Matt Reeves', 'Director'),
(12, 'Aaron Paul', 'Actor'),
(13, 'Michelle MacLaren', 'Director'),
(14, 'Adam Bernstein', 'Director'),
(15, 'Bryan Cranston', 'Actor'),
(16, 'Paul Feig', 'Director'),
(17, 'B.J. Novak', 'Director'),
(18, 'Steve Carell', 'Actor'),
(19, 'Rainn Wilson', 'Actor'),
(20, 'John Krasinski', 'Actor'),
(21, 'Jenna Fischer', 'Actor'),
(22, 'David Nutter', 'Director'),
(23, 'Alan Taylor', 'Director'),
(24, 'Emilia Clarke', 'Actor'),
(25, 'Kit Harington', 'Actor'),
(26, 'Peter Dinklage', 'Actor'),
(27, 'Gary Halvorson', 'Director'),
(28, 'Kevin Bright', 'Director'),
(29, 'Courteney Cox', 'Actor'),
(30, 'Matthew Perry', 'Actor'),
(31, 'Wesley Archer', 'Director'),
(32, 'Justin Roiland', 'Actor'),
(33, 'David Fincher', 'Director'),
(34, 'Brad Pitt', 'Actor'),
(35, 'Marc Forster', 'Director');

-- --------------------------------------------------------

--
-- Table structure for table `Stars_in`
--

CREATE TABLE `Stars_in` (
  `per_id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Stars_in`
--

INSERT INTO `Stars_in` (`per_id`, `med_id`) VALUES
(10, 1),
(12, 2),
(15, 2),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(24, 4),
(25, 4),
(26, 4),
(29, 7),
(30, 7),
(32, 8),
(34, 9),
(34, 14);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `usr_id` int(11) NOT NULL,
  `usr_username` varchar(50) NOT NULL,
  `usr_password` varchar(50) NOT NULL,
  `usr_isadmin` tinyint(1) DEFAULT '0',
  `usr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`usr_id`, `usr_username`, `usr_password`, `usr_isadmin`, `usr_date`) VALUES
(1, 'efecankaya', '123', 1, '2022-06-01 06:05:41'),
(2, 'normalaccount', '123', 0, '2022-06-01 06:06:35'),
(3, 'myacc', '123', 0, '2022-06-01 12:35:44'),
(4, 'asd', 'asd', 0, '2022-06-05 09:08:28'),
(5, 'testacc', '123', 0, '2022-06-07 12:14:04'),
(6, 'test', '123', 0, '2022-06-07 17:02:54'),
(7, 'anaccountwithalongusername', '123', 0, '2022-06-07 18:18:07'),
(8, 'user1', '123', 0, '2022-06-07 18:59:09'),
(9, 'user2', '123', 0, '2022-06-07 18:59:14'),
(10, 'user3', '123', 0, '2022-06-07 18:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `Watched`
--

CREATE TABLE `Watched` (
  `usr_id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Watched`
--

INSERT INTO `Watched` (`usr_id`, `med_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(4, 1),
(4, 3),
(4, 4),
(5, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Directs`
--
ALTER TABLE `Directs`
  ADD PRIMARY KEY (`per_id`,`med_id`),
  ADD KEY `med_id` (`med_id`);

--
-- Indexes for table `Favorite`
--
ALTER TABLE `Favorite`
  ADD PRIMARY KEY (`usr_id`,`med_id`),
  ADD KEY `med_id` (`med_id`);

--
-- Indexes for table `Genre`
--
ALTER TABLE `Genre`
  ADD PRIMARY KEY (`gen_id`),
  ADD KEY `gen_name` (`gen_name`);

--
-- Indexes for table `Has_genre`
--
ALTER TABLE `Has_genre`
  ADD PRIMARY KEY (`med_id`,`gen_id`),
  ADD KEY `gen_id` (`gen_id`);

--
-- Indexes for table `Media`
--
ALTER TABLE `Media`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `Stars_in`
--
ALTER TABLE `Stars_in`
  ADD PRIMARY KEY (`per_id`,`med_id`),
  ADD KEY `med_id` (`med_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`usr_id`),
  ADD KEY `usr_username` (`usr_username`),
  ADD KEY `usr_date` (`usr_date`);

--
-- Indexes for table `Watched`
--
ALTER TABLE `Watched`
  ADD PRIMARY KEY (`usr_id`,`med_id`),
  ADD KEY `med_id` (`med_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Genre`
--
ALTER TABLE `Genre`
  MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Media`
--
ALTER TABLE `Media`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `Person`
--
ALTER TABLE `Person`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Directs`
--
ALTER TABLE `Directs`
  ADD CONSTRAINT `directs_ibfk_1` FOREIGN KEY (`per_id`) REFERENCES `Person` (`per_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `directs_ibfk_2` FOREIGN KEY (`med_id`) REFERENCES `Media` (`med_id`) ON DELETE CASCADE;

--
-- Constraints for table `Favorite`
--
ALTER TABLE `Favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `Users` (`usr_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`med_id`) REFERENCES `Media` (`med_id`) ON DELETE CASCADE;

--
-- Constraints for table `Has_genre`
--
ALTER TABLE `Has_genre`
  ADD CONSTRAINT `has_genre_ibfk_1` FOREIGN KEY (`med_id`) REFERENCES `Media` (`med_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `has_genre_ibfk_2` FOREIGN KEY (`gen_id`) REFERENCES `Genre` (`gen_id`) ON DELETE CASCADE;

--
-- Constraints for table `Stars_in`
--
ALTER TABLE `Stars_in`
  ADD CONSTRAINT `stars_in_ibfk_1` FOREIGN KEY (`per_id`) REFERENCES `Person` (`per_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stars_in_ibfk_2` FOREIGN KEY (`med_id`) REFERENCES `Media` (`med_id`) ON DELETE CASCADE;

--
-- Constraints for table `Watched`
--
ALTER TABLE `Watched`
  ADD CONSTRAINT `watched_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `Users` (`usr_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `watched_ibfk_2` FOREIGN KEY (`med_id`) REFERENCES `Media` (`med_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
