-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 06:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afs`
--

-- --------------------------------------------------------

--
-- Table structure for table `appinfo`
--

CREATE TABLE `appinfo` (
  `id` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `gstno` varchar(17) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appuser`
--

CREATE TABLE `appuser` (
  `uid` varchar(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(2) DEFAULT NULL,
  `sign` varchar(100) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `is_logedin` varchar(1) DEFAULT NULL,
  `lastlogin_time` timestamp NULL DEFAULT NULL,
  `lastlogin_from` varchar(30) DEFAULT NULL,
  `userid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appuser`
--

INSERT INTO `appuser` (`uid`, `name`, `mobile`, `email`, `password`, `role`, `sign`, `status`, `is_logedin`, `lastlogin_time`, `lastlogin_from`, `userid`) VALUES
('520714052099007', 'Bhargab Chatterjee', '8240231376', 'bhargabiam@gmail.com', '123', '1', NULL, '1', '1', '2024-06-29 11:17:36', '192.168.0.101', 'bhargab'),
('548012159303000', 'Sumit Chatterjee', '9609423342', 'kustav@live.com', '123', '1', NULL, '0', NULL, NULL, NULL, 'kustav');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `date` date DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `name`, `amount`, `date`, `remarks`) VALUES
(1, 'Bhargab Chatterjee', '2323', '2024-11-17', ''),
(2, 'Sumit Chatterjee', '2323', '2024-11-17', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_gst_history`
--

CREATE TABLE `invoice_gst_history` (
  `id` bigint(20) NOT NULL,
  `entry_id` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `product` varchar(255) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `unit` varchar(10) NOT NULL,
  `gross_amount` float DEFAULT NULL,
  `total_ammount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_gst_history`
--

INSERT INTO `invoice_gst_history` (`id`, `entry_id`, `created_at`, `product`, `product_name`, `qty`, `unit`, `gross_amount`, `total_ammount`) VALUES
(44, 'INV_0001', '2024-10-10 12:24:43', 'SP_4', 'Queen Pineapples', 2, 'G', 445, 890),
(45, 'INV_0001', '2024-10-10 12:24:43', 'SP_3', 'Golden Delicious', 0.3, 'Kg', 454, 136.2),
(46, 'INV_0001', '2024-10-10 12:24:43', 'SP_2', 'Red Spanish Pineapples', 0.25, 'G', 3434, 858.5),
(47, 'INV_0002', '2024-10-10 12:38:38', 'SP_5', 'Kashmiri', 0.75, 'Kg', 343.9, 257.92),
(48, 'INV_0002', '2024-10-10 12:38:38', 'SP_4', 'Queen Pineapples', 3, 'G', 454, 1362),
(49, 'INV_0003', '2024-10-10 12:47:32', 'SP_4', 'Queen Pineapples', 3.25, 'G', 2500, 8125),
(50, 'INV_0004', '2024-10-10 13:01:47', 'SP_5', 'Kashmiri', 0.75, 'Kg', 2500, 1875),
(51, 'INV_0005', '2024-10-10 13:02:59', 'SP_5', 'Kashmiri', 2, 'Kg', 2500, 5000),
(52, 'INV_0006', '2024-10-10 13:04:47', 'SP_5', 'Kashmiri', 3, 'Kg', 2500, 7500),
(53, 'INV_0007', '2024-10-10 13:08:59', 'SP_5', 'Kashmiri', 1, 'Kg', 343.9, 343.9),
(54, 'INV_0008', '2024-10-19 07:34:11', 'SP_4', 'Queen Pineapples', 2, 'G', 445, 890),
(55, 'INV_0008', '2024-10-19 07:34:11', 'SP_3', 'Golden Delicious', 20, 'Kg', 400, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_gst_main`
--

CREATE TABLE `invoice_gst_main` (
  `id` varchar(20) NOT NULL,
  `invoice_no` varchar(30) DEFAULT NULL,
  `c_id` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `c_mobile` varchar(15) DEFAULT NULL,
  `c_address` varchar(50) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `delivery_note` varchar(50) DEFAULT NULL,
  `mode_pay` varchar(20) DEFAULT NULL,
  `despatched_throug` varchar(50) DEFAULT NULL,
  `destination` varchar(50) DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `word` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `uid` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_gst_main`
--

INSERT INTO `invoice_gst_main` (`id`, `invoice_no`, `c_id`, `name`, `c_mobile`, `c_address`, `invoice_date`, `delivery_note`, `mode_pay`, `despatched_throug`, `destination`, `total_amount`, `word`, `created_at`, `uid`) VALUES
('INV_0004', 'INV_0004', 'SD_1', 'Bhargab Chatterjee', '8240231376', 'BALLAVBATI', '2024-10-10', '', 'Cash', '', '', 1875, 'One thousand Eight hundred Seventy Five', '2024-10-10 13:01:47', '520714052099007'),
('INV_0005', 'INV_0005', 'SD_1', 'Bhargab Chatterjee', '8240231376', 'BALLAVBATI', '2024-10-10', '', 'Cash', '', '', 5000, 'Five thousand', '2024-10-10 13:02:59', '520714052099007'),
('INV_0007', 'INV_0007', 'SD_1', 'Bhargab Chatterjee', '8240231376', 'BALLAVBATI', '2024-10-10', '', 'Cash', '', '', 343.9, 'Three hundred Forty Three Rupees Ninety Paise ', '2024-10-10 13:08:59', '520714052099007'),
('INV_0008', 'INV_0008', 'SD_1', 'Bhargab Chatterjee', '8240231376', 'BALLAVBATI', '2024-10-19', '', 'Cash', '', '', 8890, 'Eight thousand Eight hundred Ninety Rupees Zero Paise ', '2024-10-19 07:34:11', '520714052099007');

-- --------------------------------------------------------

--
-- Table structure for table `leadger_sc`
--

CREATE TABLE `leadger_sc` (
  `id` bigint(20) NOT NULL,
  `scid` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `current_amomount` float DEFAULT NULL,
  `truns_ammount` float DEFAULT NULL,
  `mode` varchar(10) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `refno` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leadger_sc`
--

INSERT INTO `leadger_sc` (`id`, `scid`, `date`, `type`, `current_amomount`, `truns_ammount`, `mode`, `remarks`, `refno`, `created_at`, `created_by`) VALUES
(2, 'SC_1', '2024-08-03', 'due', 234, 23, 'None', NULL, 'SE_202426', '2024-08-03 10:49:03', '520714052099007'),
(3, 'SC_1', '2024-08-09', 'due', 257, 2322, 'None', NULL, 'SE_202427', '2024-08-03 10:49:52', '520714052099007'),
(4, 'SC_1', '2024-08-09', 'due', 2579, 2500, 'None', NULL, 'SE_202428', '2024-08-03 11:22:24', '520714052099007'),
(5, 'SC_1', '2024-08-02', 'due', 5079, 346, 'None', NULL, 'SE_202429', '2024-08-03 11:26:41', '520714052099007'),
(6, 'SC_1', '2024-08-02', 'due', 5425, 232, 'None', NULL, 'SE_202430', '2024-08-03 11:27:31', '520714052099007'),
(7, 'SC_1', '2024-08-02', 'due', 5657, 3, 'None', NULL, 'SE_202431', '2024-08-03 11:28:07', '520714052099007'),
(8, 'SC_1', '2024-08-03', 'due', 5660, 3434, 'None', NULL, 'SE_202432', '2024-08-03 11:29:37', '520714052099007'),
(9, 'SC_1', '2024-08-09', 'due', 9094, 3434, 'None', NULL, 'SE_202433', '2024-08-03 11:32:32', '520714052099007'),
(10, 'SC_1', '2024-08-02', 'due', 12528, 232, 'None', 'sdase3434', 'SE_202434', '2024-08-03 11:34:30', '520714052099007'),
(11, 'SC_1', '2024-08-03', 'Pay', 12760, 2000, 'cash', 'test', 'SCP_2', '2024-08-04 03:17:16', '520714052099007'),
(12, 'SC_1', '2024-08-02', 'Pay', 8760, 2000, 'upi', 'new test', 'SCP_3', '2024-08-04 03:28:39', '520714052099007'),
(13, 'SC_1', '2024-08-05', 'Pay', 8758, 2, 'upi', 'test', 'SCP_4', '2024-08-04 03:31:04', '520714052099007'),
(14, 'SC_1', '2024-08-02', 'Pay', 8558, 200, 'cheque', 'test', 'SCP_5', '2024-08-04 04:45:36', '520714052099007'),
(15, 'SC_1', '2024-08-19', 'Pay', 7358, 1200, 'cash', 'new test', 'SCP_6', '2024-08-25 04:11:56', '520714052099007'),
(16, 'SC_1', '2024-08-25', 'due', 7358, 2000, 'None', '84556465465465465', 'SE_202435', '2024-08-25 05:10:36', '520714052099007'),
(17, 'SC_1', '2024-08-25', 'Pay', 7358, 2000, 'upi', 'new test', 'SCP_7', '2024-08-25 05:11:51', '520714052099007'),
(18, 'SC_1', '2024-10-13', 'due', 7358, 2300, 'None', 'sdase3434', 'SE_20241', '2024-10-13 14:37:32', '520714052099007'),
(19, 'SC_1', '2024-11-16', 'Pay', 9426, 232, 'upi', 'test', 'SCP_8', '2024-11-16 18:02:00', '520714052099007');

-- --------------------------------------------------------

--
-- Table structure for table `leadger_sd`
--

CREATE TABLE `leadger_sd` (
  `id` bigint(20) NOT NULL,
  `sdid` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `current_amomount` float DEFAULT NULL,
  `truns_ammount` float DEFAULT NULL,
  `mode` varchar(10) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `refno` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leadger_sd`
--

INSERT INTO `leadger_sd` (`id`, `sdid`, `date`, `type`, `current_amomount`, `truns_ammount`, `mode`, `remarks`, `refno`, `created_at`, `created_by`) VALUES
(42, 'SD_1', '2024-10-10', 'Invoice', 1875, 1875, 'Cash', 'INV_0004', 'INV_0004', '2024-10-10 13:01:47', '520714052099007'),
(43, 'SD_1', '2024-10-10', 'Invoice', 6875, 5000, 'Cash', 'INV_0005', 'INV_0005', '2024-10-10 13:02:59', '520714052099007'),
(44, 'SD_1', '2024-10-10', 'Invoice', 14375, 7500, 'Cash', 'INV_0006', 'INV_0006', '2024-10-10 13:04:47', '520714052099007'),
(45, 'SD_1', '2024-10-10', 'Invoice Delete', 6875, 7500, 'Delete', 'Invoice Delete', 'INV_0006', '2024-10-10 13:05:49', '520714052099007'),
(46, 'SD_1', '2024-10-10', 'Invoice', 7218.9, 343.9, 'Cash', 'INV_0007', 'INV_0007', '2024-10-10 13:08:59', '520714052099007'),
(47, 'SD_1', '2024-10-13', 'Pay', 7000.9, 218, 'cash', 'new test', 'SDP_1', '2024-10-13 04:24:01', '520714052099007'),
(48, 'SD_1', '2024-10-19', 'Invoice', 15891, 8890, 'Cash', 'INV_0008', 'INV_0008', '2024-10-19 07:34:11', '520714052099007'),
(49, 'SD_1', '2024-11-16', 'Invoice', 25646, 9755, 'Online', 'INV_0009', 'INV_0009', '2024-11-16 18:18:15', '520714052099007'),
(50, 'SD_1', '2024-11-16', 'Invoice Delete', 15891, 9755, 'Delete', 'Invoice Delete', 'INV_0009', '2024-11-16 18:19:05', '520714052099007');

-- --------------------------------------------------------

--
-- Table structure for table `product_delivary_main`
--

CREATE TABLE `product_delivary_main` (
  `id` varchar(20) NOT NULL,
  `chalan_no` varchar(50) DEFAULT NULL,
  `to` varchar(20) DEFAULT NULL,
  `delivary_date` date DEFAULT NULL,
  `delivary_mode` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `total_amount` float DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `uid` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_delivery_history`
--

CREATE TABLE `product_delivery_history` (
  `id` varchar(20) NOT NULL,
  `entry_id` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `product` varchar(10) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_entry_history`
--

CREATE TABLE `product_entry_history` (
  `id` int(11) NOT NULL,
  `entry_id` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `product` varchar(20) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_entry_history`
--

INSERT INTO `product_entry_history` (`id`, `entry_id`, `created_at`, `product`, `qty`, `amount`, `remarks`) VALUES
(87, 'SE_202425', '2024-08-03 09:48:04', 'SP_2', 2, 23, 'By default'),
(88, 'SE_202425', '2024-08-03 09:48:05', 'SP_3', 23, 232, 'By default'),
(89, 'SE_202426', '2024-08-03 10:49:02', 'SP_4', 23, 23, 'By default'),
(90, 'SE_202427', '2024-08-03 10:49:51', 'SP_3', 2, 323, 'By default'),
(91, 'SE_202428', '2024-08-03 11:22:24', 'SP_4', 8, 858, 'By default'),
(92, 'SE_202429', '2024-08-03 11:26:41', 'SP_3', 3, 334, 'By default'),
(93, 'SE_202430', '2024-08-03 11:27:31', 'SP_4', 23, 23, 'By default'),
(94, 'SE_202431', '2024-08-03 11:28:07', 'SP_4', 3, 3, 'By default'),
(95, 'SE_202432', '2024-08-03 11:29:36', 'SP_4', 3, 34, 'By default'),
(96, 'SE_202433', '2024-08-03 11:32:31', 'SP_4', 3, 344, 'By default'),
(97, 'SE_202434', '2024-08-03 11:34:29', 'SP_4', 2, 23, 'By default'),
(98, 'SE_202435', '2024-08-25 05:10:35', 'SP_5', 25, 250, 'By default'),
(99, 'SE_20241', '2024-10-13 14:37:32', 'SP_4', 20, 445, 'By default'),
(100, 'SE_20241', '2024-10-13 14:37:32', 'SP_3', 34, 0, 'By default');

-- --------------------------------------------------------

--
-- Table structure for table `product_entry_main`
--

CREATE TABLE `product_entry_main` (
  `id` varchar(20) NOT NULL,
  `chalan_no` varchar(255) DEFAULT NULL,
  `from` varchar(20) DEFAULT NULL,
  `recived_date` date DEFAULT NULL,
  `delivary_mode` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `total_amount` float DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `uid` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_entry_main`
--

INSERT INTO `product_entry_main` (`id`, `chalan_no`, `from`, `recived_date`, `delivary_mode`, `created_at`, `total_amount`, `remarks`, `uid`) VALUES
('SE_20241', 'sdase3434', 'SC_1', '2024-10-13', 'By default', '2024-10-13 14:37:32', 2300, 'By default', '520714052099007'),
('SE_202425', 'sdase3434', 'SC_1', '2024-08-03', 'By default', '2024-08-03 09:48:04', 234, 'By default', '520714052099007'),
('SE_202426', 'sdase3434', 'SC_1', '2024-08-03', 'By default', '2024-08-03 10:49:02', 23, 'By default', '520714052099007'),
('SE_202427', 'sdase3434', 'SC_1', '2024-08-09', 'By default', '2024-08-03 10:49:51', 2322, 'By default', '520714052099007'),
('SE_202428', 'sdase3434', 'SC_1', '2024-08-09', 'By default', '2024-08-03 11:22:24', 2500, 'By default', '520714052099007'),
('SE_202429', 'sdase3434', 'SC_1', '2024-08-02', 'By default', '2024-08-03 11:26:41', 346, 'By default', '520714052099007'),
('SE_202430', 'sdase3434', 'SC_1', '2024-08-02', 'By default', '2024-08-03 11:27:31', 232, 'By default', '520714052099007'),
('SE_202431', 'wwewe3', 'SC_1', '2024-08-02', 'By default', '2024-08-03 11:28:07', 3, 'By default', '520714052099007'),
('SE_202432', 'sdase3434', 'SC_1', '2024-08-03', 'By default', '2024-08-03 11:29:36', 3434, 'By default', '520714052099007'),
('SE_202433', 'sdase3434', 'SC_1', '2024-08-09', 'By default', '2024-08-03 11:32:31', 3434, 'By default', '520714052099007'),
('SE_202434', 'sdase3434', 'SC_1', '2024-08-02', 'By default', '2024-08-03 11:34:29', 232, 'By default', '520714052099007'),
('SE_202435', '84556465465465465', 'SC_1', '2024-08-25', 'By default', '2024-08-25 05:10:35', 2000, 'By default', '520714052099007');

-- --------------------------------------------------------

--
-- Table structure for table `product_main`
--

CREATE TABLE `product_main` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `unit` varchar(255) DEFAULT NULL,
  `current_stock` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_main`
--

INSERT INTO `product_main` (`id`, `name`, `created_at`, `unit`, `current_stock`, `status`) VALUES
('pro_1', 'Apple', '2024-07-13 05:01:14', 'Kg', 0, 1),
('PRO_10', 'Kiwi', '2024-07-14 05:27:46', 'PC', 0, 1),
('PRO_11', 'Pineapple', '2024-07-14 05:28:28', 'G', 0, 1),
('PRO_12', 'Strawberry', '2024-07-14 05:28:48', 'G', 0, 1),
('PRO_13', 'Avocado', '2024-07-14 05:29:06', 'PC', 0, 1),
('PRO_14', 'Oranges', '2024-07-14 05:29:24', 'PC', 0, 1),
('PRO_15', ' Lemon', '2024-07-14 09:03:21', 'PC', 0, 1),
('PRO_16', 'test', '2024-08-25 05:07:45', 'G', 0, 1),
('PRO_2', 'Alu', '2024-07-14 04:11:17', 'Kg', 0, 1),
('PRO_3', 'Banana', '2024-07-14 05:19:34', 'PC', 0, 1),
('PRO_4', ' Mango', '2024-07-14 05:22:56', 'KG', 0, 1),
('PRO_5', 'Blueberry', '2024-07-14 05:25:16', 'KG', 0, 1),
('PRO_6', ' Watermelon', '2024-07-14 05:26:09', 'PC', 0, 1),
('PRO_7', 'Apricot', '2024-07-14 05:26:58', 'KG', 0, 1),
('PRO_8', 'Cherry', '2024-07-14 05:27:15', 'KG', 0, 1),
('PRO_9', ' Grape', '2024-07-14 05:27:29', 'KG', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_sub`
--

CREATE TABLE `product_sub` (
  `id` varchar(20) NOT NULL,
  `main_prod` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `current_stock` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sub`
--

INSERT INTO `product_sub` (`id`, `main_prod`, `name`, `created_at`, `current_stock`, `status`) VALUES
('SP_2', 'PRO_11', 'Red Spanish Pineapples', '2024-07-21 04:19:35', 2, 1),
('SP_3', 'pro_1', 'Golden Delicious', '2024-07-21 04:20:38', 42, 1),
('SP_4', 'PRO_11', 'Queen Pineapples', '2024-07-21 04:47:03', 84, 1),
('SP_5', 'pro_1', 'Kashmiri', '2024-08-25 05:08:55', 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scentity`
--

CREATE TABLE `scentity` (
  `id` varchar(20) NOT NULL,
  `merchant_name` varchar(30) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL,
  `due_ammount` float DEFAULT NULL,
  `gst` varchar(255) DEFAULT NULL,
  `uid` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scentity`
--

INSERT INTO `scentity` (`id`, `merchant_name`, `mobile`, `email`, `address`, `created_at`, `status`, `due_ammount`, `gst`, `uid`) VALUES
('SC_1', 'Sumit Chatterjee', '9609423342', 'kustav@live.com', 'Munshirhut', '2024-07-14 12:49:16', 1, 9426, 'asassssssssssss', '520714052099007');

-- --------------------------------------------------------

--
-- Table structure for table `sc_payment_entry`
--

CREATE TABLE `sc_payment_entry` (
  `id` varchar(20) NOT NULL,
  `scid` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `mode` varchar(10) DEFAULT NULL,
  `hisamount` float DEFAULT NULL,
  `curamount` float DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `uid` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sc_payment_entry`
--

INSERT INTO `sc_payment_entry` (`id`, `scid`, `created_at`, `amount`, `mode`, `hisamount`, `curamount`, `remarks`, `uid`) VALUES
('SCP_2', 'SC_1', '2024-08-03 00:00:00', 2000, 'cash', 12760, 10760, 'test', '520714052099007'),
('SCP_3', 'SC_1', '2024-08-02 00:00:00', 2000, 'upi', 10760, 8760, 'new test', '520714052099007'),
('SCP_4', 'SC_1', '2024-08-05 00:00:00', 2, 'upi', 8760, 8758, 'test', '520714052099007'),
('SCP_5', 'SC_1', '2024-08-02 00:00:00', 200, 'cheque', 8758, 8558, 'test', '520714052099007'),
('SCP_6', 'SC_1', '2024-08-19 00:00:00', 1200, 'cash', 8558, 7358, 'new test', '520714052099007'),
('SCP_7', 'SC_1', '2024-08-25 00:00:00', 2000, 'upi', 9358, 7358, 'new test', '520714052099007'),
('SCP_8', 'SC_1', '2024-11-15 18:30:00', 232, 'upi', 9658, 9426, 'test', '520714052099007');

-- --------------------------------------------------------

--
-- Table structure for table `sdentity`
--

CREATE TABLE `sdentity` (
  `id` varchar(20) NOT NULL,
  `merchant_name` varchar(30) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL,
  `due_ammount` float DEFAULT NULL,
  `gst` varchar(17) DEFAULT NULL,
  `uid` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sdentity`
--

INSERT INTO `sdentity` (`id`, `merchant_name`, `mobile`, `email`, `address`, `created_at`, `status`, `due_ammount`, `gst`, `uid`) VALUES
('SD_1', 'Bhargab Chatterjee', '8240231376', 'bhargabiam@gmail.com', 'BALLAVBATI', '2024-07-14 11:34:26', 1, 15891, 'hdfgdfgdfgdfgdf', '520714052099007');

-- --------------------------------------------------------

--
-- Table structure for table `sd_payment_entry`
--

CREATE TABLE `sd_payment_entry` (
  `id` varchar(20) NOT NULL,
  `sdid` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `mode` varchar(10) DEFAULT NULL,
  `hisamount` float DEFAULT NULL,
  `curamount` float DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `uid` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sd_payment_entry`
--

INSERT INTO `sd_payment_entry` (`id`, `sdid`, `created_at`, `amount`, `mode`, `hisamount`, `curamount`, `remarks`, `uid`) VALUES
('SDP_1', 'SD_1', '2024-10-13 00:00:00', 218, 'cash', 7218.9, 7000.9, 'new test', '520714052099007');

-- --------------------------------------------------------

--
-- Table structure for table `secuence`
--

CREATE TABLE `secuence` (
  `id` varchar(20) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `head` varchar(20) DEFAULT NULL,
  `sno` varchar(20) DEFAULT NULL,
  `remarks` varchar(40) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secuence`
--

INSERT INTO `secuence` (`id`, `type`, `head`, `sno`, `remarks`, `status`, `created_at`) VALUES
('1', 'product', 'PRO_', '16', 'For Product', 1, '2024-07-13 16:38:58'),
('2', 'sd', 'SD_', '1', 'For Sd', 1, '2024-07-14 11:20:50'),
('3', 'sc', 'SC_', '1', 'For SC', 1, '2024-07-14 12:46:25'),
('4', 'subpro', 'SP_', '5', 'For Sub Product', 1, '2024-07-21 14:49:16'),
('5', 's_entry', 'SE_2024', '1', 'For Stock Entry', 0, '2024-07-28 12:18:09'),
('6', 'sc_payment', 'SCP_', '8', 'For Sc Payment', 1, '2024-08-03 13:09:44'),
('7', 'p_delivery', 'PD_', '0', 'Product Delivary', 1, '2024-08-18 04:06:21'),
('8', 'invoice', 'INV_', '9', 'Invoice', 1, '2024-08-18 04:07:11'),
('9', 'sd_payment', 'SDP_', '1', 'For Sd Payment', 1, '2024-10-13 04:11:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appuser`
--
ALTER TABLE `appuser`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_gst_history`
--
ALTER TABLE `invoice_gst_history`
  ADD PRIMARY KEY (`id`,`entry_id`),
  ADD KEY `entry_id` (`entry_id`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `invoice_gst_main`
--
ALTER TABLE `invoice_gst_main`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `to` (`c_id`);

--
-- Indexes for table `leadger_sc`
--
ALTER TABLE `leadger_sc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created by` (`created_by`),
  ADD KEY `scid` (`scid`);

--
-- Indexes for table `leadger_sd`
--
ALTER TABLE `leadger_sd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created by` (`created_by`),
  ADD KEY `sdid` (`sdid`);

--
-- Indexes for table `product_delivary_main`
--
ALTER TABLE `product_delivary_main`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `to` (`to`);

--
-- Indexes for table `product_delivery_history`
--
ALTER TABLE `product_delivery_history`
  ADD PRIMARY KEY (`id`,`entry_id`),
  ADD KEY `entry_id` (`entry_id`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `product_entry_history`
--
ALTER TABLE `product_entry_history`
  ADD PRIMARY KEY (`id`,`entry_id`),
  ADD KEY `entry_id` (`entry_id`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `product_entry_main`
--
ALTER TABLE `product_entry_main`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `from` (`from`);

--
-- Indexes for table `product_main`
--
ALTER TABLE `product_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sub`
--
ALTER TABLE `product_sub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_prod` (`main_prod`);

--
-- Indexes for table `scentity`
--
ALTER TABLE `scentity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `sc_payment_entry`
--
ALTER TABLE `sc_payment_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `scid` (`scid`);

--
-- Indexes for table `sdentity`
--
ALTER TABLE `sdentity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `sd_payment_entry`
--
ALTER TABLE `sd_payment_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `sdid` (`sdid`);

--
-- Indexes for table `secuence`
--
ALTER TABLE `secuence`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_gst_history`
--
ALTER TABLE `invoice_gst_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `leadger_sc`
--
ALTER TABLE `leadger_sc`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `leadger_sd`
--
ALTER TABLE `leadger_sd`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `product_entry_history`
--
ALTER TABLE `product_entry_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
