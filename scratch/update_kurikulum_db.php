<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Update tabel master_mata_kuliah agar sesuai dengan 15 kolom Excel
$queries = [
    "ALTER TABLE master_mata_kuliah ADD COLUMN sks_kuliah INT DEFAULT 0",
    "ALTER TABLE master_mata_kuliah ADD COLUMN sks_seminar INT DEFAULT 0",
    "ALTER TABLE master_mata_kuliah ADD COLUMN sks_praktikum INT DEFAULT 0",
    "ALTER TABLE master_mata_kuliah ADD COLUMN konversi_jam DECIMAL(10,2) DEFAULT 0",
    "ALTER TABLE master_mata_kuliah ADD COLUMN cpl_sikap TINYINT DEFAULT 0",
    "ALTER TABLE master_mata_kuliah ADD COLUMN cpl_pengetahuan TINYINT DEFAULT 0",
    "ALTER TABLE master_mata_kuliah ADD COLUMN cpl_ku TINYINT DEFAULT 0",
    "ALTER TABLE master_mata_kuliah ADD COLUMN cpl_kk TINYINT DEFAULT 0",
    "ALTER TABLE master_mata_kuliah ADD COLUMN unit_penyelenggara VARCHAR(255)",
    "ALTER TABLE master_mata_kuliah ADD COLUMN rps_link VARCHAR(255)",
    "ALTER TABLE master_mata_kuliah ADD COLUMN is_kompetensi TINYINT DEFAULT 0",
];

foreach($queries as $q) {
    @$mysqli->query($q);
}

echo "Database master_mata_kuliah expanded to 15 columns.\n";
