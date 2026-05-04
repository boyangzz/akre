# AKRE — Entity Relationship Diagram (ERD)

> Database Schema untuk **Sistem Manajemen Akreditasi BAN-PT (Tahap 2)**
> Database: `aps` | Engine: InnoDB | Charset: utf8mb4

---

## ERD Overview

```mermaid
erDiagram
    admin_users {
        int id PK
        varchar username UK
        varchar password
        varchar nama_lengkap
        enum role
        timestamp created_at
        timestamp updated_at
    }

    setup_tabel_borang {
        int id PK
        varchar kode_tabel UK
        varchar nama_tabel
        enum kategori
        json jenjang_filter
        tinyint is_wajib
        int urutan
        json kolom_config
        text deskripsi
        timestamp created_at
        timestamp updated_at
    }

    identitas_pengusul {
        int id PK
        varchar nama_pt
        varchar nama_fakultas
        varchar nama_prodi
        enum jenjang
        varchar alamat
        varchar telepon
        varchar email
        varchar website
        varchar no_sk_banpt
        varchar peringkat_akreditasi
        date tanggal_kadaluarsa
        varchar kaprodi_nama
        varchar kaprodi_nidn
        timestamp created_at
        timestamp updated_at
    }

    master_dosen {
        int id PK
        varchar nidn UK
        varchar nama
        enum pendidikan_pasca
        varchar bidang_keahlian
        tinyint kesesuaian_kompetensi
        enum jabatan_akademik
        tinyint sertifikat_pendidik
        varchar sertifikat_kompetensi
        int prodi_id FK
        enum status_ikatan
        tinyint status_aktif
        timestamp created_at
        timestamp updated_at
    }

    master_mahasiswa {
        int id PK
        varchar nim UK
        varchar nama
        year angkatan
        int prodi_id FK
        enum status
        enum jenis
        timestamp created_at
        timestamp updated_at
    }

    master_mata_kuliah {
        int id PK
        varchar kode_mk UK
        varchar nama_mk
        int sks_teori
        int sks_praktek
        int semester
        enum jenis_mk
        int prodi_id FK
        timestamp created_at
        timestamp updated_at
    }

    identitas_pengusul ||--o{ master_dosen : "prodi_id"
    identitas_pengusul ||--o{ master_mahasiswa : "prodi_id"
    identitas_pengusul ||--o{ master_mata_kuliah : "prodi_id"
```

---

## Grup A: Admin & Konfigurasi

```mermaid
erDiagram
    admin_users {
        int id PK "AUTO_INCREMENT"
        varchar username UK "NOT NULL, max 50"
        varchar password "NOT NULL, bcrypt hash"
        varchar nama_lengkap "NOT NULL, max 100"
        enum role "admin, operator"
        timestamp created_at "DEFAULT CURRENT_TIMESTAMP"
        timestamp updated_at "ON UPDATE CURRENT_TIMESTAMP"
    }

    setup_tabel_borang {
        int id PK "AUTO_INCREMENT"
        varchar kode_tabel UK "NOT NULL, max 10 (e.g. 2b, 3a1)"
        varchar nama_tabel "NOT NULL, max 200"
        enum kategori "identitas|master|kerjasama|mahasiswa|dosen|kurikulum|luaran|keuangan"
        json jenjang_filter "NOT NULL, e.g. ['D3','S1','STr']"
        tinyint is_wajib "DEFAULT 1"
        int urutan "DEFAULT 0, untuk sorting menu"
        json kolom_config "NULL, variasi kolom per jenjang"
        text deskripsi "NULL"
        timestamp created_at "DEFAULT CURRENT_TIMESTAMP"
        timestamp updated_at "ON UPDATE CURRENT_TIMESTAMP"
    }
```

---

## Grup B: Identitas & Master

```mermaid
erDiagram
    identitas_pengusul {
        int id PK "AUTO_INCREMENT"
        varchar nama_pt "max 200"
        varchar nama_fakultas "max 200"
        varchar nama_prodi "max 200"
        enum jenjang "D3|STr|S1|S2|S2T|S3|S3T"
        varchar alamat "max 500"
        varchar telepon "max 20"
        varchar email "max 100"
        varchar website "max 200"
        varchar no_sk_banpt "max 50"
        varchar peringkat_akreditasi "max 20"
        date tanggal_kadaluarsa
        varchar kaprodi_nama "max 100"
        varchar kaprodi_nidn "max 20"
        timestamp created_at
        timestamp updated_at
    }

    master_dosen {
        int id PK "AUTO_INCREMENT"
        varchar nidn UK "max 20"
        varchar nama "max 150"
        enum pendidikan_pasca "S2|S3"
        varchar bidang_keahlian "max 200"
        tinyint kesesuaian_kompetensi "0=tidak, 1=ya"
        enum jabatan_akademik "Tenaga Pengajar|Asisten Ahli|Lektor|Lektor Kepala|Guru Besar"
        tinyint sertifikat_pendidik "0|1"
        varchar sertifikat_kompetensi "max 200, NULL"
        int prodi_id FK "-> identitas_pengusul.id"
        enum status_ikatan "tetap|tidak_tetap|industri"
        tinyint status_aktif "DEFAULT 1"
        timestamp created_at
        timestamp updated_at
    }

    master_mahasiswa {
        int id PK "AUTO_INCREMENT"
        varchar nim UK "max 20"
        varchar nama "max 150"
        year angkatan
        int prodi_id FK "-> identitas_pengusul.id"
        enum status "aktif|lulus|cuti|do|transfer"
        enum jenis "reguler|transfer"
        timestamp created_at
        timestamp updated_at
    }

    master_mata_kuliah {
        int id PK "AUTO_INCREMENT"
        varchar kode_mk UK "max 20"
        varchar nama_mk "max 200"
        int sks_teori "DEFAULT 0"
        int sks_praktek "DEFAULT 0"
        int semester
        enum jenis_mk "wajib|pilihan"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    identitas_pengusul ||--o{ master_dosen : "has many"
    identitas_pengusul ||--o{ master_mahasiswa : "has many"
    identitas_pengusul ||--o{ master_mata_kuliah : "has many"
```

---

## Grup C: Kerjasama Tridharma (Tabel 1)

```mermaid
erDiagram
    trx_kerjasama {
        int id PK "AUTO_INCREMENT"
        enum jenis_kerjasama "pendidikan|penelitian|pkm"
        varchar lembaga_mitra "max 200"
        enum tingkat "internasional|nasional|lokal"
        varchar judul_kegiatan "max 300"
        text manfaat
        varchar waktu_durasi "max 100"
        varchar bukti "max 500, path/URL"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    identitas_pengusul ||--o{ trx_kerjasama : "has many"
```

---

## Grup D: Kemahasiswaan (Tabel 2)

```mermaid
erDiagram
    trx_seleksi_mahasiswa {
        int id PK "AUTO_INCREMENT"
        varchar tahun_akademik "max 10, e.g. 2023/2024"
        int daya_tampung
        int pendaftar
        int lulus_seleksi
        int maba_reguler
        int maba_transfer "DEFAULT 0"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_mahasiswa_asing {
        int id PK "AUTO_INCREMENT"
        varchar tahun_akademik "max 10"
        int jml_fulltime "DEFAULT 0"
        int jml_parttime "DEFAULT 0"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    identitas_pengusul ||--o{ trx_seleksi_mahasiswa : "has many"
    identitas_pengusul ||--o{ trx_mahasiswa_asing : "has many"
```

---

## Grup E: Dosen & SDM (Tabel 3)

```mermaid
erDiagram
    trx_dosen_mk {
        int id PK "AUTO_INCREMENT"
        int dosen_id FK "-> master_dosen.id"
        int mk_id FK "-> master_mata_kuliah.id"
        varchar tahun_akademik "max 10"
        int semester
        timestamp created_at
    }

    trx_dosen_bimbingan {
        int id PK "AUTO_INCREMENT"
        int dosen_id FK "-> master_dosen.id"
        varchar tahun_akademik "max 10"
        int jml_bimbingan_ps "bimbingan di PS yg diakreditasi"
        int jml_bimbingan_ps_lain "bimbingan di PS lain"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_ewmp {
        int id PK "AUTO_INCREMENT"
        int dosen_id FK "-> master_dosen.id"
        varchar tahun_akademik "max 10"
        decimal sks_pendidikan_ps "10,2"
        decimal sks_pendidikan_luar "10,2"
        decimal sks_penelitian "10,2"
        decimal sks_pkm "10,2"
        decimal sks_tugas_tambahan "10,2"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_rekognisi_dosen {
        int id PK "AUTO_INCREMENT"
        int dosen_id FK "-> master_dosen.id"
        varchar bidang_keahlian "max 200"
        text rekognisi "deskripsi pengakuan"
        varchar bukti "max 500"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_penelitian_dtps {
        int id PK "AUTO_INCREMENT"
        enum sumber "pt_mandiri|dalam_negeri|luar_negeri"
        varchar tahun_akademik "max 10"
        int jumlah_judul
        decimal dana "15,2"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_pkm_dtps {
        int id PK "AUTO_INCREMENT"
        enum sumber "pt_mandiri|dalam_negeri|luar_negeri"
        varchar tahun_akademik "max 10"
        int jumlah_judul
        decimal dana "15,2"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_publikasi_dtps {
        int id PK "AUTO_INCREMENT"
        enum jenis "jurnal_tidak_terakreditasi|jurnal_nasional_terakreditasi|jurnal_internasional|jurnal_internasional_bereputasi|seminar_wilayah|seminar_nasional|seminar_internasional|tulisan_media_wilayah|tulisan_media_nasional|tulisan_media_internasional|pagelaran_wilayah|pagelaran_nasional|pagelaran_internasional"
        varchar tahun_akademik "max 10"
        int jumlah_judul
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_hki_buku_dtps {
        int id PK "AUTO_INCREMENT"
        int dosen_id FK "-> master_dosen.id"
        varchar judul "max 300"
        enum jenis "buku_isbn|book_chapter|hki_paten|hki_paten_sederhana|hki_hak_cipta|hki_desain_produk|hki_varietas_tanaman|teknologi_tepat_guna|produk_terstandarisasi|produk_tersertifikasi"
        year tahun
        varchar keterangan "max 300"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_sitasi_dtps {
        int id PK "AUTO_INCREMENT"
        int dosen_id FK "-> master_dosen.id"
        varchar judul_artikel "max 300"
        varchar jurnal_vol_tahun_hal "max 300"
        int jumlah_sitasi
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    master_dosen ||--o{ trx_dosen_mk : "mengajar"
    master_mata_kuliah ||--o{ trx_dosen_mk : "diampu oleh"
    master_dosen ||--o{ trx_dosen_bimbingan : "membimbing"
    master_dosen ||--o{ trx_ewmp : "EWMP"
    master_dosen ||--o{ trx_rekognisi_dosen : "diakui"
    master_dosen ||--o{ trx_hki_buku_dtps : "menulis"
    master_dosen ||--o{ trx_sitasi_dtps : "disitasi"
    identitas_pengusul ||--o{ trx_penelitian_dtps : "has many"
    identitas_pengusul ||--o{ trx_pkm_dtps : "has many"
    identitas_pengusul ||--o{ trx_publikasi_dtps : "has many"
```

---

## Grup F: Kurikulum & PkM (Tabel 4-7)

```mermaid
erDiagram
    trx_kurikulum {
        int id PK "AUTO_INCREMENT"
        int mk_id FK "-> master_mata_kuliah.id"
        text capaian_pembelajaran
        text metode_pembelajaran
        text bentuk_integrasi_penelitian "integrasi litabmas"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_penelitian_mhs {
        int id PK "AUTO_INCREMENT"
        varchar judul "max 300"
        int mahasiswa_id FK "-> master_mahasiswa.id"
        int dosen_id FK "-> master_dosen.id"
        year tahun
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_pkm_mhs {
        int id PK "AUTO_INCREMENT"
        varchar judul "max 300"
        int mahasiswa_id FK "-> master_mahasiswa.id, NULL"
        int dosen_id FK "-> master_dosen.id"
        year tahun
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    master_mata_kuliah ||--o{ trx_kurikulum : "has"
    master_mahasiswa ||--o{ trx_penelitian_mhs : "meneliti"
    master_dosen ||--o{ trx_penelitian_mhs : "membimbing"
    master_mahasiswa ||--o{ trx_pkm_mhs : "melaksanakan"
    master_dosen ||--o{ trx_pkm_mhs : "membimbing"
```

---

## Grup G: Luaran & Capaian (Tabel 8)

```mermaid
erDiagram
    trx_ipk_lulusan {
        int id PK "AUTO_INCREMENT"
        year tahun_lulus
        int jml_lulusan
        decimal ipk_min "4,2"
        decimal ipk_max "4,2"
        decimal ipk_rata "4,2"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_prestasi_mhs {
        int id PK "AUTO_INCREMENT"
        varchar nama_kegiatan "max 300"
        int mahasiswa_id FK "-> master_mahasiswa.id"
        enum tingkat "internasional|nasional|wilayah"
        varchar prestasi "max 200, e.g. Juara 1"
        year tahun
        enum jenis_prestasi "akademik|non_akademik"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_masa_studi {
        int id PK "AUTO_INCREMENT"
        year tahun_masuk
        int jml_mhs_diterima
        int jml_lulus_akhir_ts
        int jml_lulus_akhir_ts_plus1
        int jml_lulus_akhir_ts_plus2
        int jml_lulus_akhir_ts_plus3
        int jml_lulus_akhir_ts_plus4
        int jml_lulus_akhir_ts_plus5
        int jml_lulus_akhir_ts_plus6
        decimal rata_rata_masa_studi "5,2 semester"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_waktu_tunggu {
        int id PK "AUTO_INCREMENT"
        year tahun_lulus
        int jml_lulusan
        int jml_terlacak
        int wt_kurang_3bln
        int wt_3_sd_6bln
        int wt_lebih_6bln
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_tempat_kerja {
        int id PK "AUTO_INCREMENT"
        year tahun_lulus
        int jml_lokal "lokal/wirausaha tidak berbadan hukum"
        int jml_nasional "nasional/wirausaha berbadan hukum"
        int jml_multinasional "multinasional/internasional"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_kepuasan_pengguna {
        int id PK "AUTO_INCREMENT"
        enum jenis_kemampuan "etika|keahlian|bahasa_asing|komunikasi|teknologi_informasi|kerjasama|pengembangan_diri"
        decimal persen_sangat_baik "5,2"
        decimal persen_baik "5,2"
        decimal persen_cukup "5,2"
        decimal persen_kurang "5,2"
        text rencana_tindak_lanjut
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    trx_luaran_mhs {
        int id PK "AUTO_INCREMENT"
        int mahasiswa_id FK "-> master_mahasiswa.id"
        enum jenis "publikasi_jurnal|publikasi_seminar|buku_isbn|book_chapter|hki_paten|hki_paten_sederhana|hki_hak_cipta|hki_desain_produk|hki_varietas_tanaman|teknologi_tepat_guna|produk_terstandarisasi|produk_tersertifikasi|pagelaran_wilayah|pagelaran_nasional|pagelaran_internasional"
        varchar judul "max 300"
        year tahun
        varchar keterangan "max 300"
        int prodi_id FK "-> identitas_pengusul.id"
        timestamp created_at
        timestamp updated_at
    }

    master_mahasiswa ||--o{ trx_prestasi_mhs : "berprestasi"
    master_mahasiswa ||--o{ trx_luaran_mhs : "menghasilkan"
    identitas_pengusul ||--o{ trx_ipk_lulusan : "has many"
    identitas_pengusul ||--o{ trx_masa_studi : "has many"
    identitas_pengusul ||--o{ trx_waktu_tunggu : "has many"
    identitas_pengusul ||--o{ trx_tempat_kerja : "has many"
    identitas_pengusul ||--o{ trx_kepuasan_pengguna : "has many"
```

---

## Ringkasan Relasi Antar Tabel

```mermaid
graph LR
    IP["identitas_pengusul<br/>(Prodi)"] --> MD["master_dosen"]
    IP --> MM["master_mahasiswa"]
    IP --> MK["master_mata_kuliah"]

    MD --> DMK["trx_dosen_mk"]
    MK --> DMK
    MD --> DB["trx_dosen_bimbingan"]
    MD --> EW["trx_ewmp"]
    MD --> RK["trx_rekognisi_dosen"]
    MD --> HKI["trx_hki_buku_dtps"]
    MD --> SIT["trx_sitasi_dtps"]
    MD --> PM["trx_penelitian_mhs"]

    MM --> PR["trx_prestasi_mhs"]
    MM --> LM["trx_luaran_mhs"]
    MM --> PM

    IP --> KJ["trx_kerjasama"]
    IP --> SM["trx_seleksi_mahasiswa"]
    IP --> MA["trx_mahasiswa_asing"]
    IP --> PD["trx_penelitian_dtps"]
    IP --> PK["trx_pkm_dtps"]
    IP --> PB["trx_publikasi_dtps"]
    IP --> IPK["trx_ipk_lulusan"]
    IP --> MS["trx_masa_studi"]
    IP --> WT["trx_waktu_tunggu"]
    IP --> TK["trx_tempat_kerja"]
    IP --> KP["trx_kepuasan_pengguna"]

    MK --> KUR["trx_kurikulum"]

    STB["setup_tabel_borang<br/>(Rule Engine)"] -.->|jenjang_filter| IP
```

---

## Statistik Database

| Kategori | Jumlah Tabel | Tabel |
|---|---|---|
| Admin & Config | 2 | `admin_users`, `setup_tabel_borang` |
| Identitas & Master | 4 | `identitas_pengusul`, `master_dosen`, `master_mahasiswa`, `master_mata_kuliah` |
| Kerjasama | 1 | `trx_kerjasama` |
| Kemahasiswaan | 2 | `trx_seleksi_mahasiswa`, `trx_mahasiswa_asing` |
| Dosen & SDM | 8 | `trx_dosen_mk`, `trx_dosen_bimbingan`, `trx_ewmp`, `trx_rekognisi_dosen`, `trx_penelitian_dtps`, `trx_pkm_dtps`, `trx_publikasi_dtps`, `trx_hki_buku_dtps`, `trx_sitasi_dtps` |
| Kurikulum & PkM | 3 | `trx_kurikulum`, `trx_penelitian_mhs`, `trx_pkm_mhs` |
| Luaran & Capaian | 7 | `trx_ipk_lulusan`, `trx_prestasi_mhs`, `trx_masa_studi`, `trx_waktu_tunggu`, `trx_tempat_kerja`, `trx_kepuasan_pengguna`, `trx_luaran_mhs` |
| **Total** | **28** | |
