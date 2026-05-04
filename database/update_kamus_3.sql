UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Visi, misi, tujuan, dan strategi (VMTS) Unit Pengelola Program Studi (UPPS) dan Program Studi (PS).',
rumus_kalkulasi = 'Penilaian Kualitatif oleh Asesor (0-4). Fokus pada kejelasan, kerealistikan, dan keterlibatan pemangku kepentingan.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.1.4' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kualifikasi akademik dosen tetap (Pendidikan Doktor/S3).',
rumus_kalkulasi = 'Skor 4: Jika PDS >= 20%<br>Skor 2 + (10 * PDS): Jika PDS < 20%',
sumber_data = 'Tabel: master_dosen'
WHERE kode_elemen = 'C.4.4.b' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Jabatan akademik dosen tetap (Lektor Kepala dan Guru Besar).',
rumus_kalkulasi = 'Skor 4: Jika (LK + GB) >= 20%<br>Skor 2 + (10 * (LK+GB)): Jika < 20%',
sumber_data = 'Tabel: master_dosen'
WHERE kode_elemen = 'C.4.4.c' AND jenjang = 'D3';

UPDATE simulasi_matriks SET 
deskripsi_indikator = 'Kesesuaian kurikulum dengan visi, misi, dan tujuan program studi serta perkembangan IPTEKS.',
rumus_kalkulasi = 'Penilaian Kualitatif Asesor (0-4). Menilai kedalaman dan keluasan materi pembelajaran.',
sumber_data = 'Input Manual Asesor'
WHERE kode_elemen = 'C.6.4.a' AND jenjang = 'D3';
