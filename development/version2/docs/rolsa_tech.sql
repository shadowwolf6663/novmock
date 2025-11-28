-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2025 at 09:05 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rolsa_tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `builders`
--

CREATE TABLE `builders` (
  `builderid` int NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `date_joined` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `builders`
--

INSERT INTO `builders` (`builderid`, `username`, `password`, `date_joined`) VALUES
(1, 'tyler', '$2y$10$c.vkwYE2PdBmXgeKw72Dr.GPFrpyhotczEZT1Z.AKpFSMDpS.Tbf6', 1763631662);

-- --------------------------------------------------------

--
-- Table structure for table `consultants`
--

CREATE TABLE `consultants` (
  `consultantid` int NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `date_joined` int NOT NULL,
  `consultant_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `consultants`
--

INSERT INTO `consultants` (`consultantid`, `username`, `password`, `date_joined`, `consultant_name`) VALUES
(1, 'tyler', '$2y$10$.seZatNYI6kPAtl.TMAaf.Oqb4.hHrilRWogBUPOeUGtCccrg/nPC', 1763631858, 'bob');

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `consultationid` int NOT NULL,
  `date_booked` int NOT NULL,
  `date_of_consultation` int NOT NULL,
  `consultantid` int NOT NULL,
  `userid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`consultationid`, `date_booked`, `date_of_consultation`, `consultantid`, `userid`) VALUES
(2, 1763643559, 1763686740, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `installations`
--

CREATE TABLE `installations` (
  `installationid` int NOT NULL,
  `date_booked` int NOT NULL,
  `date_of_installation` int NOT NULL,
  `location_of_installation` text NOT NULL,
  `builderid` int NOT NULL,
  `userid` int NOT NULL,
  `installation_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `installations`
--

INSERT INTO `installations` (`installationid`, `date_booked`, `date_of_installation`, `location_of_installation`, `builderid`, `userid`, `installation_type`) VALUES
(6, 1763648345, 1761873540, 'ls1', 1, 1, 'smart_meter');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `date_joined` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `date_joined`) VALUES
(1, 'tyler', '$2y$10$Pc4Ymj8MCrkWwaJRda/6S.i1LDmc./8AXL8YU9QA7OiY.17jqBefq', 1763459017);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `builders`
--
ALTER TABLE `builders`
  ADD PRIMARY KEY (`builderid`);

--
-- Indexes for table `consultants`
--
ALTER TABLE `consultants`
  ADD PRIMARY KEY (`consultantid`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`consultationid`),
  ADD KEY `consultantid` (`consultantid`,`userid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `installations`
--
ALTER TABLE `installations`
  ADD PRIMARY KEY (`installationid`),
  ADD KEY `builderid` (`builderid`,`userid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `builders`
--
ALTER TABLE `builders`
  MODIFY `builderid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consultants`
--
ALTER TABLE `consultants`
  MODIFY `consultantid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `consultationid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `installations`
--
ALTER TABLE `installations`
  MODIFY `installationid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultations_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultations_ibfk_2` FOREIGN KEY (`consultantid`) REFERENCES `consultants` (`consultantid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `installations`
--
ALTER TABLE `installations`
  ADD CONSTRAINT `installations_ibfk_1` FOREIGN KEY (`builderid`) REFERENCES `builders` (`builderid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `installations_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
