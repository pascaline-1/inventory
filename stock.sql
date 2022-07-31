-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2022 at 05:00 AM
-- Server version: 5.7.38-cll-lve
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kigurerw_shop`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `alltransactions`
-- (See below for the actual view)
--
CREATE TABLE `alltransactions` (
`trId` varchar(20)
,`clientorsupplierId` varchar(20)
,`trProductId` varchar(20)
,`trOperation` enum('In','Out','Mixin','Mixout','Wasted')
,`trPurchasePrice` int(11)
,`trUnityPrice` int(11)
,`trQty` int(11)
,`trPayedAmount` int(11)
,`trNonPaidAmount` int(11)
,`trPaymentMethod` varchar(20)
,`trPaymentStatus` enum('Full Paid','Partial Paid','Zero Paid')
,`doneDate` varchar(20)
,`doneBy` varchar(20)
,`userId` varchar(50)
,`userNames` varchar(100)
,`userPhone` varchar(20)
,`userEmail` varchar(50)
,`userPassword` varchar(100)
,`userType` enum('Cashier','Stock','Admin')
,`confirmationCode` varchar(100)
,`remembeCode` varchar(100)
,`active` enum('No','Yes')
,`disabledTime` varchar(20)
,`productId` varchar(20)
,`productName` varchar(50)
,`productPrice` int(11)
,`productUnit` varchar(50)
,`createdBy` varchar(20)
,`createdDate` varchar(20)
,`deletedDate` varchar(20)
,`deletedBy` varchar(20)
,`supplierId` varchar(20)
,`supplierNames` varchar(50)
,`supplierPhone` varchar(20)
,`supplierEmail` varchar(20)
,`supplierDetails` varchar(50)
,`addedDate` varchar(20)
,`firstSupply` varchar(20)
,`latestSupply` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` varchar(20) NOT NULL,
  `clientNames` varchar(20) NOT NULL,
  `clientPhone` varchar(20) NOT NULL,
  `clientEmail` varchar(30) NOT NULL,
  `addedTime` varchar(20) NOT NULL,
  `firstBuy` varchar(20) DEFAULT NULL,
  `latestBuy` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientNames`, `clientPhone`, `clientEmail`, `addedTime`, `firstBuy`, `latestBuy`) VALUES
('1622431092', 'Azabe Justinaz', '250789734344', 'justinazabe@gmail.com', '1622431092', NULL, NULL),
('1622432887', 'Eric Ricky', '250782364555', 'blessederic00@gmail.com', '1622432887', NULL, NULL),
('1622506130', 'Deblack Bush', '250789734322', 'blcdsx@gmail.com', '1622506130', NULL, NULL),
('1622506166', 'Danylo Dany', '250782364325', 'danylo@gmail.com', '1622506166', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE `credits` (
  `creditId` varchar(25) NOT NULL,
  `creditorName` varchar(50) NOT NULL,
  `creditAmount` int(11) NOT NULL,
  `crPaidAmount` int(11) NOT NULL,
  `crNonPaidAmount` int(11) NOT NULL,
  `crPaymentMethod` varchar(20) NOT NULL,
  `givenBy` varchar(25) NOT NULL,
  `creditDate` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`creditId`, `creditorName`, `creditAmount`, `crPaidAmount`, `crNonPaidAmount`, `crPaymentMethod`, `givenBy`, `creditDate`) VALUES
('1624902546', 'Justin Azabe', 10000, 2000, 8000, 'Mobile', '1616351818', '1624902546'),
('1624903515', 'Aizo Kini', 20000, 20000, 0, 'Cash', '1616351818', '1624903515');

-- --------------------------------------------------------

--
-- Table structure for table `intransactions`
--

CREATE TABLE `intransactions` (
  `inTrId` varchar(20) NOT NULL,
  `InTrUnityprice` int(11) NOT NULL,
  `inTrQty` int(11) NOT NULL,
  `inPurchasedQty` int(11) NOT NULL,
  `inTrProductId` varchar(20) NOT NULL,
  `inTrDoneOn` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intransactions`
--

INSERT INTO `intransactions` (`inTrId`, `InTrUnityprice`, `inTrQty`, `inPurchasedQty`, `inTrProductId`, `inTrDoneOn`) VALUES
('1624363854', 200, 27, 120, '1622394347', '1624363854'),
('1624363882', 300, 5, 150, '1622687228', '1624363882'),
('1624748746', 0, 20, 70, '1623473857', '1624748746'),
('1650197063', 450, 10, 10, '1622394347', '1650197063'),
('1650197915', 0, 70, 70, '1650197913', '1650197915');

-- --------------------------------------------------------

--
-- Stand-in structure for view `intransactionsview`
-- (See below for the actual view)
--
CREATE TABLE `intransactionsview` (
`trId` varchar(20)
,`clientorsupplierId` varchar(20)
,`trProductId` varchar(20)
,`trOperation` enum('In','Out','Mixin','Mixout','Wasted')
,`trPurchasePrice` int(11)
,`trUnityPrice` int(11)
,`trQty` int(11)
,`trPayedAmount` int(11)
,`trNonPaidAmount` int(11)
,`trPaymentMethod` varchar(20)
,`trPaymentStatus` enum('Full Paid','Partial Paid','Zero Paid')
,`doneDate` varchar(20)
,`doneBy` varchar(20)
,`userId` varchar(50)
,`userNames` varchar(100)
,`userPhone` varchar(20)
,`userEmail` varchar(50)
,`userPassword` varchar(100)
,`userType` enum('Cashier','Stock','Admin')
,`confirmationCode` varchar(100)
,`remembeCode` varchar(100)
,`active` enum('No','Yes')
,`disabledTime` varchar(20)
,`productId` varchar(20)
,`productName` varchar(50)
,`productPrice` int(11)
,`productUnit` varchar(50)
,`createdBy` varchar(20)
,`createdDate` varchar(20)
,`deletedDate` varchar(20)
,`deletedBy` varchar(20)
,`supplierId` varchar(20)
,`supplierNames` varchar(50)
,`supplierPhone` varchar(20)
,`supplierEmail` varchar(20)
,`supplierDetails` varchar(50)
,`addedDate` varchar(20)
,`firstSupply` varchar(20)
,`latestSupply` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `outtransactions`
-- (See below for the actual view)
--
CREATE TABLE `outtransactions` (
`trId` varchar(20)
,`clientorsupplierId` varchar(20)
,`trProductId` varchar(20)
,`trOperation` enum('In','Out','Mixin','Mixout','Wasted')
,`trPurchasePrice` int(11)
,`trUnityPrice` int(11)
,`trQty` int(11)
,`trPayedAmount` int(11)
,`trNonPaidAmount` int(11)
,`trPaymentMethod` varchar(20)
,`trPaymentStatus` enum('Full Paid','Partial Paid','Zero Paid')
,`doneDate` varchar(20)
,`doneBy` varchar(20)
,`userId` varchar(50)
,`userNames` varchar(100)
,`userPhone` varchar(20)
,`userEmail` varchar(50)
,`userPassword` varchar(100)
,`userType` enum('Cashier','Stock','Admin')
,`confirmationCode` varchar(100)
,`remembeCode` varchar(100)
,`active` enum('No','Yes')
,`disabledTime` varchar(20)
,`productId` varchar(20)
,`productName` varchar(50)
,`productPrice` int(11)
,`productUnit` varchar(50)
,`createdBy` varchar(20)
,`createdDate` varchar(20)
,`deletedDate` varchar(20)
,`deletedBy` varchar(20)
,`clientId` varchar(20)
,`clientNames` varchar(20)
,`clientPhone` varchar(20)
,`clientEmail` varchar(30)
,`addedTime` varchar(20)
,`firstBuy` varchar(20)
,`latestBuy` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` varchar(20) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productUnit` varchar(50) NOT NULL,
  `productType` enum('Single','Mixture') NOT NULL,
  `productMixed` varchar(225) DEFAULT NULL,
  `createdBy` varchar(20) NOT NULL,
  `createdDate` varchar(20) NOT NULL,
  `deletedDate` varchar(20) DEFAULT NULL,
  `deletedBy` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productName`, `productPrice`, `productUnit`, `productType`, `productMixed`, `createdBy`, `createdDate`, `deletedDate`, `deletedBy`) VALUES
('1622394347', 'Amasaka', 500, 'Ibiro', 'Single', NULL, '1616351818', '1622394347', NULL, NULL),
('1622394695', 'Ubunyobwa Buseye', 1000, 'Ibiro', 'Single', NULL, '1616351818', '1622394695', NULL, NULL),
('1622395136', 'Ubunyobwa Budaseye', 800, 'Ibiro', 'Single', NULL, '1616351818', '1622395136', NULL, NULL),
('1622687228', 'Ifu y\'ibigori', 450, 'Ibiro', 'Single', NULL, '1616351818', '1622687228', NULL, NULL),
('1623473857', 'Imvange (Amasaka, Ifu y\'ibigori)', 700, 'Ibiro', 'Mixture', 'a:2:{i:0;s:10:\"1622394347\";i:1;s:10:\"1622687228\";}', '1616351818', '1623473857', NULL, NULL),
('1650197913', 'Imvange (Amasaka, Imvange (Amasaka, Ifu y\'ibigori)', 1000, 'Ibiro', 'Mixture', 'a:2:{i:0;s:10:\"1622394347\";i:1;s:10:\"1623473857\";}', '1622410222', '1650197913', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierId` varchar(20) NOT NULL,
  `supplierNames` varchar(50) NOT NULL,
  `supplierPhone` varchar(20) NOT NULL,
  `supplierEmail` varchar(20) NOT NULL,
  `supplierDetails` varchar(50) NOT NULL,
  `addedDate` varchar(20) NOT NULL,
  `firstSupply` varchar(20) DEFAULT NULL,
  `latestSupply` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplierId`, `supplierNames`, `supplierPhone`, `supplierEmail`, `supplierDetails`, `addedDate`, `firstSupply`, `latestSupply`) VALUES
('1622606803', 'Kaleb Jules', '250787789832', 'kalebjules@gmail.com', 'Amasaka, ibigori,...', '1622606803', NULL, NULL),
('1622760412', 'Manzi Thierry', '250787789822', 'manzithierry@gmail.c', 'Isukari, umunyu, amasaka,...', '1622760412', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_users`
--

CREATE TABLE `system_users` (
  `userId` varchar(50) NOT NULL,
  `userNames` varchar(100) NOT NULL,
  `userPhone` varchar(20) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPassword` varchar(100) NOT NULL,
  `userType` enum('Cashier','Stock','Admin') NOT NULL,
  `confirmationCode` varchar(100) DEFAULT NULL,
  `remembeCode` varchar(100) DEFAULT NULL,
  `active` enum('No','Yes') NOT NULL,
  `disabledTime` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_users`
--

INSERT INTO `system_users` (`userId`, `userNames`, `userPhone`, `userEmail`, `userPassword`, `userType`, `confirmationCode`, `remembeCode`, `active`, `disabledTime`) VALUES
('1', 'mugisha', '250782643555', 'ericblessed88@gmail.com', '123456', 'Cashier', NULL, NULL, 'Yes', ''),
('1616351818', 'CMuhirwa', '250784848236', 'muhirwaclement@gmail.com', '123456', 'Admin', NULL, NULL, 'Yes', ''),
('1622410222', 'Aizo Keen', '250789754425', 'aizokini@gmail.com', '123456', 'Admin', NULL, NULL, 'Yes', ''),
('1622410309', 'Feza Keen', '250780223382', 'fezakeen@gmail.com', '123456', 'Cashier', NULL, NULL, 'Yes', ''),
('1622506323', 'Tiger Keen', '250789754423', 'tigerkeen@gmail.com', '123456', 'Stock', NULL, NULL, 'Yes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trId` varchar(20) NOT NULL,
  `clientorsupplierId` varchar(20) DEFAULT NULL,
  `trProductId` varchar(20) NOT NULL,
  `trOperation` enum('In','Out','Mixin','Mixout','Wasted') NOT NULL,
  `trPurchasePrice` int(11) NOT NULL,
  `trUnityPrice` int(11) NOT NULL,
  `trQty` int(11) NOT NULL,
  `trPayedAmount` int(11) NOT NULL,
  `trNonPaidAmount` int(11) NOT NULL,
  `trPaymentMethod` varchar(20) NOT NULL,
  `trPaymentStatus` enum('Full Paid','Partial Paid','Zero Paid') NOT NULL,
  `trComment` varchar(225) NOT NULL,
  `doneDate` varchar(20) NOT NULL,
  `doneBy` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `trComment`, `doneDate`, `doneBy`) VALUES
('1624363854', '1622606803', '1622394347', 'In', 200, 200, 120, 24000, 0, 'Mobile', 'Full Paid', '', '1624363854', '1616351818'),
('1624363882', '1622760412', '1622687228', 'In', 300, 300, 150, 45000, 0, 'Cash', 'Full Paid', '', '1624363882', '1616351818'),
('1624748745', NULL, '1622394347', 'Mixout', 200, 0, 20, 0, 0, 'Imvange', 'Full Paid', '', '1624748745', '1616351818'),
('1624748746', NULL, '1622687228', 'Mixout', 300, 0, 50, 0, 0, 'Imvange', 'Full Paid', '', '1624748746', '1616351818'),
('1624748748', NULL, '1623473857', 'Mixin', 0, 0, 70, 0, 0, 'Imvange', 'Full Paid', '', '1624748746', '1616351818'),
('1625759578', '1622431092', '1622394347', 'Out', 200, 500, 40, 20000, 0, 'Bank', 'Full Paid', '', '1625759578', '1616351818'),
('1624896906', '1622431092', '1622687228', 'Out', 300, 450, 20, 2000, 7000, 'Mobile', 'Partial Paid', '', '1624896906', '1616351818'),
('1624872929', NULL, '1622687228', 'Wasted', 300, 0, 10, 0, 0, 'Impfabusa', 'Full Paid', 'Mugukora imvange', '1624872929', '1616351818'),
('1626390279', '1622431092', '1622394347', 'Out', 200, 600, 13, 7800, 0, 'Mobile', 'Full Paid', '', '1626390279', '1616351818'),
('1650196360', NULL, '1622687228', 'Wasted', 300, 0, 30, 0, 0, 'Impfabusa', 'Full Paid', 'Byamenetse', '1650196360', '1622410222'),
('1650196361', NULL, '1622687228', 'Wasted', 300, 0, 30, 0, 0, 'Impfabusa', 'Full Paid', 'Byamenetse', '1650196361', '1622410222'),
('1650197063', '1622606803', '1622394347', 'In', 450, 450, 10, 4500, 0, 'Cash', 'Full Paid', '', '1650197063', '1622410222'),
('1650197577', NULL, '1622687228', 'Wasted', 300, 0, 5, 0, 0, 'Impfabusa', 'Full Paid', 'Byamenetse', '1650197577', '1622410222'),
('1650197914', NULL, '1622394347', 'Mixout', 200, 0, 20, 0, 0, 'Imvange', 'Full Paid', '', '1650197914', '1622410222'),
('1650197915', NULL, '1623473857', 'Mixout', 0, 0, 50, 0, 0, 'Imvange', 'Full Paid', '', '1650197915', '1622410222'),
('1650197916', NULL, '1650197913', 'Mixin', 0, 0, 70, 0, 0, 'Imvange', 'Full Paid', '', '1650197915', '1622410222');

-- --------------------------------------------------------

--
-- Stand-in structure for view `wastedtransactions`
-- (See below for the actual view)
--
CREATE TABLE `wastedtransactions` (
`trId` varchar(20)
,`clientorsupplierId` varchar(20)
,`trProductId` varchar(20)
,`trOperation` enum('In','Out','Mixin','Mixout','Wasted')
,`trPurchasePrice` int(11)
,`trUnityPrice` int(11)
,`trQty` int(11)
,`trPayedAmount` int(11)
,`trNonPaidAmount` int(11)
,`trPaymentMethod` varchar(20)
,`trPaymentStatus` enum('Full Paid','Partial Paid','Zero Paid')
,`trComment` varchar(225)
,`doneDate` varchar(20)
,`doneBy` varchar(20)
,`userId` varchar(50)
,`userNames` varchar(100)
,`userPhone` varchar(20)
,`userEmail` varchar(50)
,`userPassword` varchar(100)
,`userType` enum('Cashier','Stock','Admin')
,`confirmationCode` varchar(100)
,`remembeCode` varchar(100)
,`active` enum('No','Yes')
,`disabledTime` varchar(20)
,`productId` varchar(20)
,`productName` varchar(50)
,`productPrice` int(11)
,`productUnit` varchar(50)
,`productType` enum('Single','Mixture')
,`productMixed` varchar(225)
,`createdBy` varchar(20)
,`createdDate` varchar(20)
,`deletedDate` varchar(20)
,`deletedBy` varchar(20)
,`clientId` varchar(20)
,`clientNames` varchar(20)
,`clientPhone` varchar(20)
,`clientEmail` varchar(30)
,`addedTime` varchar(20)
,`firstBuy` varchar(20)
,`latestBuy` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `alltransactions`
--
DROP TABLE IF EXISTS `alltransactions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `alltransactions`  AS SELECT `transactions`.`trId` AS `trId`, `transactions`.`clientorsupplierId` AS `clientorsupplierId`, `transactions`.`trProductId` AS `trProductId`, `transactions`.`trOperation` AS `trOperation`, `transactions`.`trPurchasePrice` AS `trPurchasePrice`, `transactions`.`trUnityPrice` AS `trUnityPrice`, `transactions`.`trQty` AS `trQty`, `transactions`.`trPayedAmount` AS `trPayedAmount`, `transactions`.`trNonPaidAmount` AS `trNonPaidAmount`, `transactions`.`trPaymentMethod` AS `trPaymentMethod`, `transactions`.`trPaymentStatus` AS `trPaymentStatus`, `transactions`.`doneDate` AS `doneDate`, `transactions`.`doneBy` AS `doneBy`, `system_users`.`userId` AS `userId`, `system_users`.`userNames` AS `userNames`, `system_users`.`userPhone` AS `userPhone`, `system_users`.`userEmail` AS `userEmail`, `system_users`.`userPassword` AS `userPassword`, `system_users`.`userType` AS `userType`, `system_users`.`confirmationCode` AS `confirmationCode`, `system_users`.`remembeCode` AS `remembeCode`, `system_users`.`active` AS `active`, `system_users`.`disabledTime` AS `disabledTime`, `products`.`productId` AS `productId`, `products`.`productName` AS `productName`, `products`.`productPrice` AS `productPrice`, `products`.`productUnit` AS `productUnit`, `products`.`createdBy` AS `createdBy`, `products`.`createdDate` AS `createdDate`, `products`.`deletedDate` AS `deletedDate`, `products`.`deletedBy` AS `deletedBy`, `suppliers`.`supplierId` AS `supplierId`, `suppliers`.`supplierNames` AS `supplierNames`, `suppliers`.`supplierPhone` AS `supplierPhone`, `suppliers`.`supplierEmail` AS `supplierEmail`, `suppliers`.`supplierDetails` AS `supplierDetails`, `suppliers`.`addedDate` AS `addedDate`, `suppliers`.`firstSupply` AS `firstSupply`, `suppliers`.`latestSupply` AS `latestSupply` FROM (((`transactions` join `system_users` on((convert(`transactions`.`doneBy` using utf8mb4) = `system_users`.`userId`))) join `products` on((convert(`transactions`.`trProductId` using utf8mb4) = `products`.`productId`))) join `suppliers` on((convert(`transactions`.`clientorsupplierId` using utf8mb4) = `suppliers`.`supplierId`))) ;

-- --------------------------------------------------------

--
-- Structure for view `intransactionsview`
--
DROP TABLE IF EXISTS `intransactionsview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `intransactionsview`  AS SELECT `transactions`.`trId` AS `trId`, `transactions`.`clientorsupplierId` AS `clientorsupplierId`, `transactions`.`trProductId` AS `trProductId`, `transactions`.`trOperation` AS `trOperation`, `transactions`.`trPurchasePrice` AS `trPurchasePrice`, `transactions`.`trUnityPrice` AS `trUnityPrice`, `transactions`.`trQty` AS `trQty`, `transactions`.`trPayedAmount` AS `trPayedAmount`, `transactions`.`trNonPaidAmount` AS `trNonPaidAmount`, `transactions`.`trPaymentMethod` AS `trPaymentMethod`, `transactions`.`trPaymentStatus` AS `trPaymentStatus`, `transactions`.`doneDate` AS `doneDate`, `transactions`.`doneBy` AS `doneBy`, `system_users`.`userId` AS `userId`, `system_users`.`userNames` AS `userNames`, `system_users`.`userPhone` AS `userPhone`, `system_users`.`userEmail` AS `userEmail`, `system_users`.`userPassword` AS `userPassword`, `system_users`.`userType` AS `userType`, `system_users`.`confirmationCode` AS `confirmationCode`, `system_users`.`remembeCode` AS `remembeCode`, `system_users`.`active` AS `active`, `system_users`.`disabledTime` AS `disabledTime`, `products`.`productId` AS `productId`, `products`.`productName` AS `productName`, `products`.`productPrice` AS `productPrice`, `products`.`productUnit` AS `productUnit`, `products`.`createdBy` AS `createdBy`, `products`.`createdDate` AS `createdDate`, `products`.`deletedDate` AS `deletedDate`, `products`.`deletedBy` AS `deletedBy`, `suppliers`.`supplierId` AS `supplierId`, `suppliers`.`supplierNames` AS `supplierNames`, `suppliers`.`supplierPhone` AS `supplierPhone`, `suppliers`.`supplierEmail` AS `supplierEmail`, `suppliers`.`supplierDetails` AS `supplierDetails`, `suppliers`.`addedDate` AS `addedDate`, `suppliers`.`firstSupply` AS `firstSupply`, `suppliers`.`latestSupply` AS `latestSupply` FROM (((`transactions` join `system_users` on((convert(`transactions`.`doneBy` using utf8mb4) = `system_users`.`userId`))) join `products` on((convert(`transactions`.`trProductId` using utf8mb4) = `products`.`productId`))) left join `suppliers` on((convert(`transactions`.`clientorsupplierId` using utf8mb4) = `suppliers`.`supplierId`))) WHERE ((`transactions`.`trOperation` = 'In') OR (`transactions`.`trOperation` = 'Mixin')) ;

-- --------------------------------------------------------

--
-- Structure for view `outtransactions`
--
DROP TABLE IF EXISTS `outtransactions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `outtransactions`  AS SELECT `transactions`.`trId` AS `trId`, `transactions`.`clientorsupplierId` AS `clientorsupplierId`, `transactions`.`trProductId` AS `trProductId`, `transactions`.`trOperation` AS `trOperation`, `transactions`.`trPurchasePrice` AS `trPurchasePrice`, `transactions`.`trUnityPrice` AS `trUnityPrice`, `transactions`.`trQty` AS `trQty`, `transactions`.`trPayedAmount` AS `trPayedAmount`, `transactions`.`trNonPaidAmount` AS `trNonPaidAmount`, `transactions`.`trPaymentMethod` AS `trPaymentMethod`, `transactions`.`trPaymentStatus` AS `trPaymentStatus`, `transactions`.`doneDate` AS `doneDate`, `transactions`.`doneBy` AS `doneBy`, `system_users`.`userId` AS `userId`, `system_users`.`userNames` AS `userNames`, `system_users`.`userPhone` AS `userPhone`, `system_users`.`userEmail` AS `userEmail`, `system_users`.`userPassword` AS `userPassword`, `system_users`.`userType` AS `userType`, `system_users`.`confirmationCode` AS `confirmationCode`, `system_users`.`remembeCode` AS `remembeCode`, `system_users`.`active` AS `active`, `system_users`.`disabledTime` AS `disabledTime`, `products`.`productId` AS `productId`, `products`.`productName` AS `productName`, `products`.`productPrice` AS `productPrice`, `products`.`productUnit` AS `productUnit`, `products`.`createdBy` AS `createdBy`, `products`.`createdDate` AS `createdDate`, `products`.`deletedDate` AS `deletedDate`, `products`.`deletedBy` AS `deletedBy`, `clients`.`clientId` AS `clientId`, `clients`.`clientNames` AS `clientNames`, `clients`.`clientPhone` AS `clientPhone`, `clients`.`clientEmail` AS `clientEmail`, `clients`.`addedTime` AS `addedTime`, `clients`.`firstBuy` AS `firstBuy`, `clients`.`latestBuy` AS `latestBuy` FROM (((`transactions` join `system_users` on((convert(`transactions`.`doneBy` using utf8mb4) = `system_users`.`userId`))) join `products` on((convert(`transactions`.`trProductId` using utf8mb4) = `products`.`productId`))) left join `clients` on((convert(`transactions`.`clientorsupplierId` using utf8mb4) = `clients`.`clientId`))) WHERE ((`transactions`.`trOperation` = 'Out') OR (`transactions`.`trOperation` = 'Mixout')) ;

-- --------------------------------------------------------

--
-- Structure for view `wastedtransactions`
--
DROP TABLE IF EXISTS `wastedtransactions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `wastedtransactions`  AS SELECT `transactions`.`trId` AS `trId`, `transactions`.`clientorsupplierId` AS `clientorsupplierId`, `transactions`.`trProductId` AS `trProductId`, `transactions`.`trOperation` AS `trOperation`, `transactions`.`trPurchasePrice` AS `trPurchasePrice`, `transactions`.`trUnityPrice` AS `trUnityPrice`, `transactions`.`trQty` AS `trQty`, `transactions`.`trPayedAmount` AS `trPayedAmount`, `transactions`.`trNonPaidAmount` AS `trNonPaidAmount`, `transactions`.`trPaymentMethod` AS `trPaymentMethod`, `transactions`.`trPaymentStatus` AS `trPaymentStatus`, `transactions`.`trComment` AS `trComment`, `transactions`.`doneDate` AS `doneDate`, `transactions`.`doneBy` AS `doneBy`, `system_users`.`userId` AS `userId`, `system_users`.`userNames` AS `userNames`, `system_users`.`userPhone` AS `userPhone`, `system_users`.`userEmail` AS `userEmail`, `system_users`.`userPassword` AS `userPassword`, `system_users`.`userType` AS `userType`, `system_users`.`confirmationCode` AS `confirmationCode`, `system_users`.`remembeCode` AS `remembeCode`, `system_users`.`active` AS `active`, `system_users`.`disabledTime` AS `disabledTime`, `products`.`productId` AS `productId`, `products`.`productName` AS `productName`, `products`.`productPrice` AS `productPrice`, `products`.`productUnit` AS `productUnit`, `products`.`productType` AS `productType`, `products`.`productMixed` AS `productMixed`, `products`.`createdBy` AS `createdBy`, `products`.`createdDate` AS `createdDate`, `products`.`deletedDate` AS `deletedDate`, `products`.`deletedBy` AS `deletedBy`, `clients`.`clientId` AS `clientId`, `clients`.`clientNames` AS `clientNames`, `clients`.`clientPhone` AS `clientPhone`, `clients`.`clientEmail` AS `clientEmail`, `clients`.`addedTime` AS `addedTime`, `clients`.`firstBuy` AS `firstBuy`, `clients`.`latestBuy` AS `latestBuy` FROM (((`transactions` join `system_users` on((convert(`transactions`.`doneBy` using utf8mb4) = `system_users`.`userId`))) join `products` on((convert(`transactions`.`trProductId` using utf8mb4) = `products`.`productId`))) left join `clients` on((convert(`transactions`.`clientorsupplierId` using utf8mb4) = `clients`.`clientId`))) WHERE (`transactions`.`trOperation` = 'Wasted') ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`creditId`);

--
-- Indexes for table `intransactions`
--
ALTER TABLE `intransactions`
  ADD PRIMARY KEY (`inTrId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierId`);

--
-- Indexes for table `system_users`
--
ALTER TABLE `system_users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
