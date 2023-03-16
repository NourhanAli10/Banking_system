-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2023 at 12:39 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(20) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(100) NOT NULL,
  `current_balance` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `email`, `current_balance`, `created_at`) VALUES
(1, 'nourhan', 'nourhan@gmail.com', '95000.00', '2023-03-16 23:15:28'),
(2, 'osama', 'osama@gmail.com', '220000.00', '2023-03-16 23:15:28'),
(3, 'Mohamed', 'mohamed@gmail.com', '500000.00', '2023-03-16 23:15:28'),
(4, 'nesma', 'nesma@gmail.com', '960000.00', '2023-03-16 23:15:28'),
(5, 'Ahmed', 'ahmed@gmail.com', '650000.00', '2023-03-16 23:15:28'),
(6, 'dina', 'dina@gmail.com', '100000.00', '2023-03-16 23:15:28'),
(7, 'asmaa', 'asmaa@gmail.com', '100500.00', '2023-03-16 23:15:28'),
(8, 'noha', 'noha@gmail.com', '200000.00', '2023-03-16 23:15:28'),
(9, 'mostafa', 'mostafa@gmail.com', '50000.00', '2023-03-16 23:15:28'),
(10, 'sara', 'sara@gmail.com', '25000.00', '2023-03-16 23:15:28'),
(11, 'noura', 'noura@gmail.com', '25000.00', '2023-03-16 23:18:53');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` int(20) UNSIGNED NOT NULL,
  `sender_name` varchar(64) NOT NULL,
  `receiver_name` varchar(64) NOT NULL,
  `transfer_amount` decimal(10,2) NOT NULL,
  `transfer_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `sender_name`, `receiver_name`, `transfer_amount`, `transfer_date`) VALUES
(1, 'nourhan', 'osama', '20000.00', '2023-03-16 23:17:02'),
(2, 'nesma', 'sara', '25000.00', '2023-03-16 23:17:38'),
(3, 'sara', 'asmaa', '500.00', '2023-03-16 23:17:53'),
(4, 'nourhan', 'nesma', '5000.00', '2023-03-16 23:18:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
