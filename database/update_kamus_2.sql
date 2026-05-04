UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Keketatan seleksi mahasiswa baru (Rasio Pendaftar / Lulus Seleksi).',
rumus_kalkulasi = 'Skor 4: Jika Rasio >= 5.0<br>Skor (Rasio - 1) x 0.75 + 1: Jika 1.0 < Rasio < 5.0<br>Skor 0: Jika Rasio <= 1.0',
sumber_data = 'Tabel: trx_seleksi_mahasiswa (Menu: Mahasiswa > Seleksi)'
WHERE kode_elemen = 'C.3.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Rata-rata masa studi lulusan (dalam tahun). Untuk D3 target standar adalah 3 tahun.',
rumus_kalkulasi = 'Skor 4: Jika MS <= 3.0 tahun<br>Skor 0: Jika MS > 3.0 tahun',
sumber_data = 'Tabel: trx_masa_studi (Menu: Luaran > Masa Studi)'
WHERE kode_elemen = 'C.9.4.c' AND jenjang = 'D3';
