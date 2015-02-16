-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2015 at 10:44 AM
-- Server version: 5.5.41-cll-lve
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `customdbase2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `usertype` varchar(100) NOT NULL,
  `loggedin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL,
  PRIMARY KEY (`adminID`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `alternate_pickup_location`
--

CREATE TABLE IF NOT EXISTS `alternate_pickup_location` (
  `student id` int(11) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `zip` text NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Alternate pickup locations for student';

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `keyname` varchar(250) NOT NULL,
  `valuename` text NOT NULL,
  PRIMARY KEY (`keyname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE IF NOT EXISTS `coupons` (
  `couponID` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(250) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `minpurchase` decimal(10,2) NOT NULL DEFAULT '0.00',
  `maxuses` int(11) NOT NULL DEFAULT '0',
  `expiration` date DEFAULT NULL,
  `notes` text,
  `timesused` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `active` enum('0','1') NOT NULL COMMENT 'switch to determine coupons are displayed for admin',
  PRIMARY KEY (`couponID`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `driverstraining`
--

CREATE TABLE IF NOT EXISTS `driverstraining` (
  `driverstrainingID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL COMMENT 'vehicle id from vehicle table',
  `adminID_lastedit` int(11) DEFAULT NULL,
  `instructorID` int(11) NOT NULL,
  `classdate` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `pickup` varchar(250) DEFAULT NULL,
  `pickup_dropdown` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `confirmed_date` datetime DEFAULT NULL,
  `confirmed_by` varchar(50) DEFAULT NULL,
  `confirmed_adminID` int(11) DEFAULT NULL,
  `confirmed_text` varchar(250) DEFAULT NULL,
  `instructor_timein` time DEFAULT NULL,
  `instructor_timeout` time DEFAULT NULL,
  `instructor_mileagein` decimal(10,1) DEFAULT NULL,
  `instructor_mileageout` decimal(10,1) DEFAULT NULL,
  `officialhours` decimal(4,2) NOT NULL DEFAULT '0.00',
  `notes` text,
  `csrupdate` enum('Y','N') NOT NULL DEFAULT 'N',
  `timesheetID` int(11) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`driverstrainingID`),
  KEY `userID` (`userID`),
  KEY `instructorID` (`instructorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60533 ;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `emailID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `toaddress` varchar(250) NOT NULL,
  `emailtext` text NOT NULL,
  `datesent` datetime NOT NULL,
  PRIMARY KEY (`emailID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6268 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas`
--

CREATE TABLE IF NOT EXISTS `gas` (
  `gasID` int(11) NOT NULL AUTO_INCREMENT,
  `instructorID` int(11) NOT NULL,
  `day` date NOT NULL,
  `station` varchar(200) NOT NULL,
  `mileage` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `gallons` float NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`gasID`),
  KEY `instructorID` (`instructorID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE IF NOT EXISTS `instructors` (
  `instructorID` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `payrate_hourly` decimal(10,2) NOT NULL,
  `payrate_noshow` decimal(10,2) NOT NULL,
  `payrate_2hourteen` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payrate_1hourteen` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payrate_senior` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payrate_dmvservice` decimal(10,2) NOT NULL,
  `licensenum` varchar(250) DEFAULT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `loggedin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL,
  PRIMARY KEY (`instructorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Table structure for table `instructors_hours`
--

CREATE TABLE IF NOT EXISTS `instructors_hours` (
  `instructorhoursID` int(11) NOT NULL AUTO_INCREMENT,
  `instructorID` int(11) NOT NULL,
  `hours` decimal(5,2) NOT NULL,
  `datefor` date NOT NULL,
  `notes` text,
  `adminID` int(11) DEFAULT NULL,
  `timesheetID` int(11) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`instructorhoursID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `instructors_logs`
--

CREATE TABLE IF NOT EXISTS `instructors_logs` (
  `instructorID` int(11) NOT NULL,
  `day` date NOT NULL,
  `hours` int(11) NOT NULL DEFAULT '0',
  `carwash` enum('Y','N') NOT NULL DEFAULT 'N',
  `reimburse_amount` decimal(10,2) DEFAULT NULL,
  `reimburse_reason` varchar(250) DEFAULT NULL,
  `other_amount` decimal(10,2) DEFAULT NULL,
  `other_reason` varchar(250) DEFAULT NULL,
  `adminID_lastedit` int(11) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`instructorID`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE IF NOT EXISTS `lists` (
  `listID` int(11) NOT NULL AUTO_INCREMENT,
  `listname` varchar(250) NOT NULL,
  `itemname` varchar(250) NOT NULL,
  PRIMARY KEY (`listID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1366 ;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `packageID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `payments` int(11) NOT NULL DEFAULT '1',
  `description` text,
  `driversed` enum('Y','N') NOT NULL DEFAULT 'N',
  `driversed_class` enum('Y','N') NOT NULL DEFAULT 'N',
  `wheelhours` int(11) NOT NULL DEFAULT '0',
  `cat` varchar(150) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`packageID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151 ;

-- --------------------------------------------------------

--
-- Table structure for table `studentnotes`
--

CREATE TABLE IF NOT EXISTS `studentnotes` (
  `noteID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `adminID` int(11) DEFAULT NULL,
  `note` text NOT NULL,
  `date_entered` datetime NOT NULL,
  PRIMARY KEY (`noteID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=632 ;

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE IF NOT EXISTS `timesheets` (
  `timesheetID` int(11) NOT NULL AUTO_INCREMENT,
  `instructorID` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `status` varchar(150) DEFAULT NULL,
  `notes` text,
  `date_added` datetime DEFAULT NULL,
  `date_closed_out` datetime DEFAULT NULL,
  `payrate_hourly` decimal(10,2) DEFAULT NULL,
  `payrate_noshow` decimal(10,2) DEFAULT NULL,
  `payrate_driversed` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payrate_2hourteen` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payrate_1hourteen` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payrate_senior` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`timesheetID`),
  UNIQUE KEY `instructorID` (`instructorID`,`startdate`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1145 ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `transactionID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `adminID_lastedit` int(11) DEFAULT NULL,
  `packageID` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `method` varchar(150) NOT NULL,
  `deposited` enum('Y','N') NOT NULL DEFAULT 'N',
  `deposited_date` datetime DEFAULT NULL,
  `deposited_user` varchar(200) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `deposit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `balance_due` decimal(10,2) NOT NULL DEFAULT '0.00',
  `balance_paid` decimal(10,2) NOT NULL DEFAULT '0.00',
  `check_num` varchar(150) DEFAULT NULL,
  `receipt_num` varchar(150) DEFAULT NULL,
  `cardname` varchar(250) DEFAULT NULL,
  `cardtype` varchar(150) DEFAULT NULL,
  `authnum` varchar(150) DEFAULT NULL,
  `subscriptionid` varchar(250) DEFAULT NULL,
  `couponID` int(11) DEFAULT NULL,
  `couponamount` int(11) NOT NULL,
  `discountamount` int(11) NOT NULL,
  `discountnote` int(11) NOT NULL,
  `transid` varchar(150) DEFAULT NULL,
  `notes` varchar(250) DEFAULT NULL,
  `date_charged` date NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`transactionID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16797 ;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `sb_student_id` int(11) NOT NULL,
  `user` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `cross_street` varchar(250) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `cellphone` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `school` varchar(250) DEFAULT NULL,
  `parent_name` varchar(250) NOT NULL,
  `parent_relation` varchar(250) NOT NULL,
  `parent_cellphone` varchar(50) DEFAULT NULL,
  `dt_cert` varchar(100) DEFAULT NULL,
  `dt_date` date DEFAULT NULL,
  `de_cert` varchar(100) DEFAULT NULL,
  `de_date` date DEFAULT NULL,
  `permit_complete` varchar(100) DEFAULT NULL,
  `permit_date` date DEFAULT NULL,
  `permit_num` varchar(100) DEFAULT NULL,
  `permit_issuedate` date DEFAULT NULL,
  `permit_expiredate` date DEFAULT NULL,
  `instructor_license` varchar(100) DEFAULT NULL,
  `mailpermit` varchar(50) NOT NULL DEFAULT 'mail',
  `notes` text,
  `addedby` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL,
  `loggedin` datetime DEFAULT NULL,
  `archived_reinstated` date DEFAULT NULL,
  `archived` enum('Y','N') NOT NULL DEFAULT 'N',
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `econtact1name` text NOT NULL,
  `econtact1email` text NOT NULL,
  `econtact1phone` text NOT NULL,
  `econtact2name` text NOT NULL,
  `econtact2email` text NOT NULL,
  `econtact2phone` text NOT NULL,
  `alt_pickup_name` text NOT NULL,
  `alt_pickup_address` text NOT NULL,
  `alt_pickup_city` text NOT NULL,
  `alt_latitude` float NOT NULL,
  `alt_longitude` float NOT NULL,
  `customerProfileID` int(11) NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `sb_student_id` (`sb_student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14623 ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `license_plate` char(7) DEFAULT NULL,
  `vin` char(17) DEFAULT NULL COMMENT 'Vehicle ID number ',
  `year` year(4) DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `acquisition_date` date NOT NULL,
  `aquisition_price` int(11) NOT NULL COMMENT 'purchase price for calculating depreciation',
  `aquired_from` text NOT NULL,
  `disposal_date` date NOT NULL COMMENT 'date car was removed from inventory',
  `disposal_amount` int(11) NOT NULL COMMENT 'price vehicle was sold for - used for asset depreciation',
  `disposal_notes` varchar(200) NOT NULL COMMENT 'Notes regarding disposal - who it was sold to, why etc',
  `active_flag` enum('0','1') NOT NULL,
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='vehicle master table' AUTO_INCREMENT=11 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
