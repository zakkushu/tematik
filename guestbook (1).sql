-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 02, 2019 at 08:18 AM
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

INSERT INTO `events` (`ID_E`, `nama_e`, `lokasi_e`, `tanggal_e`, `waktu_e`, `jumlah_m`, `jumlah_k`) VALUES
(1, 'kumpul-kumpul', 'Tangerang', '2019-09-28', '20:00:00', 2, 2),
(3, 'arisan I ', 'jakarta', '2019-09-28', '12:30:39', 1, 3),
(4, 'Bastian Gay Party', 'Cipondoh', '2019-09-26', '12:30:39', 21, 22),
(5, 'Bastian Gay Party #2', 'Cipondoh (tangcity)', '2019-09-26', '02:17:23', 20, 50),
(6, 'tidur-tiduran', 'tangerang', '2019-09-03', '08:00:00', 5, 3);

--
-- Triggers `events`
--
DELIMITER $$
CREATE TRIGGER `meja_ins` AFTER INSERT ON `events` FOR EACH ROW begin
 declare x int ;
 if(new.jumlah_m >  0 ) then
   set x = 1 ;
   while x <= new.jumlah_m do
     insert into meja (ID_E,ID_M)
     values
     (new.ID_E,x);
     set x=x+1;
    end while ;
  end if ;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `guestlist`
--

CREATE TABLE `guestlist` (
  `ID_E` int(10) DEFAULT NULL,
  `ID_M` int(10) NOT NULL,
  `ID_K` int(10) NOT NULL,
  `ID_P` int(10) DEFAULT NULL,
  `kehadiran` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guestlist`
--

INSERT INTO `guestlist` (`ID_E`, `ID_M`, `ID_K`, `ID_P`, `kehadiran`) VALUES
(1, 1, 1, 1, 'hadir'),
(1, 1, 2, 2, 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `kursi`
--

CREATE TABLE `kursi` (
  `ID_M` int(10) DEFAULT NULL,
  `ID_K` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kursi`
--

INSERT INTO `kursi` (`ID_M`, `ID_K`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `ID_E` int(10) DEFAULT NULL,
  `ID_M` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`ID_E`, `ID_M`) VALUES
(1, 1),
(1, 2),
(2, 3),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `ID_P` int(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nomorhp` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `kehadiran` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`ID_P`, `nama`, `nomorhp`, `email`, `kehadiran`) VALUES
(1, 'Bastian', '08123213', 'Bastian@gmail.com', 'hadir'),
(2, 'makaroni', '01232131', 'makanan@gmail.com', 'hadir'),
(3, 'Dion', '123123', 'asd@asd.com', 'xax'),
(4, 'Dion', '12312', 'WAWKAKWAWK', 'xax'),
(5, 'Dutbo', '82298911', 'abc@gmail.com', 'xax');

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
  MODIFY `ID_A` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID_E` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `ID_P` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
