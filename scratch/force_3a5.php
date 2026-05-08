<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Buka akses 3a5 untuk semua jenjang (D3, S1, dll) agar muncul di navbar
$mysqli->query("UPDATE setup_tabel_borang 
                SET jenjang_filter = '[\"D3\",\"S1\",\"S2\",\"S3\"]' 
                WHERE kode_tabel = '3a5'");

echo "Menu 3a5 is now visible for ALL levels.\n";
