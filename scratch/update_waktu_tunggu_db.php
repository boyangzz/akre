<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Update tabel trx_waktu_tunggu agar support semua jenjang
$queries = [
    "ALTER TABLE trx_waktu_tunggu ADD COLUMN jml_dipesan INT DEFAULT 0",
    "ALTER TABLE trx_waktu_tunggu ADD COLUMN wt_low INT DEFAULT 0",
    "ALTER TABLE trx_waktu_tunggu ADD COLUMN wt_mid INT DEFAULT 0",
    "ALTER TABLE trx_waktu_tunggu ADD COLUMN wt_high INT DEFAULT 0",
];

foreach($queries as $q) {
    @$mysqli->query($q);
}

echo "Database trx_waktu_tunggu expanded.\n";
