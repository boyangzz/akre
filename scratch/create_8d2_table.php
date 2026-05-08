<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Buat tabel ringkasan kesesuaian bidang (8.d.2)
$mysqli->query("CREATE TABLE IF NOT EXISTS trx_kesesuaian_bidang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tahun_lulus VARCHAR(10),
    jml_lulusan INT DEFAULT 0,
    jml_terlacak INT DEFAULT 0,
    kesesuaian_rendah INT DEFAULT 0,
    kesesuaian_sedang INT DEFAULT 0,
    kesesuaian_tinggi INT DEFAULT 0,
    prodi_id INT DEFAULT 1
)");

echo "Table trx_kesesuaian_bidang (8.d.2) is ready.\n";
