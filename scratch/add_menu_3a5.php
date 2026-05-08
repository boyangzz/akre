<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Cek apakah 3a5 sudah ada, jika belum insert
$check = $mysqli->query("SELECT id FROM setup_tabel_borang WHERE kode_tabel = '3a5'");
if ($check->num_rows == 0) {
    $mysqli->query("INSERT INTO setup_tabel_borang (kode_tabel, nama_tabel, kategori, urutan) 
                    VALUES ('3a5', 'Dosen Industri/Praktisi', 'dosen', 5)");
    echo "Menu 3a5 added to setup_tabel_borang.\n";
} else {
    echo "Menu 3a5 already exists in setup_tabel_borang.\n";
}
