ALTER TABLE simulasi_matriks 
ADD COLUMN deskripsi_indikator TEXT NULL AFTER bobot,
ADD COLUMN rumus_kalkulasi TEXT NULL AFTER deskripsi_indikator,
ADD COLUMN sumber_data VARCHAR(150) NULL AFTER rumus_kalkulasi;

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kecukupan jumlah dosen tetap perguruan tinggi yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi (NDTPS).',
rumus_kalkulasi = 'Skor 4: Jika NDTPS >= 12<br>Skor (NDTPS-3) x (4/9): Jika 3 <= NDTPS < 12<br>Skor 0: Jika NDTPS < 3',
sumber_data = 'Tabel: master_dosen (Menu: Master Data > Dosen)'
WHERE kode_elemen = 'C.4.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Rata-rata Indeks Prestasi Kumulatif (IPK) lulusan dalam 3 tahun terakhir.',
rumus_kalkulasi = 'Skor 4: Jika RIPK >= 3.00<br>Skor (RIPK - 2.00) x 4: Jika 2.00 <= RIPK < 3.00<br>Skor 0: Jika RIPK < 2.00',
sumber_data = 'Tabel: trx_ipk_lulusan (Menu: Luaran > IPK Lulusan)'
WHERE kode_elemen = 'C.9.4.a' AND jenjang = 'D3';
