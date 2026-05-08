<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Paksa 6b muncul di semua jenjang untuk keperluan audit
$mysqli->query("UPDATE setup_tabel_borang 
                SET jenjang_filter = '[\"D3\",\"S1\",\"S2\",\"S3\"]' 
                WHERE kode_tabel = '6b'");

echo "Menu 6b forced to visible for all levels.\n";
