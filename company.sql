-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 01:27 PM
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
-- Database: `company`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `the_users_email` VARCHAR(100) CHARSET utf8mb4)   SELECT * FROM users WHERE user_email = the_users_email$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `employee_salary` text DEFAULT NULL,
  `employee_created_at` text DEFAULT NULL,
  `employee_updated_at` text DEFAULT NULL,
  `employee_deleted_at` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_salary`, `employee_created_at`, `employee_updated_at`, `employee_deleted_at`) VALUES
(1, '18230145', '1283130912', '0', '0'),
(18, '3846044', '896767749', '0', '0'),
(22, '18390365', '206843142', '0', '0'),
(23, '14816176', '707322789', '0', '0'),
(26, '17269695', '1209401586', '0', '0'),
(28, '5100988', '875250832', '0', '0'),
(29, '6043591', '1340084723', '0', '0'),
(30, '23157118', '212519218', '0', '0'),
(36, '18624340', '1151725888', '0', '0'),
(37, '5434466', '893912994', '0', '0'),
(38, '23903409', '1543011194', '0', '0'),
(39, '19401437', '1095617215', '0', '0'),
(44, '4927785', '1338925430', '0', '0'),
(46, '16897662', '178347971', '0', '0'),
(53, '20205730', '712654163', '0', '0'),
(54, '23188688', '400837578', '0', '0'),
(58, '4931978', '1399897746', '0', '0'),
(60, '5010673', '1002158624', '0', '0'),
(61, '18704830', '226823471', '0', '0'),
(63, '24884904', '292307283', '0', '0'),
(64, '12085742', '1340036320', '0', '0'),
(65, '14970138', '1564466264', '0', '0'),
(71, '20375652', '692374340', '0', '0'),
(72, '18178439', '483049292', '0', '0'),
(74, '8316993', '505403271', '0', '0'),
(81, '15789381', '1097295486', '0', '0'),
(85, '4662001', '940693727', '0', '0'),
(93, '6515806', '623083103', '0', '0'),
(95, '23689869', '465697484', '0', '0'),
(98, '13705951', '1027832232', '0', '0'),
(103, '13219932', '1190678469', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` text DEFAULT NULL,
  `item_price` text DEFAULT NULL,
  `item_created_at` text DEFAULT NULL,
  `item_updated_at` text DEFAULT NULL,
  `item_deleted_at` text DEFAULT NULL,
  `item_created_by_user_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_price`, `item_created_at`, `item_updated_at`, `item_deleted_at`, `item_created_by_user_fk`) VALUES
(1, 'Dumplings ratione', '78', '1702816005', '0', '0', 84),
(2, 'Ice Cream laboriosam', '74', '1702816005', '0', '0', 4),
(3, 'Rice vel', '48', '1702816005', '0', '0', 45),
(4, 'Rice eum', '46', '1702816005', '0', '0', 84),
(5, 'Fish quas', '56', '1702816005', '0', '0', 20),
(6, 'Dumplings quibusdam', '37', '1702816005', '0', '0', 19),
(7, 'Cake explicabo', '80', '1702816005', '0', '0', 68),
(8, 'Soup qui', '95', '1702816005', '0', '0', 17),
(9, 'Pasta modi', '63', '1702816005', '0', '0', 43),
(10, 'Salad doloremque', '57', '1702816005', '0', '0', 68),
(11, 'Cake et', '26', '1702816005', '0', '0', 69),
(12, 'Chicken non', '37', '1702816005', '0', '0', 55),
(13, 'Fish eveniet', '79', '1702816005', '0', '0', 84),
(14, 'Burger iure', '98', '1702816005', '0', '0', 102),
(15, 'Tea voluptatem', '97', '1702816005', '0', '0', 17),
(16, 'Salad voluptas', '48', '1702816005', '0', '0', 83),
(17, 'Cake aut', '48', '1702816005', '0', '0', 51),
(18, 'Noodles facere', '12', '1702816005', '0', '0', 97),
(19, 'Pizza veritatis', '66', '1702816005', '0', '0', 17),
(20, 'Pizza nihil', '17', '1702816005', '0', '0', 3),
(21, 'Rice incidunt', '12', '1702816005', '0', '0', 48),
(22, 'Fish dolorum', '51', '1702816005', '0', '0', 43),
(23, 'Tacos nam', '65', '1702816005', '0', '0', 96),
(24, 'Soup est', '84', '1702816005', '0', '0', 6),
(25, 'Sushi nobis', '28', '1702816005', '0', '0', 50),
(26, 'Cake rerum', '22', '1702816005', '0', '0', 17),
(27, 'Salad ea', '69', '1702816005', '0', '0', 21),
(28, 'Pasta earum', '71', '1702816005', '0', '0', 91),
(29, 'Pizza quaerat', '62', '1702816005', '0', '0', 62),
(30, 'Coffee placeat', '88', '1702816005', '0', '0', 16),
(31, 'Pasta amet', '80', '1702816005', '0', '0', 68),
(32, 'Fish consequatur', '73', '1702816005', '0', '0', 51),
(33, 'Noodles recusandae', '87', '1702816005', '0', '0', 91),
(34, 'Fish excepturi', '97', '1702816005', '0', '0', 42),
(35, 'Chicken officiis', '90', '1702816005', '0', '0', 50),
(36, 'Juice assumenda', '72', '1702816005', '0', '0', 69),
(37, 'Curry ducimus', '19', '1702816005', '0', '0', 102),
(38, 'Coffee quae', '78', '1702816005', '0', '0', 82),
(39, 'Rice in', '71', '1702816005', '0', '0', 51),
(40, 'Rice vero', '36', '1702816005', '0', '0', 51),
(41, 'Noodles temporibus', '32', '1702816005', '0', '0', 51),
(42, 'Burger natus', '59', '1702816005', '0', '0', 102),
(43, 'Noodles at', '53', '1702816005', '0', '0', 99),
(44, 'Fish iste', '80', '1702816005', '0', '0', 79),
(45, 'Noodles repellendus', '10', '1702816005', '0', '0', 50),
(46, 'Rice nisi', '63', '1702816005', '0', '0', 17),
(47, 'Tea molestiae', '93', '1702816005', '0', '0', 86),
(48, 'Fish officia', '11', '1702816005', '0', '0', 45),
(49, 'Pasta distinctio', '81', '1702816005', '0', '0', 43),
(50, 'Ice Cream vitae', '80', '1702816005', '0', '0', 52),
(51, 'Soup odit', '33', '1702816005', '0', '0', 69),
(52, 'Dumplings quidem', '40', '1702816005', '0', '0', 80),
(53, 'Steak laudantium', '64', '1702816005', '0', '0', 79),
(54, 'Sandwich deserunt', '29', '1702816005', '0', '0', 55),
(55, 'Noodles atque', '24', '1702816005', '0', '0', 4),
(56, 'Rice libero', '73', '1702816005', '0', '0', 48),
(57, 'Fish minus', '59', '1702816005', '0', '0', 20),
(58, 'Sushi eligendi', '99', '1702816005', '0', '0', 20),
(59, 'Curry praesentium', '55', '1702816005', '0', '0', 77),
(60, 'Curry veniam', '91', '1702816005', '0', '0', 27),
(61, 'Soup quis', '74', '1702816005', '0', '0', 79),
(62, 'Cake sint', '72', '1702816005', '0', '0', 70),
(63, 'Salad voluptatum', '40', '1702816005', '0', '0', 27),
(64, 'Juice dolores', '54', '1702816005', '0', '0', 50),
(65, 'Soup consectetur', '52', '1702816005', '0', '0', 68),
(66, 'Pizza fuga', '16', '1702816005', '0', '0', 16),
(67, 'Soup iusto', '42', '1702816005', '0', '0', 27),
(68, 'Tea soluta', '50', '1702816005', '0', '0', 96),
(69, 'Salad magni', '48', '1702816005', '0', '0', 66),
(70, 'Sandwich tempora', '84', '1702816005', '0', '0', 86),
(71, 'Fish porro', '31', '1702816005', '0', '0', 16),
(72, 'Salad alias', '90', '1702816005', '0', '0', 102),
(73, 'Burger accusamus', '42', '1702816005', '0', '0', 68),
(74, 'Fish sed', '17', '1702816005', '0', '0', 66),
(75, 'Noodles nesciunt', '94', '1702816005', '0', '0', 97),
(76, 'Pasta velit', '90', '1702816005', '0', '0', 50),
(77, 'Rice harum', '10', '1702816005', '0', '0', 82),
(78, 'Dumplings optio', '24', '1702816005', '0', '0', 16),
(79, 'Chicken neque', '67', '1702816005', '0', '0', 42),
(80, 'Juice corporis', '66', '1702816005', '0', '0', 50),
(81, 'Cake autem', '88', '1702816005', '0', '0', 40),
(82, 'Chicken sit', '78', '1702816005', '0', '0', 79),
(83, 'Steak similique', '81', '1702816005', '0', '0', 3),
(84, 'Cake ut', '92', '1702816005', '0', '0', 70),
(85, 'Steak aliquam', '59', '1702816005', '0', '0', 84),
(86, 'Ice Cream magnam', '80', '1702816005', '0', '0', 16),
(87, 'Tea perferendis', '65', '1702816005', '0', '0', 21),
(88, 'Coffee maxime', '55', '1702816005', '0', '0', 82),
(89, 'Fish unde', '98', '1702816005', '0', '0', 79),
(90, 'Steak dolorem', '40', '1702816005', '0', '0', 55),
(91, 'Sandwich exercitationem', '84', '1702816005', '0', '0', 6),
(92, 'Tea saepe', '98', '1702816005', '0', '0', 83),
(93, 'Coffee sapiente', '73', '1702816005', '0', '0', 4),
(94, 'Fish corrupti', '84', '1702816005', '0', '0', 27),
(95, 'Burger nemo', '33', '1702816005', '0', '0', 34),
(96, 'Chicken esse', '42', '1702816005', '0', '0', 97),
(97, 'Steak aspernatur', '13', '1702816005', '0', '0', 70),
(98, 'Sandwich accusantium', '14', '1702816005', '0', '0', 32),
(99, 'Juice quia', '49', '1702816005', '0', '0', 48),
(100, 'Sandwich tempore', '20', '1702816005', '0', '0', 102);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_created_by_user_fk` int(11) DEFAULT NULL,
  `order_created_at` text DEFAULT NULL,
  `order_updated_at` text DEFAULT NULL,
  `order_deleted_at` text DEFAULT NULL,
  `order_delivered_at` text DEFAULT NULL,
  `order_delivered_by_user_fk` int(11) DEFAULT NULL,
  `order_placed_at_partner_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_created_by_user_fk`, `order_created_at`, `order_updated_at`, `order_deleted_at`, `order_delivered_at`, `order_delivered_by_user_fk`, `order_placed_at_partner_fk`) VALUES
(1, 78, '1702816006', '0', '0', '0', 22, 15),
(2, 57, '1702816006', '0', '0', '0', 44, 80),
(3, 100, '1702816006', '0', '0', '1704911787', 29, 43),
(4, 13, '1702816006', '0', '0', '0', 65, 21),
(5, 92, '1702816006', '0', '0', '0', 46, 66),
(6, 5, '1702816006', '0', '0', '0', 53, 51),
(7, 59, '1702816006', '0', '0', '0', 26, 96),
(8, 2, '1702816006', '0', '0', '0', 72, 50),
(9, 35, '1702816006', '0', '0', '0', 63, 80),
(10, 10, '1702816006', '0', '0', '1703597535', 81, 34),
(11, 33, '1702816006', '0', '0', '1702878824', 103, 86),
(12, 88, '1702816006', '0', '0', '0', 22, 27),
(13, 59, '1702816006', '0', '0', '0', 23, 99),
(14, 67, '1702816006', '0', '0', '1703638642', 38, 32),
(15, 56, '1702816006', '0', '0', '1703982807', 23, 96),
(16, 78, '1702816006', '0', '0', '0', 98, 15),
(17, 31, '1702816006', '0', '0', '1703235271', 36, 79),
(18, 41, '1702816006', '0', '0', '0', 72, 40),
(19, 14, '1702816006', '0', '0', '0', 64, 20),
(20, 25, '1702816006', '0', '0', '1703769667', 103, 45),
(21, 24, '1702816006', '0', '0', '1705345023', 53, 84),
(22, 49, '1702816006', '0', '0', '1704477260', 72, 34),
(23, 31, '1702816006', '0', '0', '0', 71, 43),
(24, 14, '1702816006', '0', '0', '0', 1, 43),
(25, 90, '1702816006', '0', '0', '0', 93, 86),
(26, 92, '1702816006', '0', '0', '1702841944', 39, 80),
(27, 87, '1702816006', '0', '0', '0', 64, 27),
(28, 78, '1702816006', '0', '0', '0', 22, 19),
(29, 11, '1702816006', '0', '0', '1705307330', 36, 6),
(30, 49, '1702816006', '0', '0', '0', 38, 43),
(31, 90, '1702816006', '0', '0', '0', 95, 82),
(32, 33, '1702816006', '0', '0', '1703066164', 28, 102),
(33, 90, '1702816006', '0', '0', '1704284811', 85, 42),
(34, 24, '1702816006', '0', '0', '0', 37, 3),
(35, 7, '1702816006', '0', '0', '0', 95, 15),
(36, 47, '1702816006', '0', '0', '1703607160', 30, 51),
(37, 76, '1702816006', '0', '0', '1703515332', 38, 16),
(38, 100, '1702816006', '0', '0', '1705218638', 63, 70),
(39, 76, '1702816006', '0', '0', '1703706092', 29, 84),
(40, 33, '1702816006', '0', '0', '1704775754', 103, 102),
(41, 11, '1702816006', '0', '0', '0', 1, 66),
(42, 89, '1702816006', '0', '0', '1702872692', 30, 4),
(43, 35, '1702816006', '0', '0', '1703527074', 44, 50),
(44, 75, '1702816006', '0', '0', '0', 98, 45),
(45, 8, '1702816006', '0', '0', '1703599437', 39, 34),
(46, 87, '1702816006', '0', '0', '0', 58, 51),
(47, 92, '1702816006', '0', '0', '1704153322', 38, 102),
(48, 25, '1702816006', '0', '0', '1703790983', 54, 20),
(49, 56, '1702816006', '0', '0', '1704818475', 103, 70),
(50, 9, '1702816006', '0', '0', '0', 63, 15),
(51, 13, '1702816006', '0', '0', '0', 53, 97),
(52, 76, '1702816006', '0', '0', '1704766104', 58, 43),
(53, 9, '1702816006', '0', '0', '1704784033', 54, 40),
(54, 88, '1702816006', '0', '0', '0', 71, 70),
(55, 41, '1702816006', '0', '0', '0', 39, 21),
(56, 35, '1702816006', '0', '0', '1705008379', 72, 97),
(57, 8, '1702816006', '0', '0', '0', 98, 19),
(58, 67, '1702816006', '0', '0', '0', 103, 68),
(59, 41, '1702816006', '0', '0', '1704789988', 30, 3),
(60, 94, '1702816006', '0', '0', '0', 38, 77),
(61, 7, '1702816006', '0', '0', '0', 46, 45),
(62, 25, '1702816006', '0', '0', '0', 30, 40),
(63, 76, '1702816006', '0', '0', '0', 60, 52),
(64, 94, '1702816006', '0', '0', '0', 30, 82),
(65, 76, '1702816006', '0', '0', '0', 54, 66),
(66, 2, '1702816006', '0', '0', '1705239775', 54, 97),
(67, 13, '1702816006', '0', '0', '1704941941', 65, 50),
(68, 5, '1702816006', '0', '0', '1705141880', 53, 99),
(69, 47, '1702816006', '0', '0', '0', 22, 34),
(70, 8, '1702816006', '0', '0', '1704682421', 54, 68),
(71, 88, '1702816006', '0', '0', '1703174006', 81, 84),
(72, 41, '1702816006', '0', '0', '1703972779', 58, 21),
(73, 94, '1702816006', '0', '0', '1704276821', 93, 82),
(74, 31, '1702816006', '0', '0', '1703842921', 93, 45),
(75, 2, '1702816006', '0', '0', '1703816778', 72, 43),
(76, 76, '1702816006', '0', '0', '0', 23, 40),
(77, 25, '1702816006', '0', '0', '0', 58, 51),
(78, 59, '1702816006', '0', '0', '0', 30, 80),
(79, 100, '1702816006', '0', '0', '1702961263', 39, 6),
(80, 35, '1702816006', '0', '0', '1703352509', 44, 84),
(81, 13, '1702816006', '0', '0', '1703261349', 46, 45),
(82, 41, '1702816006', '0', '0', '1705252896', 71, 34),
(83, 100, '1702816006', '0', '0', '0', 98, 19),
(84, 35, '1702816006', '0', '0', '1703118373', 29, 21),
(85, 10, '1702816006', '0', '0', '0', 60, 34),
(86, 49, '1702816006', '0', '0', '0', 36, 68),
(87, 75, '1702816006', '0', '0', '0', 28, 102),
(88, 87, '1702816006', '0', '0', '1704252883', 26, 4),
(89, 59, '1702816006', '0', '0', '0', 60, 62),
(90, 56, '1702816006', '0', '0', '1703310342', 58, 69),
(91, 59, '1702816006', '0', '0', '0', 95, 40),
(92, 47, '1702816006', '0', '0', '0', 1, 97),
(93, 87, '1702816006', '0', '0', '1703203592', 103, 102),
(94, 47, '1702816006', '0', '0', '1703658901', 85, 55),
(95, 90, '1702816006', '0', '0', '0', 103, 69),
(96, 67, '1702816006', '0', '0', '1703053492', 74, 6),
(97, 47, '1702816006', '0', '0', '0', 103, 21),
(98, 73, '1702816006', '0', '0', '0', 29, 17),
(99, 87, '1702816006', '0', '0', '1705282993', 85, 48),
(100, 13, '1702816006', '0', '0', '0', 71, 15);

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `orders_items_id` int(11) NOT NULL,
  `orders_items_order_fk` text DEFAULT NULL,
  `orders_items_item_fk` text DEFAULT NULL,
  `orders_items_total_price` text DEFAULT NULL,
  `orders_items_item_quantity` text DEFAULT NULL,
  `orders_items_created_at` text DEFAULT NULL,
  `orders_items_updated_at` text DEFAULT NULL,
  `orders_items_deleted_at` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`orders_items_id`, `orders_items_order_fk`, `orders_items_item_fk`, `orders_items_total_price`, `orders_items_item_quantity`, `orders_items_created_at`, `orders_items_updated_at`, `orders_items_deleted_at`) VALUES
(1, '65', '49', '243', '3', '1122327883', '0', '0'),
(2, '90', '55', '120', '5', '291841823', '0', '0'),
(3, '4', '78', '72', '3', '1431663209', '0', '0'),
(4, '85', '24', '252', '3', '888252603', '0', '0'),
(5, '65', '81', '176', '2', '908409168', '0', '0'),
(6, '24', '86', '320', '4', '1627820823', '0', '0'),
(7, '73', '83', '405', '5', '210929331', '0', '0'),
(8, '17', '92', '294', '3', '1571496725', '0', '0'),
(9, '61', '14', '294', '3', '192761306', '0', '0'),
(10, '62', '24', '168', '2', '379107049', '0', '0'),
(11, '91', '94', '84', '1', '196614745', '0', '0'),
(12, '48', '88', '275', '5', '1380930253', '0', '0'),
(13, '9', '69', '192', '4', '1556249144', '0', '0'),
(14, '92', '4', '138', '3', '829806303', '0', '0'),
(15, '33', '85', '295', '5', '1251827954', '0', '0'),
(16, '49', '3', '192', '4', '981389645', '0', '0'),
(17, '87', '95', '132', '4', '894927419', '0', '0'),
(18, '95', '88', '55', '1', '1371140465', '0', '0'),
(19, '44', '96', '168', '4', '1351049689', '0', '0'),
(20, '83', '53', '64', '1', '1442720528', '0', '0'),
(21, '35', '23', '195', '3', '541533892', '0', '0'),
(22, '27', '60', '364', '4', '578406947', '0', '0'),
(23, '82', '83', '162', '2', '1685430947', '0', '0'),
(24, '45', '99', '196', '4', '574462282', '0', '0'),
(25, '32', '34', '388', '4', '179789088', '0', '0'),
(26, '81', '81', '264', '3', '1521843818', '0', '0'),
(27, '70', '75', '470', '5', '842980187', '0', '0'),
(28, '19', '93', '146', '2', '1648266468', '0', '0'),
(29, '35', '84', '276', '3', '585726313', '0', '0'),
(30, '74', '52', '120', '3', '1691573688', '0', '0'),
(31, '72', '12', '111', '3', '1300826442', '0', '0'),
(32, '55', '38', '78', '1', '179418358', '0', '0'),
(33, '65', '90', '40', '1', '959014308', '0', '0'),
(34, '72', '3', '192', '4', '322799776', '0', '0'),
(35, '20', '69', '96', '2', '844801416', '0', '0'),
(36, '76', '27', '345', '5', '943276884', '0', '0'),
(37, '75', '58', '99', '1', '183543048', '0', '0'),
(38, '17', '72', '360', '4', '984840579', '0', '0'),
(39, '56', '46', '315', '5', '914138191', '0', '0'),
(40, '46', '26', '88', '4', '1024232597', '0', '0'),
(41, '48', '76', '270', '3', '939331740', '0', '0'),
(42, '3', '97', '13', '1', '1303288571', '0', '0'),
(43, '52', '42', '118', '2', '850307945', '0', '0'),
(44, '43', '37', '38', '2', '1570243566', '0', '0'),
(45, '39', '67', '84', '2', '1207384849', '0', '0'),
(46, '58', '38', '156', '2', '581888805', '0', '0'),
(47, '64', '91', '168', '2', '640565026', '0', '0'),
(48, '55', '10', '228', '4', '507746583', '0', '0'),
(49, '48', '99', '147', '3', '500013789', '0', '0'),
(50, '77', '23', '325', '5', '1460487865', '0', '0'),
(51, '93', '32', '219', '3', '186023068', '0', '0'),
(52, '29', '73', '126', '3', '688203839', '0', '0'),
(53, '63', '55', '48', '2', '1093178714', '0', '0'),
(54, '2', '74', '85', '5', '112622336', '0', '0'),
(55, '71', '45', '20', '2', '513246082', '0', '0'),
(56, '24', '41', '64', '2', '691565442', '0', '0'),
(57, '79', '88', '165', '3', '193016948', '0', '0'),
(58, '54', '33', '435', '5', '1337217576', '0', '0'),
(59, '18', '84', '276', '3', '970724676', '0', '0'),
(60, '16', '74', '17', '1', '195085921', '0', '0'),
(61, '10', '45', '10', '1', '136725961', '0', '0'),
(62, '24', '21', '60', '5', '1469062082', '0', '0'),
(63, '75', '29', '186', '3', '449041375', '0', '0'),
(64, '40', '35', '450', '5', '1458063803', '0', '0'),
(65, '7', '82', '78', '1', '415708915', '0', '0'),
(66, '48', '75', '188', '2', '210904650', '0', '0'),
(67, '33', '73', '168', '4', '247857516', '0', '0'),
(68, '28', '20', '85', '5', '598176841', '0', '0'),
(69, '40', '2', '370', '5', '1640347264', '0', '0'),
(70, '25', '62', '216', '3', '922488465', '0', '0'),
(71, '22', '24', '84', '1', '1394443276', '0', '0'),
(72, '74', '20', '85', '5', '482947650', '0', '0'),
(73, '20', '88', '275', '5', '727993342', '0', '0'),
(74, '84', '99', '147', '3', '496646931', '0', '0'),
(75, '63', '29', '186', '3', '578486592', '0', '0'),
(76, '40', '20', '68', '4', '1130703167', '0', '0'),
(77, '45', '95', '165', '5', '1216742483', '0', '0'),
(78, '35', '85', '295', '5', '251637187', '0', '0'),
(79, '42', '5', '112', '2', '595953638', '0', '0'),
(80, '13', '15', '388', '4', '1121537445', '0', '0'),
(81, '54', '68', '100', '2', '1453738151', '0', '0'),
(82, '98', '46', '63', '1', '567647572', '0', '0'),
(83, '97', '93', '365', '5', '264348324', '0', '0'),
(84, '24', '61', '74', '1', '899304526', '0', '0'),
(85, '79', '40', '36', '1', '121590177', '0', '0'),
(86, '23', '31', '320', '4', '1382149798', '0', '0'),
(87, '96', '85', '295', '5', '1058704916', '0', '0'),
(88, '81', '19', '198', '3', '1634898160', '0', '0'),
(89, '90', '45', '40', '4', '1542280404', '0', '0'),
(90, '78', '75', '470', '5', '1447598755', '0', '0'),
(91, '57', '10', '228', '4', '1317019014', '0', '0'),
(92, '38', '13', '237', '3', '566075440', '0', '0'),
(93, '92', '68', '50', '1', '212104421', '0', '0'),
(94, '36', '47', '372', '4', '1210024520', '0', '0'),
(95, '41', '57', '236', '4', '688336201', '0', '0'),
(96, '32', '85', '177', '3', '1671986325', '0', '0'),
(97, '88', '94', '420', '5', '540468679', '0', '0'),
(98, '30', '82', '312', '4', '741776766', '0', '0'),
(99, '73', '40', '72', '2', '309738002', '0', '0'),
(100, '90', '14', '294', '3', '1632950231', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `user_partner_id` int(11) NOT NULL,
  `partner_geo` text DEFAULT NULL,
  `partner_name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`user_partner_id`, `partner_geo`, `partner_name`) VALUES
(3, '8.153619,132.128576', 'ziemann.com'),
(4, '88.648672,0.951662', 'gottlieb.info'),
(6, '16.002156,-159.502533', 'yundt.com'),
(15, '-12.616277,-105.335968', 'johnson.info'),
(16, '66.474861,-53.547171', 'rutherford.info'),
(17, '66.284323,135.837521', 'botsford.com'),
(19, '27.510837,-163.035778', 'von.com'),
(20, '-71.486505,18.218841', 'grady.com'),
(21, '86.381054,42.871986', 'connelly.com'),
(27, '-81.513635,99.475897', 'maggio.net'),
(32, '-60.684798,117.160465', 'hauck.net'),
(34, '-28.217252,-32.131132', 'kuhn.com'),
(40, '18.657486,-118.410176', 'hagenes.info'),
(42, '69.192076,38.337973', 'klein.org'),
(43, '63.35419,-13.801833', 'bartoletti.com'),
(45, '-76.884038,18.872775', 'mills.info'),
(48, '32.056146,-83.569268', 'labadie.com'),
(50, '-59.023647,39.590343', 'schiller.net'),
(51, '2.862453,-146.533875', 'haag.com'),
(52, '-52.414576,-163.704763', 'hagenes.org'),
(55, '46.085888,16.063774', 'gerlach.com'),
(62, '-49.130452,50.485367', 'kuvalis.net'),
(66, '54.553394,-139.173016', 'schamberger.com'),
(68, '23.828687,-68.460432', 'satterfield.com'),
(69, '22.161445,164.535356', 'waters.com'),
(70, '40.372537,31.734016', 'cruickshank.com'),
(77, '-78.08573,-31.035332', 'rosenbaum.com'),
(79, '84.504696,59.457935', 'okeefe.info'),
(80, '30.463509,-170.915068', 'predovic.com'),
(82, '56.741927,79.706916', 'weimann.org'),
(83, '15.537783,82.170382', 'gleason.org'),
(84, '8.095735,105.537718', 'welch.com'),
(86, '-35.43933,-61.763828', 'christiansen.info'),
(91, '-88.259317,-41.051737', 'greenholt.com'),
(96, '-15.767392,-57.29199', 'terry.com'),
(97, '7.970688,-69.186452', 'dare.org'),
(99, '-59.76783,-109.59394', 'schiller.com'),
(102, '-64.876898,50.937764', 'farrell.com');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` text DEFAULT NULL,
  `role_created_at` text DEFAULT NULL,
  `role_updated_at` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_created_at`, `role_updated_at`) VALUES
(1, 'partner', '1702816005', '0'),
(2, 'customer', '1702816005', '0'),
(3, 'employee', '1702816005', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` text DEFAULT NULL,
  `user_last_name` text DEFAULT NULL,
  `user_email` text DEFAULT NULL,
  `user_password` text DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_role_name` text DEFAULT NULL,
  `user_tag_color` text DEFAULT NULL,
  `user_created_at` text DEFAULT NULL,
  `user_updated_at` text DEFAULT NULL,
  `user_deleted_at` text DEFAULT NULL,
  `user_is_blocked` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_last_name`, `user_email`, `user_password`, `user_address`, `user_role_name`, `user_tag_color`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `user_is_blocked`) VALUES
(1, 'Josianne', 'Gorczany', 'schaden.shana@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '2770 Ibrahim Heights\nSavanahmouth, MN 13208-3510', 'employee', '#69f89b', '1702816005', '1702816005', '0', 0),
(2, 'Cydney', 'O\'Connell', 'barrett.streich@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '774 Gerlach Viaduct\nNorth Reganborough, IL 54789-7370', 'customer', '#483f39', '1702816005', '1702816005', '0', 0),
(3, 'Delfina', 'Witting', 'qbauch@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '949 Gerardo Lakes Suite 879\nNorth Marcellefurt, TX 78259-0565', 'partner', '#6b2486', '1702816005', '1702816005', '0', 0),
(4, 'Earline', 'Turcotte', 'camryn58@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '4287 Smitham Curve\nFramichester, ID 86898-3511', 'partner', '#b314c5', '1702816005', '1702816005', '0', 0),
(5, 'Dell', 'Schuppe', 'alvera84@effertz.info', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '3384 Ondricka Fork Suite 823\nWest Lillaland, NM 48569', 'customer', '#92cb61', '1702816005', '1702816005', '0', 0),
(6, 'Jeremie', 'Lebsack', 'kelsie.luettgen@goodwin.org', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '3798 Richard Parks Apt. 996\nSouth Christine, MD 71137-2681', 'partner', '#458564', '1702816005', '1702816005', '0', 0),
(7, 'Rahul', 'Rippin', 'maryam25@bosco.org', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '92204 Sauer Trail Apt. 648\nWest Serena, WV 02004-7725', 'customer', '#38bf42', '1702816005', '1702816005', '0', 0),
(8, 'Stephany', 'Breitenberg', 'damion67@waelchi.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '970 Willie Center\nHegmannland, WA 95912-1747', 'customer', '#6ed466', '1702816005', '1702816005', '0', 0),
(9, 'Pauline', 'O\'Hara', 'glenda.bednar@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '33923 Hauck Ridge Suite 443\nNorth Jayne, CT 32491-2081', 'customer', '#3b766c', '1702816005', '1702816005', '0', 0),
(10, 'Timothy', 'Swaniawski', 'marvin.aaron@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '685 Lowe Fork\nTierrabury, NJ 31109', 'customer', '#69896b', '1702816005', '1702816005', '0', 0),
(11, 'Carmella', 'Hauck', 'durward00@muller.info', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '74470 Bins Haven Suite 480\nSavanahhaven, MD 63164-6133', 'customer', '#878938', '1702816005', '1702816005', '0', 0),
(12, 'Arnaldo', 'Abernathy', 'jason86@stokes.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '96063 Green Crest Apt. 685\nHollieberg, NC 33154', 'customer', '#548633', '1702816005', '1702816005', '0', 0),
(13, 'Elinor', 'Wiza', 'harmony.robel@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '643 Davon Dam Apt. 746\nHegmannborough, AZ 50328-2173', 'customer', '#1d1315', '1702816005', '1702816005', '0', 0),
(14, 'Emma', 'Blanda', 'lydia42@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '635 Runolfsdottir Springs Suite 798\nLelahside, IA 51528-9524', 'customer', '#593c36', '1702816005', '1702816005', '0', 0),
(15, 'Joy', 'Ledner', 'ottilie48@witting.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '3142 Jacobs Creek\nNew Rocky, ID 43732-7445', 'partner', '#3c340a', '1702816005', '1702816005', '0', 0),
(16, 'Maybelle', 'Durgan', 'jasper04@daniel.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '5047 Orlo Bridge Apt. 124\nGrahamborough, OR 49997-5088', 'partner', '#c82a2a', '1702816005', '1702816005', '0', 0),
(17, 'Lowell', 'Haley', 'dibbert.arnoldo@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '1410 Vandervort Valleys\nSouth Deannashire, ME 80247-2479', 'partner', '#bb1a09', '1702816005', '1702816005', '0', 0),
(18, 'Mathias', 'Hermann', 'edyth.schulist@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '8075 Mills Parkway\nLake Jessikatown, CA 01496', 'employee', '#7c9cda', '1702816005', '1702816005', '0', 0),
(19, 'Cameron', 'Waters', 'tremblay.prince@rohan.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '5690 Jerde Cove Suite 589\nMohrview, VA 88914', 'partner', '#bb036e', '1702816005', '1702816005', '0', 0),
(20, 'Juana', 'Walsh', 'kferry@satterfield.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '762 Cecilia Inlet\nEast Garrison, OH 06475', 'partner', '#a9935d', '1702816005', '1702816005', '0', 0),
(21, 'Lila', 'Kirlin', 'harley.simonis@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '92249 Jesse Wall\nAylinburgh, MT 87328', 'partner', '#c07589', '1702816005', '1702816005', '0', 0),
(22, 'Filomena', 'Casper', 'federico78@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '489 Gulgowski Lakes Suite 156\nPort Kaylieton, CT 69144', 'employee', '#8f1bc6', '1702816005', '1702816005', '0', 0),
(23, 'Alec', 'Bosco', 'windler.warren@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '86189 Art Summit\nWest Jessbury, OH 92095-0486', 'employee', '#67d7ae', '1702816005', '1702816005', '0', 0),
(24, 'Rico', 'Marquardt', 'alyce61@roob.net', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '72342 Schmeler Mountains\nSolonberg, AK 19694-6007', 'customer', '#2330a7', '1702816005', '1702816005', '0', 0),
(25, 'Tommie', 'Durgan', 'roob.jaylin@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '371 Botsford Via\nTrantowstad, HI 54184-4800', 'customer', '#e87403', '1702816005', '1702816005', '0', 0),
(26, 'Rosalinda', 'Homenick', 'hirthe.orin@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '609 Yesenia Junction Apt. 376\nKautzerside, PA 06932', 'employee', '#6f0ed8', '1702816005', '1702816005', '0', 0),
(27, 'Isabell', 'Paucek', 'uzemlak@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '3695 Wyman Loop Suite 678\nWest Guidoshire, CA 49698', 'partner', '#87d769', '1702816005', '1702816005', '0', 0),
(28, 'Selina', 'Lebsack', 'emmanuel33@williamson.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '62827 Douglas Loop\nEast Chynastad, VA 31672-7646', 'employee', '#0a7521', '1702816005', '1702816005', '0', 0),
(29, 'Rodrigo', 'Johnson', 'ukunze@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '417 Okuneva Fields\nPort Leo, IN 52741-5032', 'employee', '#e875e9', '1702816005', '1702816005', '0', 0),
(30, 'Estelle', 'Mertz', 'dortha92@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '8845 Kelton Unions Suite 339\nWest Elmore, PA 51009', 'employee', '#edf83f', '1702816005', '1702816005', '0', 0),
(31, 'Russell', 'Dickens', 'ortiz.carmelo@ward.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '971 Walter Hills\nNorth Lucius, SC 18853-9214', 'customer', '#8c387d', '1702816005', '1702816005', '0', 0),
(32, 'Destinee', 'Kemmer', 'darlene.mitchell@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '3259 Brown Islands\nHarrishaven, CA 83560-0968', 'partner', '#1e2812', '1702816005', '1702816005', '0', 0),
(33, 'Enola', 'Luettgen', 'agustina09@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '86291 Corrine Forge Apt. 676\nJaquanstad, FL 98098-2094', 'customer', '#0670c1', '1702816005', '1702816005', '0', 0),
(34, 'Rogers', 'Trantow', 'dulce75@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '8079 Viva Dale Suite 371\nCieloburgh, IA 33354', 'partner', '#56c9f8', '1702816005', '1702816005', '0', 0),
(35, 'Chesley', 'Hodkiewicz', 'kschaefer@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '52458 Blick Path\nWest Xavierberg, CT 15082-3796', 'customer', '#881df5', '1702816005', '1702816005', '0', 0),
(36, 'Judd', 'Yundt', 'dsporer@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '42911 Rempel Forks\nWest Jeanieland, OK 69511', 'employee', '#515aa4', '1702816005', '1702816005', '0', 0),
(37, 'Elinore', 'Daniel', 'jacobson.toy@gleichner.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '39549 Marina Village\nLake Eino, UT 89501-7994', 'employee', '#c27188', '1702816005', '1702816005', '0', 0),
(38, 'Alexie', 'Keeling', 'walker.anissa@hudson.org', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '2440 Ruthe Point\nDariusmouth, OK 51565-5759', 'employee', '#bbba25', '1702816005', '1702816005', '0', 0),
(39, 'Leanna', 'Bashirian', 'florine.oreilly@fahey.biz', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '696 Kaylin Avenue Suite 365\nLake Desireefort, DE 20515', 'employee', '#4ff878', '1702816005', '1702816005', '0', 0),
(40, 'Marie', 'Champlin', 'adolphus79@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '533 Thomas Junctions Apt. 829\nNorth Fernandofurt, NY 21760', 'partner', '#965987', '1702816005', '1702816005', '0', 0),
(41, 'Mandy', 'Hills', 'agislason@mckenzie.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '87990 Cedrick Lights Suite 830\nNew Payton, TX 40626', 'customer', '#db8710', '1702816005', '1702816005', '0', 0),
(42, 'Candida', 'Torp', 'runolfsdottir.letitia@baumbach.org', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '54218 Arden Island\nSouth Sylvan, AK 34934', 'partner', '#6eb5e9', '1702816005', '1702816005', '0', 0),
(43, 'Francisca', 'Heaney', 'baby.jaskolski@ratke.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '4229 Susan Centers\nSouth Eric, UT 91770', 'partner', '#208201', '1702816005', '1702816005', '0', 0),
(44, 'Aliyah', 'Wisoky', 'dulce.legros@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '50812 Elise Gardens\nWeberland, OK 58157-3154', 'employee', '#896c09', '1702816005', '1702816005', '0', 0),
(45, 'Irma', 'Stokes', 'madeline49@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '3638 Jerrold Drive Apt. 941\nRueckershire, IA 36510-4970', 'partner', '#1ced1b', '1702816005', '1702816005', '0', 0),
(46, 'Nico', 'Mante', 'irma.jerde@jakubowski.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '46699 Hettinger Gardens\nNew Yasminborough, NV 67278-7414', 'employee', '#0b0aca', '1702816005', '1702816005', '0', 0),
(47, 'Haley', 'Schmitt', 'connie14@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '332 Gulgowski Cove\nEast Adela, MS 15746', 'customer', '#fa1d62', '1702816005', '1702816005', '0', 0),
(48, 'Baby', 'Kuhic', 'kweimann@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '2812 Blanda Island Apt. 521\nSchmelerport, MT 00939-2665', 'partner', '#217148', '1702816005', '1702816005', '0', 0),
(49, 'Daren', 'Abernathy', 'kristin.metz@mclaughlin.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '39169 Stark Rapid Suite 782\nNew Queenborough, PA 62820', 'customer', '#9097a1', '1702816005', '1702816005', '0', 0),
(50, 'Henderson', 'Larkin', 'electa.rodriguez@jones.biz', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '4807 Beer Wells\nSouth Alexieberg, MT 70680-1484', 'partner', '#8a2654', '1702816005', '1702816005', '0', 0),
(51, 'Arthur', 'Lindgren', 'phirthe@pouros.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '33909 Stamm Lakes\nKautzerstad, DC 92313', 'partner', '#1a5b54', '1702816005', '1702816005', '0', 0),
(52, 'Cecil', 'Lesch', 'camille04@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '82323 Orlo Tunnel\nGeovannyberg, NM 37222', 'partner', '#31cdb5', '1702816005', '1702816005', '0', 0),
(53, 'Darian', 'Gerlach', 'audra.batz@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '91639 Marjolaine Cliffs\nO\'Keefemouth, SC 63486-2287', 'employee', '#ca3d8d', '1702816005', '1702816005', '0', 0),
(54, 'Peter', 'Stroman', 'kdavis@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '70452 Nikolaus Keys Suite 611\nJessyborough, WV 40389', 'employee', '#c973ad', '1702816005', '1702816005', '0', 0),
(55, 'Elijah', 'Fahey', 'bernier.tyra@torp.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '155 Wilfred Land\nNew Devin, DE 46229-6431', 'partner', '#380584', '1702816005', '1702816005', '0', 0),
(56, 'Estelle', 'Reinger', 'dallin94@johns.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '33441 Durgan Key\nPort Joanfort, WA 74868-6118', 'customer', '#6a9438', '1702816005', '1702816005', '0', 0),
(57, 'Ray', 'Kozey', 'langosh.lurline@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '4921 Gottlieb Overpass\nSouth Daishaberg, VA 40376-9561', 'customer', '#3b24b2', '1702816005', '1702816005', '0', 0),
(58, 'Asia', 'Bartell', 'matilda02@schimmel.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '18033 Purdy Extension\nPort Mireya, AL 74028-6478', 'employee', '#14fd1b', '1702816005', '1702816005', '0', 0),
(59, 'Carolanne', 'Bashirian', 'jayce73@maggio.net', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '548 Paucek Rapid Suite 266\nPort Bryon, MA 76814-5223', 'customer', '#45acb8', '1702816005', '1702816005', '0', 0),
(60, 'Claudie', 'Koss', 'senger.maxine@muller.org', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '25795 Hubert Drive Apt. 778\nZiemeshire, NJ 06539-7652', 'employee', '#1f4709', '1702816005', '1702816005', '0', 0),
(61, 'Hailey', 'Braun', 'flo13@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '1168 Hane Knolls\nNorth Mafalda, IN 09206-8961', 'employee', '#fd804b', '1702816005', '1702816005', '0', 0),
(62, 'Carli', 'Russel', 'alfonso.mann@koch.net', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '5412 Okuneva Point\nPort Robbiehaven, CA 57751-6643', 'partner', '#8b519f', '1702816005', '1702816005', '0', 0),
(63, 'Lyda', 'Mayert', 'alison.hermann@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '13033 Magnolia Walks Apt. 925\nBahringerfort, WI 89792', 'employee', '#a6ecbc', '1702816005', '1702816005', '0', 0),
(64, 'Phoebe', 'Heidenreich', 'grady.charlene@goyette.info', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '309 Elvis Ramp\nKozeybury, AK 75097-1539', 'employee', '#5d9705', '1702816005', '1702816005', '0', 0),
(65, 'Retha', 'Cartwright', 'camila.legros@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '4046 Amparo Rapids Suite 078\nO\'Connellhaven, ID 48418', 'employee', '#8d4e9b', '1702816005', '1702816005', '0', 0),
(66, 'Magdalena', 'Kemmer', 'lavinia56@prohaska.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '74979 Feeney Mills Suite 080\nMarkusstad, KS 68519-0390', 'partner', '#5450fd', '1702816005', '1702816005', '0', 0),
(67, 'Keyon', 'Cronin', 'jlittle@stanton.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '2506 McDermott Valleys Apt. 560\nHildachester, MO 65093-4247', 'customer', '#b82014', '1702816005', '1702816005', '0', 0),
(68, 'Caesar', 'Kozey', 'bbode@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '191 Macejkovic Shoals\nEast Terrell, KS 51073-5859', 'partner', '#7b6e34', '1702816005', '1702816005', '0', 0),
(69, 'Lamar', 'Kautzer', 'zschmeler@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '11760 Finn Spur\nJavontemouth, CO 18963', 'partner', '#959228', '1702816005', '1702816005', '0', 0),
(70, 'Oral', 'Nitzsche', 'cwilliamson@weissnat.org', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '2133 Grimes Hills Apt. 431\nHermannborough, VA 08832', 'partner', '#7f6154', '1702816005', '1702816005', '0', 0),
(71, 'Alaina', 'Eichmann', 'iveum@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '8393 Jonatan Harbors\nSuzanneland, WA 63778-2428', 'employee', '#5950c3', '1702816005', '1702816005', '0', 0),
(72, 'Milton', 'Bartell', 'ggaylord@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '261 Zoe Circle\nGloverfurt, MA 13104-9838', 'employee', '#1eb979', '1702816005', '1702816005', '0', 0),
(73, 'Rosemary', 'King', 'mnitzsche@bergstrom.info', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '3088 Laila Roads\nMacymouth, MO 43508-4166', 'customer', '#598157', '1702816005', '1702816005', '0', 0),
(74, 'Selmer', 'Heaney', 'breanna.hahn@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '37331 Ericka Grove Apt. 774\nPort Anitabury, MA 66865', 'employee', '#3a298d', '1702816005', '1702816005', '0', 0),
(75, 'Burley', 'Kerluke', 'callie21@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '21355 Johnson Pike\nRobertsbury, NC 27005', 'customer', '#54aa3f', '1702816005', '1702816005', '0', 0),
(76, 'Lori', 'Larson', 'wilfred.mraz@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '18981 Danyka Wells Suite 225\nPort Janelle, NC 30975-8809', 'customer', '#162647', '1702816005', '1702816005', '0', 0),
(77, 'Elyssa', 'Kohler', 'llebsack@swift.net', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '970 Lindgren Station\nLemuelchester, ND 64274', 'partner', '#12b903', '1702816005', '1702816005', '0', 0),
(78, 'Herminio', 'Roberts', 'ettie10@rutherford.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '5524 Jeromy Unions\nWest Virgil, TN 94122', 'customer', '#37a18f', '1702816005', '1702816005', '0', 0),
(79, 'Irving', 'Muller', 'tbuckridge@huel.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '875 Blick Curve Suite 648\nEverettehaven, MN 77195', 'partner', '#281125', '1702816005', '1702816005', '0', 0),
(80, 'Maudie', 'Larkin', 'gladyce.bartoletti@romaguera.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '309 Marcelino Station\nWest Cecil, VT 20992', 'partner', '#5891e3', '1702816005', '1702816005', '0', 0),
(81, 'Noemi', 'Marks', 'kfeest@harris.net', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '5903 Clement Grove Suite 698\nBergstromland, OR 90827', 'employee', '#15b1b0', '1702816005', '1702816005', '0', 0),
(82, 'Allan', 'Wisoky', 'kuhic.travon@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '162 Nichole Islands\nObieberg, GA 20323', 'partner', '#245415', '1702816005', '1702816005', '0', 0),
(83, 'Serenity', 'Bogan', 'mhane@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '7407 McLaughlin Bypass\nBarneyshire, MO 13068-2400', 'partner', '#4bdd1d', '1702816005', '1702816005', '0', 0),
(84, 'Felipa', 'Okuneva', 'meda.little@waters.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '3484 Jamey Walks\nWest Tarabury, HI 99109', 'partner', '#d50edc', '1702816005', '1702816005', '0', 0),
(85, 'Ryder', 'Little', 'gabriella.barrows@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '6530 Casper Flat\nPort Timothy, FL 16627-9035', 'employee', '#54817c', '1702816005', '1702816005', '0', 0),
(86, 'Shane', 'Pouros', 'bennie25@herzog.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '59665 Legros Ports\nEarleneburgh, IL 79910-2733', 'partner', '#371e09', '1702816005', '1702816005', '0', 0),
(87, 'Elva', 'Mayert', 'vjohns@bergstrom.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '7906 Mueller Canyon\nJackieborough, CT 47673-3600', 'customer', '#05c18a', '1702816005', '1702816005', '0', 0),
(88, 'Lavada', 'Zemlak', 'wilderman.martina@swift.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '7827 Kadin Radial Suite 776\nFarrellbury, NV 93819', 'customer', '#88520c', '1702816005', '1702816005', '0', 0),
(89, 'Joyce', 'Mosciski', 'haag.taylor@emard.net', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '629 Arely Ferry Apt. 228\nDamianborough, WA 09983', 'customer', '#622147', '1702816005', '1702816005', '0', 0),
(90, 'Lavina', 'Pfeffer', 'rashawn.becker@schinner.net', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '95893 Kulas Islands Suite 498\nMorartown, KY 49167', 'customer', '#8c644a', '1702816005', '1702816005', '0', 0),
(91, 'Carlo', 'Schuster', 'wgreenholt@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '13802 Bret Street\nLauriannefort, MI 13015-2377', 'partner', '#1a1f67', '1702816005', '1702816005', '0', 0),
(92, 'Karlie', 'Lowe', 'vmarvin@willms.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '681 Blanda Fork\nHaleyville, AR 80893-2574', 'customer', '#21b255', '1702816005', '1702816005', '0', 0),
(93, 'Petra', 'O\'Conner', 'janelle.turcotte@kris.biz', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '42546 Bernier Field Suite 725\nLefflerfort, TX 15184-4608', 'employee', '#7077ce', '1702816005', '1702816005', '0', 0),
(94, 'Wilton', 'Nitzsche', 'hickle.blake@ohara.net', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '523 Kamron Skyway\nPort Jessikaport, OK 61740-6842', 'customer', '#134c78', '1702816005', '1702816005', '0', 0),
(95, 'Godfrey', 'Collins', 'flockman@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '555 Leuschke Via Suite 667\nNew Elyseport, MA 54039', 'employee', '#12c697', '1702816005', '1702816005', '0', 0),
(96, 'Wilson', 'Blanda', 'mona.boyle@hansen.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '9846 Abshire Neck Apt. 285\nEast Hilton, CT 32267-3926', 'partner', '#4a9afd', '1702816005', '1702816005', '0', 0),
(97, 'Mafalda', 'Schroeder', 'rachael74@yahoo.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '648 Maggio Valley Apt. 417\nWest Ena, WI 62052', 'partner', '#c114e1', '1702816005', '1702816005', '0', 0),
(98, 'Mae', 'Boehm', 'uwalker@jerde.org', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '3622 Selmer Junctions\nWest Woodrowbury, MN 76645', 'employee', '#e428f7', '1702816005', '1702816005', '0', 0),
(99, 'Shea', 'Kautzer', 'amalia.gibson@hotmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '134 Reichert Haven\nWuckertville, DE 90377-4451', 'partner', '#b4fc2b', '1702816005', '1702816005', '0', 0),
(100, 'Josiah', 'Olson', 'colin.beier@gmail.com', '$2y$10$rxbiPoFBFvPWKTkftSgsGeK5sUQCMAX/198UDAA53E9bkl76O.HwC', '20268 Agustin Underpass Apt. 910\nOsinskiport, MT 86598-7138', 'customer', '#578ee3', '1702816005', '1702816005', '0', 0),
(101, 'Admin', 'Admin', 'admin@company.com', '$2y$10$7fSvqBPiLNvKDXXeyAhOM.Y9fh1fQZwpogCo6gqnMV3YYP0ql0Um2', 'Admin address', 'admin', '#0ea5e9', '1702816005', '0', '0', 0),
(102, 'Partner', 'Partner', 'partner@company.com', '$2y$10$e044xYAuCkDIOJfOQKMWJOkZ9RKTZ0K8bLGNdgYurnukm5K/Vj.im', 'Partner address', 'partner', '#0ea5e9', '1702816005', '0', '0', 0),
(103, 'Employee', 'Employee', 'employee@company.com', '$2y$10$.8FT4P8RlC1VmmHkmyYTG.m79mgGio7VlVJ.0SXiGefpgnFXjWWAq', 'employee address', 'employee', '#0ea5e9', '1702816005', '0', '0', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`orders_items_id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`user_partner_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`(255));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `orders_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
