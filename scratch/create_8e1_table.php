<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Buat tabel ringkasan tempat kerja (8.e.1)
$mysqli->query("CREATE TABLE IF NOT EXISTS trx_tempat_kerja_summary (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tahun_lulus VARCHAR(10),
    jml_lulusan INT DEFAULT 0,
    jml_terlacak INT DEFAULT 0,
    tk_lokal INT DEFAULT 0,
    tk_nasional INT DEFAULT 0,
    tk_internasional INT DEFAULT 0,
    prodi_id INT DEFAULT 1
)");

echo "Table trx_tempat_kerja_summary (8.e.1) is ready.\n";
