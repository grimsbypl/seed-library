-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2011 at 11:33 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
CREATE DATABASE seeddb;

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `Email` varchar(35) NOT NULL,
  `loginTime` datetime NOT NULL,
  PRIMARY KEY (`Email`,`loginTime`),
  UNIQUE KEY `loginTime` (`loginTime`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `seedcatalog`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;


--
-- Table structure for table `userseedreg`
--

CREATE TABLE IF NOT EXISTS `userseedreg` (
  `DateReg` date NOT NULL,
  `NameFirst` varchar(40) NOT NULL,
  `NameLast` varchar(40) NOT NULL,
  `OrgName` varchar(40) DEFAULT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(30) NOT NULL,
  `PhoneNum` varchar(15) DEFAULT NULL,
  `Email` varchar(35) NOT NULL,
  `ContactYN` varchar(4) NOT NULL,
  `SeedExpLvl` varchar(15) NOT NULL,
  `GardenExpLvl` varchar(15) NOT NULL,
  `Volunteer` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Email`),
  KEY `DateReg` (`DateReg`),
  KEY `DateReg_2` (`DateReg`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `volunteer_user_map`
--

CREATE TABLE IF NOT EXISTS `volunteer_user_map` (
  `email` varchar(50) NOT NULL,
  `Type` varchar(10) NOT NULL,
  PRIMARY KEY (`email`,`Type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



