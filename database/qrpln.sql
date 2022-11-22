-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2022 at 11:01 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qrpln`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_user`, `username`, `password`, `nama`, `jabatan`, `level`, `status`) VALUES
(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'Superadmin', 'adm', 0, '1'),
(30, 'staff', '21232f297a57a5a743894a0e4a801fc3', 'Staff QR Maker', 'mgr', 2, '1'),
(32, 'manager', '21232f297a57a5a743894a0e4a801fc3', 'Manager QR Maker', 'mgr', 1, '0'),
(34, 'test7', '098f6bcd4621d373cade4e832627b4f6', 'Tester Aja 7', 'mgr', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `ms_jabatan`
--

CREATE TABLE `ms_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `kode_jabatan` varchar(10) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_jabatan`
--

INSERT INTO `ms_jabatan` (`id_jabatan`, `kode_jabatan`, `nama_jabatan`) VALUES
(1, 'adm', 'Admin'),
(2, 'mgr', 'Manager'),
(3, 'spv', 'Supervisor'),
(4, 'staff', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `ms_katalog`
--

CREATE TABLE `ms_katalog` (
  `id_katalog` int(11) NOT NULL,
  `kode_material` char(5) NOT NULL DEFAULT '',
  `sn_mc_pln` char(14) NOT NULL DEFAULT '',
  `no_material` char(7) NOT NULL DEFAULT '',
  `material_group` char(4) NOT NULL DEFAULT '',
  `id_material` char(4) NOT NULL DEFAULT '',
  `kategori` varchar(50) NOT NULL DEFAULT '',
  `deskripsi` text NOT NULL DEFAULT '',
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_katalog`
--

INSERT INTO `ms_katalog` (`id_katalog`, `kode_material`, `sn_mc_pln`, `no_material`, `material_group`, `id_material`, `kategori`, `deskripsi`, `status`) VALUES
(1, 'A2-OD', 'PLN01030000094', '1030094', '0103', '0094', 'Trafo Distribusi', 'TRF DIS;NCSP;11,7kV/231V;1P;SOkVA;lio;OD', '0'),
(3, 'B2-OD', 'PLN01030000097', '1030097', '0103', '0097', 'Trafo Distribusi', 'TRF DIS;D3;20kV/400V;3P;50kVA;YZN5;OD', '0'),
(4, 'B7-OD', 'PLN01030000190', '1030190', '0103', '0190', 'Trafo Distribusi', 'TRF DIS;D3;20kV/400V;3P;50kVA;YNyn0;OD', '0'),
(5, 'B8-OD', 'PLN01030000180', '1030180', '0103', '0180', 'Trafo Distribusi', 'TRF DIS;NCSP;11,7kV/231V;1P;50kVA;Iio;OD', '0'),
(6, 'B9-OD', 'PLN01030000195', '1030195', '0103', '0195', 'Trafo Distribusi', 'TRF DIS;CSP;11.7KV/231V;1P;50kVA;Iio;OD', '0'),
(7, 'C2-OD', 'PLN01030000074', '1030074', '0103', '0074', 'Trafo Distribusi', 'TRF DIS;D3;20kV/400V;3P;100kVA;YZN5;OD', '0'),
(8, 'C4-OD', 'PLN01030000191', '1030191', '0103', '0191', 'Trafo Distribusi', 'TRF DIS;D3;20kV/400V;3P;100kVA;YNyn0;OD', '0'),
(9, 'D2-OD', 'PLN01030000075', '1030075', '0103', '0075', 'Trafo Distribusi', 'TRF DIS;D3;20kV/400V;3P;160kVA;YZN5;OD', '0'),
(10, 'D4-OD', 'PLN01030000192', '1030192', '0103', '0192', 'Trafo Distribusi', 'TRF DIS;D3;20kV/400V;3P;160kVA;YNyn0;OD', '0'),
(11, 'E2-OD', 'PLN01030000076', '1030076', '0103', '0076', 'Trafo Distribusi', 'TRF DIS;D3;20kV/400V;3P;200kVA;DYN5;OD', '0'),
(12, 'E4-OD', 'PLN01030000193', '1030193', '0103', '0193', 'Trafo Distribusi', 'TRF DIS;D3;20kV/400V;3P;200kVA;YNyn0;OD', '0'),
(13, 'F2-OD', 'PLN01030000077', '1030077', '0103', '0077', 'Trafo Distribusi', 'TRF DIS;D3;20kV/400V;3P;250kVA;DYN5;OD', '0'),
(14, 'H2-ID', 'PLN01030000194', '1030194', '0103', '0194', 'Trafo Distribusi', 'TRF DIS;D3;20KV/400V;3P;400KVA;DYN5;ID', '0'),
(15, 'H2-OD', 'PLN01030000114', '1030114', '0103', '0114', 'Trafo Distribusi', 'TRF DIS;D3;20kV/400V;3P;400kVA;DYN5;OD', '0'),
(16, 'I2-ID', 'PLN01030000202', '1030202', '0103', '0202', 'Trafo Distribusi', 'TRF DIS;D3;20kV/400V;3P;630kVA;DYN5;ID', '0'),
(17, 'I2-OD', 'PLN01030000137', '1030137', '0103', '0137', 'Trafo Distribusi', 'TRF DIS;D3;20kV/400V;3P;630kVA;Dyn5;OD', '0'),
(18, 'J2-ID', 'PLN01030000203', '1030203', '0103', '0203', 'Trafo Distribusi', 'TRF DIS;D3;20kV/400V;3P;1000kVA;DYN5;ID', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ms_kategori`
--

CREATE TABLE `ms_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_kategori`
--

INSERT INTO `ms_kategori` (`id_kategori`, `kategori`, `status`) VALUES
(1, 'Trafo Distribusi', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ms_kode_pabrik`
--

CREATE TABLE `ms_kode_pabrik` (
  `id_kode_pabrik` int(11) NOT NULL,
  `kode_pabrikan` char(5) NOT NULL DEFAULT '',
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_kode_pabrik`
--

INSERT INTO `ms_kode_pabrik` (`id_kode_pabrik`, `kode_pabrikan`, `status`) VALUES
(5, '12150', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ms_level`
--

CREATE TABLE `ms_level` (
  `id_level` int(11) NOT NULL,
  `level` int(2) NOT NULL,
  `nama_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_level`
--

INSERT INTO `ms_level` (`id_level`, `level`, `nama_level`) VALUES
(1, 1, 'Manager HO'),
(7, 0, 'Admin'),
(12, 2, 'Staff HO');

-- --------------------------------------------------------

--
-- Table structure for table `trx_qrcode`
--

CREATE TABLE `trx_qrcode` (
  `kode_serial_material` varchar(28) NOT NULL,
  `kode_material` char(5) NOT NULL DEFAULT '',
  `sn_mc_pln` varchar(14) NOT NULL DEFAULT '',
  `kategori` varchar(50) NOT NULL DEFAULT '',
  `deskripsi` text NOT NULL DEFAULT '',
  `kode_pabrikan` char(5) NOT NULL DEFAULT '',
  `tahun_produksi` int(4) NOT NULL DEFAULT 0,
  `batch_produksi` char(2) NOT NULL DEFAULT '',
  `sn_material` char(5) NOT NULL DEFAULT '',
  `qrcode_dir` varchar(100) NOT NULL DEFAULT '',
  `barcode_dir` varchar(100) NOT NULL DEFAULT '',
  `status_qr` enum('0','1') NOT NULL DEFAULT '0',
  `status_barcode` enum('0','1') NOT NULL DEFAULT '0',
  `status_print` enum('0','1') NOT NULL DEFAULT '0',
  `created_dt` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL DEFAULT '',
  `update_dt` datetime NOT NULL,
  `update_by` varchar(50) NOT NULL DEFAULT '',
  `print_dt` datetime NOT NULL,
  `print_by` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `ms_jabatan`
--
ALTER TABLE `ms_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `ms_katalog`
--
ALTER TABLE `ms_katalog`
  ADD PRIMARY KEY (`id_katalog`) USING BTREE;

--
-- Indexes for table `ms_kategori`
--
ALTER TABLE `ms_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `ms_kode_pabrik`
--
ALTER TABLE `ms_kode_pabrik`
  ADD PRIMARY KEY (`id_kode_pabrik`) USING BTREE;

--
-- Indexes for table `ms_level`
--
ALTER TABLE `ms_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `trx_qrcode`
--
ALTER TABLE `trx_qrcode`
  ADD PRIMARY KEY (`kode_serial_material`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ms_jabatan`
--
ALTER TABLE `ms_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ms_katalog`
--
ALTER TABLE `ms_katalog`
  MODIFY `id_katalog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ms_kategori`
--
ALTER TABLE `ms_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ms_kode_pabrik`
--
ALTER TABLE `ms_kode_pabrik`
  MODIFY `id_kode_pabrik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ms_level`
--
ALTER TABLE `ms_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
