-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2023 at 11:33 AM
-- Server version: 8.0.28
-- PHP Version: 7.4.33

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
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
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
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preparation_time` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `image_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restaurant_id` int NOT NULL
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
(9, 'Chicken Tandori', 'This Tandoori Chicken Pizza is the perfect blend of east and west. We’re talking a perfectly chewy crust made from scratch, tandoori chicken chunks, and lots of cheese of course!', '45 minutes', 1400, 'chicken_tandori', 4),
(10, 'Chicken Tikka', 'Chicken tikka is a chicken dish popularised in the Indian subcontinent during the Mughal era. The dish is popular in India, Bangladesh, Pakistan and the United Kingdom.', '30 minutes', 500, 'menu.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `menu_ingredient`
--

CREATE TABLE `menu_ingredient` (
  `id` int NOT NULL,
  `menu_id` int NOT NULL,
  `ingredient_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_ingredient`
--

INSERT INTO `menu_ingredient` (`id`, `menu_id`, `ingredient_id`) VALUES
(1, 1, 1),
(2, 1, 5),
(3, 1, 10),
(4, 1, 11),
(5, 1, 14),
(6, 1, 15),
(7, 1, 17),
(8, 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `date_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_id` int DEFAULT NULL,
  `ingredients` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preparation_instructions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `order_status` int NOT NULL,
  `special_dietary_requirements` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `any_allergy` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int DEFAULT NULL,
  `is_feedback_given` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `date_time`, `menu_id`, `ingredients`, `preparation_instructions`, `user_id`, `order_status`, `special_dietary_requirements`, `any_allergy`, `price`, `is_feedback_given`) VALUES
(1, '2023-12-03 21:37', 1, '', 'Cook well', 6, 4, 'Olives', 'Wheat', 1190, 1),
(2, '2023-12-04 00:31', 1, '', 'Cook on medium flame.', 6, 2, 'Add olives.', 'Avoid white flour.', 1190, 0),
(3, '2023-12-10 13:01', 1, '', 'Cook on medium flame', 6, 4, 'Avoid red chilli', 'No', 1190, 1),
(4, '2023-12-10 23:42', 10, '', 'It should be properly cooked', 6, 1, 'Less oily', 'No', 500, 0),
(5, '2023-12-10 23:49', 7, '', 'Add parseley.', 6, 1, 'Package properly', 'No', 600, 0),
(6, '2023-12-10 23:51', 6, '', 'Extra spicy', 6, 1, 'Add garlic', 'No', 1800, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_location`
--

CREATE TABLE `order_location` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_location`
--

INSERT INTO `order_location` (`id`, `order_id`, `latitude`, `longitude`) VALUES
(1, 1, 31.5539, 74.332),
(2, 2, 31.5534, 74.332),
(3, 3, 31.553, 74.332),
(4, 4, 31.553, 74.332),
(5, 5, 31.553, 74.332),
(6, 6, 31.553, 74.332);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restaurant_type` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `user_id`, `name`, `contact_number`, `address`, `city`, `restaurant_type`, `rating`, `image_filename`) VALUES
(1, 6, 'Salt\'n Pepper', '042 88223301', 'Liberty', 'Lahore', 'Continental', '4.1', 'salt_n_pepper'),
(2, 6, 'Haveli Restaurant', '03008414899', 'Opposite Badshahi Mosque, Shahi Mohallah', 'Lahore', 'Continental', '4.3', 'haveli'),
(3, 6, 'Monal', '0426876756', 'Liberty Chowk', 'Lahore', 'Continental', '4.3', 'monal'),
(4, 6, 'Domino\'s Pizza', '042111366466', 'M.M. Alam Road', 'Lahore', 'Fast Food', '4.1', 'dominos'),
(5, 13, 'Pizza Hut', '042678675', 'M M Alam Road', 'Lahore', 'Fast Food', '1', ''),
(6, 13, 'KFC', '042111443366', 'DHA III', 'Lahore', 'Fast Food', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_reviews`
--

CREATE TABLE `restaurant_reviews` (
  `id` int NOT NULL,
  `restaurant_id` int NOT NULL,
  `feedback` varchar(1024) COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL,
  `delivery_service` int NOT NULL,
  `overall_experience` int NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant_reviews`
--

INSERT INTO `restaurant_reviews` (`id`, `restaurant_id`, `feedback`, `rating`, `delivery_service`, `overall_experience`, `dt`) VALUES
(1, 1, 'Food was great. Neat and clean environment.', 4, 4, 4, '2023-12-30 10:59:35'),
(2, 1, 'This restaurant offers wide range of BBQ. We loved their seekh kababs. ', 5, 3, 4, '2023-12-30 10:59:35'),
(3, 1, 'I am satisfied.', 4, 5, 3, '2023-12-30 10:59:35'),
(4, 1, 'I had been ordering different food items from this restaurant. They were all good. Definitely I recommend this restaurant.', 5, 4, 5, '2023-12-30 10:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `address`, `mobile`, `user_type`) VALUES
(6, 'hasan', '82a5c663481036616824c0510f21ede50f734e63d14e5f657716ac38f3c0f9f6', 'Hasan', 'DHALahore', '0354354363', 'user'),
(7, 'sal', 'ffe2d77f8f34dd3e382569c525bb854853e2b42a98fb47927d9a7b7a881f0b04', 'Sal', 'DHA, Lahore', '0345645623', 'user'),
(9, 'aaa', '9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0', 'AAA', 'AAAAA', '767576565', 'user'),
(10, 'bb', '3b64db95cb55c763391c707108489ae18b4112d783300de38e033b4c98c3deaf', 'BB', 'BBB', '7687678', 'user'),
(13, 'nasir', 'e921bd3a79aa884506a8a1578c555c9548a9355d050974ccecc79baff4f45ce7', 'Nasir', 'Lahore', '034564579', 'restaurant_owner');

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
-- Indexes for table `order_location`
--
ALTER TABLE `order_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_reviews`
--
ALTER TABLE `restaurant_reviews`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu_ingredient`
--
ALTER TABLE `menu_ingredient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_location`
--
ALTER TABLE `order_location`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `restaurant_reviews`
--
ALTER TABLE `restaurant_reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
