<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Daftarkan menu 6b (Khusus S2/S3)
$check = $mysqli->query("SELECT id FROM setup_tabel_borang WHERE kode_tabel = '6b'");
if ($check->num_rows == 0) {
    $mysqli->query("INSERT INTO setup_tabel_borang (kode_tabel, nama_tabel, kategori, urutan, jenjang_filter) 
                    VALUES ('6b', 'Penelitian Rujukan Tesis/Disertasi', 'litabmas', 25, '[\"S2\",\"S3\"]')");
}

echo "Menu 6b for S2/S3 activated.\n";
