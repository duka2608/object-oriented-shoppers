-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2020 at 11:14 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoppers`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(10) NOT NULL,
  `first_name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_image` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `first_name`, `last_name`, `intro`, `description`, `id_image`) VALUES
(1, 'Dusko', 'Stupar', 'Rodjen 1997. godine u Budimu, sa 5 godina sam otkrio svoje nadljudske sposobnosti za programiranje.', 'Od tog dana pa do danas, programiram 8 sati dnevno. Upisao sam visoku ICT skolu strukovnih studija 2016. godine i trenutna prosecna ocena mi je 10. Nista od navedenog nije istina.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(5, 'Accessories'),
(3, 'Footwear'),
(2, 'Pants'),
(6, 'Shirts'),
(4, 'Sweatshirts'),
(1, 'T-shirts');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(10) NOT NULL,
  `title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `title`, `color_code`) VALUES
(1, 'Red', 'danger'),
(2, 'Green', 'success'),
(3, 'Blue', 'info'),
(4, 'Purple', 'primary'),
(5, 'Yellow', 'warning');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(10) NOT NULL,
  `title` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `title`) VALUES
(1, 'Female'),
(7, 'Kids'),
(2, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `gender_product`
--

CREATE TABLE `gender_product` (
  `id` int(10) NOT NULL,
  `id_gender` int(10) NOT NULL,
  `id_product` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gender_product`
--

INSERT INTO `gender_product` (`id`, `id_gender`, `id_product`) VALUES
(32, 2, 23),
(33, 7, 24),
(34, 2, 24);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) NOT NULL,
  `large` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `small` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `large`, `small`) VALUES
(2, 'autor.jpg', 'autor.jpg'),
(27, 'app/assets/images/1581988326kosulja.jpg', 'app/assets/images/small/small_1581988326kosulja.jpg'),
(28, 'app/assets/images/1582011609majica.jpg', 'app/assets/images/small/small_1582011609majica.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_category` int(10) NOT NULL,
  `id_color` int(10) NOT NULL,
  `id_image` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `date`, `id_category`, `id_color`, `id_image`) VALUES
(23, 'Shirt', 'Green utility shirt', 24, '2020-02-18 01:12:06', 6, 2, 27),
(24, 'T-shirt', 'Purple', 7, '2020-02-18 07:40:09', 1, 4, 28);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) NOT NULL,
  `title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`) VALUES
(1, 'administrator'),
(2, 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) NOT NULL,
  `title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `title`) VALUES
(4, 'L'),
(3, 'M'),
(2, 'S'),
(5, 'XL'),
(1, 'XS'),
(6, 'XXL');

-- --------------------------------------------------------

--
-- Table structure for table `sizes_products`
--

CREATE TABLE `sizes_products` (
  `id` int(10) NOT NULL,
  `id_size` int(10) NOT NULL,
  `id_product` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes_products`
--

INSERT INTO `sizes_products` (`id`, `id_size`, `id_product`) VALUES
(49, 4, 23),
(50, 5, 23),
(51, 6, 23),
(52, 3, 24),
(53, 2, 24),
(54, 1, 24);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `is_active`, `date`, `id_role`) VALUES
(15, 'Stefan', 'Drobnjak', 'stefan@gmail.com', 'stefan123', 'Pass#word123', 0, '2020-02-18 10:05:24', 2),
(42, 'Jovan', 'Jovanovic', 'jova@gmail.com', 'jovica123', 'Pass#word123', 0, '2020-02-16 11:10:53', 2),
(43, 'Boban', 'Bobic', 'boban@gmail.com', 'bobi1234', 'Pass#word123', 0, '2020-02-16 11:11:24', 2),
(44, 'Milan', 'Milanovic', 'milan@gmail.com', 'milance123', 'Pass#word123', 0, '2020-02-16 11:22:28', 2),
(45, 'Metod', 'Mitrovic', 'metod@gmail.com', 'metodije123', 'Pass#word123', 0, '2020-02-16 11:25:02', 2),
(46, 'Pera', 'Detlic', 'detlic@gmail.com', 'perica1234', 'Pass#word123', 0, '2020-02-16 11:34:22', 2),
(47, 'Boban', 'Bobanovic', 'boban@gmail.com', 'bobance123', 'Pass#word123', 0, '2020-02-16 11:56:26', 2),
(49, 'Pera', 'Peric', 'pera@gmail.com', 'perica1234', 'Pass#word123', 0, '2020-02-16 13:45:20', 2),
(50, 'Stevan', 'Stojanovic', 'mokranjac@gmail.com', 'mokranjac1234', 'Pass#word123', 0, '2020-02-16 13:47:54', 2),
(54, 'Dusko', 'Stupar', 'dusko.stupar.128.16@ict.edu.rs', 'dusko128', 'password', 0, '2020-02-18 08:32:50', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_image` (`id_image`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `gender_product`
--
ALTER TABLE `gender_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_gender` (`id_gender`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_product_2` (`id_product`),
  ADD KEY `id_gender_2` (`id_gender`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_gender` (`id_category`),
  ADD KEY `id_image` (`id_image`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_category_2` (`id_category`),
  ADD KEY `id_color` (`id_color`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `sizes_products`
--
ALTER TABLE `sizes_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_size` (`id_size`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date` (`date`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gender_product`
--
ALTER TABLE `gender_product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sizes_products`
--
ALTER TABLE `sizes_products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_ibfk_1` FOREIGN KEY (`id_image`) REFERENCES `images` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `gender_product`
--
ALTER TABLE `gender_product`
  ADD CONSTRAINT `product_gender_ibfk_1` FOREIGN KEY (`id_gender`) REFERENCES `gender` (`id`),
  ADD CONSTRAINT `product_gender_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_image`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_color`) REFERENCES `color` (`id`),
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`);

--
-- Constraints for table `sizes_products`
--
ALTER TABLE `sizes_products`
  ADD CONSTRAINT `sizes_products_ibfk_1` FOREIGN KEY (`id_size`) REFERENCES `sizes` (`id`),
  ADD CONSTRAINT `sizes_products_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
