-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2023 at 09:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stresult`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses`
--

CREATE TABLE `tblclasses` (
  `Id` int(11) NOT NULL,
  `ClassName` varchar(25) DEFAULT NULL,
  `Level` int(11) DEFAULT NULL,
  `Section` varchar(25) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblclasses`
--

INSERT INTO `tblclasses` (`Id`, `ClassName`, `Level`, `Section`, `CreationDate`, `UpdationDate`) VALUES
(1, 'FIRST YEAR', 1, 'A', '2023-09-04 13:05:08', NULL),
(2, 'SECOND YEAR', 2, 'B', '2023-09-04 13:06:58', NULL),
(3, 'SECOND YEAR', 2, 'C', '2023-09-04 13:16:29', '2023-09-04 14:28:45'),
(4, 'SECOND YEAR', 2, 'B', '2023-09-04 13:18:55', '2023-09-16 17:16:17'),
(7, 'SECOND YEAR', 2, 'A', '2023-09-04 13:27:12', NULL),
(9, 'THIRD YEAR', 3, 'B', '2023-09-04 13:50:35', '2023-09-04 14:26:21'),
(10, 'FIRST YEAR', 1, 'B', '2023-09-06 14:05:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblnotice`
--

CREATE TABLE `tblnotice` (
  `Id` int(11) NOT NULL,
  `noticeTitle` varchar(50) NOT NULL,
  `noticeDetails` mediumtext NOT NULL,
  `postingDetails` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblnotice`
--

INSERT INTO `tblnotice` (`Id`, `noticeTitle`, `noticeDetails`, `postingDetails`) VALUES
(1, 'Holiday Homework 2022-2023', 'Holiday Homework of Summer vacation 2022 – 2023 has been uploaded and you can download it by clicking on the link.', '2023-09-09 21:48:41'),
(3, 'Classes Resume', 'Dear Students, The classes will resume from 25-09-2023 (Monday). Students must reach the school in proper uniform as per their arrival time.', '2023-09-09 22:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `tblresult`
--

CREATE TABLE `tblresult` (
  `Id` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `SubjectId` int(11) NOT NULL,
  `Marks` decimal(5,2) NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblresult`
--

INSERT INTO `tblresult` (`Id`, `StudentId`, `ClassId`, `SubjectId`, `Marks`, `PostingDate`, `UpdationDate`) VALUES
(10, 1, 1, 2, 60.00, '2023-09-09 11:03:21', NULL),
(18, 6, 1, 4, 85.00, '2023-09-09 11:11:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `Id` int(11) NOT NULL,
  `StudentName` varchar(100) DEFAULT NULL,
  `RollId` varchar(50) DEFAULT NULL,
  `StudentEmail` varchar(100) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`Id`, `StudentName`, `RollId`, `StudentEmail`, `Gender`, `DOB`, `ClassId`, `RegDate`, `UpdationDate`) VALUES
(1, 'TUYISHIME Hertillan', 'E001', 'tuyishime@gmail.com', 'Male', '2001-01-01', 1, '2023-09-06 09:16:11', '2023-09-06 10:34:36'),
(2, 'Prosper MUKUNZI', 'E002', 'prosperm@gmail.com', 'Male', '2000-06-14', 2, '2023-09-06 09:18:54', NULL),
(4, 'MURENZI Frank', 'E005', 'fmurenzi@gmail.com', 'Male', '2001-06-27', 1, '2023-09-06 09:33:23', NULL),
(5, 'Anne MUNYANA', 'E004', 'amunyana@gmail.com', 'Female', '2002-07-15', 3, '2023-09-06 11:47:50', NULL),
(6, 'Delice UWINEZA', 'E008', 'uwinezadelice@gmail.com', 'Male', '2002-06-18', 1, '2023-09-08 13:18:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectcombination`
--

CREATE TABLE `tblsubjectcombination` (
  `Id` int(11) NOT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubjectcombination`
--

INSERT INTO `tblsubjectcombination` (`Id`, `ClassId`, `SubjectId`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(2, 2, 2, 'Active', '2023-09-05 16:19:25', '2023-09-14 21:08:05'),
(3, 1, 2, 'Active', '2023-09-05 18:08:44', '2023-09-14 21:08:01'),
(4, 1, 4, 'Active', '2023-09-05 19:17:08', '2023-09-14 21:07:57'),
(5, 1, 5, 'Active', '2023-09-05 19:17:35', '2023-09-14 21:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `Id` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`Id`, `SubjectName`, `SubjectCode`, `CreationDate`, `UpdationDate`) VALUES
(1, 'English', 'ENG', '2023-09-04 17:05:19', NULL),
(2, 'Mathematics', 'MATH', '2023-09-04 17:05:50', NULL),
(4, 'History', 'HIST', '2023-09-04 17:06:26', '2023-09-04 17:10:00'),
(5, 'Chemistry', 'CHEM', '2023-09-04 17:06:45', '2023-09-04 16:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `Id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`Id`, `UserName`, `Password`, `updationDate`) VALUES
(2, 'wilson@gmail.com', '$2y$10$R9Btu4BR0/T/adKoQgHQMOu9ThqUsKiJdnyEpUH6SelU73AjpOp/m', '2023-09-04 10:52:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblnotice`
--
ALTER TABLE `tblnotice`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblresult`
--
ALTER TABLE `tblresult`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ClassId` (`ClassId`);

--
-- Indexes for table `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ClassId` (`ClassId`),
  ADD KEY `SubjectId` (`SubjectId`);

--
-- Indexes for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblclasses`
--
ALTER TABLE `tblclasses`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblnotice`
--
ALTER TABLE `tblnotice`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblresult`
--
ALTER TABLE `tblresult`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblresult`
--
ALTER TABLE `tblresult`
  ADD CONSTRAINT `tblresult_ibfk_1` FOREIGN KEY (`StudentId`) REFERENCES `tblstudents` (`Id`),
  ADD CONSTRAINT `tblresult_ibfk_2` FOREIGN KEY (`ClassId`) REFERENCES `tblclasses` (`Id`),
  ADD CONSTRAINT `tblresult_ibfk_3` FOREIGN KEY (`SubjectId`) REFERENCES `tblsubjects` (`Id`);

--
-- Constraints for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD CONSTRAINT `tblstudents_ibfk_1` FOREIGN KEY (`ClassId`) REFERENCES `tblclasses` (`Id`);

--
-- Constraints for table `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  ADD CONSTRAINT `tblsubjectcombination_ibfk_1` FOREIGN KEY (`ClassId`) REFERENCES `tblclasses` (`Id`),
  ADD CONSTRAINT `tblsubjectcombination_ibfk_2` FOREIGN KEY (`SubjectId`) REFERENCES `tblsubjects` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
