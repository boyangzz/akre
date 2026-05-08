<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Gunakan kode temporary agar tidak duplicate key
$mysqli->query("UPDATE setup_tabel_borang SET kode_tabel = '3b_tmp' WHERE kode_tabel = '3b5'");
$mysqli->query("UPDATE setup_tabel_borang SET kode_tabel = '3b5', nama_tabel = 'Karya Ilmiah yang Disitasi' WHERE kode_tabel = '3b6'");
$mysqli->query("UPDATE setup_tabel_borang SET kode_tabel = '3b7', nama_tabel = 'HKI, Paten, Buku' WHERE kode_tabel = '3b_tmp'");

// Pastikan 3b6 ada
$check = $mysqli->query("SELECT id FROM setup_tabel_borang WHERE kode_tabel = '3b6'");
if ($check->num_rows == 0) {
    $mysqli->query("INSERT INTO setup_tabel_borang (kode_tabel, nama_tabel, kategori, urutan, jenjang_filter) 
                    VALUES ('3b6', 'Produk/Jasa yang Diadopsi', 'dosen', 6, '[\"D3\",\"S1\"]')");
}

echo "Menu numbering synchronized successfully.\n";
