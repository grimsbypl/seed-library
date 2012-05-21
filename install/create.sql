DROP DATABASE IF EXISTS `seeddb`;
CREATE DATABASE IF NOT EXISTS `seeddb`;
USE `seeddb`;

CREATE TABLE IF NOT EXISTS `logins` (
  `UserID` int(11) NOT NULL,
  `loginTime` datetime NOT NULL,
  PRIMARY KEY (`UserID`,`loginTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` datetime NOT NULL,
  `UserID` int(11) NOT NULL,
  `SeedID` int(11) NOT NULL,
  `Count` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `TransactionDate` (`Date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `seeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Common_Name` varchar(40) NOT NULL,
  `Latin_Name` varchar(40) DEFAULT NULL,
  `Variety` varchar(30) NOT NULL,
  `Year_Harvested` int(4) DEFAULT NULL,
  `Location` varchar(20) NOT NULL,
  `Experience` tinyint(1) NOT NULL,
  `Notes` varchar(100) NOT NULL,
  `Last_Seed` tinyint(1) NOT NULL default 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DateReg` date NOT NULL,
  `NameFirst` varchar(40) NOT NULL,
  `NameLast` varchar(40) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `Email` (`Email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
