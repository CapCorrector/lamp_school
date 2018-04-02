SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `armies` (
  `ArmyID` mediumint(9) NOT NULL,
  `OwnerID` mediumint(9) NOT NULL,
  `Unit1qty` mediumint(9) NOT NULL,
  `Unit2qty` mediumint(9) NOT NULL,
  `Unit3qty` mediumint(9) NOT NULL,
  `DestID` tinyint(4) NOT NULL,
  `ETA` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `bases` (
  `UserID` mediumint(9) NOT NULL,
  `Level` tinyint(4) NOT NULL,
  `BaseUnit1qty` mediumint(9) NOT NULL,
  `BaseUnit2qty` mediumint(9) NOT NULL,
  `BaseUnit3qty` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `logs` (
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `EventID` smallint(6) NOT NULL,
  `RelatedPlayers` varchar(3000) NOT NULL,
  `RelatedPlanets` tinyint(4) NOT NULL,
  `Description` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `planets` (
  `PlanetID` tinyint(4) NOT NULL,
  `OwnerID` mediumint(9) DEFAULT NULL,
  `Unit1qty` mediumint(9) NOT NULL,
  `Unit2qty` mediumint(9) NOT NULL,
  `Unit3qty` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `planets` (`PlanetID`, `OwnerID`, `Unit1qty`, `Unit2qty`, `Unit3qty`) VALUES
(1, NULL, 0, 0, 0),
(2, NULL, 0, 0, 0),
(3, NULL, 0, 0, 0),
(4, NULL, 0, 0, 0),
(5, NULL, 0, 0, 0),
(6, NULL, 0, 0, 0),
(7, NULL, 0, 0, 0),
(8, NULL, 0, 0, 0),
(9, NULL, 0, 0, 0),
(10, NULL, 0, 0, 0);

CREATE TABLE `users` (
  `UserID` mediumint(9) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` char(128) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Gender` tinyint(1) NOT NULL,
  `AvatarLoc` varchar(150) NOT NULL,
  `Points` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `armies`
  ADD PRIMARY KEY (`ArmyID`),
  ADD KEY `OwnerID` (`OwnerID`);

ALTER TABLE `bases`
  ADD KEY `UserID` (`UserID`);

ALTER TABLE `planets`
  ADD PRIMARY KEY (`PlanetID`),
  ADD KEY `OwnerID` (`OwnerID`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);


ALTER TABLE `armies`
  MODIFY `ArmyID` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
ALTER TABLE `planets`
  MODIFY `PlanetID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
ALTER TABLE `users`
  MODIFY `UserID` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `armies`
  ADD CONSTRAINT `aownuser` FOREIGN KEY (`OwnerID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `bases`
  ADD CONSTRAINT `bownuser` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `planets`
  ADD CONSTRAINT `pownuser` FOREIGN KEY (`OwnerID`) REFERENCES `users` (`UserID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;
