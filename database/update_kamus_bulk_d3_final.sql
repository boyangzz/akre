-- Script Final untuk melengkapi Kamus Matriks Penilaian Jenjang D3
-- Berdasarkan Lampiran 6d PerBAN-PT No. 5 Tahun 2019 & Naskah Akademik

-- 1. Inisialisasi Elemen Matriks D3 Lengkap
-- Menghapus data D3 lama untuk menghindari duplikasi kode yang membingungkan
DELETE FROM simulasi_matriks WHERE jenjang = 'D3';

INSERT INTO simulasi_matriks (kode_elemen, jenjang, bobot) VALUES
('C.1.4', 'D3', 0.52),
('C.2.4.a', 'D3', 0.35),
('C.2.4.b', 'D3', 0.35),
('C.2.4.c', 'D3', 0.69),
('C.3.4.a', 'D3', 4.68),
('C.3.4.b', 'D3', 3.12),
('C.3.4.c', 'D3', 1.56),
('C.4.4.a', 'D3', 0.62),
('C.4.4.b', 'D3', 0.91),
('C.4.4.c', 'D3', 2.27),
('C.4.4.d', 'D3', 1.13), -- Sertifikasi Kompetensi/Industri
('C.4.4.e', 'D3', 0.50), -- Rasio Dosen
('C.4.4.f', 'D3', 0.50), -- EWMP
('C.4.4.g', 'D3', 1.13), -- Tendik
('C.5.4.a', 'D3', 0.78),
('C.5.4.b', 'D3', 3.12),
('C.6.4.a', 'D3', 2.55),
('C.6.4.b', 'D3', 0.85),
('C.6.4.c', 'D3', 1.70),
('C.6.4.d', 'D3', 1.13),
('C.6.4.e', 'D3', 2.55),
('C.6.4.f', 'D3', 1.70),
('C.6.4.g', 'D3', 1.70),
('C.6.4.h', 'D3', 2.55),
('C.6.4.i', 'D3', 3.40),
('C.7.4.a', 'D3', 1.56),
('C.7.4.b', 'D3', 3.07),
('C.8.4.a', 'D3', 1.04),
('C.8.4.b', 'D3', 2.08),
('C.9.4.a', 'D3', 2.03),
('C.9.4.b', 'D3', 2.88),
('C.9.4.c', 'D3', 5.56), -- Masa Studi (Tinggi di D3)
('C.9.4.d', 'D3', 5.56), -- Waktu Tunggu (Tinggi di D3)
('C.9.4.e', 'D3', 5.56), -- Kesesuaian Bidang Kerja
('C.9.4.f', 'D3', 2.03), -- Kepuasan Pengguna
('C.9.4.g', 'D3', 2.03); -- Luaran Lainnya

-- 2. Update Deskripsi, Rumus, dan Sumber Data Jenjang D3
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kesesuaian VMTS UPPS terhadap VMTS PT dan visi keilmuan PS D3.',
rumus_kalkulasi = 'Penilaian Kualitatif (0-4). Fokus pada kejelasan visi vokasi.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.1.4' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Sistem Tata Pamong dan Good Governance (Kredibel, Transparan, Akuntabel, Bertanggung Jawab, Adil).',
rumus_kalkulasi = 'Menilai efektivitas struktur organisasi vokasi.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.2.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Mutu, manfaat, dan keberlanjutan kerjasama industri/akademik.',
rumus_kalkulasi = 'Skor 4: Jika memiliki kerjasama industri yang memberikan tempat magang dan serapan lulusan.',
sumber_data = 'Tabel: trx_kerjasama'
WHERE kode_elemen = 'C.2.4.c' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Keketatan seleksi mahasiswa baru (Pendaftar / Lulus).',
rumus_kalkulasi = 'Skor 4: Jika Rasio >= 5.0.',
sumber_data = 'Tabel: trx_seleksi_mahasiswa'
WHERE kode_elemen = 'C.3.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kecukupan jumlah dosen tetap (NDTPS) minimal 12 orang.',
rumus_kalkulasi = 'Skor 4: Jika NDTPS >= 12.',
sumber_data = 'Tabel: master_dosen'
WHERE kode_elemen = 'C.4.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Dosen tetap yang memiliki Sertifikat Kompetensi/Profesi/Industri.',
rumus_kalkulasi = 'Skor 4: Jika >= 50% dosen memiliki sertifikat kompetensi yang relevan.',
sumber_data = 'Tabel: master_dosen'
WHERE kode_elemen = 'C.4.4.d' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kesesuaian kurikulum dengan standar industri dan KKNI Level 5.',
rumus_kalkulasi = 'Menilai keterlibatan industri dalam penyusunan kurikulum.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kedalaman dan keluasan kurikulum sesuai dengan capaian pembelajaran vokasi.',
rumus_kalkulasi = 'Skor 4: Menitikberatkan pada porsi praktikum (min 60%).',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.c' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Rata-rata masa studi lulusan (Target: 3 tahun).',
rumus_kalkulasi = 'Skor 4: Jika MS <= 3.0 tahun.',
sumber_data = 'Tabel: trx_masa_studi'
WHERE kode_elemen = 'C.9.4.c' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Waktu tunggu lulusan untuk mendapatkan pekerjaan (Target: <= 3 bulan).',
rumus_kalkulasi = 'Skor 4: Jika WT <= 3 bulan.',
sumber_data = 'Tabel: trx_waktu_tunggu'
WHERE kode_elemen = 'C.9.4.d' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kesesuaian bidang kerja lulusan dengan profil lulusan D3.',
rumus_kalkulasi = 'Skor 4: Jika PBS >= 80% (Standar vokasi lebih tinggi).',
sumber_data = 'Tabel: trx_waktu_tunggu'
WHERE kode_elemen = 'C.9.4.e' AND jenjang = 'D3';
