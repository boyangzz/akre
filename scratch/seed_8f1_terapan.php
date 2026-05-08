<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Tambahkan kategori khusus Terapan jika belum ada
$kategoris_terapan = [
    'Pagelaran/pameran/presentasi dalam forum di tingkat wilayah',
    'Pagelaran/pameran/presentasi dalam forum di tingkat nasional',
    'Pagelaran/pameran/presentasi dalam forum di tingkat internasional'
];

foreach ($kategoris_terapan as $k) {
    $check = $mysqli->query("SELECT id FROM trx_publikasi_mhs_summary WHERE jenis_publikasi = '$k'");
    if ($check->num_rows == 0) {
        $mysqli->query("INSERT INTO trx_publikasi_mhs_summary (jenis_publikasi) VALUES ('$k')");
    }
}

echo "Terapan categories seeded to 8.f.1 summary.\n";
