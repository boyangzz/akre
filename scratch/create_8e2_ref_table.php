<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Buat tabel referensi kepuasan pengguna (8.e.2)
$mysqli->query("CREATE TABLE IF NOT EXISTS trx_kepuasan_pengguna_ref (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tahun_lulus VARCHAR(10),
    jml_lulusan INT DEFAULT 0,
    jml_tanggapan INT DEFAULT 0,
    prodi_id INT DEFAULT 1
)");

echo "Table trx_kepuasan_pengguna_ref (8.e.2 Reference) is ready.\n";
