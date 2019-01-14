-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2019 at 06:43 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sports_warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `SNO` int(11) NOT NULL,
  `FIRSTNAME` varchar(60) NOT NULL,
  `LASTNAME` varchar(60) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `SUBJECT` varchar(100) NOT NULL,
  `MESSAGE` varchar(255) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `STATUS` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `CATID` int(11) NOT NULL,
  `CAT_NAME` varchar(100) NOT NULL,
  `CAT_DESC` varchar(100) NOT NULL,
  `STATUS` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`CATID`, `CAT_NAME`, `CAT_DESC`, `STATUS`) VALUES
(1, 'Cricket', '', 'A'),
(2, 'Badmentain', 'Badmentain', 'A'),
(3, 'Football', 'Football', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `item_group`
--

CREATE TABLE `item_group` (
  `GID` int(11) NOT NULL,
  `CATID` char(5) NOT NULL,
  `GROUP_DESC` varchar(60) NOT NULL,
  `STATUS` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_group`
--

INSERT INTO `item_group` (`GID`, `CATID`, `GROUP_DESC`, `STATUS`) VALUES
(1, '1', 'Male', 'A'),
(2, '1', 'Female', 'A'),
(3, '1', 'Adults', 'A'),
(4, '1', 'Childern', 'A'),
(5, '1', 'ALL', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `item_master`
--

CREATE TABLE `item_master` (
  `SNO` int(11) NOT NULL,
  `ITEM_NAME` varchar(100) NOT NULL,
  `ITEM_DESC` varchar(255) NOT NULL,
  `ITEM_CATEGORY` char(3) NOT NULL,
  `ITEM_PRICE` char(10) NOT NULL,
  `ITEM_IMAGE` varchar(50) NOT NULL,
  `ITEM_GROUP` char(3) NOT NULL,
  `QUANTITY` char(4) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `CREATED_BY` varchar(30) NOT NULL,
  `EDITED_ON` datetime NOT NULL,
  `EDITED_BY` varchar(30) NOT NULL,
  `STATUS` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_master`
--

INSERT INTO `item_master` (`SNO`, `ITEM_NAME`, `ITEM_DESC`, `ITEM_CATEGORY`, `ITEM_PRICE`, `ITEM_IMAGE`, `ITEM_GROUP`, `QUANTITY`, `CREATED_ON`, `CREATED_BY`, `EDITED_ON`, `EDITED_BY`, `STATUS`) VALUES
(1, 'Bats(2) and Balls(2)', 'Combo Offer', '1', '1000', 'product7.jpg||product8.jpg||product9.jpg', '1', '2', '2019-01-10 15:27:59', 'uday', '0000-00-00 00:00:00', '', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `item_trans_hd`
--

CREATE TABLE `item_trans_hd` (
  `SNO` int(11) NOT NULL,
  `ITEMID` int(4) NOT NULL,
  `COST` int(11) NOT NULL,
  `QUANTITY` int(3) NOT NULL,
  `DADDRESS` varchar(255) NOT NULL,
  `CREATED_BY` varchar(30) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `STATUS` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_trans_hd`
--

INSERT INTO `item_trans_hd` (`SNO`, `ITEMID`, `COST`, `QUANTITY`, `DADDRESS`, `CREATED_BY`, `CREATED_ON`, `STATUS`) VALUES
(1, 1, 1000, 1, 'sdds', '5', '2019-01-14 06:14:53', 'A'),
(2, 1, 1000, 1, 'dsdf', '5', '2019-01-14 06:22:01', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `SNO` int(11) NOT NULL,
  `USER_ID` varchar(60) NOT NULL,
  `FIRST_NAME` varchar(30) NOT NULL,
  `LAST_NAME` varchar(30) NOT NULL,
  `MAILID` varchar(60) NOT NULL,
  `CONTACT_NO` varchar(20) NOT NULL,
  `PASSWORD` varchar(60) NOT NULL,
  `ISADMIN` char(1) NOT NULL DEFAULT 'N',
  `CREATED_ON` datetime NOT NULL,
  `STATUS` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`SNO`, `USER_ID`, `FIRST_NAME`, `LAST_NAME`, `MAILID`, `CONTACT_NO`, `PASSWORD`, `ISADMIN`, `CREATED_ON`, `STATUS`) VALUES
(1, 'udayvilas@gmail.com', 'Uday', 'Kumar', 'udayvilas@gmail.com', '9494976883', 'uday@123', 'Y', '2019-01-07 00:00:00', 'A'),
(5, 'udaykumar.borra@renownanalytics.com', 'uday', '', 'udaykumar.borra@renownanalytics.com', '9494976883', '1', 'N', '2019-01-08 02:50:44', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`SNO`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`CATID`);

--
-- Indexes for table `item_group`
--
ALTER TABLE `item_group`
  ADD PRIMARY KEY (`GID`);

--
-- Indexes for table `item_master`
--
ALTER TABLE `item_master`
  ADD PRIMARY KEY (`SNO`);

--
-- Indexes for table `item_trans_hd`
--
ALTER TABLE `item_trans_hd`
  ADD PRIMARY KEY (`SNO`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`SNO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `SNO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `CATID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item_group`
--
ALTER TABLE `item_group`
  MODIFY `GID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item_master`
--
ALTER TABLE `item_master`
  MODIFY `SNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_trans_hd`
--
ALTER TABLE `item_trans_hd`
  MODIFY `SNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `SNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
