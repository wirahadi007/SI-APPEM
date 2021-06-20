-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 09, 2021 at 09:16 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siap-lapor`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggaran`
--

CREATE TABLE `anggaran` (
  `id_anggaran` int(11) NOT NULL,
  `anggaran` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggaran`
--

INSERT INTO `anggaran` (`id_anggaran`, `anggaran`, `nama`) VALUES
(1, 500000, 'printer'),
(2, 1000000, 'laptop'),
(3, 1500000, 'pc'),
(4, 1500000, 'scanner'),
(6, 2000000, 'ac');

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE `bagian` (
  `id_bagian` int(11) NOT NULL,
  `bagian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`id_bagian`, `bagian`) VALUES
(1, 'Umum'),
(2, 'Hukum'),
(3, 'pidana'),
(4, 'perdata'),
(5, 'ptip'),
(6, 'hakim'),
(7, 'kepegawaian'),
(8, 'hakim2'),
(9, 'ptsp'),
(10, 'sekretaris'),
(11, 'panitera'),
(12, 'r.ketua'),
(13, 'r.wakil');

-- --------------------------------------------------------

--
-- Table structure for table `hasilservice`
--

CREATE TABLE `hasilservice` (
  `id_service` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasilservice`
--

INSERT INTO `hasilservice` (`id_service`, `status`) VALUES
(1, 'Normal'),
(2, 'Rusak Ringan'),
(3, 'Rusak Berat');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenis` varchar(50) NOT NULL,
  `jenis_brg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis`, `jenis_brg`) VALUES
('1', 'Printer'),
('2', 'Laptop'),
('3', 'Pc'),
('4', 'Scanner'),
('5', 'Ac'),
('6', 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi`
--

CREATE TABLE `kondisi` (
  `id_kondisi` int(11) NOT NULL,
  `kondisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kondisi`
--

INSERT INTO `kondisi` (`id_kondisi`, `kondisi`) VALUES
(1, 'Baik'),
(2, 'Rusak Ringan'),
(3, 'Rusak Berat');

-- --------------------------------------------------------

--
-- Table structure for table `laporanservice`
--

CREATE TABLE `laporanservice` (
  `id_laporan` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `tgl_laporan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_bulanan`
--

CREATE TABLE `laporan_bulanan` (
  `id` int(25) NOT NULL,
  `unit` varchar(25) NOT NULL,
  `kode_brg` varchar(50) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `nup` int(25) NOT NULL,
  `id_kondisi` int(11) NOT NULL,
  `tgl_lapor` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_sementara`
--

CREATE TABLE `laporan_sementara` (
  `id_sementara` int(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `kode_brg` varchar(50) NOT NULL,
  `nup` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `kondisi` varchar(17) NOT NULL,
  `tgl_lapor` date NOT NULL,
  `deskripsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `kode_brg` varchar(100) NOT NULL,
  `nup` varchar(100) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `tgl_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `pengeluaran`
--
DELIMITER $$
CREATE TRIGGER `TG_STOK_UPDATE` AFTER INSERT ON `pengeluaran` FOR EACH ROW BEGIN
	update stokbarang SET keluar=keluar + NEW.jumlah, 
	sisa=stok-keluar WHERE 
	kode_brg = NEW.kode_brg;

	update permintaan SET status=1 WHERE kode_brg=NEW.kode_brg AND 
	unit=NEW.unit;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id_permintaan` int(100) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `kode_brg` varchar(100) NOT NULL,
  `nup` varchar(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `jumlah` int(20) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sementara`
--

CREATE TABLE `sementara` (
  `id_sementara` int(100) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `kode_brg` varchar(100) NOT NULL,
  `nup` varchar(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `jumlah` int(20) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stokbarang`
--

CREATE TABLE `stokbarang` (
  `kode_brg` varchar(25) NOT NULL,
  `id_jenis` int(2) NOT NULL,
  `nama_brg` varchar(30) NOT NULL,
  `nup` varchar(11) NOT NULL,
  `bagian` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `stok` int(100) NOT NULL,
  `keluar` int(50) DEFAULT NULL,
  `sisa` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stokbarang`
--

INSERT INTO `stokbarang` (`kode_brg`, `id_jenis`, `nama_brg`, `nup`, `bagian`, `tgl_masuk`, `stok`, `keluar`, `sisa`) VALUES
('3100203004', 4, 'HP Scanjet 5590', '1', 9, '2021-03-17', 0, 0, 0),
('3100102002', 2, 'Toshiba', '10', 4, '2021-03-17', 910000, 50000, 860000),
('3100102002', 2, 'Fujitsu11', '11', 1, '2021-03-17', 910000, 50000, 860000),
('3100102002', 2, 'Fujitsu12', '12', 1, '2021-03-17', 910000, 50000, 860000),
('3100102001', 3, 'Pc Relion', '13', 1, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Relion', '14', 1, '2021-03-17', 1256364, 0, 1256364),
('3100102002', 2, 'Toshiba', '14l', 5, '2021-03-17', 910000, 50000, 860000),
('3100102002', 2, 'Toshiba', '15', 6, '2021-03-17', 910000, 50000, 860000),
('3100102002', 2, 'Toshiba', '16', 6, '2021-03-17', 910000, 50000, 860000),
('3100102001 ', 3, 'Pc ', '17', 4, '2021-03-17', 1256364, 0, 1256364),
('3100102002', 2, 'Toshiba', '18', 13, '2021-03-17', 910000, 50000, 860000),
('3100102002', 2, 'Toshiba', '19', 10, '2021-03-17', 910000, 50000, 860000),
('3100203004', 4, 'Fujitsu', '2', 3, '2021-03-17', 0, 0, 0),
('3100102001 ', 3, 'Pc Lenovo', '20', 7, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '21', 5, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '22', 1, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '23', 4, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '24', 3, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '25', 1, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '26', 4, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '27', 2, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '28', 3, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '29', 1, '2021-03-17', 1256364, 0, 1256364),
('3100102001', 3, 'acer', '3', 1, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '30', 4, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '31', 2, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '32', 9, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'HP AIO pro One 600 g5', '33', 9, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'HP AIO pro One 600 g5', '34', 9, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'HP AIO pro One 600 g5', '35', 9, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'HP AIO pro One 600 g5', '36', 9, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '37', 5, '2021-03-17', 1256364, 0, 1256364),
('3100102001 ', 3, 'Pc Lenovo', '38', 9, '2021-03-17', 1256364, 0, 1256364),
('3100203003', 1, 'Cannon Pixma', '39', 6, '2021-03-17', 0, 0, 0),
('3100203004', 4, 'Scab snap', '4', 2, '2021-03-17', 0, 0, 0),
('3100203003', 1, 'Cannon Pixma', '40', 2, '2021-03-17', 0, 0, 0),
('3100203003', 1, 'Cannon Pixma', '42', 9, '2021-03-17', 0, 0, 0),
('3100203003', 1, 'Cannon Pixma G1010', '43', 4, '2021-03-17', 0, 0, 0),
('3100203003', 1, 'Cannon Pixma G1010', '44', 3, '2021-03-17', 0, 0, 0),
('3100203003', 1, 'Canon 2010', '46', 3, '2021-03-17', 0, 0, 0),
('3100203003', 1, 'Canon 2010', '47', 5, '2021-03-17', 0, 0, 0),
('3100203003', 1, 'Canon 2010', '48', 1, '2021-03-17', 0, 0, 0),
('3100203003', 1, 'Canon 2010', '49', 10, '2021-03-17', 0, 0, 0),
('3100102001 ', 2, 'Toshiba L630', '5', 5, '2021-03-17', 1256364, 0, 1256364),
('3100102002', 2, 'Toshiba', '6', 7, '2021-03-17', 910000, 50000, 860000),
('3100102002', 2, 'Toshiba L630', '7', 10, '2021-03-17', 910000, 50000, 860000),
('3100102002', 2, 'Toshiba', '8', 11, '2021-03-17', 910000, 50000, 860000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','pkk','umum','hukum','pidana','perdata','ptip','teknisi','hakim1','hakim2','ketua','wakil','kepegawaian','sekretaris') NOT NULL,
  `manajer` varchar(50) NOT NULL,
  `asmen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `manajer`, `asmen`) VALUES
(1, 'Admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'admin', 'ketua'),
(2, 'PPK', 'e10adc3949ba59abbe56e057f20f883e', 'pkk', 'ketua', 'wakil'),
(3, 'umum', 'e10adc3949ba59abbe56e057f20f883e', 'umum', 'admin', 'wakil'),
(4, 'pidana', 'e10adc3949ba59abbe56e057f20f883e', 'pidana', 'admin', 'ppk'),
(5, 'hukum', 'e10adc3949ba59abbe56e057f20f883e', 'hukum', 'admin', 'ketua'),
(6, 'perdata', 'e10adc3949ba59abbe56e057f20f883e', 'perdata', 'admin', 'ketua'),
(7, 'ptip', 'e10adc3949ba59abbe56e057f20f883e', 'ptip', 'admin', 'ketua'),
(8, 'teknisi', 'e10adc3949ba59abbe56e057f20f883e', 'teknisi', 'admin', 'ppk'),
(9, 'hakim1', 'e10adc3949ba59abbe56e057f20f883e', 'hakim1', 'admin', 'pkk'),
(11, 'sekretaris', 'e10adc3949ba59abbe56e057f20f883e', 'sekretaris', 'ketua', 'wakil');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id_anggaran`);

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indexes for table `hasilservice`
--
ALTER TABLE `hasilservice`
  ADD PRIMARY KEY (`id_service`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indexes for table `laporanservice`
--
ALTER TABLE `laporanservice`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `laporan_bulanan`
--
ALTER TABLE `laporan_bulanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_sementara`
--
ALTER TABLE `laporan_sementara`
  ADD PRIMARY KEY (`id_sementara`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id_permintaan`),
  ADD KEY `id_permintaan` (`id_permintaan`) USING BTREE,
  ADD KEY `id_permintaan_2` (`id_permintaan`) USING BTREE;

--
-- Indexes for table `sementara`
--
ALTER TABLE `sementara`
  ADD PRIMARY KEY (`id_sementara`),
  ADD KEY `id_sementara` (`id_sementara`);

--
-- Indexes for table `stokbarang`
--
ALTER TABLE `stokbarang`
  ADD PRIMARY KEY (`nup`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laporanservice`
--
ALTER TABLE `laporanservice`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `laporan_bulanan`
--
ALTER TABLE `laporan_bulanan`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_sementara`
--
ALTER TABLE `laporan_sementara`
  MODIFY `id_sementara` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id_permintaan` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sementara`
--
ALTER TABLE `sementara`
  MODIFY `id_sementara` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
