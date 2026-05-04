# AKRE — Project Scaffolding Implementation Plan (v4 — Final)

> Scaffolding lengkap proyek **Sistem Manajemen Akreditasi BAN-PT (Tahap 2)** di atas CodeIgniter 3, dengan **validasi lengkap persyaratan jenjang** berdasarkan Sheet Pengusul APS 4.0.

---

## Matriks Kewajiban Tabel per Jenjang

Berikut hasil analisis dari sheet Excel dan lampiran PerBAN-PT. **✓** = wajib diisi, **—** = tidak berlaku.

| Kode | Nama Tabel | D3 | D4 | S1 | S2 | S2T | S3 | S3T |
|---|---|---|---|---|---|---|---|---|
| 1-1 | Kerjasama Pendidikan | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 1-2 | Kerjasama Penelitian | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 1-3 | Kerjasama PkM | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 2a | Seleksi Mahasiswa Baru | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 2b | Mahasiswa Asing | — | — | ✓ | ✓ | ✓ | ✓ | ✓ |
| 3a1 | Dosen Tetap PT | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 3a2 | Dosen Pembimbing TA | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 3a3 | EWMP Dosen Tetap | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 3a4 | Dosen Tidak Tetap | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 3a5 | Dosen Industri/Praktisi | ✓ | ✓ | — | — | — | — | — |
| 3b1 | Rekognisi Dosen | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 3b2 | Penelitian DTPS | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 3b3 | PkM DTPS | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 3b4 | Publikasi Ilmiah DTPS (Akademik) | — | — | ✓ | ✓ | — | ✓ | — |
| 3b4-t | Publikasi Ilmiah DTPS (Terapan) | ✓ | ✓ | — | — | ✓ | — | ✓ |
| 3b5 | HKI, Buku, Book Chapter DTPS | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 3b6 | Sitasi DTPS | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 3b7 | Luaran Penelitian/PkM DTPS | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 4 | Keuangan, Sarana Prasarana | ✓ | ✓ | — | — | ✓ | — | ✓ |
| 5a | Kurikulum | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 5b | Integrasi Penelitian/PkM Pembelajaran | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 5c | Kepuasan Mahasiswa Pembelajaran | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 6a | Penelitian DTPS Melibatkan Mhs | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 6b | Penelitian DTPS Rujukan Tesis/Disertasi | — | — | — | ✓ | ✓ | ✓ | ✓ |
| 7 | Pengabdian kepada Masyarakat | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 8a | IPK Lulusan | — | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 8b1 | Prestasi Akademik Mahasiswa | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 8b2 | Prestasi Non-akademik Mahasiswa | ✓ | ✓ | ✓ | — | — | — | — |
| 8c | Masa Studi Lulusan | ✓ | ✓ | ✓ | — | — | — | — |
| 8d1 | Waktu Tunggu Lulusan | — | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 8d2 | Kesesuaian Bidang Kerja | — | — | — | — | — | ✓ | ✓ |
| 8e1 | Tempat Kerja Lulusan | — | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 8e2 | Kepuasan Pengguna Lulusan | ✓ | ✓ | ✓ | ✓ | ✓ | — | — |
| 8f1 | Publikasi Ilmiah Mahasiswa | — | — | ✓ | ✓ | — | ✓ | — |
| 8f1-t | Publikasi Ilmiah Mahasiswa (Terapan) | ✓ | ✓ | — | — | ✓ | — | ✓ |
| 8f2 | Karya Ilmiah Mhs yang Disitasi | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 8f3 | Luaran Mhs - Buku/Book Chapter | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| 8f4 | Luaran Mhs - HKI/Teknologi/Produk | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |

> **Keterangan**: D4 = Sarjana Terapan, S2T = Magister Terapan, S3T = Doktor Terapan.

---

## Proposed Changes

Dibagi menjadi **6 fase**:

---

### Fase 1: Project Configuration

#### [MODIFY] [config.php](file:///c:/laragon/www/akre/application/config/config.php)
- `base_url` → `http://localhost/akre/`
- `index_page` → `''`
- `encryption_key` → random 32-char key
- `sess_save_path` → `sys_get_temp_dir()`

#### [MODIFY] [database.php](file:///c:/laragon/www/akre/application/config/database.php)
- `localhost`, `root`, `''`, `aps`

#### [MODIFY] [autoload.php](file:///c:/laragon/www/akre/application/config/autoload.php)
- `libraries` → `['database', 'session']`
- `helper` → `['url', 'form']`

#### [MODIFY] [routes.php](file:///c:/laragon/www/akre/application/config/routes.php)
- `default_controller` → `'auth/login'`

#### [NEW] [.htaccess](file:///c:/laragon/www/akre/.htaccess)
Apache URL rewriting

---

### Fase 2: Asset Download (Zero-CDN)

| File | Source |
|---|---|
| `css/bootstrap.min.css` | Bootstrap 5.3.8 |
| `css/bootstrap-icons.min.css` | Bootstrap Icons 1.11.3 |
| `css/custom_admin.css` | Custom (mobile-first) |
| `js/jquery.min.js` | jQuery 3.7.1 |
| `js/bootstrap.bundle.min.js` | Bootstrap 5.3.8 |
| `js/dynamic_borang.js` | Custom (jenjang hide/show) |
| `fonts/bootstrap-icons.woff2` | Icon font |
| `fonts/bootstrap-icons.woff` | Icon font fallback |

---

### Fase 3: Authentication System

#### [NEW] [MY_Controller.php](file:///c:/laragon/www/akre/application/core/MY_Controller.php)
- `MY_Controller` → auth check + layout data
- `Public_Controller` → tanpa auth (login page)

#### [NEW] [Auth.php](file:///c:/laragon/www/akre/application/controllers/Auth.php)
- `login()` / `logout()` — admin/admin (bcrypt)

#### [NEW] [Auth_model.php](file:///c:/laragon/www/akre/application/models/Auth_model.php)

#### [NEW] [views/auth/login.php](file:///c:/laragon/www/akre/application/views/auth/login.php)
- Mobile-first centered card login

---

### Fase 4: Database Schema (with Jenjang Rule Engine)

#### [NEW] [database/aps_schema.sql](file:///c:/laragon/www/akre/database/aps_schema.sql)

**Tabel `setup_tabel_borang`** (Rule Engine):
```sql
CREATE TABLE setup_tabel_borang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_tabel VARCHAR(10) NOT NULL,
    nama_tabel VARCHAR(200) NOT NULL,
    kategori ENUM('identitas','master','kerjasama','mahasiswa','dosen','kurikulum','luaran','keuangan') NOT NULL,
    jenjang_filter JSON NOT NULL COMMENT 'Array jenjang: ["D3","D4","S1","S2","S2T","S3","S3T"]',
    is_wajib TINYINT(1) DEFAULT 1,
    urutan INT DEFAULT 0,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

Seeder akan mengisi **38 baris** sesuai matriks jenjang di atas (misal: kode `2b` → `jenjang_filter: ["S1","S2","S2T","S3","S3T"]` — D3 & D4 **tidak** termasuk).

**Tabel Data** (sama seperti v3, tidak berubah):
- `admin_users`, `identitas_pengusul`
- `master_dosen`, `master_mahasiswa`, `master_mata_kuliah`
- `trx_kerjasama`, `trx_seleksi_mahasiswa`, `trx_mahasiswa_asing`
- `trx_dosen_mk`, `trx_dosen_bimbingan`, `trx_ewmp`
- `trx_rekognisi_dosen`, `trx_penelitian_dtps`, `trx_pkm_dtps`
- `trx_publikasi_dtps`, `trx_hki_buku_dtps`, `trx_sitasi_dtps`
- `trx_kurikulum`, `trx_penelitian_mahasiswa`
- `trx_ipk_lulusan`, `trx_prestasi_mahasiswa`, `trx_masa_studi`
- `trx_waktu_tunggu`, `trx_tempat_kerja`, `trx_kepuasan_pengguna`
- `trx_luaran_mahasiswa`

**Logika di Controller/View**: Saat user memilih jenjang prodi, query `setup_tabel_borang` WHERE `JSON_CONTAINS(jenjang_filter, '"S1"')` → hanya tampilkan menu/form yang berlaku untuk jenjang tersebut.

---

### Fase 5: Layout & Views System (Navbar, Mobile-First)

#### [NEW] [views/layout/header.php](file:///c:/laragon/www/akre/application/views/layout/header.php)
Top Navbar dengan dropdown. Menu **dinamis** berdasarkan jenjang prodi yang dipilih (query `setup_tabel_borang`):
- 📊 Dashboard
- 🏫 Identitas
- 📋 Data Master → Dosen | Mahasiswa | Mata Kuliah
- 🤝 Kerjasama (Tabel 1)
- 👥 Kemahasiswaan → Seleksi (2a) | Mhs Asing (2b)*
- 👨‍🏫 SDM & Dosen → EWMP | Rekognisi | Penelitian | PkM | Publikasi | HKI | Sitasi
- 📈 Luaran → IPK* | Prestasi | Masa Studi* | Waktu Tunggu* | Tempat Kerja* | Kepuasan* | Luaran Mhs
- ⚙️ Pengaturan
> *Item bertanda bintang muncul/hilang berdasarkan jenjang prodi aktif

#### [NEW] [views/layout/footer.php](file:///c:/laragon/www/akre/application/views/layout/footer.php)

#### [NEW] [assets/css/custom_admin.css](file:///c:/laragon/www/akre/assets/css/custom_admin.css)
Mobile-first CSS

---

### Fase 6: Controllers, Models & Views (CRUD Skeleton)

Sama seperti v3 — semua controller, model, dan view dibuat lengkap. Perbedaan: setiap controller melakukan pengecekan jenjang via `Borang_setup_model->is_allowed($kode_tabel, $jenjang)` sebelum menampilkan halaman.

#### Controllers:
| File | Methods |
|---|---|
| `Dashboard.php` | `index()` |
| `Identitas.php` | `index()`, `update()` |
| `Master_data.php` | `dosen()`, `mahasiswa()`, `matakuliah()` + CRUD |
| `Kerjasama.php` | `index()`, CRUD |
| `Kemahasiswaan.php` | `seleksi()`, `mhs_asing()` + CRUD |
| `Sumber_daya.php` | `ewmp()`, `rekognisi()`, `penelitian()`, `pkm()`, `publikasi()`, `hki()`, `sitasi()` + CRUD |
| `Luaran.php` | `ipk()`, `prestasi()`, `masa_studi()`, `waktu_tunggu()`, `tempat_kerja()`, `kepuasan()`, `luaran_mhs()` + CRUD |
| `Setup.php` | `borang()` |

#### Models:
| File | Core Method |
|---|---|
| `Borang_setup_model.php` | `is_allowed($kode, $jenjang)`, `get_menu_by_jenjang($jenjang)` |
| + semua model dari v3 | |

#### Views:
- Semua view list + form dari v3
- Setiap halaman dicek jenjang sebelum render

---

## Verification Plan

### Automated Tests (via Browser)
1. `http://localhost/akre/` → redirect ke login
2. Login `admin`/`admin` → masuk dashboard
3. Auth guard: akses tanpa login → redirect
4. Jenjang test: set prodi D3 → Tabel 2b & 8d1 **tidak muncul** di navbar
5. Jenjang test: set prodi S1 → Tabel 3a5 **tidak muncul**, Tabel 2b **muncul**
6. Asset test: no 404 di console browser

### Manual Verification
- Navbar di desktop & hamburger di mobile (375px)
- CRUD test pada Master Dosen
- Verify jenjang filter bekerja di menu
