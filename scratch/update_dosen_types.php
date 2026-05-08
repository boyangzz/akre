<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

$queries = [
    "ALTER TABLE master_dosen MODIFY COLUMN sertifikat_pendidik VARCHAR(255)",
    "ALTER TABLE master_dosen MODIFY COLUMN sertifikat_kompetensi VARCHAR(255)",
];

foreach($queries as $q) {
    @$mysqli->query($q);
}

echo "Database master_dosen types updated to VARCHAR.\n";
