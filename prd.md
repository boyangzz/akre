PRODUCT REQUIREMENTS DOCUMENT (PRD)
Nama Proyek: Sistem Manajemen Akreditasi BAN-PT (Tahap 2)
Fase Rilis: Minimum Viable Product (MVP) - Tahap 2
Fokus Rilis: Integrasi SSO, Manajemen Data Induk, dan Dashboard Rekapitulasi

1. Ringkasan Eksekutif
Aplikasi Tahap 2 ini merupakan modul lanjutan yang berfokus pada agregasi dan rekapitulasi data tridharma perguruan tinggi sesuai standar borang Akreditasi Program Studi (APS) 4.0 BAN-PT. Sistem ini dirancang untuk beroperasi dalam sebuah ekosistem multi-app, bertindak sebagai service terpisah yang menerima otorisasi pengguna secara mulus dari aplikasi Tahap 1 melalui pertukaran token. Rilis ini membatasi ruang lingkup pada proses input dan dasbor visualisasi (rekap), menunda fitur export ke dokumen final. Sistem ini berpotensi menjadi salah satu modul penunjang yang berharga dalam portofolio Husain Dev Project (HDP).

2. Arsitektur & Teknologi (Tech Stack)
Pendekatan stack klasik dipertahankan untuk memastikan stabilitas tingkat enterprise, maintenance yang mudah, serta menghindari kompleksitas build-tools modern.

Backend Framework: CodeIgniter 3 (CI3).

Frontend UI: Bootstrap 5 dan jQuery.

Manajemen Aset: Zero-CDN Policy. Seluruh file library UI (Bootstrap CSS/JS, jQuery) wajib diunduh dan disimpan di dalam folder direktori lokal assets/. Hal ini menjamin aplikasi tetap fungsional secara internal tanpa terpengaruh gangguan jaringan luar.

Autentikasi: JSON Web Token (JWT) dikirim via header dari aplikasi Tahap 1 (SSO Provider).

Database: MySQL / MariaDB (Relasional murni dengan constraint yang ketat).

3. Lingkungan Infrastruktur & Deployment (NFR)
Sistem memiliki spesifikasi Non-Functional Requirements (NFR) yang sangat efisien untuk meminimalkan beban overhead.

Development & Production Environment: Menggunakan lingkungan Laragon (web server Apache/Nginx, PHP, MySQL) yang berjalan langsung di atas sistem operasi Windows 10/11.

Efisiensi Resource: Desain query CI3 dioptimalkan agar tetap responsif dan ringan (mampu berjalan mulus pada spesifikasi perangkat keras terbatas, seperti prosesor i3 Gen 9 dengan memori 8GB).

Keamanan Penyimpanan: Deployment dan penyimpanan basis data dikonfigurasi untuk langsung menulis ke partisi data yang sudah terbentuk (established data partitions), tanpa melakukan pemformatan ulang atau menggunakan virtualisasi berlapis (tanpa Docker).

4. Ruang Lingkup Fitur MVP (Tahap 2)
Epic 1: Autentikasi & Integrasi (SSO)
Validasi Token: Pembuatan middleware/hook di CI3 untuk menangkap, mendekode, dan memvalidasi signature JWT yang dilempar dari aplikasi Tahap 1.

Session Binding: Mengubah muatan (payload) JWT menjadi sesi aktif di CI3 (user_id, role, dll) agar pengguna tidak mendapati halaman login sama sekali saat berpindah aplikasi.

Epic 2: Manajemen Data Master (Master Data Management)
CRUD Data Induk: Antarmuka dengan validasi ketat untuk mengelola tabel master_program_studi, master_dosen, master_mahasiswa, dan master_mata_kuliah.

Logika Dinamis Pemilihan Jenjang: Modul UI menggunakan jQuery untuk mendeteksi input "Jenjang" (D3/S1/S2/S3) pada profil prodi, yang nantinya akan mengatur visibilitas menu atau form terkait.

Epic 3: Transaksi Data Borang (Input)
Form Tridharma: Pencatatan kegiatan penelitian dan PkM (trx_kegiatan_tridharma) dengan relasi ganda (penulis dosen dan/atau mahasiswa) menggunakan Query Builder CI3 untuk mengatasi struktur polymorphic.

Form Luaran Akademik: Input rekam jejak lulusan, tracer study, prestasi mahasiswa, dan publikasi.

Epic 4: Dasbor Rekapitulasi (Dashboard Analytics)
Visualisasi TS (Tahun Sekarang): Dasbor akan membaca sistem "Tahun Akademik Berjalan" dan secara otomatis menghitung metrik mundur (TS-1, TS-2, dst).

Widget Ringkasan Utama: * Tampilan rasio dosen dan mahasiswa.

Persentase masa tunggu lulusan (tracer study).

Distribusi tridharma (penelitian lokal vs. internasional).

5. Strategi Database (Ringkasan)
Skema relasional mengadopsi prinsip on delete cascade dan perlindungan data yatim. Tabel setup_tabel_borang digunakan sebagai "otak" konfigurasi (rule engine) yang memungkinkan sistem untuk mengetahui tabel mana saja yang berhak dilihat oleh jenjang program studi tertentu tanpa perlu melakukan hardcode logika persaratan di dalam controller CI3.