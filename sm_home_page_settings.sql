-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2022 at 04:45 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pylearni_guru`
--

-- --------------------------------------------------------

--
-- Table structure for table `sm_home_page_settings`
--

DROP TABLE IF EXISTS `sm_home_page_settings`;
CREATE TABLE `sm_home_page_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_code` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sm_home_page_settings`
--

INSERT INTO `sm_home_page_settings` (`id`, `school_code`, `title`, `long_title`, `short_description`, `link_label`, `link_url`, `image`, `created_at`, `updated_at`) VALUES
(1, '', 'The Gurutech', 'Gurutech', 'Managing various administrative tasks in one place is now quite easy and time savior with this ERP and Give your valued time to your institute that will increase next generation productivity for our society.', NULL, NULL, 'public/uploads/homepage/42c34c6bfea8c3b67696f8ad8c4028e1.jpg', '2021-12-08 09:41:07', '2021-12-14 09:07:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sm_home_page_settings`
--
ALTER TABLE `sm_home_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sm_home_page_settings`
--
ALTER TABLE `sm_home_page_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
