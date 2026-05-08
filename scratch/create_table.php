<?php
$mysqli = new mysqli("localhost", "root", "", "aps");
$sql = "CREATE TABLE IF NOT EXISTS trx_penggunaan_dana (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prodi_id INT,
    jenis_penggunaan VARCHAR(255),
    nominal_ts2 BIGINT DEFAULT 0,
    nominal_ts1 BIGINT DEFAULT 0,
    nominal_ts BIGINT DEFAULT 0,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($mysqli->query($sql)) {
    echo "Table trx_penggunaan_dana created successfully.\n";
} else {
    echo "Error creating table: " . $mysqli->error . "\n";
}
