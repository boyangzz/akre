-- AKRE Database Schema — aps
-- Sistem Manajemen Akreditasi BAN-PT (Tahap 2)
SET FOREIGN_KEY_CHECKS = 0;
SET NAMES utf8mb4;

-- ============ ADMIN & CONFIG ============

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `nama_lengkap` VARCHAR(100) NOT NULL,
  `role` ENUM('admin','operator') NOT NULL DEFAULT 'admin',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `setup_tabel_borang` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kode_tabel` VARCHAR(10) NOT NULL UNIQUE,
  `nama_tabel` VARCHAR(200) NOT NULL,
  `kategori` ENUM('identitas','master','kerjasama','mahasiswa','dosen','kurikulum','luaran','keuangan') NOT NULL,
  `jenjang_filter` JSON NOT NULL,
  `is_wajib` TINYINT(1) DEFAULT 1,
  `urutan` INT DEFAULT 0,
  `kolom_config` JSON DEFAULT NULL,
  `deskripsi` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============ IDENTITAS & MASTER ============

CREATE TABLE IF NOT EXISTS `identitas_pengusul` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_pt` VARCHAR(200),
  `nama_fakultas` VARCHAR(200),
  `nama_prodi` VARCHAR(200),
  `jenjang` ENUM('D3','STr','S1','S2','S2T','S3','S3T') DEFAULT 'S1',
  `alamat` VARCHAR(500),
  `telepon` VARCHAR(20),
  `email` VARCHAR(100),
  `website` VARCHAR(200),
  `no_sk_banpt` VARCHAR(50),
  `peringkat_akreditasi` VARCHAR(20),
  `tanggal_kadaluarsa` DATE,
  `kaprodi_nama` VARCHAR(100),
  `kaprodi_nidn` VARCHAR(20),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `master_dosen` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nidn` VARCHAR(20) NOT NULL UNIQUE,
  `nama` VARCHAR(150) NOT NULL,
  `pendidikan_pasca` ENUM('S2','S3'),
  `bidang_keahlian` VARCHAR(200),
  `kesesuaian_kompetensi` TINYINT(1) DEFAULT 0,
  `jabatan_akademik` ENUM('Tenaga Pengajar','Asisten Ahli','Lektor','Lektor Kepala','Guru Besar') DEFAULT 'Tenaga Pengajar',
  `sertifikat_pendidik` TINYINT(1) DEFAULT 0,
  `sertifikat_kompetensi` VARCHAR(200),
  `prodi_id` INT,
  `status_ikatan` ENUM('tetap','tidak_tetap','industri') DEFAULT 'tetap',
  `status_aktif` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `master_mahasiswa` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nim` VARCHAR(20) NOT NULL UNIQUE,
  `nama` VARCHAR(150) NOT NULL,
  `angkatan` YEAR,
  `prodi_id` INT,
  `status` ENUM('aktif','lulus','cuti','do','transfer') DEFAULT 'aktif',
  `jenis` ENUM('reguler','transfer') DEFAULT 'reguler',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `master_mata_kuliah` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kode_mk` VARCHAR(20) NOT NULL UNIQUE,
  `nama_mk` VARCHAR(200) NOT NULL,
  `sks_teori` INT DEFAULT 0,
  `sks_praktek` INT DEFAULT 0,
  `semester` INT,
  `jenis_mk` ENUM('wajib','pilihan') DEFAULT 'wajib',
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============ KERJASAMA (Tabel 1) ============

CREATE TABLE IF NOT EXISTS `trx_kerjasama` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `jenis_kerjasama` ENUM('pendidikan','penelitian','pkm') NOT NULL,
  `lembaga_mitra` VARCHAR(200) NOT NULL,
  `tingkat` ENUM('internasional','nasional','lokal') NOT NULL,
  `judul_kegiatan` VARCHAR(300),
  `manfaat` TEXT,
  `waktu_durasi` VARCHAR(100),
  `bukti` VARCHAR(500),
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============ KEMAHASISWAAN (Tabel 2) ============

CREATE TABLE IF NOT EXISTS `trx_seleksi_mahasiswa` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tahun_akademik` VARCHAR(10) NOT NULL,
  `daya_tampung` INT DEFAULT 0,
  `pendaftar` INT DEFAULT 0,
  `lulus_seleksi` INT DEFAULT 0,
  `maba_reguler` INT DEFAULT 0,
  `maba_transfer` INT DEFAULT 0,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_mahasiswa_asing` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tahun_akademik` VARCHAR(10) NOT NULL,
  `jml_fulltime` INT DEFAULT 0,
  `jml_parttime` INT DEFAULT 0,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============ DOSEN & SDM (Tabel 3) ============

CREATE TABLE IF NOT EXISTS `trx_dosen_mk` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `dosen_id` INT NOT NULL,
  `mk_id` INT NOT NULL,
  `tahun_akademik` VARCHAR(10),
  `semester` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`mk_id`) REFERENCES `master_mata_kuliah`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_dosen_bimbingan` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `dosen_id` INT NOT NULL,
  `tahun_akademik` VARCHAR(10),
  `jml_bimbingan_ps` INT DEFAULT 0,
  `jml_bimbingan_ps_lain` INT DEFAULT 0,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_ewmp` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `dosen_id` INT NOT NULL,
  `tahun_akademik` VARCHAR(10),
  `sks_pendidikan_ps` DECIMAL(10,2) DEFAULT 0,
  `sks_pendidikan_luar` DECIMAL(10,2) DEFAULT 0,
  `sks_penelitian` DECIMAL(10,2) DEFAULT 0,
  `sks_pkm` DECIMAL(10,2) DEFAULT 0,
  `sks_tugas_tambahan` DECIMAL(10,2) DEFAULT 0,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_rekognisi_dosen` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `dosen_id` INT NOT NULL,
  `bidang_keahlian` VARCHAR(200),
  `rekognisi` TEXT,
  `bukti` VARCHAR(500),
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_penelitian_dtps` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `sumber` ENUM('pt_mandiri','dalam_negeri','luar_negeri') NOT NULL,
  `tahun_akademik` VARCHAR(10),
  `jumlah_judul` INT DEFAULT 0,
  `dana` DECIMAL(15,2) DEFAULT 0,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_pkm_dtps` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `sumber` ENUM('pt_mandiri','dalam_negeri','luar_negeri') NOT NULL,
  `tahun_akademik` VARCHAR(10),
  `jumlah_judul` INT DEFAULT 0,
  `dana` DECIMAL(15,2) DEFAULT 0,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_publikasi_dtps` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `jenis` VARCHAR(50) NOT NULL,
  `tahun_akademik` VARCHAR(10),
  `jumlah_judul` INT DEFAULT 0,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_hki_buku_dtps` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `dosen_id` INT NOT NULL,
  `judul` VARCHAR(300) NOT NULL,
  `jenis` VARCHAR(50) NOT NULL,
  `tahun` YEAR,
  `keterangan` VARCHAR(300),
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_sitasi_dtps` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `dosen_id` INT NOT NULL,
  `judul_artikel` VARCHAR(300),
  `jurnal_vol_tahun_hal` VARCHAR(300),
  `jumlah_sitasi` INT DEFAULT 0,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============ KURIKULUM & PKM (Tabel 5-7) ============

CREATE TABLE IF NOT EXISTS `trx_kurikulum` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `mk_id` INT NOT NULL,
  `capaian_pembelajaran` TEXT,
  `metode_pembelajaran` TEXT,
  `bentuk_integrasi_penelitian` TEXT,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`mk_id`) REFERENCES `master_mata_kuliah`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_penelitian_mhs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `judul` VARCHAR(300) NOT NULL,
  `mahasiswa_id` INT,
  `dosen_id` INT,
  `tahun` YEAR,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`mahasiswa_id`) REFERENCES `master_mahasiswa`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_pkm_mhs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `judul` VARCHAR(300) NOT NULL,
  `mahasiswa_id` INT,
  `dosen_id` INT,
  `tahun` YEAR,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`mahasiswa_id`) REFERENCES `master_mahasiswa`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`dosen_id`) REFERENCES `master_dosen`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============ LUARAN & CAPAIAN (Tabel 8) ============

CREATE TABLE IF NOT EXISTS `trx_ipk_lulusan` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tahun_lulus` YEAR,
  `jml_lulusan` INT DEFAULT 0,
  `ipk_min` DECIMAL(4,2),
  `ipk_max` DECIMAL(4,2),
  `ipk_rata` DECIMAL(4,2),
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_prestasi_mhs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_kegiatan` VARCHAR(300) NOT NULL,
  `mahasiswa_id` INT,
  `tingkat` ENUM('internasional','nasional','wilayah') NOT NULL,
  `prestasi` VARCHAR(200),
  `tahun` YEAR,
  `jenis_prestasi` ENUM('akademik','non_akademik') DEFAULT 'akademik',
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`mahasiswa_id`) REFERENCES `master_mahasiswa`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_masa_studi` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tahun_masuk` YEAR,
  `jml_mhs_diterima` INT DEFAULT 0,
  `jml_lulus_akhir_ts` INT DEFAULT 0,
  `jml_lulus_akhir_ts1` INT DEFAULT 0,
  `jml_lulus_akhir_ts2` INT DEFAULT 0,
  `jml_lulus_akhir_ts3` INT DEFAULT 0,
  `jml_lulus_akhir_ts4` INT DEFAULT 0,
  `jml_lulus_akhir_ts5` INT DEFAULT 0,
  `jml_lulus_akhir_ts6` INT DEFAULT 0,
  `rata_masa_studi` DECIMAL(5,2),
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_waktu_tunggu` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tahun_lulus` YEAR,
  `jml_lulusan` INT DEFAULT 0,
  `jml_terlacak` INT DEFAULT 0,
  `wt_kurang_3bln` INT DEFAULT 0,
  `wt_3_sd_6bln` INT DEFAULT 0,
  `wt_lebih_6bln` INT DEFAULT 0,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_tempat_kerja` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tahun_lulus` YEAR,
  `jml_lokal` INT DEFAULT 0,
  `jml_nasional` INT DEFAULT 0,
  `jml_multinasional` INT DEFAULT 0,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_kepuasan_pengguna` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `jenis_kemampuan` VARCHAR(50) NOT NULL,
  `persen_sangat_baik` DECIMAL(5,2) DEFAULT 0,
  `persen_baik` DECIMAL(5,2) DEFAULT 0,
  `persen_cukup` DECIMAL(5,2) DEFAULT 0,
  `persen_kurang` DECIMAL(5,2) DEFAULT 0,
  `rencana_tindak_lanjut` TEXT,
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `trx_luaran_mhs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `mahasiswa_id` INT,
  `jenis` VARCHAR(50) NOT NULL,
  `judul` VARCHAR(300) NOT NULL,
  `tahun` YEAR,
  `keterangan` VARCHAR(300),
  `prodi_id` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`mahasiswa_id`) REFERENCES `master_mahasiswa`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`prodi_id`) REFERENCES `identitas_pengusul`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============ SEEDERS ============

-- Admin default: admin / admin
INSERT INTO `admin_users` (`username`, `password`, `nama_lengkap`, `role`) VALUES
('admin', '$2y$10$0H7HWHszUSO6H.FUqmTaW.NYNQmqnCg7pziIbFeXE4FOFRhGaZ3Ye', 'Administrator', 'admin');

-- Identitas default
INSERT INTO `identitas_pengusul` (`nama_pt`, `nama_fakultas`, `nama_prodi`, `jenjang`) VALUES
('Universitas XYZ', 'Fakultas Teknik', 'Teknik Informatika', 'S1');

-- Setup Tabel Borang (Rule Engine - Layer 1)
INSERT INTO `setup_tabel_borang` (`kode_tabel`, `nama_tabel`, `kategori`, `jenjang_filter`, `urutan`) VALUES
('1-1', 'Kerjasama Pendidikan', 'kerjasama', '["D3","S1","STr","S2","S2T","S3","S3T"]', 1),
('1-2', 'Kerjasama Penelitian', 'kerjasama', '["D3","S1","STr","S2","S2T","S3","S3T"]', 2),
('1-3', 'Kerjasama PkM', 'kerjasama', '["D3","S1","STr","S2","S2T","S3","S3T"]', 3),
('2a', 'Seleksi Mahasiswa Baru', 'mahasiswa', '["S1","S2","S3"]', 4),
('2b', 'Mahasiswa Asing', 'mahasiswa', '["D3","S1","STr","S2","S2T","S3"]', 5),
('3a1', 'Dosen Tetap PT', 'dosen', '["D3","S1","STr","S2","S2T","S3","S3T"]', 6),
('3a2', 'Pembimbing Utama TA', 'dosen', '["D3","S1","S2","S3"]', 7),
('3a3', 'EWMP Dosen Tetap', 'dosen', '["S1"]', 8),
('3a4', 'Dosen Tidak Tetap', 'dosen', '["S1","S2"]', 9),
('3a5', 'Dosen Industri/Praktisi', 'dosen', '["D3","STr","S2T"]', 10),
('3b1', 'Rekognisi Dosen', 'dosen', '["S1","S2","S3"]', 11),
('3b2', 'Penelitian DTPS', 'dosen', '["S1","S2T"]', 12),
('3b3', 'PkM DTPS', 'dosen', '["D3","S1","STr","S2","S2T","S3","S3T"]', 13),
('3b4', 'Publikasi Ilmiah DTPS', 'dosen', '["D3","S1","STr","S2","S2T","S3","S3T"]', 14),
('3b5', 'HKI & Buku DTPS', 'dosen', '["D3","S1","STr","S2","S2T","S3","S3T"]', 15),
('3b6', 'Sitasi DTPS', 'dosen', '["D3","S1","STr","S2","S2T","S3","S3T"]', 16),
('3b7', 'Luaran Lain DTPS', 'dosen', '["D3","S1","STr","S2","S2T","S3","S3T"]', 17),
('4', 'Keuangan & Sarpras', 'keuangan', '["D3","S1","STr","S2","S2T","S3","S3T"]', 18),
('5a', 'Kurikulum', 'kurikulum', '["D3","S1","STr","S2","S2T","S3","S3T"]', 19),
('5b', 'Integrasi Litabmas', 'kurikulum', '["D3","S1","STr","S2","S2T","S3","S3T"]', 20),
('5c', 'Kepuasan Mhs Pembelajaran', 'kurikulum', '["D3","S1","STr","S2","S2T","S3","S3T"]', 21),
('6a', 'Penelitian DTPS + Mhs', 'kurikulum', '["D3","S1","STr","S2","S2T","S3","S3T"]', 22),
('6b', 'Penelitian Rujukan Tesis', 'kurikulum', '["S1","S2","S2T","S3","S3T"]', 23),
('7', 'PkM DTPS + Mhs', 'kurikulum', '["D3","S1","STr","S2","S2T","S3","S3T"]', 24),
('8a', 'IPK Lulusan', 'luaran', '["D3","STr"]', 25),
('8b1', 'Prestasi Akademik Mhs', 'luaran', '["D3","S1","STr","S2","S2T","S3","S3T"]', 26),
('8b2', 'Prestasi Non-akademik', 'luaran', '["D3","S1","STr"]', 27),
('8c', 'Masa Studi Lulusan', 'luaran', '["D3","S1","STr","S2","S2T","S3","S3T"]', 28),
('8d1', 'Waktu Tunggu Lulusan', 'luaran', '["D3","S1","STr","S2","S2T"]', 29),
('8d2', 'Kesesuaian Bidang Kerja', 'luaran', '["D3","S1","STr","S2","S2T","S3","S3T"]', 30),
('8e1', 'Tempat Kerja Lulusan', 'luaran', '["D3","S1","STr","S2","S2T","S3","S3T"]', 31),
('8e2', 'Kepuasan Pengguna', 'luaran', '["D3","S1","STr","S2","S2T"]', 32),
('8f1', 'Publikasi Ilmiah Mhs', 'luaran', '["S1","S2","S3"]', 33),
('8f1t', 'Publikasi Mhs Terapan', 'luaran', '["D3","STr","S2T","S3T"]', 34),
('8f2', 'Sitasi Karya Mhs', 'luaran', '["D3","S1","STr","S2","S2T","S3","S3T"]', 35),
('8f3', 'Luaran Mhs Buku', 'luaran', '["D3","S1","STr","S2","S2T","S3","S3T"]', 36),
('8f4', 'Luaran Mhs HKI/Produk', 'luaran', '["D3","S1","STr","S2","S2T","S3","S3T"]', 37);

SET FOREIGN_KEY_CHECKS = 1;
