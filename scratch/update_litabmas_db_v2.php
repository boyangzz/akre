<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

$queries = [
    "ALTER TABLE trx_penelitian_dtps ADD COLUMN melibatkan_mahasiswa TINYINT(1) DEFAULT 0",
    "ALTER TABLE trx_penelitian_dtps ADD COLUMN tema_roadmap VARCHAR(255)",
    "ALTER TABLE trx_penelitian_dtps ADD COLUMN mahasiswa_id INT",
    "ALTER TABLE trx_penelitian_dtps ADD COLUMN judul_kegiatan TEXT",
    "ALTER TABLE trx_penelitian_dtps ADD COLUMN tahun INT",
    "ALTER TABLE trx_pkm_dtps ADD COLUMN melibatkan_mahasiswa TINYINT(1) DEFAULT 0",
    "ALTER TABLE trx_pkm_dtps ADD COLUMN tema_roadmap VARCHAR(255)",
    "ALTER TABLE trx_pkm_dtps ADD COLUMN mahasiswa_id INT",
    "ALTER TABLE trx_pkm_dtps ADD COLUMN judul_kegiatan TEXT",
    "ALTER TABLE trx_pkm_dtps ADD COLUMN tahun INT",
];

foreach($queries as $q) {
    @$mysqli->query($q); // Suppress errors if column already exists
}

echo "Database maintenance completed.\n";
