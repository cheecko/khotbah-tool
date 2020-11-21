-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 08:03 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ficg`
--

-- --------------------------------------------------------

--
-- Table structure for table `sermon`
--

CREATE TABLE `sermon` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `album` varchar(200) NOT NULL,
  `speaker` int(11) NOT NULL,
  `audio_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sermon`
--

INSERT INTO `sermon` (`id`, `date`, `title`, `album`, `speaker`, `audio_file`) VALUES
(1, '2017-03-25', 'Melakukan Kehendak Tuhan', '', 4, '170325_Melakukan_Kehendak_Tuhan_Johnsen_Ng.mp3'),
(2, '2017-03-18', 'Lebendiges Wasser', '', 7, '170318_Lebendiges_Wasser_David_Sanders.mp3'),
(3, '2017-03-11', 'Pesan Terakhir Tuhan', '', 6, '170311_Pesan_Terakhir_Tuhan_Michael_Suwito.mp3'),
(4, '2017-01-14', 'Das Reich Gottes', '', 7, '170114_das_Reich_Gottes_David_Sanders.mp3'),
(16, '2019-07-06', 'Rahasia Damai Sejahtera', 'Weekly Sermon 2019', 8, '190706_-_Rahasia Damai Sejahtera.mp3'),
(17, '2019-07-13', 'Berjalan Dalam Tuhan', 'Weekly Sermon 2019', 6, '190713_-_Berjalan Dalam Tuhan.mp3'),
(18, '2019-07-20', 'Das Gebet Paulus fÃ¼r Gemeinde in Efesus', 'Weekly Sermon 2019', 7, '190720_-_Das Gebet Paulus fÃ¼r Gemeinde in Efesus.mp3'),
(19, '2019-08-03', 'Gambar Diri (2)', 'Weekly Sermon 2019', 4, '190803_-_Gambar Diri_part2.mp3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sermon`
--
ALTER TABLE `sermon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`),
  ADD KEY `speaker` (`speaker`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sermon`
--
ALTER TABLE `sermon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sermon`
--
ALTER TABLE `sermon`
  ADD CONSTRAINT `speaker` FOREIGN KEY (`speaker`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
