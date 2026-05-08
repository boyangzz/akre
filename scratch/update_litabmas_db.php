<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Add columns to trx_penelitian_dtps
$sql1 = "ALTER TABLE trx_penelitian_dtps 
    ADD COLUMN IF NOT EXISTS melibatkan_mahasiswa TINYINT(1) DEFAULT 0,
    ADD COLUMN IF NOT EXISTS tema_roadmap VARCHAR(255),
    ADD COLUMN IF NOT EXISTS mahasiswa_id INT,
    ADD COLUMN IF NOT EXISTS judul_kegiatan TEXT,
    ADD COLUMN IF NOT EXISTS tahun INT";

// Add columns to trx_pkm_dtps
$sql2 = "ALTER TABLE trx_pkm_dtps 
    ADD COLUMN IF NOT EXISTS melibatkan_mahasiswa TINYINT(1) DEFAULT 0,
    ADD COLUMN IF NOT EXISTS tema_roadmap VARCHAR(255),
    ADD COLUMN IF NOT EXISTS mahasiswa_id INT,
    ADD COLUMN IF NOT EXISTS judul_kegiatan TEXT,
    ADD COLUMN IF NOT EXISTS tahun INT";

if ($mysqli->query($sql1) && $mysqli->query($sql2)) {
    echo "Database tables updated successfully.\n";
} else {
    echo "Error updating database: " . $mysqli->error . "\n";
}
