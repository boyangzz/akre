<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

$queries = [
    "ALTER TABLE trx_seleksi_mahasiswa ADD COLUMN mhs_aktif_reguler INT DEFAULT 0",
    "ALTER TABLE trx_seleksi_mahasiswa ADD COLUMN mhs_aktif_transfer INT DEFAULT 0",
];

foreach($queries as $q) {
    @$mysqli->query($q);
}

echo "Database trx_seleksi_mahasiswa updated with active student columns.\n";
