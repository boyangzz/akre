<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

$query = "CREATE TABLE IF NOT EXISTS trx_produk_jasa_dtps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dosen_id INT,
    nama_produk VARCHAR(255),
    deskripsi TEXT,
    bukti VARCHAR(255),
    tahun YEAR,
    prodi_id INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$mysqli->query($query);

echo "Table trx_produk_jasa_dtps created.\n";
