CREATE DATABASE IF NOT EXISTS `seeddb`;
USE `seeddb`;

CREATE TABLE IF NOT EXISTS `logins` (
  `UserID` int(11) NOT NULL,
  `loginTime` datetime NOT NULL,
  PRIMARY KEY (`UserID`,`loginTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `seedcatalog` (
  `Common_Name` varchar(40) NOT NULL,
  `Latin_Name` varchar(40) DEFAULT NULL,
  `Date` date NOT NULL,
  `Variety` varchar(30) NOT NULL,
  `MemberID` varchar(35) NOT NULL,
  `Year_Harvested` int(4) DEFAULT NULL,
  `Location` varchar(20) NOT NULL,
  `Experience` varchar(15) NOT NULL,
  `Notes` varchar(100) NOT NULL,
  `TransactionID` int(11) NOT NULL AUTO_INCREMENT,
  `Last_Seed` varchar(4) NOT NULL,
  PRIMARY KEY (`TransactionID`),
  UNIQUE KEY `Common_Name` (`Common_Name`,`Date`,`Variety`,`MemberID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DateReg` date NOT NULL,
  `NameFirst` varchar(40) NOT NULL,
  `NameLast` varchar(40) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `SeedExpLvl` varchar(15) NOT NULL,
  `GardenExpLvl` varchar(15) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `Email` (`Email`),
  KEY `DateReg` (`DateReg`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
