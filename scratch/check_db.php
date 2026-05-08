<?php
$mysqli = new mysqli("localhost", "root", "", "aps");
$result = $mysqli->query("SELECT kode_tabel, nama_tabel FROM setup_tabel_borang ORDER BY kode_tabel");
while ($row = $result->fetch_assoc()) {
    echo '[' . $row['kode_tabel'] . '] ' . $row['nama_tabel'] . "\n";
}
