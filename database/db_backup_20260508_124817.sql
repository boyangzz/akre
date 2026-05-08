-- Database Backup: aps
-- Generated: 2026-05-08 12:48:17



CREATE TABLE `admin_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','operator') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_users` (`id`, `username`, `password`, `nama_lengkap`, `role`, `created_at`, `updated_at`) VALUES ('1', 'admin', '$2y$10$0H7HWHszUSO6H.FUqmTaW.NYNQmqnCg7pziIbFeXE4FOFRhGaZ3Ye', 'Administrator', 'admin', '2026-04-27 23:10:41', '2026-04-27 23:10:41');


CREATE TABLE `identitas_pengusul` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_pt` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_fakultas` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_prodi` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenjang` enum('D3','STr','S1','S2','S2T','S3','S3T') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'S1',
  `alamat` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_sk_banpt` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peringkat_akreditasi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `kaprodi_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kaprodi_nidn` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `identitas_pengusul` (`id`, `nama_pt`, `nama_fakultas`, `nama_prodi`, `jenjang`, `alamat`, `telepon`, `email`, `website`, `no_sk_banpt`, `peringkat_akreditasi`, `tanggal_kadaluarsa`, `kaprodi_nama`, `kaprodi_nidn`, `created_at`, `updated_at`) VALUES ('1', 'Universitas XYZ', 'Fakultas Teknik', 'Teknik Informatika', 'D3', '', '', '', '', '', '', '2026-04-30', '', '', '2026-04-27 23:10:41', '2026-05-08 14:57:56');


CREATE TABLE `identitas_prodi_upps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_program` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_peringkat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_tgl_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_kadaluarsa` date DEFAULT NULL,
  `jumlah_mahasiswa` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `master_dosen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nidn` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan_pasca` enum('S2','S3') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bidang_keahlian` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kesesuaian_kompetensi` tinyint(1) DEFAULT '0',
  `jabatan_akademik` enum('Tenaga Pengajar','Asisten Ahli','Lektor','Lektor Kepala','Guru Besar') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Tenaga Pengajar',
  `sertifikat_pendidik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sertifikat_kompetensi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `status_ikatan` enum('tetap','tidak_tetap','industri') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'tetap',
  `status_aktif` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bobot_sks_praktisi` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nidn` (`nidn`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `master_dosen_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('1', '031', 'D1', 'S3', NULL, '1', 'Tenaga Pengajar', '0', NULL, '1', 'tetap', '1', '2026-05-08 09:13:46', '2026-05-08 09:13:46', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('2', '032', 'D2', 'S3', NULL, '1', 'Tenaga Pengajar', '0', NULL, '1', 'tetap', '1', '2026-05-08 09:13:46', '2026-05-08 09:13:46', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('3', '033', 'D3', 'S3', NULL, '1', 'Tenaga Pengajar', '0', NULL, '1', 'tetap', '1', '2026-05-08 09:13:46', '2026-05-08 09:13:46', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('4', '034', 'D4', 'S2', NULL, '1', 'Tenaga Pengajar', '0', NULL, '1', 'tetap', '1', '2026-05-08 09:13:46', '2026-05-08 09:13:46', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('5', '035', 'D5', 'S2', NULL, '1', 'Tenaga Pengajar', '0', NULL, '1', 'tetap', '1', '2026-05-08 09:13:46', '2026-05-08 09:13:46', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('6', '036', 'D6', 'S2', NULL, '1', 'Tenaga Pengajar', '0', NULL, '1', 'tetap', '1', '2026-05-08 09:13:46', '2026-05-08 09:13:46', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('26', 'DUMMY1', 'Dosen Dummy 1', 'S2', NULL, '1', 'Tenaga Pengajar', NULL, NULL, '1', 'tetap', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('27', 'DUMMY2', 'Dosen Dummy 2', 'S2', NULL, '1', 'Tenaga Pengajar', NULL, NULL, '1', 'tetap', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('28', 'DUMMY3', 'Dosen Dummy 3', 'S2', NULL, '1', 'Tenaga Pengajar', NULL, NULL, '1', 'tetap', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('29', 'DUMMY4', 'Dosen Dummy 4', 'S2', NULL, '1', 'Tenaga Pengajar', NULL, NULL, '1', 'tetap', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('30', 'DUMMY5', 'Dosen Dummy 5', 'S2', NULL, '1', 'Tenaga Pengajar', NULL, NULL, '1', 'tetap', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('31', 'DUMMY6', 'Dosen Dummy 6', 'S2', NULL, '1', 'Tenaga Pengajar', NULL, NULL, '1', 'tetap', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('32', 'DUMMY7', 'Dosen Dummy 7', 'S2', NULL, '1', 'Tenaga Pengajar', NULL, NULL, '1', 'tetap', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('33', 'DUMMY8', 'Dosen Dummy 8', 'S2', NULL, '1', 'Tenaga Pengajar', NULL, NULL, '1', 'tetap', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('34', 'DUMMY9', 'Dosen Dummy 9', 'S2', NULL, '1', 'Tenaga Pengajar', NULL, NULL, '1', 'tetap', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('35', 'DUMMY10', 'Dosen Dummy 10', 'S2', NULL, '1', 'Tenaga Pengajar', NULL, NULL, '1', 'tetap', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('36', 'DUMMY11', 'Dosen Dummy 11', 'S2', NULL, '1', 'Tenaga Pengajar', NULL, NULL, '1', 'tetap', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', NULL, '0');
INSERT INTO `master_dosen` (`id`, `nidn`, `nama`, `pendidikan_pasca`, `bidang_keahlian`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `prodi_id`, `status_ikatan`, `status_aktif`, `created_at`, `updated_at`, `nama_perusahaan`, `bobot_sks_praktisi`) VALUES ('37', 'DUMMY12', 'Dosen Dummy 12', 'S2', NULL, '1', 'Tenaga Pengajar', NULL, NULL, '1', 'tetap', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', NULL, '0');


CREATE TABLE `master_mahasiswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `angkatan` year DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `status` enum('aktif','lulus','cuti','do','transfer') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'aktif',
  `jenis` enum('reguler','transfer') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'reguler',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nim` (`nim`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `master_mahasiswa_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `master_mahasiswa` (`id`, `nim`, `nama`, `angkatan`, `prodi_id`, `status`, `jenis`, `created_at`, `updated_at`) VALUES ('1', '2313', 'boy', '2026', '1', 'aktif', 'reguler', '2026-04-28 00:01:15', '2026-04-28 00:01:15');


CREATE TABLE `master_mata_kuliah` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_mk` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_mk` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks_teori` int DEFAULT '0',
  `sks_praktek` int DEFAULT '0',
  `semester` int DEFAULT NULL,
  `jenis_mk` enum('wajib','pilihan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'wajib',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sks_kuliah` int DEFAULT '0',
  `sks_seminar` int DEFAULT '0',
  `sks_praktikum` int DEFAULT '0',
  `konversi_jam` decimal(10,2) DEFAULT '0.00',
  `cpl_sikap` tinyint DEFAULT '0',
  `cpl_pengetahuan` tinyint DEFAULT '0',
  `cpl_ku` tinyint DEFAULT '0',
  `cpl_kk` tinyint DEFAULT '0',
  `unit_penyelenggara` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rps_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_kompetensi` tinyint DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_mk` (`kode_mk`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `master_mata_kuliah_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `master_mata_kuliah` (`id`, `kode_mk`, `nama_mk`, `sks_teori`, `sks_praktek`, `semester`, `jenis_mk`, `prodi_id`, `created_at`, `updated_at`, `sks_kuliah`, `sks_seminar`, `sks_praktikum`, `konversi_jam`, `cpl_sikap`, `cpl_pengetahuan`, `cpl_ku`, `cpl_kk`, `unit_penyelenggara`, `rps_link`, `is_kompetensi`) VALUES ('1', 'a1', 'tesa1', NULL, NULL, '1', NULL, '1', '2026-04-27 23:49:46', '2026-04-27 23:49:46', '0', '0', '0', '0.00', '0', '0', '0', '0', NULL, NULL, '0');


CREATE TABLE `setup_tabel_borang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_tabel` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_tabel` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('identitas','master','kerjasama','mahasiswa','dosen','kurikulum','luaran','keuangan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang_filter` json NOT NULL,
  `is_wajib` tinyint(1) DEFAULT '1',
  `urutan` int DEFAULT '0',
  `kolom_config` json DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_tabel` (`kode_tabel`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('1', '1-1', 'Kerjasama Pendidikan', 'kerjasama', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '1', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:10:41');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('2', '1-2', 'Kerjasama Penelitian', 'kerjasama', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '2', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:10:41');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('3', '1-3', 'Kerjasama PkM', 'kerjasama', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '3', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:10:41');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('4', '2a', 'Seleksi Mahasiswa Baru', 'mahasiswa', '[\"D3\", \"STr\", \"S1\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '4', NULL, NULL, '2026-04-27 23:10:41', '2026-04-28 10:12:18');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('5', '2b', 'Mahasiswa Asing', 'mahasiswa', '[\"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '5', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:36:34');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('6', '3a1', 'Dosen Tetap PT', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '6', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:10:41');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('7', '3a2', 'Pembimbing Utama TA', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '7', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:36:34');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('8', '3a3', 'EWMP Dosen Tetap', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '8', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:36:34');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('9', '3a4', 'Dosen Tidak Tetap', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '9', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:36:34');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('10', '3a5', 'Dosen Industri/Praktisi', 'dosen', '[\"D3\", \"S1\", \"S2\", \"S3\"]', '1', '10', NULL, NULL, '2026-04-27 23:10:41', '2026-05-08 11:10:30');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('11', '3b1', 'Rekognisi Dosen', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '11', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:36:34');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('12', '3b2', 'Penelitian DTPS', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '12', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:36:34');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('13', '3b3', 'PkM DTPS', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '13', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:10:41');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('14', '3b4', 'Publikasi Ilmiah DTPS', 'dosen', '[\"STr\", \"S1\", \"S2\", \"S2T\", \"S3\", \"S3T\", \"D3\"]', '1', '14', NULL, NULL, '2026-04-27 23:10:41', '2026-04-28 10:07:46');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('15', '3b7', 'HKI, Paten, Buku', 'dosen', '[\"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '15', NULL, NULL, '2026-04-27 23:10:41', '2026-05-08 13:58:07');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('16', '3b5', 'Karya Ilmiah yang Disitasi', 'dosen', '[\"D3\", \"STr\", \"S3T\"]', '1', '16', NULL, NULL, '2026-04-27 23:10:41', '2026-05-08 13:57:33');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('17', '3b8', 'Luaran Lainnya', 'dosen', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '17', NULL, NULL, '2026-04-27 23:10:41', '2026-05-08 13:58:07');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('18', '4', 'Keuangan & Sarpras', 'keuangan', '[\"D3\", \"S1\", \"S2\", \"S3\"]', '1', '18', NULL, NULL, '2026-04-27 23:10:41', '2026-05-08 14:07:51');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('19', '5a', 'Kurikulum', 'kurikulum', '[\"D3\", \"S1\", \"S2\", \"S3\"]', '1', '19', NULL, NULL, '2026-04-27 23:10:41', '2026-05-08 14:39:26');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('20', '5b', 'Integrasi Litabmas', 'kurikulum', '[\"D3\", \"S1\", \"S2\", \"S3\"]', '1', '20', NULL, NULL, '2026-04-27 23:10:41', '2026-05-08 14:39:27');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('21', '5c', 'Kepuasan Mhs Pembelajaran', 'kurikulum', '[\"D3\", \"S1\", \"S2\", \"S3\"]', '1', '21', NULL, NULL, '2026-04-27 23:10:41', '2026-05-08 14:39:27');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('22', '6a', 'Penelitian DTPS + Mhs', 'kurikulum', '[\"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '22', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:36:34');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('23', '6b', 'Penelitian Rujukan Tesis', 'kurikulum', '[\"D3\", \"S1\", \"S2\", \"S3\"]', '1', '23', NULL, NULL, '2026-04-27 23:10:41', '2026-05-08 14:46:57');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('24', '7', 'PkM DTPS + Mhs', 'kurikulum', '[\"D3\", \"S1\", \"STr\"]', '1', '24', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:36:34');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('25', '8a', 'IPK Lulusan', 'luaran', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '25', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:36:34');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('26', '8b1', 'Prestasi Akademik Mhs', 'luaran', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '26', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:10:41');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('27', '8b2', 'Prestasi Non-akademik', 'luaran', '[\"D3\", \"S1\", \"STr\"]', '1', '27', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:10:41');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('28', '8c', 'Masa Studi Lulusan', 'luaran', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\"]', '1', '28', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:10:41');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('29', '8d1', 'Waktu Tunggu Lulusan', 'luaran', '[\"D3\", \"S1\", \"STr\"]', '1', '29', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:36:34');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('30', '8d2', 'Kesesuaian Bidang Kerja', 'luaran', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\"]', '1', '30', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:36:34');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('31', '8e1', 'Tempat Kerja Lulusan', 'luaran', '[\"D3\", \"S1\", \"STr\"]', '1', '31', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:36:34');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('32', '8e2', 'Kepuasan Pengguna', 'luaran', '[\"D3\", \"S1\", \"STr\", \"S2\", \"S2T\"]', '1', '32', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:10:41');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('33', '8f1', 'Publikasi Ilmiah Mhs', 'luaran', '[\"STr\", \"S1\", \"S2\", \"S2T\", \"S3\", \"D3\"]', '1', '33', NULL, NULL, '2026-04-27 23:10:41', '2026-04-28 10:07:46');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('34', '8f1t', 'Publikasi Mhs Terapan', 'luaran', '[\"D3\", \"STr\", \"S2T\", \"S3T\"]', '1', '34', NULL, NULL, '2026-04-27 23:10:41', '2026-04-27 23:10:41');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('35', '8f2', 'Sitasi Karya Mhs', 'luaran', '[\"D3\", \"STr\", \"S2\", \"S2T\", \"S3T\"]', '1', '35', NULL, NULL, '2026-04-27 23:10:41', '2026-05-08 09:52:42');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('36', '8f3', 'Luaran Mhs Buku', 'luaran', '[\"D3\", \"STr\", \"S2\", \"S2T\", \"S3T\"]', '1', '36', NULL, NULL, '2026-04-27 23:10:41', '2026-04-28 09:02:37');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('37', '8f4', 'Luaran Mhs HKI/Produk', 'luaran', '[\"S1\", \"STr\", \"S2\", \"S2T\", \"S3\", \"S3T\", \"D3\"]', '1', '37', NULL, NULL, '2026-04-27 23:10:41', '2026-04-28 10:07:46');
INSERT INTO `setup_tabel_borang` (`id`, `kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `is_wajib`, `urutan`, `kolom_config`, `deskripsi`, `created_at`, `updated_at`) VALUES ('38', '3b6', 'Produk/Jasa yang Diadopsi', 'dosen', '[\"D3\", \"S1\"]', '1', '6', NULL, NULL, '2026-05-08 13:58:07', '2026-05-08 13:58:07');


CREATE TABLE `simulasi_matriks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_elemen` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` decimal(5,2) NOT NULL,
  `deskripsi_indikator` text COLLATE utf8mb4_unicode_ci,
  `rumus_kalkulasi` text COLLATE utf8mb4_unicode_ci,
  `sumber_data` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('29', 'C.1.4', 'S1', '0.51', 'Kesesuaian VMTS Unit Pengelola Program Studi (UPPS) terhadap VMTS PT dan visi keilmuan PS.', 'Penilaian Kualitatif (0-4). UPPS memiliki visi yang mencerminkan visi PT dan memayungi visi keilmuan PS.', 'Input Manual Asesor (LED)', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('30', 'C.2.4.a', 'S1', '0.34', 'Sistem Tata Pamong berjalan secara efektif (Kredibel, Transparan, Akuntabel, Bertanggung Jawab, Adil).', 'Skor 4: Jika sistem tata pamong didukung oleh dokumen formal dan bukti implementasi yang konsisten.', 'Input Manual Asesor (LED)', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('31', 'C.2.4.b', 'S1', '0.34', 'Keefektifan kepemimpinan operasional, organisasional, dan publik di tingkat PS.', 'Penilaian Kualitatif Asesor (0-4). Menilai tata kelola dan keberlanjutan prodi.', 'Input Manual Asesor', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('32', 'C.2.4.c', 'S1', '0.68', 'Mutu, manfaat, dan keberlanjutan kerjasama akademik dan non-akademik (Internasional, Nasional, Lokal).', 'Skor 4: Jika memiliki kerjasama internasional dan nasional yang aktif memberikan kontribusi nyata bagi CPL.', 'Tabel: trx_kerjasama', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('33', 'C.3.4.a', 'S1', '4.60', 'Keketatan seleksi mahasiswa baru (Rasio Pendaftar / Lulus Seleksi).', 'Skor 4: Jika Rasio >= 5.0<br>Skor (Rasio-1) * 0.75 + 1: Jika 1 < Rasio < 5', 'Tabel: trx_seleksi_mahasiswa', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('34', 'C.3.4.b', 'S1', '3.07', 'Peningkatan animo calon mahasiswa dan daya tarik program studi.', 'Skor 4: Jika jumlah pendaftar meningkat >= 10% per tahun dalam 3 tahun terakhir.', 'Tabel: trx_seleksi_mahasiswa', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('35', 'C.3.4.c', 'S1', '1.53', 'Layanan kemahasiswaan (Bimbingan Karir, Beasiswa, Kesehatan, Minat Bakat).', 'Menilai ketersediaan dan efektivitas penggunaan layanan oleh mahasiswa.', 'Input Manual Asesor', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('36', 'C.4.4.a', 'S1', '0.74', 'Kecukupan jumlah dosen tetap (NDTPS) minimal 12 orang.', 'Skor 4: Jika NDTPS >= 12<br>Skor ((2 * NDTPS) + 12) / 9: Jika NDTPS < 12', 'Tabel: master_dosen', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('37', 'C.4.4.b', 'S1', '0.99', 'Kualifikasi akademik dosen tetap (Persentase Doktor/S3).', 'Skor 4: Jika PDS >= 50%<br>Skor 2 + (4 * PDS): Jika PDS < 50%', 'Tabel: master_dosen', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('38', 'C.4.4.c', 'S1', '0.99', 'Jabatan akademik dosen tetap (Lektor Kepala dan Guru Besar).', 'Skor 4: Jika (LK + GB) >= 70%<br>Skor 2 + (20/7 * (LK+GB)): Jika < 70%', 'Tabel: master_dosen', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('39', 'C.4.4.d', 'S1', '1.12', 'Kualifikasi dan kecukupan tenaga kependidikan untuk mendukung Tridharma.', 'Menilai kecukupan pustakawan, laboran, teknisi, dan staf administrasi.', 'Input Manual Asesor', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('40', 'C.5.4.a', 'S1', '0.77', 'Rata-rata dana operasional pendidikan per mahasiswa per tahun (DOP).', 'Skor 4: Jika DOP >= 20 Juta<br>Skor (DOP / 20) * 4: Jika < 20 Juta', 'Tabel: trx_penggunaan_dana', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('41', 'C.5.4.b', 'S1', '3.07', 'Kecukupan, aksesibilitas, dan mutu sarana prasarana pembelajaran.', 'Fokus pada ruang kuliah, laboratorium, dan ketersediaan pustaka mutakhir.', 'Input Manual Asesor', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('42', 'C.6.4.a', 'S1', '2.51', 'Keterlibatan pemangku kepentingan dalam evaluasi dan pemutakhiran kurikulum.', 'Skor 4: Melibatkan asosiasi, alumni, dan pengguna secara berkala (4-5 tahun sekali).', 'Input Manual Asesor', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('43', 'C.6.4.b', 'S1', '1.12', 'Kesesuaian capaian pembelajaran (CPL) dengan profil lulusan dan jenjang KKNI (Level 6).', 'Menilai kedalaman materi dan kesesuaian matakuliah dengan CPL yang ditetapkan.', 'Input Manual Asesor', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('44', 'C.6.4.c', 'S1', '1.12', 'Ketersediaan dan pemutakhiran Rencana Pembelajaran Semester (RPS).', 'Skor 4: Jika 100% matakuliah memiliki RPS yang disusun berdasarkan hasil penelitian dan PkM.', 'Input Manual Asesor', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('45', 'C.6.4.d', 'S1', '1.12', 'Karakteristik proses pembelajaran yang Interaktif, Holistik, dan berpusat pada mahasiswa (SCL).', 'Menilai implementasi Case Method dan Team-Based Project.', 'Input Manual Asesor', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('46', 'C.6.4.e', 'S1', '0.56', 'Sistem Monitoring dan Evaluasi proses pembelajaran secara periodik.', 'Skor 4: Dilakukan secara sistematis, terdokumentasi, dan ada tindak lanjut (siklus PPEPP).', 'Input Manual Asesor', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('47', 'C.6.4.f', 'S1', '1.12', 'Pelaksanaan penilaian pembelajaran yang valid, objektif, adil, dan akuntabel.', 'Menilai rubrik penilaian dan transparansi pengumuman nilai mahasiswa.', 'Input Manual Asesor', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('48', 'C.6.4.g', 'S1', '0.56', 'Integrasi hasil penelitian dan PkM dosen ke dalam materi pembelajaran.', 'Skor 4: Jika terdapat banyak mata kuliah yang diperkaya hasil penelitian dosen.', 'Tabel: trx_kurikulum', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('49', 'C.6.4.h', 'S1', '0.56', 'Kualitas suasana akademik untuk mendukung otonomi keilmuan dosen dan mahasiswa.', 'Menilai interaksi ilmiah dan pengembangan budaya akademik di lingkungan prodi.', 'Input Manual Asesor', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('50', 'C.7.4.a', 'S1', '2.00', 'Relevansi penelitian terhadap roadmap penelitian UPPS dan melibatkan mahasiswa.', 'Skor 4: Jika penelitian memiliki dampak keilmuan/praktis dan melibatkan > 25% mahasiswa.', 'Tabel: trx_penelitian_dtps', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('51', 'C.7.4.b', 'S1', '1.05', NULL, NULL, NULL, '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('52', 'C.8.4.a', 'S1', '0.80', 'Relevansi Pengabdian kepada Masyarakat (PkM) terhadap roadmap dan kemanfataan bagi masyarakat.', 'Skor 4: Jika PkM memberikan solusi nyata bagi masalah masyarakat dan melibatkan mahasiswa.', 'Tabel: trx_pkm_dtps', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('53', 'C.8.4.b', 'S1', '1.05', NULL, NULL, NULL, '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('54', 'C.9.4.a', 'S1', '1.05', 'Rata-rata IPK lulusan dalam 3 tahun terakhir (Target: >= 3.25).', 'Skor 4: Jika RIPK >= 3.25<br>Skor (RIPK - 2.00) / 1.25 * 4: Jika 2.00 <= RIPK < 3.25', 'Tabel: trx_ipk_lulusan', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('55', 'C.9.4.b', 'S1', '1.05', 'Prestasi mahasiswa di bidang akademik dan non-akademik (Internasional/Nasional).', 'Menilai jumlah dan kualitas medali/penghargaan yang diraih mahasiswa.', 'Tabel: trx_prestasi_mhs', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('56', 'C.9.4.c', 'S1', '1.05', 'Rata-rata masa studi lulusan (Target: 3.5 s.d 4.5 tahun).', 'Skor 4: Jika MS <= 4.0 tahun<br>Skor 0: Jika MS > 7.0 tahun', 'Tabel: trx_masa_studi', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('57', 'C.9.4.d', 'S1', '3.16', 'Waktu tunggu lulusan untuk mendapatkan pekerjaan pertama (Target: <= 6 bulan).', 'Skor 4: Jika WT <= 6 bulan<br>Skor (18 - WT) / 12 * 4: Jika 6 < WT < 18', 'Tabel: trx_waktu_tunggu', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('58', 'C.9.4.e', 'S1', '2.11', 'Kesesuaian bidang kerja lulusan dengan profil lulusan (Target: >= 60%).', 'Skor 4: Jika PBS >= 60%<br>Skor (PBS / 60) * 4: Jika < 60%', 'Tabel: trx_waktu_tunggu', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('59', 'C.9.4.f', 'S1', '3.16', 'Tingkat kepuasan pengguna lulusan terhadap kompetensi alumni.', 'Skor 4: Jika Indeks Kepuasan Pengguna >= 3.50.', 'Tabel: trx_kepuasan_pengguna', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('60', 'C.9.4.g', 'S1', '1.05', 'Publikasi ilmiah mahasiswa (Jurnal Nasional/Internasional) dan Sitasi.', 'Menilai jumlah artikel mahasiswa di jurnal bereputasi atau sitasi karya ilmiah.', 'Tabel: trx_luaran_mhs', '2026-04-28 14:27:48');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('63', 'C.1.4', 'D3', '0.52', 'Kesesuaian VMTS UPPS terhadap VMTS PT dan visi keilmuan PS D3.', 'Penilaian Kualitatif (0-4). Fokus pada kejelasan visi vokasi.', 'Input Manual Asesor', '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('64', 'C.2.4.a', 'D3', '0.35', 'Sistem Tata Pamong dan Good Governance (Kredibel, Transparan, Akuntabel, Bertanggung Jawab, Adil).', 'Menilai efektivitas struktur organisasi vokasi.', 'Input Manual Asesor', '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('65', 'C.2.4.b', 'D3', '0.35', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('66', 'C.2.4.c', 'D3', '0.69', 'Mutu, manfaat, dan keberlanjutan kerjasama industri/akademik.', 'Skor 4: Jika memiliki kerjasama industri yang memberikan tempat magang dan serapan lulusan.', 'Tabel: trx_kerjasama', '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('67', 'C.3.4.a', 'D3', '4.68', 'Keketatan seleksi mahasiswa baru (Pendaftar / Lulus).', 'Skor 4: Jika Rasio >= 5.0.', 'Tabel: trx_seleksi_mahasiswa', '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('68', 'C.3.4.b', 'D3', '3.12', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('69', 'C.3.4.c', 'D3', '1.56', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('70', 'C.4.4.a', 'D3', '0.62', 'Kecukupan jumlah dosen tetap (NDTPS) minimal 12 orang.', 'Skor 4: Jika NDTPS >= 12.', 'Tabel: master_dosen', '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('71', 'C.4.4.b', 'D3', '0.91', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('72', 'C.4.4.c', 'D3', '2.27', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('73', 'C.4.4.d', 'D3', '1.13', 'Dosen tetap yang memiliki Sertifikat Kompetensi/Profesi/Industri.', 'Skor 4: Jika >= 50% dosen memiliki sertifikat kompetensi yang relevan.', 'Tabel: master_dosen', '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('74', 'C.4.4.e', 'D3', '0.50', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('75', 'C.4.4.f', 'D3', '0.50', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('76', 'C.4.4.g', 'D3', '1.13', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('77', 'C.5.4.a', 'D3', '0.78', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('78', 'C.5.4.b', 'D3', '3.12', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('79', 'C.6.4.a', 'D3', '2.55', 'Kesesuaian kurikulum dengan standar industri dan KKNI Level 5.', 'Menilai keterlibatan industri dalam penyusunan kurikulum.', 'Input Manual Asesor', '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('80', 'C.6.4.b', 'D3', '0.85', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('81', 'C.6.4.c', 'D3', '1.70', 'Kedalaman dan keluasan kurikulum sesuai dengan capaian pembelajaran vokasi.', 'Skor 4: Menitikberatkan pada porsi praktikum (min 60%).', 'Input Manual Asesor', '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('82', 'C.6.4.d', 'D3', '1.13', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('83', 'C.6.4.e', 'D3', '2.55', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('84', 'C.6.4.f', 'D3', '1.70', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('85', 'C.6.4.g', 'D3', '1.70', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('86', 'C.6.4.h', 'D3', '2.55', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('87', 'C.6.4.i', 'D3', '3.40', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('88', 'C.7.4.a', 'D3', '1.56', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('89', 'C.7.4.b', 'D3', '3.07', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('90', 'C.8.4.a', 'D3', '1.04', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('91', 'C.8.4.b', 'D3', '2.08', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('92', 'C.9.4.a', 'D3', '2.03', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('93', 'C.9.4.b', 'D3', '2.88', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('94', 'C.9.4.c', 'D3', '5.56', 'Rata-rata masa studi lulusan (Target: 3 tahun).', 'Skor 4: Jika MS <= 3.0 tahun.', 'Tabel: trx_masa_studi', '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('95', 'C.9.4.d', 'D3', '5.56', 'Waktu tunggu lulusan untuk mendapatkan pekerjaan (Target: <= 3 bulan).', 'Skor 4: Jika WT <= 3 bulan.', 'Tabel: trx_waktu_tunggu', '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('96', 'C.9.4.e', 'D3', '5.56', 'Kesesuaian bidang kerja lulusan dengan profil lulusan D3.', 'Skor 4: Jika PBS >= 80% (Standar vokasi lebih tinggi).', 'Tabel: trx_waktu_tunggu', '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('97', 'C.9.4.f', 'D3', '2.03', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('98', 'C.9.4.g', 'D3', '2.03', NULL, NULL, NULL, '2026-04-28 15:19:49');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('99', 'C.1.X', 'D3', '1.48', 'Indikator Pelengkap Kriteria 1 (Visi Misi)', 'Evaluasi pendukung VMTS', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('100', 'C.2.X', 'D3', '3.61', 'Indikator Pelengkap Kriteria 2 (Tata Pamong)', 'Evaluasi pendukung Tata Kelola', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('101', 'C.3.X', 'D3', '0.64', 'Indikator Pelengkap Kriteria 3 (Mahasiswa)', 'Evaluasi pendukung Kemahasiswaan', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('102', 'C.4.X', 'D3', '7.94', 'Indikator Pelengkap Kriteria 4 (SDM)', 'Evaluasi pendukung SDM', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('103', 'C.5.X', 'D3', '6.10', 'Indikator Pelengkap Kriteria 5 (Keuangan/Sarpras)', 'Evaluasi pendukung Sarpras', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('104', 'C.6.X', 'D3', '1.87', 'Indikator Pelengkap Kriteria 6 (Pendidikan)', 'Evaluasi pendukung Kurikulum', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('105', 'C.7.X', 'D3', '0.37', 'Indikator Pelengkap Kriteria 7 (Penelitian)', 'Evaluasi pendukung Penelitian', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('106', 'C.8.X', 'D3', '1.88', 'Indikator Pelengkap Kriteria 8 (PkM)', 'Evaluasi pendukung PkM', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('107', 'C.9.X', 'D3', '2.35', 'Indikator Pelengkap Kriteria 9 (Luaran)', 'Evaluasi pendukung Luaran', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('108', 'C.1.X', 'S1', '1.59', 'Indikator Pelengkap Kriteria 1 (Visi Misi)', 'Evaluasi pendukung VMTS', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('109', 'C.2.X', 'S1', '3.94', 'Indikator Pelengkap Kriteria 2 (Tata Pamong)', 'Evaluasi pendukung Tata Kelola', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('110', 'C.3.X', 'S1', '0.80', 'Indikator Pelengkap Kriteria 3 (Mahasiswa)', 'Evaluasi pendukung Kemahasiswaan', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('111', 'C.4.X', 'S1', '12.00', 'Indikator Pelengkap Kriteria 4 (SDM)', 'Evaluasi pendukung SDM', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('112', 'C.5.X', 'S1', '1.46', 'Indikator Pelengkap Kriteria 5 (Keuangan/Sarpras)', 'Evaluasi pendukung Sarpras', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('113', 'C.6.X', 'S1', '9.73', 'Indikator Pelengkap Kriteria 6 (Pendidikan)', 'Evaluasi pendukung Kurikulum', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('114', 'C.7.X', 'S1', '2.25', 'Indikator Pelengkap Kriteria 7 (Penelitian)', 'Evaluasi pendukung Penelitian', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('115', 'C.8.X', 'S1', '0.75', 'Indikator Pelengkap Kriteria 8 (PkM)', 'Evaluasi pendukung PkM', 'Input Manual Asesor', '2026-05-04 13:50:42');
INSERT INTO `simulasi_matriks` (`id`, `kode_elemen`, `jenjang`, `bobot`, `deskripsi_indikator`, `rumus_kalkulasi`, `sumber_data`, `created_at`) VALUES ('116', 'C.9.X', 'S1', '22.53', 'Indikator Pelengkap Kriteria 9 (Luaran)', 'Evaluasi pendukung Luaran', 'Input Manual Asesor', '2026-05-04 13:50:42');


CREATE TABLE `simulasi_scenarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_skenario` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang` enum('D3','S1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `simulasi_scenarios` (`id`, `nama_skenario`, `jenjang`, `is_active`, `created_at`) VALUES ('1', 'Skenario Utama (Default)', 'D3', '0', '2026-04-28 15:51:18');
INSERT INTO `simulasi_scenarios` (`id`, `nama_skenario`, `jenjang`, `is_active`, `created_at`) VALUES ('2', 'Skenario Utama (Default)', 'S1', '1', '2026-04-28 15:51:18');
INSERT INTO `simulasi_scenarios` (`id`, `nama_skenario`, `jenjang`, `is_active`, `created_at`) VALUES ('3', 'testing 2', 'D3', '1', '2026-05-04 10:37:31');


CREATE TABLE `simulasi_skor_asesor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `scenario_id` int DEFAULT '0',
  `matriks_id` int NOT NULL,
  `skor` decimal(5,2) NOT NULL DEFAULT '0.00',
  `nilai` decimal(5,2) NOT NULL DEFAULT '0.00',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `matriks_id` (`matriks_id`),
  CONSTRAINT `simulasi_skor_asesor_ibfk_1` FOREIGN KEY (`matriks_id`) REFERENCES `simulasi_matriks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('1', '1', '63', '4.00', '2.08', NULL, '2026-05-04 09:35:08');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('2', '1', '64', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('3', '1', '65', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('4', '1', '66', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('5', '1', '67', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('6', '1', '68', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('7', '1', '69', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('8', '1', '70', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('9', '1', '71', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('10', '1', '72', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('11', '1', '73', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('12', '1', '74', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('13', '1', '75', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('14', '1', '76', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('15', '1', '77', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('16', '1', '78', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('17', '1', '79', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('18', '1', '80', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('19', '1', '81', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('20', '1', '82', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('21', '1', '83', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('22', '1', '84', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('23', '1', '85', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('24', '1', '86', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('25', '1', '87', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('26', '1', '88', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('27', '1', '89', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('28', '1', '90', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('29', '1', '91', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('30', '1', '92', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('31', '1', '93', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('32', '1', '94', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('33', '1', '95', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('34', '1', '96', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('35', '1', '97', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('36', '1', '98', '0.00', '0.00', NULL, '2026-05-04 10:33:21');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('37', '3', '63', '4.00', '2.08', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('38', '3', '64', '4.00', '1.40', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('39', '3', '65', '4.00', '1.40', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('40', '3', '66', '4.00', '2.76', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('41', '3', '67', '3.00', '14.04', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('42', '3', '68', '3.00', '9.36', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('43', '3', '69', '2.99', '4.66', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('44', '3', '70', '3.00', '1.86', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('45', '3', '71', '4.00', '3.64', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('46', '3', '72', '4.00', '9.08', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('47', '3', '73', '2.99', '3.38', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('48', '3', '74', '3.00', '1.50', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('49', '3', '75', '3.00', '1.50', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('50', '3', '76', '4.00', '4.52', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('51', '3', '77', '4.00', '3.12', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('52', '3', '78', '4.00', '12.48', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('53', '3', '79', '3.98', '10.15', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('54', '3', '80', '4.00', '3.40', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('55', '3', '81', '4.00', '6.80', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('56', '3', '82', '4.00', '4.52', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('57', '3', '83', '4.00', '10.20', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('58', '3', '84', '3.30', '5.61', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('59', '3', '85', '3.00', '5.10', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('60', '3', '86', '4.00', '10.20', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('61', '3', '87', '3.00', '10.20', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('62', '3', '88', '4.00', '6.24', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('63', '3', '89', '3.99', '12.25', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('64', '3', '90', '3.00', '3.12', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('65', '3', '91', '3.50', '7.28', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('66', '3', '92', '3.00', '6.09', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('67', '3', '93', '3.00', '8.64', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('68', '3', '94', '3.99', '22.18', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('69', '3', '95', '4.00', '22.24', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('70', '3', '96', '4.00', '22.24', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('71', '3', '97', '4.00', '8.12', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('72', '3', '98', '3.00', '6.09', '', '2026-05-04 10:55:27');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('73', '0', '29', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('74', '0', '30', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('75', '0', '31', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('76', '0', '32', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('77', '0', '33', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('78', '0', '34', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('79', '0', '35', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('80', '0', '36', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('81', '0', '37', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('82', '0', '38', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('83', '0', '39', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('84', '0', '40', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('85', '0', '41', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('86', '0', '42', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('87', '0', '43', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('88', '0', '44', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('89', '0', '45', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('90', '0', '46', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('91', '0', '47', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('92', '0', '48', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('93', '0', '49', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('94', '0', '50', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('95', '0', '51', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('96', '0', '52', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('97', '0', '53', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('98', '0', '54', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('99', '0', '55', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('100', '0', '56', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('101', '0', '57', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('102', '0', '58', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('103', '0', '59', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('104', '0', '60', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('105', '0', '99', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('106', '0', '100', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('107', '0', '101', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('108', '0', '102', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('109', '0', '103', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('110', '0', '104', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('111', '0', '105', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('112', '0', '106', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('113', '0', '107', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('114', '0', '108', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('115', '0', '109', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('116', '0', '110', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('117', '0', '111', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('118', '0', '112', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('119', '0', '113', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('120', '0', '114', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('121', '0', '115', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('122', '0', '116', '0.00', '0.00', NULL, '2026-05-04 13:50:55');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('136', '3', '99', '3.00', '4.44', '', '2026-05-04 13:54:28');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('137', '3', '100', '3.00', '10.83', '', '2026-05-04 13:54:28');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('138', '3', '101', '4.00', '2.56', '', '2026-05-04 13:54:28');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('139', '3', '102', '4.00', '31.76', '', '2026-05-04 13:54:28');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('140', '3', '103', '4.00', '24.40', '', '2026-05-04 13:54:28');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('141', '3', '104', '3.00', '5.61', '', '2026-05-04 13:54:28');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('142', '3', '105', '3.00', '1.11', '', '2026-05-04 13:54:28');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('143', '3', '106', '3.00', '5.64', '', '2026-05-04 13:54:28');
INSERT INTO `simulasi_skor_asesor` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `catatan`, `updated_at`) VALUES ('144', '3', '107', '4.00', '9.40', '', '2026-05-04 13:54:28');


CREATE TABLE `simulasi_skor_sistem` (
  `id` int NOT NULL AUTO_INCREMENT,
  `scenario_id` int DEFAULT '0',
  `matriks_id` int NOT NULL,
  `skor` decimal(5,2) NOT NULL DEFAULT '0.00',
  `nilai` decimal(5,2) NOT NULL DEFAULT '0.00',
  `last_calculated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `matriks_id` (`matriks_id`),
  CONSTRAINT `simulasi_skor_sistem_ibfk_1` FOREIGN KEY (`matriks_id`) REFERENCES `simulasi_matriks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('1', '2', '36', '2.67', '1.97', '2026-05-08 09:28:52');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('2', '2', '37', '4.00', '3.96', '2026-05-08 09:28:52');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('3', '2', '38', '2.00', '1.98', '2026-05-08 09:28:52');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('4', '2', '33', '4.00', '18.40', '2026-05-08 09:28:52');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('5', '2', '54', '4.00', '4.20', '2026-05-08 09:28:52');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('6', '2', '56', '0.00', '0.00', '2026-05-08 09:28:52');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('7', '2', '57', '1.00', '3.16', '2026-05-08 09:28:52');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('8', '2', '30', '4.00', '1.36', '2026-05-08 09:28:52');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('9', '2', '39', '0.00', '0.00', '2026-05-08 09:28:52');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('10', '2', '55', '0.00', '0.00', '2026-05-08 09:28:52');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('11', '2', '58', '4.00', '8.44', '2026-05-08 09:28:52');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('12', '2', '59', '0.00', '0.00', '2026-05-08 09:28:52');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('13', '2', '60', '0.00', '0.00', '2026-05-08 09:28:52');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('14', '3', '70', '4.00', '2.48', '2026-05-08 16:29:21');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('15', '3', '67', '4.00', '18.72', '2026-05-08 16:29:21');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('16', '3', '92', '4.00', '8.12', '2026-05-08 16:29:21');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('17', '3', '94', '3.93', '21.87', '2026-05-08 16:29:21');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('18', '3', '66', '4.00', '2.76', '2026-05-08 16:29:21');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('19', '3', '73', '0.00', '0.00', '2026-05-08 16:29:21');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('20', '3', '93', '0.00', '0.00', '2026-05-08 16:29:21');
INSERT INTO `simulasi_skor_sistem` (`id`, `scenario_id`, `matriks_id`, `skor`, `nilai`, `last_calculated`) VALUES ('21', '3', '95', '4.00', '22.24', '2026-05-08 16:29:21');


CREATE TABLE `trx_dosen_bimbingan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dosen_id` int NOT NULL,
  `tahun_akademik` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jml_bimbingan_ps` int DEFAULT '0',
  `jml_bimbingan_ps_lain` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ps_sendiri_ts2` int DEFAULT '0',
  `ps_sendiri_ts1` int DEFAULT '0',
  `ps_sendiri_ts` int DEFAULT '0',
  `ps_lain_ts2` int DEFAULT '0',
  `ps_lain_ts1` int DEFAULT '0',
  `ps_lain_ts` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `dosen_id` (`dosen_id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_dosen_bimbingan_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trx_dosen_bimbingan_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_dosen_mk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dosen_id` int NOT NULL,
  `mk_id` int NOT NULL,
  `tahun_akademik` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `dosen_id` (`dosen_id`),
  KEY `mk_id` (`mk_id`),
  CONSTRAINT `trx_dosen_mk_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trx_dosen_mk_ibfk_2` FOREIGN KEY (`mk_id`) REFERENCES `master_mata_kuliah` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_ewmp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dosen_id` int NOT NULL,
  `tahun_akademik` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sks_pendidikan_ps` decimal(10,2) DEFAULT '0.00',
  `sks_pendidikan_luar` decimal(10,2) DEFAULT '0.00',
  `sks_penelitian` decimal(10,2) DEFAULT '0.00',
  `sks_pkm` decimal(10,2) DEFAULT '0.00',
  `sks_tugas_tambahan` decimal(10,2) DEFAULT '0.00',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `dosen_id` (`dosen_id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_ewmp_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trx_ewmp_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_hki_buku_dtps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dosen_id` int NOT NULL,
  `judul` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year DEFAULT NULL,
  `keterangan` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `dosen_id` (`dosen_id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_hki_buku_dtps_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trx_hki_buku_dtps_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_integrasi_pembelajaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dosen_id` int DEFAULT NULL,
  `matakuliah_id` int DEFAULT NULL,
  `bentuk_integrasi` text COLLATE utf8mb4_unicode_ci,
  `tahun` year DEFAULT NULL,
  `prodi_id` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_ipk_lulusan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun_lulus` year DEFAULT NULL,
  `jml_lulusan` int DEFAULT '0',
  `ipk_min` decimal(4,2) DEFAULT NULL,
  `ipk_max` decimal(4,2) DEFAULT NULL,
  `ipk_rata` decimal(4,2) DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_ipk_lulusan_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_ipk_lulusan` (`id`, `tahun_lulus`, `jml_lulusan`, `ipk_min`, `ipk_max`, `ipk_rata`, `prodi_id`, `created_at`, `updated_at`) VALUES ('5', '2022', '50', '2.75', '3.90', '3.25', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43');
INSERT INTO `trx_ipk_lulusan` (`id`, `tahun_lulus`, `jml_lulusan`, `ipk_min`, `ipk_max`, `ipk_rata`, `prodi_id`, `created_at`, `updated_at`) VALUES ('6', '2023', '55', '2.80', '3.95', '3.30', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43');
INSERT INTO `trx_ipk_lulusan` (`id`, `tahun_lulus`, `jml_lulusan`, `ipk_min`, `ipk_max`, `ipk_rata`, `prodi_id`, `created_at`, `updated_at`) VALUES ('7', '2024', '60', '2.85', '4.00', '3.35', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43');


CREATE TABLE `trx_kepuasan_mhs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `aspek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sangat_baik` decimal(5,2) DEFAULT '0.00',
  `baik` decimal(5,2) DEFAULT '0.00',
  `cukup` decimal(5,2) DEFAULT '0.00',
  `kurang` decimal(5,2) DEFAULT '0.00',
  `tindak_lanjut` text COLLATE utf8mb4_unicode_ci,
  `prodi_id` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_kepuasan_mhs` (`id`, `aspek`, `sangat_baik`, `baik`, `cukup`, `kurang`, `tindak_lanjut`, `prodi_id`) VALUES ('1', 'Keandalan (reliability)', '0.00', '0.00', '0.00', '0.00', NULL, '1');
INSERT INTO `trx_kepuasan_mhs` (`id`, `aspek`, `sangat_baik`, `baik`, `cukup`, `kurang`, `tindak_lanjut`, `prodi_id`) VALUES ('2', 'Daya tanggap (responsiveness)', '0.00', '0.00', '0.00', '0.00', NULL, '1');
INSERT INTO `trx_kepuasan_mhs` (`id`, `aspek`, `sangat_baik`, `baik`, `cukup`, `kurang`, `tindak_lanjut`, `prodi_id`) VALUES ('3', 'Kepastian (assurance)', '0.00', '0.00', '0.00', '0.00', NULL, '1');
INSERT INTO `trx_kepuasan_mhs` (`id`, `aspek`, `sangat_baik`, `baik`, `cukup`, `kurang`, `tindak_lanjut`, `prodi_id`) VALUES ('4', 'Empati (empathy)', '0.00', '0.00', '0.00', '0.00', NULL, '1');
INSERT INTO `trx_kepuasan_mhs` (`id`, `aspek`, `sangat_baik`, `baik`, `cukup`, `kurang`, `tindak_lanjut`, `prodi_id`) VALUES ('5', 'Tangible', '0.00', '0.00', '0.00', '0.00', NULL, '1');


CREATE TABLE `trx_kepuasan_pengguna` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_kemampuan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `persen_sangat_baik` decimal(5,2) DEFAULT '0.00',
  `persen_baik` decimal(5,2) DEFAULT '0.00',
  `persen_cukup` decimal(5,2) DEFAULT '0.00',
  `persen_kurang` decimal(5,2) DEFAULT '0.00',
  `rencana_tindak_lanjut` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_kepuasan_pengguna_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_kepuasan_pengguna` (`id`, `jenis_kemampuan`, `persen_sangat_baik`, `persen_baik`, `persen_cukup`, `persen_kurang`, `rencana_tindak_lanjut`, `prodi_id`, `created_at`, `updated_at`) VALUES ('1', 'Etika', '11.00', '11.00', '11.00', '11.00', '22', '1', '2026-04-28 00:09:40', '2026-04-28 00:09:40');
INSERT INTO `trx_kepuasan_pengguna` (`id`, `jenis_kemampuan`, `persen_sangat_baik`, `persen_baik`, `persen_cukup`, `persen_kurang`, `rencana_tindak_lanjut`, `prodi_id`, `created_at`, `updated_at`) VALUES ('2', 'Keahlian pada bidang ilmu (kompetensi utama)', '0.00', '0.00', '0.00', '0.00', NULL, '1', '2026-05-08 15:15:56', '2026-05-08 15:15:56');
INSERT INTO `trx_kepuasan_pengguna` (`id`, `jenis_kemampuan`, `persen_sangat_baik`, `persen_baik`, `persen_cukup`, `persen_kurang`, `rencana_tindak_lanjut`, `prodi_id`, `created_at`, `updated_at`) VALUES ('3', 'Kemampuan berbahasa asing', '0.00', '0.00', '0.00', '0.00', NULL, '1', '2026-05-08 15:15:56', '2026-05-08 15:15:56');
INSERT INTO `trx_kepuasan_pengguna` (`id`, `jenis_kemampuan`, `persen_sangat_baik`, `persen_baik`, `persen_cukup`, `persen_kurang`, `rencana_tindak_lanjut`, `prodi_id`, `created_at`, `updated_at`) VALUES ('4', 'Penggunaan teknologi informasi', '0.00', '0.00', '0.00', '0.00', NULL, '1', '2026-05-08 15:15:56', '2026-05-08 15:15:56');
INSERT INTO `trx_kepuasan_pengguna` (`id`, `jenis_kemampuan`, `persen_sangat_baik`, `persen_baik`, `persen_cukup`, `persen_kurang`, `rencana_tindak_lanjut`, `prodi_id`, `created_at`, `updated_at`) VALUES ('5', 'Kemampuan berkomunikasi', '0.00', '0.00', '0.00', '0.00', NULL, '1', '2026-05-08 15:15:56', '2026-05-08 15:15:56');
INSERT INTO `trx_kepuasan_pengguna` (`id`, `jenis_kemampuan`, `persen_sangat_baik`, `persen_baik`, `persen_cukup`, `persen_kurang`, `rencana_tindak_lanjut`, `prodi_id`, `created_at`, `updated_at`) VALUES ('6', 'Kerjasama', '0.00', '0.00', '0.00', '0.00', NULL, '1', '2026-05-08 15:15:56', '2026-05-08 15:15:56');
INSERT INTO `trx_kepuasan_pengguna` (`id`, `jenis_kemampuan`, `persen_sangat_baik`, `persen_baik`, `persen_cukup`, `persen_kurang`, `rencana_tindak_lanjut`, `prodi_id`, `created_at`, `updated_at`) VALUES ('7', 'Pengembangan diri', '0.00', '0.00', '0.00', '0.00', NULL, '1', '2026-05-08 15:15:56', '2026-05-08 15:15:56');


CREATE TABLE `trx_kepuasan_pengguna_ref` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun_lulus` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jml_lulusan` int DEFAULT '0',
  `jml_tanggapan` int DEFAULT '0',
  `prodi_id` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_kerjasama` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_kerjasama` enum('pendidikan','penelitian','pkm') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lembaga_mitra` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` enum('internasional','nasional','lokal') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_kegiatan` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manfaat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `waktu_durasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_kerjasama_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_kerjasama` (`id`, `jenis_kerjasama`, `lembaga_mitra`, `tingkat`, `judul_kegiatan`, `manfaat`, `waktu_durasi`, `bukti`, `prodi_id`, `created_at`, `updated_at`) VALUES ('1', 'pendidikan', 'University 1', 'internasional', 'Joint Research 1', NULL, NULL, NULL, '1', '2026-05-08 09:18:41', '2026-05-08 09:18:41');
INSERT INTO `trx_kerjasama` (`id`, `jenis_kerjasama`, `lembaga_mitra`, `tingkat`, `judul_kegiatan`, `manfaat`, `waktu_durasi`, `bukti`, `prodi_id`, `created_at`, `updated_at`) VALUES ('2', 'pendidikan', 'University 2', 'internasional', 'Joint Research 2', NULL, NULL, NULL, '1', '2026-05-08 09:18:41', '2026-05-08 09:18:41');
INSERT INTO `trx_kerjasama` (`id`, `jenis_kerjasama`, `lembaga_mitra`, `tingkat`, `judul_kegiatan`, `manfaat`, `waktu_durasi`, `bukti`, `prodi_id`, `created_at`, `updated_at`) VALUES ('3', 'pendidikan', 'University 3', 'internasional', 'Joint Research 3', NULL, NULL, NULL, '1', '2026-05-08 09:18:41', '2026-05-08 09:18:41');
INSERT INTO `trx_kerjasama` (`id`, `jenis_kerjasama`, `lembaga_mitra`, `tingkat`, `judul_kegiatan`, `manfaat`, `waktu_durasi`, `bukti`, `prodi_id`, `created_at`, `updated_at`) VALUES ('4', 'pendidikan', 'University 4', 'internasional', 'Joint Research 4', NULL, NULL, NULL, '1', '2026-05-08 09:18:41', '2026-05-08 09:18:41');


CREATE TABLE `trx_kesesuaian_bidang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun_lulus` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jml_lulusan` int DEFAULT '0',
  `jml_terlacak` int DEFAULT '0',
  `kesesuaian_rendah` int DEFAULT '0',
  `kesesuaian_sedang` int DEFAULT '0',
  `kesesuaian_tinggi` int DEFAULT '0',
  `prodi_id` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_kesesuaian_bidang` (`id`, `tahun_lulus`, `jml_lulusan`, `jml_terlacak`, `kesesuaian_rendah`, `kesesuaian_sedang`, `kesesuaian_tinggi`, `prodi_id`) VALUES ('1', '2022', '50', '45', '2', '8', '35', '1');
INSERT INTO `trx_kesesuaian_bidang` (`id`, `tahun_lulus`, `jml_lulusan`, `jml_terlacak`, `kesesuaian_rendah`, `kesesuaian_sedang`, `kesesuaian_tinggi`, `prodi_id`) VALUES ('2', '2023', '55', '50', '2', '8', '40', '1');
INSERT INTO `trx_kesesuaian_bidang` (`id`, `tahun_lulus`, `jml_lulusan`, `jml_terlacak`, `kesesuaian_rendah`, `kesesuaian_sedang`, `kesesuaian_tinggi`, `prodi_id`) VALUES ('3', '2024', '60', '55', '2', '8', '45', '1');


CREATE TABLE `trx_kurikulum` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mk_id` int NOT NULL,
  `capaian_pembelajaran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `metode_pembelajaran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `bentuk_integrasi_penelitian` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `mk_id` (`mk_id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_kurikulum_ibfk_1` FOREIGN KEY (`mk_id`) REFERENCES `master_mata_kuliah` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trx_kurikulum_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_luaran_mhs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int DEFAULT NULL,
  `jenis` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year DEFAULT NULL,
  `keterangan` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `mahasiswa_id` (`mahasiswa_id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_luaran_mhs_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `master_mahasiswa` (`id`) ON DELETE SET NULL,
  CONSTRAINT `trx_luaran_mhs_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_luaran_mhs` (`id`, `mahasiswa_id`, `jenis`, `judul`, `tahun`, `keterangan`, `prodi_id`, `created_at`, `updated_at`) VALUES ('1', '1', 'Hak Cipta', '4124', '2026', '21', '1', '2026-04-28 00:04:32', '2026-04-28 00:04:32');


CREATE TABLE `trx_mahasiswa_asing` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun_akademik` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_fulltime` int DEFAULT '0',
  `jml_parttime` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_mahasiswa_asing_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_mahasiswa_asing` (`id`, `tahun_akademik`, `jml_fulltime`, `jml_parttime`, `prodi_id`, `created_at`, `updated_at`) VALUES ('1', '2025', '5', '2', '1', '2026-05-08 10:42:22', '2026-05-08 10:42:22');


CREATE TABLE `trx_masa_studi` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jml_lulus_ts6` int DEFAULT '0',
  `jml_lulus_ts5` int DEFAULT '0',
  `jml_lulus_ts4` int DEFAULT '0',
  `jml_lulus_ts3` int DEFAULT '0',
  `jml_lulus_ts2` int DEFAULT '0',
  `jml_lulus_ts1` int DEFAULT '0',
  `jml_lulus_ts0` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_masa_studi_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_masa_studi` (`id`, `tahun_masuk`, `jml_mhs_diterima`, `jml_lulus_akhir_ts`, `jml_lulus_akhir_ts1`, `jml_lulus_akhir_ts2`, `jml_lulus_akhir_ts3`, `jml_lulus_akhir_ts4`, `jml_lulus_akhir_ts5`, `jml_lulus_akhir_ts6`, `rata_masa_studi`, `prodi_id`, `created_at`, `updated_at`, `jml_lulus_ts6`, `jml_lulus_ts5`, `jml_lulus_ts4`, `jml_lulus_ts3`, `jml_lulus_ts2`, `jml_lulus_ts1`, `jml_lulus_ts0`) VALUES ('2', '2021', '50', '0', '0', '0', '0', '0', '0', '0', '6.00', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `trx_masa_studi` (`id`, `tahun_masuk`, `jml_mhs_diterima`, `jml_lulus_akhir_ts`, `jml_lulus_akhir_ts1`, `jml_lulus_akhir_ts2`, `jml_lulus_akhir_ts3`, `jml_lulus_akhir_ts4`, `jml_lulus_akhir_ts5`, `jml_lulus_akhir_ts6`, `rata_masa_studi`, `prodi_id`, `created_at`, `updated_at`, `jml_lulus_ts6`, `jml_lulus_ts5`, `jml_lulus_ts4`, `jml_lulus_ts3`, `jml_lulus_ts2`, `jml_lulus_ts1`, `jml_lulus_ts0`) VALUES ('3', '2020', '55', '0', '0', '0', '0', '0', '0', '0', '6.10', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `trx_masa_studi` (`id`, `tahun_masuk`, `jml_mhs_diterima`, `jml_lulus_akhir_ts`, `jml_lulus_akhir_ts1`, `jml_lulus_akhir_ts2`, `jml_lulus_akhir_ts3`, `jml_lulus_akhir_ts4`, `jml_lulus_akhir_ts5`, `jml_lulus_akhir_ts6`, `rata_masa_studi`, `prodi_id`, `created_at`, `updated_at`, `jml_lulus_ts6`, `jml_lulus_ts5`, `jml_lulus_ts4`, `jml_lulus_ts3`, `jml_lulus_ts2`, `jml_lulus_ts1`, `jml_lulus_ts0`) VALUES ('4', '2019', '60', '0', '0', '0', '0', '0', '0', '0', '6.00', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', '0', '0', '0', '0', '0', '0', '0');


CREATE TABLE `trx_penelitian_dtps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sumber` enum('pt_mandiri','dalam_negeri','luar_negeri') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_akademik` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_judul` int DEFAULT '0',
  `dana` decimal(15,2) DEFAULT '0.00',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `melibatkan_mahasiswa` tinyint(1) DEFAULT '0',
  `tema_roadmap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mahasiswa_id` int DEFAULT NULL,
  `judul_kegiatan` text COLLATE utf8mb4_unicode_ci,
  `tahun` int DEFAULT NULL,
  `dosen_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_penelitian_dtps_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_penelitian_dtps` (`id`, `sumber`, `tahun_akademik`, `jumlah_judul`, `dana`, `prodi_id`, `created_at`, `updated_at`, `melibatkan_mahasiswa`, `tema_roadmap`, `mahasiswa_id`, `judul_kegiatan`, `tahun`, `dosen_id`) VALUES ('1', 'pt_mandiri', 'ts', '1', '111.00', '1', '2026-04-28 00:03:27', '2026-04-28 00:03:27', '0', NULL, NULL, NULL, NULL, NULL);


CREATE TABLE `trx_penelitian_mhs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mahasiswa_id` int DEFAULT NULL,
  `dosen_id` int DEFAULT NULL,
  `tahun` year DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `mahasiswa_id` (`mahasiswa_id`),
  KEY `dosen_id` (`dosen_id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_penelitian_mhs_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `master_mahasiswa` (`id`) ON DELETE SET NULL,
  CONSTRAINT `trx_penelitian_mhs_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE SET NULL,
  CONSTRAINT `trx_penelitian_mhs_ibfk_3` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_penggunaan_dana` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prodi_id` int DEFAULT NULL,
  `jenis_penggunaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal_ts2` bigint DEFAULT '0',
  `nominal_ts1` bigint DEFAULT '0',
  `nominal_ts` bigint DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nominal_upps_ts2` bigint DEFAULT '0',
  `nominal_upps_ts1` bigint DEFAULT '0',
  `nominal_upps_ts` bigint DEFAULT '0',
  `nominal_ps_ts2` bigint DEFAULT '0',
  `nominal_ps_ts1` bigint DEFAULT '0',
  `nominal_ps_ts` bigint DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_penggunaan_dana` (`id`, `prodi_id`, `jenis_penggunaan`, `nominal_ts2`, `nominal_ts1`, `nominal_ts`, `updated_at`, `nominal_upps_ts2`, `nominal_upps_ts1`, `nominal_upps_ts`, `nominal_ps_ts2`, `nominal_ps_ts1`, `nominal_ps_ts`) VALUES ('1', '1', 'a. Biaya Dosen (Gaji, Honor)', '0', '0', '0', '2026-05-08 14:11:05', '0', '0', '0', '0', '0', '0');
INSERT INTO `trx_penggunaan_dana` (`id`, `prodi_id`, `jenis_penggunaan`, `nominal_ts2`, `nominal_ts1`, `nominal_ts`, `updated_at`, `nominal_upps_ts2`, `nominal_upps_ts1`, `nominal_upps_ts`, `nominal_ps_ts2`, `nominal_ps_ts1`, `nominal_ps_ts`) VALUES ('2', '1', 'b. Biaya Tenaga Kependidikan', '0', '0', '0', '2026-05-08 14:11:05', '0', '0', '0', '0', '0', '0');
INSERT INTO `trx_penggunaan_dana` (`id`, `prodi_id`, `jenis_penggunaan`, `nominal_ts2`, `nominal_ts1`, `nominal_ts`, `updated_at`, `nominal_upps_ts2`, `nominal_upps_ts1`, `nominal_upps_ts`, `nominal_ps_ts2`, `nominal_ps_ts1`, `nominal_ps_ts`) VALUES ('3', '1', 'c. Biaya Operasional Pembelajaran', '0', '0', '0', '2026-05-08 14:11:05', '0', '0', '0', '0', '0', '0');
INSERT INTO `trx_penggunaan_dana` (`id`, `prodi_id`, `jenis_penggunaan`, `nominal_ts2`, `nominal_ts1`, `nominal_ts`, `updated_at`, `nominal_upps_ts2`, `nominal_upps_ts1`, `nominal_upps_ts`, `nominal_ps_ts2`, `nominal_ps_ts1`, `nominal_ps_ts`) VALUES ('4', '1', 'd. Biaya Operasional Tidak Langsung', '0', '0', '0', '2026-05-08 14:11:05', '0', '0', '0', '0', '0', '0');
INSERT INTO `trx_penggunaan_dana` (`id`, `prodi_id`, `jenis_penggunaan`, `nominal_ts2`, `nominal_ts1`, `nominal_ts`, `updated_at`, `nominal_upps_ts2`, `nominal_upps_ts1`, `nominal_upps_ts`, `nominal_ps_ts2`, `nominal_ps_ts1`, `nominal_ps_ts`) VALUES ('5', '1', '2. Biaya Operasional Kemahasiswaan', '0', '0', '0', '2026-05-08 14:11:05', '0', '0', '0', '0', '0', '0');
INSERT INTO `trx_penggunaan_dana` (`id`, `prodi_id`, `jenis_penggunaan`, `nominal_ts2`, `nominal_ts1`, `nominal_ts`, `updated_at`, `nominal_upps_ts2`, `nominal_upps_ts1`, `nominal_upps_ts`, `nominal_ps_ts2`, `nominal_ps_ts1`, `nominal_ps_ts`) VALUES ('6', '1', '3. Biaya Penelitian', '0', '0', '0', '2026-05-08 14:11:05', '0', '0', '0', '0', '0', '0');
INSERT INTO `trx_penggunaan_dana` (`id`, `prodi_id`, `jenis_penggunaan`, `nominal_ts2`, `nominal_ts1`, `nominal_ts`, `updated_at`, `nominal_upps_ts2`, `nominal_upps_ts1`, `nominal_upps_ts`, `nominal_ps_ts2`, `nominal_ps_ts1`, `nominal_ps_ts`) VALUES ('7', '1', '4. Biaya PkM', '0', '0', '0', '2026-05-08 14:11:05', '0', '0', '0', '0', '0', '0');
INSERT INTO `trx_penggunaan_dana` (`id`, `prodi_id`, `jenis_penggunaan`, `nominal_ts2`, `nominal_ts1`, `nominal_ts`, `updated_at`, `nominal_upps_ts2`, `nominal_upps_ts1`, `nominal_upps_ts`, `nominal_ps_ts2`, `nominal_ps_ts1`, `nominal_ps_ts`) VALUES ('8', '1', '5. Biaya Investasi SDM', '0', '0', '0', '2026-05-08 14:11:05', '1', '0', '0', '0', '0', '0');
INSERT INTO `trx_penggunaan_dana` (`id`, `prodi_id`, `jenis_penggunaan`, `nominal_ts2`, `nominal_ts1`, `nominal_ts`, `updated_at`, `nominal_upps_ts2`, `nominal_upps_ts1`, `nominal_upps_ts`, `nominal_ps_ts2`, `nominal_ps_ts1`, `nominal_ps_ts`) VALUES ('9', '1', '6. Biaya Investasi Sarana', '0', '0', '0', '2026-05-08 14:11:05', '1', '0', '0', '0', '0', '0');
INSERT INTO `trx_penggunaan_dana` (`id`, `prodi_id`, `jenis_penggunaan`, `nominal_ts2`, `nominal_ts1`, `nominal_ts`, `updated_at`, `nominal_upps_ts2`, `nominal_upps_ts1`, `nominal_upps_ts`, `nominal_ps_ts2`, `nominal_ps_ts1`, `nominal_ps_ts`) VALUES ('10', '1', '6. Biaya Investasi Prasarana', '0', '0', '0', '2026-05-08 14:11:05', '1', '0', '0', '0', '0', '0');


CREATE TABLE `trx_pkm_dtps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sumber` enum('pt_mandiri','dalam_negeri','luar_negeri') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_akademik` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_judul` int DEFAULT '0',
  `dana` decimal(15,2) DEFAULT '0.00',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `melibatkan_mahasiswa` tinyint(1) DEFAULT '0',
  `tema_roadmap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mahasiswa_id` int DEFAULT NULL,
  `judul_kegiatan` text COLLATE utf8mb4_unicode_ci,
  `tahun` int DEFAULT NULL,
  `dosen_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_pkm_dtps_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_pkm_dtps` (`id`, `sumber`, `tahun_akademik`, `jumlah_judul`, `dana`, `prodi_id`, `created_at`, `updated_at`, `melibatkan_mahasiswa`, `tema_roadmap`, `mahasiswa_id`, `judul_kegiatan`, `tahun`, `dosen_id`) VALUES ('1', 'dalam_negeri', 'ts', '11', '1111.00', '1', '2026-04-28 00:04:12', '2026-04-28 00:04:12', '0', NULL, NULL, NULL, NULL, NULL);


CREATE TABLE `trx_pkm_mhs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mahasiswa_id` int DEFAULT NULL,
  `dosen_id` int DEFAULT NULL,
  `tahun` year DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `mahasiswa_id` (`mahasiswa_id`),
  KEY `dosen_id` (`dosen_id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_pkm_mhs_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `master_mahasiswa` (`id`) ON DELETE SET NULL,
  CONSTRAINT `trx_pkm_mhs_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE SET NULL,
  CONSTRAINT `trx_pkm_mhs_ibfk_3` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_prestasi_mhs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mahasiswa_id` int DEFAULT NULL,
  `tingkat` enum('internasional','nasional','wilayah') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prestasi` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` year DEFAULT NULL,
  `jenis_prestasi` enum('akademik','non_akademik') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'akademik',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `mahasiswa_id` (`mahasiswa_id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_prestasi_mhs_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `master_mahasiswa` (`id`) ON DELETE SET NULL,
  CONSTRAINT `trx_prestasi_mhs_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_produk_jasa_dtps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dosen_id` int DEFAULT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` year DEFAULT NULL,
  `prodi_id` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_publikasi_dtps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_akademik` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_judul` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_publikasi_dtps_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_publikasi_mhs_summary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_publikasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jml_ts2` int DEFAULT '0',
  `jml_ts1` int DEFAULT '0',
  `jml_ts0` int DEFAULT '0',
  `prodi_id` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_publikasi_mhs_summary` (`id`, `jenis_publikasi`, `jml_ts2`, `jml_ts1`, `jml_ts0`, `prodi_id`) VALUES ('1', 'Jurnal penelitian tidak terakreditasi', '0', '0', '0', '1');
INSERT INTO `trx_publikasi_mhs_summary` (`id`, `jenis_publikasi`, `jml_ts2`, `jml_ts1`, `jml_ts0`, `prodi_id`) VALUES ('2', 'Jurnal penelitian nasional terakreditasi', '0', '0', '0', '1');
INSERT INTO `trx_publikasi_mhs_summary` (`id`, `jenis_publikasi`, `jml_ts2`, `jml_ts1`, `jml_ts0`, `prodi_id`) VALUES ('3', 'Jurnal penelitian internasional', '0', '0', '0', '1');
INSERT INTO `trx_publikasi_mhs_summary` (`id`, `jenis_publikasi`, `jml_ts2`, `jml_ts1`, `jml_ts0`, `prodi_id`) VALUES ('4', 'Jurnal penelitian internasional bereputasi', '0', '0', '0', '1');
INSERT INTO `trx_publikasi_mhs_summary` (`id`, `jenis_publikasi`, `jml_ts2`, `jml_ts1`, `jml_ts0`, `prodi_id`) VALUES ('5', 'Seminar wilayah/lokal/perguruan tinggi', '0', '0', '0', '1');
INSERT INTO `trx_publikasi_mhs_summary` (`id`, `jenis_publikasi`, `jml_ts2`, `jml_ts1`, `jml_ts0`, `prodi_id`) VALUES ('6', 'Seminar nasional', '0', '0', '0', '1');
INSERT INTO `trx_publikasi_mhs_summary` (`id`, `jenis_publikasi`, `jml_ts2`, `jml_ts1`, `jml_ts0`, `prodi_id`) VALUES ('7', 'Seminar internasional', '0', '0', '0', '1');
INSERT INTO `trx_publikasi_mhs_summary` (`id`, `jenis_publikasi`, `jml_ts2`, `jml_ts1`, `jml_ts0`, `prodi_id`) VALUES ('8', 'Tulisan di media massa wilayah', '0', '0', '0', '1');
INSERT INTO `trx_publikasi_mhs_summary` (`id`, `jenis_publikasi`, `jml_ts2`, `jml_ts1`, `jml_ts0`, `prodi_id`) VALUES ('9', 'Tulisan di media massa nasional', '0', '0', '0', '1');
INSERT INTO `trx_publikasi_mhs_summary` (`id`, `jenis_publikasi`, `jml_ts2`, `jml_ts1`, `jml_ts0`, `prodi_id`) VALUES ('10', 'Tulisan di media massa internasional', '0', '0', '0', '1');
INSERT INTO `trx_publikasi_mhs_summary` (`id`, `jenis_publikasi`, `jml_ts2`, `jml_ts1`, `jml_ts0`, `prodi_id`) VALUES ('11', 'Pagelaran/pameran/presentasi dalam forum di tingkat wilayah', '0', '0', '0', '1');
INSERT INTO `trx_publikasi_mhs_summary` (`id`, `jenis_publikasi`, `jml_ts2`, `jml_ts1`, `jml_ts0`, `prodi_id`) VALUES ('12', 'Pagelaran/pameran/presentasi dalam forum di tingkat nasional', '0', '0', '0', '1');
INSERT INTO `trx_publikasi_mhs_summary` (`id`, `jenis_publikasi`, `jml_ts2`, `jml_ts1`, `jml_ts0`, `prodi_id`) VALUES ('13', 'Pagelaran/pameran/presentasi dalam forum di tingkat internasional', '0', '0', '0', '1');


CREATE TABLE `trx_rekognisi_dosen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dosen_id` int NOT NULL,
  `bidang_keahlian` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekognisi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `bukti` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `dosen_id` (`dosen_id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_rekognisi_dosen_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trx_rekognisi_dosen_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_seleksi_mahasiswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun_akademik` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `daya_tampung` int DEFAULT '0',
  `pendaftar` int DEFAULT '0',
  `lulus_seleksi` int DEFAULT '0',
  `maba_reguler` int DEFAULT '0',
  `maba_transfer` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mhs_aktif_reguler` int DEFAULT '0',
  `mhs_aktif_transfer` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_seleksi_mahasiswa_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_seleksi_mahasiswa` (`id`, `tahun_akademik`, `daya_tampung`, `pendaftar`, `lulus_seleksi`, `maba_reguler`, `maba_transfer`, `prodi_id`, `created_at`, `updated_at`, `mhs_aktif_reguler`, `mhs_aktif_transfer`) VALUES ('2', '2024', '100', '550', '110', '100', '0', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', '0', '0');


CREATE TABLE `trx_sitasi_dtps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dosen_id` int NOT NULL,
  `judul_artikel` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurnal_vol_tahun_hal` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_sitasi` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `dosen_id` (`dosen_id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_sitasi_dtps_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trx_sitasi_dtps_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_tempat_kerja` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun_lulus` year DEFAULT NULL,
  `jml_lokal` int DEFAULT '0',
  `jml_nasional` int DEFAULT '0',
  `jml_multinasional` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_tempat_kerja_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_tempat_kerja_summary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun_lulus` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jml_lulusan` int DEFAULT '0',
  `jml_terlacak` int DEFAULT '0',
  `tk_lokal` int DEFAULT '0',
  `tk_nasional` int DEFAULT '0',
  `tk_internasional` int DEFAULT '0',
  `prodi_id` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `trx_waktu_tunggu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun_lulus` year DEFAULT NULL,
  `jml_lulusan` int DEFAULT '0',
  `jml_terlacak` int DEFAULT '0',
  `wt_kurang_3bln` int DEFAULT '0',
  `wt_3_sd_6bln` int DEFAULT '0',
  `wt_lebih_6bln` int DEFAULT '0',
  `prodi_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jml_dipesan` int DEFAULT '0',
  `wt_low` int DEFAULT '0',
  `wt_mid` int DEFAULT '0',
  `wt_high` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `prodi_id` (`prodi_id`),
  CONSTRAINT `trx_waktu_tunggu_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trx_waktu_tunggu` (`id`, `tahun_lulus`, `jml_lulusan`, `jml_terlacak`, `wt_kurang_3bln`, `wt_3_sd_6bln`, `wt_lebih_6bln`, `prodi_id`, `created_at`, `updated_at`, `jml_dipesan`, `wt_low`, `wt_mid`, `wt_high`) VALUES ('2', '2022', '50', '45', '40', '4', '1', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', '0', '0', '0', '0');
INSERT INTO `trx_waktu_tunggu` (`id`, `tahun_lulus`, `jml_lulusan`, `jml_terlacak`, `wt_kurang_3bln`, `wt_3_sd_6bln`, `wt_lebih_6bln`, `prodi_id`, `created_at`, `updated_at`, `jml_dipesan`, `wt_low`, `wt_mid`, `wt_high`) VALUES ('3', '2023', '55', '50', '45', '4', '1', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', '0', '0', '0', '0');
INSERT INTO `trx_waktu_tunggu` (`id`, `tahun_lulus`, `jml_lulusan`, `jml_terlacak`, `wt_kurang_3bln`, `wt_3_sd_6bln`, `wt_lebih_6bln`, `prodi_id`, `created_at`, `updated_at`, `jml_dipesan`, `wt_low`, `wt_mid`, `wt_high`) VALUES ('4', '2024', '60', '55', '50', '4', '1', '1', '2026-05-08 16:28:43', '2026-05-08 16:28:43', '0', '0', '0', '0');
