-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 10:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laptop`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `image_url` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `brand`, `model`, `price`, `image_url`) VALUES
(22, 'Acer', 'Nitro 5 (2022) AN515', 54331, 'img/6416e9b1ccbfd.png'),
(23, 'HP', 'OMEN 16-C0167AX', 67867, 'img/6417b72c34709.png'),
(24, 'Asus', 'Tuf F15 FX5', 61995, 'img/tuf.png'),
(50, 'Acer', 'Aspire 5 A514-54-50LX', 30990, 'img/Aspire 5 A514-54-50LX.png'),
(51, 'Acer', 'Aspire 5 A514-55-36NK', 28490, 'img/Aspire 5 A514-55-36NK.png'),
(52, 'HP', 'Pavilion 15-Ec1500Ax', 44990, 'img/Pavilion 15-Ec1500Ax.png'),
(53, 'Gigabyte', 'G7 MD Gaming', 46990, 'img/G7 MD Gaming.png'),
(54, 'Lenovo', 'Ideapad Slim 3i 15', 46990, 'img/Ideapad Slim 3i 15.png'),
(55, 'Acer', 'Predator Helios 300', 84999, 'img/Predator Helios 300.png'),
(56, 'Lenovo', 'Thinkpad T16 Gen 1', 53996, 'img/T16 Gen 1.png'),
(75, 'Lenovo', 'Legion 5 15 GEN7', 77995, 'img/6416e84bb6b32.png'),
(76, 'Lenovo', 'Legion 5 Qi', 63999, 'img/6416e8c581b7f.png'),
(77, 'MSI', 'GF63 Thin 11UC', 64995, 'img/6416ea8d81735.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
