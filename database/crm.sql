-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2016 at 12:56 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

DROP TABLE IF EXISTS `detail_pemesanan`;
CREATE TABLE IF NOT EXISTS `detail_pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_beli` int(3) NOT NULL DEFAULT '1',
  KEY `constraint_id_pemesanan` (`id_pemesanan`),
  KEY `constraint_id_produk_pemesanan` (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id_pemesanan`, `id_produk`, `jumlah_beli`) VALUES
(20, 49, 20),
(20, 44, 20),
(20, 48, 20),
(22, 5, 10),
(22, 45, 5);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

DROP TABLE IF EXISTS `detail_transaksi`;
CREATE TABLE IF NOT EXISTS `detail_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_beli` int(3) NOT NULL,
  KEY `constraint_id_transaksi` (`id_transaksi`),
  KEY `constraint_id_produk` (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_produk`, `jumlah_beli`) VALUES
(86, 40, 1),
(86, 43, 1),
(86, 42, 1),
(86, 44, 1),
(86, 41, 1),
(87, 48, 1),
(87, 49, 1),
(88, 45, 1),
(88, 47, 1),
(88, 46, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

DROP TABLE IF EXISTS `kategori_produk`;
CREATE TABLE IF NOT EXISTS `kategori_produk` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(30) NOT NULL,
  `status_hapus` char(1) DEFAULT '1',
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `nama_kategori`, `status_hapus`) VALUES
(1, 'Novel', '1'),
(2, 'Buku Sekolah', '1'),
(3, 'Alat Peraga', '1'),
(4, 'Alat Olahraga', '1'),
(5, 'ATK', '1'),
(6, 'Mainan', '0'),
(7, 'Majalah', '1'),
(8, 'Alat Elektronik', '1');

-- --------------------------------------------------------

--
-- Table structure for table `keluhan`
--

DROP TABLE IF EXISTS `keluhan`;
CREATE TABLE IF NOT EXISTS `keluhan` (
  `id_keluhan` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_keluhan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isi_keluhan` text,
  `foto_keluhan` varchar(255) NOT NULL,
  `foto_struk` varchar(255) NOT NULL,
  `status` char(2) NOT NULL DEFAULT 'BR',
  `pesan_respon` text,
  `id_pelanggan` int(11) NOT NULL,
  PRIMARY KEY (`id_keluhan`),
  KEY `id_pelanggan` (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluhan`
--

INSERT INTO `keluhan` (`id_keluhan`, `tgl_keluhan`, `isi_keluhan`, `foto_keluhan`, `foto_struk`, `status`, `pesan_respon`, `id_pelanggan`) VALUES
(7, '2016-06-01 15:27:42', 'Halaman Buku nya ada yang rusak pa', 'rusak.png', 'Struk.jpg', 'SR', 'Silahkan tukarkan kembali ke toko kami saja pa.\r\nTerima Kasih', 1),
(8, '2016-06-02 09:26:20', 'halaman 200 hilang', 'buker ipa 1a.jpg', 'Struk.jpg', 'BR', NULL, 1),
(11, '2016-06-12 13:48:00', 'Maaf pa, buku yang saya beli tempo hari ternyata ada cacat halaman di hal 50', 'robek.png', 'Struk.jpg', 'SR', 'silahkan tukarkan kembali ke toko kami.\r\nTerima kasih', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kritiksaran`
--

DROP TABLE IF EXISTS `kritiksaran`;
CREATE TABLE IF NOT EXISTS `kritiksaran` (
  `id_kritiksaran` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_kritiksaran` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_kritiksaran` char(2) NOT NULL DEFAULT 'BR',
  `isi_kritiksaran` text NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kritiksaran`),
  KEY `id_pelanggan` (`id_pelanggan`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE IF NOT EXISTS `pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jabatan` enum('direktur','manager','administrasi','pemasaran','pengunjung','inventori') DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_hapus` char(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_pegawai` (`id_pegawai`),
  KEY `constratint_id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `id_pegawai`, `nama`, `jabatan`, `id_user`, `status_hapus`) VALUES
(2, 10112645, 'Mohamad Ihsan', 'direktur', 2, '1'),
(4, 10112637, 'Irfan Rangga Gumilar', 'administrasi', 4, '1'),
(5, 10112438, 'Julio Febryanto', 'pemasaran', 5, '1'),
(7, 10112711, 'Rismoyo Bayu', 'inventori', 9, '1'),
(10, 10112448, 'Iqbal Aditya Pangestu', 'manager', 14, '1'),
(13, 10112233, 'Ahmad Nugraha', 'inventori', 17, '0');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`),
  KEY `constratint_id_user_pelanggan` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `no_telp`, `email`, `id_user`) VALUES
(1, 'Hardo Pratama', 'Jalan Dago No 10 Bandung', '085270050747', 'hardopratama@gmail.com', 6),
(2, 'Annisa Amelia', 'Jalan Proklamasi No 2 Banjar ', '085786834372', 'annisaamelia@gmail.com', 8),
(3, 'Ria', 'Jalan Iskandardinata no 10 Banjar', '081214478990', 'ria@gmail.com', 18),
(4, 'Asri Nurmala', 'Jalan Guntur no 38 Banjar', '085727604692', 'asrinurmala@gmail.com', 19),
(5, 'Eva Safitri', 'Jalan Pembangunan no 51 Banjar', '085720054204', 'evasafitri@gmail.com', 20),
(20, 'Ika Widya', 'Jalan Pembangunan, Banjar', '085721740036', 'ikawidya@gmail.com', 35),
(21, 'Iqbal Aditya Pangestu', 'Bandung', '081214478990', 'iqbaladityap@gmail.com', 36);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

DROP TABLE IF EXISTS `pemesanan`;
CREATE TABLE IF NOT EXISTS `pemesanan` (
  `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_pemesanan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_pemesanan` char(2) DEFAULT 'BL',
  `total_bayar` int(11) DEFAULT '0',
  `bukti_transfer` varchar(100) DEFAULT NULL,
  `tgl_pengambilan` datetime DEFAULT NULL,
  `id_pelanggan` int(11) NOT NULL,
  PRIMARY KEY (`id_pemesanan`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `tgl_pemesanan`, `status_pemesanan`, `total_bayar`, `bukti_transfer`, `tgl_pengambilan`, `id_pelanggan`) VALUES
(20, '2016-06-13 05:47:44', 'BL', 3940000, NULL, '2016-07-29 00:00:00', 1),
(22, '2016-07-26 05:59:50', 'BL', 4750000, NULL, '2016-08-25 00:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

DROP TABLE IF EXISTS `pesan`;
CREATE TABLE IF NOT EXISTS `pesan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` char(2) DEFAULT 'R',
  `isi` text,
  `status_hapus` char(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `jenis`, `isi`, `status_hapus`) VALUES
(1, 'RD', 'CV. Lumpur Mas\r\nTerima kasih telah berbelanja di toko kami.\r\nKunjungi website kami di www.lumpurmas.com\r\nKategori produk rekomendasi hari ini untuk anda adalah', '0'),
(2, 'R', 'CV. Lumpur Mas - Terima kasih telah berbelanja di toko kami.[ www.lumpurmas.com ]. Kategori produk rekomendasi hari ini untuk anda adalah ', '1'),
(3, 'RD', 'CV. Lumpur Mas - Terima kasih telah berbelanja di toko kami.[ www.lumpurmas.com ]. Selamat anda mendapatkan diskon untuk pembelian kategori produk :  ', '1');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(50) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `status_produk` char(2) DEFAULT 'TD',
  `diskon` int(2) NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT 'default.jpg',
  `status_hapus` char(1) DEFAULT '1',
  `id_kategori` int(11) DEFAULT NULL,
  `kode_produk` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id_produk`),
  UNIQUE KEY `kode_produk` (`kode_produk`),
  KEY `constraint_id_kategori` (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `status_produk`, `diskon`, `url`, `status_hapus`, `id_kategori`, `kode_produk`) VALUES
(1, 'Koala Kumal', 60000, 'TD', 0, 'cover-koala-kumal.JPG', '1', 1, 'BN0001'),
(2, 'Laskar Pelangi', 80000, 'TD', 0, 'b3-2013-08-30-novel-andrea-hirata-laskar-pelangi-ctk-22.jpg', '1', 1, 'BN0002'),
(3, 'Erlangga IPA Terpadu 3A', 45000, 'G', 0, 'buker ipa 1a.jpg', '1', 2, 'BS0001'),
(4, 'Bahasa Inggris 2A', 30000, 'G', 0, 'buker ipa 2a.jpg', '1', 2, 'BS0002'),
(5, 'Molten Bola Voli', 350000, 'G', 0, 'molten.jpg', '1', 4, 'AO0001'),
(8, 'Brontosaurus', 85000, 'TD', 0, '20151218_181629_scaled.png', '1', 1, 'BN003'),
(38, 'Spalding Bola Basket', 350000, 'G', 0, 'splading.jpg', '1', 4, 'AO0002'),
(39, 'Erlangga IPA Terpadu 2A', 30000, 'G', 0, 'buker ipa 2a.jpg', '1', 2, 'BS0003'),
(40, 'Kutinggal Dia Karena Dia', 43000, 'TD', 0, 'kutinggal_dia_karena_dia.jpg', '1', 1, 'BN004 '),
(41, 'Mencari Tuhan Yang Hilang', 60000, 'TD', 0, 'mencari-tuhan-yang-hilang.jpg', '1', 1, 'BN005'),
(42, 'Manusia Setengah Salmon', 42000, 'TD', 0, 'manusia-salmon.jpg', '1', 1, 'BN006'),
(43, 'Kiss The Rain', 45000, 'TD', 0, 'kiss-the-rain.jpg', '1', 1, 'BN007'),
(44, 'Yudistira Matematika SMP 3', 93000, 'G', 0, 'yudistira matematika 3.jpg', '1', 2, 'BS0004'),
(45, 'Raket Yonex ArcSaber Light', 250000, 'DG', 10, 'RACKET-YONEX-ARC-SABER-3-FL-MR-2.jpg', '1', 4, 'AO0003'),
(46, 'Apa Ini Cinta?', 42000, 'TD', 0, 'apa ini cinta.jpg', '1', 1, 'BN008'),
(47, 'Di Bawah Langit Jakarta', 55000, 'TD', 0, 'di bawah langit jakarta.jpg', '1', 1, 'BN0009'),
(48, 'Yudistira Kimia SMA 3', 54000, 'G', 0, 'Yudistira Kimia SMA 3.png', '1', 2, 'BS0005'),
(49, 'Erlangga Fisika SMA 3', 50000, 'G', 0, 'Erlanggan Fisika SMA 3.jpg', '1', 2, 'BS0006'),
(66, 'Ada Apa Dengan Cinta', 100000, 'G', 0, 'default.jpg', '1', 1, 'BN010'),
(68, 'Globe', 250000, 'TD', 0, 'default.jpg', '0', 6, '68'),
(69, 'Globe', 250000, 'TD', 0, 'default.jpg', '1', 3, 'AP0001'),
(70, 'Pesil', 2500, 'TD', 0, 'default.jpg', '1', 5, 'ATK001');

-- --------------------------------------------------------

--
-- Table structure for table `promosi`
--

DROP TABLE IF EXISTS `promosi`;
CREATE TABLE IF NOT EXISTS `promosi` (
  `id_promosi` int(11) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT 'Y',
  `url` varchar(100) DEFAULT 'default.jpg',
  `id_pegawai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_promosi`),
  KEY `constratint_id_pegawai` (`id_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promosi`
--

INSERT INTO `promosi` (`id_promosi`, `status`, `url`, `id_pegawai`) VALUES
(2, 'Y', 'WallpaperStudio10-1327.jpg', NULL),
(3, 'Y', 'WallpaperStudio10-12301.jpg', NULL),
(4, 'Y', 'WallpaperStudio10-19280.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi`
--

DROP TABLE IF EXISTS `rekomendasi`;
CREATE TABLE IF NOT EXISTS `rekomendasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  `pesan` varchar(160) DEFAULT NULL,
  `kategori_produk` varchar(50) DEFAULT NULL,
  `status_kirim` char(2) DEFAULT 'BD',
  `id_transaksi` int(11) DEFAULT NULL,
  `id_pesan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_transaksi` (`id_transaksi`),
  KEY `id_pesan` (`id_pesan`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekomendasi`
--

INSERT INTO `rekomendasi` (`id`, `nama`, `no_telp`, `pesan`, `kategori_produk`, `status_kirim`, `id_transaksi`, `id_pesan`) VALUES
(30, 'Eva Safitri', '085720054204', NULL, 'Buku Sekolah', 'SD', NULL, 2),
(31, 'Ria', '081214478990', NULL, 'Buku Sekolah', 'SD', NULL, 3),
(32, 'Asri Nurmala', '085727604692', NULL, 'Buku Sekolah', 'SD', NULL, 3),
(33, 'Eva Safitri', '085720054204', NULL, 'Novel', 'SD', NULL, 2),
(34, 'Ria', '081214478990', NULL, 'Buku Sekolah', 'SD', NULL, 3),
(35, 'Asri Nurmala', '085727604692', NULL, 'Buku Sekolah', 'SD', NULL, 3),
(36, 'Eva Safitri', '085720054204', NULL, 'Novel', 'SD', NULL, 2),
(37, 'Ria', '081214478990', NULL, 'Buku Sekolah', 'SD', NULL, 3),
(38, 'Asri Nurmala', '085727604692', NULL, 'Buku Sekolah', 'SD', NULL, 3),
(39, 'Eva Safitri', '085720054204', NULL, 'Novel', 'SD', NULL, 2),
(40, 'Ria', '081214478990', NULL, 'Buku Sekolah', 'SD', NULL, 3),
(43, 'Ria', '081214478990', NULL, 'Buku Sekolah', 'SD', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_transaksi` char(2) DEFAULT 'BL',
  `nama_garansi` varchar(30) DEFAULT NULL,
  `telp_garansi` varchar(12) DEFAULT NULL,
  `total_bayar` int(11) NOT NULL DEFAULT '0',
  `id_pelanggan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `constraint_id_pelanggan_trans` (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tgl_transaksi`, `status_transaksi`, `nama_garansi`, `telp_garansi`, `total_bayar`, `id_pelanggan`) VALUES
(86, '2016-07-04 00:00:00', 'L', 'Ria', '081214478990', 283000, 3),
(87, '2016-07-04 00:00:00', 'L', 'Eva Safitri', '085720054204', 104000, 5),
(88, '2016-07-04 00:00:00', 'L', 'Asri Nurmala', '085727604692', 347000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status_hapus` char(1) DEFAULT '1',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `status_hapus`) VALUES
(2, 'direktur', '4fbfd324f5ffcdff5dbf6f019b02eca8', '1'),
(4, 'administrasi', '15ff3c0a0310a2e3de3e95c8aeb328d0', '1'),
(5, 'pemasaran', '229eaac0894a3379d759a720e0e3410c', '1'),
(6, 'pelanggan', 'pelanggan', '1'),
(8, 'pengunjung2', 'e55093db9c1fcfc25152e7ca2c6d3cab', '1'),
(9, 'inventori', '4e943c28c3b011e0540ff9a19334953b', '1'),
(14, 'manager', '1d0258c2440a8d19e716292b231e3190', '1'),
(17, '17', '965dabeb1ed76937028796eec8daa5d4', '0'),
(18, 'ria', '552ef513f00c07030d1e21e94ce17854', '1'),
(19, 'asrinurmala', '48feb56abc3e86dd649d46ee0fb670fb', '1'),
(20, 'evasafitri', '7a33e86c33a4061c5d2e11d2b50d7308', '1'),
(35, 'ika', '7965c82127bd8517d2495e8efb12702c', '1'),
(36, 'iqbaaladitya', '290c5e549acedf53f19acde5cadaf789', '1');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_produk_dibeli`
--
DROP VIEW IF EXISTS `v_produk_dibeli`;
CREATE TABLE IF NOT EXISTS `v_produk_dibeli` (
`nama_kategori` varchar(30)
);

-- --------------------------------------------------------

--
-- Structure for view `v_produk_dibeli`
--
DROP TABLE IF EXISTS `v_produk_dibeli`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_produk_dibeli`  AS  select distinct `kategori_produk`.`nama_kategori` AS `nama_kategori` from (((`kategori_produk` join `produk`) join `detail_transaksi`) join `transaksi`) where (((`produk`.`id_kategori` = `kategori_produk`.`id_kategori`) and (`detail_transaksi`.`id_produk` = `produk`.`id_produk`) and (`transaksi`.`id_transaksi` = `detail_transaksi`.`id_transaksi`) and (`transaksi`.`nama_garansi` = 'Ria')) or ((`produk`.`id_kategori` = `kategori_produk`.`id_kategori`) and (`detail_transaksi`.`id_produk` = `produk`.`id_produk`) and (`transaksi`.`id_transaksi` = `detail_transaksi`.`id_transaksi`) and (`transaksi`.`nama_garansi` = 'Asri Nurmala') and (not(`kategori_produk`.`nama_kategori` in (select `kategori_produk`.`nama_kategori` from (((`kategori_produk` join `produk`) join `detail_transaksi`) join `transaksi`) where ((`produk`.`id_kategori` = `kategori_produk`.`id_kategori`) and (`detail_transaksi`.`id_produk` = `produk`.`id_produk`) and (`transaksi`.`id_transaksi` = `detail_transaksi`.`id_transaksi`) and (`transaksi`.`nama_garansi` = 'Ria') and (not(`kategori_produk`.`nama_kategori` in (select `kategori_produk`.`nama_kategori` from (((`kategori_produk` join `produk`) join `detail_transaksi`) join `transaksi`) where ((`produk`.`id_kategori` = `kategori_produk`.`id_kategori`) and (`detail_transaksi`.`id_produk` = `produk`.`id_produk`) and (`transaksi`.`id_transaksi` = `detail_transaksi`.`id_transaksi`) and (`transaksi`.`nama_garansi` = 'Asri Nurmala'))))))))))) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pemesanan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `constraint_id_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `constraint_id_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keluhan`
--
ALTER TABLE `keluhan`
  ADD CONSTRAINT `keluhan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `constratint_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `constratint_id_user_pelanggan` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `constraint_id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_produk` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promosi`
--
ALTER TABLE `promosi`
  ADD CONSTRAINT `constratint_id_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD CONSTRAINT `rekomendasi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekomendasi_ibfk_2` FOREIGN KEY (`id_pesan`) REFERENCES `pesan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `constraint_id_pelanggan_trans` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
