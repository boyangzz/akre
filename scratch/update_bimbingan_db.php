<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

$queries = [
    "ALTER TABLE trx_dosen_bimbingan ADD COLUMN ps_sendiri_ts2 INT DEFAULT 0",
    "ALTER TABLE trx_dosen_bimbingan ADD COLUMN ps_sendiri_ts1 INT DEFAULT 0",
    "ALTER TABLE trx_dosen_bimbingan ADD COLUMN ps_sendiri_ts INT DEFAULT 0",
    "ALTER TABLE trx_dosen_bimbingan ADD COLUMN ps_lain_ts2 INT DEFAULT 0",
    "ALTER TABLE trx_dosen_bimbingan ADD COLUMN ps_lain_ts1 INT DEFAULT 0",
    "ALTER TABLE trx_dosen_bimbingan ADD COLUMN ps_lain_ts INT DEFAULT 0",
];

foreach($queries as $q) {
    @$mysqli->query($q);
}

echo "Database trx_dosen_bimbingan updated to multi-year structure.\n";
