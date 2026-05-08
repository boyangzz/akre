<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Tambahkan filter jenjang D3 untuk 3a5
$mysqli->query("UPDATE setup_tabel_borang 
                SET jenjang_filter = '[\"D3\"]' 
                WHERE kode_tabel = '3a5'");

echo "Visibility for Menu 3a5 updated to include D3.\n";
