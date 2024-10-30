-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 04:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@gmail.com', '0000');

-- --------------------------------------------------------

--
-- Table structure for table `bakery_equipment_inventory`
--

CREATE TABLE `bakery_equipment_inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `serial_no` varchar(100) DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `status` enum('Good Working Condition','Not Working') NOT NULL,
  `last_service` date DEFAULT NULL,
  `maintenance_schedule` varchar(255) DEFAULT NULL,
  `purchase_cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bakery_equipment_inventory`
--

INSERT INTO `bakery_equipment_inventory` (`id`, `item_name`, `category`, `serial_no`, `purchase_date`, `status`, `last_service`, `maintenance_schedule`, `purchase_cost`) VALUES
(1, 'Industrial Oven', 'Baking', 'OV123456', '2022-05-10', 'Good Working Condition', '2023-03-15', 'Quarterly', 5000.00),
(2, 'Dough Mixer', 'Mixing', 'MX987654', '2021-07-22', 'Good Working Condition', '2023-01-10', 'Monthly', 2500.00),
(3, 'Refrigerator', 'Storage', 'RF543210', '2020-03-18', 'Good Working Condition', '2023-02-20', 'Bi-Annually', 1500.00),
(4, 'Proofing Cabinet', 'Baking', 'PC135792', '2022-01-05', 'Not Working', '0000-00-00', 'N/A', 2000.00),
(5, 'Baking Tray', 'Baking', 'BT246810', '2022-04-15', 'Good Working Condition', '2023-04-01', 'As Needed', 100.00),
(6, 'Pastry Sheeter', 'Mixing', 'PS112233', '2021-08-30', 'Good Working Condition', '2023-03-05', 'Monthly', 1800.00),
(7, 'Bread Slicer', 'Cutting', 'BS445566', '2022-06-12', 'Good Working Condition', '2023-02-28', 'Quarterly', 1200.00),
(8, 'Cake Decorator', 'Decorating', 'CD778899', '2021-09-25', 'Good Working Condition', '2023-01-15', 'Monthly', 900.00),
(9, 'Dough Divider', 'Mixing', 'DD101112', '2020-11-20', 'Not Working', '0000-00-00', 'N/A', 1500.00),
(10, 'Cooling Rack', 'Baking', 'CR131415', '2022-03-11', 'Good Working Condition', '2023-04-10', 'As Needed', 50.00),
(11, 'Whisk', 'Mixing', 'WK161718', '2021-12-01', 'Good Working Condition', '2023-02-05', 'As Needed', 15.00),
(12, 'Oven Thermometer', 'Baking', 'OT192021', '2022-05-05', 'Good Working Condition', '2023-03-12', 'As Needed', 25.00),
(13, 'Pizza Oven', 'Baking', 'PO222324', '2022-07-30', 'Good Working Condition', '2023-04-15', 'Quarterly', 3000.00),
(14, 'Cake Stand', 'Decorating', 'CS252627', '2021-10-10', 'Good Working Condition', '2023-01-20', 'As Needed', 75.00),
(15, 'Mixer Attachments', 'Mixing', 'MA282930', '2022-02-15', 'Good Working Condition', '2023-03-20', 'As Needed', 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `bakery_products`
--

CREATE TABLE `bakery_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bakery_products`
--

INSERT INTO `bakery_products` (`id`, `product_name`, `description`, `price`, `quantity`, `created_at`, `expiry_date`) VALUES
(1, 'vanilla cake', 'creamy vanilla cake ', 234.00, 3, '2024-10-28 17:46:02', '2024-01-15'),
(2, 'Chocolate Cake', 'Rich and moist chocolate cake topped with chocolate frosting.', 25.99, 10, '2024-10-28 17:48:12', '2024-02-10'),
(3, 'Vanilla Cupcake', 'Delicious vanilla cupcake with creamy vanilla frosting.', 2.50, 50, '2024-10-28 17:48:12', '2024-01-20'),
(4, 'Blueberry Muffin', 'Freshly baked muffin loaded with blueberries.', 3.00, 30, '2024-10-28 17:48:12', '2024-01-25'),
(5, 'Croissant', 'Flaky and buttery croissant, perfect for breakfast.', 1.75, 40, '2024-10-28 17:48:12', '2025-03-01'),
(6, 'Apple Pie', 'Classic apple pie with a flaky crust and sweet apple filling.', 15.00, 15, '2024-10-28 17:48:12', '2024-02-15'),
(7, 'Brownie', 'Fudgy brownie with walnuts, a chocolate lover\'s delight.', 2.00, 25, '2024-10-28 17:48:12', '2024-01-30'),
(8, 'Baguette', 'Crispy crust and soft inside, perfect for sandwiches.', 3.50, 20, '2024-10-28 17:48:12', '2024-01-28'),
(9, 'Cheesecake', 'Creamy cheesecake with a graham cracker crust.', 20.00, 5, '2024-10-28 17:48:12', '2024-02-05'),
(10, 'Pecan Tart', 'Delicious tart filled with pecans and caramel.', 4.50, 12, '2024-10-28 17:48:12', '2024-01-22'),
(11, 'Lemon Bar', 'Tangy lemon bar with a buttery crust.', 2.25, 30, '2024-10-28 17:48:12', '2024-03-01'),
(12, 'cake', 'normal cake', 234.00, 3, '2024-10-28 17:48:23', '2024-02-20'),
(13, 'cake', 'wertyjk', 234.00, 3, '2024-10-28 18:03:00', '2024-03-15'),
(14, 'cake', 'wertyjk', 234.00, 3, '2024-10-28 18:05:24', '2024-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `hiring_date` date NOT NULL,
  `salary` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `id_number`, `hiring_date`, `salary`) VALUES
(1, 'John Mwangi', 'ID12345678', '2020-01-15', 50000.00),
(2, 'Jane Wambui', 'ID23456789', '2019-03-10', 60000.00),
(3, 'Peter Otieno', 'ID34567890', '2021-06-25', 55000.00),
(4, 'Mary Njeri', 'ID45678901', '2022-07-30', 45000.00),
(5, 'James Kamau', 'ID56789012', '2023-02-20', 70000.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `cake_type` enum('Cheesecake','Blackforest','Red Velvet','ButterCake','LemonCake') NOT NULL,
  `cake_description` text NOT NULL,
  `date_needed` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `order_number`, `cake_type`, `cake_description`, `date_needed`, `created_at`) VALUES
(1, 'Alice Smith', 'alice.smith@gmail.com', 'ORD001', 'Cheesecake', 'New York style cheesecake with strawberries.', '2023-10-15', '2024-10-29 14:25:01'),
(2, 'Bob Johnson', 'bob.johnson@gmail.com', 'ORD002', 'Blackforest', 'Classic black forest cake with cherries and whipped cream.', '2023-10-20', '2024-10-29 14:25:01'),
(3, 'Charlie Brown', 'charlie.brown@gmail.com', 'ORD003', 'Red Velvet', 'Red velvet cake with cream cheese frosting.', '2023-10-18', '2024-10-29 14:25:01'),
(4, 'Diana Prince', 'diana.prince@gmail.com', 'ORD004', 'ButterCake', 'Moist butter cake with vanilla flavor.', '2023-10-22', '2024-10-29 14:25:01'),
(5, 'Ethan Hunt', 'ethan.hunt@gmail.com', 'ORD005', 'LemonCake', 'Zesty lemon cake with lemon glaze.', '2023-10-25', '2024-10-29 14:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_sold` int(11) NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL,
  `total_sale` decimal(10,2) NOT NULL,
  `sale_date` datetime NOT NULL,
  `payment_method` enum('cash','mpesa') NOT NULL,
  `amount_given` decimal(10,2) DEFAULT NULL,
  `change_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `quantity_sold`, `price_per_unit`, `total_sale`, `sale_date`, `payment_method`, `amount_given`, `change_amount`) VALUES
(7, 1, 2, 5.00, 10.00, '2024-10-29 09:50:07', 'cash', 15.00, 5.00),
(8, 2, 1, 3.50, 3.50, '2024-10-29 09:50:07', 'cash', 5.00, 1.50),
(9, 3, 5, 2.00, 10.00, '2024-10-29 09:50:07', 'cash', 12.00, 2.00),
(10, 4, 3, 4.00, 12.00, '2024-10-29 09:50:07', 'cash', 20.00, 8.00),
(11, 5, 4, 6.00, 24.00, '2024-10-29 09:50:07', 'cash', 30.00, 6.00);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `product_name`, `supplier_name`, `quantity`, `price`, `created_at`, `expiry_date`) VALUES
(1, 'Chocolate Cake', 'Sweet Treats Bakery', 5, 20.00, '2024-10-28 18:21:46', '2024-01-15'),
(2, 'Vanilla Cupcake', 'Cupcake Heaven', 30, 1.50, '2024-10-28 18:21:46', '2024-02-10'),
(3, 'Blueberry Muffin', 'Morning Bakes', 20, 2.00, '2024-10-28 18:21:46', '2024-01-20'),
(4, 'Croissant', 'French Delights', 50, 1.00, '2024-10-28 18:21:46', '2024-01-25'),
(5, 'Apple Pie', 'Grandma’s Kitchen', 10, 12.00, '2024-10-28 18:21:46', '2025-03-01'),
(6, 'Brownie', 'Choco Bliss', 25, 1.50, '2024-10-28 18:21:46', '2024-02-15'),
(7, 'Baguette', 'Artisan Breads Co.', 40, 2.50, '2024-10-28 18:21:46', '2024-01-30'),
(8, 'Cheesecake', 'Dessert Dreams', 8, 15.00, '2024-10-28 18:21:46', '2024-01-28'),
(9, 'Pecan Tart', 'Nutty Delights', 12, 3.50, '2024-10-28 18:21:46', '2024-02-05'),
(10, 'Lemon Bar', 'Citrus Sweets', 30, 1.75, '2024-10-28 18:21:46', '2024-01-22'),
(11, 'pizza dough', 'roy', 222, 2.00, '2024-10-28 18:31:39', '2024-03-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `username` (`email`);

--
-- Indexes for table `bakery_equipment_inventory`
--
ALTER TABLE `bakery_equipment_inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_no` (`serial_no`);

--
-- Indexes for table `bakery_products`
--
ALTER TABLE `bakery_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_number` (`id_number`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bakery_equipment_inventory`
--
ALTER TABLE `bakery_equipment_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bakery_products`
--
ALTER TABLE `bakery_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `bakery_products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
