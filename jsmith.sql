-- phpMyAdmin SQL Dump
-- version 5.2.2-1.el9.remi
-- https://www.phpmyadmin.net/
--
-- Host: mysql-200-130.mysql.prositehosting.net
-- Generation Time: May 09, 2025 at 09:02 AM
-- Server version: 8.0.36
-- PHP Version: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jsmith`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblAccounts`
--

CREATE TABLE `tblAccounts` (
  `id` int NOT NULL,
  `account` int NOT NULL,
  `balance` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblAccounts`
--

INSERT INTO `tblAccounts` (`id`, `account`, `balance`) VALUES
(1, 12345678, 1200),
(2, 87654321, 50112);

-- --------------------------------------------------------

--
-- Table structure for table `tblCaseNotes`
--

CREATE TABLE `tblCaseNotes` (
  `noteID` int NOT NULL,
  `caseID` int NOT NULL,
  `userID` int NOT NULL,
  `note` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblCaseNotes`
--

INSERT INTO `tblCaseNotes` (`noteID`, `caseID`, `userID`, `note`) VALUES
(2, 1, 1, 'this is a test');

-- --------------------------------------------------------

--
-- Table structure for table `tblCourse`
--

CREATE TABLE `tblCourse` (
  `courseID` int NOT NULL,
  `moduleID` int NOT NULL,
  `courseName` varchar(128) NOT NULL,
  `department` text NOT NULL,
  `departmentHead` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblLocation`
--

CREATE TABLE `tblLocation` (
  `locationID` int NOT NULL,
  `buildingName` text NOT NULL,
  `roomNumber` varchar(20) NOT NULL,
  `roomType` varchar(20) NOT NULL,
  `capacity` int NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblMissingCase`
--

CREATE TABLE `tblMissingCase` (
  `caseID` int NOT NULL,
  `userID` int NOT NULL,
  `MPfirstname` varchar(20) NOT NULL,
  `MPsurname` varchar(20) NOT NULL,
  `MPage` int NOT NULL,
  `MPheight` varchar(3) NOT NULL,
  `MPuniqueFeatures` varchar(40) NOT NULL,
  `MPlastSeen` date NOT NULL,
  `MPlastLocation` varchar(20) NOT NULL,
  `MPcaseNumber` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblMissingCase`
--

INSERT INTO `tblMissingCase` (`caseID`, `userID`, `MPfirstname`, `MPsurname`, `MPage`, `MPheight`, `MPuniqueFeatures`, `MPlastSeen`, `MPlastLocation`, `MPcaseNumber`) VALUES
(1, 1, 'tim', 'smith', 25, '6.1', 'tattoo on left arm', '2024-05-06', 'newcastle', '0142545'),
(2, 2, 'beth', 'thomas', 44, '5.8', 'blonde hair, glasses', '2023-12-01', 'London', '0123546');

-- --------------------------------------------------------

--
-- Table structure for table `tblModule`
--

CREATE TABLE `tblModule` (
  `moduleID` int NOT NULL,
  `moduleKey` varchar(20) NOT NULL,
  `moduleName` varchar(128) NOT NULL,
  `totalMarks` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblOrder`
--

CREATE TABLE `tblOrder` (
  `OrderID` int NOT NULL,
  `userID` int NOT NULL,
  `payType` varchar(20) NOT NULL,
  `cardNum` int NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `date` date NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `totalItems` int NOT NULL,
  `orderVal` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblOrder`
--

INSERT INTO `tblOrder` (`OrderID`, `userID`, `payType`, `cardNum`, `postcode`, `date`, `totalPrice`, `totalItems`, `orderVal`) VALUES
(32, 7, 'amex', 1231234568, '45132', '2025-01-05', 26.00, 1, '8\nCoffee Mug\n25.50\n1\n'),
(33, 7, 'visa', 123, 'Ne12abc', '2025-01-05', 15.99, 1, 'Product: \nLight Roast\n Price: \n15.99\n Quantity: \n1\n'),
(34, 7, 'mastercard', 2147483647, 'Ne12abc', '2025-01-05', 31.98, 2, 'Product: \nLight Roast\n Price: \n15.99\n Quantity: \n2\n'),
(37, 7, 'mastercard', 2147483647, 'Ne12abc', '2025-01-05', 28.00, 1, 'Product: \nCoffee Mug\n Price: \n28.00\n Quantity: \n1\n'),
(38, 7, 'mastercard', 2147483647, 'Ne12abc', '2025-01-05', 28.00, 1, 'Product: \nCoffee Mug\n Price: \n28.00\n Quantity: \n1\n'),
(39, 7, 'mastercard', 2147483647, 'Ne12abc', '2025-01-05', 28.00, 1, 'Product: \nCoffee Mug\n Price: \n28.00\n Quantity: \n1\n'),
(51, 8, 'mastercard', 2147483647, 'AA1 123', '2025-02-05', 31.98, 2, 'Product: \nLight Roast\n Price: \n15.99\n Quantity: \n2\n');

-- --------------------------------------------------------

--
-- Table structure for table `tblProduct`
--

CREATE TABLE `tblProduct` (
  `productID` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(455) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblProduct`
--

INSERT INTO `tblProduct` (`productID`, `name`, `price`, `image`, `description`) VALUES
(6, 'Light Roast', 15.99, 'img/TBC_Light.png', 'This is a description of the light brew coffee - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat'),
(8, 'Coffee Mug', 28.00, 'img/TBC_MugLogo.png', 'This is a description of the white coffee mug - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat'),
(9, 'Tote Bag', 40.00, 'img/tote.jpg', 'Simple tote bag for the coffee shop');

-- --------------------------------------------------------

--
-- Table structure for table `tblTimetable`
--

CREATE TABLE `tblTimetable` (
  `timetableID` int NOT NULL,
  `userID` int NOT NULL,
  `courseID` int NOT NULL,
  `locationID` int NOT NULL,
  `week` int NOT NULL,
  `day` int NOT NULL,
  `timeSlot` time NOT NULL,
  `firstname` text NOT NULL,
  `surname` text NOT NULL,
  `buildingName` text NOT NULL,
  `roomNumber` varchar(20) NOT NULL,
  `moduleName` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblTimetable2`
--

CREATE TABLE `tblTimetable2` (
  `timeID` int NOT NULL,
  `userID` int NOT NULL,
  `courseID` int NOT NULL,
  `locationID` int NOT NULL,
  `week` int NOT NULL,
  `day` int NOT NULL,
  `9.00am - 10.00am` varchar(200) NOT NULL,
  `10.00am - 11.00am` varchar(200) NOT NULL,
  `11.00am - 12.00pm` varchar(200) NOT NULL,
  `12.00pm - 1.00pm` varchar(200) NOT NULL,
  `1.00pm - 2.00pm` varchar(200) NOT NULL,
  `2.00pm - 3.00pm` varchar(200) NOT NULL,
  `3.00pm - 4.00pm` varchar(200) NOT NULL,
  `4.00pm - 5.00pm` varchar(200) NOT NULL,
  `5.00pm - 6.00pm` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblUser`
--

CREATE TABLE `tblUser` (
  `userID` int NOT NULL,
  `firstname` text NOT NULL,
  `surname` text NOT NULL,
  `email` varchar(64) NOT NULL,
  `qualification` varchar(64) NOT NULL,
  `password` varchar(20) NOT NULL,
  `adminStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblUsers`
--

CREATE TABLE `tblUsers` (
  `userID` int NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblUsers`
--

INSERT INTO `tblUsers` (`userID`, `firstname`, `surname`, `username`, `password`, `email`, `role`) VALUES
(1, 'Jade', 'Smith', 'Admin1', 'Password1', '', 'Admin'),
(2, 'bob', 'roberts', 'user1', 'Password1', 'email@email.com', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tblUsers3`
--

CREATE TABLE `tblUsers3` (
  `userID` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `uuid` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblUsers3`
--

INSERT INTO `tblUsers3` (`userID`, `email`, `username`, `password`, `uuid`, `admin`) VALUES
(2, 'user1@email.com', 'user1', '$2y$10$B0GQRaxlFkPri5t.OOiRrOJ039RVr0XPWLkVg5mgJHR', '17309932697ed4eae7293bd3f0', 0),
(3, 'user2@email.com', 'user2', '$2y$10$.AuCFy1cnZZpCOa2xDf/UeIyngLaNUBlJyId.difGN4', '1730994069f1b57670c9eadae7', 0),
(4, 'user3@email.com', 'user3', '$2y$10$BZzKFgOiB.pnXMAGtEO8AOI3z1wYWakw/S7nyzhApvd', '17309945997fe291027a6e470d', 0),
(5, 'lll@lll.lll', 'pop', '$2y$10$rzysVLB4.XNiOUPhHnQIg.lB48nG4hupyINNUS4WL4g', '1730995578de780e21ad229395', 0),
(6, 'aaa@aaa.a', 'aaaa', '$2y$10$uex1RnaKvUlssTnYb8yjjeU69X7wDFyUwaGskwVH74Xf7gzu9fnM6', '1730995959874956c414df00da', 0),
(7, 'user@email.com', 'user', '$2y$10$BkS0s0FdpwB/unl9MMQ1GutrsRDyQrChQuaUVucXFbou4kjsB2HPa', '17359315132e1ef33de76bed19', 1),
(8, 'test@test.com', 'mlambert', '$2y$10$HqC.xp6ZoGuOhqK1vOpuBeMsOAm2XoWj9wRga9QEosHu7WA9TMikm', '1738788099e445e9b3f51a1bc4', 0),
(9, 'user11@email.com', 'user11', '$2y$10$eRPEQdhcX0AxdB8HfQ7gAuSIZTlbj/JjJoVcgQABKe36/WXqvPbP6', '17437649929ac9f5551a3bf9b8', 1),
(10, 'user10@email.com', 'user10', '$2y$10$titvLMq3/d4yI8aIVg/wVeGH1JsnqnFSnPunWnQ/QUIBq5d5pvBcC', '1746174318c3852b868557c961', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblUsers214`
--

CREATE TABLE `tblUsers214` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblUsers214`
--

INSERT INTO `tblUsers214` (`id`, `username`, `password`) VALUES
(1, 'username1', 'newPass'),
(2, 'username2', 'newPass');

-- --------------------------------------------------------

--
-- Table structure for table `tblXssComments`
--

CREATE TABLE `tblXssComments` (
  `id` int NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblXssComments`
--

INSERT INTO `tblXssComments` (`id`, `comment`) VALUES
(1, 'this is a very boring test comment to make sure that the database is working '),
(2, 'ahhhhhhhhhhhhhhhhhhh]'),
(3, '<h1>this is a header </h1>'),
(4, '<body style=\"background-color:powderblue;\">'),
(5, '<body style=\"background-color:pink;\">');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblAccounts`
--
ALTER TABLE `tblAccounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblCaseNotes`
--
ALTER TABLE `tblCaseNotes`
  ADD PRIMARY KEY (`noteID`),
  ADD UNIQUE KEY `caseID` (`caseID`,`userID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `tblCourse`
--
ALTER TABLE `tblCourse`
  ADD PRIMARY KEY (`courseID`),
  ADD KEY `tblCourse_id1` (`moduleID`);

--
-- Indexes for table `tblLocation`
--
ALTER TABLE `tblLocation`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `tblMissingCase`
--
ALTER TABLE `tblMissingCase`
  ADD PRIMARY KEY (`caseID`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `tblModule`
--
ALTER TABLE `tblModule`
  ADD PRIMARY KEY (`moduleID`);

--
-- Indexes for table `tblOrder`
--
ALTER TABLE `tblOrder`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `userID_2` (`userID`);

--
-- Indexes for table `tblProduct`
--
ALTER TABLE `tblProduct`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `tblTimetable`
--
ALTER TABLE `tblTimetable`
  ADD PRIMARY KEY (`timetableID`),
  ADD KEY `tblTime_id1` (`userID`),
  ADD KEY `tblTime_id2` (`courseID`),
  ADD KEY `tblTime_id3` (`locationID`);

--
-- Indexes for table `tblTimetable2`
--
ALTER TABLE `tblTimetable2`
  ADD PRIMARY KEY (`timeID`);

--
-- Indexes for table `tblUser`
--
ALTER TABLE `tblUser`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tblUsers`
--
ALTER TABLE `tblUsers`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tblUsers3`
--
ALTER TABLE `tblUsers3`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tblUsers214`
--
ALTER TABLE `tblUsers214`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblXssComments`
--
ALTER TABLE `tblXssComments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblAccounts`
--
ALTER TABLE `tblAccounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblCaseNotes`
--
ALTER TABLE `tblCaseNotes`
  MODIFY `noteID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblCourse`
--
ALTER TABLE `tblCourse`
  MODIFY `courseID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblLocation`
--
ALTER TABLE `tblLocation`
  MODIFY `locationID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblMissingCase`
--
ALTER TABLE `tblMissingCase`
  MODIFY `caseID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblModule`
--
ALTER TABLE `tblModule`
  MODIFY `moduleID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblOrder`
--
ALTER TABLE `tblOrder`
  MODIFY `OrderID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tblProduct`
--
ALTER TABLE `tblProduct`
  MODIFY `productID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblTimetable`
--
ALTER TABLE `tblTimetable`
  MODIFY `timetableID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblTimetable2`
--
ALTER TABLE `tblTimetable2`
  MODIFY `timeID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblUser`
--
ALTER TABLE `tblUser`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblUsers`
--
ALTER TABLE `tblUsers`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblUsers3`
--
ALTER TABLE `tblUsers3`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblUsers214`
--
ALTER TABLE `tblUsers214`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblXssComments`
--
ALTER TABLE `tblXssComments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblCaseNotes`
--
ALTER TABLE `tblCaseNotes`
  ADD CONSTRAINT `tblCaseNotes_ibfk_1` FOREIGN KEY (`caseID`) REFERENCES `tblMissingCase` (`caseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblCaseNotes_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblCourse`
--
ALTER TABLE `tblCourse`
  ADD CONSTRAINT `tblCourse_id1` FOREIGN KEY (`moduleID`) REFERENCES `tblModule` (`moduleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblMissingCase`
--
ALTER TABLE `tblMissingCase`
  ADD CONSTRAINT `tblMissingCase_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tblUsers` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblOrder`
--
ALTER TABLE `tblOrder`
  ADD CONSTRAINT `tblOrder_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tblUsers3` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblTimetable`
--
ALTER TABLE `tblTimetable`
  ADD CONSTRAINT `tblTime_id1` FOREIGN KEY (`userID`) REFERENCES `tblUser` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblTime_id2` FOREIGN KEY (`courseID`) REFERENCES `tblCourse` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblTime_id3` FOREIGN KEY (`locationID`) REFERENCES `tblLocation` (`locationID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
