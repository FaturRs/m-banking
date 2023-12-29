-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2023 at 08:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `NAMA_ADMIN` varchar(1024) NOT NULL,
  `USERNAME_ADMIN` varchar(1024) DEFAULT NULL,
  `PASS_ADMIN` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`NAMA_ADMIN`, `USERNAME_ADMIN`, `PASS_ADMIN`) VALUES
('FaturRs', 'fatur123', '7cbcd42a9aa589ab743a585cd5e83aeca6c763bfe9bf9af741da687a52b46b06');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID_CUSTOMER` int(11) NOT NULL,
  `NAMA_ADMIN` varchar(1024) DEFAULT NULL,
  `NAMA_CUSTOMER` varchar(1024) DEFAULT NULL,
  `ALAMAT_CUSTOMER` varchar(1024) DEFAULT NULL,
  `NO_TELP_CUST` varchar(20) DEFAULT NULL,
  `USERNAME_CUST` varchar(1024) DEFAULT NULL,
  `PASSWORD_CUST` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID_CUSTOMER`, `NAMA_ADMIN`, `NAMA_CUSTOMER`, `ALAMAT_CUSTOMER`, `NO_TELP_CUST`, `USERNAME_CUST`, `PASSWORD_CUST`) VALUES
(46, 'FaturRs', 'Prio Budi Laksono', 'Ds.Tanjungkalang', '081225711886', 'prio1', 'a790ecad0996008737c73fe200c9fa76e99dd47d1e3161a1c2a487b0ebba6516'),
(47, 'FaturRs', 'Fatur Rosek', 'Arosbaya', '087525412762', 'fatur1', 'bbcc1c0b6ec6a71f759d7c95319daed093b403139fdb04768b0dea02be601609');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `ID_CUSTOMER` int(11) NOT NULL,
  `NO_REKENING` bigint(20) NOT NULL,
  `JUMLAH_SALDO` float DEFAULT NULL,
  `DEBIT_REKENING` float DEFAULT NULL,
  `KREDIT_REKENING` float DEFAULT NULL,
  `TGL_UPDATE_REK` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`ID_CUSTOMER`, `NO_REKENING`, `JUMLAH_SALDO`, `DEBIT_REKENING`, `KREDIT_REKENING`, `TGL_UPDATE_REK`) VALUES
(46, 2177, 500000, 0, 0, '2022-11-26 15:01:32'),
(46, 2178, 10000, 0, 0, '2022-11-26 15:02:14'),
(47, 2145, 500000, 490000, 0, '2022-11-26 15:00:08'),
(47, 2146, 10000, 0, 0, '2022-11-26 14:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `ID_TRANSFER` int(11) NOT NULL,
  `ID_CUSTOMER` int(11) NOT NULL,
  `NO_REKENING` bigint(20) NOT NULL,
  `JUMLAH_TRANSAKSI` float DEFAULT NULL,
  `TGL_TRANSAKSI` datetime DEFAULT NULL,
  `NO_REKENING_PENERIMA` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`NAMA_ADMIN`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID_CUSTOMER`),
  ADD KEY `FK_MEMBUAT` (`NAMA_ADMIN`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`ID_CUSTOMER`,`NO_REKENING`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`ID_TRANSFER`),
  ADD KEY `FK_MELAKUKAN` (`ID_CUSTOMER`,`NO_REKENING`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID_CUSTOMER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `ID_TRANSFER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_MEMBUAT` FOREIGN KEY (`NAMA_ADMIN`) REFERENCES `admin` (`NAMA_ADMIN`);

--
-- Constraints for table `rekening`
--
ALTER TABLE `rekening`
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_CUSTOMER`) REFERENCES `customer` (`ID_CUSTOMER`);

--
-- Constraints for table `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `FK_MELAKUKAN` FOREIGN KEY (`ID_CUSTOMER`,`NO_REKENING`) REFERENCES `rekening` (`ID_CUSTOMER`, `NO_REKENING`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
