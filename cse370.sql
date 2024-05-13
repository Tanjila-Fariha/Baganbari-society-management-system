-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 01:35 PM
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
-- Database: `cse370`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartment_a1`
--

CREATE TABLE `apartment_a1` (
  `Flat_ID` varchar(10) NOT NULL,
  `Floor_no` int(2) NOT NULL,
  `Flat_no` int(3) NOT NULL,
  `Building_no` int(3) NOT NULL,
  `otp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartment_a1`
--

INSERT INTO `apartment_a1` (`Flat_ID`, `Floor_no`, `Flat_no`, `Building_no`, `otp`) VALUES
('F1', 1, 2, 3, 'BSM'),
('F100', 8, 100, 6, 'BSM'),
('F2', 1, 2, 5, 'BSM'),
('F200', 1, 2, 1, 'BSM'),
('F3', 3, 4, 7, 'BSM'),
('F4', 7, 8, 8, 'BSM'),
('F5', 10, 11, 10, 'Fgh'),
('F6', 8, 9, 11, 'Far');

-- --------------------------------------------------------

--
-- Table structure for table `apartment_a2`
--

CREATE TABLE `apartment_a2` (
  `Building_no` int(3) NOT NULL,
  `Road_no` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartment_a2`
--

INSERT INTO `apartment_a2` (`Building_no`, `Road_no`) VALUES
(1, 2),
(3, 4),
(5, 6),
(6, 6),
(7, 8),
(8, 9),
(10, 11),
(11, 12);

-- --------------------------------------------------------

--
-- Table structure for table `apartment_a3`
--

CREATE TABLE `apartment_a3` (
  `Building_no` int(3) NOT NULL,
  `Building_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartment_a3`
--

INSERT INTO `apartment_a3` (`Building_no`, `Building_name`) VALUES
(1, 'Jahanara Garden'),
(3, 'Shoikat Misha'),
(5, 'Sunset Villa'),
(6, 'Baganbari Tower'),
(7, 'Enchanted Cottage'),
(8, 'Serene Haven'),
(10, 'Nakshi Garden'),
(11, 'RSA Tower');

-- --------------------------------------------------------

--
-- Table structure for table `flat_owner`
--

CREATE TABLE `flat_owner` (
  `O_Resident_ID` varchar(10) NOT NULL,
  `Owner_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flat_owner`
--

INSERT INTO `flat_owner` (`O_Resident_ID`, `Owner_ID`) VALUES
('R100', 'O100'),
('R200', 'O200');

-- --------------------------------------------------------

--
-- Table structure for table `maintainence_request`
--

CREATE TABLE `maintainence_request` (
  `Request_ID` int(5) NOT NULL,
  `Resident_ID` varchar(10) NOT NULL,
  `Flat_ID` varchar(10) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Request_description` text NOT NULL,
  `Required_role` text NOT NULL,
  `a_staff_id` varchar(10) DEFAULT NULL,
  `s_contact` int(14) DEFAULT NULL,
  `Wage` int(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintainence_request`
--

INSERT INTO `maintainence_request` (`Request_ID`, `Resident_ID`, `Flat_ID`, `Status`, `Request_description`, `Required_role`, `a_staff_id`, `s_contact`, `Wage`) VALUES
(100, 'R100', 'F100', 0, 'Water Tap broken', 'Utility Technician', NULL, NULL, 120),
(200, 'R100', 'F100', 1, 'Water Tap broken', 'Plumber', 'S200', 1945344268, 120);

-- --------------------------------------------------------

--
-- Table structure for table `owns`
--

CREATE TABLE `owns` (
  `O_Flat_ID` varchar(10) NOT NULL,
  `O_Resident_ID` varchar(10) NOT NULL,
  `O_Owner_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owns`
--

INSERT INTO `owns` (`O_Flat_ID`, `O_Resident_ID`, `O_Owner_ID`) VALUES
('F100', 'R100', 'O100'),
('F2', 'R100', 'O100'),
('F4', 'R200', 'O200'),
('F5', 'R100', 'O100');

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `Resident_ID` varchar(10) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Name` text NOT NULL,
  `Contact_num` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`Resident_ID`, `Password`, `Name`, `Contact_num`) VALUES
('R100', 'Far', 'Tanjila', 1234),
('R200', 'Far', 'Fariha', 1945344268),
('R400', 'JaniNa', 'Shafin Khadem', 1945344268);

-- --------------------------------------------------------

--
-- Table structure for table `resident_notification`
--

CREATE TABLE `resident_notification` (
  `Resident_ID` varchar(10) NOT NULL,
  `notification` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident_notification`
--

INSERT INTO `resident_notification` (`Resident_ID`, `notification`) VALUES
('R400', 'Notice from R100:Rent will change to  from .'),
('R400', 'Notice from R100:Rent will change to 12 from 2024-01.'),
('R400', 'Notice from R100:Rent will change to 1234 from 2024-01.'),
('R400', 'Notice: Rent will change to 123 from January.');

-- --------------------------------------------------------

--
-- Table structure for table `sellsorrents`
--

CREATE TABLE `sellsorrents` (
  `S_Owner_ID` varchar(10) NOT NULL,
  `S_Flat_ID` varchar(10) NOT NULL,
  `O_Resident_ID` varchar(10) NOT NULL,
  `Cost` int(10) NOT NULL,
  `rent_or_sell` varchar(20) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellsorrents`
--

INSERT INTO `sellsorrents` (`S_Owner_ID`, `S_Flat_ID`, `O_Resident_ID`, `Cost`, `rent_or_sell`, `Description`) VALUES
('O200', 'F4', 'R200', 123, 'Rent', '1200 sqft');

-- --------------------------------------------------------

--
-- Table structure for table `service_and_utility_staff`
--

CREATE TABLE `service_and_utility_staff` (
  `Staff_ID` varchar(10) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Name` text NOT NULL,
  `Role` text NOT NULL,
  `Contact_num` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_and_utility_staff`
--

INSERT INTO `service_and_utility_staff` (`Staff_ID`, `Password`, `Name`, `Role`, `Contact_num`) VALUES
('S200', 'Far', 'Moinul', 'Plumber', 1945344268);

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `T_Resident_ID` varchar(10) NOT NULL,
  `Tenant_ID` varchar(10) NOT NULL,
  `T_Owner_ID` varchar(10) NOT NULL,
  `T_Flat_ID` varchar(10) NOT NULL,
  `O_Resident_ID` varchar(10) NOT NULL,
  `Rent_from` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`T_Resident_ID`, `Tenant_ID`, `T_Owner_ID`, `T_Flat_ID`, `O_Resident_ID`, `Rent_from`) VALUES
('R400', 'T100', 'O100', 'F2', 'R100', 'December');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartment_a1`
--
ALTER TABLE `apartment_a1`
  ADD PRIMARY KEY (`Flat_ID`),
  ADD KEY `Building_no` (`Building_no`);

--
-- Indexes for table `apartment_a2`
--
ALTER TABLE `apartment_a2`
  ADD PRIMARY KEY (`Building_no`);

--
-- Indexes for table `apartment_a3`
--
ALTER TABLE `apartment_a3`
  ADD PRIMARY KEY (`Building_no`);

--
-- Indexes for table `flat_owner`
--
ALTER TABLE `flat_owner`
  ADD PRIMARY KEY (`O_Resident_ID`,`Owner_ID`),
  ADD KEY `Owner_ID` (`Owner_ID`);

--
-- Indexes for table `maintainence_request`
--
ALTER TABLE `maintainence_request`
  ADD PRIMARY KEY (`Request_ID`),
  ADD KEY `Flat_ID` (`Flat_ID`),
  ADD KEY `Resident_ID` (`Resident_ID`),
  ADD KEY `a_staff_id` (`a_staff_id`);

--
-- Indexes for table `owns`
--
ALTER TABLE `owns`
  ADD PRIMARY KEY (`O_Flat_ID`,`O_Resident_ID`,`O_Owner_ID`),
  ADD KEY `O_Resident_ID` (`O_Resident_ID`),
  ADD KEY `O_Owner_ID` (`O_Owner_ID`);

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`Resident_ID`);

--
-- Indexes for table `resident_notification`
--
ALTER TABLE `resident_notification`
  ADD PRIMARY KEY (`Resident_ID`,`notification`);

--
-- Indexes for table `sellsorrents`
--
ALTER TABLE `sellsorrents`
  ADD PRIMARY KEY (`S_Owner_ID`,`S_Flat_ID`,`O_Resident_ID`),
  ADD KEY `S_Flat_ID` (`S_Flat_ID`),
  ADD KEY `O_Resident_ID` (`O_Resident_ID`);

--
-- Indexes for table `service_and_utility_staff`
--
ALTER TABLE `service_and_utility_staff`
  ADD PRIMARY KEY (`Staff_ID`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`T_Resident_ID`,`Tenant_ID`,`T_Owner_ID`,`T_Flat_ID`,`O_Resident_ID`),
  ADD KEY `T_Owner_ID` (`T_Owner_ID`),
  ADD KEY `T_Flat_ID` (`T_Flat_ID`),
  ADD KEY `O_Resident_ID` (`O_Resident_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartment_a1`
--
ALTER TABLE `apartment_a1`
  ADD CONSTRAINT `apartment_a1_ibfk_1` FOREIGN KEY (`Building_no`) REFERENCES `apartment_a2` (`Building_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `apartment_a3`
--
ALTER TABLE `apartment_a3`
  ADD CONSTRAINT `apartment_a3_ibfk_1` FOREIGN KEY (`Building_no`) REFERENCES `apartment_a2` (`Building_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flat_owner`
--
ALTER TABLE `flat_owner`
  ADD CONSTRAINT `flat_owner_ibfk_1` FOREIGN KEY (`O_Resident_ID`) REFERENCES `resident` (`Resident_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintainence_request`
--
ALTER TABLE `maintainence_request`
  ADD CONSTRAINT `maintainence_request_ibfk_1` FOREIGN KEY (`Flat_ID`) REFERENCES `apartment_a1` (`Flat_ID`),
  ADD CONSTRAINT `maintainence_request_ibfk_2` FOREIGN KEY (`Resident_ID`) REFERENCES `resident` (`Resident_ID`),
  ADD CONSTRAINT `maintainence_request_ibfk_3` FOREIGN KEY (`a_staff_id`) REFERENCES `service_and_utility_staff` (`Staff_ID`);

--
-- Constraints for table `owns`
--
ALTER TABLE `owns`
  ADD CONSTRAINT `owns_ibfk_1` FOREIGN KEY (`O_Flat_ID`) REFERENCES `apartment_a1` (`Flat_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_2` FOREIGN KEY (`O_Resident_ID`) REFERENCES `flat_owner` (`O_Resident_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_3` FOREIGN KEY (`O_Owner_ID`) REFERENCES `flat_owner` (`Owner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resident_notification`
--
ALTER TABLE `resident_notification`
  ADD CONSTRAINT `resident_notification_ibfk_1` FOREIGN KEY (`Resident_ID`) REFERENCES `resident` (`Resident_ID`);

--
-- Constraints for table `sellsorrents`
--
ALTER TABLE `sellsorrents`
  ADD CONSTRAINT `sellsorrents_ibfk_1` FOREIGN KEY (`S_Owner_ID`) REFERENCES `flat_owner` (`Owner_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellsorrents_ibfk_2` FOREIGN KEY (`S_Flat_ID`) REFERENCES `apartment_a1` (`Flat_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellsorrents_ibfk_3` FOREIGN KEY (`O_Resident_ID`) REFERENCES `flat_owner` (`O_Resident_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenant`
--
ALTER TABLE `tenant`
  ADD CONSTRAINT `tenant_ibfk_1` FOREIGN KEY (`T_Resident_ID`) REFERENCES `resident` (`Resident_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tenant_ibfk_2` FOREIGN KEY (`T_Owner_ID`) REFERENCES `flat_owner` (`Owner_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tenant_ibfk_3` FOREIGN KEY (`T_Flat_ID`) REFERENCES `apartment_a1` (`Flat_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tenant_ibfk_4` FOREIGN KEY (`O_Resident_ID`) REFERENCES `flat_owner` (`O_Resident_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
