-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2016 at 09:37 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `lang` varchar(5) DEFAULT 'ENG',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ar_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `city_id`, `name`, `deleted`, `lang`, `created_at`, `updated_at`, `ar_name`) VALUES
(3, 3, 'Sahat Al-Assi', 0, 'en', '2016-05-13 17:01:29', '2016-05-13 17:01:29', 'ساحة العاصي'),
(5, 3, 'Alshareaa', 0, 'en', '2016-05-13 17:01:29', '2016-05-13 17:01:29', 'الشريعة'),
(6, 3, 'Aldabagha', 0, 'en', '2016-05-13 17:01:29', '2016-05-13 17:01:29', 'الدباغة'),
(7, 3, 'Almarabet', 0, 'en', '2016-05-13 17:01:29', '2016-05-13 17:01:29', 'المرابط'),
(8, 3, 'Janob Al-Malaab', 0, 'en', '2016-05-13 17:01:29', '2016-05-13 17:01:29', 'جنوب الملعب'),
(9, 3, 'Aldahia', 0, 'en', '2016-05-13 17:01:29', '2016-05-13 17:01:29', 'الضاحية'),
(10, 3, 'Tarek Halab', 0, 'en', '2016-05-13 17:01:29', '2016-05-13 17:01:29', 'طريق حلب'),
(11, 3, 'Bab Trablous', 0, 'en', '2016-05-13 17:01:29', '2016-05-13 17:01:29', 'باب طرابلس');

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `lang` varchar(5) DEFAULT 'ENG',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ar_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`id`, `name`, `photo`, `deleted`, `lang`, `created_at`, `updated_at`, `ar_name`) VALUES
(1, 'Fool Restaurant', 'icon1.jpg', 0, 'en', '2016-05-13 16:46:53', '2016-05-13 16:46:53', 'فول وحمص'),
(2, 'Snak Restaurant', 'icon2.jpg', 0, 'en', '2016-05-13 16:46:53', '2016-05-13 16:46:53', 'وجبات سريعة'),
(3, 'Mana2ish Restaurant', 'icon3.jpg', 0, 'en', '2016-05-13 16:46:53', '2016-05-13 16:46:53', 'مناقيش'),
(4, 'Sweets', 'icon4.jpg', 0, 'en', '2016-05-13 16:46:53', '2016-05-13 16:46:53', 'حلويات'),
(5, 'Gaz', 'icon5.jpg', 0, 'en', '2016-05-13 16:46:53', '2016-05-13 16:46:53', 'غاز'),
(6, 'SuperMarket', 'icon6.jpg', 0, 'en', '2016-05-13 16:46:53', '2016-05-13 16:46:53', 'سوبر ماركيت');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `lang` varchar(5) DEFAULT 'ENG',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ar_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `name`, `deleted`, `lang`, `created_at`, `updated_at`, `ar_name`) VALUES
(3, 1, 'Hama', 0, 'en', '2016-05-13 16:55:03', '2016-05-13 16:55:03', 'حماة'),
(5, 1, 'Homs', 0, 'en', '2016-05-13 16:55:03', '2016-05-13 16:55:03', 'حمص'),
(6, 2, 'Aleppo', 0, 'en', '2016-05-13 16:55:03', '2016-05-13 16:55:03', 'حلب'),
(7, 1, 'Damascus', 0, 'en', '2016-05-13 16:55:03', '2016-05-13 16:55:03', 'دمشق'),
(8, 1, 'Lattakia', 0, 'en', '2016-05-13 16:55:03', '2016-05-13 16:55:03', 'اللاذقية'),
(9, 1, 'Idleb', 0, 'en', '2016-05-13 16:55:03', '2016-05-13 16:55:03', 'ادلب'),
(10, 1, 'Tartos', 0, 'en', '2016-05-13 16:55:03', '2016-05-13 16:55:03', 'طرطوس');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(145) COLLATE dec8_bin DEFAULT NULL,
  `email` varchar(70) COLLATE dec8_bin NOT NULL,
  `phone` varchar(15) COLLATE dec8_bin DEFAULT NULL,
  `message` text COLLATE dec8_bin,
  `lang` varchar(5) COLLATE dec8_bin DEFAULT 'en'
) ENGINE=InnoDB DEFAULT CHARSET=dec8 COLLATE=dec8_bin;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `message`, `lang`) VALUES
(1, 'zooz mooz', 'dfdf@sddf', '1111111111', 'sddsdsdsd', 'en'),
(2, 'zooz mooz', 'dfdf@sddf', '1111111111', 'sddsdsdsd', 'en'),
(3, 'zooz mooz', 'sdfd@sdf', '1112222222', 'zddsdsdsd', 'en'),
(4, 'zooz mooz', 'dfdfd@sdfdf', '1111111111', 'sdsdsd', 'en'),
(5, 'zooz mooz', 'dfdfd@sdfdf', '1111111111', 'sdsdsd', 'en'),
(6, 'zooz mooz', 'sdsd@sdsd', '1111111111', 'wwwwww ssd sdsd', 'en'),
(7, 'zooz mooz', 'dsdsds@sdsds', '1111111111', 'aaaaaaaa qa aaaaaaa aaaaa', 'en'),
(8, 'zooz mooz', 'dsdsds@sdsds', '1111111111', 'aaaaaaaa qa aaaaaaa aaaaa', 'en'),
(9, 'zooz mooz', 'sdsd@sdsd', '1111111111', '1111111111111111', 'en'),
(10, 'zooz mooz', 'sdsds@sdsds', '1111111111', 'aaaaaaaaaaaaaaaaa ssssss', 'en'),
(11, 'zooz mooz', 'ssssssss@sdsdsd', '1111111111', '2323232 sdsdsds sdsdsd sds sd sd s ds', 'en'),
(12, 'zooz mooz', 'ssssssss@sdsdsd', '1111111111', '2323232 sdsdsds sdsdsd sds sd sd s ds', 'en'),
(13, 'zooz mooz', 'sfdsdfsdf@sdsds', '1111111111', 'sssssssss ssssssss sssssssssss ssssss', 'en'),
(14, 'zooz mooz', 'sfsdf@sdsdsd', '1111111111', 'sssssssss ssssssssssss ssssssssss', 'en'),
(15, 'sdsdssss', 'ssdsds@sdsd', '1212121111', 'sdsdsdsdsdsd', 'en'),
(16, '43434333', 'sddsds@sdsd', '1111111111', '2222222222', 'en'),
(17, 'zooz mooz', 'yaser.alsabbouh@gmail.com', '3323232222', '222222222222', 'en'),
(18, 'zooz mooz', 'yaser@h', '966325412', 'Ttttttyyu', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `country_code` varchar(3) DEFAULT NULL,
  `iso_code` varchar(3) DEFAULT NULL,
  `deleted` enum('0','1') DEFAULT '0',
  `lang` enum('en','ar') DEFAULT 'en',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ar_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `country_code`, `iso_code`, `deleted`, `lang`, `created_at`, `updated_at`, `ar_name`) VALUES
(1, 'Syria', '963', 'SYR', '0', 'en', '2016-05-13 16:53:17', '2016-05-13 16:53:17', 'سوريا'),
(2, 'Lebanon', '961', 'LB', '1', 'ar', '2016-07-16 11:46:46', '2016-07-16 11:46:46', 'لبنان'),
(3, 'Jordan', '962', 'JO', '1', 'en', '2016-07-16 11:07:30', '2016-07-16 11:07:30', 'الأدردن');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password_digest` varchar(255) DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `auth_token` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT 'Male',
  `is_allowed` tinyint(1) DEFAULT '1',
  `unlock_token` varchar(255) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `locked_at` datetime DEFAULT NULL,
  `sms_count` int(11) DEFAULT '0',
  `lang` varchar(5) DEFAULT 'ENG',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `password_digest`, `confirmation_token`, `auth_token`, `full_name`, `phone`, `mobile`, `photo`, `gender`, `is_allowed`, `unlock_token`, `confirmed_at`, `locked_at`, `sms_count`, `lang`, `created_at`, `updated_at`, `email`) VALUES
(1, 'zhazeem', '$2a$10$JmmbRSVjjVe.rIbWDgP5re51KasFe3LvCIsJZgSILSOFazXARZsTq', '37651', '7e5WBwwWvb', 'zooz mooz', '993130478', '12345678', NULL, 'M', 1, NULL, NULL, NULL, 0, 'ar', '2016-05-13 15:02:18', '2016-06-04 06:49:58', 'yaser.alsabbouh@gmail.com'),
(3, 'nawar', '$2a$10$NbyOvRgk3ZtBvEQQJMmaMOO20n1sngQp0a.lS07o/QI6EeuPNbQqG', '16140', 'qkbn35ygpk', 'Nawar Albarazi', NULL, NULL, NULL, 'Male', 1, NULL, NULL, NULL, 0, 'en', '2016-05-22 21:39:34', '2016-05-22 21:39:34', NULL),
(7, 'zoozmooz', '$2a$10$dMK9xnoL.KFq26q9vTFkHunYv9e0YyQ3ZvlLo5wclDD2Muu30nwrq', '50900', 'n0eYKdep20', 'Zooz mooz', NULL, NULL, NULL, 'Male', 1, NULL, NULL, NULL, 0, 'en', '2016-06-06 00:24:06', '2016-06-06 00:24:06', NULL),
(8, 'Nebras', '$2a$10$DGm0pHqv9psJ/nHlXdEaO.DDzMqDASGtjnqMObfOtNZO0/Ettgytq', '13426', '2oKOW6mano', 'Nebras', '0', NULL, NULL, 'Male', 1, NULL, NULL, NULL, 0, 'en', '2016-06-06 05:46:47', '2016-06-07 15:21:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` int(11) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `city_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `building` varchar(255) DEFAULT NULL,
  `floor` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `customer_id`, `city_id`, `area_id`, `street`, `building`, `floor`, `details`, `phone`, `email`, `latitude`, `longitude`, `is_default`, `deleted`, `created_at`, `updated_at`) VALUES
(16, 1, 3, 3, 'Thikar street', 'Ja3bany building', 'F2', NULL, '993130478', 'yaser.alsabbouh@gmail.com', '0', '0', 0, 0, '2016-06-05 10:02:33', '2016-06-05 10:02:33'),
(17, 3, 3, 3, 'alquatli', 'building 12', '11', NULL, '944508853', 'nawar@mail.com', '0', '0', 0, 0, '2016-06-05 18:08:26', '2016-06-05 18:08:26'),
(18, 7, 3, 3, 'تتتتتتتتاا', 'اتتتتتتت', '55', NULL, '2222222222', 'rrtt@ttt', '0', '0', 0, 0, '2016-06-06 13:36:18', '2016-06-06 13:36:18'),
(19, 8, 3, 3, 'الضم والفرز', 'رشا سنتر', 'ط 2', 'Test', '3698527469', 'nebrassal@gmail.com', '0', '0', 0, 1, '2016-06-06 14:17:35', '2016-06-07 18:29:48'),
(20, 8, 3, 3, 'Testttvvv', 'Testjhgv', '66', 'Hhvb', '3698562369', '', '0', '0', 0, 0, '2016-06-07 15:07:37', '2016-06-07 15:07:37'),
(21, 8, 3, 3, 'تتالنلىوو', 'نؤتاىةوةت', 'بؤ', NULL, '96394422', 'nebrassal@gmail.com', '0', '0', 0, 0, '2016-06-25 12:02:31', '2016-06-25 12:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `imei` varchar(255) DEFAULT NULL,
  `gcm_key` varchar(255) DEFAULT NULL,
  `sms_register_count` int(11) DEFAULT '0',
  `sms_reset_pass_count` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `shop_item_category_id` int(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `lang` varchar(5) DEFAULT 'en',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ar_name` varchar(255) DEFAULT NULL,
  `ar_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `shop_item_category_id`, `name`, `description`, `price`, `photo`, `active`, `deleted`, `lang`, `created_at`, `updated_at`, `ar_name`, `ar_description`) VALUES
(1, 1, 'Ranch Angus', 'Ranch Angus', '1000', 'Ranch_Angus.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:32:54', 'Ranch Angus', 'Ranch Angus'),
(2, 1, 'Ranch Angus Meal', 'Ranch Angus Meal', '1600', 'Ranch_Angus_Meal.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:33:07', 'Ranch Angus Meal', 'Ranch Angus Meal'),
(3, 1, 'Spicy Angus', 'Spicy Angus', '1800', 'Spicy_Angus.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:33:18', 'Spicy Angus', 'Spicy Angus'),
(4, 1, 'Sautéed Mushroom angus', 'Sautéed Mushroom angus', '2000', 'Saut_ed_Mushroom_angus.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:36:47', 'Sautéed Mushroom angus', 'Sautéed Mushroom angus'),
(5, 1, 'Sautéed Mushroom Angus Meal', 'Sautéed Mushroom Angus Meal', '2200', 'Saut_ed_Mushroom_Angus_Meal.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:37:20', 'Sautéed Mushroom Angus Meal', 'Sautéed Mushroom Angus Meal'),
(6, 2, 'Whopper Sandwich', 'Whopper Sandwich', '1200', 'Whopper_Sandwich.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:37:37', 'وابر سندويتش ', 'وابر سندويتش '),
(7, 2, 'Double Whopper Sandwich', 'Double Whopper Sandwich', '1500', 'Double_Whopper_Sandwich.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:37:46', 'دوبل وابر سندويتش ', 'دوبل وابر سندويتش '),
(8, 2, 'Whopper Jr Sandwich', 'Whopper Jr Sandwich', '1600', 'Whopper_Jr_Sandwich.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:37:54', 'وابر جونيور سندويتش', 'وابر جونيور سندويتش'),
(9, 2, 'Chicken Royal Sandwich', 'Chicken Royal Sandwich', '1800', 'Chicken_Royal_Sandwich.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:38:04', 'دجاج رويال سندويتش', 'دجاج رويال سندويتش'),
(10, 2, 'Hamburger Sandwich', 'Hamburger Sandwich', '1900', 'Chicken_Tendergrill_Sandwich.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:38:34', 'همبرجر سندويتش', 'همبرجر سندويتش'),
(11, 2, 'Chicken Crisp Sandwich', 'Chicken Crisp Sandwich', '2000', 'Chicken_Crisp_Sandwich.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:40:16', 'تشيكن كريسب سندويتش', 'تشيكن كريسب سندويتش'),
(12, 2, 'Chicken Tendergrill Sandwich', 'Chicken Tendergrill Sandwich', '2200', 'Chicken_Tendergrill_Sandwich.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:40:29', 'تشيكن تندرجريل سندويتش ', 'تشيكن تندرجريل سندويتش '),
(13, 3, 'Mushroom N Swiss XXL Sandwich', 'Mushroom N Swiss XXL Sandwich', '1500', 'Mushroom_N_Swiss_XXL_Sandwich.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:40:38', 'مشروم اند سويس XXL سندويتش', 'مشروم اند سويس XXL سندويتش'),
(14, 3, 'Chicken Royal Sandwich With Cheese', 'Chicken Royal Sandwich With Cheese', '1900', 'Chicken_Royal_Sandwich_With_Cheese.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:40:47', 'دجاج رويال سندويتش مع جبنة', 'دجاج رويال سندويتش مع جبنة'),
(15, 3, 'Big King XXL Sandwich', 'Big King XXL Sandwich', '1520', 'Big_King_XXL_Sandwich.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:40:55', 'بيج كنج XXL', 'بيج كنج XXL'),
(16, 3, 'Cheese Burger', 'Cheese Burger', '1950', 'Big_King_XXL_Sandwich.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:50:12', 'دوبل تشيز برجر سندويتش', 'دوبل تشيز برجر سندويتش'),
(17, 3, 'Double Cheese Burger Sandwich', 'Double Cheese Burger Sandwich', '1650', 'Double_Cheese_Burger_Sandwich.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:41:40', 'تشيز برجر سندويتش', 'تشيز برجر سندويتش'),
(18, 3, 'Chicken Crisp Sandwich With Cheese', 'Chicken Crisp Sandwich With Cheese', '2050', 'Chicken_Crisp_Sandwich_With_Cheese.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:41:50', 'تشيكن كريسب سندويتش مع جبنة', 'تشيكن كريسب سندويتش مع جبنة'),
(19, 3, 'Chicken Tendergrill Sandwich With Cheese', 'Chicken Tendergrill Sandwich With Cheese', '2200', 'Chicken_Tendergrill_Sandwich_With_Cheese.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:41:59', 'تشكين تندرجريل سندويتش مع جبنة', 'تشكين تندرجريل سندويتش مع جبنة'),
(20, 6, 'Water', 'Water', '150', 'Water.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:42:08', 'ماء', 'ماء'),
(21, 6, 'Coca Cola', 'Coca Cola', '190', 'Coca_Cola.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:42:22', 'كوكا كولا', 'كوكا كولا'),
(22, 6, 'Coka Cola Light', 'Coka Cola Light', '1520', 'Coka_Cola_Light.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:57:30', 'كوكا كولا دايت', 'كوكا كولا دايت'),
(23, 6, 'Sprite', 'Sprite', '195', 'Sprite.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:42:38', 'سبريت', 'سبريت'),
(24, 6, 'Fanta', 'Fanta', '165', 'Fanta.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:42:48', 'فانتا', 'فانتا'),
(31, 12, 'Meatzza Feast Small', 'Meatzza Feast Small', '1150', 'Meatzza_Feast_Small.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:43:33', 'ميتزا صغيرة', 'ميتزا صغيرة'),
(32, 12, 'Extravaganzza Feast Small', 'Extravaganzza Feast Small', '190', 'Extravaganzza_Feast_Small.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:43:44', 'اكسترا فاجانزا صغيرة', 'اكسترا فاجانزا صغيرة'),
(33, 12, 'Deluxe Feast Small', 'Deluxe Feast Small', '1520', 'Deluxe_Feast_Small.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:43:53', 'اكسترا فاجانزا صغيرة دايت', 'اكسترا فاجانزا صغيرة دايت'),
(34, 12, 'Pepperoni Feast Small', 'Pepperoni Feast Small', '195', 'Pepperoni_Feast_Small.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:44:01', 'البيبيروني صغيرة', 'البيبيروني صغيرة'),
(35, 12, 'Italiano Feast Small', 'Italiano Feast Small', '165', 'Italiano_Feast_Small.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:44:09', 'ايطاليانو صغيرة', 'ايطاليانو صغيرة'),
(36, 7, 'Meatzza Feast Medium', 'Meatzza Feast Small', '1650', 'Meatzza_Feast_Medium.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:57:06', 'ميتزا وسط', 'ميتزا صغيرة'),
(37, 7, 'Extravaganzza Feast Medium', 'Extravaganzza Feast Small', '1900', 'Meatzza_Feast_Medium.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:44:32', 'اكسترا فاجانزا وسط', 'اكسترا فاجانزا صغيرة'),
(38, 7, 'Deluxe Feast Medium', 'Deluxe Feast Small', '1920', 'Deluxe_Feast_Medium.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:44:43', 'اكسترا فاجانزا صغيرة دايت', 'اكسترا فاجانزا صغيرة دايت'),
(39, 7, 'Chicken Legend Medium', 'Pepperoni Feast Small', '1950', 'Chicken_Legend_Medium.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:44:50', 'الدجاج الاسطورة وسط', 'البيبيروني صغيرة'),
(40, 7, 'Pepperoni Feast Medium', 'Pepperoni Feast Medium', '1650', 'Pepperoni_Feast_Medium.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:44:59', 'البيبيروني وسط', 'البيبيروني وسط'),
(41, 7, 'Classic Hand Tossed Philly Cheese Steak Medium', 'Classic Hand Tossed Philly Cheese Steak Medium', '2150', 'Classic_Hand_Tossed_Philly_Cheese_Steak_Medium.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:45:08', 'فيلي تشيز ستيك وسط- العجينة الاصلية الاصلية', 'فيلي تشيز ستيك وسط- العجينة الاصلية الاصلية'),
(42, 7, 'Italiano Feast Medium', 'Italiano Feast Medium', '2250', 'Italiano_Feast_Medium.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:45:18', 'ايطاليانو وسط', 'ايطاليانو وسط'),
(51, 8, 'Meatzza Feast Large', 'Meatzza Feast Small', '2650', 'Meatzza_Feast_Small.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:47:01', 'ميتزا كبيرة', 'ميتزا كبيرة'),
(52, 8, 'Extravaganzza Feast Large', 'Extravaganzza Feast Small', '2900', 'Extravaganzza_Feast_Small.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:47:01', 'اكسترا فاجانزا كبيرة', 'اكسترا فاجانزا كبيرة'),
(53, 8, 'Deluxe Feast Large', 'Deluxe Feast Small', '2950', 'Deluxe_Feast_Small.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:47:01', 'اكسترا فاجانزا كبيرة دايت', 'اكسترا فاجانزا كبيرة دايت'),
(54, 8, 'Chicken Legend Large', 'Pepperoni Feast Small', '2950', 'Chicken_Legend_Medium.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:48:02', 'الدجاج الاسطورة كبيرة', 'البيبيروني كبيرة'),
(55, 8, 'Pepperoni Feast Large', 'Pepperoni Feast Large', '2650', 'Pepperoni_Feast_Medium.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:48:25', 'البيبيروني كبيرة', 'البيبيروني كبيرة'),
(56, 8, 'Classic Hand Tossed Philly Cheese Steak Large', 'Classic Hand Tossed Philly Cheese Steak Large', '2850', 'Classic_Hand_Tossed_Philly_Cheese_Steak_Medium.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:48:48', 'فيلي تشيز ستيك كبيرة- العجينة الاصلية الاصلية', 'فيلي تشيز ستيك كبيرة- العجينة الاصلية الاصلية'),
(57, 8, 'Italiano Feast Large', 'Italiano Feast Large', '2850', 'Italiano_Feast_Medium.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 09:49:07', 'ايطاليانو كبيرة', 'ايطاليانو كبيرة'),
(58, 13, 'Roasted Chicken Salad', 'Roasted Chicken Salad', '2650', 'Egg_Cheese.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 11:45:56', 'سلطة الدجاج المشوي', 'سلطة الدجاج المشوي'),
(59, 14, 'Egg & Cheese', 'Egg & Cheese', '2650', 'Roasted_Chicken_Salad.jpg', 1, 0, 'en', '2016-06-05 00:00:00', '2016-06-05 11:45:56', 'بيض وجبنه', 'بيض وجبنه');

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `lang` varchar(5) DEFAULT 'en',
  `deleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ar_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `name`, `photo`, `lang`, `deleted`, `created_at`, `updated_at`, `ar_name`) VALUES
(1, 'Angus Club', '', 'en', 0, NULL, NULL, 'انجوس كلوب'),
(2, 'Sandwiches', '', 'en', 0, NULL, NULL, 'ساندويشات'),
(3, 'Cheese Sandwiches', '', 'en', 0, NULL, NULL, 'ساندويشات جبنة'),
(4, 'Chicken', '', 'en', 0, NULL, NULL, 'دجاج'),
(5, 'Kids Meal', '', 'en', 0, NULL, NULL, 'وجبات الاطفال'),
(6, 'Drinks', '', 'en', 0, NULL, NULL, 'مشروبات'),
(12, 'Feasts Pizza Small', '', 'en', 0, NULL, NULL, 'فيست بيتزا صغير'),
(13, 'Feasts Pizza Medium', '', 'en', 0, NULL, NULL, 'فيست بيتزا وسط'),
(14, 'Feasts Pizza Large', '', 'en', 0, NULL, NULL, 'فيست بيتزا كبير'),
(15, 'Sides', '', 'en', 0, NULL, NULL, 'الطلبات الجانبية'),
(16, 'Breakfast', '', 'en', 0, NULL, NULL, 'الفطور'),
(17, 'Salad', '', 'en', 0, NULL, NULL, 'السلطات');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1468595607),
('m130524_201442_init', 1468595612);

-- --------------------------------------------------------

--
-- Table structure for table `opening_hours`
--

CREATE TABLE `opening_hours` (
  `id` int(11) NOT NULL,
  `shop_id` int(20) NOT NULL,
  `day_name` varchar(255) DEFAULT NULL,
  `from_hour` int(11) NOT NULL,
  `to_hour` int(11) NOT NULL,
  `full_day` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `opening_hours`
--

INSERT INTO `opening_hours` (`id`, `shop_id`, `day_name`, `from_hour`, `to_hour`, `full_day`, `created_at`, `updated_at`) VALUES
(1, 1, 'sat', 8, 24, 0, NULL, NULL),
(2, 2, 'sat', 8, 24, 0, NULL, NULL),
(3, 2, 'sun', 8, 24, 0, NULL, NULL),
(4, 2, 'mon', 8, 24, 0, NULL, NULL),
(5, 2, 'tue', 8, 24, 0, NULL, NULL),
(6, 2, 'wed', 8, 24, 0, NULL, NULL),
(7, 2, 'thu', 8, 24, 0, NULL, NULL),
(8, 2, 'fri', 8, 24, 0, NULL, NULL),
(9, 1, 'sun', 8, 24, 0, NULL, NULL),
(10, 1, 'mon', 8, 24, 0, NULL, NULL),
(11, 1, 'tue', 8, 24, 0, NULL, NULL),
(12, 1, 'wed', 8, 24, 0, NULL, NULL),
(13, 1, 'thu', 8, 24, 0, NULL, NULL),
(14, 1, 'fri', 8, 24, 0, NULL, NULL),
(15, 3, 'sat', 12, 24, 0, NULL, NULL),
(16, 3, 'sun', 12, 24, 0, NULL, NULL),
(17, 3, 'mon', 12, 24, 0, NULL, NULL),
(18, 3, 'tue', 12, 24, 0, NULL, NULL),
(19, 3, 'wed', 12, 24, 0, NULL, NULL),
(20, 3, 'thu', 1, 24, 0, NULL, NULL),
(21, 3, 'fri', 12, 24, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `shop_id` int(20) DEFAULT NULL,
  `customer_address_id` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) NOT NULL,
  `total` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `cancel_reason` varchar(255) DEFAULT NULL,
  `note` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `delivery_charge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `shop_id`, `customer_address_id`, `order_status`, `total`, `qty`, `cancel_reason`, `note`, `created_at`, `updated_at`, `delivery_charge`) VALUES
(32, 1, 2, '16', 'PENDING', '5220', 3, NULL, 'Test', '2016-06-05 10:27:06', '2016-06-05 10:27:06', 500),
(33, 1, 2, '16', 'PENDING', '3040', 2, NULL, '', '2016-06-05 10:37:07', '2016-06-05 10:37:07', 500),
(34, 1, 2, '16', 'CLOSED', '10710', 6, NULL, '', '2016-06-05 12:36:27', '2016-06-05 12:36:27', 500),
(35, 3, 2, '17', 'PENDING', '3300', 2, NULL, '', '2016-06-05 18:21:21', '2016-06-05 18:21:21', 500),
(36, 7, 2, '18', 'PENDING', '3300', 2, NULL, '', '2016-06-06 13:37:25', '2016-06-06 13:37:25', 500),
(37, 3, 2, '17', 'PENDING', '5200', 3, NULL, '', '2016-06-07 09:49:33', '2016-06-07 09:49:33', 500),
(38, 1, 2, '16', 'PENDING', '10900', 6, NULL, '', '2016-06-07 12:17:33', '2016-06-07 12:17:33', 500),
(39, 8, 2, '19', 'PENDING', '9250', 5, NULL, 'Test', '2016-06-07 14:40:29', '2016-06-07 14:40:29', 500),
(40, 8, 1, '19', 'PENDING', '18400', 12, NULL, '', '2016-06-07 14:51:49', '2016-06-07 14:51:49', 500),
(41, 8, 1, '19', 'PENDING', '9600', 8, NULL, '', '2016-06-07 15:00:02', '2016-06-07 15:00:02', 500),
(42, 8, 1, '20', 'PENDING', '4000', 4, NULL, '', '2016-06-07 15:08:16', '2016-06-07 15:08:16', 500),
(43, 3, 1, '17', 'PENDING', '6200', 5, NULL, '', '2016-06-07 15:31:24', '2016-06-07 15:31:24', 500),
(44, 8, 2, '20', 'PENDING', '11460', 6, NULL, '', '2016-06-07 18:20:54', '2016-06-07 18:20:54', 500),
(45, 8, 2, '19', 'PENDING', '26210', 14, NULL, '', '2016-06-07 18:26:43', '2016-06-07 18:26:43', 500),
(46, 8, 2, '-1', 'PENDING', '2950', 1, NULL, '', '2016-06-07 18:30:29', '2016-06-07 18:30:29', 500),
(47, 3, 1, '17', 'PENDING', '2000', 2, NULL, '', '2016-06-07 22:23:08', '2016-06-07 22:23:08', 500),
(48, 3, 1, '17', 'PENDING', '2600', 2, NULL, '', '2016-06-07 22:26:55', '2016-06-07 22:26:55', 500),
(49, 3, 1, '17', 'PENDING', '2600', 2, NULL, '', '2016-06-07 23:06:16', '2016-06-07 23:06:16', 500),
(50, 3, 1, '17', 'PENDING', '1000', 1, NULL, '', '2016-06-08 08:14:13', '2016-06-08 08:14:13', 500),
(51, 3, 1, '17', 'PENDING', '2600', 2, NULL, '', '2016-06-08 08:18:52', '2016-06-08 08:18:52', 500),
(52, 3, 1, '17', 'PENDING', '3900', 3, NULL, '', '2016-06-08 08:26:23', '2016-06-08 08:26:23', 500),
(53, 3, 1, '17', 'PENDING', '1000', 1, NULL, '', '2016-06-08 08:37:33', '2016-06-08 08:37:33', 500),
(54, 3, 1, '17', 'PENDING', '8300', 5, NULL, '', '2016-06-08 08:40:34', '2016-06-08 08:40:34', 500),
(55, 3, 1, '17', 'PENDING', '1000', 1, NULL, '', '2016-06-08 08:44:42', '2016-06-08 08:44:42', 500),
(56, 3, 1, '17', 'PENDING', '4600', 4, NULL, '', '2016-06-08 10:13:29', '2016-06-08 10:13:29', 500),
(57, 8, 1, '20', 'PENDING', '6400', 4, NULL, '', '2016-06-08 12:33:06', '2016-06-08 12:33:06', 500),
(58, 3, 1, '17', 'PENDING', '2600', 2, NULL, '', '2016-06-09 15:01:49', '2016-06-09 15:01:49', 500),
(59, 1, 1, '16', 'PENDING', '7800', 6, NULL, '', '2016-06-09 20:54:07', '2016-06-09 20:54:07', 500),
(60, 3, 1, '17', 'PENDING', '6400', 4, NULL, '', '2016-06-10 21:59:24', '2016-06-10 21:59:24', 500),
(61, 3, 1, '17', 'PENDING', '7200', 6, NULL, '', '2016-06-14 22:43:35', '2016-06-14 22:43:35', 500),
(62, 1, 1, '16', 'PENDING', '6800', 4, NULL, '', '2016-06-15 11:28:30', '2016-06-15 11:28:30', 500),
(63, 3, 2, '17', 'PENDING', '3300', 2, NULL, '', '2016-06-18 20:31:51', '2016-06-18 20:31:51', 500),
(64, 3, 1, '17', 'PENDING', '1000', 1, NULL, '', '2016-06-19 10:01:49', '2016-06-19 10:01:49', 500),
(65, 3, 1, '17', 'PENDING', '1000', 1, NULL, 'gdfgdgdfg', '2016-06-19 14:12:44', '2016-06-19 14:12:44', 500),
(66, 3, 1, '17', 'PENDING', '1000', 1, NULL, '', '2016-06-19 15:05:04', '2016-06-19 15:05:04', 500),
(67, 3, 1, '17', 'PENDING', '1000', 1, NULL, '', '2016-06-19 15:37:18', '2016-06-19 15:37:18', 500),
(68, 3, 1, '17', 'PENDING', '1000', 1, NULL, '', '2016-06-19 16:21:06', '2016-06-19 16:21:06', 500),
(69, 3, 1, '17', 'PENDING', '1000', 1, NULL, '', '2016-06-19 16:33:52', '2016-06-19 16:33:52', 500),
(70, 3, 1, '17', 'PENDING', '3000', 3, NULL, '', '2016-06-19 21:07:45', '2016-06-19 21:07:45', 500),
(71, 1, 1, '16', 'PENDING', '14600', 8, NULL, '', '2016-06-19 22:50:54', '2016-06-19 22:50:54', 500),
(72, 3, 1, '17', 'PENDING', '8800', 6, NULL, '', '2016-06-20 08:04:31', '2016-06-20 08:04:31', 500),
(73, 1, 2, '16', 'PENDING', '4950', 3, NULL, '', '2016-06-22 12:40:30', '2016-06-22 12:40:30', 500),
(74, 1, 1, '16', 'PENDING', '2600', 2, NULL, '', '2016-06-22 12:41:52', '2016-06-22 12:41:52', 500),
(75, 1, 2, '16', 'PENDING', '3300', 2, NULL, '', '2016-06-22 12:43:09', '2016-06-22 12:43:09', 500),
(76, 8, 2, '20', 'PENDING', '31850', 14, NULL, '', '2016-06-23 09:42:10', '2016-06-23 09:42:10', 500),
(77, 8, 2, '21', 'PENDING', '21900', 13, NULL, '', '2016-06-25 12:11:08', '2016-06-25 12:11:08', 500),
(78, 8, 2, '20', 'PENDING', '14200', 8, NULL, '', '2016-06-25 12:24:08', '2016-06-25 12:24:08', 500),
(79, 8, 2, '21', 'PENDING', '12510', 6, NULL, '', '2016-06-25 12:31:56', '2016-06-25 12:31:56', 500),
(80, 8, 2, '21', 'PENDING', '10600', 4, NULL, '', '2016-07-02 16:39:50', '2016-07-02 16:39:50', 500);

-- --------------------------------------------------------

--
-- Table structure for table `order_histories`
--

CREATE TABLE `order_histories` (
  `id` int(11) NOT NULL,
  `order_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL DEFAULT '0',
  `order_status` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(20) NOT NULL,
  `item_id` int(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `total` varchar(255) DEFAULT NULL,
  `is_canceled` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `qty`, `item_price`, `total`, `is_canceled`, `created_at`, `updated_at`) VALUES
(55, 32, 36, 2, 1650, '3300.0', 0, '2016-06-05 10:27:06', '2016-06-05 10:27:06'),
(56, 32, 38, 1, 1920, '1920.0', 0, '2016-06-05 10:27:06', '2016-06-05 10:27:06'),
(57, 33, 33, 2, 1520, '3040.0', 0, '2016-06-05 10:37:07', '2016-06-05 10:37:07'),
(58, 34, 36, 3, 1650, '4950.0', 0, '2016-06-05 12:36:27', '2016-06-05 12:36:27'),
(59, 34, 38, 3, 1920, '5760.0', 0, '2016-06-05 12:36:27', '2016-06-05 12:36:27'),
(60, 35, 36, 2, 1650, '3300.0', 0, '2016-06-05 18:21:21', '2016-06-05 18:21:21'),
(61, 36, 36, 2, 1650, '3300.0', 0, '2016-06-06 13:37:25', '2016-06-06 13:37:25'),
(62, 37, 36, 2, 1650, '3300.0', 0, '2016-06-07 09:49:33', '2016-06-07 09:49:33'),
(63, 37, 37, 1, 1900, '1900.0', 0, '2016-06-07 09:49:33', '2016-06-07 09:49:33'),
(64, 38, 36, 2, 1650, '3300.0', 0, '2016-06-07 12:17:33', '2016-06-07 12:17:33'),
(65, 38, 37, 4, 1900, '7600.0', 0, '2016-06-07 12:17:33', '2016-06-07 12:17:33'),
(66, 39, 36, 1, 1650, '1650.0', 0, '2016-06-07 14:40:29', '2016-06-07 14:40:29'),
(67, 39, 37, 4, 1900, '7600.0', 0, '2016-06-07 14:40:29', '2016-06-07 14:40:29'),
(68, 40, 2, 3, 1600, '4800.0', 0, '2016-06-07 14:51:49', '2016-06-07 14:51:49'),
(69, 40, 6, 5, 1200, '6000.0', 0, '2016-06-07 14:51:49', '2016-06-07 14:51:49'),
(70, 40, 10, 4, 1900, '7600.0', 0, '2016-06-07 14:51:49', '2016-06-07 14:51:49'),
(71, 41, 6, 8, 1200, '9600.0', 0, '2016-06-07 15:00:02', '2016-06-07 15:00:02'),
(72, 42, 1, 4, 1000, '4000.0', 0, '2016-06-07 15:08:16', '2016-06-07 15:08:16'),
(73, 43, 1, 3, 1000, '3000.0', 0, '2016-06-07 15:31:24', '2016-06-07 15:31:24'),
(74, 43, 2, 2, 1600, '3200.0', 0, '2016-06-07 15:31:24', '2016-06-07 15:31:24'),
(75, 44, 37, 3, 1900, '5700.0', 0, '2016-06-07 18:20:54', '2016-06-07 18:20:54'),
(76, 44, 38, 3, 1920, '5760.0', 0, '2016-06-07 18:20:54', '2016-06-07 18:20:54'),
(77, 45, 37, 2, 1900, '3800.0', 0, '2016-06-07 18:26:43', '2016-06-07 18:26:43'),
(78, 45, 36, 3, 1650, '4950.0', 0, '2016-06-07 18:26:43', '2016-06-07 18:26:43'),
(79, 45, 40, 3, 1650, '4950.0', 0, '2016-06-07 18:26:43', '2016-06-07 18:26:43'),
(80, 45, 55, 3, 2650, '7950.0', 0, '2016-06-07 18:26:43', '2016-06-07 18:26:43'),
(81, 45, 33, 3, 1520, '4560.0', 0, '2016-06-07 18:26:43', '2016-06-07 18:26:43'),
(82, 46, 53, 1, 2950, '2950.0', 0, '2016-06-07 18:30:29', '2016-06-07 18:30:29'),
(83, 47, 1, 2, 1000, '2000.0', 0, '2016-06-07 22:23:08', '2016-06-07 22:23:08'),
(84, 48, 1, 1, 1000, '1000.0', 0, '2016-06-07 22:26:55', '2016-06-07 22:26:55'),
(85, 48, 2, 1, 1600, '1600.0', 0, '2016-06-07 22:26:55', '2016-06-07 22:26:55'),
(86, 49, 1, 1, 1000, '1000.0', 0, '2016-06-07 23:06:16', '2016-06-07 23:06:16'),
(87, 49, 2, 1, 1600, '1600.0', 0, '2016-06-07 23:06:16', '2016-06-07 23:06:16'),
(88, 50, 1, 1, 1000, '1000.0', 0, '2016-06-08 08:14:13', '2016-06-08 08:14:13'),
(89, 51, 1, 1, 1000, '1000.0', 0, '2016-06-08 08:18:52', '2016-06-08 08:18:52'),
(90, 51, 2, 1, 1600, '1600.0', 0, '2016-06-08 08:18:52', '2016-06-08 08:18:52'),
(91, 52, 6, 2, 1200, '2400.0', 0, '2016-06-08 08:26:23', '2016-06-08 08:26:23'),
(92, 52, 7, 1, 1500, '1500.0', 0, '2016-06-08 08:26:23', '2016-06-08 08:26:23'),
(93, 53, 1, 1, 1000, '1000.0', 0, '2016-06-08 08:37:33', '2016-06-08 08:37:33'),
(94, 54, 13, 3, 1500, '4500.0', 0, '2016-06-08 08:40:34', '2016-06-08 08:40:34'),
(95, 54, 14, 2, 1900, '3800.0', 0, '2016-06-08 08:40:34', '2016-06-08 08:40:34'),
(96, 55, 1, 1, 1000, '1000.0', 0, '2016-06-08 08:44:42', '2016-06-08 08:44:42'),
(97, 56, 1, 3, 1000, '3000.0', 0, '2016-06-08 10:13:29', '2016-06-08 10:13:29'),
(98, 56, 2, 1, 1600, '1600.0', 0, '2016-06-08 10:13:29', '2016-06-08 10:13:29'),
(99, 57, 2, 4, 1600, '6400.0', 0, '2016-06-08 12:33:06', '2016-06-08 12:33:06'),
(100, 58, 1, 1, 1000, '1000.0', 0, '2016-06-09 15:01:49', '2016-06-09 15:01:49'),
(101, 58, 2, 1, 1600, '1600.0', 0, '2016-06-09 15:01:49', '2016-06-09 15:01:49'),
(102, 59, 6, 4, 1200, '4800.0', 0, '2016-06-09 20:54:07', '2016-06-09 20:54:07'),
(103, 59, 7, 2, 1500, '3000.0', 0, '2016-06-09 20:54:07', '2016-06-09 20:54:07'),
(104, 60, 8, 4, 1600, '6400.0', 0, '2016-06-10 21:59:24', '2016-06-10 21:59:24'),
(105, 61, 1, 4, 1000, '4000.0', 0, '2016-06-14 22:43:35', '2016-06-14 22:43:35'),
(106, 61, 2, 2, 1600, '3200.0', 0, '2016-06-14 22:43:35', '2016-06-14 22:43:35'),
(107, 62, 1, 1, 1000, '1000.0', 0, '2016-06-15 11:28:30', '2016-06-15 11:28:30'),
(108, 62, 4, 2, 2000, '4000.0', 0, '2016-06-15 11:28:30', '2016-06-15 11:28:30'),
(109, 62, 3, 1, 1800, '1800.0', 0, '2016-06-15 11:28:30', '2016-06-15 11:28:30'),
(110, 63, 36, 2, 1650, '3300.0', 0, '2016-06-18 20:31:51', '2016-06-18 20:31:51'),
(111, 64, 1, 1, 1000, '1000.0', 0, '2016-06-19 10:01:49', '2016-06-19 10:01:49'),
(112, 65, 1, 1, 1000, '1000.0', 0, '2016-06-19 14:12:45', '2016-06-19 14:12:45'),
(113, 66, 1, 1, 1000, '1000.0', 0, '2016-06-19 15:05:04', '2016-06-19 15:05:04'),
(114, 67, 1, 1, 1000, '1000.0', 0, '2016-06-19 15:37:18', '2016-06-19 15:37:18'),
(115, 68, 1, 1, 1000, '1000.0', 0, '2016-06-19 16:21:06', '2016-06-19 16:21:06'),
(116, 69, 1, 1, 1000, '1000.0', 0, '2016-06-19 16:33:52', '2016-06-19 16:33:52'),
(117, 70, 1, 3, 1000, '3000.0', 0, '2016-06-19 21:07:45', '2016-06-19 21:07:45'),
(118, 71, 19, 3, 2200, '6600.0', 0, '2016-06-19 22:50:54', '2016-06-19 22:50:54'),
(119, 71, 2, 5, 1600, '8000.0', 0, '2016-06-19 22:50:54', '2016-06-19 22:50:54'),
(120, 72, 6, 1, 1200, '1200.0', 0, '2016-06-20 08:04:31', '2016-06-20 08:04:31'),
(121, 72, 7, 4, 1500, '6000.0', 0, '2016-06-20 08:04:31', '2016-06-20 08:04:31'),
(122, 72, 8, 1, 1600, '1600.0', 0, '2016-06-20 08:04:31', '2016-06-20 08:04:31'),
(123, 73, 36, 3, 1650, '4950.0', 0, '2016-06-22 12:40:30', '2016-06-22 12:40:30'),
(124, 74, 1, 1, 1000, '1000.0', 0, '2016-06-22 12:41:52', '2016-06-22 12:41:52'),
(125, 74, 2, 1, 1600, '1600.0', 0, '2016-06-22 12:41:52', '2016-06-22 12:41:52'),
(126, 75, 36, 2, 1650, '3300.0', 0, '2016-06-22 12:43:09', '2016-06-22 12:43:09'),
(127, 76, 36, 3, 1650, '4950.0', 0, '2016-06-23 09:42:10', '2016-06-23 09:42:10'),
(128, 76, 37, 4, 1900, '7600.0', 0, '2016-06-23 09:42:10', '2016-06-23 09:42:10'),
(129, 76, 51, 4, 2650, '10600.0', 0, '2016-06-23 09:42:10', '2016-06-23 09:42:10'),
(130, 76, 52, 3, 2900, '8700.0', 0, '2016-06-23 09:42:10', '2016-06-23 09:42:10'),
(131, 77, 36, 3, 1650, '4950.0', 0, '2016-06-25 12:11:08', '2016-06-25 12:11:08'),
(132, 77, 37, 3, 1900, '5700.0', 0, '2016-06-25 12:11:08', '2016-06-25 12:11:08'),
(133, 77, 39, 4, 1950, '7800.0', 0, '2016-06-25 12:11:08', '2016-06-25 12:11:08'),
(134, 77, 31, 3, 1150, '3450.0', 0, '2016-06-25 12:11:08', '2016-06-25 12:11:08'),
(135, 78, 36, 4, 1650, '6600.0', 0, '2016-06-25 12:24:08', '2016-06-25 12:24:08'),
(136, 78, 37, 4, 1900, '7600.0', 0, '2016-06-25 12:24:08', '2016-06-25 12:24:08'),
(137, 79, 33, 3, 1520, '4560.0', 0, '2016-06-25 12:31:56', '2016-06-25 12:31:56'),
(138, 79, 51, 3, 2650, '7950.0', 0, '2016-06-25 12:31:56', '2016-06-25 12:31:56'),
(139, 80, 51, 4, 2650, '10600.0', 0, '2016-07-02 16:39:50', '2016-07-02 16:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `order_map_trace`
--

CREATE TABLE `order_map_trace` (
  `id` int(11) NOT NULL,
  `order_histories_id` int(20) NOT NULL,
  `Longitude` float NOT NULL DEFAULT '0',
  `Latitude` float NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles_group_elements`
--

CREATE TABLE `roles_group_elements` (
  `id` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schema_migrations`
--

CREATE TABLE `schema_migrations` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `schema_migrations`
--

INSERT INTO `schema_migrations` (`version`) VALUES
('20160531130928'),
('20160601112817'),
('20160601204620'),
('20160603190908'),
('20160604120617'),
('20160605141321');

-- --------------------------------------------------------

--
-- Table structure for table `security_groups`
--

CREATE TABLE `security_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `security_permissions`
--

CREATE TABLE `security_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `security_permissions`
--

INSERT INTO `security_permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'CREATE_ITEM_CATEGORY', '2016-06-20 00:00:00', NULL),
(2, 'EDIT_ITEM_CATEGORY', '2016-06-20 00:00:00', NULL),
(3, 'VIEW_ITEM_CATEGORY', '2016-06-20 00:00:00', NULL),
(4, 'DELETE_ITEM_CATEGORY', '2016-06-20 00:00:00', NULL),
(5, 'CREATE_ITEM', '2016-06-20 00:00:00', NULL),
(6, 'EDIT_ITEM', '2016-06-20 00:00:00', NULL),
(7, 'DELETE_ITEM', '2016-06-20 00:00:00', NULL),
(8, 'VIEW_ITEM', '2016-06-20 00:00:00', NULL),
(9, 'CREATE_SHOP', '2016-06-20 00:00:00', NULL),
(10, 'EDIT_SHOP', '2016-06-20 00:00:00', NULL),
(11, 'VIEW_SHOP', '2016-06-20 00:00:00', NULL),
(12, 'DELETE_SHOP', '2016-06-20 00:00:00', NULL),
(13, 'CREATE_USER', '2016-06-20 00:00:00', NULL),
(14, 'EDIT_USER', '2016-06-20 00:00:00', NULL),
(15, 'DELETE_USER', '2016-06-20 00:00:00', NULL),
(16, 'VIEW_USER', '2016-06-20 00:00:00', NULL),
(17, 'ASSIGN_ROLE', '2016-06-20 00:00:00', NULL),
(18, 'VIEW_RATING', '2016-06-20 00:00:00', NULL),
(19, 'ALL_SALES_REPORT', '2016-06-20 00:00:00', NULL),
(20, 'TOP_SELLING_ITEMS', '2016-06-20 00:00:00', NULL),
(21, 'TOP_SELLING_USERS', '2016-06-20 00:00:00', NULL),
(22, 'TOP_SELLING_PERIODS', '2016-06-20 00:00:00', NULL),
(23, 'DELVIERY_MAN_ORDERS_REPORT', '2016-06-20 00:00:00', NULL),
(24, 'DELIVERY_MAN_ADVANCE_PAMYMENT_REPORT', '2016-06-20 00:00:00', NULL),
(25, 'SHOW_OPEN_ORDERS', '2016-06-20 00:00:00', NULL),
(26, 'EDIT_OPEN_ORDERS', '2016-06-20 00:00:00', NULL),
(27, 'SHOW_PREPARED_ORDERS', '2016-06-20 00:00:00', NULL),
(28, 'EDIT_PREPARED_ORDERS', '2016-06-20 00:00:00', NULL),
(29, 'SHOW_CANCELED_ORDERS', '2016-06-20 00:00:00', NULL),
(30, 'EDIT_CANCELED_ORDERS', '2016-06-20 00:00:00', NULL),
(31, 'SHOW_COLSED_ORDERS', '2016-06-20 00:00:00', NULL),
(32, 'SHOW_ORDERS_MAP', '2016-06-20 00:00:00', NULL),
(33, 'ASSIGN_ORDER_TO_DELIVERY_MAN', '2016-06-20 00:00:00', NULL),
(34, 'LIST_USERS', '2016-07-08 00:00:00', '2016-07-08 00:00:00'),
(35, 'LIST_ITEM_CATEGORIES', '2016-07-08 00:00:00', '2016-07-08 00:00:00'),
(36, 'LIST_SHOPS', '2016-07-08 00:00:00', '2016-07-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `security_user_groups`
--

CREATE TABLE `security_user_groups` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `security_group_permission_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `security_user_permissions`
--

CREATE TABLE `security_user_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `security_permission_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `security_user_permissions`
--

INSERT INTO `security_user_permissions` (`id`, `user_id`, `security_permission_id`, `deleted`, `created_at`, `updated_at`) VALUES
(3, 1, 34, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `is_avilable` tinyint(1) DEFAULT '1',
  `longitude` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `estimation_time` varchar(255) DEFAULT NULL,
  `min_amount` int(11) NOT NULL DEFAULT '10000',
  `delivery_expected_time` varchar(11) NOT NULL DEFAULT '30',
  `delivery_charge` int(11) NOT NULL DEFAULT '5000',
  `promotion_note` text,
  `warning_note` text,
  `photo` varchar(100) DEFAULT NULL,
  `masteries` text,
  `deleted` tinyint(1) DEFAULT '0',
  `lang` varchar(5) DEFAULT 'ENG',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `rating` int(2) NOT NULL DEFAULT '0',
  `country` varchar(3) DEFAULT 'LB',
  `subscribed` tinyint(1) DEFAULT '0',
  `ar_name` varchar(255) DEFAULT NULL,
  `ar_short_description` varchar(255) DEFAULT NULL,
  `ar_address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `business_id`, `area_id`, `name`, `short_description`, `address`, `is_avilable`, `longitude`, `latitude`, `estimation_time`, `min_amount`, `delivery_expected_time`, `delivery_charge`, `promotion_note`, `warning_note`, `photo`, `masteries`, `deleted`, `lang`, `created_at`, `updated_at`, `rating`, `country`, `subscribed`, `ar_name`, `ar_short_description`, `ar_address`, `phone`) VALUES
(1, 2, 3, 'Burger King', 'Snak Restaurant', 'Hama - Saht El Assi Tel: 0993215874', 1, '35.1318623', '36.7571503', '45 min', 1000, '45', 500, 'No Promotion', 'Good Food', 'Burger-King.jpg', 'Burgers,Sandwiches,American', 0, 'ENG', '2016-06-05 00:00:00', '2016-06-07 14:52:05', 3, 'SY', 1, 'برجر كينج', 'مطعم متخصص بالوجبات السريعة', 'ساحة العاصي خليف البريد هاتف 2121252252', '00963944508853'),
(2, 2, 3, 'Domino`s Pizza', 'Domino`s Pizza', 'Hama - Saht El Assi Tel: 9898989898', 1, '35.1311956', '36.7570917', '45 min', 1000, '45', 500, 'No Promotion', 'Good Food', 'ResizedLogo.png', 'Pizzas,American', 0, 'ENG', '2016-06-05 00:00:00', '2016-06-22 12:43:12', 3, 'SY', 1, 'دومينوز بيتزا', 'مطعم متخصص بالبيتزا', 'ساحة العاصي خليف جامع المدفن هاتف 3232222', '00963944508853'),
(3, 2, 3, 'Subway', 'Subway', 'Hama - Saht El Assi Tel: 45454545', 1, '35.1611956', '36.7670917', '35 min', 800, '35', 400, '', 'Good Food', 'log.jpg', 'Healthy Food,Sandwiches,Breakfast', 0, 'ENG', '2016-06-05 00:00:00', '2016-06-05 11:45:56', 1, 'SY', 0, 'صب واي', 'صب واي', 'ساحة العاصي خليف جامع  الشيرازي هاتف 454545', '00963944508853');

-- --------------------------------------------------------

--
-- Table structure for table `shop_delivery_areas`
--

CREATE TABLE `shop_delivery_areas` (
  `id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_delivery_areas`
--

INSERT INTO `shop_delivery_areas` (`id`, `area_id`, `shop_id`, `deleted`, `created_at`, `updated_at`) VALUES
(2, 3, 1, 0, NULL, NULL),
(3, 3, 2, 0, NULL, NULL),
(4, 3, 3, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_item_categories`
--

CREATE TABLE `shop_item_categories` (
  `id` int(11) NOT NULL,
  `item_category_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_item_categories`
--

INSERT INTO `shop_item_categories` (`id`, `item_category_id`, `shop_id`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, NULL, NULL),
(2, 2, 1, 0, NULL, NULL),
(3, 3, 1, 0, NULL, NULL),
(4, 4, 1, 0, NULL, NULL),
(5, 5, 1, 0, NULL, NULL),
(6, 6, 1, 0, NULL, NULL),
(7, 13, 2, 0, NULL, NULL),
(8, 14, 2, 0, NULL, NULL),
(12, 12, 2, 0, NULL, NULL),
(13, 16, 3, 0, NULL, NULL),
(14, 17, 3, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_offers`
--

CREATE TABLE `shop_offers` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE dec8_bin NOT NULL,
  `short_description` varchar(255) COLLATE dec8_bin DEFAULT NULL,
  `photo` varchar(100) COLLATE dec8_bin NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `offer_type` varchar(45) COLLATE dec8_bin NOT NULL,
  `lang` varchar(5) COLLATE dec8_bin DEFAULT 'en',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `clickable` tinyint(1) DEFAULT '1',
  `ar_name` varchar(255) COLLATE dec8_bin DEFAULT NULL,
  `ar_short_description` varchar(255) COLLATE dec8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=dec8 COLLATE=dec8_bin;

--
-- Dumping data for table `shop_offers`
--

INSERT INTO `shop_offers` (`id`, `shop_id`, `item_id`, `name`, `short_description`, `photo`, `from_date`, `to_date`, `active`, `offer_type`, `lang`, `created_at`, `updated_at`, `clickable`, `ar_name`, `ar_short_description`) VALUES
(2, 1, 2, 'offer 1', 'desc desc', 'promotion1.jpg', '2016-05-01', '2017-05-31', 1, 'GOLDEN', 'en', '2016-05-21 00:00:00', '2016-06-04 12:05:15', 1, NULL, NULL),
(3, 2, 33, 'name ar', 'desc ar', 'promotion2.jpg', '2016-05-01', '2017-05-31', 1, 'SILVER', 'en', '2016-05-21 00:00:00', '2016-06-04 12:05:15', 1, NULL, NULL),
(5, 1, 1, 'offer 1', 'desc desc', 'promotion2.jpg', '2016-05-01', '2017-05-31', 1, 'GOLDEN', 'en', '2016-05-21 00:00:00', '2016-06-04 12:05:15', 1, NULL, NULL),
(6, 1, 4, 'offer 4', 'desc desc', 'promotion1.jpg', '2016-05-01', '2017-05-31', 1, 'GOLDEN', 'en', '2016-05-21 00:00:00', '2016-06-04 12:05:15', 1, NULL, NULL),
(7, 1, 2, 'offer 2', 'desc desc', 'promotion2.jpg', '2016-05-01', '2017-05-31', 1, 'GOLDEN', 'en', '2016-05-21 00:00:00', '2016-06-04 12:05:15', 1, NULL, NULL),
(8, 1, 2, 'name ar', 'desc ar', 'promotion1.jpg', '2016-05-01', '2017-05-31', 1, 'SILVER', 'en', '2016-05-21 00:00:00', '2016-06-04 12:05:15', 1, NULL, NULL),
(9, 2, 55, 'name ar', 'desc ar', 'promotion2.jpg', '2016-05-01', '2017-05-31', 1, 'SILVER', 'en', '2016-05-21 00:00:00', '2016-06-04 12:05:15', 1, NULL, NULL),
(10, 1, 2, 'name ar', 'desc ar', 'promotion1.jpg', '2016-05-01', '2017-05-31', 1, 'SILVER', 'en', '2016-05-21 00:00:00', '2016-06-04 12:05:15', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_rates`
--

CREATE TABLE `shop_rates` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_rates`
--

INSERT INTO `shop_rates` (`id`, `customer_id`, `shop_id`, `order_id`, `rate`, `deleted`) VALUES
(1, 1, 1, 19, 4, 0),
(2, 1, 1, 22, 0, 0),
(3, 1, 1, 23, 3, 0),
(4, 1, 1, 24, 4, 0),
(5, 6, 1, 27, 3, 0),
(6, 1, 1, 28, 4, 0),
(7, 1, 1, 29, 5, 0),
(8, 1, 1, 30, 4, 0),
(9, 1, 2, 32, 4, 0),
(10, 7, 2, 36, 0, 0),
(11, 1, 2, 38, 4, 0),
(12, 8, 2, 39, 3, 0),
(13, 8, 1, 40, 5, 0),
(14, 8, 1, 41, 4, 0),
(15, 8, 1, 42, 4, 0),
(16, 1, 1, 59, 4, 0),
(17, 1, 1, 62, 4, 0),
(18, 3, 2, 63, 3, 0),
(19, 1, 1, 71, 3, 0),
(20, 1, 1, 74, 4, 0),
(21, 1, 2, 75, 5, 0),
(22, 8, 2, 76, 4, 0),
(23, 8, 2, 79, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, '', '', 'ysabouh', 'BZSqc0jNwRQNablM40utOA6LBmwrxDQh', '$2y$13$D.JaNzE0HKEdN//koCiazuhped2X1LcL5FlCKw5Rzshhe/D.0EpD.', NULL, 'yaser.alsabbouh@gmail.com', 10, 1468595644, 1468595644),
(2, 'Yasser', 'El Sabbouh', 'ysabouh1', 'bNCN1GOQIF19Pu8_CvUXjzh952H_gPCl', '$2y$13$8y/SnzYPdtux/bif93FMt.ff.9ZX5l2E1j44zfW5UyUfVBG.2UY4.', NULL, 'test@gmail.com', 10, 1468598229, 1468598229);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `auth_token` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password_digest` varchar(255) NOT NULL,
  `full_name` varchar(145) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `is_fired` tinyint(1) DEFAULT '0',
  `gender` varchar(255) DEFAULT 'Male',
  `user_type` varchar(30) NOT NULL DEFAULT 'SHOP_ADMIN',
  `deleted` tinyint(1) DEFAULT '0',
  `lang` varchar(5) DEFAULT 'en',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `subscribed` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `shop_id`, `auth_token`, `username`, `password_digest`, `full_name`, `phone`, `is_fired`, `gender`, `user_type`, `deleted`, `lang`, `created_at`, `updated_at`, `subscribed`) VALUES
(1, 1, 'jMDkRd497l', 'admin', '$2a$10$ZcKH5W/dFh1hC84TgKMqqueufzzKji.THqn/ZiBsKfJtVlPSpLuFm', 'Admin Admin', '1234567', 0, 'Male', 'CR_ADMIN', 0, 'en', '2016-07-08 00:00:00', '2016-07-08 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_areas_cities1_idx` (`city_id`);

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cities_countries_idx` (`country_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer_addresses_customers1_idx` (`customer_id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`,`customer_id`),
  ADD KEY `fk_devices_customers1_idx` (`customer_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_items_shop_item_categories1_idx` (`shop_item_category_id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `opening_hours`
--
ALTER TABLE `opening_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_opening_hours_shops1_idx` (`shop_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_customers1_idx` (`customer_id`);

--
-- Indexes for table `order_histories`
--
ALTER TABLE `order_histories`
  ADD PRIMARY KEY (`id`,`order_id`),
  ADD KEY `fk_order_histories_orders1_idx` (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`,`order_id`,`item_id`),
  ADD KEY `fk_order_items_orders1_idx` (`order_id`),
  ADD KEY `fk_order_items_items1_idx` (`item_id`);

--
-- Indexes for table `order_map_trace`
--
ALTER TABLE `order_map_trace`
  ADD PRIMARY KEY (`id`,`order_histories_id`),
  ADD KEY `fk_order_map_trace_order_histories1_idx` (`order_histories_id`);

--
-- Indexes for table `roles_group_elements`
--
ALTER TABLE `roles_group_elements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schema_migrations`
--
ALTER TABLE `schema_migrations`
  ADD UNIQUE KEY `unique_schema_migrations` (`version`);

--
-- Indexes for table `security_groups`
--
ALTER TABLE `security_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security_permissions`
--
ALTER TABLE `security_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security_user_groups`
--
ALTER TABLE `security_user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security_user_permissions`
--
ALTER TABLE `security_user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_roles_users1_idx` (`user_id`),
  ADD KEY `fk_users_roles_roles1_idx` (`security_permission_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_shops_businesses1_idx` (`business_id`);

--
-- Indexes for table `shop_delivery_areas`
--
ALTER TABLE `shop_delivery_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_shop_Delivery_areas_areas1_idx` (`area_id`),
  ADD KEY `fk_shop_Delivery_areas_shops1_idx` (`shop_id`);

--
-- Indexes for table `shop_item_categories`
--
ALTER TABLE `shop_item_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_shop_item_categories_item_categories1_idx` (`item_category_id`),
  ADD KEY `fk_shop_item_categories_shops1_idx` (`shop_id`);

--
-- Indexes for table `shop_offers`
--
ALTER TABLE `shop_offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_shop_offers_shops1_idx` (`shop_id`),
  ADD KEY `fk_shop_offers_items1_idx` (`item_id`);

--
-- Indexes for table `shop_rates`
--
ALTER TABLE `shop_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_shop_rates_on_shop_id` (`shop_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_shops1_idx` (`shop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `opening_hours`
--
ALTER TABLE `opening_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `order_histories`
--
ALTER TABLE `order_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `order_map_trace`
--
ALTER TABLE `order_map_trace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles_group_elements`
--
ALTER TABLE `roles_group_elements`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `security_groups`
--
ALTER TABLE `security_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `security_permissions`
--
ALTER TABLE `security_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `security_user_groups`
--
ALTER TABLE `security_user_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `security_user_permissions`
--
ALTER TABLE `security_user_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `shop_delivery_areas`
--
ALTER TABLE `shop_delivery_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `shop_item_categories`
--
ALTER TABLE `shop_item_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `shop_offers`
--
ALTER TABLE `shop_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `shop_rates`
--
ALTER TABLE `shop_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `fk_areas_cities1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `fk_cities_countries` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `fk_customer_addresses_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_shop_item_categories1` FOREIGN KEY (`shop_item_category_id`) REFERENCES `shop_item_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `opening_hours`
--
ALTER TABLE `opening_hours`
  ADD CONSTRAINT `fk_opening_hours_shops1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_histories`
--
ALTER TABLE `order_histories`
  ADD CONSTRAINT `fk_order_histories_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_items1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_items_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_map_trace`
--
ALTER TABLE `order_map_trace`
  ADD CONSTRAINT `fk_order_map_trace_order_histories1` FOREIGN KEY (`order_histories_id`) REFERENCES `order_histories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `security_user_permissions`
--
ALTER TABLE `security_user_permissions`
  ADD CONSTRAINT `fk_users_roles_roles1` FOREIGN KEY (`security_permission_id`) REFERENCES `security_permissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_roles_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `fk_shops_businesses1` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop_delivery_areas`
--
ALTER TABLE `shop_delivery_areas`
  ADD CONSTRAINT `fk_shop_Delivery_areas_areas1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shop_Delivery_areas_shops1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop_item_categories`
--
ALTER TABLE `shop_item_categories`
  ADD CONSTRAINT `fk_shop_item_categories_item_categories1` FOREIGN KEY (`item_category_id`) REFERENCES `item_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shop_item_categories_shops1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop_offers`
--
ALTER TABLE `shop_offers`
  ADD CONSTRAINT `fk_shop_offers_items1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shop_offers_shops1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_shops1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
