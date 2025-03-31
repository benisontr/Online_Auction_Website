-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2021 at 10:15 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `role` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `role`, `password`, `created_at`) VALUES
(1, 'admin', 'manu', 'admin', '$2y$10$YJjQMwYLBWkEPgJu0xS8quNHFU5uCmBkFJsvsX5cF4U2gp1SsmNGe', '2021-09-10 04:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
  `id` int NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `start_time` varchar(20) NOT NULL,
  `end_time` varchar(20) NOT NULL,
  `location` int NOT NULL,
  `category` int NOT NULL,
  `sub_category` int NOT NULL,
  `price` varchar(10) NOT NULL,
  `email` varchar(150) NOT NULL,
  `image_1` varchar(150) DEFAULT NULL,
  `image_2` varchar(150) DEFAULT NULL,
  `image_3` varchar(150) DEFAULT NULL,
  `image_4` varchar(150) DEFAULT NULL,
  `image_5` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`id`, `title`, `description`, `date`, `start_time`, `end_time`, `location`, `category`, `sub_category`, `price`, `email`, `image_1`, `image_2`, `image_3`, `image_4`, `image_5`) VALUES

(11, 'test auction', 'asaa', '2024-05-04 15:37:06', '9:00', '12.00', 4, 2, 1, '10000', 'manu@gmail.com', 'b8ec2c83bb655fb8defcbd2d1af7bc36.png', 'd9232256fb9ffbbeb241abf5ed8f04cb.png', '74719b99c907e830931fc330f3ee5dbf.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int NOT NULL,
  `amount` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `auction` int NOT NULL,
  `bidder` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `amount`, `time`, `auction`, `bidder`) VALUES
(1, '100', '2019-05-31 07:09:49', 8, 'johndoe@email.com'),
(2, '100', '2019-05-31 07:09:49', 8, 'johndoe@email.com'),
(3, '100', '2019-05-31 07:09:49', 8, 'johndoe@email.com'),
(4, '100', '2019-05-31 07:09:49', 8, 'johndoe@email.com'),
(5, '100', '2019-05-31 07:09:49', 8, 'johndoe@email.com'),
(6, '100', '2019-05-31 07:09:49', 8, 'johndoe@email.com'),
(7, '100', '2019-05-31 07:09:49', 8, 'johndoe@email.com'),
(8, '100', '2019-05-31 07:09:49', 8, 'johndoe@email.com'),
(9, '100', '2019-05-31 07:09:49', 8, 'johndoe@email.com'),
(10, '100', '2019-05-31 07:09:49', 8, 'johndoe@email.com'),
(11, '100', '2019-05-31 07:09:49', 8, 'johndoe@email.com'),
(12, '', '2019-05-31 07:09:49', 1, 'johndoe@email.com'),
(13, '4000', '2019-05-31 07:09:49', 1, 'johndoe@email.com'),
(14, '5000', '2019-05-31 10:27:46', 9, 'thanos@titan.com'),
(15, '5010', '2019-05-31 10:40:34', 9, 'thanos@titan.com'),
(16, '8000', '2019-05-31 10:40:39', 9, 'thanos@titan.com'),
(17, '1000', '2019-05-31 10:40:45', 9, 'thanos@titan.com'),
(18, '20000', '2021-09-12 05:03:22', 16, 'injamul.haque6@gmail.com'),
(19, '2001', '2021-09-12 05:03:34', 16, 'injamul.haque6@gmail.com'),
(20, '22000', '2021-09-12 05:03:45', 16, 'injamul.haque6@gmail.com'),
(21, '30000', '2021-09-12 05:03:57', 16, 'injamul.haque6@gmail.com'),
(22, '2000', '2021-10-11 10:54:10', 17, 'injamul.haque6@gmail.com'),
(23, '30000', '2021-10-11 10:54:22', 17, 'injamul.haque6@gmail.com'),
(24, '40000', '2021-10-11 10:54:59', 17, 'injamul.haque6@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Land'),
(2, 'Real Estate');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, 'Zoo Road tinial'),
(2, 'Bhangagarh'),
(3, 'somewhere'),
(4, 'wawfqd'),
(5, 'Guwahati'),
(8, 'Guwahati'),
(9, 'Guwahati'),
(10, 'Guwahati'),
(11, 'Guwahati'),
(12, 'Kacharua');

-- --------------------------------------------------------

--
-- Table structure for table `personal_details`
--

CREATE TABLE `personal_details` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `street` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `alt_phone` varchar(15) NOT NULL,
  `zip_code` int NOT NULL,
  `image` varchar(256) DEFAULT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal_details`
--

INSERT INTO `personal_details` (`id`, `name`, `street`, `phone`, `alt_phone`, `zip_code`, `image`, `email`) VALUES
(1, 'John', 'Calicut', '9876543210', '', 781008, NULL, 'johndoe@email.com');


-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `category` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `category`) VALUES
(1, 'Housing', 2),
(2, 'Apartment', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(256) NOT NULL,
  `last_password` varchar(256) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `last_password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'johndoe@email.com', '$2y$10$.i226sSokscR9.aEZmrqaurUbt0z15AOeT3scjH2YSkhHc.GEpK5C', '$2y$10$Ir.WzMobGownI8t0DktBiu8eGl0ewsvwkfpOlt6B5uWe9FqQV1KN.', 'active', '2019-05-31 07:11:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `winner`
--

CREATE TABLE `winner` (
  `id` int NOT NULL,
  `auction` int NOT NULL,
  `bid` int NOT NULL,
  `winner` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `winner`
--

INSERT INTO `winner` (`id`, `auction`, `bid`, `winner`) VALUES
(1, 9, 16, 'thanos@titan.com'),
(2, 9, 16, 'thanos@titan.com'),
(3, 9, 16, 'thanos@titan.com'),
(4, 9, 16, 'thanos@titan.com'),
(5, 9, 16, 'thanos@titan.com'),
(6, 9, 16, 'thanos@titan.com'),
(7, 9, 16, 'thanos@titan.com'),
(8, 9, 16, 'thanos@titan.com'),
(9, 9, 16, 'thanos@titan.com'),
(10, 9, 16, 'thanos@titan.com'),
(11, 9, 16, 'thanos@titan.com'),
(12, 9, 16, 'thanos@titan.com'),
(13, 9, 16, 'thanos@titan.com'),
(14, 9, 16, 'thanos@titan.com'),
(15, 9, 16, 'thanos@titan.com'),
(16, 9, 16, 'thanos@titan.com'),
(17, 9, 16, 'thanos@titan.com'),
(18, 9, 16, 'thanos@titan.com'),
(19, 9, 16, 'thanos@titan.com'),
(20, 9, 16, 'thanos@titan.com'),
(21, 9, 16, 'thanos@titan.com'),
(22, 9, 16, 'thanos@titan.com'),
(23, 9, 16, 'thanos@titan.com'),
(24, 9, 16, 'thanos@titan.com'),
(25, 9, 16, 'thanos@titan.com'),
(26, 9, 16, 'thanos@titan.com'),
(27, 9, 16, 'thanos@titan.com'),
(28, 9, 16, 'thanos@titan.com'),
(29, 16, 21, 'injamul.haque6@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `winner`
--
ALTER TABLE `winner`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_details`
--
ALTER TABLE `personal_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `winner`
--
ALTER TABLE `winner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
