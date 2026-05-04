-- Script untuk melengkapi seluruh Kamus Matriks Penilaian Jenjang D3
-- Berdasarkan Lampiran 6d PerBAN-PT No. 5 Tahun 2019

-- 1. Tambahkan elemen yang mungkin belum ada di migration_simulasi.sql
INSERT IGNORE INTO simulasi_matriks (kode_elemen, jenjang, bobot) VALUES
('C.9.4.c', 'D3', 2.88),
('C.9.4.d', 'D3', 2.03);

-- 2. Update Deskripsi, Rumus, dan Sumber Data
-- KRITERIA 1: VISI MISI TUJUAN DAN STRATEGI
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kesesuaian VMTS Unit Pengelola Program Studi (UPPS) terhadap VMTS Perguruan Tinggi (PT) dan kesesuaian VMTS Program Studi terhadap VMTS UPPS.',
rumus_kalkulasi = 'Penilaian Kualitatif (0-4). Skor 4 jika memiliki visi yang sangat jelas, realistis, dan menjadi rujukan seluruh sivitas akademika.',
sumber_data = 'Input Manual Asesor (LED)'
WHERE kode_elemen = 'C.1.4' AND jenjang = 'D3';

-- KRITERIA 2: TATA PAMONG, TATA KELOLA, DAN KERJASAMA
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Sistem Tata Pamong dan Good Governance (Kredibel, Transparan, Akuntabel, Bertanggung Jawab, Adil).',
rumus_kalkulasi = 'Penilaian Kualitatif (0-4). Menilai efektivitas struktur organisasi dan kepatuhan terhadap standar tata pamong.',
sumber_data = 'Input Manual Asesor (LED)'
WHERE kode_elemen = 'C.2.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Keefektifan kepemimpinan operasional, organisasional, dan publik.',
rumus_kalkulasi = 'Penilaian Kualitatif (0-4). Menilai kemampuan pimpinan dalam mengelola sumber daya dan menjamin keberlanjutan PS.',
sumber_data = 'Input Manual Asesor (LED)'
WHERE kode_elemen = 'C.2.4.b' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Mutu, manfaat, kepuasan dan keberlanjutan kerjasama akademik dan non-akademik.',
rumus_kalkulasi = 'Skor 4: Jika memiliki kerjasama internasional, nasional, dan lokal yang relevan serta memberikan manfaat nyata bagi PS.',
sumber_data = 'Tabel: trx_kerjasama (Menu: Kerjasama)'
WHERE kode_elemen = 'C.2.4.c' AND jenjang = 'D3';

-- KRITERIA 3: MAHASISWA
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Keketatan seleksi mahasiswa baru (Rasio Pendaftar / Lulus Seleksi).',
rumus_kalkulasi = 'Skor 4: Jika Rasio >= 5.0<br>Skor (Rasio - 1) x 0.75 + 1: Jika 1.0 < Rasio < 5.0',
sumber_data = 'Tabel: trx_seleksi_mahasiswa (Menu: Mahasiswa > Seleksi)'
WHERE kode_elemen = 'C.3.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Peningkatan animo calon mahasiswa dalam 3 tahun terakhir.',
rumus_kalkulasi = 'Skor 4: Jika tren jumlah pendaftar meningkat secara signifikan (> 10% per tahun).',
sumber_data = 'Tabel: trx_seleksi_mahasiswa'
WHERE kode_elemen = 'C.3.4.b' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Ketersediaan dan mutu layanan kemahasiswaan (minat bakat, karir, kesehatan, beasiswa).',
rumus_kalkulasi = 'Penilaian Kualitatif (0-4). Menilai keberagaman dan efektivitas penggunaan layanan oleh mahasiswa.',
sumber_data = 'Input Manual Asesor (LED)'
WHERE kode_elemen = 'C.3.4.c' AND jenjang = 'D3';

-- KRITERIA 4: SUMBER DAYA MANUSIA
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kecukupan jumlah dosen tetap (NDTPS) untuk menjamin kualitas pembelajaran.',
rumus_kalkulasi = 'Skor 4: Jika NDTPS >= 12<br>Skor (NDTPS-3) x (4/9): Jika 3 <= NDTPS < 12',
sumber_data = 'Tabel: master_dosen (Menu: Master Data > Dosen)'
WHERE kode_elemen = 'C.4.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kualifikasi akademik dosen tetap (Persentase Doktor/S3).',
rumus_kalkulasi = 'Skor 4: Jika PDS >= 20% (Doktor)<br>Skor 2 + (10 * PDS): Jika < 20%',
sumber_data = 'Tabel: master_dosen'
WHERE kode_elemen = 'C.4.4.b' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Jabatan akademik dosen tetap (Lektor Kepala dan Guru Besar).',
rumus_kalkulasi = 'Skor 4: Jika (LK + GB) >= 20%<br>Skor 2 + (10 * (LK+GB)): Jika < 20%',
sumber_data = 'Tabel: master_dosen'
WHERE kode_elemen = 'C.4.4.c' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kualifikasi dan kecukupan tenaga kependidikan (pustakawan, laboran, teknisi, dsb).',
rumus_kalkulasi = 'Penilaian Kualitatif (0-4). Menilai rasio kecukupan dan sertifikasi kompetensi tendik.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.4.4.d' AND jenjang = 'D3';

-- KRITERIA 5: KEUANGAN, SARANA, DAN PRASARANA
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Realisasi biaya operasional pendidikan (DOP) per mahasiswa per tahun.',
rumus_kalkulasi = 'Skor 4: Jika DOP >= 10 Juta/mhs/th<br>Skor (DOP/10) * 4: Jika < 10 Juta',
sumber_data = 'Tabel: trx_penggunaan_dana'
WHERE kode_elemen = 'C.5.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kecukupan, aksesibilitas, dan mutu sarana prasarana (Laboratorium, Studio, Perpustakaan).',
rumus_kalkulasi = 'Penilaian Kualitatif (0-4). Fokus pada ketersediaan peralatan utama praktik sesuai standar industri.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.5.4.b' AND jenjang = 'D3';

-- KRITERIA 6: PENDIDIKAN
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Keterlibatan pemangku kepentingan dalam penyusunan dan pemutakhiran kurikulum.',
rumus_kalkulasi = 'Skor 4: Jika melibatkan asosiasi profesi, alumni, dan pengguna lulusan secara aktif dan berkala.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kedalaman dan keluasan kurikulum sesuai dengan Capaian Pembelajaran Lulusan (CPL).',
rumus_kalkulasi = 'Menilai kesesuaian kurikulum dengan KKNI Level 5 (D3) dan kebutuhan dunia kerja.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.b' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Ketersediaan dan kualitas Rencana Pembelajaran Semester (RPS) yang mutakhir.',
rumus_kalkulasi = 'Skor 4: Jika 100% matakuliah memiliki RPS yang disusun berdasarkan CPL dan ditinjau berkala.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.c' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Karakteristik proses pembelajaran (Sifat Interaktif, Holistik, Integratif, Saintifik, Kontekstual).',
rumus_kalkulasi = 'Penilaian Kualitatif (0-4). Menilai metode pembelajaran (SCL, Case Method, Project Based Learning).',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.d' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Efektivitas sistem monitoring dan evaluasi proses pembelajaran.',
rumus_kalkulasi = 'Skor 4: Jika dilakukan secara periodik, terdokumentasi, dan diikuti dengan tindak lanjut perbaikan.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.e' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Mutu pelaksanaan penilaian pembelajaran (Valid, Objektif, Adil, Terpadu, Terbuka, Akuntabel).',
rumus_kalkulasi = 'Menilai keberagaman teknik penilaian dan korelasi antara nilai dengan capaian kompetensi.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.f' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Integrasi kegiatan penelitian dan PkM ke dalam proses pembelajaran.',
rumus_kalkulasi = 'Skor 4: Jika terdapat banyak mata kuliah yang diperkaya dengan hasil penelitian/PkM dosen/mahasiswa.',
sumber_data = 'Tabel: trx_kurikulum'
WHERE kode_elemen = 'C.6.4.g' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kualitas suasana akademik (Otonomi Keilmuan, Kebebasan Akademik, Mimbar Akademik).',
rumus_kalkulasi = 'Menilai interaksi antara dosen dan mahasiswa di luar jam kuliah untuk pengembangan intelektual.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.h' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Tingkat kepuasan mahasiswa terhadap proses pembelajaran.',
rumus_kalkulasi = 'Skor 4: Jika Indeks Kepuasan Mahasiswa (IKM) >= 3.50 (dari skala 4).',
sumber_data = 'Tabel: trx_kepuasan_pengguna'
WHERE kode_elemen = 'C.6.4.i' AND jenjang = 'D3';

-- KRITERIA 7: PENELITIAN
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Relevansi penelitian dosen tetap dan mahasiswa terhadap roadmap penelitian PS.',
rumus_kalkulasi = 'Skor 4: Jika 100% judul penelitian relevan dengan bidang keahlian dan roadmap prodi.',
sumber_data = 'Tabel: trx_penelitian_dtps'
WHERE kode_elemen = 'C.7.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Keterlibatan mahasiswa dalam kegiatan penelitian dosen tetap.',
rumus_kalkulasi = 'Skor 4: Jika > 25% mahasiswa terlibat dalam penelitian dosen dalam 3 tahun terakhir.',
sumber_data = 'Tabel: trx_penelitian_mhs'
WHERE kode_elemen = 'C.7.4.b' AND jenjang = 'D3';

-- KRITERIA 8: PENGABDIAN KEPADA MASYARAKAT (PkM)
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Relevansi PkM dosen tetap dan mahasiswa terhadap roadmap PkM PS.',
rumus_kalkulasi = 'Skor 4: Jika kegiatan PkM mampu memberikan solusi nyata bagi masalah di masyarakat/industri.',
sumber_data = 'Tabel: trx_pkm_dtps'
WHERE kode_elemen = 'C.8.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Keterlibatan mahasiswa dalam kegiatan PkM dosen tetap.',
rumus_kalkulasi = 'Skor 4: Jika > 25% mahasiswa terlibat aktif dalam pengabdian kepada masyarakat.',
sumber_data = 'Tabel: trx_pkm_mhs'
WHERE kode_elemen = 'C.8.4.b' AND jenjang = 'D3';

-- KRITERIA 9: LUARAN DAN CAPAIAN TRIDHARMA
UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Rata-rata Indeks Prestasi Kumulatif (IPK) lulusan dalam 3 tahun terakhir.',
rumus_kalkulasi = 'Skor 4: Jika RIPK >= 3.00<br>Skor (RIPK - 2.00) x 4: Jika 2.00 <= RIPK < 3.00',
sumber_data = 'Tabel: trx_ipk_lulusan (Menu: Luaran > IPK Lulusan)'
WHERE kode_elemen = 'C.9.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Waktu tunggu lulusan untuk mendapatkan pekerjaan pertama (Target standar: <= 6 bulan).',
rumus_kalkulasi = 'Skor 4: Jika WT <= 6 bulan<br>Skor 4 - ((WT-6)/6 * 4): Jika WT > 6 bulan',
sumber_data = 'Tabel: trx_waktu_tunggu'
WHERE kode_elemen = 'C.9.4.b' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Rata-rata masa studi lulusan (dalam tahun). Untuk D3 target standar adalah 3 tahun.',
rumus_kalkulasi = 'Skor 4: Jika MS <= 3.0 tahun<br>Skor 0: Jika MS > 3.0 tahun',
sumber_data = 'Tabel: trx_masa_studi (Menu: Luaran > Masa Studi)'
WHERE kode_elemen = 'C.9.4.c' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kesesuaian bidang kerja lulusan dengan profil lulusan (Level KKNI 5).',
rumus_kalkulasi = 'Skor 4: Jika PBS >= 60%<br>Skor 2 + (10/3 * PBS): Jika < 60%',
sumber_data = 'Tabel: trx_waktu_tunggu'
WHERE kode_elemen = 'C.9.4.d' AND jenjang = 'D3';
