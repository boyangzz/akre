<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Rename Luaran Lain (3b7) ke 3b8 dulu agar 3b7 kosong
$mysqli->query("UPDATE setup_tabel_borang SET kode_tabel = '3b8', nama_tabel = 'Luaran Lainnya' WHERE kode_tabel = '3b7'");

// Pindahkan HKI (3b_tmp) ke 3b7
$mysqli->query("UPDATE setup_tabel_borang SET kode_tabel = '3b7', nama_tabel = 'HKI, Paten, Buku' WHERE kode_tabel = '3b_tmp'");

// Buat 3b6 jika belum ada
$check = $mysqli->query("SELECT id FROM setup_tabel_borang WHERE kode_tabel = '3b6'");
if ($check->num_rows == 0) {
    $mysqli->query("INSERT INTO setup_tabel_borang (kode_tabel, nama_tabel, kategori, urutan, jenjang_filter) 
                    VALUES ('3b6', 'Produk/Jasa yang Diadopsi', 'dosen', 6, '[\"D3\",\"S1\"]')");
}

echo "Final menu synchronization complete.\n";
