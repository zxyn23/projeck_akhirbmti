-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2025 at 08:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek-fajar`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `level` varchar(2) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nama`, `username`, `password`, `level`) VALUES
(21, 'mahasiswa', 'mahasiswa', '$2y$10$zihdNAfR7C7AtzKArMwzIePmSqUTAkGjUSzNZMbn5ZYnVyEF3s0L.', '1');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`) VALUES
(13, 'kartus'),
(21, 'penggaris');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(2, 'Teknik Mesin'),
(6, 'Teknik Kimia'),
(7, 'Teknik Informatika'),
(8, 'Teknik Elektro');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nim` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `prodi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `jk` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama`, `prodi`, `jk`, `alamat`, `tanggal`) VALUES
(30, 'D1121111007', 'MOCHAMMAD FAJAR FADHILLAH', 'Teknik Elektro', 'Laki Laki', 'Jalan', '2025-05-18 21:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telepon` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `jabatan`, `email`, `telepon`, `alamat`) VALUES
(1, 'naufal', 'wakil Direktur', 'naufal@gmail.com', '08238665349', 'cimahi'),
(2, 'ajay', 'Direktur', 'ajay@gmail.com', '082119394245634', 'Bandung');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
