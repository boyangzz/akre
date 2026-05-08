<?php
$mysqli = new mysqli("localhost", "root", "", "aps");
$sql = "CREATE TABLE IF NOT EXISTS identitas_prodi_upps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis_program VARCHAR(100),
    nama_prodi VARCHAR(255),
    status_peringkat VARCHAR(100),
    no_tgl_sk VARCHAR(255),
    tgl_kadaluarsa DATE,
    jumlah_mahasiswa INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($mysqli->query($sql)) {
    echo "Table identitas_prodi_upps created successfully.\n";
} else {
    echo "Error: " . $mysqli->error . "\n";
}
