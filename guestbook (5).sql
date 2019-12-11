-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2019 at 06:57 PM
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
  `createdat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `createdat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedby` varchar(100) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID_E`, `nama_e`, `lokasi_e`, `tanggal_e`, `waktu_e`, `jumlah_m`, `createdby`, `createdat`, `modifiedby`, `notes`) VALUES
(2, 'sadasd', 'asdsad', '2019-12-12', '15:00:00', NULL, NULL, '2019-12-11 18:05:11', NULL, NULL),
(3, 'adadsad', NULL, NULL, NULL, NULL, NULL, '2019-12-11 18:50:12', NULL, NULL);

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
  `IDD_M` int(10) NOT NULL,
  `ID_K` int(10) NOT NULL,
  `ID_P` int(10) DEFAULT NULL,
  `kehadiran` varchar(100) DEFAULT NULL,
  `raffle` int(100) DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `createdat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kursi`
--

CREATE TABLE `kursi` (
  `IDD_M` int(10) DEFAULT NULL,
  `ID_K` int(10) NOT NULL,
  `ID_P` int(10) DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `createdat` datetime DEFAULT CURRENT_TIMESTAMP,
  `modifiedby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kursi`
--

INSERT INTO `kursi` (`IDD_M`, `ID_K`, `ID_P`, `createdby`, `createdat`, `modifiedby`) VALUES
(1, 7, 1, 'meh', '2019-12-12 00:27:40', ''),
(1, 8, 1, 'meh', '2019-12-12 00:27:47', ''),
(1, 9, 2, NULL, '2019-12-12 00:52:21', NULL),
(1, 10, 1, 'meh', '2019-12-12 01:21:24', ''),
(1, 11, 1, 'meh', '2019-12-12 01:21:45', ''),
(1, 12, 1, 'meh', '2019-12-12 01:21:57', ''),
(1, 13, 1, 'meh', '2019-12-12 01:22:24', ''),
(1, 14, 1, 'meh', '2019-12-12 01:23:54', ''),
(1, 15, 1, 'meh', '2019-12-12 01:24:38', ''),
(1, 16, 1, 'meh', '2019-12-12 01:25:01', ''),
(1, 17, 1, 'meh', '2019-12-12 01:27:37', ''),
(1, 18, 1, 'meh', '2019-12-12 01:28:50', ''),
(1, 19, 1, 'meh', '2019-12-12 01:29:23', ''),
(1, 20, 1, 'meh', '2019-12-12 01:29:45', ''),
(1, 21, 1, 'meh', '2019-12-12 01:31:59', ''),
(1, 22, 1, 'meh', '2019-12-12 01:33:30', ''),
(1, 23, 1, 'meh', '2019-12-12 01:33:46', '');

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `IDD_M` int(10) NOT NULL,
  `ID_E` int(10) DEFAULT NULL,
  `ID_M` int(10) NOT NULL,
  `tname` varchar(100) DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `createdat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`IDD_M`, `ID_E`, `ID_M`, `tname`, `createdby`, `createdat`, `modifiedby`) VALUES
(1, 1, 1, 'orion', 'meh', '2019-12-11 14:08:53', 'admin'),
(2, 1, 2, NULL, NULL, '2019-12-11 14:08:53', NULL),
(3, 1, 3, NULL, NULL, '2019-12-11 14:08:53', NULL),
(4, 1, 4, NULL, NULL, '2019-12-11 14:08:53', NULL),
(6, 1, 5, 'photon', 'meh', '2019-12-11 14:39:29', '');

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
  `createdat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`ID_P`, `nama`, `nickname`, `nomorhp`, `email`, `createdby`, `createdat`, `modifiedby`) VALUES
(1, 'empty', 'empty', 'empty', 'empty', 'admin', '2019-12-11 17:33:37', NULL),
(2, 'test', 'test', '21312', 'test', 'admin', '2019-12-11 13:10:51', ''),
(3, 'anto', NULL, NULL, NULL, NULL, '2019-12-11 13:17:07', NULL);

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
-- Indexes for table `kursi`
--
ALTER TABLE `kursi`
  ADD PRIMARY KEY (`ID_K`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`IDD_M`);

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
  MODIFY `ID_A` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID_E` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kursi`
--
ALTER TABLE `kursi`
  MODIFY `ID_K` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `IDD_M` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `ID_P` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
