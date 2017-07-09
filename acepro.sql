-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2017 at 07:23 AM
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
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
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
);

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `itemname`, `vendorID`, `description`, `extraDescription`, `purchasingUOM`, `sellingUOM`, `stockingUOM`, `drawingNumber`, `cost`, `listPrice`, `MinBalance`, `leadTime`, `abcCode`, `exfield1`, `exfield2`, `exfield3`, `createddate`, `updatedate`) VALUES
(3, 'Wireless Door Chime - 716970', '20', 'Wireless Door Chime - 716970', 'What you need to know before purchasing\r\nNot all stores carry stock of this product, but will order it in for you. Please allow up to 14 days for stock to arrive at your selected store.\r\n- Products are available while stocks last\r\n- Please allow up to 1', 'KG', 'KG', 'KG', 'DR4545454', '85', '78', '450', '5', 'ABC7878', 'TEST1', 'TEST2', 'TEST3', '2017-07-05 14:33:58', '2017-07-05 14:33:58'),
(4, 'Analogue Timer - D809/1', '22', 'Analogue Timer - D809/1', 'What you need to know before purchasing\r\nNot all stores carry stock of this product, but will order it in for you. Please allow up to 14 days for stock to arrive at your selected store.\r\n- Products are available while stocks last\r\n- Please allow up to 1', 'KG', 'KG', 'KG', 'DRW687687786', '45', '12', '', '5', 'ABC09898', 'TEST1', 'TEST2', 'TEST3', '2017-07-05 14:36:19', '2017-07-05 14:36:19'),
(5, 'Dewalt Pro Headtorch', '22', 'Dewalt Pro Headtorch', 'High/Low setting. 6 hours runtime on high setting. 29 hours 48 minutes on low setting. Runs on 3 AAA batteries (Included). 104 lumens of bright white light. 2 metre impact resistant . Water resistant . Shatter resistant lens for durability. Anti-slip', 'KG', 'KG', 'KG', '3253560704407', '45', '56', '55', '10', 'ABC98897', 'TESt1', 'TEST2', 'TEST3', '2017-07-05 14:37:27', '2017-07-05 14:37:27');

-- --------------------------------------------------------

--
-- Table structure for table `locationtrans`
--

CREATE TABLE `locationtrans` (
  `ID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `PartID` int(11) NOT NULL,
  `WhsID` int(11) NOT NULL,
  `LocID` int(11) NOT NULL,
  `OpenBal` float NOT NULL,
  `Receipts` float NOT NULL,
  `Issues` float NOT NULL,
  `Adjustmenst` float NOT NULL,
  `Allocations` float NOT NULL,
  `Last_Txn_Date` date NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `location_master`
--

CREATE TABLE `location_master` (
  `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder`
--

CREATE TABLE `purchaseorder` (
  `pid` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `vendorno` varchar(20) NOT NULL,
  `warehousecode` varchar(20) NOT NULL,
  `adddate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `status` char(1) DEFAULT 'N'
) ;

--
-- Dumping data for table `purchaseorder`
--

INSERT INTO `purchaseorder` (`vendorno`, `warehousecode`, `adddate`, `updatedate`, `status`) VALUES
('20', 'code1', '2017-07-05 14:45:58', '2017-07-05 14:45:58', NULL);

INSERT INTO `purchaseorder` (`vendorno`, `warehousecode`, `adddate`, `updatedate`, `status`) VALUES
('20', 'code1', '2017-07-05 14:45:58', '2017-07-05 14:45:58', NULL);
-- --------------------------------------------------------

--
-- Table structure for table `purchaseorderetails`
--

CREATE TABLE `purchaseorderetails` (
  `podid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `partnumber` varchar(20) NOT NULL,
  `location` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `cost` varchar(50) NOT NULL,
  `duedate` varchar(50) NOT NULL,
  `requestedqty` integer DEFAULT 0,
  `receptquantity` integer DEFAULT 0,
  `receiveddate` varchar(50) DEFAULT '',
  `linestatus` integer default 1,

  CONSTRAINT pk_podid_pid PRIMARY KEY (`pid`,`podid`),
  CONSTRAINT fk_pid FOREIGN KEY (pid)
  REFERENCES purchaseorder(pid)
);

--
-- Dumping data for table `purchaseorderetails`
--

INSERT INTO `purchaseorderetails` (`podid`, `pid`, `partnumber`, `location`, `quantity`, `cost`, `duedate`, `linestatus`) VALUES
(0, 1, '4', '', '100', '4500', '2017-07-05',1),
(1, 1, '5', '', '25', '1125', '2017-07-05',1),
(0, 2, '3', '', '25', '2125', '2017-07-05',1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(11) UNSIGNED NOT NULL PRIMARY KEY,
  `part_number` varchar(50) DEFAULT NULL,
  `warehouse_code` varchar(50) DEFAULT NULL,
  `location_code` varchar(50) DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `cost` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `ref_number` int(11) DEFAULT NULL,
  `line_number` int(11) DEFAULT NULL,
  `careted_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `vendermaster`
--

CREATE TABLE `vendermaster` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
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
);

--
-- Dumping data for table `vendermaster`
--

INSERT INTO `vendermaster` (`id`, `vname`, `description`, `address1`, `address2`, `suburb`, `state`, `postcode`, `country`, `termscode`, `extrafield1`, `extrafield2`, `extrafield3`, `createdate`, `updateddate`) VALUES
(20, 'HOME TIMBER & HARDWARE', 'HOME TIMBER & HARDWARE', '298', 'Coventry St', 'South Melbourne', 'VIC', '3205', 'Australia', 'code1', 'Home Timber & Hardware is the home of quality products and expert advice. We are committed to delive', 'Home Timber & Hardware is the home of quality products and expert advice. We are committed to delive', 'Home Timber & Hardware is the home of quality products and expert advice. We are committed to delive', '2017-07-05 14:04:38', '2017-07-05 14:04:38'),
(21, 'Bunnings Warehouse', 'Bunnings Group, trading as Bunnings Warehouse, is Australias largest household hardware chain. The chain has been owned by Wesfarmers since 1994, and has stores in Australia, New Zealand, and the United Kingdom', '230', 'Burwood Road', 'BOXHILL', 'VIC', '3128', 'Australia', 'code1', 'Bring the kids into the Box Hill store today to attend our Balloon Twisting workshop for some School', 'Bring the kids into the Box Hill store today to attend our Balloon Twisting workshop for some School', 'Bring the kids into the Box Hill store today to attend our Balloon Twisting workshop for some School', '2017-07-05 14:09:10', '2017-07-05 14:09:10'),
(22, 'MITRE10', 'Mitre 10, formed in 1959, is a large player in the Australian home improvement and hardware industry. The Mitre 10 group comprises.', '12', 'Dansu Court', 'Hallam', 'VIC', '3845', 'Australia', 'code1', 'Australias largest independent home improvement and hardware wholesaler to the industry.\r\n', 'Australias largest independent home improvement and hardware wholesaler to the industry.\r\nAn iconic ', 'Australias largest independent home improvement and hardware wholesaler to the industry.\r\nAn iconic ', '2017-07-05 14:14:36', '2017-07-05 14:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `ID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `Whse` varchar(10) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Alloc_Flag` char(1) NOT NULL,
  `Extrafld` varchar(200) NOT NULL
);
