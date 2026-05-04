# AKRE — Sistem Akreditasi BAN-PT

Sistem manajemen data akreditasi program studi berbasis **CodeIgniter 3**, Bootstrap 5, dan MySQL.

## Fitur
- Login & autentikasi pengguna
- Manajemen identitas program studi
- Master data: Dosen, Mahasiswa, Mata Kuliah
- Borang Kerjasama (1.1)
- Borang Kemahasiswaan: Seleksi (2.a), Mahasiswa Asing (2.b)
- Sumber Daya Manusia: EWMP, Rekognisi, Penelitian, PkM, Publikasi, HKI, Sitasi, Pembimbing TA, Luaran Lain
- Luaran: IPK, Masa Studi, Waktu Tunggu, Kepuasan Pengguna, Prestasi, Tempat Kerja, Luaran Mahasiswa
- Rule Engine: visibilitas menu otomatis berdasarkan jenjang (D3/S1/S2/S3/Terapan)
- Dashboard dengan statistik ringkasan

## Tech Stack
- **Backend**: PHP 7.4+ / 8.x, CodeIgniter 3
- **Frontend**: Bootstrap 5, Bootstrap Icons (lokal), jQuery
- **Database**: MySQL

## Instalasi
1. Clone repo ini ke direktori web server (mis. `laragon/www/akre`)
2. Import `database/aps.sql` ke MySQL
3. Salin `application/config/database.sample.php` → `database.php` dan sesuaikan kredensial
4. Akses `http://localhost/akre`

## Login Default
- **Username**: `admin`
- **Password**: `admin`
