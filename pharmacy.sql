-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2025 at 06:25 PM
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
(1, 'Suresh', 'Shrestha', 'M', 34, '9841234567', 'suresh.shrestha@gmail.com'),
(2, 'Asha', 'Thapa', 'F', 28, '9865432109', 'asha.thapa@yahoo.com'),
(3, 'Ramesh', 'Gurung', 'M', 45, '9809876543', 'ramesh.gurung@outlook.com'),
(4, 'Sunita', 'Tamang', 'F', 19, '9845678901', 'sunita.tamang@gmail.com'),
(5, 'Hari', 'Pokhrel', 'M', 52, '9861239876', 'hari.pokhrel@hotmail.com'),
(6, 'Gita', 'Rai', 'F', 37, '9804567890', 'gita.rai@gmail.com'),
(7, 'Bikash', 'Magar', 'M', 26, '9847891234', 'bikash.magar@yahoo.com'),
(8, 'Maya', 'Lama', 'F', 60, '9862345678', 'maya.lama@outlook.com'),
(9, 'Prakash', 'Adhikari', 'M', 41, '9803216547', 'prakash.adhikari@gmail.com'),
(10, 'Laxmi', 'Karki', 'F', 33, '9848765432', 'laxmi.karki@hotmail.com'),
(11, 'Nabin', 'Bhandari', 'M', 29, '9867891234', 'nabin.bhandari@yahoo.com'),
(12, 'Sarita', 'Joshi', 'F', 47, '9806543210', 'sarita.joshi@gmail.com'),
(13, 'Krishna', 'Dahal', 'M', 55, '9843219876', 'krishna.dahal@outlook.com'),
(14, 'Anita', 'Poudel', 'F', 22, '9864567890', 'anita.poudel@gmail.com'),
(15, 'Manoj', 'Khanal', 'M', 38, '9807894561', 'manoj.khanal@hotmail.com'),
(16, 'Sushant', 'Rana', 'Male', 22, '9815631275', 'sushantrana1121@gmail.com');

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
(10, 'Laxmi', 'Magar', 'F', '1996-02-25', 29, 'Cashier', 32000.00, '9804567890', '2022-07-15', 'laxmi.magar@gmail.com', 'Siddhartha Hwy, Bhairahawa'),
(11, 'Sanjay', 'Adhikari', 'M', '1993-06-30', 32, 'Technician', 45000.00, '9847891234', '2021-04-01', 'sanjay.adhikari@yahoo.com', 'Tribhuvan Chowk, Nepalgunj'),
(12, 'Pooja', 'Karki', 'F', '1999-01-12', 26, 'Cashier', 28000.00, '9862345678', '2023-08-05', 'pooja.karki@outlook.com', 'Hospital Rd, Bharatpur'),
(13, 'Nabin', 'Joshi', 'M', '1991-12-05', 33, 'Pharmacist', 62000.00, '9803216547', '2020-12-10', 'nabin.joshi@gmail.com', 'Bagbazar, Kathmandu'),
(14, 'Sarita', 'Poudel', 'F', '1997-08-20', 28, 'Technician', 42000.00, '9848765432', '2022-05-25', 'sarita.poudel@hotmail.com', 'Chipledhunga, Pokhara');

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
(1, 'Paracetamol', 16812, 20.00, 'Tablet', 'Rack A'),
(2, 'Ibuprofen', 13684, 25.50, 'Tablet', 'Rack B'),
(3, 'Aspirin', 9516, 15.75, 'Tablet', 'Rack C'),
(4, 'Amoxicillin', 4445, 30.00, 'Capsule', 'Rack D'),
(5, 'Ciprofloxacin', 7383, 45.25, 'Tablet', 'Rack E'),
(6, 'Azithromycin', 3890, 50.00, 'Capsule', 'Rack F'),
(7, 'Metformin', 16001, 22.30, 'Tablet', 'Rack G'),
(8, 'Insulin', 1500, 80.00, 'Injection', 'Rack H'),
(9, 'Losartan', 4100, 35.50, 'Tablet', 'Rack I'),
(10, 'Amlodipine', 3800, 28.75, 'Tablet', 'Rack J'),
(11, 'Omeprazole', 5000, 18.90, 'Capsule', 'Rack K'),
(12, 'Pantoprazole', 4300, 21.40, 'Capsule', 'Rack L'),
(13, 'Loratadine', 2900, 12.50, 'Tablet', 'Rack M'),
(14, 'Cetirizine', 9125, 14.00, 'Tablet', 'Rack N'),
(15, 'Salbutamol', 2600, 32.00, 'Inhaler', 'Rack O'),
(16, 'Montelukast', 3100, 40.25, 'Tablet', 'Rack P'),
(17, 'Atorvastatin', 4700, 27.80, 'Tablet', 'Rack Q'),
(18, 'Simvastatin', 4000, 23.60, 'Tablet', 'Rack R'),
(19, 'Diazepam', 1800, 19.50, 'Injection', 'Rack S'),
(20, 'Alprazolam', 1500, 22.00, 'Tablet', 'Rack T'),
(21, 'Fluoxetine', 3165, 26.70, 'Capsule', 'Rack U'),
(22, 'Sertraline', 3400, 29.90, 'Tablet', 'Rack V'),
(23, 'Levothyroxine', 3700, 17.25, 'Tablet', 'Rack W'),
(24, 'Prednisolone', 2500, 31.00, 'Tablet', 'Rack X'),
(25, 'Hydrocortisone', 2200, 28.50, 'Injection', 'Rack Y'),
(26, 'Metronidazole', 4100, 16.80, 'Tablet', 'Rack Z'),
(27, 'Fluconazole', 2800, 42.00, 'Capsule', 'Rack A1'),
(28, 'Clotrimazole', 3000, 15.30, 'Drops', 'Rack B1'),
(29, 'Acetaminophen', 7500, 21.10, 'Syrup', 'Rack C1'),
(30, 'Naproxen', 3300, 27.00, 'Tablet', 'Rack D1'),
(31, 'Cephalexin', 3600, 34.50, 'Capsule', 'Rack E1'),
(32, 'Doxycycline', 2900, 38.75, 'Tablet', 'Rack F1'),
(33, 'Ambroxol', 4000, 24.60, 'Syrup', 'Rack G1'),
(34, 'Lisinopril', 4200, 30.20, 'Tablet', 'Rack H1'),
(35, 'Ranitidine', 3800, 19.80, 'Syrup', 'Rack I1'),
(36, 'Fexofenadine', 2700, 16.50, 'Tablet', 'Rack J1'),
(37, 'Budesonide', 2300, 45.00, 'Inhaler', 'Rack K1'),
(38, 'Clonazepam', 1600, 23.40, 'Tablet', 'Rack L1'),
(39, 'Citalopram', 3100, 28.00, 'Capsule', 'Rack M1'),
(40, 'Timolol', 3400, 18.90, 'Drops', 'Rack N1');

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
(29, 1, 1, 8236, 20.00, '2019-03-03', '2022-03-03', '2025-09-02'),
(30, 2, 2, 8272, 25.50, '2023-02-02', '2025-02-02', '2025-09-02'),
(31, 3, 3, 6326, 15.75, '2024-04-04', '2026-04-04', '2025-09-02'),
(32, 5, 5, 4583, 45.00, '2025-05-05', '2027-05-05', '2025-09-02'),
(33, 7, 6, 9833, 22.00, '2026-06-06', '2028-06-06', '2025-09-02'),
(34, 14, 8, 5625, 14.00, '2025-08-08', '2028-08-08', '2025-09-02');

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
(114, 2, '2025-08-24', '17:58:47', 225.00, 'Cash', 'Pending', NULL, NULL),
(116, 1, '2025-08-24', '18:10:33', 5320.00, 'Cash', 'Pending', NULL, NULL),
(117, 6, '2025-08-24', '18:12:21', 15.00, 'Cash', 'Pending', NULL, NULL),
(118, 10, '2025-08-24', '18:44:15', 150.00, 'Cash', 'Pending', NULL, NULL),
(120, 7, '2025-08-25', '13:51:34', 45.00, 'Cash', 'Pending', NULL, NULL),
(125, 13, '2025-08-26', '20:42:44', 500.00, 'Cash', 'Pending', NULL, NULL),
(134, 1, '2025-09-02', '10:52:04', 1000.00, 'Cash', 'Pending', NULL, NULL),
(135, 2, '2025-09-02', '10:53:09', 510.00, 'Cash', 'Pending', NULL, NULL),
(136, 3, '2025-09-02', '10:53:53', 1065.00, 'Cash', 'Pending', NULL, NULL),
(137, 4, '2025-09-02', '10:54:22', 900.00, 'Cash', 'Pending', NULL, NULL),
(138, 6, '2025-09-02', '10:54:55', 500.00, 'Cash', 'Pending', NULL, NULL),
(139, 7, '2025-09-02', '10:55:09', 356.80, 'Cash', 'Pending', NULL, NULL),
(140, 16, '2025-09-02', '10:55:22', 1291.30, 'Cash', 'Pending', NULL, NULL);

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
(129, 126, 20, 5, 600.00),
(130, 127, 15, 5, 700.00),
(131, 128, 10, 5, 75.00),
(132, 129, 1, 20, 400.00),
(133, 130, 17, 35, 175.00),
(134, 131, 15, 1, 140.00),
(135, 132, 20, 5, 600.00),
(136, 133, 23, 5, 1000.00),
(137, 134, 1, 50, 1000.00),
(138, 135, 2, 20, 510.00),
(139, 136, 3, 20, 315.00),
(140, 136, 4, 25, 750.00),
(141, 137, 4, 30, 900.00),
(142, 138, 6, 10, 500.00),
(143, 139, 7, 16, 356.80),
(144, 140, 7, 16, 356.80),
(145, 140, 21, 35, 934.50);

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
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `E_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `Med_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `P_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `Sale_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `Sup_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
