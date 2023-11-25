-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2023 at 06:11 AM
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
-- Database: `food_buddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`) VALUES
(1, 'Chicken'),
(2, 'Chedder Cheese'),
(3, 'Tomatoes'),
(4, 'Capsicum'),
(5, 'Onions'),
(6, 'Olive Oil'),
(7, 'Black Olives'),
(8, 'Black Pepper'),
(9, 'Potatoes'),
(10, 'Garlic'),
(11, 'Ginger'),
(12, 'Carrots'),
(13, 'Mushroom'),
(14, 'Broccoli '),
(15, 'Salt'),
(16, 'Vegetable Oil'),
(17, 'Salmon'),
(18, 'Sesame Oil');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `preparation_time` varchar(45) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `image_filename` varchar(255) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `preparation_time`, `price`, `image_filename`, `restaurant_id`) VALUES
(1, 'Ginger Roasted Salmon & Broccoli', 'This quick Asian salmon recipe uses the sauce for both glazing the salmon and tossing with the broccoli', '25 minutes', 1190, 'menu_ginger_roasted_salmon_broccoli', 1),
(2, 'Creamy Jalapeño Skillet Chicken', 'These easy chicken cutlets are perfect for a weeknight dinner. A creamy jalapeño sauce coats the cutlets for a flavorful bite with a good amount of heat. Serve over rice or pasta.', '25 minutes', 1500, 'creamy_jalapeño_skillet_chicken', 1),
(3, 'Moroccan Chicken & Tomato Stew', 'This Moroccan chicken stew is inspired by a traditional tagine, a dish which takes its name from the pottery vessel it\'s made in (a skillet works here). Serve with a side of roasted vegetables and whole-wheat couscous, if desired.', '35 minutes', 1100, 'morocan_chicken', 1),
(4, 'Ginger Roasted Salmon & Broccoli', 'This quick Asian salmon recipe uses the sauce for both glazing the salmon and tossing with the broccoli', '25 minutes', 1190, 'menu_ginger_roasted_salmon_broccoli', 3),
(5, 'Moroccan Chicken & Tomato Stew', 'This Moroccan chicken stew is inspired by a traditional tagine, a dish which takes its name from the pottery vessel it\'s made in (a skillet works here). Serve with a side of roasted vegetables and whole-wheat couscous, if desired.', '35 minutes', 1100, 'morocan_chicken', 3),
(6, 'Chicken Karahi', 'This is a restaurant-style Pakistani Chicken Karahi recipe that can be prepared quickly and easily with no finicky steps.', '45 minutes', 1800, 'chicken_karahi', 2),
(7, 'Chicken Biryani', 'Biryani is an intricate rice dish made with layers of curried meat and rice. Given its use of adornments and luxurious finishes, it’s no surprise that biryani has roots in Persian cuisine.', '60 minutes', 600, 'chicken_biryani', 2),
(8, 'Chicken Fajita', 'Pizza topped with chicken, bell peppers, onions and salsa. Another family favorite that has been adapted from a Pillsbury Bake-off recipe. Prep time does not include time to make dough', '45 minutes', 1300, 'chicken_fajita', 4),
(9, 'Chicken Tandori', 'This Tandoori Chicken Pizza is the perfect blend of east and west. We’re talking a perfectly chewy crust made from scratch, tandoori chicken chunks, and lots of cheese of course!', '45 minutes', 1400, 'chicken_tandori', 4);

-- --------------------------------------------------------

--
-- Table structure for table `menu_ingredient`
--

CREATE TABLE `menu_ingredient` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `date_time` varchar(255) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `preparation_instructions` varchar(255) DEFAULT NULL,
  `ordercol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `restaurant_type` varchar(45) DEFAULT NULL,
  `rating` varchar(45) DEFAULT NULL,
  `image_filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `contact_number`, `address`, `city`, `restaurant_type`, `rating`, `image_filename`) VALUES
(1, 'Salt\'n Pepper', '042 88223301', 'Liberty', 'Lahore', 'Continental', '4.1', 'salt_n_pepper'),
(2, 'Haveli Restaurant', '03008414899', 'Opposite Badshahi Mosque, Shahi Mohallah', 'Lahore', 'Continental', '4.3', 'haveli'),
(3, 'Monal', '0426876756', 'Liberty Chowk', 'Lahore', 'Continental', '4.3', 'monal'),
(4, 'Domino\'s Pizza', '042111366466', 'M.M. Alam Road', 'Lahore', 'Fast Food', '4.1', 'dominos');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `user_type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `address`, `mobile`, `user_type`) VALUES
(4, 'ali', 'ali', 'Ali', 'Lahore', '03014444333', 'user'),
(5, 'hassan', 'hassan', 'Hassan', 'Lahore', '03313334444', 'restaurant_owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_ingredient`
--
ALTER TABLE `menu_ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu_ingredient`
--
ALTER TABLE `menu_ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
