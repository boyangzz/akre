# AKRE — Sistem Manajemen Akreditasi IAPS 4.0 (BAN-PT)

[![Status](https://img.shields.io/badge/Audit-100%25%20Completed-success)](https://github.com/boyangzz/akre)
[![Version](https://img.shields.io/badge/Version-4.0--Standard-blue)](https://github.com/boyangzz/akre)
[![Framework](https://img.shields.io/badge/Framework-CodeIgniter%203-orange)](https://codeigniter.com/)

**AKRE** adalah platform manajemen data akreditasi program studi yang dirancang khusus untuk memenuhi standar **Instrumen Akreditasi Program Studi (IAPS 4.0)** BAN-PT. Sistem ini membantu Program Studi dalam mengumpulkan, mengelola, dan mensimulasikan nilai akreditasi secara real-time.

---

## 🚀 Fitur Unggulan

### 1. **Smart Table Engine (Kriteria 5-8)**
Seluruh tabel kuantitatif telah distandarisasi menggunakan arsitektur Smart Table:
- **Bulk Processing**: Penyimpanan data massal secara atomik.
- **Auto-Calculations**: Perhitungan total baris/kolom dan rata-rata secara real-time via Vanilla JS.
- **Jenjang Aware**: Sistem otomatis menyesuaikan label kategori antara Program **Akademik** dan **Terapan/Vokasi**.

### 2. **Accreditation Simulation Engine**
Mesin kalkulasi skor yang dipetakan langsung ke **PerBAN-PT No. 5 Tahun 2019**:
- **Dual Perspective**: Perbandingan antara skor objektif Sistem vs skor subjektif Asesor.
- **Syarat Perlu Monitoring**: Deteksi dini status "Terancam Tidak Terakreditasi" berdasarkan indikator kritis (SDM, SPMI, Kurikulum).
- **Rank Prediction**: Prediksi peringkat (Unggul, Baik Sekali, Baik) secara instan.

### 3. **Quality Control Dashboard**
Dashboard audit terpadu untuk memonitor status pengisian data di 40+ sheet instrumen BAN-PT.

---

## 🛠️ Tech Stack
- **Backend**: PHP 7.4+ (CodeIgniter 3)
- **Frontend**: Bootstrap 5, jQuery, Vanilla JS
- **Database**: MySQL 8.x
- **Zero-CDN Policy**: Seluruh aset (CSS/JS/Icons) disimpan secara lokal untuk keamanan dan kecepatan.

---

## 📥 Instalasi
1. Clone repository ke direktori web server Anda.
2. Import database terbaru dari `database/aps_audit_final.sql`.
3. Konfigurasi `application/config/database.php`.
4. Akses sistem melalui browser.

**Login Default:**
- **Username**: `admin`
- **Password**: `admin`

---

## 📑 Referensi Matriks Penilaian
Sistem ini mengacu pada:
- **Lampiran 6a-6d PerBAN-PT No. 5 Th 2019** (Matriks Penilaian IAPS S1 & D3).

---
*Developed with ❤️ for Academic Excellence.*
