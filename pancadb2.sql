-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2019 at 07:18 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pancadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_barang`
--

CREATE TABLE `t_barang` (
  `kode_barang` int(10) NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `harga_barang` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_barang`
--

INSERT INTO `t_barang` (`kode_barang`, `nama_barang`, `harga_barang`) VALUES
(1, '160', 182000),
(2, '170', 216000),
(3, '175', 230000),
(4, '201', 290000),
(5, '188', 400000),
(6, '525', 500000),
(7, '838', 770000),
(8, '168', 310000),
(9, '887', 230000),
(10, '777', 250000),
(11, '622', 290000),
(12, '533', 420000),
(13, '232', 430000),
(14, '700', 630000),
(15, '828', 610000),
(16, '18', 460000),
(17, '268', 660000),
(18, '375', 410000),
(19, '401', 410000),
(20, '500', 700000),
(21, '02', 980000),
(22, '27', 660000),
(23, '07', 1180000),
(24, '1001', 660000);

-- --------------------------------------------------------

--
-- Table structure for table `t_pelanggan`
--

CREATE TABLE `t_pelanggan` (
  `kode_pelanggan` int(10) NOT NULL,
  `toko_pelanggan` varchar(100) NOT NULL,
  `pic_pelanggan` varchar(100) NOT NULL,
  `telp_pelanggan` varchar(20) NOT NULL,
  `alamat_pelanggan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pelanggan`
--

INSERT INTO `t_pelanggan` (`kode_pelanggan`, `toko_pelanggan`, `pic_pelanggan`, `telp_pelanggan`, `alamat_pelanggan`) VALUES
(4, 'Meruya', 'Leon', '', 'Jl. Pluit Karang Cantik B4 No. 39');

-- --------------------------------------------------------

--
-- Table structure for table `t_transaksi`
--

CREATE TABLE `t_transaksi` (
  `kode_transaksi` int(10) NOT NULL,
  `nota_transaksi` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_pelanggan` int(10) NOT NULL,
  `diskon` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_transaksi`
--

INSERT INTO `t_transaksi` (`kode_transaksi`, `nota_transaksi`, `tanggal`, `kode_pelanggan`, `diskon`) VALUES
(5, '001', '2019-12-04', 4, 10001),
(7, '003', '2019-12-09', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_transaksi_child`
--

CREATE TABLE `t_transaksi_child` (
  `id` int(20) NOT NULL,
  `kode_transaksi` int(20) NOT NULL,
  `kode_barang` int(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `harga_modal` int(20) NOT NULL,
  `harga_jual` int(20) NOT NULL,
  `total_profit` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_transaksi_child`
--

INSERT INTO `t_transaksi_child` (`id`, `kode_transaksi`, `kode_barang`, `quantity`, `harga_modal`, `harga_jual`, `total_profit`) VALUES
(9, 5, 2, 1, 216000, 250000, 34000),
(10, 5, 5, 3, 400000, 450000, 150000),
(11, 7, 1, 5, 182000, 230000, 240000),
(12, 7, 4, 3, 290000, 300000, 30000),
(13, 7, 10, 2, 250000, 330000, 160000);

-- --------------------------------------------------------

--
-- Table structure for table `t_transaksi_temp`
--

CREATE TABLE `t_transaksi_temp` (
  `id` int(11) NOT NULL,
  `kode_barang` int(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `harga_modal` int(20) NOT NULL,
  `harga_jual` int(20) NOT NULL,
  `total_profit` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_transaksi_temp`
--

INSERT INTO `t_transaksi_temp` (`id`, `kode_barang`, `quantity`, `harga_modal`, `harga_jual`, `total_profit`) VALUES
(8, 2, 1, 216000, 300000, 84000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`) VALUES
('admin', '81d29fd72914e093bcc4b9c2c0475fae', 'Riyadi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_barang`
--
ALTER TABLE `t_barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `barang` (`kode_barang`);

--
-- Indexes for table `t_pelanggan`
--
ALTER TABLE `t_pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`),
  ADD KEY `pelanggan` (`kode_pelanggan`);

--
-- Indexes for table `t_transaksi`
--
ALTER TABLE `t_transaksi`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- Indexes for table `t_transaksi_child`
--
ALTER TABLE `t_transaksi_child`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_transaksi_temp`
--
ALTER TABLE `t_transaksi_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_barang`
--
ALTER TABLE `t_barang`
  MODIFY `kode_barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `t_pelanggan`
--
ALTER TABLE `t_pelanggan`
  MODIFY `kode_pelanggan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_transaksi`
--
ALTER TABLE `t_transaksi`
  MODIFY `kode_transaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_transaksi_child`
--
ALTER TABLE `t_transaksi_child`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_transaksi_temp`
--
ALTER TABLE `t_transaksi_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
