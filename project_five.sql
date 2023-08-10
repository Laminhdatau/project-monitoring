-- phpMyAdmin SQL Dump
-- version 5.1.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2023 at 11:24 PM
-- Server version: 8.0.32-0ubuntu0.22.10.2
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_five`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id_jadwal` int NOT NULL,
  `id_mata_kuliah` int NOT NULL,
  `id_dosen` int NOT NULL,
  `id_semester` int NOT NULL,
  `id_kelas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`id_jadwal`, `id_mata_kuliah`, `id_dosen`, `id_semester`, `id_kelas`) VALUES
(1, 1, 2, 3, 2),
(4, 3, 3, 4, 7),
(5, 4, 2, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kehadiran`
--

CREATE TABLE `tbl_kehadiran` (
  `id_kehadiran` int NOT NULL,
  `id_jadwal` int NOT NULL,
  `id_keting` int NOT NULL,
  `hadir` int NOT NULL,
  `izin` int NOT NULL,
  `sakit` int NOT NULL,
  `alfa` int NOT NULL,
  `id_status_kehadiran` int NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `is_verify` enum('0','1') NOT NULL,
  `date_created` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_kehadiran`
--

INSERT INTO `tbl_kehadiran` (`id_kehadiran`, `id_jadwal`, `id_keting`, `hadir`, `izin`, `sakit`, `alfa`, `id_status_kehadiran`, `keterangan`, `foto`, `is_verify`, `date_created`) VALUES
(1, 1, 1, 10, 2, 2, 1, 1, 'jandsjanjkd', '6efe76e8a31b800753ed295d712253b0.png', '1', '2023-04-08 18:32:20'),
(3, 5, 5, 10, 2, 2, 1, 1, 'ghjkl', '75cda1eb55cff7ac6689ca56dd9c637c.png', '1', '2023-04-12 15:16:02'),
(4, 5, 5, 10, 2, 2, 1, 1, 'adfsgd', 'b57e062b660c8aeba42b3426634dbf42.png', '1', '2023-04-12 15:20:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keting`
--

CREATE TABLE `tbl_keting` (
  `id_keting` int NOT NULL,
  `nim` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_prodi` int NOT NULL,
  `id_semester` int NOT NULL,
  `id_kelas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_keting`
--

INSERT INTO `tbl_keting` (`id_keting`, `nim`, `nama`, `id_prodi`, `id_semester`, `id_kelas`) VALUES
(4, '131318011', 'EKO HIDAYAT', 1, 3, 2),
(5, '20501014', 'HELMALIA PUTRI MALOHO', 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_dosen`
--

CREATE TABLE `tbl_mst_dosen` (
  `id_dosen` int NOT NULL,
  `nidn` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `id_prodi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_mst_dosen`
--

INSERT INTO `tbl_mst_dosen` (`id_dosen`, `nidn`, `nama`, `alamat`, `notelp`, `id_prodi`) VALUES
(2, '123412341234', 'EKO HIDAYAT, A. Md. Kom', 'Huangobotu', '081234455443', 1),
(3, '91818129319102', 'SITI NURLIANI', 'Huangobotu', '081234455443', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_kelas`
--

CREATE TABLE `tbl_mst_kelas` (
  `id_kelas` int NOT NULL,
  `kelas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_mst_kelas`
--

INSERT INTO `tbl_mst_kelas` (`id_kelas`, `kelas`) VALUES
(1, 'A'),
(3, 'C'),
(7, 'B'),
(8, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_mata_kuliah`
--

CREATE TABLE `tbl_mst_mata_kuliah` (
  `id_mata_kuliah` int NOT NULL,
  `mata_kuliah` varchar(100) NOT NULL,
  `id_prodi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_mst_mata_kuliah`
--

INSERT INTO `tbl_mst_mata_kuliah` (`id_mata_kuliah`, `mata_kuliah`, `id_prodi`) VALUES
(1, 'Proposal', 1),
(3, 'PEMROGRAMAN BERBASIS OBJEK', 1),
(4, 'PEMROGRAMAN DASAR', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_prodi`
--

CREATE TABLE `tbl_mst_prodi` (
  `id_prodi` int NOT NULL,
  `prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_mst_prodi`
--

INSERT INTO `tbl_mst_prodi` (`id_prodi`, `prodi`) VALUES
(1, 'PRODI TEKNIK INFORMATIKA'),
(2, 'PRODI MESIN PERALATAN PERTANIAN'),
(3, 'PRODI TEKNOLOGI HASIL PERTANIAN'),
(4, 'PRODI REKAYASA PANGAN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_role`
--

CREATE TABLE `tbl_mst_role` (
  `id_role` int NOT NULL,
  `role` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_mst_role`
--

INSERT INTO `tbl_mst_role` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Mahasiswa'),
(3, 'Kaprodi'),
(4, 'Dosen');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_semester`
--

CREATE TABLE `tbl_mst_semester` (
  `id_semester` int NOT NULL,
  `semester` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_mst_semester`
--

INSERT INTO `tbl_mst_semester` (`id_semester`, `semester`) VALUES
(1, 'I (SATU)'),
(2, 'II (DUA)'),
(3, 'III (TIGA)'),
(4, 'IV (EMPAT)'),
(5, 'V (LIMA)'),
(6, 'VI (ENAM)'),
(8, 'VII (TUJUH)'),
(9, 'VIII (DELAPAN)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_status_kehadiran`
--

CREATE TABLE `tbl_mst_status_kehadiran` (
  `id_status_kehadiran` int NOT NULL,
  `status_kehadiran` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_mst_status_kehadiran`
--

INSERT INTO `tbl_mst_status_kehadiran` (`id_status_kehadiran`, `status_kehadiran`) VALUES
(1, 'Hadir'),
(2, 'Tidak Hadir ( Tanpa Keterangan )'),
(6, 'Tidak Hadir ( Dengan Keterangan )');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int NOT NULL,
  `id_biodata` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `id_role`, `id_biodata`) VALUES
(1, 'ekohidayat', 'c77f88c8f28f183e41124a0ae4aa0a20', 2, 4),
(2, 'ekohidayatadmin', 'c77f88c8f28f183e41124a0ae4aa0a20', 1, 2),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 4, 3),
(4, 'PUTRI', 'e10adc3949ba59abbe56e057f20f883e', 2, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_mata_kuliah` (`id_mata_kuliah`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_semester` (`id_semester`);

--
-- Indexes for table `tbl_kehadiran`
--
ALTER TABLE `tbl_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_keting` (`id_keting`),
  ADD KEY `id_status_kehadiran` (`id_status_kehadiran`);

--
-- Indexes for table `tbl_keting`
--
ALTER TABLE `tbl_keting`
  ADD PRIMARY KEY (`id_keting`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_prodi` (`id_prodi`),
  ADD KEY `id_semester` (`id_semester`);

--
-- Indexes for table `tbl_mst_dosen`
--
ALTER TABLE `tbl_mst_dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `tbl_mst_kelas`
--
ALTER TABLE `tbl_mst_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tbl_mst_mata_kuliah`
--
ALTER TABLE `tbl_mst_mata_kuliah`
  ADD PRIMARY KEY (`id_mata_kuliah`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `tbl_mst_prodi`
--
ALTER TABLE `tbl_mst_prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `tbl_mst_role`
--
ALTER TABLE `tbl_mst_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tbl_mst_semester`
--
ALTER TABLE `tbl_mst_semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `tbl_mst_status_kehadiran`
--
ALTER TABLE `tbl_mst_status_kehadiran`
  ADD PRIMARY KEY (`id_status_kehadiran`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_biodata` (`id_biodata`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id_jadwal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_kehadiran`
--
ALTER TABLE `tbl_kehadiran`
  MODIFY `id_kehadiran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_keting`
--
ALTER TABLE `tbl_keting`
  MODIFY `id_keting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_mst_dosen`
--
ALTER TABLE `tbl_mst_dosen`
  MODIFY `id_dosen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_mst_kelas`
--
ALTER TABLE `tbl_mst_kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_mst_mata_kuliah`
--
ALTER TABLE `tbl_mst_mata_kuliah`
  MODIFY `id_mata_kuliah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_mst_prodi`
--
ALTER TABLE `tbl_mst_prodi`
  MODIFY `id_prodi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_mst_role`
--
ALTER TABLE `tbl_mst_role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_mst_semester`
--
ALTER TABLE `tbl_mst_semester`
  MODIFY `id_semester` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_mst_status_kehadiran`
--
ALTER TABLE `tbl_mst_status_kehadiran`
  MODIFY `id_status_kehadiran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
