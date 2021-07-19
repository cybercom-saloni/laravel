-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2021 at 12:19 PM
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
(1, 3, 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'billing', '2021-06-20 23:45:45', '2021-06-20 23:45:45'),
(2, 2, '56', '1', '1', '1', '1', '1', 'billing', '2021-06-28 00:16:18', '2021-06-28 00:16:32'),
(3, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'shipping', '2021-06-28 00:16:18', '2021-06-28 00:16:18'),
(4, 3, '1', '1', '1', '1', '1', '1', 'shipping', '2021-06-30 07:06:14', '2021-06-30 07:06:14');

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
(1, 1, '972.00', '60.00', NULL, NULL, '0.00', '2021-06-13 22:41:08', '2021-06-28 05:42:52'),
(5, 3, '0.00', '0.00', NULL, NULL, '0.00', '2021-06-23 05:07:55', '2021-06-28 05:31:06'),
(7, 5, '0.00', '0.00', NULL, NULL, '0.00', '2021-06-28 05:26:15', '2021-06-28 05:26:17');

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

--
-- Dumping data for table `cart_addresses`
--

INSERT INTO `cart_addresses` (`id`, `cartId`, `addressId`, `address`, `area`, `city`, `state`, `zipcode`, `country`, `addressType`, `sameAsBilling`, `created_at`, `updated_at`) VALUES
(9, 5, 1, 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'billing', '0', '2021-06-28 05:28:03', '2021-06-28 05:28:03');

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
(6, 1, 1, 3, '100.00', '300.00', '10.00', '2021-06-28 05:26:41', '2021-06-28 05:27:53'),
(7, 1, 4, 3, '20.00', '60.00', '10.00', '2021-06-28 05:26:41', '2021-06-28 05:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parentId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pathId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `slug`, `status`, `created_at`, `updated_at`, `parentId`, `pathId`, `sort_order`) VALUES
(1, 'new1', NULL, '', '1', NULL, '2021-07-14 04:12:26', NULL, '1', 3),
(2, 'Ab', NULL, '', '1', NULL, '2021-07-14 02:05:57', '3', '2', 1),
(3, 'parent_A', '<p>f</p>', '', '1', NULL, '2021-07-14 04:12:27', NULL, NULL, 4),
(7, 'child_B', '<p>d</p>', '', '1', NULL, '2021-07-14 04:12:26', NULL, NULL, 1),
(9, 'a', '<p>ff</p>', '', '1', NULL, '2021-07-01 08:11:44', '11', NULL, 1),
(10, 'd1', '<p>d</p>', '', '1', NULL, '2021-07-14 02:05:57', '3', NULL, 2),
(11, 'd', '<p>d</p>', '', '1', NULL, '2021-07-14 04:12:26', NULL, NULL, 2),
(14, 'e', '<p>v</p>', '', '2', NULL, '2021-06-30 20:22:51', '9', NULL, 1),
(15, 'child_c', '<p>c</p>', '', '1', NULL, '2021-06-30 20:23:11', '11', NULL, 1),
(16, 'ab child', '<p>c</p>', '', '1', NULL, '2021-07-14 04:12:24', '7', NULL, 1),
(17, 'echild', '<p>v</p>', '', '1', NULL, '2021-06-30 20:22:51', '9', NULL, 2),
(20, 'c', '<p>d</p>', NULL, '1', NULL, '2021-07-14 01:58:39', '7', NULL, 2);

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
  `password_confirmation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `email`, `password`, `password_confirmation`, `contactno`, `status`, `email_verified_at`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'saloni', 'maheshwari', 'saloni@gmail.com', 'saloni', '', '9413145532', '0', NULL, NULL, '2021-06-28 00:09:44', NULL),
(2, 'riya', 's', 's@gmail.com', 'eyJpdiI6IlV6bm9ZZ1VhdEZmSGltdk9EOHNOL3c9PSIsInZhbHVlIjoiMUtiOEoyajFzTVo3ZFB6SytrNTE1UT09IiwibWFjIjoiMDYzNzQ4MjY1M2E0NDc0ZjViNWVjYWE1Y2U3ZjM0OTVkZTQyZjEzNWZjNzU3Y2E4ZjY5ZThlNzAyMTkyMjM5MCJ9', '', '123456', '1', NULL, NULL, '2021-06-28 03:42:48', NULL),
(3, 'saloni', 'maheshwari', 'saloni45@gmail.com', 'eyJpdiI6Ikh1UWVDd3FpdHp1cDNaRGYzWG5ydWc9PSIsInZhbHVlIjoibDRsVTZxTmtnRTRKQW1TU0Z4Ky9Bdz09IiwibWFjIjoiZWRjMjg1OTdkMDFhYjcxZDg3ZmI4ODljZWEwZjA2ZTlhODAxZmExY2E0ZDc3MjIwOWQxM2YwNWY2MjMwNTM3OCJ9', '', '123456', '0', NULL, NULL, '2021-06-28 03:42:40', NULL),
(5, 'riya', 's', 'riya@gmail.com', 'eyJpdiI6ImhIRWJOS2ZRK1g3OWpWanJyWGFJRkE9PSIsInZhbHVlIjoiL3ZUYXdxZzMvV2YvQmU0OGtuN2hIQT09IiwibWFjIjoiZjAwMWNmYTQ2NWZmYTdjMGUxZWFmZDcyODE1ZDQxMWUyN2I2ODA3NDM3ZjM1MmQ1YmEwNmE2OWQ5MDUxNGMzZCJ9', '', '121212', '0', NULL, NULL, '2021-06-28 03:44:42', NULL),
(7, 'sa', 'as', 'as@gmail.com', 'eyJpdiI6ImZKNEZSUFBGTmlxSC9lVysxSDJDTlE9PSIsInZhbHVlIjoiOW9ZQ0RFSWlhMW8xNzg2Um9WQ205QT09IiwibWFjIjoiMDQxNzM5YmI0OWRmOGE3ODMyOTIyNzk3M2U5MTg2MjI4YzU5ZDgyMjIxMzgzOTczYWRiY2FjZmE0MDJlM2UzMCJ9', '', '1234', '0', NULL, NULL, NULL, NULL),
(8, '1', '1', '1@gmail.com', 'eyJpdiI6ImRHRHRFTmc1WnpOVHdJbkl5TFFGQlE9PSIsInZhbHVlIjoiSGhOa05oKytZMDFMSWlqT1NFWWh3dz09IiwibWFjIjoiZTZmMDk4MjBkZjZjYmM3NDQwYzdiNzNlOTA1ZjIwYzU5OTgyYmQzY2U3M2Q2MTk4NzBkMTgyNDlhZmMzODUxZiJ9', '', '1234', '0', NULL, NULL, NULL, NULL),
(9, '2', '2', '2@gmail.com', 'eyJpdiI6IkxpOFpaeHQ2a3dJZ25zOFBvTFNEY3c9PSIsInZhbHVlIjoiUUdwS2poSGt0c2Q4SXlCZ0k2alJjdz09IiwibWFjIjoiMDY2NmUyMDAwZTM4NjY4Y2M0NmE5N2FkYjM4NTVlZmUwNzRkMTllYTVmYWEyYmU0YThkNmIwMTcwNjcxOTYwOCJ9', '', '12345', '0', NULL, NULL, NULL, NULL),
(10, '2', '2', '21@gmail.com', 'eyJpdiI6ImtpakMxd0xOSjF1dFlrTElCZnovUFE9PSIsInZhbHVlIjoiWnlzamtDV2dWcTdOWjExSStydEF2Zz09IiwibWFjIjoiYzgwN2E4NDJkMDg3ODM0Y2VhZDUxMTNkZWQwMWQ1YmY3MGQ1MDdlYmQ0MWRjODk1ZTQ3ZDNmZjAyZTM3NmI1MSJ9', '', '12345', '0', NULL, NULL, NULL, NULL),
(11, 'saloni', 'aheshwari', 'saloniyy@gmail.com', 'eyJpdiI6IkNwOWREY2hqamZCVERDYjhIR0FFN3c9PSIsInZhbHVlIjoiK0JZVTRvd1M1NTdlWWtmUUxVdkpHQT09IiwibWFjIjoiZDhjZmE2NjgyNDQzODUxNzEyMjY0NTBjNTUxOTRlMTcyMzBiZTEzMzU0YWQ2ZWI0ZjQ0Y2Q1NWRiZDA2NzIzMCJ9', '', '1234', '0', NULL, NULL, NULL, NULL),
(12, 'siya', 'siya', 'rs@gmail.com', 'eyJpdiI6ImZTcnUxUHo0YU52M25tTy83ZzJzbnc9PSIsInZhbHVlIjoieEV3Q0RuT25JZTRNbDR1c3RYQ0ZFZz09IiwibWFjIjoiZmQwMWQ1ODU3ZGU3ZWE3MTZkZTZlNDBlNWYwMDViZDVkMTAxNDg1YzUyOTFmNDExYTYzNTI5NTg4NmU1Mzg0NiJ9', '', '12345', '0', NULL, NULL, NULL, NULL),
(13, 'siya', 'siya', 'rs45@gmail.com', 'eyJpdiI6ImFrZlQ2VGxhOVJZVVcrVmJtMmVLWlE9PSIsInZhbHVlIjoiTDlZMWxUaUo5WXZFOENQaW42NUNldz09IiwibWFjIjoiZDFkYzE2MjMyZDIwYWI4OThlOWQ2OWFjYWMzOTgzM2U2ZjBmOWY2YjdkMjUzZmQzOGVhOGViOTBiMTc0ZDI5OCJ9', '', '12345', '0', NULL, NULL, NULL, NULL),
(15, 'saloni', 'sa', 'sa@gmail.com', 'eyJpdiI6IkVlcndlZGpZMlZuR2E2MlZ4c0lZc0E9PSIsInZhbHVlIjoiYXNTTWoxVlkvR1pWdWhnd2dsZ2Zudz09IiwibWFjIjoiZjFlODMyNGU4NGRiY2IyNzQ2NGE3OWQ1NGJkZTJlMTQ1ZDY3N2M0N2EyNWUzNWQ2YmQ3MmRjNWY2YjNhN2Q4YSJ9', '', '123', '0', NULL, NULL, NULL, NULL),
(16, 'saloni', 'sa', 'sa1@gmail.com', 'eyJpdiI6Im1BTGRYT2IwakdaaS9HamNndWozUHc9PSIsInZhbHVlIjoiNjlrNHZlelZWZkt6MmUxNzRDNDl6QT09IiwibWFjIjoiNzE3MmExN2YwMTVmZmM1ZTkwMmFiMWVlMmIwN2FhYzk0ZTU0Njk0ZTM0NjEyZmQ3YmM1N2M4MjI4M2NlZjdhNCJ9', '', '123', '0', NULL, NULL, NULL, NULL),
(17, 'saloni', 'sa', 'sa11@gmail.com', 'eyJpdiI6Inh3ZFNnRld3K1Bxa2xJQm1EK3Q3NGc9PSIsInZhbHVlIjoiUDJWUmNsOFo0MUF2akdMUktrZ2t4dz09IiwibWFjIjoiMWQyMzI1MDMyMjgxZWY0NDg2MDAzMTE4MDc4ZTI4MDY5NmRjYTkwNzc4NjM5ZDFmM2Y1ODBhZmJkMjY0YTkyNiJ9', '', '123', '0', NULL, NULL, NULL, NULL),
(18, 'saloni', 'sa', 'sa2@gmail.com', 'eyJpdiI6ImJLOWluRWcwa0dEdjluSUt1cTFDWEE9PSIsInZhbHVlIjoiUWI4OHZnbmNGN2EwZjN2Wnhwa3JXZz09IiwibWFjIjoiZDVlNzVmZWI1MTFmNTdmMDczMmVmMDBiYjcyNDhjMmNiYzM1MGI1YjhiMWRmOTlmYTJiYTY2Y2QwOGI0N2VlMSJ9', '', '123', '0', NULL, NULL, NULL, NULL),
(19, 'saloni', 'sa', 'sa22@gmail.com', 'eyJpdiI6IlYrNkZKS3pKM0pFeUVta0RNTnFCdUE9PSIsInZhbHVlIjoiNzA4S0k2T3U1Q0FVNWZRamRNUUl2QT09IiwibWFjIjoiMzM5YjA5YmI3Mjc2MWYxM2UwYzE4ZDlhZmUzNGMwYmY5YjZhYjM2ZmVmNDc5MzQxMzkzMzVhYTU3ODM5OWMwMiJ9', '', '123', '0', NULL, NULL, NULL, NULL),
(20, 'saloni', 'sa', 'sa4422@gmail.com', 'eyJpdiI6IlNESWZZWklhZHNMTjcvUENKUmpWWEE9PSIsInZhbHVlIjoibXhNN3ZqM1lEaUdTU0hTV1BLMG5Pdz09IiwibWFjIjoiMGE2MGVlNzdhMDA0MzYzN2Y0Nzk4OTYyODJiOGQ4ZTZkNjUwNDRlOTcyNDBkZjIwODgzNGJkM2FmZDE3ZTcxMiJ9', '', '123', '0', NULL, NULL, NULL, NULL),
(21, 'saloni', 'sa', 'sa44242@gmail.com', 'eyJpdiI6IkFvb2ZvTjd4OUFNVGtOVks4RFlNTXc9PSIsInZhbHVlIjoiZTVwM3psVHN1T0pmeFpRaFdvSWQvdz09IiwibWFjIjoiYTViZTBiZTFlMTEwNjljZmY1YmM4ZTdhYzg4M2JmOThlZjhiYjM4ODIxNWJkZDBlMzQyZTcxN2EyNDNlNTk5YiJ9', '', '123', '0', '2021-07-05 04:28:32', NULL, '2021-07-05 04:28:32', NULL),
(22, 'saloni', 'sa', 'sa442542@gmail.com', 'eyJpdiI6InVxYUI1RXZzQlNUME1mMkhKVDJEM2c9PSIsInZhbHVlIjoiS2Nldi9BaUErUTR5SDlUUUMvUi84dz09IiwibWFjIjoiY2I1ODU4ZjllZGQ2NTE1NDhmMDU0YjNiNGZkNTM3YzA1OGRlZjJkNzVlOWJiNTkzOTI0OGUyNDI0N2MzZTM0MCJ9', '', '123', 'pending', NULL, NULL, '2021-07-04 23:01:03', NULL),
(23, 'saloni', 'sa', 'sa4425412@gmail.com', 'eyJpdiI6IlpKclBGNmlxN2cvSWQrTlcwQjI4dXc9PSIsInZhbHVlIjoiZ1NWcVhGY3ZSZUV5U0x1T2dOOWxhZz09IiwibWFjIjoiOTdmMTQ3ZmNkZGU3OTJmOTkzZjNhODBjZWViNTgyN2IwZTBmZmYyODViN2YyMDQxMjc3ODRiYmI3MDZjYzkxOCJ9', '', '123', 'pending', NULL, NULL, '2021-07-04 23:03:14', NULL),
(24, 'saloni', 'sa', 'sa890@gmail.com', 'eyJpdiI6IkZMN09CQkZEVlZvdlc3dVJ0WVBPUGc9PSIsInZhbHVlIjoidzhNYjZoWmhpSnJDTUx4VlU1MXJRQT09IiwibWFjIjoiNjJhMTIzYWMzZjFmM2NlZjc1ZWRkMTM2M2VhN2NhZTIzM2FkMDI3NTE3MTFmZWU4ZDBjMDgyMWNhZDUxYzJhYSJ9', '', '123', 'new', NULL, NULL, NULL, NULL),
(25, 'saloni', 'sa', 'sa8960@gmail.com', 'eyJpdiI6IkowcWVVZjUwZm8vMTBCT0p4Z1RnNWc9PSIsInZhbHVlIjoiZXNQVlRubFBTWUExcFZIcEwybFJPUT09IiwibWFjIjoiNDNjODY0NGE5NDViMTk5Nzc1YTU2MzljNzE5NzcwNjcwZThlYzFmNWI2NzE3MDQ1YWUwNDg1NTkxMTQ3ODEzZCJ9', '', '123', 'new', NULL, NULL, NULL, NULL),
(26, 'saloni', 'sa', 'sa89660@gmail.com', 'eyJpdiI6IlFycFpEbC9ETXo3UGhIOGRjeDdrdlE9PSIsInZhbHVlIjoibzVwQ2kyMWZja0pwdXdSSnNZaGdmdz09IiwibWFjIjoiYmEyYWY3ZTBhNzFjN2M1NDVkYjAyZTBlOTcwYjI3MzhjMWIzYTY1MmZiZGE5YWYyNTIxZjIzOWI4NWNjZWIzNCJ9', '', '123', 'pending', NULL, NULL, '2021-07-04 23:15:03', NULL),
(27, 'saloni', 'sa', 'plantwondver0524@gmail.com', 'eyJpdiI6ImFuUE9GMDMySWgzOFRnSS95SU9kdHc9PSIsInZhbHVlIjoicFBNdGhBQzFKN3NsL1dXb3ZUWFNEUT09IiwibWFjIjoiYWM2NTg4OTI3YzRkMjE2MTJhZTc2YmNiNjBkMjA4MTdlNTJkNTcxZWFhYmMwZWQzNTJmNWFkNGMxMWE2NWJkNyJ9', '', '123', 'pending', NULL, NULL, '2021-07-04 23:15:51', NULL),
(28, 'fg', 'fr', 'plantwondecr0524@gmail.com', 'eyJpdiI6ImVMLzAzUDZaQ25mSUlNc2lzRkUrYnc9PSIsInZhbHVlIjoiRTVscTlld2tKeC9WSzRUSHVkTVZxdz09IiwibWFjIjoiMjlkOWM5OTNjY2IwYjZiM2M0MzhjZjdmOTUyYmNlMjNjNTFiMDljODUxMDFiMDEwYjEyOTcwM2E5MmNkODlhMiJ9', '', '12211', 'pending', NULL, NULL, '2021-07-05 20:16:26', NULL),
(29, 'fg', 'fr', 'plantwonder0524@gmail.comv', 'eyJpdiI6InA0eTEvWHFzYU15bll2WjU0akU0Ymc9PSIsInZhbHVlIjoidi9LbldHSzB1dnkwbDhtR2c1dnhQQT09IiwibWFjIjoiYTk5MzEwNjdmZmFjMGJkOTc2Yzk1MDFlNzU2ZjI1M2M2ZDBlYzc2M2I3OWY1MzcxOGVjY2YzOTliNDlkZDdiYSJ9', '', '12211', 'pending', NULL, NULL, '2021-07-05 20:19:07', NULL),
(30, 'fg', 'fr', 'plantwonderv052489@gmail.com', 'eyJpdiI6ImV0ZFJJQ2o4QlcvSVBTTytMWXQvbFE9PSIsInZhbHVlIjoiWGQ4U0lTZHRtMkpvRWRoWDZ3aHdpdz09IiwibWFjIjoiYzIzNzM3ODcwN2Q0YjA2ZmY4NjNiNDQ4YjFkMTdkYjVlNzQ5MGUzYjY3MTNjODBiZDJiY2NlYzMzMTZjM2YxNCJ9', '', '12211', '1', NULL, NULL, '2021-07-05 22:12:40', NULL),
(31, 'fg', 'fr', 'plantwonder0524@gmail.comvg', 'eyJpdiI6InNhQUpzbjQrQnVQcXRJaUxEbml6aFE9PSIsInZhbHVlIjoibmE1eWZNTXN6UlpENVRQNU1IUUVmUT09IiwibWFjIjoiMTQyZjc5MWQ4ZjhiZmYzOTJmNjU4YjEwOGQyMGQ1NTBjNDFhYjNjMDAyODFhNWI2YzZhODBmMDkwZDgyYTkzOCJ9', '', '12211', 'verifiedemail', '2021-07-06 01:59:37', NULL, '2021-07-06 01:59:37', NULL),
(32, 'fg', 'fr', 'plantwonder0524@gmail.comp', 'eyJpdiI6Ik15M3d1MVJBNjFlRjBBdUJSdUFTMWc9PSIsInZhbHVlIjoiM1R0eUNLQ0tiRFZ0bk9SWkphVXJjZz09IiwibWFjIjoiZDQwMGJkYzBkNzgwNjFkM2M5Yzk3ZGJhNzdkNTc2MjJkZDcyZWY2MzMzZDRiNjI1YjcwMWJkZTY3MWNlNWMzMCJ9', '', '12211', '0', '2021-07-06 18:30:00', NULL, '2021-07-05 22:12:53', NULL),
(34, 'saloni', 'sal', 'sal@gmail.com', 'eyJpdiI6IkpPS1NiVzFTTzFnR1dnazNkcFgrR1E9PSIsInZhbHVlIjoia2pXMTRiYnpFYVVYVmMzbERpVDh0UT09IiwibWFjIjoiZWI3Yjg2ZGYzMmRhNzg3YzdhMGMxY2MyOGY2NzAyNDdiMDk5MWZhNGFmNWE1OGI0YWJmZDQ2MWNjNGQ0ZjNmZiJ9', '', '12345', 'verifiedemail', '2021-07-06 03:45:47', NULL, '2021-07-06 03:45:47', NULL),
(35, 'saloni', 'rt', 'salonimaheshwari05@gmail.co', 'qw', '12345678', '12345', '1', '2021-07-06 03:56:44', NULL, '2021-07-05 22:27:58', NULL),
(36, '78', '56', '78@gmail.com', 'eyJpdiI6IlN2eHhqM0VWdHBqWGNHTjhsejYyV2c9PSIsInZhbHVlIjoiVVlXTy82U0FvYUNQaW5QcVUrVUUwZz09IiwibWFjIjoiNDVjODE1OTFhOGE5MGRlMDA3YTlkZmVlZjY4MDkzMzQwOTI4YTBkYjc5MDVjNjgwNmFhZTQ4ZmRjNjMwN2MxMCJ9', '12345678', '12345', 'pending', NULL, NULL, '2021-07-06 02:54:06', NULL),
(37, '78', '56', '78f@gmail.com', 'eyJpdiI6Ind5WCtZNTlSWXlSZ3g1QlFMZDFzQ0E9PSIsInZhbHVlIjoiZEZEU0pwc1Z3ekpvVzUrYjUrQ3NIZz09IiwibWFjIjoiMGJmMmRhZGYwY2MyNDNjNDg1ZTE2ODg0MjVlODM0NTg4MmJlMGE5ZjFiYjRiMzYzNGIzMTQxZTk5Y2QyYzViZSJ9', '12345678', '12345', 'pending', NULL, NULL, '2021-07-06 03:01:12', NULL),
(38, '78', '56', '78f7@gmail.com', 'eyJpdiI6IjBDTWFyMC8yZndDd2htdmYxVVlScWc9PSIsInZhbHVlIjoiSTRkeWdlM1Vna0RSb1JXRU15cmY3QT09IiwibWFjIjoiNzc5YWU4ZWY0YTE2MzM1ZDg5YjMzMDY2ZDMyOTMzZjY0MjE3ZWU2OTdlM2MzMGU1OWFjZWM3NDkzYzIzZThhMiJ9', '123456789', '12345', 'pending', NULL, NULL, '2021-07-06 03:03:37', NULL),
(39, '100', '100', '100@gmail.com', 'eyJpdiI6ImRjais3czRKUW14Z1BLOUJwNHhDTkE9PSIsInZhbHVlIjoiczQrSEZDTmQza29qSk5KcVFQWkg4Zz09IiwibWFjIjoiY2FjYmQzMGJmOGY2NmEzMzAyN2IwMTdkOTlkNjcyNjJhZTc0ZWNmNTllNmIxOTVkOGM4ODYxYzllN2Q0MzFkNyJ9', '123456789', '123456789', 'pending', NULL, NULL, '2021-07-06 03:29:43', NULL),
(40, 'saloni', 'maheshwari', 'salonimaheshwari057@gmail.com', 'eyJpdiI6Ikxma3BQSEtZWmREcVZqRnVGMFlRcnc9PSIsInZhbHVlIjoibXNPQnpldHFzcXJtWWhKSGpFN1RrZz09IiwibWFjIjoiZmM2OTZlYjg1ZTlkMTU2ZGU2ZWQzZDZiODZkZTE2OWE1MDc4NWYzZjI0ZDI4Mjk5OTY0YWYwMDVhMmQ4NzUyOCJ9', '1234567890', '1234567', '1', NULL, NULL, '2021-07-06 03:42:19', NULL),
(41, 'saloni', 'maheshwari', 'salonimaheshwari05@gmail.comd', 'eyJpdiI6IkVXK0h3cnkyejQ4QkE3UXp6YThoM3c9PSIsInZhbHVlIjoibm1OR1hCZ1p3UkdvRmhvNG5KaVpLdz09IiwibWFjIjoiMDg0M2MzYzViNzcxOWE5YjhlYzFhYmRmMTc4MWNjOWRhZGJhNGMyZDg3OWI1ZGUyZjRlMTlmMDhlZTA3MTkzNiJ9', '123456789', '12345', '1', '2021-07-05 21:18:49', NULL, '2021-07-06 03:49:22', NULL),
(42, 'saloni', 'sa', 'plantwonder0524@gmail.comf', 'eyJpdiI6IkhPdkoyUVZNTFJLaVZDMU5ReGdEZWc9PSIsInZhbHVlIjoiYjMyRy9lc2J2WGpuMjA4ODNtK0NBdz09IiwibWFjIjoiZjNjMjhlYjgzMTRlZGZiYTNkODkzOWQ2Nzk2YTM3NTA3MjcyYmM2NWEyNGRkMDNlMmQ0ZTJkZWI1ODgxN2UxMyJ9', '123456789', '123', '1', '2021-07-05 21:30:00', NULL, '2021-07-06 04:01:00', NULL),
(43, 'a', 'a', 'a@gmail.com', 'eyJpdiI6IllJNmxGQjdHMHZxZ09kdzFyQUVTamc9PSIsInZhbHVlIjoiS0FUd0pFMjFOaERKM1pTL1lDS0dCdz09IiwibWFjIjoiMjc1OWYyYmQyMDhkYmZlZmZjYjkyNzY4MjUyMDA5YjMwZWVkODI4MWQwZmUzYWYzODAwNDhmYzk2MzdmMjk2YSJ9', 'salonisa', '12345', 'pending', NULL, NULL, '2021-07-06 04:18:16', NULL),
(44, 'saloni', 'sa', 'salonimaheshwari05@gmail.comgh', 'b6c4a628c1bd93b97fd32096340ffb361739128701b462bec62c986e66a2eacb', 'S@loni0512', '12345', '1', '2021-07-07 00:14:56', NULL, '2021-07-07 08:13:09', NULL),
(45, 'saloni', 's', 'salonimadheshwari05@gmail.com', 'b6c4a628c1bd93b97fd32096340ffb361739128701b462bec62c986e66a2eacb', 'S@loni0512', '1234', '1', '2021-07-07 01:49:31', NULL, '2021-07-07 08:23:08', NULL),
(46, 'saloni', 'sqw', 'plantwonder0524@gmail.comffg', 'b6c4a628c1bd93b97fd32096340ffb361739128701b462bec62c986e66a2eacb', 'S@loni0512', '123456789', '1', '2021-07-07 02:43:35', NULL, '2021-07-07 09:14:04', NULL),
(47, 'as', 'as', 'plantwonder0524@gmail.com', 'b6c4a628c1bd93b97fd32096340ffb361739128701b462bec62c986e66a2eacb', 'S@loni0512', '123455', '1', '2021-07-07 02:50:41', NULL, '2021-07-07 09:21:19', NULL),
(48, 'as', 'as', 'salonimaheshwari05@gmail.comfffju', 'b6c4a628c1bd93b97fd32096340ffb361739128701b462bec62c986e66a2eacb', 'S@loni0512', '123455', 'pending', NULL, NULL, '2021-07-07 09:22:23', NULL),
(49, 'as', 'as', 'salonimaheshwari05@gmail.comdd', 'b6c4a628c1bd93b97fd32096340ffb361739128701b462bec62c986e66a2eacb', 'S@loni0512', '123455', '1', NULL, NULL, '2021-07-07 09:23:01', NULL),
(50, 'as', 'as', 'as@gnail.com', 'a313f338c0c46771e9a3f0a7aa76ae5128857c58b72e0cb90fe3fede3cc1c3da', 'S@loni05', '123456', 'pending', NULL, NULL, '2021-07-07 09:26:25', NULL),
(51, 'as', 'as', 'as@gbil.com', 'b6c4a628c1bd93b97fd32096340ffb361739128701b462bec62c986e66a2eacb', 'S@loni0512', '123456', 'pending', NULL, NULL, '2021-07-07 09:26:58', NULL),
(52, 'saloni', '12', 'as123@gmail.com', 'b6c4a628c1bd93b97fd32096340ffb361739128701b462bec62c986e66a2eacb', 'S@loni0512', '12', 'pending', NULL, NULL, '2021-07-07 21:40:21', NULL),
(53, 'saloni', '12', 'as123t@gmail.com', 'b6c4a628c1bd93b97fd32096340ffb361739128701b462bec62c986e66a2eacb', 'S@loni0512', '12', 'pending', NULL, NULL, '2021-07-07 21:40:43', NULL),
(54, 'd', '12', 'd12345@gmail.com', '485a5ee66b428ccbdd4b85baf94afc58fd934925d1fc597dd72952d6f24c2001', 'S@loni12', '12345', 'pending', NULL, NULL, '2021-07-07 21:48:21', NULL),
(55, 'df', 'fd', 'sd@gmail.com', '4e6cb4ea15cfcc8f1c661ea8114547c43790f81e54ea1a7dabc90fd2da266756', '123456@Sa', '132323', 'pending', NULL, NULL, '2021-07-07 22:45:52', NULL),
(56, 'saloni', 's', 'salonimaheshwari05@gmail.cofmfgfgfg', 'eyJpdiI6Imtxd1IrVDlIMHVRNXYyWHhxakVQV3c9PSIsInZhbHVlIjoiUS9XcTdQRytKYlQxQkhLL3Erc3l0UT09IiwibWFjIjoiZWFmNjU2M2JhZmI1ODc5ZDY4ZWQ2NjRhMzI0NDNmM2VkMTU4M2E4NGVkNmMzNjhkOWNiYTgzZjM1MjUzOGE4YyJ9', 'S@loni0512', '121212', '1', '2021-07-12 05:36:03', NULL, '2021-07-12 00:06:21', NULL),
(57, 'saloni', 'maheshwari', 'salonimaheshwari05@gmail.comfgh', 'eyJpdiI6Ijl4V3pURXBHQTZ6c0Q1UStrWW5nbGc9PSIsInZhbHVlIjoiWnlmK0ZmWk0vZWdoWktCalZkNWw4VUtoQjFtOVM0NmlUR2x5RFBQcUdtTT0iLCJtYWMiOiJiM2JkZWVhZmUxOTU0MGI1YTgzM2I4Y2JiMmRmYzAzMjljNzgzZmRkZDg1NmNkZDQ0YWJjNjE5YTBjODE3NTZiIn0=', 'Salonimaheshwari05@gmail.com', '45', '1', NULL, NULL, '2021-07-12 00:13:20', NULL),
(59, 'saloni', 'parwal', 'salonimaheshwari05@gmail.com', 'b6c4a628c1bd93b97fd32096340ffb361739128701b462bec62c986e66a2eacb', 'S@loni0512', '1212', '1', '2021-07-12 06:25:25', NULL, '2021-07-12 00:55:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_form`
--

CREATE TABLE `dynamic_form` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entity_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dynamic_form`
--

INSERT INTO `dynamic_form` (`id`, `entity_name`, `slug`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(4, 'cc', 'cc', '1', 1, '2021-07-10 05:25:06', '2021-07-10 05:25:06'),
(6, 'Contact-Us', 'contact-us', '1', 1, '2021-07-10 05:26:03', '2021-07-12 06:08:04'),
(17, 'feedback', 'feedback', '5', 1, '2021-07-12 20:47:30', '2021-07-13 05:35:05'),
(18, 'fileupload', 'fileupload', '1', 1, '2021-07-13 05:34:11', '2021-07-18 05:07:51'),
(20, 'complaint', 'complaint', '10', 1, '2021-07-14 05:28:24', '2021-07-14 05:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_form_field`
--

CREATE TABLE `dynamic_form_field` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entity_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_type` int(11) DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `backend_validation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placeholder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `style` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isrequired` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dynamic_form_field`
--

INSERT INTO `dynamic_form_field` (`id`, `entity_type_id`, `name`, `input_type`, `description_type`, `file_type`, `backend_validation`, `sort_order`, `label`, `placeholder`, `validation`, `style`, `isrequired`, `status`, `created_at`, `updated_at`) VALUES
(6, 6, 'labels', 'text', NULL, '', '', '17', 'name', 'name', 'minlength=2,maxlength=10', 'background-color:red,font-size:40px', '1', 1, '2021-07-10 12:25:43', '2021-07-14 21:15:16'),
(7, 6, 'description', 'checkbox', NULL, '', '', '3', 'option', 'description', '1', '1', '0', 1, '2021-07-10 12:26:03', '2021-07-14 21:11:53'),
(8, 6, '1212ytytyty', 'date', NULL, '', '', '10', 'date', '12', '1', '1', '0', 1, NULL, '2021-07-14 21:15:10'),
(9, 6, 'qw', 'textarea', NULL, '', '', '1', 'description', '12', '1ddggfg', '1', '1', 1, NULL, NULL),
(10, 6, 'contactno', 'text', NULL, '', '', '12', 'contact', 'contact', 'maxlength=2', NULL, '1', 1, '2021-07-12 06:06:58', '2021-07-12 23:53:49'),
(11, 6, 'xdd', 'radio', NULL, '', '', '11', 'd', 'd', '1', '1', '0', 1, '2021-07-12 06:24:16', '2021-07-12 06:24:16'),
(12, 4, 'as', 'textarea', NULL, '', '', '1', 'df', 'df', 'sd', 'sd', '1', 1, '2021-07-12 23:18:36', '2021-07-15 05:44:51'),
(13, 17, 'description', 'textarea', 1, '', '', '1', 'vb', 'dd', '1', '1', '1', 1, '2021-07-12 23:21:47', '2021-07-18 04:55:36'),
(15, 17, 'name', 'text', 0, NULL, NULL, '100', 'name', 'name', 'minlength=3;maxlength=10', NULL, '1', 1, '2021-07-13 00:55:27', '2021-07-18 04:13:37'),
(19, 20, 'fullname', 'text', 0, '', '', '1', 'name', 'name', 'minlength=2,maxlength=5', 'background-color:gray', '1', 1, '2021-07-14 05:34:21', '2021-07-15 23:05:10'),
(20, 20, 'description', 'textarea', 0, '', '', '2', 'description', 'description', NULL, NULL, '1', 1, '2021-07-14 05:51:03', '2021-07-15 09:08:26'),
(21, 20, 'ac', 'select', 0, '', '', '3', 'a', 'a', NULL, NULL, '1', 1, '2021-07-14 05:51:49', '2021-07-14 05:51:49'),
(22, 20, 'dob', 'date', 0, '', '', '4', 'dob', 'dob', NULL, NULL, '1', 1, '2021-07-14 05:53:19', '2021-07-14 05:53:19'),
(23, 20, 'hobby', 'checkbox', 0, '', '', '5', '11', '11', NULL, NULL, '1', 1, '2021-07-14 05:53:51', '2021-07-14 05:53:51'),
(24, 20, 'ee', 'radio', NULL, '', '', '6', 'ee', 'ee', NULL, NULL, '1', 1, '2021-07-14 05:54:23', '2021-07-14 05:54:23'),
(25, 4, 'drr', 'text', NULL, '', '', '2', 'd', 'f', NULL, NULL, '1', 0, '2021-07-14 11:41:08', '2021-07-14 11:41:18'),
(26, 20, 'name', 'text', 0, '', '', '7', 'name', 'name', NULL, NULL, '1', 1, '2021-07-14 11:53:23', '2021-07-14 11:53:23'),
(27, 17, 'Address', 'textarea', 0, '', '', '4', 'r', 'r', NULL, NULL, '1', 1, '2021-07-14 21:18:03', '2021-07-18 04:13:42'),
(30, 4, '3dg', 'checkbox', NULL, '', '', '12', 's', 'd', NULL, NULL, '1', 1, '2021-07-15 00:16:28', '2021-07-15 00:16:28'),
(32, 20, 'dgg', 'text', NULL, '', '', '8', 'dfdf', 'dfdf', '11', NULL, '0', 1, '2021-07-15 06:12:44', '2021-07-15 06:12:44'),
(33, 20, 'develop', 'textarea', 1, '', '', '9', 'description_type', 'd', 'cols=10', NULL, '1', 1, '2021-07-15 06:26:35', '2021-07-15 20:46:26'),
(34, 20, 'multiselect', 'multiselect', NULL, '', '', '91', 'multiselect', 'multiselect', NULL, NULL, '1', 1, '2021-07-15 06:40:36', '2021-07-15 06:40:36'),
(35, 20, '11', 'textarea', 0, '', '', '92', 'desc', 'desc', NULL, NULL, '1', 1, '2021-07-15 06:45:27', '2021-07-15 06:45:27'),
(36, 20, 'contact', 'text', NULL, '', '', '93', '11', '11', '11', '11', '1', 1, '2021-07-15 07:58:49', '2021-07-15 07:58:49'),
(37, 20, 'labels', 'text', 0, '', '', '97', 'q1', 'labels', NULL, NULL, '1', 1, '2021-07-15 08:09:44', '2021-07-15 08:09:44'),
(38, 20, 'phone number', 'number', 0, '', '', '94', 'phone number', 'phone number', 'min=10', NULL, '1', 1, '2021-07-15 08:59:55', '2021-07-15 08:59:55'),
(39, 20, 'submit', 'button', 0, '', '', '99', 'button1', 'button1', NULL, NULL, '1', 1, '2021-07-15 09:04:02', '2021-07-15 09:04:02'),
(40, 20, 'password', 'password', 0, '', '', '96', 'password', 'password', NULL, NULL, '1', 1, '2021-07-15 11:08:42', '2021-07-15 11:08:42'),
(41, 20, 'email', 'email', 0, '', '', '98', 'email', 'email@gmail.com', NULL, NULL, '1', 1, '2021-07-15 11:09:15', '2021-07-15 11:09:15'),
(42, 17, 'sumbit', 'button', NULL, '', '', '5', 'sumbit', 'submit', NULL, NULL, '1', 1, '2021-07-16 05:25:16', '2021-07-16 05:25:16'),
(43, 17, 'email', 'email', NULL, '', '', '3', 'email', 'email', NULL, NULL, '1', 1, '2021-07-16 05:33:33', '2021-07-16 22:20:23'),
(44, 17, 'password', 'password', NULL, '', '', '3', 'password', 'password', NULL, NULL, '1', 1, '2021-07-16 05:34:55', '2021-07-16 22:20:29'),
(45, 17, 'number', 'number', 0, NULL, NULL, '3', 'number', 'number', 'min=2;step=4', NULL, '1', 1, '2021-07-16 05:36:06', '2021-07-16 22:20:34'),
(46, 17, 'dob', 'date', NULL, '', '', '4', 'dob', 'dob', NULL, NULL, '1', 1, '2021-07-16 05:37:10', '2021-07-16 22:20:53'),
(47, 17, 'gender', 'radio', 0, '', '', '3', 'gender', 'gender', NULL, NULL, '1', 1, '2021-07-16 05:38:43', '2021-07-16 22:20:58'),
(48, 17, 'select', 'select', NULL, '', '', '3', 'select', 'select', NULL, NULL, '1', 1, '2021-07-16 05:41:42', '2021-07-17 02:42:41'),
(49, 17, 'hobby', 'checkbox', NULL, '', '', '3', 'hobby', 'hobby', NULL, NULL, '1', 1, '2021-07-16 05:44:18', '2021-07-17 02:44:26'),
(50, 17, 'file', 'file', 0, NULL, 'mimes:txt,pdf', '2', 'file', 'file', 'multiple', NULL, '1', 1, '2021-07-16 06:44:21', '2021-07-18 09:02:07'),
(51, 17, 'multiselect', 'multiselect', NULL, '', '', '3', 'multiselect', 'multiselect', NULL, NULL, '1', 1, '2021-07-16 07:21:27', '2021-07-16 22:21:09'),
(53, 17, 'image', 'file', 0, 'image', 'mimes:jpeg,jpg,png', '1', 'image', 'image', 'multiple; accept=.jpg, .jpeg, .png', NULL, '1', 1, '2021-07-18 04:15:23', '2021-07-18 08:59:09'),
(54, 18, 'input', 'file', 0, NULL, 'required;mimes:jpeg,jpg,png', '1', 'image', 'image', 'multiple; accept=.jpg, .jpeg, .png', NULL, '1', 1, '2021-07-18 05:09:16', '2021-07-19 02:21:41'),
(55, 18, 'submit', 'button', NULL, NULL, NULL, '3', 'abc', 'abc', NULL, NULL, '1', 1, '2021-07-18 05:09:46', '2021-07-19 00:49:35'),
(57, 18, 'number', 'number', 0, NULL, NULL, '1', 'number', 'number', 'min=2;step=4;maxlength=10', 'background-color:gray', '1', 1, '2021-07-19 00:20:48', '2021-07-19 02:16:04'),
(58, 18, 'text', 'text', 0, NULL, NULL, '4', 'text', 'text', 'minlength=\"4\"', NULL, '1', 1, '2021-07-19 01:33:33', '2021-07-19 03:03:38'),
(59, 6, 'submit', 'button', NULL, NULL, NULL, '999', 'submit', 'submit', NULL, NULL, '1', 1, '2021-07-19 01:39:51', '2021-07-19 01:39:51'),
(60, 6, 'name1', 'text', NULL, NULL, NULL, '91', 'q', 'q', 'minlength=5;maxlength=10', NULL, '1', 1, '2021-07-19 01:42:20', '2021-07-19 01:42:20');

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_form_field_option`
--

CREATE TABLE `dynamic_form_field_option` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dynamic_form_field_option`
--

INSERT INTO `dynamic_form_field_option` (`id`, `attribute_id`, `name`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'a', 2, 1, NULL, '2021-07-13 04:09:41'),
(2, 7, 'b', 3, 1, NULL, '2021-07-13 04:09:42'),
(3, 7, 'e', 4, 1, '2021-07-12 05:23:57', '2021-07-13 04:09:42'),
(5, 7, 'c', 6, 1, '2021-07-13 04:09:42', '2021-07-13 04:09:42'),
(6, 11, 'l', 1, 1, '2021-07-13 04:12:42', '2021-07-13 04:12:42'),
(7, 21, 'b', 2, 1, '2021-07-14 05:52:13', '2021-07-15 09:16:33'),
(8, 23, 'b', 2, 1, '2021-07-14 05:55:52', '2021-07-15 09:30:09'),
(30, 24, 'd4', 1, 1, '2021-07-14 08:07:14', '2021-07-14 08:15:30'),
(31, 24, 'qf', 2, 1, '2021-07-14 08:07:14', '2021-07-14 08:15:30'),
(32, 24, 'tf', 3, 1, '2021-07-14 08:07:37', '2021-07-14 08:15:30'),
(33, 24, 'r', 4, 1, '2021-07-14 08:07:37', '2021-07-14 08:15:30'),
(34, 24, 'y', 5, 1, '2021-07-14 08:07:38', '2021-07-14 08:15:30'),
(48, 34, 'a', 1, 1, '2021-07-15 06:41:22', '2021-07-15 06:41:22'),
(49, 34, 'b', 3, 1, '2021-07-15 06:41:22', '2021-07-15 06:41:22'),
(50, 34, 'c', 2, 1, '2021-07-15 06:41:22', '2021-07-15 06:41:22'),
(51, 21, 'v', 1, 1, '2021-07-15 09:16:33', '2021-07-15 09:16:33'),
(52, 21, 'cd', 3, 1, '2021-07-15 09:16:33', '2021-07-15 09:16:33'),
(53, 23, 'a', 1, 1, '2021-07-15 09:30:09', '2021-07-15 09:30:09'),
(54, 23, 'c', 3, 1, '2021-07-15 09:30:09', '2021-07-15 09:30:09'),
(55, 47, 'male', 1, 1, '2021-07-16 05:39:06', '2021-07-16 05:39:06'),
(56, 47, 'female', 2, 1, '2021-07-16 05:39:07', '2021-07-16 05:39:07'),
(57, 48, 'a', 1, 1, '2021-07-16 05:42:22', '2021-07-16 05:42:22'),
(58, 48, 'b', 2, 1, '2021-07-16 05:42:22', '2021-07-16 05:42:22'),
(59, 48, 'c', 3, 1, '2021-07-16 05:42:22', '2021-07-16 05:42:22'),
(60, 48, 'd', 4, 1, '2021-07-16 05:42:22', '2021-07-16 05:42:22'),
(61, 48, 'e', 5, 1, '2021-07-16 05:42:23', '2021-07-16 05:42:23'),
(62, 49, 'a', 4, 1, '2021-07-16 05:44:40', '2021-07-16 05:44:40'),
(63, 49, 'b', 3, 1, '2021-07-16 05:44:40', '2021-07-16 05:44:40'),
(64, 49, 'c', 1, 1, '2021-07-16 05:44:40', '2021-07-16 05:44:40'),
(65, 51, 'a', 1, 1, '2021-07-16 07:22:12', '2021-07-16 07:22:12'),
(66, 51, 'b', 2, 1, '2021-07-16 07:22:12', '2021-07-16 07:22:12'),
(67, 51, 'c', 3, 1, '2021-07-16 07:22:12', '2021-07-16 07:22:12'),
(68, 51, 'd', 4, 1, '2021-07-16 07:22:12', '2021-07-16 07:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_form_field_values`
--

CREATE TABLE `dynamic_form_field_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `form_id` bigint(20) UNSIGNED NOT NULL,
  `form_field_id` bigint(20) UNSIGNED NOT NULL,
  `input_values` varchar(255) DEFAULT NULL,
  `option_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dynamic_form_field_values`
--

INSERT INTO `dynamic_form_field_values` (`id`, `customer_id`, `form_id`, `form_field_id`, `input_values`, `option_id`, `created_at`) VALUES
(5, 1, 17, 13, '<p>sa&nbsp; &nbsp;</p>', NULL, NULL),
(6, 1, 17, 53, 'error2.png', NULL, NULL),
(7, 1, 17, 15, 'saloni', NULL, NULL),
(8, 1, 17, 50, 'on duty.pdf', NULL, NULL),
(9, 1, 17, 43, 'sa@a', NULL, NULL),
(10, 1, 17, 44, '12345', NULL, NULL),
(11, 1, 17, 45, '12345', NULL, NULL),
(12, 1, 17, 47, NULL, '55', NULL),
(13, 1, 17, 48, NULL, '57', NULL),
(14, 1, 17, 49, NULL, '64,63', NULL),
(15, 1, 17, 51, NULL, '65,68', NULL),
(16, 1, 17, 27, 'as', NULL, NULL),
(17, 1, 17, 46, '2021-07-05', NULL, NULL),
(18, 1, 17, 42, 'sumbit', NULL, NULL),
(19, 1, 18, 54, 'error1.png', NULL, NULL),
(20, 1, 18, 55, 'submit', NULL, NULL),
(21, 1, 18, 54, 'ccc (2).sql', NULL, NULL),
(22, 1, 18, 55, 'submit', NULL, NULL),
(23, 1, 18, 54, 'productcsv2.csv', NULL, NULL),
(24, 1, 18, 55, 'submit', NULL, NULL),
(25, 1, 18, 54, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL),
(26, 1, 18, 55, 'submit', NULL, NULL),
(27, 1, 17, 13, '<p>saloni&nbsp;</p>', NULL, NULL),
(28, 1, 17, 13, '<p>saloni</p>', NULL, NULL),
(29, 1, 17, 13, '<p>saloni</p>', NULL, NULL),
(30, 1, 17, 13, '<p>saloni</p>', NULL, NULL),
(31, 1, 17, 13, '<p>saloni</p>', NULL, NULL),
(32, 1, 17, 13, '<p>saloni&nbsp;&nbsp;&nbsp;&nbsp;</p>', NULL, NULL),
(33, 1, 17, 15, 'saloni', NULL, NULL),
(34, 1, 17, 43, 'saloni@12', NULL, NULL),
(35, 1, 17, 44, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL),
(36, 1, 17, 45, '123456', NULL, NULL),
(37, 1, 17, 47, NULL, '55', NULL),
(38, 1, 17, 48, NULL, '58', NULL),
(39, 1, 17, 49, NULL, '64,63', NULL),
(40, 1, 17, 51, NULL, '66,68', NULL),
(41, 1, 17, 27, 'as', NULL, NULL),
(42, 1, 17, 46, '2021-07-22', NULL, NULL),
(43, 1, 17, 42, 'sumbit', NULL, NULL),
(44, 1, 18, 54, '5thMSC_SEM9_NOTIFICATION_16_04_2021.pdf', NULL, NULL),
(45, 1, 18, 55, 'submit', NULL, NULL),
(46, 1, 17, 13, '<p>saloni</p>', NULL, NULL),
(47, 1, 17, 15, 'saloni', NULL, NULL),
(48, 1, 17, 50, '5thMSC_SEM9_NOTIFICATION_16_04_2021.pdf', NULL, NULL),
(49, 1, 17, 43, 'saloni@12', NULL, NULL),
(50, 1, 17, 44, '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', NULL, NULL),
(51, 1, 17, 45, '12345', NULL, NULL),
(52, 1, 17, 47, NULL, '55', NULL),
(53, 1, 17, 48, NULL, '59', NULL),
(54, 1, 17, 49, NULL, '63,62', NULL),
(55, 1, 17, 51, NULL, '66,67', NULL),
(56, 1, 17, 27, 'ax', NULL, NULL),
(57, 1, 17, 46, '2021-07-15', NULL, NULL),
(58, 1, 17, 42, 'sumbit', NULL, NULL),
(59, 1, 17, 13, '<p>saloni</p>', NULL, NULL),
(60, 1, 17, 13, '<p>saloni</p>', NULL, NULL),
(61, 1, 17, 13, '<p>saloni</p>', NULL, NULL),
(62, 1, 17, 53, 'error1.png', NULL, NULL),
(63, 1, 17, 15, 'saloni', NULL, NULL),
(64, 1, 17, 43, 'saloni@12', NULL, NULL),
(65, 1, 17, 44, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL),
(66, 1, 17, 45, '123456', NULL, NULL),
(67, 1, 17, 47, NULL, '55', NULL),
(68, 1, 17, 48, NULL, '59', NULL),
(69, 1, 17, 49, NULL, '64,63', NULL),
(70, 1, 17, 51, NULL, '65,66,67', NULL),
(71, 1, 17, 27, 'asx', NULL, NULL),
(72, 1, 17, 46, '2021-07-14', NULL, NULL),
(73, 1, 17, 42, 'sumbit', NULL, NULL),
(74, 1, 17, 13, '<p>saloni</p>', NULL, NULL),
(75, 1, 17, 53, 'error2.png', NULL, NULL),
(76, 1, 17, 15, 'saloni', NULL, NULL),
(77, 1, 17, 50, '5thMSC_SEM9_NOTIFICATION_16_04_2021.pdf', NULL, NULL),
(78, 1, 17, 43, 'saloni@12', NULL, NULL),
(79, 1, 17, 44, 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', NULL, NULL),
(80, 1, 17, 45, '123456', NULL, NULL),
(81, 1, 17, 47, NULL, '55', NULL),
(82, 1, 17, 48, NULL, '58', NULL),
(83, 1, 17, 49, NULL, '64,63', NULL),
(84, 1, 17, 51, NULL, '66,67', NULL),
(85, 1, 17, 27, 'abc', NULL, NULL),
(86, 1, 17, 46, '2021-07-28', NULL, NULL),
(87, 1, 17, 42, 'sumbit', NULL, NULL),
(88, 1, 17, 13, '<p>saloi</p>', NULL, NULL),
(89, 1, 17, 53, '5thMSC_SEM9_NOTIFICATION_16_04_2021.pdf', NULL, NULL),
(90, 1, 17, 15, 'sa', NULL, NULL),
(91, 1, 17, 50, 'error1.png', NULL, NULL),
(92, 1, 17, 43, 'sa@12', NULL, NULL),
(93, 1, 17, 44, 'f4bf9f7fcbedaba0392f108c59d8f4a38b3838efb64877380171b54475c2ade8', NULL, NULL),
(94, 1, 17, 45, '123456', NULL, NULL),
(95, 1, 17, 47, NULL, '55', NULL),
(96, 1, 17, 48, NULL, '59', NULL),
(97, 1, 17, 49, NULL, '64,63', NULL),
(98, 1, 17, 51, NULL, '65,66', NULL),
(99, 1, 17, 27, 'as', NULL, NULL),
(100, 1, 17, 46, '2021-07-21', NULL, NULL),
(101, 1, 17, 42, 'sumbit', NULL, NULL),
(102, 1, 18, 54, 'error2.png', NULL, NULL),
(103, 1, 18, 55, 'submit', NULL, NULL),
(104, 1, 18, 54, '5thMSC_SEM9_NOTIFICATION_16_04_2021.pdf', NULL, NULL),
(105, 1, 18, 55, 'submit', NULL, NULL),
(106, 1, 17, 13, '<p>saaloni&nbsp;&nbsp;&nbsp;&nbsp;</p>', NULL, NULL),
(107, 1, 17, 53, 'error1.png', NULL, NULL),
(108, 1, 17, 15, 'saloni', NULL, NULL),
(123, 1, 18, 54, 'RCC-ERCC-Bidder-Registration-Process-RCC-ERCC.pdf', NULL, NULL),
(124, 1, 18, 55, 'submit', NULL, NULL),
(125, 1, 18, 54, '1624209046320.jpg', NULL, NULL),
(126, 1, 18, 55, 'submit', NULL, NULL),
(127, 1, 18, 54, 'biodata(vishal).pdf', NULL, NULL),
(128, 1, 18, 55, 'submit', NULL, NULL),
(129, 1, 18, 54, 'RCC-ERCC-Bidder-Registration-Process-RCC-ERCC.pdf', NULL, NULL),
(130, 1, 18, 55, 'submit', NULL, NULL),
(131, 1, 18, 54, '1624200488821.jpg', NULL, NULL),
(132, 1, 18, 55, 'submit', NULL, NULL),
(133, 1, 18, 54, 'anshul-biodata.pdf', NULL, NULL),
(134, 1, 18, 55, 'submit', NULL, NULL),
(135, 1, 18, 55, 'submit', NULL, NULL),
(136, 1, 18, 55, 'submit', NULL, NULL),
(137, 1, 18, 55, 'submit', NULL, NULL),
(138, 1, 18, 55, 'submit', NULL, NULL),
(139, 1, 18, 55, 'submit', NULL, NULL),
(140, 1, 18, 55, 'submit', NULL, NULL),
(141, 1, 18, 55, 'submit', NULL, NULL),
(142, 1, 18, 55, 'submit', NULL, NULL),
(143, 1, 18, 55, 'submit', NULL, NULL),
(144, 1, 18, 55, 'submit', NULL, NULL),
(145, 1, 18, 55, 'submit', NULL, NULL),
(146, 1, 18, 55, 'submit', NULL, NULL),
(147, 1, 18, 55, 'submit', NULL, NULL),
(148, 1, 18, 55, 'submit', NULL, NULL),
(149, 1, 18, 55, 'submit', NULL, NULL),
(150, 1, 18, 55, 'submit', NULL, NULL),
(151, 1, 18, 55, 'submit', NULL, NULL),
(152, 1, 18, 55, 'submit', NULL, NULL),
(153, 1, 18, 55, 'submit', NULL, NULL),
(154, 1, 18, 55, 'submit', NULL, NULL),
(155, 1, 18, 55, 'submit', NULL, NULL),
(156, 1, 18, 55, 'submit', NULL, NULL),
(157, 1, 18, 54, '1624200488821.jpg', NULL, NULL),
(158, 1, 18, 55, 'submit', NULL, NULL),
(159, 1, 18, 54, '1624200488821.jpg', NULL, NULL),
(160, 1, 18, 55, 'submit', NULL, NULL),
(161, 1, 18, 54, '1.png', NULL, NULL),
(162, 1, 18, 55, 'submit', NULL, NULL),
(163, 1, 17, 13, '<p>saloni</p>', NULL, NULL),
(164, 1, 17, 53, '1.png', NULL, NULL),
(165, 1, 17, 15, 'saloni', NULL, NULL),
(166, 1, 17, 13, '<p>saloni</p>', NULL, NULL),
(167, 1, 17, 53, '1.png', NULL, NULL),
(168, 1, 17, 15, 'saloni', NULL, NULL),
(169, 1, 17, 50, '1624206988989.pdf', NULL, NULL),
(170, 1, 17, 43, 'saloni@12', NULL, NULL),
(171, 1, 17, 44, '039d2b06545264bc6d5fd65a7cedbeca007bf6bbcb609520573664680eefcac5', NULL, NULL),
(172, 1, 17, 45, '122', NULL, NULL),
(173, 1, 17, 47, NULL, '56', NULL),
(174, 1, 17, 48, NULL, '58', NULL),
(175, 1, 17, 49, NULL, '64,63', NULL),
(176, 1, 17, 51, NULL, '65,68', NULL),
(177, 1, 17, 27, 'as', NULL, NULL),
(178, 1, 17, 46, '2021-07-28', NULL, NULL),
(179, 1, 17, 42, 'sumbit', NULL, NULL),
(180, 1, 18, 54, '2 inch Khurpa with Wooden Handle No. MMI-91.jpg', NULL, NULL),
(181, 1, 18, 54, '3 inch Khurpa with Wooden Handle No. MMI-90.jpg', NULL, NULL),
(182, 1, 18, 55, 'submit', NULL, NULL),
(183, 1, 18, 57, '1212', NULL, NULL),
(184, 1, 18, 55, 'submit', NULL, NULL),
(185, 1, 18, 57, '1212', NULL, NULL),
(186, 1, 18, 55, 'submit', NULL, NULL),
(187, 1, 18, 57, '122', NULL, NULL),
(188, 1, 18, 55, 'submit', NULL, NULL),
(189, 1, 18, 57, '12', NULL, NULL),
(190, 1, 18, 55, 'submit', NULL, NULL),
(191, 1, 18, 57, '1234', NULL, NULL),
(192, 1, 18, 55, 'submit', NULL, NULL),
(193, 1, 18, 57, '12', NULL, NULL),
(194, 1, 18, 55, 'submit', NULL, NULL),
(195, 1, 18, 57, '12', NULL, NULL),
(196, 1, 18, 55, 'submit', NULL, NULL),
(197, 1, 18, 55, 'submit', NULL, NULL),
(198, 1, 18, 55, 'submit', NULL, NULL),
(199, 1, 18, 55, 'submit', NULL, NULL),
(200, 1, 18, 55, 'submit', NULL, NULL),
(201, 1, 18, 55, 'submit', NULL, NULL),
(202, 1, 18, 57, '66', NULL, NULL),
(203, 1, 18, 55, 'submit', NULL, NULL);

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

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `media`, `label`, `small`, `thumb`, `base`, `gallery`, `product_id`, `created_at`, `updated_at`) VALUES
(1, '1 inch Khurpa Steel Handle with Grip No. MMI-87 1.jpg', 'productLabel', 1, 1, 1, 1, 4, NULL, NULL),
(3, 'error1.png', 'productLabel', 1, 1, 1, 1, 1, NULL, NULL),
(4, 'error3.png', 'productLabel', 0, 0, 0, 0, 4, NULL, NULL),
(9, '1 inch Khurpa Steel Handle with Grip No. MMI-87 1.jpg', 'productLabel', 1, 1, 1, 1, 87, NULL, NULL),
(10, 'Coco peat block.jpg', 'productLabel', 0, 0, 0, 0, 87, NULL, NULL),
(11, 'Coco Dung.jpg', 'productLabel', 0, 0, 0, 0, 87, NULL, NULL),
(12, 'Coco Dung.jpg', 'productLabel', 0, 0, 0, 0, 87, NULL, NULL),
(13, 'Green Gold.jpg', 'productLabel', 0, 0, 0, 0, 87, NULL, NULL),
(14, 'Plant O Boost 2.jpg', 'productLabel', 0, 0, 0, 0, 87, NULL, NULL),
(15, 'Nutri Boom.jpg', 'productLabel', 0, 0, 0, 0, 87, NULL, NULL),
(16, 'Perlite.jpg', 'productLabel', 0, 0, 0, 0, 87, NULL, NULL),
(18, 'Maxi grow.jpg', 'productLabel', 0, 0, 0, 0, 87, NULL, NULL),
(19, 'Maxi grow.jpg', 'productLabel', 0, 0, 0, 0, 87, NULL, NULL),
(20, 'Plant O Boost 2.jpg', 'productLabel', 0, 0, 0, 0, 87, NULL, NULL),
(24, 'Vermicompost.jpg', 'productLabel', 0, 0, 0, 0, 87, NULL, NULL),
(28, 'error2.png', 'productLabel', 0, 0, 0, 0, 87, NULL, NULL),
(29, 'Vermicompost.jpg', 'productLabel', 0, 0, 0, 0, 87, NULL, NULL),
(38, '1 inch Khurpa Steel Handle with Grip No. MMI-87 1.jpg', 'productLabel', 0, 0, 0, 0, 1, NULL, NULL),
(39, 'error3.png', 'productLabel', 0, 0, 0, 0, 83, NULL, NULL),
(40, '1 inch Khurpa Steel Handle with Grip No. MMI-87 1.jpg', 'productLabel', 0, 0, 0, 0, 83, NULL, NULL),
(41, 'Double Prong Hoe', 'productLabel', 0, 0, 0, 0, 83, NULL, NULL),
(42, 'img3.jpg', 'productLabel', 0, 0, 0, 0, 1, NULL, NULL),
(43, 'img2.jpg', 'productLabel', 0, 0, 0, 0, 1, NULL, NULL),
(44, '1 inch Khurpa Steel Handle with Grip No. MMI-87.jpg', 'productLabel', 0, 0, 0, 0, 1, NULL, NULL);

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
(35, '2021_06_11_161042_create_salesman_product_discount_null', 1),
(36, '2021_07_01_014719_add_sort_order_category', 2),
(37, '2021_07_01_015623_add_product_slug', 3),
(38, '2021_07_01_020707_add_product_slug', 4),
(39, '2021_07_03_113156_customer_add_fields', 5),
(40, '2021_07_07_075720_add_deleted_on_product', 6),
(41, '2021_07_08_105142_create_entity_types_table', 7),
(42, '2021_07_08_105641_create_attributes_table', 8),
(43, '2021_07_08_111702_create_attribute_options_table', 9),
(44, '2021_07_09_035901_create_entity_types_table', 10),
(45, '2021_07_09_042011_create_attributes_table', 11),
(46, '2021_07_09_053128_create_attribute_options_table', 12),
(47, '2021_07_12_023552_create_options_table', 13);

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
(1, 3, '298.00', 1, 1, '100.00', '30.00', 'Cancelled', '2021-06-20 23:46:03', '2021-06-28 06:05:15'),
(2, 3, '370.00', 2, 1, '100.00', '30.00', 'Pending', '2021-06-23 03:59:57', '2021-06-23 03:59:57'),
(3, 2, '280.00', 1, 1, '100.00', '20.00', 'InProcess', '2021-06-25 07:57:36', '2021-06-25 07:58:49'),
(4, 2, '568.00', 2, 1, '100.00', '50.00', 'Pending', '2021-06-28 05:46:23', '2021-06-28 05:46:23'),
(5, 2, '280.00', 2, 1, '100.00', '20.00', 'Pending', '2021-06-28 05:49:49', '2021-06-28 05:49:49'),
(6, 2, '190.00', 2, 1, '100.00', '10.00', 'Pending', '2021-06-28 05:51:13', '2021-06-28 05:51:13'),
(7, 2, '190.00', 2, 1, '100.00', '10.00', 'Pending', '2021-06-28 05:52:07', '2021-06-28 05:52:07');

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
(2, NULL, 1, 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'shipping', '2021-06-20 23:46:04', '2021-06-20 23:46:04'),
(3, 1, 2, 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'billing', '2021-06-23 03:59:58', '2021-06-23 03:59:58'),
(4, NULL, 2, 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'ahmedabad', 'shipping', '2021-06-23 03:59:58', '2021-06-23 03:59:58'),
(5, NULL, 3, 'a', 'a', 'a', 'a', 'a', 'a', 'billing', '2021-06-25 07:57:36', '2021-06-25 07:57:36'),
(6, NULL, 3, 'a', 'a', 'a', 'a', 'a', 'a', 'shipping', '2021-06-25 07:57:36', '2021-06-25 07:57:36'),
(7, 2, 4, '56', '1', '1', '1', '1', '1', 'billing', '2021-06-28 05:46:24', '2021-06-28 05:46:24'),
(8, 3, 4, '56', '1', '1', '1', '1', '1', 'shipping', '2021-06-28 05:46:24', '2021-06-28 05:46:24'),
(9, 2, 5, '56', '1', '1', '1', '1', '1', 'billing', '2021-06-28 05:49:49', '2021-06-28 05:49:49'),
(10, 3, 5, '56', '1', '1', '1', '1', '1', 'shipping', '2021-06-28 05:49:50', '2021-06-28 05:49:50'),
(11, 2, 6, '56', '1', '1', '1', '1', '1', 'billing', '2021-06-28 05:51:13', '2021-06-28 05:51:13'),
(12, 3, 6, '56', '1', '1', '1', '1', '1', 'shipping', '2021-06-28 05:51:14', '2021-06-28 05:51:14'),
(13, 2, 7, '56', '1', '1', '1', '1', '1', 'billing', '2021-06-28 05:52:07', '2021-06-28 05:52:07'),
(14, 3, 7, '56', '1', '1', '1', '1', '1', 'shipping', '2021-06-28 05:52:07', '2021-06-28 05:52:07');

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
(2, 1, 4, 1, '20.00', '20.00', '10.00', '2021-06-20 23:46:04', '2021-06-20 23:46:04'),
(3, 2, 1, 3, '100.00', '100.00', '10.00', '2021-06-23 03:59:57', '2021-06-23 03:59:57'),
(4, 3, 1, 2, '100.00', '100.00', '10.00', '2021-06-25 07:57:36', '2021-06-25 07:57:36'),
(5, 4, 1, 1, '100.00', '200.00', '10.00', '2021-06-28 05:46:23', '2021-06-28 05:46:23'),
(6, 4, 4, 4, '20.00', '80.00', '10.00', '2021-06-28 05:46:23', '2021-06-28 05:46:23'),
(7, 5, 1, 2, '100.00', '100.00', '10.00', '2021-06-28 05:49:49', '2021-06-28 05:49:49'),
(8, 6, 1, 1, '100.00', '100.00', '10.00', '2021-06-28 05:51:13', '2021-06-28 05:51:13'),
(9, 7, 1, 1, '100.00', '100.00', '10.00', '2021-06-28 05:52:07', '2021-06-28 05:52:07');

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
(1, 1, 'pending', 'Pending', '2021-06-20 23:46:24', '2021-06-20 23:46:24'),
(2, 3, 'process', 'InProcess', '2021-06-25 07:58:49', '2021-06-25 07:58:49'),
(3, 1, 'process', 'Confirm', '2021-06-28 06:05:03', '2021-06-28 06:05:03'),
(4, 1, 'f', 'Cancelled', '2021-06-28 06:05:15', '2021-06-28 06:05:15');

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
(1, 'Cash on Delivery', 'cod', 'cod', 0, NULL, '2021-06-28 05:07:55'),
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
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deletedOn` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `price`, `discount`, `quantity`, `description`, `status`, `category_id`, `slug`, `created_at`, `updated_at`, `deletedOn`) VALUES
(1, 'table09TY 67', 'tableTop', '100.00', 10, 10, '12', 1, 1, 'teatable-1-189-12', '2021-07-07 21:49:53', '2021-07-08 21:49:12', '2021-07-07 21:48:13'),
(4, 'teaTable', 'teaTable', '20.00', 10, 1, 'queensize', 3, 16, 'teatable-1', '2021-06-13 20:47:04', '2021-07-07 08:03:14', '2021-07-06 20:03:14'),
(6, 'Case', 'Bench', '20.00', 10, 1, 'queensize', 1, 2, 'case-3', '2021-06-13 20:47:04', '2021-07-08 04:19:36', '0000-00-00 00:00:00'),
(8, 'FileCase', 'FileCase', '20.00', 10, 1, 'queensize', 3, 2, 'filecase', '2021-06-13 20:47:04', '2021-07-07 12:55:49', '2021-07-07 00:55:49'),
(9, 'Fase', 'Case', '2000.00', 10, 1, 'queensize', 1, 2, 'case-9', '2021-06-13 20:47:04', '2021-07-10 05:41:11', '0000-00-00 00:00:00'),
(57, 'diningTable', 'diningTable', '5000.00', 10, 1, 'queensize', 1, 6, NULL, '2021-06-21 01:28:29', '2021-06-28 07:18:45', '0000-00-00 00:00:00'),
(58, 'rawTable', 'rawTable', '20.00', 10, 1, 'queensize', 1, 6, NULL, '2021-06-21 01:28:29', '2021-06-28 07:18:45', '0000-00-00 00:00:00'),
(59, 'BookCase', 'BookCase', '900.00', 10, 1, 'queensize', 1, 2, 'bookcase', '2021-06-21 01:28:29', '2021-06-30 19:55:43', '0000-00-00 00:00:00'),
(60, 'BookCase', 'Fase1', '2000.00', 10, 1, 'queensize', 1, 2, 'bookcase-60dd79d58d72b', '2021-06-21 01:28:29', '2021-06-30 20:16:21', '0000-00-00 00:00:00'),
(61, 'Case', 'NightStand', '2000.00', 10, 1, 'queensize', 1, 2, 'case-as-7', '2021-06-21 01:28:29', '2021-07-02 21:30:13', '0000-00-00 00:00:00'),
(83, 'Case', 'Fase', '2000.00', 10, 1, 'queensize', 0, 2, 'case', '2021-06-27 21:46:03', '2021-07-02 21:29:53', '0000-00-00 00:00:00'),
(84, 'Case', '1', '1.00', 1, 1, '<p>ghgh</p>', 0, 1, 'case-2', '2021-06-28 04:27:13', '2021-07-07 01:58:56', '0000-00-00 00:00:00'),
(87, '347-9SA#T', '16', '1.00', 1, 1, '<p>v</p>', 1, 2, '347-9sa-t', '2021-06-30 04:31:00', '2021-07-01 05:53:58', '0000-00-00 00:00:00'),
(89, '12@12A', 'yEE', '121.00', 12, 1, '<p>dg</p>', 1, 1, '12-12a', '2021-07-01 04:31:34', '2021-07-01 01:10:00', '0000-00-00 00:00:00'),
(90, '12@12A', '12', '12.00', 12, 12, '<p>fff</p>', 1, 3, '12-12a-2', '2021-07-01 05:47:12', '2021-06-30 23:25:06', '0000-00-00 00:00:00'),
(92, 'bookcase', 'bokk', '100.00', 10, 10, '<p>f</p>', 1, 3, 'bookcase-1', '2021-06-30 20:17:06', '2021-06-30 23:00:13', '0000-00-00 00:00:00'),
(93, 'bokk^3___08', 'BookCaseA', '12.00', 1, 1, '<p>v</p>', 1, 2, 'bokk-3-08', '2021-06-30 21:07:42', '2021-06-30 22:05:54', '0000-00-00 00:00:00'),
(94, 'df-56-67-n-67-n-77-4-7-r6', 'book1', '2.00', 2, 2, '<p>f</p>', 1, 2, 'df-56-67-n-67-n-77-4-7-r6-2', '2021-06-30 22:06:53', '2021-07-01 00:38:04', '0000-00-00 00:00:00'),
(95, 'Q{  o        op}0!w@e#t$$y%%u^^i   7 8 8&&o&&O**o(O)      ^_(9+0+-5=6\'r;8<0?0:m.;i{0\\e`U', 'ty', '1.00', 1, 1, '<p>d</p>', 1, 1, 'q-o-op-0-w-e-t-y-u-i-7-8-8-o-o-o-o-9-0-5-6-r-8-0-0-m-i-0-e-u-yu', '2021-06-30 22:18:58', '2021-07-02 21:30:45', '0000-00-00 00:00:00'),
(105, 'Q{ o op}0!w@e#t$$y%%u^^i 7 8 8&&o&&O**o(O) ^_(9+0+-5=6\'r;8<0?0:m.;i{0\\e`U', 'ty677', '4.00', 6, 12, '<p>c</p>', 1, 7, 'q-o-op-0-w-e-t-y-u-i-7-8-8-o-o-o-o-9-0-5-6-r-8-0-0-m-i-0-e-u-yu-105', '2021-07-06 21:50:38', '2021-07-07 09:50:38', '2021-07-06 21:50:29'),
(110, '5', '5', '1.00', 1, 1, '<p>f</p>', 1, 7, '5-1', '2021-07-02 03:24:49', '2021-07-02 03:25:35', '0000-00-00 00:00:00'),
(112, '10E0R ty @$^&%%%14', '198989', '1.00', 12, 12, '<p>d</p>', 1, 1, '10e0r-ty-14', '2021-07-02 05:37:45', NULL, '0000-00-00 00:00:00'),
(115, 'panelbed 4 @ T', 'panelbed', '10.00', 20, 10, '<p>x</p>', 3, 17, 'panelbed-4-t-1', '2021-07-01 19:49:32', '2021-07-07 08:16:43', '2021-07-06 20:16:43'),
(116, '22', '57', '4.00', 34, 12, '<p>c&nbsp;&nbsp;&nbsp;&nbsp;</p>', 1, 7, '2267', '2021-07-02 00:27:31', '2021-07-02 21:29:13', '0000-00-00 00:00:00'),
(117, '45SS asasas ~4`}i', '67', '565.00', 45, 4, '<p>c&nbsp;&nbsp;&nbsp;&nbsp;</p>', 3, 7, '45ss-asasas-4-i', '2021-07-03 06:50:17', '2021-07-07 08:13:45', '2021-07-06 20:13:45'),
(120, '12 f', '127uu1', '1.00', 1, 1, '<p>f</p>', 3, 1, '12-f1-120', '2021-07-06 20:13:11', '2021-07-07 08:13:46', '2021-07-06 20:13:46'),
(121, '12 f', '127uu14', '1.00', 1, 1, '<p>f</p>', 3, 17, 'table-1-121', '2021-07-06 20:13:32', '2021-07-07 08:13:47', '2021-07-06 20:13:47'),
(124, 'Raw Material 23 7', 'rawmaterial', '10.00', 10, 10, '<p>c</p>', 3, 7, 'raw-material-23-7-90', '2021-07-02 21:36:56', '2021-07-07 08:13:49', '2021-07-06 20:13:49');

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
(96, 1, 1, '101.00', '10.00', NULL, '2021-06-23 04:28:28'),
(97, 1, 4, '209.00', NULL, NULL, '2021-06-23 04:28:28'),
(98, 1, 5, '100.00', NULL, NULL, '2021-06-23 04:28:28'),
(99, 1, 6, '20.00', NULL, NULL, '2021-06-23 04:28:28'),
(100, 1, 8, '20.00', NULL, NULL, '2021-06-23 04:28:28'),
(101, 1, 9, '2000.00', NULL, NULL, '2021-06-23 04:28:28'),
(102, 1, 10, '2000.00', NULL, NULL, '2021-06-23 04:28:28'),
(103, 1, 57, '6000.00', NULL, NULL, '2021-06-23 04:28:28'),
(104, 1, 58, NULL, NULL, NULL, '2021-06-23 04:28:28'),
(105, 1, 59, NULL, NULL, NULL, '2021-06-23 04:28:28'),
(106, 1, 60, NULL, NULL, NULL, '2021-06-23 04:28:28'),
(107, 1, 61, NULL, NULL, NULL, '2021-06-23 04:28:28'),
(108, 1, 62, NULL, NULL, NULL, '2021-06-21 23:42:21'),
(109, 1, 63, NULL, NULL, NULL, '2021-06-21 23:42:21'),
(110, 1, 64, NULL, NULL, NULL, '2021-06-21 23:42:21'),
(111, 1, 65, NULL, NULL, NULL, '2021-06-21 23:42:21'),
(112, 1, 66, NULL, NULL, NULL, '2021-06-21 23:42:21'),
(113, 1, 70, NULL, NULL, NULL, '2021-06-21 23:42:21'),
(114, 1, 71, NULL, NULL, NULL, '2021-06-21 23:42:21'),
(115, 1, 72, NULL, NULL, NULL, '2021-06-21 23:42:21'),
(116, 1, 73, NULL, NULL, NULL, '2021-06-21 23:42:21'),
(117, 1, 74, NULL, NULL, NULL, '2021-06-21 23:42:21'),
(118, 1, 75, NULL, NULL, NULL, '2021-06-21 23:42:21'),
(119, 1, 76, NULL, NULL, NULL, '2021-06-21 23:42:21'),
(120, 14, 1, '100.00', NULL, NULL, '2021-06-23 03:25:28'),
(121, 14, 4, '200.00', NULL, NULL, '2021-06-23 03:25:28'),
(122, 14, 5, NULL, NULL, NULL, '2021-06-23 03:25:28'),
(123, 14, 6, NULL, NULL, NULL, '2021-06-23 03:25:28'),
(124, 14, 8, NULL, NULL, NULL, '2021-06-23 03:25:29'),
(125, 14, 9, NULL, NULL, NULL, '2021-06-23 03:25:29'),
(126, 14, 10, NULL, NULL, NULL, '2021-06-23 03:25:29'),
(127, 14, 57, NULL, NULL, NULL, '2021-06-23 03:25:29'),
(128, 14, 58, NULL, NULL, NULL, '2021-06-23 03:25:29'),
(129, 14, 59, NULL, NULL, NULL, '2021-06-23 03:25:29'),
(130, 14, 60, NULL, NULL, NULL, '2021-06-23 03:25:29'),
(131, 14, 61, NULL, NULL, NULL, '2021-06-23 03:25:29'),
(132, 14, 62, NULL, NULL, NULL, '2021-06-21 23:43:22'),
(133, 14, 63, NULL, NULL, NULL, '2021-06-21 23:43:22'),
(134, 14, 64, NULL, NULL, NULL, '2021-06-21 23:43:22'),
(135, 14, 65, NULL, NULL, NULL, '2021-06-21 23:43:22'),
(136, 14, 66, NULL, NULL, NULL, '2021-06-21 23:43:22'),
(137, 14, 70, NULL, NULL, NULL, '2021-06-21 23:43:22'),
(138, 14, 71, NULL, NULL, NULL, '2021-06-21 23:43:22'),
(139, 14, 72, NULL, NULL, NULL, '2021-06-21 23:43:22'),
(140, 14, 73, NULL, NULL, NULL, '2021-06-21 23:43:22'),
(141, 14, 74, NULL, NULL, NULL, '2021-06-21 23:43:23'),
(142, 14, 75, NULL, NULL, NULL, '2021-06-21 23:43:23'),
(143, 14, 76, NULL, NULL, NULL, '2021-06-21 23:43:23'),
(478, 80, 1, '100.00', '1.00', NULL, '2021-06-30 04:31:50'),
(479, 80, 4, '100.00', NULL, NULL, '2021-06-30 04:31:50'),
(480, 80, 5, '100.00', NULL, NULL, '2021-06-30 04:31:50'),
(481, 80, 6, '200.00', NULL, NULL, '2021-06-30 04:31:50'),
(482, 80, 8, '100.00', NULL, NULL, '2021-06-30 04:31:50'),
(483, 80, 9, NULL, NULL, NULL, '2021-06-30 04:31:50'),
(484, 80, 10, NULL, NULL, NULL, '2021-06-23 05:20:07'),
(485, 80, 57, NULL, NULL, NULL, '2021-06-30 04:31:50'),
(486, 80, 58, NULL, NULL, NULL, '2021-06-30 04:31:50'),
(487, 80, 59, NULL, NULL, NULL, '2021-06-30 04:31:50'),
(488, 80, 60, NULL, NULL, NULL, '2021-06-30 04:31:50'),
(489, 80, 61, NULL, NULL, NULL, '2021-06-30 04:31:50'),
(515, 80, 83, NULL, NULL, NULL, '2021-06-30 04:31:50'),
(516, 80, 84, NULL, NULL, NULL, '2021-06-30 04:31:50'),
(517, 80, 87, NULL, NULL, NULL, '2021-06-30 04:31:50');

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
(14, 'siya', '2021-06-14 08:10:24', '2021-06-14 08:10:24'),
(80, 'john', '2021-06-23 02:43:16', '2021-06-23 02:43:16');

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
(1, 'normal Delivery', 'normal', '100.00', '10', 1, NULL, '2021-06-28 05:20:40'),
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'saloni', 'saloni@gmail.com', NULL, 'saloni', NULL, NULL, NULL),
(2, 'admin', 'admin@gmail.com', NULL, 'saloni', NULL, NULL, NULL);

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
-- Indexes for table `dynamic_form`
--
ALTER TABLE `dynamic_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynamic_form_field`
--
ALTER TABLE `dynamic_form_field`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attributes_entity_type_id_foreign` (`entity_type_id`);

--
-- Indexes for table `dynamic_form_field_option`
--
ALTER TABLE `dynamic_form_field_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `dynamic_form_field_values`
--
ALTER TABLE `dynamic_form_field_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_id` (`form_id`),
  ADD KEY `form_field_id` (`form_field_id`),
  ADD KEY `customer_id` (`customer_id`);

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
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart_addresses`
--
ALTER TABLE `cart_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `dynamic_form`
--
ALTER TABLE `dynamic_form`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `dynamic_form_field`
--
ALTER TABLE `dynamic_form_field`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `dynamic_form_field_option`
--
ALTER TABLE `dynamic_form_field_option`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `dynamic_form_field_values`
--
ALTER TABLE `dynamic_form_field_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_addresses`
--
ALTER TABLE `order_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salesman_products`
--
ALTER TABLE `salesman_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=518;

--
-- AUTO_INCREMENT for table `salesmen`
--
ALTER TABLE `salesmen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `dynamic_form_field`
--
ALTER TABLE `dynamic_form_field`
  ADD CONSTRAINT `attributes_entity_type_id_foreign` FOREIGN KEY (`entity_type_id`) REFERENCES `dynamic_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dynamic_form_field_option`
--
ALTER TABLE `dynamic_form_field_option`
  ADD CONSTRAINT `options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `dynamic_form_field` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dynamic_form_field_values`
--
ALTER TABLE `dynamic_form_field_values`
  ADD CONSTRAINT `dynamic_form_field_values_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `dynamic_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dynamic_form_field_values_ibfk_2` FOREIGN KEY (`form_field_id`) REFERENCES `dynamic_form_field` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dynamic_form_field_values_ibfk_4` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
