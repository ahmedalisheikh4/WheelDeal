-- Database: DB Project semester#5

-- --------------------------------------------------------

--
-- Table structure for table usersusers
--

CREATE TABLE users (
  user_id INT NOT NULL,
  firstname varchar(250) NOT NULL,
  lastname varchar(250) NOT NULL,
  address varchar(250)NOT NULL,
  email varchar(250) NOT NULL,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  user_type ENUM('buyer', 'seller') NOT NULL
--  avatar text DEFAULT NULL,
--  last_login datetime DEFAULT NULL,
--  type tinyint(1) NOT NULL DEFAULT 0,
--  date_added datetime NOT NULL DEFAULT current_timestamp(),
--  date_updated datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
); -- ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='2';

--
-- Dumping data for table users
--
-- avatar, last_login, type, date_added, date_updated
INSERT INTO users (user_id, firstname, lastname, address, email, username, password,user_type) VALUES
(1, 'Shayan', 'Haider', 'HOUSE#69', 'shayan@gmail.com', 'shanoo', '3211','seller');
INSERT INTO users (user_id, firstname, lastname, address, email, username, password,user_type) VALUES
(7, 'Taha', 'Hassan', 'HOUSE#420', 'taha@gmail.com', 'noob', '4680','buyer');
-- (7, 'John', 'D', 'Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', 'uploads/avatars/7.png?v=1654065792', NULL, 2, '2022-05-26 11:04:16', '2022-06-01 14:43:12');

-- Add an index on the user_id column in the users table
ALTER TABLE users
  ADD INDEX idx_user_id (user_id);




-- CREATE TABLE users (
--    user_id INT PRIMARY KEY AUTO_INCREMENT,
--    username VARCHAR(50) NOT NULL,
--    password VARCHAR(255) NOT NULL,
--    email VARCHAR(100) NOT NULL,
--    user_type ENUM('buyer', 'seller') NOT NULL
-- );

-- --------------------------------------------------------

--
-- Table structure for table brand_list
--

CREATE TABLE brand_list (
  brand_id int NOT NULL,
  brand_name text NOT NULL,
  status tinyint NOT NULL DEFAULT 1
  );
--  delete_flag tinyint(1) NOT NULL DEFAULT 0,
--  date_created datetime NOT NULL DEFAULT current_timestamp(),
--  date_updated datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()) -- ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table brand_list
--

-- delete_flag, date_created, date_updated
INSERT INTO brand_list (brand_id, brand_name, status) VALUES
(1, 'Mercedes-benz', 1),
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
(17, 'Tesla', 1);

-- --------------------------------------------------------

--
-- Table structure for table car_type_list
--

CREATE TABLE car_type_list (
  type_id int NOT NULL,
  type_name text NOT NULL,
  status tinyint NOT NULL DEFAULT 1
--  delete_flag tinyint(1) NOT NULL DEFAULT 0,
--  date_created datetime NOT NULL DEFAULT current_timestamp(),
--  date_updated datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
); -- ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table car_type_list
--

-- delete_flag, date_created, date_updated
INSERT INTO car_type_list (type_id, type_name, status) VALUES
(1, 'Sedan', 1),
(2, 'Coupe', 1),
(3, 'Sports', 1),
(4, 'Station Wagon', 1),
(5, 'Hatchback', 1),
(6, 'Sports-Utility Vehicle (SUV)', 1),
(7, 'Minivan', 1),
(8, 'Pickup Truck ', 1),
(9, 'test - updated', 1);

-- --------------------------------------------------------

--
-- Table structure for table model_list
--

CREATE TABLE model_list (
  model_id int NOT NULL,
  brand_id int NOT NULL,
  model_name text NOT NULL,
  engine_type text NOT NULL,
  transmission_type text NOT NULL,
  type_id int NOT NULL,
--  technology text NOT NULL,
  status tinyint NOT NULL DEFAULT 1
--  delete_flag tinyint(1) NOT NULL DEFAULT 0,
--  date_created datetime NOT NULL DEFAULT current_timestamp(),
--  date_updated datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
); -- ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table model_list
--

INSERT INTO model_list (model_id, brand_id, model_name, engine_type, transmission_type, type_id, status) VALUES
(2, 2, 'Wigo 1.0 E MT', 'Gasoline', 'Manual (2WD) (5-Speed)', 5, 1),
(3, 16, 'test', 'test', 'test', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table system_info
--

-- CREATE TABLE system_info (
--  id int(30) NOT NULL,
--  meta_field text NOT NULL,
--  meta_value text NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table system_info
--

-- INSERT INTO system_info (id, meta_field, meta_value) VALUES
-- (1, 'name', 'Auto Dealer Management System'),
-- (6, 'short_name', 'ADMS - PHP'),
-- (11, 'logo', 'uploads/logo.png?v=1654130795'),
-- (13, 'user_avatar', 'uploads/user_avatar.jpg'),
-- (14, 'cover', 'uploads/cover.png?v=1654130796'),
-- (17, 'phone', '456-987-1231'),
-- (18, 'mobile', '09123456987 / 094563212222 '),
-- (19, 'email', 'info@sample.com'),
-- (20, 'address', '7087 Henry St. Clifton Park, NY 12065 - updated address');

-- --------------------------------------------------------

--
-- Table structure for table vehicle_list
--

CREATE TABLE vehicle_list (
  vehicle_id int NOT NULL,
  model_id int NOT NULL,
--  mv_number text NOT NULL,
  plate_number text NOT NULL,
  variant text NOT NULL,
  mileage varchar(255) NOT NULL,
  engine_number varchar(255) NOT NULL,
  chasis_number varchar(255) NOT NULL,
  price DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  status tinyint NOT NULL DEFAULT 0 COMMENT '0 = Available,\r\n1=Sold'
--  delete_flag tinyint(1) NOT NULL DEFAULT 0,
--  date_created datetime NOT NULL DEFAULT current_timestamp(),
--  date_updated datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
); -- ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add an index on the vehicle_id column in the vehicle_list table
ALTER TABLE vehicle_list
  ADD INDEX idx_vehicle_id (vehicle_id);

--
-- Dumping data for table vehicle_list
--

INSERT INTO vehicle_list (vehicle_id, model_id, plate_number, variant, mileage, engine_number, chasis_number, price, status) VALUES
(1, 2,  'GBN-2306', 'Gray Metalic', '10000', '10141997', '19971507', 450000.00, 0),
(2, 2, 'CDM-9879', 'Red', '15879', '78954623', '5646897546', 425000.00, 1),
(3, 2, 'test', 'test', 'test', 'test', 'test', 123.00, 0);

-- ------------------------------------------------------------
--
-- Table structure for table transaction_list
--

CREATE TABLE transaction_list (
  transaction_id int NOT NULL,
  vehicle_id int NOT NULL,
  -- agent_name text NOT NULL,
 -- firstname text NOT NULL,
  -- middlename text DEFAULT NULL,
 -- lastname text NOT NULL,
  -- sex varchar(20) NOT NULL,
 -- dob date NOT NULL,
    buyer_id INT,
    seller_id INT,
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (buyer_id) REFERENCES users(user_id),
    FOREIGN KEY (seller_id) REFERENCES users(user_id),
    FOREIGN KEY (vehicle_id) REFERENCES vehicle_list(vehicle_id),
  
	date_created datetime NOT NULL DEFAULT current_timestamp()
--  date_updated datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Create transactions table
-- CREATE TABLE transactions (
--    transaction_id INT PRIMARY KEY AUTO_INCREMENT,
--    buyer_id INT,
--    seller_id INT,
--    car_id INT,
--    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--    FOREIGN KEY (buyer_id) REFERENCES users(user_id),
--    FOREIGN KEY (seller_id) REFERENCES users(user_id),
--    FOREIGN KEY (car_id) REFERENCES vehicle_list(car_id)
-- );
--
-- Dumping data for table transaction_list
--

INSERT INTO transaction_list (transaction_id, vehicle_id,buyer_id,seller_id,transaction_date,date_created) VALUES
(4, 1, 7 , 1 , '2022-06-02 13:40:37', '2022-06-02 13:40:37');


-- --------------------------------------------------------


--
-- Indexes for dumped tables
--

--
-- Indexes for table brand_list
--
ALTER TABLE brand_list
  ADD PRIMARY KEY (brand_id);

--
-- Indexes for table car_type_list
--
ALTER TABLE car_type_list
  ADD PRIMARY KEY (type_id);

--
-- Indexes for table model_list
--
ALTER TABLE model_list
  ADD PRIMARY KEY (model_id),
  ADD KEY brand_id (brand_id),
  ADD KEY type_id (type_id);

--
-- Indexes for table system_info
--
-- ALTER TABLE system_info
--  ADD PRIMARY KEY (id);

--
-- Indexes for table vehicle_list
--
ALTER TABLE vehicle_list
  ADD PRIMARY KEY (vehicle_id),
  ADD KEY model_id (model_id);

--
-- Indexes for table transaction_list
--
ALTER TABLE transaction_list
  ADD PRIMARY KEY (transaction_id),
  ADD KEY vehicle_id (vehicle_id);

--
-- Indexes for table users
--
ALTER TABLE users
  ADD PRIMARY KEY (user_id);


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table brand_list
--
ALTER TABLE brand_list
  MODIFY brand_id int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table car_type_list
--
ALTER TABLE car_type_list
  MODIFY type_id int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table model_list
--
ALTER TABLE model_list
  MODIFY model_id int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table system_info
--
-- ALTER TABLE system_info
--  MODIFY id int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table transaction_list
--
ALTER TABLE transaction_list
  MODIFY transaction_id int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table users
--

-- NOT WORKED (AHMED NOOB)
  -- ALTER TABLE users
   -- MODIFY user_id int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
-- ALTER TABLE vehicle_list MODIFY vehicle_id int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
-- --------------------------------

-- AUTO_INCREMENT for table vehicle_list
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table model_list
--
ALTER TABLE model_list
  ADD CONSTRAINT brand_id_fk_ml FOREIGN KEY (brand_id) REFERENCES brand_list (brand_id) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT car_type_id_fk_ml FOREIGN KEY (type_id) REFERENCES car_type_list (type_id) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table transaction_list
--
ALTER TABLE transaction_list
  ADD CONSTRAINT vehicle_id FOREIGN KEY (vehicle_id) REFERENCES vehicle_list (vehicle_id) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table vehicle_list
--
ALTER TABLE vehicle_list
  ADD CONSTRAINT model_id_fk_vl FOREIGN KEY (model_id) REFERENCES model_list (model_id) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;