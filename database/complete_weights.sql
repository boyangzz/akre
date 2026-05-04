-- Script untuk melengkapi bobot matriks agar total menjadi 100 (Skor Maksimal 400)
-- Menambahkan indikator pelengkap untuk kriteria yang bobotnya belum mencapai standar BAN-PT

-- JENJANG D3 (Target 100.00)
INSERT INTO simulasi_matriks (kode_elemen, jenjang, bobot, deskripsi_indikator, rumus_kalkulasi, sumber_data) VALUES
('C.1.X', 'D3', 1.48, 'Indikator Pelengkap Kriteria 1 (Visi Misi)', 'Evaluasi pendukung VMTS', 'Input Manual Asesor'),
('C.2.X', 'D3', 3.61, 'Indikator Pelengkap Kriteria 2 (Tata Pamong)', 'Evaluasi pendukung Tata Kelola', 'Input Manual Asesor'),
('C.3.X', 'D3', 0.64, 'Indikator Pelengkap Kriteria 3 (Mahasiswa)', 'Evaluasi pendukung Kemahasiswaan', 'Input Manual Asesor'),
('C.4.X', 'D3', 7.94, 'Indikator Pelengkap Kriteria 4 (SDM)', 'Evaluasi pendukung SDM', 'Input Manual Asesor'),
('C.5.X', 'D3', 6.10, 'Indikator Pelengkap Kriteria 5 (Keuangan/Sarpras)', 'Evaluasi pendukung Sarpras', 'Input Manual Asesor'),
('C.6.X', 'D3', 1.87, 'Indikator Pelengkap Kriteria 6 (Pendidikan)', 'Evaluasi pendukung Kurikulum', 'Input Manual Asesor'),
('C.7.X', 'D3', 0.37, 'Indikator Pelengkap Kriteria 7 (Penelitian)', 'Evaluasi pendukung Penelitian', 'Input Manual Asesor'),
('C.8.X', 'D3', 1.88, 'Indikator Pelengkap Kriteria 8 (PkM)', 'Evaluasi pendukung PkM', 'Input Manual Asesor'),
('C.9.X', 'D3', 2.35, 'Indikator Pelengkap Kriteria 9 (Luaran)', 'Evaluasi pendukung Luaran', 'Input Manual Asesor');

-- JENJANG S1 (Target 100.00)
INSERT INTO simulasi_matriks (kode_elemen, jenjang, bobot, deskripsi_indikator, rumus_kalkulasi, sumber_data) VALUES
('C.1.X', 'S1', 1.59, 'Indikator Pelengkap Kriteria 1 (Visi Misi)', 'Evaluasi pendukung VMTS', 'Input Manual Asesor'),
('C.2.X', 'S1', 3.94, 'Indikator Pelengkap Kriteria 2 (Tata Pamong)', 'Evaluasi pendukung Tata Kelola', 'Input Manual Asesor'),
('C.3.X', 'S1', 0.80, 'Indikator Pelengkap Kriteria 3 (Mahasiswa)', 'Evaluasi pendukung Kemahasiswaan', 'Input Manual Asesor'),
('C.4.X', 'S1', 12.00, 'Indikator Pelengkap Kriteria 4 (SDM)', 'Evaluasi pendukung SDM', 'Input Manual Asesor'),
('C.5.X', 'S1', 1.46, 'Indikator Pelengkap Kriteria 5 (Keuangan/Sarpras)', 'Evaluasi pendukung Sarpras', 'Input Manual Asesor'),
('C.6.X', 'S1', 9.73, 'Indikator Pelengkap Kriteria 6 (Pendidikan)', 'Evaluasi pendukung Kurikulum', 'Input Manual Asesor'),
('C.7.X', 'S1', 2.25, 'Indikator Pelengkap Kriteria 7 (Penelitian)', 'Evaluasi pendukung Penelitian', 'Input Manual Asesor'),
('C.8.X', 'S1', 0.75, 'Indikator Pelengkap Kriteria 8 (PkM)', 'Evaluasi pendukung PkM', 'Input Manual Asesor'),
('C.9.X', 'S1', 22.53, 'Indikator Pelengkap Kriteria 9 (Luaran)', 'Evaluasi pendukung Luaran', 'Input Manual Asesor');
