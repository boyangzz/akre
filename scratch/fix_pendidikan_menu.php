<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Daftarkan visibilitas untuk Kriteria 5 (Pendidikan)
$menus = [
    ['5a', 'Kurikulum & CPL', 'pendidikan', 21],
    ['5b', 'Integrasi Penlitian/PkM', 'pendidikan', 22],
    ['5c', 'Kepuasan Mahasiswa', 'pendidikan', 23],
];

foreach ($menus as $m) {
    $check = $mysqli->query("SELECT id FROM setup_tabel_borang WHERE kode_tabel = '{$m[0]}'");
    if ($check->num_rows == 0) {
        $mysqli->query("INSERT INTO setup_tabel_borang (kode_tabel, nama_tabel, kategori, urutan, jenjang_filter) 
                        VALUES ('{$m[0]}', '{$m[1]}', '{$m[2]}', {$m[3]}, '[\"D3\",\"S1\",\"S2\",\"S3\"]')");
    } else {
        $mysqli->query("UPDATE setup_tabel_borang 
                        SET jenjang_filter = '[\"D3\",\"S1\",\"S2\",\"S3\"]' 
                        WHERE kode_tabel = '{$m[0]}'");
    }
}

echo "Menu Pendidikan (5a, 5b, 5c) visibility updated.\n";
