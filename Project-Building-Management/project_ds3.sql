-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 07, 2022 at 04:37 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_ds3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `username` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'ILHAM SHUBKHI', 'ilham', '$2a$12$CiFWxPJ5RKo/arhVvnmAROM3XciMJDyv0uYljsiJ/k3HFGKZm4paW');

-- --------------------------------------------------------

--
-- Table structure for table `asset_gedung`
--

CREATE TABLE `asset_gedung` (
  `id` int(11) NOT NULL,
  `id_gedung` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `merk` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `asset_gedung`
--

INSERT INTO `asset_gedung` (`id`, `id_gedung`, `id_kategori`, `nama_barang`, `jumlah`, `merk`, `tgl_masuk`) VALUES
(1, 2, 7, 'Mobil', 3, 'Toyota', '2022-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `gedung`
--

CREATE TABLE `gedung` (
  `id` int(11) NOT NULL,
  `nama_gedung` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `nama_pic` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `nohp_pic` varchar(15) COLLATE utf8_swedish_ci NOT NULL,
  `alamat_pic` text COLLATE utf8_swedish_ci NOT NULL,
  `luas_tanah` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `tahun_berdiri` varchar(5) COLLATE utf8_swedish_ci NOT NULL,
  `alamat` text COLLATE utf8_swedish_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `gedung`
--

INSERT INTO `gedung` (`id`, `nama_gedung`, `nama_pic`, `nohp_pic`, `alamat_pic`, `luas_tanah`, `tahun_berdiri`, `alamat`, `foto`) VALUES
(2, 'PT. DEWANS', 'Pak denni', '123456789', 'Jl. Ciledug', '5 hektar', '2005', 'Jl. Ciledug', '3482680610.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_asset`
--

CREATE TABLE `kategori_asset` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(80) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `kategori_asset`
--

INSERT INTO `kategori_asset` (`id`, `nama_kategori`) VALUES
(7, 'Transportasi');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `id_maintenance` int(11) NOT NULL,
  `foto` json NOT NULL,
  `lokasi` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `judul_masalah` varchar(150) COLLATE utf8_swedish_ci NOT NULL,
  `deskripsi_masalah` text COLLATE utf8_swedish_ci NOT NULL,
  `solusi_masalah` text COLLATE utf8_swedish_ci NOT NULL,
  `waktu` date NOT NULL,
  `estimasi` varchar(30) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `id_maintenance`, `foto`, `lokasi`, `judul_masalah`, `deskripsi_masalah`, `solusi_masalah`, `waktu`, `estimasi`) VALUES
(1, 1, '[\"technology-product-electronics-r-20211012050217.jpg\"]', 'Lantai 2', 'Barang hilang', 'Hilang di laci', 'Harap kunci laci terlebih dahulu', '2022-03-04', '30 menit');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) NOT NULL,
  `id_gedung` int(11) NOT NULL,
  `id_teknisi` int(11) NOT NULL,
  `judul` varchar(150) COLLATE utf8_swedish_ci NOT NULL,
  `detail` text COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id`, `id_gedung`, `id_teknisi`, `judul`, `detail`) VALUES
(1, 2, 3, 'Barang Hilang', 'Barang hilang di lantai 2');

-- --------------------------------------------------------

--
-- Table structure for table `teknisi`
--

CREATE TABLE `teknisi` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_swedish_ci NOT NULL,
  `nama_teknisi` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8_swedish_ci NOT NULL,
  `foto_profile` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `nik` varchar(18) COLLATE utf8_swedish_ci NOT NULL,
  `nip` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `nama_pt` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `nama_bagian` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `alamat` text COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `teknisi`
--

INSERT INTO `teknisi` (`id`, `username`, `password`, `nama_teknisi`, `no_telp`, `foto_profile`, `nik`, `nip`, `nama_pt`, `nama_bagian`, `alamat`) VALUES
(3, 'zoro', '$2y$10$ZBFa//b3Bsottr6dEbwDHeVaIBPZzYVCxgEj4rHdB12csCYTx9bIG', 'ZORO RORO', '012345678', '20210712-one-piece-zoro-wano-postcover-555x555.jpg', '1234567890', '1234567890', 'PT. DEWANS', 'KEAMANAN', 'Jl. raya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_gedung`
--
ALTER TABLE `asset_gedung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_asset`
--
ALTER TABLE `kategori_asset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asset_gedung`
--
ALTER TABLE `asset_gedung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gedung`
--
ALTER TABLE `gedung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_asset`
--
ALTER TABLE `kategori_asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
