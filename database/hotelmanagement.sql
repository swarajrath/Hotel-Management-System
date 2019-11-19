-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2019 at 12:46 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelmanagement`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAvailableroom` (IN `param_type` VARCHAR(20))  NO SQL
SELECT
    room.room_no
FROM
    room
WHERE
  room_type = param_type AND
  room.room_no not in 
  (
    SELECT
      room_date.room_no
    FROM
      room_date
    WHERE
      (room_date.check_in<='2019-06-13' and room_date.check_out>='2019-06-13')
      OR
      (room_date.check_in<'2019-06-19' and room_date.check_out>='2019-06-19')
      OR
      (room_date.check_in>='2019-06-13' and room_date.check_out<'2019-06-19')
   )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getRoom` (IN `troom` VARCHAR(20))  NO SQL
SELECT room.room_no, room_date.cus_id, room_date.check_in, room_date.check_out FROM room INNER JOIN room_date ON room.room_no = room_date.room_no AND room_type = troom$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(12121, 'swaraj', '123'),
(12133, 'james', 'bond'),
(12134, 'swaraj', 'rath'),
(12135, 'sachin', '456');

-- --------------------------------------------------------

--
-- Table structure for table `bill_generate`
--

CREATE TABLE `bill_generate` (
  `bill_no` int(11) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `adult` int(3) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_price` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_generate`
--

INSERT INTO `bill_generate` (`bill_no`, `customer_id`, `customer_name`, `adult`, `check_in`, `check_out`, `total_price`) VALUES
(2, 40, 'Mr.  Gulal  Tiger', 2, '2019-06-19', '2019-06-20', 2300),
(3, 58, 'Mr.  DRIF  Medq', 1, '2019-07-20', '2019-07-31', 546480000),
(8, 9, 'Mr.  Aditya  Shelar', 10, '2019-06-07', '2019-06-09', 3450),
(9, 68, 'Mr.  amine  drif', 1, '2019-06-20', '2019-06-28', 9200);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `title` varchar(10) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `room_type` varchar(20) NOT NULL,
  `adult` int(3) NOT NULL,
  `children` int(3) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival_time` time NOT NULL,
  `status` varchar(20) NOT NULL,
  `room_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `title`, `first_name`, `last_name`, `email`, `nationality`, `phone`, `room_type`, `adult`, `children`, `check_in`, `check_out`, `arrival_time`, `status`, `room_no`) VALUES
(8, 'Dr.', 'Jerrad', 'Piuque', 'abcd@gmail.com', 'spain', '121232434', 'Orchid Suite', 2, 0, '2019-06-18', '2019-06-22', '15:00:00', 'Confirm', 0),
(9, 'Mr.', 'Aditya', 'Shelar', 'djsod@kjnansoa.com', 'Indian', '12132323', 'Club Room', 10, 10, '2019-06-07', '2019-06-09', '09:00:00', 'Checked Out', 401),
(40, 'Mr.', 'Gulal', 'Tiger', 'swarajrath007@gmail.com', 'German', '65531384', 'Orchid Suite', 2, 1, '2019-06-19', '2019-06-20', '16:00:00', 'Checked Out', 10),
(54, 'Mr.', 'Brad', 'Pitt', 'bpitt@gmail.com', 'Swedish', '856914752', 'Club Room', 2, 1, '2019-06-08', '2019-06-11', '03:00:00', 'Checked Out', 402),
(55, 'Mr.', 'Ray', 'Ban', 'gulo@gmail.com', 'ksdnljbk', '8934312', 'Deluxe Room', 2, 0, '2019-06-19', '2019-06-22', '01:00:00', 'Checked Out', 103),
(56, 'Mr.', 'Ferrari', 'F360', 'f@gmail.com', 'German', '74586321', 'Deluxe Room', 2, 1, '2019-06-12', '2019-06-15', '03:00:00', 'Checked Out', 103),
(58, 'Mr.', 'DRIF', 'Medq', 'ofemwf@ghht', 'feowpmf', '2548', 'Deluxe Room', 1, 0, '2019-07-20', '2019-07-31', '00:00:00', 'Checked Out', 103),
(59, 'Mrs.', 'Gabrial', 'Stallon', 'gb@gmail.com', 'German', '122334455667', 'Deluxe Room', 2, 0, '2019-06-13', '2019-06-17', '01:00:00', 'Checked In', 102),
(60, 'Mr.', 'Spiderman', 'Parkar', 'gulal009@gmail.com', 'Indian', '231654987', 'Club Room', 2, 1, '2019-06-17', '2019-06-21', '03:00:00', 'Checked In', 403),
(62, 'Mr.', 'Amal', 'Nato', 'amalanto123@gmail.com', 'Indian', '64984651', 'Orchid Suite', 1, 0, '2019-06-17', '2019-06-20', '01:00:00', 'Confirm', 301),
(63, 'Mr.', 'SUperman', 'Hello', 'gulal009@gmail.com', 'USa', '987654321', 'Orchid Suite', 2, 0, '2019-06-25', '2019-06-28', '03:00:00', 'Confirm', 303),
(64, 'Mr.', 'Chris', 'Hemsworth', 'gulal009@gmail.com', 'USA', '987654321', 'Premier Room', 2, 0, '2019-06-18', '2019-06-21', '00:00:00', 'Confirm', 203),
(65, 'Dr.', 'Stephan', 'Strange', 'gulal009@gmail.com', 'Canada', '159753654', 'Club Room', 2, 0, '2019-06-18', '2019-06-20', '15:00:00', 'Confirm', 401),
(68, 'Mr.', 'amine', 'drif', 'med.amine@outlook.de', 'moroccan', '0175258', 'Premier Room', 1, 0, '2019-06-20', '2019-06-28', '15:30:00', 'Checked Out', 203),
(69, 'Mr.', 'Captain', 'America', 'capamerica@gmail.com', 'America', '654321987898', 'Orchid Suite', 1, 0, '2019-08-27', '2019-09-05', '01:00:00', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `startdate` date NOT NULL,
  `salary` varchar(20) NOT NULL,
  `emptype` varchar(30) NOT NULL,
  `resigndate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `fullname`, `address`, `phone`, `startdate`, `salary`, `emptype`, `resigndate`) VALUES
(12121, 'Swaraj Rath', 'Carl Zuchmayer', '1213243546565', '2019-01-17', '75000', 'Manager', '0000-00-00'),
(12123, 'Gabrial', 'Mannheim', '987654321', '2017-04-26', '20000', 'clener', '0000-00-00'),
(12129, 'Sherlock Holmes', '221B Baker Street', '68461631649', '2016-12-11', '30000', 'CEO', '0000-00-00'),
(12130, 'Rabbit', '221B Baker Street, London, 768595', '78745592', '2019-06-03', '30000$', 'Customer Service', '0000-00-00'),
(12131, 'Tru Note ', 'India', '74125896325', '2019-06-07', '100000', 'Manager', '2019-06-22'),
(12133, 'James Bond 007', 'MI6, London, World, 41586', '987654321', '2019-06-20', '60000', 'Admin', '0000-00-00'),
(12134, 'Swaraj Rath', 'London, Europe', '7873868803', '2019-06-11', '20000', 'Admin', '0000-00-00'),
(12135, 'sachin Patil', 'Am Stergarten', '09049033460', '2019-06-12', '40000', 'Admin', '0000-00-00'),
(12138, 'rushi patil', 'dfgus', '45646', '2019-06-12', '45000', 'ADMIN', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_no` int(10) NOT NULL,
  `room_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_no`, `room_type`) VALUES
(101, 'Deluxe Room'),
(102, 'Deluxe Room'),
(103, 'Deluxe Room'),
(104, 'Deluxe Room'),
(105, 'Deluxe Room'),
(201, 'Premier Room'),
(202, 'Premier Room'),
(203, 'Premier Room'),
(204, 'Premier Room'),
(301, 'Orchid Suite'),
(302, 'Orchid Suite'),
(303, 'Orchid Suite'),
(304, 'Orchid Suite'),
(401, 'Club Room'),
(402, 'Club Room'),
(403, 'Club Room'),
(404, 'Club Room');

-- --------------------------------------------------------

--
-- Table structure for table `room_date`
--

CREATE TABLE `room_date` (
  `room_no` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `cus_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_date`
--

INSERT INTO `room_date` (`room_no`, `check_in`, `check_out`, `cus_id`) VALUES
(102, '2019-06-13', '2019-06-17', 59),
(402, '2019-06-11', '2019-06-19', 53),
(402, '2019-06-11', '2019-06-19', 53),
(302, '2019-06-19', '2019-06-28', 60),
(403, '2019-06-17', '2019-06-21', 0),
(301, '2019-06-17', '2019-06-20', 62),
(303, '2019-06-25', '2019-06-28', 63),
(202, '2019-06-18', '2019-06-21', 64),
(401, '2019-06-18', '2019-06-20', 65),
(203, '2019-06-18', '2019-06-21', 64);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_generate`
--
ALTER TABLE `bill_generate`
  ADD PRIMARY KEY (`bill_no`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_no`);

--
-- Indexes for table `room_date`
--
ALTER TABLE `room_date`
  ADD KEY `room_no` (`room_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12136;

--
-- AUTO_INCREMENT for table `bill_generate`
--
ALTER TABLE `bill_generate`
  MODIFY `bill_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12139;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `room_date`
--
ALTER TABLE `room_date`
  ADD CONSTRAINT `room_date_ibfk_1` FOREIGN KEY (`room_no`) REFERENCES `room` (`room_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
