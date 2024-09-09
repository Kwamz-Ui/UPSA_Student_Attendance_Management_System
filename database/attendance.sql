-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 09:11 PM
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
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `firstname`, `lastname`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attendclass`
--

CREATE TABLE `attendclass` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `attend_date` date NOT NULL DEFAULT current_timestamp(),
  `attend_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendclass`
--

INSERT INTO `attendclass` (`id`, `cid`, `lid`, `sid`, `attend_date`, `attend_time`) VALUES
(1, 3, 3, 33823668, '2024-04-17', '12:27:29'),
(2, 1, 3, 99347602, '2024-04-17', '12:28:17'),
(3, 2, 3, 71981888, '2024-04-17', '15:34:28'),
(4, 9, 5, 89823206, '2024-04-17', '23:02:49'),
(5, 10, 5, 89823206, '2024-04-17', '23:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `cid` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ctype` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `stime` time NOT NULL,
  `etime` time NOT NULL,
  `level` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `gid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cid`, `code`, `name`, `ctype`, `day`, `stime`, `etime`, `level`, `pid`, `lid`, `gid`) VALUES
(1, 'BGEC101', 'Communication Skills ', 1, 4, '11:00:00', '13:00:00', 100, 1, 3, 1),
(2, 'BGEC101', 'Communication Skills ', 1, 4, '14:00:00', '16:00:00', 100, 1, 3, 2),
(3, 'BGEC101', 'Communication Skills ', 1, 4, '11:00:00', '13:00:00', 100, 2, 3, 1),
(4, 'BGEC101', 'Communication Skills ', 1, 4, '14:00:00', '16:00:00', 100, 5, 3, 2),
(5, 'BGEC101', 'Communication Skills ', 1, 4, '11:00:00', '13:00:00', 100, 5, 3, 1),
(6, 'BGEC101', 'Communication Skills ', 1, 4, '14:00:00', '16:00:00', 100, 5, 3, 2),
(7, 'BITM401', 'Web Development', 3, 2, '08:00:00', '11:00:00', 400, 2, 1, 1),
(8, 'BITM401', 'Web Development', 3, 3, '14:00:00', '17:00:00', 400, 2, 1, 2),
(9, 'BGEC103', 'Introduction To French', 1, 4, '22:00:00', '23:31:00', 100, 3, 5, 1),
(10, 'BGEC103', 'Introduction Nana Afua', 1, 4, '23:14:00', '23:33:00', 100, 3, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `did` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fid` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`did`, `name`, `fid`, `date_created`) VALUES
(1, 'Department of Accounting', 1, '2024-04-16'),
(2, 'Department of Marketing', 2, '2024-04-16'),
(3, 'Department of Information Technology Management', 3, '2024-04-16'),
(4, 'Department of Law', 4, '2024-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fid`, `name`, `date_created`) VALUES
(1, 'Faculty of Accounting and Finance', '2024-04-16'),
(2, 'Faculty of Management Studies', '2024-04-16'),
(3, 'Faculty of Information Technology and Communication Studies', '2024-04-16'),
(4, 'Faculty of Law', '2024-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `grouping`
--

CREATE TABLE `grouping` (
  `gid` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grouping`
--

INSERT INTO `grouping` (`gid`, `name`, `date`) VALUES
(1, 'Group 1', '2024-04-16'),
(2, 'Group 2', '2024-04-16'),
(3, 'Group 3', '2024-04-16'),
(4, 'Group 4', '2024-04-16'),
(6, 'Group 5', '2024-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lid` int(11) NOT NULL,
  `title` char(5) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lid`, `title`, `firstname`, `lastname`, `email`, `phone`, `username`, `password`) VALUES
(1, 'Dr', 'Derick', 'Keddy', 'dkeddy@upsa.edu', '0201112345', 'dkeddy', 'kedyy123'),
(2, 'Mrs', 'Augustina', 'Agor', 'aagor@upsa.edu', '0542345678', 'aagor', 'agor123'),
(3, 'Dr', 'Adwoa', 'Amankwaa', 'aamankwaa@upsa.edu', '0551234567', 'aamankwa', 'amankwaa123'),
(4, 'Mr', 'Peter', 'Kodjie', 'pkodjie@upsa.ed', '0201123456', 'pkodjie', 'peter123'),
(5, 'Mr', 'Lazarus', 'Lamptey', 'llamptey@upsa.edu', '0201234567', 'llamptey', 'lamptey123'),
(6, 'Mr', 'Ransford', 'Afeadi', 'rafeadi@upsa.edu', '0542345678', 'afeadi', 'ransford123');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `pid` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `did` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`pid`, `name`, `did`, `date_created`) VALUES
(1, 'Bachelor of Science in Marketing', 2, '2024-04-16'),
(2, 'Bachelor of Science in Information Technology Management ', 3, '2024-04-16'),
(3, 'Bachelor of Science in Accounting and Finance', 1, '2024-04-16'),
(4, 'BLL', 4, '2024-04-16'),
(5, 'Bachelor of Science in Accounting', 1, '2024-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sid` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `semail` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `firstname`, `lastname`, `phone`, `semail`, `password`, `level`, `gid`, `pid`) VALUES
(21280144, 'Simon', 'Yobeah', '0245670000', '21280144@upsa.edu', 'simon', 400, 2, 2),
(33823668, 'Frank', 'Appiah', '0252348900', '33823668@upsa.edu', 'frank123', 100, 1, 2),
(49310693, 'Prince', 'Nartey', '0501234567', '49310693@upsa.edu', 'prince123', 200, 2, 5),
(58905534, 'Prince', 'Osei', '0551231456', '58905534@upsa.edu', 'prince123', 400, 1, 2),
(64730309, 'Simon', 'Tetteh', '0541113424', '64730309@upsa.edu', 'simon123', 100, 2, 5),
(66842753, 'Marilyn', 'Ceasar', '0279842990', '66842753@upsa.edu', 'marilyn', 200, 1, 5),
(71981888, 'Isaac', 'Bentum', '0242347789', '71981888@upsa.edu', 'isaac123', 100, 2, 1),
(73453744, 'Gideon', 'Neequaye', '0501234567', '73453744@upsa.edu', 'gideon123', 400, 1, 2),
(77138047, 'Evans', 'Kwampa', '0554565677', '77138047@upsa.edu', 'evans123', 100, 2, 2),
(89823206, 'Alex', 'Bamfo', '0241235678', '89823206@upsa.edu', 'bamfo123', 100, 1, 3),
(90518071, 'Hamdan', 'Yussif', '0247892578', '90518071@upsa.edu', 'yussif123', 100, 2, 2),
(97905762, 'Opuku', 'Agyeman', '0201234567', '97905762@upsa.edu', 'opuku123', 100, 1, 5),
(99347602, 'Michael', 'Morgan', '0557778979', '99347602@upsa.edu', 'morgan123', 100, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `attendclass`
--
ALTER TABLE `attendclass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `grouping`
--
ALTER TABLE `grouping`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendclass`
--
ALTER TABLE `attendclass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grouping`
--
ALTER TABLE `grouping`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
