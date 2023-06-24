-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2023 at 05:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `class`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `type` varchar(200) NOT NULL,
  `id` varchar(7) NOT NULL,
  `totalUsedTime` int(11) DEFAULT NULL,
  `producedYear` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `lastUserUsed` varchar(8) DEFAULT NULL,
  `currentRoom` varchar(7) DEFAULT NULL,
  `avaiableTime` set('1','2','3','4','5','6','7','8','9','10','11','12','13','14') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`type`, `id`, `totalUsedTime`, `producedYear`, `description`, `lastUserUsed`, `currentRoom`, `avaiableTime`) VALUES
('Micro', 'MIC_001', 200, 2015, 'Hơi rè', NULL, 'D9_501', '1,2,3,4,5,6,7,8,9,10,11,12,13,14'),
('Oscilloscope', 'OSC_001', 23, 2018, 'Hoạt động bình thường', '20205093', 'D9_401', '1,2,3,4,5,6,7,8,9,10,11,12,13,14');

-- --------------------------------------------------------

--
-- Table structure for table `equipmentregisterform`
--

CREATE TABLE `equipmentregisterform` (
  `userID` varchar(8) NOT NULL,
  `phoneNumber` varchar(12) NOT NULL,
  `purpose` varchar(200) NOT NULL,
  `equipType` varchar(50) NOT NULL,
  `numberOfEach` int(11) NOT NULL,
  `borrowTime` set('1','2','3','4','5','6','7','8','9','10','11','12','13','14') NOT NULL,
  `borrowDay` date NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `formid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipmentregisterform`
--

INSERT INTO `equipmentregisterform` (`userID`, `phoneNumber`, `purpose`, `equipType`, `numberOfEach`, `borrowTime`, `borrowDay`, `approved`, `formid`) VALUES
('20201234', '0987654321', 'Mượn mic cho lớp học ngày mai', 'MIC', 1, '2,3,4', '2023-07-21', 0, 1),
('20201234', '0987654321', 'Mượn loa cầm tay ', 'SPEAKER', 1, '5,6,7', '2023-07-04', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notiContent` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notiContent`) VALUES
('Thông báo, từ ngày 7/8 nhà trường ngừng cho mượn các phòng học tại D7, D9 phục vụ kỳ thi UHYU 2023. Trân trọng!');

-- --------------------------------------------------------

--
-- Table structure for table `reportform`
--

CREATE TABLE `reportform` (
  `reportDate` date NOT NULL,
  `roomID` varchar(7) NOT NULL,
  `userReportID` varchar(8) DEFAULT NULL,
  `desribeCondition` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reportform`
--

INSERT INTO `reportform` (`reportDate`, `roomID`, `userReportID`, `desribeCondition`) VALUES
('2023-06-21', 'D9_505', '20201234', 'Không thể kết nối âm thanh từ mic phát tới loa.');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` varchar(7) NOT NULL,
  `capacity` int(11) NOT NULL,
  `usability` tinyint(1) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `avaiableTime` set('1','2','3','4','5','6','7','8','9','10','11','12','13','14') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `capacity`, `usability`, `description`, `avaiableTime`) VALUES
('D9_401', 150, 1, 'Điều hòa hỏng', '3,4,5'),
('D9_501', 150, 1, 'Bình thường', '3,4,5,8,9,10'),
('D9_505', 50, 0, 'Hỏng mic. Màn chiếu không hoạt động.', '3,4,5,8,9,10');

-- --------------------------------------------------------

--
-- Table structure for table `roomregisterform`
--

CREATE TABLE `roomregisterform` (
  `userID` varchar(8) NOT NULL,
  `phoneNumber` varchar(12) NOT NULL,
  `purpose` varchar(200) NOT NULL,
  `numberOfRoom` int(11) NOT NULL,
  `numberOfPeople` int(11) NOT NULL,
  `borrowTime` set('1','2','3','4','5','6','7','8','9','10','11','12','13','14') NOT NULL,
  `borrowDay` date NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `formid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomregisterform`
--

INSERT INTO `roomregisterform` (`userID`, `phoneNumber`, `purpose`, `numberOfRoom`, `numberOfPeople`, `borrowTime`, `borrowDay`, `approved`, `formid`) VALUES
('20201234', '0987654321', 'Mượn phòng cho CLB sinh hoạt', 1, 26, '13,14', '2023-07-12', 0, 1),
('20201234', '0987654321', 'Mượn phòng học.', 1, 80, '3,4,5,6,7,8,9', '2023-07-04', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `schoolID` varchar(8) NOT NULL,
  `fullName` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`email`, `password`, `schoolID`, `fullName`) VALUES
('admin@sis.hust.edu.vn', '20231234', '20231234', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `email` varchar(200) DEFAULT NULL,
  `pass` varchar(200) DEFAULT NULL,
  `isType` set('Lecturer','Student') DEFAULT NULL,
  `fullName` varchar(200) DEFAULT NULL,
  `schoolID` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`email`, `pass`, `isType`, `fullName`, `schoolID`) VALUES
('anh.hm201234@sis.hust.edu.vn', '123456', 'Student', 'Hoàng Minh Anh', '20201234'),
('linh.hmt205093@sis.hust.edu.vn', '123456', 'Student', 'Hoàng Mai Thùy Linh', '20205093');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currentRoom` (`currentRoom`),
  ADD KEY `lastUserUsed` (`lastUserUsed`);

--
-- Indexes for table `equipmentregisterform`
--
ALTER TABLE `equipmentregisterform`
  ADD PRIMARY KEY (`formid`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `reportform`
--
ALTER TABLE `reportform`
  ADD KEY `userReportID` (`userReportID`),
  ADD KEY `roomID` (`roomID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomregisterform`
--
ALTER TABLE `roomregisterform`
  ADD PRIMARY KEY (`formid`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`schoolID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`schoolID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipmentregisterform`
--
ALTER TABLE `equipmentregisterform`
  MODIFY `formid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roomregisterform`
--
ALTER TABLE `roomregisterform`
  MODIFY `formid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`currentRoom`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `equipment_ibfk_2` FOREIGN KEY (`lastUserUsed`) REFERENCES `tbluser` (`schoolID`);

--
-- Constraints for table `equipmentregisterform`
--
ALTER TABLE `equipmentregisterform`
  ADD CONSTRAINT `equipmentregisterform_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbluser` (`schoolID`);

--
-- Constraints for table `reportform`
--
ALTER TABLE `reportform`
  ADD CONSTRAINT `reportform_ibfk_1` FOREIGN KEY (`userReportID`) REFERENCES `tbluser` (`schoolID`),
  ADD CONSTRAINT `reportform_ibfk_2` FOREIGN KEY (`roomID`) REFERENCES `room` (`id`);

--
-- Constraints for table `roomregisterform`
--
ALTER TABLE `roomregisterform`
  ADD CONSTRAINT `roomregisterform_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbluser` (`schoolID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
