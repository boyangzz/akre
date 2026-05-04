-- Script untuk memasukkan data simulasi (Dummy) D3 yang ideal
-- Didesain agar menghasilkan skor mendekati UNGGUL

-- 1. Identitas Pengusul (Prodi D3)
INSERT INTO identitas_pengusul (id, nama_pt, nama_prodi, jenjang, peringkat_akreditasi) 
VALUES (1, 'Universitas Indonesia', 'D3 Administrasi Perkantoran', 'D3', 'Baik')
ON DUPLICATE KEY UPDATE jenjang='D3';

-- 2. Master Dosen (15 Dosen Tetap, 4 Lektor Kepala/GB untuk syarat perlu)
DELETE FROM master_dosen WHERE prodi_id = 1;
INSERT INTO master_dosen (nidn, nama, pendidikan_pasca, jabatan_akademik, status_ikatan, kesesuaian_kompetensi, prodi_id) VALUES
('0011018501', 'Dr. Budi Santoso', 'S3', 'Lektor Kepala', 'tetap', 1, 1),
('0011018502', 'Dr. Siti Aminah', 'S3', 'Lektor Kepala', 'tetap', 1, 1),
('0011018503', 'Dr. Ahmad Fauzi', 'S3', 'Lektor', 'tetap', 1, 1),
('0011018504', 'Ir. Haryono, M.T.', 'S2', 'Asisten Ahli', 'tetap', 1, 1),
('0011018505', 'Drs. Suparman, M.Si.', 'S2', 'Lektor Kepala', 'tetap', 1, 1),
('0011018506', 'Anita Wijaya, M.Kom.', 'S2', 'Asisten Ahli', 'tetap', 1, 1),
('0011018507', 'Rahmat Hidayat, M.Sc.', 'S2', 'Tenaga Pengajar', 'tetap', 1, 1),
('0011018508', 'Santi Kurnia, M.Pd.', 'S2', 'Lektor', 'tetap', 1, 1),
('0011018509', 'Dr. Hendra Wijaya', 'S3', 'Guru Besar', 'tetap', 1, 1),
('0011018510', 'Maya Indah, M.M.', 'S2', 'Lektor', 'tetap', 1, 1),
('0011018511', 'Joko Susilo, M.T.', 'S2', 'Asisten Ahli', 'tetap', 1, 1),
('0011018512', 'Linda Sari, M.Si.', 'S2', 'Lektor', 'tetap', 1, 1),
('0011018513', 'Aris Munandar, M.Kom.', 'S2', 'Asisten Ahli', 'tetap', 1, 1),
('0011018514', 'Dewi Lestari, M.Pd.', 'S2', 'Tenaga Pengajar', 'tetap', 1, 1),
('0011018515', 'Eko Prasetyo, M.T.', 'S2', 'Lektor', 'tetap', 1, 1);

-- 3. Seleksi Mahasiswa (Rasio > 5)
DELETE FROM trx_seleksi_mahasiswa WHERE prodi_id = 1;
INSERT INTO trx_seleksi_mahasiswa (tahun_akademik, daya_tampung, pendaftar, lulus_seleksi, maba_reguler, prodi_id)
VALUES ('2023/2024', 100, 600, 95, 90, 1);

-- 4. IPK Lulusan (IPK > 3.0)
DELETE FROM trx_ipk_lulusan WHERE prodi_id = 1;
INSERT INTO trx_ipk_lulusan (tahun_lulus, jml_lulusan, ipk_min, ipk_max, ipk_rata, prodi_id)
VALUES (2023, 80, 2.75, 3.95, 3.45, 1);

-- 5. Masa Studi (Rata-rata 6 semester = 3 tahun)
DELETE FROM trx_masa_studi WHERE prodi_id = 1;
INSERT INTO trx_masa_studi (tahun_masuk, jml_mhs_diterima, jml_lulus_akhir_ts, rata_rata_masa_studi, prodi_id)
VALUES (2020, 100, 85, 6.0, 1); -- 6.0 semester = 3.0 tahun

-- 6. Waktu Tunggu (Rata-rata < 3 bulan)
DELETE FROM trx_waktu_tunggu WHERE prodi_id = 1;
INSERT INTO trx_waktu_tunggu (tahun_lulus, jml_lulusan, jml_terlacak, wt_kurang_3bln, wt_3_sd_6bln, wt_lebih_6bln, prodi_id)
VALUES (2022, 80, 75, 70, 5, 0, 1);

-- 7. Kerjasama Industri (Untuk Skor C.2.4.c)
DELETE FROM trx_kerjasama WHERE prodi_id = 1;
INSERT INTO trx_kerjasama (jenis_kerjasama, lembaga_mitra, tingkat, judul_kegiatan, manfaat, waktu_durasi, prodi_id)
VALUES 
('pendidikan', 'PT Digital Solusi', 'nasional', 'Magang Industri Mahasiswa', 'Penempatan lulusan', '1 Semester', 1),
('penelitian', 'Google Indonesia', 'internasional', 'Riset AI Terapan', 'Publikasi bersama', '1 Tahun', 1);

-- 8. Kepuasan Pengguna (Untuk Skor C.9.4.f)
DELETE FROM trx_kepuasan_pengguna WHERE prodi_id = 1;
INSERT INTO trx_kepuasan_pengguna (jenis_kemampuan, persen_sangat_baik, persen_baik, prodi_id)
VALUES 
('etika', 90, 10, 1),
('keahlian', 85, 15, 1),
('komunikasi', 88, 12, 1),
('kerjasama', 92, 8, 1);
