-- Script untuk melengkapi seluruh Kamus Matriks Penilaian Jenjang S1
-- Berdasarkan Lampiran 6a PerBAN-PT No. 5 Tahun 2019

-- 1. Inisialisasi Elemen Matriks S1 (Jika belum ada)
INSERT IGNORE INTO simulasi_matriks (kode_elemen, jenjang, bobot) VALUES
('C.1.4', 'S1', 0.51),
('C.2.4.a', 'S1', 0.34),
('C.2.4.b', 'S1', 0.34),
('C.2.4.c', 'S1', 0.68),
('C.3.4.a', 'S1', 4.60),
('C.3.4.b', 'S1', 3.07),
('C.3.4.c', 'S1', 1.53),
('C.4.4.a', 'S1', 0.74),
('C.4.4.b', 'S1', 0.99),
('C.4.4.c', 'S1', 0.99),
('C.4.4.d', 'S1', 1.12),
('C.5.4.a', 'S1', 0.77),
('C.5.4.b', 'S1', 3.07),
('C.6.4.a', 'S1', 2.51),
('C.6.4.b', 'S1', 1.12),
('C.6.4.c', 'S1', 1.12),
('C.6.4.d', 'S1', 1.12),
('C.6.4.e', 'S1', 0.56),
('C.6.4.f', 'S1', 1.12),
('C.6.4.g', 'S1', 0.56),
('C.6.4.h', 'S1', 0.56),
('C.7.4.a', 'S1', 2.00),
('C.7.4.b', 'S1', 1.05),
('C.8.4.a', 'S1', 0.80),
('C.8.4.b', 'S1', 1.05),
('C.9.4.a', 'S1', 1.05),
('C.9.4.b', 'S1', 1.05),
('C.9.4.c', 'S1', 1.05),
('C.9.4.d', 'S1', 3.16),
('C.9.4.e', 'S1', 2.11),
('C.9.4.f', 'S1', 3.16),
('C.9.4.g', 'S1', 1.05);

-- 2. Update Deskripsi, Rumus, dan Sumber Data Jenjang S1
-- KRITERIA 1: VISI MISI
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kesesuaian VMTS Unit Pengelola Program Studi (UPPS) terhadap VMTS PT dan visi keilmuan PS.',
rumus_kalkulasi = 'Penilaian Kualitatif (0-4). UPPS memiliki visi yang mencerminkan visi PT dan memayungi visi keilmuan PS.',
sumber_data = 'Input Manual Asesor (LED)'
WHERE kode_elemen = 'C.1.4' AND jenjang = 'S1';

-- KRITERIA 2: TATA PAMONG
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Sistem Tata Pamong berjalan secara efektif (Kredibel, Transparan, Akuntabel, Bertanggung Jawab, Adil).',
rumus_kalkulasi = 'Skor 4: Jika sistem tata pamong didukung oleh dokumen formal dan bukti implementasi yang konsisten.',
sumber_data = 'Input Manual Asesor (LED)'
WHERE kode_elemen = 'C.2.4.a' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Keefektifan kepemimpinan operasional, organisasional, dan publik di tingkat PS.',
rumus_kalkulasi = 'Penilaian Kualitatif Asesor (0-4). Menilai tata kelola dan keberlanjutan prodi.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.2.4.b' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Mutu, manfaat, dan keberlanjutan kerjasama akademik dan non-akademik (Internasional, Nasional, Lokal).',
rumus_kalkulasi = 'Skor 4: Jika memiliki kerjasama internasional dan nasional yang aktif memberikan kontribusi nyata bagi CPL.',
sumber_data = 'Tabel: trx_kerjasama'
WHERE kode_elemen = 'C.2.4.c' AND jenjang = 'S1';

-- KRITERIA 3: MAHASISWA
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Keketatan seleksi mahasiswa baru (Rasio Pendaftar / Lulus Seleksi).',
rumus_kalkulasi = 'Skor 4: Jika Rasio >= 5.0<br>Skor (Rasio-1) * 0.75 + 1: Jika 1 < Rasio < 5',
sumber_data = 'Tabel: trx_seleksi_mahasiswa'
WHERE kode_elemen = 'C.3.4.a' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Peningkatan animo calon mahasiswa dan daya tarik program studi.',
rumus_kalkulasi = 'Skor 4: Jika jumlah pendaftar meningkat >= 10% per tahun dalam 3 tahun terakhir.',
sumber_data = 'Tabel: trx_seleksi_mahasiswa'
WHERE kode_elemen = 'C.3.4.b' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Layanan kemahasiswaan (Bimbingan Karir, Beasiswa, Kesehatan, Minat Bakat).',
rumus_kalkulasi = 'Menilai ketersediaan dan efektivitas penggunaan layanan oleh mahasiswa.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.3.4.c' AND jenjang = 'S1';

-- KRITERIA 4: SDM
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kecukupan jumlah dosen tetap (NDTPS) minimal 12 orang.',
rumus_kalkulasi = 'Skor 4: Jika NDTPS >= 12<br>Skor ((2 * NDTPS) + 12) / 9: Jika NDTPS < 12',
sumber_data = 'Tabel: master_dosen'
WHERE kode_elemen = 'C.4.4.a' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kualifikasi akademik dosen tetap (Persentase Doktor/S3).',
rumus_kalkulasi = 'Skor 4: Jika PDS >= 50%<br>Skor 2 + (4 * PDS): Jika PDS < 50%',
sumber_data = 'Tabel: master_dosen'
WHERE kode_elemen = 'C.4.4.b' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Jabatan akademik dosen tetap (Lektor Kepala dan Guru Besar).',
rumus_kalkulasi = 'Skor 4: Jika (LK + GB) >= 70%<br>Skor 2 + (20/7 * (LK+GB)): Jika < 70%',
sumber_data = 'Tabel: master_dosen'
WHERE kode_elemen = 'C.4.4.c' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kualifikasi dan kecukupan tenaga kependidikan untuk mendukung Tridharma.',
rumus_kalkulasi = 'Menilai kecukupan pustakawan, laboran, teknisi, dan staf administrasi.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.4.4.d' AND jenjang = 'S1';

-- KRITERIA 5: KEUANGAN/SARPRAS
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Rata-rata dana operasional pendidikan per mahasiswa per tahun (DOP).',
rumus_kalkulasi = 'Skor 4: Jika DOP >= 20 Juta<br>Skor (DOP / 20) * 4: Jika < 20 Juta',
sumber_data = 'Tabel: trx_penggunaan_dana'
WHERE kode_elemen = 'C.5.4.a' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kecukupan, aksesibilitas, dan mutu sarana prasarana pembelajaran.',
rumus_kalkulasi = 'Fokus pada ruang kuliah, laboratorium, dan ketersediaan pustaka mutakhir.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.5.4.b' AND jenjang = 'S1';

-- KRITERIA 6: PENDIDIKAN
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Keterlibatan pemangku kepentingan dalam evaluasi dan pemutakhiran kurikulum.',
rumus_kalkulasi = 'Skor 4: Melibatkan asosiasi, alumni, dan pengguna secara berkala (4-5 tahun sekali).',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.a' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kesesuaian capaian pembelajaran (CPL) dengan profil lulusan dan jenjang KKNI (Level 6).',
rumus_kalkulasi = 'Menilai kedalaman materi dan kesesuaian matakuliah dengan CPL yang ditetapkan.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.b' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Ketersediaan dan pemutakhiran Rencana Pembelajaran Semester (RPS).',
rumus_kalkulasi = 'Skor 4: Jika 100% matakuliah memiliki RPS yang disusun berdasarkan hasil penelitian dan PkM.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.c' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Karakteristik proses pembelajaran yang Interaktif, Holistik, dan berpusat pada mahasiswa (SCL).',
rumus_kalkulasi = 'Menilai implementasi Case Method dan Team-Based Project.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.d' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Sistem Monitoring dan Evaluasi proses pembelajaran secara periodik.',
rumus_kalkulasi = 'Skor 4: Dilakukan secara sistematis, terdokumentasi, dan ada tindak lanjut (siklus PPEPP).',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.e' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Pelaksanaan penilaian pembelajaran yang valid, objektif, adil, dan akuntabel.',
rumus_kalkulasi = 'Menilai rubrik penilaian dan transparansi pengumuman nilai mahasiswa.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.f' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Integrasi hasil penelitian dan PkM dosen ke dalam materi pembelajaran.',
rumus_kalkulasi = 'Skor 4: Jika terdapat banyak mata kuliah yang diperkaya hasil penelitian dosen.',
sumber_data = 'Tabel: trx_kurikulum'
WHERE kode_elemen = 'C.6.4.g' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kualitas suasana akademik untuk mendukung otonomi keilmuan dosen dan mahasiswa.',
rumus_kalkulasi = 'Menilai interaksi ilmiah dan pengembangan budaya akademik di lingkungan prodi.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.h' AND jenjang = 'S1';

-- KRITERIA 7: PENELITIAN
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Relevansi penelitian terhadap roadmap penelitian UPPS dan melibatkan mahasiswa.',
rumus_kalkulasi = 'Skor 4: Jika penelitian memiliki dampak keilmuan/praktis dan melibatkan > 25% mahasiswa.',
sumber_data = 'Tabel: trx_penelitian_dtps'
WHERE kode_elemen = 'C.7.4.a' AND jenjang = 'S1';

-- KRITERIA 8: PkM
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Relevansi Pengabdian kepada Masyarakat (PkM) terhadap roadmap dan kemanfataan bagi masyarakat.',
rumus_kalkulasi = 'Skor 4: Jika PkM memberikan solusi nyata bagi masalah masyarakat dan melibatkan mahasiswa.',
sumber_data = 'Tabel: trx_pkm_dtps'
WHERE kode_elemen = 'C.8.4.a' AND jenjang = 'S1';

-- KRITERIA 9: LUARAN
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Rata-rata IPK lulusan dalam 3 tahun terakhir (Target: >= 3.25).',
rumus_kalkulasi = 'Skor 4: Jika RIPK >= 3.25<br>Skor (RIPK - 2.00) / 1.25 * 4: Jika 2.00 <= RIPK < 3.25',
sumber_data = 'Tabel: trx_ipk_lulusan'
WHERE kode_elemen = 'C.9.4.a' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Prestasi mahasiswa di bidang akademik dan non-akademik (Internasional/Nasional).',
rumus_kalkulasi = 'Menilai jumlah dan kualitas medali/penghargaan yang diraih mahasiswa.',
sumber_data = 'Tabel: trx_prestasi_mhs'
WHERE kode_elemen = 'C.9.4.b' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Rata-rata masa studi lulusan (Target: 3.5 s.d 4.5 tahun).',
rumus_kalkulasi = 'Skor 4: Jika MS <= 4.0 tahun<br>Skor 0: Jika MS > 7.0 tahun',
sumber_data = 'Tabel: trx_masa_studi'
WHERE kode_elemen = 'C.9.4.c' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Waktu tunggu lulusan untuk mendapatkan pekerjaan pertama (Target: <= 6 bulan).',
rumus_kalkulasi = 'Skor 4: Jika WT <= 6 bulan<br>Skor (18 - WT) / 12 * 4: Jika 6 < WT < 18',
sumber_data = 'Tabel: trx_waktu_tunggu'
WHERE kode_elemen = 'C.9.4.d' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kesesuaian bidang kerja lulusan dengan profil lulusan (Target: >= 60%).',
rumus_kalkulasi = 'Skor 4: Jika PBS >= 60%<br>Skor (PBS / 60) * 4: Jika < 60%',
sumber_data = 'Tabel: trx_waktu_tunggu'
WHERE kode_elemen = 'C.9.4.e' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Tingkat kepuasan pengguna lulusan terhadap kompetensi alumni.',
rumus_kalkulasi = 'Skor 4: Jika Indeks Kepuasan Pengguna >= 3.50.',
sumber_data = 'Tabel: trx_kepuasan_pengguna'
WHERE kode_elemen = 'C.9.4.f' AND jenjang = 'S1';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Publikasi ilmiah mahasiswa (Jurnal Nasional/Internasional) dan Sitasi.',
rumus_kalkulasi = 'Menilai jumlah artikel mahasiswa di jurnal bereputasi atau sitasi karya ilmiah.',
sumber_data = 'Tabel: trx_luaran_mhs'
WHERE kode_elemen = 'C.9.4.g' AND jenjang = 'S1';
