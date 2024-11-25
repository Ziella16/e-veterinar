-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 04:34 PM
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
-- Database: `my_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `pet_age` int(3) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `contact`, `pet_age`, `created_at`) VALUES
(2, 'asd', 'saya@gmail.com', '$2y$10$C.UXtb6lcAaKZz9Ssf9j7OOoxlkBGBUIC1E5r47ZbtuGcmZpBsJrK', '123456', 0, '2024-11-19 17:59:22'),
(4, '', 'aa@gmail.com', '$2y$10$pveAg5Iqr9wZHr4Fzgygduz96F7JnbprPyyfXKB8Qr2HMUJg2.Uey', '123456', 0, '2024-11-19 18:51:26'),
(5, 'abc', 'abc@gmail.com', '$2y$10$5CGkwXi2LQzX/UVH5NgPWuFxRn1WvNZx38obmp4nReyr9sGgbJC1C', '123', 0, '2024-11-19 18:57:00'),
(6, 'qwe', 'qwe@example.com', '$2y$10$nhbfnjxPIWhXvHCaFpZtre4NXlUl0mc0cC83NoSPYDOJts8yu0QAC', '123', 0, '2024-11-21 22:01:15'),
(7, 'ahmad', 'ahmad@gmail.com', 'ahmad', '123456', 0, '2024-11-22 02:13:44'),
(8, 'al', 'al@example.com', '$2y$10$f4DIa4jG000rQRQkWhncXO5NNv7IY.zFPfrFZMEs1KuZrElGu2fYi', '123', 0, '2024-11-22 03:22:13'),
(9, 'zikri', 'zikri@gmail.com', '$2y$10$o9ncgxLiSJlpeKI9mIX7R.C4B1LoTjtwHUflr5jeVmX0FQGH05sLG', '123456123', 0, '2024-11-22 03:35:12'),
(10, 'zikri', '', '$2y$10$02QTbG7UbMm0ytKB9B2I...43nElf//IC9t7csXl4c1L6ylEKFpJm', '', NULL, '2024-11-22 03:35:12'),
(15, 'syafiq', 'syafiq@example.com', '$2y$10$vvetHyKvVm7nx.WXUbZHKuEUbdOBT2hZfbKYc4md.eD46uUhS9GT.', '123456', 0, '2024-11-22 06:51:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
