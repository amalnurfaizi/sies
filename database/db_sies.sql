-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2023 at 02:34 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sies`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(30) NOT NULL,
  `tanggal_ditambah` datetime NOT NULL DEFAULT current_timestamp(),
  `tanggal_diperbarui` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nisn` varchar(12) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(12) NOT NULL,
  `id_ekskul` int(30) DEFAULT NULL,
  `kelas` tinyint(2) NOT NULL,
  `jurusan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `tanggal_ditambah`, `tanggal_diperbarui`, `nama_lengkap`, `email`, `nisn`, `no_hp`, `alamat`, `jenis_kelamin`, `id_ekskul`, `kelas`, `jurusan`) VALUES
(2, '2022-11-22 14:21:39', '2022-11-22 14:21:39', 'asdasd', 'tatalungga3@gmail.com', 'asdasd', '0895619094346', 'Pekanbaru', 'laki-laki', NULL, 11, 'jaringan komputer'),
(4, '2022-11-22 14:22:31', '2022-11-22 14:22:31', 'asdasd', 'tatalungga3@gmail.com', 'asdasd', '0895619094346', 'Pekanbaru', 'laki-laki', NULL, 10, 'asdasdas'),
(5, '2022-11-22 15:08:02', '2022-11-22 15:08:02', 'asdasdas', 'asdasdasd@gmail.com', '111111', '0895619094346', 'Pekanbaru', 'perempuan', NULL, 12, 'asdasdasd'),
(6, '2022-12-01 14:09:02', '2022-12-01 14:09:02', 'ucok', 'tatalungga3@gmail.com', '42123', '0895619094346', 'Pekanbaru', 'laki-laki', NULL, 10, 'asdasdasd'),
(7, '2022-12-08 22:42:23', '2022-12-08 22:42:23', 'ikhsan', 'asdasdasd@gmail.com', '321123', 'asdasd', 'asdasd', 'laki-laki', NULL, 12, 'asdasd'),
(8, '2022-12-08 22:42:48', '2022-12-08 22:42:48', 'asdasd', 'asdasd@sample.com', 'asdasd', 'asdasd', 'asdasd', 'laki-laki', NULL, 10, 'asdasd'),
(9, '2022-12-08 23:44:35', '2022-12-08 23:44:35', 'asd', 'asdasdasd@gmail.com', 'asd', 'asd', 'asd', 'laki-laki', NULL, 10, 'asdasd'),
(10, '2022-12-09 18:32:57', '2022-12-09 18:32:57', 'udinese', 'tatalungga3@gmail.com', '1234567890', '0895619094346', 'Pekanbaru', 'laki-laki', NULL, 10, 'asdasdasd'),
(11, '2022-12-13 17:48:49', '2022-12-13 17:48:49', 'Ikhsan Dwi Saputra', 'tatalungga3@gmail.com', '321123', '0895619094346', 'Pekanbaru', 'laki-laki', NULL, 12, 'asdasdas'),
(12, '2022-12-14 12:15:16', '2022-12-14 12:15:16', 'Ikhsan Dwi Saputra', 'tatalungga3@gmail.com', '321123', '0895619094346', 'Pekanbaru', 'laki-laki', NULL, 10, 'jaringan komputer'),
(15, '2022-12-14 22:32:16', '2022-12-14 22:32:16', 'Ikhsan Dwi Saputra', 'tatalungga3@gmail.com', '1234567890', '088888888888', 'Pekanbaru', 'laki-laki', 47, 12, 'animasi'),
(16, '2022-12-14 22:35:20', '2022-12-14 22:35:20', 'Jeremy Fauziah', 'jeremy@gmail.com', '1432568790', '08912321231', ' Jl Rawa Gelam Bl 36/6', 'laki-laki', 47, 12, 'analis kimia'),
(17, '2022-12-14 22:36:41', '2022-12-14 22:36:41', 'Aldo Widyatama', 'aldo@gmail.com', '8787876545', '087651253212', 'JL. Jend. A. Yani Km.3 No. 104', 'laki-laki', 47, 10, 'bisnis dan pemasaran'),
(20, '2022-12-20 19:55:33', '2022-12-20 19:55:33', 'asdasd', 'tatalungga3@gmail.com', '321123', '0895619094346', 'Pekanbaru', 'laki-laki', NULL, 10, 'jaringan komputer'),
(22, '2022-12-24 15:15:33', '2022-12-24 15:15:33', 'asdasd', 'tatalungga3@gmail.com', '123123', '0895619094346', 'Pekanbaru', 'laki-laki', 48, 10, 'jaringan komputer'),
(24, '2023-01-02 11:56:43', '2023-01-02 11:56:43', 'Rozi Saputra', 'rozi@gmail.com', '1234567890', '080808080808', 'Kualu, Pekanbaru', 'laki-laki', 47, 12, 'jaringan komputer'),
(25, '2023-01-02 11:58:32', '2023-01-02 11:58:32', 'Khafiz Sholata', 'khafiz@gmail.com', '1233211231', '089898989898', 'Jln. Merpati Sakti,  Pekanbaru', 'laki-laki', 47, 12, 'Pembangunan');

-- --------------------------------------------------------

--
-- Table structure for table `catatan_kehadiran`
--

CREATE TABLE `catatan_kehadiran` (
  `id_kehadiran` int(30) NOT NULL,
  `tanggal_dibuat` datetime NOT NULL DEFAULT current_timestamp(),
  `id` int(30) NOT NULL,
  `id_anggota` int(30) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0=absen,1=hadir,2=terlambat, 3=sakit/izin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catatan_kehadiran`
--

INSERT INTO `catatan_kehadiran` (`id_kehadiran`, `tanggal_dibuat`, `id`, `id_anggota`, `type`) VALUES
(1, '2022-11-29 20:43:23', 1, 2, 1),
(1, '2022-11-29 20:43:23', 2, 4, 1),
(1, '2022-11-29 20:43:23', 3, 5, 0),
(2, '2022-11-29 22:06:21', 4, 2, 1),
(2, '2022-11-29 22:06:21', 5, 4, 1),
(2, '2022-11-29 22:06:21', 6, 5, 1),
(3, '2022-11-29 22:06:32', 7, 2, 0),
(3, '2022-11-29 22:06:32', 8, 4, 1),
(3, '2022-11-29 22:06:32', 9, 5, 1),
(4, '2022-11-29 22:43:25', 10, 2, 3),
(4, '2022-11-29 22:43:25', 11, 4, 3),
(4, '2022-11-29 22:43:25', 12, 5, 3),
(5, '2022-12-01 08:55:19', 13, 2, 1),
(5, '2022-12-01 08:55:19', 14, 4, 1),
(5, '2022-12-01 08:55:19', 15, 5, 1),
(6, '2022-12-01 14:14:47', 16, 2, 1),
(6, '2022-12-01 14:14:47', 17, 4, 1),
(6, '2022-12-01 14:14:47', 18, 5, 1),
(6, '2022-12-01 14:14:47', 19, 6, 1),
(7, '2022-12-01 14:15:54', 20, 2, 1),
(7, '2022-12-01 14:15:54', 21, 4, 1),
(7, '2022-12-01 14:15:54', 22, 5, 1),
(7, '2022-12-01 14:15:54', 23, 6, 1),
(8, '2022-12-08 22:47:09', 24, 7, 1),
(8, '2022-12-08 22:47:09', 25, 8, 1),
(9, '2022-12-08 23:14:15', 26, 7, 0),
(9, '2022-12-08 23:14:15', 27, 8, 0),
(10, '2022-12-08 23:14:46', 28, 7, 0),
(10, '2022-12-08 23:14:46', 29, 8, 0),
(11, '2022-12-08 23:15:06', 30, 7, 1),
(11, '2022-12-08 23:15:06', 31, 8, 1),
(12, '2022-12-08 23:15:20', 32, 7, 0),
(12, '2022-12-08 23:15:20', 33, 8, 0),
(13, '2022-12-08 23:16:03', 34, 7, 1),
(13, '2022-12-08 23:16:03', 35, 8, 1),
(14, '2022-12-08 23:17:16', 36, 7, 3),
(14, '2022-12-08 23:17:16', 37, 8, 1),
(15, '2022-12-09 00:20:01', 38, 7, 1),
(15, '2022-12-09 00:20:01', 39, 8, 1),
(15, '2022-12-09 00:20:01', 40, 9, 1),
(16, '2022-12-09 00:29:55', 41, 7, 1),
(16, '2022-12-09 00:29:55', 42, 8, 1),
(16, '2022-12-09 00:29:55', 43, 9, 1),
(17, '2022-12-09 00:31:31', 44, 7, 1),
(17, '2022-12-09 00:31:31', 45, 8, 1),
(17, '2022-12-09 00:31:31', 46, 9, 1),
(18, '2022-12-09 18:33:56', 47, 7, 1),
(18, '2022-12-09 18:33:56', 48, 8, 1),
(18, '2022-12-09 18:33:56', 49, 9, 1),
(18, '2022-12-09 18:33:56', 50, 10, 1),
(19, '2022-12-09 20:21:06', 51, 7, 1),
(19, '2022-12-09 20:21:06', 52, 8, 1),
(19, '2022-12-09 20:21:06', 53, 9, 1),
(19, '2022-12-09 20:21:06', 54, 10, 1),
(20, '2022-12-12 15:31:05', 55, 7, 1),
(20, '2022-12-12 15:31:05', 56, 8, 1),
(20, '2022-12-12 15:31:05', 57, 9, 1),
(20, '2022-12-12 15:31:05', 58, 10, 1),
(21, '2022-12-14 12:55:50', 59, 12, 0),
(22, '2022-12-14 22:43:06', 60, 15, 1),
(22, '2022-12-14 22:43:06', 61, 16, 1),
(22, '2022-12-14 22:43:06', 62, 17, 1),
(23, '2022-12-24 15:16:12', 63, 22, 1),
(24, '2022-12-25 11:13:00', 64, 22, 1),
(25, '2022-12-31 12:05:36', 65, 22, 1),
(26, '2023-01-02 11:59:33', 66, 15, 1),
(26, '2023-01-02 11:59:33', 67, 16, 1),
(26, '2023-01-02 11:59:33', 68, 17, 1),
(26, '2023-01-02 11:59:33', 69, 24, 1),
(26, '2023-01-02 11:59:33', 70, 25, 1),
(27, '2023-02-15 19:57:40', 71, 15, 1),
(27, '2023-02-15 19:57:40', 72, 16, 1),
(27, '2023-02-15 19:57:40', 73, 17, 1),
(27, '2023-02-15 19:57:40', 74, 24, 1),
(27, '2023-02-15 19:57:40', 75, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_kehadiran`
--

CREATE TABLE `daftar_kehadiran` (
  `id` int(30) NOT NULL,
  `id_ekskul` int(30) DEFAULT NULL,
  `tanggal_dibuat` datetime NOT NULL DEFAULT current_timestamp(),
  `doc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_kehadiran`
--

INSERT INTO `daftar_kehadiran` (`id`, `id_ekskul`, `tanggal_dibuat`, `doc`) VALUES
(1, 15, '2022-11-29 20:43:23', '2022-11-29'),
(2, 15, '2022-11-29 22:06:21', '2022-11-01'),
(3, 15, '2022-11-29 22:06:32', '2022-11-02'),
(4, 15, '2022-11-29 22:43:25', '2022-11-11'),
(5, 15, '2022-12-01 08:55:19', '2022-12-01'),
(6, 15, '2022-12-01 14:14:47', '2022-12-02'),
(7, 15, '2022-12-01 14:15:54', '2022-12-03'),
(8, 14, '2022-12-08 22:47:09', '2022-12-08'),
(9, 14, '2022-12-08 23:14:15', '2022-12-07'),
(10, 14, '2022-12-08 23:14:46', '2022-12-09'),
(11, 14, '2022-12-08 23:15:06', '2022-12-01'),
(12, 14, '2022-12-08 23:15:20', '2022-12-02'),
(13, 14, '2022-12-08 23:16:03', '2022-12-03'),
(14, 14, '2022-12-08 23:17:16', '2022-12-04'),
(15, 14, '2022-12-09 00:20:01', '2022-12-10'),
(16, 14, '2022-12-09 00:29:55', '2022-12-11'),
(17, 14, '2022-12-09 00:31:31', '2022-12-12'),
(18, 14, '2022-12-09 18:33:56', '2022-11-02'),
(19, 14, '2022-12-09 20:21:06', '2022-10-01'),
(20, 14, '2022-12-12 15:31:05', '2022-12-13'),
(21, 43, '2022-12-14 12:55:50', '2022-12-14'),
(22, 47, '2022-12-14 22:43:06', '2022-12-14'),
(23, 48, '2022-12-24 15:16:12', '2022-12-24'),
(24, 48, '2022-12-25 11:13:00', '2022-12-25'),
(25, 48, '2022-12-31 12:05:36', '2022-12-31'),
(26, 47, '2023-01-02 11:59:33', '2023-01-02'),
(27, 47, '2023-02-15 19:57:40', '2023-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `ekskul`
--

CREATE TABLE `ekskul` (
  `id` int(30) NOT NULL,
  `nama_ekskul` varchar(30) NOT NULL,
  `jadwal` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `logo_path` text DEFAULT NULL,
  `logo` tinyint(1) NOT NULL DEFAULT 0,
  `tanggal_dibuat` datetime NOT NULL DEFAULT current_timestamp(),
  `tanggal_diperbarui` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pembina` int(50) DEFAULT NULL,
  `id_ketua` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ekskul`
--

INSERT INTO `ekskul` (`id`, `nama_ekskul`, `jadwal`, `status`, `logo_path`, `logo`, `tanggal_dibuat`, `tanggal_diperbarui`, `id_pembina`, `id_ketua`) VALUES
(47, 'Futsal', 'Sabtu Jam 13:30 - 15:00', 1, 'uploads/logo_ekskul/47.png?v=1671029336', 0, '2022-12-14 21:48:56', '2023-02-15 19:50:57', NULL, NULL),
(48, 'Basket', 'Jum\'at Jam 14:00 - 16:00', 1, 'uploads/logo_ekskul/48.png?v=1671029811', 0, '2022-12-14 21:56:51', '2022-12-14 21:56:51', 52, 53),
(49, 'Voli', 'Minggu Jam 09:00 - 12:00', 1, 'uploads/logo_ekskul/49.png?v=1671030483', 0, '2022-12-14 22:08:03', '2022-12-14 22:08:03', 54, 55),
(50, 'Pramuka', 'Jum\'at Jam 16:00 - 17:30', 2, 'uploads/logo_ekskul/50.png?v=1671031144', 0, '2022-12-14 22:19:04', '2022-12-24 14:56:43', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar`
--

CREATE TABLE `pendaftar` (
  `id` int(30) NOT NULL,
  `id_ekskul` int(30) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `nisn` varchar(11) NOT NULL,
  `jenis_kelamin` varchar(12) NOT NULL,
  `kelas` int(2) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `alasan` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_wa` varchar(14) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 = Pending, 1 = Confirmed, 2 = Approved, 3 = Denied',
  `tanggal_dibuat` datetime NOT NULL DEFAULT current_timestamp(),
  `tanggal_diperbarui` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftar`
--

INSERT INTO `pendaftar` (`id`, `id_ekskul`, `nama_lengkap`, `nisn`, `jenis_kelamin`, `kelas`, `jurusan`, `alasan`, `email`, `no_wa`, `alamat`, `status`, `tanggal_dibuat`, `tanggal_diperbarui`) VALUES
(48, 47, 'Ikhsan Dwi Saputra', '1234567890', 'Laki-Laki', 12, 'animasi', 'ingin menambah skill futsal, dan menambah teman ba', 'tatalungga3@gmail.com', '088888888888', 'Pekanbaru', 1, '2022-12-14 22:29:14', '2023-02-15 20:32:26'),
(49, 48, 'asdasdasd', '123123', 'Laki-Laki', 12, 'asdasd', 'asdasdasdasdasd', 'tatalungga3@gmail.com', '123123', 'Pekanbaru', 2, '2022-12-23 18:53:06', '2022-12-23 18:54:24'),
(50, 48, 'alskdkasd', '123123', 'Laki-Laki', 10, 'jaringan komputer', 'asdasdasdasd', 'tatalungga3@gmail.com', '123321', 'Pekanbaru', 2, '2022-12-24 14:53:41', '2022-12-24 15:21:26'),
(51, 48, 'asdasd', '123321', 'Laki-Laki', 10, 'jaringan komputer', 'asdasdasd', 'tatalungga3@gmail.com', '123321', 'Pekanbaru', 0, '2022-12-31 06:21:39', '2022-12-31 06:21:39'),
(52, 49, 'asdasd', '321123321', 'Laki-Laki', 10, 'jaringan komputer', 'asdasdasd', 'tatalungga3@gmail.com', '321123', 'Pekanbaru', 0, '2022-12-31 11:14:33', '2022-12-31 11:14:33'),
(53, 48, 'Ikhsan Dwi Saputra', '12321', 'Laki-Laki', 10, 'asdasdasd', 'adsasdasd', 'tatalungga3@gmail.com', '123321', 'Pekanbaru', 0, '2023-02-08 14:50:36', '2023-02-08 14:50:36'),
(54, 47, 'qweqwe', '123321', 'Laki-Laki', 10, 'animasi', 'asdasdasd', 'asdasdasd@gmail.com', '123321', 'asdasd', 2, '2023-02-15 19:59:34', '2023-02-15 20:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(50) NOT NULL,
  `nama_depan` varchar(30) NOT NULL,
  `nama_tengah` varchar(30) DEFAULT NULL,
  `nama_belakang` varchar(30) NOT NULL,
  `nama_pengguna` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `foto_profil` text DEFAULT NULL,
  `tipe` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = waka(administrator), 2= pembina, 3 = ketua',
  `id_ekskul` int(30) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `tanggal_ditambah` datetime NOT NULL DEFAULT current_timestamp(),
  `tanggal_diperbarui` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama_depan`, `nama_tengah`, `nama_belakang`, `nama_pengguna`, `password`, `foto_profil`, `tipe`, `id_ekskul`, `last_login`, `tanggal_ditambah`, `tanggal_diperbarui`, `email`) VALUES
(1, 'Administrator', '', 'Admin', 'admin', '$2y$10$n2s5dbrCwxWa7i6Fr/U44O8miS9d9zB07ZQbGzrFg4LLu6rPTdFkq', 'uploads/users/avatar-1.png?v=1669028921', 1, NULL, '2022-03-30 03:48:55', '2022-03-30 09:49:16', '2022-11-21 18:08:41', ''),
(52, 'Ray ', '', 'Jordan', 'rjordan', '$2y$10$8E4xfggqdE8q1y1LAYAmruT6v4zBRQDiBr./02sEMoWGGvpH76ii2', 'uploads/pengguna/foto_profil-52.png?v=1671029570', 2, 48, NULL, '2022-12-14 21:52:50', '2022-12-14 22:00:26', ''),
(53, 'Mochammad ', '', 'Rizal', 'mrizal', '$2y$10$lXckTKYh/CNHUGD/WgguaOP8l2TnqhkKATt3nv/OfAMFau0haYWBq', 'uploads/pengguna/foto_profil-53.png?v=1671029642', 3, 48, NULL, '2022-12-14 21:54:02', '2022-12-14 22:00:38', ''),
(54, 'Rahmalia', 'Yanti', 'Mariana', 'rmariana', '$2y$10$7dg7xJn4.KhNmNcQmthLMeJBt1wqJ4n3INc9SCLZlMcShOInTaN3G', 'uploads/pengguna/foto_profil-54.png?v=1671030248', 2, 49, NULL, '2022-12-14 22:04:08', '2022-12-14 22:08:29', ''),
(55, 'Berian', '', 'Mirza', 'bmirza', '$2y$10$seqH2FrSGnZ.VtAQo/evH.ldt4kdLCiLg0yf/rCsrwuQruUtkpYue', 'uploads/pengguna/foto_profil-55.png?v=1671030338', 3, 49, NULL, '2022-12-14 22:05:38', '2022-12-14 22:08:42', ''),
(56, 'Aditya ', '', 'Baskoro', 'abaskoro', '$2y$10$laGfJYNXFDjty...CCEW0ei1nWx7rdNjXjWuWcRWgwtvwepYj3Iyi', 'uploads/pengguna/foto_profil-56.png?v=1671030866', 2, 50, NULL, '2022-12-14 22:14:26', '2022-12-14 22:19:25', ''),
(80, 'itachi', '', 'uciha', 'iuciha', '$2y$10$xwGpySpd3S7YKTrQXF4yausdJXfHOyc9HQjlwxcYP94XbKYzA0WXu', 'uploads/pengguna/foto_profil-80.png?v=1676466872', 2, 47, NULL, '2023-02-15 20:14:31', '2023-02-15 20:14:32', ''),
(81, 'kisame', '', 'hosigaki', 'khosigaki', '$2y$10$doscTpFx4/3b7b150EFCtOOX.NPvJ9pCoe/D6awlFrxDT.kUV0jpO', 'uploads/pengguna/foto_profil-81.png?v=1676466900', 3, 47, NULL, '2023-02-15 20:15:00', '2023-02-15 20:27:06', '');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Sistem Informasi Ekstrakurikuler SMKN2 Pekanbaru'),
(6, 'short_name', 'SIES - PEKANBARU'),
(11, 'logo', 'uploads/system-logo.png?v=1649297034'),
(14, 'cover', 'uploads/system-cover.png?v=1668957517');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `anggota_id_ekskul_fk` (`id_ekskul`);

--
-- Indexes for table `catatan_kehadiran`
--
ALTER TABLE `catatan_kehadiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kehadiran_fk_daftar_kehadiran` (`id_kehadiran`);

--
-- Indexes for table `daftar_kehadiran`
--
ALTER TABLE `daftar_kehadiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekskul`
--
ALTER TABLE `ekskul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pembina` (`id_pembina`,`id_ketua`),
  ADD KEY `ekskul_id_ketua_fk` (`id_ketua`);

--
-- Indexes for table `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`id_ekskul`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`id_ekskul`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `catatan_kehadiran`
--
ALTER TABLE `catatan_kehadiran`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `daftar_kehadiran`
--
ALTER TABLE `daftar_kehadiran`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ekskul`
--
ALTER TABLE `ekskul`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `pendaftar`
--
ALTER TABLE `pendaftar`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_id_ekskul_fk` FOREIGN KEY (`id_ekskul`) REFERENCES `ekskul` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `catatan_kehadiran`
--
ALTER TABLE `catatan_kehadiran`
  ADD CONSTRAINT `id_kehadiran_fk_daftar_kehadiran` FOREIGN KEY (`id_kehadiran`) REFERENCES `daftar_kehadiran` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ekskul`
--
ALTER TABLE `ekskul`
  ADD CONSTRAINT `ekskul_id_ketua_fk` FOREIGN KEY (`id_ketua`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ekskul_id_pembina_fk` FOREIGN KEY (`id_pembina`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD CONSTRAINT `pendaftar_id_ekskul_fk` FOREIGN KEY (`id_ekskul`) REFERENCES `ekskul` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `user_club_id_fk` FOREIGN KEY (`id_ekskul`) REFERENCES `ekskul` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
