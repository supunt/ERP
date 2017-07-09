-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2017 at 07:12 AM
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
(3, 'Wireless Door Chime - 716970', '20', 'Wireless Door Chime - 716970', 'What you need to know before purchasing\r\nNot all stores carry stock of this product, but will order it in for you. Please allow up to 14 days for stock to arrive at your selected store.\r\n- Products are available while stocks last\r\n- Please allow up to 1', 'KG', 'KG', 'KG', 'DR4545454', '85', '78', '450', '5', 'ABC7878', 'TEST1', 'TEST2', 'TEST3', '2017-07-05 14:33:58', '2017-07-05 14:33:58'),
(4, 'Analogue Timer - D809/1', '22', 'Analogue Timer - D809/1', 'What you need to know before purchasing\r\nNot all stores carry stock of this product, but will order it in for you. Please allow up to 14 days for stock to arrive at your selected store.\r\n- Products are available while stocks last\r\n- Please allow up to 1', 'KG', 'KG', 'KG', 'DRW687687786', '45', '12', '', '5', 'ABC09898', 'TEST1', 'TEST2', 'TEST3', '2017-07-05 14:36:19', '2017-07-05 14:36:19'),
(5, 'Dewalt Pro Headtorch', '22', 'Dewalt Pro Headtorch', 'High/Low setting. 6 hours runtime on high setting. 29 hours 48 minutes on low setting. Runs on 3 AAA batteries (Included). 104 lumens of bright white light. 2 metre impact resistant . Water resistant . Shatter resistant lens for durability. Anti-slip', 'KG', 'KG', 'KG', '3253560704407', '45', '56', '55', '10', 'ABC98897', 'TESt1', 'TEST2', 'TEST3', '2017-07-05 14:37:27', '2017-07-05 14:37:27');

-- --------------------------------------------------------

--
-- Table structure for table `location_master`
--

CREATE TABLE `location_master` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(8, '20', 'code1', '2017-07-05 14:45:58', '2017-07-05 14:45:58');

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
  `receptquantity` varchar(50) NOT NULL,
  `receiveddate` varchar(50) DEFAULT '',
  `linestatus` char(11) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseorderetails`
--

INSERT INTO `purchaseorderetails` (`podid`, `pid`, `partnumber`, `location`, `quantity`, `cost`, `duedate`, `requestedqty`, `receptquantity`, `receiveddate`, `linestatus`) VALUES
(1, 8, '4', '', '100', '4500', '2017-07-05', 'null', 'null', NULL, NULL),
(2, 8, '5', '', '25', '1125', '2017-07-05', 'null', 'null', NULL, NULL),
(20, 8, '3', '', '25', '2125', '2017-07-05', 'null', 'null', NULL, NULL);

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
(20, 'HOME TIMBER & HARDWARE', 'HOME TIMBER & HARDWARE', '298', 'Coventry St', 'South Melbourne', 'VIC', '3205', 'Australia', 'code1', 'Home Timber & Hardware is the home of quality products and expert advice. We are committed to delive', 'Home Timber & Hardware is the home of quality products and expert advice. We are committed to delive', 'Home Timber & Hardware is the home of quality products and expert advice. We are committed to delive', '2017-07-05 14:04:38', '2017-07-05 14:04:38'),
(21, 'Bunnings Warehouse', 'Bunnings Group, trading as Bunnings Warehouse, is Australias largest household hardware chain. The chain has been owned by Wesfarmers since 1994, and has stores in Australia, New Zealand, and the United Kingdom', '230', 'Burwood Road', 'BOXHILL', 'VIC', '3128', 'Australia', 'code1', 'Bring the kids into the Box Hill store today to attend our Balloon Twisting workshop for some School', 'Bring the kids into the Box Hill store today to attend our Balloon Twisting workshop for some School', 'Bring the kids into the Box Hill store today to attend our Balloon Twisting workshop for some School', '2017-07-05 14:09:10', '2017-07-05 14:09:10'),
(22, 'MITRE10', 'Mitre 10, formed in 1959, is a large player in the Australian home improvement and hardware industry. The Mitre 10 group comprises.', '12', 'Dansu Court', 'Hallam', 'VIC', '3845', 'Australia', 'code1', 'Australias largest independent home improvement and hardware wholesaler to the industry.\r\n', 'Australias largest independent home improvement and hardware wholesaler to the industry.\r\nAn iconic ', 'Australias largest independent home improvement and hardware wholesaler to the industry.\r\nAn iconic ', '2017-07-05 14:14:36', '2017-07-05 14:14:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_master`
--
ALTER TABLE `location_master`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `location_master`
--
ALTER TABLE `location_master`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  MODIFY `pid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `purchaseorderetails`
--
ALTER TABLE `purchaseorderetails`
  MODIFY `podid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `vendermaster`
--
ALTER TABLE `vendermaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
