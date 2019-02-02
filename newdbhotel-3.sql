-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2018 at 04:43 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newdbhotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bridge`
--

CREATE TABLE `bridge` (
  `bridgeid` int(11) NOT NULL,
  `reserveid` int(11) NOT NULL,
  `did` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bridge`
--

INSERT INTO `bridge` (`bridgeid`, `reserveid`, `did`) VALUES
(2, 9, 1),
(3, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `did` int(11) NOT NULL,
  `discounttype` varchar(50) NOT NULL,
  `discountpercent` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`did`, `discounttype`, `discountpercent`) VALUES
(1, 'Senior', '0.20');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(10) UNSIGNED NOT NULL,
  `usname` varchar(30) DEFAULT NULL,
  `pass` varchar(30) DEFAULT NULL,
  `usertype` int(11) NOT NULL,
  `FName` varchar(225) NOT NULL,
  `LName` varchar(225) NOT NULL,
  `archive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `usname`, `pass`, `usertype`, `FName`, `LName`, `archive`) VALUES
(1, 'admin', '1234', 1, 'admin', 'istrator', 0),
(2, 'test', '1234', 2, 'test', 'ing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentid` int(11) NOT NULL,
  `reserveid` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentid`, `reserveid`, `amount`, `datetime`) VALUES
(1, 9, '7616.00', '2018-09-06 15:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomid` int(11) NOT NULL,
  `roomtype` varchar(225) NOT NULL,
  `roomprice` int(11) NOT NULL,
  `roomcapacity` int(11) NOT NULL,
  `roomavailable` int(11) NOT NULL,
  `additional` int(11) NOT NULL,
  `description` varchar(225) NOT NULL,
  `roomimg` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomid`, `roomtype`, `roomprice`, `roomcapacity`, `roomavailable`, `additional`, `description`, `roomimg`) VALUES
(1, 'Standard', 1700, 2, 10, 3, '(Wifi)<br />\n(Bathroom)<br />\n(TV)<br />', './images/standard.JPG'),
(2, 'Deluxe', 2800, 4, 10, 5, '(Wifi)<br /> (Bathroom)<br /> (TV)<br />', './images/deluxe.JPG'),
(3, 'Family', 3500, 6, 10, 6, '(Wifi)<br /> (Bathroom)<br /> (TV)<br />', './images/family.JPG'),
(4, 'Senior', 3500, 5, 10, 5, '(Wifi)<br /> (Bathroom)<br /> (TV)<br />', './images/senior.JPG'),
(5, 'test room', 1, 1, 1, 1, 'Bawal Maingay', './images/senior.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `roomreserve`
--

CREATE TABLE `roomreserve` (
  `ID` int(10) UNSIGNED NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `PhoneNumber` bigint(13) NOT NULL,
  `roomid` int(11) NOT NULL,
  `NRoom` varchar(30) NOT NULL,
  `NGuest` varchar(30) NOT NULL,
  `AGuest` int(11) NOT NULL,
  `Cin` date NOT NULL,
  `Cout` date NOT NULL,
  `paymenttype` varchar(225) NOT NULL,
  `Stat` int(11) NOT NULL,
  `NoOfDays` int(20) NOT NULL,
  `datestamp` date NOT NULL,
  `payment` varchar(225) NOT NULL,
  `did` int(11) NOT NULL,
  `depositimg` varchar(225) NOT NULL,
  `dpayment` decimal(11,2) NOT NULL,
  `fpayment` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomreserve`
--

INSERT INTO `roomreserve` (`ID`, `FName`, `LName`, `Email`, `Address`, `PhoneNumber`, `roomid`, `NRoom`, `NGuest`, `AGuest`, `Cin`, `Cout`, `paymenttype`, `Stat`, `NoOfDays`, `datestamp`, `payment`, `did`, `depositimg`, `dpayment`, `fpayment`) VALUES
(9, 'Dddasd', 'Ddd', 'jarwingines@gmail.com', 'asdasd', 123, 1, '1', '1', 0, '2018-09-10', '2018-09-14', 'full', 2, 4, '2018-09-06', 'bankdep', 0, 'large.png', '0.00', '0.00'),
(10, 'asdasdasd', 'asdasdasd', 'asdasdasda', 'asdasd', 1234, 1, '1', '1', 0, '2018-09-10', '2018-09-14', 'full', 1, 4, '2018-09-06', 'bankdep', 0, 'large.png', '0.00', '0.00'),
(11, 'dasdasd', 'asdasd', 'asdasd', 'asdasd', 1231, 1, '1', '1', 0, '2018-09-10', '2018-09-14', 'full', 1, 4, '2018-09-06', 'cash', 0, '', '0.00', '0.00'),
(12, 'dasdasd', 'asdasd', 'asdasd', 'asdasd', 1231, 1, '1', '1', 0, '2018-09-10', '2018-09-14', 'full', 1, 4, '2018-09-06', 'cash', 0, '', '0.00', '0.00'),
(13, 'dasdasd', 'asdasd', 'asdasd', 'asdasd', 1231, 1, '1', '1', 0, '2018-09-10', '2018-09-14', 'full', 1, 4, '2018-09-06', 'cash', 0, '', '0.00', '0.00'),
(14, 'dasdasd', 'asdasd', 'asdasd', 'asdasd', 1231, 1, '1', '1', 0, '2018-09-10', '2018-09-14', 'full', 1, 4, '2018-09-06', 'cash', 0, '', '0.00', '0.00'),
(15, 'dasdasd', 'asdasd', 'asdasd', 'asdasd', 1231, 1, '1', '1', 0, '2018-09-10', '2018-09-14', 'full', 1, 4, '2018-09-06', 'cash', 0, '', '0.00', '0.00'),
(16, 'dasdasd', 'asdasd', 'asdasd', 'asdasd', 1231, 1, '1', '1', 0, '2018-09-10', '2018-09-14', 'full', 1, 4, '2018-09-06', 'cash', 0, '', '0.00', '0.00'),
(17, 'dasdasd', 'asdasd', 'asdasd', 'asdasd', 1231, 1, '1', '1', 0, '2018-09-10', '2018-09-14', 'full', 1, 4, '2018-09-06', 'cash', 0, '', '0.00', '0.00'),
(18, 'dasdasd', 'asdasd', 'asdasd', 'asdasd', 1231, 1, '1', '1', 0, '2018-09-10', '2018-09-14', 'full', 1, 4, '2018-09-06', 'cash', 0, '', '0.00', '0.00'),
(19, 'Jarwin', 'Gines', 'jarwingines@gmail.com', '39 BMA Ave Brgy Tatalon', 639, 2, '1', '1', 0, '2018-09-10', '2018-09-14', 'full', 0, 4, '2018-09-07', 'bankdep', 0, '', '0.00', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bridge`
--
ALTER TABLE `bridge`
  ADD PRIMARY KEY (`bridgeid`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomid`);

--
-- Indexes for table `roomreserve`
--
ALTER TABLE `roomreserve`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bridge`
--
ALTER TABLE `bridge`
  MODIFY `bridgeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roomreserve`
--
ALTER TABLE `roomreserve`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
