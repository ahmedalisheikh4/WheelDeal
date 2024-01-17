-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 06:28 AM
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
(44, 'Tesla', 1),
(47, 'Chevrolet', 1),
(48, 'Chevrolet', 1),
(50, 'Haval', 1);

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
(1, 'Sedan', 1),
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
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(20) NOT NULL,
  `cdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `action`, `cdate`) VALUES
(1, 4678, 'inserted', '2023-12-06 11:43:55'),
(2, 4678, 'inserted', '2023-12-07 10:20:31');

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
  `seller_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `model_list`
--

INSERT INTO `model_list` (`model_id`, `brand_id`, `model_name`, `engine_type`, `transmission_type`, `type_id`, `seller_id`, `status`) VALUES
(5, 6, 'CR-V', 'Petrol', 'Automatic', 6, 1, 1),
(7, 3, 'mustang', '7070E', 'Manual (3WD)(Nitro)', 3, 3212, 1),
(10, 6, 'BR-V', 'Petrol', 'Automatic', 6, 1, 1),
(22, 2, 'Altis', 'Petrol', 'Automatic', 1, 7, 1),
(23, 2, 'GLI', 'Petrol', 'Manual (2WD)(Nitro)', 1, 7, 1),
(25, 16, '7 Series', '2998 cc Petrol', 'Automatic', 3, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_list`
--

CREATE TABLE `transaction_list` (
  `transaction_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `sex` varchar(20) NOT NULL,
  `dob` date DEFAULT NULL,
  `contact` text NOT NULL,
  `comment` text NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_list`
--

INSERT INTO `transaction_list` (`transaction_id`, `vehicle_id`, `buyer_id`, `seller_id`, `sex`, `dob`, `contact`, `comment`, `transaction_date`, `date_created`) VALUES
(14, 66, 1, 7, '1', '0000-00-00', '335', 'meet me ', '2023-12-07 05:13:32', '2023-12-07 10:13:32'),
(15, 23, 4678, 3212, '1', '0000-00-00', '9887', 'meet me at 6', '2023-12-07 05:25:10', '2023-12-07 10:25:10');

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
(3212, 'Ahmed', 'Ali', 'PECHS', 'ahmed@gmail.com', 'ahmed', '3212', 'seller'),
(4678, 'asad', 'Noor', 'landhi', 'asad@gmail.com', 'asad', '4678', 'buyer');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `insertlog` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO logs VALUES(null, NEW.user_id, 'inserted', NOW())
$$
DELIMITER ;

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
  `seller_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Available, 1 = Sold',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_list`
--

INSERT INTO `vehicle_list` (`vehicle_id`, `model_id`, `plate_number`, `variant`, `mileage`, `engine_number`, `chasis_number`, `price`, `seller_id`, `status`, `image`) VALUES
(20, 5, 'ASG-091', 'white', '1200', '1oi856', '00000000077', 50000.00, 1, 1, ''),
(23, 7, 'AWZ-222', 'Red', '130', '78965412', '9899999', 45000.00, 3212, 1, 'uploads/5d3ec5b455555.jpg'),
(26, 7, 'CCZ-911', 'yellow', '1200', '87654321', '11110000', 50000.00, 3212, 1, 'uploads/5d415ceaa3375.jpg'),
(27, 10, 'KHI-211', 'black', '10', '545454', '77777', 20000.00, 1, 1, 'uploads/brv.jpeg'),
(30, 22, 'ABC-111', 'white', '130', '87654321', '11110000', 25000.00, 7, 1, 'uploads/download.jpeg'),
(58, 23, 'CDM-9879', 'grey', '130', '87654321', '98999999', 20000.00, 7, 1, 'uploads/gli.jpeg'),
(66, 25, 'TAH-468', 'blue', '130', '7845oo', '12345678', 60000.00, 7, 1, 'uploads/bmw.jpeg'),
(67, 7, 'asas', 'blue', '2500', '7845oo', '12345678', 20000.00, 4678, 1, '0');

--
-- Triggers `vehicle_list`
--
DELIMITER $$
CREATE TRIGGER `DeleteVehiclelog` BEFORE DELETE ON `vehicle_list` FOR EACH ROW INSERT INTO vehicle_log VALUES(null, OLD.vehicle_id, OLD.model_id, OLD.plate_number, OLD.variant, OLD.mileage, OLD.engine_number, OLD.chasis_number, OLD.price, OLD.seller_id, OLD.status, OLD.image, 'Delete vehicle', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertVehiclelog` AFTER INSERT ON `vehicle_list` FOR EACH ROW INSERT INTO vehicle_log VALUES(null, NEW.vehicle_id, New.model_id, NEW.plate_number, NEW.variant, NEW.mileage, NEW.engine_number, NEW.chasis_number, NEW.price, NEW.seller_id, NEW.status, NEW.image, 'Insert vehicle', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateVehiclelog` AFTER UPDATE ON `vehicle_list` FOR EACH ROW INSERT INTO vehicle_log VALUES(null, NEW.vehicle_id, New.model_id, NEW.plate_number, NEW.variant, NEW.mileage, NEW.engine_number, NEW.chasis_number, NEW.price, NEW.seller_id, NEW.status, NEW.image, 'Update vehicle', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_log`
--

CREATE TABLE `vehicle_log` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `plate_number` varchar(20) NOT NULL,
  `variant` text NOT NULL,
  `mileage` varchar(255) NOT NULL,
  `engine_number` varchar(255) NOT NULL,
  `chasis_number` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `image` varchar(255) NOT NULL,
  `action` varchar(20) NOT NULL,
  `cdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_log`
--

INSERT INTO `vehicle_log` (`id`, `vehicle_id`, `model_id`, `plate_number`, `variant`, `mileage`, `engine_number`, `chasis_number`, `price`, `seller_id`, `status`, `image`, `action`, `cdate`) VALUES
(75, 63, 25, 'TAH-468', 'blue', '20', '7845oo', '12345678', 60000, 7, 1, 'uploads/bmw.jpeg', 'Insert vehicle', '2023-12-07 09:35:45'),
(76, 63, 25, 'TAH-468', 'blue', '20', '7845oo', '12345678', 60000, 7, 1, 'uploads/bmw.jpeg', 'Delete vehicle', '2023-12-07 09:35:50'),
(77, 64, 25, 'TAH-468', 'blue', '20', '7845oo', '12345678', 60000, 7, 1, 'uploads/bmw.jpeg', 'Insert vehicle', '2023-12-07 09:36:52'),
(78, 64, 25, 'TAH-468', 'blue', '20', '7845oo', '12345678', 60000, 7, 1, 'uploads/bmw.jpeg', 'Delete vehicle', '2023-12-07 09:37:02'),
(79, 65, 25, 'TAH-468', 'blue', '130', '7845oo', '12345678', 60000, 7, 1, 'uploads/bmw.jpeg', 'Insert vehicle', '2023-12-07 09:42:03'),
(80, 65, 25, 'TAH-468', 'blue', '130', '7845oo', '12345678', 60000, 7, 1, 'uploads/bmw.jpeg', 'Delete vehicle', '2023-12-07 09:42:06'),
(89, 30, 22, 'ABC-111', 'white', '130', '87654321', '11110000', 25000, 7, 1, 'uploads/download.jpeg', 'Update vehicle', '2023-12-07 09:51:54'),
(90, 66, 25, 'TAH-468', 'blue', '130', '7845oo', '12345678', 60000, 7, 1, 'uploads/bmw.jpeg', 'Update vehicle', '2023-12-07 09:52:16'),
(91, 20, 5, 'ASG-091', 'white', '1200', '1oi856', '00000000077', 50000, 1, 1, '', 'Update vehicle', '2023-12-07 10:12:39');

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
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `vehicle_log`
--
ALTER TABLE `vehicle_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand_list`
--
ALTER TABLE `brand_list`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `car_type_list`
--
ALTER TABLE `car_type_list`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `model_list`
--
ALTER TABLE `model_list`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `transaction_list`
--
ALTER TABLE `transaction_list`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vehicle_list`
--
ALTER TABLE `vehicle_list`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `vehicle_log`
--
ALTER TABLE `vehicle_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

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
