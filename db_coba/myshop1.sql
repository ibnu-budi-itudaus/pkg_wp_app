-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2021 at 04:26 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myshop1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_brg` int(11) NOT NULL,
  `nama_brg` varchar(120) NOT NULL,
  `keterangan` varchar(225) NOT NULL,
  `kategori` varchar(80) NOT NULL,
  `harga_brg` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_brg`, `nama_brg`, `keterangan`, `kategori`, `harga_brg`, `stok`, `gambar`) VALUES
(1, 'Sepatu Adidas', 'Sepatu merek adidas untuk pria', 'Pakaian Pria', 300000, 10, 'sepatu.jpg'),
(2, 'Kamera', 'Kamera canon eos 700d', 'Elektronik', 5900000, 7, 'kamera.jpg'),
(3, 'Samsung Galaxy A20', 'Samsung Galaxy A20', 'Elektronik', 3400000, 10, 'hp.jpg'),
(4, 'Laptop ASUS', 'Laptop ASUS ram 2gb', 'Elektronik', 4500000, 10, 'laptop.jpg'),
(13, 'Jaket Pacheri pria', 'warna biru, kualitas terbaik', 'Pakaian Pria', 470000, 11, 'p7.jpg'),
(14, 'Tas Selempang Kulit Bluecherry', 'tas Selempang, warna hitam, kulit, merek bluecherry', 'Pakaian Wanita', 525000, 19, 'p29.jpg'),
(15, 'Sepatu Hak Tinggi Merek Bluecherry', 'Sepatu Hak Tinggi, Merek Bluecherry', 'Pakaian Wanita', 335000, 11, 'p22.jpg'),
(20, 'CHANGHONG - LED TV G3 SERIES ', '32 Inch, LED TV', 'Elektronik', 1999000, 11, 'CHANGHONG_-_LED_TV_G3_SERIES_(32_INCH)_1_999_000k.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `batas_bayar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_invoice`
--

INSERT INTO `tb_invoice` (`id`, `nama`, `alamat`, `tgl_pesan`, `batas_bayar`) VALUES
(2, 'Muhammad Firdaus', 'Ciceri Permai 4, Kota Serang', '2021-01-11 20:13:15', '2021-01-12 20:13:15'),
(3, 'ahmad', 'serang', '2021-01-12 07:32:24', '2021-01-13 07:32:24'),
(4, 'Musa', 'Cilegon', '2021-01-12 07:57:00', '2021-01-13 07:57:00'),
(5, 'Yusuf', 'serang', '2021-01-12 07:58:15', '2021-01-13 07:58:15'),
(6, 'Usman', 'Bogor', '2021-01-12 13:34:13', '2021-01-13 13:34:13'),
(7, 'ahmad', 'walantaka', '2021-01-14 15:16:36', '2021-01-15 15:16:36'),
(8, 'ahmad', 'walantaka', '2021-01-14 15:17:47', '2021-01-15 15:17:47'),
(9, 'Yaqub', 'Pandeglang', '2021-01-27 17:00:24', '2021-01-28 17:00:24'),
(10, 'Muhammad Firdaus', 'Ciceri Permai 4, Kota Serang', '2014-01-01 00:34:30', '2014-01-02 00:34:30'),
(11, 'am', '', '2021-01-28 17:04:04', '2021-01-29 17:04:04'),
(12, 'amin', 'cikande', '2021-01-28 17:05:14', '2021-01-29 17:05:14'),
(13, 'yusuf', 'cilegon', '2021-01-29 12:37:25', '2021-01-30 12:37:25'),
(14, '', '', '2021-01-29 12:38:25', '2021-01-30 12:38:25'),
(15, 'yusuf', 'cilegon', '2021-01-30 17:35:22', '2021-01-31 17:35:22'),
(16, 'yusuf', 'cilegon', '2021-01-30 17:52:21', '2021-01-31 17:52:21'),
(17, 'yusuf', 'cilegon', '2021-01-30 17:52:25', '2021-01-31 17:52:25'),
(18, 'yusuf', 'cilegon', '2021-02-04 20:44:40', '2021-02-05 20:44:40'),
(19, 'yusuf', 'cilegon', '2021-02-06 01:56:02', '2021-02-07 01:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_brg` int(11) NOT NULL,
  `pilihan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id`, `id_invoice`, `id_brg`, `nama_brg`, `jumlah`, `harga_brg`, `pilihan`) VALUES
(1, 2, 1, 'Sepatu Adidas', 1, 300000, ''),
(2, 2, 2, 'Kamera', 1, 5900000, ''),
(3, 3, 3, 'Samsung Galaxy A20', 1, 3400000, ''),
(4, 4, 4, 'Laptop ASUS', 1, 4500000, ''),
(5, 5, 1, 'Sepatu Adidas', 1, 300000, ''),
(6, 5, 3, 'Samsung Galaxy A20', 1, 3400000, ''),
(7, 6, 1, 'Sepatu Adidas', 1, 300000, ''),
(8, 6, 2, 'Kamera', 1, 5900000, ''),
(9, 6, 3, 'Samsung Galaxy A20', 1, 3400000, ''),
(10, 6, 4, 'Laptop ASUS', 1, 4500000, ''),
(11, 7, 1, 'Sepatu Adidas', 2, 300000, ''),
(12, 8, 2, 'Kamera', 2, 5900000, ''),
(13, 9, 20, 'CHANGHONG - LED TV G3 SERIES ', 1, 1999000, ''),
(14, 9, 3, 'Samsung Galaxy A20', 1, 3400000, ''),
(15, 10, 1, 'Sepatu Adidas', 1, 300000, ''),
(16, 10, 2, 'Kamera', 1, 5900000, ''),
(17, 11, 3, 'Samsung Galaxy A20', 1, 3400000, ''),
(18, 12, 4, 'Laptop ASUS', 1, 4500000, ''),
(19, 13, 13, 'Jaket Pacheri pria', 1, 470000, ''),
(20, 14, 3, 'Samsung Galaxy A20', 1, 3400000, ''),
(21, 15, 3, 'Samsung Galaxy A20', 1, 3400000, ''),
(22, 18, 4, 'Laptop ASUS', 1, 4500000, ''),
(23, 19, 3, 'Samsung Galaxy A20', 1, 3400000, ''),
(24, 19, 15, 'Sepatu Hak Tinggi Merek Bluecherry', 1, 335000, '');

--
-- Triggers `tb_pesanan`
--
DELIMITER $$
CREATE TRIGGER `pesanan_penjualan` AFTER INSERT ON `tb_pesanan` FOR EACH ROW BEGIN
	UPDATE tb_barang SET stok = stok - NEW.jumlah
    WHERE id_brg = NEW.id_brg;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_toko`
--

CREATE TABLE `tb_toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_toko`
--

INSERT INTO `tb_toko` (`id_toko`, `nama_toko`, `alamat`) VALUES
(1, 'Yusuf sejahtera', 'cilegon'),
(2, 'daus sentosa', 'serang');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `role_id` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `role_id`) VALUES
(1, 'admin', 'admin', '123', 1),
(2, 'user', 'user', '123', 2),
(3, 'Yaqub', 'yaqub_baik', '123yaqub', 2),
(4, 'Umar Alfaruq', 'umar', '123umar', 2),
(5, 'yusuf', 'yusuf214', '140298', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indexes for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_toko`
--
ALTER TABLE `tb_toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_toko`
--
ALTER TABLE `tb_toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
