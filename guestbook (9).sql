-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2019 at 09:55 AM
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

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`ID_A`, `nama`, `email`, `password`, `createdby`, `createdat`, `modifiedby`) VALUES
(2, 'alpha', 'alpha@gmail.com', 'ZXnFQ8d+4lAYHA==', 'SU', '2019-11-28 08:13:12', ''),
(3, 'beta', 'beta@gmail.com', 'ZnDBSsR6+kE=', 'Super User', '2019-11-28 09:21:57', '');

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
(2, 'asd', 'sadsa', '2019-11-12', '10:00:00', 5, NULL, '2019-11-28 08:32:13', NULL, NULL),
(3, 'sddsa', 'manao', '2019-11-28', '04:19:32', 10, 'admin', '2019-11-28 09:19:51', '', 'sdadsdsa ad'),
(4, 'asd', 'sdads', '2019-11-28', '04:23:38', 4, 'admin', '2019-11-28 09:23:57', '', 'asd qweqwe'),
(5, 'ads', 'jakarta', '2019-11-28', '04:24:34', 5, 'admin', '2019-11-28 09:24:55', '', 'dsaasd'),
(6, 'Asoyyy', 'jakarta', '2019-11-28', '04:28:34', 3, 'admin', '2019-11-28 09:29:28', '', 'dsadwaknad awdwad'),
(7, 'Makan', 'jakarta', '2019-11-28', '04:33:58', 5, 'admin', '2019-11-28 09:34:19', '', 'wkwkw wkwkw'),
(8, 'Mabok mabok', 'manado', '2019-11-28', '04:35:02', 5, 'admin', '2019-11-28 09:35:33', '', 'mantap asu'),
(9, 'Testing', 'testing', '2019-11-28', '04:36:50', 5, 'admin', '2019-11-28 09:37:10', '', 'asddmads adssa'),
(10, 'ZXC', 'adssad', '2019-11-28', '04:40:25', 5, 'admin', '2019-11-28 09:40:46', '', 'wq'),
(11, 'asdasd', 'asdd', '2019-11-28', '04:48:17', 9, 'admin', '2019-11-28 09:48:39', '', 'asddsasad'),
(12, 'Wakwaw', 'jakarta', '2019-11-28', '04:50:20', 5, 'admin', '2019-11-28 09:50:39', '', 'adsads'),
(13, 'Jakarta', 'asd', '2019-11-28', '04:51:19', 5, 'admin', '2019-11-28 09:51:37', '', 'wkwkwkkw'),
(14, 'wkwkadaw', 'szxczx', '2019-11-28', '04:52:35', 12, 'admin', '2019-11-28 09:52:53', '', 'asdadsas');

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
  `createdat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
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
  `createdat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kursi`
--

INSERT INTO `kursi` (`ID_M`, `ID_K`, `ID_P`, `createdby`, `createdat`, `modifiedby`) VALUES
(1, 1, 1, NULL, '2019-11-21 08:45:29', NULL);

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
(1, 2, 1, 'alphaalpha', 'SU', NULL, ''),
(2, 2, 2, NULL, NULL, NULL, NULL),
(3, 2, 3, NULL, NULL, NULL, NULL),
(4, 2, 4, NULL, NULL, NULL, NULL),
(5, 2, 5, NULL, NULL, NULL, NULL),
(6, 3, 1, NULL, NULL, NULL, NULL),
(7, 3, 2, NULL, NULL, NULL, NULL),
(8, 3, 3, NULL, NULL, NULL, NULL),
(9, 3, 4, NULL, NULL, NULL, NULL),
(10, 3, 5, NULL, NULL, NULL, NULL),
(11, 3, 6, NULL, NULL, NULL, NULL),
(12, 3, 7, NULL, NULL, NULL, NULL),
(13, 3, 8, NULL, NULL, NULL, NULL),
(14, 3, 9, NULL, NULL, NULL, NULL),
(15, 3, 10, NULL, NULL, NULL, NULL),
(16, 4, 1, NULL, NULL, NULL, NULL),
(17, 4, 2, NULL, NULL, NULL, NULL),
(18, 4, 3, NULL, NULL, NULL, NULL),
(19, 4, 4, NULL, NULL, NULL, NULL),
(20, 5, 1, NULL, NULL, NULL, NULL),
(21, 5, 2, NULL, NULL, NULL, NULL),
(22, 5, 3, NULL, NULL, NULL, NULL),
(23, 5, 4, NULL, NULL, NULL, NULL),
(24, 5, 5, NULL, NULL, NULL, NULL),
(25, 6, 1, NULL, NULL, NULL, NULL),
(26, 6, 2, NULL, NULL, NULL, NULL),
(27, 6, 3, NULL, NULL, NULL, NULL),
(28, 7, 1, NULL, NULL, NULL, NULL),
(29, 7, 2, NULL, NULL, NULL, NULL),
(30, 7, 3, NULL, NULL, NULL, NULL),
(31, 7, 4, NULL, NULL, NULL, NULL),
(32, 7, 5, NULL, NULL, NULL, NULL),
(33, 8, 1, NULL, NULL, NULL, NULL),
(34, 8, 2, NULL, NULL, NULL, NULL),
(35, 8, 3, NULL, NULL, NULL, NULL),
(36, 8, 4, NULL, NULL, NULL, NULL),
(37, 8, 5, NULL, NULL, NULL, NULL),
(38, 9, 1, NULL, NULL, NULL, NULL),
(39, 9, 2, NULL, NULL, NULL, NULL),
(40, 9, 3, NULL, NULL, NULL, NULL),
(41, 9, 4, NULL, NULL, NULL, NULL),
(42, 9, 5, NULL, NULL, NULL, NULL),
(43, 10, 1, 'test', '', '2019-11-28 09:40:46', ''),
(44, 10, 2, NULL, NULL, '2019-11-28 09:40:46', NULL),
(45, 10, 3, NULL, NULL, '2019-11-28 09:40:46', NULL),
(46, 10, 4, NULL, NULL, '2019-11-28 09:40:46', NULL),
(47, 10, 5, NULL, NULL, '2019-11-28 09:40:46', NULL),
(48, 11, 1, NULL, NULL, '2019-11-28 09:48:39', NULL),
(49, 11, 2, NULL, NULL, '2019-11-28 09:48:39', NULL),
(50, 11, 3, NULL, NULL, '2019-11-28 09:48:39', NULL),
(51, 11, 4, NULL, NULL, '2019-11-28 09:48:39', NULL),
(52, 11, 5, NULL, NULL, '2019-11-28 09:48:39', NULL),
(53, 11, 6, NULL, NULL, '2019-11-28 09:48:39', NULL),
(54, 11, 7, NULL, NULL, '2019-11-28 09:48:39', NULL),
(55, 11, 8, NULL, NULL, '2019-11-28 09:48:39', NULL),
(56, 11, 9, NULL, NULL, '2019-11-28 09:48:39', NULL),
(57, 12, 1, '', '', '2019-11-28 09:50:39', ''),
(58, 12, 2, NULL, NULL, '2019-11-28 09:50:39', NULL),
(59, 12, 3, NULL, NULL, '2019-11-28 09:50:39', NULL),
(60, 12, 4, NULL, NULL, '2019-11-28 09:50:39', NULL),
(61, 12, 5, NULL, NULL, '2019-11-28 09:50:39', NULL),
(62, 13, 1, 'Diamond', '', '2019-11-28 09:51:37', ''),
(63, 13, 2, NULL, NULL, '2019-11-28 09:51:37', NULL),
(64, 13, 3, NULL, NULL, '2019-11-28 09:51:37', NULL),
(65, 13, 4, NULL, NULL, '2019-11-28 09:51:37', NULL),
(66, 13, 5, NULL, NULL, '2019-11-28 09:51:37', NULL),
(67, 14, 1, 'asdadsad', 'admin', '2019-11-28 09:52:53', 'admin'),
(68, 14, 2, 'Permata', 'admin', '2019-11-28 09:52:53', 'admin'),
(69, 14, 3, NULL, NULL, '2019-11-28 09:52:53', NULL),
(70, 14, 4, NULL, NULL, '2019-11-28 09:52:53', NULL),
(71, 14, 5, NULL, NULL, '2019-11-28 09:52:53', NULL),
(72, 14, 6, NULL, NULL, '2019-11-28 09:52:53', NULL),
(73, 14, 7, NULL, NULL, '2019-11-28 09:52:53', NULL),
(74, 14, 8, NULL, NULL, '2019-11-28 09:52:53', NULL),
(75, 14, 9, NULL, NULL, '2019-11-28 09:52:53', NULL),
(76, 14, 10, NULL, NULL, '2019-11-28 09:52:53', NULL),
(77, 14, 11, NULL, NULL, '2019-11-28 09:52:53', NULL),
(78, 14, 12, NULL, NULL, '2019-11-28 09:52:53', NULL);

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
  MODIFY `ID_A` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID_E` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `IDD_M` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `ID_P` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
