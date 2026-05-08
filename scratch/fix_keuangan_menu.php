<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Pastikan kode 4 (Keuangan) ada dan terbuka untuk semua jenjang
$check = $mysqli->query("SELECT id FROM setup_tabel_borang WHERE kode_tabel = '4'");
if ($check->num_rows == 0) {
    $mysqli->query("INSERT INTO setup_tabel_borang (kode_tabel, nama_tabel, kategori, urutan, jenjang_filter) 
                    VALUES ('4', 'Penggunaan Dana', 'keuangan', 20, '[\"D3\",\"S1\",\"S2\",\"S3\"]')");
} else {
    $mysqli->query("UPDATE setup_tabel_borang 
                    SET jenjang_filter = '[\"D3\",\"S1\",\"S2\",\"S3\"]' 
                    WHERE kode_tabel = '4'");
}

echo "Menu Keuangan (4) visibility updated.\n";
