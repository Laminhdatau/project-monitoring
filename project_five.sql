-- phpMyAdmin SQL Dump
-- version 5.1.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2023 at 04:57 PM
-- Server version: 8.0.33-0ubuntu0.22.10.2
-- PHP Version: 8.1.7-1ubuntu3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jumlah_mahasiswa`
--

CREATE TABLE `tbl_jumlah_mahasiswa` (
  `nim_keting` varchar(255) NOT NULL,
  `jumlah_mahasiswa` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_jumlah_mahasiswa`
--

INSERT INTO `tbl_jumlah_mahasiswa` (`nim_keting`, `jumlah_mahasiswa`) VALUES
('1111111', 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kehadiran`
--

CREATE TABLE `tbl_kehadiran` (
  `id_kehadiran` int NOT NULL,
  `id_jadwal` int NOT NULL,
  `nim` varchar(20) NOT NULL,
  `hadir` int NOT NULL,
  `izin` int NOT NULL,
  `sakit` int NOT NULL,
  `alfa` int NOT NULL,
  `id_status_kehadiran` int NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `is_verify` enum('0','1') NOT NULL,
  `date_created` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keting`
--

CREATE TABLE `tbl_keting` (
  `nim` varchar(30) NOT NULL,
  `ttm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_keting`
--

INSERT INTO `tbl_keting` (`nim`, `ttm`) VALUES
('1111111', '2023-08-20 16:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_biodata`
--

CREATE TABLE `tbl_mst_biodata` (
  `id_biodata` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_mst_biodata`
--

INSERT INTO `tbl_mst_biodata` (`id_biodata`, `nik`, `nama_lengkap`, `jk`, `alamat`, `date_created`) VALUES
('020c46a9-3793-11ee-b229-503eaa456e2a', '1110000111', 'Laanasisaa', 'L', 'najbsajja', '2023-08-10 23:31:42'),
('35e3707e-36f9-11ee-93ad-503eaa456e2a', '723727328', 'Ahmat Tunggi', 'L', 'pohuwato', '2023-08-10 05:10:47'),
('46251138-36e6-11ee-93ad-503eaa456e2a', '1111111', 'ILI', 'P', 'Botupingge', '2023-08-10 02:55:14'),
('a59446ca-3725-11ee-93ad-503eaa456e2a', '121291921', 'Mmin', 'L', 'tolgh', '2023-08-10 10:28:52');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_mst_dosen`
--

INSERT INTO `tbl_mst_dosen` (`id_dosen`, `nidn`, `nama`, `alamat`, `notelp`, `id_prodi`) VALUES
(2, '123412341234', 'Saiful Bahri Musa,ST,.M.Kom', 'Botupingge', '000000000000000', 1),
(3, '91818129319102', 'Ismail Mohidin,S.Kom,.MT', 'Botupingge', '08xxxxxxxxx', 1),
(4, '12133232323', 'Nurhayati,A.Md.Kom', 'Botupingge', '08xxxxxxxx', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_kelas`
--

CREATE TABLE `tbl_mst_kelas` (
  `id_kelas` int NOT NULL,
  `kelas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
-- Table structure for table `tbl_mst_mahasiswa`
--

CREATE TABLE `tbl_mst_mahasiswa` (
  `id_mahasiswa` varchar(255) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `id_kelas` int NOT NULL,
  `status_mhs` enum('0','1') NOT NULL DEFAULT '0',
  `id_prodi` int NOT NULL,
  `id_semester` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_mst_mahasiswa`
--

INSERT INTO `tbl_mst_mahasiswa` (`id_mahasiswa`, `nim`, `nik`, `id_kelas`, `status_mhs`, `id_prodi`, `id_semester`) VALUES
('020bc4a1-3793-11ee-b229-503eaa456e2a', '20501039', '1110000111', 7, '0', 1, 1),
('35e2c52a-36f9-11ee-93ad-503eaa456e2a', '20501001', '723727328', 1, '0', 1, 1),
('4624827b-36e6-11ee-93ad-503eaa456e2a', '1111111', '1111111', 1, '0', 1, 1),
('a5926ee3-3725-11ee-93ad-503eaa456e2a', '20501049', '121291921', 1, '0', 1, 2);

--
-- Triggers `tbl_mst_mahasiswa`
--
DELIMITER $$
CREATE TRIGGER `tr_delete_biodata` AFTER DELETE ON `tbl_mst_mahasiswa` FOR EACH ROW BEGIN
    DELETE FROM tbl_mst_biodata WHERE nik = OLD.nik;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_mata_kuliah`
--

CREATE TABLE `tbl_mst_mata_kuliah` (
  `id_mata_kuliah` int NOT NULL,
  `mata_kuliah` varchar(100) NOT NULL,
  `id_prodi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_mst_mata_kuliah`
--

INSERT INTO `tbl_mst_mata_kuliah` (`id_mata_kuliah`, `mata_kuliah`, `id_prodi`) VALUES
(3, 'PEMROGRAMAN BERBASIS OBJEK', 1),
(4, 'PEMROGRAMAN DASAR', 1),
(5, 'WEB DASAR', 1),
(6, 'PEMROGRAMAN MOBILE', 1),
(7, 'PEMROGRAMAN MOBILE LANJUT', 1),
(8, 'BASIS DATA', 1),
(9, 'BASIS DATA LANJUT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_periode`
--

CREATE TABLE `tbl_mst_periode` (
  `id_periode` int NOT NULL,
  `tahun_mulai` year NOT NULL,
  `tahun_selesai` year NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_mst_periode`
--

INSERT INTO `tbl_mst_periode` (`id_periode`, `tahun_mulai`, `tahun_selesai`, `status`) VALUES
(1, 2023, 2024, 1),
(14, 2024, 2025, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_prodi`
--

CREATE TABLE `tbl_mst_prodi` (
  `id_prodi` int NOT NULL,
  `prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_mst_prodi`
--

INSERT INTO `tbl_mst_prodi` (`id_prodi`, `prodi`) VALUES
(1, 'TEKNIK INFORMATIKA'),
(2, 'MESIN PERALATAN PERTANIAN'),
(3, 'TEKNOLOGI HASIL PERTANIAN'),
(4, 'TEKNIK REKAYASA PANGAN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_role`
--

CREATE TABLE `tbl_mst_role` (
  `id_role` int NOT NULL,
  `role` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
  `status_kehadiran` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_mst_status_kehadiran`
--

INSERT INTO `tbl_mst_status_kehadiran` (`id_status_kehadiran`, `status_kehadiran`) VALUES
(1, 'Hadir'),
(2, 'Tidak Hadir');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pertemuan`
--

CREATE TABLE `tbl_pertemuan` (
  `id_pertemuan` int NOT NULL,
  `pertemuan` varchar(12) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_pertemuan`
--

INSERT INTO `tbl_pertemuan` (`id_pertemuan`, `pertemuan`) VALUES
(1, 'Satu'),
(2, 'Dua'),
(3, 'Tiga'),
(4, 'Empat'),
(5, 'Lima'),
(6, 'Enam'),
(7, 'Tujuh'),
(8, 'Delapan'),
(9, 'Sembilan'),
(10, 'Sepuluh'),
(17, 'Sebelas'),
(18, 'Dua Belas'),
(19, 'Tiga Belas'),
(20, 'Empat Belas'),
(21, 'Lima Belas'),
(22, 'Enam Belas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekap_kehadiran`
--

CREATE TABLE `tbl_rekap_kehadiran` (
  `id_periode` int NOT NULL,
  `id_kehadiran` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int NOT NULL,
  `id_biodata` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `id_role`, `id_biodata`) VALUES
(5, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 1, '4'),
(6, 'kaprodi', 'c4ca4238a0b923820dcc509a6f75849b', 3, '2'),
(17, 'dosen', 'c4ca4238a0b923820dcc509a6f75849b', 4, '3');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_mhs`
-- (See below for the actual view)
--
CREATE TABLE `v_mhs` (
`nim` varchar(20)
,`nik` varchar(16)
,`nama_lengkap` varchar(50)
,`jk` enum('L','P')
,`alamat` text
,`date_created` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pertemuan`
-- (See below for the actual view)
--
CREATE TABLE `v_pertemuan` (
`pertemuan` bigint unsigned
,`id_kehadiran` int
,`id_dosen` int
,`id_kelas` int
,`id_mata_kuliah` int
,`nim` varchar(20)
,`id_semester` int
,`date_created` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_per_pertemuan`
-- (See below for the actual view)
--
CREATE TABLE `v_per_pertemuan` (
`pertemuan` bigint unsigned
,`id_kehadiran` int
,`id_dosen` int
,`id_kelas` int
,`id_mata_kuliah` int
,`nim` varchar(20)
,`id_semester` int
,`date_created` timestamp
,`hadir` int
,`izin` int
,`sakit` int
,`alfa` int
,`jumlah_mahasiswa` decimal(35,0)
,`nama_lengkap` varchar(50)
,`nama` varchar(100)
,`kelas` varchar(30)
,`semester` varchar(30)
,`mata_kuliah` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `v_mhs`
--
DROP TABLE IF EXISTS `v_mhs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_mhs`  AS SELECT `m`.`nim` AS `nim`, `m`.`nik` AS `nik`, `b`.`nama_lengkap` AS `nama_lengkap`, `b`.`jk` AS `jk`, `b`.`alamat` AS `alamat`, `b`.`date_created` AS `date_created` FROM (`tbl_mst_mahasiswa` `m` join `tbl_mst_biodata` `b`) WHERE (`m`.`nik` = `b`.`nik`) ORDER BY `m`.`id_mahasiswa` ASC, `m`.`nim` ASC, `m`.`id_prodi` ASC, `m`.`id_semester` ASC, `m`.`id_kelas` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_pertemuan`
--
DROP TABLE IF EXISTS `v_pertemuan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pertemuan`  AS SELECT row_number()  (PARTITION BY `j`.`id_mata_kuliah` ORDER BY `h`.`date_created` ) AS `OVER` FROM (`tbl_kehadiran` `h` join `tbl_jadwal` `j` on((`j`.`id_jadwal` = `h`.`id_jadwal`))) WHERE ((`h`.`date_created` is not null) AND (`h`.`is_verify` = '1')) ORDER BY `j`.`id_mata_kuliah` ASC, `h`.`date_created` ASC, `h`.`nim` ASC LIMIT 0, 16 ;

-- --------------------------------------------------------

--
-- Structure for view `v_per_pertemuan`
--
DROP TABLE IF EXISTS `v_per_pertemuan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_per_pertemuan`  AS SELECT `v`.`pertemuan` AS `pertemuan`, `v`.`id_kehadiran` AS `id_kehadiran`, `v`.`id_dosen` AS `id_dosen`, `v`.`id_kelas` AS `id_kelas`, `v`.`id_mata_kuliah` AS `id_mata_kuliah`, `v`.`nim` AS `nim`, `v`.`id_semester` AS `id_semester`, `v`.`date_created` AS `date_created`, `a`.`hadir` AS `hadir`, `a`.`izin` AS `izin`, `a`.`sakit` AS `sakit`, `a`.`alfa` AS `alfa`, sum((((`a`.`hadir` + `a`.`izin`) + `a`.`sakit`) + `a`.`alfa`)) AS `jumlah_mahasiswa`, `vm`.`nama_lengkap` AS `nama_lengkap`, `d`.`nama` AS `nama`, `k`.`kelas` AS `kelas`, `s`.`semester` AS `semester`, `m`.`mata_kuliah` AS `mata_kuliah` FROM (((((((`v_pertemuan` `v` join `tbl_kehadiran` `a`) join `v_mhs` `vm`) join `tbl_pertemuan` `p`) join `tbl_mst_dosen` `d`) join `tbl_mst_kelas` `k`) join `tbl_mst_semester` `s`) join `tbl_mst_mata_kuliah` `m`) WHERE ((`p`.`id_pertemuan` = `v`.`pertemuan`) AND (`d`.`id_dosen` = `v`.`id_dosen`) AND (`vm`.`nim` = `v`.`nim`) AND (`k`.`id_kelas` = `v`.`id_kelas`) AND (`m`.`id_mata_kuliah` = `v`.`id_mata_kuliah`) AND (`s`.`id_semester` = `v`.`id_semester`) AND (`a`.`id_kehadiran` = `v`.`id_kehadiran`)) GROUP BY `v`.`id_dosen`, `v`.`nim`, `v`.`id_semester`, `v`.`id_kelas`, `v`.`id_mata_kuliah`, `v`.`id_kehadiran` ;

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
-- Indexes for table `tbl_jumlah_mahasiswa`
--
ALTER TABLE `tbl_jumlah_mahasiswa`
  ADD KEY `tbl_jumlah_mahasiswa_ibfk_1` (`nim_keting`);

--
-- Indexes for table `tbl_kehadiran`
--
ALTER TABLE `tbl_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_keting` (`nim`),
  ADD KEY `id_status_kehadiran` (`id_status_kehadiran`);

--
-- Indexes for table `tbl_keting`
--
ALTER TABLE `tbl_keting`
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `tbl_mst_biodata`
--
ALTER TABLE `tbl_mst_biodata`
  ADD PRIMARY KEY (`id_biodata`),
  ADD UNIQUE KEY `nik` (`nik`);

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
-- Indexes for table `tbl_mst_mahasiswa`
--
ALTER TABLE `tbl_mst_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `id_prodi` (`id_prodi`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tbl_mst_mata_kuliah`
--
ALTER TABLE `tbl_mst_mata_kuliah`
  ADD PRIMARY KEY (`id_mata_kuliah`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `tbl_mst_periode`
--
ALTER TABLE `tbl_mst_periode`
  ADD PRIMARY KEY (`id_periode`);

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
-- Indexes for table `tbl_pertemuan`
--
ALTER TABLE `tbl_pertemuan`
  ADD PRIMARY KEY (`id_pertemuan`);

--
-- Indexes for table `tbl_rekap_kehadiran`
--
ALTER TABLE `tbl_rekap_kehadiran`
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `id_kehadiran` (`id_kehadiran`);

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
  MODIFY `id_jadwal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_kehadiran`
--
ALTER TABLE `tbl_kehadiran`
  MODIFY `id_kehadiran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_mst_dosen`
--
ALTER TABLE `tbl_mst_dosen`
  MODIFY `id_dosen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_mst_kelas`
--
ALTER TABLE `tbl_mst_kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_mst_mata_kuliah`
--
ALTER TABLE `tbl_mst_mata_kuliah`
  MODIFY `id_mata_kuliah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_mst_periode`
--
ALTER TABLE `tbl_mst_periode`
  MODIFY `id_periode` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT for table `tbl_pertemuan`
--
ALTER TABLE `tbl_pertemuan`
  MODIFY `id_pertemuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_jumlah_mahasiswa`
--
ALTER TABLE `tbl_jumlah_mahasiswa`
  ADD CONSTRAINT `tbl_jumlah_mahasiswa_ibfk_1` FOREIGN KEY (`nim_keting`) REFERENCES `tbl_keting` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_keting`
--
ALTER TABLE `tbl_keting`
  ADD CONSTRAINT `tbl_keting_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tbl_mst_mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_mst_mahasiswa`
--
ALTER TABLE `tbl_mst_mahasiswa`
  ADD CONSTRAINT `tbl_mst_mahasiswa_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `tbl_mst_prodi` (`id_prodi`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `tbl_rekap_kehadiran`
--
ALTER TABLE `tbl_rekap_kehadiran`
  ADD CONSTRAINT `tbl_rekap_kehadiran_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `tbl_mst_periode` (`id_periode`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_rekap_kehadiran_ibfk_3` FOREIGN KEY (`id_kehadiran`) REFERENCES `tbl_kehadiran` (`id_kehadiran`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
