# AKRE — Project Scaffolding Implementation Plan (v3 — Final)

> Scaffolding lengkap proyek **Sistem Manajemen Akreditasi BAN-PT (Tahap 2)** di atas CodeIgniter 3, diperkaya dengan struktur tabel resmi dari **Sheet Pengusul APS 4.0** dan lampiran **PerBAN-PT No. 5 Th 2019**.

---

## Konteks dari Bahan Lampiran

Dari analisis file `Sheet Pengusul APS 4_0 20200131.xlsx` (48 sheet), struktur tabel LKPS yang harus diakomodasi oleh sistem:

| Kode Sheet | Nama Tabel BAN-PT | Kategori |
|---|---|---|
| Menu | Identitas Pengusul | Config |
| PS | Profil Program Studi & UPPS | Master |
| 1-1, 1-2, 1-3 | Tabel 1: Kerjasama Tridharma (Pendidikan, Penelitian, PkM) | Transaksi |
| 2a | Tabel 2.a: Seleksi Mahasiswa Baru | Transaksi |
| 2b | Tabel 2.b: Mahasiswa Asing | Transaksi |
| 3a1 | Tabel 3.a.1: Dosen Tetap PT | Master |
| 3a2 | Tabel 3.a.2: Dosen Pembimbing TA (rasio) | Transaksi |
| 3a3 | Tabel 3.a.3: EWMP Dosen Tetap | Transaksi |
| 3a4 | Tabel 3.a.4: Dosen Tidak Tetap | Master |
| 3a5 | Tabel 3.a.5: Dosen Industri/Praktisi | Master |
| 3b1 | Tabel 3.b.1: Rekognisi Dosen | Transaksi |
| 3b2 | Tabel 3.b.2: Penelitian DTPS | Transaksi |
| 3b3 | Tabel 3.b.3: PkM DTPS | Transaksi |
| 3b4-1, 3b4-2 | Tabel 3.b.4: Publikasi Ilmiah DTPS | Transaksi |
| 3b5 | Tabel 3.b.5: HKI, Buku, Book Chapter DTPS | Transaksi |
| 3b6 | Tabel 3.b.6: Sitasi DTPS | Transaksi |
| 5a, 5b, 5c | Tabel 5: Kurikulum & Pembelajaran | Transaksi |
| 6a, 6b | Tabel 6: Penelitian & Tesis Mahasiswa | Transaksi |
| 8a | Tabel 8.a: IPK Lulusan | Transaksi |
| 8b1, 8b2 | Tabel 8.b: Prestasi Mahasiswa | Transaksi |
| 8c | Tabel 8.c: Masa Studi Lulusan | Transaksi |
| 8d1, 8d2 | Tabel 8.d: Waktu Tunggu Lulusan | Transaksi |
| 8e1, 8e2 | Tabel 8.e: Tempat Kerja & Kepuasan Pengguna | Transaksi |
| 8f1-1, 8f1-2, 8f2, 8f3, 8f4-1..4 | Tabel 8.f: Luaran Penelitian/PkM Mahasiswa | Transaksi |

---

## Proposed Changes

Dibagi menjadi **6 fase** yang dikerjakan berurutan:

---

### Fase 1: Project Configuration

#### [MODIFY] [config.php](file:///c:/laragon/www/akre/application/config/config.php)
- `base_url` → `http://localhost/akre/`
- `index_page` → `''`
- `encryption_key` → random 32-char key
- `sess_save_path` → `sys_get_temp_dir()`
- `composer_autoload` tetap `FALSE`

#### [MODIFY] [database.php](file:///c:/laragon/www/akre/application/config/database.php)
- `hostname` → `localhost`, `username` → `root`, `password` → `''`, `database` → `aps`

#### [MODIFY] [autoload.php](file:///c:/laragon/www/akre/application/config/autoload.php)
- `libraries` → `['database', 'session']`
- `helper` → `['url', 'form']`

#### [MODIFY] [routes.php](file:///c:/laragon/www/akre/application/config/routes.php)
- `default_controller` → `'auth/login'`

#### [NEW] [.htaccess](file:///c:/laragon/www/akre/.htaccess)
Apache URL rewriting untuk clean URLs.

---

### Fase 2: Asset Download (Zero-CDN)

Download semua library frontend ke `assets/`:

| File | Source |
|---|---|
| `css/bootstrap.min.css` | Bootstrap 5.3.8 |
| `css/bootstrap-icons.min.css` | Bootstrap Icons 1.11.3 |
| `css/custom_admin.css` | Custom (mobile-first) |
| `js/jquery.min.js` | jQuery 3.7.1 |
| `js/bootstrap.bundle.min.js` | Bootstrap 5.3.8 |
| `js/dynamic_borang.js` | Custom (jenjang logic) |
| `fonts/bootstrap-icons.woff2` | Icon font |
| `fonts/bootstrap-icons.woff` | Icon font fallback |

---

### Fase 3: Authentication System

Login admin sederhana, session-based. Tanpa JWT.

#### [NEW] [MY_Controller.php](file:///c:/laragon/www/akre/application/core/MY_Controller.php)
- `MY_Controller` — cek session, redirect ke login jika belum auth
- `Public_Controller` — tanpa auth check (untuk halaman login)

#### [NEW] [Auth.php](file:///c:/laragon/www/akre/application/controllers/Auth.php)
- `login()` / `logout()` — validasi `admin` / `admin` (bcrypt)

#### [NEW] [Auth_model.php](file:///c:/laragon/www/akre/application/models/Auth_model.php)
- `authenticate()`, `get_user_by_id()`

#### [NEW] [views/auth/login.php](file:///c:/laragon/www/akre/application/views/auth/login.php)
- Mobile-first centered card login form

---

### Fase 4: Database Schema

SQL schema yang memetakan langsung ke struktur tabel LKPS APS 4.0.

#### [NEW] [database/aps_schema.sql](file:///c:/laragon/www/akre/database/aps_schema.sql)

**Grup A: Admin & Konfigurasi**

| Tabel | Kolom Utama |
|---|---|
| `admin_users` | id, username, password, nama_lengkap, role, timestamps |
| `setup_tabel_borang` | id, kode_tabel, nama_tabel, jenjang_filter (JSON: ["S1","S2",...]), is_wajib, urutan, deskripsi |

**Grup B: Identitas & Master**

| Tabel | Kolom Utama | Ref Sheet |
|---|---|---|
| `identitas_pengusul` | id, nama_pt, nama_fakultas, nama_prodi, jenjang, alamat, no_sk_banpt, peringkat_akreditasi, tanggal_kadaluarsa | Menu |
| `master_dosen` | id, nidn, nama, pendidikan_pasca (S2/S3), bidang_keahlian, kesesuaian_kompetensi, jabatan_akademik (Asisten Ahli/Lektor/Lektor Kepala/Guru Besar), sertifikat_pendidik, sertifikat_kompetensi, prodi_id, status_ikatan (tetap/tidak_tetap/industri) | 3a1, 3a4, 3a5 |
| `master_mahasiswa` | id, nim, nama, angkatan, prodi_id, status (aktif/lulus/cuti/do), jenis (reguler/transfer) | 2a |
| `master_mata_kuliah` | id, kode_mk, nama_mk, sks_teori, sks_praktek, semester, jenis (wajib/pilihan), prodi_id | 5a |

**Grup C: Kerjasama (Tabel 1)**

| Tabel | Kolom Utama | Ref Sheet |
|---|---|---|
| `trx_kerjasama` | id, lembaga_mitra, tingkat (internasional/nasional/lokal), jenis (pendidikan/penelitian/pkm), judul_kegiatan, manfaat, waktu_durasi, bukti, prodi_id | 1-1, 1-2, 1-3 |

**Grup D: Mahasiswa (Tabel 2)**

| Tabel | Kolom Utama | Ref Sheet |
|---|---|---|
| `trx_seleksi_mahasiswa` | id, tahun_akademik, daya_tampung, pendaftar, lulus_seleksi, maba_reguler, maba_transfer, prodi_id | 2a |
| `trx_mahasiswa_asing` | id, tahun_akademik, jml_mhs_asing_fulltime, jml_mhs_asing_parttime, prodi_id | 2b |

**Grup E: Dosen (Tabel 3)**

| Tabel | Kolom Utama | Ref Sheet |
|---|---|---|
| `trx_dosen_mk` | id, dosen_id, mk_id, semester, tahun_akademik | 3a1 col 12 |
| `trx_dosen_bimbingan` | id, dosen_id, tahun_akademik, jml_bimbingan_ps, jml_bimbingan_ps_lain, prodi_id | 3a2 |
| `trx_ewmp` | id, dosen_id, tahun_akademik, sks_pendidikan_ps, sks_pendidikan_luar_ps, sks_penelitian, sks_pkm, sks_tugas_tambahan, prodi_id | 3a3 |
| `trx_rekognisi_dosen` | id, dosen_id, bidang_keahlian, rekognisi, bukti, prodi_id | 3b1 |
| `trx_penelitian_dtps` | id, sumber_pembiayaan (pt_mandiri/dalam_negeri/luar_negeri), tahun, jumlah_judul, dana, prodi_id | 3b2, 3b3 |
| `trx_pkm_dtps` | id, sumber_pembiayaan, tahun, jumlah_judul, dana, prodi_id | 3b3 |
| `trx_publikasi_dtps` | id, jenis (jurnal_tidak_terakreditasi/jurnal_nasional_terakreditasi/jurnal_internasional/jurnal_internasional_bereputasi/seminar_wilayah/seminar_nasional/seminar_internasional/tulisan_media_wilayah/tulisan_media_nasional/tulisan_media_internasional), tahun, jumlah_judul, prodi_id | 3b4 |
| `trx_hki_buku_dtps` | id, dosen_id, judul, jenis (buku_isbn/book_chapter/hki_paten/hki_hak_cipta/teknologi_tepat_guna), tahun, keterangan, prodi_id | 3b5 |
| `trx_sitasi_dtps` | id, dosen_id, judul_artikel, jurnal_vol_tahun_hal, jumlah_sitasi, prodi_id | 3b6 |

**Grup F: Kurikulum (Tabel 5)**

| Tabel | Kolom Utama | Ref Sheet |
|---|---|---|
| `trx_kurikulum` | id, mk_id, capaian_pembelajaran, metode_pembelajaran, bentuk_integrasi_penelitian, prodi_id | 5a, 5b, 5c |

**Grup G: Luaran & Capaian (Tabel 6, 8)**

| Tabel | Kolom Utama | Ref Sheet |
|---|---|---|
| `trx_penelitian_mahasiswa` | id, judul, mahasiswa_id, dosen_pembimbing_id, tahun, prodi_id | 6a |
| `trx_ipk_lulusan` | id, tahun_lulus, jml_lulusan, ipk_min, ipk_max, ipk_rata, prodi_id | 8a |
| `trx_prestasi_mahasiswa` | id, nama_kegiatan, mahasiswa_id, tingkat (internasional/nasional/lokal), prestasi, tahun, prodi_id | 8b |
| `trx_masa_studi` | id, tahun_lulus, jml_lulusan, masa_studi_min, masa_studi_max, masa_studi_rata, prodi_id | 8c |
| `trx_waktu_tunggu` | id, tahun_lulus, jml_lulusan, jml_terlacak, wt_kurang_3bln, wt_3_6bln, wt_lebih_6bln, prodi_id | 8d |
| `trx_tempat_kerja` | id, tahun_lulus, jml_lokal, jml_nasional, jml_multinasional, prodi_id | 8e1 |
| `trx_kepuasan_pengguna` | id, jenis_kemampuan (etika/keahlian/bahasa_asing/komunikasi/teknologi_informasi/kerjasama/pengembangan_diri), tingkat_kepuasan_persen, rencana_tindak_lanjut, prodi_id | 8e2 |
| `trx_luaran_mahasiswa` | id, jenis (publikasi_ilmiah/hki_paten/hki_hak_cipta/teknologi_tepat_guna/buku_isbn), judul, tahun, mahasiswa_id, tingkat, prodi_id | 8f |

**Seeder**: Insert admin `admin`/`admin` + data `setup_tabel_borang` (48 entri rule engine per jenjang).

---

### Fase 5: Layout & Views System (Navbar, Mobile-First)

#### [NEW] [views/layout/header.php](file:///c:/laragon/www/akre/application/views/layout/header.php)
**Top Navbar** (tanpa sidebar) dengan Bootstrap 5:
- Brand: "AKRE — Sistem Akreditasi"
- Hamburger menu (mobile)
- Dropdown menus:
  - 📊 Dashboard
  - 🏫 Identitas (Profil Pengusul)
  - 📋 Data Master → Dosen | Mahasiswa | Mata Kuliah
  - 🤝 Kerjasama (Tabel 1)
  - 👥 Kemahasiswaan → Seleksi (2a) | Mhs Asing (2b)
  - 👨‍🏫 Dosen & SDM → EWMP (3a3) | Rekognisi (3b1) | Penelitian DTPS (3b2) | PkM (3b3) | Publikasi (3b4) | HKI & Buku (3b5) | Sitasi (3b6)
  - 📈 Luaran → IPK (8a) | Prestasi (8b) | Masa Studi (8c) | Waktu Tunggu (8d) | Tempat Kerja (8e) | Kepuasan (8e2) | Luaran Mhs (8f)
  - ⚙️ Pengaturan → Setup Borang
- User info + logout button (kanan)

#### [NEW] [views/layout/footer.php](file:///c:/laragon/www/akre/application/views/layout/footer.php)
- Load local JS, slot page-specific scripts

#### [NEW] [assets/css/custom_admin.css](file:///c:/laragon/www/akre/assets/css/custom_admin.css)
- Mobile-first: base styles mobile, `@media (min-width: 768px)` dan `@media (min-width: 992px)` untuk tablet/desktop
- Dark navbar theme, card styling, responsive tables, form styling

---

### Fase 6: Controllers, Models & Views (CRUD Skeleton)

#### Controllers:

| File | Methods |
|---|---|
| [NEW] `Dashboard.php` | `index()` — widget ringkasan utama |
| [NEW] `Identitas.php` | `index()`, `update()` — profil pengusul |
| [NEW] `Master_data.php` | `dosen()`, `mahasiswa()`, `matakuliah()` + CRUD per entity |
| [NEW] `Kerjasama.php` | `index()`, `create()`, `store()`, `edit()`, `update()`, `delete()` |
| [NEW] `Kemahasiswaan.php` | `seleksi()`, `mhs_asing()` + CRUD |
| [NEW] `Sumber_daya.php` | `ewmp()`, `rekognisi()`, `penelitian()`, `pkm()`, `publikasi()`, `hki()`, `sitasi()` + CRUD |
| [NEW] `Luaran.php` | `ipk()`, `prestasi()`, `masa_studi()`, `waktu_tunggu()`, `tempat_kerja()`, `kepuasan()`, `luaran_mhs()` + CRUD |
| [NEW] `Setup.php` | `borang()` — kelola setup_tabel_borang |

#### Models:

| File | Methods |
|---|---|
| [NEW] `Identitas_model.php` | get/update profil pengusul |
| [NEW] `Master_model.php` | CRUD dosen, mahasiswa, matakuliah |
| [NEW] `Kerjasama_model.php` | CRUD kerjasama tridharma |
| [NEW] `Kemahasiswaan_model.php` | CRUD seleksi, mhs asing |
| [NEW] `Sumber_daya_model.php` | CRUD EWMP, rekognisi, penelitian, pkm, publikasi, hki, sitasi |
| [NEW] `Luaran_model.php` | CRUD IPK, prestasi, masa studi, waktu tunggu, tempat kerja, kepuasan, luaran mhs |
| [NEW] `Borang_setup_model.php` | CRUD setup + `get_by_jenjang()`, `is_wajib()` |
| [NEW] `Dashboard_model.php` | Aggregate queries untuk widget dashboard |

#### Views (per controller, pola: `list` + `form`):

| Path | Content |
|---|---|
| `views/dashboard/index.php` | Widget cards + placeholder chart |
| `views/identitas/index.php` | Form profil pengusul (read/edit) |
| `views/master/dosen_*.php` | List + Form dosen |
| `views/master/mahasiswa_*.php` | List + Form mahasiswa |
| `views/master/matakuliah_*.php` | List + Form mata kuliah |
| `views/kerjasama/*.php` | List + Form kerjasama (3 tab: Pendidikan/Penelitian/PkM) |
| `views/kemahasiswaan/*.php` | Form seleksi + mhs asing (per tahun) |
| `views/sumber_daya/*.php` | List + Form per sub-tabel (ewmp, rekognisi, dll) |
| `views/luaran/*.php` | List + Form per sub-tabel (ipk, prestasi, dll) |
| `views/setup/borang_*.php` | List + Form setup borang |

---

## Verification Plan

### Automated Tests (via Browser)
1. `http://localhost/akre/` → redirect ke login
2. Login `admin`/`admin` → masuk dashboard
3. Akses tanpa login → redirect ke login
4. Semua tabel created di database `aps`
5. Asset CSS/JS load tanpa 404

### Manual Verification
- Navbar dropdown di desktop & hamburger di mobile (375px)
- CRUD test pada Master Dosen
- Tampilan mobile-first validation
