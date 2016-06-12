-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2016 at 04:49 PM
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
  `jumlah_beli` int(3) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

DROP TABLE IF EXISTS `kategori_produk`;
CREATE TABLE IF NOT EXISTS `kategori_produk` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Novel'),
(2, 'Buku Sekolah'),
(3, 'Alat Peraga'),
(4, 'Alat Olahraga'),
(5, 'ATK');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluhan`
--

INSERT INTO `keluhan` (`id_keluhan`, `tgl_keluhan`, `isi_keluhan`, `foto_keluhan`, `foto_struk`, `status`, `pesan_respon`, `id_pelanggan`) VALUES
(7, '2016-06-01 15:27:42', 'Halaman Buku nya ada yang rusak pa', 'rusak.png', 'Struk.jpg', 'BR', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keluhan_saran`
--

DROP TABLE IF EXISTS `keluhan_saran`;
CREATE TABLE IF NOT EXISTS `keluhan_saran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subjek` varchar(30) DEFAULT NULL,
  `tgl_keluhansaran` datetime DEFAULT NULL,
  `isi_keluhansaran` text,
  `status_keluhansaran` char(1) DEFAULT NULL,
  `url_foto_struk` varchar(100) DEFAULT NULL,
  `url_foto_keluhan` varchar(100) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `constraint_id_pelanggan_keluhan` (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keluhan_saran`
--

INSERT INTO `keluhan_saran` (`id`, `subjek`, `tgl_keluhansaran`, `isi_keluhansaran`, `status_keluhansaran`, `url_foto_struk`, `url_foto_keluhan`, `id_pelanggan`) VALUES
(1, 'Pemesanan', '2016-05-06 00:00:00', 'Pemesanan buku dengan ID=TRX0001 belum sampai ke sekolah kami', 'B', NULL, NULL, 1);

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
  `id_pelanggan` int(11) NOT NULL,
  PRIMARY KEY (`id_kritiksaran`),
  KEY `id_pelanggan` (`id_pelanggan`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kritiksaran`
--

INSERT INTO `kritiksaran` (`id_kritiksaran`, `tgl_kritiksaran`, `status_kritiksaran`, `isi_kritiksaran`, `id_pelanggan`) VALUES
(1, '2016-06-01 16:26:49', 'BR', 'Pelayanan nya kurang cepat, tolong di tingkatkan kembali', 1);

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_pegawai` (`id_pegawai`),
  KEY `constratint_id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `id_pegawai`, `nama`, `jabatan`, `id_user`) VALUES
(2, 10112645, 'Mohamad Ihsan', 'direktur', 2),
(4, 10112637, 'Irfan Rangga Gumilar', 'administrasi', 4),
(5, 10112438, 'Julio Febryanto', 'pemasaran', 5),
(7, 10112711, 'Rismoyo Bayu', 'inventori', 9),
(10, 10112448, 'Iqbal Aditya Pangestu', 'manager', 14),
(13, 10112233, 'Ahmad Nugraha', 'inventori', 17);

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
  `poin` int(4) DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`),
  KEY `constratint_id_user_pelanggan` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `no_telp`, `email`, `poin`, `id_user`) VALUES
(1, 'Hardo Pratama', 'Jalan Dipati Ukur No 10 Bandung', '085720054204', NULL, 0, 6),
(2, 'Annisa Amelia', 'Jalan Simpay Asih No 2 Bandung', '087720054255', NULL, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

DROP TABLE IF EXISTS `pemesanan`;
CREATE TABLE IF NOT EXISTS `pemesanan` (
  `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_pemesanan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_pemesanan` enum('BL','L') NOT NULL DEFAULT 'BL',
  `total_bayar` int(11) DEFAULT '0',
  `bukti_transfer` varchar(100) DEFAULT NULL,
  `tgl_pengambilan` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_pelanggan` int(11) NOT NULL,
  PRIMARY KEY (`id_pemesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(50) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `status_produk` char(1) DEFAULT NULL,
  `url` varchar(255) DEFAULT 'default.jpg',
  `id_kategori` int(11) DEFAULT NULL,
  `kode_produk` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id_produk`),
  UNIQUE KEY `kode_produk` (`kode_produk`),
  KEY `constraint_id_kategori` (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `status_produk`, `url`, `id_kategori`, `kode_produk`) VALUES
(1, 'Koala Kumal', 60000, 'D', 'cover-koala-kumal.JPG', 1, 'BN0001'),
(2, 'Laskar Pelangi', 80000, 'D', 'b3-2013-08-30-novel-andrea-hirata-laskar-pelangi-ctk-22.jpg', 1, 'BN0002'),
(3, 'Erlangga IPA Terpadu 3A', 45000, 'N', 'buker ipa 1a.jpg', 2, 'BS0001'),
(4, 'Bahasa Inggris 2A', 30000, 'N', 'buker ipa 2a.jpg', 2, 'BS0002'),
(5, 'Molten Bola Voli', 350000, 'D', 'molten.jpg', 4, 'AO0001'),
(8, 'Brontosaurus', 85000, NULL, '20151218_181629_scaled.png', 1, 'BN003'),
(38, 'Spalding Bola Basket', 350000, NULL, 'splading.jpg', 4, 'AO0002'),
(39, 'Erlangga IPA Terpadu 2A', 30000, NULL, 'buker ipa 2a.jpg', 2, 'BS0003');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

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
  `produk_rekomendasi` varchar(30) NOT NULL,
  `pesan` varchar(160) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kategori` (`id_kategori`) USING BTREE,
  KEY `id_pelanggan` (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_transaksi` char(2) DEFAULT NULL,
  `nama_garansi` varchar(30) DEFAULT NULL,
  `telp_garansi` varchar(12) DEFAULT NULL,
  `total_bayar` int(11) NOT NULL DEFAULT '0',
  `id_pelanggan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `constraint_id_pelanggan_trans` (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(2, 'direktur', '4fbfd324f5ffcdff5dbf6f019b02eca8'),
(4, 'administrasi', '15ff3c0a0310a2e3de3e95c8aeb328d0'),
(5, 'pemasaran', '229eaac0894a3379d759a720e0e3410c'),
(6, 'pengunjung', '3fbe7200a4b9a894e16c9d998314dc80'),
(8, 'pengunjung2', 'e55093db9c1fcfc25152e7ca2c6d3cab'),
(9, 'inventori', '4e943c28c3b011e0540ff9a19334953b'),
(14, 'manager', '1d0258c2440a8d19e716292b231e3190'),
(17, 'ahmadnugraha', '965dabeb1ed76937028796eec8daa5d4');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `constraint_id_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `constraint_id_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keluhan_saran`
--
ALTER TABLE `keluhan_saran`
  ADD CONSTRAINT `constraint_id_pelanggan_keluhan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `constraint_id_kategori_rek` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_produk` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `constraint_id_pelanggan_trans` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
