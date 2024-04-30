-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 03:29 PM
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
-- Database: `cattle_trade_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals_available`
--

CREATE TABLE `animals_available` (
  `animal_id` int(11) NOT NULL,
  `animal_name` varchar(255) NOT NULL,
  `quantity_available` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animals_available`
--

INSERT INTO `animals_available` (`animal_id`, `animal_name`, `quantity_available`) VALUES
(1, 'sine', '3436'),
(3, 'igaju', '200000');

-- --------------------------------------------------------

--
-- Table structure for table `cattle`
--

CREATE TABLE `cattle` (
  `CattleID` int(11) NOT NULL,
  `FarmerID` int(11) DEFAULT NULL,
  `Breed` varchar(255) DEFAULT NULL,
  `Age` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cattle`
--

INSERT INTO `cattle` (`CattleID`, `FarmerID`, `Breed`, `Age`) VALUES
(1, 1, 'rrtgu', '5'),
(2, 2, 'kjhgyf', '3'),
(4, 8, 'ekjk', '2');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Contact` varchar(11) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `Name`, `Contact`, `Address`) VALUES
(1, 'bugen', '078989886', 'musanze'),
(2, 'herman', '072324444', 'kageyo');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `FarmerID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Contact` varchar(15) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`FarmerID`, `Name`, `Contact`, `Address`) VALUES
(1, 'muneza', '07887888', 'butare'),
(2, 'eric', '073233355', 'kayonza'),
(4, 'divine', '078989898', 'london'),
(5, 'jacky', '0785556667', 'remera'),
(6, 'vvghjk', 'iuytr', 'remkjh'),
(7, 'byung', '072323232', 'kibeho'),
(8, 'dfg', '07898', 'kigali'),
(9, 'byung', '072323232', 'kibeho'),
(10, 'byung', '072323232', 'kibeho');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_id` int(11) NOT NULL,
  `TransactionID` int(11) DEFAULT NULL,
  `Payment_method` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_id`, `TransactionID`, `Payment_method`) VALUES
(1, 1, 'momo'),
(2, 2, 'BK');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `TransactionID` int(11) NOT NULL,
  `CattleID` int(11) DEFAULT NULL,
  `TransactionType` varchar(255) DEFAULT NULL,
  `Price` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`TransactionID`, `CattleID`, `TransactionType`, `Price`) VALUES
(1, 2, 'kiuygf', '555'),
(2, 1, 'selling', '70M'),
(3, 4, 'purchasing ', '100k');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'umutesi', 'naome', 'mutesi5', 'naomeumutesi@gmail.com', '0785556664', '$2y$10$pfb4kocDKGjRakrhjf00UOYkDcbXcsUqfkfMQSMGLvjqwMXjchti2', '2024-04-25 12:21:40', '23456', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals_available`
--
ALTER TABLE `animals_available`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `cattle`
--
ALTER TABLE `cattle`
  ADD PRIMARY KEY (`CattleID`),
  ADD KEY `FarmerID` (`FarmerID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`FarmerID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_id`),
  ADD KEY `TransactionID` (`TransactionID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `CattleID` (`CattleID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals_available`
--
ALTER TABLE `animals_available`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cattle`
--
ALTER TABLE `cattle`
  MODIFY `CattleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `FarmerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cattle`
--
ALTER TABLE `cattle`
  ADD CONSTRAINT `cattle_ibfk_1` FOREIGN KEY (`FarmerID`) REFERENCES `farmer` (`FarmerID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`TransactionID`) REFERENCES `transaction` (`TransactionID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`CattleID`) REFERENCES `cattle` (`CattleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
