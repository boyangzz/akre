-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2026 at 05:16 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aps`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','operator') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `nama_lengkap`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$0H7HWHszUSO6H.FUqmTaW.NYNQmqnCg7pziIbFeXE4FOFRhGaZ3Ye', 'Administrator', 'admin', '2026-04-27 16:10:41', '2026-04-27 16:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `identitas_pengusul`
--

CREATE TABLE `identitas_pengusul` (
  `id` int NOT NULL,
  `nama_pt` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_fakultas` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_prodi` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenjang` enum('D3','STr','S1','S2','S2T','S3','S3T') COLLATE utf8mb4_unicode_ci DEFAULT 'S1',
  `alamat` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_sk_banpt` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peringkat_akreditasi` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `kaprodi_nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kaprodi_nidn` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `identitas_pengusul`
--

INSERT INTO `identitas_pengusul` (`id`, `nama_pt`, `nama_fakultas`, `nama_prodi`, `jenjang`, `alamat`, `telepon`, `email`, `website`, `no_sk_banpt`, `peringkat_akreditasi`, `tanggal_kadaluarsa`, `kaprodi_nama`, `kaprodi_nidn`, `created_at`, `updated_at`) VALUES
(1, 'Universitas XYZ ABC', 'Fakultas Teknik', 'Teknik Informatika', 'D3', '', '', '', '', '', '', '2026-04-30', '', '', '2026-04-27 16:10:41', '2026-04-27 16:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `master_dosen`
--

CREATE TABLE `master_dosen` (
  `id` int NOT NULL,
  `nidn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan_pasca` enum('S2','S3') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bidang_keahlian` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kesesuaian_kompetensi` tinyint(1) DEFAULT '0',
  `jabatan_akademik` enum('Tenaga Pengajar','Asisten Ahli','Lektor','Lektor Kepala','Guru Besar') COLLATE utf8mb4_unicode_ci DEFAULT 'Tenaga Pengajar',
  `sertifikat_pendidik` tinyint(1) DEFAULT '0',
  `sertifikat_kompetensi` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `status_ikatan` enum('tetap','tidak_tetap','industri') COLLATE utf8mb4_unicode_ci DEFAULT 'tetap',
  `status_aktif` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_dosen`
--

INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, '2', 'tes b', 'S2', '4', 1, 'Tenaga Pengajar', 1, 'sdf', 1, 'tetap', 1, '2026-04-27 16:41:47', '2026-04-27 16:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `master_mahasiswa`
--

CREATE TABLE `master_mahasiswa` (
  `id` int NOT NULL,
  `nim` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `angkatan` year DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `status` enum('aktif','lulus','cuti','do','transfer') COLLATE utf8mb4_unicode_ci DEFAULT 'aktif',
  `jenis` enum('reguler','transfer') COLLATE utf8mb4_unicode_ci DEFAULT 'reguler',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_mahasiswa`
--

INSERT INTO `master_mahasiswa` (`id`, `nim`, `nama`, `angkatan`, `prodi_id`, `status`, `jenis`, `created_at`, `updated_at`) VALUES
(1, '2313', 'boy', '2026', 1, 'aktif', 'reguler', '2026-04-27 17:01:15', '2026-04-27 17:01:15');

-- --------------------------------------------------------

--
-- Table structure for table `master_mata_kuliah`
--

CREATE TABLE `master_mata_kuliah` (
  `id` int NOT NULL,
  `kode_mk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_mk` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks_teori` int DEFAULT '0',
  `sks_praktek` int DEFAULT '0',
  `semester` int DEFAULT NULL,
  `jenis_mk` enum('wajib','pilihan') COLLATE utf8mb4_unicode_ci DEFAULT 'wajib',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_mata_kuliah`
--

INSERT INTO `master_mata_kuliah` (`id`, `kode_mk`, `nama_mk`, `sks_teori`, `sks_praktek`, `semester`, `jenis_mk`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 'a1', 'tesa1', NULL, NULL, 1, NULL, 1, '2026-04-27 16:49:46', '2026-04-27 16:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `setup_tabel_borang`
--

CREATE TABLE `setup_tabel_borang` (
  `id` int NOT NULL,
  `kode_tabel` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_tabel` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('identitas','master','kerjasama','mahasiswa','dosen','kurikulum','luaran','keuangan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang_filter` json NOT NULL,
  `is_wajib` tinyint(1) DEFAULT '1',
  `urutan` int DEFAULT '0',
  `kolom_config` json DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setup_tabel_borang`
--

INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, '1-1', 'Kerjasama Pendidikan', 'kerjasama', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 1, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(2, '1-2', 'Kerjasama Penelitian', 'kerjasama', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 2, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(3, '1-3', 'Kerjasama PkM', 'kerjasama', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 3, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(4, '2a', 'Seleksi Mahasiswa Baru', 'mahasiswa', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 4, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(5, '2b', 'Mahasiswa Asing', 'mahasiswa', '[\"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 5, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(6, '3a1', 'Dosen Tetap PT', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 6, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(7, '3a2', 'Pembimbing Utama TA', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 7, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(8, '3a3', 'EWMP Dosen Tetap', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 8, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(9, '3a4', 'Dosen Tidak Tetap', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 9, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(10, '3a5', 'Dosen Industri/Praktisi', 'dosen', '[\"D3\", \"STr\"]', 1, 10, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(11, '3b1', 'Rekognisi Dosen', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 11, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(12, '3b2', 'Penelitian DTPS', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 12, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(13, '3b3', 'PkM DTPS', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 13, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(14, '3b4', 'Publikasi Ilmiah DTPS', 'dosen', '[\"S1\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 14, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(15, '3b5', 'HKI & Buku DTPS', 'dosen', '[\"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 15, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(16, '3b6', 'Sitasi DTPS', 'dosen', '[\"D3\", \"STr\", \"S3T\"]', 1, 16, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(17, '3b7', 'Luaran Lain DTPS', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 17, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(18, '4', 'Keuangan & Sarpras', 'keuangan', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 18, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(19, '5a', 'Kurikulum', 'kurikulum', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 19, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(20, '5b', 'Integrasi Litabmas', 'kurikulum', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 20, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(21, '5c', 'Kepuasan Mhs Pembelajaran', 'kurikulum', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 21, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(22, '6a', 'Penelitian DTPS + Mhs', 'kurikulum', '[\"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 22, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(23, '6b', 'Penelitian Rujukan Tesis', 'kurikulum', '[\"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 23, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(24, '7', 'PkM DTPS + Mhs', 'kurikulum', '[\"D3\", \"S1\", \"STr\"]', 1, 24, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(25, '8a', 'IPK Lulusan', 'luaran', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 25, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(26, '8b1', 'Prestasi Akademik Mhs', 'luaran', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 26, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(27, '8b2', 'Prestasi Non-akademik', 'luaran', '[\"D3\", \"S1\", \"STr\"]', 1, 27, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(28, '8c', 'Masa Studi Lulusan', 'luaran', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 28, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(29, '8d1', 'Waktu Tunggu Lulusan', 'luaran', '[\"D3\", \"S1\", \"STr\"]', 1, 29, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(30, '8d2', 'Kesesuaian Bidang Kerja', 'luaran', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\"]', 1, 30, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(31, '8e1', 'Tempat Kerja Lulusan', 'luaran', '[\"D3\", \"S1\", \"STr\"]', 1, 31, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(32, '8e2', 'Kepuasan Pengguna', 'luaran', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\"]', 1, 32, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(33, '8f1', 'Publikasi Ilmiah Mhs', 'luaran', '[\"S1\", \"S2\", \"S2T\", \"S3\"]', 1, 33, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(34, '8f1t', 'Publikasi Mhs Terapan', 'luaran', '[\"D3\", \"STr\", \"S2T\", \"S3T\"]', 1, 34, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:10:41'),
(35, '8f2', 'Sitasi Karya Mhs', 'luaran', '[\"S2\", \"S2T\", \"S3T\"]', 1, 35, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(36, '8f3', 'Luaran Mhs Buku', 'luaran', '[\"D3\", \"S2\", \"S2T\", \"S3T\"]', 1, 36, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34'),
(37, '8f4', 'Luaran Mhs HKI/Produk', 'luaran', '[\"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', 1, 37, NULL, NULL, '2026-04-27 16:10:41', '2026-04-27 16:36:34');

-- --------------------------------------------------------

--
-- Table structure for table `trx_dosen_bimbingan`
--

CREATE TABLE `trx_dosen_bimbingan` (
  `id` int NOT NULL,
  `dosen_id` int NOT NULL,
  `tahun_akademik` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jml_bimbingan_ps` int DEFAULT '0',
  `jml_bimbingan_ps_lain` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_dosen_bimbingan`
--

INSERT INTO `trx_dosen_bimbingan` (`id`, `dosen_id`, `tahun_akademik`, `jml_bimbingan_ps`, `jml_bimbingan_ps_lain`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 1, '20', 1, 1, 1, '2026-04-27 17:04:43', '2026-04-27 17:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `trx_dosen_mk`
--

CREATE TABLE `trx_dosen_mk` (
  `id` int NOT NULL,
  `dosen_id` int NOT NULL,
  `mk_id` int NOT NULL,
  `tahun_akademik` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trx_ewmp`
--

CREATE TABLE `trx_ewmp` (
  `id` int NOT NULL,
  `dosen_id` int NOT NULL,
  `tahun_akademik` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sks_pendidikan_ps` decimal(10,2) DEFAULT '0.00',
  `sks_pendidikan_luar` decimal(10,2) DEFAULT '0.00',
  `sks_penelitian` decimal(10,2) DEFAULT '0.00',
  `sks_pkm` decimal(10,2) DEFAULT '0.00',
  `sks_tugas_tambahan` decimal(10,2) DEFAULT '0.00',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_ewmp`
--

INSERT INTO `trx_ewmp` (`id`, `dosen_id`, `tahun_akademik`, `sks_pendidikan_ps`, `sks_pendidikan_luar`, `sks_penelitian`, `sks_pkm`, `sks_tugas_tambahan`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 1, '20', 1.00, 3.00, 1.00, 1.00, 1.00, 1, '2026-04-27 17:01:51', '2026-04-27 17:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `trx_hki_buku_dtps`
--

CREATE TABLE `trx_hki_buku_dtps` (
  `id` int NOT NULL,
  `dosen_id` int NOT NULL,
  `judul` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year DEFAULT NULL,
  `keterangan` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trx_ipk_lulusan`
--

CREATE TABLE `trx_ipk_lulusan` (
  `id` int NOT NULL,
  `tahun_lulus` year DEFAULT NULL,
  `jml_lulusan` int DEFAULT '0',
  `ipk_min` decimal(4,2) DEFAULT NULL,
  `ipk_max` decimal(4,2) DEFAULT NULL,
  `ipk_rata` decimal(4,2) DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_ipk_lulusan`
--

INSERT INTO `trx_ipk_lulusan` (`id`, `tahun_lulus`, `jml_lulusan`, `ipk_min`, `ipk_max`, `ipk_rata`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, '2001', 1, 1.00, 1.00, 1.00, 1, '2026-04-27 17:08:17', '2026-04-27 17:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `trx_kepuasan_pengguna`
--

CREATE TABLE `trx_kepuasan_pengguna` (
  `id` int NOT NULL,
  `jenis_kemampuan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `persen_sangat_baik` decimal(5,2) DEFAULT '0.00',
  `persen_baik` decimal(5,2) DEFAULT '0.00',
  `persen_cukup` decimal(5,2) DEFAULT '0.00',
  `persen_kurang` decimal(5,2) DEFAULT '0.00',
  `rencana_tindak_lanjut` text COLLATE utf8mb4_unicode_ci,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_kepuasan_pengguna`
--

INSERT INTO `trx_kepuasan_pengguna` (`id`, `jenis_kemampuan`, `persen_sangat_baik`, `persen_baik`, `persen_cukup`, `persen_kurang`, `rencana_tindak_lanjut`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 'Etika', 11.00, 11.00, 11.00, 11.00, '22', 1, '2026-04-27 17:09:40', '2026-04-27 17:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `trx_kerjasama`
--

CREATE TABLE `trx_kerjasama` (
  `id` int NOT NULL,
  `jenis_kerjasama` enum('pendidikan','penelitian','pkm') COLLATE utf8mb4_unicode_ci NOT NULL,
  `lembaga_mitra` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` enum('internasional','nasional','lokal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_kegiatan` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manfaat` text COLLATE utf8mb4_unicode_ci,
  `waktu_durasi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_kerjasama`
--

INSERT INTO `trx_kerjasama` (`id`, `jenis_kerjasama`, `lembaga_mitra`, `tingkat`, `judul_kegiatan`, `manfaat`, `waktu_durasi`, `bukti`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 'pendidikan', 'tes', 'nasional', 'tes 1', '', 'tes', '', 1, '2026-04-27 16:40:27', '2026-04-27 16:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `trx_kurikulum`
--

CREATE TABLE `trx_kurikulum` (
  `id` int NOT NULL,
  `mk_id` int NOT NULL,
  `capaian_pembelajaran` text COLLATE utf8mb4_unicode_ci,
  `metode_pembelajaran` text COLLATE utf8mb4_unicode_ci,
  `bentuk_integrasi_penelitian` text COLLATE utf8mb4_unicode_ci,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trx_luaran_mhs`
--

CREATE TABLE `trx_luaran_mhs` (
  `id` int NOT NULL,
  `mahasiswa_id` int DEFAULT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year DEFAULT NULL,
  `keterangan` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_luaran_mhs`
--

INSERT INTO `trx_luaran_mhs` (`id`, `mahasiswa_id`, `jenis`, `judul`, `tahun`, `keterangan`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hak Cipta', '4124', '2026', '21', 1, '2026-04-27 17:04:32', '2026-04-27 17:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `trx_mahasiswa_asing`
--

CREATE TABLE `trx_mahasiswa_asing` (
  `id` int NOT NULL,
  `tahun_akademik` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_fulltime` int DEFAULT '0',
  `jml_parttime` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trx_masa_studi`
--

CREATE TABLE `trx_masa_studi` (
  `id` int NOT NULL,
  `tahun_masuk` year DEFAULT NULL,
  `jml_mhs_diterima` int DEFAULT '0',
  `jml_lulus_akhir_ts` int DEFAULT '0',
  `jml_lulus_akhir_ts1` int DEFAULT '0',
  `jml_lulus_akhir_ts2` int DEFAULT '0',
  `jml_lulus_akhir_ts3` int DEFAULT '0',
  `jml_lulus_akhir_ts4` int DEFAULT '0',
  `jml_lulus_akhir_ts5` int DEFAULT '0',
  `jml_lulus_akhir_ts6` int DEFAULT '0',
  `rata_masa_studi` decimal(5,2) DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_masa_studi`
--

INSERT INTO `trx_masa_studi` (`id`, `tahun_masuk`, `jml_mhs_diterima`, `jml_lulus_akhir_ts`, `jml_lulus_akhir_ts1`, `jml_lulus_akhir_ts2`, `jml_lulus_akhir_ts3`, `jml_lulus_akhir_ts4`, `jml_lulus_akhir_ts5`, `jml_lulus_akhir_ts6`, `rata_masa_studi`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, '2001', 1, 1, 1, 0, 0, 0, 0, 0, 1.00, 1, '2026-04-27 17:08:42', '2026-04-27 17:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `trx_penelitian_dtps`
--

CREATE TABLE `trx_penelitian_dtps` (
  `id` int NOT NULL,
  `sumber` enum('pt_mandiri','dalam_negeri','luar_negeri') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_akademik` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_judul` int DEFAULT '0',
  `dana` decimal(15,2) DEFAULT '0.00',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_penelitian_dtps`
--

INSERT INTO `trx_penelitian_dtps` (`id`, `sumber`, `tahun_akademik`, `jumlah_judul`, `dana`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 'pt_mandiri', 'ts', 1, 111.00, 1, '2026-04-27 17:03:27', '2026-04-27 17:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `trx_penelitian_mhs`
--

CREATE TABLE `trx_penelitian_mhs` (
  `id` int NOT NULL,
  `judul` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mahasiswa_id` int DEFAULT NULL,
  `dosen_id` int DEFAULT NULL,
  `tahun` year DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trx_pkm_dtps`
--

CREATE TABLE `trx_pkm_dtps` (
  `id` int NOT NULL,
  `sumber` enum('pt_mandiri','dalam_negeri','luar_negeri') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_akademik` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_judul` int DEFAULT '0',
  `dana` decimal(15,2) DEFAULT '0.00',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_pkm_dtps`
--

INSERT INTO `trx_pkm_dtps` (`id`, `sumber`, `tahun_akademik`, `jumlah_judul`, `dana`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 'dalam_negeri', 'ts', 11, 1111.00, 1, '2026-04-27 17:04:12', '2026-04-27 17:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `trx_pkm_mhs`
--

CREATE TABLE `trx_pkm_mhs` (
  `id` int NOT NULL,
  `judul` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mahasiswa_id` int DEFAULT NULL,
  `dosen_id` int DEFAULT NULL,
  `tahun` year DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trx_prestasi_mhs`
--

CREATE TABLE `trx_prestasi_mhs` (
  `id` int NOT NULL,
  `nama_kegiatan` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mahasiswa_id` int DEFAULT NULL,
  `tingkat` enum('internasional','nasional','wilayah') COLLATE utf8mb4_unicode_ci NOT NULL,
  `prestasi` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` year DEFAULT NULL,
  `jenis_prestasi` enum('akademik','non_akademik') COLLATE utf8mb4_unicode_ci DEFAULT 'akademik',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trx_publikasi_dtps`
--

CREATE TABLE `trx_publikasi_dtps` (
  `id` int NOT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_akademik` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_judul` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trx_rekognisi_dosen`
--

CREATE TABLE `trx_rekognisi_dosen` (
  `id` int NOT NULL,
  `dosen_id` int NOT NULL,
  `bidang_keahlian` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekognisi` text COLLATE utf8mb4_unicode_ci,
  `bukti` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_rekognisi_dosen`
--

INSERT INTO `trx_rekognisi_dosen` (`id`, `dosen_id`, `bidang_keahlian`, `rekognisi`, `bukti`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'df', 'sdfsd', '', 1, '2026-04-27 17:03:00', '2026-04-27 17:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `trx_seleksi_mahasiswa`
--

CREATE TABLE `trx_seleksi_mahasiswa` (
  `id` int NOT NULL,
  `tahun_akademik` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daya_tampung` int DEFAULT '0',
  `pendaftar` int DEFAULT '0',
  `lulus_seleksi` int DEFAULT '0',
  `maba_reguler` int DEFAULT '0',
  `maba_transfer` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_seleksi_mahasiswa`
--

INSERT INTO `trx_seleksi_mahasiswa` (`id`, `tahun_akademik`, `daya_tampung`, `pendaftar`, `lulus_seleksi`, `maba_reguler`, `maba_transfer`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, '20', 12, 12, 12, 12, 0, 1, '2026-04-27 16:55:02', '2026-04-27 16:55:02');

-- --------------------------------------------------------

--
-- Table structure for table `trx_sitasi_dtps`
--

CREATE TABLE `trx_sitasi_dtps` (
  `id` int NOT NULL,
  `dosen_id` int NOT NULL,
  `judul_artikel` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurnal_vol_tahun_hal` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_sitasi` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_sitasi_dtps`
--

INSERT INTO `trx_sitasi_dtps` (`id`, `dosen_id`, `judul_artikel`, `jurnal_vol_tahun_hal`, `jumlah_sitasi`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'fsefs', '1', 2, 1, '2026-04-27 17:04:23', '2026-04-27 17:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `trx_tempat_kerja`
--

CREATE TABLE `trx_tempat_kerja` (
  `id` int NOT NULL,
  `tahun_lulus` year DEFAULT NULL,
  `jml_lokal` int DEFAULT '0',
  `jml_nasional` int DEFAULT '0',
  `jml_multinasional` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trx_waktu_tunggu`
--

CREATE TABLE `trx_waktu_tunggu` (
  `id` int NOT NULL,
  `tahun_lulus` year DEFAULT NULL,
  `jml_lulusan` int DEFAULT '0',
  `jml_terlacak` int DEFAULT '0',
  `wt_kurang_3bln` int DEFAULT '0',
  `wt_3_sd_6bln` int DEFAULT '0',
  `wt_lebih_6bln` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_waktu_tunggu`
--

INSERT INTO `trx_waktu_tunggu` (`id`, `tahun_lulus`, `jml_lulusan`, `jml_terlacak`, `wt_kurang_3bln`, `wt_3_sd_6bln`, `wt_lebih_6bln`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, '2001', 11, 11, 11, 11, 11, 1, '2026-04-27 17:09:10', '2026-04-27 17:09:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `identitas_pengusul`
--
ALTER TABLE `identitas_pengusul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_dosen`
--
ALTER TABLE `master_dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nidn` (`nidn`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `master_mahasiswa`
--
ALTER TABLE `master_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `master_mata_kuliah`
--
ALTER TABLE `master_mata_kuliah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_mk` (`kode_mk`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `setup_tabel_borang`
--
ALTER TABLE `setup_tabel_borang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_tabel` (`kode_tabel`);

--
-- Indexes for table `trx_dosen_bimbingan`
--
ALTER TABLE `trx_dosen_bimbingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_dosen_mk`
--
ALTER TABLE `trx_dosen_mk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `mk_id` (`mk_id`);

--
-- Indexes for table `trx_ewmp`
--
ALTER TABLE `trx_ewmp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_hki_buku_dtps`
--
ALTER TABLE `trx_hki_buku_dtps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_ipk_lulusan`
--
ALTER TABLE `trx_ipk_lulusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_kepuasan_pengguna`
--
ALTER TABLE `trx_kepuasan_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_kerjasama`
--
ALTER TABLE `trx_kerjasama`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_kurikulum`
--
ALTER TABLE `trx_kurikulum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mk_id` (`mk_id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_luaran_mhs`
--
ALTER TABLE `trx_luaran_mhs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_mahasiswa_asing`
--
ALTER TABLE `trx_mahasiswa_asing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_masa_studi`
--
ALTER TABLE `trx_masa_studi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_penelitian_dtps`
--
ALTER TABLE `trx_penelitian_dtps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_penelitian_mhs`
--
ALTER TABLE `trx_penelitian_mhs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_pkm_dtps`
--
ALTER TABLE `trx_pkm_dtps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_pkm_mhs`
--
ALTER TABLE `trx_pkm_mhs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_prestasi_mhs`
--
ALTER TABLE `trx_prestasi_mhs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_publikasi_dtps`
--
ALTER TABLE `trx_publikasi_dtps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_rekognisi_dosen`
--
ALTER TABLE `trx_rekognisi_dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_seleksi_mahasiswa`
--
ALTER TABLE `trx_seleksi_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_sitasi_dtps`
--
ALTER TABLE `trx_sitasi_dtps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_tempat_kerja`
--
ALTER TABLE `trx_tempat_kerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `trx_waktu_tunggu`
--
ALTER TABLE `trx_waktu_tunggu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `identitas_pengusul`
--
ALTER TABLE `identitas_pengusul`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_dosen`
--
ALTER TABLE `master_dosen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_mahasiswa`
--
ALTER TABLE `master_mahasiswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_mata_kuliah`
--
ALTER TABLE `master_mata_kuliah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setup_tabel_borang`
--
ALTER TABLE `setup_tabel_borang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `trx_dosen_bimbingan`
--
ALTER TABLE `trx_dosen_bimbingan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trx_dosen_mk`
--
ALTER TABLE `trx_dosen_mk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_ewmp`
--
ALTER TABLE `trx_ewmp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trx_hki_buku_dtps`
--
ALTER TABLE `trx_hki_buku_dtps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_ipk_lulusan`
--
ALTER TABLE `trx_ipk_lulusan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trx_kepuasan_pengguna`
--
ALTER TABLE `trx_kepuasan_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trx_kerjasama`
--
ALTER TABLE `trx_kerjasama`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trx_kurikulum`
--
ALTER TABLE `trx_kurikulum`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_luaran_mhs`
--
ALTER TABLE `trx_luaran_mhs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trx_mahasiswa_asing`
--
ALTER TABLE `trx_mahasiswa_asing`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_masa_studi`
--
ALTER TABLE `trx_masa_studi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trx_penelitian_dtps`
--
ALTER TABLE `trx_penelitian_dtps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trx_penelitian_mhs`
--
ALTER TABLE `trx_penelitian_mhs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_pkm_dtps`
--
ALTER TABLE `trx_pkm_dtps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trx_pkm_mhs`
--
ALTER TABLE `trx_pkm_mhs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_prestasi_mhs`
--
ALTER TABLE `trx_prestasi_mhs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_publikasi_dtps`
--
ALTER TABLE `trx_publikasi_dtps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_rekognisi_dosen`
--
ALTER TABLE `trx_rekognisi_dosen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trx_seleksi_mahasiswa`
--
ALTER TABLE `trx_seleksi_mahasiswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trx_sitasi_dtps`
--
ALTER TABLE `trx_sitasi_dtps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trx_tempat_kerja`
--
ALTER TABLE `trx_tempat_kerja`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_waktu_tunggu`
--
ALTER TABLE `trx_waktu_tunggu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_dosen`
--
ALTER TABLE `master_dosen`
  ADD CONSTRAINT `master_dosen_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `master_mahasiswa`
--
ALTER TABLE `master_mahasiswa`
  ADD CONSTRAINT `master_mahasiswa_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `master_mata_kuliah`
--
ALTER TABLE `master_mata_kuliah`
  ADD CONSTRAINT `master_mata_kuliah_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_dosen_bimbingan`
--
ALTER TABLE `trx_dosen_bimbingan`
  ADD CONSTRAINT `trx_dosen_bimbingan_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trx_dosen_bimbingan_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_dosen_mk`
--
ALTER TABLE `trx_dosen_mk`
  ADD CONSTRAINT `trx_dosen_mk_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trx_dosen_mk_ibfk_2` FOREIGN KEY (`mk_id`) REFERENCES `master_mata_kuliah` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trx_ewmp`
--
ALTER TABLE `trx_ewmp`
  ADD CONSTRAINT `trx_ewmp_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trx_ewmp_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_hki_buku_dtps`
--
ALTER TABLE `trx_hki_buku_dtps`
  ADD CONSTRAINT `trx_hki_buku_dtps_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trx_hki_buku_dtps_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_ipk_lulusan`
--
ALTER TABLE `trx_ipk_lulusan`
  ADD CONSTRAINT `trx_ipk_lulusan_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_kepuasan_pengguna`
--
ALTER TABLE `trx_kepuasan_pengguna`
  ADD CONSTRAINT `trx_kepuasan_pengguna_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_kerjasama`
--
ALTER TABLE `trx_kerjasama`
  ADD CONSTRAINT `trx_kerjasama_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_kurikulum`
--
ALTER TABLE `trx_kurikulum`
  ADD CONSTRAINT `trx_kurikulum_ibfk_1` FOREIGN KEY (`mk_id`) REFERENCES `master_mata_kuliah` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trx_kurikulum_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_luaran_mhs`
--
ALTER TABLE `trx_luaran_mhs`
  ADD CONSTRAINT `trx_luaran_mhs_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `master_mahasiswa` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `trx_luaran_mhs_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_mahasiswa_asing`
--
ALTER TABLE `trx_mahasiswa_asing`
  ADD CONSTRAINT `trx_mahasiswa_asing_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_masa_studi`
--
ALTER TABLE `trx_masa_studi`
  ADD CONSTRAINT `trx_masa_studi_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_penelitian_dtps`
--
ALTER TABLE `trx_penelitian_dtps`
  ADD CONSTRAINT `trx_penelitian_dtps_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_penelitian_mhs`
--
ALTER TABLE `trx_penelitian_mhs`
  ADD CONSTRAINT `trx_penelitian_mhs_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `master_mahasiswa` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `trx_penelitian_mhs_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `trx_penelitian_mhs_ibfk_3` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_pkm_dtps`
--
ALTER TABLE `trx_pkm_dtps`
  ADD CONSTRAINT `trx_pkm_dtps_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_pkm_mhs`
--
ALTER TABLE `trx_pkm_mhs`
  ADD CONSTRAINT `trx_pkm_mhs_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `master_mahasiswa` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `trx_pkm_mhs_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `trx_pkm_mhs_ibfk_3` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_prestasi_mhs`
--
ALTER TABLE `trx_prestasi_mhs`
  ADD CONSTRAINT `trx_prestasi_mhs_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `master_mahasiswa` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `trx_prestasi_mhs_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_publikasi_dtps`
--
ALTER TABLE `trx_publikasi_dtps`
  ADD CONSTRAINT `trx_publikasi_dtps_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_rekognisi_dosen`
--
ALTER TABLE `trx_rekognisi_dosen`
  ADD CONSTRAINT `trx_rekognisi_dosen_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trx_rekognisi_dosen_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_seleksi_mahasiswa`
--
ALTER TABLE `trx_seleksi_mahasiswa`
  ADD CONSTRAINT `trx_seleksi_mahasiswa_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_sitasi_dtps`
--
ALTER TABLE `trx_sitasi_dtps`
  ADD CONSTRAINT `trx_sitasi_dtps_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trx_sitasi_dtps_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_tempat_kerja`
--
ALTER TABLE `trx_tempat_kerja`
  ADD CONSTRAINT `trx_tempat_kerja_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trx_waktu_tunggu`
--
ALTER TABLE `trx_waktu_tunggu`
  ADD CONSTRAINT `trx_waktu_tunggu_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
