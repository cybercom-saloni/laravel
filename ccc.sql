-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2021 at 07:47 AM
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
-- Database: `ccc`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customerId` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addressType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `customerId`, `address`, `area`, `city`, `state`, `zipcode`, `country`, `addressType`, `created_at`, `updated_at`) VALUES
(1, 1, 'rt', 'r', 'r', 'r', 'r', 'r', 'billing', NULL, '2021-05-19 10:44:43'),
(2, 2, 'ratiban', 'ab', 'ab', 'ab', 'ab', 'ab', 'billing', '2021-05-19 03:44:13', '2021-05-19 07:38:16'),
(3, 2, 'rrrrrrrrr', 'ab', 'ab', 'ab', 'ab', 'ab', 'shipping', '2021-05-19 03:44:13', '2021-05-19 07:38:16'),
(4, 3, 'rati', 'ab', 'ab', 'ab', 'ab', 'ab', 'billing', '2021-05-19 07:27:54', '2021-05-19 07:27:54'),
(5, 1, 'rrrrrrrrr', 'ab', 'ab', 'ab', 'ab', 'ab', 'shipping', '2021-05-19 07:31:59', '2021-05-19 07:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customerId` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paymentId` bigint(20) UNSIGNED NOT NULL,
  `shippingId` bigint(20) UNSIGNED NOT NULL,
  `shippingAmount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `customerId`, `total`, `discount`, `paymentId`, `shippingId`, `shippingAmount`, `created_at`, `updated_at`) VALUES
(4, 1, '0.00', '0.00', 2, 2, '100.00', '2021-05-19 02:51:06', '2021-05-19 23:14:00'),
(5, 2, '0.00', '0.00', 1, 1, '0.00', '2021-05-19 02:51:20', '2021-05-19 02:51:20'),
(8, 3, '0.00', '0.00', 1, 1, '0.00', '2021-05-19 03:06:56', '2021-05-19 03:06:56'),
(9, 6, '0.00', '0.00', 1, 1, '0.00', '2021-05-19 05:54:14', '2021-05-19 05:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `cart_addresses`
--

CREATE TABLE `cart_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cartId` bigint(20) UNSIGNED NOT NULL,
  `addressId` bigint(20) UNSIGNED DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addressType` enum('shipping','billing') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sameAsBilling` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_addresses`
--

INSERT INTO `cart_addresses` (`id`, `cartId`, `addressId`, `address`, `area`, `city`, `state`, `zipcode`, `country`, `addressType`, `sameAsBilling`, `created_at`, `updated_at`) VALUES
(1, 8, NULL, 'rati', 'ab', 'ab', 'ab', 'ab', 'ab', 'billing', '0', '2021-05-19 03:51:28', '2021-05-19 07:28:30'),
(2, 8, NULL, 'ab', 'ab', 'ab', 'ab', 'ab', 'ab', 'shipping', '0', '2021-05-19 04:00:47', '2021-05-19 07:28:30'),
(7, 4, 1, 'rt', 'r', 'r', 'r', 'r', 'r', 'billing', '0', '2021-05-19 04:52:21', '2021-05-19 23:13:59'),
(9, 4, 5, 'rrrrrrrrr', 'ab', 'ab', 'ab', 'ab', 'ab', 'shipping', '0', '2021-05-19 04:53:50', '2021-05-19 23:13:59'),
(10, 5, 2, 'ratiban', 'ab', 'ab', 'ab', 'ab', 'ab', 'billing', '0', '2021-05-19 06:08:07', '2021-05-19 07:39:52'),
(11, 5, 3, 'rrrrrrrrr', 'ab', 'ab', 'ab', 'ab', 'ab', 'shipping', '0', '2021-05-19 06:08:07', '2021-05-19 07:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cartId` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `basePrice` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cartId`, `productId`, `quantity`, `basePrice`, `price`, `discount`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 1, '100.00', '100.00', '1.00', '2021-05-19 23:56:00', '2021-05-20 00:05:01'),
(2, 4, 7, 1, '1.00', '1.00', '1.00', '2021-05-19 23:56:15', '2021-05-20 00:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'category1', 0, 'cat1', '1', NULL, NULL),
(2, 'child2', 1, 'child', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cccprac1`
--

CREATE TABLE `cccprac1` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `email`, `password`, `contactno`, `status`, `created_at`, `updated_at`) VALUES
(1, 'saloni', 'maheshwari', 'saloni01@gmail.com', 'eyJpdiI6Imlrc2FHQzBPQzNuRVE1a2hWUzlIY0E9PSIsInZhbHVlIjoibWpBSzhZQldtNUVLS0p4WkQySElWQT09IiwibWFjIjoiOTc3ODc3NmZkYzJmYmZiYTU0OGUwNGM5MTgxNDZhYmQ3MDhiMTkxZDc5OTQyOWM4MjA1OWNlOWQ1NWY5ODY3ZSJ9', '94131233', 1, NULL, '2021-05-13 04:35:05'),
(2, 'anshul', 'parwal', 'ansh@gmail.com', 'eyJpdiI6IkNDejIwL05SN3ZJSkViZWN4Zkxpcnc9PSIsInZhbHVlIjoiMTNPNkZYRVJBbmkzQ2VXWFZPbEtxdz09IiwibWFjIjoiNGRlMzMzYzIxMzY1MTE3ZGIwNTliYjI3NTk1YmRmYzI1MGRhMDEyYjUxMTRjMzQ0ZjljYmNmZWM0ZjgyZTA5NSJ9', '941314553', 1, NULL, '2021-05-19 03:43:39'),
(3, 'newcust', 'cust', 'cust@gmail.com', 'eyJpdiI6Ind0bW05a202Yks1akcrd2tKRkNuWFE9PSIsInZhbHVlIjoiS29xWDV4WEpyc0IwMkR2M0wzOEdGZz09IiwibWFjIjoiOTQ1ZmRlZmNhM2I1ZDY4NzZiZGI4ODdlNTZiZDI4NzY1YjdmZmEyNTZlMmJhYmVlZGQ4ZjQ4ZDQ4ZmRmYjI3ZSJ9', '941314552', 1, NULL, '2021-05-13 06:39:59'),
(6, 'x', 'x', 'x', 'eyJpdiI6IkdFWVdtc2liSjUzTmVTWGlWaVRsYUE9PSIsInZhbHVlIjoiWjdYNnpQM3ljRDdTclBVWXF1Rk1xdz09IiwibWFjIjoiYTBjYjk4YjBmMmJiYjEzYTY2YTI4NGMyNmQ4OTA4NmI5ZWMxYTY3OTMzODM0NDE0MDZlZGNmYmIxMzRlNjRjNCJ9', '1', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'label',
  `small` tinyint(4) NOT NULL DEFAULT 0,
  `thumb` tinyint(4) NOT NULL DEFAULT 0,
  `base` tinyint(4) NOT NULL DEFAULT 0,
  `gallery` tinyint(4) NOT NULL DEFAULT 0,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `media`, `label`, `small`, `thumb`, `base`, `gallery`, `product_id`, `created_at`, `updated_at`) VALUES
(6, '1620798786.png', 'qw', 1, 0, 1, 1, 2, NULL, NULL),
(7, '1620917391.jpg', 'label', 0, 0, 0, 0, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(112, '2014_10_12_000000_create_users_table', 1),
(113, '2014_10_12_100000_create_password_resets_table', 1),
(114, '2019_08_19_000000_create_failed_jobs_table', 1),
(115, '2021_04_29_082939_create_cccprac1_table', 1),
(116, '2021_04_29_145231_create_posts_table', 1),
(117, '2021_04_29_145647_create_post_table', 1),
(118, '2021_04_30_031342_create_pots_table', 1),
(119, '2021_04_30_031515_create_products_table', 1),
(120, '2021_05_02_033041_create_media_table', 1),
(121, '2021_05_03_052259_create_categories_table', 1),
(123, '2021_05_05_013412_create_categorynews_table', 1),
(125, '2021_05_05_010114_create_category_table', 2),
(126, '2021_05_05_063624_create_categories_table', 3),
(127, '2021_05_05_123131_create_categories_table', 4),
(128, '2021_05_12_065448_create_customers_table', 5),
(129, '2021_05_12_075321_create_customers_table', 6),
(130, '2021_05_12_081246_create_customers_table', 7),
(131, '2021_05_13_041504_create_customer_addresses_table', 8),
(132, '2021_05_13_045411_create_addresses_table', 9),
(133, '2021_05_13_060001_create_addresses_table', 10),
(134, '2021_05_13_082028_create_addresses_table', 11),
(135, '2021_05_13_082520_create_customers_table', 12),
(136, '2021_05_13_082653_create_categories_table', 13),
(137, '2021_05_13_082836_create_addresses_table', 14),
(138, '2021_05_14_004423_create_carts_table', 15),
(139, '2021_05_14_004601_create_cart_item_table', 15),
(140, '2021_05_14_004843_create_cart_address_table', 15),
(141, '2021_05_14_010233_create_payment_table', 15),
(142, '2021_05_14_010711_create_shipment_table', 15),
(143, '2021_05_14_012535_create_shipping_table', 16),
(144, '2021_05_14_015646_create_carts_table', 17),
(145, '2021_05_19_074110_create_payments_table', 18),
(146, '2021_05_19_074135_create_shippings_table', 18),
(147, '2021_05_19_074431_create_carts_table', 19),
(148, '2021_05_19_075153_create_cart_items_table', 20),
(149, '2021_05_19_080306_create_addresses_table', 21),
(150, '2021_05_19_080529_create_cart_addresses_table', 22);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentId` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentId`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'cash on delivery', 'cod', 'cod', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'cash on delivery', 'cod', 'cod', 1, NULL, NULL),
(2, 'card', 'card', 'card', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pots`
--

CREATE TABLE `pots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `price`, `discount`, `quantity`, `description`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'panel', 'panel', 100, 1, 1, 'nice', 1, 2, '2021-05-04 22:38:58', '2021-05-04 22:43:36'),
(7, '1', '1', 1, 1, 1, '1', 1, 1, '2021-05-13 04:28:24', NULL),
(8, '2', 'second pro', 2, 2, 2, '2', 1, 1, '2021-05-13 04:28:39', '2021-05-17 06:50:17'),
(9, '1', '2', 1, 1, 1, '1', 1, 1, '2021-05-17 04:41:32', '2021-05-17 06:57:22'),
(10, '2', '2', 2, 2, 2, '1', 0, 1, '2021-05-17 04:41:57', '2021-05-17 01:18:04'),
(11, 'new', 'new1', 100, 10, 1, '111', 1, 1, '2021-05-17 06:47:13', '2021-05-17 06:47:57'),
(12, '1', '1', 1, 1, 1, '1', 0, 1, '2021-05-17 06:57:56', NULL),
(14, 's', 's', 12, 1, 1, '1', 1, 1, '2021-05-17 20:35:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shippingId` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `name`, `code`, `amount`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'fast Delivery', 'fast', '400.00', 'fast', 1, NULL, NULL),
(2, 'express delivery', 'express', '100.00', 'express', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_customerid_foreign` (`customerId`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_shippingid_foreign` (`shippingId`),
  ADD KEY `carts_customerid_foreign` (`customerId`),
  ADD KEY `carts_paymentid_foreign` (`paymentId`);

--
-- Indexes for table `cart_addresses`
--
ALTER TABLE `cart_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_addresses_cartid_foreign` (`cartId`),
  ADD KEY `cart_addresses_addressid_foreign` (`addressId`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cartid_foreign` (`cartId`),
  ADD KEY `cart_items_productid_foreign` (`productId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cccprac1`
--
ALTER TABLE `cccprac1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pots`
--
ALTER TABLE `pots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shippingId`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart_addresses`
--
ALTER TABLE `cart_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cccprac1`
--
ALTER TABLE `cccprac1`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pots`
--
ALTER TABLE `pots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shippingId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_customerid_foreign` FOREIGN KEY (`customerId`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_customerid_foreign` FOREIGN KEY (`customerId`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_paymentid_foreign` FOREIGN KEY (`paymentId`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_shippingid_foreign` FOREIGN KEY (`shippingId`) REFERENCES `shippings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_addresses`
--
ALTER TABLE `cart_addresses`
  ADD CONSTRAINT `cart_addresses_addressid_foreign` FOREIGN KEY (`addressId`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_addresses_cartid_foreign` FOREIGN KEY (`cartId`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cartid_foreign` FOREIGN KEY (`cartId`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_items_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
