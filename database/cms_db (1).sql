-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 04:41 PM
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
-- Database: `cms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand_list`
--

CREATE TABLE `brand_list` (
  `brand_id` int(11) NOT NULL,
  `brand_name` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand_list`
--

INSERT INTO `brand_list` (`brand_id`, `brand_name`, `status`) VALUES
(2, 'Toyota', 1),
(3, 'Ford', 1),
(4, 'Hyundai', 1),
(5, 'Chevrolet', 1),
(6, 'Honda', 1),
(7, 'Nissan', 1),
(8, 'Jeep', 1),
(9, 'Volkswagen', 1),
(10, 'Volvo', 1),
(11, 'Audi', 1),
(12, 'Land Rover', 1),
(13, 'Rolls Royce', 1),
(14, 'Bugati', 1),
(15, 'Porsche', 1),
(16, 'BMW', 1),
(44, 'Tesla', 1);

-- --------------------------------------------------------

--
-- Table structure for table `car_type_list`
--

CREATE TABLE `car_type_list` (
  `type_id` int(11) NOT NULL,
  `type_name` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_type_list`
--

INSERT INTO `car_type_list` (`type_id`, `type_name`, `status`) VALUES
(1, 'Sedan', 0),
(2, 'Coupe', 1),
(3, 'Sports', 1),
(4, 'Station Wagon', 1),
(5, 'Hatchback', 1),
(6, 'Sports-Utility Vehicle (SUV)', 1),
(7, 'Minivan', 1),
(17, 'Pickup Truck', 1),
(18, 'motorhome', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_list`
--

CREATE TABLE `model_list` (
  `model_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_name` text NOT NULL,
  `engine_type` text NOT NULL,
  `transmission_type` text NOT NULL,
  `type_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `model_list`
--

INSERT INTO `model_list` (`model_id`, `brand_id`, `model_name`, `engine_type`, `transmission_type`, `type_id`, `status`) VALUES
(2, 2, 'Wigo 1.1 E MT', 'Gasoline', 'Manual (2WD) (5-Speed)', 5, 1),
(5, 6, 'BR-V', 'Petrol', 'Automatic', 6, 1),
(6, 3, 'mustang', 'Petrol', 'Manual (2WD)(Nitro)', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_list`
--

CREATE TABLE `transaction_list` (
  `transaction_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_list`
--

INSERT INTO `transaction_list` (`transaction_id`, `vehicle_id`, `buyer_id`, `seller_id`, `transaction_date`, `date_created`) VALUES
(4, 1, 7, 1, '2022-06-02 08:40:37', '2022-06-02 13:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('buyer','seller') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `address`, `email`, `username`, `password`, `user_type`) VALUES
(1, 'Shayan', 'Haider', 'HOUSE#69', 'shayan@gmail.com', 'shanoo', '3211', 'seller'),
(7, 'Taha', 'Hassan', 'HOUSE#420', 'taha@gmail.com', 'noob', '4680', 'buyer'),
(3212, 'Ahmed', 'Ali', 'PECHS', 'ahmed@gmail.com', 'ahmed', '3212', 'buyer');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_list`
--

CREATE TABLE `vehicle_list` (
  `vehicle_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `plate_number` text NOT NULL,
  `variant` text NOT NULL,
  `mileage` varchar(255) NOT NULL,
  `engine_number` varchar(255) NOT NULL,
  `chasis_number` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Available, 1 = Sold',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_list`
--

INSERT INTO `vehicle_list` (`vehicle_id`, `model_id`, `plate_number`, `variant`, `mileage`, `engine_number`, `chasis_number`, `price`, `status`, `image`) VALUES
(1, 6, 'GBN-2306', 'red', '10000', '10141997', '19971507', 450000.00, 1, 'uploads/5d3ec5b455555.jpg'),
(2, 5, 'ABC-2306', 'white', '10000', '10141997', '19971507', 450000.00, 1, 'uploads/5d3fc9a42a81f.jpg'),
(3, 2, 'CDM-9879', 'Red', '15879', '78954623', '5646897546', 425000.00, 1, 'uploads/5d3fc9a42a81f.jpg'),
(5, 2, 'ASG-091', 'grey', '250000', '1oi856', '00000000', 88888888.00, 1, 'uploads/6358fc21096e7.jpg'),
(6, 6, 'K21-3212', 'yellow', '1200', '32323232', '12121212', 50000000.00, 1, 'uploads/5d415ceaa3375.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand_list`
--
ALTER TABLE `brand_list`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `car_type_list`
--
ALTER TABLE `car_type_list`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `model_list`
--
ALTER TABLE `model_list`
  ADD PRIMARY KEY (`model_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `transaction_list`
--
ALTER TABLE `transaction_list`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `buyer_id` (`buyer_id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `vehicle_list`
--
ALTER TABLE `vehicle_list`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `idx_vehicle_id` (`vehicle_id`),
  ADD KEY `model_id` (`model_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand_list`
--
ALTER TABLE `brand_list`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `car_type_list`
--
ALTER TABLE `car_type_list`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `model_list`
--
ALTER TABLE `model_list`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction_list`
--
ALTER TABLE `transaction_list`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicle_list`
--
ALTER TABLE `vehicle_list`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_list`
--
ALTER TABLE `model_list`
  ADD CONSTRAINT `brand_id_fk_ml` FOREIGN KEY (`brand_id`) REFERENCES `brand_list` (`brand_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `car_type_id_fk_ml` FOREIGN KEY (`type_id`) REFERENCES `car_type_list` (`type_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `transaction_list`
--
ALTER TABLE `transaction_list`
  ADD CONSTRAINT `transaction_list_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `transaction_list_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `transaction_list_ibfk_3` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle_list` (`vehicle_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `vehicle_list`
--
ALTER TABLE `vehicle_list`
  ADD CONSTRAINT `model_id_fk_vl` FOREIGN KEY (`model_id`) REFERENCES `model_list` (`model_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
