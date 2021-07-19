-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2021 at 11:18 AM
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
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addressType` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `customerId`, `address`, `area`, `city`, `state`, `zipcode`, `country`, `addressType`, `created_at`, `updated_at`) VALUES
(1, 3, 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'billing', '2021-06-20 23:45:45', '2021-06-20 23:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customerId` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paymentId` bigint(20) UNSIGNED DEFAULT NULL,
  `shippingId` bigint(20) UNSIGNED DEFAULT NULL,
  `shippingAmount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `customerId`, `total`, `discount`, `paymentId`, `shippingId`, `shippingAmount`, `created_at`, `updated_at`) VALUES
(1, 1, '0.00', '0.00', NULL, NULL, '0.00', '2021-06-13 22:41:08', '2021-06-20 23:44:42'),
(2, 2, '90.00', '10.00', NULL, NULL, '0.00', '2021-06-13 22:41:35', '2021-06-13 22:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `cart_addresses`
--

CREATE TABLE `cart_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cartId` bigint(20) UNSIGNED NOT NULL,
  `addressId` bigint(20) UNSIGNED DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addressType` enum('shipping','billing') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'billing',
  `sameAsBilling` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 2, 1, 1, '100.00', '100.00', '10.00', '2021-06-13 22:41:42', '2021-06-13 22:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parentId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pathId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`, `parentId`, `pathId`) VALUES
(1, 'new', NULL, '1', NULL, '2021-06-13 20:45:52', '0', '1'),
(2, 'Ab', NULL, '1', NULL, '2021-06-20 23:38:12', '0', '2');

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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `postId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `postId`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'p1', '1', NULL, NULL),
(2, '1', 'p2', '1', NULL, NULL),
(3, '1', 'p4\r\n                                                                                                     ', '1', NULL, NULL),
(4, '2', 'p3', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment_post`
--

CREATE TABLE `comment_post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` int(11) NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment_post`
--

INSERT INTO `comment_post` (`id`, `comment_id`, `post_id`, `status`, `commentable_id`, `commentable_type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', 1, 'App\\Models\\Post', NULL, NULL),
(2, 1, 1, '1', 1, 'App\\Models\\Comment', NULL, NULL);

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
(1, 'saloni', 'maheshwari', 'saloni@gmail.com', 'eyJpdiI6IkxVOEFSZ21YQTdITnNWNHJ6Q205dVE9PSIsInZhbHVlIjoiTy9sQ2xTUjRNSGtxczRKbE0rSEhBdz09IiwibWFjIjoiMGQ0ZTNjYjM5YWQ5N2JkYThkMzdjMzYyYjI3OWRiNjExOGUyNTI4OTg2MTRmOWM3YThkNTJiMWRkZjQ4NmIwOCJ9', '9413145532', 1, NULL, NULL),
(2, 'riya', 's', 's@gmail.com', 'eyJpdiI6IlV6bm9ZZ1VhdEZmSGltdk9EOHNOL3c9PSIsInZhbHVlIjoiMUtiOEoyajFzTVo3ZFB6SytrNTE1UT09IiwibWFjIjoiMDYzNzQ4MjY1M2E0NDc0ZjViNWVjYWE1Y2U3ZjM0OTVkZTQyZjEzNWZjNzU3Y2E4ZjY5ZThlNzAyMTkyMjM5MCJ9', '123456', 1, NULL, NULL),
(3, 'saloni', 'maheshwari', 'saloni45@gmail.com', 'eyJpdiI6Ikh1UWVDd3FpdHp1cDNaRGYzWG5ydWc9PSIsInZhbHVlIjoibDRsVTZxTmtnRTRKQW1TU0Z4Ky9Bdz09IiwibWFjIjoiZWRjMjg1OTdkMDFhYjcxZDg3ZmI4ODljZWEwZjA2ZTlhODAxZmExY2E0ZDc3MjIwOWQxM2YwNWY2MjMwNTM3OCJ9', '123456', 1, NULL, NULL);

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
-- Table structure for table `import_export_csvs`
--

CREATE TABLE `import_export_csvs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'productLabel',
  `small` tinyint(4) NOT NULL DEFAULT 0,
  `thumb` tinyint(4) NOT NULL DEFAULT 0,
  `base` tinyint(4) NOT NULL DEFAULT 0,
  `gallery` tinyint(4) NOT NULL DEFAULT 0,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_comments_table', 1),
(2, '2014_10_12_000000_create_posts_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2021_04_29_082939_create_cccprac1_table', 1),
(7, '2021_04_30_031515_create_products_table', 1),
(8, '2021_05_13_082520_create_customers_table', 1),
(9, '2021_05_19_074110_create_payments_table', 1),
(10, '2021_05_19_074135_create_shippings_table', 1),
(11, '2021_05_19_074431_create_carts_table', 1),
(12, '2021_05_19_075153_create_cart_items_table', 1),
(13, '2021_05_24_022859_create_orders_table', 1),
(14, '2021_05_24_023813_create_order_items_table', 1),
(15, '2021_05_27_111733_create_categories_table', 1),
(16, '2021_05_28_053855_create_media_table', 1),
(17, '2021_05_30_113535_create_addresses_table', 1),
(18, '2021_06_01_063122_create_cart_addresses_table', 1),
(19, '2021_06_01_063256_create_order_addresses_table', 1),
(20, '2021_06_03_015933_create_order_statuses_table', 1),
(21, '2021_06_03_025004_add__cart__address__null', 1),
(22, '2021_06_03_030106_add__order__address__null', 1),
(23, '2021_06_03_033410_add__sku_unique', 1),
(24, '2021_06_03_034009_add_category_name_unique', 1),
(25, '2021_06_03_090142_add_payment_shippingid_cart_null', 1),
(26, '2021_06_04_042252_add_path_id_category', 1),
(27, '2021_06_07_114134_create_routes_table', 1),
(28, '2021_06_07_144325_create_import_export_csvs_table', 1),
(29, '2021_06_08_044649_drop_foreign_key_category', 1),
(30, '2021_06_08_050719_add_category_path', 1),
(31, '2021_06_10_100155_create_comment_post_table', 1),
(32, '2021_06_10_123853_create_salesmen_table', 1),
(33, '2021_06_10_123953_create_salesman_products_table', 1),
(34, '2021_06_11_143807_add_products_field_null', 1),
(35, '2021_06_11_161042_create_salesman_product_discount_null', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customerId` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paymentId` bigint(20) UNSIGNED NOT NULL,
  `shippingId` bigint(20) UNSIGNED NOT NULL,
  `shippingAmount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('Confirm','Pending','InProcess','Shipped','Cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customerId`, `total`, `paymentId`, `shippingId`, `shippingAmount`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '298.00', 1, 1, '100.00', '30.00', 'Pending', '2021-06-20 23:46:03', '2021-06-20 23:46:03');

-- --------------------------------------------------------

--
-- Table structure for table `order_addresses`
--

CREATE TABLE `order_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `addressId` bigint(20) UNSIGNED DEFAULT NULL,
  `orderId` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addressType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'billing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_addresses`
--

INSERT INTO `order_addresses` (`id`, `addressId`, `orderId`, `address`, `area`, `city`, `state`, `zipcode`, `country`, `addressType`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'billing', '2021-06-20 23:46:04', '2021-06-20 23:46:04'),
(2, NULL, 1, 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'shipping', '2021-06-20 23:46:04', '2021-06-20 23:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderId` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `basePrice` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `orderId`, `productId`, `quantity`, `basePrice`, `price`, `discount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '100.00', '100.00', '10.00', '2021-06-20 23:46:04', '2021-06-20 23:46:04'),
(2, 1, 4, 1, '20.00', '20.00', '10.00', '2021-06-20 23:46:04', '2021-06-20 23:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderId` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Confirm','Pending','InProcess','Shipped','Cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `orderId`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'pending', 'Pending', '2021-06-20 23:46:24', '2021-06-20 23:46:24');

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
(1, 'Cash on Delivery', 'cod', 'cod', 1, NULL, NULL),
(2, 'visa card', 'card', '1', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commentId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `commentId`, `name`, `created_at`, `updated_at`) VALUES
(1, '1', 'c2', NULL, NULL),
(2, '2', 'c1\r\n                                                                                   ', NULL, NULL),
(3, 'E2KTbxrHIU', 'cy9npnzeoU', NULL, NULL),
(4, '92x2d1PLK9', '6ik0LdIESX', NULL, NULL),
(5, '2', 'fb', NULL, NULL),
(6, '1', 'Delia Brakus', NULL, NULL),
(7, '1', 'Mitchel Willms', NULL, NULL),
(8, '1', 'Dr. Joe Schimmel', NULL, NULL),
(9, '1', 'Mr. Austyn Pacocha', NULL, NULL),
(10, '1', 'Dr. Jaime Turner Jr.', NULL, NULL),
(11, '1', 'Watson Satterfield II', NULL, NULL),
(12, '1', 'Prof. Marianne Quitzon', NULL, NULL),
(13, '1', 'Madisen Friesen', NULL, NULL),
(14, '1', 'Shaniya Parker', NULL, NULL),
(15, '1', 'Prof. Alfonzo Lebsack V', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `price`, `discount`, `quantity`, `description`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'table', 'tableTop', '100.00', 10, 10, '1', 1, 1, '2021-06-14 02:16:36', NULL),
(4, 'teaTable', 'teaTable', '20.00', 10, 1, 'queensize', 1, 6, '2021-06-13 20:47:04', '2021-06-21 02:29:07'),
(5, 'Table', 'Table', '20.00', 10, 1, 'queensize', 1, 2, '2021-06-13 20:47:04', '2021-06-21 02:29:07'),
(6, 'Bench', 'Bench', '20.00', 10, 1, 'queensize', 1, 2, '2021-06-13 20:47:04', '2021-06-21 02:29:07'),
(8, 'FileCase', 'FileCase', '20.00', 10, 1, 'queensize', 1, 2, '2021-06-13 20:47:04', '2021-06-21 02:29:07'),
(9, 'Fase', 'Case', '2000.00', 10, 1, 'queensize', 1, 2, '2021-06-13 20:47:04', '2021-06-21 02:29:07'),
(10, 'Case', 'Fase', '2000.00', 10, 1, 'queensize', 1, 2, '2021-06-13 20:47:04', '2021-06-21 02:29:07'),
(57, 'diningTable', 'diningTable', '5000.00', 10, 1, 'queensize', 1, 6, '2021-06-21 01:28:29', '2021-06-21 02:29:07'),
(58, 'rawTable', 'rawTable', '20.00', 10, 1, 'queensize', 1, 6, '2021-06-21 01:28:29', '2021-06-21 02:29:07'),
(59, 'BookCase', 'BookCase', '900.00', 10, 1, 'queensize', 1, 2, '2021-06-21 01:28:29', '2021-06-21 02:29:07'),
(60, 'Case', 'Fase1', '2000.00', 10, 1, 'queensize', 1, 2, '2021-06-21 01:28:29', '2021-06-21 02:29:07'),
(61, 'NightStand', 'NightStand', '2000.00', 10, 1, 'queensize', 1, 2, '2021-06-21 01:28:29', '2021-06-21 02:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salesman_products`
--

CREATE TABLE `salesman_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salesman_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `salesmanPrice` decimal(10,2) DEFAULT NULL,
  `salesmanDiscount` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salesman_products`
--

INSERT INTO `salesman_products` (`id`, `salesman_id`, `product_id`, `salesmanPrice`, `salesmanDiscount`, `created_at`, `updated_at`) VALUES
(11, 1, 1, '100.00', '10.00', NULL, '2021-06-18 01:42:41'),
(12, 1, 4, '100.00', '1.00', NULL, '2021-06-18 01:42:41'),
(13, 1, 5, '100.00', NULL, NULL, '2021-06-18 01:42:41'),
(14, 1, 6, '100.00', NULL, NULL, '2021-06-18 01:42:41'),
(15, 1, 8, '100.00', NULL, NULL, '2021-06-18 01:42:41'),
(16, 1, 9, '2000.00', NULL, NULL, '2021-06-18 01:42:41'),
(17, 1, 10, '2000.00', NULL, NULL, '2021-06-18 01:42:41'),
(18, 1, 11, '2000.00', NULL, NULL, '2021-06-18 01:42:41'),
(19, 1, 12, '2000.00', NULL, NULL, '2021-06-18 01:42:41'),
(20, 1, 42, '200.00', NULL, NULL, '2021-06-18 00:44:32'),
(21, 14, 1, '200.00', NULL, NULL, '2021-06-18 06:13:45'),
(22, 14, 4, '21.00', '1.00', NULL, '2021-06-18 06:13:45'),
(23, 14, 5, '21.00', NULL, NULL, '2021-06-18 06:13:45'),
(24, 14, 6, '21.00', NULL, NULL, '2021-06-18 06:13:45'),
(25, 14, 8, '21.00', NULL, NULL, '2021-06-18 06:13:45'),
(26, 14, 9, '2000.00', NULL, NULL, '2021-06-18 06:13:45'),
(27, 14, 10, '2000.00', NULL, NULL, '2021-06-18 06:13:45'),
(28, 14, 11, '2000.00', NULL, NULL, '2021-06-18 06:13:45'),
(29, 14, 12, '2000.00', NULL, NULL, '2021-06-18 06:13:45'),
(30, 14, 42, '1000.00', NULL, NULL, '2021-06-18 00:45:09'),
(40, 14, 44, NULL, NULL, NULL, '2021-06-18 04:15:36'),
(77, 14, 1, '200.00', '0.00', NULL, NULL),
(78, 14, 4, '21.00', '0.00', NULL, NULL),
(79, 14, 5, '21.00', '0.00', NULL, NULL),
(80, 14, 6, '21.00', '0.00', NULL, NULL),
(81, 14, 8, '21.00', '0.00', NULL, NULL),
(82, 14, 9, '2000.00', '0.00', NULL, NULL),
(83, 14, 10, '2000.00', '0.00', NULL, NULL),
(84, 14, 59, '1000.00', '0.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salesmen`
--

CREATE TABLE `salesmen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salesmen`
--

INSERT INTO `salesmen` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'saloni', '2021-06-13 20:47:17', '2021-06-13 20:47:17'),
(14, 'siya', '2021-06-14 08:10:24', '2021-06-14 08:10:24');

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
(1, 'normal Delivery', 'normal', '100.00', '10', 1, NULL, NULL),
(2, 'express Delivery', 'express', '400.00', '1', 1, NULL, NULL);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `cccprac1`
--
ALTER TABLE `cccprac1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_post`
--
ALTER TABLE `comment_post`
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
-- Indexes for table `import_export_csvs`
--
ALTER TABLE `import_export_csvs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_shippingid_foreign` (`shippingId`),
  ADD KEY `orders_customerid_foreign` (`customerId`),
  ADD KEY `orders_paymentid_foreign` (`paymentId`);

--
-- Indexes for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_addresses_addressid_foreign` (`addressId`),
  ADD KEY `order_addresses_orderid_foreign` (`orderId`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_orderid_foreign` (`orderId`),
  ADD KEY `order_items_productid_foreign` (`productId`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_statuses_orderid_foreign` (`orderId`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `routes_url_unique` (`url`),
  ADD UNIQUE KEY `routes_name_unique` (`name`);

--
-- Indexes for table `salesman_products`
--
ALTER TABLE `salesman_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salesman_products_salesman_id_foreign` (`salesman_id`),
  ADD KEY `salesman_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `salesmen`
--
ALTER TABLE `salesmen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `salesmen_name_unique` (`name`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_addresses`
--
ALTER TABLE `cart_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment_post`
--
ALTER TABLE `comment_post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `import_export_csvs`
--
ALTER TABLE `import_export_csvs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_addresses`
--
ALTER TABLE `order_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salesman_products`
--
ALTER TABLE `salesman_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `salesmen`
--
ALTER TABLE `salesmen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customerid_foreign` FOREIGN KEY (`customerId`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_paymentid_foreign` FOREIGN KEY (`paymentId`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_shippingid_foreign` FOREIGN KEY (`shippingId`) REFERENCES `shippings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD CONSTRAINT `order_addresses_addressid_foreign` FOREIGN KEY (`addressId`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_addresses_orderid_foreign` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_orderid_foreign` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD CONSTRAINT `order_statuses_orderid_foreign` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_products`
--
ALTER TABLE `salesman_products`
  ADD CONSTRAINT `salesman_products_salesman_id_foreign` FOREIGN KEY (`salesman_id`) REFERENCES `salesmen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
