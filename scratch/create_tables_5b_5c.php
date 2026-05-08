<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// 1. Tabel Integrasi Penelitian (5b)
$mysqli->query("CREATE TABLE IF NOT EXISTS trx_integrasi_pembelajaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255),
    dosen_id INT,
    matakuliah_id INT,
    bentuk_integrasi TEXT,
    tahun YEAR,
    prodi_id INT DEFAULT 1
)");

// 2. Tabel Kepuasan Mahasiswa (5c)
$mysqli->query("CREATE TABLE IF NOT EXISTS trx_kepuasan_mhs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aspek VARCHAR(255),
    sangat_baik DECIMAL(5,2) DEFAULT 0,
    baik DECIMAL(5,2) DEFAULT 0,
    cukup DECIMAL(5,2) DEFAULT 0,
    kurang DECIMAL(5,2) DEFAULT 0,
    tindak_lanjut TEXT,
    prodi_id INT DEFAULT 1
)");

// Seed data kepuasan jika kosong
$check = $mysqli->query("SELECT id FROM trx_kepuasan_mhs");
if ($check->num_rows == 0) {
    $aspeks = [
        "Keandalan (reliability)",
        "Daya tanggap (responsiveness)",
        "Kepastian (assurance)",
        "Empati (empathy)",
        "Tangible"
    ];
    foreach ($aspeks as $a) {
        $mysqli->query("INSERT INTO trx_kepuasan_mhs (aspek) VALUES ('$a')");
    }
}

echo "Tables for 5b and 5c are ready.\n";
