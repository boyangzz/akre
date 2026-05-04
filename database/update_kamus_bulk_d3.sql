UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Keefektifan kepemimpinan operasional, organisasional, dan publik.',
rumus_kalkulasi = 'Penilaian Kualitatif (0-4). Menilai kemampuan pimpinan dalam mengelola sumber daya dan menjamin keberlanjutan PS.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.2.4.b' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kualifikasi dan kecukupan tenaga kependidikan (pustakawan, laboran, teknisi, dsb).',
rumus_kalkulasi = 'Penilaian Kualitatif (0-4). Menilai rasio kecukupan dan sertifikasi kompetensi tendik.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.4.4.d' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Realisasi biaya operasional pendidikan (DOP) per mahasiswa per tahun.',
rumus_kalkulasi = 'Skor 4: Jika DOP >= 10 Juta/mhs/th<br>Skor (DOP/10) * 4: Jika < 10 Juta',
sumber_data = 'Tabel: trx_penggunaan_dana'
WHERE kode_elemen = 'C.5.4.a' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kecukupan, aksesibilitas, dan mutu sarana prasarana (terutama Laboratorium/Bengkel).',
rumus_kalkulasi = 'Penilaian Kualitatif (0-4). Fokus pada ketersediaan peralatan utama praktik sesuai standar industri.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.5.4.b' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Ketersediaan dan kualitas Rencana Pembelajaran Semester (RPS) yang mutakhir.',
rumus_kalkulasi = 'Skor 4: Jika 100% matakuliah memiliki RPS yang disusun berdasarkan Capaian Pembelajaran Lulusan (CPL).',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.c' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Waktu tunggu lulusan untuk mendapatkan pekerjaan pertama (Target standar: <= 6 bulan).',
rumus_kalkulasi = 'Skor 4: Jika WT <= 6 bulan<br>Skor 4 - ((WT-6)/6 * 4): Jika WT > 6 bulan',
sumber_data = 'Tabel: trx_waktu_tunggu'
WHERE kode_elemen = 'C.9.4.b' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kesesuaian bidang kerja lulusan dengan profil lulusan yang ditetapkan.',
rumus_kalkulasi = 'Skor 4: Jika PBS >= 60%<br>Skor 2 + (10/3 * PBS): Jika < 60%',
sumber_data = 'Tabel: trx_waktu_tunggu'
WHERE kode_elemen = 'C.9.4.d' AND jenjang = 'D3';
