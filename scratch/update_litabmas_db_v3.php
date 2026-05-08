<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

$queries = [
    "ALTER TABLE trx_penelitian_dtps ADD COLUMN dosen_id INT",
    "ALTER TABLE trx_pkm_dtps ADD COLUMN dosen_id INT",
];

foreach($queries as $q) {
    @$mysqli->query($q);
}

echo "Column dosen_id added successfully.\n";
