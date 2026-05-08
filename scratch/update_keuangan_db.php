<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Update tabel agar mendukung pemisahan UPPS dan PS
$queries = [
    "ALTER TABLE trx_penggunaan_dana ADD COLUMN nominal_upps_ts2 BIGINT DEFAULT 0",
    "ALTER TABLE trx_penggunaan_dana ADD COLUMN nominal_upps_ts1 BIGINT DEFAULT 0",
    "ALTER TABLE trx_penggunaan_dana ADD COLUMN nominal_upps_ts BIGINT DEFAULT 0",
    "ALTER TABLE trx_penggunaan_dana ADD COLUMN nominal_ps_ts2 BIGINT DEFAULT 0",
    "ALTER TABLE trx_penggunaan_dana ADD COLUMN nominal_ps_ts1 BIGINT DEFAULT 0",
    "ALTER TABLE trx_penggunaan_dana ADD COLUMN nominal_ps_ts BIGINT DEFAULT 0",
];

foreach($queries as $q) {
    @$mysqli->query($q);
}

echo "Database trx_penggunaan_dana updated for dual UPPS/PS structure.\n";
