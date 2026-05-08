<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Buat tabel ringkasan publikasi mhs (8.f.1)
$mysqli->query("CREATE TABLE IF NOT EXISTS trx_publikasi_mhs_summary (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis_publikasi VARCHAR(255),
    jml_ts2 INT DEFAULT 0,
    jml_ts1 INT DEFAULT 0,
    jml_ts0 INT DEFAULT 0,
    prodi_id INT DEFAULT 1
)");

// Seed 10 kategori publikasi jika belum ada
$kategoris = [
    'Jurnal penelitian tidak terakreditasi',
    'Jurnal penelitian nasional terakreditasi',
    'Jurnal penelitian internasional',
    'Jurnal penelitian internasional bereputasi',
    'Seminar wilayah/lokal/perguruan tinggi',
    'Seminar nasional',
    'Seminar internasional',
    'Tulisan di media massa wilayah',
    'Tulisan di media massa nasional',
    'Tulisan di media massa internasional'
];

foreach ($kategoris as $k) {
    $check = $mysqli->query("SELECT id FROM trx_publikasi_mhs_summary WHERE jenis_publikasi = '$k'");
    if ($check->num_rows == 0) {
        $mysqli->query("INSERT INTO trx_publikasi_mhs_summary (jenis_publikasi) VALUES ('$k')");
    }
}

echo "Table trx_publikasi_mhs_summary (8.f.1) is ready.\n";
