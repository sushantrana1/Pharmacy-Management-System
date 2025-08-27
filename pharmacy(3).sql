-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2025 at 09:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `C_ID` int(11) NOT NULL,
  `C_Fname` varchar(50) DEFAULT NULL,
  `C_Lname` varchar(50) DEFAULT NULL,
  `C_Sex` varchar(10) DEFAULT NULL,
  `C_Age` int(11) DEFAULT NULL,
  `C_Phno` varchar(15) DEFAULT NULL,
  `C_Mail` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`C_ID`, `C_Fname`, `C_Lname`, `C_Sex`, `C_Age`, `C_Phno`, `C_Mail`) VALUES
(1, 'Ramita', 'Rana', 'F', 32, '9812345678', 'ram@mail.com'),
(2, 'Rita', 'Nepali', 'F', 29, '9811132211', 'rita@pms.com'),
(6, 'Rohit ', 'Bohara', 'Male', 20, '9836637367', 'rohit@gmail.com'),
(7, 'Sameer ', 'Pant', 'Male', 24, '982763892', 'sameer@gmail.com'),
(10, 'Ramesh', 'Thapa', 'M', 30, '9800001234', 'ramesh@test.com'),
(13, 'Heram', 'Pant', 'Male', 22, '93873863862', 'hra@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `E_ID` int(11) NOT NULL,
  `E_Fname` varchar(50) DEFAULT NULL,
  `E_Lname` varchar(50) DEFAULT NULL,
  `E_Sex` varchar(10) DEFAULT NULL,
  `Bdate` date DEFAULT NULL,
  `E_Age` int(11) DEFAULT NULL,
  `E_Type` varchar(50) DEFAULT NULL,
  `E_Sal` decimal(10,2) DEFAULT NULL,
  `E_Phno` varchar(15) DEFAULT NULL,
  `E_date` date DEFAULT NULL,
  `E_Mail` varchar(100) DEFAULT NULL,
  `E_Add` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`E_ID`, `E_Fname`, `E_Lname`, `E_Sex`, `Bdate`, `E_Age`, `E_Type`, `E_Sal`, `E_Phno`, `E_date`, `E_Mail`, `E_Add`) VALUES
(1, 'Sushant', 'Rana', 'M', '2000-01-01', 25, 'pharmacist', 30000.00, '9800000000', '2025-08-03', 'sushant@pms.com', 'Dhangadhi'),
(2, 'Ranjit', 'Pant', 'M', '1999-05-10', 28, 'Pharmacist', 25000.00, '9811111111', '2025-08-03', 'sameer@pms.com', 'Doti'),
(3, 'Paras', 'Rana', 'Male', '2000-02-02', 21, 'pharmacist', 25000.00, '9924872698', '2022-02-01', 'paras@gmail.com', 'Geta'),
(4, 'Suresh ', 'Rana', 'Male', '2000-02-03', 26, 'pharmacist', 20000.00, '9838232221', '2025-02-01', 'suresh@gmail.com', 'Pipladi');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `Med_ID` int(11) NOT NULL,
  `Med_Name` varchar(100) NOT NULL,
  `Med_Qty` int(11) NOT NULL,
  `Med_Price` decimal(10,2) NOT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Location_Rack` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`Med_ID`, `Med_Name`, `Med_Qty`, `Med_Price`, `Category`, `Location_Rack`) VALUES
(1, 'Paracetamol', 8646, 20.00, 'Painkiller', 'Rack A'),
(10, 'Ibuprofen', 4191, 15.00, 'Painkiller', 'Rack B'),
(15, 'Soothex', 324, 140.00, 'Syrup', 'Rack D'),
(17, 'Neems', 40442, 5.00, 'Tablet', 'Rack F'),
(20, 'Atenolol', 4995, 120.00, 'Syrup', 'Rack G'),
(23, 'Amlodipine', 3497, 200.00, 'Syrup', 'Rack D');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `P_ID` int(11) NOT NULL,
  `Med_ID` int(11) NOT NULL,
  `Sup_ID` int(11) NOT NULL,
  `P_Qty` int(11) NOT NULL,
  `P_Cost` decimal(10,2) NOT NULL,
  `Mfg_Date` date DEFAULT NULL,
  `Exp_Date` date DEFAULT NULL,
  `Pur_Date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`P_ID`, `Med_ID`, `Sup_ID`, `P_Qty`, `P_Cost`, `Mfg_Date`, `Exp_Date`, `Pur_Date`) VALUES
(1, 15, 3, 500, 140.00, '2024-02-02', '2035-02-02', '2025-07-26'),
(2, 13, 4, 1000, 10.00, '2023-05-05', '2033-05-05', '2025-07-26'),
(4, 1, 5, 10000, 10.00, '2024-05-07', '2029-05-07', '2025-08-03'),
(5, 17, 4, 40000, 5.00, '2020-09-05', '2027-08-05', '2025-08-03'),
(6, 10, 5, 300, 65.00, '2002-04-05', '2006-04-06', '2025-08-20'),
(7, 10, 4, 4000, 10.00, '2002-03-04', '2006-03-04', '2025-08-22'),
(8, 23, 4, 1000, 200.00, '2002-01-03', '2006-02-04', '2025-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `Sale_ID` int(11) NOT NULL,
  `C_ID` int(11) DEFAULT NULL,
  `S_Date` date DEFAULT NULL,
  `S_Time` time DEFAULT NULL,
  `Total_Amount` decimal(10,2) DEFAULT NULL,
  `Payment_Method` varchar(50) DEFAULT 'Cash',
  `Payment_Status` varchar(20) DEFAULT 'Pending',
  `Payment_Date` date DEFAULT NULL,
  `Payment_Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`Sale_ID`, `C_ID`, `S_Date`, `S_Time`, `Total_Amount`, `Payment_Method`, `Payment_Status`, `Payment_Date`, `Payment_Time`) VALUES
(113, 2, '2025-08-24', '17:58:04', 225.00, 'Cash', 'Pending', NULL, NULL),
(114, 2, '2025-08-24', '17:58:47', 225.00, 'Cash', 'Pending', NULL, NULL),
(115, 1, '2025-08-24', '18:09:55', 2660.00, 'Cash', 'Pending', NULL, NULL),
(116, 1, '2025-08-24', '18:10:33', 5320.00, 'Cash', 'Pending', NULL, NULL),
(117, 6, '2025-08-24', '18:12:21', 15.00, 'Cash', 'Pending', NULL, NULL),
(118, 10, '2025-08-24', '18:44:15', 150.00, 'Cash', 'Pending', NULL, NULL),
(119, 7, '2025-08-24', '18:51:36', 1350.00, 'Cash', 'Pending', NULL, NULL),
(120, 7, '2025-08-25', '13:51:34', 45.00, 'Cash', 'Pending', NULL, NULL),
(121, 2, '2025-08-25', '13:56:25', 225.00, 'Cash', 'Pending', NULL, NULL),
(122, 2, '2025-08-26', '12:34:08', 50.00, 'Cash', 'Pending', NULL, NULL),
(123, 10, '2025-08-26', '20:39:17', 30.00, 'Cash', 'Pending', NULL, NULL),
(124, 13, '2025-08-26', '20:40:54', 600.00, 'Cash', 'Pending', NULL, NULL),
(125, 13, '2025-08-26', '20:42:44', 500.00, 'Cash', 'Pending', NULL, NULL),
(126, 6, '2025-08-26', '20:44:58', 600.00, 'Cash', 'Pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `Item_ID` int(11) NOT NULL,
  `Sale_ID` int(11) DEFAULT NULL,
  `Med_ID` int(11) DEFAULT NULL,
  `Sale_Qty` int(11) DEFAULT NULL,
  `Tot_Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_items`
--

INSERT INTO `sales_items` (`Item_ID`, `Sale_ID`, `Med_ID`, `Sale_Qty`, `Tot_Price`) VALUES
(100, 100, 10, 5, 75.00),
(103, 101, 1, 2, 40.00),
(104, 102, 15, 12, 1680.00),
(105, 103, 17, 7, 35.00),
(106, 104, 10, 20, 300.00),
(107, 105, 17, 35, 175.00),
(108, 106, 15, 5, 700.00),
(109, 107, 10, 19, 285.00),
(110, 108, 1, 5, 100.00),
(111, 109, 1, 20, 400.00),
(112, 110, 15, 4, 560.00),
(113, 111, 10, 15, 225.00),
(114, 112, 15, 1, 140.00),
(115, 113, 10, 15, 225.00),
(116, 114, 10, 15, 225.00),
(117, 115, 15, 19, 2660.00),
(118, 116, 15, 19, 2660.00),
(119, 116, 15, 19, 2660.00),
(120, 117, 10, 1, 15.00),
(121, 118, 10, 10, 150.00),
(122, 119, 10, 90, 1350.00),
(123, 120, 10, 3, 45.00),
(124, 121, 10, 15, 225.00),
(125, 122, 17, 10, 50.00),
(126, 123, 10, 2, 30.00),
(127, 124, 23, 3, 600.00),
(128, 125, 17, 100, 500.00),
(129, 126, 20, 5, 600.00);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `Sup_ID` int(11) NOT NULL,
  `Sup_Name` varchar(100) DEFAULT NULL,
  `Sup_Add` varchar(200) DEFAULT NULL,
  `Sup_Mail` varchar(100) DEFAULT NULL,
  `Sup_Phno` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`Sup_ID`, `Sup_Name`, `Sup_Add`, `Sup_Mail`, `Sup_Phno`) VALUES
(3, 'Ajit Sijapati', 'Pokhara', 'ajit@gmail.com', '9348932984'),
(4, 'Hemant Bhatta', 'Dhangadhi', 'hemant@gmail.com', '9742972499'),
(5, 'Abishke Rana', 'Daijee', 'abishek@gmail.com', '827982692');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','pharmacist') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(5, 'Admin User', 'adminmaster@gmail.com', 'admin123', 'admin'),
(6, 'Pharma User', 'pharmamaster@gmail.com', 'pharma123', 'pharmacist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`C_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`E_ID`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`Med_ID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`P_ID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`Sale_ID`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`Item_ID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`Sup_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `E_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `Med_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `P_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `Sale_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `Sup_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
