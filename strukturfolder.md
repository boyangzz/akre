/nama_proyek_tahap2
│
├── /assets                 <-- (Zero-CDN Policy: Semua aset wajib di sini)
│   ├── /css
│   │   ├── bootstrap.min.css
│   │   └── custom_admin.css
│   ├── /js
│   │   ├── jquery.min.js
│   │   ├── bootstrap.bundle.min.js
│   │   └── dynamic_borang.js <-- (Logic untuk hide/show form sesuai jenjang prodi)
│   └── /img
│
├── /application
│   ├── /config
│   │   ├── autoload.php    <-- (Autoload database, url helper, session)
│   │   ├── config.php      <-- (Set base_url)
│   │   ├── database.php    <-- (Koneksi ke MySQL/MariaDB Laragon)
│   │   └── routes.php      <-- (Routing custom untuk API dan Dashboard)
│   │
│   ├── /core
│   │   └── MY_Controller.php <-- (Sangat Penting: Berisi logic middleware untuk memvalidasi JWT Token sebelum user mengakses controller lain)
│   │
│   ├── /libraries
│   │   └── Jwt_auth.php    <-- (Library custom/pihak ketiga untuk decode token dari Tahap 1)
│   │
│   ├── /controllers
│   │   ├── Sso_handler.php <-- (Endpoint untuk menerima lemparan JWT dari Tahap 1 & set Session)
│   │   ├── Dashboard.php   <-- (Menampilkan widget rekap TS, TS-1, dst)
│   │   ├── Master_data.php <-- (CRUD Dosen, Mahasiswa, Prodi, Mata Kuliah)
│   │   ├── Tridharma.php   <-- (Input Penelitian, PkM, Anggota Polymorphic)
│   │   └── Outcomes.php    <-- (Input Tracer Study, Kelulusan, Prestasi)
│   │
│   ├── /models             <-- (Berdasarkan ERD yang sudah disepakati)
│   │   ├── Borang_setup_model.php <-- (Rule engine untuk cek "is_wajib")
│   │   ├── Master_model.php
│   │   ├── Tridharma_model.php
│   │   └── Luaran_model.php
│   │
│   └── /views
│       ├── /layout
│       │   ├── header.php  <-- (Load local CSS)
│       │   ├── sidebar.php <-- (Navigasi dinamis)
│       │   └── footer.php  <-- (Load local JS)
│       ├── /dashboard
│       │   └── index.php
│       ├── /master
│       │   ├── dosen_list.php
│       │   └── mahasiswa_list.php
│       ├── /tridharma
│       │   └── form_kegiatan.php
│       └── /outcomes
│           └── form_tracer.php
│
├── /system                 <-- (Core CI3, tidak perlu disentuh)
├── .htaccess               <-- (Untuk menghilangkan index.php pada URL)
└── index.php