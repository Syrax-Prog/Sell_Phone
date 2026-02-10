-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2026 at 10:00 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phonestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `brand_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`, `brand_img`) VALUES
(1, 'Apple', 'assets/images/brand-logo/25345.png'),
(2, 'Samsung', 'assets/images/brand-logo/samsung_logo_blue.png'),
(3, 'Xiaomi', 'assets/images/brand-logo/xiaomi-logo-logos-marcas-8.png'),
(4, 'Oppo', 'assets/images/brand-logo/OPPO_LOGO_2019.png'),
(5, 'Vivo', 'assets/images/brand-logo/Vivo_logo_2019.svg.png'),
(12, 'Realme', 'assets/images/brand-logo/1765180197_Realme.png'),
(13, 'Honor', 'assets/images/No_Image_Available.jpg'),
(14, 'Huawei', 'assets/images/No_Image_Available.jpg'),
(15, 'Nothing', 'assets/images/No_Image_Available.jpg'),
(16, 'Infinix', 'assets/images/No_Image_Available.jpg'),
(17, 'Tecno', 'assets/images/No_Image_Available.jpg'),
(18, 'Asus', 'assets/images/No_Image_Available.jpg'),
(19, 'Google', 'assets/images/brand-logo/1765762842_Google.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `cart_id`, `created_at`, `updated_at`) VALUES
(40, 129, '2025-11-19 12:43:01', '2025-11-19 12:43:01'),
(62, 130, '2025-12-10 17:41:50', '2025-12-10 17:41:50'),
(320, 131, '2025-12-17 14:17:01', '2025-12-17 14:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `phone_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `cart_id`, `phone_id`, `quantity`, `added_at`, `updated_at`) VALUES
(558, 131, 380, 1, '2026-01-19 07:43:54', '2026-01-19 15:43:54'),
(559, 129, 369, 1, '2026-01-19 09:18:26', '2026-01-19 17:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `nama_dz` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `status` varchar(50) DEFAULT 'Order Placed',
  `address_at_order` text NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cancelle_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `status`, `address_at_order`, `order_date`, `created_at`, `updated_at`, `cancelle_by`) VALUES
(75, 40, '6998.00', 'Cancelled', 'Mr Savvy Sdn Bhd (slebew)\r\nNo. 5, Jalan SS 21/23,\r\nDamansara Utama, 47400 Petaling Jaya,\r\nSelangor.', '2025-11-19 16:27:07', '2025-11-19 16:27:07', '2025-11-19 16:27:17', NULL),
(76, 40, '6495.00', 'Completed', '\r\nJabatan Pendidikan Negeri Kelantan\r\nBandar Baru Tunjong\r\nKota Bharu, 16010\r\nKELANTAN\r\n', '2025-12-01 16:33:07', '2025-11-19 16:33:07', '2025-12-01 12:16:50', NULL),
(77, 40, '3299.00', 'Completed', '\r\nJabatan Pendidikan Negeri Kelantan\r\nBandar Baru Tunjong\r\nKota Bharu, 16010\r\nKELANTAN\r\n', '2025-11-17 17:00:06', '2025-11-19 17:00:06', '2025-11-19 17:08:41', NULL),
(78, 40, '7798.00', 'Completed', '\r\nJabatan Pendidikan Negeri Kelantan\r\nBandar Baru Tunjong\r\nKota Bharu, 16010\r\nKELANTAN\r\n', '2025-12-03 17:00:23', '2025-11-19 17:00:23', '2025-12-03 09:48:31', NULL),
(79, 40, '17994.00', 'Cancelled', '\r\nJabatan Pendidikan Negeri Kelantan\r\nBandar Baru Tunjong\r\nKota Bharu, 16010\r\nKELANTAN\r\n', '2025-11-25 11:06:24', '2025-11-25 11:06:24', '2025-12-10 17:43:48', NULL),
(80, 40, '2999.00', 'Shipped', '\r\nJabatan Pendidikan Negeri Kelantan\r\nBandar Baru Tunjong\r\nKota Bharu, 16010\r\nKELANTAN\r\n', '2025-11-25 11:06:56', '2025-11-25 11:06:56', '2025-12-02 17:50:09', NULL),
(82, 40, '0.00', 'Cancelled', '12, Jalan Mawar 3/4\r\nTaman Sri Sentosa\r\n15050 Kota Bharu\r\nKelantan\r\nMalaysia', '2025-12-02 09:23:59', '2025-12-02 09:23:59', '2025-12-02 09:32:25', NULL),
(84, 40, '2999.00', 'Completed', '12, Jalan Mawar 3/4\r\nTaman Sri Sentosa\r\n15050 Kota Bharu\r\nKelantan\r\nMalaysia', '2025-12-02 09:32:18', '2025-12-02 09:32:18', '2026-01-02 11:48:52', NULL),
(85, 40, '2999.00', 'Order Placed', '12, Jalan Mawar 3/4\r\nTaman Sri Sentosa\r\n15050 Kota Bharu\r\nKelantan\r\nMalaysia', '2025-12-02 09:32:45', '2025-12-02 09:32:45', '2025-12-02 09:32:45', NULL),
(86, 40, '2999.00', 'Cancelled', '12, Jalan Mawar 3/4\r\nTaman Sri Sentosa\r\n15050 Kota Bharu\r\nKelantan\r\nMalaysia', '2025-12-02 09:33:34', '2025-12-02 09:33:34', '2025-12-02 12:50:59', NULL),
(87, 40, '17495.00', 'Cancelled', '\r\nJabatan Pendidikan Negeri Kelantan\r\nBandar Baru Tunjong\r\nKota Bharu, 16010\r\nKELANTAN\r\n', '2025-12-02 12:19:51', '2025-12-02 12:19:51', '2025-12-02 12:50:27', NULL),
(88, 40, '23493.00', 'Cancelled', '12, Jalan Mawar 3/4\r\nTaman Sri Sentosa\r\n15050 Kota Bharu\r\nKelantan\r\nMalaysia', '2025-12-02 12:48:08', '2025-12-02 12:48:08', '2025-12-02 12:50:05', NULL),
(89, 40, '5198.00', 'Shipped', '12, Jalan Mawar 3/4\r\nTaman Sri Sentosa\r\n15050 Kota Bharu\r\nKelantan\r\nMalaysia', '2025-12-02 12:52:55', '2025-12-02 12:52:55', '2025-12-02 17:49:42', NULL),
(90, 40, '74999.00', 'Completed', 'Hunter’s Hut No. 12,\r\nWestern Outcrop Path,\r\nAncient Forest,\r\nAstera Region', '2025-12-09 10:58:06', '2025-12-09 10:58:06', '2025-12-09 11:02:45', NULL),
(91, 40, '799.00', 'Completed', 'No. 9, Tingkat 2, Blok C,\r\nPangsapuri Seri Wawasan,\r\n97000 Bintulu, Sarawak.', '2025-12-09 14:44:54', '2025-12-09 14:44:54', '2025-12-10 17:43:34', NULL),
(92, 62, '6998.00', 'Completed', '123 Jalan Merpati, Taman Seri Indah, 43000 Kajang, Selangor, Malaysia', '2025-12-10 17:42:45', '2025-12-10 17:42:45', '2025-12-10 17:43:22', NULL),
(93, 40, '3299.00', 'Order Placed', 'No. 9, Tingkat 2, Blok C,\r\nPangsapuri Seri Wawasan,\r\n97000 Bintulu, Sarawak.', '2025-12-16 10:06:00', '2025-12-16 10:06:00', '2025-12-16 10:06:00', NULL),
(94, 40, '3499.00', 'Cancelled', 'No. 9, Tingkat 2, Blok C,\r\nPangsapuri Seri Wawasan,\r\n97000 Bintulu, Sarawak.', '2025-12-16 11:34:40', '2025-12-16 11:34:40', '2025-12-16 14:26:33', NULL),
(95, 40, '3299.00', 'Completed', 'No. 9, Tingkat 2, Blok C,\r\nPangsapuri Seri Wawasan,\r\n97000 Bintulu, Sarawak.', '2025-12-16 12:35:42', '2025-12-16 12:35:42', '2025-12-16 15:22:36', NULL),
(97, 40, '6598.00', 'Completed', 'No. 9, Tingkat 2, Blok C,\r\nPangsapuri Seri Wawasan,\r\n97000 Bintulu, Sarawak.', '2025-12-16 14:29:11', '2025-12-16 14:29:11', '2025-12-16 15:22:32', NULL),
(98, 40, '4796.00', 'Completed', 'Hunter’s Hut No. 12,\r\nWestern Outcrop Path,\r\nAncient Forest,\r\nAstera Region', '2025-12-17 09:33:26', '2025-12-17 09:33:26', '2026-01-02 11:33:04', NULL),
(99, 320, '11696.60', 'Completed', 'Anjay Mabar @ gmail dot com', '2025-12-17 15:08:27', '2025-12-17 15:08:27', '2025-12-22 17:22:10', NULL),
(100, 320, '5598.40', 'Completed', 'AWSDADWDAWDAWDDDAWDAWDAWDAW', '2025-12-17 15:50:11', '2025-12-17 15:50:11', '2025-12-22 17:33:51', NULL),
(101, 320, '13596.00', 'Order Placed', 'AWSDADWDAWDAWDDDAWDAWDAWDAW', '2026-01-13 11:12:52', '2026-01-13 11:12:52', '2026-01-13 11:12:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `phone_id` int(11) NOT NULL,
  `phone_name_at_order` varchar(100) NOT NULL,
  `price_at_order` decimal(10,2) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `storage_at_order` varchar(50) DEFAULT NULL,
  `ram_at_order` varchar(50) DEFAULT NULL,
  `battery_at_order` varchar(50) DEFAULT NULL,
  `os_at_order` varchar(50) DEFAULT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS (`price_at_order` * `quantity`) STORED,
  `is_cancelled` int(11) NOT NULL DEFAULT 0,
  `image_at_order` varchar(255) NOT NULL DEFAULT 'assets/images/No_Image_Available.jpg',
  `cancelled_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `phone_id`, `phone_name_at_order`, `price_at_order`, `quantity`, `storage_at_order`, `ram_at_order`, `battery_at_order`, `os_at_order`, `is_cancelled`, `image_at_order`, `cancelled_by`) VALUES
(124, 75, 370, 'Galaxy S21+', '3499.00', 2, '256', '8', '4800', 'Android', 1, 'assets/images/No_Image_Available.jpg', 'User'),
(125, 76, 371, 'Galaxy S22', '3299.00', 1, '128', '8', '3700', 'Android', 1, 'assets/images/No_Image_Available.jpg', 'User'),
(126, 76, 373, 'Galaxy A34', '1299.00', 5, '128', '6', '5000', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(127, 77, 371, 'Galaxy S22', '3299.00', 1, '128', '8', '3700', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(128, 78, 370, 'Galaxy S21+', '3499.00', 1, '256', '8', '4800', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(129, 78, 376, 'iPhone 13 Pro', '4299.00', 1, '256', '6', '3095', 'iOS', 0, 'assets/images/No_Image_Available.jpg', NULL),
(130, 79, 370, 'Galaxy S21+', '3499.00', 1, '256', '8', '4800', 'Android', 1, 'assets/images/No_Image_Available.jpg', 'User'),
(131, 79, 369, 'Galaxy S21', '2999.00', 6, '128', '8', '4000', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(132, 80, 369, 'Galaxy S21', '2999.00', 1, '128', '8', '4000', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(133, 82, 369, 'Galaxy S21', '0.00', 1, '128', '8', '4000', 'Android', 1, 'assets/images/No_Image_Available.jpg', 'User'),
(134, 84, 369, 'Galaxy S21', '2999.00', 1, '128', '8', '4000', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(135, 85, 369, 'Galaxy S21', '2999.00', 1, '128', '8', '4000', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(136, 86, 369, 'Galaxy S21', '2999.00', 1, '128', '8', '4000', 'Android', 1, 'assets/images/No_Image_Available.jpg', 'User'),
(137, 87, 369, 'Galaxy S21', '2999.00', 3, '128', '8', '4000', 'Android', 1, 'assets/images/No_Image_Available.jpg', 'User'),
(138, 87, 370, 'Galaxy S21+', '3499.00', 5, '256', '8', '4800', 'Android', 1, 'assets/images/No_Image_Available.jpg', 'User'),
(139, 88, 370, 'Galaxy S21+', '3499.00', 5, '256', '8', '4800', 'Android', 1, 'assets/images/No_Image_Available.jpg', 'User'),
(140, 88, 369, 'Galaxy S21', '2999.00', 2, '128', '8', '4000', 'Android', 1, 'assets/images/No_Image_Available.jpg', 'User'),
(141, 89, 374, 'iPhone 12', '2599.00', 2, '128', '4', '2815', 'iOS', 0, 'assets/images/No_Image_Available.jpg', NULL),
(142, 89, 370, 'Galaxy S21+', '3499.00', 5, '256', '8', '4800', 'Android', 1, 'assets/images/No_Image_Available.jpg', 'User'),
(143, 90, 538, 'Galaxy Nebula', '74999.00', 1, '512', '128', '15000', 'Android Quantum OS', 0, 'assets/images/No_Image_Available.jpg', NULL),
(144, 91, 384, 'OPPO A57', '799.00', 1, '128', '6', '5000', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(145, 92, 370, 'Galaxy S21+', '3499.00', 2, '256', '8', '4800', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(146, 93, 371, 'Galaxy S22', '3299.00', 1, '128', '8', '3700', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(147, 94, 373, 'Galaxy A34', '1299.00', 1, '128', '6', '5000', 'Android', 1, 'assets/images/No_Image_Available.jpg', 'User'),
(148, 94, 370, 'Galaxy S21+', '3499.00', 1, '256', '8', '4800', 'Android', 1, 'assets/images/No_Image_Available.jpg', 'User'),
(149, 95, 371, 'Galaxy S22', '3299.00', 1, '128', '8', '3700', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(152, 97, 373, 'Galaxy A34', '1299.00', 1, '128', '6', '5000', 'Android', 1, 'assets/images/No_Image_Available.jpg', 'User'),
(153, 97, 371, 'Galaxy S22', '3299.00', 2, '128', '8', '3700', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(154, 98, 382, 'Poco X4 Pro Max', '1199.00', 4, '256', '8', '5160', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(155, 99, 371, 'Galaxy S22', '3299.00', 1, '128', '8', '3700', 'Android', 1, 'assets/images/No_Image_Available.jpg', NULL),
(156, 99, 370, 'Galaxy S21+', '2799.20', 3, '256', '8', '4800', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(157, 100, 370, 'Galaxy S21+', '2799.20', 2, '256', '8', '4800', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(158, 101, 371, 'Galaxy S22', '3299.00', 2, '128', '8', '3700', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL),
(159, 101, 370, 'Galaxy S21+', '3499.00', 2, '256', '8', '4800', 'Android', 0, 'assets/images/No_Image_Available.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

CREATE TABLE `phone` (
  `phone_id` int(11) NOT NULL,
  `phone_name` varchar(100) NOT NULL,
  `normalized_name` varchar(255) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `storage` int(11) DEFAULT NULL,
  `ram` int(11) DEFAULT NULL,
  `battery` int(11) DEFAULT NULL,
  `os` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT 'assets/images/No_Image_Available.jpg',
  `is_active` int(11) DEFAULT 1,
  `stock` int(11) DEFAULT 0,
  `current_price` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `discount` decimal(10,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phone`
--

INSERT INTO `phone` (`phone_id`, `phone_name`, `normalized_name`, `brand`, `description`, `storage`, `ram`, `battery`, `os`, `image_url`, `is_active`, `stock`, `current_price`, `created_at`, `created_by`, `updated_at`, `updated_by`, `discount`) VALUES
(369, 'Galaxy S21', 'galaxys21', 'Samsung', 'Flagship Samsung smartphone', 128, 8, 4000, 'Android', 'assets/images/No_Image_Available.jpg', 0, 2, '2999.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(370, 'Galaxy S21+', 'galaxys21', 'Samsung', 'Larger S21 variant', 256, 8, 4800, 'Android', 'assets/images/No_Image_Available.jpg', 1, 793, '3499.00', '2025-10-19 09:54:04', '1', '2026-01-13 11:12:52', 'Hafiz Zainal', '0'),
(371, 'Galaxy S22', 'galaxys22', 'Samsung', 'Next-gen flagship', 128, 8, 3700, 'Android', 'assets/images/No_Image_Available.jpg', 1, 52, '3299.00', '2025-11-19 09:54:04', '1', '2026-01-13 11:12:52', 'Honor', '0'),
(372, 'Galaxy S23', 'galaxys23', 'Samsung', 'Flagship Snapdragon model', 256, 8, 3900, 'Android', 'assets/images/No_Image_Available.jpg', 0, 0, '3999.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', 'Honor', '0'),
(373, 'Galaxy A34', 'galaxya34', 'Samsung', 'Mid-range Samsung', 128, 6, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 75, '1299.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(374, 'iPhone 12', 'iphone12', 'Apple', 'Apple smartphone A14 Bionic', 128, 4, 2815, 'iOS', 'assets/images/No_Image_Available.jpg', 0, 0, '2599.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(375, 'iPhone 13', 'iphone13', 'Apple', 'Apple smartphone A15 Bionic', 128, 4, 3227, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 55, '2899.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(376, 'iPhone 13 Pro', 'iphone13pro', 'Apple', 'Pro series camera system', 256, 6, 3095, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 44, '4299.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(377, 'iPhone 14', 'iphone14', 'Apple', 'Latest Apple iPhone', 128, 6, 3279, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 65, '3499.00', '2025-11-19 09:54:04', '1', '2026-01-02 17:21:24', '1', '0'),
(378, 'iPhone 14 Pro', 'iphone14pro', 'Apple', 'Dynamic Island flagship', 256, 6, 3200, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 70, '4899.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(379, 'Redmi Note 10', 'redminote10', 'Xiaomi', 'Affordable Xiaomi smartphone', 128, 6, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 90, '799.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(380, 'Redmi Note 11', 'redminote11', 'Xiaomi', 'Popular mid-range device', 128, 6, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 100, '899.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(381, 'Redmi Note 12', 'redminote12', 'Xiaomi', 'Improved camera and battery', 256, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 85, '1099.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(382, 'Poco X4 Pro', 'pocox4pro', 'Xiaomi', 'Performance mid-range', 256, 8, 5160, 'Android', 'assets/images/No_Image_Available.jpg', 1, 66, '1199.00', '2025-11-19 09:54:04', '1', '2025-12-17 09:33:26', '1', '0'),
(383, 'Xiaomi 12T', 'xiaomi12t', 'Xiaomi', 'Flagship-level performance', 256, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 55, '2099.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(384, 'OPPO A57', 'oppoa57', 'OPPO', 'Affordable OPPO smartphone', 128, 6, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 119, '799.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(385, 'OPPO Reno7', 'opporeno7', 'OPPO', 'Stylish camera-focused phone', 256, 8, 4500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 75, '1799.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(386, 'OPPO Reno8', 'opporeno8', 'OPPO', 'Portrait camera tech', 256, 8, 4500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 65, '1899.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(387, 'OPPO A78', 'oppoa78', 'OPPO', 'Balanced mid-range', 128, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 95, '1099.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(388, 'OPPO Find X5', 'oppofindx5', 'OPPO', 'Premium flagship', 256, 12, 4800, 'Android', 'assets/images/No_Image_Available.jpg', 1, 30, '3999.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(389, 'Vivo Y21', 'vivoy21', 'Vivo', 'Entry-level Vivo phone', 64, 4, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 100, '699.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(390, 'Vivo Y33s', 'vivoy33s', 'Vivo', 'Budget-friendly camera phone', 128, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 85, '899.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(391, 'Vivo V21', 'vivov21', 'Vivo', 'Selfie-focused phone', 128, 8, 4000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 65, '1499.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(392, 'Vivo V25', 'vivov25', 'Vivo', 'Color-changing design', 256, 8, 4500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 55, '1699.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(393, 'Vivo X80', 'vivox80', 'Vivo', 'Flagship Zeiss optics', 256, 12, 4500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 40, '3999.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(394, 'Realme 8', 'realme8', 'Realme', 'Affordable AMOLED phone', 128, 6, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 110, '799.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(395, 'Realme 9', 'realme9', 'Realme', 'Upgraded Realme mid-range', 128, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 95, '999.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(396, 'Realme 10', 'realme10', 'Realme', 'Latest Realme series', 256, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 80, '1199.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(397, 'Realme GT Neo 3', 'realmegtneo3', 'Realme', 'Fast-charging beast', 256, 12, 4500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 50, '2099.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(398, 'Realme C55', 'realmec55', 'Realme', 'Budget device with Mini Capsule', 128, 6, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 140, '699.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(399, 'Honor X8', 'honorx8', 'Honor', 'Slim design mid-range', 128, 6, 4000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 90, '899.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(400, 'Honor X9', 'honorx9', 'Honor', 'Premium design', 128, 8, 4800, 'Android', 'assets/images/No_Image_Available.jpg', 1, 75, '1099.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(401, 'Honor 70', 'honor70', 'Honor', 'Flagship-level camera', 256, 8, 4800, 'Android', 'assets/images/No_Image_Available.jpg', 1, 60, '1999.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(402, 'Honor Magic4', 'honormagic4', 'Honor', 'Premium flagship', 256, 12, 4600, 'Android', 'assets/images/No_Image_Available.jpg', 1, 40, '2999.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(403, 'Honor Magic5', 'honormagic5', 'Honor', 'Next-gen flagship', 512, 12, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 35, '3499.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(404, 'Huawei Nova 8', 'huaweinova8', 'Huawei', 'Stylish mid-range phone', 128, 8, 3800, 'HarmonyOS', 'assets/images/No_Image_Available.jpg', 1, 80, '1299.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(405, 'Huawei Nova 9', 'huaweinova9', 'Huawei', 'RYYB camera system', 256, 8, 4300, 'HarmonyOS', 'assets/images/No_Image_Available.jpg', 1, 75, '1599.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(406, 'Huawei P50', 'huaweip50', 'Huawei', 'Premium camera flaghship', 256, 8, 4100, 'HarmonyOS', 'assets/images/No_Image_Available.jpg', 1, 40, '3299.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(407, 'Huawei P50 Pro', 'huaweip50pro', 'Huawei', 'Flagship photography monster', 512, 12, 4360, 'HarmonyOS', 'assets/images/No_Image_Available.jpg', 1, 30, '4299.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(408, 'Huawei Mate 40', 'huaweimate40', 'Huawei', 'Flagship Kirin chipset', 256, 8, 4200, 'HarmonyOS', 'assets/images/No_Image_Available.jpg', 1, 45, '2899.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(409, 'Nothing Phone 1', 'nothingphone1', 'Nothing', 'Glyph interface design', 256, 8, 4500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 50, '2199.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(410, 'Nothing Phone 2', 'nothingphone2', 'Nothing', 'Upgraded Glyph & Snapdragon', 256, 12, 4700, 'Android', 'assets/images/No_Image_Available.jpg', 1, 40, '2899.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(411, 'Infinix Note 30', 'infinixnote30', 'Infinix', 'Affordable fast-charging device', 128, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 100, '699.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(412, 'Tecno Spark 10', 'tecnospark10', 'Tecno', 'Budget phone for youth', 128, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 130, '599.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(413, 'Asus ROG Phone 6', 'asusrogphone6', 'Asus', 'Gaming flagship', 512, 16, 6000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 25, '4499.00', '2025-11-19 09:54:04', '1', '2025-12-16 15:00:50', '1', '0'),
(414, 'Galaxy A14', 'galaxya14', 'Samsung', 'Affordable Samsung A-series', 64, 4, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 120, '699.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(415, 'Galaxy A24', 'galaxya24', 'Samsung', 'Upgraded mid-range Samsung', 128, 6, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 110, '999.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(416, 'Galaxy A54', 'galaxya54', 'Samsung', 'Premium mid-range with strong camera', 256, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 85, '1699.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(417, 'Galaxy M14', 'galaxym14', 'Samsung', 'Large battery budget phone', 128, 6, 6000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 95, '799.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(418, 'Galaxy Z Flip 4', 'galaxyzflip4', 'Samsung', 'Foldable compact flagship', 256, 8, 3700, 'Android', 'assets/images/No_Image_Available.jpg', 1, 30, '3999.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(419, 'iPhone 11', 'iphone11', 'Apple', 'Classic Apple model A13 Bionic', 128, 4, 3110, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 60, '1999.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(420, 'iPhone 12 Pro', 'iphone12pro', 'Apple', 'Triple camera premium', 256, 6, 2815, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 50, '3799.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(421, 'iPhone 14 Plus', 'iphone14plus', 'Apple', 'Large display Apple device', 256, 6, 4323, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 70, '4199.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(422, 'iPhone SE 2022', 'iphonese2022', 'Apple', 'Compact Apple phone', 128, 4, 2018, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 75, '1899.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(423, 'iPhone 15', 'iphone15', 'Apple', 'Latest A16-powered iPhone', 256, 6, 3300, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 85, '4699.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(424, 'Redmi 10', 'redmi10', 'Xiaomi', 'Budget Xiaomi with huge battery', 128, 4, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 100, '599.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(425, 'Redmi 12', 'redmi12', 'Xiaomi', 'Latest budget Xiaomi model', 256, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 95, '799.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(426, 'Redmi Note 13 Pro', 'redminote13pro', 'Xiaomi', 'Pro camera system with AMOLED', 256, 8, 5100, 'Android', 'assets/images/No_Image_Available.jpg', 1, 85, '1299.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(427, 'Poco M6 Pro', 'pocom6pro', 'Xiaomi', 'Powerful budget gaming device', 256, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 70, '999.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(428, 'Xiaomi 13', 'xiaomi13', 'Xiaomi', 'Flagship Leica camera phone', 256, 12, 4600, 'Android', 'assets/images/No_Image_Available.jpg', 1, 55, '3399.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(429, 'OPPO A17', 'oppoa17', 'OPPO', 'Stylish entry-level OPPO', 64, 4, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 120, '599.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(430, 'OPPO A38', 'oppoa38', 'OPPO', 'Affordable OPPO smartphone', 128, 6, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 110, '699.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(431, 'OPPO Reno10', 'opporeno10', 'OPPO', 'Latest Reno series with portrait lens', 256, 8, 4600, 'Android', 'assets/images/No_Image_Available.jpg', 1, 65, '1799.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(432, 'OPPO A79', 'oppoa79', 'OPPO', 'Balanced mid-range OPPO', 128, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 90, '999.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(433, 'OPPO Find X6', 'oppofindx6', 'OPPO', 'Flagship Hasselblad camera', 512, 16, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 35, '3999.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(434, 'Vivo Y16', 'vivoy16', 'Vivo', 'Affordable Vivo smartphone', 64, 4, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 110, '599.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(435, 'Vivo Y22s', 'vivoy22s', 'Vivo', 'Budget Vivo with Snapdragon', 128, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 95, '799.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(436, 'Vivo V27', 'vivov27', 'Vivo', 'Color-shifting design phone', 256, 8, 4600, 'Android', 'assets/images/No_Image_Available.jpg', 1, 70, '1899.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(437, 'Vivo V29', 'vivov29', 'Vivo', 'Aura light portrait camera', 256, 8, 4600, 'Android', 'assets/images/No_Image_Available.jpg', 1, 1, '2099.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(438, 'Vivo X90', 'vivox90', 'Vivo', 'Flagship performance phone', 512, 12, 4810, 'Android', 'assets/images/No_Image_Available.jpg', 1, 40, '4099.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(439, 'Realme C30', 'realmec30', 'Realme', 'Super budget phone', 32, 3, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 140, '399.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(440, 'Realme Narzo 50', 'realmenarzo50', 'Realme', 'Performance budget series', 128, 6, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 100, '799.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(441, 'Realme 11 Pro', 'realme11pro', 'Realme', 'Premium leather design phone', 256, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 70, '1499.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(442, 'Realme GT 2', 'realmegt2', 'Realme', 'Sustainable design flagship killer', 256, 12, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 50, '2099.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(443, 'Realme 10 Pro+', 'realme10pro', 'Realme', 'Curved AMOLED mid-range', 256, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 80, '1399.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(444, 'Honor X6', 'honorx6', 'Honor', 'Affordable Honor handset', 64, 4, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 120, '499.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(445, 'Honor 9X', 'honor9x', 'Honor', 'Pop-up camera Honor phone', 128, 6, 4000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 100, '899.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(446, 'Honor 50', 'honor50', 'Honor', 'Premium mid-range Honor', 256, 8, 4300, 'Android', 'assets/images/No_Image_Available.jpg', 1, 75, '1499.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(447, 'Honor 90', 'honor90', 'Honor', 'High megapixel camera', 256, 12, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 65, '2099.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(448, 'Honor Magic6', 'honormagic6', 'Honor', 'Next-gen Magic flagship', 512, 16, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 35, '4499.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(449, 'Huawei Nova 10', 'huaweinova10', 'Huawei', 'Premium mid-range Huawei', 256, 8, 4500, 'HarmonyOS', 'assets/images/No_Image_Available.jpg', 1, 80, '1699.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(450, 'Huawei Nova 11', 'huaweinova11', 'Huawei', 'Latest Nova series', 256, 8, 4500, 'HarmonyOS', 'assets/images/No_Image_Available.jpg', 1, 70, '1899.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(451, 'Huawei P60', 'huaweip60', 'Huawei', 'Flagship photography phone', 256, 12, 4815, 'HarmonyOS', 'assets/images/No_Image_Available.jpg', 1, 45, '3599.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(452, 'Huawei Mate 50', 'huaweimate50', 'Huawei', 'Premium Mate series', 512, 12, 4700, 'HarmonyOS', 'assets/images/No_Image_Available.jpg', 1, 40, '4299.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(453, 'Huawei Mate X3', 'huaweimatex3', 'Huawei', 'Foldable Huawei flagship', 512, 12, 4800, 'HarmonyOS', 'assets/images/No_Image_Available.jpg', 1, 25, '7999.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(454, 'Nothing Phone 2a', 'nothingphone2a', 'Nothing', 'Affordable Glyph phone', 128, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 90, '1499.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(455, 'Infinix Hot 30', 'infinixhot30', 'Infinix', 'Budget gaming phone', 128, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 130, '599.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', '1', '0'),
(456, 'Infinix Zero 20', 'infinixzero20', 'Infinix', 'High megapixel selfie phone', 256, 8, 4500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 90, '999.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', 'Honor', '0'),
(457, 'Tecno Camon 20', 'tecnocamon20', 'Tecno', 'Camera-focused budget device', 256, 8, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 100, '899.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', 'Honor', '0'),
(458, 'Asus Zenfone 9', 'asuszenfone9', 'Asus', 'Compact flagship phone', 256, 16, 4300, 'Android', 'assets/images/No_Image_Available.jpg', 1, 35, '3499.00', '2025-11-19 09:55:10', '1', '2025-12-16 15:00:50', 'Honor', '0'),
(461, 'Toaru Kagaku No Railgun', 'toarukagakunorailgun', 'Samsung', 'vggvngvn', 456546, 456546, 456456, '4566456', 'assets/images/No_Image_Available.jpg', 1, 456456, '54565.00', '2025-11-25 17:41:45', 'Honor', '2025-12-16 15:00:50', 'Honor', '0'),
(462, 'Wuthering Waves', 'wutheringwaves', 'Oppo', '345345', 345345, 345, 345, '345', 'assets/images/No_Image_Available.jpg', 1, 345, '3453.00', '2025-12-02 16:55:20', 'Honor', '2025-12-16 15:00:50', 'Honor', '0'),
(463, 'Google Pixel 6', 'googlepixel6', 'Google', 'Google Pixel 6 with Tensor chip', 128, 8, 4600, 'Android 14', 'assets/images/No_Image_Available.jpg', 1, 20, '1999.00', '2025-12-04 12:22:50', 'admin', '2025-12-16 15:00:50', 'admin', '0'),
(464, 'Google Pixel 6 Pro', 'googlepixel6pro', 'Google', 'Pixel 6 Pro flagship model', 128, 12, 5000, 'Android 14', 'assets/images/No_Image_Available.jpg', 1, 15, '2699.00', '2025-12-04 12:22:50', 'admin', '2025-12-16 15:00:50', 'admin', '0'),
(465, 'Google Pixel 7', 'googlepixel7', 'Google', 'Pixel 7 with Tensor G2', 128, 8, 4355, 'Android 14', 'assets/images/No_Image_Available.jpg', 1, 25, '2299.00', '2025-12-04 12:22:50', 'admin', '2025-12-16 15:00:50', 'admin', '0'),
(466, 'Google Pixel 7 Pro', 'googlepixel7pro', 'Google', 'Pixel 7 Pro with triple camera system', 256, 12, 5000, 'Android 14', 'assets/images/No_Image_Available.jpg', 1, 18, '3299.00', '2025-12-04 12:22:50', 'admin', '2025-12-16 15:00:50', 'admin', '0'),
(467, 'Google Pixel 7a', 'googlepixel7a', 'Google', 'Pixel 7a affordable flagship', 128, 8, 4385, 'Android 13', 'assets/images/No_Image_Available.jpg', 1, 30, '1599.00', '2025-12-04 12:22:50', 'admin', '2025-12-16 15:00:50', 'admin', '0'),
(468, 'Google Pixel 8', 'googlepixel8', 'Google', 'Pixel 8 with Tensor G3 processor', 128, 8, 4575, 'Android 14', 'assets/images/No_Image_Available.jpg', 1, 22, '2799.00', '2025-12-04 12:22:50', 'admin', '2025-12-16 15:00:50', 'admin', '0'),
(469, 'Google Pixel 8 Pro', 'googlepixel8pro', 'Google', 'Pixel 8 Pro with advanced AI features', 256, 12, 5050, 'Android 14', 'assets/images/No_Image_Available.jpg', 1, 17, '3999.00', '2025-12-04 12:22:50', 'admin', '2025-12-16 15:00:50', 'admin', '0'),
(470, 'Google Pixel Fold', 'googlepixelfold', 'Google', 'Google’s foldable phone with large display', 256, 12, 4821, 'Android 14', 'assets/images/No_Image_Available.jpg', 0, 10, '6299.00', '2025-12-04 12:22:50', 'admin', '2025-12-16 15:00:50', 'Honor', '0'),
(471, 'Google Pixel 5', 'googlepixel5', 'Google', 'Pixel 5 with Snapdragon processor', 128, 8, 4080, 'Android 13', 'assets/images/No_Image_Available.jpg', 1, 12, '1299.00', '2025-12-04 12:22:50', 'admin', '2025-12-16 15:00:50', 'Honor', '0'),
(472, 'Google Pixel 4a', 'googlepixel4a', 'Google', 'Budget-friendly Pixel 4a', 128, 6, 3140, 'Android 12', 'assets/images/No_Image_Available.jpg', 1, 14, '899.00', '2025-12-04 12:22:50', 'admin', '2025-12-16 15:00:50', 'Honor', '0'),
(485, 'Toaru 21+', 'toaru21+', 'Apple', 'q123', 128, 4, 50000, 'Toaru Smart OS', 'assets/images/No_Image_Available.jpg', 1, 12, '12999.00', '2025-12-05 11:12:05', 'Honor', '2025-12-16 15:00:50', 'Honor', '0'),
(486, 'Toaru 22 Ultra', 'toaru22ultra', 'Apple', 'sefesfsqdhrg', 128, 16, 5000, 'Android 17 SE', 'assets/images/No_Image_Available.jpg', 1, 12, '12999.00', '2025-12-05 11:13:52', 'Honor', '2025-12-16 15:00:50', 'Honor', '0'),
(487, 'Toaru 24 Pro', 'toaru24pro', 'Samsung', 'sfsfsgf', 128, 12, 5000, 'Android 17 SE', 'assets/images/No_Image_Available.jpg', 0, 13, '5999.00', '2025-12-05 11:15:58', 'Honor', '2025-12-16 15:00:50', 'Honor', '0'),
(490, 'Mi 11', 'mi-11', 'Xiaomi', 'High-performance Xiaomi phone', 256, 8, 4600, 'Android', 'assets/images/No_Image_Available.jpg', 1, 40, '1999.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(491, 'Pixel 6', 'pixel-6', 'Google', 'Google Pixel flagship', 128, 8, 4614, 'Android', 'assets/images/No_Image_Available.jpg', 1, 25, '2799.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(492, 'OnePlus 9', 'oneplus-9', 'OnePlus', 'Fast charging flagship phone', 128, 12, 4500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 35, '2399.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(493, 'Galaxy A52', 'galaxy-a52', 'Samsung', 'Mid-range Samsung phone', 128, 6, 4500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 60, '1299.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(496, 'Pixel 5a', 'pixel-5a', 'Google', 'Affordable Google phone', 128, 6, 4680, 'Android', 'assets/images/No_Image_Available.jpg', 1, 20, '1799.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(497, 'OnePlus Nord 2', 'oneplus-nord-2', 'OnePlus', 'Mid-range OnePlus phone', 128, 8, 4500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 30, '1599.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(498, 'Galaxy S20', 'galaxy-s20', 'Samsung', 'Older flagship Samsung', 128, 8, 4000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 15, '1999.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(500, 'Mi 10T', 'mi-10t', 'Xiaomi', 'Mid-range Xiaomi phone', 128, 6, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 25, '1299.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(501, 'Pixel 4a', 'pixel-4a', 'Google', 'Budget Google phone', 128, 6, 3140, 'Android', 'assets/images/No_Image_Available.jpg', 1, 30, '1499.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(502, 'OnePlus 8T', 'oneplus-8t', 'OnePlus', 'Previous flagship', 128, 12, 4500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 20, '1899.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(503, 'Galaxy Note 20', 'galaxy-note-20', 'Samsung', 'Samsung Note series phone', 256, 8, 4300, 'Android', 'assets/images/No_Image_Available.jpg', 1, 10, '3499.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(504, 'iPhone SE', 'iphone-se', 'Apple', 'Compact iPhone', 64, 3, 1821, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 30, '1399.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(506, 'Pixel 4', 'pixel-4', 'Google', 'Older Pixel phone', 64, 6, 2800, 'Android', 'assets/images/No_Image_Available.jpg', 1, 15, '1299.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(507, 'OnePlus 7T', 'oneplus-7t', 'OnePlus', 'Previous generation OnePlus', 128, 8, 3800, 'Android', 'assets/images/No_Image_Available.jpg', 1, 10, '1399.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(508, 'Galaxy A71', 'galaxy-a71', 'Samsung', 'Mid-range Samsung', 128, 8, 4500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 40, '1499.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(509, 'iPhone XR', 'iphone-xr', 'Apple', 'Older Apple model', 64, 3, 2942, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 25, '1599.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(510, 'Mi 9T', 'mi-9t', 'Xiaomi', 'Previous Xiaomi flagship', 128, 6, 4000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 20, '999.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(511, 'Pixel 3a', 'pixel-3a', 'Google', 'Budget older Pixel', 64, 4, 3000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 15, '1199.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(512, 'OnePlus 6T', 'oneplus-6t', 'OnePlus', 'Older OnePlus', 128, 8, 3700, 'Android', 'assets/images/No_Image_Available.jpg', 1, 10, '1099.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(513, 'Galaxy M31', 'galaxy-m31', 'Samsung', 'Mid-range battery-focused', 128, 6, 6000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 35, '899.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(514, 'iPhone 8', 'iphone-8', 'Apple', 'Older iPhone', 64, 2, 1821, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 20, '1199.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(515, 'Redmi 9', 'redmi-9', 'Xiaomi', 'Budget Xiaomi phone', 64, 3, 5020, 'Android', 'assets/images/No_Image_Available.jpg', 1, 40, '699.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(516, 'Pixel 2', 'pixel-2', 'Google', 'Older Pixel phone', 64, 4, 2700, 'Android', 'assets/images/No_Image_Available.jpg', 1, 10, '999.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(517, 'OnePlus 5T', 'oneplus-5t', 'OnePlus', 'Older OnePlus model', 128, 6, 3300, 'Android', 'assets/images/No_Image_Available.jpg', 1, 10, '899.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(518, 'Galaxy S10', 'galaxy-s10', 'Samsung', 'Previous flagship', 128, 8, 3400, 'Android', 'assets/images/No_Image_Available.jpg', 1, 15, '1699.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(519, 'iPhone 7', 'iphone-7', 'Apple', 'Old Apple iPhone', 32, 2, 1960, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 15, '999.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(520, 'Mi 8', 'mi-8', 'Xiaomi', 'Older Xiaomi phone', 64, 4, 3400, 'Android', 'assets/images/No_Image_Available.jpg', 1, 20, '799.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(521, 'Pixel 2 XL', 'pixel-2-xl', 'Google', 'Big older Pixel', 64, 4, 3520, 'Android', 'assets/images/No_Image_Available.jpg', 1, 10, '1099.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(522, 'OnePlus 5', 'oneplus-5', 'OnePlus', 'Older OnePlus', 64, 6, 3300, 'Android', 'assets/images/No_Image_Available.jpg', 1, 10, '799.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(523, 'Galaxy Note 10', 'galaxy-note-10', 'Samsung', 'Older Note series', 256, 8, 3500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 15, '2799.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(524, 'iPhone 6S', 'iphone-6s', 'Apple', 'Old Apple phone', 32, 2, 1715, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 10, '799.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(525, 'Redmi 8', 'redmi-8', 'Xiaomi', 'Budget Xiaomi', 64, 3, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 20, '599.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(526, 'Pixel XL', 'pixel-xl', 'Google', 'Older big Pixel', 32, 4, 3450, 'Android', 'assets/images/No_Image_Available.jpg', 1, 10, '899.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(527, 'OnePlus 3T', 'oneplus-3t', 'OnePlus', 'Old OnePlus model', 64, 6, 3400, 'Android', 'assets/images/No_Image_Available.jpg', 1, 5, '699.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(528, 'Galaxy J7', 'galaxy-j7', 'Samsung', 'Budget Samsung phone', 16, 2, 3000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 20, '499.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(529, 'iPhone 6', 'iphone-6', 'Apple', 'Old Apple phone', 16, 1, 1810, 'iOS', 'assets/images/No_Image_Available.jpg', 1, 10, '599.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(530, 'Redmi 7', 'redmi-7', 'Xiaomi', 'Budget Xiaomi', 32, 2, 4000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 25, '499.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(531, 'Pixel', 'pixel', 'Google', 'Original Pixel phone', 32, 4, 2770, 'Android', 'assets/images/No_Image_Available.jpg', 1, 10, '699.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(532, 'OnePlus 3', 'oneplus-3', 'OnePlus', 'Old OnePlus', 64, 6, 3000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 5, '599.00', '2025-12-09 10:46:38', 'admin', '2025-12-09 10:46:38', 'admin', '0'),
(533, 'Galaxy Quantum X', 'galaxy-quantum-x', 'Samsung FutureTech', '50th-generation quantum-powered phone', 2048, 512, 10000, 'Android Quantum OS', 'assets/images/No_Image_Available.jpg', 1, 25, '99999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(534, 'iPhone Vision 2075', 'iphone-vision-2075', 'Apple NextGen', 'Holographic display iPhone', 1024, 256, 9000, 'iOS 2075', 'assets/images/No_Image_Available.jpg', 1, 20, '109999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(535, 'Mi Hypernova', 'mi-hypernova', 'Xiaomi Futuristics', 'Self-repairing phone with AI core', 512, 128, 8500, 'Xiaomi AI OS', 'assets/images/No_Image_Available.jpg', 1, 30, '79999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(536, 'Pixel Infinity', 'pixel-infinity', 'Google Vision', 'Phone with endless battery and teleport messaging', 1024, 64, 100000, 'Google Infinity OS', 'assets/images/No_Image_Available.jpg', 1, 15, '89999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(537, 'OnePlus Stellar', 'oneplus-stellar', 'OnePlus Nova', 'Space-grade ultra-light phone', 256, 64, 12000, 'Stellar OS', 'assets/images/No_Image_Available.jpg', 1, 25, '69999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(538, 'Galaxy Nebula', 'galaxy-nebula', 'Samsung FutureTech', 'Nebula-powered AI assistant phone', 512, 128, 15000, 'Android Quantum OS', 'assets/images/No_Image_Available.jpg', 1, 19, '74999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:58:06', 'admin', '0'),
(539, 'iPhone Aurora', 'iphone-aurora', 'Apple NextGen', 'Aurora holographic interface', 256, 64, 9000, 'iOS 2075', 'assets/images/No_Image_Available.jpg', 1, 15, '79999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(540, 'Mi Cosmos', 'mi-cosmos', 'Xiaomi Futuristics', 'Zero-gravity phone with adaptive AI', 128, 32, 8000, 'Xiaomi AI OS', 'assets/images/No_Image_Available.jpg', 1, 30, '69999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(541, 'Pixel Hyperion', 'pixel-hyperion', 'Google Vision', 'Solar-powered phone with neural interface', 256, 64, 100000, 'Google Infinity OS', 'assets/images/No_Image_Available.jpg', 1, 20, '84999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(542, 'OnePlus Nova X', 'oneplus-nova-x', 'OnePlus Nova', 'Transdimensional communication phone', 512, 128, 12000, 'Stellar OS', 'assets/images/No_Image_Available.jpg', 1, 25, '89999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(543, 'Galaxy Eclipse', 'galaxy-eclipse', 'Samsung FutureTech', 'Phone with eclipse energy harvesting', 1024, 256, 20000, 'Android Quantum OS', 'assets/images/No_Image_Available.jpg', 1, 15, '99999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(544, 'iPhone Photon', 'iphone-photon', 'Apple NextGen', 'Photon-powered holographic display', 512, 128, 9500, 'iOS 2075', 'assets/images/No_Image_Available.jpg', 1, 20, '89999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(545, 'Mi Aurora X', 'mi-aurora-x', 'Xiaomi Futuristics', 'AI-assisted galaxy navigation phone', 1024, 256, 15000, 'Xiaomi AI OS', 'assets/images/No_Image_Available.jpg', 1, 25, '99999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(546, 'Pixel Zenith', 'pixel-zenith', 'Google Vision', 'Neural-connected infinity phone', 512, 128, 12000, 'Google Infinity OS', 'assets/images/No_Image_Available.jpg', 1, 20, '94999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(547, 'OnePlus Cosmos', 'oneplus-cosmos', 'OnePlus Nova', 'Interstellar AI phone', 256, 64, 10000, 'Stellar OS', 'assets/images/No_Image_Available.jpg', 1, 25, '79999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(548, 'Galaxy Orion', 'galaxy-orion', 'Samsung FutureTech', 'AI-assisted star navigation', 1024, 512, 20000, 'Android Quantum OS', 'assets/images/No_Image_Available.jpg', 1, 20, '109999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(549, 'iPhone Celestia', 'iphone-celestia', 'Apple NextGen', 'Celestial AI holographic phone', 512, 128, 10000, 'iOS 2075', 'assets/images/No_Image_Available.jpg', 1, 15, '89999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(550, 'Mi Nebula X', 'mi-nebula-x', 'Xiaomi Futuristics', 'Next-gen interstellar phone', 256, 64, 12000, 'Xiaomi AI OS', 'assets/images/No_Image_Available.jpg', 1, 30, '79999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(551, 'Pixel Aurora', 'pixel-aurora', 'Google Vision', 'Aurora-powered neural phone', 128, 32, 9000, 'Google Infinity OS', 'assets/images/No_Image_Available.jpg', 1, 25, '69999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(552, 'OnePlus Eclipse', 'oneplus-eclipse', 'OnePlus Nova', 'Energy-harvesting phone', 512, 128, 15000, 'Stellar OS', 'assets/images/No_Image_Available.jpg', 1, 20, '89999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(553, 'Galaxy Pulsar', 'galaxy-pulsar', 'Samsung FutureTech', 'AI star-tracking phone', 1024, 256, 25000, 'Android Quantum OS', 'assets/images/No_Image_Available.jpg', 1, 15, '119999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(554, 'iPhone Quantum', 'iphone-quantum', 'Apple NextGen', 'Quantum-computing enabled phone', 1024, 512, 20000, 'iOS 2075', 'assets/images/No_Image_Available.jpg', 1, 20, '109999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(555, 'Mi Hyperion', 'mi-hyperion', 'Xiaomi Futuristics', 'AI-assisted galaxy communication', 512, 128, 15000, 'Xiaomi AI OS', 'assets/images/No_Image_Available.jpg', 1, 30, '89999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(556, 'Pixel Stellar', 'pixel-stellar', 'Google Vision', 'Stellar navigation AI phone', 256, 64, 12000, 'Google Infinity OS', 'assets/images/No_Image_Available.jpg', 1, 25, '79999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(557, 'OnePlus Orion', 'oneplus-orion', 'OnePlus Nova', 'Next-gen interstellar phone', 512, 128, 15000, 'Stellar OS', 'assets/images/No_Image_Available.jpg', 1, 20, '89999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(558, 'Galaxy Hypernova', 'galaxy-hypernova', 'Samsung FutureTech', 'Galaxy-powered AI phone', 1024, 512, 25000, 'Android Quantum OS', 'assets/images/No_Image_Available.jpg', 1, 15, '129999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(559, 'iPhone Nebula', 'iphone-nebula', 'Apple NextGen', 'Holographic star-display phone', 512, 128, 12000, 'iOS 2075', 'assets/images/No_Image_Available.jpg', 1, 20, '99999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(560, 'Mi Celestia', 'mi-celestia', 'Xiaomi Futuristics', 'Next-gen AI star phone', 256, 64, 10000, 'Xiaomi AI OS', 'assets/images/No_Image_Available.jpg', 1, 25, '79999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(561, 'Pixel Nova', 'pixel-nova', 'Google Vision', 'AI-powered space phone', 128, 32, 9000, 'Google Infinity OS', 'assets/images/No_Image_Available.jpg', 1, 25, '69999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(562, 'OnePlus Quantum', 'oneplus-quantum', 'OnePlus Nova', 'Quantum-computing phone', 512, 128, 15000, 'Stellar OS', 'assets/images/No_Image_Available.jpg', 1, 20, '89999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(563, 'Galaxy Aurora X', 'galaxy-aurora-x', 'Samsung FutureTech', 'Aurora-powered AI phone', 1024, 256, 20000, 'Android Quantum OS', 'assets/images/No_Image_Available.jpg', 1, 15, '109999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(564, 'iPhone Stellar', 'iphone-stellar', 'Apple NextGen', 'Stellar navigation phone', 512, 128, 12000, 'iOS 2075', 'assets/images/No_Image_Available.jpg', 1, 20, '99999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(565, 'Mi Quantum', 'mi-quantum', 'Xiaomi Futuristics', 'Next-gen AI quantum phone', 256, 64, 10000, 'Xiaomi AI OS', 'assets/images/No_Image_Available.jpg', 1, 25, '79999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(566, 'Pixel Nebula', 'pixel-nebula', 'Google Vision', 'Neural star-tracking phone', 128, 32, 9000, 'Google Infinity OS', 'assets/images/No_Image_Available.jpg', 1, 25, '69999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(567, 'OnePlus Aurora', 'oneplus-aurora', 'OnePlus Nova', 'Aurora-powered phone', 512, 128, 15000, 'Stellar OS', 'assets/images/No_Image_Available.jpg', 1, 20, '89999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(568, 'Galaxy Nova X', 'galaxy-nova-x', 'Samsung FutureTech', 'Galaxy AI phone', 1024, 512, 25000, 'Android Quantum OS', 'assets/images/No_Image_Available.jpg', 1, 15, '129999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(569, 'iPhone Hyperion', 'iphone-hyperion', 'Apple NextGen', 'AI-assisted interstellar phone', 512, 128, 12000, 'iOS 2075', 'assets/images/No_Image_Available.jpg', 1, 20, '99999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(570, 'Mi Stellar', 'mi-stellar', 'Xiaomi Futuristics', 'Next-gen stellar phone', 256, 64, 10000, 'Xiaomi AI OS', 'assets/images/No_Image_Available.jpg', 1, 25, '79999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(571, 'Pixel Quantum X', 'pixel-quantum-x', 'Google Vision', 'Quantum AI phone', 128, 32, 9000, 'Google Infinity OS', 'assets/images/No_Image_Available.jpg', 1, 25, '69999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(572, 'OnePlus Nebula', 'oneplus-nebula', 'OnePlus Nova', 'Neural star-powered phone', 512, 128, 15000, 'Stellar OS', 'assets/images/No_Image_Available.jpg', 1, 20, '89999.00', '2025-12-09 10:49:57', 'admin', '2025-12-09 10:49:57', 'admin', '0'),
(573, 'Dragon Slayer X1', 'dragon-slayer-x1', 'EpicTech', 'Phone inspired by legendary dragon-slaying weapons', 256, 16, 6000, 'RPG OS', 'assets/images/No_Image_Available.jpg', 1, 20, '5999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(574, 'Mystic Wand 2077', 'mystic-wand-2077', 'MagicCorp', 'Phone with magical AR interface', 128, 12, 4500, 'Wizard OS', 'assets/images/No_Image_Available.jpg', 1, 25, '4999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(575, 'Excalibur Nova', 'excalibur-nova', 'LegendaryTech', 'Sword-inspired phone with infinite energy', 512, 32, 8000, 'Arthurian OS', 'assets/images/No_Image_Available.jpg', 1, 15, '7999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(576, 'Phoenix Feather', 'phoenix-feather', 'Firebird Inc', 'Rebirth-enabled battery phone', 256, 16, 7000, 'Immortal OS', 'assets/images/No_Image_Available.jpg', 1, 30, '6999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(577, 'Shadow Blade', 'shadow-blade', 'StealthTech', 'Stealth mode enabled smartphone', 128, 12, 5000, 'Shadow OS', 'assets/images/No_Image_Available.jpg', 1, 25, '5499.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(578, 'Orb of Eternity', 'orb-of-eternity', 'MysticTech', 'Infinite power phone with AI orb', 512, 32, 10000, 'Eternal OS', 'assets/images/No_Image_Available.jpg', 1, 20, '8999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(579, 'Thunderstrike Z', 'thunderstrike-z', 'VoltCorp', 'Lightning-fast charging with storm OS', 256, 16, 6000, 'Storm OS', 'assets/images/No_Image_Available.jpg', 1, 25, '5999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(580, 'Crystal Fang', 'crystal-fang', 'BeastTech', 'Fang-inspired design with beast AI', 128, 12, 4500, 'Beast OS', 'assets/images/No_Image_Available.jpg', 1, 30, '4999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(581, 'Titan Hammer', 'titan-hammer', 'Colossus Inc', 'Massive battery hammer phone', 512, 32, 12000, 'Titan OS', 'assets/images/No_Image_Available.jpg', 1, 15, '8999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(582, 'Phoenix Wing', 'phoenix-wing', 'Firebird Inc', 'Flying holographic phone', 256, 16, 7000, 'Immortal OS', 'assets/images/No_Image_Available.jpg', 1, 30, '6999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(583, 'Aegis Shield', 'aegis-shield', 'DefenderTech', 'Ultra-protection phone', 128, 12, 5000, 'Guardian OS', 'assets/images/No_Image_Available.jpg', 1, 25, '5499.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(584, 'Dragon Fang', 'dragon-fang', 'EpicTech', 'Dragon-inspired high-performance phone', 256, 16, 6000, 'RPG OS', 'assets/images/No_Image_Available.jpg', 1, 20, '5999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(585, 'Wizard Staff X', 'wizard-staff-x', 'MagicCorp', 'Staff-inspired AR phone', 128, 12, 4500, 'Wizard OS', 'assets/images/No_Image_Available.jpg', 1, 25, '4999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(586, 'Shadow Cloak', 'shadow-cloak', 'StealthTech', 'Cloak-inspired stealth phone', 128, 12, 5000, 'Shadow OS', 'assets/images/No_Image_Available.jpg', 1, 25, '5499.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(587, 'Crystal Orb', 'crystal-orb', 'MysticTech', 'Mystic orb-powered phone', 512, 32, 10000, 'Eternal OS', 'assets/images/No_Image_Available.jpg', 1, 20, '8999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(588, 'Thunder Axe', 'thunder-axe', 'VoltCorp', 'Axe-shaped lightning phone', 256, 16, 6000, 'Storm OS', 'assets/images/No_Image_Available.jpg', 1, 25, '5999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(589, 'Titan Sword', 'titan-sword', 'Colossus Inc', 'Massive sword phone', 512, 32, 12000, 'Titan OS', 'assets/images/No_Image_Available.jpg', 1, 15, '8999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(590, 'Phoenix Orb', 'phoenix-orb', 'Firebird Inc', 'Rebirth energy orb', 256, 16, 7000, 'Immortal OS', 'assets/images/No_Image_Available.jpg', 1, 30, '6999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(591, 'Crystal Blade', 'crystal-blade', 'BeastTech', 'Blade-inspired AI phone', 128, 12, 4500, 'Beast OS', 'assets/images/No_Image_Available.jpg', 1, 30, '4999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(592, 'Dragon Heart', 'dragon-heart', 'EpicTech', 'Heart of dragon for AI power', 512, 32, 10000, 'RPG OS', 'assets/images/No_Image_Available.jpg', 1, 20, '8999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(593, 'Wizard Tome', 'wizard-tome', 'MagicCorp', 'Spellbook-inspired phone', 128, 12, 4500, 'Wizard OS', 'assets/images/No_Image_Available.jpg', 1, 25, '4999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(594, 'Shadow Dagger', 'shadow-dagger', 'StealthTech', 'Dagger-inspired stealth device', 128, 12, 5000, 'Shadow OS', 'assets/images/No_Image_Available.jpg', 1, 25, '5499.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(595, 'Titan Gauntlet', 'titan-gauntlet', 'Colossus Inc', 'Gauntlet with massive power', 512, 32, 12000, 'Titan OS', 'assets/images/No_Image_Available.jpg', 1, 15, '8999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(596, 'Phoenix Blade', 'phoenix-blade', 'Firebird Inc', 'Blade with rebirth energy', 256, 16, 7000, 'Immortal OS', 'assets/images/No_Image_Available.jpg', 1, 30, '6999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(597, 'Dragon Orb', 'dragon-orb', 'EpicTech', 'Orb with dragon AI power', 512, 32, 10000, 'RPG OS', 'assets/images/No_Image_Available.jpg', 1, 20, '8999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(598, 'Wizard Crystal', 'wizard-crystal', 'MagicCorp', 'Crystal-powered spellphone', 128, 12, 4500, 'Wizard OS', 'assets/images/No_Image_Available.jpg', 1, 25, '4999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(599, 'Shadow Spear', 'shadow-spear', 'StealthTech', 'Spear-inspired stealth phone', 128, 12, 5000, 'Shadow OS', 'assets/images/No_Image_Available.jpg', 1, 25, '5499.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(600, 'Crystal Shield', 'crystal-shield', 'BeastTech', 'Shield-powered AI phone', 512, 32, 10000, 'Beast OS', 'assets/images/No_Image_Available.jpg', 1, 20, '8999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(601, 'Thunder Orb', 'thunder-orb', 'VoltCorp', 'Lightning orb-powered device', 256, 16, 6000, 'Storm OS', 'assets/images/No_Image_Available.jpg', 1, 25, '5999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(602, 'Titan Helm', 'titan-helm', 'Colossus Inc', 'Helm-shaped phone with massive power', 512, 32, 12000, 'Titan OS', 'assets/images/No_Image_Available.jpg', 1, 15, '8999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(603, 'Phoenix Staff', 'phoenix-staff', 'Firebird Inc', 'Staff with rebirth energy', 256, 16, 7000, 'Immortal OS', 'assets/images/No_Image_Available.jpg', 1, 30, '6999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(604, 'Dragon Sword', 'dragon-sword', 'EpicTech', 'Sword with dragon AI', 512, 32, 10000, 'RPG OS', 'assets/images/No_Image_Available.jpg', 1, 20, '8999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(605, 'Wizard Orb', 'wizard-orb', 'MagicCorp', 'Orb-powered spellphone', 128, 12, 4500, 'Wizard OS', 'assets/images/No_Image_Available.jpg', 1, 25, '4999.00', '2025-12-09 10:51:54', 'admin', '2025-12-09 10:51:54', 'admin', '0'),
(606, 'Shadow Shield', 'shadow-shield', 'StealthTech', 'Shield-inspired stealth device', 128, 12, 5000, 'Shadow OS', 'assets/images/1765869422_shadow_shield.jpg', 1, 25, '5499.00', '2025-12-09 10:51:54', 'admin', '2026-01-02 17:35:31', 'Hafiz Zainal', '0'),
(607, 'sefse', 'sefse', 'Xiaomi', 'sefsefes', 123, 123, 123, '123', 'assets/images/1765945043_one_utama.jpg', 0, 123, '123.00', '2025-12-17 12:17:23', 'One Utama', '2025-12-17 12:17:39', 'One Utama', '0');
INSERT INTO `phone` (`phone_id`, `phone_name`, `normalized_name`, `brand`, `description`, `storage`, `ram`, `battery`, `os`, `image_url`, `is_active`, `stock`, `current_price`, `created_at`, `created_by`, `updated_at`, `updated_by`, `discount`) VALUES
(608, 'Nova X1', 'nova x1', 'Novatek', 'Affordable phone with balanced performance', 128, 6, 4500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 20, '1299.00', '2025-12-17 17:39:32', 'admin', '2026-01-02 17:54:32', 'admin', '13'),
(609, 'Nova X1 Pro', 'nova x1 pro', 'Novatek', 'Upgraded Nova with better camera', 256, 8, 4700, 'Android', 'assets/images/No_Image_Available.jpg', 1, 15, '1599.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '15'),
(610, 'Aether Pulse', 'aether pulse', 'Aether', 'Sleek design with AMOLED display', 256, 8, 4800, 'Android', 'assets/images/No_Image_Available.jpg', 1, 18, '1899.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '12'),
(611, 'Aether Pulse Max', 'aether pulse max', 'Aether', 'Large battery and smooth performance', 512, 12, 5200, 'Android', 'assets/images/No_Image_Available.jpg', 1, 12, '2299.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '18'),
(612, 'Zenon Z5', 'zenon z5', 'Zenon', 'Mid-range phone for daily use', 128, 6, 4600, 'Android', 'assets/images/No_Image_Available.jpg', 1, 30, '1399.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '8'),
(613, 'Zenon Z5 Ultra', 'zenon z5 ultra', 'Zenon', 'Premium Zenon phone with fast charging', 256, 12, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 10, '2099.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '20'),
(614, 'Orion Spark', 'orion spark', 'Orion', 'Compact phone with fast UI', 128, 8, 4300, 'Android', 'assets/images/No_Image_Available.jpg', 1, 25, '1499.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '10'),
(615, 'Orion Spark Pro', 'orion spark pro', 'Orion', 'Enhanced camera and display', 256, 12, 4800, 'Android', 'assets/images/No_Image_Available.jpg', 1, 14, '1999.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '15'),
(616, 'Vortex V10', 'vortex v10', 'Vortex', 'Gaming-focused phone with cooling system', 256, 12, 5500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 16, '2499.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '22'),
(617, 'Vortex V10 Max', 'vortex v10 max', 'Vortex', 'Extreme gaming performance', 512, 16, 6000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 8, '2999.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '25'),
(618, 'Lumin L3', 'lumin l3', 'Lumin', 'Lightweight phone with clean UI', 128, 6, 4200, 'Android', 'assets/images/No_Image_Available.jpg', 1, 40, '1199.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '5'),
(619, 'Lumin L3 Plus', 'lumin l3 plus', 'Lumin', 'Better battery and display', 256, 8, 4600, 'Android', 'assets/images/No_Image_Available.jpg', 1, 22, '1499.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '10'),
(620, 'Spectra S9', 'spectra s9', 'Spectra', 'Stylish phone with vibrant screen', 256, 8, 4800, 'Android', 'assets/images/No_Image_Available.jpg', 1, 18, '1799.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '12'),
(621, 'Spectra S9 Pro', 'spectra s9 pro', 'Spectra', 'Flagship Spectra experience', 512, 12, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 9, '2399.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '18'),
(622, 'Helix One', 'helix one', 'Helix', 'Minimalist design and smooth UX', 128, 6, 4400, 'Android', 'assets/images/No_Image_Available.jpg', 1, 35, '1099.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '7'),
(623, 'Helix One Plus', 'helix one plus', 'Helix', 'Improved performance and battery', 256, 8, 4800, 'Android', 'assets/images/No_Image_Available.jpg', 1, 20, '1399.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '10'),
(624, 'Pixelon P7', 'pixelon p7', 'Pixelon', 'Camera-focused smartphone', 256, 12, 4900, 'Android', 'assets/images/No_Image_Available.jpg', 1, 14, '2199.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '15'),
(625, 'Pixelon P7 Ultra', 'pixelon p7 ultra', 'Pixelon', 'Advanced imaging and AI features', 512, 16, 5200, 'Android', 'assets/images/No_Image_Available.jpg', 1, 6, '2799.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '20'),
(626, 'Cryon Edge', 'cryon edge', 'Cryon', 'Premium feel with curved display', 256, 12, 5000, 'Android', 'assets/images/No_Image_Available.jpg', 1, 11, '2599.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '18'),
(627, 'Cryon Edge Max', 'cryon edge max', 'Cryon', 'High-end specs with large storage', 512, 16, 5500, 'Android', 'assets/images/No_Image_Available.jpg', 1, 5, '3199.00', '2025-12-17 17:39:32', 'admin', '2025-12-17 17:39:32', 'admin', '25');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','hidden','deleted') DEFAULT 'active',
  `order_item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `product_id`, `order_id`, `rating`, `comment`, `images`, `created_at`, `updated_at`, `status`, `order_item_id`) VALUES
(4, 60, 371, 97, 2, 'So, I got the SuperMegaPhone 9000 and wow… this phone has officially made me question my entire life. The camera is so good that I can now see every pore, every crumb, and every regret in HD. I showed a photo of my coffee to my mom, and she gasped like I had discovered a new planet.\n\nBattery life? The box says “all-day,” but I’m pretty sure that’s in alien hours. One scroll through Instagram, and it’s begging for mercy. Thankfully, it charges faster than I can say “oops, almost late for work.”\n\nThe AI assistant? Don’t get me started. I asked it to set an alarm, and it replied, “Do you really want to wake up that early?” Yes. I do. And then it suggested I meditate. No, phone, I meditate by scrolling memes in bed, thank you.\n\nThe screen is so bright that I now need sunglasses inside. The fingerprint sensor likes to play hide-and-seek, so unlocking it sometimes feels like a trust exercise.\n\nAll in all, the SuperMegaPhone 9000 isn’t just a phone—it’s a tiny, judgmental life coach, a paparazzi photographer, and my new favorite companion. 5/5 stars for turning my daily life into a sitcom I didn’t know I signed up for.', '[\"assets\\/images\\/40\\/OI97_OIID153\\/1766478645_OI97_OIID153_0.jpeg\",\"assets\\/images\\/40\\/OI97_OIID153\\/1766478645_OI97_OIID153_1.jpg\",\"assets\\/images\\/40\\/OI97_OIID153\\/1766478645_OI97_OIID153_2.png\"]', '2025-12-23 16:30:45', '2025-12-23 17:24:19', 'active', 153),
(5, 40, 371, 95, 5, 'Aku baru dapat SuperMegaPhone 9000 ni, dan serius… telefon ni macam pandai lebih daripada aku. Kamera dia? Fuh, kalau ambik gambar nasi lemak, rasa macam chef bintang 5 je yang masak. Aku tunjuk kat mak, dia terus cakap, “Eh, siapa ni ambik gambar? Makan tak habis ke?”\n\nBateri dia kata “sehari penuh”, tapi satu jam scroll TikTok, terus minta charger macam aku mintak duit raya. Nasib baik cas laju gila—sementara aku pergi masak Maggi, bateri dah penuh balik.\n\nAI assistant dia? Lawak gila. Aku suruh set alarm pukul 7 pagi, dia tanya, “Betul ke nak bangun awal ni?” Betul lah, telefon! Lepas tu dia cadangkan meditasi pulak. Aku meditasi dengan cara tengok meme je, cukup tak?\n\nSkrin dia terang macam lampu stadium, pakai kat luar mata aku macam nak terbakar. Sensor cap jari pulak suka main sorok-sorok, macam nak uji kesabaran aku.\n\nKesimpulan: SuperMegaPhone 9000 ni bukan telefon biasa, dia macam kawan yang judge kita, paparazi makanan kita, tapi still berguna gila. Aku bagi 5/5 sebab hiburkan hidup aku macam drama Melayu setiap hari.', '[\"assets\\/images\\/40\\/OI95_OIID149\\/1766480162_OI95_OIID149_0.png\",\"assets\\/images\\/40\\/OI95_OIID149\\/1766480162_OI95_OIID149_1.png\",\"assets\\/images\\/40\\/OI95_OIID149\\/1766480162_OI95_OIID149_2.jpg\"]', '2025-12-23 16:56:02', '2025-12-23 17:25:30', 'active', 149),
(6, 40, 371, 97, 4, 'Aku beli SuperMegaPhone 9000 ni, serious, telefon ni macam ada otak sendiri. Kamera dia? Fuh, boleh ambik gambar nasi goreng, nampak macam MasterChef siap bagi rating 10/10. Aku share kat kawan, dia cakap, “Eh ni food review ke, atau kau nak buka restoran?”\n\nBateri dia pulak… wahai kawan, claim “sehari penuh”, tapi scroll TikTok 30 minit, terus minta charger macam aku mintak duit raya. Nasib baik cas laju, sempat aku mandi + gosok gigi, bateri dah penuh.\n\nAI assistant dia pun lawak gila. Aku suruh set alarm pukul 7 pagi, dia tanya, “Betul ke nak bangun awal ni?” Eh telefon, jangan tanya aku soalan hidup mati ni! Lepas tu cadang aku meditasi… aku meditasi dengan cara tengok meme je lah.\n\nSkrin dia terang gila, sampai pakai kat luar macam nak silaukan mata jiran. Sensor cap jari pulak suka main sorok-sorok, macam nak test kesabaran aku.\n\nKesimpulan: SuperMegaPhone 9000 ni bukan telefon biasa, ni macam kawan yang judge kita, paparazi makanan kita, dan kadang-kadang buat kita gelak gila. Aku bagi 5/5 bintang.', '[\"assets\\/images\\/40\\/OI97_OIID153\\/1766480205_OI97_OIID153_0.png\",\"assets\\/images\\/40\\/OI97_OIID153\\/1766480205_OI97_OIID153_1.png\",\"assets\\/images\\/40\\/OI97_OIID153\\/1766480205_OI97_OIID153_2.jpg\",\"assets\\/images\\/40\\/OI97_OIID153\\/1766480205_OI97_OIID153_3.jpg\",\"assets\\/images\\/40\\/OI97_OIID153\\/1766480205_OI97_OIID153_4.png\",\"assets\\/images\\/40\\/OI97_OIID153\\/1766480205_OI97_OIID153_5.jpeg\"]', '2025-12-23 16:56:45', '2025-12-23 17:25:58', 'active', 153),
(7, 40, 371, 97, 5, 'Aku baru je adopt kucing ni, serius, rasa macam dia lebih smart dari aku. Makan je bukan main, tapi kalau aku cuba ambik remote TV dia pandang macam, “Bro… ni hak aku. Jangan kacau.”\n\nMain bola? Haha jangan harap, kucing ni rileks je, duduk tengok aku kelam-kabut macam drama Melayu. Tidur dia? Fuh, macam model Instagram je, siap pose cantik atas sofa.\n\nDia pandai main tipu aku jugak. Contoh: letak makanan kat pinggan, terus dia tengok je, siap buat muka innocent. Aku pulak tergoda bagi lagi… muka dia macam menang Oscar, aku kalah mental.\n\nP/S: dia ni tak bagi aku pegang lama-lama, tapi bila aku tidur je, terus naik kat bantal, tidur macam bos besar. Aku? Penjawat kecil je kat rumah ni.\n\nRating: ⭐⭐⭐⭐⭐ sebab hiburkan hidup aku tiap hari… dan buat aku rasa rendah diri sikit 😅\n\nP/S 2: sorry gambar takde kaitan, gambar aku je tengah menangis tengok dia makan ikan', '[\"assets\\/images\\/40\\/OI97_OIID153\\/1766481095_OI97_OIID153_0.jpg\",\"assets\\/images\\/40\\/OI97_OIID153\\/1766481095_OI97_OIID153_1.jpg\",\"assets\\/images\\/40\\/OI97_OIID153\\/1766481095_OI97_OIID153_2.jpg\",\"assets\\/images\\/40\\/OI97_OIID153\\/1766481095_OI97_OIID153_3.png\",\"assets\\/images\\/40\\/OI97_OIID153\\/1766481095_OI97_OIID153_4.jpg\",\"assets\\/images\\/40\\/OI97_OIID153\\/1766481095_OI97_OIID153_5.png\"]', '2025-12-23 17:11:35', '2025-12-23 17:26:23', 'active', 153),
(8, 40, 376, 78, 5, 'freak', '[\"assets\\/images\\/40\\/OI78_OIID129\\/1768810733_OI78_OIID129_0.png\",\"assets\\/images\\/40\\/OI78_OIID129\\/1768810733_OI78_OIID129_1.png\",\"assets\\/images\\/40\\/OI78_OIID129\\/1768810733_OI78_OIID129_2.png\",\"assets\\/images\\/40\\/OI78_OIID129\\/1768810733_OI78_OIID129_3.png\",\"assets\\/images\\/40\\/OI78_OIID129\\/1768810733_OI78_OIID129_4.png\"]', '2026-01-19 16:18:53', '2026-01-19 16:18:53', 'active', 129),
(9, 40, 369, 84, 5, 'Aku baru je adopt kucing ni, serius, rasa macam dia lebih smart dari aku. Makan je bukan main, tapi kalau aku cuba ambik remote TV dia pandang macam, “Bro… ni hak aku. Jangan kacau.”\n\nMain bola? Haha jangan harap, kucing ni rileks je, duduk tengok aku kelam-kabut macam drama Melayu. Tidur dia? Fuh, macam model Instagram je, siap pose cantik atas sofa.\n\nDia pandai main tipu aku jugak. Contoh: letak makanan kat pinggan, terus dia tengok je, siap buat muka innocent. Aku pulak tergoda bagi lagi… muka dia macam menang Oscar, aku kalah mental.\n\nP/S: dia ni tak bagi aku pegang lama-lama, tapi bila aku tidur je, terus naik kat bantal, tidur macam bos besar. Aku? Penjawat kecil je kat rumah ni.\n\nRating: ⭐⭐⭐⭐⭐ sebab hiburkan hidup aku tiap hari… dan buat aku rasa rendah diri sikit 😅\n\nP/S 2: sorry gambar takde kaitan, gambar aku je tengah menangis tengok dia makan ikan', '[\"assets\\/images\\/40\\/OI84_OIID134\\/1768811127_OI84_OIID134_0.png\",\"assets\\/images\\/40\\/OI84_OIID134\\/1768811127_OI84_OIID134_1.png\"]', '2026-01-19 16:25:27', '2026-01-19 16:35:13', 'active', 134),
(10, 40, 369, 84, 5, 'anjay mabar', '[\"assets\\/images\\/40\\/OI84_OIID134\\/1768811127_OI84_OIID134_0.png\",\"assets\\/images\\/40\\/OI84_OIID134\\/1768811127_OI84_OIID134_1.png\"]', '2026-01-19 16:25:27', '2026-01-19 16:25:27', 'active', 134),
(11, 40, 382, 98, 5, 'Jam tangan perisa coklat', '[\"assets\\/images\\/40\\/OI98_OIID154\\/1768872228_OI98_OIID154_0.png\",\"assets\\/images\\/40\\/OI98_OIID154\\/1768872228_OI98_OIID154_1.png\",\"assets\\/images\\/40\\/OI98_OIID154\\/1768872228_OI98_OIID154_2.jpg\",\"assets\\/images\\/40\\/OI98_OIID154\\/1768872228_OI98_OIID154_3.jpg\",\"assets\\/images\\/40\\/OI98_OIID154\\/1768872228_OI98_OIID154_4.png\",\"assets\\/images\\/40\\/OI98_OIID154\\/1768872228_OI98_OIID154_5.jpeg\",\"assets\\/images\\/40\\/OI98_OIID154\\/1768872228_OI98_OIID154_6.png\",\"assets\\/images\\/40\\/OI98_OIID154\\/1768872228_OI98_OIID154_7.jpg\",\"assets\\/images\\/40\\/OI98_OIID154\\/1768872228_OI98_OIID154_8.png\",\"assets\\/images\\/40\\/OI98_OIID154\\/1768872228_OI98_OIID154_9.svg\",\"assets\\/images\\/40\\/OI98_OIID154\\/1768872228_OI98_OIID154_10.jpg\",\"assets\\/images\\/40\\/OI98_OIID154\\/1768872228_OI98_OIID154_11.jpg\"]', '2026-01-20 09:23:48', '2026-01-20 09:23:48', 'active', 154);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT 'User',
  `is_active` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin_type` varchar(100) NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `role`, `is_active`, `created_at`, `updated_at`, `admin_type`) VALUES
(40, 'Syrax3s', 'c4ca4238a0b923820dcc509a6f75849b', 'afiq@gmail.com', 'User', 1, '2025-11-17 16:43:35', '2025-12-17 09:41:48', 'normal'),
(43, 'Oppo Hal', '202cb962ac59075b964b07152d234b70', 'oppoHal@gmail.com', 'Admin', 1, '2025-12-09 14:04:43', '2025-12-15 11:36:56', 'normal'),
(44, 'oppo', 'c892ba238c98835d4d53a3faed43ee52', 'oppo@gmail.com', 'Admin', 1, '2025-12-09 14:05:49', '2025-12-09 14:05:49', 'normal'),
(60, 'Jason Lee', '482c811da5d5b4bc6d497ffa98491e38', 'jason.lee@example.com', 'User', 1, '2025-12-09 15:49:20', '2025-12-15 10:12:08', 'normal'),
(61, 'Liyana Ismail', '098f6bcd4621d373cade4e832627b4f6', 'liyana.ismail@example.com', 'User', 0, '2025-12-09 15:49:20', '2025-12-10 16:46:47', 'normal'),
(62, 'Mohd Amir', '098f6bcd4621d373cade4e832627b4f6', 'mohd.amir@example.com', 'User', 1, '2025-12-09 15:49:20', '2025-12-10 16:46:47', 'normal'),
(63, 'Adam Hakim', '098f6bcd4621d373cade4e832627b4f6', 'adam.hakim@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(64, 'Aina Farah', '098f6bcd4621d373cade4e832627b4f6', 'aina.farah@example.com', 'User', 0, '2025-12-09 15:49:59', '2025-12-15 10:08:44', 'normal'),
(65, 'Amirul Haziq', '098f6bcd4621d373cade4e832627b4f6', 'amirul.haziq@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(66, 'Anis Amani', '098f6bcd4621d373cade4e832627b4f6', 'anis.amani@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(67, 'Arif Hafiz', '098f6bcd4621d373cade4e832627b4f6', 'arif.hafiz@example.com', 'User', 0, '2025-12-09 15:49:59', '2025-12-15 10:11:44', 'normal'),
(68, 'Asyraf Najmi', '098f6bcd4621d373cade4e832627b4f6', 'asyraf.najmi@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(70, 'Bella Khairina', '098f6bcd4621d373cade4e832627b4f6', 'bella.khairina@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(72, 'Daphne Lim', '098f6bcd4621d373cade4e832627b4f6', 'daphne.lim@example.com', 'User', 0, '2025-12-09 15:49:59', '2025-12-15 10:08:49', 'normal'),
(73, 'Ehsan Faiz', '098f6bcd4621d373cade4e832627b4f6', 'ehsan.faiz@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(74, 'Elaine Wong', '098f6bcd4621d373cade4e832627b4f6', 'elaine.wong@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(75, 'Farid Iskandar', '098f6bcd4621d373cade4e832627b4f6', 'farid.iskandar@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(76, 'Fatin Aqilah', '098f6bcd4621d373cade4e832627b4f6', 'fatin.aqilah@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(77, 'Fauzi Rahman', '098f6bcd4621d373cade4e832627b4f6', 'fauzi.rahman@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(78, 'Hafizuddin', '098f6bcd4621d373cade4e832627b4f6', 'hafizuddin@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(79, 'Hani Sofea', '098f6bcd4621d373cade4e832627b4f6', 'hani.sofea@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(80, 'Haziq Amin', '098f6bcd4621d373cade4e832627b4f6', 'haziq.amin@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(81, 'Ilham Faizal', '098f6bcd4621d373cade4e832627b4f6', 'ilham.faizal@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(82, 'Iqbal Hakim', '098f6bcd4621d373cade4e832627b4f6', 'iqbal.hakim@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(83, 'Jasmine Tan', '098f6bcd4621d373cade4e832627b4f6', 'jasmine.tan@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(84, 'Joel Lim', '098f6bcd4621d373cade4e832627b4f6', 'joel.lim@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(85, 'Khairul Nizam', '098f6bcd4621d373cade4e832627b4f6', 'khairul.nizam@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(86, 'Laila Sofia', '098f6bcd4621d373cade4e832627b4f6', 'laila.sofia@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(87, 'Latifah Amira', '098f6bcd4621d373cade4e832627b4f6', 'latifah.amira@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(88, 'Luqman Hakim', '098f6bcd4621d373cade4e832627b4f6', 'luqman.hakim@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(89, 'Maira Husna', '098f6bcd4621d373cade4e832627b4f6', 'maira.husna@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(90, 'Malik Farhan', '098f6bcd4621d373cade4e832627b4f6', 'malik.farhan@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(91, 'Maria Isabella', '098f6bcd4621d373cade4e832627b4f6', 'maria.isabella@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(92, 'Mikhael Tan', '098f6bcd4621d373cade4e832627b4f6', 'mikhael.tan@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(93, 'Najwa Aina', '098f6bcd4621d373cade4e832627b4f6', 'najwa.aina@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(94, 'Nashit Amir', '098f6bcd4621d373cade4e832627b4f6', 'nashit.amir@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(95, 'Nur Afiqah', '098f6bcd4621d373cade4e832627b4f6', 'nur.afiqah@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(96, 'Nur Fatimah', '098f6bcd4621d373cade4e832627b4f6', 'nur.fatimah@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(97, 'Nurul Hidayah', '098f6bcd4621d373cade4e832627b4f6', 'nurul.hidayah@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(98, 'Qistina Izzah', '098f6bcd4621d373cade4e832627b4f6', 'qistina.izzah@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(99, 'Rashid Hakim', '098f6bcd4621d373cade4e832627b4f6', 'rashid.hakim@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(100, 'Raya Sofia', '098f6bcd4621d373cade4e832627b4f6', 'raya.sofia@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(101, 'Rizal Farhan', '098f6bcd4621d373cade4e832627b4f6', 'rizal.farhan@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(102, 'Sabrina Lim', '098f6bcd4621d373cade4e832627b4f6', 'sabrina.lim@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(103, 'Shafiq Azlan', '098f6bcd4621d373cade4e832627b4f6', 'shafiq.azlan@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(104, 'Syahir Hakim', '098f6bcd4621d373cade4e832627b4f6', 'syahir.hakim@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(105, 'Syafiqah Nur', '098f6bcd4621d373cade4e832627b4f6', 'syafiqah.nur@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(106, 'Tasha Amira', '098f6bcd4621d373cade4e832627b4f6', 'tasha.amira@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(107, 'Taufik Hakim', '098f6bcd4621d373cade4e832627b4f6', 'taufik.hakim@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(108, 'Wafa Sofia', '098f6bcd4621d373cade4e832627b4f6', 'wafa.sofia@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(109, 'Wan Hazim', '098f6bcd4621d373cade4e832627b4f6', 'wan.hazim@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(110, 'Yasmin Aina', '098f6bcd4621d373cade4e832627b4f6', 'yasmin.aina@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(111, 'Zul Hakim', '098f6bcd4621d373cade4e832627b4f6', 'zul.hakim@example.com', 'User', 1, '2025-12-09 15:49:59', '2025-12-10 16:46:47', 'normal'),
(112, 'James Smith', '098f6bcd4621d373cade4e832627b4f6', 'james.smith@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(113, 'Olivia Johnson', '098f6bcd4621d373cade4e832627b4f6', 'olivia.johnson@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(114, 'Liam Williams', '098f6bcd4621d373cade4e832627b4f6', 'liam.williams@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(115, 'Emma Brown', '098f6bcd4621d373cade4e832627b4f6', 'emma.brown@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(116, 'Noah Jones', '098f6bcd4621d373cade4e832627b4f6', 'noah.jones@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(117, 'Ava Garcia', '098f6bcd4621d373cade4e832627b4f6', 'ava.garcia@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(118, 'Oliver Martinez', '098f6bcd4621d373cade4e832627b4f6', 'oliver.martinez@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(119, 'Sophia Rodriguez', '098f6bcd4621d373cade4e832627b4f6', 'sophia.rodriguez@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(120, 'Elijah Lee', '098f6bcd4621d373cade4e832627b4f6', 'elijah.lee@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(121, 'Isabella Walker', '098f6bcd4621d373cade4e832627b4f6', 'isabella.walker@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(122, 'Lucas Hall', '098f6bcd4621d373cade4e832627b4f6', 'lucas.hall@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(123, 'Mia Allen', '098f6bcd4621d373cade4e832627b4f6', 'mia.allen@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(124, 'Mason Young', '098f6bcd4621d373cade4e832627b4f6', 'mason.young@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(125, 'Charlotte Hernandez', '098f6bcd4621d373cade4e832627b4f6', 'charlotte.hernandez@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(126, 'Logan King', '098f6bcd4621d373cade4e832627b4f6', 'logan.king@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(127, 'Amelia Wright', '098f6bcd4621d373cade4e832627b4f6', 'amelia.wright@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(128, 'Ethan Lopez', '098f6bcd4621d373cade4e832627b4f6', 'ethan.lopez@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(129, 'Harper Hill', '098f6bcd4621d373cade4e832627b4f6', 'harper.hill@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(130, 'Aiden Scott', '098f6bcd4621d373cade4e832627b4f6', 'aiden.scott@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(131, 'Evelyn Green', '098f6bcd4621d373cade4e832627b4f6', 'evelyn.green@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(132, 'Benjamin Adams', '098f6bcd4621d373cade4e832627b4f6', 'benjamin.adams@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(133, 'Abigail Baker', '098f6bcd4621d373cade4e832627b4f6', 'abigail.baker@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(134, 'Samuel Nelson', '098f6bcd4621d373cade4e832627b4f6', 'samuel.nelson@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(135, 'Emily Carter', '098f6bcd4621d373cade4e832627b4f6', 'emily.carter@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(136, 'Henry Mitchell', '098f6bcd4621d373cade4e832627b4f6', 'henry.mitchell@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(137, 'Elizabeth Perez', '098f6bcd4621d373cade4e832627b4f6', 'elizabeth.perez@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(138, 'Alexander Roberts', '098f6bcd4621d373cade4e832627b4f6', 'alexander.roberts@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(139, 'Sofia Turner', '098f6bcd4621d373cade4e832627b4f6', 'sofia.turner@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(140, 'William Phillips', '098f6bcd4621d373cade4e832627b4f6', 'william.phillips@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(141, 'Ella Campbell', '098f6bcd4621d373cade4e832627b4f6', 'ella.campbell@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(142, 'Michael Parker', '098f6bcd4621d373cade4e832627b4f6', 'michael.parker@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(143, 'Avery Evans', '098f6bcd4621d373cade4e832627b4f6', 'avery.evans@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(144, 'Daniel Edwards', '098f6bcd4621d373cade4e832627b4f6', 'daniel.edwards@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(145, 'Madison Collins', '098f6bcd4621d373cade4e832627b4f6', 'madison.collins@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(146, 'Matthew Stewart', '098f6bcd4621d373cade4e832627b4f6', 'matthew.stewart@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(147, 'Scarlett Sanchez', '098f6bcd4621d373cade4e832627b4f6', 'scarlett.sanchez@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(148, 'David Morris', '098f6bcd4621d373cade4e832627b4f6', 'david.morris@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(149, 'Victoria Rogers', '098f6bcd4621d373cade4e832627b4f6', 'victoria.rogers@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(150, 'Joseph Reed', '098f6bcd4621d373cade4e832627b4f6', 'joseph.reed@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(151, 'Grace Cook', '098f6bcd4621d373cade4e832627b4f6', 'grace.cook@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(152, 'Jackson Morgan', '098f6bcd4621d373cade4e832627b4f6', 'jackson.morgan@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(153, 'Hannah Bell', '098f6bcd4621d373cade4e832627b4f6', 'hannah.bell@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(154, 'Sebastian Murphy', '098f6bcd4621d373cade4e832627b4f6', 'sebastian.murphy@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(155, 'Lily Bailey', '098f6bcd4621d373cade4e832627b4f6', 'lily.bailey@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(156, 'Owen Rivera', '098f6bcd4621d373cade4e832627b4f6', 'owen.rivera@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(157, 'Chloe Cooper', '098f6bcd4621d373cade4e832627b4f6', 'chloe.cooper@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(158, 'Carter Richardson', '098f6bcd4621d373cade4e832627b4f6', 'carter.richardson@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(159, 'Penelope Cox', '098f6bcd4621d373cade4e832627b4f6', 'penelope.cox@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(160, 'Wyatt Howard', '098f6bcd4621d373cade4e832627b4f6', 'wyatt.howard@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(161, 'Riley Ward', '098f6bcd4621d373cade4e832627b4f6', 'riley.ward@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(162, 'Gabriel Torres', '098f6bcd4621d373cade4e832627b4f6', 'gabriel.torres@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(163, 'Aria Peterson', '098f6bcd4621d373cade4e832627b4f6', 'aria.peterson@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(164, 'Julian Gray', '098f6bcd4621d373cade4e832627b4f6', 'julian.gray@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(165, 'Aurora Ramirez', '098f6bcd4621d373cade4e832627b4f6', 'aurora.ramirez@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(166, 'Levi James', '098f6bcd4621d373cade4e832627b4f6', 'levi.james@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(167, 'Camila Watson', '098f6bcd4621d373cade4e832627b4f6', 'camila.watson@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(168, 'Mateo Brooks', '098f6bcd4621d373cade4e832627b4f6', 'mateo.brooks@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(169, 'Victoria Kelly', '098f6bcd4621d373cade4e832627b4f6', 'victoria.kelly@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(170, 'Ryan Sanders', '098f6bcd4621d373cade4e832627b4f6', 'ryan.sanders@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(171, 'Nora Price', '098f6bcd4621d373cade4e832627b4f6', 'nora.price@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(172, 'Luke Bennett', '098f6bcd4621d373cade4e832627b4f6', 'luke.bennett@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(173, 'Scarlett Wood', '098f6bcd4621d373cade4e832627b4f6', 'scarlett.wood@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(174, 'Isaac Barnes', '098f6bcd4621d373cade4e832627b4f6', 'isaac.barnes@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(175, 'Zoe Ross', '098f6bcd4621d373cade4e832627b4f6', 'zoe.ross@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(176, 'Caleb Henderson', '098f6bcd4621d373cade4e832627b4f6', 'caleb.henderson@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(177, 'Lillian Coleman', '098f6bcd4621d373cade4e832627b4f6', 'lillian.coleman@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(178, 'Nathan Jenkins', '098f6bcd4621d373cade4e832627b4f6', 'nathan.jenkins@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(179, 'Hannah Perry', '098f6bcd4621d373cade4e832627b4f6', 'hannah.perry@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(180, 'Ryan Powell', '098f6bcd4621d373cade4e832627b4f6', 'ryan.powell@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(181, 'Layla Long', '098f6bcd4621d373cade4e832627b4f6', 'layla.long@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(182, 'Thomas Patterson', '098f6bcd4621d373cade4e832627b4f6', 'thomas.patterson@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(183, 'Hazel Hughes', '098f6bcd4621d373cade4e832627b4f6', 'hazel.hughes@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(184, 'Connor Flores', '098f6bcd4621d373cade4e832627b4f6', 'connor.flores@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(185, 'Victoria Washington', '098f6bcd4621d373cade4e832627b4f6', 'victoria.washington@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(186, 'Eli Butler', '098f6bcd4621d373cade4e832627b4f6', 'eli.butler@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(187, 'Aurora Simmons', '098f6bcd4621d373cade4e832627b4f6', 'aurora.simmons@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(188, 'Isaiah Foster', '098f6bcd4621d373cade4e832627b4f6', 'isaiah.foster@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(189, 'Stella Gonzales', '098f6bcd4621d373cade4e832627b4f6', 'stella.gonzales@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(190, 'Joshua Bryant', '098f6bcd4621d373cade4e832627b4f6', 'joshua.bryant@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(191, 'Violet Alexander', '098f6bcd4621d373cade4e832627b4f6', 'violet.alexander@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(192, 'Andrew Russell', '098f6bcd4621d373cade4e832627b4f6', 'andrew.russell@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(193, 'Hannah Griffin', '098f6bcd4621d373cade4e832627b4f6', 'hannah.griffin@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(194, 'Christian Diaz', '098f6bcd4621d373cade4e832627b4f6', 'christian.diaz@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(195, 'Aurora Hayes', '098f6bcd4621d373cade4e832627b4f6', 'aurora.hayes@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(196, 'Hunter Myers', '098f6bcd4621d373cade4e832627b4f6', 'hunter.myers@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(197, 'Layla Ford', '098f6bcd4621d373cade4e832627b4f6', 'layla.ford@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(198, 'Dylan Hamilton', '098f6bcd4621d373cade4e832627b4f6', 'dylan.hamilton@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(199, 'Paisley Graham', '098f6bcd4621d373cade4e832627b4f6', 'paisley.graham@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(200, 'Leo Sullivan', '098f6bcd4621d373cade4e832627b4f6', 'leo.sullivan@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(201, 'Penelope Wallace', '098f6bcd4621d373cade4e832627b4f6', 'penelope.wallace@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(202, 'Nathaniel West', '098f6bcd4621d373cade4e832627b4f6', 'nathaniel.west@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(203, 'Emilia Cole', '098f6bcd4621d373cade4e832627b4f6', 'emilia.cole@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(204, 'Aaron Jenkins', '098f6bcd4621d373cade4e832627b4f6', 'aaron.jenkins@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(205, 'Nora Howard', '098f6bcd4621d373cade4e832627b4f6', 'nora.howard@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(206, 'Christian Simmons', '098f6bcd4621d373cade4e832627b4f6', 'christian.simmons@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(207, 'Hazel Foster', '098f6bcd4621d373cade4e832627b4f6', 'hazel.foster@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(208, 'Lincoln Gonzales', '098f6bcd4621d373cade4e832627b4f6', 'lincoln.gonzales@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(209, 'Aurora Bryant', '098f6bcd4621d373cade4e832627b4f6', 'aurora.bryant@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(210, 'Wyatt Alexander', '098f6bcd4621d373cade4e832627b4f6', 'wyatt.alexander@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(211, 'Stella Russell', '098f6bcd4621d373cade4e832627b4f6', 'stella.russell@example.com', 'User', 1, '2025-12-09 16:39:30', '2025-12-10 16:46:47', 'normal'),
(212, 'Aiden Walker', '098f6bcd4621d373cade4e832627b4f6', 'aiden.walker@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(213, 'Mila Hill', '098f6bcd4621d373cade4e832627b4f6', 'mila.hill@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(214, 'Ethan Adams', '098f6bcd4621d373cade4e832627b4f6', 'ethan.adams@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(215, 'Ella Baker', '098f6bcd4621d373cade4e832627b4f6', 'ella.baker@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(216, 'Logan Nelson', '098f6bcd4621d373cade4e832627b4f6', 'logan.nelson@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(217, 'Avery Carter', '098f6bcd4621d373cade4e832627b4f6', 'avery.carter@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(218, 'Sebastian Mitchell', '098f6bcd4621d373cade4e832627b4f6', 'sebastian.mitchell@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(219, 'Harper Perez', '098f6bcd4621d373cade4e832627b4f6', 'harper.perez@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(220, 'Mason Roberts', '098f6bcd4621d373cade4e832627b4f6', 'mason.roberts@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(221, 'Luna Turner', '098f6bcd4621d373cade4e832627b4f6', 'luna.turner@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(222, 'Jackson Phillips', '098f6bcd4621d373cade4e832627b4f6', 'jackson.phillips@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(223, 'Layla Campbell', '098f6bcd4621d373cade4e832627b4f6', 'layla.campbell@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(224, 'Lucas Edwards', '098f6bcd4621d373cade4e832627b4f6', 'lucas.edwards@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(225, 'Scarlett Collins', '098f6bcd4621d373cade4e832627b4f6', 'scarlett.collins@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(226, 'Levi Stewart', '098f6bcd4621d373cade4e832627b4f6', 'levi.stewart@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(227, 'Victoria Sanchez', '098f6bcd4621d373cade4e832627b4f6', 'victoria.sanchez@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(228, 'Owen Morris', '098f6bcd4621d373cade4e832627b4f6', 'owen.morris@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(229, 'Grace Rogers', '098f6bcd4621d373cade4e832627b4f6', 'grace.rogers@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(230, 'Elijah Reed', '098f6bcd4621d373cade4e832627b4f6', 'elijah.reed@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(231, 'Hannah Cook', '098f6bcd4621d373cade4e832627b4f6', 'hannah.cook@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(232, 'Gabriel Morgan', '098f6bcd4621d373cade4e832627b4f6', 'gabriel.morgan@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(233, 'Zoe Bell', '098f6bcd4621d373cade4e832627b4f6', 'zoe.bell@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(234, 'Caleb Murphy', '098f6bcd4621d373cade4e832627b4f6', 'caleb.murphy@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(235, 'Aria Bailey', '098f6bcd4621d373cade4e832627b4f6', 'aria.bailey@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(236, 'Isaac Rivera', '098f6bcd4621d373cade4e832627b4f6', 'isaac.rivera@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(237, 'Lily Cooper', '098f6bcd4621d373cade4e832627b4f6', 'lily.cooper@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(238, 'Carter Richardson', '098f6bcd4621d373cade4e832627b4f6', 'carter.richardson2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(239, 'Penelope Cox', '098f6bcd4621d373cade4e832627b4f6', 'penelope.cox2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(240, 'Wyatt Howard', '098f6bcd4621d373cade4e832627b4f6', 'wyatt.howard2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(241, 'Riley Ward', '098f6bcd4621d373cade4e832627b4f6', 'riley.ward2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(242, 'Nathan James', '098f6bcd4621d373cade4e832627b4f6', 'nathan.james@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(243, 'Emilia Watson', '098f6bcd4621d373cade4e832627b4f6', 'emilia.watson@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(244, 'Leo Brooks', '098f6bcd4621d373cade4e832627b4f6', 'leo.brooks@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(245, 'Camila Kelly', '098f6bcd4621d373cade4e832627b4f6', 'camila.kelly@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(246, 'Aaron Sanders', '098f6bcd4621d373cade4e832627b4f6', 'aaron.sanders@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(247, 'Nora Price', '098f6bcd4621d373cade4e832627b4f6', 'nora.price2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(248, 'Isaiah Bennett', '098f6bcd4621d373cade4e832627b4f6', 'isaiah.bennett@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(249, 'Hazel Wood', '098f6bcd4621d373cade4e832627b4f6', 'hazel.wood2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(250, 'Lincoln Barnes', '098f6bcd4621d373cade4e832627b4f6', 'lincoln.barnes@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(251, 'Aurora Bryant', '098f6bcd4621d373cade4e832627b4f6', 'aurora.bryant2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(252, 'Wyatt Alexander', '098f6bcd4621d373cade4e832627b4f6', 'wyatt.alexander2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(253, 'Stella Russell', '098f6bcd4621d373cade4e832627b4f6', 'stella.russell2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(254, 'Hunter Griffin', '098f6bcd4621d373cade4e832627b4f6', 'hunter.griffin@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(255, 'Emery Diaz', '098f6bcd4621d373cade4e832627b4f6', 'emery.diaz@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(256, 'Landon Hayes', '098f6bcd4621d373cade4e832627b4f6', 'landon.hayes@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(257, 'Addison Myers', '098f6bcd4621d373cade4e832627b4f6', 'addison.myers@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(258, 'Grayson Foster', '098f6bcd4621d373cade4e832627b4f6', 'grayson.foster@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(259, 'Aurora Simmons', '098f6bcd4621d373cade4e832627b4f6', 'aurora.simmons2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(260, 'Eli Butler', '098f6bcd4621d373cade4e832627b4f6', 'eli.butler2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(261, 'Scarlett Hayes', '098f6bcd4621d373cade4e832627b4f6', 'scarlett.hayes2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(262, 'Josiah Foster', '098f6bcd4621d373cade4e832627b4f6', 'josiah.foster@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(263, 'Stella Gonzales', '098f6bcd4621d373cade4e832627b4f6', 'stella.gonzales2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(264, 'Nathaniel Bryant', '098f6bcd4621d373cade4e832627b4f6', 'nathaniel.bryant@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(265, 'Violet Alexander', '098f6bcd4621d373cade4e832627b4f6', 'violet.alexander2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(266, 'Andrew Russell', '098f6bcd4621d373cade4e832627b4f6', 'andrew.russell2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(267, 'Hannah Griffin', '098f6bcd4621d373cade4e832627b4f6', 'hannah.griffin2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(268, 'Christian Diaz', '098f6bcd4621d373cade4e832627b4f6', 'christian.diaz2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(269, 'Aurora Hayes', '098f6bcd4621d373cade4e832627b4f6', 'aurora.hayes2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(270, 'Hunter Myers', '098f6bcd4621d373cade4e832627b4f6', 'hunter.myers2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(271, 'Layla Ford', '098f6bcd4621d373cade4e832627b4f6', 'layla.ford2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(272, 'Dylan Hamilton', '098f6bcd4621d373cade4e832627b4f6', 'dylan.hamilton2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(273, 'Paisley Graham', '098f6bcd4621d373cade4e832627b4f6', 'paisley.graham2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(274, 'Leo Sullivan', '098f6bcd4621d373cade4e832627b4f6', 'leo.sullivan2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(275, 'Penelope Wallace', '098f6bcd4621d373cade4e832627b4f6', 'penelope.wallace2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(276, 'Nathaniel West', '098f6bcd4621d373cade4e832627b4f6', 'nathaniel.west2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(277, 'Emilia Cole', '098f6bcd4621d373cade4e832627b4f6', 'emilia.cole2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(278, 'Aaron Jenkins', '098f6bcd4621d373cade4e832627b4f6', 'aaron.jenkins2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(279, 'Nora Howard', '098f6bcd4621d373cade4e832627b4f6', 'nora.howard2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(280, 'Christian Simmons', '098f6bcd4621d373cade4e832627b4f6', 'christian.simmons2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(281, 'Hazel Foster', '098f6bcd4621d373cade4e832627b4f6', 'hazel.foster2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(282, 'Lincoln Gonzales', '098f6bcd4621d373cade4e832627b4f6', 'lincoln.gonzales2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(283, 'Aurora Bryant', '098f6bcd4621d373cade4e832627b4f6', 'aurora.bryant3@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(284, 'Wyatt Alexander', '098f6bcd4621d373cade4e832627b4f6', 'wyatt.alexander3@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(285, 'Stella Russell', '098f6bcd4621d373cade4e832627b4f6', 'stella.russell3@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(286, 'Hunter Griffin', '098f6bcd4621d373cade4e832627b4f6', 'hunter.griffin2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(287, 'Emery Diaz', '098f6bcd4621d373cade4e832627b4f6', 'emery.diaz2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(288, 'Landon Hayes', '098f6bcd4621d373cade4e832627b4f6', 'landon.hayes2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(289, 'Addison Myers', '098f6bcd4621d373cade4e832627b4f6', 'addison.myers2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(290, 'Grayson Foster', '098f6bcd4621d373cade4e832627b4f6', 'grayson.foster2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(291, 'Aurora Simmons', '098f6bcd4621d373cade4e832627b4f6', 'aurora.simmons3@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(292, 'Eli Butler', '098f6bcd4621d373cade4e832627b4f6', 'eli.butler3@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(293, 'Scarlett Hayes', '098f6bcd4621d373cade4e832627b4f6', 'scarlett.hayes3@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(294, 'Josiah Foster', '098f6bcd4621d373cade4e832627b4f6', 'josiah.foster2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(295, 'Stella Gonzales', '098f6bcd4621d373cade4e832627b4f6', 'stella.gonzales3@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(296, 'Nathaniel Bryant', '098f6bcd4621d373cade4e832627b4f6', 'nathaniel.bryant2@example.com', 'User', 1, '2025-12-09 16:40:46', '2025-12-10 16:46:47', 'normal'),
(298, 'test', '098f6bcd4621d373cade4e832627b4f6', 'Test@gmail.com', 'User', 0, '2025-12-10 16:43:21', '2025-12-10 16:44:02', 'normal'),
(300, 'Siti Aisyah', 'password123', 'siti.aisyah@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'normal'),
(302, 'Nurul Huda', 'password123', 'nurul.huda@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'normal'),
(304, 'Aina Farhana', 'password123', 'aina.farhana@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'normal'),
(305, 'Hafiz Zainal', '098f6bcd4621d373cade4e832627b4f6', 'hafiz.zainal@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 14:08:40', 'super'),
(306, 'Farah Nabilah', 'password123', 'farah.nabilah@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'normal'),
(308, 'Liyana Azman', 'password123', 'liyana.azman@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'normal'),
(310, 'Shahirah Mazlan', 'password123', 'shahirah.mazlan@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'normal'),
(311, 'Faizal Hakim', 'password123', 'faizal.hakim@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'super'),
(312, 'Hana Syafiqah', 'password123', 'hana.syafiqah@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'normal'),
(313, 'Adrian Tan', 'password123', 'adrian.tan@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'super'),
(314, 'Melissa Ong', 'password123', 'melissa.ong@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'normal'),
(315, 'Daniel Lim', 'password123', 'daniel.lim@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'super'),
(316, 'Jasmine Lee', 'password123', 'jasmine.lee@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'normal'),
(317, 'Rizal Hakim', 'password123', 'rizal.hakim@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'super'),
(318, 'Aisyah Rahim', 'password123', 'aisyah.rahim@example.com', 'Admin', 1, '2025-12-15 11:45:17', '2025-12-15 11:53:49', 'normal'),
(319, 'One Utama 1', 'c4ca4238a0b923820dcc509a6f75849b', '1@gmail.com', 'Admin', 1, '2025-12-16 15:20:43', '2025-12-17 15:57:03', 'super'),
(320, 'One Utama 1', 'c4ca4238a0b923820dcc509a6f75849b', '2@gmail.com', 'User', 1, '2025-12-16 15:20:43', '2025-12-17 15:57:03', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `ua_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `is_default` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`ua_id`, `user_id`, `address`, `is_default`, `created_at`, `updated_at`) VALUES
(117, 40, 'No. 9, Tingkat 2, Blok C,\r\nPangsapuri Seri Wawasan,\r\n97000 Bintulu, Sarawak.', 1, '2025-12-09 09:01:12', '2025-12-09 09:36:36'),
(118, 40, 'No. 102, Jalan Kampung Telaga,\r\nKampung Tok Hakim,\r\n16150 Kota Bharu, Kelantan.', 0, '2025-12-09 09:01:26', '2025-12-09 09:36:36'),
(124, 40, 'Fort Emberwatch,\r\nBlazing Ridge Pass,\r\nBorderlands of Kaer’Thun,\r\nEmpire of Drakenfall', 0, '2025-12-09 09:15:04', '2025-12-09 09:15:16'),
(125, 40, 'Stall 19, Clockwork Market,\r\nGearhold Center,\r\nSteamforge City,\r\nFederation of Aethersteel', 0, '2025-12-09 09:15:16', '2025-12-09 09:20:15'),
(126, 40, 'Hunter’s Hut No. 12,\r\nWestern Outcrop Path,\r\nAncient Forest,\r\nAstera Region', 0, '2025-12-09 09:19:59', '2025-12-09 09:19:59'),
(128, 62, '123 Jalan Merpati, Taman Seri Indah, 43000 Kajang, Selangor, Malaysia', 1, '2025-12-10 17:42:40', '2025-12-10 17:42:40'),
(133, 320, 'AWSDADWDAWDAWDDDAWDAWDAWDAW', 1, '2025-12-17 15:49:59', '2025-12-17 15:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_data` longblob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`id`, `user_id`, `cart_data`, `created_at`) VALUES
(1, 900, 0x5b7b2270726f647563745f6964223a3130312c226e616d65223a224170706c65222c227175616e74697479223a332c227072696365223a322e357d2c7b2270726f647563745f6964223a3230322c226e616d65223a2242616e616e61222c227175616e74697479223a352c227072696365223a312e327d5d, '2025-11-24 06:07:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`phone_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`ua_id`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=560;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `phone`
--
ALTER TABLE `phone`
  MODIFY `phone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=628;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `ua_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
