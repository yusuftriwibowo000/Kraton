-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 07, 2021 at 11:49 PM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u320096150_toko_bumdes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `no_tlp` varchar(14) NOT NULL,
  `level` enum('admin','karyawan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `no_tlp`, `level`) VALUES
(1, 'admin', 'admin', '12', 'admin'),
(3, 'aji', 'aji', '098', 'karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(32) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `id_kategori` varchar(50) NOT NULL,
  `harga_jual` int(50) NOT NULL,
  `stok` int(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `id_kategori`, `harga_jual`, `stok`, `keterangan`) VALUES
('RJ0002', 'Fermipan / ons', 'KB0005', 10000, 13, 'asasas'),
('RJ0003', 'Pulpen', 'KB0002', 2000, 23, 'asas'),
('RJ0004', 'Fermipan / Kg', 'KB0005', 2000, 12, 'asas'),
('RJ0005', 'Fermipan / Box', 'KB0002', 3000, 12, 'asas');

-- --------------------------------------------------------

--
-- Table structure for table `buku_besar`
--

CREATE TABLE `buku_besar` (
  `id_bukubesar` int(11) NOT NULL,
  `kode_transaksi` varchar(12) NOT NULL,
  `tipe` enum('penjualan','pembelian','kas') NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int(10) NOT NULL,
  `jenis` enum('debit','kredit') NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku_besar`
--

INSERT INTO `buku_besar` (`id_bukubesar`, `kode_transaksi`, `tipe`, `tanggal`, `nominal`, `jenis`, `keterangan`) VALUES
(1, 'KS0002', 'kas', '2020-09-10', 100000, 'kredit', 'Baik baik aja'),
(2, 'KS0003', 'kas', '2020-09-09', 20000, 'debit', 'as'),
(3, 'PB0006', 'pembelian', '2020-09-10', 0, 'kredit', 'dada'),
(4, 'PB0007', 'pembelian', '2020-08-01', 0, 'kredit', ''),
(5, 'PJ0005', 'penjualan', '2020-08-01', 200000, 'debit', ''),
(8, 'PB0010', 'pembelian', '2020-09-17', 28000, 'kredit', 'dada'),
(9, 'PJ0006', 'penjualan', '2020-10-15', 3500, 'debit', 'dada'),
(10, 'PJ0007', 'penjualan', '2020-10-10', 5000, 'debit', 'dada'),
(11, 'PJ0008', 'penjualan', '2020-10-16', 8500, 'debit', 'dada'),
(14, 'PB0008', 'pembelian', '2020-10-17', 41500, 'kredit', 'dada'),
(15, 'KS0004', 'kas', '2020-10-18', 20000, 'debit', 'sas'),
(17, 'PJ0011', 'penjualan', '0000-00-00', 4000, 'debit', ''),
(18, 'PB0009', 'pembelian', '0000-00-00', 26000, 'kredit', ''),
(19, 'PJ0012', 'penjualan', '0000-00-00', 4500, 'debit', ''),
(20, 'PJ0013', 'penjualan', '0000-00-00', 6000, 'debit', ''),
(21, 'PJ0014', 'penjualan', '0000-00-00', 10000, 'debit', ''),
(22, 'PJ0015', 'penjualan', '0000-00-00', 6000, 'debit', ''),
(23, 'PJ0016', 'penjualan', '0000-00-00', 10000, 'debit', ''),
(24, 'PJ0017', 'penjualan', '0000-00-00', 50000, 'debit', '');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_detail` int(5) NOT NULL,
  `kode_pembelian` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `qty` int(50) NOT NULL,
  `harga_satuan` int(50) NOT NULL,
  `keterangan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_detail`, `kode_pembelian`, `kode_barang`, `qty`, `harga_satuan`, `keterangan`) VALUES
(11, 'PB0001', 'RJ0004', 2, 3000, 'baik'),
(12, 'PB0001', 'RJ0003', 3, 1400, 'baik'),
(13, 'PB0002', 'RJ0001', 5, 1000, 'baik'),
(14, 'PB0003', 'RJ0003', 10, 1000, 'baik'),
(16, 'PB0004', 'RJ0001', 7, 1000, 'baik'),
(17, 'PB0005', 'RJ0001', 12, 2000, 'baik'),
(18, 'PB0006', 'RJ0001', 2, 2000, 'baik'),
(19, 'PB0006', 'RJ0003', 3, 2000, 'baik'),
(20, 'PB0007', 'RJ0002', 10, 20000, ''),
(26, 'PB0008', 'RJ0001', 4, 10000, 'baik'),
(27, 'PB0008', 'RJ0002', 1, 1500, 'baik'),
(29, 'PB0009', 'RJ0002', 13, 2000, '');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` int(50) NOT NULL,
  `kode_penjualan` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `qty` int(50) NOT NULL,
  `harga_satuan` int(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `kode_penjualan`, `kode_barang`, `qty`, `harga_satuan`, `keterangan`) VALUES
(1, 'PJ0001', 'RJ0003', 2, 2000, 'baik'),
(2, 'PJ0001', 'RJ0003', 2, 2000, 'baik'),
(3, 'PJ0002', 'RJ0001', 2, 2500, 'baik'),
(4, 'PJ0002', 'RJ0003', 2, 2000, 'baik'),
(5, 'PJ0003', 'RJ0002', 2, 1500, 'baik'),
(6, 'PJ0003', 'RJ0004', 2, 2000, 'baik'),
(7, 'PJ0004', 'RJ0001', 2, 2500, 'baik'),
(8, 'PJ0004', 'RJ0004', 5, 2000, 'baik'),
(9, 'PJ0005', 'RJ0001', 20, 10000, ''),
(10, 'PJ0006', 'RJ0001', 1, 3500, 'baik'),
(11, 'PJ0007', 'RJ0003', 1, 2000, 'baik'),
(12, 'PJ0007', 'RJ0002', 2, 1500, 'baik'),
(13, 'PJ0008', 'RJ0001', 2, 5500, 'baik'),
(14, 'PJ0008', 'RJ0002', 1, 1500, 'baik'),
(15, 'PJ0009', 'RJ0002', 3, 1500, 'baik'),
(16, 'PJ0009', 'RJ0003', 5, 2000, 'baik'),
(17, 'PJ0010', 'RJ0001', 9, 3500, 'baik'),
(18, 'PJ0010', 'RJ0002', 2, 1500, 'baik'),
(19, 'PJ0010', 'RJ0003', 2, 2000, 'baik'),
(20, 'PJ0011', 'RJ0003', 2, 2000, ''),
(21, 'PJ0012', 'RJ0002', 3, 1500, ''),
(22, 'PJ0013', 'RJ0002', 4, 1500, ''),
(23, 'PJ0014', 'RJ0004', 5, 2000, ''),
(24, 'PJ0015', 'RJ0002', 4, 1500, ''),
(25, 'PJ0016', 'RJ0002', 1, 10000, ''),
(26, 'PJ0017', 'RJ0002', 5, 10000, '');

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `kode_kas` varchar(9) NOT NULL,
  `tanggal_kas` date NOT NULL,
  `nominal` int(10) NOT NULL,
  `jenis` enum('debit','kredit') NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`kode_kas`, `tanggal_kas`, `nominal`, `jenis`, `keterangan`) VALUES
('KS0001', '2020-09-10', 100000, 'kredit', 'Baik baik aja'),
('KS0002', '2020-09-10', 100000, 'kredit', 'Baik baik aja'),
('KS0003', '2020-09-09', 20000, 'kredit', 'as');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(50) NOT NULL,
  `nama_kategori` varchar(59) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
('KB0001', 'Aksesoris'),
('KB0002', 'Alat Tulis'),
('KB0004', 'Minuman'),
('KB0005', 'Makanan'),
('KB0006', 'Barang');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `kode_pembelian` varchar(50) NOT NULL,
  `tanggal_pembelian` varchar(50) NOT NULL,
  `total` int(50) NOT NULL,
  `id_admin` int(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`kode_pembelian`, `tanggal_pembelian`, `total`, `id_admin`, `keterangan`) VALUES
('PB0001', '2020/09/10', 0, 1, ''),
('PB0002', '2020/09/22', 5000, 1, ''),
('PB0003', '2020/09/29', 20000, 1, ''),
('PB0004', '2020/10/16', 7000, 1, 'dsdadaadadad'),
('PB0005', '2020/10/10', 24000, 1, ''),
('PB0006', '2020/10/10', 0, 0, 'dada'),
('PB0007', '2020/10/01', 0, 0, ''),
('PB0008', '2020/10/17', 41500, 1, 'dada'),
('PB0009', '', 26000, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `kode_penjualan` varchar(30) NOT NULL,
  `tanggal_penjualan` varchar(35) NOT NULL,
  `total_qty` int(35) NOT NULL,
  `total_penjualan` int(50) NOT NULL,
  `total_bayar` int(50) NOT NULL,
  `potongan` int(11) NOT NULL,
  `id_admin` int(35) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`kode_penjualan`, `tanggal_penjualan`, `total_qty`, `total_penjualan`, `total_bayar`, `potongan`, `id_admin`, `keterangan`) VALUES
('PJ0001', '2020/09/16', 4, 8000, 8000, 2000, 1, ''),
('PJ0002', '2020/10/01', 4, 9000, 8000, 2000, 1, ''),
('PJ0003', '2020/09/16', 4, 7000, 8000, 2000, 1, ''),
('PJ0004', '2020/09/22', 7, 15000, 20000, 2000, 1, ''),
('PJ0005', '2020/09/01', 20, 200000, 200000, 0, 1, ''),
('PJ0006', '2020/10/15', 1, 3500, 10000, 1000, 1, 'dada'),
('PJ0007', '2020/10/10', 3, 5000, 10000, 0, 1, 'dada'),
('PJ0008', '2020/10/16', 3, 0, 10000, 2000, 1, 'dada'),
('PJ0009', '2020/09/16', 8, 14500, 20000, 3000, 1, 'dada'),
('PJ0010', '2020/10/19', 13, 38500, 50000, 5000, 1, 'dada'),
('PJ0011', '', 2, 4000, 10000, 0, 1, ''),
('PJ0012', '', 3, 4500, 7000, 0, 1, ''),
('PJ0013', '', 4, 6000, 8000, 0, 1, ''),
('PJ0014', '', 5, 10000, 20000, 0, 1, ''),
('PJ0015', '', 4, 6000, 10000, 1000, 1, ''),
('PJ0016', '', 1, 10000, 2000, 0, 1, ''),
('PJ0017', '', 5, 50000, 90000, 0, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `buku_besar`
--
ALTER TABLE `buku_besar`
  ADD PRIMARY KEY (`id_bukubesar`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`kode_kas`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`kode_pembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kode_penjualan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buku_besar`
--
ALTER TABLE `buku_besar`
  MODIFY `id_bukubesar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
