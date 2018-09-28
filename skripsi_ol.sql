-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2018 at 05:24 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_ol`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokumen`
--

CREATE TABLE `tbl_dokumen` (
  `id_dok` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `validasi` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dokumen`
--

INSERT INTO `tbl_dokumen` (`id_dok`, `nim`, `jurusan`, `judul`, `validasi`) VALUES
(3, 1001, 'Teknik Informatika', 'Implementasi Data Mining Untuk Menentukan Beasiswa Menggunakan Algoritma C4.5', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dosen`
--

CREATE TABLE `tbl_dosen` (
  `id_dosen` int(20) NOT NULL,
  `nm_dosen` varchar(50) NOT NULL,
  `fakultas` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dosen`
--

INSERT INTO `tbl_dosen` (`id_dosen`, `nm_dosen`, `fakultas`, `status`, `jabatan`, `alamat`, `no_telp`, `email`) VALUES
(101025, 'Istiqoma Sumadikarta, ST., M.Kom', 'Teknik', 'Dosen Tetap', 'Kepala PUSTIKOM', 'Jl. Satu', '08823456789', 'istiqomah@gmail.com'),
(101026, 'Berlin Sitorus S.Kom., M.Kom', 'Teknik', 'Dosen Tetap', 'Kajur Sistem Informasi', 'Jl. Dua', '08823456788', 'berlin.sitorus@gmail.com'),
(101027, 'Zulkifli S.Kom., M.Kom', 'Teknik', 'Dosen Tetap', 'Kajur Teknik', 'Jl. Tiga', '08823456787', 'zulkifli.mkom@gmail.com'),
(101028, 'Pradono Budi Saputro, M.SI', 'Fisip', 'Dosen Tetap', 'Kajur Fisip', 'Jl. Limo', '08823456786', 'pradono.bs@gmail.com'),
(101030, 'Faizal Zuli, S.Kom., M.Kom', 'Teknik', 'Dosen Tetap', 'Dosen', 'Jl. Dodol', '08823456785', 'faizal.zuli@gmail.com'),
(101032, 'Safrizal, ST., MM', 'Fisip', 'Dosen Tetap', 'Dosen', 'Jl. Samsak', '08884754650', 'safrizal.st.mm@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mhs`
--

CREATE TABLE `tbl_mhs` (
  `nim` int(30) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `fakultas` varchar(50) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `pembimbing1` varchar(30) NOT NULL,
  `pembimbing2` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mhs`
--

INSERT INTO `tbl_mhs` (`nim`, `nama_mhs`, `fakultas`, `jurusan`, `pembimbing1`, `pembimbing2`) VALUES
(1001, 'Arnold Rozak', 'Teknik', 'Teknik Informatika', '101025', '101026'),
(1002, 'Muhammad Unggul Wicaksono', 'Teknik', 'Teknik Informatika', '101025', '101026'),
(1003, 'Muhammad Rizkyanto', 'Teknik', 'Teknik Informatika', '101027', '101030'),
(1004, 'Fajar Agus Mulyono', 'Teknik', 'Teknik Informatika', '101027', '101030'),
(1005, 'Raezal Septiawan', 'Teknik', 'Teknik Informatika', '101028', '101032'),
(1006, 'Prabandini', 'Teknik', 'Teknik Informatika', '101025', '101026'),
(1007, 'Windani', 'Fisip', 'Ilmu Komunikasi', '101028', '101032'),
(1008, 'Moelyani', 'Fisip', 'Ilmu Hubungan Internasional', '101028', '101032');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` enum('kajur','dosen','mahasiswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Kajur', 'kajur'),
(2, 'dosen', 'ce28eed1511f631af6b2a7bb0a85d636', 'Dosen', 'dosen'),
(3, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Mahasiswa', 'mahasiswa'),
(5, '1001', 'b8c37e33defde51cf91e1e03e51657da', 'Arnold Rozak', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  ADD PRIMARY KEY (`id_dok`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `tbl_mhs`
--
ALTER TABLE `tbl_mhs`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  MODIFY `id_dok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  MODIFY `id_dosen` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101033;

--
-- AUTO_INCREMENT for table `tbl_mhs`
--
ALTER TABLE `tbl_mhs`
  MODIFY `nim` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  ADD CONSTRAINT `fk_nim_judul` FOREIGN KEY (`nim`) REFERENCES `tbl_mhs` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
