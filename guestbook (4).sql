-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2019 at 06:24 AM
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
  `password` varchar(100) DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `createdat` time DEFAULT NULL,
  `modifiedby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`ID_A`, `nama`, `email`, `password`, `createdby`, `createdat`, `modifiedby`) VALUES
(1, 'alpha', 'alpha@gmail.com', 'alphaalpha', NULL, NULL, NULL);

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
  `createdby` varchar(100) DEFAULT NULL,
  `createdat` time DEFAULT NULL,
  `modifiedby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID_E`, `nama_e`, `lokasi_e`, `tanggal_e`, `waktu_e`, `jumlah_m`, `createdby`, `createdat`, `modifiedby`) VALUES
(1, 'arisan', 'tangerang', '2019-11-06', '16:04:00', 10, NULL, NULL, NULL);

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
  `kehadiran` varchar(100) DEFAULT NULL,
  `raffle` int(100) DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `createdat` time DEFAULT NULL,
  `modifiedby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kursi`
--

CREATE TABLE `kursi` (
  `ID_M` int(10) DEFAULT NULL,
  `ID_K` int(10) DEFAULT NULL,
  `ID_P` int(10) DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `createdat` time DEFAULT NULL,
  `modifiedby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `ID_E` int(10) DEFAULT NULL,
  `ID_M` int(10) NOT NULL,
  `tname` varchar(100) DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `createdat` time DEFAULT NULL,
  `modifiedby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`ID_E`, `ID_M`, `tname`, `createdby`, `createdat`, `modifiedby`) VALUES
(1, 1, NULL, NULL, NULL, NULL),
(1, 2, NULL, NULL, NULL, NULL),
(1, 3, NULL, NULL, NULL, NULL),
(1, 4, NULL, NULL, NULL, NULL),
(1, 5, NULL, NULL, NULL, NULL),
(1, 6, NULL, NULL, NULL, NULL),
(1, 7, NULL, NULL, NULL, NULL),
(1, 8, NULL, NULL, NULL, NULL),
(1, 9, NULL, NULL, NULL, NULL),
(1, 10, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `ID_P` int(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `nomorhp` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `createdat` time DEFAULT NULL,
  `modifiedby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `tamu`
-- (See below for the actual view)
--
CREATE TABLE `tamu` (
`nama_e` varchar(100)
,`nama` varchar(100)
,`tname` varchar(100)
,`ID_K` int(10)
);

-- --------------------------------------------------------

--
-- Structure for view `tamu`
--
DROP TABLE IF EXISTS `tamu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tamu`  AS  select `e`.`nama_e` AS `nama_e`,`p`.`nama` AS `nama`,`m`.`tname` AS `tname`,`k`.`ID_K` AS `ID_K` from ((((`guestlist` `g` join `pelanggan` `p` on((`p`.`ID_P` = `g`.`ID_P`))) join `events` `e` on((`g`.`ID_E` = `e`.`ID_E`))) join `meja` `m` on((`m`.`ID_E` = `e`.`ID_E`))) join `kursi` `k` on((`k`.`ID_K` = `g`.`ID_K`))) ;

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
  MODIFY `ID_A` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID_E` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `ID_P` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
