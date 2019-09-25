-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 25, 2019 at 11:27 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guestbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `ID_A` int(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`ID_A`, `nama`, `email`, `password`) VALUES
(1, 'alpha', 'alpha@gmail.com', 'alphaalpha'),
(2, 'beta', 'beta@gmail.com', 'betabeta');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `ID_E` int(10) NOT NULL,
  `nama_e` varchar(100) DEFAULT NULL,
  `lokasi_e` varchar(100) DEFAULT NULL,
  `tanggal_e` date DEFAULT NULL,
  `waktu_e` time DEFAULT NULL,
  `jumlah_m` int(100) DEFAULT NULL,
  `jumlah_k` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--


DELIMITER $$

CREATE
 TRIGGER meja_after_update AFTER INSERT
 ON events 
 FOR EACH ROW BEGIN
    DECLARE x INT;
                  DECLARE y INT;
    declare x_counter int unsigned default 0;
                  declare y_counter int unsigned default 0;
                  SET x = jumlah_m;
                  SET y = jumlah_k;
  while  x_counter < x do
    INSERT INTO meja (ID_E, ID_M) VALUES (ID_E,x_counter+1);
    set x_counter=x_counter+1;
  end while;
 END$$


INSERT INTO `events` (`ID_E`, `nama_e`, `lokasi_e`, `tanggal_e`, `waktu_e`, `jumlah_m`, `jumlah_k`) VALUES
(1, 'makan', 'tangerang', '2019-09-03', '16:05:00', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kursi`
--

CREATE TABLE `kursi` (
  `ID_E` int(10) DEFAULT NULL,
  `ID_M` int(10) NOT NULL,
  `ID_K` int(10) NOT NULL,
  `ID_P` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `ID_E` int(10) DEFAULT NULL,
  `ID_M` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `ID_P` int(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nomorhp` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `kehadiran` varchar(100) DEFAULT NULL,
  `ID_E` int(10) DEFAULT NULL,
  `ID_K` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`ID_P`, `nama`, `nomorhp`, `email`, `kehadiran`, `ID_E`, `ID_K`) VALUES
(2, 'manusia', '08123213', 'manusia@gmail.com', 'hadir', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`ID_A`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID_E`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`ID_P`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `ID_A` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID_E` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `ID_P` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
