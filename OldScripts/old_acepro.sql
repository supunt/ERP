-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2017 at 11:26 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acepro`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
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
  `updatedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `itemname`, `vendorID`, `description`, `extraDescription`, `purchasingUOM`, `sellingUOM`, `stockingUOM`, `drawingNumber`, `cost`, `listPrice`, `MinBalance`, `leadTime`, `abcCode`, `exfield1`, `exfield2`, `exfield3`, `createddate`, `updatedate`) VALUES
(2, 'baby-1', '15', 'baby item 2', 'bay item 2 with more details', 'code2', 'code4', 'code1', 'dra1234-2', '90.92', '77.92', '3344', '8', 'abc1234', 'hgjhgjgjhghjghjgj', 'uoiuoiouoiuououo', 'kljlkjljljljlkjjljjlkjl', '2017-07-03 19:19:54', '2017-07-03 19:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder`
--

CREATE TABLE `purchaseorder` (
  `pid` int(20) NOT NULL,
  `vendorno` varchar(20) NOT NULL,
  `warehousecode` varchar(20) NOT NULL,
  `adddate` datetime NOT NULL,
  `updatedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `purchaseorderetails` (
  `podid` int(20) NOT NULL,
  `pid` int(20) NOT NULL,
  `partnumber` varchar(20) NOT NULL,
  `location` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `cost` varchar(50) NOT NULL,
  `duedate` varchar(50) NOT NULL,
  `requestedqty` varchar(50) NOT NULL,
  `receptquantity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `vendermaster` (
  `id` int(11) NOT NULL,
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
  `updateddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendermaster`
--

INSERT INTO `vendermaster` (`id`, `vname`, `description`, `address1`, `address2`, `suburb`, `state`, `postcode`, `country`, `termscode`, `extrafield1`, `extrafield2`, `extrafield3`, `createdate`, `updateddate`) VALUES
(15, 'Vendor 01', 'Vendor 01 Description ', 'Vendor 01 Address 1', 'Vendor 01 Address 2', 'Vendor 01 Suburb', 'Vendor 01', '123456', 'AU', 'code1', 'Ex 01', 'Ex 02', 'Ex 03', '2017-06-27 22:01:38', '2017-06-27 22:01:38'),
(16, 'Vendor 02', 'Vendor 02 Description ', 'Vendor 02 Address 1 ', 'Vendor 02 Address 2 ', 'Vendor 02 Suburb', 'Vendor 02 State', '5678', 'UK', 'code1', '', '', '', '2017-06-27 22:04:25', '2017-06-27 22:04:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `purchaseorderetails`
--
ALTER TABLE `purchaseorderetails`
  ADD PRIMARY KEY (`podid`);

--
-- Indexes for table `vendermaster`
--
ALTER TABLE `vendermaster`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  MODIFY `pid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `purchaseorderetails`
--
ALTER TABLE `purchaseorderetails`
  MODIFY `podid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `vendermaster`
--
ALTER TABLE `vendermaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
