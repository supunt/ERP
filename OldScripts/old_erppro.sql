-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 27, 2017 at 08:54 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `erppro`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemname` varchar(150) NOT NULL,
  `vendorID` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `extraDescription` varchar(255) DEFAULT NULL,
  `purchasingUOM` varchar(45) DEFAULT NULL,
  `sellingUOM` varchar(45) DEFAULT NULL,
  `stockingUOM` varchar(45) DEFAULT NULL,
  `drawingNumber` varchar(45) DEFAULT NULL,
  `cost` varchar(45) DEFAULT NULL,
  `listPrice` varchar(45) DEFAULT NULL,
  `MinBalance` varchar(15) NOT NULL,
  `leadTime` varchar(45) DEFAULT NULL,
  `abcCode` varchar(45) DEFAULT NULL,
  `exfield1` varchar(200) DEFAULT NULL,
  `exfield2` varchar(200) DEFAULT NULL,
  `exfield3` varchar(200) DEFAULT NULL,
  `createddate` datetime DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `itemname`, `vendorID`, `description`, `extraDescription`, `purchasingUOM`, `sellingUOM`, `stockingUOM`, `drawingNumber`, `cost`, `listPrice`, `MinBalance`, `leadTime`, `abcCode`, `exfield1`, `exfield2`, `exfield3`, `createddate`, `updatedate`) VALUES
(29, 'Part  1', '15', 'Part  1  Description ', 'Part  1 Extra Description ', 'code1', 'code1', 'code1', '101010', '1500.00', '1600.00', '120', '111', 'ABC 025', 'Extra Fields 1', 'Extra Fields 2', 'Extra Fields 3', '2017-06-27 22:06:37', '2017-06-27 22:06:37'),
(30, 'Part  2', '15', 'Part  2', 'Part  2', 'code2', 'code2', 'code2', 'Part  2 Drawing NO', '200', '220', '210', '222', 'ABC 222', 'Ex2 1', 'Ex2 2', 'Ex2 3', '2017-06-27 22:08:02', '2017-06-27 22:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder`
--

CREATE TABLE IF NOT EXISTS `purchaseorder` (
  `pid` int(20) NOT NULL AUTO_INCREMENT,
  `vendorno` varchar(20) NOT NULL,
  `warehousecode` varchar(20) NOT NULL,
  `adddate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `purchaseorder`
--

INSERT INTO `purchaseorder` (`pid`, `vendorno`, `warehousecode`, `adddate`, `updatedate`) VALUES
(1, '15', 'code1', '2017-06-28 00:05:36', '2017-06-28 00:05:36'),
(2, '15', 'code4', '2017-06-28 00:17:29', '2017-06-28 00:17:29'),
(3, '15', 'code1', '2017-06-28 00:21:35', '2017-06-28 00:21:35'),
(4, '', 'code1', '2017-06-28 02:16:12', '2017-06-28 02:16:12'),
(5, '15', 'code1', '2017-06-28 02:20:49', '2017-06-28 02:20:49'),
(6, '', 'code1', '2017-06-28 02:22:35', '2017-06-28 02:22:35'),
(7, '15', 'code1', '2017-06-28 02:23:09', '2017-06-28 02:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorderetails`
--

CREATE TABLE IF NOT EXISTS `purchaseorderetails` (
  `podid` int(20) NOT NULL AUTO_INCREMENT,
  `pid` int(20) NOT NULL,
  `partnumber` varchar(20) NOT NULL,
  `location` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `cost` varchar(50) NOT NULL,
  `duedate` varchar(50) NOT NULL,
  `requestedqty` varchar(50) NOT NULL,
  `receptquantity` varchar(50) NOT NULL,
  PRIMARY KEY (`podid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `purchaseorderetails`
--

INSERT INTO `purchaseorderetails` (`podid`, `pid`, `partnumber`, `location`, `quantity`, `cost`, `duedate`, `requestedqty`, `receptquantity`) VALUES
(6, 1, '29', 'Location 02', '10', '1500.00', '20-02-2017', '', ''),
(9, 2, '29', 'Location 02', '10', '1500.00', '20-02-2017', 'null', 'null'),
(11, 3, '29', 'Location 01', '10', '1500.00', '20-02-2017', 'null', 'null'),
(14, 3, '30', 'Location 02', '2', '2', '2', 'null', 'null'),
(17, 3, '30', 'Location 03', '3333', '333', '333', 'null', 'null'),
(18, 5, '29', 'Location 01', 'x', 'x', 'x', 'null', 'null'),
(19, 5, '29', 'Location 01', 'd', 'd', 'd', 'null', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `vendermaster`
--

CREATE TABLE IF NOT EXISTS `vendermaster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vname` varchar(150) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `address1` varchar(150) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `suburb` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `postcode` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `termscode` varchar(45) DEFAULT NULL,
  `extrafield1` varchar(100) DEFAULT NULL,
  `extrafield2` varchar(100) DEFAULT NULL,
  `extrafield3` varchar(100) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `updateddate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `vendermaster`
--

INSERT INTO `vendermaster` (`id`, `vname`, `description`, `address1`, `address2`, `suburb`, `state`, `postcode`, `country`, `termscode`, `extrafield1`, `extrafield2`, `extrafield3`, `createdate`, `updateddate`) VALUES
(15, 'Vendor 01', 'Vendor 01 Description ', 'Vendor 01 Address 1', 'Vendor 01 Address 2', 'Vendor 01 Suburb', 'Vendor 01', '123456', 'AU', 'code1', 'Ex 01', 'Ex 02', 'Ex 03', '2017-06-27 22:01:38', '2017-06-27 22:01:38'),
(16, 'Vendor 02', 'Vendor 02 Description ', 'Vendor 02 Address 1 ', 'Vendor 02 Address 2 ', 'Vendor 02 Suburb', 'Vendor 02 State', '5678', 'UK', 'code1', '', '', '', '2017-06-27 22:04:25', '2017-06-27 22:04:25');
