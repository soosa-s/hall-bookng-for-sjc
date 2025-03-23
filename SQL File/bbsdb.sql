-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 20, 2025 at 07:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(11) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `AdminuserName` varchar(20) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp(),
  `UserType` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `AdminuserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`, `UserType`) VALUES
(1, 'Admin', 'admin', 9345680254, 'admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2025-02-16 05:34:57', 1),
(2, 'soosa', 'soosa', 9655298502, 'soosa12@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2025-02-16 09:12:46', 0);

-- --------------------------------------------------------
CREATE TABLE `principal` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UserType` int(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `principal` (`UserName`, `Password`, `UserType`) VALUES
('father', MD5('1234'), NULL),('father', MD5('12345'), NULL);



-- --------------------------------------------------------
--
-- Table structure for table `tblbookings`
--

CREATE TABLE `tblbookings` (
  `ID` int(5) NOT NULL,
  `HallID` int(10) NOT NULL,
  `BookingNumber` bigint(12) DEFAULT NULL,
  `FullName` varchar(250) DEFAULT NULL,
  `EmailId` varchar(250) DEFAULT NULL,
  `PhoneNumber` bigint(12) DEFAULT NULL,
  `BookingDateFrom` date DEFAULT NULL,
  `BookingTime` varchar(100) DEFAULT NULL,
  `EndingTime` varchar(100) DEFAULT NULL,
  `dept` varchar(100) DEFAULT NULL,
  `purpose` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` varchar(250) DEFAULT NULL,
  `BookingStatus` varchar(250) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbookings`
--

INSERT INTO `tblbookings` (`ID`, `HallID`, `BookingNumber`, `FullName`, `EmailId`, `PhoneNumber`, `BookingDateFrom`, `BookingTime`, `EndingTime`, `dept`, `purpose`, `postingDate`, `AdminRemark`, `BookingStatus`, `UpdationDate`) VALUES
(25, 4, 6480119835, 'tamil', 'tamilselvan8775@gmail.com', 9345680254, '2025-03-10', '13:03', '18:28', 'msc', 'placement', '2025-03-10 07:34:01', 'ok\r\n', 'Accepted', '2025-03-10 07:34:41'),
(26, 2, 4482411655, 'kavi', 'tamilselvan8775@gmail.com', 9876543210, '2025-03-22', '08:30', '14:00', 'msc', 'ok', '2025-03-20 04:20:46', 'no', 'Rejected', '2025-03-20 04:23:19'),
(27, 3, 8874734523, 'kavi', 'tamilselvan8775@gmail.com', 9876543210, '2025-03-22', '08:30', '16:00', 'msc', 'seminar', '2025-03-20 04:21:23', 'ok', 'Accepted', '2025-03-20 05:01:09'),
(28, 4, 7471411232, 'kavi', 'tamilselvan8775@gmail.com', 9876543210, '2025-03-29', '08:30', '11:30', 'msc', 'ae', '2025-03-20 05:02:46', 'ok', 'Accepted', '2025-03-20 05:05:55'),
(29, 7, 9215305659, 'kavi', 'tamilselvan8775@gmail.com', 9876543210, '2025-03-29', '08:30', '14:00', 'msc', 'ae', '2025-03-20 05:21:20', NULL, NULL, '2025-03-20 05:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `tblhall`
--

CREATE TABLE `tblhall` (
  `ID` int(5) NOT NULL,
  `HallName` varchar(250) DEFAULT NULL,
  `Image` varchar(250) DEFAULT NULL,
  `Size` varchar(100) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `AddedBy` int(5) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblhall`
--

INSERT INTO `tblhall` (`ID`, `HallName`, `Image`, `Size`, `Description`, `AddedBy`, `CreationDate`) VALUES
(2, 'lawley hall', '4b796e7efe0d75c007f0db60e5da96861739696871jpeg', 'Medium', 'big hall', 1, '2025-02-16 05:36:39'),
(3, 'kp joshep hall', 'd41d8cd98f00b204e9800998ecf8427e1739777707', 'Medium', 'its conducting seminar,exams,placement class etc', 1, '2025-02-17 07:35:07'),
(4, 'Toulouse Arena', 'd41d8cd98f00b204e9800998ecf8427e1741587954', 'Large', 'this is very big hall contain every program and function', 1, '2025-03-10 06:25:54'),
(5, 'jubilee hall', 'd41d8cd98f00b204e9800998ecf8427e1741588299', 'Medium', 'its jubliee hall contain any program and function,placement etc', 1, '2025-03-10 06:31:39'),
(6, 'marian hall', 'd41d8cd98f00b204e9800998ecf8427e1741589292', 'Medium', 'this is marian hall contain exams,seminar,function,placement,etc', 1, '2025-03-10 06:48:12'),
(7, 'Sail Hall', 'd41d8cd98f00b204e9800998ecf8427e1741589935', 'Medium', 'this is Sail hall contain program and functions', 1, '2025-03-10 06:58:55'),
(8, 'Sequira Hall', 'd41d8cd98f00b204e9800998ecf8427e1741746462', 'Small', 'This is Sequira hall it contains program,functions etc.', 1, '2025-03-12 02:27:42'),
(9, 'MCA Seminar hall', 'd41d8cd98f00b204e9800998ecf8427e1741746542', 'Medium', 'This is MCA Seminar hall it contains program,functions,placement training etc.', 1, '2025-03-12 02:29:02'),
(10, 'Commerce AV Hall', 'd41d8cd98f00b204e9800998ecf8427e1741746656', 'Medium', 'This is Commerce AV hall contain program,exams,functions etc', 1, '2025-03-12 02:30:56'),
(11, 'Balam Hall', 'd41d8cd98f00b204e9800998ecf8427e1741746772', 'Medium', 'This is Balam Hall contain program,function etc', 1, '2025-03-12 02:32:52'),
(12, 'TV AV Hall', 'd41d8cd98f00b204e9800998ecf8427e1741746897', 'Medium', 'This is TV AV HAll it contain program functions etc', 1, '2025-03-12 02:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UserType` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`ID`, `UserName`, `Email`, `Password`, `RegDate`, `UserType`) VALUES
(1, 'john_doe', 'john.doe@example.com', '81dc9bdb52d04dc20036dbd8313ed055', '2025-02-16 05:34:57', NULL),
(2, 'tamil', 'tamilselvan8775@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2025-02-16 05:44:47', 0),
(3, 'soosa', 'soosa12@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2025-02-16 09:11:58', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--

--
ALTER TABLE `tblbookings`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `HallID` (`HallID`);

--
-- Indexes for table `tblhall`
--
ALTER TABLE `tblhall`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--

--
ALTER TABLE `tblbookings`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tblhall`
--
ALTER TABLE `tblhall`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbookings`
--
ALTER TABLE `tblbookings`
  ADD CONSTRAINT `tblbookings_ibfk_1` FOREIGN KEY (`HallID`) REFERENCES `tblhall` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
