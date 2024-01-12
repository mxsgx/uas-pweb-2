-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 12, 2024 at 04:27 AM
-- Server version: 5.7.44
-- PHP Version: 8.2.14

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4741_uas`
--
CREATE DATABASE IF NOT EXISTS `4741_uas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `4741_uas`;

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `nama`) VALUES
(1, 'Perancangan Web I'),
(2, 'Perancangan Web II'),
(3, 'Perancangan Web III'),
(4, 'Pendidikan Pancasila'),
(5, 'Pendidikan Agama'),
(6, 'Bahasa Indonesia'),
(7, 'Algoritma dan Pemrograman'),
(9, 'Metode Penelitian');

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`id`, `nama`) VALUES
(1, 'D3 Teknik Informatika'),
(2, 'D3 Manajemen Informatika'),
(3, 'S1 Informatika'),
(4, 'S1 Sistem Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `rps`
--

CREATE TABLE `rps` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `sks` int(11) NOT NULL,
  `dokumen` text,
  `mata_kuliah_id` int(11) DEFAULT NULL,
  `program_studi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rps`
--

INSERT INTO `rps` (`id`, `kode`, `sks`, `dokumen`, `mata_kuliah_id`, `program_studi_id`) VALUES
(1, 'DT170', 4, 'dt170.pdf', 2, 1),
(2, 'DT171', 4, 'dt171.pdf', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `role`) VALUES
(1, 'Masga', 'masga@gmail.com', '$2y$10$D9jCmxOOBWKtn2ok5CGeveZr1/iwi36oCLR5Nj/bxIe04hNzU5COe', 'admin'),
(7, 'Satria', 'satria@gmail.com', '$2y$10$boZSao10BygB/Yeb0/4aDOro5qafT0Pw3KNuZJ/FdM1wm10u3QNDS', 'admin'),
(8, 'Wirawan', 'wirawan@gmail.com', '$2y$10$.0kPOySBAjsFs0CJYc6la./W5iVl8KFQMOi5zLgEdkH9SjZz0BZd.', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rps`
--
ALTER TABLE `rps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_unique` (`kode`),
  ADD KEY `rps_mata_kuliah` (`mata_kuliah_id`),
  ADD KEY `rps_program_studi` (`program_studi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rps`
--
ALTER TABLE `rps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rps`
--
ALTER TABLE `rps`
  ADD CONSTRAINT `rps_mata_kuliah` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliah` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `rps_program_studi` FOREIGN KEY (`program_studi_id`) REFERENCES `program_studi` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
