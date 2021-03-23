-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2021 at 11:42 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `Book_Id` varchar(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Publisher` varchar(50) NOT NULL,
  `Edition` int(11) NOT NULL,
  `Cost` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`Book_Id`, `Title`, `Author`, `Publisher`, `Edition`, `Cost`, `Quantity`) VALUES
('B1', 'Web Pogramming Using PHP', 'Binu MB', 'Prakash Publications', 1, 160, 3),
('B2', 'Data Structures Through CPP', 'GS Baluja', 'Dhanpat Rai And CO', 1, 245, 5),
('B3', 'Microprocessor Architecture', 'Remesh Gaonkar', 'Penram', 6, 500, 0),
('B4', 'C Programming', 'Balaguruswami', 'Tata Edition', 3, 600, 4),
('B5', 'The Davinchi Code', 'Dan Brown', 'Corgo', 3, 500, 10);

-- --------------------------------------------------------

--
-- Table structure for table `book_issue`
--

CREATE TABLE `book_issue` (
  `Issue_Id` varchar(10) NOT NULL,
  `BookId` varchar(10) NOT NULL,
  `Student_Id` int(11) NOT NULL,
  `Issue_Date` date NOT NULL,
  `Due_Date` date NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_issue`
--

INSERT INTO `book_issue` (`Issue_Id`, `BookId`, `Student_Id`, `Issue_Date`, `Due_Date`, `Status`) VALUES
('IS1', 'B1', 3333, '2021-03-11', '2021-03-13', 'Returned'),
('IS10', 'B2', 8990, '2021-03-15', '2021-03-22', 'Returned'),
('IS11', 'B2', 8998, '2021-03-15', '2021-03-29', 'Returned'),
('IS12', 'B5', 2345, '2021-03-11', '2021-03-15', 'Returned'),
('IS13', 'B1', 2345, '2021-03-15', '2021-03-29', 'Issued'),
('IS2', 'B2', 3636, '2021-03-09', '2021-03-11', 'Returned'),
('IS3', 'B1', 3636, '2021-03-11', '2021-03-13', 'Returned'),
('IS4', 'B2', 3333, '2021-03-11', '2021-03-13', 'Issued'),
('IS5', 'B2', 3333, '2021-04-10', '2021-03-20', 'Returned'),
('IS6', 'B1', 3333, '2021-03-18', '2021-03-21', 'Issued'),
('IS7', 'B1', 3333, '2021-04-10', '2021-03-12', 'Returned'),
('IS8', 'B1', 3636, '2021-03-28', '2021-04-08', 'Returned'),
('IS9', 'B1', 3636, '2021-03-15', '2021-03-22', 'Issued');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `User_Id` int(11) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `Role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`User_Id`, `Password`, `Role`) VALUES
(987, 'Sindhy123', 'Student'),
(1111, 'Admin', 'Admin'),
(2345, 'Ann123', 'Student'),
(3333, 'Anjali', 'Student'),
(3636, 'Anju', 'Student'),
(4455, 'Anna4455', 'Student'),
(6666, 'Anjana', 'Student'),
(8923, 'Reshma123', 'Student'),
(8967, 'Elvin123', 'Student'),
(8990, 'Anupama123', 'Student'),
(8998, 'Elizabeth1', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Admission_No` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Semester` varchar(20) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Phone_No` bigint(20) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Admission_No`, `Name`, `Semester`, `Department`, `Phone_No`, `Status`) VALUES
(987, 'Sindhya', '4', 'Mech', 7902698556, 'Pending'),
(2345, 'Ann', '6', 'Arch', 9562374604, 'Approved'),
(3333, 'Anjali PT', '3', 'Chem', 9656828504, 'Approved'),
(3636, 'Anju PT', '5', 'MCA', 9656829261, 'Approved'),
(4455, 'Anna', '4', 'Chem', 9876645312, 'Pending'),
(6666, 'Anjana PT', '1', 'MCA', 7902698558, 'Rejected'),
(8923, 'Reshma', '3', 'SOM', 7902698556, 'Pending'),
(8967, 'Elvin', '1', 'Electrical', 7902698556, 'Pending'),
(8990, 'Anupama', '1', 'MCA', 7902698556, 'Approved'),
(8998, 'Elizabeth', '1', 'MCA', 7902698556, 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`Book_Id`);

--
-- Indexes for table `book_issue`
--
ALTER TABLE `book_issue`
  ADD PRIMARY KEY (`Issue_Id`),
  ADD KEY `BookId` (`BookId`),
  ADD KEY `Student_Id` (`Student_Id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`User_Id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Admission_No`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_issue`
--
ALTER TABLE `book_issue`
  ADD CONSTRAINT `book_issue_ibfk_1` FOREIGN KEY (`BookId`) REFERENCES `book` (`Book_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_issue_ibfk_2` FOREIGN KEY (`Student_Id`) REFERENCES `student` (`Admission_No`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
