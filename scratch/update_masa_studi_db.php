<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Update tabel trx_masa_studi agar bisa menampung s.d. TS-6 (untuk S1/S3)
$queries = [
    "ALTER TABLE trx_masa_studi ADD COLUMN jml_lulus_ts6 INT DEFAULT 0",
    "ALTER TABLE trx_masa_studi ADD COLUMN jml_lulus_ts5 INT DEFAULT 0",
    "ALTER TABLE trx_masa_studi ADD COLUMN jml_lulus_ts4 INT DEFAULT 0",
    "ALTER TABLE trx_masa_studi ADD COLUMN jml_lulus_ts3 INT DEFAULT 0",
    "ALTER TABLE trx_masa_studi ADD COLUMN jml_lulus_ts2 INT DEFAULT 0",
    "ALTER TABLE trx_masa_studi ADD COLUMN jml_lulus_ts1 INT DEFAULT 0",
    "ALTER TABLE trx_masa_studi ADD COLUMN jml_lulus_ts0 INT DEFAULT 0",
    "ALTER TABLE trx_masa_studi ADD COLUMN rata_masa_studi DECIMAL(10,2) DEFAULT 0",
];

foreach($queries as $q) {
    @$mysqli->query($q);
}

echo "Database trx_masa_studi expanded for all program levels.\n";
