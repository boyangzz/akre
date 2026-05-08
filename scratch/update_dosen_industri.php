<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

$queries = [
    "ALTER TABLE master_dosen ADD COLUMN nama_perusahaan VARCHAR(255)",
    "ALTER TABLE master_dosen ADD COLUMN bobot_sks_praktisi INT DEFAULT 0",
];

foreach($queries as $q) {
    @$mysqli->query($q);
}

echo "Database master_dosen updated with Industry fields.\n";
