-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2018 at 12:58 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msand`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_profile`
--

CREATE TABLE `admin_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_profile`
--

INSERT INTO `admin_profile` (`id`, `name`, `password`, `email`) VALUES
(1, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `msand` varchar(30) DEFAULT NULL,
  `psand` varchar(30) DEFAULT NULL,
  `waste` varchar(30) DEFAULT NULL,
  `insert_date` varchar(30) DEFAULT NULL,
  `last_login` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone`, `address`, `msand`, `psand`, `waste`, `insert_date`, `last_login`) VALUES
(1, 'test', '1234567890', 'sfsdfsdf', '123', '99', '100', '2018-08-10', '1533893257');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL,
  `expense_name` varchar(30) DEFAULT NULL,
  `category` varchar(30) DEFAULT NULL,
  `description` text,
  `amount` varchar(30) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `expense_name`, `category`, `description`, `amount`, `date`) VALUES
(2, 'test1', '4', 'zfzdfedf', '678', '2018-08-24'),
(5, 'ftgdrgd', '3', 'thyrftyhrftg fgxdrgrg rfrferfregtrg ggrgtgrhyrtyger tgretgser rerf frfrfrgrg rtgrg tgrt tetgg xgc gtgtggcf', '565', '2018-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `exp_catid` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `notes` text,
  `date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`exp_catid`, `name`, `notes`, `date`) VALUES
(2, 'a', 'asda sdcsf dfdg cfgbcvgbgvn vgn\r\nadzsdzsf sfzsfzsfz', '2018-08-15'),
(3, 'tgdrgd', 'grfdxgxfgxdfgx', '2018-08-15'),
(4, 'dfgdfgd', 'fgxdfgvfgvbxfgvbcf', '2018-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `user_type` varchar(30) DEFAULT NULL,
  `insert_date` varchar(100) DEFAULT NULL,
  `last_login` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `name`, `email`, `password`, `mobile`, `address`, `user_type`, `insert_date`, `last_login`, `user_id`) VALUES
(81, 'admin', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 9034534534, '3ertfegerr ert er t', 'admin', '11-10-2017', '1534490605', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `insert_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `insert_date`) VALUES
(3, 'msand', 123, '2018-08-10'),
(4, 'psand', 99, '2018-08-10'),
(6, 'Waste', 100, '2018-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `raw_material`
--

CREATE TABLE `raw_material` (
  `raw_material_id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `price` varchar(30) DEFAULT NULL,
  `notes` text,
  `insert_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raw_material`
--

INSERT INTO `raw_material` (`raw_material_id`, `name`, `price`, `notes`, `insert_date`) VALUES
(1, 'test', '123', 'erfrfxdf', '2018-08-16'),
(2, 'test1', '345', 'dtgfhgvnhtfhgd drtg drtgd', '2018-08-16'),
(3, 'ghy', '120', 'rfdfd', '2018-08-16');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `zip` varchar(30) DEFAULT NULL,
  `user_type` varchar(30) DEFAULT NULL,
  `login_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `mobile`, `city`, `state`, `address`, `zip`, `user_type`, `login_id`) VALUES
(1, 'shyamily', 'shyamily@sigosoft.com', 1111111111, 'calicut', 'kerala', '                  sigosoft', '111111', 'user', 103),
(2, 'frfrfsrf', 'admin@wewerwe', 34534534, NULL, NULL, 'fefdsdsd', NULL, 'user', 106),
(4, 'test', 'admin@admin', 1234567890, NULL, NULL, 'tgdgtgcthgcfth', NULL, 'user', 108),
(5, 'shyamily', 'shyamily@sigosoft.com', 1234567890, NULL, NULL, 'sigosoft', NULL, 'user', 109);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `model` varchar(30) DEFAULT NULL,
  `reg_number` varchar(30) DEFAULT NULL,
  `cl` varchar(30) DEFAULT NULL,
  `cw` varchar(30) DEFAULT NULL,
  `ch` varchar(30) DEFAULT NULL,
  `el` varchar(30) DEFAULT NULL,
  `ew` varchar(30) DEFAULT NULL,
  `eh` varchar(30) DEFAULT NULL,
  `insert_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `name`, `model`, `reg_number`, `cl`, `cw`, `ch`, `el`, `ew`, `eh`, `insert_date`) VALUES
(2, 'test', 'ere', 'ere', '3', '4', '4', NULL, NULL, NULL, '2018-08-15'),
(3, 'tere2', 'erter2', 'erer2', '42', '52', '32', '62', '72', '22', '2018-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `vendor_add_date` varchar(30) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `totalamount` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `name`, `mobile`, `email`, `vendor_add_date`, `date`, `totalamount`) VALUES
(7, 'erwerw', '42342', 'aw@wedw', '2018-08-24', '2018-08-17', '4182');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_products`
--

CREATE TABLE `vendor_products` (
  `vendor_products_id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `price` varchar(30) DEFAULT NULL,
  `quantity` varchar(30) DEFAULT NULL,
  `total` varchar(30) DEFAULT NULL,
  `vendor_id` varchar(30) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_products`
--

INSERT INTO `vendor_products` (`vendor_products_id`, `name`, `price`, `quantity`, `total`, `vendor_id`, `date`) VALUES
(9, '1', ' 123', '34', '4182', '7', '2018-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_temp_products`
--

CREATE TABLE `vendor_temp_products` (
  `vendor_temp_products_id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `price` varchar(30) DEFAULT NULL,
  `quantity` varchar(30) DEFAULT NULL,
  `total` varchar(30) DEFAULT NULL,
  `login_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_profile`
--
ALTER TABLE `admin_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`exp_catid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_material`
--
ALTER TABLE `raw_material`
  ADD PRIMARY KEY (`raw_material_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_products`
--
ALTER TABLE `vendor_products`
  ADD PRIMARY KEY (`vendor_products_id`);

--
-- Indexes for table `vendor_temp_products`
--
ALTER TABLE `vendor_temp_products`
  ADD PRIMARY KEY (`vendor_temp_products_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_profile`
--
ALTER TABLE `admin_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `exp_catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `raw_material`
--
ALTER TABLE `raw_material`
  MODIFY `raw_material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vendor_products`
--
ALTER TABLE `vendor_products`
  MODIFY `vendor_products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vendor_temp_products`
--
ALTER TABLE `vendor_temp_products`
  MODIFY `vendor_temp_products_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
