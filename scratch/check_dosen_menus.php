<?php
$mysqli = new mysqli("localhost", "root", "", "aps");
$res = $mysqli->query("SELECT kode_tabel, nama_tabel FROM setup_tabel_borang WHERE kategori = 'dosen'");
while($row = $res->fetch_assoc()) {
    echo $row['kode_tabel'] . " | " . $row['nama_tabel'] . "\n";
}
