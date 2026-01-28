-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2026 at 05:59 PM
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
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `alert_id` int(11) NOT NULL,
  `alert_type` enum('low_stock','expiry') NOT NULL,
  `Med_ID` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `alert_date` datetime DEFAULT current_timestamp(),
  `status` enum('active','dismissed') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`alert_id`, `alert_type`, `Med_ID`, `message`, `alert_date`, `status`) VALUES
(16, 'expiry', 2, 'Expiring soon: Amoxicillin on 2026-02-05', '2026-01-28 11:17:39', 'dismissed'),
(17, 'expiry', 11, 'Expiring soon: Vitamin D3 on 2026-01-30', '2026-01-28 11:17:39', 'dismissed'),
(18, 'low_stock', 1, 'Low stock: Paracetamol (Only 5 left)', '2026-01-28 11:41:06', 'dismissed'),
(19, 'low_stock', 24, 'Low stock: Hydrocortisone (Only 0 left)', '2026-01-28 11:45:37', 'dismissed'),
(20, 'expiry', 24, '⚠️ URGENT: Hydrocortisone expires on 2026-01-30 (1 days left)', '2026-01-28 11:47:01', 'dismissed'),
(21, 'expiry', 24, '⚠️ URGENT: Hydrocortisone expires on 2026-01-30 (1 days left)', '2026-01-28 11:49:15', 'dismissed'),
(22, 'expiry', 24, '⚠️ URGENT: Hydrocortisone expires on 2026-01-30 (1 days left)', '2026-01-28 11:49:18', 'dismissed'),
(23, 'expiry', 24, '⚠️ URGENT: Hydrocortisone expires on 2026-01-30 (1 days left)', '2026-01-28 11:49:50', 'dismissed'),
(24, 'low_stock', 15, 'Low stock: Insulin Regular (Only 0 left)', '2026-01-28 12:12:44', 'dismissed'),
(25, 'low_stock', 23, 'Low stock: Ofloxacin (Only 0 left)', '2026-01-28 12:19:15', 'active'),
(26, 'expiry', 24, 'U: Hydrocortisone expires on 2026-01-30 (1 days left)', '2026-01-28 12:16:26', 'dismissed'),
(27, 'expiry', 24, 'URGENT: Hydrocortisone expires on 2026-01-30 (1 days left)', '2026-01-28 12:19:15', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `alert_settings`
--

CREATE TABLE `alert_settings` (
  `id` int(11) NOT NULL,
  `low_stock_threshold` int(11) DEFAULT 10,
  `expiry_warning_days` int(11) DEFAULT 30,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alert_settings`
--

INSERT INTO `alert_settings` (`id`, `low_stock_threshold`, `expiry_warning_days`, `updated_at`) VALUES
(2, 10, 30, '2026-01-28 05:58:31');

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
(1, 'Suresh', 'Shrestha', 'M', 34, '9841234567', 'suresh.shrestha@gmail.com'),
(2, 'Asha', 'Thapa', 'F', 28, '9865432109', 'asha.thapa@yahoo.com'),
(3, 'Ramesh', 'Gurung', 'M', 45, '9809876543', 'ramesh.gurung@outlook.com'),
(4, 'Sunita', 'Tamang', 'F', 19, '9845678901', 'sunita.tamang@gmail.com'),
(5, 'Hari', 'Pokhrel', 'M', 52, '9861239876', 'hari.pokhrel@hotmail.com'),
(6, 'Gita', 'Rai', 'F', 37, '9804567890', 'gita.rai@gmail.com'),
(7, 'Bikash', 'Magar', 'M', 26, '9847891234', 'bikash.magar@yahoo.com'),
(8, 'Maya', 'Lama', 'F', 60, '9862345678', 'maya.lama@outlook.com'),
(9, 'Prakash', 'Adhikari', 'M', 41, '9803216547', 'prakash.adhikari@gmail.com'),
(10, 'Laxmi', 'Karki', 'F', 33, '9848765432', 'laxmi.karki@hotmail.com');

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
(4, 'Suresh ', 'Rana', 'Male', '2000-02-03', 26, 'pharmacist', 20000.00, '9838232221', '2025-02-01', 'suresh@gmail.com', 'Pipladi'),
(5, 'Ramesh', 'Shrestha', 'M', '1990-03-15', 35, 'Pharmacist', 60000.00, '9841234567', '2021-06-01', 'ramesh.shrestha@gmail.com', 'Thamel Marg, Kathmandu'),
(6, 'Sita', 'Thapa', 'F', '1995-07-22', 30, 'Cashier', 30000.00, '9865432109', '2022-01-15', 'sita.thapa@yahoo.com', 'New Baneshwor, Kathmandu'),
(7, 'Bikram', 'Gurung', 'M', '1992-11-10', 32, 'Manager', 80000.00, '9809876543', '2020-09-01', 'bikram.gurung@outlook.com', 'Lakeside Rd, Pokhara'),
(8, 'Anju', 'Tamang', 'F', '1998-04-05', 27, 'Technician', 40000.00, '9845678901', '2023-03-10', 'anju.tamang@gmail.com', 'Main Rd, Biratnagar'),
(9, 'Hari', 'Rai', 'M', '1987-09-18', 38, 'Pharmacist', 65000.00, '9861239876', '2021-11-20', 'hari.rai@hotmail.com', 'Adarsh Nagar, Birgunj'),
(10, 'Laxmi', 'Magar', 'F', '1996-02-25', 29, 'Cashier', 32000.00, '9804567890', '2022-07-15', 'laxmi.magar@gmail.com', 'Siddhartha Hwy, Bhairahawa');

-- --------------------------------------------------------

--
-- Table structure for table `expired_medicines`
--

CREATE TABLE `expired_medicines` (
  `Med_ID` int(11) NOT NULL DEFAULT 0,
  `Med_Name` varchar(100) NOT NULL,
  `Exp_Date` date DEFAULT NULL,
  `Batch_Qty` int(11) NOT NULL,
  `Purchase_ID` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expired_medicines`
--

INSERT INTO `expired_medicines` (`Med_ID`, `Med_Name`, `Exp_Date`, `Batch_Qty`, `Purchase_ID`) VALUES
(1, 'Paracetamol', '2005-01-01', 2500, 37),
(2, 'Ibuprofen', '2007-02-02', 3500, 38),
(3, 'Aspirin', '2012-03-03', 4500, 39),
(4, 'Amoxicillin', '2024-05-05', 5000, 40),
(37, 'Budesonide', '2025-03-05', 5463, 44),
(35, 'Ranitidine', '2025-05-22', 7652, 45);

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
  `Location_Rack` varchar(50) DEFAULT NULL,
  `expiry_date` date NOT NULL,
  `total_stock` int(11) DEFAULT 0,
  `remaining_stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`Med_ID`, `Med_Name`, `Med_Qty`, `Med_Price`, `Category`, `Location_Rack`, `expiry_date`, `total_stock`, `remaining_stock`) VALUES
(1, 'Paracetamol', 500, 10.00, 'Tablet', 'Rack A1', '0000-00-00', 0, 0),
(2, 'Amoxicillin', 600, 25.00, 'Capsule', 'Rack A1', '0000-00-00', 0, 0),
(3, 'Azithromycin', 1410, 35.00, 'Tablet', 'Rack A2', '0000-00-00', 0, 0),
(4, 'Ibuprofen', 730, 18.00, 'Tablet', 'Rack A2', '0000-00-00', 0, 0),
(5, 'Cetirizine', 2095, 12.00, 'Tablet', 'Rack A3', '0000-00-00', 0, 0),
(6, 'Omeprazole', 740, 22.00, 'Capsule', 'Rack A3', '0000-00-00', 0, 0),
(7, 'Salbutamol', 790, 120.00, 'Inhaler', 'Rack B1', '0000-00-00', 0, 0),
(8, 'Beclomethasone', 240, 150.00, 'Inhaler', 'Rack B1', '0000-00-00', 0, 0),
(9, 'Cough Syrup DX', 480, 65.00, 'Syrup', 'Rack B2', '0000-00-00', 0, 0),
(10, 'Iron Syrup', 390, 55.00, 'Syrup', 'Rack B2', '0000-00-00', 0, 0),
(11, 'Vitamin D3', 670, 30.00, 'Drops', 'Rack B3', '0000-00-00', 0, 0),
(12, 'Zinc Drops', 520, 28.00, 'Drops', 'Rack B3', '0000-00-00', 0, 0),
(13, 'Gentamicin', 210, 90.00, 'Injection', 'Rack C1', '0000-00-00', 0, 0),
(14, 'Ceftriaxone', 180, 140.00, 'Injection', 'Rack C1', '0000-00-00', 0, 0),
(15, 'Insulin Regular', 400, 250.00, 'Injection', 'Rack C2', '0000-00-00', 0, 0),
(16, 'Metformin', 800, 20.00, 'Tablet', 'Rack C2', '0000-00-00', 0, 0),
(17, 'Amlodipine', 760, 15.00, 'Tablet', 'Rack C3', '0000-00-00', 0, 0),
(18, 'Losartan', 690, 24.00, 'Tablet', 'Rack C3', '0000-00-00', 0, 0),
(19, 'Pantoprazole', 560, 26.00, 'Capsule', 'Rack D1', '0000-00-00', 0, 0),
(20, 'Doxycycline', 430, 32.00, 'Capsule', 'Rack D1', '0000-00-00', 0, 0),
(21, 'Montelukast', 350, 40.00, 'Tablet', 'Rack D2', '0000-00-00', 0, 0),
(22, 'Loratadine', 610, 14.00, 'Tablet', 'Rack D2', '0000-00-00', 0, 0),
(23, 'Ofloxacin', 0, 38.00, 'Tablet', 'Rack D3', '0000-00-00', 0, 0),
(24, 'Hydrocortisone', 895, 110.00, 'Injection', 'Rack D3', '0000-00-00', 0, 0),
(25, 'Nasal Saline', 520, 45.00, 'Drops', 'Rack D4', '0000-00-00', 0, 0);

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
(53, 1, 1, 500, 10.00, '2026-02-01', '2029-02-01', '2026-01-28'),
(54, 3, 2, 1000, 35.00, '2025-04-03', '2030-04-03', '2026-01-28'),
(55, 5, 3, 1200, 12.00, '2025-06-05', '2029-06-05', '2026-01-28'),
(56, 7, 4, 500, 120.00, '2024-05-01', '2026-05-01', '2026-01-28'),
(57, 6, 5, 200, 22.00, '2024-09-08', '2027-09-08', '2026-01-28'),
(59, 1, 11, 500, 10.00, '2026-06-02', '2027-04-04', '2026-01-28'),
(60, 24, 12, 500, 110.00, '2026-08-01', '2026-01-30', '2026-01-28'),
(61, 23, 2, 0, 38.00, '2024-05-02', '2024-03-04', '2026-01-28'),
(62, 24, 14, 200, 110.00, '2026-05-21', '2030-03-26', '2026-01-28'),
(63, 24, 12, 200, 110.00, '2026-03-02', '2029-03-02', '2026-01-28'),
(64, 15, 5, 400, 250.00, '2026-06-03', '2030-12-03', '2026-01-28');

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
(158, 1, '2026-01-28', '06:40:00', 13000.00, 'Cash', 'Pending', NULL, NULL),
(159, 3, '2026-01-28', '06:41:17', 450.00, 'Cash', 'Pending', NULL, NULL),
(160, 2, '2026-01-28', '07:09:25', 250.00, 'Cash', 'Pending', NULL, NULL),
(161, 4, '2026-01-28', '07:09:48', 3310.00, 'Cash', 'Pending', NULL, NULL),
(162, 6, '2026-01-28', '07:10:31', 1750.00, 'Cash', 'Pending', NULL, NULL),
(163, 8, '2026-01-28', '07:11:19', 50.00, 'Cash', 'Pending', NULL, NULL),
(164, 4, '2026-01-28', '07:12:11', 37500.00, 'Cash', 'Pending', NULL, NULL);

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
(165, 158, 1, 1300, 13000.00),
(166, 159, 1, 45, 450.00),
(167, 160, 2, 10, 250.00),
(168, 161, 2, 10, 250.00),
(169, 161, 8, 20, 3000.00),
(170, 161, 5, 5, 60.00),
(171, 162, 24, 5, 550.00),
(172, 162, 7, 10, 1200.00),
(173, 163, 1, 5, 50.00),
(174, 164, 15, 150, 37500.00);

-- --------------------------------------------------------

--
-- Table structure for table `stock_alerts`
--

CREATE TABLE `stock_alerts` (
  `alert_id` int(11) NOT NULL,
  `Med_ID` int(11) NOT NULL,
  `current_qty` int(11) NOT NULL,
  `threshold_qty` int(11) NOT NULL,
  `alert_date` datetime DEFAULT current_timestamp(),
  `status` enum('active','resolved') DEFAULT 'active',
  `resolved_by` int(11) DEFAULT NULL,
  `resolved_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_alerts`
--

INSERT INTO `stock_alerts` (`alert_id`, `Med_ID`, `current_qty`, `threshold_qty`, `alert_date`, `status`, `resolved_by`, `resolved_date`) VALUES
(32, 1, 5, 10, '2026-01-28 11:26:30', 'resolved', NULL, '2026-01-28 11:26:33'),
(33, 1, 5, 10, '2026-01-28 11:26:33', 'resolved', NULL, '2026-01-28 11:41:09'),
(34, 1, 5, 10, '2026-01-28 11:41:09', 'resolved', NULL, '2026-01-28 11:53:59'),
(35, 15, 0, 10, '2026-01-28 11:59:14', 'resolved', NULL, '2026-01-28 12:06:27'),
(36, 15, 0, 10, '2026-01-28 12:06:27', 'resolved', NULL, '2026-01-28 12:13:48'),
(37, 23, 0, 10, '2026-01-28 12:14:28', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_settings`
--

CREATE TABLE `stock_settings` (
  `id` int(11) NOT NULL,
  `threshold_qty` int(11) DEFAULT 10,
  `email_alerts` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_settings`
--

INSERT INTO `stock_settings` (`id`, `threshold_qty`, `email_alerts`, `updated_at`) VALUES
(1, 10, 0, '2026-01-26 06:59:40');

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
(1, 'Nepal MediCorp', 'Thamel Marg, Kathmandu', 'contact@nepalmedicorp.com', '01-5432101'),
(2, 'Himalaya Pharma', 'New Baneshwor, Kathmandu', 'sales@himalayapharma.com', '01-5432102'),
(3, 'Pokhara Health Supplies', 'Lakeside Rd, Pokhara', 'info@pokharahealth.com', '061-321001'),
(4, 'Birat Pharma Distributors', 'Main Rd, Biratnagar', 'support@biratpharma.com', '021-654321'),
(5, 'Everest Medical Co.', 'Koteshwor, Kathmandu', 'orders@everestmedical.com', '01-5432103'),
(6, 'Birgunj Pharma Solutions', 'Adarsh Nagar, Birgunj', 'service@birgunjpharma.com', '051-432101'),
(7, 'Bhairahawa Wellness', 'Siddhartha Hwy, Bhairahawa', 'info@bhairahawawellness.com', '071-321002'),
(8, 'Nepalgunj MediSupplies', 'Tribhuvan Chowk, Nepalgunj', 'contact@nepalgunjmedi.com', '081-543201'),
(9, 'Bharatpur Health Ltd.', 'Hospital Rd, Bharatpur', 'sales@bharatpurhealth.com', '056-654322'),
(10, 'Kathmandu Care Pharma', 'Bagbazar, Kathmandu', 'support@kathmanducare.com', '01-5432104'),
(11, 'Pokhara MediTrade', 'Chipledhunga, Pokhara', 'orders@pokharameditrade.com', '061-321003'),
(12, 'Biratnagar Vital Supplies', 'Traffic Chowk, Biratnagar', 'info@biratnagarvital.com', '021-654323'),
(13, 'Birgunj Cure Distributors', 'Maisthan, Birgunj', 'contact@birgunjcure.com', '051-432102'),
(14, 'Bhairahawa Pharma Hub', 'Buddha Chowk, Bhairahawa', 'sales@bhairahawapharma.com', '071-321004'),
(15, 'Nepalgunj Health Solutions', 'Surkhet Rd, Nepalgunj', 'service@nepalgunjhealth.com', '081-543202');

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
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`alert_id`),
  ADD KEY `Med_ID` (`Med_ID`);

--
-- Indexes for table `alert_settings`
--
ALTER TABLE `alert_settings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `stock_alerts`
--
ALTER TABLE `stock_alerts`
  ADD PRIMARY KEY (`alert_id`),
  ADD KEY `Med_ID` (`Med_ID`);

--
-- Indexes for table `stock_settings`
--
ALTER TABLE `stock_settings`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `alert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `alert_settings`
--
ALTER TABLE `alert_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `E_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `Med_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `P_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `Sale_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `stock_alerts`
--
ALTER TABLE `stock_alerts`
  MODIFY `alert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `stock_settings`
--
ALTER TABLE `stock_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `Sup_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT `alerts_ibfk_1` FOREIGN KEY (`Med_ID`) REFERENCES `medicine` (`Med_ID`) ON DELETE CASCADE;

--
-- Constraints for table `stock_alerts`
--
ALTER TABLE `stock_alerts`
  ADD CONSTRAINT `stock_alerts_ibfk_1` FOREIGN KEY (`Med_ID`) REFERENCES `medicine` (`Med_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
