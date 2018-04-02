-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 21, 2018 at 07:03 PM
-- Server version: 5.6.36
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `game_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `armies`
--

CREATE TABLE `armies` (
  `ArmyID` mediumint(9) NOT NULL,
  `OwnerID` mediumint(9) NOT NULL,
  `Unit1qty` mediumint(9) NOT NULL,
  `Unit2qty` mediumint(9) NOT NULL,
  `Unit3qty` mediumint(9) NOT NULL,
  `DestID` tinyint(4) NOT NULL,
  `ETA` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `armies`
--

INSERT INTO `armies` (`ArmyID`, `OwnerID`, `Unit1qty`, `Unit2qty`, `Unit3qty`, `DestID`, `ETA`) VALUES
(1, 17, 24, 17, 10, 0, '0000-00-00 00:00:00'),
(2, 17, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(3, 17, 10, 10, 10, 0, '0000-00-00 00:00:00'),
(5, 17, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(6, 17, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(11, 17, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(12, 17, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(13, 17, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(14, 17, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bases`
--

CREATE TABLE `bases` (
  `UserID` mediumint(9) NOT NULL,
  `Level` tinyint(4) NOT NULL,
  `BaseUnit1qty` mediumint(9) NOT NULL,
  `BaseUnit2qty` mediumint(9) NOT NULL,
  `BaseUnit3qty` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bases`
--

INSERT INTO `bases` (`UserID`, `Level`, `BaseUnit1qty`, `BaseUnit2qty`, `BaseUnit3qty`) VALUES
(17, 0, 372, 172, 172),
(18, 0, 232, 232, 232),
(19, 0, 232, 232, 232);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `EventID` smallint(6) NOT NULL,
  `RelatedPlayers` varchar(3000) NOT NULL,
  `RelatedPlanets` tinyint(4) NOT NULL,
  `Description` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `planets`
--

CREATE TABLE `planets` (
  `PlanetID` tinyint(4) NOT NULL,
  `OwnerID` mediumint(9) DEFAULT NULL,
  `Unit1qty` mediumint(9) NOT NULL,
  `Unit2qty` mediumint(9) NOT NULL,
  `Unit3qty` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `planets`
--

INSERT INTO `planets` (`PlanetID`, `OwnerID`, `Unit1qty`, `Unit2qty`, `Unit3qty`) VALUES
(1, NULL, 0, 0, 0),
(2, NULL, 0, 0, 0),
(3, 17, 0, 0, 0),
(4, NULL, 0, 0, 0),
(5, NULL, 0, 0, 0),
(6, NULL, 0, 0, 0),
(7, NULL, 0, 0, 0),
(8, NULL, 0, 0, 0),
(9, NULL, 0, 0, 0),
(10, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` mediumint(9) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` char(128) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Gender` tinyint(1) NOT NULL,
  `AvatarLoc` varchar(150) NOT NULL,
  `Points` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `Gender`, `AvatarLoc`, `Points`) VALUES
(17, 'testf', '123', '123@312.123', 1, 'img/avatars/2f4525b5d0837a6a46bb6818be313eaa868a84853af2adedf3de6128f84f0e81.jpeg', 0),
(18, 'testav', '123', '123@312.123', 0, 'img/avatars/93517fc6d0e8b416f0b862648617946187b84eca1028af83d893bfb06e8e4360.jpeg', 0),
(19, 'testimg', '123', '123@312.123', 0, 'img/avatars/4c4af6ddb1e1396338278793d41e3345ec80dc15790d73728899178033cc131a.jpeg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armies`
--
ALTER TABLE `armies`
  ADD PRIMARY KEY (`ArmyID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `bases`
--
ALTER TABLE `bases`
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `planets`
--
ALTER TABLE `planets`
  ADD PRIMARY KEY (`PlanetID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armies`
--
ALTER TABLE `armies`
  MODIFY `ArmyID` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `planets`
--
ALTER TABLE `planets`
  MODIFY `PlanetID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `armies`
--
ALTER TABLE `armies`
  ADD CONSTRAINT `aownuser` FOREIGN KEY (`OwnerID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bases`
--
ALTER TABLE `bases`
  ADD CONSTRAINT `bownuser` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `planets`
--
ALTER TABLE `planets`
  ADD CONSTRAINT `pownuser` FOREIGN KEY (`OwnerID`) REFERENCES `users` (`UserID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

