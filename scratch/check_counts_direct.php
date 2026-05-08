<?php
$mysqli = new mysqli("localhost", "root", "", "aps");
$tables = ['trx_masa_studi', 'trx_waktu_tunggu', 'trx_seleksi_mahasiswa', 'master_dosen', 'trx_kesesuaian_bidang'];
foreach ($tables as $t) {
    $res = $mysqli->query("SELECT COUNT(*) as total FROM $t");
    $row = $res->fetch_assoc();
    echo "$t: " . $row['total'] . "\n";
}
