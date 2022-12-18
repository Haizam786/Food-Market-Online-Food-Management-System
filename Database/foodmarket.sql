-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2021 at 04:49 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `username`, `password`) VALUES
(35, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(5, 'Pizza', 'Food_Category_696.jpg', 'Yes', 'Yes'),
(6, 'Pasta', 'Food_Category_926.jpg', 'Yes', 'Yes'),
(12, 'Burgers', 'Food_Category_741.jpg', 'No', 'Yes'),
(16, 'Smoothie', 'Food_Category_444.webp', 'Yes', 'Yes'),
(19, 'Submarine', 'Food_Category_606.jpg', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(12, 'Veggie Supreme', 'Mushrooms, tomatoes, onions, black olives and bell peppers with a double layer of mozzarella cheese.', '3000.00', 'Food_Name_184.jpg', 5, 'Yes', 'Yes'),
(13, 'Chocolate Smoothie', 'Take a sip of a creamy concoction of double chocolate and lose yourself in a chocolate coma!', '350.00', 'Food_Name_491.jpg', 16, 'Yes', 'Yes'),
(14, 'Pasta with Chicken & Sausage Meat', 'The famed Italian spaghetti with minced chicken complemented by', '1000.00', 'Food_Name_261.jpg', 6, 'Yes', 'Yes'),
(18, 'WHOPPER', 'A real meaty flame-grilled WHOPPER® beef patty, topped with tangy pickles, ketchup, fresh tomatoes, crisp lettuce and fresh onions, finished with creamy mayo , and served on a toasted 5\" sesame seed bun. Feeling hungry for a real meaty burger yet?', '1000.00', 'Food_Name_176.png', 12, 'Yes', 'Yes'),
(19, 'Veg Sub', 'Try our Fresh-baked breads, crisp veggies, tasty cheeses, and flavorful sauces.', '600.00', 'Food_Name_926.jpg', 19, 'No', 'Yes'),
(20, 'Pizza Margherita', '100ml tomato passata (sieved tomatoes)* or roasted-tomato sugo \r\nchopped basil leaves, plus small leaves to garnish', '2500.00', 'Food_Name_767.jpeg', 5, 'No', 'Yes'),
(21, 'Strawberry Smoothie', 'This strawberry smoothie is a healthy, filling and colourful way to start any day.', '500.00', 'Food_Name_426.png', 16, 'No', 'Yes'),
(22, 'Tomato Goat Cheese Pasta', 'This tomato goat cheese pasta is simple, fresh', '800.00', 'Food_Name_127.jpg', 6, 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `orderr`
--

CREATE TABLE `orderr` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderr`
--

INSERT INTO `orderr` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Veggie Supreme', '2500.00', 1, '2500.00', '2021-10-04 08:06:19', 'Delivered', 'Mohamed', '0712345678', 'M07@gmail.com', '222/1, Galle Rd, Colombo 04'),
(4, 'Veggie Supreme', '3000.00', 1, '3000.00', '2021-10-09 01:40:47', 'Ordered', 'Sarah', '0769876543', 'sarah02@gmail.com', '08/B Negombo Rd, Wattala'),
(5, 'Pasta with Chicken & Sausage Meat', '800.00', 1, '800.00', '2021-10-09 01:53:58', 'Delivered', 'Saalim', '0761235498', 'salimjr@gmail.com', '229/D Puttalam Rd,Kurana'),
(6, 'Veggie Supreme', '3000.00', 754, '2262000.00', '2021-10-10 06:47:11', 'Delivered', 'Amir Slater', '+1 (632) 846-1909', 'dyhocebe@mailinator.com', 'Beatae tempor sed ex');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderr`
--
ALTER TABLE `orderr`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orderr`
--
ALTER TABLE `orderr`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
