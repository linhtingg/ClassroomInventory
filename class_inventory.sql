-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 03:28 AM
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
  `usability` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`type`, `id`, `totalUsedTime`, `producedYear`, `description`, `lastUserUsed`, `currentRoom`, `usability`) VALUES
('Dây nối', 'CON_001', 98, 2017, ' ', '20203425', 'D9_401', 0),
('Dây nối', 'CON_002', 90, 2020, ' ', '20204568', 'D6_205', 0),
('Microphone', 'MIC_001', 200, 2017, 'Hơi rè', '20205093', 'D9_501', 1),
('Chuột máy tính', 'MSE_001', 40, 2018, NULL, NULL, 'D9_501', 1),
('Chuột máy tính', 'MSE_002', 9, 2023, ' ', '20205093', 'D9_505', 0),
('Chuột máy tính', 'MSE_003', 10, 2023, '', '20201234', 'D5_309', 0),
('Chuột máy tính', 'MSE_004', 40, 2022, '', NULL, 'D6_205', NULL),
('Oscilloscope', 'OSC_001', 23, 2018, 'Chả có gì', '20205093', 'D9_401', 1),
('Oscilloscope', 'OSC_002', 27, 2018, 'Hoạt động bình thường', '20215689', 'D9_501', 1),
('Oscilloscope', 'OSC_003', 0, 2023, '', '20205093', 'D9_505', 0),
('Bút con trỏ laser', 'PTR_001', 0, 2023, '', NULL, 'D9_401', NULL),
('Bàn học', 'TBL_001', 9, 2017, ' ', '20205093', 'D9_401', 0),
('Bàn học', 'TBL_002', 98, 2022, 'Gãy chân', '20215689', 'D9_501', 0),
('Bàn học', 'TBL_003', 98, 2022, 'Hộc bàn bị mọt', '20201234', 'D9_401', 0);

-- --------------------------------------------------------

--
-- Table structure for table `equipmentregisterform`
--

CREATE TABLE `equipmentregisterform` (
  `userID` varchar(8) NOT NULL,
  `purpose` varchar(200) NOT NULL,
  `equipType` varchar(50) NOT NULL,
  `numberOfEach` int(11) NOT NULL,
  `borrowTime` varchar(20) DEFAULT NULL,
  `borrowDay` date NOT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `formid` int(11) NOT NULL,
  `reply` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipmentregisterform`
--

INSERT INTO `equipmentregisterform` (`userID`, `purpose`, `equipType`, `numberOfEach`, `borrowTime`, `borrowDay`, `approved`, `formid`, `reply`) VALUES
('20201234', 'Mượn mic cho lớp học ngày mai', 'MIC', 1, 'Morning', '2023-07-21', NULL, 1, NULL),
('20201234', 'Mượn loa cầm tay ', 'SPEAKER', 1, 'Evening', '2023-07-04', NULL, 2, NULL),
('20205093', 'Điều khiển máy chiếu lớp học', 'CTL', 2, 'Evening', '2023-06-30', 1, 5, NULL),
('20201234', 'Dây nối máy chiếu', 'Dây nối', 1, 'Afternoon', '2023-07-27', NULL, 6, NULL),
('20205093', 'Thực hành Điện tử cho CNTT', 'Oscilloscope', 1, 'Afternoon', '2023-06-30', NULL, 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equipschedule`
--

CREATE TABLE `equipschedule` (
  `id` int(11) NOT NULL,
  `occupiedTime` set('Morning','Afternoon','Evening') NOT NULL,
  `occupiedDay` date NOT NULL,
  `equipmentID` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipschedule`
--

INSERT INTO `equipschedule` (`id`, `occupiedTime`, `occupiedDay`, `equipmentID`) VALUES
(1, 'Afternoon', '2023-07-14', 'MIC_001'),
(2, 'Afternoon', '2023-07-13', 'OSC_001'),
(3, 'Evening', '2023-07-13', 'OSC_001');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notiContent` varchar(200) NOT NULL,
  `valid_til` date DEFAULT (current_timestamp() + interval 7 day),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notiContent`, `valid_til`, `id`) VALUES
('Thông báo, từ ngày 7/8 nhà trường ngừng cho mượn các phòng học tại D7, D9 phục vụ kỳ thi UHYU 2023. Trân trọng!', '2023-07-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reportform`
--

CREATE TABLE `reportform` (
  `reportDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `roomID` varchar(7) NOT NULL,
  `userReportID` varchar(8) DEFAULT NULL,
  `desribeCondition` varchar(200) NOT NULL,
  `formid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reportform`
--

INSERT INTO `reportform` (`reportDate`, `roomID`, `userReportID`, `desribeCondition`, `formid`) VALUES
('2023-06-20 17:00:00', 'D9_505', '20201234', 'Không thể kết nối âm thanh từ mic phát tới loa.', 1),
('2023-06-26 05:11:57', 'D9_505', '20201234', '2 bàn bị gãy chân', 3);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` varchar(7) NOT NULL,
  `capacity` int(11) NOT NULL,
  `usability` tinyint(1) NOT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `capacity`, `usability`, `description`) VALUES
('D35_205', 50, 1, 'Phòng máy'),
('D5_205', 50, 1, 'bình thường bình thường'),
('D5_306', 150, 1, 'Bình thường'),
('D5_309', 50, 0, 'Rơi tường'),
('D6_205', 50, 0, 'Xịn nhưng không dùng được'),
('D9_401', 150, 1, 'Điều hòa hỏng'),
('D9_501', 150, 1, 'Bình thường'),
('D9_505', 50, 0, 'Hỏng mic. Màn chiếu không hoạt động.');

-- --------------------------------------------------------

--
-- Table structure for table `roomregisterform`
--

CREATE TABLE `roomregisterform` (
  `userID` varchar(8) NOT NULL,
  `purpose` varchar(200) NOT NULL,
  `numberOfRoom` int(11) NOT NULL,
  `numberOfPeople` int(11) NOT NULL,
  `borrowTime` varchar(20) DEFAULT NULL,
  `borrowDay` date NOT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `formid` int(11) NOT NULL,
  `reply` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomregisterform`
--

INSERT INTO `roomregisterform` (`userID`, `purpose`, `numberOfRoom`, `numberOfPeople`, `borrowTime`, `borrowDay`, `approved`, `formid`, `reply`) VALUES
('20201234', 'Mượn phòng cho CLB sinh hoạt', 1, 26, 'Morning', '2023-07-12', NULL, 1, NULL),
('20201234', 'Mượn phòng học.', 1, 80, 'Noon', '2023-07-04', NULL, 2, NULL),
('20205093', 'Học bổ túc', 1, 30, 'Evening', '2023-06-30', NULL, 8, NULL),
('20215689', 'Lớp học Latex', 2, 50, 'Evening', '2023-04-08', 0, 9, NULL),
('20215689', 'Ôn tập cuối kỳ', 1, 30, 'Morning', '2023-07-25', 1, 10, NULL),
('20205093', 'Lớp thi cuối kỳ Giải tích 2', 1, 50, 'Afternoon', '2023-07-21', 1, 11, NULL),
('20215689', 'Học sáng', 2, 50, 'Afternoon', '2023-07-13', NULL, 13, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roomschedule`
--

CREATE TABLE `roomschedule` (
  `id` int(11) NOT NULL,
  `occupiedTime` set('Morning','Afternoon','Evening') NOT NULL,
  `occupiedDay` date NOT NULL,
  `roomID` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomschedule`
--

INSERT INTO `roomschedule` (`id`, `occupiedTime`, `occupiedDay`, `roomID`) VALUES
(1, 'Morning', '2023-07-12', 'D9_501'),
(2, 'Afternoon', '2023-07-12', 'D9_501'),
(3, 'Evening', '2023-07-14', 'D9_505');

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
  `fullName` varchar(200) NOT NULL,
  `schoolID` varchar(8) NOT NULL,
  `phonenumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`email`, `pass`, `isType`, `fullName`, `schoolID`, `phonenumber`) VALUES
('anh.hm201234@sis.hust.edu.vn', '123456', 'Student', 'Hoàng Minh Anh', '20201234', '0987654321'),
('hien.vm201879@sis.hust.edu.vn', '20201879', 'Student', 'Vũ Minh Hiền', '20201879', NULL),
('tien.ttq203425@sis.hust.edu.vn', '20203425', 'Student', 'Trần Thị Quỳnh Tiên', '20203425', '2345109833'),
('dat.nt204568@sis.hust.edu.vn', '20204568', 'Student', 'Nguyễn Tiến Đạt', '20204568', '23451098766'),
('hoan.nv204709L@sis.hust.edu.vn', '20204709L', 'Lecturer', 'Nguyễn Văn Hoàn', '20204709', NULL),
('linh.hmt205093@sis.hust.edu.vn', '123456', 'Student', 'Hoàng Mai Thùy Linh', '20205093', '032456789'),
('nhung.pt209876@sis.hust.edu.vn', '20209876', 'Student', 'Phạm Thi Nhung', '20209876', NULL),
('vu.ph215689@sis.hust.edu.vn', '1234', 'Student', 'Phan Nguyên Vũ', '20215689', '08756765456');

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
  ADD KEY `userID` (`userID`),
  ADD KEY `reply` (`reply`);

--
-- Indexes for table `equipschedule`
--
ALTER TABLE `equipschedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reportform`
--
ALTER TABLE `reportform`
  ADD PRIMARY KEY (`formid`),
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
  ADD KEY `userID` (`userID`),
  ADD KEY `reply` (`reply`);

--
-- Indexes for table `roomschedule`
--
ALTER TABLE `roomschedule`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `formid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `equipschedule`
--
ALTER TABLE `equipschedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reportform`
--
ALTER TABLE `reportform`
  MODIFY `formid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roomregisterform`
--
ALTER TABLE `roomregisterform`
  MODIFY `formid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roomschedule`
--
ALTER TABLE `roomschedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `equipmentregisterform_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbluser` (`schoolID`),
  ADD CONSTRAINT `equipmentregisterform_ibfk_2` FOREIGN KEY (`reply`) REFERENCES `equipment` (`id`);

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
  ADD CONSTRAINT `roomregisterform_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbluser` (`schoolID`),
  ADD CONSTRAINT `roomregisterform_ibfk_2` FOREIGN KEY (`reply`) REFERENCES `room` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
