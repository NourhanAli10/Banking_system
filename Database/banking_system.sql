-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 11:12 PM
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
(1, 'nourhan', 'nourhan@gmail.com', '116000.00', '2023-03-16 21:27:32'),
(2, 'osama', 'osama@gmail.com', '18900.00', '2023-03-16 21:27:32'),
(3, 'Mohamed', 'mohamed@gmail.com', '1450.00', '2023-03-16 21:27:32'),
(4, 'nesma', 'nesma@gmail.com', '975000.00', '2023-03-16 21:27:32'),
(5, 'Ahmed', 'ahmed@gmail.com', '645000.00', '2023-03-16 21:27:32'),
(6, 'dina', 'dina@gmail.com', '330000.00', '2023-03-16 21:27:32'),
(7, 'noha', 'noha@gmail.com', '220000.00', '2023-03-16 21:27:32'),
(8, 'mostafa', 'mostafa@gmail.com', '55000.00', '2023-03-16 21:27:32'),
(9, 'sara', 'sara@gmail.com', '500.00', '2023-03-16 21:27:32'),
(10, 'asmaa', 'asmaa@gmail.com', '105000.00', '2023-03-16 21:27:32'),
(11, 'noura', 'noura@gmail.com', '25000.00', '2023-03-16 21:33:40'),
(12, 'nermeen', 'nermeen@gmail.com', '250000.00', '2023-03-16 21:52:25');

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
(1, 'nourhan', 'osama', '1000.00', '2023-03-16 21:50:44'),
(2, 'dina', 'noha', '20000.00', '2023-03-16 21:51:19'),
(3, 'Ahmed', 'asmaa', '5000.00', '2023-03-16 22:02:37');

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
  MODIFY `customer_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
